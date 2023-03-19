<?php

class View{

    function __construct(){
        //echo "<p>Vista base</p>";
    }

    function render($nombre){
        require_once 'src/views/' . $nombre . '.php';
    }

    function redirect($nombre){
        echo '<script>window.location.replace("' . URL . $nombre . '");</script>';
    }

    function addMessage($type, $content){
        $message = array(
            'type'    => $type,
            'content' => $content
        );

        $this->message = $message;
    }

    function error(){
        $this->redirect('error/index');
    }
}

?>