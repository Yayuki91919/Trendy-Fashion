<?php 
    include('layouts/header.php');
    include_once __DIR__. '../controller/bannerController.php';
    include_once __DIR__. '../controller/subController.php';
    $banner_controller=new BannerController();
    $banners=$banner_controller->getBanners();
    $sub_controller = new SubCategoryController;
    if(isset($_GET['delete_id'])){
       
        $delete_id=$_GET['delete_id'];
        $result=$banner_controller->deleteBanner($delete_id);
        if($result)
        {
            $message = 3;
            echo '<script> location.href="banner.php?status='.$message.'"</script>';
        }
    } 
?>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete?");
}
</script>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <?php
                if(isset($_GET['status']) && $_GET['status'] == 1)
                {
                    echo "<div class='alert alert-success text-success' > New Banner has been successfully added. </div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 2)
                {
                    echo "<div class='alert alert-success' > New Bannner has been successfully updated.</div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 3)
                {
                    echo "<div class='alert alert-success' >Banner has been successfully deleted.</div>";
                }

     ?>

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Banner</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-9">
                                <h4 class="card-title">Banner Lists</h4>
                            </div>
                            <div class="col-sm-2"><a href="new_banner.php" class="btn mb-1 btn-rounded gradient-2">+ New
                                    Banner</a></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered zero-configuration table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Brand Name</th>
                                        <th>Action</th>
                                        <th>View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $count=1;
                                            if(isset($banners)){
                                            foreach($banners as $banner){
                                                $sub_id=$banner['sub_id'];
                                                $sub=$sub_controller->getSubCategory($sub_id);
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <?php
                                            $my_array = explode(",", $banner['image']);
                                            $random_key = array_rand($my_array);
                                            $random_value = $my_array[$random_key];
                                        ?>

                                        <td><img src="images/banner_photo/<?php echo $random_value ?>" width="100"
                                                alt=""></td>
                                        <td><?php echo $banner['title'] ?></td>
                                        <td><?php echo $sub['brand_name'] ?></td>
                                        <td><a href="edit_banner.php?banner_id=<?php echo $banner['banner_id']?>"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-pencil color-muted m-r-5"></i> </a>

                                            <a href="banner.php?delete_id=<?php echo $banner['banner_id']?>"
                                                class="ti-trash" data-toggle="tooltip" data-placement="top"
                                                title="Delete" onclick="return confirmDelete()">
                                        </td>
                                        <td><a href="view_banner.php?banner_id=<?php echo $banner['banner_id'] ?>"
                                                class="btn mb-1 btn-rounded gradient-7">View More</a></td>
                                    </tr>
                                    <?php }} ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Brand Name</th>
                                        <th>Action</th>
                                        <th>View Details</th>
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


<?php include('layouts/footer.php'); ?>