<?php
if (!isset($_SESSION)) {
	session_start();
}
include_once __DIR__ . '/../Admin/controller/socialController.php'; 
include_once __DIR__ . '/../Admin/controller/categoryController.php'; 
$social_controller = new SocialController();
$fb = $tiktok = $insta = "";
$social = $social_controller->getSocial();
if (!empty($social)) {
    foreach ($social as $so) {
        $fb = $so['fb'];
        $tiktok = $so['tiktok'];
        $insta = $so['insta'];
        $phone=$so['phone'];
    }
}
// include_once __DIR__ . '/Admin/controller/cartController.php';
//echo "Current directory: " . __DIR__ . "<br>";

// Construct the absolute path to cartController.php
$cartControllerPath = realpath(__DIR__ . '/../Admin/controller/cartController.php');

// Print resolved path for debugging
//echo "Resolved path: " . $cartControllerPath . "<br>";

// Check if the file exists and include it
if (file_exists($cartControllerPath)) {
	include_once $cartControllerPath;
} else {
	echo "Error: cartController.php not found.<br>";
}

$cartController = new cartController;


if (isset($_GET['removeCartId'])) {
	$cart_id = $_GET['removeCartId'];
	$name = $_GET['name'];
	$status = $cartController->removeCart($cart_id);

	if ($status) {
		// echo '<script> location.href="sub_category.php?status='.$status.'"</script>';
		$_SESSION['info'] = $name . " is Removed! ";
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

	<!-- theme meta -->
	<meta name="theme-name" content="Trendy Fashion" />

	<!-- Favicon -->
	<!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" /> -->
	<!-- <link rel="icon" href="images/favicon.ico"> -->
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
</head>

<body id="body">

	<!-- Start Top Header Bar -->
	<section class="top-header">
		<div class="container">

			<div class="row">
				<div class="col-md-4 col-xs-12 col-sm-4">
					<div class="contact-number">
						<i class="tf-ion-ios-telephone"></i>
						<?php if(!empty($phone)){ ?>
						<span><?php echo $phone ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-4 col-xs-12 col-sm-4">
					<!-- Site Logo -->
					<div class="logo text-center">
						<a href="index.php">
							<img class="m-0 p-0" width='150' height='100' src="./Admin/icons/trendy-icon/android-chrome-512x512.png" alt="">
						</a>
					</div>
				</div>
				<div class="col-md-4 col-xs-12 col-sm-4">
					

					<?php if (isset($_SESSION['user_login'])) { ?>
						<ul class="top-menu text-right list-inline">
							<?php
							$cid = $_SESSION['user_login']['customer_id'];
							$cart = $cartController->getUserCart($cid);
							//  var_dump($cart);
							$subtotal = $total = 0;
							$count = 0;
							foreach ($cart as $c) {
								$count++;
							} ?>
							<li class="dropdown cart-nav dropdown-slide">
								<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-android-cart"></i>Cart</a>
								<?php
								// if there is no cart don't show
								if ($count > 0) { ?>
									<div class="dropdown-menu cart-dropdown">
										<!-- Cart Item -->
										<?php
										foreach ($cart as $c) {
											$subtotal = $c["quantity"] * $c["price"];
											$total += $subtotal;
										?>
											<div class="media">
												<a class="pull-left" href="#!">
													<img class="media-object" src="./Admin/images/product/<?php echo htmlspecialchars($c['random_image']); ?>" alt="image" />
												</a>
												<?php //echo $c['random_image']; 
												?>

												<div class="media-body">
													<h4 class="media-heading">
														<a href="product-single.php?pid=<?php echo $c['product_id']; ?>&edit_cart=<?php echo $c['cart_id']; ?>"><?php echo $c["product_name"]; ?></a>
													</h4>
													<span><?php echo "Size: " . $c["size"] . " & Color: " . $c["color"]; ?></span>
													<div class="cart-price">
														<span><?php echo $c["quantity"]; ?></span>
														<span>X</span>
														<span><?php echo $c["price"] . " Ks"; ?></span>
													</div>
													<h5><strong><?php echo $subtotal . " Ks"; ?></strong></h5>
												</div>
												<a href="shop-sidebar.php?removeCartId=<?php echo $c['cart_id'] ?>&name=<?php echo $c['product_name'] ?>" class="remove" onclick="return confirm('Are you sure to remove?');"><i class="tf-ion-close"></i></a>
											</div>

										<?php } ?>
										<div class="cart-summary">
											<span>Total</span>
											<span class="total-price"><?php echo $total . " Ks"; ?></span>
										</div>
										<ul class="text-center cart-buttons">
											<li><a href="cart.php" class="btn btn-small">View Cart</a></li>
											<li><a href="checkout.php" class="btn btn-small btn-solid-border">Checkout</a></li>
										</ul>
									</div>
								<?php  } else { ?>
									<div class="dropdown-menu cart-dropdown">
										<div class="cart-summary">
											<div class="block text-center">
												<p><i class="tf-ion-ios-cart-outline"></i>&nbsp;Your cart is currently empty.</p>
												<a href="shop-sidebar.php" class="btn btn-main mt-20">Return to shop</a>
											</div>
										</div>

									</div>
								<?php } ?>

							</li><!-- / Cart -->
							<li class="dropdown dropdown-slide">
								<a href="login.php" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><span class="ep--avatar"><?php echo $_SESSION['user_login']['username']; ?></span></a>
								<ul class="dropdown-menu">

									<li class="text-center"><a href="logout.php">Logout</a></li>
								</ul>
							</li>

						</ul>

					<?php } else { ?>
						<ul class="top-menu text-right list-inline">

							<li class="dropdown dropdown-slide">
								<a href="login.php" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><span class="ep--avatar"> Sign In</span></a>
								<ul class="dropdown-menu">
									<li class="text-center"><a href="register.php
						">Create Account</a></li>
									<li class="text-center"><a href="login.php">Login</a></li>
								</ul>
							</li>

						</ul><!-- / .nav .navbar-nav .navbar-right -->
					<?php } ?>
					<!-- Cart -->

				</div>
			</div>
		</div>
	</section><!-- End Top Header Bar -->


	<!-- Main Menu Section -->
	<section class="menu">
		<nav class="navbar navigation">
			<div class="container">
				<div class="navbar-header">
					<h2 class="menu-title">Main Menu</h2>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

				</div><!-- / .navbar-header -->

				<!-- Navbar Links -->
				<div id="navbar" class="navbar-collapse collapse text-center">
					<ul class="nav navbar-nav">

						<!-- Home -->
						<li class="dropdown ">
							<a href="index.php">Home</a>
						</li><!-- / Home -->


						<!-- Elements -->
						<li class="dropdown dropdown-slide">
							<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">product <span class="tf-ion-ios-arrow-down"></span></a>
							<div class="dropdown-menu">
								<div class="row">

									<!-- Basic -->
									<div class="col-lg-12 col-md-12 mb-sm-3">
										<ul>
											<li class="dropdown-header">Product</li>
											<li role="separator" class="divider"></li>
											<li><a href="shop-sidebar.php">All Product</a></li>
											<?php 
											    $cat_controller=new CategoryController();
												$categories=$cat_controller->getCategories();
											foreach($categories as $c)
											{ ?>
												<li><a href="product_category.php?cid=<?php echo $c['category_id'];?>"><?php echo $c['category_name']; ?></a></li>
											<?php
											}
											?>


										</ul>
									</div>


								</div><!-- / .row -->
							</div><!-- / .dropdown-menu -->
						</li><!-- / Elements -->

						<?php if (isset($_SESSION['user_login'])) { ?>
							<!-- Pages -->
							<li class="dropdown  dropdown-slide">
								<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="tf-ion-ios-arrow-down"></span></a>
								<div class="dropdown-menu">
									<div class="row">

										<!-- Contact -->
										<div class="col-lg-12 col-md-12 mb-sm-3">
											<ul>
												<li class="dropdown-header">Profile</li>
												<li role="separator" class="divider"></li>
												<li><a href="profile-details.php">User Interface</a></li>
											
											</ul>
										</div>



										<!-- Mega Menu -->
										
									</div><!-- / .row -->
								</div><!-- / .dropdown-menu -->
							</li><!-- / Pages -->

							<!-- Elements -->
							<li class="dropdown dropdown-slide">
								<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Order <span class="tf-ion-ios-arrow-down"></span></a>
								<div class="dropdown-menu">
									<div class="row">

										<!-- Basic -->
										<div class="col-sm-6 col-xs-12">

											<ul>
												<li class="dropdown-header">Order</li>
												<li role="separator" class="divider"></li>
												<li><a href="cart.php">Cart</a></li>
												<li><a href="checkout.php">Checkout</a></li>
												<li><a href="order.php">Order</a></li>

											</ul>
										</div>
										<div class="col-sm-6 col-xs-12">
											<a href="shop.html">
												<img class="img-responsive" src="images/shop/header-img.jpg" alt="menu image" />
											</a>
										</div>


									</div><!-- / .row -->
								</div><!-- / .dropdown-menu -->
							</li><!-- / Elements -->
						<?php
						}
						?>

						<li class="dropdown ">
							<a href="collaboration.php">Collaboration</a>
						</li>

						<!-- <li class="dropdown ">
							<a href="dashboard.php">Profile</a>
						</li> -->

						<!-- Blog -->
						<!-- <li class="dropdown dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Blog <span
								class="tf-ion-ios-arrow-down"></span></a>
						<ul class="dropdown-menu">
							<li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
							<li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
							<li><a href="blog-full-width.html">Blog Full Width</a></li>
							<li><a href="blog-grid.html">Blog 2 Columns</a></li>
							<li><a href="blog-single.html">Blog Single</a></li>
						</ul>
					</li> -->
						<!-- / Blog -->

						<!-- Shop -->
						<!-- <li class="dropdown dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Elements <span
								class="tf-ion-ios-arrow-down"></span></a>
						<ul class="dropdown-menu">
							<li><a href="typography.html">Typography</a></li>
							<li><a href="buttons.html">Buttons</a></li>
							<li><a href="alerts.html">Alerts</a></li>
						</ul>
					</li> -->
						<!-- / Blog -->
					</ul><!-- / .nav .navbar-nav -->

				</div>
				<!--/.navbar-collapse -->
			</div><!-- / .container -->
		</nav>
	</section>