<!doctype html>
<html lang="en">

<head>
    <title>Order Management</title>
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
            <h2 class="mb-4"><?= __("Order Managment") ?></h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <b style="font-size: 20px;"><?= __("List of Orders") ?></b>
                            <!-- Sorting form -->
                            <form method="GET" action="" class="input-group mb-3">
                                <select name="sortOption" class="form-control">
                                    <option value="timeASC"><?= __("Time Ascending") ?></option>
                                    <option value="timeDESC"><?= __("Time Descending") ?></option>
                                    <option value="priceASC"><?= __("Price Ascending") ?></option>
                                    <option value="priceDESC"><?= __("Price Descending") ?></option>
                                </select>
                                <button class="btn btn-outline-secondary" type="submit"><?= __("Sort") ?></button>
                            </form>
                            <!-- Search form -->
                            <form method="GET" action="" class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="<?= __("Search by Order ID or Customer Name") ?>" name="search" />
                                <button class="btn btn-outline-secondary" type="submit"><?= __("Search") ?></button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-condensed table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><?= __("Order ID") ?></th>
                                        <th><?= __("Customer ID") ?></th>
                                        <th><?= __("Total Price") ?></th>
                                        <th><?= __("Status") ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= $order->order_id ?></td>
                                    <td><?= $order->customer_id ?></td>
                                    <td>$<?= $order->total_price ?></td>
                                    <td>
                                        <form action="/Admin/updateOrderStatus" method="post">
                                            <input type="hidden" name="order_id" value="<?= $order->order_id ?>">
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                <option value="0" <?= $order->status == 0 ? 'selected' : '' ?>><?= __("Placed") ?></option>
                                                <option value="1" <?= $order->status == 1 ? 'selected' : '' ?>><?= __("Shipped") ?></option>
                                                <option value="2" <?= $order->status == 2 ? 'selected' : '' ?>><?= __("Completed/Delivered") ?></option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            </table>
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