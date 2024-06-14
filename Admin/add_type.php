 
<?php
    include_once 'layouts/header.php';
    include_once __DIR__. '../controller/typeController.php';

    $type_controller = new TypeController;


    // insert 
    if(isset($_POST['add']))
    {
        $name=$_POST['name'];

        $status=$type_controller->addType($name);
        if($status)
        {
            echo '<script> location.href="product_type.php?status='.$status.'"</script>';
        }

    }

    //   get edit data to update
    if(isset($_GET['edit_id']))
    {
        $type_id = $_GET['edit_id'];
        $type = $type_controller->getType($type_id);
    }

    if(isset($_POST['edit']))
    {
        $name=$_POST['name'];
        $status=$type_controller->editType($type_id,$name);
        if($status)
        {
            $message=2;
            echo '<script> location.href="product_type.php?status='.$status.'"</script>';
        }
    }


?>


        <!--**********************************
            Content body start
        ***********************************-->
        
        <div class="content-body">
            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product Type</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <?php if(isset($_GET['edit_id'])){                                    
                                    ?>
                                        
                                <h4 class="card-title">Product Type Form</h4>
                                <p>Enter Product Type Name</p>
                                <div class="basic-form">
                                    <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $type['name']; ?>">
                                        </div>
                                        <input type="submit" class="btn gradient-3 mb-2" value="Update" name="edit">
                                    </form>
                                </div>

                                <?php }else{?>

                                <h4 class="card-title">Product Type Form</h4>
                                <p>Enter Product Type Name</p>
                                <div class="basic-form">
                                    <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                        <input type="submit" class="btn gradient-3 mb-2" value="Add" name="add">
                                    </form>
                                </div>

                                <?php }?>
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