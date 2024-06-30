<?php
include('layouts/header.php');
include_once __DIR__. '../controller/shopinfoController.php';
$shop_controller = new ShopInfoController();
$shop_info = $shop_controller->getShopInfo();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = 1; // Set the correct ID here
    $phone= $_POST['phone'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $map_link=$_POST['code'];
    $fb=$_POST['fb'];
    $twt=$_POST['twitter'];
    $insta=$_POST['insta'];

    $result = $shop_controller->editShopInfo($id,$phone,$email,$address,$map_link,$fb,$twt,$insta);
    if ($result) {
        $message = 2;
        echo '<script>location.href="shopinfo.php?status='.$message.'"</script>';
    }
}
?>

<!-- Content body start -->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Shop Information</a></li>
            </ol>
        </div>
    </div>
    <?php
            if (isset($_GET['status']) && $_GET['status'] == 2) {
                echo "<div class='alert alert-success text-success'> Information Are Successfully Updated. </div>";
            }
    ?>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class=" mb-3">Shop Information</h3>
                        <div class="form-validation">
                            <form class="form-valide" action="shopinfo.php" method="post">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username" required>Phone Number <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="phone"
                                            value="<?php echo $shop_info['phone'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Email Address <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="email" class="form-control" id="val-username" name="email"
                                            value="<?php echo $shop_info['email'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Shop Address <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="address"
                                            value="<?php echo $shop_info['address'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Location Embed Code <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="code"
                                            value="<?php echo $shop_info['map_link'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Facebook link <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="fb"
                                            value="<?php echo $shop_info['fb_link'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Twitter Link<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="twitter"
                                            value="<?php echo $shop_info['twitter_link'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Instagram Link <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="insta"
                                            value="<?php echo $shop_info['insta_link'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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



<?php include('layouts/footer.php'); ?>