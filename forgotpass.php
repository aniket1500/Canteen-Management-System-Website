<?php

if (isset($_POST['email'])) {
$newpass=$_POST['newpass'];
$email = $_POST['email'];

$pass=password_hash($newpass, PASSWORD_DEFAULT);
include "_dbconnect.php";

$query="UPDATE `user_details` SET `password`='$pass' WHERE `email` = '$email'";
if(mysqli_query($con,$query)){
    header("Location:loginForm.php");
}
else
    die();
}
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="css/loginForm.css">
</head>
<body>
    <div class="container">
        <form class="form" id="login" action="forgotpass.php" method="POST">
            <h1 class="form__title">Reset password</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
              <input type="email" name="email" class="form__input" autofocus placeholder="Email">
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name="newpass"placeholder="Enter new Password">
            </div>
            <button class="form__button" type="submit">Confirm new password</button>
        </form>
    </div>
</body>