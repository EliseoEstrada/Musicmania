<?php

class AdminController extends Controller{
    function __construct(){
        //Controlador padre
        parent::__construct();    
    }

    function render($vista){
        $this->view->render($vista);
    }

    function index(){
        $this->render('product/add');
    }

}
