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
            <li class="nav-item active">
                <a class="nav-link" href="orders.php">Orders<span class="sr-only">(current)</span></a>
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
    <div class="row mt-2 ml-2">
        <h5>
            <?php  
            $sql = "SELECT count(referenceId) AS c FROM checkout";
            $result = mysqli_query($dbcon, $sql);
            $row = mysqli_fetch_assoc($result);
            echo $row['c']; ?> orders found</h5>
    </div>
    <div class="row">
        <div class="col mt-2">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Ref No.</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Items</th>
                        <th scope="col">Address</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Checkout</th>
                        <th scope="col">Delivery</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM checkout ct
                        INNER JOIN orders o ON o.orderId = ct.orderId
                        INNER JOIN customer c ON c.customerId = o.customerId
                        INNER JOIN address a ON a.addressId=ct.addressId
                        INNER JOIN status s ON s.statusId=ct.statusId
                        ";
                    $result = mysqli_query($dbcon, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $order = $row['orderId'];
                    ?>
                        <tr>
                            <th><?php echo $row['referenceId']; ?></th>
                            <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                            <td>
                                <?php
                                $sql2 = "SELECT * FROM product p
                                    INNER JOIN inventory i ON i.productId=p.productId
                                    INNER JOIN orderitem oi ON oi.stockId = i.stockId 
                                    WHERE oi.orderId='$order'";
                                $result2 = mysqli_query($dbcon, $sql2);
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                echo $row2['brandName']." ".$row2['productName']."<br>";
                                } ?>
                            </td>
                            <td><?php echo $row['addressLine1']; ?> <br> <?php echo $row['addressLine2']; ?> <br><?php echo $row['city']; ?> <span><?php echo $row['postalCode']; ?></span></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['checkoutDate']; ?></td>
                            <td><?php if (isset($row['deliveryDate'])) {
                                    echo $row['deliveryDate'];
                                } else {
                                    echo "Pending";
                                } ?></td>
                            <td>Rs. <?php echo number_format($row['amount'], 2); ?></td>
                            <td><?php echo $row['paymentMethod']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <a class="fa fa-pencil-square-o text-warning btn btn-sm" href="editproduct.php?productId=" aria-hidden="true"></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include 'includes/admin-footer.php'; ?>