<?php $this->view('header'); ?>
<!-- Page Title -->
<title>Zenithal Zone Designs | Customer Profile</title>
<link rel="stylesheet" href="/app/views/Admin/css/modifyprofile.css">

</head>


<body>
	<?php
	include('app/views/navbar.php');
	?>

	<div id='main'>
		<form method='post' action=''>
			<div class="form-group">
				<label><?= __('Name') ?>:<input type="text" class="form-control" name="name" placeholder="Jon" value='<?= $data->name ?>' disabled/></label>
			</div>
			<div class="form-group">
				<label><?= __('Email') ?>:<input type="text" class="form-control" name="email" placeholder="jjo@12.com" value='<?= $data->email ?>' disabled/></label>
			</div>
			<div class="form-group">
				<label><?= __('Username') ?>:<input type="text" class="form-control" name="username" placeholder="Doe" value='<?= $data->username ?>' disabled/></label>
			</div>
			<div class="form-group">
				<label><?= __('Current Password') ?>:<input type="password" class="form-control" name="password" placeholder="password"></label>
			</div>
			<div class="form-group">
				<label><?= __('New Password: At Least 8 Characters') ?><input type="password" class="form-control" name="new_password" placeholder="new_password" pattern=".{8,}" /></label>
			</div>
			<div class="form-group">
				<label><?= __('Confirm New Password') ?>:<input type="password" class="form-control" name="confirm_password" placeholder="confirm_password" /></label>
			</div>
			<div class="form-group">
				<input type="submit" name="action" value="Update my profile" />
				<a href='/Customer/viewProfile'><?= __('Cancel') ?></a>
			</div>
		</form>
	</div>

	<?php
	include('app/views/Product/offcanvas/searchCanvas.php');
	?>
</body>

</html>