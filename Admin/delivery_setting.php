 <?php
    include_once 'layouts/header.php';
    include_once __DIR__. '../controller/locationController.php';
    include_once __DIR__. '../controller/feeController.php';

    $fee_controller=new FeeController();
    $location_controller=new LocationController();
    $locations=$location_controller->getLocationList();
    $flag=true;
    $city=$town=$fee="";
  
    if(isset($_POST['submit'])&&(!isset($_POST['lid']))){
        $city=$_POST['city'];
        $town=$_POST['town'];
        $fee=$_POST['fee'];
        foreach($locations as $local){
            if(($city==$local['city'])&&($town==$local['township'])){
                $flag=false;
                break;
            }
        }
        if($flag==false){
            $message = 4;
            echo '<script>location.href="delivery_setting.php?status='.$message.'"</script>';
        }elseif($flag==true){
        $result=$location_controller->createNewLocation($city,$town);
        $lastId = $location_controller->getLastInsertId();
        
        $result_fee=$fee_controller->createNewFee($fee,$lastId['last_id']);

            if($result&&$result_fee)
            {
                $message = 1;
                echo '<script>location.href="delivery_setting.php?status='.$message.'"</script>';
            }
        }
    }
    if(isset($_GET['allEdit_id'])){
        $edit_id=$_GET['allEdit_id'];
        $localEdit=$location_controller->getLocationListById($edit_id);
        $c_name=$localEdit['city'];
        $t_name=$localEdit['township'];
        $feeEdit=$fee_controller->getFeeInfoByLocationId($edit_id);
        $f_value=$feeEdit['fee'];
    }

    if(isset($_POST['submit'])&&(isset($_POST['lid']))){
        $city_name=$_POST['city'];
        $town_name=$_POST['town'];
        $fee_value=$_POST['fee'];
        $lid=$_POST['lid'];
        $count=0;
        foreach($locations as $local){
            if(($city_name==$local['city'])&&($town_name==$local['township'])){
                ++$count;
                break;
            }
        }
        if($count>1){
            $message = 4;
            echo '<script>location.href="delivery_setting.php?status='.$message.'"</script>';
        }elseif($count==1 || $count==0){
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
        }
    }
    if(isset($_GET['delete_id'])){
       
            $delete_id=$_GET['delete_id'];
            $result=$fee_controller->deleteFee($delete_id);
            $status=$location_controller->deleteLocation($delete_id);
            if($status)
            {
                $message = 3;
                echo '<script> location.href="delivery_setting.php?status='.$message.'"</script>';
            }else{
                $message = 6;
                echo '<script>location.href="delivery_setting.php?status='.$message.'"</script>';
               
            }
        }
    

?>


 <!--**********************************
            Content body start
        ***********************************-->

 <div class="content-body">
     <?php
                if(isset($_GET['status']) && $_GET['status'] == 1)
                {
                    echo "<div class='alert alert-success text-success' > New Location has been successfully added. </div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 2)
                {
                    echo "<div class='alert alert-success' > Location has been successfully updated.</div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 3)
                {
                    echo "<div class='alert alert-success' >Location has been successfully deleted.</div>";
                }elseif(isset($_GET['status']) && $_GET['status'] == 4)
                {
                    echo "<div class='alert alert-danger' >Locations are Duplicated.</div>";
                }elseif(isset($_GET['status']) && $_GET['status'] == 5)
                {
                    echo "<div class='alert alert-danger' >Can't process.</div>";
                }elseif(isset($_GET['status']) && $_GET['status'] == 6)
                {
                    echo "<div class='alert alert-danger' >You can't delete as it has other releated data</div>";
                }
                ?>
     <div class="row page-titles mx-0">
         <div class="col p-md-0">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                 <li class="breadcrumb-item active"><a href="javascript:void(0)">Delivery Setting</a></li>
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
                                         <input type="text" class="form-control" placeholder="Fee-MMK" name="fee" value="<?php echo $f_value ?>" name="fee" required>
                                     </div>
                                     <div class="col-auto m-1">
                                         <button type="submit" name="submit" class="btn btn-dark mb-2">Edit</button>
                                     </div>
                                 </div>
                             </form>
                           <?php }else{ ?>
                             <form class="form-valide" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                             <div class="form-row">
                                 <div class="col-4 m-1">
                                     <input type="text" class="form-control" placeholder="Enter City Name" value="<?php echo $city ?>" name="city" required>
                                 </div>
                                 <div class="col-4 m-1">
                                 <input type="text" class="form-control" placeholder="Enter Township Name" value="<?php echo $town ?>"  name="town" required>
                                 </div>

                                 <div class="col-8 m-1">
                                     <input type="text" class="form-control" placeholder="Fee-MMK" name="fee" value="<?php echo $fee ?>" name="fee" required>
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
             <!-- /# column -->
             <div class="col-lg-12">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="card-title">Location & Fees</h4>
                         <div class="table-responsive">
                             <table class="table table-hover zero-configuration">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>City</th>
                                         <th>Township</th>
                                         <th>Fees (MMK)</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                    <?php  $count=1;
                                            $all=$location_controller->getLocationFeeInfo();
                                            if(!empty($all)){
                                            foreach($all as $location){
                                                $location_id=$location['location_id'];
                                             ?>
                                        <tr>
                                            <td><?php echo $count++ ?></td>
                                            <td><?php echo $location['city'] ?></td>
                                            <td><?php echo $location['township'] ?></td>
                                            <?php
                                             if(!empty($location['fee'])){ ?>
                                            <td class="text-green text-center font-weight-bold"><?php echo $location['fee']; ?> </td>
                                            <?php }elseif($location['fee']==null){ ?>
                                            <td class="text-danger text-center font-weight-bold">-</td>
                                            <?php } ?>
                                            <td><a href="delivery_setting.php?allEdit_id=<?php echo $location['location_id']?>" data-toggle="tooltip" data-placement="top" title="Edit Location"><i class="fa fa-pencil color-muted m-r-5"></i> </a>
                                                <a href="delivery_setting.php?delete_id=<?php echo $location['location_id']?>" class="ti-trash" 
                                                data-toggle="tooltip" data-placement="top" title="Delete Location">
                                            </td>
                                        </tr>
                                         <?php }} ?>
                                 </tbody>
                                 <tfoot>
                                     <tr>
                                         <th>No</th>
                                         <th>City</th>
                                         <th>Township</th>
                                         <th>Fees</th>
                                         <th>Action</th>
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


 <?php
    include_once 'layouts/footer.php';
?>