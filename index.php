<?php include "includes/header.php" ?>

<!-- Carousel start -->
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/b1.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Panasonic Headphone</h5>
                <p>High Quilty Sounds</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="images/b2.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>PC Gaming Setup</h5>
                <p>Shop us for exclusive Gaming Setups</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="images/b3.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Playstation Accessories</h5>
                <p>Pre-Order PS5 games & Accessories</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          </div>
      </div>
  </div>
<!-- Carousel ends start -->
  <div class="container">
  <div class="row m-1">
    <div class="col-3 shadow-sm zoom">
      <a href="shop.php?catId=1">
        <img src="images/cat-lap.jpg" class="w-100 zoom" alt="...">
        <div class="centered text-danger"><h6>Laptops</h6></div>
      </a>
    </div>
    <div class="col-3 shadow-sm zoom">
      <a href="shop.php?catId=2">
        <img src="images/cat-pc.jpg" class="w-100 zoom" alt="...">
        <div class="centered text-danger"><h6>Computers</h6></div>
      </a>
    </div>
    <div class="col-3 shadow-sm zoom">
      <a href="shop.php?catId=3">
        <img src="images/cat-led.jpg" class="w-100" alt="...">
        <div class="centered text-danger"><h6>TV & Audio</h6></div>
      </a>
    </div>
    <div class="col-3 shadow-sm zoom">
      <a href="shop.php?catId=4">  
        <img src="images/cat-wtsm.jpg" class="w-100" alt="...">
        <div class="centered text-danger"><h6>Wearable Tech</h6></div>
      </a>
    </div>
  </div>
  <div class="row mt-3 mb-2">
    <h4>Featured Products</h4>
  </div>
  <div class="row m-2">
    <?php
        $sql = "SELECT * FROM product INNER JOIN productimage ON product.productId=productimage.productId LIMIT 12";
        $result = mysqli_query($dbcon, $sql);
        if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){ ?> 
    <!-- single product start -->
    <div class="col-3 mb-3">
      <div class="card rounded" style="width: 13rem;">
        <div class="card-image">
        <a class="text-dark"href="product?pid=<?php echo $row['productId']; ?>">
          <img class="img-fluid zoom" src="<?php echo $row['image']; ?>" alt="Alternate Text" />
        </a>
        </div>
        <div class="card-body text-center">
          <h6 class="text-warning"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><h6>
          <h5><a class="text-dark"href="product?pid=<?php echo $row['productId']; ?>"><?php echo $row['productName']; ?></a></h5>
          <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['brandName']; ?></h6>
          <p><span class="text-danger">Rs. <?php echo number_format($row['price'],2); ?></span></p>
          <button type="button" class="btn btn-danger btn-sm btn-block">Add to Cart</button>
        </div>
      </div>
    </div>
    <!-- single product ends -->
    <?php } } ?>    
  </div> 
</div>



<?php include "includes/footer.php" ?>   