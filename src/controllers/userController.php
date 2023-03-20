<?php

class UserController extends Controller{
    function __construct(){
        //Controlador padre
        parent::__construct();    
        //cargar modelo
        $this->loadModel('user');
    }

    function render($vista){
        $this->view->render($vista);
    }

    function redirect($vista){
        $this->view->redirect($vista);
    }

    function profile(){

        //Obtener historial de compra
        $this->loadAuxModel('order');
        $orders = $this->auxModel->getOrdersByUser($_SESSION['identity']['id']);
        $this->view->orders = $orders;
        
        $this->render('user/profile');
    }

    function signup(){
        
        if(isset($_POST['submit'])){

            $data = array(
                'username'  => $_POST['username'], 
                'email'     => $_POST['email'], 
                'password'  => $_POST['password']
            );

            $result = $this->model->insert($data);

            if(!is_string($result)){
                $_SESSION['identity'] = $result;
                $this->redirect('product/index');
            }else{
                $this->view->addMessage('error', $result);
                $this->view->data = $data;
                $this->render('auth/signup');
            }

        }else{
            $this->render('auth/signup');
        }
    }

    function login(){
        if(isset($_POST['submit'])){
            $data = array(
                'user'       => $_POST['user'], 
                'password'   => $_POST['password']
            );

            $result = $this->model->login($data);

            if(!is_string($result)){
                
                $_SESSION['identity'] = $result;
                $this->redirect('product/index');
            }else{
                
                $this->view->addMessage('error', $result);
                $this->view->data = $data;
                $this->render('auth/login');
            }
        }else{
            $this->render('auth/login');
        }
    }

    function logout(){
        if(isset($_SESSION['identity'])){
            $_SESSION['identity'] = null;
            unset($_SESSION['identity']);
            $this->redirect('product/index');
            //echo '<script>window.location.replace("'.URL.'product/index.php");</script>';
            //$this->render('product/index');
        }
    }

    function updateData(){
        if(isset($_POST['submit'])){
            $data = array(
                'id'        => $_SESSION['identity']['id'],
                'username'  => $_POST['username'], 
                'email'     => $_POST['email'], 
                'address'   => $_POST['address']
            );

            //var_dump($data);

            $result = $this->model->updateData($data);

            if(!is_string($result)){
                $_SESSION['identity']['username']   = $data['username'];
                $_SESSION['identity']['email']      = $data['email'];
                $_SESSION['identity']['address']    = $data['address'];
                $this->view->addMessage('success', "Datos actualizados");
                $this->render('user/profile');
            }else{
                $this->view->addMessage('error', $result);
                $this->render('user/profile');
            }
        }else{
            $this->view->error();
        }
    }

    function updateImage(){
        if(isset($_POST)){

            $image_name         = $_FILES["new_image"]["name"];
            $image_extension    = $_FILES['new_image']['type'];
            $image_tmp          = $_FILES['new_image']['tmp_name'];
            $image_route = ROOT .'/'. PATH_USER_IMAGE . $image_name;

            $data = array(
                'id'        => $_SESSION['identity']['id'],
                'image'     => $image_name,
                'extension' => $image_extension
            );


            //guardar imagen en servidor
            if(move_uploaded_file($image_tmp, $image_route) ){

                //guardar imagen en bd
                $result = $this->model->updateImage($data);

                if(!is_string($result)){

                    //Borrar antigua imagen de servidor
                    $old_image_route = ROOT .'/'. PATH_USER_IMAGE . $_SESSION['identity']['image'];
                    if(file_exists($old_image_route)){
                        try{
                            unlink($old_image_route);
                        }catch(Exception $e){
                            
                        }
                    }

                    //actualizar usuario
                    $_SESSION['identity']['image'] = $data['image'];
                    $_SESSION['identity']['extension'] = $data['extension'];


                    $this->view->addMessage('success', "Imagen actualizada");
                    $this->render('user/profile');

                }else{
                    //borrar imagen de servidor
                    unlink($image_route);
                    $this->view->addMessage('error', $result);
                    $this->render('user/profile');
                }

            }else{
                $this->view->addMessage('error', 'No se pudo subir imagen al servidor');
                $this->render('user/profile');
            }

        }
    }

    function updatePassword(){
        if(isset($_POST['submit'])){
            $data = array(
                'id'        => $_SESSION['identity']['id'],
                'password'  => $_POST['password']
            );

            $result = $this->model->updatePassword($data);

            if(!is_string($result)){
                $_SESSION['identity']['password'] = $data['password'];
                $this->view->addMessage('success', "Contraseña actualizada");
                $this->render('user/profile');
            }else{
                $this->view->addMessage('error', $result);
                $this->render('user/profile');
            }
        }else{
            $this->view->error();
        }
    }

    function cart(){
        $productController = new ProductController();

        $items =[];
        $products_in_cart = 0;

        if(isset($_SESSION['cart'])){
            $items = $productController->getProductsInCart();
            $products_in_cart = count($_SESSION['cart']);
        }

        $this->view->products = $items;
        $this->view->products_in_cart = $products_in_cart;
        

        $this->render('user/cart');
    }

}