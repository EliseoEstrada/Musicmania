<?php
//Controlador frontal: es aquel que se encarga de cargar ficheros, acciones en 
// función de los parametros de la URL es el único fichero que se encarga de cargarlo 
// absolutamente todo, este index es un ejemplo 

class App{

    function __construct(){
        require_once 'src/views/layout/header.php'; // layout header vista
        //require_once 'src/views/layout/auxNav.php'; // layout navbar vista
        
        $classController = "";
        $action = "";

        //CONTROLADOR
        if(isset($_GET['controller'])){
            //Sí existe el controlador haga:
            $classController = $_GET['controller'].'Controller';
        }elseif(!isset ($_GET['controller']) && !isset ($_GET['action'])){
            //Sí no existe el controlador y la acción, debe cargar el controlador default
            // configurado en el .htaccess 
            $classController = controller_default;
        }else{
            // Sino existe el error, llame la función de errores
            $this->show_error();
            exit();
        }

        //ACCION
        // comprobando que el controlador exista
        //print_r($classController);
        if(isset($classController) && class_exists($classController)){

            //Creo un nuevo objeto de la clase controladora
            $controller = new $classController();
            // Invocando los métodos automáticamente
            if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
                $action = $_GET['action'];
                $controller->$action();
            }elseif(!isset ($_GET['controller']) && !isset ($_GET['action'])){
            //Sí no existe el controlador y la acción, debe cargar el controlador default
            // configurado en el .htaccess 
                $action_default = action_default;
                $controller->$action_default();
            }else{
                $this->show_error();
            }
        }else{    
            $this->show_error();
            
        }

        require_once 'src/views/layout/footer.php'; // layout navbar vista

    }

    //Funciones para cargar controlador de errores
    function show_error(){
        $error = new ErrorController();
        //$error->index();
    }
}
