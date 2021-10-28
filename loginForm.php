<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"]; 
    
    $sql = "Select * from user_details where email='$email'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1){
        while($row = mysqli_fetch_assoc($result)){
            if($email == 'admin@admin.com' && password_verify($password, $row['password'])){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                header("location: adminPanel.php");
            }
            else{if(password_verify($password, $row['password'])){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                // $query = "SELECT `currency` FROM `user_details` WHERE `email` = $email";
                // $query = "SELECT `currency` FROM `user_details` WHERE `email` = $email";
                // $currency = mysqli_query($con, $query);
                //$_SESSION['currency'] = $currency;
                $_SESSION['first'] = 0;
                
                header("location: homepage.php");
            }
            else{
                $showError = "Invalid Credentials";
            }}
        }
    } 
    else{
        $showError = "Invalid Credentials";
    }
}
    
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>MyCanteen Login</title>
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link href="css/loginForm.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <form class="form" id="login" action="loginForm.php" method="POST">
            <?php
            if($login){
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You are logged in
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
            <h1 class="form__title">MyCanteen Login</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" class="form__input" name="email" autofocus placeholder="Email">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name="password" placeholder="Password">
                <div class="form__input-error-message"></div>
            </div>
            <button class="form__button" type="submit">Continue</button>
            <p class="form__text">
                <a class="form__link" href="signup.php">Don't have an account? Create account</a>
            </p>
            <p class="form__text">
                <a class="form__link" href="forgotpass.php">Forgot password?</a>
            </p>
        </form>
    </div>
    <script src="js/loginForm.js"></script>
</body>
