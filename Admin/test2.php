<?php
include_once 'layouts/header.php';
include_once DIR . '/Admin/controller/bannerController.php';
include_once DIR . '/Admin/controller/subController.php';
include_once DIR . '/Admin/controller/productController.php';
include_once DIR . '/Admin/controller/ShopInfoController.php';

$sub_controller = new SubCategoryController();
$banner_controller = new BannerController();
$product_controller = new productController();
$shop_controller = new ShopInfoController();

$banners = $banner_controller->getbanners();

?>
<link rel="stylesheet" href="css/index.css">
<?php if ($banners != null) {
    foreach ($banners as $banner) {
        $images = explode(',', $banner['image']);
?>
        <div class="hero-slider">
            <?php foreach ($images as $image) { ?>
                <div class="slider-item th-fullpage hero-area" style="background-image: url(Admin/images/banner_photo/<?php echo htmlspecialchars($image); ?>);">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 text-left">
                                <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">
                                    <?php echo $banner['title'] ?></p>
                                <?php
                                $sub_id = $banner['sub_id'];
                                $sub = $sub_controller->getSubCategory($sub_id) ?>
                                <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">
                                    <?php echo $sub['brand_name'] ?></h1>
                                <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop-sidebar.php?sub_id=<?php echo $banner['sub_id'] ?>">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- <div class="wrapper">
    <?php
        // $subid=$banner['sub_id'];
        // $product=$product_controller->getProductsBySubCategory($subid);
        // if($product!=null){
        // $product_id=$product['product_id'];
        // $pimages=$product_controller->getImages($product_id);
    ?>
    <h2 class="text-center">New Arrivals</h2>
    <div class="photobanner">
        <?php
        //foreach($pimages as $pimage){
        ?>
        <a href="shop-sidebar.php"><img width="30%" src="Admin/images/product/<?php //echo $pimage['image_name'] 
                                                                                ?>"
                alt="" /></a>
        <?php
    }
} ?>
    </div>
</div> -->
        <?php //}} 
        ?>


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


        <?php
        include_once 'layouts/footer.php';
        ?>