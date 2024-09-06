<?php $this->view('header'); ?>



<!-- Page Title -->
<title>Zenithal Zone Designs | Cart</title>


</head>

<body class="">

    <!-- NavBar -->
    <?php $this->view('navBar'); ?>
    <!-- Main Section-->
    <section class="mt-5 container ">
        <!-- Page Content Goes Here -->
        <h1 class="mb-6 display-5 fw-bold text-center"><?= __('Your Cart') ?></h1>
        <div class="row g-4 g-md-8">
            <!-- Cart Items -->
            <div class="col-12 col-lg-6 col-xl-7">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="d-none d-sm-table-cell"></th>
                                <th class="ps-sm-3"><?= __('Details') ?></th>
                                <th>Qty</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $index => $cart_item) : ?>
                                <?php
                                $prod = new \app\models\Product();
                                $prod = $prod->getProductByID($cart_item->product_id);

                                $Product_category = new \app\models\Product_category();
                                $Product_category = $Product_category->getAllByProductId($prod->product_id);
                                $Category = new \app\models\Category();

                                $cartItemModel = new \app\models\Cart_item();
                                $cartItems = $cartItemModel->getCartDetails($_SESSION["customer_id"]);

                                foreach ($Product_category as $singleCategory) {
                                    $Category = $Category->getByCatId($singleCategory->category_id);
                                    $picture = new \app\models\Picture();
                                    $picture = $picture->getAllForProductCartItem($singleCategory->product_id);
                                    $filename = $picture[0]->filename;
                                }
                                $priceafterqty = $prod->price * $cart_item->quantity;
                                ?>
                                <tr>
                                    <!-- image -->
                                    <td class="d-none d-sm-table-cell">
                                        <picture class="d-block bg-light p-3 f-w-20">
                                            <img src='/uploads/<?= $filename ?>' class="rounded img-fluid">
                                        </picture>
                                    </td>
                                    <!-- image -->

                                    <!-- Details -->
                                    <td>
                                        <div class="ps-sm-3">
                                            <h6 class="mb-2 fw-bolder">
                                                <?= $prod->title ?>
                                            </h6>
                                            <small class="d-block text-muted"><?= $Category->title ?></small>
                                        </div>
                                    </td>
                                    <!-- Details -->

                                    <!-- Qty -->
                                    <td>
                                        <div class="px-3">
                                            <span class="small text-muted mt-1"><?= $cart_item->quantity ?> @
                                                $ <?= $prod->price ?></span>
                                        </div>
                                    </td>
                                    <!-- /Qty -->

                                    <!-- Actions -->
                                    <td>
                                        <form action="/Cart/updateQuantity" method="post">
                                            <div class="input-group">
                                                <input type="number" class="form-control quantity-input" name="quantity" min="1" max="<?=$prod->quantity?>" value="<?= $cart_item->quantity ?>" data-product-id="<?= $prod->product_id ?>" >
                                                <input type="hidden" name="product_id" value="<?= $prod->product_id ?>">
                                                <button type="submit" class="btn btn-primary"><?= __('Update') ?></button>
                                            </div>
                                        </form>
                                    </td>

                                    <td class="f-h-0">
                                        <div class="d-flex justify-content-between flex-column align-items-end h-100">
                                            <a href="/Cart/removeFromCart?product_id=<?= $prod->product_id ?>&customer_id=<?= $_SESSION['customer_id'] ?>" class="btn btn-danger btn-sm remove-item-btn"><?= __('Remove') ?></a>
                                            <p class="fw-bolder mt-3 m-sm-0">$<?= $priceafterqty ?></p>
                                        </div>
                                    </td>
                                    <!-- /Actions -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            $shipping = 8.95;
            $subtotal = $shipping;
            $tax1 = 0;
            $total = 0;
            foreach ($data as $index => $cart_item) {
                $prod = new \app\models\Product();
                $prod = $prod->getProductByID($cart_item->product_id);
                $priceafterqty2 = $prod->price * $cart_item->quantity;
                $subtotal += $priceafterqty2;
                $tax1 = $subtotal * 0.15;
                $total = 0;
                $total += $tax1 + $subtotal;
                $tax1 = number_format($tax1, 2);
                $total = number_format($total, 2);
            }
            echo (" <div class=\"col-12 col-lg-6 col-xl-5\">
                               <div class=\"bg-dark p-4 p-md-5 text-white\">
                                   <h3 class=\"fs-3 fw-bold m-0 text-center\">". __('Order Summary'). "</h3>
                                   <div class=\"py-3 border-bottom-white-opacity\">
                                       <div class=\"d-flex justify-content-between align-items-center mb-2 flex-column flex-sm-row\">
                                           <p class=\"m-0 fw-bolder fs-6\">". __('Subtotal'). "</p>
                                           <p class=\"m-0 fs-6 fw-bolder\">$$subtotal</p>
                                       </div>
                                       <div
                                           class=\"d-flex justify-content-between align-items-center flex-column flex-sm-row mt-3 m-sm-0\">
                                           <p class=\"m-0 fw-bolder fs-6\">". __('Shipping'). "</p>
                                           <span class=\"text-white opacity-75 small\">$$shipping</span>
                                       </div>
                                   </div>
                                   <div class=\"py-3 border-bottom-white-opacity\">
                                       <div class=\"d-flex justify-content-between align-items-center flex-column flex-sm-row\">
                                           <div>
                                               <p class=\"m-0 fs-5 fw-bold\">". __('Grand Total'). "</p>
                                               <span class=\"text-white opacity-75 small\">Inc $$tax1 ". __('Sales Tax'). "<
                                               /span>
                                           </div>
                                           <p class=\"mt-3 m-sm-0 fs-5 fw-bold\">$$total</p>
                                       </div>
                                   </div>")
            ?>
            <!-- /Cart Items -->
            <!-- <div class="col-12 col-lg-6 col-xl-5">
                <div class="bg-dark p-4 p-md-5 text-white">
                    <h3 class="fs-3 fw-bold m-0 text-center">Order Summary</h3>
                    <div class="py-3 border-bottom-white-opacity">
                        <div class="d-flex justify-content-between align-items-center mb-2 flex-column flex-sm-row">
                            <p class="m-0 fw-bolder fs-6">Subtotal</p>
                            <p class="m-0 fs-6 fw-bolder">$422.99</p>
                        </div>
                        <div
                            class="d-flex justify-content-between align-items-center flex-column flex-sm-row mt-3 m-sm-0">
                            <p class="m-0 fw-bolder fs-6">Shipping</p>
                            <span class="text-white opacity-75 small">Will be set at checkout</span>
                        </div>
                    </div>
                    <div class="py-3 border-bottom-white-opacity">
                        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row">
                            <div>
                                <p class="m-0 fs-5 fw-bold">Grand Total</p>
                                <span class="text-white opacity-75 small">Inc $45.89 sales tax</span>
                            </div>
                            <p class="mt-3 m-sm-0 fs-5 fw-bold">$422.99</p>
                        </div>
                    </div> -->
     

            <!-- Checkout Button-->
            <a href="./checkout" class="btn btn-white w-100 text-center mt-3" role="button"><i class="ri-secure-payment-line align-bottom"></i> <?= __("Proceed to Checkout") ?></a>
            <!-- Checkout Button-->
        </div>

        <!-- Payment Icons-->
        <ul class="list-unstyled d-flex justify-content-center mt-3">
            <li class="mx-1 border d-flex align-items-center p-2"><i class="pi pi-paypal"></i></li>
            <li class="mx-1 border d-flex align-items-center p-2"><i class="pi pi-mastercard"></i></li>
            <li class="mx-1 border d-flex align-items-center p-2"><i class="pi pi-american-express"></i></li>
            <li class="mx-1 border d-flex align-items-center p-2"><i class="pi pi-visa"></i></li>
        </ul>
        <!-- / Payment Icons-->
        </div>
        <!-- Cart Summary -->

        <!-- /Cart Summary -->
        </div>

        <!-- /Page Content -->
    </section>
    <!-- / Main Section-->

    <!-- Footer -->
    <?php $this->view('footer'); ?>

    <!-- Offcanvas Imports-->
    <!-- Cart Offcanvas-->
    <div class="offcanvas offcanvas-end d-none" tabindex="-1" id="offcanvasCart">
        <div class="offcanvas-header d-flex align-items-center">
            <h5 class="offcanvas-title" id="offcanvasCartLabel">Your Cart</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column justify-content-between w-100 h-100">
                <div>

                    <div class="mt-4 mb-5">
                        <p class="mb-2 fs-6"><i class="ri-truck-line align-bottom me-2"></i> <span class="fw-bolder">$22</span> away
                            from free delivery</p>
                        <div class="progress f-h-1">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- Cart Product-->
                    <div class="row mx-0 pb-4 mb-4 border-bottom">
                        <div class="col-3">
                            <picture class="d-block bg-light">
                                <img class="img-fluid" src="../../assets/images/products/product-1.jpg" alt="Bootstrap 5 Template by Pixel Rocket">
                            </picture>
                        </div>
                        <div class="col-9">
                            <div>
                                <h6 class="justify-content-between d-flex align-items-start mb-2">
                                    Mens StormBreaker Jacket
                                    <i class="ri-close-line"></i>
                                </h6>
                                <small class="d-block text-muted fw-bolder">Size: Medium</small>
                                <small class="d-block text-muted fw-bolder">Qty: 1</small>
                            </div>
                            <p class="fw-bolder text-end m-0">$85.00</p>
                        </div>
                    </div>

                    <!-- Cart Product-->
                    <div class="row mx-0 pb-4 mb-4 border-bottom">
                        <div class="col-3">
                            <picture class="d-block bg-light">
                                <img class="img-fluid" src="../../assets/images/products/product-2.jpg" alt="Bootstrap 5 Template by Pixel Rocket">
                            </picture>
                        </div>
                        <div class="col-9">
                            <div>
                                <h6 class="justify-content-between d-flex align-items-start mb-2">
                                    Mens Torrent Terrain Jacket
                                    <i class="ri-close-line"></i>
                                </h6>
                                <small class="d-block text-muted fw-bolder">Size: Medium</small>
                                <small class="d-block text-muted fw-bolder">Qty: 1</small>
                            </div>
                            <p class="fw-bolder text-end m-0">$99.00</p>
                        </div>
                    </div>

                </div>
                <div class="border-top pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0 fw-bolder">Subtotal</p>
                        <p class="m-0 fw-bolder">$233.33</p>
                    </div>
                    <a href="./checkout" class="btn btn-orange btn-orange-chunky mt-5 mb-2 d-block text-center">Checkout</a>
                    <a href="./cart" class="btn btn-dark fw-bolder d-block text-center transition-all opacity-50-hover">View Cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Filters Offcanvas-->
    <div class="offcanvas offcanvas-end d-none" tabindex="-1" id="offcanvasFilters">
        <div class="offcanvas-header d-flex align-items-center">
            <h5 class="offcanvas-title" id="offcanvasFiltersLabel">Category Filters</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column justify-content-between w-100 h-100">

                <!-- Filters-->
                <div>
                    <!-- Filter Category -->
                    <div class="mb-4">
                        <h2 class="mb-4 fs-6 mt-2 fw-bolder">Jacket Category</h2>
                        <nav>
                            <ul class="list-unstyled list-default-text">
                                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                            Waterproof Jackets</span> <span class="text-muted ms-4">(21)</span></a>
                                </li>
                                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Down
                                            Jackets</span> <span class="text-muted ms-4">(13)</span></a>
                                </li>
                                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                            Windproof Jackets</span> <span class="text-muted ms-4">(18)</span></a>
                                </li>
                                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Hiking
                                            Jackets</span> <span class="text-muted ms-4">(25)</span></a>
                                </li>
                                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Climbing
                                            Jackets</span> <span class="text-muted ms-4">(11)</span></a>
                                </li>
                                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Trekking
                                            Jackets</span> <span class="text-muted ms-4">(19)</span></a>
                                </li>
                                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Allround
                                            Jackets</span> <span class="text-muted ms-4">(24)</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- / Filter Category-->

                    <!-- Price Filter -->
                    <div class="py-4 widget-filter widget-filter-price border-top">
                        <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron" data-bs-toggle="collapse" href="#filter-modal-price" role="button" aria-expanded="false" aria-controls="filter-modal-price">
                            Price
                        </a>
                        <div id="filter-modal-price" class="collapse">
                            <div class="filter-price mt-6"></div>
                            <div class="d-flex justify-content-between align-items-center mt-7">
                                <div class="input-group mb-0 me-2 border">
                                    <span class="input-group-text bg-transparent fs-7 p-2 text-muted border-0">$</span>
                                    <input type="number" min="00" max="1000" step="1" class="filter-min form-control-sm border flex-grow-1 text-muted border-0">
                                </div>
                                <div class="input-group mb-0 ms-2 border">
                                    <span class="input-group-text bg-transparent fs-7 p-2 text-muted border-0">$</span>
                                    <input type="number" min="00" max="1000" step="1" class="filter-max form-control-sm flex-grow-1 text-muted border-0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Price Filter -->

                    <!-- Brands Filter -->
                    <div class="py-4 widget-filter border-top">
                        <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron" data-bs-toggle="collapse" href="#filter-modal-brands" role="button" aria-expanded="false" aria-controls="filter-modal-brands">
                            Brands
                        </a>
                        <div id="filter-modal-brands" class="collapse">
                            <div class="input-group my-3 py-1">
                                <input type="text" class="form-control py-2 filter-search rounded" placeholder="Search" aria-label="Search">
                                <span class="input-group-text bg-transparent p-2 position-absolute top-2 end-0 border-0 z-index-20"><i class="ri-search-2-line text-muted"></i></span>
                            </div>
                            <div class="simplebar-wrapper">
                                <div class="filter-options" data-pixr-simplebar>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-0">
                                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brands-modal-0">Adidas <span class="text-muted">(21)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-1">
                                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brands-modal-1">Asics <span class="text-muted">(13)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-2">
                                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brands-modal-2">Canterbury <span class="text-muted">(18)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-3">
                                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brands-modal-3">Converse <span class="text-muted">(25)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-4">
                                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brands-modal-4">Donnay <span class="text-muted">(11)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-5">
                                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brands-modal-5">Nike <span class="text-muted">(19)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-6">
                                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brands-modal-6">Millet <span class="text-muted">(24)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-7">
                                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brands-modal-7">Puma <span class="text-muted">(11)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-8">
                                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brands-modal-8">Reebok <span class="text-muted">(19)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-9">
                                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brands-modal-9">Under Armour <span class="text-muted">(24)</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Brands Filter -->

                    <!-- Type Filter -->
                    <div class="py-4 widget-filter border-top">
                        <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron" data-bs-toggle="collapse" href="#filter-modal-type" role="button" aria-expanded="false" aria-controls="filter-modal-type">
                            Type
                        </a>
                        <div id="filter-modal-type" class="collapse">
                            <div class="input-group my-3 py-1">
                                <input type="text" class="form-control py-2 filter-search rounded" placeholder="Search" aria-label="Search">
                                <span class="input-group-text bg-transparent p-2 position-absolute top-2 end-0 border-0 z-index-20"><i class="ri-search-2-line text-muted"></i></span>
                            </div>
                            <div class="filter-options">
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-0">
                                    <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-type-modal-0">Slip On </label>
                                </div>
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-1">
                                    <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-type-modal-1">Strap Up </label>
                                </div>
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-2">
                                    <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-type-modal-2">Zip Up </label>
                                </div>
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-3">
                                    <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-type-modal-3">Toggle </label>
                                </div>
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-4">
                                    <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-type-modal-4">Auto </label>
                                </div>
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-5">
                                    <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-type-modal-5">Click </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Type Filter -->

                    <!-- Sizes Filter -->
                    <div class="py-4 widget-filter border-top">
                        <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron" data-bs-toggle="collapse" href="#filter-modal-sizes" role="button" aria-expanded="false" aria-controls="filter-modal-sizes">
                            Sizes
                        </a>
                        <div id="filter-modal-sizes" class="collapse">
                            <div class="filter-options mt-3">
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-0">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-0">6.5</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-1">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-1">7</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-2">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-2">7.5</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-3">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-3">8</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-4">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-4">8.5</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-5">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-5">9</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-6">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-6">9.5</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-7">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-7">10</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-8">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-8">10.5</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-9">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-9">11</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-10">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-10">11.5</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Sizes Filter -->

                    <!-- Colour Filter -->
                    <div class="py-4 widget-filter border-top">
                        <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron" data-bs-toggle="collapse" href="#filter-modal-colour" role="button" aria-expanded="false" aria-controls="filter-modal-colour">
                            Colour
                        </a>
                        <div id="filter-modal-colour" class="collapse">
                            <div class="filter-options mt-3">
                                <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-primary">
                                    <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-0">
                                    <label class="form-check-label" for="filter-colours-modal-0"></label>
                                </div>
                                <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-success">
                                    <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-1">
                                    <label class="form-check-label" for="filter-colours-modal-1"></label>
                                </div>
                                <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-danger">
                                    <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-2">
                                    <label class="form-check-label" for="filter-colours-modal-2"></label>
                                </div>
                                <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-info">
                                    <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-3">
                                    <label class="form-check-label" for="filter-colours-modal-3"></label>
                                </div>
                                <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-warning">
                                    <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-4">
                                    <label class="form-check-label" for="filter-colours-modal-4"></label>
                                </div>
                                <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-dark">
                                    <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-5">
                                    <label class="form-check-label" for="filter-colours-modal-5"></label>
                                </div>
                                <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-secondary">
                                    <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-6">
                                    <label class="form-check-label" for="filter-colours-modal-6"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Colour Filter -->
                </div>
                <!-- / Filters-->

                <!-- Filter Button-->
                <div class="border-top pt-3">
                    <a href="#" class="btn btn-dark mt-2 d-block hover-lift-sm hover-boxshadow">Done</a>
                </div>
                <!-- /Filter Button-->
            </div>
        </div>
    </div>
    <!-- Review Offcanvas-->
    <div class="offcanvas offcanvas-end d-none" tabindex="-1" id="offcanvasReview">
        <div class="offcanvas-header d-flex align-items-center">
            <h5 class="offcanvas-title" id="offcanvasReviewLabel">Leave A Review</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Review Form -->
            <form>
                <div class="form-group mb-3 mt-2">
                    <label class="form-label" for="formReviewName">Your Name</label>
                    <input type="text" class="form-control" id="formReviewName" placeholder="Your Name">
                </div>
                <div class="form-group mb-3 mt-2">
                    <label class="form-label" for="formReviewEmail">Your Email</label>
                    <input type="text" class="form-control" id="formReviewEmail" placeholder="Your Email">
                </div>
                <div class="form-group mb-3 mt-2">
                    <label class="form-label" for="formReviewTitle">Your Review Title</label>
                    <input type="text" class="form-control" id="formReviewTitle" placeholder="Review Title">
                </div>
                <div class="form-group mb-3 mt-2">
                    <label class="form-label" for="formReviewReview">Your Review</label>
                    <textarea class="form-control" name="formReviewReview" id="formReviewReview" cols="30" rows="5" placeholder="Your Review"></textarea>
                </div>
                <button type="submit" class="btn btn-dark hover-lift hover-boxshadow">Submit Review</button>
            </form>
            <!-- / Review Form-->
        </div>
    </div>
    <!-- Search Overlay-->
    <?php
    include('app/views/Product/offcanvas/searchCanvas.php');
    ?>
    <!-- Theme JS -->
    <!-- Vendor JS -->
    <script src="../../assets/js/vendor.bundle.js"></script>

    <!-- Theme JS -->
    <script src="../../assets/js/theme.bundle.js"></script>
</body>

</html>