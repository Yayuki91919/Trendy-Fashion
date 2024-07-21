<?php
include_once 'layouts/header.php';
include_once __DIR__ . '/Admin/controller/typeController.php';
include_once __DIR__ . '/Admin/controller/subController.php';
include_once __DIR__ . '/Admin/controller/categoryController.php';
include_once __DIR__ . '/Admin/controller/productController.php';

$type_controller = new typeController();
$types = $type_controller->getTypes();

$cat_controller = new CategoryController();
$categories = $cat_controller->getCategories();

$sub_controller = new SubCategoryController();

$product_controller = new productController();
$products = $product_controller->getPublicProduct();
$product_id = "";
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
            <div class="col-md-3">
                <div class="widget">
                    <h4 class="widget-title">Type</h4>
                    <select id="productTypeSelect" class="form-control">
                        <option value="all">All Type</option>

                        <?php foreach ($types as $type) { ?>
                            <option value="<?php echo $type['type_id']; ?>"><?php echo $type['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="widget product-category">
                    <h4 class="widget-title">Categories</h4>
                    <div class="panel-group commonAccordion" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php foreach ($categories as $cat) {
                            $cat_id = $cat['category_id'];
                        ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading<?php echo $cat_id ?>">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $cat_id ?>" aria-expanded="false" aria-controls="collapse<?php echo $cat_id ?>">
                                            <?php echo $cat['category_name']; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?php echo $cat_id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $cat_id ?>">
                                    <div class="panel-body">
                                        <?php $subCategories = $sub_controller->getSelectCategory($cat_id); ?>
                                        <ul>
                                            <?php foreach ($subCategories as $sub) { ?>
                                                <li><a href="#!" class="subCategoryLink" data-sub-category-id="<?php echo $sub['sub_id']; ?>"><?php echo $sub['brand_name']; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row" id="productContainer">
                    <?php foreach ($products as $p) {
                        $product_id = $p['product_id'];
                        $images = $product_controller->getRandomImages($product_id); ?>

                        <div class="col-md-4">
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



            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productTypeSelect').on('change', function() {
            var typeId = $(this).val();
            if (typeId) {
                $.ajax({
                    url: 'fetch_products.php',
                    method: 'POST',
                    data: {
                        typeId: typeId
                    },
                    success: function(response) {
                        $('#productContainer').html(response);
                    }
                });
            } else {
                $('#productContainer').html('');
            }
        });

        $('.subCategoryLink').on('click', function() {
            var subCategoryId = $(this).data('sub-category-id');
            if (subCategoryId) {
                $.ajax({
                    url: 'fetch_products.php',
                    method: 'POST',
                    data: {
                        subCategoryId: subCategoryId
                    },
                    success: function(response) {
                        $('#productContainer').html(response);
                    }
                });
            } else {
                $('#productContainer').html('');
            }
        });
    });
</script>

<?php
include_once 'layouts/footer.php';
?>