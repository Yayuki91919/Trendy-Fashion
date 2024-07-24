<?php
session_start();
include_once __DIR__ . '/Admin/controller/userController.php';
$userController = new UsersController;


$name = $status = $email = $phone = $password = $c_password = "";
$password_Err = "";

if (isset($_POST["signin"])) {
  $name = $_POST['username'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $c_password = $_POST['c_password'];

  if ($password != $c_password) {
    $password_Err = "Password and Confirm password not match!";
  } else {
    $check = $userController->check_user($email);

    if (count($check) > 0) {
      $_SESSION['error'] = "The selected email already exists.";
      header("Location: register.php");
      exit();
    } else {
      $register = $userController->createUser($name, $email, $password, $phone);

      if ($register) {
        $_SESSION['info'] = "The user account has been created. Login Now!";
        header("Location: login.php");
        exit();
      } else {
        $_SESSION['error'] = "The user account creation failed.";
        header("Location: register.php");
        exit();
      }
    }
    
  }
}
?>
<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">

<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Trendy Fashion</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Constra HTML Template v1.0">

  <!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="Admin/icons/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Admin/icons/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Admin/icons/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="Admin/icons/site.webmanifest">

  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">

  <!-- Animate css -->
  <link rel="stylesheet" href="plugins/animate/animate.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <link rel="stylesheet" href="plugins/slick/slick-theme.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body id="body">

  <section class="signin-page account">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="block text-center">
            <?php include "noti.php"; ?>

            <h2 class="text-center">Create Your Account</h2>
            <?php 
            //if(isset($check))
            //echo count($check)?>
            <form class="text-left clearfix" action="<?php $_PHP_SELF ?>" method="POST">
              <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="User Name" value="<?php echo $name; ?>">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>">
              </div>
              <div class="form-group">
                <input type="number" class="form-control" name="phone" placeholder="Phone" value="<?php echo $phone; ?>">
              </div>
              <div class="form-group">
                <label class="text-danger"><?php echo $password_Err ?></label>
                <input type="password" class="form-control" name="password" placeholder="Password" minlength="6">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="c_password" placeholder="Confirm Password">
              </div>
              <div class="text-center">
                <button type="submit" name="signin" class="btn btn-main text-center">Sign In</button>
              </div>
            </form>
            <p class="mt-20">Already hava an account ?<a href="login.php"> Login</a></p>
            <p><a href="forget-password.php"> Forgot your password?</a></p>
            <a href="shop-sidebar.php" class="btn btn-main btn-solid-border">&larr;Back</a>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 
    Essential Scripts
    =====================================-->

  <!-- Main jQuery -->
  <script src="plugins/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.1 -->
  <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
  <!-- Bootstrap Touchpin -->
  <script src="plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
  <!-- Instagram Feed Js -->
  <script src="plugins/instafeed/instafeed.min.js"></script>
  <!-- Video Lightbox Plugin -->
  <script src="plugins/ekko-lightbox/dist/ekko-lightbox.min.js"></script>
  <!-- Count Down Js -->
  <script src="plugins/syo-timer/build/jquery.syotimer.min.js"></script>

  <!-- slick Carousel -->
  <script src="plugins/slick/slick.min.js"></script>
  <script src="plugins/slick/slick-animation.min.js"></script>

  <!-- Google Mapl -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
  <script type="text/javascript" src="plugins/google-map/gmap.js"></script>

  <!-- Main Js File -->
  <script src="js/script.js"></script>



</body>

</html>