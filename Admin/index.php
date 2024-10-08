<?php
session_start();
include_once __DIR__. '../controller/adminloginController.php';
$admin_controller = new adminloginController();

// Initialize variables
$emailErr = $passwordErr = "";
$email = $password =$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    if (empty($_POST["email"])) {
        $emailErr = "Email Address is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }
    $admins = $admin_controller->getAdmin();
    foreach($admins as $admin){
    if(($email==$admin['email'])&&($password==$admin['password'])){
        $_SESSION['username']=$admin['username'];
        header('Location:dashboard.php');
    }else{
        $login_error="Invalid Login!";
    }
    }
 }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Trendy Fashion For You</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->

	<link rel="apple-touch-icon" sizes="180x180" href="icons/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="icons/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icons/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="icons/site.webmanifest">

    <link href="css/style.css" rel="stylesheet">


</head>
<style>
.error {color: #FF0000;}
</style>
<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html"> <h4>Admin of Trendy Fashion</h4></a>

                                <form class="mt-5 mb-5 login-input" action='index.php' method='post'>
                                <center><label class="error"><?php echo  $login_error;?></label></center>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                                    </div>
                                    <button class="btn gradient-2 login-form__btn submit w-100" name="submit">Login</button>
                                </form>
                                <!-- <p class="mt-5 login-form__footer"><a href="forget_password.php" class="text-primary">Forget Password?</a></p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>
</html>





