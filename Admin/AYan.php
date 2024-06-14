<?php
include_once 'layouts/header.php';
include_once __DIR__ . '../controller/TypeController.php';

$type_controller = new typeController();
$types = $type_controller->getTypes();

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $status = $cat_controller->addType($name);
    if ($status) {
        echo '<script> location.href="product_type.php?status=' . $status . '"</script>';
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($types as $type) {
                                        echo "<tr >";
                                        echo "<th>" . $count++ . "</th>";
                                        echo "<td>
                                                <h4 class='card-title'>Custom Media 1</h4>
                                                <div class='custom-media-object-1'>
                                                    <div class='media border-bottom-1 p-t-15'>
                                                        <div class='media-body'>
                                                            <div class='row'>
                                                                <div class='col-lg-2'>
                                                                    <h5><span class='BTC m-l-10'>S </span> &nbsp&nbsp - &nbsp&nbsp; <span class='NEO m-l-10 lead'>5</span>&nbsp&nbsp
                                                                    <a href='add_type.php' data-toggle='tooltip' data-placement='top' title='Edit'>
                                                                    <i class='fa fa-pencil color-muted m-r-5'></i> </a></h5>
                                                                    <h5><span class=' XRP m-l-10'>M </span> &nbsp&nbsp - &nbsp&nbsp; <span class='NEO m-l-10 lead'>8</span></h5>
                                                                    <h5><span class=' XRP m-l-10'>L </span> &nbsp&nbsp - &nbsp&nbsp; <span class='NEO m-l-10 lead'>2</span></h5>
                                                                    <h5><span class=' XRP m-l-10'>XL </span> &nbsp&nbsp - &nbsp&nbsp; <span class='NEO m-l-10 lead'>5</span></h5>
                                                                </div>
                                                                <div class='col-lg-8 text-right'>
                                                                    <img class='mr-3' src='images/avatar/example.jpg' alt='Generic placeholder image'>
                                                                    <img class='mr-3' src='images/avatar/skirt.jpg' alt='Generic placeholder image'>
                                                                    <img class='mr-3' src='images/avatar/3.jpg' alt='Generic placeholder image'>
                                                                    <img class='mr-3' src='images/avatar/1.jpg' alt='Generic placeholder image'>
                                                                    <img class='mr-3' src='images/avatar/1.jpg' alt='Generic placeholder image'>
                                                                    <img class='mr-3' src='images/avatar/1.jpg' alt='Generic placeholder image'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>";
                                        echo "<td id='" . $type['type_id'] . "'>
                                                    <a href='add_type.php?edit_id=" . $type['type_id'] . "' data-toggle='tooltip' data-placement='top' title='Edit'>
                                                    <i class='fa fa-pencil color-muted m-r-5'></i> </a>
                                                                              
                                                    <a class='type_delete ti-trash color-danger' data-toggle='tooltip' data-placement='top' title='Delete'></a>
                                                    <br>

                                                    <button type='button' class='btn my-1 btn-rounded btn-info'>
                                                    <span class='btn-icon-left'><i class='fa fa-plus color-info'></i></span>post
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
                                        <th>Action</th>
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