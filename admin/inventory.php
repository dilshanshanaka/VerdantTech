<?php include 'includes/admin-header.php'; ?>

<!-- Nav bar starts -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="../images/logo.png" height="30" class="d-inline-block align-top" alt="">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Dashboard</a>
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
        <a class="nav-link active" href="inventory.php">Inventory</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="addproduct.php">Add New product</a>
    </li>
</ul>
<!-- Navigation ends -->

<div class="container mb-4">
    <!-- Table starts -->
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Category</th>
                    <th scope="col">Sub Category</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Price (Rs.)</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM product AS p
                INNER JOIN productimage AS i ON p.productId=i.productId
                INNER JOIN subcategory AS sc ON p.subCatId=sc.subCatId
                INNER JOIN maincategory AS mc ON sc.mainCatId=mc.mainCatId
                ORDER BY p.productId DESC";
                $result = mysqli_query($dbcon, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $pid = $row['productId'];
                ?>
                        <tr>
                            <th><img src="../<?php echo $row['image']; ?>" height="50" alt="<?php echo $row['productName']; ?>"></th>
                            <td><?php echo $row['productName']; ?></td>
                            <td><?php echo $row['brandName']; ?></td>
                            <td><?php echo $row['mainCatName']; ?></td>
                            <td><?php echo $row['subCatName']; ?></td>
                            <td>12</td>
                            <td>In Stock</td>
                            <td class="text-right"><?php echo number_format($row['price'], 2); ?></td>
                            <td>
                                <a class="fa fa-pencil-square-o text-warning btn btn-sm" href="editproduct.php?productId=<?php echo $pid ?>" aria-hidden="true"></a>
                                <a class="fa fa-trash text-danger btn btn-sm" href="deleteproduct.php?productId=<?php echo $pid ?>" aria-hidden="true"></a>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <!-- Table ends -->
</div>

<?php include 'includes/admin-footer.php'; ?>