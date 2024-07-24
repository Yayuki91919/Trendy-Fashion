<?php 
    include('layouts/header.php');
    include_once __DIR__. '../controller/invoiceController.php';
    $invoice_controller=new InvoiceController();
    $invoices=$invoice_controller->getInvoices();
    
?>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Invoice</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Invoice Lists</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered zero-configuration table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Invoice_No</th>
                                                <th>Customer</th>
                                                <th>Delivery_Fee</th>
                                                <th>Total</th>
                                                <th>Order_Date</th>
                                                <th>Delivery_Status</th>
                                                <th>Invoice_Detail</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $count=1;
                                            if(isset($invoices)){
                                            foreach($invoices as $invoice){
                                             ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $invoice['invoice_no'] ?></td>
                                                <td><?php echo $invoice['username'] ?></td>
                                                <td><?php echo $invoice['fee'] ?></td>
                                                <td><?php echo $invoice['total'] ?></td>
                                                <td><?php echo $invoice['invoice_date'] ?></td>
                                                <td><?php if($invoice['status']=='processing'){ ?>
                                                        <p class="f-s-13 text-danger">
                                                            <?php echo "Processing"; ?></p>
                                                        <?php }elseif($invoice['status']=='shipped'){?>
                                                        <span
                                                            class="m-0 text-warning"><?php echo "Shipped at "; ?></span>
                                                        <?php }elseif($invoice['status']=='delivered') ?></td>
                                                <td><a href="invoice_detail.php?invoice_id=<?php echo $invoice['invoice_id'] ?>" class="btn mb-1 btn-rounded gradient-2">View</a></td>
                                            </tr>
                                            <?php }} ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Invoice_No</th>
                                                <th>Customer</th>
                                                <th>Delivery_Fee</th>
                                                <th>Total</th>
                                                <th>Order_Date</th>
                                                <th>Delivery_Status</th>
                                                <th>Invoice_Detail</th>
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