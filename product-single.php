<?php
include_once 'layouts/header.php';
include_once __DIR__ . '/Admin/controller/productController.php';

$product_controller = new productController();



if (isset($_GET['pid'])) {
	$product_id = $_GET['pid'];
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
					<div class="product-size">
						<span>Size</span>
						<select class="form-control" name="size" id="sizeSelect">
							<option value="">Select</option>

							<?php
							$size = $product_controller->getSizeDistict($product_id);
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
					<div class="product-quantity">
						<span>Quantity:</span>
						<div class="product-quantity-slider">
							<input id="product-quantity" type="text" value="1" name="product-quantity" min="1">
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
					<a href="cart.html" class="btn btn-main mt-20">Add To Cart</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="tabCommon mt-20">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a></li>
						<li class=""><a data-toggle="tab" href="#reviews" aria-expanded="false">Reviews (3)</a></li>
					</ul>
					<div class="tab-content patternbg">
						<div id="details" class="tab-pane fade active in">
							<h4>Product Description</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut per spici</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis delectus quidem repudiandae veniam distinctio repellendus magni pariatur molestiae asperiores animi, eos quod iusto hic doloremque iste a, nisi iure at unde molestias enim fugit, nulla voluptatibus. Deserunt voluptate tempora aut illum harum, deleniti laborum animi neque, praesentium explicabo, debitis ipsa?</p>
						</div>
						<div id="reviews" class="tab-pane fade">
							<div class="post-comments">
								<ul class="media-list comments-list m-bot-50 clearlist">
									<!-- Comment Item start-->
									<li class="media">

										<a class="pull-left" href="#!">
											<img class="media-object comment-avatar" src="images/blog/avater-1.jpg" alt="" width="50" height="50" />
										</a>

										<div class="media-body">
											<div class="comment-info">
												<h4 class="comment-author">
													<a href="#!">Jonathon Andrew</a>

												</h4>
												<time datetime="2013-04-06T13:53">July 02, 2015, at 11:34</time>
												<a class="comment-button" href="#!"><i class="tf-ion-chatbubbles"></i>Reply</a>
											</div>

											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut ante eleifend eleifend.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod laborum minima, reprehenderit laboriosam officiis praesentium? Impedit minus provident assumenda quae.
											</p>
										</div>

									</li>
									<!-- End Comment Item -->

									<!-- Comment Item start-->
									<li class="media">

										<a class="pull-left" href="#!">
											<img class="media-object comment-avatar" src="images/blog/avater-4.jpg" alt="" width="50" height="50" />
										</a>

										<div class="media-body">

											<div class="comment-info">
												<div class="comment-author">
													<a href="#!">Jonathon Andrew</a>
												</div>
												<time datetime="2013-04-06T13:53">July 02, 2015, at 11:34</time>
												<a class="comment-button" href="#!"><i class="tf-ion-chatbubbles"></i>Reply</a>
											</div>

											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut ante eleifend eleifend. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni natus, nostrum iste non delectus atque ab a accusantium optio, dolor!
											</p>

										</div>

									</li>
									<!-- End Comment Item -->

									<!-- Comment Item start-->
									<li class="media">

										<a class="pull-left" href="#!">
											<img class="media-object comment-avatar" src="images/blog/avater-1.jpg" alt="" width="50" height="50">
										</a>

										<div class="media-body">

											<div class="comment-info">
												<div class="comment-author">
													<a href="#!">Jonathon Andrew</a>
												</div>
												<time datetime="2013-04-06T13:53">July 02, 2015, at 11:34</time>
												<a class="comment-button" href="#!"><i class="tf-ion-chatbubbles"></i>Reply</a>
											</div>

											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut ante eleifend eleifend.
											</p>

										</div>

									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="products related-products section">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>Related Products</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="product-item">
					<div class="product-thumb">
						<span class="bage">Sale</span>
						<img class="img-responsive" src="images/shop/products/product-5.jpg" alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<span data-toggle="modal" data-target="#product-modal">
										<i class="tf-ion-ios-search"></i>
									</span>
								</li>
								<li>
									<a href="#"><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<a href="#!"><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">Reef Boardsport</a></h4>
						<p class="price">$200</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="product-item">
					<div class="product-thumb">
						<img class="img-responsive" src="images/shop/products/product-1.jpg" alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<span data-toggle="modal" data-target="#product-modal">
										<i class="tf-ion-ios-search-strong"></i>
									</span>
								</li>
								<li>
									<a href="#"><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<a href="#!"><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">Rainbow Shoes</a></h4>
						<p class="price">$200</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="product-item">
					<div class="product-thumb">
						<img class="img-responsive" src="images/shop/products/product-2.jpg" alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<span data-toggle="modal" data-target="#product-modal">
										<i class="tf-ion-ios-search"></i>
									</span>
								</li>
								<li>
									<a href="#"><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<a href="#!"><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">Strayhorn SP</a></h4>
						<p class="price">$230</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="product-item">
					<div class="product-thumb">
						<img class="img-responsive" src="images/shop/products/product-3.jpg" alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<span data-toggle="modal" data-target="#product-modal">
										<i class="tf-ion-ios-search"></i>
									</span>
								</li>
								<li>
									<a href="#"><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<a href="#!"><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">Bradley Mid</a></h4>
						<p class="price">$200</p>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal product-modal fade" id="product-modal">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<i class="tf-ion-close"></i>
	</button>
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-8">
						<div class="modal-image">
							<img class="img-responsive" src="images/shop/products/modal-product.jpg" />
						</div>
					</div>
					<div class="col-md-3">
						<div class="product-short-details">
							<h2 class="product-title">GM Pendant, Basalt Grey</h2>
							<p class="product-price">$200</p>
							<p class="product-short-description">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem iusto nihil cum. Illo laborum numquam rem aut officia dicta cumque.
							</p>
							<a href="#!" class="btn btn-main">Add To Cart</a>
							<a href="#!" class="btn btn-transparent">View Product Details</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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
                    
                    // Log color_id and color to console for verification
                    console.log('Color ID: ' + color.color_id + ', Color Name: ' + color.color); 
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


<?php
include_once 'layouts/footer.php';

?>
