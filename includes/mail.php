<?php
  if(isset($_POST['email']) && $_POST['email'] != ''){
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

      $name = $_POST['name'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];
      $message = $_POST['message'];
      $subject = "Inquiry";

      $to = "info@verdanttech.com";
      $body = "";

      $body .= "From: ".$name."\r\n";
      $body .= "Email: ".$email."\r\n";
      $body .= "Message: ".$message.'<br>'.'Mobile No:'.$mobile."\r\n";

      mail($to, $subject, $body);

    }
  }
?>