<?php 
    include('layouts/header.php');
    include_once __DIR__ . '../controller/invoiceController.php';
    include_once __DIR__ . '../controller/orderController.php';
    include_once __DIR__ . '../controller/deli_infoController.php';
    include_once __DIR__ . '../controller/locationController.php';
    include_once __DIR__ . '../controller/deliveryController.php';

    $delivery_controller = new DeliveryController();
    
    if (isset($_GET['invoice_id'])) {
        $id = $_GET['invoice_id'];
    }
    
    $order_controller = new OrderController();
    $orders = $order_controller->getOrderListByInvoice($id);
    
    $invoice_controller = new InvoiceController();
    $invoice = $invoice_controller->getInvoice($id);
    $in_id = $invoice['deli_info_id'];
    
    $deli_controller = new DeliInfoController();
    $delis = $deli_controller->getDeliInfoListById($in_id);
    
    $delivery = $delivery_controller->getDeliveryListByInvoiceId($id);
    $location_id = $delis['location_id'];
    
    $location_controller = new LocationController();
    $location = $location_controller->getLocationListById($location_id);
?>

<!--**********************************
    Content body start
***********************************-->
<style>
    .image-container {
    display: inline;
    
}

.thumbnail {
    width: 100%;
    height: auto;
}

.delete-icon {
    text-align: right;
    background-color: #ff5c5c;
    color: white;
    padding: 5px 10px;
    border-radius: 3px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    text-decoration: none;
}

.delete-icon:hover {
    background-color: #e14c4c;
}

/* Fullscreen Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 100;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.9);
}

.modal-content {
    margin: auto;
    display: block;
    width: 90%;
    max-width: 700px;
}

#imageName {
    color: white;
    font-size: 18px;
    text-align: center;
    padding: 10px 0;
}

/* Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

@media screen and (max-width: 700px) {
    .modal-content {
        width: 100%;
    }

    .close {
        font-size: 30px;
        right: 15px;
    }

    #imageName {
        font-size: 16px;
    }
}



.error {
    color: red;
    font-size: 0.9em;
}

</style>
<div class="content-body">
    <?php if (isset($_GET['result']) && $_GET['result'] == 2) {
        echo "<div class='alert alert-success text-success'>Delivery Status Changed Successfully!</div>";
    } ?>

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
            <!-- Delivery Information -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Delivery Information</h4>
                        <div class="custom-media-object-1">
                            <div class="media border-bottom-1 p-t-15"><i class="align-self-start mr-3 cc NEO f-s-30"></i>
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>Customer</h5>
                                            <p class="m-0"><b>Name: </b><?php echo $delis['name'] ?></p>
                                            <p class="m-0"><b>Email: </b><?php echo $delis['email'] ?></p>
                                            <p class="m-0"><b>Phone: </b><?php echo $delis['phone'] ?></p><br>
                                            <a href="editDelivery.php?invoice_id=<?php echo $id ?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Status</a>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <h5>Delivery Location</h5>
                                            <p class="m-0 text-info font-weight-bold"><?php echo $location['city'] ?></p>
                                            <p class="m-0 text-info font-weight-bold"><?php echo $location['township'] ?></p>
                                            <p class="m-0"><b><?php echo $delis['address_details'] ?></b></p>
                                            <?php if ($delivery['status'] == 'processing') { ?>
                                                <p class="f-s-13 text-danger font-italic font-weight-bold">Processing</p>
                                            <?php } elseif ($delivery['status'] == 'shipped') { ?>
                                                <span class="m-0 f-s-13 text-warning font-italic font-weight-bold">Shipped at</span><br>
                                                <span class="text-muted"><?php echo $delivery['shipping_date'] ?></span>
                                            <?php } elseif ($delivery['status'] == 'delivered') { ?>
                                                <span class="m-0 f-s-13 text-green font-italic font-weight-bold">Delivered at</span><br>
                                                <span class="text-muted"><?php echo $delivery['delivered_date'] ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Orders -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Orders</h4>
                        <div class="custom-media-object-2">
                            <?php foreach ($orders as $order) { 
                                $pid = $order['product_detail_id'];
                                $product = $order_controller->getProductListByInvoice($pid);
                            ?>
                            <div class="media border-bottom-1 p-t-15 image-container">
                                <img class="thumbnail" src="images/product/<?php echo $product['random_image'] ?>" data-name="<?php echo $product['random_image'] ?>">
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <h5><?php echo $product['product_name'] ?></h5>
                                            <p class="m-0"><b>Size: </b><?php echo $product['psize'] ?></p>
                                            <p class="m-0"><b>Color: </b><?php echo $product['pcolor'] ?></p>
                                            <p class="m-0"><b>Qty: </b><?php echo $order['quantity'] ?></p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p class="text-muted"><i class="color-danger ti-minus m-r-5"></i><?php echo $product['price'] ?> <span class="XRP m-l-10">KS</span></p>
                                        </div>
                                        <div class="col-lg-3 text-right">
                                            <h5 class="text-muted"></h5>
                                            <span class="badge badge-success"><?php echo $order['cus_status'] ?></span>
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
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
    Content body end
***********************************-->
<div id="fullscreenModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="fullImage">
    <div id="imageName"></div>
</div>
<script>
    var modal = document.getElementById("fullscreenModal");
    var modalImg = document.getElementById("fullImage");
    var captionText = document.getElementById("imageName");
    var thumbnails = document.getElementsByClassName("thumbnail");

    for (let i = 0; i < thumbnails.length; i++) {
        thumbnails[i].onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.getAttribute("data-name");
        }
    }

    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        modal.style.display = "none";
    }

    modal.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<?php include('layouts/footer.php'); ?>
