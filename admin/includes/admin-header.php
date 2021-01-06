<?php include 
"../includes/database.php";
session_start();

if(!isset($_SESSION['userid']) OR $_SESSION['role']<>1 AND $_SESSION['role']<>2){
    header('Location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Verdant Tech</title>
    <link rel="icon" href="../images/logo.png">

    <link rel="stylesheet" href="../dist/css/main.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../dist/css/bootstrap-4.5.3-dist/css/bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../dist/css/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
