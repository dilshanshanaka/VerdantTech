<?php
include "includes/header.php";
include "includes/functions.php";

$pid = $_GET['pid'];
if (isset($_SESSION['userid'])) {
    $user = $_SESSION['userid'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and assign POST method form data 
    $review = validation($_POST['pReview']);
    $star = validation($_POST['star']);

    $sql = "SELECT customerId FROM customer WHERE userId='$user'";
    $result = mysqli_query($dbcon, $sql);
    $row = mysqli_fetch_assoc($result);
    $customerId = $row['customerId'];

    $sql2 = "INSERT INTO productreview (productId, customerId, reviewMessage, starRating) 
    VALUES ('$pid', '$customerId', '$review', '$star')";

    mysqli_query($dbcon, $sql2);
}
?>


<div class="container">
    <?php
    $query = "SELECT * FROM product AS p 
    INNER JOIN productimage AS img ON img.productId=p.productId 
    WHERE p.productId='$pid'";
    $result = mysqli_query($dbcon, $query);
    $row = mysqli_fetch_assoc($result);
    $subcatId = $row['subCatId'];
    ?>

    <div class="row">
        <div class="col-4">
            <img class="img-fluid" src="<?php echo $row['image']; ?>" alt="">
        </div>
        <div class="col-6 mt-4 pt-5">
            <h3 class="text-uppercase font-weight-bold"><?php echo $row['brandName']; ?> <?php echo $row['productName']; ?></h3>
            <h6 class="text-warning">
                <?php
                $query2 = "SELECT AVG(starRating) AS rate FROM productreview WHERE productId='$pid'";
                $result2 = mysqli_query($dbcon, $query2);
                $row2 = mysqli_fetch_assoc($result2);
                $starRate = round($row2['rate']);

                for ($i = 0; $i < 5; $i++) {
                    if ($starRate != 0) {
                        echo '<i class="fa fa-star"></i>';
                        $starRate--;
                    } else {
                        echo '<i class="fa fa-star-o"></i>';
                    }
                }
                ?>
            </h6>
            <h6>Brand: <?php echo $row['brandName']; ?></h6>
            <h5 class="font-weight-light"><?php echo $row['productDesc']; ?></h5>
            <h5>Rs. <?php echo number_format($row['price'], 2); ?></h5>
            <form action="addtocart.php" method="POST">
                <input type="hidden" name="productId" value="<?php echo $row['productId']; ?>">
                <input type="hidden" name="qty" value="1">
                <button type="submit" class="btn btn-danger btn-sm">Add to Cart</button>
            </form>
        </div>

    </div>
    <div class="row">

        <!-- User Review Section Start -->
        <div class="col-6">
            <h5>User Reviews</h5>
            <div class="row">
                <div class="col">
                    <?php
                    $sql = "SELECT * FROM productreview pr
                    INNER JOIN customer c ON c.customerId=pr.customerId WHERE productId = '$pid' LIMIT 3";
                    $result = mysqli_query($dbcon, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <h6><?php echo $row['firstName'] . " " . $row['lastName']; ?>
                                <span><small class="text-right"><?php echo $row['submitDate'] ?></small></span>
                                <h6 class="text-warning">
                                    <?php
                                    $starRate = $row['starRating'];

                                    for ($i = 0; $i < 5; $i++) {
                                        if ($starRate != 0) {
                                            echo '<i class="fa fa-star"></i>';
                                            $starRate--;
                                        } else {
                                            echo '<i class="fa fa-star-o"></i>';
                                        }
                                    }
                                    ?>
                                    <h6>
                                    </h6>
                                    <p> <?php echo $row['reviewMessage'] ?>
                                    </p>
                            <?php }
                    } ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php
                    if (isset($_SESSION['userid'])) {
                    ?>
                        <form action="" method="POST">
                            <div class="form-row">
                                <div class="col-md-12 mb-2">
                                    <label for="pDesc" class="font-weight-bold">Add a Review</label>
                                    <textarea class="form-control" name="pReview" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-10 mb-3">
                                    Star Ratings
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="star" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="star" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="star" id="inlineRadio1" value="3">
                                        <label class="form-check-label" for="inlineRadio1">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="star" id="inlineRadio2" value="4">
                                        <label class="form-check-label" for="inlineRadio2">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="star" id="inlineRadio2" value="5">
                                        <label class="form-check-label" for="inlineRadio2">5</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- User Review Section ends -->

        <!-- Recent Products starts -->
        <div class="col-6">
            <div class="row">
                <?php
                $sql = "SELECT * FROM product INNER JOIN productimage ON product.productId=productimage.productId 
        WHERE subCatId = " . $subcatId . " LIMIT 6";
                $result = mysqli_query($dbcon, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <!-- single related product start -->
                        <div class="col-4 text-center">
                            <a href="product?pid=<?php echo $row['productId']; ?>">
                                <img class="img-fluid" src="<?php echo $row['image']; ?>" alt="">
                                <h6 class="text-danger"><?php echo $row['brandName']; ?> <?php echo $row['productName']; ?></h6>
                            </a>
                            <p>Rs. <?php echo number_format($row['price'], 2); ?></p>
                        </div>
                        <!-- single related product start -->
                <?php }
                } ?>
            </div>
        </div>
        <!-- Recent Products ends -->

    </div>

</div>


<?php include "includes/footer.php" ?>