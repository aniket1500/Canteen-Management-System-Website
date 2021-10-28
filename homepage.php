<?php
session_start();
$_SESSION['count'] = 0;
$_SESSION['first']  = 0;
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    
    header("location: loginForm.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/homepage.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <title>MyCanteen</title>
</head>
<body>
    <nav class="navbar">
        <ul class="nav-list">
            <div class="title"><a href="homepage.php"><b>MyCanteen</b></a></div>
            <li><a href = 'logOut.php' ><b>Log Out</b></a></li>
            <!-- <li><a href = 'aboutUs.html'><b>About Us</b></a></li> -->
        </ul>
    </nav>
    <section class="background firstSection">
        <div class="box-main">
            <div class="quote">
                <p class="para"><b>"A place where good ideas<br/> and bad decisions are born."</b></p>
            </div>
        </div>
        <button class="btn2" type="button"><a href="orderingMenu.php">Order Now</a></button>
        <br>
        <br>
        <button class="btn2" type="button"><a href="orderDetails.php">My Orders</a></button>
    
    </section>
</body>
</html>