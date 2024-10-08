<?php
session_start();
include_once __DIR__ . '/Admin/controller/userController.php';
$userController = new UsersController;

// Initialize variables
$emailErr = $passwordErr = "";
$email = $password = $login_error = "";

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
    $password = $_POST["password"];
    $password = test_input($_POST["password"]);
  }
  $user = $userController->userLogin($email,$password);
  if($user)
  {
    if (($email == $user['email']) && ($password == $user['password']))
    {
       // $_SESSION['username'] = $u['username'];
       $_SESSION['user_login']=$user;
       header('Location:index.php');
     }
  } else {
    $_SESSION['error'] = "Incorrect username or password!";
  }
    
  //  $_SESSION['user_login']=$user;
  //  echo $_SESSION['user_login']['username'];
  // echo $password,$email;

  // foreach($user as $u)
  // {
      // if (($email == $user['email']) && ($password == $user['password']))
      //  {
      //     // $_SESSION['username'] = $u['username'];
      //     $_SESSION['user_login']=$user;
      //     header('Location:index.php');
      //   } else {
      //     $_SESSION['error'] = "Login failed.";
      //   }
  // }


}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
  <!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    -->

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
            <h3>Trendy Fashion</h3>
            <?php include "noti.php";?>
            <form class="text-left clearfix" action="login.php" method="post">
              <center><label class="error"><?php echo  $login_error; ?></label></center>

              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-main text-center">Login</button>

              </div>
            </form>
            <p class="mt-20">New in this site ?<a href="register.php"> Create New Account</a></p>
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