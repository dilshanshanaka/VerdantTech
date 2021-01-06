<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><img src="images/logo.png" width="auto" height="50" alt="" loading="lazy"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Store
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    $sql = "SELECT * FROM maincategory";
                    $result = mysqli_query($dbcon, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>

                            <a class="dropdown-item" href="shop?catId=<?php echo $row['mainCatId']; ?>"><?php echo $row['mainCatName']; ?></a>

                    <?php }
                    } ?>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
        </ul>

        <div>
            <a class="btn text-dark" href="cart.php"><i class="fa fa-shopping-cart">
                    <span class="badge badge-danger">
                        <?php if (isset($_SESSION['cartproducts']) && !isset($_SESSION['userid'])) {
                            echo  count($_SESSION['cartproducts']);
                        } elseif (isset($_SESSION['userid'])) {
                            $user = $_SESSION['userid'];
                            $q = "SELECT count(orderItemId) oCount FROM orderitem oi INNER JOIN orders o ON o.orderId=oi.orderId 
                                                            INNER JOIN customer c ON c.customerId=o.customerId WHERE c.userId='$user' AND oi.statusId=6";
                            $result = mysqli_query($dbcon, $q);
                            $row = mysqli_fetch_assoc($result);
                            if (mysqli_num_rows($result) > 0) {
                                echo $row['oCount'];
                            }
                        } ?></span></i></a>
            <div class="btn-group">
                <a type="button" class="btn btn-light fa fa-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </a>
                <div class="dropdown-menu">
                    <?php if (isset($_SESSION['userid'])) {
                        echo '<a class="dropdown-item" href="profile.php">My Account</a>
                                  <a class="dropdown-item" href="logout.php">Logout</a>';
                    } else {
                        echo '<a class="dropdown-item" href="login.php">Login</a>
                                  <a class="dropdown-item" href="register.php">Register</a>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</nav>