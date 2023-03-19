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

    function byCategory(){
        if(isset($_GET) && $_GET['category'] != null){
            $category = $_GET['category'];
            $products = $this->model->getByCategory($category);
            $this->view->products = $products;
            $this->view->title = $category;
            $this->render('product/filter');
        }
    }

    function search(){
        if(isset($_POST['search'])){
            $search = $_POST['search'];
            $products = $this->model->getBySearch($search);
            $this->view->products = $products;
            $this->view->title = $search;
            $this->render('product/filter');
            
        }
    }

    function details(){
        if(isset($_GET) && $_GET != null){
            $idProduct = $_GET['id'] ? $_GET['id'] : null;

            if($idProduct != null){
                $product = $this->model->getOne($idProduct);

                if($product != null){

                    $this->view->buyed = false;
                    if(isset($_SESSION['identity'])){
                        $this->loadAuxModel('order');
                        $this->view->buyed = $this->auxModel->getProductOrderById($_SESSION['identity']['id'],intval($idProduct));
                    }

                    $this->view->product = $product;
                    $this->render('product/details'); 
                }

            }else{
                $this->view->error();
            }

        }else{
            $this->view->error();
        }
        
    }

    function addToCart(){
        //unset($_SESSION['cart']);
        if(isset($_POST['product_id'], $_POST['quantity'])){

            $product_id = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];

            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                if (array_key_exists($product_id, $_SESSION['cart'])) {
                    // Product exists in cart so just update the quanity
                    $_SESSION['cart'][$product_id] += $quantity;
                } else {
                    // Product is not in cart so add it
                    $_SESSION['cart'][$product_id] = $quantity;
                }
            } else {
                // There are no products in cart, this will add the first product to cart
                $_SESSION['cart'] = array($product_id => $quantity);
            }

            $this->view->redirect('user/cart');

        }
    }

    function getProductsInCart(){
        $items = $this->model->getProductsInCart();
        return $items;
    }

    function removeProductToCart(){
        if(isset($_GET['product_id'])){
            $product_id = (int)$_GET['product_id'];
            unset($_SESSION['cart'][$product_id]);

            $this->view->redirect('user/cart');
        }

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
            $image_route = ROOT .'/'. PATH_PRODUCT_IMAGES . $image_name;

            $data = array(
                'title'             => $title,
                'description'       => $description,
                'price'             => $price,
                'quantity'          => $quantity,
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

//https://codeshack.io/shopping-cart-system-php-mysql/