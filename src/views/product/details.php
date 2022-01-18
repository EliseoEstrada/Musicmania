<div class="container">
    <div class="row rounded mb-2 mt-1 bg-white ">
        <div class="col-lg-6 text-center p-1">
            <img src="<?=URL . path_product_images . $this->product['image']?>" class="img-fluid " >    
        </div>
        <!--COMPRAR PRODUCTO-->
        <div class="col-lg-6  d-flex align-items-center ">
            <div class="card-body pb-2 ">
                <h4 class="card-title"><strong><span><?=$this->product['title']?></span></strong></h4>
                <p class="mb-0"><strong>Descripcion</strong></p>
                <p class="card-text"><?=$this->product['description']?></p>
                <p class="mb-0"><strong>Categoria</strong></p>
                <p class="card-text"><?=$this->product['category']?></p>

                <?php $price = number_format($this->product['price'], 2, '.', ''); ?>
                <p class="mb-3 card-title text-danger text-center fs-4"><b>$ <?=$price?> MXN</b></p>

                <form action="<?=URL?>product/addToCart" class="pb-1" method="POST">

                    <?php $quantity = $this->product['quantity']; ?>

                    <p class="mb-2"><b>Unidades disponibles</b> <?=$quantity?></p>
                    <div class="input-group " >    
                        <b class="my-auto me-2">Cantidad: </b>
                        <select class="form-control form-control-sm" name="quantity">

                            <?php for($i = 1; $i <= $quantity; $i++): ?>

                                <option clas="text-center" value="<?=$i?>"><?=$i?></option>

                            <?php endfor; ?>

                        </select>
                        <input type="hidden" name="product_id" value="<?=$this->product['id']?>">
                        <button class="btn btn-danger ms-2" type="submit">
                            <i class="fa fa-cart-plus me-3" aria-hidden="true"></i>
                            Agregar al carro
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!--COMENTARIOS-->
    <div class="row ">
        <div class="col-12 p-0 ">
            <div class="card p-md-3">

                
                <div class="p-2">
                    <h5 class="pl-3 pt-2">¿Que te parecio el producto?</h5>
                    <form id="formAgregarComentario" method="POST" action="../ajax/comentario/agregar.php" class=" my-2 my-lg-0 pl-2" idUsuario="<?=$idUsuario?>" idProducto="<?=$idProducto?>">
                        <p class="clasificacion m-0 " style="font-size: 30px;">
                            <input id="radio1" type="radio" name="estrellas" value="5" ><!--
                            --><label for="radio1" class="label-star">★</label><!--
                            --><input id="radio2" type="radio" name="estrellas" value="4"><!--
                            --><label for="radio2" class="label-star">★</label><!--
                            --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                            --><label for="radio3" class="label-star">★</label><!--
                            --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                            --><label for="radio4" class="label-star">★</label><!--
                            --><input id="radio5" type="radio" name="estrellas" value="1" checked><!--
                            --><label for="radio5" class="label-star">★</label>
                        </p>


                        <div class="input-group " >    
                            <input class="form-control " name="comentary" type="text" placeholder="Escribir una reseña" autocomplete="off">
                            <button class="btn btn-danger " type="submit">Publicar</button>
                        </div>

                    </form>
                </div>



                <!--PROMEDIO DE CALIFICACION-->
                <h5 class="pl-3 pt-2">Promedio de calificación</h5>
                <div class="row pb-3">
                    <div class="col">
                        
                        <p class="h1 my-auto ">
                            <span class="orange-color m-0 h1 ">
                            ★★★
                            </span>
                            <span class="">
                                (3.5)
                            </span>
                            
                        </p>
                    </div>
                </div>
                
                <!--COMENTARIOS-->
                <h5 class="pl-3 pt-2">Opiniones acerca de: Nombre producto</h5>

                <?php for($i = 0; $i< 5; $i++):?>
                <div class="row mt-2">
                    <div class="col-2 text-center">
                        <img src="<?=URL . path_product_images . $this->product['image']?>" width="50" height="50" class="rounded-circle ">
                    </div>
                    <div class="col-10">
                        <div class="row">
                            <div class="col-8">
                                <p class="m-0">Usuario</p>
                            </div>
                            <div class="col-4">
                                <p class="m-0 ">
                                    <label class="orange-color m-0">★</label>
                                    <label class="orange-color m-0">★</label>
                                    <label class="orange-color m-0">★</label>
                                </p>
                            </div>
                        </div>
                        <p class="text-secondary">Este es un comentario algo largo que es una reseña</p>
                    </div>                    
                </div>
                <?php endfor;?>
             
            </div>
            
        </div>
    </div>
</div>