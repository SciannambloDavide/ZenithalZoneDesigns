<!doctype html>
<html lang="en">

<head>
	<title>Review Manage</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
			max-width: 100px;
			max-height: 150px;
		}
	</style>
</head>

<body onload="disableButton()">
	<div class="wrapper d-flex align-items-stretch">
	<?php
            include('app/views/Admin/adminSideBar.php');
        ?>

		<!-- Page Content  -->
		<div id="content" class="p-4 p-md-5">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
						<i class="fa fa-bars"></i>
						<span class="sr-only">Toggle Menu</span>
					</button>
					<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fa fa-bars"></i>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="nav navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link" href="\User\index"><?= __("Home") ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="\User\logout"><?= __("Logout") ?></a>
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<!-- BODY CONTENT -->
			<h2 class="mb-4"><?= __("Reviews Management") ?></h2>
			<div class="col-lg-22">
				<div class="row mb-4 mt-4">
					<div class="col-md-12">
					</div>
				</div>
				<div class="row">
					<!-- FORM Panel -->
					<!-- Table Panel -->
					<div class="col-md-12">
						<div class="card">
							<div class="card-header d-flex justify-content-between align-items-center" id="cardColor">
								<b style="font-size: 20px;"><?= __("List of Reviews") ?>
									<form action="" method="GET" class="input-group mb-3">
										<select name="sortOption" class="form-control" style="font-size: 14px;">
											<option value=""><?= __("--Select Option") ?></option>
											<option value="nameASC"><?= __("Product's Name A-Z") ?></option>
											<option value="nameDESC"><?= __("Product's Name Z-A") ?></option>
											<option value="statusASC"><?= __("Status Inactive-Active") ?></option>
											<option value="statusDESC"><?= __("Status Active-Inactive") ?></option>
											<option value="dateASC"><?= __("Date Oldest-Latest") ?></option>
											<option value="dateDESC"><?= __("Date Latest-Oldest") ?></option>
										</select>
										<button class="btn btn-outline-light" type="submit"><?= __("Sort") ?></button>
										<a href="/Admin/reviewManagement"><button class="btn btn-outline-light" type="button"><?= __("Reset") ?></button></a>
									</form>
									<form method="GET" action="" class="input-group mb-3">
										<input type="text" class="form-control" placeholder="<?= __("Search By Product ID") ?>" name="content" />
										<button class="btn btn-outline-light" type="submit"><?= __("Search") ?></button>
									</form>

								</b>
								<div class="">
									<form method="GET" action="" class="input-group mb-3" id="statusForm">
										<input type="hidden" name="review_ids" id="reviewIds">
										<button class="btn btn-lg btn-outline-light" style="width: auto; height:auto;" onclick="setReviewIds('/Admin/approveMultipleStatus')" id="approveButton"><i class="fa fa-plus"> <?= __("Approve Selected") ?></i></button>
										<button class="btn btn-lg btn-outline-light" style="width: auto; height:auto;" onclick="setReviewIds('/Admin/denyMultipleStatus')" id="denyButton"><i class="fa fa-plus"> <?= __("Deny Selected") ?></i></button>
									</form>
									<button class="btn btn-lg btn-outline-light" style="width: auto; height:auto;" onclick="selectAll()" <?php 
										if (count($data) === 0) {
											echo "disabled";
									   }
									?>><i class="fa fa-check" id="selectAllButton"> <?= __("Select All") ?></i></button>
								</div>

							</div>

							<div class="card-body">
								<table class="table table-condensed table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center"><?= __("Select") ?></th>
											<th class="text-center">#</th>
											<th class=""><?= __("Title") ?></th>
											<th class="text-center"><?= __("Status") ?></th>
											<th class="text-center"><?= __("Product") ?></th>
											<th class="text-center"><?= __("Date Added") ?></th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($data as $index => $review) {
											$product = new \app\models\Product();
											$product = $product->getProductByID($review->product_id);
										?>
											<tr>
												<!-- Checkbox -->
												<td class="text-center">
													<input type="checkbox" name="review_ids" value="<?= $review->review_id ?>" onchange="disableButton()">
												</td>
												<!-- ID -->
												<td class="text-center"><?= $review->review_id ?></td>
												<!-- Title -->
												<td>
													<p><b><?= $review->title ?></b></p>
												</td>
												<!-- Status -->
												<td class="text-center">
													<?php
													echo "<a href='/Admin/toggleStatus?id=$review->review_id'>";
													if ($review->status == 1) {
														echo  __("[Active]") ;
													} else {
														echo  __("[Inactive]") ;
													}
													echo "</a>";
													?>
												</td>
												<!-- Product Details -->
												<td class="text-center">
													<p><?= __("Name") ?>: <?= $product->title ?><br></p>
													<p>ID: <?= $product->product_id ?></p>
												</td>
												<!-- Date Added -->
												<td class="text-center">
													<p><?= $review->date ?><br></p>
												</td>
												<!-- Action -->
												<td class="text-center">
													<a href='/Admin/adminDeleteReview?id=<?= $review->review_id ?>'><button class="btn btn-sm btn-outline-danger delete_product" type="button"><?= __("Delete") ?></button></a>
													<a href='/Product/viewProduct?id=<?= $review->product_id ?>'><button class="btn btn-sm btn-outline-secondary edit_product" type="button"><?= __("View") ?></button></a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>

								</table>
							</div>
						</div>
					</div>
					<!-- Table Panel -->
				</div>
			</div>
		</div>
	</div>

	<script>
		function setReviewIds(url) {
			// Get all checkboxes
			var checkboxes = document.querySelectorAll('input[name="review_ids"]:checked');
			// Extract review IDs
			var reviewIds = Array.from(checkboxes).map(function(checkbox) {
				return checkbox.value;
			});
			// Set the review IDs as a comma-separated string in the hidden input field
			document.getElementById('reviewIds').value = reviewIds.join(',');
			document.getElementById('statusForm').action = url;
			// Submit the form
			document.getElementById('statusForm').submit();
		}

		function disableButton() {
			var checkboxes = document.querySelectorAll('input[name="review_ids"]:checked');
			// Extract product IDs
			var reviewIds = Array.from(checkboxes).map(function(checkbox) {
				return checkbox.value;
			});
			if (reviewIds.length == 0) {
				document.getElementById('approveButton').disabled = true;
				document.getElementById('denyButton').disabled = true;
			} else {
				document.getElementById('approveButton').disabled = false;
				document.getElementById('denyButton').disabled = false;
			}
		}

		function selectAll() {
			var checkboxes = document.querySelectorAll('input[name="review_ids"]');
			var selectButton = document.getElementById('selectAllButton');
			if (selectButton.innerHTML == " Select All") {
				checkboxes.forEach(function(checkbox) {
					checkbox.checked = true;
					selectButton.innerHTML = " Deselect All";
					document.getElementById('approveButton').disabled = false;
					document.getElementById('denyButton').disabled = false;
				});
			} else {
				checkboxes.forEach(function(checkbox) {
					checkbox.checked = false;
					document.getElementById('approveButton').disabled = true;
					document.getElementById('denyButton').disabled = true;
					selectButton.innerHTML = " Select All";
				});
			}
		}
	</script>
	<script src="/app/views/Admin/js/jquery.min.js"></script>
	<script src="/app/views/Admin/js/popper.js"></script>
	<script src="/app/views/Admin/js/bootstrap.min.js"></script>
	<script src="/app/views/Admin/js/main.js"></script>
</body>

</html>