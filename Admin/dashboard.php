<?php 
include('layouts/header.php'); 
include_once __DIR__. '../controller/shopinfoController.php';
include_once __DIR__. '../controller/customerController.php';
include_once __DIR__. '../controller/invoiceController.php';
include_once __DIR__. '../controller/orderController.php';
$order_controller=new OrderController();
$invoice_controller=new InvoiceController();
$customer_controller=new CustomerController();
$shop_controller = new ShopInfoController();
$shopcount=$shop_controller->ShopRowCount();
$customers=$customer_controller->getCustomers();
$cus_count = count($customers);
$invoices=$invoice_controller->getInvoices();
$invoice_count=count($invoices);
$order_count=$order_controller->getOrderCountInfo();

?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <a href="invoice.php">
                    <div class="card gradient-1">
                        <div class="card-body">
                            <h3 class="card-title text-white">Products Sold</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white"><?php
                                    if(!empty($order_count)){
                                        echo $order_count ;
                                    }else{
                                        echo '0';
                                    }
                                     ?></h2>
                                <p class="text-white mb-0">See More</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6">
                <a href="invoice.php">
                    <div class="card gradient-2">
                        <div class="card-body">
                            <h3 class="card-title text-white">Orders</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white"> <?php
                                    if(!empty($invoice_count)){
                                        echo $invoice_count ;
                                    }else{
                                        echo '0';
                                    }
                                     ?></h2>
                                <p class="text-white mb-0">See More</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6">
                <a href="customer.php">
                    <div class="card gradient-3">
                        <div class="card-body">
                            <h3 class="card-title text-white">Customers</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">
                                    <?php
                                    if(!empty($cus_count)){
                                        echo $cus_count ;
                                    }else{
                                        echo '0';
                                    }
                                     ?></h2>
                                <p class="text-white mb-0">See More</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6">
                <a href="shopinfo.php">
                    <div class="card gradient-4">
                        <div class="card-body">
                            <h3 class="card-title text-white">Shops</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">
                                    <?php
                                    if(!empty($shopcount)){
                                        echo $shopcount ;
                                    }else{
                                        echo '0';
                                    }
                                     ?></h2>
                                <p class="text-white mb-0">See More</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->


<?php include('layouts/footer.php'); ?>