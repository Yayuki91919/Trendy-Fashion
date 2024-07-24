<?php 
include('layouts/header.php');
include_once __DIR__ . '../controller/bannerController.php';
include_once __DIR__ . '../controller/subController.php';
$banner_controller = new BannerController();
$banners = $banner_controller->getBanners();
$sub_controller = new SubCategoryController();

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Fetch the banner information before deleting
    $banner = $banner_controller->getBannerById($delete_id);
    if ($banner) {
        // Extract the image file names
        $image_files = explode(",", $banner['image']);
        
        // Delete the banner from the database
        $result = $banner_controller->deleteBanner($delete_id);
        
        if ($result) {
            // Delete the image files from the server
            foreach ($image_files as $image_file) {
                $file_path = __DIR__ . "/images/banner_photo/" . $image_file;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $message = 3;
            echo '<script> location.href="banner.php?status=' . $message . '"</script>';
        }
    }
}
?>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete?");
}
</script>
<style>
/* Fullscreen Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 100;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.9);
}

.modal-content {
    margin: auto;
    display: block;
    width: 90%;
    max-width: 700px;
}

#imageName {
    color: white;
    font-size: 18px;
    text-align: center;
    padding: 10px 0;
}

/* Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

@media screen and (max-width: 700px) {
    .modal-content {
        width: 100%;
        /* Make modal image responsive */
    }

    .close {
        font-size: 30px;
        /* Adjust close button size */
        right: 15px;
    }

    #imageName {
        font-size: 16px;
        /* Adjust font size for smaller screens */
    }
}
</style>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <?php
    if (isset($_GET['status']) && $_GET['status'] == 1) {
        echo "<div class='alert alert-success text-success' > New Banner has been successfully added. </div>";
    } elseif (isset($_GET['status']) && $_GET['status'] == 2) {
        echo "<div class='alert alert-success' > New Bannner has been successfully updated.</div>";
    } elseif (isset($_GET['status']) && $_GET['status'] == 3) {
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

                                        <td><img class="thumbnail" src="images/banner_photo/<?php echo $random_value ?>"
                                                width="100" alt="" data-name="<?php echo $random_value ?>">
                                            <div id="fullscreenModal" class="modal">
                                                <span class="close">&times;</span>
                                                <img class="modal-content" id="fullImage">
                                                <div id="imageName"></div>
                                            </div>
                                        </td>
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

<script>
var modal = document.getElementById("fullscreenModal");
var modalImg = document.getElementById("fullImage");
var captionText = document.getElementById("imageName");
var thumbnails = document.getElementsByClassName("thumbnail");

for (let i = 0; i < thumbnails.length; i++) {
    thumbnails[i].onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.getAttribute("data-name");
    }
}

var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
    modal.style.display = "none";
}

modal.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<?php include('layouts/footer.php'); ?>
