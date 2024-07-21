<?php
include_once 'layouts/header.php';
include_once __DIR__ . '/Admin/controller/productController.php';
include_once __DIR__ . '/Admin/controller/cartController.php';

$product_controller = new productController();
$cart_controller = new cartController();

if (isset($_GET['pid'])) {
	$product_id = $_GET['pid'];
}

$cid = $_SESSION['user_login']['customer_id'];
if (isset($_POST['addToCart'])) {
	$d_id = $_POST['d_id'];
	$quantity = $_POST['product-quantity'];
	$status = $cart_controller->addToCart($d_id, $cid, $quantity);
	if ($status) {
		// echo '<script> location.href="shop-sidebar.php?status=' . $status . '"</script>';
		echo '<script> location.href="cart.php?status=' . $status . '"</script>';
	} 

}
if (isset($_POST['updateCart'])) {
	$d_id = $_POST['d_id'];
	$quantity = $_POST['product-quantity'];
	$status = $cart_controller->updateCart($d_id, $cid, $quantity);
	if ($status) {
		echo '<script> location.href="cart.php?status=' . $status . '"</script>';
	} 
}

?>

<!-- Main Menu Section -->

<section class="single-product">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li><a href="shop-sidebar.php">Shop</a></li>
					<li class="active">Single Product</li>
				</ol>
			</div>
			<div class="col-md-6">
				<ol class="product-pagination text-right">
					<li><a href="blog-left-sidebar.html"><i class="tf-ion-ios-arrow-left"></i> Next </a></li>
					<li><a href="blog-left-sidebar.html">Preview <i class="tf-ion-ios-arrow-right"></i></a></li>
				</ol>
			</div>
		</div>
		<div class="row mt-20">
			<div class="col-md-4">
				<div class="single-product-slider">
					<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>

								<?php $ram_images = $product_controller->getRandomImages($product_id); ?>
								<?php foreach ($ram_images as $img) { ?>
									<div class='item active'>
										<img src="Admin/images/product/<?php echo $img['image_name']; ?>" alt='' data-zoom-image="Admin/images/product/<?php echo $img['image_name']; ?>" />
									</div>

								<?php
								} ?>

								<?php $images = $product_controller->getImages($product_id); ?>
								<?php foreach ($images as $img) { ?>
									<div class='item'>
										<img src="Admin/images/product/<?php echo $img['image_name']; ?>" alt='' data-zoom-image="Admin/images/product/<?php echo $img['image_name']; ?>" />
									</div>

								<?php
								} ?>

							</div>

							<!-- sag sol -->
							<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
								<i class="tf-ion-ios-arrow-left"></i>
							</a>
							<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
								<i class="tf-ion-ios-arrow-right"></i>
							</a>
						</div>

						<!-- thumb -->
						<ol class='carousel-indicators mCustomScrollbar meartlab'>
							<?php $ram1_images = $product_controller->getRandomImages($product_id); ?>
							<?php foreach ($ram1_images as $img) { ?>
								<li data-target='#carousel-custom' class='active'>
									<img src="Admin/images/product/<?php echo $img['image_name']; ?>" alt='' />
								</li>

							<?php
							} ?>
							<?php $images1 = $product_controller->getImages($product_id); ?>
							<?php foreach ($images1 as $img) { ?>
								<li data-target='#carousel-custom' data-slide-to='1'>
									<img src="Admin/images/product/<?php echo $img['image_name']; ?>" alt='' />
								</li>

							<?php
							} ?>

						</ol>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<?php
				$detail = $product_controller->getProducts($product_id);
				?>
				<div class="single-product-details">
					<h2><?php echo $detail['product_name']; ?></h2>
					<p class="product-price"><?php echo $detail['price'] . " Ks"; ?></p>

					<p class="product-description mt-20">
						<?php echo $detail['description']; ?>	
					</p>
					<?php if (isset($_GET['edit_cart'])) { 
						$cart_id = $_GET['edit_cart'];
						$e = $cart_controller->getEditCart($cart_id);
						
						?>
						<form action="<?php $_PHP_SELF ?>" method="post" onsubmit="return validateFormEdit()">
							<div class="product-size">
								<span>Size</span>
								
								<p class="form-control"><?php echo $e['size']; ?></p>
								
							</div>
							<div class="product-size">
								<span>Color</span>
								
								<p class="form-control"><?php echo $e['color']; ?></p>

							</div>

							<input type="hidden" name="d_id" id="d_id" value="<?php echo $e['d_id'] ?>" >
							<input type="hidden" name="avaliable_quantity" id="qty" value="<?php echo $e['max_qty'] ?>">

							<div class="product-quantity">
								<span>Quantity:</span>
								<div class="product-quantity-slider">
									<input id="product-quantity" type="text" name="product-quantity" min="1" value="<?php echo $e['quantity'] ?>">
								</div>
							</div>

							<div class="product-category">
								<span><?php echo $detail['category_name']; ?></span>
								<ul>
									<li><a href="product-single.html"><?php echo $detail['brand_name']; ?></a></li>
									<span>/</span>
									<li><a href="product-single.html"><?php echo $detail['type']; ?></a></li>
								</ul>
							</div>
							<input type="submit" value="Update Cart" name="updateCart" class="btn btn-main mt-20">
							<a href="cart.php" class="btn btn-main mt-20 btn-solid-border">View Cart</a>

						</form>

					<?php } else { ?>
						<form action="<?php $_PHP_SELF ?>" method="post" onsubmit="return validateForm()">
							<div class="product-size">
								<span>Size</span>
								<select class="form-control" name="size" id="sizeSelect">
									<option value="">Select</option>

									<?php
									$size = $product_controller->getSizeDistinct($product_id);
									foreach ($size as $s) {
										echo '<option value="' . $s['size_id'] . '">' . $s['size'] . '</option>';
									}
									?>
								</select>
							</div>
							<div class="product-size">
								<span>Color</span>
								<select class="form-control" name="color" id="colorSelect">
									<!-- Options will be populated dynamically via AJAX -->
								</select>
							</div>

							<input type="hidden" name="d_id" id="d_id">
							<input type="hidden" name="avaliable_quantity" id="qty">
							<input type="text" name="cart_quantity" id="cart_qty">

							<div class="product-quantity">
								<span>Quantity:</span>
								<div class="product-quantity-slider">
									<input id="product-quantity" type="text" name="product-quantity" min="1">
								</div>
							</div>

							<div class="product-category">
								<span><?php echo $detail['category_name']; ?></span>
								<ul>
									<li><a href="product-single.html"><?php echo $detail['brand_name']; ?></a></li>
									<span>/</span>
									<li><a href="product-single.html"><?php echo $detail['type']; ?></a></li>
								</ul>
							</div>
							<input type="submit" value="Add To Cart" name="addToCart" class="btn btn-main mt-20">
							<a href="cart.php" class="btn btn-main mt-20 btn-solid-border">View Cart</a>

						</form>

					<?php } ?>




				</div>
			</div>
		</div>

	</div>
</section>


<!-- Include jQuery from a CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$(document).ready(function() {
		$('#sizeSelect').change(function() {
			var selectedSize = $(this).val();
			var productId = '<?php echo $product_id; ?>';

			// AJAX call to fetch colors for selected size and product ID
			$.ajax({
				url: 'get_colors.php',
				method: 'POST',
				data: {
					size: selectedSize,
					product_id: productId
				},
				dataType: 'json',
				success: function(response) {
					$('#colorSelect').empty(); // Clear current options

					// Populate color options based on response
					$.each(response, function(index, color) {
						// Append an option with value as color_id and text as color
						$('#colorSelect').append('<option value="' + color.color_id + '">' + color.color + '</option>');
						$('#d_id').val(color.d_id);
						$('#qty').val(color.qty);
						$('#cart_qty').val(color.cart_quantity);
						console.log(color.d_id);
						console.log(color.qty);
						console.log(color.cart_quantity);
						console.log('Color ID: ' + color.color_id + ', Color Name: ' + color.color);

						$('#product-quantity').attr('max', color.qty);

					});
				},
				error: function(xhr, status, error) {
					console.error('Error fetching colors:', error);
					// Optionally handle errors
				}
			});
		});
	});
</script>

<script>
function validateForm() {
    var selectedQuantity = parseInt(document.getElementById('product-quantity').value);
    var availableQuantity = parseInt(document.getElementById('qty').value);
    var selectedSize = document.getElementById('sizeSelect').value;

    // Validate selected quantity
    if (selectedQuantity === 0) {
        alert('Please select at least 1 item.');
        return false; // Prevent form submission
    }

    // Validate available quantity
    if (selectedQuantity > availableQuantity) {
        alert('Only ' + availableQuantity + ' clothes left.');
        return false; // Prevent form submission
    }

    // Validate selected size
    if (selectedSize === "") {
        alert('Please select size.');
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}
function validateFormEdit() {
    var selectedQuantity = parseInt(document.getElementById('product-quantity').value);
    var availableQuantity = parseInt(document.getElementById('qty').value);

    // Validate selected quantity
    if (selectedQuantity === 0) {
        alert('Please select at least 1 item.');
        return false; // Prevent form submission
    }

    // Validate available quantity
    if (selectedQuantity > availableQuantity) {
        alert('Only ' + availableQuantity + ' clothes left.');
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}

</script>



<?php
include_once 'layouts/footer.php';

?>