<?php include 'includes/admin-header.php'; ?>

<!-- Nav bar starts -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="../images/logo.png" height="30" class="d-inline-block align-top" alt="">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Dashboard<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="inventory.php">Inventory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">Users</a>
            </li>
        </ul>
    </div>
</nav>
<!-- Nav bar ends -->

<div class="container-fluid">

    <div class="row text-white text-center justify-content-center">
        <div class="col-2 m-3 p-4 bg-danger shadow">
            <h4>New Orders</h4>
            <h5 class="font-weight-light">1</h5>
        </div>
        <div class="col-2 m-3 p-3 bg-danger shadow">
            <h4>Completed Orders</h4>
            <h5 class="font-weight-light">0</h5>
        </div>
        <div class="col-2 m-3 p-3 bg-danger shadow">
            <?php
            $sql = "SELECT COUNT(userId) AS uCount FROM user";
            $result = mysqli_query($dbcon, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <h4>Registered Users</h4>
            <h4 class="font-weight-light"><?php echo $row['uCount']; ?></h4>
        </div>
        <div class="col-2 m-3 p-4 bg-danger shadow">
            <?php
            $sql = "SELECT COUNT(productId) AS pCount FROM product";
            $result = mysqli_query($dbcon, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <h4>Inventory</h4>
            <h4 class="font-weight-light"><?php echo $row['pCount']; ?></h4>
        </div>
        <div class="col-2 m-3 p-4 bg-danger shadow">
            <h4>Total Sales</h4>
            <h5 class="font-weight-light">100</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <div class="col shadow bg-white m-2 p-3">
                <h5 class="mb-3">Latest Orders</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#Order No</th>
                            <th scope="col">Items</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>HP Laptop 15.6</td>
                            <td>Rs. 126,000.00</td>
                            <td>Pending</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4">
            <div class="col shadow bg-white m-2 p-3">
                <h5>Latest Products</h5>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">Product</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Sony Playstation 4</td>
                            <td>Rs. 75,000.00</td>
                            <td>Pending</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col shadow bg-white mt-3 m-2 p-3">
                <h5>Quick Links</h5>
                <div>
                    <a href="addproduct.php">Add New Product</a>
                </div>
                <div>
                    <a href="addemployee.php">Add New Employee</a>
                </div>
                <div>
                    <a href="addproduct.php">Visit Website</a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'includes/admin-footer.php'; ?>