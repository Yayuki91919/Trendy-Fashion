<!-- combine add -->
<?php
include_once 'layouts/header.php';
include_once __DIR__ . '../controller/categoryController.php';
include_once __DIR__ . '../controller/subController.php';
include_once __DIR__ . '../controller/typeController.php';
include_once __DIR__ . '../controller/productController.php';


$cat_controller = new CategoryController();
$categories = $cat_controller->getCategoriesWithSub();

$sub_controller = new SubCategoryController();
$subs = $sub_controller->getSubCategories();

$type_controller = new typeController();
$types = $type_controller->getTypes();

$product_controller = new productController();
$colors = $product_controller->getColors();
$sizes = $product_controller->getSizes();
$size_color = $product_controller->getSizeColor();

if (isset($_POST['addProduct'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $cat_id = $_POST['cat_id'];
    $sub_id = $_POST['sub_id'];
    $type_id = $_POST['type_id'];
    $des = $_POST['des'];
    // $images = $_FILES['images'];
    $status = $product_controller->addProduct($name, $price, $sub_id, $type_id, $des);
    // if ($status) {
        echo '<script> location.href="addedProduct.php?pid=' . $status . '"</script>';
    // }
}

if (isset($_GET['size_color_delete'])) {
    $temp_id = $_GET['size_color_delete'];
    $status = $product_controller->deleteTemp($temp_id);
    if ($status) {
        //var_dump($status);
        echo '<script> location.href="add_product.php"</script>';
    }
}



?>


<!--**********************************
            Content body start
        ***********************************-->

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12  ">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Add Product Form</h4>
                        <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Name:</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter product name" style="width: 100%;" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Category</label>
                                        <select name="cat_id" class="form-control mr-sm-2" id="categorySelect" required>
                                            <option value="">Choose Category</option>
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price:</label>
                                        <input type="text" id="price" name="price" class="form-control" placeholder="Enter price" style="width: 100%;" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Sub Category</label>
                                        <select name="sub_id" class="form-control    mr-sm-2" id="subCategorySelect">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="des">Description:</label>
                                        <!-- <textarea id="description" name="des" class="custom-select " name="description" placeholder="Description" style="width: 100%;"></textarea> -->
                                        <textarea id="description" name="des" class="form-control" placeholder="Description" rows="5" style="width: 100%;" required></textarea>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Type</label>
                                        <select name="type_id" class="form-control mr-sm-2" id="categorySelect" required>
                                            <option value="">Choose Type</option>
                                            <?php foreach ($types as $type) : ?>
                                                <option value="<?php echo $type['type_id']; ?>"><?php echo $type['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <input type="submit" value="Add Product" class="btn text-white btn-info float-right" name="addProduct">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- ***********************Sub Category************************* -->
<script>
    $(document).ready(function() {
        $('#categorySelect').change(function() {
            var category_id = $(this).val(); // Get the selected category ID
            $.ajax({
                type: 'POST',
                url: 'get_subcategories.php',
                data: {
                    category_id: category_id
                },
                dataType: 'json', // Ensure this is set to 'json'
                success: function(response) {
                    $('#subCategorySelect').empty();
                    $.each(response, function(index, subcategory) {
                        $('#subCategorySelect').append('<option value="' + subcategory.sub_id + '">' + subcategory.brand_name + '</option>');
                        console.log(subcategory.sub_id); // Log each sub_id
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ': ' + error);
                }
            });
        });

    });
</script>




<?php
include_once 'layouts/footer.php';
?>
<!-- image validation message if not entering in database-->