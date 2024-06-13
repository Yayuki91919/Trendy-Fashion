<?php 
    include('layouts/header.php');
    include_once __DIR__. '../controller/customerController.php';
   
    if(isset($_GET['cust_id'])){
        $id=$_GET['cust_id'];
        $customer_controller=new CustomerController();
        $customer=$customer_controller->getCustomer($id);
    }elseif(isset($_POST['submit'])){
        $id=$_POST['cust_id'];
        $customer_controller=new CustomerController();
        $customer=$customer_controller->getCustomer($id);
        $username=$_POST['username'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $status=$customer_controller->editCustomer($id,$username,$email,$phone);
    }
    
?>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

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
                                <h4 class="card-title">Edit Customer Info</h4> 
                                <div class="basic-form">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <?php if(isset($_GET['cust_id'])){ ?>
                                    <input type="hidden" class="form-control" placeholder="Customer's Username" name="cust_id" value="<?php echo $customer['customer_id'] ?>" required>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Usesname</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="Customer's Username" name="username" value="<?php echo $customer['username'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" placeholder="Customer's Email" name="email" value="<?php echo $customer['email'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="Customer's Phone" name="phone" value="<?php echo $customer['phone'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-1">
                                                <button type="submit" name="submit" class="btn btn-dark">Edit</button>
                                            </div>
                                            <div class="col-sm-1">
                                                <a href="customer.php" class="btn btn-primary">Back </a>
                                            </div>
                                        </div>
                                        <?php }else{ ?>
                                            <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Usesname</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="Customer's Username" name="username" value="<?php echo $username ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" placeholder="Customer's Email" name="email" value="<?php echo $email ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="Customer's Phone" name="phone" value="<?php echo $phone ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-1">
                                                <button type="submit" name="submit" class="btn btn-dark">Edit</button>
                                            </div>
                                            <div class="col-sm-1">
                                                <a href="customer.php" class="btn btn-primary">Back</a>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </form>
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