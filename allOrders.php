<?php
include '_dbconnect.php';
session_start();

$count = 0;
global $count;
error_reporting(E_ALL ^ E_WARNING); 

if(!empty($_GET["action"])) {
    $o_id = $_GET['oid'];
    $update = "UPDATE `order_details` SET `status`= 1 WHERE `order_id` = $o_id";
    $run_q = mysqli_query($con,$update);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" , initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="css/myOrders.css">
    <link rel="stylesheet" href="css/adminPanel.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="blur-cont" id="blur">
        <div class="banner">
            <div class="wrapper">
                <ul class="navbar-ele">
                    <li><a href="adminPanel.php"><img src="res/cross.svg" class="exit-btn"></a></li>
                    <li><p class="title">MyCanteen</p></li>
                    <li><img class="money-icon" src="res/money.svg"></li>
                    <li><p class="money" id="money"></p></li>
                </ul>
            </div>
        </div>
        <div class="wrapper">
            <div class="sub-title">
                <p>Orders Details:</p>
            </div>
            <div class="item-container">
                <?php
                //$email = $_SESSION['email'];
                $my_orders = mysqli_query($con,"SELECT * FROM `order_details`");
                if(!empty($my_orders)){
                    while($row1 = mysqli_fetch_array($my_orders)){
                        $order_id = $row1['order_id'];
                        $unser_arr = unserialize($row1['products']);
                        $total_amount = $row1['total'];
                        $user_email = $row1['email'];
                        $status = $row1['status'];
                        $o_date = $row1['date'];
                        
                ?>
                <p>ID: <?php echo $order_id;?></p>
                <div style = "display: grid; grid-template-columns: 2fr 1fr ;">
                    <div class="grid3"> <p><strong>Ordered by:</strong> <?php echo $user_email;?></p></div>
                    <div class="grid4"><p><strong>Status:</strong> <?php if($status==0){
                    echo "Not delivered";} else{echo "Delivered";}?></p></div>
                </div>

                <p></p>
                <div class="inner-container">
                    <div class="container" style="display: grid; grid-template-columns: 70% 30%;">
                        <p><strong>Items:</strong></p>
                        <p></p>
                        <?php
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
                        <p><strong>Total:</strong></p>
                        <strong style="padding-left:30px;">Rs. <?php echo $total_amount;?></strong>
                        <p><strong> Ordered on:</strong> <?php echo $o_date;?></p>
                        <form action="#" method="get">
                            <a class="my-btn" style="padding-left:20px; color:white;" href="allOrders.php?action=done&oid=<?php echo $order_id;?>">  ✔ Delivered</a>
                        </form>
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

