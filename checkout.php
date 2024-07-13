
    <?php 
    include_once 'layouts/header.php'; 
    include_once __DIR__ . '/Admin/controller/locationController.php';
    $location_controller = new LocationController();
    $city = $township = "";
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
                            <form class="checkout-form">
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" class="form-control" id="full_name">
                                </div>
                                <div class="form-group">
                                    <label for="user_address">Email</label>
                                    <input type="text" class="form-control" id="user_email">
                                </div>
                                <div class="form-group">
                                    <label for="user_phone">Phone</label>
                                    <input type="text" class="form-control" id="user_phone">
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
                                    <input type="text" class="form-control" id="user_address" placeholder="">
                                </div>
                                <a href="confirmation.php" class="btn btn-main mt-20">Place Order</a>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-checkout-details">
                            <div class="block">
                                <h4 class="widget-title">Order Summary</h4>
                                <div class="media product-card">
                                    <a class="pull-left" href="product-single.html">
                                        <img class="media-object" src="images/shop/cart/cart-1.jpg" alt="Image" />
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="product-single.html">Ambassador Heritage 1921</a></h4>
                                        <p class="price">1 x $249</p>
                                        <span class="remove">Remove</span>
                                    </div>
                                </div>
                                <ul class="summary-prices">
                                    <li>
                                        <span>Subtotal:</span>
                                        <span class="price">$249</span>
                                    </li>
                                    <li>
                                        <span>Shipping Fee:</span>
                                        <span id="txt">Free</span>
                                    </li>
                                </ul>
                                <div class="summary-total">
                                    <span>Total</span>
                                    <span>$249</span>
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
    xmlhttp.open("GET","gettown.php?q="+str,true);
    xmlhttp.send();
  }
}
function showFee(str) {
  if (str == "") {
    document.getElementById("txt").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txt").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","getfee.php?f="+str,true);
    xmlhttp.send();
  }
}
    </script>
    <?php include_once 'layouts/footer.php'; ?>
