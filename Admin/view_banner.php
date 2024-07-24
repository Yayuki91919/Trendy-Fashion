<?php 
session_start();
include('layouts/header.php');
include_once __DIR__ . '../controller/bannerController.php';
$banner_controller = new BannerController();
$errors = [];

if (isset($_GET['banner_id'])) {
    $id = $_GET['banner_id'];
    $_SESSION['banner_id'] = $id;
}
if (isset($_SESSION['banner_id'])) {
    $id = $_SESSION['banner_id'];
}
$banner = $banner_controller->getBanner($id);
$img_array = explode(",", $banner['image']);

if (isset($_GET['delete_img'])) {
    $img = $_GET['delete_img'];
    $valueToDelete = $img;
    $count = count($img_array);
    if ($count != 1) {
        $key = array_search($valueToDelete, $img_array);
        if ($key !== false) {
            unset($img_array[$key]);
            $img_array = array_values($img_array);
        }
        $images = implode(',', $img_array);
        $result = $banner_controller->editBannerImage($id, $images);
        if ($result) {
            // Delete the image file from the directory
            $file_path = __DIR__ . '/images/banner_photo/' . $img;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $message = 3;
            echo '<script>location.href="view_banner.php?status=' . $message . '"</script>';
        }
    } else {
        $message = 2;
        echo '<script>location.href="view_banner.php?status=' . $message . '"</script>';
    }
}

function getUniqueFileName($upload_dir, $file_name) {
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_base_name = pathinfo($file_name, PATHINFO_FILENAME);
    $new_file_name = $file_name;
    $counter = 1;
    while (file_exists($upload_dir . $new_file_name)) {
        $new_file_name = $file_base_name . '_' . time() . '_' . $counter . '.' . $file_ext;
        $counter++;
    }
    return $new_file_name;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $files = $_FILES['files'];
    foreach ($files['tmp_name'] as $key => $tmp_name) {
        $image_info = getimagesize($tmp_name);
        if ($image_info) {
            $width = $image_info[0];
            $height = $image_info[1];
            if ($width != 1280 || $height != 720) {
                $errors['files'] = "Image {$files['name'][$key]} does not have the required dimensions of 1280x720.";
            }
        } else {
            $errors['files'] = "File {$files['name'][$key]} is not a valid image.";
        }
    }

    if (empty($errors)) {
        $upload_dir = __DIR__ . '/images/banner_photo/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $uploaded_files = [];
        foreach ($files['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($files['name'][$key]);
            $target_file = $upload_dir . $file_name;

            // Rename the file if it already exists
            if (file_exists($target_file)) {
                $file_name = getUniqueFileName($upload_dir, $file_name);
                $target_file = $upload_dir . $file_name;
            }

            if (move_uploaded_file($tmp_name, $target_file)) {
                $uploaded_files[] = $file_name;
            }
        }

        $new_images = implode(',', $uploaded_files);
        $images = $banner['image'] . ',' . $new_images; 
        $result = $banner_controller->editBannerImage($id, $images);
        if ($result) {
            $message = 3;
            echo '<script>location.href="view_banner.php?status=' . $message . '"</script>';
        }
    } else {
        $message = 4;
        echo '<script>location.href="view_banner.php?status=' . $message . '"</script>';
    }
}
?>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete?");
}
</script>
<link rel="stylesheet" href="css/view_banner.css">
<div class="content-body">
    <?php
    if (isset($_GET['status']) && $_GET['status'] == 1) {
        echo "<div class='alert alert-success text-success'> New Banner has been successfully added. </div>";
    } elseif (isset($_GET['status']) && $_GET['status'] == 2) {
        echo "<div class='alert alert-danger'> You can't delete the last image.</div>";
    } elseif (isset($_GET['status']) && $_GET['status'] == 3) {
        echo "<div class='alert alert-success'>Banner has been successfully updated.</div>";
    } elseif (isset($_GET['status']) && $_GET['status'] == 4) {
        echo "<div class='alert alert-danger'>Image upload failed. (Image size must have width-1280px & height-720px)</div>";
    }
    ?>
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Banner Images</a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-10">
                                <h4 class="card-title">Banner Images</h4>
                            </div>
                            <div class="col-sm-1"><a href="banner.php" class="btn mb-1 btn-rounded gradient-4">Back</a></div>
                        </div>
                        <div class="row">
                            <?php foreach ($img_array as $img) { ?>
                            <div class="col-md-4">
                                <div class="image-container" style="position: relative;">
                                    <a href="view_banner.php?delete_img=<?php echo $img ?>" class="ti-trash delete-icon"
                                        data-toggle="tooltip" data-placement="top" title="Delete"
                                        onclick="return confirmDelete()"></a>
                                    <img src="images/banner_photo/<?php echo $img ?>" class="thumbnail"
                                        data-name="<?php echo $img ?>">
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div id="fullscreenModal" class="modal">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="fullImage">
                            <div id="imageName"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-sm-12">
                            <h4 class="card-title">Add More Images</h4>
                        </div> 
                        <div class="col-md-12">
                            <form id="bannerForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Banner Images</label>
                                    <div class="col-sm-9 mx-3">
                                        <label class="custom-file-label" for="files">Choose Files</label>
                                        <input type="file" class="custom-file-input" id="files" name="files[]" multiple
                                            onchange="previewFiles()" required>
                                        <div class="img-preview" id="imgPreview"></div>
                                        <?php if (!empty($errors['files'])): ?>
                                        <div class="error"><?php echo $errors['files']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10"></div>
                                    <div class="col-lg-1 m-2">
                                        <button type="submit" name="submit" class="btn mb-1 btn-rounded gradient-2">Submit</button>
                                    </div>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<script>
function previewFiles() {
    var preview = document.getElementById('imgPreview');
    var files = document.getElementById('files').files;
    preview.innerHTML = '';

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if (file.type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.title = theFile.name;
                    preview.appendChild(img);
                };
            })(file);
            reader.readAsDataURL(file);
        }
    }
}
</script>
<?php include('layouts/footer.php'); ?>
