<?php 
    include('layouts/header.php');
    include_once __DIR__ . '../controller/deliveryController.php';
    $delivery_controller = new DeliveryController();
    $fail = '';
    
    if (isset($_GET['invoice_id'])) {
        $invoice_id = $_GET['invoice_id'];
        $delivery = $delivery_controller->getDeliveryListByInvoiceId($invoice_id);
    }
    
    if (isset($_POST['submit'])) {
        $id = $_POST['invoice_id'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $delivery_id = $_POST['delivery_id'];
        
        if ($status == 'processing') {
            $shipped_date = '';
            $delivered_date = '';
        } elseif ($status == 'shipped') {
            $shipped_date = $date;
            $delivered_date = '';
        } elseif ($status == 'delivered') {
            $shipped_date = '';
            $delivered_date = $date;
        }
        
        $result = $delivery_controller->editDelivery($id, $shipped_date, $delivered_date, $status);
        
        if ($result) {
            $message = 2;
           echo '<script> location.href="invoice_detail.php?invoice_id=' . $id . '&result=' . $message . '"</script>';
        } else {
            $fail = "fail";
        }
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Order Detail</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <?php echo $fail ?>
                            <form class="form-valide" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="invoice_id" value="<?php echo $delivery['invoice_id']; ?>">
                                <input type="hidden" name="delivery_id" value="<?php echo $delivery['deli_id']; ?>">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Delivery Status <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="val-skill" name="status" required>
                                            <option value="<?php echo $delivery['status']; ?>"><?php echo $delivery['status']; ?></option>
                                            <option value="processing">Processing</option>
                                            <option value="shipped">Shipped</option>
                                            <option value="delivered">Delivered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Date At <span class="text-danger">*</span></label>
                                    <?php if ($delivery['status'] == 'processing') { ?>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="date" id="mdate" required>
                                    </div>
                                    <?php } elseif ($delivery['status'] == 'shipped') { ?>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" placeholder="<?php echo $delivery['shipping_date']; ?>" value="<?php echo $delivery['shipping_date']; ?>" name="date" id="mdate" required>
                                    </div>
                                    <?php } elseif ($delivery['status'] == 'delivered') { ?>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" placeholder="<?php echo $delivery['delivered_date']; ?>" value="<?php echo $delivery['delivered_date']; ?>" name="date" id="mdate" required>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                        <a href="invoice_detail.php?invoice_id=<?php echo $delivery['invoice_id']; ?>" class="btn btn-secondary mx-3">Back</a>
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
<!--**********************************
            Content body end
        ***********************************-->
<?php include('layouts/footer.php'); ?>
