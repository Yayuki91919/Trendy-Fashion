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
    if (isset($_GET['delete_tid'])) {
        $delete_id = $_GET['delete_tid'];
        $status = $type_controller->deleteType($delete_id);
        if ($status) {
            $status=3;
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
                                     <h4 class="card-title">Product Type Lists</h4>
                                 </div>
                                 <div class="col-md-2">
                                     <a href="add_type.php" class="btn mb-1 gradient-2">
                                         New Product Type <span class="btn-icon-right">
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
                                         <th>Product Type</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        $count = 1;
                                        foreach ($types as $type) {
                                            echo "<tr >";
                                            echo "<th>" . $count++ . "</th>";
                                            echo "<td>" . $type['name'] . "</td>";
                                            echo "<td id='" . $type['type_id'] . "'>
                                                        <a href='add_type.php?edit_id=" . $type['type_id'] . "' data-toggle='tooltip' data-placement='top' title='Edit'>
                                                            <i class='fa fa-pencil color-muted m-r-5'></i>
                                                        </a>
                                                                                    
                                                        <a href='product_type.php?delete_tid=" . $type['type_id'] . "' class='ti-trash color-danger' onclick=\"return confirm('Are you sure to delete?');\" data-toggle='tooltip' data-placement='top' title='Delete'>
                                                        </a>
                                                    </td>";


                                            echo "</tr>";
                                        }
                                        ?>
                                 </tbody>
                                 <tfoot>
                                     <tr>
                                         <th>No</th>
                                         <th>Product Type</th>
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