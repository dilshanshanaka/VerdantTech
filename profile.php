<?php include "includes/header.php"; ?>


<div class="container mb-4">
    <div class="row mt-2">
        <h3>My Profile</h3>
    </div>
    <div class="row">
        <?php
        $user = $_SESSION['userid'];
        $sql = "SELECT * FROM customer AS c 
            INNER JOIN user AS u ON c.userId=u.userId 
            INNER JOIN address AS a ON c.addressId = a.addressId
            WHERE c.userId = '$user'";
        $result = mysqli_query($dbcon, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $customerId = $row['customerId']; // Customer Id for Order
        }
        ?>
        <div class="col-6 shadow m-2 p-4">
            <h5>Profile Information</h5>
            <hr>
            <!-- Profile Info starts -->
            <div class="profile-data">
                <div class="row">
                    <div class="col-3">
                        <h6>Email</h6>
                    </div>
                    <div class="col-9">
                        <h6 class="font-weight-light"><?php echo $row['email'] ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <h6>First Name</h6>
                    </div>
                    <div class="col-3">
                        <h6 class="font-weight-light"><?php echo $row['firstName'] ?></h6>
                    </div>
                    <div class="col-3">
                        <h6>Last Name</h6>
                    </div>
                    <div class="col-3">
                        <h6 class="font-weight-light"><?php echo $row['lastName'] ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <h6>Mobile</h6>
                    </div>
                    <div class="col-9">
                        <h6 class="font-weight-light"><?php echo $row['mobile'] ?></h6>
                    </div>
                </div>

                <h5 class="mt-3 mb-3">Address Information</h5>
                <div class="row">
                    <div class="col-3">
                        <h6>Address Line 1</h6>
                    </div>
                    <div class="col-8">
                        <h6 class="font-weight-light"><?php echo $row['addressLine1'] ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <h6>Address Line 2</h6>
                    </div>
                    <div class="col-8">
                        <h6 class="font-weight-light"><?php echo $row['addressLine2'] ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <h6>City</h6>
                    </div>
                    <div class="col-3">
                        <h6 class="font-weight-light"><?php echo $row['city'] ?></h6>
                    </div>
                    <div class="col-3">
                        <h6>Postal Code</h6>
                    </div>
                    <div class="col-3">
                        <h6 class="font-weight-light"><?php echo $row['postalCode'] ?></h6>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end mt-2">
                <div class="col-6 text-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#changepassword">Change Password</button>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editprofile">Edit Profile</button>

                </div>
            </div>

            <!-- Profile Info ends -->
        </div>

        <div class="col-5 shadow m-2 ml-4 p-4">
            <h5>Orders</h5>
            <div class="table-div mt-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Ref No.</th>
                            <th scope="col">Date</th>
                            <th scope="col">Amount (Rs.)</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql2 = "SELECT * FROM checkout AS c INNER JOIN orders AS o ON o.orderId=c.orderId
                            INNER JOIN status AS s ON s.statusId = c.statusId
                            WHERE o.customerId='$customerId' AND c.statusId=9 OR c.statusId=7";
                            $result2 = mysqli_query($dbcon, $sql2);
                            while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                        <tr>
                            <th scope="row"><?php echo $row2['referenceId']; ?></th>
                            <td><?php echo $row2['checkoutDate']; ?></td>
                            <td><?php echo number_format($row2['amount'], 2); ?></td>
                            <td class="text-primary"><?php echo $row2['status']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Change Password starts -->
    <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordTitle">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form method="POST" action="changepassword.php">
                        <div class="form-group">
                            <label for="ePassword">Current Password</label>
                            <input type="password" class="form-control form-control-sm" name="ePassword">
                        </div>
                        <div class="form-group">
                            <label for="nPassword">New Password</label>
                            <input type="password" class="form-control form-control-sm" name="nPassword">
                        </div>
                        <div class="form-group">
                            <label for="cPassword">Confirm New Password</label>
                            <input type="password" class="form-control form-control-sm" name="cPassword">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Change Password ends -->

    <!-- Edit profile info starts -->
    <div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="editprofiletitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editprofiletitle">Edit Profile Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="updateuser.php">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control form-control-sm" name="email" value="<?php echo $row['email'] ?>" disabled>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control form-control-sm" name="fname" value="<?php echo $row['firstName'] ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control form-control-sm" name="lname" value="<?php echo $row['lastName'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control form-control-sm" name="mobile" value="<?php echo $row['mobile'] ?>">
                        </div>
                        <label for="address">Address</label>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" name="add1" value="<?php echo $row['addressLine1'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" name="add2" value="<?php echo $row['addressLine2'] ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <input type="text" class="form-control form-control-sm" name="city" value="<?php echo $row['city'] ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control form-control-sm" name="postalcode" placeholder="Postal Code" value="<?php echo $row['postalCode'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="addressId" value="<?php echo $row['addressId'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit profile info ends -->
    </div>
</div>
<?php include "includes/footer.php" ?>