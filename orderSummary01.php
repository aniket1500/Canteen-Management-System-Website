<?php
include '_dbconnect.php';
session_start();
$total_amount = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" , initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="css/orderSummary01.css">
    <!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
    <div class="blur-cont" id="blur">
        <div class="banner">
            <div class="wrapper">
                <ul class="navbar-ele">
                    <li><a href="homepage.php"><img src="res/cross.svg" class="exit-btn"></a></li>
                    <li><p class="title">MY CANTEEN</p></li>
                    <div class="inner-money-div">
                        <li><img class="money-icon" src="res/money.svg"></li>
                        <li><p class="money">
                            <!-- currency here -->
                        </p></li>
                    </div>
                </ul>
            </div>
            
        </div>
        <div class="wrapper">
            <p>Order Summary:</p>
            <div class="container">
                <?php

                //to find array whic contains all pids of each element
                $product= mysqli_query($con,"SELECT * FROM `product_details` ORDER BY `p_id` ASC");
                if(!empty($product)){
                    while ($row=mysqli_fetch_array($product)) {
                        $p_names[] = $row['p_name'];
                        $p_prices[] = $row['p_price'];
                    }
                }
                else{
                    echo "No records!";
                }
                for($i = 0; $i <= sizeof($p_prices); $i++ ){
                    if($_SESSION['order']['quantity'][$i] > 0){
                        $temp = $p_prices[$i] * $_SESSION['order']['quantity'][$i];
                        $total_amount = $total_amount + $temp;
                ?>
                <p><?php echo $p_names[$i];echo"   ( "; echo $_SESSION['order']['quantity'][$i]; echo " )";?></p>
                
                <p>Rs. <?php echo $p_prices[$i];?></p>
                <?php  
                    }
                }
                ?>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p>Total:</p>
                <p>Rs. <?php echo $total_amount;?><?php ?></p>
                <?php $_SESSION['total_amount'] = $total_amount;?>
            </div>
            <form action="#" method="post">
                <a href="#" onclick="toggleBlur()" class="myButton">Proceed</a>
            </form>
            
            
        </div>
        
        
    </div>
    <div id="popup">
        <p>Confirm your order?</p>
        <div class="popup-text-1">
            <!-- <a onclick="toggleBlur()" href="orderSummary02.html">Confirm</a> -->
            <a href="orderSummary02.php" onclick="toggleBlur()" class="myButton">Confirm</a>
        </div>
        <div >
            <!-- <a onclick="toggleBlur()" href="#">Cancel</a> -->
            <!-- <button type="button" class="btn btn-info " class="popup-text-2"onclick="toggleBlur()">Cancel</button> -->
            <a href="#" onclick="toggleBlur()" class="myButton2">Cancel</a>
        </div>
    </div>
    <script type="text/javascript">
        function toggleBlur(){
            var blur= document.getElementById('blur')
            blur.classList.toggle('active')
            var popup= document.getElementById('popup')
            popup.classList.toggle('active')
        }
    </script>
</body>
</html>