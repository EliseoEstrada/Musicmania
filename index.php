<?php

//Iniciar la sesión
session_start();


require_once 'autoload.php';            // Llamo a los controladores a través del autoload
require_once 'config/parameters.php';   //Conexión a la base de datos.
require_once 'src/helpers/utils.php'; //Archivo de utilidades
require_once 'src/libs/database.php';
require_once 'src/libs/controller.php';
require_once 'src/libs/model.php';
require_once 'src/libs/view.php';
require_once 'src/libs/app.php';

$app = new App();

?>