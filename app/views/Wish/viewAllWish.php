</html><?php $this->view('header'); ?>
<!-- Page Title -->
<title>Zenithal Zone Designs | Wish</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Navbar -->
    <?php $this->view('navBar'); ?>


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
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <h1><?= __('Wish List') ?></h1>
                            <a href="\Wish\removeAllFromWish" class="btn btn-lg btn-outline-primary" style="width: auto; height:auto; float:right;"><i class="fa fa-eraser"> <?= __('Clear All') ?></i></a>
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">
                                        <h3><?= __('Items') ?></h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $index => $product) {
                                    $prod = new \app\models\Product();
                                    $prod = $prod->getProductByID($product->product_id);
                                ?>
                                    <tr>
                                        <td>
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $prod->title ?></h5>
                                                <p class="card-text"><?= $prod->description ?></p>
                                                <p class="card-text">Price: <?= $prod->price ?>$</p>
                                                <?php
                                                $picture = new \app\models\Picture();
                                                $picture = $picture->getCountForProduct($product->product_id);
                                                echo "<img src='/uploads/{$picture[0]->filename}' alt='thumbnail' class='img-thumbnail img-fluid' width='100' height='auto'>";
                                                ?>
                                                <a href="\Wish\removeFromWish?product_id=<?= $prod->product_id ?>" style="float:right" class="btn btn-primary pull-right"><?= __('Remove') ?></a>
                                            </div>
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
    <?php
    include('app/views/Product/offcanvas/searchCanvas.php');
    ?>
    <!-- Footer -->
    <?php $this->view('footer'); ?>
</body>

</html>