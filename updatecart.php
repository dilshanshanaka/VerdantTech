<?php

include "includes/database.php";
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userid'])){
    $cartItemId = $_POST['cartItemId'];
    $qty = $_POST['qty'];
    $sql = "UPDATE orderitem SET qty ='$qty' WHERE orderItemId='$cartItemId'";

    if(mysqli_query($dbcon, $sql)){
        header('Location: cart.php');
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['userid'])){
    $cartItemId = $_POST['cartItemId'];
    $qty = $_POST['qty'];
    $i = 0;
    $cartItem = 0;

    while($cartItem != $cartItemId){
        $cart = $_SESSION['cartproducts'][$i];
        $cartItem = $cart['itemId'];
        $i++;
    }

    $index = $i -1;
    $_SESSION['cartproducts'][$index]['qty'] = $qty;
    header('Location: cart.php');
}

?>