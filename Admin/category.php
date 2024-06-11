 
<?php
    include_once 'layouts/header.php';
    include_once __DIR__. '../controller/categoryController.php';

    $cat_controller=new CategoryController();
    $categories=$cat_controller->getCategories();

    // insert 
    if(isset($_POST['add']))
    {
        $name=$_POST['name'];
        $status=$cat_controller->addCategory($name);
        if($status)
        {
            // header('location:category.php');
            echo '<script> location.href="category.php?status='.$status.'"</script>';
        }

    }

    // get edit data to update
    if(isset($_GET['edit_id']))
    {
        $id=$_GET['edit_id'];
        $cat_controller=new CategoryController();
        $category=$cat_controller->getCategory($id);
    }

    if(isset($_POST['edit']))
    {
        $name=$_POST['name'];
        $status=$cat_controller->editCategory($id,$name);
        if($status)
        {
            $message=2;
            echo '<script> location.href="category.php?status='.$message.'"</script>';
        }
    }


    // delete
    if(isset($_GET['delete_id']))
    {
        $delete_id=$_GET['delete_id'];
        $result=$cat_controller->deleteCategory($delete_id);
        if($result)
        {
            $message = 3;
            echo '<script> location.href="category.php?status='.$message.'"</script>';

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
                    echo "<div class='alert alert-success text-success' > New Category has been successfully added </div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 2)
                {
                    echo "<div class='alert alert-success' > New Category has been successfully updated</div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 3)
                {
                    echo "<div class='alert alert-success' >Category has been successfully deleted</div>";
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
                                        
                                <h4 class="card-title">Edit Category Form</h4>
                                <p>Enter Category Name</p>
                                <div class="basic-form">
                                    <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $category['category_name']; ?>">
                                        </div>
                                        <input type="submit" class="btn btn-dark mb-2" value="Update" name="edit">
                                    </form>
                                </div>

                                <?php }else{?>

                                <h4 class="card-title">Add Category Form</h4>
                                <p>Enter Category Name</p>
                                <div class="basic-form">
                                    <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                        <input type="submit" class="btn btn-dark mb-2" value="Enter" name="add">
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
                                    <h4>Table Striped</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <!-- <th>Date</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <th>1</th>
                                                <td>Kolor Tea Shirt For Man</td>
                                                </td>
                                                <td>January 22</td>
                                                <td><span>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr> -->
                                            <?php
                                            $count=1;
                                            foreach($categories as $category)
                                            {
                                                echo "<tr >";
                                                echo "<th>".$count++."</th>";
                                                echo "<td>" .$category['category_name']."</td>";                                               
                                                echo "<td><span>
                                                    <a href='category.php?edit_id=".$category['category_id']."' data-toggle='tooltip' data-placement='top' title='Edit'>
                                                    <i class='fa fa-pencil color-muted m-r-5'></i> </a>
                                                
                                                    <a href='category.php?delete_id=".$category['category_id']."' data-toggle='tooltip' data-placement='top' title='Delete' onclick=''>
                                                    <i class='fa fa-close color-danger'></i></a></span>
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


<?php
    include_once 'layouts/footer.php';
?>