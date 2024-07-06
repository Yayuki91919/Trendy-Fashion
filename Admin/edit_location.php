<?php 
include('layouts/header.php');
include_once __DIR__.'../controller/locationController.php';
include_once __DIR__.'../controller/feeController.php';

$fee_controller = new FeeController();
$location_controller = new LocationController();
$locations = $location_controller->getLocationList();
$flag = true;
$city = $town = $fee = "";

if(isset($_GET['allEdit_id'])){
    $edit_id=$_GET['allEdit_id'];
    $localEdit=$location_controller->getLocationListById($edit_id);
    $c_name=$localEdit['city'];
    $t_name=$localEdit['township'];
    $feeEdit=$fee_controller->getFeeInfoByLocationId($edit_id);
    $f_value=$feeEdit['fee'];
}

if(isset($_POST['submit'])){
    $city_name=$_POST['city'];
    $town_name=$_POST['town'];
    $fee_value=$_POST['fee'];
    $lid=$_POST['lid'];
    $localEdit=$location_controller->getLocationExceptFromId($lid);
        foreach($localEdit as $local){
            if(($city_name==$local['city'])&&($town_name==$local['township'])){
                $flag=false;
                break;
            }
        }
        if($flag){
            $Result=$location_controller->editLocation($lid,$city_name,$town_name);
            $result_fee=$fee_controller->editFee($lid,$fee_value);
            if($Result && $result_fee)
            {
                $message = 2;
                echo '<script>location.href="delivery_setting.php?status='.$message.'"</script>';
            }else{
                $message = 5;
                echo '<script>location.href="delivery_setting.php?status='.$message.'"</script>';
               
            }
        }else{
            $message = 4;
            echo '<script>location.href="delivery_setting.php?status='.$message.'"</script>';
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
                            <?php if(isset($edit_id)){ ?>
                                <form class="form-valide" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="form-row">
                                        <div class="col-4 m-1">
                                            <input type="text" class="form-control" value="<?php echo $c_name ?>" name="city" required>
                                            <input type="hidden" class="form-control" value="<?php echo $edit_id ?>" name="lid" required>
                                        </div>
                                        <div class="col-4 m-1">
                                            <input type="text" class="form-control" value="<?php echo $t_name ?>"  name="town" required>
                                        </div>

                                        <div class="col-8 m-1">
                                            <input type="text" class="form-control" placeholder="Fee-MMK" name="fee" value="<?php echo $f_value ?>" required>
                                        </div>
                                        <div class="col-auto m-1">
                                            <button type="submit" name="submit" class="btn btn-dark mb-2">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            <?php }else{ ?>
                                <form class="form-valide" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="form-row">
                                        <div class="col-4 m-1">
                                            <input type="hidden" class="form-control" value="<?php echo $lid ?>" name="lid" required>
                                            <input type="text" class="form-control" placeholder="Enter City Name" value="<?php echo $city ?>" name="city" required>
                                        </div>
                                        <div class="col-4 m-1">
                                            <input type="text" class="form-control" placeholder="Enter Township Name" value="<?php echo $town ?>"  name="town" required>
                                        </div>

                                        <div class="col-8 m-1">
                                            <input type="text" class="form-control" placeholder="Fee-MMK" name="fee" value="<?php echo $fee ?>" required>
                                        </div>
                                        <div class="col-auto m-1">
                                            <button type="submit" name="submit" class="btn btn-dark mb-2">Add New Location</button>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
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
