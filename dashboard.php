<?php include_once 'layouts/header.php'; ?>

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
					<li><a class="active" href="dashboard.html">Dashboard</a></li>
					<li><a href="order.php">Orders</a></li>
					<li><a href="address.php">Address</a></li>
					<li><a href="profile-details.php">Profile Details</a></li>
				</ul>
				<div class="dashboard-wrapper user-dashboard">
					<div class="total-order mt-20">
						<h4>Total Orders</h4>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Order ID</th>
										<th>Date</th>
										<th>Items</th>
										<th>Total Price</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><a href="#!">#252125</a></td>
										<td>Mar 25, 2016</td>
										<td>2</td>
										<td>$ 99.00</td>
									</tr>
									<tr>
										<td><a href="#!">#252125</a></td>
										<td>Mar 25, 2016</td>
										<td>2</td>
										<td>$ 99.00</td>
									</tr>
									<tr>
										<td><a href="#!">#252125</a></td>
										<td>Mar 25, 2016</td>
										<td>2</td>
										<td>$ 99.00</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<?php
include_once 'layouts/footer.php';
?>