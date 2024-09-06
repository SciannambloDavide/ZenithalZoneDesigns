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

<body onload="disableRemove()">
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
            <h2 class="mb-4"><?= __("Add Products to Category") ?>: <b><?= $data['category']->title ?></b></h2>

            <div class="col-md-13">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <b><?= __("List of Products Without") ?> <b><?= $data['category']->title ?> </b><?= __("Sort") ?></b>
                            <form method="GET" action="" class="input-group " id="categoryForm">
                                <input type="hidden" name="product_ids" id="productIds">
                                <input type="hidden" name="id" id="id" value="<?= $data['category']->category_id ?>">
                                <button class="btn btn-sm btn-outline-dark  ml-auto" style="width: auto; height:auto; margin-right: 5px;" onclick="setProductIds('/Category/addMultiple')" id="removeButton"><i class="fa fa-plus"> <?= __("Add") ?></i></button>
                            </form>
                            <button class="btn btn-sm btn-outline-dark" style="width: auto; height:auto;" onclick="selectAll()"><i class="fa fa-check" id="selectAllButton"> <?= __("Select All") ?></i></button>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Img</th>
                                    <th class=""><?= __("Product") ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data['products'] as $index => $product) {

                                ?>
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="product_ids" value="<?= $product->product_id ?>" onchange="disableRemove()">
                                        </td>
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
                                        <!-- Product's Info -->
                                        <td class="">
                                            <p><?= __("Name") ?>: <b><?= $product->title ?></b></p>
                                            <p><small><?= __("Description") ?>: <b><?= $product->description ?></b></small></p>
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

    <script>
        function setProductIds(url) {
            // Get all checkboxes
            var checkboxes = document.querySelectorAll('input[name="product_ids"]:checked');
            // Extract product IDs
            var productIds = Array.from(checkboxes).map(function(checkbox) {
                return checkbox.value;
            });
            if (productIds.length == 0) {
                return;
            }
            document.getElementById('productIds').value = productIds;
            document.getElementById('categoryForm').action = url;
            document.getElementById('categoryForm').submit();
        }

        function selectAll() {
            var checkboxes = document.querySelectorAll('input[name="product_ids"]');
            var selectButton = document.getElementById('selectAllButton');
            if (selectButton.innerHTML == " <?= __("Select All") ?>") {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = true;
                    selectButton.innerHTML = " <?= __("Deselect All") ?>";
                    document.getElementById('removeButton').disabled = false;
                });
            } else {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                    document.getElementById('removeButton').disabled = true;
                    selectButton.innerHTML = " <?= __("Select All") ?>";
                });
            }
        }

        function disableRemove() {
            var checkboxes = document.querySelectorAll('input[name="product_ids"]:checked');
            // Extract product IDs
            var productIds = Array.from(checkboxes).map(function(checkbox) {
                return checkbox.value;
            });
            if (productIds.length == 0) {
                document.getElementById('removeButton').disabled = true;
            } else {
                document.getElementById('removeButton').disabled = false;
            }
        }
    </script>

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