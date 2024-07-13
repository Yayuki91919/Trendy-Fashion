<?php
include('layouts/header.php');
include_once __DIR__. '../controller/shopinfoController.php';
$shop_id=$name=$phone=$viber=$address=$open=$close="";
$shop_controller = new ShopInfoController();
if(isset($_GET['shop_id'])){
    $shop_id=$_GET['shop_id'];
    $shop = $shop_controller->getShopById($shop_id);
    $name=$shop['name'];
    $phone=$shop['phone'];
    $viber=$shop['viber'];
    $address=$shop['address'];
    $open=$shop['open_time'];
    $close=$shop['close_time'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shop_id=$_POST['shop_id'];
    $name=$_POST['name'];
    $phone= $_POST['phone'];
    $viber=$_POST['viber'];
    $address=$_POST['address'];
    $open=$_POST['open'];
    $close=$_POST['close'];
    $result = $shop_controller->editShopInfo($shop_id,$name,$phone,$viber,$address,$open,$close);
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
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class=" mb-3">Update Shop Information</h2>
                        <div class="form-validation">
                            <form class="form-valide" action="edit_shopinfo.php" method="post">
                                <input type="hidden" name='shop_id' value="<?php echo $shop_id ?>">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Shop Name<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="name"
                                            value="<?php echo $name ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Phone Number <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="phone"
                                            value="<?php echo $phone ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Viber Phone<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="viber"
                                            value="<?php echo $viber ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Shop Address <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" 
                                            name="address" value="<?php echo $address ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Opening Time<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                         <div class="input-group clockpicker" data-placement="top" data-align="top"
                                            data-autoclose="true">
                                            <input type="text" class="form-control" name="open" value="<?php echo $open ?>"> <span
                                                class="input-group-append"><span class="input-group-text"><i
                                                        class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Closing Time<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <div class="input-group clockpicker" data-placement="top" data-align="top"
                                            data-autoclose="true">
                                            <input type="text" class="form-control" name="close" value="<?php echo $close ?>"> <span
                                                class="input-group-append"><span class="input-group-text"><i
                                                        class="fa fa-clock-o"></i></span></span>
                                        </div>
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



<?php include('layouts/footer.php'); ?>