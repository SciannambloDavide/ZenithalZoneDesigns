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
        <nav id="sidebar">
            <div class="p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(/images/logo.PNG);"></a>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="\Admin\dashboard">Dashboard</a>
                    </li>
                    <li>
                        <a href="\Admin\productManagement">Product Management</a>
                    </li>
                    <li>
                        <a href="\Admin\reviewManagement">Review Management</a>
                    </li>
                </ul>
            </div>
        </nav>

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
                                <a class="nav-link" href="\User\index">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="\User\logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- BODY CONTENT -->
            <h2 class="mb-4">Products Management</h2>
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
                                <b style="font-size: 20px;">List of Reviews
                                    <form action="" method="GET" class="input-group mb-3">
                                        <select name="sortOption" class="form-control" style="font-size: 14px;">
                                            <option value="">--Select Option</option>
                                            <option value="nameASC">Product's Name A-Z</option>
                                            <option value="nameDESC">Product's Name Z-A</option>
                                            <option value="priceASC">Product's Price ASC</option>
                                            <option value="priceDESC">Product's Price DESC</option>
                                            <option value="typeASC">Product's Type A-Z</option>
                                            <option value="typeDESC">Product's Type Z-A</option>
                                        </select>
                                        <button class="btn btn-outline-light" type="submit">Sort</button>
                                        <a href="/Admin/productManagement"><button class="btn btn-outline-light" type="button">Reset</button></a>
                                    </form>
                                    <form method="GET" action="" class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search By Name" name="content" />
                                        <button class="btn btn-outline-light" type="submit">Search</button>
                                    </form>
                                </b>
                            </div>


                            <div class="card-body">
                                <table class="table table-condensed table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="">Title</th>
                                            <th class="">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data as $index => $review) {
                                        ?>
                                            <tr>
                                                <!-- ID -->
                                                <td class="text-center"><?= $review->product_id ?></td>
                                                <!-- Title -->
                                                <td>
                                                    <p> <b><?= $review->title ?></b></p>
                                                </td>
                                                <!-- Status -->
                                                <td class="">
                                                    <?php
                                                    echo "<a href='/Admin/toggleStatus?id=$review->review_id'>";
                                                    if ($review->status == 1) {
                                                        echo "[Active]";
                                                    } else {
                                                        echo "[Inactive]";
                                                    }
                                                    echo " 
                                                    </a> </td>
			                                        ";
                                                    ?>

                                                </td>
                                                <!-- Action -->
                                                <td class="text-center">
                                                    <a href='/Admin/adminEditReview?id=<?= $review->product_id ?>'><button class="btn btn-sm btn-outline-primary edit_product\" type="button">Edit</button></a>
                                                    <a href='/Admin/adminDeleteReview?id=<?= $review->product_id ?>'> <button class="btn btn-sm btn-outline-danger delete_product\" type="button">Delete</button></a>
                                                    <a href='/Product/view?id=<?= $review->product_id ?>'> <button class="btn btn-sm btn-outline-secondary edit_product\" type="button">View</button></a>
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

    <script src="/app/views/Admin/js/jquery.min.js"></script>
    <script src="/app/views/Admin/js/popper.js"></script>
    <script src="/app/views/Admin/js/bootstrap.min.js"></script>
    <script src="/app/views/Admin/js/main.js"></script>
</body>

</html>