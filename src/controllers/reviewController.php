<?php

class ReviewController extends Controller{
    function __construct(){
        //Controlador padre
        parent::__construct();    
        //cargar modelo
        $this->loadModel('review');
    }

    function render($vista){
        $this->view->render($vista);
    }
    function redirect($vista){
        $this->view->redirect($vista);
    }

    function add(){
        if(isset($_POST) and $_POST != null){
            $product_id = $_POST['product_id'];
            $stars = $_POST['stars'];
            $comment = $_POST['comment'];

            $data = array(
                'user_id'          => $_SESSION['identity']['id'],
                'product_id'       => $product_id,
                'comment'          => $comment,
                'punctuation'      => $stars
            );

            $result = $this->model->insert($data);

            if($result){
                $this->redirect("product/details&id={$product_id}");
            }
        }
    }


}