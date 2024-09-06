<!doctype html>
<html lang="en">

<head>
	<title>Change Image</title>
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
			max-width: auto;
			max-height: auto;
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
			<h2 class="mb-4"><?= __("Image Management") ?></h2>
			<div class="row mx-auto">
				<!-- Form as a card on the right -->
				<div class="col-md-16">
					<div class="card">
						<div class="card-header"><!--  -->
							<b><?= __("Change Image") ?></b>
						</div>
						<div class="card-body">
							<form method="POST" action="" enctype="multipart/form-data">
								<!-- Form content -->
								<div class="row">
									<div class="form-group">
										<form method="post" enctype="multipart/form-data">
											<label for="product_image"><?= __("Select an image file to modify") ?>:</label>
											<input type="file" class="form-control" name="newPicture" accept="image/png, image/jpeg, image/jpg" required id="product_image">
											<input type="submit" name="action" class="btn btn-sm btn-outline-dark" value="<?= __("Change") ?>">
										</form>
									</div>
									<?php
									if ($data['error'] != null) {
										echo "<p>$data</p>";
									}
									echo "
											<p>
											<img src='/uploads/$picture->filename' style='margin:20px' class='img-fluid rounded mx-auto d-block'>
											</p>
											";
									?>


								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




	<script src="/app/views/Admin/js/jquery.min.js"></script>
	<script src="/app/views/Admin/js/popper.js"></script>
	<script src="/app/views/Admin/js/bootstrap.min.js"></script>
	<script src="/app/views/Admin/js/main.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

	<script>
		$(document).ready(function() {
			$("#position").select2({
				allowClear: true,
				placeholder: 'Category'
			});
		});
	</script>

</body>

</html>