 
<?php
    include_once 'layouts/header.php';
    include_once __DIR__. '../controller/SubController.php';

    $sub_controller=new SubCategoryController();
    $sub_categories=$sub_controller->getSubCategories();

    if(isset($_GET['delete_sid']))
    {
        $sid=$_GET['delete_sid'];
        $status=$sub_controller->deleteSubCategory($sid);
        if($status)
        {
            $status=3;
            echo '<script> location.href="sub_category.php?status='.$status.'"</script>';
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
                    echo "<div class='alert alert-success text-success' > New Brand has been added </div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 2)
                {
                    echo "<div class='alert alert-success' > New Brand has been successfully updated</div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 3)
                {
                    echo "<div class='alert alert-success' >Brand has been successfully deleted</div>";
                }

        ?>
            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Subcategory</a></li>
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
                                            <h4 class="card-title">Brand Lists</h4>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="add_sub_category.php" class="btn mb-1 gradient-2">
                                            New Brand <span class="btn-icon-right">
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
                                                <th>Brand</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count=1;
                                            foreach( $sub_categories as $sub)
                                            {
                                                echo "<tr >";
                                                echo "<th>".$count++."</th>";
                                                echo "<td>" .$sub['brand_name']."</td>";
                                                echo "<td>" .$sub['category_name']."</td>";                                                
                                                echo "<td id='".$sub['sub_id']."'>
                                                    <a href='add_sub_category.php?edit_id=".$sub['sub_id']."' data-toggle='tooltip' data-placement='top' title='Edit'>
                                                    <i class='fa fa-pencil color-muted m-r-5'></i> </a>
                                                                              
                                                    <a href='sub_category.php?delete_sid=" . $sub['sub_id'] . "' class='ti-trash color-danger' onclick=\"return confirm('Are you sure to delete?');\" data-toggle='tooltip' data-placement='top' title='Delete'>
                                                    </a>
                                                    </td>";

                                                echo "</tr>";
                                            }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Brand</th>
                                                <th>Category</th>
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