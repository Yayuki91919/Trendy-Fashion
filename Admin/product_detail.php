<?php
include_once 'layouts/header.php';
include_once __DIR__ . '../controller/productController.php';
include_once __DIR__ . '../controller/categoryController.php';
include_once __DIR__ . '../controller/subController.php';
include_once __DIR__ . '../controller/typeController.php';

//  Product Information Section
$product_controller = new productController();
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

    //  echo $size_id."<br>".$color_id."<br>".$qty."<br>".$id;

    $status = $product_controller->addMoreSizeColor($size_id, $color_id, $qty, $id);
    if ($status) {
        //var_dump($status);
        echo '<script> location.href="product_detail.php?pid=' . $id . '"</script>';
    }
}

if (isset($_POST['addImage'])) {

    $images = $_FILES['images'];
    $status = $product_controller->addMoreImage($id, $images);
    if ($status) {

        echo '<script> location.href="product_detail.php?pid=' . $id . '"</script>';
        //header('Location: product_detail.php?pid=' . $id);

    } else {
        echo "Failed to add images.";
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
if (isset($_GET['delete_image'])) {
    $delete_image = $_GET['delete_image'];
    $status = $product_controller->delete_image($delete_image);
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

    $status=$product_controller->editProduct($id,$product_name,$sub_id,$type_id,$price,$des,$state);
    if($status)
    {
        // $message=2;
        echo '<script> location.href="product_detail.php?pid=' . $id . '"</script>';
    }
}


?>


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
                            <h5><span class="text-info"><?php echo $status; ?></span></h5>
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
                                            <?php if($state == "None") { ?>
                                                <option value="None" selected>None</option>
                                            <?php } else { ?>
                                                <option value="None">None</option>
                                            <?php } ?>

                                            <?php if($state == "New Arrival") { ?>
                                                <option value="New Arrival" selected>New Arrival</option>
                                            <?php } else { ?>
                                                <option value="New Arrival">New Arrival</option>
                                            <?php } ?>

                                            <?php if($state == "Best Seller") { ?>
                                                <option value="Best Seller" selected>Best Seller</option>
                                            <?php } else { ?>
                                                <option value="Best Seller">Best Seller</option>
                                            <?php } ?>

                                            <?php if($state == "Popular") { ?>
                                                <option value="Popular" selected>Popular</option>
                                            <?php } else { ?>
                                                <option value="Popular">Popular</option>
                                            <?php } ?>

                                            <?php if($state == "Limited Edition") { ?>
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
                                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
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
                            <button class="btn btn-success text-white" data-toggle="modal" data-target="#addSizeColorModal">
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
                                ?>

                                    <tr>
                                        <th><?php echo $count++ ?></th>
                                        <td><?php echo $sc['size'] ?></td>
                                        <td><?php echo $sc['color'] ?> </td>
                                        <td><span class="badge badge-primary px-2"></span>
                                            <?php echo $sc['qty'] ?></td>
                                        <td><a href="product_detail.php?pid=<?php echo $id ?>&size_color_delete=<?php echo $sc['d_id'] ?>" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash text-danger"></i></a></td>

                                    </tr>
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
                    <div class="row mt-3">
                        <?php $count = 1;
                        foreach ($images as $i) : ?>
                            <div class="col-6 col-md-4">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <?php echo $product_name, $count++ ?>

                                        <a href="product_detail.php?pid=<?php echo $id ?>&delete_image=<?php echo $i['image_id'] ?>" onclick="return confirm('Are you sure to delete?')" class="btn-lg float-right">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>

                                    </div>
                                    <img class="card-img-top" src="images/product/<?php echo $i['image_name'] ?>" alt="<?php echo $i['image_name'] ?>" style="width: 100%; height: 200px; object-fit: cover;" onclick="openModal('<?php echo $i['image_id'] ?>')">
                                    <div class="card-body">
                                        <!-- Additional content or details if needed -->
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
                                    <div class="p-3 bg-light border rounded shadow-sm">
                                        <label class="font-weight-bold">Add More Images:</label>
                                        <input type="file" name="images[]" accept="image/*" multiple class="form-control" placeholder="Choose Images" required id="imageInput">

                                        <div id="previewContainer" class="row mt-3">
                                            <!-- Previewed images will be added here -->
                                        </div>
                                    </div>
                                    <input type="submit" value="Add Image" name="addImage" class="btn btn-success text-white">
                            </div>
                            </form>
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