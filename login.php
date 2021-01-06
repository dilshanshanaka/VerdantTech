<?php
include "includes/header.php";
include "includes/functions.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and assign POST method form data 
    $email = validation($_POST['email']);
    $password = validation($_POST['password']);

    // password hashing
    $hashpass = md5($password);

    $sql = "SELECT userId, roleId FROM user WHERE email = '$email' and password = '$hashpass'";
    $result = mysqli_query($dbcon, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['userid'] = $row['userId'];
        $_SESSION['role'] = $row['roleId'];

        if($_SESSION['role'] == 1 OR $_SESSION['role'] == 2 ){
            header('Location: admin/index.php');
        }else{
            header("Location:index.php");
        }
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>

<div class="p-4" id="bglog" style="background-image: url('images/bg.jpg');">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-8">
                <div class="row">
                    <div class="col-6 shadow">
                        <img class="img-fluid w-100" src="images/login.jpg" alt="">
                    </div>
                    <div class="col-6 shadow bg-white">
                        <h2 class="font-weight-light text-center mt-4 mb-2">Hey, Welcome back!</h2>
                        <h4 class="font-weight-lighter text-center mb-4">Login to continue</h4>
                        <!-- Login form starts -->
                        <form method="POST" class="m-4">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-sm" name="email" aria-describedby="emailHelp" placeholder="Email Address" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="forsm-group">
                                <input type="password" class="form-control form-control-sm" name="password" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-danger btn-sm btn-block mb-3 mt-4">Submit</button>
                        </form>
                        <!-- Login form ends -->
                        <h6 class="text-center">New to Verdant Tech! <span><a href="register.php">Create an Account</a></span></h6>
                        <img src="images/logo.png" class="center mt-2" alt="logo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "includes/footer.php"; ?>