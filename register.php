<?php
include "includes/header.php";
include "includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and assign POST method form data 
    $email = validation($_POST['email']);
    $firstName = validation($_POST['fname']);
    $lastName = validation($_POST['lname']);
    $mobile = validation($_POST['mobile']);
    $address1 = validation($_POST['add1']);
    $address2 = validation($_POST['add2']);
    $city = validation($_POST['city']);
    $postal = validation($_POST['postalcode']);
    $password = validation($_POST['password']);
    $cpassword = validation($_POST['cpassword']);

    if ($password == $cpassword) {
        // password hashing
        $hashpass = md5($password);

        $sql = "INSERT INTO user (email, password) VALUES('$email', '$hashpass')";
        mysqli_query($dbcon, $sql);
        $userId = mysqli_insert_id($dbcon);

        $sql2 = "INSERT INTO address (addressLine1, addressLine2, city, postalCode)
        VALUES('$address1', '$address2', '$city', '$postal')";
        mysqli_query($dbcon, $sql2);
        $addressId = mysqli_insert_id($dbcon);

        $sql3 = "INSERT INTO customer (userId, firstName, lastName, addressId, mobile, statusId )
        VALUES('$userId', '$firstName', '$lastName', '$addressId', '$mobile', 1)";

        if (mysqli_query($dbcon, $sql3)) {
            $_SESSION['userid'] = $userId;
            $_SESSION['role'] = $row['roleId'];
            header("Location:index.php");
        } else {
            $error = "Registration Error";
        }
    } else {
        $error = "Password confirmation doesn't match";
    }
}

?>


<div class="p-4" id="bglog" style="background-image: url('images/bg.jpg');">
    <div class="container">
        <div class="row justify-content-center m-4 shadow">
            <div class="col-6 bg-white">
                <div class="content m-4">
                    <h2 class="font-weight-light mt-2 mb-3">Sign Up</h2>

                    <!-- Register form starts -->
                    <form method="POST" class="m-3">
                        <div class="form-group">
                            <input type="email" class="form-control form-control-sm" name="email" placeholder="Email address" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control form-control-sm" name="fname" placeholder="First Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control form-control-sm" name="lname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" name="mobile" placeholder="Mobile" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" name="add1" placeholder="Address Line 1" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" name="add2" placeholder="Address Line 2" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <input type="city" class="form-control form-control-sm" placeholder="City" name="city" required>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control form-control-sm" name="postalcode" placeholder="Postal Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm" name="cpassword" placeholder="Confirm Password" required>
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm btn-block mb-3 mt-4">Submit</button>
                    </form>
                    <!-- Register form ends -->

                    <h6 class="text-center">Already have an account <span><a href="login.php">Login</a></span></h6>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "includes/footer.php"; ?>