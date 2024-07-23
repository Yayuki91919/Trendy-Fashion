<?php include_once 'layouts/header.php';
	include_once __DIR__. '/Admin/controller/collaborationController.php';
	$collaboration_controller = new CollaborationController();
	$collaboration = $collaboration_controller->getCollaboration();
?>


<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Collaboration Information</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<?php echo $collaboration['info']; ?>
			</div>
		</div>
	</div>
</section>



<?php
include_once 'layouts/footer.php';
?>