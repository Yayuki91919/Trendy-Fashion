<?php 
    include_once 'layouts/header.php'; 
    include_once __DIR__ . '/Admin/controller/locationController.php';
    include_once __DIR__. '/Admin/controller/deli_infoController.php';
    include_once __DIR__. '/Admin/controller/invoiceController.php';
    include_once __DIR__. '/Admin/controller/orderController.php';
    include_once __DIR__. '/Admin/controller/feeController.php';
    $location_controller = new LocationController();
    $deliinfo_controller=new DeliInfoController();
    $invoice_controller=new InvoiceController();
    $fee_controller=new FeeController();
    $order_controller=new OrderController();
    $city = $township = "";
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $location_id=$_POST['town'];
        $address=$_POST['address'];
        $cid = $_SESSION['user_login']['customer_id'];
        $d_info_id=$deliinfo_controller->createDeliinfo($name,$email,$phone,$location_id,$address);
        
        $fee=$fee_controller->getFeeInfoByLocationId($location_id);
        $fee_id=$fee['fee_id'];
        $invoice_date=date('Y-m-d');
        $invoice=$invoice_controller->getLastInvoice();
        if($invoice==null){
            $invoice_no="1001";
        }else{
            $invoice_no=$invoice+1;
        }
        $cart = $cartController->getUserCart($cid);
        $subtotal=$total=0;
        foreach ($cart as $c) {
            $subtotal = $c["quantity"] * $c["price"];
            $total += $subtotal;
        }
        $invoice_id=$invoice_controller->createInvoice($invoice_no,$cid,$d_info_id,$fee_id,$total,$invoice_date);
        foreach ($cart as $c) {
            $d_id=$c['d_id'];
            $qty=$c['quantity'];
            $cus_status="order";
            $orderAdd=$order_controller->addOrder($d_id,$qty,$invoice_id,$cus_status,$cid);
        }
        if($orderAdd){
             echo '<script>location.href="confirmation.php"</script>';
        }else{
            echo '<script>location.href="404.php"</script>';
        }
    }
?>

<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <h1 class="page-name">Checkout</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Checkout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="page-wrapper">
    <div class="checkout shopping">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="block billing-details">
                        <h4 class="widget-title">Address Details</h4>
                        <form class="checkout-form" action="checkout.php" id="phoneForm" method="post">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" class="form-control" id="user_email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="user_phone">Phone</label>
                                <input type="text" class="form-control" id="user_phone" name="phone" required>
                            </div>
                            <div class="checkout-country-code clearfix">
                                <div class="form-group">
                                    <select name="city" onchange="showUser(this.value)" class="form-control" required>
                                        <option value="">Select City</option>
                                        <?php 
                                            $cities = $location_controller->getCityGroupBy();
                                            foreach ($cities as $row) { ?>
                                        <option value="<?php echo $row['city']; ?>"><?php echo $row['city']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="town" id="txtHint" class="form-control" onchange="showFee(this.value)" required>
                                        <option value="">Select Township</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_address">Address</label>
                                <input type="text" class="form-control" id="user_address" placeholder="" name="address" required>
                            </div>
                            <input type="submit" value="Place Order" name="submit" class="btn btn-main mt-20">
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product-checkout-details">
                        <div class="block">
                            <h4 class="widget-title">Order Summary</h4>
                            <div class="media product-card">
                                <?php
                                $cart = $cartController->getUserCart($cid);
                                $subtotal=$total=0;
                                foreach ($cart as $c) {
                                    $subtotal = $c["quantity"] * $c["price"];
                                    $total += $subtotal;
                                ?>
                                <a class="pull-left" href="product-single.php">
                                    <img class="media-object" src="./Admin/images/product/<?php echo htmlspecialchars($c['random_image']); ?>" alt="Image" />
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="product-single.php"><?php echo $c['product_name']?></a></h4>
                                    <p><span><?php echo "Size: ".$c["size"]." & Color: ".$c["color"] ; ?></span></p>
                                    <p class="price"><?php echo $c["quantity"]; ?> x <?php echo $c["price"] . " Ks"; ?></p>
                                    <a href="shop-sidebar.php?removeCartId=<?php echo $c['cart_id']?>&name=<?php echo $c['product_name']?>" class="remove" onclick="return confirm('Are you sure to remove?');"><span class="remove">Remove</span></a>
                                </div>
                                <?php } ?>
                            </div>
                            <ul class="summary-prices">
                                <li>
                                    <span>Total:</span>
                                    <span class="price" id="subtotal"><?php echo $total . " Ks"; ?></span>
                                </li>
                                <li>
                                    <span>Shipping Fee:</span>
                                    <span id="shippingFee">0 Ks</span>
                                </li>
                            </ul>
                            <div class="summary-total">
                                <span>Total Amount:</span>
                                <span id="finalTotal"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gettown.php?q=" + str, true);
        xmlhttp.send();
    }
}

function showFee(str) {
    if (str == "") {
        document.getElementById("shippingFee").innerHTML = "0 Ks";
        calculateTotal();
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("shippingFee").innerHTML = this.responseText;
                calculateTotal(); // Recalculate the total when the shipping fee is updated
            }
        };
        xmlhttp.open("GET", "getfee.php?f=" + str, true);
        xmlhttp.send();
    }
}

function calculateTotal() {
    var subtotal = parseFloat(document.getElementById('subtotal').textContent.replace(" Ks", ""));
    var shippingFee = parseFloat(document.getElementById('shippingFee').textContent.replace(" Ks", ""));
    var finalTotal = subtotal + shippingFee;
    document.getElementById('finalTotal').textContent = finalTotal + " Ks";
}

document.addEventListener('DOMContentLoaded', calculateTotal);

document.getElementById('phoneForm').addEventListener('submit', function(e) {
    var phoneInput = document.getElementById('user_phone').value;
    if (!validateMyanmarPhone(phoneInput)) {
        e.preventDefault();
        alert('Please enter a valid Myanmar phone number.');
    }
});

function validateMyanmarPhone(phone) {
    var myanmarPhoneRegex = /^(09|\+?959)\d{7,9}$/;
    return myanmarPhoneRegex.test(phone);
}
</script>
<?php include_once 'layouts/footer.php'; ?>
