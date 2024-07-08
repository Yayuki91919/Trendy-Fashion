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
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="order.php">Orders</a></li>
          <li><a class="active" href="address.php">Address</a></li>
          <li><a href="profile-details.php">Profile Details</a></li>
        </ul>
        <div class="dashboard-wrapper user-dashboard">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Country</th>
                  <th class="col-md-2 col-sm-3">Phone</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Nokia</td>
                  <td>Adam Smith</td>
                  <td>9/4 C Babor Road, Mohammad Pur, Dhaka</td>
                  <td>Bangladesh</td>
                  <td>+884 5452 6452</td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-default"><i class="tf-pencil2" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default"><i class="tf-ion-close" aria-hidden="true"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Samsung</td>
                  <td>Adam Smith</td>
                  <td>9/4 C Babor Road, Mohammad Pur, Dhaka</td>
                  <td>Bangladesh</td>
                  <td>+884 5452 6452</td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-default"><i class="tf-pencil2" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default"><i class="tf-ion-close" aria-hidden="true"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Motorola</td>
                  <td>Adam Smith</td>
                  <td>9/4 C Babor Road, Mohammad Pur, Dhaka</td>
                  <td>Bangladesh</td>
                  <td>+884 5452 6452</td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-default"><i class="tf-pencil2" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default"><i class="tf-ion-close" aria-hidden="true"></i></button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
include_once 'layouts/footer.php';
?>