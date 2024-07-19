<?php include_once 'layouts/header.php'; ?>


<section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="content">
          <h1 class="page-name">Cart</h1>
          <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">cart</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>



<div class="page-wrapper">
  <div class="cart shopping">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="block">
            <div class="product-list">
              <form method="post" action="checkout.php">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="">Item Name</th>
                      <th class="">Item Price</th>
                      <th class="">Quantity</th>
                      <th class="">Amount</th>
                      <th class="">Actions</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                      $subtotal=$total=0;
                    foreach ($cart as $c) { 
                      $subtotal = $c["price"]*$c["quantity"];
                      $total += $subtotal 
                      ?>
                      <tr class="cart-item" data-cart-id="<?php echo $c['cart_id']; ?>">
                        <td>
                          <div class="product-info">
                            <img width="80" src="Admin/images/product/<?php echo htmlspecialchars($c['random_image']); ?>" alt="" />
                            <a href="#"><?php echo $c["product_name"]; ?></a>
                          </div>
                        </td>
                        <td><?php echo $c["price"] . " Ks"; ?></td>
                        <td><?php echo $c["quantity"] ; ?><a href=product-single.php?pid=<?php echo $c["product_id"] ;?>&edit_cart=<?php echo $c["cart_id"]?>> <i class="tf-ion-edit"></i></a></td>
                        
                        <td><?php echo $subtotal . " Ks"; ?></td>
                        <td>
                          <a class="product-remove" href="#" data-cart-id="<?php echo $c['cart_id']; ?>" onclick="return confirm('Are you sure to remove?');">Remove</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>

                </table>
                <a href="shop-sidebar.php" class="btn btn-main mt-20 btn-solid-border"><< Shopping</a>
                <a class="btn pull-right mt-10 text-red"><?php echo "Total : ".$total." Ks"; ?></a>
                <a href="checkout.php" class="btn mt-20 btn-main pull-right">Checkout</a>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    $('.product-remove').click(function(e) {
        e.preventDefault(); // Prevent the default action of the link
        
        var cart_id = $(this).attr('data-cart-id'); // Get the cart_id from the data attribute
        
        // Send AJAX request to remove item from cart
        $.ajax({
            url: 'remove_cart.php', // URL to your server-side script handling deletion
            type: 'POST',
            data: { cart_id: cart_id }, // Data to send - cart_id to identify the item to remove
            success: function(response) {
                if (response === 'success') {
                    // Remove the corresponding <tr> from the table
                    $('tr[data-cart-id="' + cart_id + '"]').fadeOut(300, function() {
                        $(this).remove();
                    });
                  } else {
                    alert('Failed to remove item from cart.');
                }
            },
            error: function() {
                alert('Error removing item from cart.');
            }
        });
    });
});
</script>


<?php
include_once 'layouts/footer.php';
?>