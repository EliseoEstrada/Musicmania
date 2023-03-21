
<div class="row mt-2 mb-3">


    <h3 class="text-center text-white">Resultados de "<?=$this->title?>"</h3>
    <?php foreach($this->products as &$product): ?>

        <?php
        
        $price = number_format($product['price'], 2, '.', '');
        
        $rating = $product['rating'] ;

        ?>

    <div class="col-md-4 col-lg-3 mt-2">
        <div class="card ms-2 me-2 h-100">
            <a href="<?=URL?>product/details&id=<?=$product['id']?>" class="product_link">
                <img src="<?=URL . PATH_PRODUCT_IMAGES . $product['image']?>" class="card-img-top" alt="image-product">
                <div class="card-body text-center">
                    <h6 class="card-text"><?=$product['title']?></h6>
                    <span  class="card-text fw-bold fs-5">$<?=$price?> MXN</span>
                    <p class="card-text "> 
                        <?php if($rating != 0): ?>
                            <?php 
                            $rating = number_format($rating, 1, '.', '');
                            $auxRating = round($rating, 0, PHP_ROUND_HALF_DOWN);
                            for($i = 1; $i <= $auxRating; $i++):
                            ?>
                                <span class="text-warning">★</span> 
                            <?php 
                            endfor;
                            ?>
                            <span><?=$rating;?></span>
                        <?php else: ?>
                            <span class="text-danger">Aun no ha sido calificado</span> 
                        <?php endif; ?>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <?php endforeach; ?>

</div>