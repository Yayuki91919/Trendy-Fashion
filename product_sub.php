
<?php
include_once 'layouts/header.php';
include_once __DIR__ . '/Admin/controller/categoryController.php';
include_once __DIR__ . '/Admin/controller/productController.php';

$cat_controller = new CategoryController();
$categories = $cat_controller->getCategories();

$product_controller = new productController();
$sid = $_GET['sid'];

$products = $product_controller->getProductsBySubCategory($sid);
?>

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Shop</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">shop</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="products section">
	<div class="container">
		<div class="row">
        <?php foreach ($products as $p) {
                        $product_id = $p['product_id'];
                        $images = $product_controller->getRandomImages($product_id); ?>

                        <div class="col-md-3">
                            <div class="product-item">
                                <div class="product-thumb">
                                    <?php if ($p['state'] != 'None') { ?>

                                        <span class="bage"><?php echo htmlspecialchars($p['state']); ?></span>

                                    <?php }

                                    foreach ($images as $img) { ?>

                                        <img class="img-responsive" src="Admin/images/product/<?php echo htmlspecialchars($img['image_name']); ?>" alt="product-img" />

                                    <?php }

                                    $check = $product_controller->checkSoldOut($product_id);
                                    foreach ($check as $c) {
                                        $qty = $c['total_quantity'];
                                    }
                                    if ($qty > 0) { ?>
                                        <div class="preview-meta">
                                            <ul>
                                                <li>
                                                    <a href="product-single.php?pid=<?php echo $product_id; ?>">
                                                        <i class="tf-ion-android-cart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php
                                    } else { ?>
                                        <div class="preview-meta">
                                            <ul class="">
                                                <a href="#!" class="btn btn-danger">
                                                    Sold Out
                                                </a>
                                            </ul>
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                                <div class="product-content">
                                    <h4><a><?php echo htmlspecialchars($p['product_name']); ?></a></h4>
                                    <p class="price"><?php echo htmlspecialchars($p['price']) . " Ks"; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
		</div>
    <a href="shop-sidebar.php" class="btn btn-main btn-solid-border">&larr;View All</a>

	</div>

</section>

<?php
include_once 'layouts/footer.php';
?>
