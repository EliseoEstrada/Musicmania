<div class="container">
    <div class="row rounded mb-2 mt-1 bg-white ">
        <div class="col-lg-6 text-center p-1">
            <img src="<?=URL . PATH_PRODUCT_IMAGES . $this->product['image']?>" class="img-fluid " >    
        </div>
        <!--COMPRAR PRODUCTO-->
        <div class="col-lg-6  d-flex align-items-center ">
            <div class="card-body pb-2 ">
                <h4 class="card-title"><strong><span><?=$this->product['title']?></span></strong></h4>
                <p class="mb-0"><strong>Descripcion</strong></p>
                <p class="card-text"><?=$this->product['description']?></p>
                <p class="mb-0"><strong>Categoria</strong></p>
                <p class="card-text"><?=$this->product['category']?></p>

                <?php 
                $price = number_format($this->product['price'], 2, '.', ''); 
                ?>

                <p class="mb-3 card-title text-danger text-center fs-4"><b>$ <?=$price?> MXN</b></p>

                <form action="<?=URL?>product/addToCart" class="pb-1" method="POST">

                    <?php 
                    $quantity = $this->product['quantity']; 
                    ?>

                    <p class="mb-2"><b>Unidades disponibles</b> <?=$quantity?></p>
                    <div class="input-group " >    
                        <b class="my-auto me-2">Cantidad: </b>
                        <select class="form-control form-control-sm" name="quantity">

                            <?php 
                            for($i = 1; $i <= $quantity; $i++): 
                            ?>

                                <option clas="text-center" value="<?=$i?>"><?=$i?></option>

                            <?php 
                            endfor; 
                            ?>

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

                <?php 
                if($this->buyed): 
                ?>

                <div class="p-2">
                    <h5 class="pl-3 pt-2">¿Que te parecio el producto?</h5>
                    <form method="POST" action="<?=URL?>review/add"  >
                        <input type="hidden" name="product_id" value="<?=$this->product['id']?>">
                        <div class="star-widget">
                            <input type="radio" id="rate-5" name="stars" value="5" checked >
                            <label for="rate-5" class="label-star">★</label>
                            <input type="radio" id="rate-4" name="stars" value="4" >
                            <label for="rate-4" class="label-star">★</label>
                            <input type="radio" id="rate-3" name="stars" value="3" >
                            <label for="rate-3" class="label-star">★</label>
                            <input type="radio" id="rate-2" name="stars" value="2" >
                            <label for="rate-2" class="label-star">★</label>
                            <input type="radio" id="rate-1" name="stars" value="1">
                            <label for="rate-1" class="label-star">★</label>
                        </div>

                        <div class="input-group " >    
                            <input class="form-control " name="comment" type="text" placeholder="Escribir una reseña" autocomplete="off">
                            <button type="submit" class="btn btn-danger " type="submit">Publicar</button>
                        </div>
                    </form>
                </div>
                <?php 
                endif; 
                ?>

                <?php 
                if($this->product['rating'] != '0'): 
                ?>
                    

                <!--PROMEDIO DE CALIFICACION-->
                <h5 class="pl-3 pt-2">Promedio de calificación</h5>
                <div class="row pb-3">
                    <div class="col">
                        <?php 
                        $rating = number_format($this->product['rating'], 1, '.', ''); 
                        ?>
                        <p class="h1 my-auto ">
                            <span class="orange-color m-0 h1 ">

                            <?php 
                            for($i = 1; $i <= $rating; $i++ ):
                            ?>
                                ★
                            <?php 
                            endfor;
                            ?>

                            </span>
                            <span class="">
                                (<?=$rating?>)
                            </span>
                            
                        </p>
                    </div>
                </div>
                
                <!--COMENTARIOS-->
                <h5 class="pl-3 pt-2">Opiniones acerca de producto</h5>

                <?php 
                $reviews = Utils::getReviews($this->product['id']); 
                foreach($reviews as &$review):
                
                    $image = $review['image'];
                    if($image != null){
                        $image = URL . PATH_USER_IMAGE . $image;
                    }else{
                        $image = PATH_RESOURCES_IMAGES . 'user_layout.png';
                    }                            
                ?>

                <div class="row mt-2">
                    <div class="col-2 text-center">
                        <img src="<?=$image?>" width="50" height="50" class="rounded-circle ">
                    </div>
                    <div class="col-10">
                        <div class="row">
                            <div class="col-8">
                                <p class="m-0"><b><?=$review['username']?></b><span class="text-secondary"> <?=$review['create_at']?></span></p>
                            </div>
                            <div class="col-4">
                                <p class="m-0 ">
                                    <?php for($i = 1; $i <= intval($review['punctuation']); $i++):?>
                                    <label class="orange-color m-0">★</label>
                                    <?php endfor;?>
                                </p>
                            </div>
                        </div>
                        <p class="text-secondary"><?=$review['comment']?></p>
                    </div>                    
                </div>
                <?php endforeach;?>

                <?php else: ?>
                <h5 class="pl-3 pt-2 text-center">El producto aun no ha sido calificado</h5>
                <?php endif; ?>
             
            </div>
            
        </div>
    </div>
</div>