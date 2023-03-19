<div class="container ">
    <div class="row mt-2 mb-2">

        <?php if(!empty($this->products)): ?>

        <div class="col-md-8 bg-white">
            <h4 class="text-center m-3">Carro de compras</h4>
            <div class="table-responsive">
                <table class="table " >
                    <thead class="text-secondary">
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">Producto</th>
                        <th scope="col" class="text-center ">Unidades</th>
                        <th scope="col" class="text-center">Precio</th>
                        <th scope="col" class="text-center">Subtotal</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php $total = 0.0;?>

                        <?php foreach($this->products as &$product): ?>
                            <?php
        
                            $price = number_format($product['price'], 2, '.', '');
                            $subtotal = $price * $_SESSION['cart'][$product['id']];
                            $subtotal = number_format($subtotal, 2, '.', '');
                            $total += $subtotal;
                            ?>
                        <tr>
                            <td>
                                <img src="<?=URL . PATH_PRODUCT_IMAGES . $product['image']?>" width="100" height="100"  alt="img">
                            </td>
                            <td class ="align-middle">
                                <a href="<?=URL?>product/details&id=<?=$product['id']?>" class="product_link">
                                    <?=$product['title']?>
                                </a>    
                            </td>
                            <td class="text-center align-middle"><?=$_SESSION['cart'][$product['id']]?></td>


                            <td class="text-center align-middle" >$<?=$price?></td>
                            <td class="text-center align-middle" ><b>$<?=$subtotal?></b></td>
                            <td class="text-center align-middle">
                                <a  href="<?=URL?>product/removeProductToCart&product_id=<?=$product['id']?>" class="btn btn-sm btn-outline-danger" type="button ">
                                    <i class="fa fa-times " aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    
                </table>
            </div>

        </div>
        <div class="col-md-4 bg-dark">
            <div class=" text-white p-3">
                <?php
                $total = number_format($total, 2, '.', '');
                ?>
                <h4 class="text-center">Resumen de pedido</h4>
                <hr>

                <div class="d-flex justify-content-between mt-3">
                    <span>Productos: <?=$this->products_in_cart?></span>
                    <span>$ <?=$total?> MXN</span>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <span>Precio de envio</span>
                    <span>$ 0.00 MXN</span>
                </div>
                
                <hr>
                <div class="d-flex justify-content-between mt-4 mb-3">
                    <span><b>PRECIO TOTAL </b></span>
                    <span><b>$ <?=$total?> MXN</b></span>
                </div>
                
                <?php if(isset($_SESSION['identity']) && $_SESSION['identity'] != null):?>

                <a href="<?=URL?>order/createOrder" class="btn btn-danger w-100">COMPRAR</a>

                <?php else:?>

                <a href="<?=URL?>user/login" class="btn btn-secondary w-100">Inicia sesión para continuar</a>

                <?php endif;?>
            </div>
        </div>

        <?php else: ?>
        <div class="col bg-white text-center p-5 ">
            <span class="">
                <i class="fas fa-cart-arrow-down fa-6x" aria-hidden="true"></i>
            </span>
            <p class="mt-3">Tu carro de compras esta vacio</p>
            <a href="<?=URL?>" class="btn btn-danger">Continuar comprando</a>
        </div>
        <?php endif; ?>


    </div>
</div>