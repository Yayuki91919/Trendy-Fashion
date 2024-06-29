<?php
include_once 'layouts/header.php';
include_once __DIR__ . '../controller/productController.php';

$product_controller = new productController();
$products = $product_controller->getProduct();

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
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($products as $p) 
                                    {   
                                        echo "<td>".$count++."</td>";
                                        echo "<td class='row'>
                                                
                                                    <div class='card h-100 w-100 bg-light'>
                                                        <div class='row no-gutters'>
                                                            <div class='col-md-4'>
                                                                <img class='card-img img-fluid' src='images/product/".$p['random_image']."' alt='' style='width: 200px; height: 200px; object-fit: cover;'>
                                                            </div>
                                                            <div class='col-md-8'>
                                                                <div class='card-body'>
                                                                    <h5 class='card-title'>".$p['product_name']."<span class='badge gradient-2'>".$p['state']."</span></h5>
                                                                    <p class='small'>
                                                                        <span class='NEO'>".$p['brand_name']." </span> |
                                                                        <span class='BTC'>".$p['category_name']."</span>
                                                                    </p>
                                                                    <p class='card-text'>".$p['description']."</p>
                                                                </div>
                                                                <div class='card-footer bg-light'>
                                                                    <small class='text-muted'>create_date - ".$p['date']."</small>
                                                                    <a href='product_detail.php?pid=".$p['product_id']."' class='btn m-2 gradient-1'><i class='fa fa-eye'></i> Detail </a>
                                                                     
                                                                    <a href='".$p['product_id']."' data-toggle='tooltip' data-placement='top' title='Edit' class='m-2'>
                                                                        <i class='fa fa-pencil fa-2x color-muted m-r-5'></i>
                                                                    </a>
                                                                    <a class='m-2 product_delete fa-2x ti-trash color-danger' data-toggle='tooltip' data-placement='top' title='Delete'></a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                            </td>";
                                        
                                            
                                        echo "<td>
                                                <button type='button' class='btn m-2 btn-rounded btn-info'>
                                                    <span class='btn-icon-left'><i class='fa fa-plus color-info'></i></span>".$p['status']."
                                                </button>
                                            </td>";
                                          
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Status</th>
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