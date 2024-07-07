<?php
include_once 'layouts/header.php';
include_once __DIR__ . '/Admin/controller/bannerController.php';
include_once __DIR__ . '/Admin/controller/subController.php';
include_once __DIR__ . '/Admin/controller/productController.php';

$sub_controller = new SubCategoryController();
$banner_controller = new BannerController();
$product_controller= new productController();
$banners = $banner_controller->getbanners();

?>
<style>
	  .wrapper {
            width: 100%;
            overflow: hidden;
			margin-bottom:50px;
			box-shadow: 2px 2px 8px pink;
        }
        .photobanner {
            display: flex;
            width: 100%;
            animation: bannermove 20s linear infinite;
			margin-bottom:20px;
        }
        .photobanner img {
            margin: 0 25px;
            box-shadow: 2px 2px 8px pink;
			border:none;
			border-radius:5%;
        }
        @keyframes bannermove {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
</style>
<?php foreach($banners as $banner) { 
        $images = explode(',', $banner['image']);
    ?>
<div class="hero-slider">
    <?php foreach($images as $image) { ?>
    <div class="slider-item th-fullpage hero-area"
        style="background-image: url(Admin/images/banner_photo/<?php echo htmlspecialchars($image); ?>);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text-left">
                    <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">
                        <?php echo $banner['title'] ?></p>
                    <?php 
					$sub_id=$banner['sub_id'];
					$sub=$sub_controller->getSubCategory($sub_id) ?>
                    <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">
                        <?php echo $sub['brand_name'] ?></h1>
                    <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                        href="shop-sidebar.php?sub_id=<?php echo $banner['sub_id'] ?>">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php } ?>
</div>
<div class="wrapper">
	<h2 class="text-center">New Arrivals</h2>
        <div class="photobanner">
			<?php $products=$product_controller-> ?>
            <a href="shop-sidebar.php"><img src=""
                    alt="" /></a>
        </div>
    </div>
<!-- <section class="product-category section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title text-center">
                    <h2>Product Category</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="category-box">
                    <a href="#!">
                        <img src="images/shop/category/category-1.jpg" alt="" />
                        <div class="content">
                            <h3>Clothes Sales</h3>
                            <p>Shop New Season Clothing</p>
                        </div>
                    </a>
                </div>
                <div class="category-box">
                    <a href="#!">
                        <img src="images/shop/category/category-2.jpg" alt="" />
                        <div class="content">
                            <h3>Smart Casuals</h3>
                            <p>Get Wide Range Selection</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="category-box category-box-2">
                    <a href="#!">
                        <img src="images/shop/category/category-3.jpg" alt="" />
                        <div class="content">
                            <h3>Jewellery</h3>
                            <p>Special Design Comes First</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> -->

<?php } ?>



<!--
Start Call To Action
==================================== -->
<!-- <section class="call-to-action bg-gray section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="title">
					<h2>SUBSCRIBE TO NEWSLETTER</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, <br> facilis numquam impedit ut sequi. Minus facilis vitae excepturi sit laboriosam.</p>
				</div>
				<div class="col-lg-6 col-md-offset-3">
				    <div class="input-group subscription-form">
				      <input type="text" class="form-control" placeholder="Enter Your Email Address">
				      <span class="input-group-btn">
				        <button class="btn btn-main" type="button">Subscribe Now!</button>
				      </span>
				    </div>
			  </div>

			</div>
		</div> 		
		
	</div>   	
	
</section>    
-->

<section class="section instagram-feed">
    <div class="container">
        <div class="row">
            <div class="title">
                <h2>View us on instagram</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="instagram-slider" id="instafeed"
                    data-accessToken="IGQVJYeUk4YWNIY1h4OWZANeS1wRHZARdjJ5QmdueXN2RFR6NF9iYUtfcGp1NmpxZA3RTbnU1MXpDNVBHTzZAMOFlxcGlkVHBKdjhqSnUybERhNWdQSE5hVmtXT013MEhOQVJJRGJBRURn">
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include_once 'layouts/footer.php';
?>