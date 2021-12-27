<?php

class CategoryController extends Controller{
    function __construct(){
        parent::__construct();    
        $this->loadModel('category');
    }

    function getAll(){
        $categories = $this->model->getAll();
        return $categories;
    }
}