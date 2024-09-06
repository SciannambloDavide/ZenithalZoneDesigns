<!doctype html>
<html lang="en">

<head>
    <title>Product Manage</title>
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
            <h2 class="mb-4"><?= __("Category Management") ?></h2>
            <div class="row mx-auto">
                <!-- Form as a card on the right -->
                <div class="col-md-16">
                    <div class="card">
                        <div class="card-header">
                            <b><?= __("Add Category") ?></b>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <!-- Form content -->
                                <div class="row">
                                    <!-- Category title -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title"><?= __("Category Title") ?></label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Category Title" required>
                                            <span id="productError" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <input type="submit" class="btn btn-outline-success btn-lg ml-auto " name="action" value="<?= __("Create") ?>">
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
</body>

</html>