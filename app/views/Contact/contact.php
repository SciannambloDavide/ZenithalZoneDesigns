<?php $this->view('header'); ?>
<!-- Page Title -->
<title>Zenithal Zone Designs | Contact</title>
</head>

<body>
    <?php
    include('app/views/navbar.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="contact-form">
                    <h2><?= __('Contact Us') ?></h2>
                    <form method="post" action="/Contact/Contact_us">
                        <div class="form-group">
                            <label for="name"><?= __('Your Name') ?></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><?= __('Your Email') ?></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject"><?= __('Subject') ?></label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message"><?= __('Message') ?></label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="send"><?= __('Submit') ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Overlay-->
    <?php
    include('app/views/Product/offcanvas/searchCanvas.php');
    include('app/views/footer.php');
    ?>

    <body>

</html>