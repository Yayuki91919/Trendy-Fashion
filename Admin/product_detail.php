<?php
include_once 'layouts/header.php';
include_once __DIR__ . '../controller/productController.php';
include_once __DIR__ . '../controller/categoryController.php';
include_once __DIR__ . '../controller/subController.php';
include_once __DIR__ . '../controller/typeController.php';

$product_controller = new productController();
$errors = [];
$id = $_GET['pid'];

$product = $product_controller->getProducts($id);
$product_name = $product['product_name'];
$description = $product['description'];
$price = $product['price'];
$status = $product['status'];
$state = $product['state'];
$date = $product['date'];
$brand_name = $product['brand_name'];
$sub_id = $product['sub_id'];
$category_id = $product['category_id'];
$type = $product['type'];
$category_name = $product['category_name'];

$cat_controller = new CategoryController();
// $categories = $cat_controller->getCategoriesWithSub();
$categories = $cat_controller->getCategories();

$sub_controller = new SubCategoryController();
$subs = $sub_controller->getSubCategories();

$type_controller = new typeController();
$types = $type_controller->getTypes();


// size and color of $id product
$size_color = $product_controller->getSizeColorDetail($id);

$colors = $product_controller->getColors();
$sizes = $product_controller->getSizes();

$images = $product_controller->getImages($id);


if (isset($_POST['addSize'])) {
    $size_id = $_POST['size_id'];
    $color_id = $_POST['color_id'];
    $qty = $_POST['qty'];

    $status = $product_controller->addMoreSizeColor($size_id, $color_id, $qty, $id);
    if ($status) {
        //var_dump($status);
        echo '<script> location.href="product_detail.php?pid=' . $id . '"</script>';
    }
}


if (isset($_POST['addImage'])) {
    $product_id = $_POST['product_id'];
    $files = $_FILES['files'];

    if (empty($files['name'][0])) {
        $errors['files'] = "Please upload at least one image.";
    } else {
        $upload_dir = __DIR__ . '/images/product/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        foreach ($files['tmp_name'] as $key => $tmp_name) {
            $image_info = getimagesize($tmp_name);
            if ($image_info) {
                $width = $image_info[0];
                $height = $image_info[1];
                if ($width != 500 || $height != 600) {
                    $errors['files'] = "Image {$files['name'][$key]} does not have the required dimensions of 500 x 600. It is $width X $height";
                    break; // Stop further processing on dimension error
                } else {
                    // Generate unique file name to avoid overwriting
                    $file_name = uniqid() . '_' . basename($files['name'][$key]);
                    $target_file = $upload_dir . $file_name;
                    if (move_uploaded_file($tmp_name, $target_file)) {
                        // Successfully uploaded, now add to database or process further
                        $result = $product_controller->addMoreImage($id, $file_name);
                        if (!$result) {
                            $fail = "Failed to add image '{$files['name'][$key]}' to the database.";
                            break; // Exit loop on failure
                        }
                    } else {
                        $errors['files'] = "Error uploading file {$files['name'][$key]}";
                        break; // Exit loop on upload failure
                    }
                }
            } else {
                $errors['files'] = "File {$files['name'][$key]} is not a valid image.";
                break; // Exit loop on invalid image
            }
        }
    }

    if (empty($errors)) {
        echo '<script> location.href="product_detail.php?pid=' . $id . '"</script>';
    }
}


if (isset($_GET['delete_image'])) {
    $delete_image = $_GET['delete_image'];
    $name = $product_controller->getImageName($delete_image);

    foreach ($name as $a) {
        $image_name = $a;
    }
    $status = $product_controller->delete_image($delete_image);

    if ($status) {
        $upload_dir = 'images/product/';
        $image_path = $upload_dir . $image_name;

        echo 'upload Directory: ' . $image_path;


        if (file_exists($image_path)) {
            $delete_success = unlink($image_path);

            if ($delete_success) {

                if (isset($_GET['pid'])) {
                    $id = $_GET['pid'];
                    echo '<script>location.href="product_detail.php?pid=' . $id . '"</script>';
                    exit;
                } else {
                    echo '<script>alert("Product ID (pid) not provided.");</script>';
                }
            } else {
                // Failed to delete file
                echo '<script>alert("Failed to delete the image file.");</script>';
            }
        } else {
            // File does not exist
            echo '<script>alert("Image file does not exist. Image Path: ' . $image_path . '");</script>';
        }
    } else {
        // Deletion status was false
        echo '<script>alert("Failed to delete image from database.");</script>';
    }
}


if (isset($_GET['size_color_delete'])) {
    $product_detail_id = $_GET['size_color_delete'];
    $status = $product_controller->delete_product_detail($product_detail_id);
    if ($status) {
        //var_dump($status);
        echo '<script> location.href="product_detail.php?pid=' . $id . '"</script>';
    }
}

if (isset($_POST['editProduct'])) {
    $product_name = $_POST['product'];
    $cat_id = $_POST['cat_id'];
    $sub_id = $_POST['sub_id'];
    $type_id = $_POST['type_id'];
    $price = $_POST['price'];
    $des = $_POST['des'];
    $state = $_POST['state'];

    $status = $product_controller->editProduct($id, $product_name, $sub_id, $type_id, $price, $des, $state);
    if ($status) {
        // $message=2;
        echo '<script> location.href="product_detail.php?pid=' . $id . '"</script>';
    }
}


if (isset($_POST['qtyIncrease'])) {
    $d_id = $_POST['d_id'];
    $increaseQty = $_POST['quantity'];

    $status = $product_controller->increaseQty($d_id,$increaseQty);
    if ($status) {
        echo '<script> location.href="product_detail.php?pid=' . $id . '"</script>';
    }

}

if (isset($_POST['qtyDecrease'])) {
    $d_id = $_POST['d_id'];
    $decreaseQty = $_POST['quantity'];

    $status = $product_controller->decreaseQty($d_id,$decreaseQty);
    if ($status) {
        echo '<script> location.href="product_detail.php?pid=' . $id . '"</script>';
    }

}


?>
<style>
    .error {
        color: red;
        font-size: 0.9em;
    }
</style>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <?php
    if (isset($_GET['status']) && $_GET['status'] == 1) {
        echo "<div class='alert alert-success text-success' > New Product has been added </div>";
    } elseif (isset($_GET['status']) && $_GET['status'] == 2) {
        echo "<div class='alert alert-success' > New Product has been successfully updated</div>";
    } elseif (isset($_GET['status']) && $_GET['status'] == 3) {
        echo "<div class='alert alert-success' >Product has been successfully deleted</div>";
    }

    ?>
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Details</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class='card-title'><?php echo $product_name; ?>
                                <span class="badge gradient-3"><?php echo $state; ?></span>
                            </h5>
                            <a href="#" class="edit-icon m-2">
                                <i class="fa fa-pencil fa-2x text-primary m-r-5"></i>
                            </a>
                        </div>


                        </h5>
                        <p>
                            <span class="NEO">Brand: <b><?php echo $brand_name; ?></b></span> |
                            <span class="BTC">Category: <b><?php echo $category_name; ?></b></span>
                        </p>
                        <p class="card-text">Type: <b><?php echo $type; ?></b></p>
                        <p class="card-text">Price: <b><?php echo $price . " Ks"; ?></b></p>
                        <p class="card-text">Description: <b><?php echo $description; ?></b></p>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <span class="XRP">Created_date - <b><?php echo $date; ?></b></span>
                        <span class="float-right">
                            <h5><span class="text-info"><?php // echo $status; 
                                                        ?></span></h5>
                        </span>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Product Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form for editing details -->
                                <form id="editForm" action="<?php $_PHP_SELF ?>" method="POST">
                                    <div class="form-group">
                                        <label for="editBrand">Product</label>
                                        <input type="text" name="product" class="form-control" id="editProduct" value="<?php echo $product_name; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="editCategory">State</label>

                                        <select name="state" value="" class="custom-select mr-sm-2">
                                            <?php if ($state == "None") { ?>
                                                <option value="None" selected>None</option>
                                            <?php } else { ?>
                                                <option value="None">None</option>
                                            <?php } ?>

                                            <?php if ($state == "New Arrival") { ?>
                                                <option value="New Arrival" selected>New Arrival</option>
                                            <?php } else { ?>
                                                <option value="New Arrival">New Arrival</option>
                                            <?php } ?>

                                            <?php if ($state == "Best Seller") { ?>
                                                <option value="Best Seller" selected>Best Seller</option>
                                            <?php } else { ?>
                                                <option value="Best Seller">Best Seller</option>
                                            <?php } ?>

                                            <?php if ($state == "Popular") { ?>
                                                <option value="Popular" selected>Popular</option>
                                            <?php } else { ?>
                                                <option value="Popular">Popular</option>
                                            <?php } ?>

                                            <?php if ($state == "Limited Edition") { ?>
                                                <option value="Limited Edition" selected>Limited Edition</option>
                                            <?php } else { ?>
                                                <option value="Limited Edition">Limited Edition</option>
                                            <?php } ?>

                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="editCategory">Brand:</label>

                                        <select name="sub_id" value="" class="custom-select mr-sm-2">
                                            <?php
                                            foreach ($subs as $sub) {
                                                if ($sub['sub_id'] == $sub_id) {
                                            ?>
                                                    <option value="<?php echo $sub['sub_id']; ?>" selected><?php echo $sub['brand_name']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $sub['sub_id']; ?>"><?php echo $sub['brand_name']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Type</label>
                                        <select name="type_id" value="" class="custom-select mr-sm-2">
                                            <?php
                                            foreach ($types as $type) {
                                                if ($type['sub_id'] == $type_id) {
                                            ?>
                                                    <option value="<?php echo $type['type_id']; ?>" selected><?php echo $type['name']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $type['type_id']; ?>"><?php echo $type['name']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="editPrice">Price:</label>
                                        <input type="text" name="price" class="form-control" id="editPrice" value="<?php echo $price; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="editDescription">Description:</label>
                                        <textarea class="form-control" id="editDescription" name="des"><?php echo $description; ?></textarea>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" name="editProduct" value="Save changes">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Size and Color</h4>
                            <button class="btn btn-primary text-white" data-toggle="modal" data-target="#addSizeColorModal">
                                <i class="fa fa-plus"></i> Add
                            </button>
                        </div>
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
        $d_id = $sc['d_id'];
    ?>

        <tr>
            <th><?php echo $count++ ?></th>
            <td><?php echo $sc['size'] ?></td>
            <td><?php echo $sc['color'] ?></td>
            <td>
                <span class="px-2"><?php echo $sc['qty'] ?></span>
                <span class="badge badge-success px-2" data-toggle="modal" data-target="#quantityModal<?php echo $d_id ?>"><i class="fa fa-plus text-white"></i></span>
                <span class="badge badge-warning px-2" data-toggle="modal" data-target="#quantityDecreaseModal<?php echo $d_id ?>"><i class="fa fa-minus text-white"></i></span>
            </td>
            <td><a href="product_detail.php?pid=<?php echo $id ?>&size_color_delete=<?php echo $d_id ?>" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash text-danger"></i></a></td>
        </tr>

        <!-- Modal for increase quantity input -->
        <div class="modal fade" id="quantityModal<?php echo $d_id ?>" tabindex="-1" aria-labelledby="quantityModalLabel<?php echo $d_id ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quantityModalLabel<?php echo $d_id ?>"><br>Size : <?php echo " " . $sc['size'] ?> and Color : <?php echo " " . $sc['color'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="quantityForm<?php echo $d_id ?>" action="<?php $_PHP_SELF ?>" method="post">
                            <input type="hidden" name="d_id" value="<?php echo $d_id ?>">
                            <input type="hidden" name="pid" value="<?php echo $id ?>">
                            <div class="form-group">
                                <label for="quantityInput<?php echo $d_id ?>">Quantity Increment:</label>
                                <input type="number" class="form-control" id="quantityInput<?php echo $d_id ?>" name="quantity">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="qtyIncrease" value="Increase" class="btn btn-success text-white save-quantity-btn" data-d-id="<?php echo $d_id ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for decrease quantity input -->
        <div class="modal fade" id="quantityDecreaseModal<?php echo $d_id ?>" tabindex="-1" aria-labelledby="quantityDecreaseModalLabel<?php echo $d_id ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quantityDecreaseModalLabel<?php echo $d_id ?>"><br>Size : <?php echo " " . $sc['size'] ?> and Color : <?php echo " " . $sc['color'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="quantityDecreaseForm<?php echo $d_id ?>" action="<?php $_PHP_SELF ?>" method="post">
                            <input type="hidden" name="d_id" value="<?php echo $d_id ?>">
                            <input type="hidden" name="pid" value="<?php echo $id ?>">
                            <div class="form-group">
                                <label for="quantityDecreaseInput<?php echo $d_id ?>">Quantity Decrease:</label>
                                <input type="number" class="form-control" id="quantityDecreaseInput<?php echo $d_id ?>" name="quantity">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="qtyDecrease" value="Decrease" class="btn btn-warning text-white save-quantity-btn" data-d-id="<?php echo $d_id ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
    ?>
</tbody>


                        </table>
                    </div>
                </div>


                <!-- modal for add size -->
                <div class="modal fade" id="addSizeColorModal" tabindex="-1" role="dialog" aria-labelledby="addSizeColorModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addSizeColorModalLabel">Add Size, Color, and Quantity</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addSizeColorForm" method="post" action="<?php $_PHP_SELF ?>">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <select name="size_id" class="form-control">
                                            <?php foreach ($sizes as $size) : ?>
                                                <option value="<?php echo $size['size_id']; ?>"><?php echo $size['size'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <select name="color_id" class="form-control">
                                            <?php foreach ($colors as $color) : ?>
                                                <option value="<?php echo $color['color_id']; ?>"><?php echo $color['color'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" min="1" name="qty" class="form-control" id="quantity" required>

                                    </div>
                                    <button type="submit" name="addSize" class="btn btn-primary">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Product Images Section -->
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Images</h4>
                        <!-- <button class="btn btn-success text-white" data-toggle="modal" data-target="#addImageModal">
                            <i class="fa fa-plus"></i> Add Image
                        </button> -->
                    </div>

                    <div class="row mt-1">
                        <?php foreach ($images as $i) : ?>
                            <div class="col-6 col-md-4 mb-3">
                                <div class="position-relative">
                                    <!-- Delete button -->
                                    <a href="product_detail.php?pid=<?php echo $id ?>&delete_image=<?php echo $i['image_id'] ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-link position-absolute" style="top: 5px; right: 5px;">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                    <!-- Image -->
                                    <img class="img-fluid" src="images/product/<?php echo $i['image_name'] ?>" alt="<?php echo $i['image_name'] ?>" style="width: auto; height: auto; max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>





                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
                                    <div class="p-3 bg-light border rounded shadow-sm">
                                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                        <label class="font-weight-bold">Add More Images:</label>
                                        <input type="file" name="files[]" multiple class="form-control" placeholder="Choose Images" required id="imageInput">

                                        <div id="previewContainer" class="row mt-3">
                                            <!-- Previewed images will be added here -->
                                        </div>
                                        <?php if (isset($errors['files'])) : ?>
                                            <div class="error"><?php echo $errors['files']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <a href="product.php" class="btn btn-info text-white mt-3"><i class="fa fa-arrow-left"></i>
                                    Back</a>
                                    <input type="submit" value="Add Image" name="addImage" class="btn btn-info mt-3 float-right text-white">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <!-- Add Image button -->
                </div>
            </div>

        </div>
    </div>
</div>

</div>

</div>

</div>
<!--**********************************
            Content body end
        ***********************************-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- ***************Click Image***************** -->
<script>
    function openModal(imageId) {
        $('#imageModal' + imageId).modal('show');
    }
</script>

<!-- ***************Image Preview********************** -->
<!-- <script>
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
</script> -->

<!-- *************** Image Preview and File Extension Validation ********************** -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview function with file extension validation
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = ''; // Clear previous images
            const files = event.target.files;

            if (files.length === 0) {
                console.log('No files selected'); // Debugging log
                return;
            }

            const allowedExtensions = ['jpg', 'jpeg', 'png'];

            for (const file of files) {
                const fileName = file.name;
                const ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();

                // Check if file extension is allowed
                if (allowedExtensions.indexOf(ext) === -1) {
                    alert('Error: Only JPG, JPEG, or PNG files are allowed.');
                    continue; // Skip processing invalid file
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const colDiv = document.createElement('div');
                    colDiv.classList.add('col-6', 'col-md-4', 'col-lg-3', 'mb-3'); // Adjust column size as needed
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-fluid'); // Bootstrap class for responsive images
                    colDiv.appendChild(img);
                    previewContainer.appendChild(colDiv);
                };
                reader.readAsDataURL(file);
            }
        });

        // Form submission event listener for additional file extension validation
        document.getElementById('addSizeColorForm').addEventListener('submit', function(event) {
            var fileInput = document.getElementById('photo');
            var fileName = fileInput.value;
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
            var allowedExtensions = ['jpg', 'jpeg', 'png'];

            // Check if a file is selected and it's an image with allowed extension
            if (fileName && allowedExtensions.indexOf(ext) === -1) {
                alert('Error: Only JPG, JPEG, or PNG files are allowed.');
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>



<!-- ******************edit product Modal********************** -->
<script>
    $(document).ready(function() {
        $('.edit-icon').click(function() {

            $('#editModal').modal('show');
        });
    });
</script>


<?php
include_once 'layouts/footer.php';
?>