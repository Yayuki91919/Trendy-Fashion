 <?php
    include_once 'layouts/header.php';
    include_once __DIR__. '../controller/locationController.php';
    include_once __DIR__. '../controller/feeController.php';
    $fee_controller=new FeeController();
    $location_controller=new LocationController();
    $locations=$location_controller->getLocationList();
    $flag=true;
    $city=$town=$fee="";
   
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
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete?");
}
</script>

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
             <!-- /# column -->
             <div class="col-lg-12">
                 <div class="card">
                     <div class="card-body">
                     <div class="row">
                            <div class="col-sm-9">
                                <h4 class="card-title">Location and Fee</h4>
                            </div>
                            <div class="col-sm-2">
                                <a href="add_delivery.php" class="btn mb-1 btn-rounded gradient-2">+ New Location</a>
                            </div>
                        </div>
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
                                            <td><a href="edit_location.php?allEdit_id=<?php echo $location['location_id']?>" data-toggle="tooltip" data-placement="top" title="Edit Location"><i class="fa fa-pencil color-muted m-r-5"></i> </a>
                                                <a href="delivery_setting.php?delete_id=<?php echo $location['location_id']?>" class="ti-trash" 
                                                data-toggle="tooltip" data-placement="top" title="Delete Location" onclick="return confirmDelete()">
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