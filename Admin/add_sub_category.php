 
<?php
    include_once 'layouts/header.php';
    include_once __DIR__. '../controller/categoryController.php';
    include_once __DIR__. '../controller/subController.php';

    $cat_controller=new CategoryController();
    $categories=$cat_controller->getCategories();



    // insert 
    if(isset($_POST['add']))
    {
        $name=$_POST['sub_name'];
        $cat_id=$_POST['cat_id'];
        $status=$sub_controller->addSubCategory($name,$cat_id);
        if($status)
        {
            echo '<script> location.href="sub_category.php?status='.$status.'"</script>';
        }

    }

    //   get edit data to update
    if(isset($_GET['edit_id']))
    {
        $sub_controller = new SubCategoryController();
        $sub_id = $_GET['edit_id'];
        $sub_category = $sub_controller->getSubCategory($sub_id);
    }

    if(isset($_POST['edit']))
    {
        $name=$_POST['brand_name'];
        $cat_id=$_POST['cat_id'];
        $status=$sub_controller->editSubCategory($sub_id,$name,$cat_id);
        if($status)
        {
            $message=2;
            echo '<script> location.href="sub_category.php?status='.$message.'"</script>';
        }
    }


    // delete
    // if(isset($_GET['delete_id']))
    // {
    //     $delete_id=$_GET['delete_id'];
    //     $result=$cat_controller->deleteCategory($delete_id);
    //     if($result)
    //     {
    //         $message = 3;
    //         echo '<script> location.href="category.php?status='.$message.'"</script>';

    //     }
    //     else{
    //         echo "You can't delete as it has releated child data";
    //     }
    // }


?>


        <!--**********************************
            Content body start
        ***********************************-->
        
        <div class="content-body">
            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add New Brand</a></li>
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
                                        
                                <h4 class="card-title">Edit Brand Form</h4>
                                <p>Enter Brand Name</p>
                                <div class="basic-form">
                                    <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="text" name="brand_name" class="form-control" placeholder="Name" value="<?php echo $sub_category['brand_name']; ?>">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <select name="cat_id" value="<?php if(isset($sub_category)) echo $sub_category; ?>" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                <?php
                                                foreach($categories as $category)
                                                {
                                                    if($category['category_id']==$sub_category['category_id']){
                                                ?>
                                                <option value="<?php echo $category['category_id']; ?>" selected><?php echo $category['category_name'];?></option>
                                                <?php }else { ?>
                                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name'];?></option>
                                                <?php
                                                 }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="submit" class="btn btn-dark mb-2" value="Update" name="edit">
                                    </form>
                                </div>

                                <?php }else{?>

                                <h4 class="card-title">Add New Brand Form</h4>
                                <p>Enter Brand Name</p>
                                <div class="basic-form">
                                    <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="text" name="sub_name" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <select name="cat_id" value="<?php if(isset($category)) echo $category; ?>" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                <?php
                                                foreach($categories as $category)
                                                {
                                                ?>
                                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name'];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="submit" class="btn btn-dark mb-2" value="Enter" name="add">
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