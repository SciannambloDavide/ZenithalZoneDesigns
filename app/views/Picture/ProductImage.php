<!doctype html>
<html lang="en">

<head>
	<title>Picture upload</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="/app/views/Admin/css/style.css">
	<style>
		td {
			vertical-align: middle !important;
		}

		td p {
			margin: unset
		}

		table td img {
			max-width: 100px;
			max-height: 150px;
		}

		img {
			max-width: 70px;
			max-height: 120px;
		}

		#images {
			display: flex;
			justify-content: space-around;
			margin: auto;

		}
	</style>
</head>

<body>
	<div class="wrapper d-flex align-items-stretch">
		<?php
		include('app/views/Admin/adminSideBar.php');
		?>

		<!-- Page Content  -->
		<div id="content" class="p-4 p-md-5">

			<?php
			include('app/views/Product/offcanvas/adminNavbar.php');
			?>

			<!-- BODY CONTENT -->
			<h2 class="mb-4"><?= __("Add 5 Maximum Images") ?></h2>
			<div class="row mx-auto">
				<!-- Form as a card on the right -->
				<div class="col-md-16">
					<div class="card">
						<div class="card-header"><!--  -->
							<b><?= __("Update Image") ?></b>
						</div>
						<div class="card-body">
							<form method="POST" action="" enctype="multipart/form-data">
								<!-- Form content -->
								<div class="row">
									<!-- Product title -->
									<div class="col-md-12">

										<div class="form-group">
											<form method="post" enctype="multipart/form-data">
												<label for="product_image"><?= __("Select an image file to upload") ?>:</label>
												<input type="file" class="form-control" name="newPicture" accept="image/png, image/jpeg, image/jpg" required id="product_image">
												<input type="submit" name="action" class="btn btn-sm btn-outline-dark" value="<?= __("Add") ?>">
											</form>
										</div>
										<label for="title"><?= __("Product Images") ?></label>
										<div id='images'>


											<?php
											if ($data['error'] != null) {
												echo "<p>$data</p>";
											}

											foreach ($pictures as $picture) {
												echo "<div>
															<img src='/uploads/$picture->filename' class='img-thumbnail'>
															<a href='/Picture/editImage?id=$picture->picture_id' class='btn btn-outline-success btn-sm'>" . __("Edit") . "</a>
															<a href='/Picture/deletePhoto?id=$picture->picture_id' class='btn btn-outline-danger btn-sm'>" . __("Delete") . "</a>
														</div>
													";
											}
											?>

										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" tabindex="-1" role="dialog" id="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Notification</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><?= $data['message'] ?></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __("Close") ?></button>
				</div>
			</div>
		</div>
	</div>
	<script src="/app/views/Admin/js/jquery.min.js"></script>
	<script src="/app/views/Admin/js/popper.js"></script>
	<script src="/app/views/Admin/js/bootstrap.min.js"></script>
	<script src="/app/views/Admin/js/main.js"></script>
	<script>
		$(document).ready(function() {
			$("#position").select2({
				allowClear: true,
				placeholder: 'Category'
			});
		});
	</script>
	<?php
	if (isset($data['message'])) {
	?>
		<script type="text/javascript">
			$(window).on('load', function() {
				$('#myModal').modal('show');
			});
		</script>
	<?php
	}
	?>


</body>

</html>