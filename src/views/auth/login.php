<div class="row justify-content-center ">
    <div class="col-12 col-md-8 col-lg-4 col-xl-4 p-3 " >

        <form action="<?=URL?>user/login" method="POST" id="login"class=" bg-white p-3 border rounded">
            
            <h2 class="text-center mb-4">Bienvenido</h2>

            <?php 
            if(isset($this->message) && $this->message != null){ 
                if($this->message['type'] == 'success'){
                    $type_message = 'alert-success';
                }else{
                    $type_message = 'alert-danger';
                }
            ?>

                <div class="alert <?=$type_message?> d-flex align-items-center " role="alert">
                    <span class="my-auto mx-auto"> 
                        <?=$this->message['content']?>
                    </span>    
                </div>

            <?php 
            }
            ?>

            <?php
            $user = isset($this->data)? $this->data['user'] : null;
            $pass = isset($this->data)? $this->data['password'] : null;
            ?>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-user mr-1" ></i></span>
                    <input type="text" name="user" class="form-control"  value="<?=$user?>" placeholder="Usuario o Correo" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"> <i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control"  value="<?=$pass?>" placeholder="Contraseña" required>
                </div>
                
            </div>

            <button type="submit" name="submit" class="btn btn-danger w-100">Ingresar</button>

            <hr class="mt-4 mb-3">
            <p class="text-center">
                <span>¿No tienes cuenta?</span>
                <a href="<?=URL?>user/signup">Registrarse</a>
            </p>
        </form>

    </div>
</div>
