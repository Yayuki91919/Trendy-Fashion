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
                                    <a href="add_type.php" class="btn mb-1 gradient-2">
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
                                    foreach ($products as $p) 
                                    {
                                        echo "<tr >";
                                        echo "<th>" . $count++ . "</th>";
                                        echo "<td>
                                                <div class='card-title'>
                                                <span class='NEO m-10'>".$p['product_name']."</span>
                                                <span class=' m-10'>".$p['brand_name']." /</span>
                                                <span class='h6 m-10'>".$p['category_id']."</span>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-6'>
                                                        <div class='row'>
                                                            <div class='col'>

                                                                <span class='text-nowrap bg-light p-2 m-2 d-inline-block'>Size<span class='BTC m-l-10 lead'> S </span> &nbsp - &nbsp; <span class='NEO m-l-10 lead'>5</span>&nbsp&nbsp</span>
                                                            
                                                            </div>  
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class='col'>
                                                        <button type='button' class='btn mb-1 gradient-1'><i class='fa fa-eye'></i> Detail </button>
                                                    </div>
                                                    <div class='col'>
                                                        <button type='button' class='btn my-1 btn-rounded btn-info'>
                                                        <span class='btn-icon-left'><i class='fa fa-plus color-info'></i></span>post
                                                        </button>                                                    
                                                    </div>
                                                    <div class='col p-2 m-2' id='". $p['product_id'] . "'>
                                                        <a href='add_product.php?edit_id=" . $p['product_id'] . "' data-toggle='tooltip' data-placement='top' title='Edit'>
                                                        <i class=' fa fa-pencil fa-2x color-muted m-r-5'></i> </a>
                                                                                    
                                                        <a class='product_delete fa-2x ti-trash color-danger' data-toggle='tooltip' data-placement='top' title='Delete'></a>
                                                        <br>
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