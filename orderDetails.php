<?php
include '_dbconnect.php';
session_start();
error_reporting(E_ALL ^ E_WARNING); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" , initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="css/myOrders.css">
    <!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <div class="blur-cont" id="blur">
        <div class="banner">
            <div class="wrapper">
                <ul class="navbar-ele">
                    <li><a href="homepage.php"><img src="res/cross.svg" class="exit-btn"></a></li>
                    <li><p class="title">MyCanteen</p></li>
                    <li><img class="money-icon" src="res/money.svg"></li>
                    <li><p class="money" id="money">999</p></li>
                </ul>
            </div>
        </div>
        <div class="wrapper">
            <div class="sub-title">
                <p>Orders Details:</p>
            </div>
            <div class="item-container">
                <?php
                $email = $_SESSION['email'];
                $my_orders = mysqli_query($con,"SELECT * FROM `order_details` WHERE `email` = '$email'");
                if(!empty($my_orders)){
                    while($row1 = mysqli_fetch_array($my_orders)){
                        $order_id = $row1['order_id'];
                        $unser_arr = unserialize($row1['products']);
                        $total_amount = $row1['total'];
                        $o_date = $row1['date'];
                ?>
                <p>ID: <?php echo $order_id;?></p>
                <p></p>
                <div class="inner-container">
                    <div class="container" style="display: grid; grid-template-columns: 80% 20%;">
                        <p><strong>Items:</strong></p>
                        <p></p>
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
                        for($i = 0; $i < count($unser_arr['quantity']); $i++ ){
                            if($unser_arr['quantity'][$i] > 0){
                        ?>
                        <p><?php echo $p_names[$i];echo"   ( "; echo $unser_arr['quantity'][$i]; echo " )";?></p>
                        
                        <p>Rs. <?php echo $p_prices[$i];?></p>
                        <?php  
                                    }//if condtion ends here
                                }//for loop for each item in an order
                        ?>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p>Total:</p>
                        <strong>Rs. <?php echo $total_amount;?></strong>
                        <p>Ordered on: <?php echo $o_date;?></p>
                    </div>
                    
                </div>
                <br>
                <p></p>
                <p></p>
                <?php
                    }//while loop for all orders
                    }
                    else{
                    echo "No records!";
                    }//first if condition
                ?>
            </div>
            
        </div>
</body>
</html>