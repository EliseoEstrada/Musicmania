<?php

//Cargar el modelo 
//require_once 'models/producto.php';

// definir clase controladora
class ProductController extends Controller{
    function __construct(){
        //Controlador padre
        parent::__construct();    
        //cargar modelo
        $this->loadModel('product');
    }

    function render($vista){
        $this->view->render($vista);
    }

    function index(){
        $this->getAll();
    }

    function getAll(){
        
        $products = $this->model->getAll();
        $this->view->products = $products;
        $this->render('product/index');
    }

    function add(){
        if(isset($_POST) and $_POST != null){
            $title          = $_POST['title'] ? $_POST['title'] : null;
            $description    = $_POST['description'] ? $_POST['description'] : null;
            $quantity       = $_POST['quantity'] ? $_POST['quantity'] : null;
            $price          = $_POST['price'] ? $_POST['price'] : null;
            $category       = $_POST['category'] ? $_POST['category'] : null;

            $image_name         = $_FILES["image"]["name"];
            $image_extension    = $_FILES['image']['type'];
            $image_tmp          = $_FILES['image']['tmp_name'];
            $image_route = ROOT .'/'. path_image_product . $image_name;

            $data = array(
                'title'             => $title,
                'description'       => $description,
                'price'             => $price,
                'quantity'            => $quantity,
                'category'          => $category,
                'image_name'        => $image_name,
                'image_extension'   => $image_extension
            );

            if (move_uploaded_file($image_tmp, $image_route) ){

                $result = $this->model->insert($data);

                if($result === true){

                    $this->view->addMessage('success', 'Producto agregado con exito');

                }else{
                    unlink( $image_route);

                    $this->view->addMessage('error', $result);
                    $this->view->data = $data;
                }
            }else{
                $this->view->addMessage('error', 'No se pudo subir imagen al servidor');
                $this->view->data = $data;
            }
        }
        
        $this->render('product/add');
    }
}