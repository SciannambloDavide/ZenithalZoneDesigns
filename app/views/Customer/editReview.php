<html>

<head>
    <title><?= $name ?> view</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">-->
    <link rel="stylesheet" href="/app/includes/css.css">
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>-->
</head>

<body>
    <?php
    include('app/views/header.php');
    include('app/views/navbar.php');
    ?>
    <div id='main'>
        <form method='post' action=''>
            <div class="form-group">

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="contact-form">
                                <h2><?= __('Edit your review') ?></h2>
                                <form method="post" action="/ContactMessage/test">
                                    <div class="form-group">
                                        <label><?= __('Title') ?>:<input type="text" class="form-control" name="title" placeholder="Jon" required value="<?= $data->title ?>" /></label>
                                    </div>

                                    <div class="form-group">
                                        <p>Description:</p>
                                        <textarea class="form-control" id="comment" name="description" rows="4" cols="50" placeholder="Write your comment" required><?= $data->description ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <p><?= __('Rating') ?>:</p>
                                        <p>
                                            <span style="margin-right: 76px;">0</span>
                                            <span style="margin-right: 76px;">1</span>
                                            <span style="margin-right: 76px;">2</span>
                                            <span style="margin-right: 76px;">3</span>
                                            <span style="margin-right: 76px;">4</span>
                                            <span>5</span>
                                        </p>
                                        <label style="display: inline-block;width:550px;">

                                        </label>

                                        <input type="range" name="rating" class="form-range" min="0" max="5" id="customRange2" value="<?= $data->rating ?>">
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="send"><?= __('Update') ?></button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
</body>

</html>