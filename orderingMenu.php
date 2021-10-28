<?php
require_once ('_dbconnect.php');
session_start();

$count = 0;
global $count;
error_reporting(E_ALL ^ E_WARNING); 

if ($_SESSION['first']  == 0){
    $_SESSION['order'] = [
        'product' => [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25],
        'quantity' => [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
    ];
    $_SESSION['first']  += 1;
}

//code for add, remove
if(!empty($_GET["action"])) {
$pid=$_GET["pid"];
switch($_GET['action']){
    case "add":
        $_SESSION['order']['quantity'][$pid] += 1;
    break;
    case "remove":
        if($_SESSION['order']['quantity'][$pid] > 0){
            $_SESSION['order']['quantity'][$pid] -= 1;
        }
    break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/orderingMenu.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="js/menu.js"></script>
</head>
<body>
    <div class="banner">
        <div class="wrapper">
            <ul class="navbar-ele" style="margin=0em 2em;">
                <li><a href="homepage.php"><img src="res/cross.svg" class="exit-btn"></a></li>
                <li><p class="title">MY CANTEEN</p></li>
                <div class="inner-money-div">
                    <li><img class="money-icon" src="res/money.svg"></li>
                    <li></li>
                </div>
            </ul>
        </div>
    </div>
    <div class="wrapper">
    <?php
    //code to display all menu items and its prices
    $product= mysqli_query($con,"SELECT * FROM `product_details` ORDER BY `p_id` ASC");
    if(!empty($product)){
        while ($row=mysqli_fetch_array($product)){?>
            <div id="menu-div"> 
                <ul class="menu-item" id="item-list-id"> 
                    <li class="item-name"><?php echo $row["p_name"]?></li>
                    <li class="item-name">Rs.  <?php echo $row["p_price"]?></li>
                    <form action="#" method="get">
                    <div class="quantity">
                        <a href="orderingMenu.php?action=add&pid=<?php echo $count?>"class='add-btn'><img src="res/add-button.svg"></a>
                        <?php echo $_SESSION['order']['quantity'][$count];?>
                        <a href="orderingMenu.php?action=remove&pid=<?php echo $count?>"class='add-btn'><img style='width:24px;' src="res/minus-button.svg"></a>      
                    </div>
                    </form>
                </ul>
            </div>
    <?php
            $count+=1;    
        }
    }
    else{
        echo "No-Records"; 
    }?>
    </div> <!-- wrapper div ends-->
    <form action="orderSummary01.php" method="POST" class="order-form">
        <div style="display: flex; justify-content: center; background-color: #b01919">
            <button type="submit" style="background-color: #b01919; color:#ffffff;"><p id="checkout-id">Checkout</p></button>
        </div>
    </form>
</body>
</html>