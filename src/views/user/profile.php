<?php

$email    = isset($_SESSION['identity']['email']) ? $_SESSION['identity']['email'] : null;
$user     =  isset($_SESSION['identity']['username']) ? $_SESSION['identity']['username'] : null;
$address  =  isset($_SESSION['identity']['address']) ? $_SESSION['identity']['address'] : null;
$image    = isset($_SESSION['identity']['image']) ? $_SESSION['identity']['image'] : null;
$password = isset($_SESSION['identity']['password']) ? $_SESSION['identity']['password'] : null;
if($image != null){
    $image = URL . PATH_USER_IMAGE . $image;
}else{
    $image = PATH_RESOURCES_IMAGES . 'user_layout.png';
}

//Comprobar si hay mensajes

if(isset($this->message) && $this->message != null){ 
    if($this->message['type'] == 'success'){
        $type_message = 'alert-success';
    }else{
        $type_message = 'alert-danger';
    }
}


?>

<div class="container-xxl mt-3 mb-3">
    <div class="row bg-white h-100">
        <div class="col-12 col-md-4 border-end border-secondary border-2">

            <div class="list-group  mt-3 p-3" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">Información personal</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Imagen</a>
                <a class="list-group-item list-group-item-action " id="list-password-list" data-bs-toggle="list" href="#list-password" role="tab" aria-controls="list-password">Contraseña</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">Pedidos</a>
            </div>
            
        </div>

        <!-- ============================= Menu lateral ============================== -->
        
        <div class="col-12 col-md-8 p-4">
            <div class="tab-content ps-md-3 pe-md-3" id="nav-tabContent">

                <?php if(isset($this->message)): ?>

                <div class="alert <?=$type_message?> d-flex align-items-center " role="alert">
                    <span class="my-auto mx-auto"> 
                        <?=$this->message['content']?>
                    </span>    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <?php endif; ?>
                <!-- ============================= Informacion de usuario ============================== -->
                <div class="tab-pane fade show active " id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <form action="<?=URL?>user/updateData" method="POST">
                        <h4 class="text-center">Datos personales</h4>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control form-control-sm" name="email" value="<?=$email?>">
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Usuario</label>
                            <input type="text" class="form-control form-control-sm" name="username" value="<?=$user?>">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Direccion</label>
                            <input type="text" class="form-control form-control-sm" name="address" value="<?=$address?>">
                        </div>
                        <div class="mt-3">
                            <button type="submit" name="submit" class="btn btn-danger w-100">Actualizar datos</button>
                        </div>
                    </form>
                    
                </div>

                <!-- ============================= Imagen ============================== -->
                <div class="tab-pane fade " id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                    <h4 class="text-center">Avatar</h4>
                    <div class="text-center">
                        <img id="user_image_field" src="<?=$image?>" class="img-fluid rounded-circle border border-2 old_image_user" alt="" >
                    </div>

                    <form action="<?=URL?>user/updateImage" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3 mt-3">
                            <input name="new_image" type="file" accept="image/*" class="form-control" id="new_image" onchange="previewImage(event)" aria-describedby="new_image" aria-label="Upload">
                            <button class="btn btn-outline-danger" type="submit" >Actualizar</button>
                        </div>
                    </form>
                </div>
                
                <!-- ============================= Contraseña ============================== -->
                <div class="tab-pane fade " id="list-password" role="tabpanel" aria-labelledby="list-password-list">
                    <form action="<?=URL?>user/updatePassword" method="POST">
                        <h4 class="text-center">Contraseña</h4>

                        <div class="mb-3">
                            <label for="old_password" class="form-label">Contraseña actual</label>
                            <input type="text" class="form-control form-control-sm disabled" name="old_password" readonly value="<?=$password?>">
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control form-control-sm" name="password" >
                        </div>
                        <div class="mt-3">
                            <button type="submit" name="submit" class="btn btn-danger w-100">Cambiar constraseña</button>
                        </div>
                    </form>
                    
                </div>
                <div class="tab-pane fade " id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                    
                    <table class="table table-bordered table-striped table-hover ">
                        <thead>
                            <tr class="text-center">
                            <th scope="col"></th>
                            <th scope="col">Clave</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Total</th>
                            <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($this->orders as $key => &$order): ?>
                            
                            <?php $total = number_format($order['total'], 2, '.', ''); ?>

                            <tr class="text-center">
                                <th scope="row"><?=$key + 1?></th>
                                <td><?=$order['id']?> </td>
                                <td><?=$order['create_at']?></td>


                                <td>$ <?=$total?> MXN</td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-sm " tabindex="-1" role="button" aria-disabled="true">Ver detalles</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>