<?php include "includes/header.php";

if (isset($_GET['subId'])) {
    $catId = $_GET['catId'];
    $subId = $_GET['subId'];
    $wsql = "WHERE subCatId =$subId";
} elseif (isset($_GET['brand'])) {
    $brand = $_GET['brand'];
    $catId = 0;
    $wsql = "WHERE brandName = '$brand'";
} else {
    $catId = $_GET['catId'];
    $wsql = "INNER JOIN subcategory ON product.subCatId=subcategory.subCatId WHERE mainCatId =$catId";
}
?>


<div class="container">
    <!-- Category header -->
    <div class="row mt-4 mb-2">
        <div class="col-6">
            <h5><a href="index.php"><i class="fa fa-home text-danger"></i></a> > Shop </h5>
        </div>
        <div class="col-6 text-right">
            <?php
            $sql = "SELECT * FROM maincategory WHERE mainCatId ='" . $catId . "'";
            $result = mysqli_query($dbcon, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <h4 class="text-danger">
                        <?php
                        echo $row['mainCatName'];
                        ?>
                    </h4>
            <?php }
            } ?>
        </div>
    </div>
    <!-- Category Header ends -->

    <!-- filter -->
    <h6>Filter By</h6>
    <div class="row">

        <!-- Filter by Main Category -->
        <div class="col-3 mt-2">
            <div class="dropdown">
                <button class="btn btn-light btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Category
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                    $sql = "SELECT * FROM maincategory";
                    $result = mysqli_query($dbcon, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <a class="dropdown-item" href="shop.php?catId=<?php echo $row['mainCatId']; ?>"><?php echo $row['mainCatName']; ?></a>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
        <!-- Filter by Main Category -->

        <!-- Filter by Sub Category -->
        <div class="col-3 mt-2">
            <div class="dropdown">
                <button class="btn btn-light btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sub-Category
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                    $sql = "SELECT * FROM subcategory WHERE mainCatId ='" . $catId . "'";
                    $result = mysqli_query($dbcon, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <a class="dropdown-item" href="shop.php?catId=<?php echo $row['mainCatId'] . '&subId=' . $row['subCatId']; ?>"><?php echo $row['subCatName']; ?></a>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
        <!-- Filter by sub Category ends-->

        <!-- Filter by Brand -->
        <div class="col-3 mt-2">
            <div class="dropdown">
                <button class="btn btn-light btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Brand
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php $sql = "SELECT brandName FROM product GROUP BY brandName";
                    $result = mysqli_query($dbcon, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <a class="dropdown-item" href="shop?brand=<?php echo $row['brandName']; ?>"><?php echo $row['brandName']; ?></a>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
        <!-- Filter by Brand ends-->

    </div>
    <!-- filter ends -->

    <div class="row">
        <!-- Products -->
        <div class="col-12  mb-4 mt-2">
            <div class="row">
                <?php
                $sql = "SELECT * FROM product INNER JOIN productimage ON product.productId=productimage.productId " . $wsql . "";
                $result = mysqli_query($dbcon, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                        <!-- single product start -->
                        <div class="col-3 mt-1 mb-2 text-center">
                            <a class="text-dark" href="product?pid=<?php echo $row['productId']; ?>">
                                <img class="img-fluid zoom" src="<?php echo $row['image']; ?>" alt="Alternate Text" />
                            </a>
                            <a class="text-dark" href="product?pid=<?php echo $row['productId']; ?>">
                                <h5 class="text-decoration-none"><?php echo $row['productName']; ?></h5>
                            </a>
                            <h6 class="text-warning">
                                <?php
                                $pid = $row['productId'];

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
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['brandName']; ?></h6>
                            <p><span class="text-danger">Rs. <?php echo number_format($row['price'], 2); ?></span></p>
                            <form action="addtocart.php" method="POST">
                                <input type="hidden" name="productId" value="<?php echo $row['productId']; ?>">
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" class="btn btn-danger btn-sm btn-block">Add to Cart</button>
                            </form>
                        </div>
                        <!-- single product ends -->

                <?php }
                } ?>
            </div>
        </div>
        <!-- Products ends -->
    </div>

</div>

<?php include "includes/footer.php" ?>