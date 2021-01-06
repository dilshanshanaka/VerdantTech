<?php
include "includes/database.php";
include "includes/functions.php";

session_start();

$user = $_SESSION['userid'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = validation($_POST['fname']);
    $lastName = validation($_POST['lname']);
    $mobile = validation($_POST['mobile']);
    $address1 = validation($_POST['add1']);
    $address2 = validation($_POST['add2']);
    $city = validation($_POST['city']);
    $postal = validation($_POST['postalcode']);
    $addressId = $_POST['addressId'];

    $sql = "UPDATE customer SET firstName = '$firstName', lastName = '$lastName', mobile = '$mobile' WHERE userId = '$user'";

    if (mysqli_query($dbcon, $sql)) {
        $sql2 = "UPDATE address SET addressLine1 = '$address1', addressLine2 = '$address2', 
        city = '$city', postalCode = '$postal' WHERE addressId = '$addressId'";

        if (mysqli_query($dbcon, $sql2)) {
            echo '<script>location.replace("profile.php");</script>';
        }
    }
}

?>
