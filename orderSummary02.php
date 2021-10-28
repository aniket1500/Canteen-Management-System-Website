<?php
include "_dbconnect.php";

session_start();
$serialized_arr = serialize($_SESSION['order']);
$email = $_SESSION['email'];
$total = $_SESSION['total_amount'];
$sql = "INSERT INTO `order_details`(`email`, `products`, `total`, `status`) VALUES ('$email','$serialized_arr','$total', '0')";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" , initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="css/orderSummary01.css">
</head>
<body>
    <div class="banner">
        <div class="wrapper">
            <ul class="navbar-ele">
                <li><a href="homepage.php"><img class="exit-btn" src="res/cross.svg"></a></li>
                <li><p class="title">MY CANTEEN</p></li>
                <li><img class="money-icon" src="res/money.svg"></li>
                <li><p class="money"></p></li>
            </ul>
        </div>   
    </div>
    <div class="wrapper">
        <div class="successful">
            <p>Order Placed Successfully!</p>
            <p></p>
            <img class="check-logo" src="res/checkmark.svg">
        </div>
        <div class="pay-btn">
            <a href="orderDetails.php" class="myButton">View details</a>
        </div>
    </div>
</body>
</html>