<?php 
include_once 'layouts/header.php';
	include_once __DIR__. '/Admin/controller/invoiceController.php';
    include_once __DIR__. '/Admin/controller/orderController.php';
    include_once __DIR__. '/Admin/controller/deli_infoController.php';
    include_once __DIR__. '/Admin/controller/locationController.php';
    include_once __DIR__. '/Admin/controller/deliveryController.php';
    $delivery_controller=new DeliveryController();
    $invoice_controller=new InvoiceController();
    $invoices=$invoice_controller->getInvoices(); 
    if(isset($_GET['invoice_id']))
    {
    $id=$_GET['invoice_id'];
    $order_controller=new OrderController();
    $orders=$order_controller->getOrderListByInvoice($id);
    $invoice_controller=new InvoiceController();
    $invoice=$invoice_controller->getInvoice($id);
    $in_id=$invoice['deli_info_id'];
    $deli_controller=new DeliInfoController();
    $delis=$deli_controller->getDeliInfoListById($in_id);
    $delivery=$delivery_controller->getDeliveryListByInvoiceId($id);
    $location_id=$delis['location_id'];
    $location_controller=new LocationController();
    $location=$location_controller->getLocationListById($location_id);
	}
    if(isset($_GET['delete'])){
        $invoice_id=$_GET['delete'];
        $result=$invoice_controller->deleteOrder($invoice_id);
        if($result){
            echo '<script>location.href="order.php"</script>';
       }else{
           echo '<script>location.href="404.php"</script>';
       }
    }
?>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to cancel order?");
}
</script>
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <h1 class="page-name">Dashboard</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">my account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="user-dashboard page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline dashboard-menu text-center">
                    <li><a class="active" href="order.php">Orders</a></li>
                    <li><a href="profile-details.php">Profile Details</a></li>
                </ul>
                <div class="dashboard-wrapper user-dashboard">
                    <?php if(isset($_GET['invoice_id'])){ ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Delivery Information</h4>
                                    <div class="custom-media-object-1">
                                        <div class="media border-bottom-1 p-t-15"><i
                                                class="align-self-start mr-3 cc NEO f-s-30"></i>
                                            <div class="media-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h5>Your Information</h5>
                                                        <p class="m-0 "><b>Name : </b><?php echo $delis['name'] ?></p>
                                                        <p class="m-0"><b>Email : </b><?php echo $delis['email'] ?></p>
                                                        <p class="m-0"><b>Phone : </b><?php echo $delis['phone'] ?></p>
                                                        <?php if($delivery['status']=='processing'){ ?>
                                                        <p class="f-s-13 text-danger">
                                                            <?php echo "Processing"; ?></p>
                                                        <?php }elseif($delivery['status']=='shipped'){?>
                                                        <span
                                                            class="m-0 text-warning"><?php echo "Shipped at "; ?></span><span
                                                            class="text-muted"><?php echo $delivery['shipping_date'] ?></span>
                                                        <?php }elseif($delivery['status']=='delivered'){?>
                                                        <span
                                                            class="m-0 text-info"><?php echo "Delivered at"; ?></span><br><span
                                                            class="text-muted"><?php echo $delivery['delivered_date'] ?></span>
                                                        <?php } ?>
                                                        <br>
                                                    </div>
                                                    <div class="col-lg-6 text-right">
                                                        <h5 class="">Delivery Location</h5>
                                                        <p class="m-0 ">
                                                            <?php echo $location['city'] ?>
                                                        </p>
                                                        <p class="m-0 text-info">
                                                            <?php echo $location['township'] ?></p>
                                                        <p class="m-0 text-secondary"><b><?php echo $delis['address_details'] ?></b>
                                                        </p>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Orders</h4>
                                    <div class="custom-media-object-2">
                                        <?php foreach($orders as $order){ 
                                 $pid=$order['product_detail_id'];
                                 $product= $order_controller->getProductListByInvoice($pid);
                                ?>
                                        <div class="media border-bottom-1 p-t-15">
                                            <div class="media-body">
                                                <div class="row">
                                                    <div class="col-lg-2"><img class="m-2"
                                                            src="Admin/images/product/<?php echo $product['random_image'] ?>"
                                                            width="80" height="80" alt=""></div>
                                                    <div class="col-lg-6">
                                                        <h5><?php echo $product['product_name'] ?></h5>
                                                        <b>Size : </b><?php echo $product['psize'] ?><br>
                                                        <b>Color : </b><?php echo $product['pcolor'] ?><br>
                                                        <b>Qty : </b><?php echo $order['quantity'] ?> x
                                                        <?php echo $product['price'] ?> <span
                                                            class="XRP m-l-10">KS</span>
                                                    </div>
                                                    <div class="col-lg-4 text-right">
                                                        <?php if($order['cus_status']=="order"){ ?>
                                                        <span
                                                            class="label label-info "><?php echo $order['cus_status'] ?></span>
                                                        <?php }elseif($order['cus_status']=="cancel"){ ?>
                                                        <span
                                                            class="label label-danger "><?php echo $order['cus_status'] ?></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }else{ 
                       if(!empty($invoices)){ ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Delivery Fee</th>
                                    <th>Total Price</th>
                                    <th>Shipping Status</th>
                                    <th>Details</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                    foreach($invoices as $invoice){
                            	?>
                                <tr>
                                    <td>#<?php echo $invoice['invoice_no'] ?></td>
                                    <td><?php echo $invoice['invoice_date'] ?></td>
                                    <td><?php echo $invoice['fee'] ?> Ks</td>
                                    <td><?php echo $invoice['total'] ?> Ks</td>
                                    <?php 
										    $in_id=$invoice['invoice_id']; 
											$delivery=$delivery_controller->getDeliveryListByInvoiceId($in_id); ?>
                                    <td><?php if($delivery['status']=='processing'){ ?>
                                        <p class="label label-info">
                                            <?php echo "Processing"; ?></p>
                                        <?php }elseif($delivery['status']=='shipped'){?>
                                        <span class="label label-warning"><?php echo "Shipped"; ?></span><br>
                                        <?php }elseif($delivery['status']=='delivered'){?>
                                        <span class="label label-success"><?php echo "Delivered"; ?></span><br>
                                        <?php } ?>
                                    </td>
                                    <td><a href="order.php?invoice_id=<?php echo $invoice['invoice_id'] ?>"
                                            class="btn btn-default">View</a></td>
                                            <td><a href="order.php?delete=<?php echo $invoice['invoice_id'] ?>"
                                            class="tn btn-main btn-small btn-round-full" onclick="return confirmDelete()">Cancel Order</a></td>
                                </tr>
                                <?php 
                            } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }else{ ?>
                        <p class="text-center"> <?php echo "There is no order yet."; ?></p> 
                     <?php  }} ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once 'layouts/footer.php';
?>