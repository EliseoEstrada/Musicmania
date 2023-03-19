
<div class="row mt-2 mb-3">


    <h3 class="text-center text-white">Productos mas recientes</h3>
    <?php foreach($this->products as &$product): ?>

        <?php
        
        $price = number_format($product['price'], 2, '.', '');
          
        $rating = $product['rating'] ;

        ?>

    <div class="col-md-4 col-lg-3 mt-2 animate__animated animate__fadeInUp">
        <div class="card ms-2 me-2 h-100">
            <a href="<?=URL?>product/details&id=<?=$product['id']?>" class="product_link">
                <img src="<?=URL . PATH_PRODUCT_IMAGES . $product['image']?>" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <h6 class="card-text"><?=$product['title']?></h6>
                    <span  class="card-text fw-bold fs-5">$<?=$price?> MXN</span>
                    <p class="card-text "> 
                        <?php if($rating != 0): ?>
                        <span class="text-warning">★★★★★</span> 
                        <span>(3)</span>
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