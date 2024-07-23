<?php
include('layouts/header.php');
include_once __DIR__ . '../controller/socialController.php'; // Fixed the path
$social_controller = new SocialController();
$fb = $tiktok = $insta = "";
$social = $social_controller->getSocial();

if (!empty($social)) {
    foreach ($social as $so) {
        $fb = $so['fb'];
        $tiktok = $so['tiktok'];
        $insta = $so['insta'];
        $phone=$so['phone'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fb = $_POST['fb'];
    $tiktok = $_POST['tiktok'];
    $insta = $_POST['insta'];
    $phone = $_POST['phone'];
    $result = $social_controller->editSocial($fb, $tiktok, $insta,$phone);
    if ($result) {
        $message = 2;
        echo '<script>location.href="social.php?status=' . $message . '"</script>';
    }
}
?>

<!-- Content body start -->
<div class="content-body">
<?php
if (isset($_GET['status']) && $_GET['status'] == 2) {
    echo "<div class='alert alert-success'> Social Information has been successfully updated.</div>";
}
?>
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Shop Social Information</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3">Update Shop Social Information</h3>
                        <div class="form-validation" id="phoneForm">
                            <form class="form-valide" action="social.php" method="post"> <!-- Updated form action -->
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Facebook Link<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="fb" value="<?php echo $fb; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">TikTok<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="tiktok" value="<?php echo $tiktok; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Instagram<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="insta" value="<?php echo $insta; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Phone<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
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
        </div>
    </div>
    <!-- #/ container -->
</div>
<!-- Content body end -->
<script>
    document.getElementById('phoneForm').addEventListener('submit', function(e) {
    var phoneInput = document.getElementById('phone').value;
    if (!validateMyanmarPhone(phoneInput)) {
        e.preventDefault();
        alert('Please enter a valid Myanmar phone number.');
    }
});

function validateMyanmarPhone(phone) {
    var myanmarPhoneRegex = /^(09|\+?959)\d{7,9}$/;
    return myanmarPhoneRegex.test(phone);
}
</script>
<?php include('layouts/footer.php'); ?>
