<?php
include_once 'layouts/header.php';
include_once __DIR__ . '/Admin/controller/bannerController.php';
include_once __DIR__ . '/Admin/controller/subController.php';
include_once __DIR__ . '/Admin/controller/productController.php';

$sub_controller = new SubCategoryController();
$banner_controller = new BannerController();
$product_controller = new productController();
$banners = $banner_controller->getbanners();
?>

<link rel="stylesheet" href="css/index.css">

<?php if ($banners != null) {
    foreach ($banners as $banner) {
        $images = explode(',', $banner['image']); ?>
<!-- Banner Slider -->
<div class="slider-container">
    <div class="banner-slider">
        <div class="banner-slides">
            <?php
                foreach ($images as $image) { ?>
            <div class="banner-slide" style="background-image: url('Admin/images/banner_photo/<?php echo $image; ?>');">
                <div class="banner-content">
                    <h1><?php echo $banner['title']; ?></h1>
                    <?php
                        $sub_id = $banner['sub_id'];
                        $sub = $sub_controller->getSubCategory($sub_id); ?>
                    <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">
                        <?php echo $sub['brand_name']; ?></h1>
                    <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                        href="product_sub.php?s_id=<?php echo $banner['sub_id']; ?>">Shop Now</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
$subid = $banner['sub_id'];
$products = $product_controller->getProductsBySubCategory($subid);
if ($products != null) {
    foreach ($products as $product) {
        if($product['state']=='new_arrival'){    
        $product_id = $product['product_id'];
        $pimages = $product_controller->getImages($product_id);
?>
<div class="slider">
    <div class="slides">
        <?php
        foreach ($pimages as $pimage) { 
        ?>
        <a href="product-single.php?pid=<?php echo $product_id ?>">
        <div class="slide" style="background-image: url('Admin/images/product/<?php echo $pimage['image_name']; ?>');">
        <div class="badge">New</div>
        </div>
        </a>
        <?php } ?>
    </div>
    <button class="prev" onclick="moveSlide(this, -1)">&#10094;</button>
    <button class="next" onclick="moveSlide(this, 1)">&#10095;</button>
</div>
<?php } 
}
} else { ?>
<h2 class="text-center"><?php echo $sub['brand_name']; ?></h2>
<?php }
}
} ?>

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
document.querySelectorAll('.banner-slider').forEach((sliderContainer) => {
    let bannerIndex = 0;
    const bannerSlides = sliderContainer.querySelectorAll('.banner-slide');
    const totalBannerSlides = bannerSlides.length;

    function showBannerSlide(n) {
        if (n >= totalBannerSlides) bannerIndex = 0;
        else if (n < 0) bannerIndex = totalBannerSlides - 1;
        else bannerIndex = n;
        const offset = -bannerIndex * 100;
        sliderContainer.querySelector('.banner-slides').style.transform = `translateX(${offset}%)`;
    }

    function nextBannerSlide() {
        showBannerSlide(bannerIndex + 1);
    }

    if (totalBannerSlides > 1) {
        setInterval(nextBannerSlide, 3000); // Change banner slide every 3 seconds only if more than one slide
    }
});

// Product Slider
function moveSlide(button, direction) {
    const sliderContainer = button.closest('.slider');
    const slides = sliderContainer.querySelector('.slides');
    const totalSlides = sliderContainer.querySelectorAll('.slide').length;
    const slidesPerPage = 4;
    let currentSlide = sliderContainer.getAttribute('data-current-slide') || 0;
    currentSlide = parseInt(currentSlide);
    const maxSlide = Math.ceil(totalSlides / slidesPerPage) - 1;

    currentSlide = (currentSlide + direction + maxSlide + 1) % (maxSlide + 1);
    sliderContainer.setAttribute('data-current-slide', currentSlide);
    slides.style.transform = `translateX(-${currentSlide * 100}%)`;
}
</script>

<?php
include_once 'layouts/footer.php';
?>
