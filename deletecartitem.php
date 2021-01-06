<?php 
include 'includes/database.php';

session_start();

// Product Id from GET method
$orderItemId = $_GET['orderItemId'];

// Delete MySQL Query
if(isset($_SESSION['userid'])){
    $sql = "DELETE FROM orderitem WHERE orderItemId = '$orderItemId'"; 
    mysqli_query($dbcon, $sql);
}

if(isset($_SESSION['cartproducts'])){
    $i = 0;
    $cartItem = 0;

    while($cartItem != $orderItemId){
        $cart = $_SESSION['cartproducts'][$i];
        $cartItem = $cart['itemId'];
        $i++;
    }
    $index = $i -1;
    
    unset($_SESSION['cartproducts'][$index]);
}

header('Location: cart.php');
