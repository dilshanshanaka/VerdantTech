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
            <li class="nav-item">
                <a class="nav-link" href="inventory.php">Inventory</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="users.php">Users<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
<!-- Nav bar ends -->

<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h4 class="mb-3">Employees</h4>
            <!-- Employee starts -->
            <div class="table-employee">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Position</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM employee AS e
                        INNER JOIN status AS s ON s.statusId=e.statusId
                        INNER JOIN user AS u ON u.userId=e.userId";
                        $result = mysqli_query($dbcon, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $row['employeeId']; ?></th>
                                    <td><?php echo $row['firstName']; ?></td>
                                    <td><?php echo $row['lastName']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['position']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
            <!-- Employee ends -->

        </div>
        <div class="col-12">
            <h4 class="mb-3 mt-2">Customers</h4>
            <!-- Customer starts -->
            <div class="table-employee">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM customer AS c
                        INNER JOIN status AS s ON s.statusId=c.statusId
                        INNER JOIN user AS u ON u.userId=c.userId";
                        $result2 = mysqli_query($dbcon, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $row2['customerId']; ?></th>
                                    <td><?php echo $row2['firstName']; ?></td>
                                    <td><?php echo $row2['lastName']; ?></td>
                                    <td><?php echo $row2['email']; ?></td>
                                    <td><?php echo $row2['status']; ?></td>
                                    <td>
                                        <a class="fa fa-ban text-danger btn btn-sm" href="deleteproduct.php?productId=" aria-hidden="true"></a>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
            <!-- Customer ends -->
        </div>
    </div>
</div>

<?php include 'includes/admin-footer.php'; ?>