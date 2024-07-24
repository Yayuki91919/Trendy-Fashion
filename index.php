<?php
include_once 'layouts/header.php';
include_once __DIR__ . '/Admin/controller/bannerController.php';
include_once __DIR__ . '/Admin/controller/subController.php';
include_once __DIR__ . '/Admin/controller/productController.php';
include_once __DIR__ . '/Admin/controller/ShopInfoController.php';

$sub_controller = new SubCategoryController();
$banner_controller = new BannerController();
$product_controller  = new productController();
$shop_controller = new ShopInfoController();

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
                    <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn btn-main"
                        href="product_sub.php?sid=<?php echo $banner['sub_id']; ?>">Shop Now</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php }} ?>

<section class="section instagram-feed">
            <div class="container">
                <div class="row">
                    <div class="title">
                        <h2>Shopping With Us</h2>
                    </div>
                </div>
                <section class="pricing-table">
                    <div class="container">
                        <div class="row">
                            <?php $shop = $shop_controller->getShopInfo(); ?>
                            <?php
                            foreach ($shop as $s) { ?>

                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="pricing-item">
                                        <table class="price-title">
                                            <tr>
                                                <th colspan="2"><?php echo $s['name'] ?></th>
                                            </tr>

                                            <tr class="">
                                                <td colspan="2" style="padding-bottom: 5px; padding-top: 5px; ">
                                                    <p class="text-justify">
                                                        <?php echo $s['address'] ?>
                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="text-align: left;">Open Time:</td>
                                                <td style="text-align: left;"><?php echo $s['open_time'] . " AM" ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">Close Time:</td>
                                                <td style="text-align: left;"><?php echo $s['close_time'] . " PM" ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">Phone:</td>
                                                <td style="text-align: left;"><?php echo $s['phone'] ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">Viber:</td>
                                                <td style="text-align: left;"><?php echo $s['viber'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

                        </div> <!-- End row -->
                    </div> <!-- End container -->
                </section> <!-- End section -->
                <div class="row">
                    <div class="col-12">
                        <div class="instagram-slider" id="instafeed" data-accessToken="IGQVJYeUk4YWNIY1h4OWZANeS1wRHZARdjJ5QmdueXN2RFR6NF9iYUtfcGp1NmpxZA3RTbnU1MXpDNVBHTzZAMOFlxcGlkVHBKdjhqSnUybERhNWdQSE5hVmtXT013MEhOQVJJRGJBRURn">
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
