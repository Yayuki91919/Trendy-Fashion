<?php 
    include('layouts/header.php');
    include_once __DIR__. '../controller/invoiceController.php';
    if(isset($_GET['invoice_id'])){
    $id=$_GET['invoice_id'];
    $invoice_controller=new InvoiceController();
    $invoices=$invoice_controller->getInvoice($id);
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
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Orders</h4>
                        <div class="custom-media-object-2">
                            <div class="media border-bottom-1 p-t-15">
                                <img class="mr-3 rounded-circle" src="images/avatar/1.jpg" alt="">
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <h5><?php echo $invoices['product_name'] ?></h5>
                                            <p class="m-0"><b>Size : </b><?php echo $invoices['size'] ?></p>
                                            <p class="m-0"><b>Color : </b><?php echo $invoices['color'] ?></p>
                                            <p class="m-0"><b>Qty : </b><?php echo $invoices['quantity'] ?></p>
                                        </div>
                                        <div class="col-lg-2">
                                            <p class="text-muted f-s-14">10 Deals</p>
                                        </div>
                                        <div class="col-lg-5 text-right">
                                            <h5 class="text-muted"><i class="cc BTC m-r-5"></i> <span
                                                    class="BTC m-l-10">Send BTC</span></h5>
                                            <p class="f-s-13 text-muted">Last 10 min ago</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            </div>
            <div class="col-lg-">
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->


<?php include('layouts/footer.php'); ?>