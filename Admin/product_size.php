 
<?php
    include_once 'layouts/header.php';
    include_once __DIR__. '../controller/productController.php';

    $productController=new productController();
    $sizes=$productController->getProductSize();

    // insert 
    if(isset($_POST['add']))
    {
        $size=$_POST['size'];
        $status=$productController->addProductSize($size);
        if($status)
        {
            // header('location:category.php');
            echo '<script> location.href="product_size.php?status='.$status.'"</script>';
        }
    }

    // get edit data to update
    if(isset($_GET['edit_id']))
    {
        $id=$_GET['edit_id'];
        $productController=new ProductController();
        $size=$productController->getSize($id);
    }

    if(isset($_POST['edit']))
    {
        $size=$_POST['size'];
        $status=$productController->editProductSize($id,$size);
        if($status)
        {
            $message=2;
            echo '<script> location.href="product_size.php?status='.$message.'"</script>';
        }
    }


    // delete
    if(isset($_GET['delete_id']))
    {
        $delete_id=$_GET['delete_id'];
        $result=$productController->deleteProductSize($delete_id);
        if($result)
        {
            $message = 3;
            echo '<script> location.href="product_size.php?status='.$message.'"</script>';

        }
        else{
            echo "You can't delete as it has releated child data";
        }
    }


?>


        <!--**********************************
            Content body start
        ***********************************-->
        
        <div class="content-body">
        <?php
                if(isset($_GET['status']) && $_GET['status'] == 1)
                {
                    echo "<div class='alert alert-success text-success' > New Product Size has been successfully added </div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 2)
                {
                    echo "<div class='alert alert-success' > New Product Size has been successfully updated</div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 3)
                {
                    echo "<div class='alert alert-success' >Product Size has been successfully deleted</div>";
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
                                <?php if(isset($_GET['edit_id'])){                                    
                                    ?>
                                        
                                <h4 class="card-title">Edit Product Size Form</h4>
                                <p>Enter Size</p>
                                <div class="basic-form">
                                    <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="text" name="size" class="form-control" placeholder="Size" value="<?php echo $size['size']; ?>">
                                        </div>
                                        <input type="submit" class="btn gradient-3 mb-2" value="Update" name="edit">
                                    </form>
                                </div>

                                <?php }else{?>

                                <h4 class="card-title">Add Product Size Form</h4>
                                <p>Enter Size</p>
                                <div class="basic-form">
                                    <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="text" name="size" class="form-control" placeholder="Size">
                                        </div>
                                        <input type="submit" class="btn gradient-2 mb-2" value="Enter" name="add">
                                    </form>
                                </div>
                                <?php }?>

                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4>Product Size Table</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Size</th>
                                                <!-- <th>Date</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            $count=1;
                                            foreach($sizes as $size)
                                            {
                                                echo "<tr >";
                                                echo "<th>".$count++."</th>";
                                                echo "<td>" .$size['size']."</td>";                                               
                                                echo "<td id='".$size['size_id']."'>
                                                    <a href='product_size.php?edit_id=".$size['size_id']."' data-toggle='tooltip' data-placement='top' title='Edit'>
                                                    <i class='fa fa-pencil color-muted m-r-5'></i> </a>
                                                                              
                                                    <a href='product_size.php?delete_id=".$size['size_id']."'  onclick=\"return confirm('Are you sure want to delete?');\" ><i class='fa fa-close color-danger'></i></a>
                                                    </td>";

                                                echo "</tr>";
                                            }
                                        ?>
                                        </tbody>
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
