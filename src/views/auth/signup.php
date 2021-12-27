<div class="row justify-content-center ">
    <div class="col-12 col-md-6 col-lg-4 col-xl-4 p-3 " id="">

        <form action="<?=URL?>user/signup" method="POST" id="signup"class=" bg-white p-3 my-auto my-auto border rounded">
            <h2 class="text-center ">Crear cuenta</h2>

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
            $user = isset($this->data)? $this->data['username'] : null;
            $email = isset($this->data)? $this->data['email'] : null;
            $pass = isset($this->data)? $this->data['password'] : null;
            ?>

            

            <div class="mb-3">
                <label for="username" class="form-label ">Usuario</label>
                <input type="text" name="username" class="form-control" id="username" autofocus="true" value="<?=$user?>" required >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label ">Correo</label>
                <input type="email" name="email" class="form-control" id="email" value="<?=$email?>"required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label ">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password" value="<?=$pass?>" required>
            </div>

            <button type="submit" name="submit" class="btn btn-danger w-100">Registrarse</button>

            <hr class="mt-4 mb-3">
            <p class="text-center">
                <span>¿Ya tienes cuenta?</span>
                <a href="<?=URL?>user/login">Iniciar sesión</a>
            </p>
        </form>

    </div>
</div>
