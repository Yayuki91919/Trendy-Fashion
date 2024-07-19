<?php 
   include('layouts/header.php');
   include_once __DIR__. '../controller/shopinfoController.php';
   $shop_controller = new ShopInfoController();
   $shops = $shop_controller->getShopInfo();
    if(isset($_GET['delete_id'])){
        $delete_id=$_GET['delete_id'];
        $result=$shop_controller->deleteShop( $delete_id);
        if($result)
        {
            $message = 3;
            echo '<script> location.href="shopinfo.php?status='.$message.'"</script>';
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
                    echo "<div class='alert alert-success text-success' > New Shop Info has been successfully added. </div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 2)
                {
                    echo "<div class='alert alert-success' > New Shop Info has been successfully updated.</div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 3)
                {
                    echo "<div class='alert alert-success' >Shop Info has been successfully deleted.</div>";
                }

     ?>

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Shop</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-9">
                                <h4 class="card-title">Shop Lists</h4>
                            </div>
                            <div class="col-sm-2"><a href="new_shop.php" class="btn mb-1 btn-rounded gradient-2">+ New
                                    Shop</a></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered zero-configuration table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Shop Information</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $count=1;
                                            if(!empty($shops)){
                                            foreach($shops as $shop){
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td>
                                            <p class="m-0"><b>Name : <span
                                                    class=" text-danger"><?php echo $shop['name'] ?> </span></b></p><br>
                                            <p class="m-0"><b>Phone : </b><span
                                                    class=""><?php echo $shop['phone'] ?> </span></p><br>
                                            <p class="m-0"><b>Address : </b><span
                                                    class=""><?php echo $shop['address'] ?> </span></p>
                                        </td>
                                        <td>
                                            <p class="m-0"><b>Opening Time : </b><span
                                                    class=" text-green"><?php echo $shop['open_time'] ?> </span></p><br>
                                            <p class="m-0"><b>Closing Time : </b><span
                                                    class="text-green"><?php echo $shop['close_time'] ?> </span></p><br>
                                        </td>
                                        <td><a href="edit_shopinfo.php?shop_id=<?php echo $shop['shop_id'] ?>"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-pencil color-muted m-r-5"></i> </a>
                                            <a href="shopinfo.php?delete_id=<?php echo $shop['shop_id'] ?>"
                                                class="ti-trash" data-toggle="tooltip" data-placement="top"
                                                title="Delete" onclick="return confirmDelete()">
                                        </td>

                                    </tr>
                                    <?php }} ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Shop Information</th>
                                        <th>Social Media</th>
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


<?php include('layouts/footer.php'); ?>