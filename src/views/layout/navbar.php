<?php 
    $categories = Utils::showCategories(); 
    ob_start();

    $email = isset($_SESSION['identity']) ? $_SESSION['identity']['email'] : null;
    $user =  isset($_SESSION['identity']) ? $_SESSION['identity']['username'] : null;
    $image = isset($_SESSION['identity']) ? $_SESSION['identity']['image'] : null;
    if($image != null){
        $image = URL . PATH_USER_IMAGE . $image;
    }else{
        $image = PATH_RESOURCES_IMAGES . 'user_layout.png';
    }
?>

<nav class="navbar navbar-dark bg-dark ">
    <div class="container-fluid">
        <!--Boton izquierdo-->
        <button class="navbar-toggler d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar1" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--Titulo-->
        <a class="navbar-brand" href="<?=URL?>">
            <img class="logo_nav" src="<?=PATH_RESOURCES_IMAGES?>Logotipo.png" alt="logo">
        </a>
        <!--Formulario de busqueda-->
        <form method="POST" action="<?=URL?>product/search" class="form-inline w-25 pr-2 d-none d-md-block"  >
            <div class="input-group ">
                <input type="text" class="form-control border-dark" name="search" placeholder="¿Que estas buscando?" autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger" type="submit" ><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <?php if(!isset($_SESSION['identity'])):?>            
        <!--botones login/signup-->
        <div class="my-auto d-none d-md-block">
            <a class="btn  btn-outline-danger text-white my-auto " href="<?=URL?>user/login"  >Iniciar sesión</a>
            <a class="btn btn-outline-secondary text-white my-auto " href="<?=URL?>user/signup"  >Registrarse</a>
            <a class="btn btn-danger " href="<?=URL?>user/cart">
                <i class="fa fa-shopping-cart " aria-hidden="true"></i>
            </a>
        </div>
        <!--Boton derecho-->
        <button class="btn btn btn-outline-secondary btn-lg d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile" aria-controls="offcanvasProfile">
            <span class="text-white "><i class="fa fa-user" ></i></span>
        </button>
        <?php else: ?>

        <!--Boton de perfil-->
        <div class="d-block d-md-none">
            <button class="btn btn-danger btn-lg text-white " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile" aria-controls="offcanvasProfile">
                <span class="d-block d-md-none"><i class="fa fa-user" ></i> </span>
                <p class="d-none d-md-block m-0"><i class="fa fa-user" ></i> <?=$user?></p>
            </button>
        </div>
        <div class="d-md-block d-none">
            <div class="dropdown ">
                <button class="btn btn-danger dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= $image ?>" class="rounded" width="30" height="30" alt=""> <?=$user?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" style="min-width: 0;">
                    <li><a class="dropdown-item " href="<?=URL?>user/profile"><i class="fa fa-user" ></i> Perfil</a></li>
                    <li><a class="dropdown-item " href="<?=URL?>user/cart"><i class="fa fa-user" ></i> Mi carro</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item " href="<?=URL?>user/logout"><i class="fa fa-user" ></i> Cerrar sesion</a></li>
                </ul>
            </div>
        </div>
        <?php endif;?>

        <!--Categorias-->
        <div class="w-100 d-md-block d-none ">
            <ol class="navbar-nav small box_categories">
                <?php foreach($categories as $category): ?>
                <li class="nav-item "><a href="<?=URL?>product/byCategory&category=<?=$category['name']?>" class="nav-link py-1 "><?=$category['name']?></a></li>
                <?php endforeach; ?>
            </ol>
        </div>


        <!-- CANVAS modo responsivo -->

         <!--Canvas Categorias-->
        <div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="offcanvasNavbar1" aria-labelledby="offcanvasNavbarLabel1">
            <div class="offcanvas-header justify-content-end">
                <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        
            <div class="offcanvas-body">
            
                <form method="POST" action="<?=URL?>product/search" class="form-inline mt-3"  >
                    <div class="input-group w-100">
                        <input type="text" class="form-control border-dark" name="search" placeholder="¿Que estas buscando?" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="submit" ><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                
                <h4 class="offcanvas-title text-white mt-5">Categorias</h4>
                <ol class="navbar-nav justify-content-end flex-grow-1 p-3">
                    <?php foreach($categories as $category): ?>
                    <li class="nav-item "><a href="<?=URL?>product/byCategory&category=<?=$category['name']?>" class="nav-link py-2"><?=$category['name']?></a></li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>

        <!--Canvas perfil-->
        <div class="offcanvas offcanvas-end bg-dark" data-bs-scroll="true" tabindex="-1" id="offcanvasProfile" aria-labelledby="offcanvasProfile">
            <div class="offcanvas-header justify-content-end">
                <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php if(isset($_SESSION['identity'])):?>          
                <ul class="navbar-nav justify-content-end flex-grow-1 ps-3">

                    <li class="text-center">
                        <img width="150" height="150" class="rounded-circle" src="<?=$image?>" alt="logo">
                    </li>
                    <li class="mt2">
                        <h5 class="text-white text-center" ><?=$email?></h5>
                    </li>
                    <li class="m-auto mt-2">
                        <a class="btn btn-sm btn-outline-secondary text-white my-auto " href="<?=URL?>user/logout"  >Cerrar sesion</a>
                    </li>

                    <hr class="text-white">

                    <li class="">
                        <a class="nav-link " href="<?=URL?>user/profile"><i class="fa fa-user mr-1" ></i> Mi Perfil</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="<?=URL?>user/cart"><i class="fa fa-shopping-cart " ></i> Mi carro  </a>
                    </li>

                </ul>
                <?php else: ?>          
                <div class="mt-3">
                    <a class="btn btn-secondary text-white my-auto mt-3 w-100" href="<?=URL?>user/cart"  >
                        <i class="fa fa-shopping-cart " aria-hidden="true"></i>
                        Carro de compras
                    </a>
                    <hr>
                    <a class="btn  btn-danger text-white mt-3 w-100" href="<?=URL?>user/login"  >Iniciar sesión</a>
                    <a class="btn btn-secondary text-white my-auto mt-3 w-100" href="<?=URL?>user/signup"  >Registrarse</a>
                </div>
                <?php endif;?>       
            </div>
        </div>
    </div>
</nav>

<div class="main">