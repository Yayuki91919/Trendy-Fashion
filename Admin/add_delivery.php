<?php 
include('layouts/header.php');
include_once __DIR__.'../controller/locationController.php';
include_once __DIR__.'../controller/feeController.php';

$fee_controller = new FeeController();
$location_controller = new LocationController();
$locations = $location_controller->getLocationList();
$flag = true;
$city = $town = $fee = "";

if(isset($_POST['submit'])){
    $city = trim($_POST['city']);
    $town = trim($_POST['town']);
    $fee = trim($_POST['fee']);
    
    foreach($locations as $local){
        if(($city == $local['city']) && ($town == $local['township'])){
            $flag = false;
            break;
        }
    }
    
    if(!$flag){
        $message = 4;
        echo '<script>location.href="delivery_setting.php?status='.$message.'"</script>';
    } else {
        $result = $location_controller->createNewLocation($city, $town);
        $lastId = $location_controller->getLastInsertId();
        
        $result_fee = $fee_controller->createNewFee($fee, $lastId['last_id']);
        
        if($result && $result_fee){
            $message = 1;
            echo '<script>location.href="delivery_setting.php?status='.$message.'"</script>';
        }
    }
}
?>

<!-- Content body start -->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Delivery Location & Fee</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Fees By Location</h4>
                        <div class="form-validation">

                            <form class="form-valide" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="form-row">
                                    <div class="col-4 m-1">
                                        <input type="text" class="form-control" placeholder="Enter City Name"
                                            value="<?php echo $city ?>" name="city" required>
                                    </div>
                                    <div class="col-4 m-1">
                                        <input type="text" class="form-control" placeholder="Enter Township Name"
                                            value="<?php echo $town ?>" name="town" required>
                                    </div>

                                    <div class="col-8 m-1">
                                        <input type="text" class="form-control" placeholder="Fee-MMK" name="fee"
                                            value="<?php echo $fee ?>" required>
                                    </div>
                                    <div class="col-auto m-1">
                                        <button type="submit" name="submit" class="btn btn-dark mb-2">Add New
                                            Location</button>
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