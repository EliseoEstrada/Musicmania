<?php

$email      = isset($_SESSION['identity']['email']) ? $_SESSION['identity']['email'] : null;
$user       =  isset($_SESSION['identity']['username']) ? $_SESSION['identity']['username'] : null;
$address    =  isset($_SESSION['identity']['address']) ? $_SESSION['identity']['address'] : null;
$image      = isset($_SESSION['identity']['image']) ? $_SESSION['identity']['image'] : null;
$password   = isset($_SESSION['identity']['password']) ? $_SESSION['identity']['password'] : null;
if(!$image != null){
    $image = path_resources_images . 'user_layout.png';
}

?>


<div class="container-xxl mt-3 mb-3">
    <div class="row bg-white">
        <div class="col-12 col-md-4 border-end border-secondary border-2">

            <div class="list-group  mt-3 p-3" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">Información personal</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Imagen</a>
                <a class="list-group-item list-group-item-action " id="list-password-list" data-bs-toggle="list" href="#list-password" role="tab" aria-controls="list-password">Contraseña</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">Carro de compras</a>
                <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">Historial de compras</a>
            </div>
            
        </div>
        
        <div class="col-12 col-md-8 p-4">
            <div class="tab-content ps-md-3 pe-md-3" id="nav-tabContent">
                <div class="tab-pane fade show active " id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <h4 class="text-center">Datos personales</h4>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" class="form-control form-control-sm" id="email" value="<?=$email?>">
                    </div>
                    <div class="mb-3">
                        <label for="user" class="form-label">Usuario</label>
                        <input type="text" class="form-control form-control-sm" id="user" value="<?=$user?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Direccion</label>
                        <input type="text" class="form-control form-control-sm" id="address" value="<?=$address?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" name="submit" class="btn btn-danger w-100">Actualizar datos</button>
                    </div>
                </div>

                <div class="tab-pane fade " id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                    <h4 class="text-center">Avatar</h4>
                    <div class="text-center">
                        <img src="<?=$image?>" class="img-fluid rounded-circle border border-2 old_image_user" alt="" >
                    </div>

                    <div class="input-group mb-3 mt-3">
                        <input  id="new_image" type="file" accept="image/*" class="form-control" id="new_image" aria-describedby="new_image" aria-label="Upload">
                        <button class="btn btn-outline-danger" type="submit" id="new_image">Actualizar</button>
                    </div>
                </div>
                
                <div class="tab-pane fade " id="list-password" role="tabpanel" aria-labelledby="list-password-list">
                    <h4 class="text-center">Contraseña</h4>
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Contraseña actual</label>
                        <input type="text" class="form-control form-control-sm disabled" id="old_password" readonly value="<?=$password?>">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control form-control-sm" id="new_password" >
                    </div>
                    <div class="mt-3">
                        <button type="submit" name="submit" class="btn btn-danger w-100">Cambiar constraseña</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>

                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
            </div>
        </div>
    </div>
</div>