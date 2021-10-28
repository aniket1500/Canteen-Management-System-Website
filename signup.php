<?php
$ErrMsg1 = "";
$ErrMsg2 = "";
$ErrMsg3 = "";
$ErrMsg4 = "";
$ErrMsg5 = "";
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "_dbconnect.php";
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $existSql = "SELECT * FROM `user_details` WHERE `email` = '$email'";
    $result = mysqli_query($con, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $ErrMsg2 = "Email Already Exists";
    }
    else{
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `user_details` (`name`, `email`, `phone`, `password`) VALUES ('$username', '$email', '$phone', '$hash')";
            $result = mysqli_query($con, $sql);
            if ($result){
                $showAlert = TRUE;
            }
        }
        else{
            $ErrMsg5 = "Passwords do not match";
        }
    }


    //validations
    if(!empty($_POST['username'])){
        if (!preg_match ("/^([a-z A-Z]{4,15})$/", $username) ){  
            $ErrMsg1 = "Should atleast contain 4 char and should not contain numeric chars <br>";  
        }
    }  
    if(!empty($_POST['email'])){
        if (!preg_match ("/^([a-z 0-9\.-]+)@([a-z0-9]+).([a-z]{2,8})(.[a-z]{2,8})?$/", $email) ){  
            $ErrMsg2 = "Invalid Email <br>";  
        }
    }  
    if(!empty($_POST['phone'])){
        if (!preg_match ("/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/", $phone) ){  
            $ErrMsg3 = "Invalid Phone Number <br>";  
        }
    }
    if(!empty($_POST['password'])){
        if (!preg_match ("/^([a-z A-Z 0-9]{4,14})$/", $password) ){  
            $ErrMsg4 = "Min 4 and max 14 characters <br>";  
        }
    }
}

?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>MyCanteen SignUp</title>
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/signup.css">
    <link href="css/signup.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="container">
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
?>
        <form class="form" id="createAccount" action="/Mycanteen/signup.php"  method="post">
            <h1 class="form__title">Create Account</h1>
            <div class="form__input-group">
                <input type="text" id="signupUsername" class="form__input" id= "username" name="username" minlength="4" autofocus placeholder="Username">
                <div class="form__input-error-message"></div>
            </div>
            <p style="color: red; font-size: 15px; margin: 0px;"><?php
                echo $ErrMsg1;
            ?></p>
            <label id="inval" style="color: red; visibility: hidden; padding-left: 3.2%;">Invalid</label><br>
            <div class="form__input-group">
                <input type="email" class="form__input" id="email" name="email" placeholder="Email Address">
                <div class="form__input-error-message"></div>
            </div>
            <p style="color: red; font-size: 15px; margin: 0px;"><?php
                echo $ErrMsg2;
            ?></p>
            <label id="inval1" style="color: red; visibility: hidden; padding-left: 3.2%;">Invalid</label><br>
            <div class="form__input-group">
                <input type="text" class="form__input" id="phone" name="phone" minlength="10" maxlength="10" placeholder="Phone Number">
                <div class="form__input-error-message"></div>
            </div>
            <p style="color: red; font-size: 15px; margin: 0px;"><?php
                echo $ErrMsg3;
            ?></p>
            <label id="inval2" style="color: red; visibility: hidden; padding-left: 3.2%;">Invalid</label><br>
            <div class="form__input-group">
                <input type="password" class="form__input" id="password" name="password" minlength="4" maxlength="14" placeholder="Password">
                <div class="form__input-error-message"></div>
            </div>
            <p style="color: red; font-size: 15px; margin: 0px;"><?php
                echo $ErrMsg4;
            ?></p>
            <label id="inval3" style="color: red; visibility: hidden; padding-left: 3.2%;">Invalid</label><br>
            <div class="form__input-group">
                <input type="password" class="form__input" id="cpassword" name="cpassword"minlength="4" maxlength="14" placeholder="Confirm password">
                <div class="form__input-error-message"></div>
            </div>
            <p style="color: red; font-size: 15px; "><?php
                echo $ErrMsg5;
            ?></p>
            <button class="form__button" >Continue</button>
            <p class="form__text">
                <a class="form__link" href="loginForm.php" id="">Already have an account? Sign in</a>
            </p>
        </form>
    </div>
</body>
