<?php
include_once 'layouts/header.php';
include_once __DIR__ . '../controller/productController.php';

$product_controller = new productController();


$id = $_GET['pid'];
$product = $product_controller->getProducts($id);

$size_color = $product_controller->getSizeColorDetail($id);
$images = $product_controller->getImages($id);


// if ($product) {
//     // Process the product information
//     var_dump($product);
// } else {
//     echo 'Product not found or an error occurred.';
// }


// if (isset($_POST['add'])) {
//     $name = $_POST['name'];
//     $status = $product_controller->addProduct($name);
//     if ($status) {
//         echo '<script> location.href="product.php?status=' . $status . '"</script>';
//     }
// }


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
            <!-- Product Information Section -->
            <?php

            $product_name = $product['product_name'];
            $description = $product['description'];
            $price = $product['price'];
            $status = $product['status'];
            $state = $product['state'];
            $date = $product['date'];
            $brand_name = $product['brand_name'];
            $category_name = $product['category_name'];

            ?>
            <div class="col-12 col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title"><?php echo $product_name; ?> <span class="badge gradient-3"><?php echo $state; ?></span></h5>
                            <a href="edit_product.php" data-toggle="tooltip" data-placement="top" title="Edit" class="m-2 ">
                                <i class="fa fa-pencil fa-2x text-primary m-r-5"></i>
                            </a>
                        </div>

                        </h5>
                        <p>
                            <span class="NEO">Brand: <b><?php echo $brand_name; ?></b></span> |
                            <span class="BTC">Category: <b><?php echo $category_name; ?></b></span>
                        </p>
                        <p class="card-text">Price: <b><?php echo $price . " Ks"; ?></b></p>
                        <p class="card-text">Description: <b><?php echo $description; ?></b></p>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <span class="XRP">Created_date - <b><?php echo $date; ?></b></span>
                        <span class="float-right">
                            <h5><span class="btn gradient-1">Public</span></h5>
                        </span>
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
                                        <td id=<?php echo $sc['d_id'] ?>>
                                            <!-- <a class="edit_size" href="editSize.php?id=<?php echo $sc['d_id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-pencil text-primary"></i>
                                            </a> -->
                                            <a href="delete_size.php?sid=<?php echo $sc['d_id']; ?>&pid=<?php echo $id ?>" data-toggle="tooltip" data-placement="top" title="Remove">
                                                <i class="fa fa-close text-danger"></i>
                                            </a>
                                        </td>
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
                <form id="addSizeColorForm">
                    <div class="form-group">
                        <label for="size">Size</label>
                        <input type="text" class="form-control" id="size" name="size" required>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" id="color" name="color" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
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
                        <button class="btn btn-success text-white" data-toggle="modal" data-target="#addImageModal">
                            <i class="fa fa-plus"></i> Add Image
                        </button>
                    </div>
                    <div class="row mt-3">
                        <?php $count = 1;
                        foreach ($images as $i) : ?>
                            <div class="col-6 col-md-4">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <?php echo $product_name, $count++ ?>
                                        <a href='delete_ProductImg.php?img_id=<?php echo $i['image_id'] ?>' class="btn-lg float-right" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="fa fa-close text-danger"></i>
                                        </a>
                                    </div>
                                    <img class="card-img-top" src="images/product/<?php echo $i['image_name'] ?>" alt="<?php echo $i['image_name'] ?>" style="width: 100%; height: 200px; object-fit: cover;" onclick="openModal('<?php echo $i['image_id'] ?>')">
                                    <div class="card-body">
                                        <!-- Additional content or details if needed -->
                                    </div>
                                </div>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="imageModal<?php echo $i['image_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel<?php echo $i['image_id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalLabel<?php echo $i['image_id'] ?>"><?php echo $product_name, $count++ ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="images/product/<?php echo $i['image_name'] ?>" class="img-fluid" alt="<?php echo $i['image_name'] ?>">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        <?php endforeach; ?>
                        <!-- Add Image Modal -->
                        <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addImageModalLabel">Add Image</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="upload_image.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="image">Select image to upload:</label>
                                                <input type="file" class="form-control" name="image" id="image" required>
                                            </div>
                                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Upload Image</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
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

<script>
    function openModal(imageId) {
        $('#imageModal' + imageId).modal('show');
    }
</script>


<?php
include_once 'layouts/footer.php';
?>