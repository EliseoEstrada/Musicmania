<?php
// definir clase controladora de errores 404
class ErrorController{
    
    public function index() {
        echo '
        <div class="row">
            <div class="col-12">
                <div class="text-white text-center mt-5">
                    <h1>La página que buscas no existe</h1>
                </div>
            </div>
        </div>
        ';
    }
    
}

?>