<?php

class Controller{

    function __construct(){
        
        $this->view = new View();
    }

    function loadModel($model){
        
        $clasModel = $model . 'Model';
        $file = 'src/models/'. $clasModel . '.php';

        if(file_exists($file)){
            require_once $file;
            $this->model = new $clasModel();
        }
        
    }

    function loadAuxModel($model){
        
        $clasModel = $model . 'Model';
        $file = 'src/models/'. $clasModel . '.php';

        if(file_exists($file)){
            require $file;
            $this->auxModel = new $clasModel();
        }
        
    }
}

?>