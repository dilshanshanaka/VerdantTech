<?php include "includes/database.php" ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Verdant Tech | Home </title>
    <link rel="icon" href="images/logo.png">

    <link rel="stylesheet" href="dist/css/main.css"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="container-fluid bg-light">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.php"><img src="images/logo.png" width="auto" height="50" alt="" loading="lazy"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Store
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                          $sql = "SELECT * FROM maincategory";
                          $result = mysqli_query($dbcon, $sql);
                          if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)){ ?>

                          <a class="dropdown-item" href="shop?catId=<?php echo $row['mainCatId']; ?>"><?php echo $row['mainCatName']; ?></a>
                          
                          <?php } } ?>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    </ul>
                    
                    <form class="form-inline my-2 my-lg-0">
                        <div class="input-group">
                          <input class="form-control mr-sm-2" type="search" class="form-control" placeholder="Search">
                          <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i></i>
                            </button>
                          </div>
                        </div>
                      </form>

                    <div>
                        <button class="btn text-danger"><i class="fa fa-shopping-cart"></i></button>
                        <button class="btn"><i class="fa fa-user"></i></button>
                    </div>
                </div>
            </nav>          
        </div>  
    </div>