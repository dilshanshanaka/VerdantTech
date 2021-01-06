<?php 
include '../includes/database.php';

// Product Id from GET method
$pid = $_GET['productId'];

// Delete MySQL Query
$sql2 = "DELETE FROM product WHERE productId='$pid'"; 
mysqli_query($dbcon, $sql2);

// Redirect to inventory
header('Location: inventory.php');

?>