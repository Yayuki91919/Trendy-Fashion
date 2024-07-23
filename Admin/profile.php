<?php
include('layouts/header.php');
include_once __DIR__ . '../controller/profileController.php'; 
$profile_controller = new ProfileController();
$profiles = $profile_controller->getProfile();

if (!empty($profiles)) {
    foreach ($profiles as $profile) {
        $email = $profile['email'];
        $username = $profile['username'];
        $image = $profile['image'];
        $password = $profile['password'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['old'])) {
        if ($_POST['old'] == $password) {
            $message = 'correct';
            echo '<script>location.href="profile.php?status=' . $message . '"</script>';
        } else {
            $message = 'incorrect';
            echo '<script>location.href="profile.php?status=' . $message . '"</script>';
        }
    } else {
        // Handle profile update
        $new_username = $_POST['username'];
        $new_email = $_POST['email'];
        $new_password = $_POST['password'];

        // Handle file upload
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $file = $_FILES['file'];
            $upload_dir = 'images/profile/';
            $new_filename = basename($file['name']);
            $upload_file = $upload_dir . $new_filename;

            // Delete old image if it exists
            if ($image && file_exists($upload_dir . $image)) {
                unlink($upload_dir . $image);
            }

            if (move_uploaded_file($file['tmp_name'], $upload_file)) {
                $new_image = $new_filename;
            } else {
                $new_image = $image; // Keep old image if upload fails
            }
        } else {
            $new_image = $image; // Keep old image if no new image is uploaded
        }

        // Update profile in database (implement this in your controller)
        $result=$profile_controller->editProfile($new_email,$new_password,$new_username,$new_image);;
        if($result)
        {
            $message = 2;
            echo '<script>location.href="profile.php?status=' . $message . '"</script>';
        }
    }
}
?>
<style>
    .img-preview img {
        max-width: 100%;
        height: auto;
        display: block;
        margin-top: 10px;
    }
</style>
<!-- Content body start -->
<div class="content-body">
    <?php
if (isset($_GET['status']) && $_GET['status'] == 2) {
    echo "<div class='alert alert-success'> Profile has been successfully updated.</div>";
} elseif (isset($_GET['status']) && $_GET['status'] == 'incorrect') {
    echo "<div class='alert alert-danger'> Incorrect Password.</div>";
}
?>
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Admin Panel</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center mb-4">
                            <img class="mr-3" src="images/profile/<?php echo $profile['image']; ?>" width="80"
                                height="80" alt="">
                            <div class="media-body">
                                <h3 class="mb-0"><?php echo $profile['username']; ?> &nbsp;<a
                                        href="profile.php?edit=Edit" data-toggle="tooltip" data-placement="top"
                                        title="Edit Profile"><i class="fa fa-pencil color-muted m-r-5"></i> </a></h3>
                                <p class="text-muted mb-0"><?php echo $profile['email']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if((isset($_GET['edit']) || (isset($_GET['status']) && $_GET['status'] == 'incorrect'))) { ?>
            <div class="col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation" id="phoneForm">
                            <form class="form-valide" action="profile.php" method="post">
                                <!-- Updated form action -->
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-password">Old Password</label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="val-password" name="old"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn gradient-2">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } elseif (isset($_GET['status']) && $_GET['status'] == 'correct') { ?>
            <div class="col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation" id="phoneForm">
                            <form class="form-valide" action="profile.php" method="post" enctype="multipart/form-data">
                                <!-- Updated form action -->
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Username</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="username"
                                            value="<?php echo htmlspecialchars($username); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Email</label>
                                    <div class="col-lg-6">
                                        <input type="email" class="form-control" id="val-email" name="email"
                                            value="<?php echo htmlspecialchars($email); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-password">Password</label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="val-password" name="password"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-image">Image</label>
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="files" name="file"
                                                onchange="previewFiles()">
                                            <label class="custom-file-label" for="files">Choose Files</label>
                                        </div>
                                        <div class="img-preview" id="imgPreview"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn gradient-2">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!-- Content body end -->
<script>
    function previewFiles() {
        const preview = document.getElementById('imgPreview');
        const files = document.getElementById('files').files;

        preview.innerHTML = ''; // Clear any existing preview images

        if (files) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function(event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    preview.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        }
    }
</script>
<?php include('layouts/footer.php'); ?>
