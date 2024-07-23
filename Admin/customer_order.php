<?php 
    include('layouts/header.php');
    include_once __DIR__. '../controller/invoiceController.php';
    include_once __DIR__. '../controller/deli_infoController.php';
    include_once __DIR__. '../controller/locationController.php';
    include_once __DIR__. '../controller/feeController.php';
    include_once __DIR__. '../controller/deliveryController.php';
    include_once __DIR__. '../controller/orderController.php';
    $order_controller=new OrderController();
    $deli_controller=new DeliInfoController();
    $invoice_controller=new InvoiceController();
    $location_controller=new LocationController();
    $fee_controller=new FeeController();
    $delivery_controller=new DeliveryController();
    
    if(isset($_GET['customer_id'])){
        $cus_id=$_GET['customer_id'];
        $invoices=$invoice_controller->getInvoiceInfoByCustomerId($cus_id);
    }
     
?>
<link href="css/cus_order.css" rel="stylesheet">
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
                                        <th>Invoice_No</th>
                                        <th>Customer Information</th>
                                        <th>Delivery_Information</th>
                                        <th>Order List</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $count=1;
                                            if(!empty($invoices)){
                                            foreach($invoices as $invoice){
                                                $in_id=$invoice['deli_info_id'];
                                                $invoice_id=$invoice['invoice_id'];
                                                $fee_id=$invoice['fee_id'];
                                                $delis=$deli_controller->getDeliInfoListById($in_id);
                                                $location_id=$delis['location_id'];
                                                $location=$location_controller->getLocationListById($location_id);
                                                $fee=$fee_controller->getFeesById($fee_id);
                                                $delivery=$delivery_controller->getDeliveryListByInvoiceId($invoice_id);
                                                $orders=$order_controller->getOrderListByInvoice($invoice_id);
                                                
                                             ?>
                                    <tr>
                                        <td>#<?php echo $invoice['invoice_no'] ?></td>
                                        <td>
                                            <p class="m-0"><b>Name : </b><?php echo $delis['name'] ?></p><br>
                                            <p class="m-0"><b>Email : </b><?php echo $delis['email'] ?></p><br>
                                            <p class="m-0"><b>Phone : </b><?php echo $delis['phone'] ?></p><br>
                                            <p class="m-0"><b>Order Date : </b><?php echo $invoice['invoice_date'] ?>
                                            </p>

                                        </td>
                                        <td>
                                            <p class="m-0"><b>City : </b><?php echo $location['city'] ?></p><br>
                                            <p class="m-0"><b>Township : </b><?php echo $location['township'] ?></p><br>
                                            <p class="m-0"><b>Address : </b><?php echo $delis['address_details'] ?></p>
                                            <br>
                                            <p class="m-0"><b>Delivery Fee : </b><?php echo $fee['fee'] ?> Ks</p><br>
                                            <?php if($delivery['status']=='processing'){ ?>
                                            <p class="f-s-13 text-danger font-italic font-weight-bold">
                                                <?php echo "Processing"; ?></p>
                                            <?php }elseif($delivery['status']=='shipped'){?>
                                            <span
                                                class="m-0 f-s-13 text-warning font-italic font-weight-bold"><?php echo "Shipped at : "; ?></span>
                                            <span class="text-muted"><?php echo $delivery['shipping_date'] ?></span>
                                            <?php }elseif($delivery['status']=='delivered'){?>
                                            <span
                                                class="m-0 f-s-13 text-green font-italic font-weight-bold"><?php echo "Delivered at : "; ?>
                                            </span>
                                            <span class="text-muted"><?php echo $delivery['delivered_date'] ?></span>
                                            <?php } ?>

                                        </td>
                                        <td>
                                            <button class="btn mb-1 btn-rounded gradient-2 toggle-button">Show</button>
                                            <div class="floating-order-list" id="orderList">
                                                <button class="close-button" id="closeButton">&times;</button>
                                                <h2>Order List</h2>
                                                <div class="order-list-content">
                                                    <ol>
                                                        <?php foreach($orders as $order){ 
                                                        $pid=$order['product_detail_id'];
                                                        $product= $order_controller->getProductListByInvoice($pid);
                                                    ?>
                                                        <li class="shadow bg-body-tertiary rounded">
                                                            <div class="bootstrap-media m-3">
                                                                <div class="media">
                                                                    <img id="myImg" class="align-self-start mr-3"
                                                                        src="images/product/<?php echo $product['random_image'] ?>"
                                                                        width="80" height="80" >
                                                                    <div class="media-body">
                                                                        <div class="row">
                                                                            <div class="col-md-8">
                                                                                <h5 class="mt-0">
                                                                                    <?php echo $product['product_name'] ?> 
                                                                                    <span class="badge badge-success m-2"><?php echo $order['cus_status'] ?></span>
                                                                                </h5>
                                                                                <p>
                                                                                    <b>Size: </b>
                                                                                    <?php echo $product['psize'] ?>,
                                                                                    <b>Color: </b>
                                                                                    <?php echo $product['pcolor'] ?>,
                                                                                    <b>Qty:</b>
                                                                                    <?php echo $order['quantity'] ?> Pcs
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <h5 class="mt-0">
                                                                                    <?php 
                                                                                    $subtotal=$product['price']*$order['quantity'];
                                                                                    echo $subtotal ?>
                                                                                    <b>Ks</b>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php } ?>

                                                    </ol>
                                                    <p class="text-right mr-4">Total: <b><?php echo $invoice['total'] ?>
                                                            MMK</b></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php }} ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Invoice_No</th>
                                        <th>Customer Information</th>
                                        <th>Delivery_Information</th>
                                        <th>Order List</th>
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
 <!-- The Modal -->

<script>
document.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('.toggle-button');
    const closeButton = document.getElementById('closeButton');
    const body = document.body;

    button.addEventListener('click', () => {
        body.classList.toggle('show-order-list');
        if (body.classList.contains('show-order-list')) {
            button.textContent = 'Hide';
        } else {
            button.textContent = 'Show';
        }
    });

    closeButton.addEventListener('click', () => {
        body.classList.remove('show-order-list');
        button.textContent = 'Show';
    });
});
</script>


<?php include('layouts/footer.php'); ?>
