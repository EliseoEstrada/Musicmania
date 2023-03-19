<?php

class Utils{

    public static function showCategories(){
        // incluyendo el modelo
        //require_once ROOT.'/src/controllers/categories.php';
        // Creando objeto de la clase modelo
        $categoryController = new CategoryController();
        $categories = $categoryController->getAll();
        
        return $categories;
    }

    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

}

?>