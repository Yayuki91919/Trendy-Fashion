 <?php
    include_once 'layouts/header.php';
    include_once __DIR__ . '../controller/productController.php';

    $productController = new productController();
    $colors = $productController->getProductColor();

    // insert 
    if (isset($_POST['add'])) {
        $color = $_POST['color'];
        $status = $productController->addProductColor($color);
        if ($status) {
            // header('location:category.php');
            echo '<script> location.href="product_color.php?status=' . $status . '"</script>';
        }
    }

    // get edit data to update
    if (isset($_GET['edit_id'])) {
        $id = $_GET['edit_id'];
        $productController = new ProductController();
        $color = $productController->getColor($id);
    }

    if (isset($_POST['edit'])) {
        $color = $_POST['color'];
        $status = $productController->editProductColor($id, $color);
        if ($status) {
            $message = 2;
            echo '<script> location.href="product_color.php?status=' . $message . '"</script>';
        }
    }


    // delete
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $result = $productController->deleteProductColor($delete_id);
        if ($result) {
            $message = 3;
            echo '<script> location.href="product_color.php?status=' . $message . '"</script>';
        } else {
            echo "You can't delete as it has releated child data";
        }
    }


    ?>


 <!--**********************************
            Content body start
        ***********************************-->

 <div class="content-body">
     <?php
        if (isset($_GET['status']) && $_GET['status'] == 1) {
            echo "<div class='alert alert-success text-success' > New Product Color has been successfully added </div>";
        } elseif (isset($_GET['status']) && $_GET['status'] == 2) {
            echo "<div class='alert alert-success' > New Product Color has been successfully updated</div>";
        } elseif (isset($_GET['status']) && $_GET['status'] == 3) {
            echo "<div class='alert alert-success' >Product Color has been successfully deleted</div>";
        }

        ?>
     <div class="row page-titles mx-0">
         <div class="col p-md-0">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                 <li class="breadcrumb-item active"><a href="javascript:void(0)">Category</a></li>
             </ol>
         </div>
     </div>
     <!-- row -->

     <div class="container-fluid">
         <div class="row">
             <div class="col-lg-6">
                 <div class="card">
                     <div class="card-body">
                         <?php if (isset($_GET['edit_id'])) {
                            ?>

                             <h4 class="card-title">Edit Product Color Form</h4>
                             <p>Enter Color</p>
                             <div class="basic-form">
                                 <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                     <div class="form-group mx-sm-3 mb-2">
                                         <input type="text" name="color" class="form-control" placeholder="Enter Color" value="<?php echo $color['color']; ?>">
                                     </div>
                                     <input type="submit" class="btn gradient-3 mb-2" value="Update" name="edit">
                                 </form>
                             </div>

                         <?php } else { ?>

                             <h4 class="card-title">Add Product Color Form</h4>
                             <p>Enter Color</p>
                             <div class="basic-form">
                                 <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                     <div class="form-group mx-sm-3 mb-2">
                                         <input type="text" name="color" class="form-control" placeholder="Enter Color">
                                     </div>
                                     <input type="submit" class="btn gradient-2 mb-2" value="Enter" name="add">
                                 </form>
                             </div>
                         <?php } ?>

                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
             <div class="table-responsive">
                 <table class="table table-striped table-bordered zero-configuration">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Product color</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $count = 1;
                            foreach ($colors as $color) {
                                echo "<tr >";
                                echo "<th>" . $count++ . "</th>";
                                echo "<td>" . $color['color'] . "</td>";
                                echo "<td id='" . $color['color_id'] . "'>
                                        <a href='product_color.php?edit_id=" . $color['color_id'] . "' data-toggle='tooltip' data-placement='top' title='Edit'>
                                        <i class='fa fa-pencil color-muted m-r-5'></i> </a>
                                                                    
                                        <a href='product_color.php?delete_id=" . $color['color_id'] . "'  onclick=\"return confirm('Are you sure want to delete?');\" ><i class='fa fa-close color-danger'></i></a>
                                    
                                        </td>";


                                echo "</tr>";
                            }
                            ?>
                     </tbody>
                     <tfoot>
                         <tr>
                             <th>No</th>
                             <th>Product color</th>
                             <th>Action</th>
                         </tr>
                     </tfoot>
                 </table>
             </div>
             </div>
         </div>
         <div class="row">

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