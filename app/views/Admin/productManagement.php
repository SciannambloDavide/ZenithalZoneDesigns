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
            <h2 class="mb-4"><?= __("Products Management") ?></h2>
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
                                <b style="font-size: 20px;"><?= __("List of Products") ?>
                                    <form action="" method="GET" class="input-group mb-3">
                                        <select name="sortOption" class="form-control" style="font-size: 14px;">
                                            <option value=""><?= __("--Select Option") ?></option>
                                            <option value="nameASC"><?= __("Product's Name A-Z") ?></option>
                                            <option value="nameDESC"><?= __("Product's Name Z-A") ?></option>
                                            <option value="priceASC"><?= __("Product's Price ASC") ?></option>
                                            <option value="priceDESC"><?= __("Product's Price DESC") ?></option>
                                            <option value="idASC"><?= __("Product's ID ASC") ?></option>
                                            <option value="idDESC"><?= __("Product's ID DESC") ?></option>
                                        </select>
                                        <button class="btn btn-outline-light" type="submit"><?= __("Sort") ?></button>
                                        <a href="/Admin/productManagement"><button class="btn btn-outline-light" type="button"><?= __("Reset") ?></button></a>
                                    </form>
                                    <form method="GET" action="" class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="<?= __("Search By Name") ?>" name="content" />
                                        <button class="btn btn-outline-light" type="submit"><?= __("Search") ?></button>
                                    </form>
                                </b>
                                <!-- New Entry button -->
                                <a href="/Product/create" class="btn btn-lg btn-outline-light" style="width: auto; height:auto;"><i class="fa fa-plus"> <?= __("New Entry") ?></i></a>
                            </div>


                            <div class="card-body">
                                <table class="table table-condensed table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="">Img</th>
                                            <th class=""><?= __("Category") ?></th>
                                            <th class=""><?= __("Product") ?></th>
                                            <th class=""><?= __("Other Info") ?></th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['products'] as $index => $product) {
                                            $product_cat = new \app\models\Product_category();
                                            $product_cat = $product_cat->getAllByProductId($product->product_id);
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $product->product_id ?></td>
                                                <!--Image-->
                                                <td class="">
                                                    <div class="row justify-content-center">
                                                        <?php
                                                        $picture = new \app\models\Picture();
                                                        $picture = $picture->getCountForProduct($product->product_id);
                                                        echo "<img src='/uploads/{$picture[0]->filename}' alt='thumbnail' class='img-thumbnail img-fluid' width='100' height='auto'>";
                                                        ?>

                                                    </div>
                                                </td>
                                                <td>
                                                    <!--Category-->
                                                    <?php
                                                    foreach ($product_cat as $index => $product_category) {
                                                        $category = new \app\models\Category();
                                                        $category = $category->getByCatId($product_category->category_id);
                                                        echo "<p><b>$category->title</b></p>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="">
                                                    <p><?= __("Name") ?>: <b><?= $product->title ?></b></p>
                                                    <p><small><?= __("Description") ?>: <b><?= $product->description ?></b></small></p>
                                                </td>
                                                <td>
                                                    <p><small><?= __("Regular Price") ?>: <b><?= $product->price ?></b></small></p>
                                                    <p><small><?= __("In Stock") ?>: <b><?= $product->in_stock ?  __("Yes") : __("No") ?></b></small></p>
                                                    <?php if ($product->in_stock == 1) : ?>
                                                        <p><small><?= __("Quantity") ?>: <b><?= $product->quantity ?></b></small></p>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href='/Picture/ProductImage?id=<?= $product->product_id ?>'><button class="btn btn-sm btn-outline-primary edit_product\" type="button"><?= __("Edit Photos") ?></button></a>
                                                    <a href='/Product/edit?id=<?= $product->product_id ?>'><button class="btn btn-sm btn-outline-primary edit_product\" type="button"><?= __("Edit") ?></button></a>
                                                    <a href='/Product/delete?id=<?= $product->product_id ?>'> <button class="btn btn-sm btn-outline-danger delete_product\" type="button"><?= __("Delete") ?></button></a>
                                                    <a href='/Product/viewProduct?id=<?= $product->product_id ?>'> <button class="btn btn-sm btn-outline-secondary edit_product\" type="button"><?= __("View") ?></button></a>
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
    <div class="modal" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?= $data['message'] ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __("Close") ?></button>
                </div>
            </div>
        </div>
    </div>
    <script src="/app/views/Admin/js/jquery.min.js"></script>
    <script src="/app/views/Admin/js/popper.js"></script>
    <script src="/app/views/Admin/js/bootstrap.min.js"></script>
    <script src="/app/views/Admin/js/main.js"></script>
    <?php
    if (isset($data['message'])) {
    ?>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#myModal').modal('show');
            });
        </script>
    <?php
    }
    ?>
</body>

</html>