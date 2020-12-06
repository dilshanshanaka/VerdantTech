<?php 
    include "includes/header.php";
    $pid = $_GET['pid'];
?>


<div class="container">
<?php
    $query = "SELECT * FROM product INNER JOIN productimage ON product.productId=productimage.productId WHERE product.productId='".$pid."'";
    $result = mysqli_query($dbcon, $query);
    $row = mysqli_fetch_assoc($result);
?> 
        
    <div class="row">
        <div class="col-4">
            <img class="img-fluid" src="<?php echo $row['image']; ?>" alt="">
        </div>
        <div class="col-6 mt-4 pt-5">
            <h3 class="text-uppercase font-weight-bold"><?php echo $row['brandName']; ?> <?php echo $row['productName']; ?></h3>
            <h6 class="text-warning"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><h6>
            <h6>Brand: <?php echo $row['brandName']; ?></h6>
            <h5 class="font-weight-light"><?php echo $row['productDesc']; ?></h5>
            <h5>Rs. <?php echo number_format($row['price'],2); ?></h5>
          <button type="button" class="btn btn-danger btn-sm">Add to Cart</button>

        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <h5>User Reviews</h5>
        </div>
        <div class="col-6">
            <h6>User Name 
            <span><small class="text-right">2020-12-05 10.00 PM </small></span>
            <h6 class="text-warning"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><h6>
            </h6>
            <p>Comments goes here......
            </p>
            
        </div>
    </div>
</div>


<?php include "includes/footer.php" ?>