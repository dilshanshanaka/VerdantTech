<?php include "includes/header.php";
$subtotal = 0;

if (isset($_SESSION['cartproducts']) or isset($_SESSION['userid'])) {
    $delivery = 1000;
} else {
    $delivery = 0;
}

if (isset($_SESSION['userid']) && isset($_SESSION['cartproducts'])) {
    $userId = $_SESSION['userid'];

    $q = "SELECT customerId FROM customer WHERE userId='$userId'";
    $result = mysqli_query($dbcon, $q);
    $row = mysqli_fetch_assoc($result);
    $customerId = $row['customerId'];

    // Check for open order 
    $sql = "SELECT * FROM orders WHERE customerId='$customerId' AND statusId=6";
    $result = mysqli_query($dbcon, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 0) {
        // Current Date
        $date = date("Y-m-d");
        $query1 = "INSERT INTO orders(customerId, orderDate, statusId) VALUES('$customerId', '$date', 6)";
        mysqli_query($dbcon, $query1);
        $orderId = mysqli_insert_id($dbcon);
    } else {
        $orderId = $row['orderId'];
    }

    foreach ($_SESSION['cartproducts'] as $usercart) {
        $itemId = $usercart['itemId'];
        $qty = $usercart['qty'];

        $query2 = "SELECT * FROM product AS p INNER JOIN  inventory AS i ON i.productId=p.productId WHERE p.productId='$itemId'";
        $result2 = mysqli_query($dbcon, $query2);
        $row2 = mysqli_fetch_assoc($result2);

        $stock = $row2['stockId'];
        $amount = $qty * $row2['price'];
        $warrenty = 1;

        $query3 = "SELECT * FROM orders AS o INNER JOIN orderitem AS ot ON ot.orderId=o.orderId 
        WHERE o.customerId='$customerId' AND ot.stockId='$stock' AND ot.statusId=6";
        $result3 = mysqli_query($dbcon, $query3);
        $count2 = mysqli_num_rows($result3);


        if ($count2 == 0) {
            $query4 = "INSERT INTO orderitem(orderId, stockId, qty, amount, warrentyPeriod, statusId) 
            VALUES('$orderId', '$stock', '$qty', '$amount', '$warrenty', 6)";
            mysqli_query($dbcon, $query4);
        }
    }
}

?>

<div class="container">
    <div class="row mt-3 mb-4">
        <div class="col-8">
            <h4>YOUR CART</h4>
            <hr>
            <p><?php if (isset($_SESSION['cartproducts']) && !isset($_SESSION['userid'])) {
                    echo "You have " . count($_SESSION['cartproducts']) . " items in your cart.";
                } elseif (isset($_SESSION['userid'])) {
                    $user = $_SESSION['userid'];
                    $q = "SELECT count(orderItemId) oCount FROM orderitem oi INNER JOIN orders o ON o.orderId=oi.orderId 
                    INNER JOIN customer c ON c.customerId=o.customerId WHERE c.userId='$user' AND o.statusId=6";
                    $result = mysqli_query($dbcon, $q);
                    $row = mysqli_fetch_assoc($result);
                    if (mysqli_num_rows($result) > 0) {
                        $itemCount = $row['oCount'];
                        echo "You have " . $itemCount . " items in your cart.";
                        if ($itemCount == 0) {
                            $delivery = 0;
                        }
                    }
                } else {
                    echo 'No items';
                } ?></p>
            <table class="table mr-4">
                <thead">
                    <tr class="font-weight-light">
                        <th scope="col"></th>
                        <th scope="col">Product</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Amount <small>(Rs.)</small></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_SESSION['cartproducts']) && !isset($_SESSION['userid'])) {
                            foreach ($_SESSION['cartproducts'] as $usercart) {
                                $pid = $usercart['itemId'];
                                $pqty = $usercart['qty'];

                                $sql = "SELECT * FROM product AS p INNER JOIN productimage AS img ON img.productId = p.productId
                                WHERE p.productId = '$pid'";
                                $result = mysqli_query($dbcon, $sql);
                                $row = mysqli_fetch_assoc($result);
                        ?>
                                <tr>
                                    <td><img height="100px" src="<?php echo $row['image']; ?>" alt=""></td>
                                    <td class="w-100">
                                        <div>
                                            <h6><strong>Product </strong><?php echo $row['productName']; ?></h6>
                                            <h6><strong>Brand </strong><?php echo $row['brandName']; ?></h6>
                                            <h6><strong>Unit Price </strong><?php echo number_format($row['price'], 2); ?></h6>
                                            <h6><strong>Warranty </strong>1 Year</h6>

                                        </div>
                                    </td>
                                    <form action="updatecart.php" method="POST">
                                        <td><input class="form-control form-control-sm" name="qty" type="text" value="<?php echo $pqty; ?>"></span></td>
                                        <input type="hidden" name="cartItemId" value="<?php echo $row['productId']; ?>">
                                        <td><?php echo number_format($row['price'] * $pqty, 2); ?></td>
                                        <td>
                                            <button type="submit" class="btn text-warning fa fa-pencil-square-o" href="updatecart.php"></button>
                                        </form>
                                            <span><a class="fa fa-trash text-danger btn" href="deletecartitem.php?orderItemId=<?php echo $row['productId']; ?>"></a></span>
                                        </td>

                                    <?php
                                    $subtotal = $subtotal + $row['price'] * $pqty;
                                    ?>

                                </tr>
                        <?php }
                        } ?>


                        <?php if (isset($_SESSION['userid'])) {
                            $user = $_SESSION['userid'];
                            $query = "SELECT * FROM orderitem AS oi INNER JOIN orders AS o ON o.orderId=oi.orderId
                                    INNER JOIN customer AS c ON c.customerId=o.customerId 
                                    INNER JOIN inventory AS i ON i.stockId=oi.stockId 
                                    INNER JOIN product AS p ON p.productId =i.productId 
                                    INNER JOIN productimage AS img ON img.productId=p.productId
                                    INNER JOIN address AS a ON a.addressId = c.addressId
                                    WHERE c.userId='$user' AND o.statusId=6";
                            $result = mysqli_query($dbcon, $query);
                            $cp = mysqli_num_rows($result);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $orderId = $row['orderId'];
                                    $addressId = $row['addressId'];
                                    $userName = $row['firstName'] . ' ' . $row['lastName'];
                                    $mobile = $row['mobile'];
                                    $addressL1 = $row['addressLine1'];
                                    $addressL2 = $row['addressLine2'];
                                    $city = $row['city'];
                                    $postalCode = $row['postalCode'];

                        ?>
                                    <tr>
                                        <td><img height="100px" src="<?php echo $row['image']; ?>" alt=""></td>
                                        <td class="w-100">
                                            <div>
                                                <h6><strong>Product </strong><?php echo $row['productName']; ?></h6>
                                                <h6><strong>Brand </strong><?php echo $row['brandName']; ?></h6>
                                                <h6><strong>Unit Price </strong><?php echo number_format($row['price'], 2); ?></h6>
                                                <h6><strong>Warranty </strong>1 Year</h6>

                                            </div>
                                        </td>
                                        <form action="updatecart.php" method="POST">
                                        <td><input class="form-control form-control-sm" name="qty" type="text" value="<?php echo $row['qty']; ?>"></span></td>
                                        <input type="hidden" name="cartItemId" value="<?php echo $row['orderItemId']; ?>">
                                        <td><?php echo number_format($row['price'] * $row['qty'], 2); ?></td>
                                        <td>
                                            <button type="submit" class="btn text-warning fa fa-pencil-square-o" href="updatecart.php"></button>
                                        </form>
                                            <span><a class="fa fa-trash text-danger btn" href="deletecartitem.php?orderItemId=<?php echo $row['orderItemId']; ?>"></a></span>
                                        </td>

                                        <?php
                                        $subtotal = $subtotal + $row['price'] * $row['qty'];
                                        ?>

                                    </tr>
                        <?php }
                            }
                        } ?>
                    </tbody>

            </table>
            <hr>

        </div>
        <div class="col-4">
            <div class="order-summary bg-light text-dark shadow p-3 m-1">
                <h5 class="mt-3">ORDER SUMMARY</h5>
                <hr>
                <table class="table table-borderless text-dark ">
                    <tbody>
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-right font-weight-light">Rs.<?php echo number_format($subtotal, 2); ?></td>
                        </tr>
                        <tr>

                            <td>Shipping Fee</td>
                            <td class="text-right font-weight-light">Rs.<?php echo number_format($delivery, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Total</td>
                            <td class="text-right font-weight-bold">Rs. <?php echo number_format(($subtotal + $delivery), 2); ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php
                if (isset($_SESSION['userid']) and $itemCount > 0) {
                    echo '<form onsubmit="openModal()" id="myForm">';
                    echo '<button type="submit" class="btn btn-secondary btn-block mb-4">Checkout</button>';
                    echo '</form>';
                } else {
                    echo '<button type="button" class="btn btn-secondary btn-block mb-4">Checkout</button>';
                }
                ?>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="checkoutModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Thank you for your order!</h4>
                <?php
                if ($check == 1) {
                    $amount = $subtotal + $delivery;

                    $sql2 = "INSERT INTO checkout( orderId, amount, addressId, checkoutDate, statusId) 
                VALUES ('$orderId', '$amount', '$addressId', current_timestamp(), 9)";

                    if (mysqli_query($dbcon, $sql2)) {
                        $refId = mysqli_insert_id($dbcon);

                        $sql3 = "UPDATE orders SET statusId=9 WHERE orderId='$orderId'";
                        mysqli_query($dbcon, $sql3);
                        $check = 0;
                    }
                }

                ?>
            </div>
            <div class="modal-body">
                <h5><u>Order Summery</u></h5>
                <div class="row">
                    <div class="col-4">
                        <h6>Reference No:</h6>
                    </div>
                    <div class="col-8">
                        <h6><?php echo $refId; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h6>Amount</h6>
                    </div>
                    <div class="col-8">
                        <h6>Rs. <?php echo number_format(($amount), 2); ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h6>Customer</h6>
                    </div>
                    <div class="col-8">
                        <h6><?php echo $userName; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h6>Date</h6>
                    </div>
                    <div class="col-8">
                        <h6><?php echo date("Y-m-d"); ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h6>Address</h6>
                    </div>
                    <div class="col-8">
                        <h6><?php echo $addressL1 . "<br>" . $addressL2 . "<br>" . $city . " <span>" . $postalCode . "</span>"; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h6>Mobile</h6>
                    </div>
                    <div class="col-8">
                        <h6><?php echo $mobile; ?></h6>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>