<?php
//Controlador frontal: es aquel que se encarga de cargar ficheros, acciones en 
// función de los parametros de la URL es el único fichero que se encarga de cargarlo 
// absolutamente todo, este index es un ejemplo 

class App{

    function __construct(){
        require_once 'src/views/layout/header.php'; // layout header vista

        $classController = "";
        $action = "";

        //CONTROLADOR
        if(isset($_GET['controller'])){
            //Sí existe el controlador
            $classController = $_GET['controller'].'Controller';
        }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
            //Sí no existe el controlador y la acción, debe cargar el controlador default
            // configurado en el .htaccess 
            $classController = DEFAULT_CONTROLLER;
        }else{

            // Si no existe, llame la función de errores
            $this->show_error();
            exit();
        }


        //ACCION
        // comprobando que el controlador exista

        if(isset($classController) && class_exists($classController)){

            //Creo un nuevo objeto de la clase controladora
            $controller = new $classController();

            
            // Invocando los métodos automáticamente
            if(isset($_GET['action'])){
                if(method_exists($controller, $_GET['action'])){
                    $action = $_GET['action'];
                    $controller->$action();
                }elseif(method_exists($controller, 'index')){
                    $action = "index";
                    $controller->$action();
                }
            }
            elseif(!isset ($_GET['controller']) && !isset ($_GET['action'])){
            //Sí no existe el controlador y la acción, debe cargar el controlador default
            // configurado en el .htaccess 
                $default_action = DEFAULT_ACTION;
                $controller->$default_action();
            }
            else{
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
        $error->index();
    }
}
