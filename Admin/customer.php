<?php 
    include('layouts/header.php');
    include_once __DIR__. '../controller/customerController.php';
    $customer_controller=new CustomerController();
    $customers=$customer_controller->getCustomers();
    if(isset($_GET['cust_id'])){
       
            $delete_id=$_GET['cust_id'];
            $result=$customer_controller->deleteCustomer($delete_id);
            if($result)
            {
                $message = 3;
                echo '<script> location.href="customer.php?status='.$message.'"</script>';
            }
            else{
                echo "You can't delete as it has releated child data";
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
                    echo "<div class='alert alert-success text-success' > New Customer has been successfully added </div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 2)
                {
                    echo "<div class='alert alert-success' > New Customer has been successfully updated</div>";
                }
                elseif(isset($_GET['status']) && $_GET['status'] == 3)
                {
                    echo "<div class='alert alert-success' >Customer has been successfully deleted</div>";
                }

                ?>

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Customer Lists</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered zero-configuration table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                                <th>Orders</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $count=1;
                                            if(isset($customers)){
                                            foreach($customers as $customer){
                                             ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $customer['username'] ?></td>
                                                <td><?php echo $customer['email'] ?></td>
                                                <td><?php echo $customer['phone'] ?></td>
                                                <td><a href="customer_edit.php?cust_id=<?php echo $customer['customer_id']?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a>
                                              
                                                <a href="customer.php?cust_id=<?php echo $customer['customer_id']?>" class="ti-trash" 
                                                data-toggle="tooltip" data-placement="top"  title="Delete" onclick="return confirmDelete()">
                                                </td>
                                                <td><a href="customer_order.php?customer_id=<?php echo $customer['customer_id'] ?>" class="btn mb-1 btn-rounded gradient-7">View</a></td>
                                            </tr>
                                            <?php }} ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                                <th>Orders</th>
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