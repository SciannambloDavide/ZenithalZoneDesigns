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
                <label><?= __('Name') ?>:<input type="text" class="form-control" name="name" placeholder="Jon" value='<?= $data['Customer']->name ?>' required/></label>
            </div>
            <div class="form-group">
                <label><?= __('Email') ?>:<input type="text" class="form-control" name="email" placeholder="jjo@12.com" value='<?= $data['Customer']->email ?>' required/></label>
            </div>
            <div class="form-group">
                <label><?= __('Username') ?>:<input type="text" class="form-control" name="username" placeholder="Doe" value='<?= $data['Customer']->username ?>' required/></label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="newsletterCheckbox" name="newsletterCheckbox" <?php if($data['isSubscribed']) {echo 'checked';} ?>>
                <label for="newsletterCheckbox"><?= __('Subscribe to Newsletter') ?></label>
            </div>
            <div>
                <input type="checkbox" id="twoFactorCheckbox" name="twoFactorCheckbox" <?php if($data['Customer']->secret !== null) {echo 'checked';} ?>>
                <label for="twoFactorCheckbox"><?= __('Enable Two-Factor Authentication') ?></label>
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
