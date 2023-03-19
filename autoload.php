<?php
// creamos función para autocargar los archivos de clases
function controllers_autoload($classname){
  
    $classnameParameter = ucfirst($classname);
    $directory = ROOT."/src/controllers/{$classnameParameter}.php";
    if(file_exists($directory)) {
        include $directory;
    } else {
        die("El archivo {$classname}.php no se ha podido encontrar.");
    }
}
// se usa la función de registro de autoload y se le pasa la funcón anterior
spl_autoload_register('controllers_autoload');

