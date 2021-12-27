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

    function signup(){
        
        if(isset($_POST['submit'])){

            $data = array(
                'username'      => $_POST['username'], 
                'email'         => $_POST['email'], 
                'password'      => $_POST['password']
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
                'email'         => $_POST['email'], 
                'password'      => $_POST['password']
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

}