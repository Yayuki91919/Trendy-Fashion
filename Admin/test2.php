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
<link rel="stylesheet" href="css/index.css">
<?php if($banners!=null){
foreach($banners as $banner) { 
        $images = explode(',', $banner['image']);
    ?>
<div class="hero-slider">
    <?php  foreach($images as $image) { ?>
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
    <?php   
            $subid=$banner['sub_id'];
		    $products=$product_controller->getProductsBySubCategory($subid);
            var_dump($products);
            echo $subid;
            if($products!=null){
                foreach($products as $product){
			$product_id=$product['product_id'];
			$pimages=$product_controller->getImages($product_id);
    ?>
    <h2 class="text-center">New Arrivals</h2>
    <div class="photobanner">
        <?php 
				foreach($pimages as $pimage){
				?>
        <a href="shop-sidebar.php"><img width="30%" src="Admin/images/product/<?php echo $pimage['image_name'] ?>"
                alt="" /></a>
        <?php 
        }}
        } ?>
    </div>
</div>
<?php  }} ?>



<section class="section instagram-feed">
    <div class="container">
        <div class="row">
            <div class="title">
                <h2>Shopping With Us</h2>
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

<script>
        // Banner Slider
        let bannerIndex = 0;
        const bannerSlides = document.querySelectorAll('.banner-slide');
        const totalBannerSlides = bannerSlides.length;

        function showBannerSlide(n) {
            if (n >= totalBannerSlides) bannerIndex = 0;
            else if (n < 0) bannerIndex = totalBannerSlides - 1;
            else bannerIndex = n;
            const offset = -bannerIndex * 100;
            document.querySelector('.banner-slides').style.transform = `translateX(${offset}%)`;
        }

        function nextBannerSlide() {
            showBannerSlide(bannerIndex + 1);
        }

        if (totalBannerSlides > 1) {
            setInterval(nextBannerSlide, 3000); // Change banner slide every 3 seconds only if more than one slide
        }

        // Product Slider
        let currentSlide = 0;

function moveSlide(direction) {
    const slides = document.querySelector('.slides');
    const totalSlides = document.querySelectorAll('.slide').length;
    const slidesPerPage = 4;
    const maxSlide = Math.ceil(totalSlides / slidesPerPage) - 1;

    currentSlide = (currentSlide + direction + maxSlide + 1) % (maxSlide + 1);
    slides.style.transform = `translateX(-${currentSlide * 100}%)`;
}

    </script>
<?php
include_once 'layouts/footer.php';
?>
<!-- Product Slider -->
<div class="slider">
    <div class="slides">
        <!-- Add your images here -->
        <?php
        foreach ($banners as $banner) {
            $subid = $banner['sub_id'];
            $products = $product_controller->getProductsBySubCategory($subid);
            if ($products != null) {
                foreach ($products as $product) {
                    $product_id = $product['product_id'];
                    $pimages = $product_controller->getImages($product_id);
                    foreach ($pimages as $pimage) { ?>
                        <div class="slide" style="background-image: url('Admin/images/product/<?php echo $pimage['image_name']; ?>');"></div>
                    <?php }
                }
            }
        } ?>
    </div>
    <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
    <button class="next" onclick="moveSlide(1)">&#10095;</button>
</div>