
<div class="row">

    <?php foreach($this->products as &$product): ?>

        <?php
        
        $price = number_format($product['price'], 2, '.', '');
            
        ?>

    <div class="col-md-3">
        <div class="card m-2">
            <a href="" class="product_link">
                <img src="<?=path_product_images . $product['image']?>" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <h5 class="card-text"><?=$product['title']?></h5>
                    <span  class="card-text fw-bold fs-4">$<?=$price?> MXN</span>
                    <p class="card-text "> 
                        <span class="text-warning">★★★★★</span> 
                        <span>(3)</span>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <?php endforeach; ?>

</div>