<?php


if(isset($_POST)){
    $product_id = (int)$_POST['product_id'];

    $_SESSION['cart'] = array_diff($_SESSION['cart'], $product_id);

    echo json_encode(array('result' => true, 'id' => $product_id));
    //echo $result;
}else{
    echo json_encode(array('result' => false));
    //echo false;
}

?>