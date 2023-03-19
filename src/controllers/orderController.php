<?php

class OrderController extends Controller{
    function __construct(){
        //Controlador padre
        parent::__construct();    
        //cargar modelo
        $this->loadModel('order');
    }

    function render($vista){
        $this->view->render($vista);
    }

    function index(){
        $this->getAll();
    }

    function createOrder(){
        //Procedure creado, falta todo lo demas

        //Obtener productos
        $this->loadAuxModel('product');
        $products = $this->auxModel->getProductsInCart();


        $total = 0.0;
        foreach($products as &$product){

            $price = $product['price'];
            $total += $price * $_SESSION['cart'][$product['id']];
        }

        $data = array(
            'user_id'     => $_SESSION['identity']['id'],
            'total'       => $total
        );

        //Crear orden en la bd
        $result = $this->model->insert($data);
        if($result !== false){

            //Agregar productos de orden
            foreach($products as &$product){

                $price = $product['price'];
                $subtotal = $price * $_SESSION['cart'][$product['id']];    

                $data2 = array(
                    'order_id'  => $result,
                    'product_id' => $product['id'],
                    'quantity' => $_SESSION['cart'][$product['id']], 
                    'subtotal' => $subtotal
                );

                
                $this->model->insertItem($data2);

            }
            $_SESSION['cart'] = null;
            unset($_SESSION['cart']);
            echo "<script>alert('Gracias por comprar en Musicmania')</script>";
            $this->view->redirect('product/index');

        }else{
            echo 'error';
        }

    }

    

}

