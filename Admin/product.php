<?php
include_once 'layouts/header.php';
include_once __DIR__ . '../controller/productController.php';

$product_controller = new productController();
$products = $product_controller->getProduct();

if (isset($_GET['delete_pid'])) {
    $id = $_GET['delete_pid'];
    $status = $product_controller->deleteProduct($id);
    if ($status) {
        //var_dump($status);
        echo '<script> location.href="product.php"</script>';
    }
}

if (isset($_GET['pid']) && isset($_GET['edit_status'])) {

    $pid = $_GET['pid'];
    $edit_status = $_GET['edit_status'];
    
    $status = $product_controller->updateStatus($pid,$edit_status);
    if ($status) {
               
       // var_dump($status);

        echo '<script> location.href="product.php"</script>';
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Type</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="card-title">Product Lists</h4>
                                </div>
                                <div class="col-md-2">
                                    <a href="add_product.php" class="btn mb-1 gradient-2">
                                        New Product <span class="btn-icon-right">
                                            <i class="fa fa-plus"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($products as $p) {
                                        echo "<tr>";
                                        echo "<td>" . $count++ . "</td>";
                                        echo "<td class='row'>
                                        <div class='card bg-light'>
                                            <div class='row no-gutters'>
                                                <div class='col-md-4'>
                                                    <div class='card-img-wrapper'>
                                                        <img class='card-img img-fluid' src='images/product/" . $p['random_image'] . "' alt='" . $p['product_name'] . "' style='object-fit: cover; width: 100%; height: 100%;'>
                                                    </div>
                                                </div>
                                                <div class='col-md-8'>
                                                    <div class='card-body'>
                                                        <h5 class='card-title'>" . $p['product_name'] . "<span class='badge gradient-2'>" . $p['state'] . "</span></h5>
                                                        <p class='small'>
                                                            <span class='NEO'>" . $p['brand_name'] . "</span> |
                                                            <span class='BTC'>" . $p['category_name'] . "</span>
                                                        </p>
                                                        <p class='card-text'>" . $p['description'] . "</p>
                                                        <small class='text-muted'>create_date - " . $p['date'] . "</small>
                                                    </div>
                                                    <div class='card-footer bg-light'>
                                                        <a href='product_detail.php?pid=" . $p['product_id'] . "' class='btn m-2 gradient-1'><i class='fa fa-eye'></i> Detail </a>
                                                        <a href='product.php?delete_pid=" . $p['product_id'] . "' onclick='return confirm(\"Are you sure to delete?\")' class='m-2 btn btn-danger'>
                                                            <i class='fa fa-trash'></i> Delete
                                                        </a>";
                                    
                                                        if ($p['status'] == 1) { // Use strict comparison to ensure both value and type match
                                                            echo "<a href='product.php?pid=" . $p['product_id'] . "&edit_status=" . $p['status'] . "' onclick='return confirm(\"Are you sure want to change Private?\")' class='btn btn-success m-2 text-white'>
                                                                        <i class='fa fa-check'></i> Public
                                                                    </a>";
                                                        } else {
                                                            echo "<a href='product.php?pid=" . $p['product_id'] . "&edit_status=" . $p['status'] . "' onclick='return confirm(\"Are you sure want to change Public?\")' class='btn btn-warning m-2 text-white'>
                                                                <i class='fa fa-lock'></i> Private
                                                            </a>";
                                                        }
                                    
                                                    echo "</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>";
                                    
                                        echo "</tr>";
                                         }
                                            ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>

                                    </tr>
                                </tfoot>
                            </table>
                            
                        </div>
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


<?php
include_once 'layouts/footer.php';
?>
