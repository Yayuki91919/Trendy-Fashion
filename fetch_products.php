<?php
include_once __DIR__ . '/Admin/controller/productController.php';

$product_controller = new productController();

if (isset($_POST['typeId']) || isset($_POST['subCategoryId'])) {
    if (isset($_POST['typeId'])) {
        $typeId = $_POST['typeId'];
        if($typeId == 'all'){
            $products = $product_controller->getProduct();


        }else{
            $products = $product_controller->getProductsByType($typeId);

        }
    } elseif (isset($_POST['subCategoryId'])) {
        $subCategoryId = $_POST['subCategoryId'];
        $products = $product_controller->getProductsBySubCategory($subCategoryId);
    }

    if ($products) {
        // If $products is a single product (associative array), wrap it in an array
        if (isset($products['product_id'])) {
            $products = [$products];
        }
        //   var_dump($products);
        
        foreach ($products as $p) {
            $product_id = $p['product_id'];
            $images = $product_controller->getRamdomImages($product_id); ?>

            <div class="col-md-4">
                <div class="product-item">
                    <div class="product-thumb">
                        <?php if($p['state'] != 'None'){?>

                        <span class="bage"><?php echo htmlspecialchars($p['state']); ?></span>

                        <?php } ?>
                        <?php foreach ($images as $img) { ?>
                            <img class="img-responsive" src="Admin/images/product/<?php echo htmlspecialchars($img['image_name']); ?>" alt="product-img" />
                        <?php } ?>
                        <div class="preview-meta">
                            <ul>
                                <li>
                                    <!-- <span data-toggle="modal" data-target="#product-modal">
                                        <i class="tf-ion-ios-search-strong"></i>
                                    </span> -->
                                    <a href="product-single.php?pid=<?php echo $product_id; ?>"><i class="tf-ion-ios-search-strong"></i></a>
                                </li>
                                <li>
                                    <a href="#!"><i class="tf-ion-ios-heart"></i></a>
                                </li>
                                <li>
                                    <a href="#!"><i class="tf-ion-android-cart"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a href="product-single.php"><?php echo htmlspecialchars($p['product_name']); ?></a></h4>
                        <p class="price"><?php echo htmlspecialchars($p['price']) . " Ks"; ?></p>
                    </div>
                </div>
            </div>
        <?php }
    } else {
        echo '<p>No products found for this type/sub-category.</p>';
    }
} else {
    echo '<p>No type or sub-category selected.</p>';
}
?>
