<!doctype html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
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

<body>
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
                            <li class="nav-item active">
                                <a class="nav-link" href="\User\index"><?= __("Home") ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="\User\logout"><?= __("Logout") ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="contact-form">
                            <h2><?= __("Contact a User") ?></h2>
                            <form method="post" action="/Admin/contactUser">
                                <div class="form-group">
                                    <label for="email"><?= __("Customer Email") ?></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="subject"><?= __("Subject") ?></label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="form-group">
                                    <label for="message"><?= __("Message") ?></label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="send"><?= __("Submit") ?></button>
                            </form>
                        </div>

                        <!-- Separator -->
                        <div style="margin-top: 10px; margin-bottom: 10px;">
                            <span style="display: inline-block; width: 100%; text-align: center;">------------- <?= __("or") ?> ---------------</span>
                        </div>

                        <!-- Download Button for Subscribed Users -->
                        <form action="/Admin/downloadUserList" method="post" style="margin-bottom: 20px;">
                            <button type="submit" class="btn btn-secondary"><?= __("Download User List") ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/app/views/Admin/js/jquery.min.js"></script>
    <script src="/app/views/Admin/js/popper.js"></script>
    <script src="/app/views/Admin/js/bootstrap.min.js"></script>
    <script src="/app/views/Admin/js/main.js"></script>
</body>

</html>