<?php
$subid = $banner['sub_id'];
$products = $product_controller->getProductsBySubCategory($subid);
if ($products != null) {
    
?>
<div class="slider">
    <div class="slides">
        <?php
        foreach ($products as $product) {
            if($product['state']=='New Arrival'){    
            $product_id = $product['product_id'];
            $pimages = $product_controller->getImageBannerList($product_id);
        foreach ($pimages as $pimage) { 
        ?>
        <a href="product-single.php?pid=<?php echo $product_id ?>">
        <div class="slide" style="background-image: url('Admin/images/product/<?php echo htmlspecialchars($pimage['image_name']); ?>');">
        <div class="badge">New</div>
        </div>
        </a>
        <?php }}} ?>
    </div>
    <button class="prev" onclick="moveSlide(this, -1)">&#10094;</button>
    <button class="next" onclick="moveSlide(this, 1)">&#10095;</button>
</div>
<?php 
} else { ?>
<h2 class="text-center"><?php echo $sub['brand_name']; ?></h2>
<?php }
 ?>