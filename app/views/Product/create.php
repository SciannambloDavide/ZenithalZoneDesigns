<!doctype html>
<html lang="en">

<head>
    <title>Product Manage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

            <?php
            include('app/views/Product/offcanvas/adminNavbar.php');
            ?>

            <!-- BODY CONTENT -->
            <h2 class="mb-4"><?= __("Products Managment") ?></h2>
            <div class="row mx-auto">
                <!-- Form as a card on the right -->
                <div class="col-md-16">
                    <div class="card">
                        <div class="card-header"><!--  -->
                            <b><?= __("Add Product") ?></b>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <!-- Form content -->
                                <div class="row">
                                    <!-- Product title -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title"><?= __("Product Title") ?></label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="<?= __("Product Title") ?>" required>
                                            <span id="productError" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <!-- Select a product category -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category[]"><?= __("Product Type") ?></label><br>
                                            <select style="width: 32%" name="category[]" class="form-control" id="position" style="font-size: 14px;" multiple required>
                                                <?php
                                                foreach ($data as $index => $category) {
                                                    echo "<option value=\"$category->category_id\">$category->title</option> ";
                                                ?>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Regular price -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price"><?= __("Price") ?></label><br>
                                            <input type="number" class="form-control-sm" name="price" id="price" placeholder="12.5" min="0" step="0.01" required>
                                            <span id="regularPriceError" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <!-- Thumbnail -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="product_image"><?= __("Upload Product Thumbnail") ?></label>
                                            <input type="file" class="form-control" name="newPicture" id="newPicture" accept="image/png, image/jpeg, image/jpg" required>
                                            <span id="thumbnail_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <!-- In Stock -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="in_stock" name="in_stock">
                                                <label class="form-check-label" for="in_stock"><?= __("In Stock?") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Long/brief Description -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" rows="5" class="form-control" placeholder="Description" required></textarea>
                                            <span id="long_description_error" class="text-danger"></span>
                                        </div>
                                        <div class="form-group" id="quantity_container" style="display:none;">
                                            <label for="quantity"><?= __("Quantity") ?></label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" placeholder="<?= __("Enter Quantity") ?>">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#position").select2({
                allowClear: true,
                placeholder: 'Category'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#position").select2({
                allowClear: true,
                placeholder: 'Category'
            });

            $('#in_stock').change(function() {
                if ($(this).is(':checked')) {
                    $('#quantity_container').show();
                    $('#quantity').attr('required', true);
                } else {
                    $('#quantity_container').hide();
                    $('#quantity').removeAttr('required');
                }
            });
        });
    </script>
</body>

</html>