<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Customer Profile</title>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="/app/includes/css.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
		crossorigin="anonymous"></script> -->
		<link rel="stylesheet" href="/app/views/Admin/css/viewprofile.css">

</head>


<body>
	<?php
	include('app/views/header.php');
	include('app/views/navbar.php');
	?>


	<!-- Main content area -->
	<div id='main'>
		<h1><?= __('Hello') ?> <?= $data['Customer']->name ?>!</h1>
		<dl>
			<dt>ID:</dt>
			<dd><?= $data['Customer']->customer_id ?></dd>

			<dt><?= __('Name') ?>:</dt>
			<dd><?= $data['Customer']->name ?></dd>

			<dt><?= __('Email') ?>:</dt>
			<dd><?= $data['Customer']->email ?></dd>

			<dt><?= __('Username') ?>:</dt>
			<dd><?= $data['Customer']->username ?></dd>

			<dt><?= __('Subscription') ?>:</dt>
			<dd><?= $data['isSubscribed'] ? 'You are subscribed to the newsletter' : 'You are not subscribed to the newsletter'; ?>
			</dd>

			<dt><?= __('Two-Factor Authentical') ?>:</dt>
			<dd><?= ($data['Customer']->secret !== null) ? __('ENABLED') : __('DISABLED') ; ?></dd>
		</dl>
		<div>
			<a href='/Customer/modify'><?= __('Modify My Profile') ?></a>
			<a href='/Customer/updatePassword'><?= __('Update Password') ?></a>
			<a href='/User/logout'><?= __('Logout') ?></a>
		</div>
	</div>

	<?php include ('app/views/Product/offcanvas/searchCanvas.php'); ?>

</body>

</html>