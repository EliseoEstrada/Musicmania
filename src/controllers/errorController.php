<?php
// definir clase controladora de errores 404
class ErrorController extends Controller{
    
    function __construct(){
        parent::__construct();    
    }

    public function index() {
        $this->view->render('error/index');
    }
    
}

?>