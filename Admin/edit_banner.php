<?php 
    include('layouts/header.php');
    include_once __DIR__. '../controller/bannerController.php';
    include_once __DIR__. '../controller/subController.php';
    $sub_controller = new SubCategoryController();
    $banner_controller = new BannerController();
    $errors = [];
    $success = '';
    $sub = $title = '';



    if (isset($_GET['banner_id'])) {
        $banner_id = $_GET['banner_id'];
        $banner = $banner_controller->getBanner($banner_id);
        $sub_value = $sub_controller->getSubCategory($banner['sub_id']);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sub = $_POST['sub'];
        $title = $_POST['title'];
        $banner_id = $_POST['banner_id'];
        $banner = $banner_controller->getBanner($banner_id);
        $sub_value = $sub_controller->getSubCategory($banner['sub_id']);

        // Server-side validation
        if ($sub == 0) {
            $errors['brand'] = "Please select a brand name.";
        }

        if (empty($title)) {
            $errors['title'] = "Title is required.";
        }

        if (empty($errors)) {
            $result = $banner_controller->editBanner($banner_id, $title, $sub);
            if ($result) {
                $message = 2;
                echo '<script>location.href="banner.php?status='.$message.'"</script>';
            }
        }
    }
?>
<style>
.img-preview {
    display: flex;
    flex-wrap: wrap;
}

.img-preview img {
    max-width: 150px;
    margin: 10px;
    border: 1px solid #ddd;
    padding: 5px;
    background: #fff;
}

.error {
    color: red;
    font-size: 0.9em;
}
</style>
<!--**********************************
            Content body start
        ***********************************-->
<!-- Content body start -->
<div class="content-body">
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
                        <h4 class="card-title">Update Banner</h4>
                        <div class="basic-form">
                            <form id="bannerForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                <?php if (isset($banner_id)) { ?>
                                <div class="form-group row">
                                    <input type="hidden" name="banner_id" value="<?php echo $banner_id; ?>">
                                    <label class="col-sm-2 col-form-label">Brand Name</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="val-skill" name="sub" required>
                                            <option value="<?php echo $banner['sub_id'] ?>"><?php echo $sub_value['brand_name'] ?></option>
                                            <?php 
                                            $subs = $sub_controller->getSubCategories();
                                            foreach ($subs as $s) { ?>
                                            <option value="<?php echo $s['sub_id']; ?>"><?php echo $s['brand_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($errors['brand'])): ?>
                                        <div class="error"><?php echo $errors['brand']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Banner's Title" value="<?php echo $banner['title'] ?>" name="title" required>
                                        <?php if (isset($errors['title'])): ?>
                                        <div class="error"><?php echo $errors['title']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-1 m-2">
                                        <button type="submit" name="submit" class="btn btn-dark">Submit</button>
                                    </div>
                                    <div class="col-lg-1 m-2">
                                        <a href="banner.php" class="btn btn-primary">Back</a>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Brand Name</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="val-skill" name="sub" required>
                                            <option value="0">Choose Brand</option>
                                            <?php 
                                            $subs = $sub_controller->getSubCategories();
                                            foreach ($subs as $s) { ?>
                                            <option value="<?php echo $s['sub_id']; ?>"><?php echo $s['brand_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($errors['brand'])): ?>
                                        <div class="error"><?php echo $errors['brand']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Banner's Title" name="title" required>
                                        <?php if (isset($errors['title'])): ?>
                                        <div class="error"><?php echo $errors['title']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-lg-1 m-2">
                                        <button type="submit" name="submit" class="btn btn-dark">Submit</button>
                                    </div>
                                    <div class="col-lg-1 m-2">
                                        <a href="banner.php" class="btn btn-primary">Back</a>
                                    </div>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!-- Content body end -->

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

// Client-side validation
document.getElementById('bannerForm').addEventListener('submit', function(event) {
    var form = this;
    var isValid = true;
    var errorMsg = '';

    var sub = form.querySelector('select[name="sub"]').value;
    var title = form.querySelector('input[name="title"]').value;

    if (sub == 0) {
        isValid = false;
        errorMsg += 'Please select a brand name.\n';
    }

    if (title.trim() === '') {
        isValid = false;
        errorMsg += 'Title is required.\n';
    }

    if (!isValid) {
        event.preventDefault();
        alert(errorMsg);
    }
});
</script>
<?php include('layouts/footer.php'); ?>
