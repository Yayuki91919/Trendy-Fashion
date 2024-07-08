<?php include_once 'layouts/header.php'; ?>


<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Purchase Confirmation</h1>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">purchase confirmation</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="page-wrapper">
  	<div class="purchase-confirmation shopping">
    	<div class="container">
      		<div class="row">
        		<div class="col-md-8 col-md-offset-2">
          			<div class="block ">
            			<div class="purchase-confirmation-details">
				            <table id="purchase-receipt" class="table">
				                <thead>
									<tr>
					                    <th><strong>Payment:</strong></th>
					                    <th>33056</th>
				                  	</tr>
				                </thead>

				                <tbody>

				                  	<tr>
				                    	<td class=""><strong>Payment Status:</strong></td>
				                    	<td class="">Complete</td>
				                  	</tr>


				                  	<tr>
				                    	<td><strong>Payment Method:</strong></td>
				                    	<td>Free Purchase</td>
				                  	</tr>
				                  	<tr>
				                    	<td><strong>Date:</strong></td>
				                    	<td>December 20, 2016</td>
				                  	</tr>
				                  	<tr>
				                    	<td><strong>Subtotal</strong></td>
				                    	<td>
				                      	$18.00        </td>
				                    </tr>

				                    <tr>
				                      	<td><strong>Total Price:</strong></td>
				                      	<td>$18.00</td>
				                    </tr>
				                </tbody>
				            </table>
              			</div>
            		</div>
          		</div>
        	</div>
      	</div>
    </div>
</div>



<?php
include_once 'layouts/footer.php';
?>