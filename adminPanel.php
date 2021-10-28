<?php
include "_dbconnect.php";
session_start();
$count = 0;

$_SESSION['p_list'] = [];
$_SESSION['p_price'] = [];
//to get list of items in array
$product= mysqli_query($con,"SELECT * FROM `product_details` ORDER BY `p_id` ASC");
if(!empty($product)){
    while ($row=mysqli_fetch_array($product)){
        array_push($_SESSION['p_list'],$row['p_name']);
        array_push($_SESSION['p_price'],$row['p_price']);
    }
}
//code to remove item
if(!empty($_GET["rid"])) {
    $rid=$_GET["rid"];
    $toDelete = $_SESSION['p_list'][$rid];
    unset($_SESSION['p_list'][$rid]);
    $remove = "DELETE FROM `product_details` WHERE `p_name` = '$toDelete'";
    $query = mysqli_query($con, $remove);
    if(!empty($query)){
        header('Location:adminPanel.php');
    }
}
//code to add item
if(!empty($_POST['name-input'])){
    $a_name = $_POST['name-input'];
    $a_price = $_POST['price-input'];
    $i_query = "INSERT INTO `product_details` (`p_name`, `p_price`) VALUES ('$a_name','$a_price')";
    if(mysqli_query($con, $i_query)){
        ?>
        <script>alert(' Item Added Successfully!');</script>
        <?php
    }
    else{
        ?>
        <script>alert(' Item NOT Added !');</script>
        <?php
    }
    header('Location:adminPanel.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" , initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/adminPanel.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="banner">
        <div class="wrapper">
            <ul class="navbar-ele" style="display: grid; grid-template-columns: 25% auto;">
                <li style="margin: 20px;"><a href="logOut.php" class="title" style="font-size:20px;">LogOut</a></li>
                <li><p class="title">My Canteen Admin</p></li>
            </ul>
        </div>
    </div>
    <div class="wrapper">
        <p>Hello Admin!</p>
        <br>
        <a class="my-btn" href="allOrders.php">View Orders</a>
        <!-- <a class="my-btn" href="#">Add money</a> -->
        <br>
        <br>
        <p>Edit your menu here:</p>
        <div class="container">
            <div class="category1" id="category-1">
                <form action="adminPanel.php" class="grid1" method="POST">
                    <p class="title-text">Add new Item here ➜</p>
                    <input type="text" class="text-input" name = "name-input" required placeholder="Enter new item">
                    <input type="number" class="text-input" name = "price-input" required placeholder="Enter price">
                    <button type="submit" class="my-btn">Add this item</button>
                </form>
                <?php
                for ($i=0;$i<sizeof($_SESSION['p_list']);$i++){
                ?>
                <div class="grid2">
                    <p class="text-small"><?php echo $_SESSION['p_list'][$i]?></p>
                    <p class="text-small">Rs. <?php echo $_SESSION["p_price"][$i]?></p>
                    <form action="#" method="get">
                        <a class="my-btn-small" href="adminPanel.php?rid=<?php echo $i?>">Remove</a>
                    </form>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>



