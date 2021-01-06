<?php include 'includes/admin-header.php';
include "../includes/functions.php";

$proId = $_GET['productId'];
$user = $_SESSION['userid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and assign POST method form data 
    $pName = validation($_POST['pName']);
    $brand = validation($_POST['brand']);
    $pDesc = validation($_POST['pDesc']);
    $subCat = $_POST['subCat'];
    $status = $_POST['status'];
    $quantity = validation($_POST['quantity']);
    $price = validation($_POST['price']);

    // Image 
    // $target_dir = "../images/products/";
    // $target_file = $target_dir . basename($_FILES["image"]["name"]);
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // $imagePath =  "images/products/" . basename($_FILES["image"]["name"]);

    
    $sql = "UPDATE product SET subCatId='$subCat', brandName ='$brand', 
    productName='$pName', productDesc='$pDesc', price='$price' WHERE productId='$proId'";
    mysqli_query($dbcon, $sql);


    // $sql2 = "UPDATE productimage SET image='$imagePath' WHERE productId='$proId'";
    // mysqli_query($dbcon, $sql2);

    // Getting Current Time
    $dateTime = date("Y-m-d h:i:s");

    $sql3 = "UPDATE inventory SET qty='$quantity', statusId ='$status', 
    modifiedUser='$user', modifiedDate='$dateTime' WHERE productId='$proId'"; 

    if (mysqli_query($dbcon, $sql3)) {
        header("Location:inventory.php");
    } else {
        $error = "Registration Error";
    }
} else {
    $error = "Password confirmation doesn't match";
}



?>


<!-- Nav bar starts -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="../images/logo.png" height="30" class="d-inline-block align-top" alt="">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="admin-index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders.php">Orders</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="inventory.php">Inventory<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">Users</a>
            </li>
        </ul>
    </div>
</nav>
<!-- Nav bar ends -->

<!-- Navigation starts -->
<ul class="nav mt-2 mb-3">
    <li class="nav-item">
        <a class="nav-link" href="inventory.php">Inventory</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="addproduct.php">Add New product</a>
    </li>
</ul>
<!-- Navigation ends -->

<div class="container">
    <div class="row m-4 justify-content-center">

        <!-- Add product start -->
        <div class="col-8 mb-3">
            <h4>Edit product</h4>

            <?php
                $sqlproduct = "SELECT * FROM product AS p
                INNER JOIN inventory AS i ON p.productId=i.productId
                INNER JOIN subcategory AS sc ON p.subCatId=sc.subCatId
                INNER JOIN status AS s ON i.statusId=s.statusId
                WHERE p.productId='$proId'";
                $result2 = mysqli_query($dbcon, $sqlproduct);
                $row2 = mysqli_fetch_assoc($result2);
            ?>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-row mt-3">
                    <div class="col-md-5 mb-3">
                        <label for="pName">Product</label>
                        <input type="text" class="form-control" name="pName" value="<?php echo $row2['productName'] ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="brand">Brand name</label>
                        <input type="text" class="form-control" name="brand" value="<?php echo $row2['brandName'] ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="image">Upload Image</label>
                        <input type="file" class="form-control-file" name="image">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="pDesc">Product Description</label>
                        <textarea class="form-control" name="pDesc" rows="3"><?php echo $row2['productDesc'] ?></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="subCat">Sub Category</label>
                        <select class="custom-select" name="subCat">
                            <?php $subCat = $row2['subCatId']; ?>
                            <option value="<?php echo $subCat ?>" selected><?php echo $row2['subCatName']; ?></option>
                           
                           <?php
                            $sql = "SELECT * FROM subcategory WHERE subCatId <> '$subCat'";
                            $result = mysqli_query($dbcon, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <option value="<?php echo $row['subCatId']; ?>"><?php echo $row['subCatName']; ?></option>
                            <?php }
                            } ?>

                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="status">Status</label>
                        <select class="custom-select" name="status">
                            <?php $status = $row2['statusId']; ?>
                            <option value="<?php echo $status ?>" selected><?php echo $row2['status']; ?></option>

                            <?php
                            $sql = "SELECT * FROM status WHERE statusId>=3 AND statusId<=5 AND statusId<>'$status'";
                            $result = mysqli_query($dbcon, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <option value="<?php echo $row['statusId']; ?>"><?php echo $row['status']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="quantity ">Quantity</label>
                        <input type="text" class="form-control" name="quantity" value="12">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="price">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="price-rs">Rs.</span>
                            </div>
                            <input type="text" class="form-control" name="price" aria-describedby="price" value="<?php echo $row2['price'] ?>" required>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
        <!-- Add product ends -->

    </div>
</div>


<?php include 'includes/admin-footer.php'; ?>