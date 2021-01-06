<?php
    session_start();

    $pid = $_POST['productId'];
    $qty = $_POST['qty'];

    if(!isset( $_SESSION['cartproducts'])){
        $_SESSION['cartproducts']=array();
    }
    
    array_push($_SESSION['cartproducts'],array("itemId" => $pid, "qty" => $qty));   

    header('Location: cart.php');

?>