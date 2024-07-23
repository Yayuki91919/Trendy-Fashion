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
    $images = $_FILES['images'];
    $status = $product_controller->addProduct($name, $price, $sub_id, $type_id, $des, $images);
    if($status)
    {
        echo '<script> location.href="product.php?status='.$status.'"</script>';
    }

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
                            <div class="row">

                                    <!-- /# column -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title">
                                                    <h4>Sizes and Color <span class="float-right mt-2">
                                                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#addProductModal">
                                                                Add Size
                                                            </button>
                                                        </span></h4>

                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Size</th>
                                                                <th>Color</th>
                                                                <th>Quantity</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $count = 1;

                                                            foreach ($size_color as $sc) {
                                                            ?>

                                                                <tr>
                                                                    <th><?php echo $count++ ?></th>
                                                                    <td><?php echo $sc['size'] ?></td>
                                                                    <td><?php echo $sc['color'] ?> </td>
                                                                    <td><span class="badge badge-primary px-2"></span>
                                                                        <?php echo $sc['qty'] ?></td>
                                                                    <td><a href="add_product.php?size_color_delete=<?php echo $sc['id'] ?>" 
                                                                    onclick="return confirm('Are you sure to delete?')">
                                                                    <i class="fa fa-trash text-danger"></i></a></td>
                                                                                                
                                            

                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>



                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /# column -->

                                </div>
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
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="p-3 bg-light border rounded shadow-sm">
                                                <label class="font-weight-bold">Select Images:</label>
                                                <input type="file" name="images[]" accept="image/*" multiple class="form-control" placeholder="Choose Images" required id="imageInput">

                                                <div id="previewContainer" class="row mt-3">
                                                    <!-- Previewed images will be added here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <input type="submit" value="Add Product" class="btn text-white btn-info" name="addProduct">
                            </form>


                            <?php
                            if (isset($_POST['addSize'])) {
                                $size_id = $_POST['size_id'];
                                $color_id = $_POST['color_id'];
                                $qty = $_POST['qty'];

                                $size_name = $product_controller->getSize($size_id);
                                foreach ($size_name as $s) {
                                    $size = $s;
                                }

                                $color_name = $product_controller->getColor($color_id);
                                foreach ($color_name as $c) {
                                    $color = $c;
                                }

                                // echo $size_id,$size,$color_id,$color,$qty;

                                $status = $product_controller->addSize_Color($color_id, $color, $size_id, $size, $qty);
                                if ($status) {
                                    // var_dump($status);
                                    echo '<script> location.href="add_product.php"</script>';
                                }
                            } ?>


                            <!-- ######################modal############### -->
                            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post" action="<?php $_PHP_SELF ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="size">Size:</label>
                                                    <select name="size_id" class="form-control">
                                                        <?php foreach ($sizes as $size) : ?>
                                                            <option value="<?php echo $size['size_id']; ?>"><?php echo $size['size'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Color:</label>
                                                    <select name="color_id" class="form-control">
                                                        <?php foreach ($colors as $color) : ?>
                                                            <option value="<?php echo $color['color_id']; ?>"><?php echo $color['color'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="qty">Quantity:</label>
                                                    <input type="number" min="1" name="qty" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn text-white btn-secondary" data-dismiss="modal">Close</button>
                                                <input type="submit" name="addSize" class="btn btn-primary" value="Add Size">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- #########################modal end####################################### -->



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


<!-- *********************Image preview*************************** -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = ''; // Clear previous images
            const files = event.target.files;

            if (files.length === 0) {
                console.log('No files selected'); // Debugging log
                return;
            }

            for (const file of files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const colDiv = document.createElement('div');
                    colDiv.classList.add('col-6', 'col-md-4', 'col-lg-3', 'mb-3'); // Adjust column size as needed
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-fluid'); // Bootstrap class for responsive images
                    colDiv.appendChild(img);
                    previewContainer.appendChild(colDiv);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>


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