<?php include 'includes/admin-header.php';
include "../includes/functions.php";

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
    $target_dir = "../images/products/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $imagePath =  "images/products/" . basename($_FILES["image"]["name"]);

    // Insert Form data to Database
    $sql = "INSERT INTO product (subCatId, brandName, productName, productDesc, price) 
    VALUES('$subCat', '$brand', '$pName', '$pDesc', '$price')";
    mysqli_query($dbcon, $sql);
    $pId = mysqli_insert_id($dbcon);

    $sql2 = "INSERT INTO productimage (productId, image) VALUES('$pId', '$imagePath')";
    mysqli_query($dbcon, $sql2);

    // Getting Current Time
    $dateTime = date("Y-m-d h:i:s");

    $sql3 = "INSERT INTO inventory (productId, qty, statusId, createdUser, createdDate)
        VALUES('$pId', '$quantity', '$status', '$user', '$dateTime' )";

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
            <h4>Add new product</h4>

            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-row mt-3">
                    <div class="col-md-5 mb-3">
                        <label for="pName">Product</label>
                        <input type="text" class="form-control" name="pName" placeholder="Product Name" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="brand">Brand name</label>
                        <input type="text" class="form-control" name="brand" placeholder="Brand name" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="image">Upload Image</label>
                        <input type="file" class="form-control-file" name="image">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="pDesc">Product Description</label>
                        <textarea class="form-control" name="pDesc" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="subCat">Sub Category</label>
                        <select class="custom-select" name="subCat">
                            <?php
                            $sql = "SELECT * FROM subcategory";
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
                            <?php
                            $sql = "SELECT * FROM status WHERE statusId>=3 AND statusId<=5";
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
                        <input type="text" class="form-control" name="quantity" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="price">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="price-rs">Rs.</span>
                            </div>
                            <input type="text" class="form-control" name="price" aria-describedby="price" required>
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