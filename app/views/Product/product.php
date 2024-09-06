<?php $this->view('header'); ?>
<!-- Page Title -->
<title>Zenithal Zone Designs | Product</title>
<style>
  #snackbar {
    visibility: hidden;
    /* Hidden by default. Visible on click */
    min-width: 250px;
    /* Set a default minimum width */
    margin-left: -125px;
    /* Divide value of min-width by 2 */
    background-color: #333;
    /* Black background color */
    color: #fff;
    /* White text color */
    text-align: center;
    /* Centered text */
    border-radius: 2px;
    /* Rounded borders */
    padding: 16px;
    /* Padding */
    position: fixed;
    /* Sit on top of the screen */
    z-index: 1;
    /* Add a z-index if needed */
    left: 50%;
    /* Center the snackbar */
    bottom: 30px;
    /* 30px from the bottom */
  }

  /* Show the snackbar when clicking on a button (class added with JavaScript) */
  #snackbar.show {
    visibility: visible;
    /* Show the snackbar */
    /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
  However, delay the fade out process for 2.5 seconds */
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
  }

  /* Animations to fade the snackbar in and out */
  @-webkit-keyframes fadein {
    from {
      bottom: 0;
      opacity: 0;
    }

    to {
      bottom: 30px;
      opacity: 1;
    }
  }

  @keyframes fadein {
    from {
      bottom: 0;
      opacity: 0;
    }

    to {
      bottom: 30px;
      opacity: 1;
    }
  }

  @-webkit-keyframes fadeout {
    from {
      bottom: 30px;
      opacity: 1;
    }

    to {
      bottom: 0;
      opacity: 0;
    }
  }

  @keyframes fadeout {
    from {
      bottom: 30px;
      opacity: 1;
    }

    to {
      bottom: 0;
      opacity: 0;
    }
  }
</style>
</head>

<body class="" onload="myFunction()">

  <!-- NavBar -->
  <?php $this->view('navBar'); ?>

  <!-- Main Section-->
  <section class="mt-5 ">
    <!-- Page Content Goes Here -->

    <!-- Product Top-->
    <section class="container">

      <!-- Breadcrumbs-->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/Product/viewProductAll?index=1"><?= __('Products') ?></a></li>

          <!-- Because we use composite table and another table genre, extra PHP code must be utilized. -->
          <?php

          $Product_category = new \app\models\Product_category();
          $Product_category = $Product_category->getAllByProductId($data['product']->product_id);
          $Category = new \app\models\Category();
          foreach ($Product_category as $singleCategory) {
            $Category = $Category->getByCatId($singleCategory->category_id);
            echo "<li class='breadcrumb-item'><a href='/Product/Category?id=$Category->category_id&index=1'>$Category->title</a></li>";
          }
          ?>
          <li class="breadcrumb-item active" aria-current="page"><?= $data['product']->title ?></li>
        </ol>
      </nav> <!-- /Breadcrumbs-->

      <div class="row g-5">

        <!-- Images Section-->
        <div class="col-12 col-lg-7">
          <div class="row g-2">
            <div class="swiper-container gallery-thumbs-vertical col-2 pb-4">
              <div class="swiper-wrapper">

                <?php
                $pictures = new \app\models\Picture();
                $pictures = $pictures->getAllForProduct($data['product']->product_id);

                foreach ($pictures as $index => $picture) {
                  echo "
            <div class='swiper-slide bg-light bg-light h-auto'>
                                <picture>
                                <img class='img-fluid mx-auto d-table' src='/uploads/$picture->filename' alt='image Template' style='width: 120px; height: 120.8px;'>
                                </picture>
                              </div>
            ";
                }

                ?>
              </div>
            </div>
            <div class="swiper-container gallery-top-vertical col-10">
              <div class="swiper-wrapper">
                <?php
                $pictures = new \app\models\Picture();
                $pictures = $pictures->getAllForProduct($data['product']->product_id);

                foreach ($pictures as $index => $picture) {
                  echo "
            <div class='swiper-slide bg-white h-auto'>
                                    <picture>
                                        <img class='img-fluid d-table mx-auto' src='/uploads/$picture->filename' style='width: 632px; height: 632px; alt='Bootstrap 5 Template by Pixel Rocket' data-zoomable>
                                    </picture>
                                </div>
            ";
                }

                ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /Images Section-->

        <!-- Product Info Section-->
        <div class="col-12 col-lg-5">
          <div class="pb-3">

            <!-- Product Name, Review, Brand, Price-->
            <div class="d-flex justify-content-between align-items-center mb-2">
              <p class="small fw-bolder text-uppercase tracking-wider text-muted mb-0 lh-1">Zenithal Zone Design</p>
              <div class="d-flex justify-content-start align-items-center">



                <!-- Review Stars Small-->
                <div class="rating position-relative d-table">
                  <?php
                  //this is to get the overall rating
                  $Reviews = new \app\models\Review();
                  $ReviewsCount = $Reviews->getAllForProductVerified($data['product']->product_id);
                  $rating1 = $Reviews->getCountForProductRatingCountVerified($_GET['id'], 1);
                  $rating2 = $Reviews->getCountForProductRatingCountVerified($_GET['id'], 2);
                  $rating3 = $Reviews->getCountForProductRatingCountVerified($_GET['id'], 3);
                  $rating4 = $Reviews->getCountForProductRatingCountVerified($_GET['id'], 4);
                  $rating5 = $Reviews->getCountForProductRatingCountVerified($_GET['id'], 5);
                  $Reviews = $Reviews->getAllForProductVerified($data['product']->product_id);
                  $ReviewsCount = count($Reviews);
                  $combinedRatings = (($rating1 * 1) + ($rating2 * 2) + ($rating3 * 3) + ($rating4 * 4) + ($rating5 * 5));
                  if ($combinedRatings != 0) {
                    //avg out of 5
                    $OverallRating =  $combinedRatings / $ReviewsCount;
                    //avg out of 100%
                    $OverallRating = $OverallRating * 100 / 5;
                  } else {
                    $OverallRating =  0;
                  }

                  $OverallRating = number_format($OverallRating, 2);
                  echo "                                    <div class='position-absolute stars' style='width: $OverallRating%'>
                                                        <i class='ri-star-fill text-dark mr-1'></i>
                                                        <i class='ri-star-fill text-dark mr-1'></i>
                                                        <i class='ri-star-fill text-dark mr-1'></i>
                                                        <i class='ri-star-fill text-dark mr-1'></i>
                                                        <i class='ri-star-fill text-dark mr-1'></i>
                                    </div>
                                    <div class='stars'>
                                        <i class='ri-star-fill mr-1 text-muted opacity-25'></i>
                                        <i class='ri-star-fill mr-1 text-muted opacity-25'></i>
                                        <i class='ri-star-fill mr-1 text-muted opacity-25'></i>
                                        <i class='ri-star-fill mr-1 text-muted opacity-25'></i>
                                        <i class='ri-star-fill mr-1 text-muted opacity-25'></i>
                                    </div>
                                    
                                    </div>            <small class='text-muted d-inline-block ms-2 fs-bolder'>($ReviewsCount)</small>

            "
                  ?>

                </div>
              </div>
              <h1 class="mb-2 fs-2 fw-bold"><?= $data['product']->title ?></h1>

              <div class="d-flex justify-content-start align-items-center">
                <p class="lead fw-bolder m-0 fs-3 lh-1 text-danger me-2">$<?= $data['product']->price ?></p>
                <!-- Removed both the sales and the hot topic review -->
                <!-- <s class="lh-1 me-2"><span class="fw-bolder m-0">$94.99</span></s>-->
                <!--- <p class="lead fw-bolder m-0 fs-6 lh-1 text-success">Save $10.00</p>-->
              </div>
              <!-- /Product Name, Review, Brand, Price-->

              <!-- Product Views-->
              <!--
                        <div class="d-flex justify-content-start mt-3">
                            <div class="alert bg-light rounded py-1 px-2 d-table m-0">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="ri-fire-fill lh-1 text-orange"></i>
                                    <div class="ms-2">
                                        <small class="opacity-75 fw-bolder lh-1">167 views today</small>
                                    </div>
                                </div>
                            </div>
                        </div>
        -->
              <!-- /Product Views-->

              <!-- Product Options-->
              <!--
                        <div class="border-top mt-4 mb-3">
                            <div class="product-option mb-4 mt-4">
                                <small class="text-uppercase d-block fw-bolder mb-2">
                                    Colour : <span class="selected-option fw-bold">Crimson Blue</span>
                                </small>
                                <div class="d-flex justify-content-start">
                                    <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom">
                                        <input type="radio" class="form-check-color-input" id="option-colour-1" name="option-colour"
                                            value="Dark Black">
                                        <label class="form-check-label" for="option-colour-1"></label>
                                    </div>
                                    <div
                                        class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-warning">
                                        <input type="radio" class="form-check-color-input" id="option-colour-2" name="option-colour"
                                            value="Sun Yellow">
                                        <label class="form-check-label" for="option-colour-2"></label>
                                    </div>
                                    <div
                                        class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-info">
                                        <input type="radio" class="form-check-color-input" id="option-colour-3" name="option-colour"
                                            value="Crimson Blue" checked>
                                        <label class="form-check-label" for="option-colour-3"></label>
                                    </div>
                                    <div
                                        class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-danger">
                                        <input type="radio" class="form-check-color-input" id="option-colour-4" name="option-colour"
                                            value="Cherry Red">
                                        <label class="form-check-label" for="option-colour-4"></label>
                                    </div>
                                </div>
                            </div>
                            -->

              <!-- information and  Size -->
              <div class="accordion" id="accordionExample" style="margin-top:10px; margin-bottom:10px;">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Description:
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <?= $data['product']->description ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <?= __('Details') ?>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                      <!-- Because we use composite table and another table genre, extra PHP code must be utilized. -->
                      <p><strong><?= __('Type Of Product') ?>:</strong>
                        <?php

                        $Product_category = new \app\models\Product_category();
                        $Product_category = $Product_category->getAllByProductId($data['product']->product_id);
                        $Category = new \app\models\Category();
                        foreach ($Product_category as $singleCategory) {
                          $Category = $Category->getByCatId($singleCategory->category_id);
                          echo "$Category->title ";
                        }
                        ?>
                      </p>
                      <p><strong><?= __('Is It in Stock') ?>:</strong> <?= $data['product']->in_stock == "1" ?  __('Yes') :  __('No') ?></p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- space between details and buttons -->
              <br>



              <!-- /Product Options-->
              <div id="snackbar"><?= $data['message'] ?></div>

              <!-- Add To Cart-->
              <div class="d-flex justify-content-between mt-3">
                <!--I put some PHP in the buttons to verify if you are a customer -->
                <form action="" method="GET" id="cartWishForm">
                  <input type="hidden" name="product_id" id="product_id" value="<?= $data['product']->product_id ?>">
                  <button class="btn btn-dark btn-dark-chunky flex-grow-1 me-2 text-white" onclick="addToCart('/Cart/addToCart')" <?= isset($_SESSION['customer_id']) ? '' : "disabled" ?>><?= isset($_SESSION['customer_id']) ? __('Add To Cart') : __('Please log in to add to cart')  ?></button>
                  <button class="btn btn-orange btn-orange-chunky" onclick="addToWish('/Wish/addToWish')" <?= isset($_SESSION['customer_id']) ? '' : "disabled" ?>><i class="ri-heart-line"></i></button>
                </form>

              </div>
 

            </div>
          </div>
          <!-- / Product Info Section-->
        </div>
    </section>
    <!-- / Product Top-->

    <section>

      <!-- Product Tabs-->
      <div class="mt-7 pt-5 border-top">
        <div class="container">
          <!-- Tab Nav-->
          <ul class="nav justify-content-center nav-tabs nav-tabs-border mb-4" id="myTab" role="tablist">

            <li class="nav-item w-100 mb-2 mb-sm-0 w-sm-auto mx-sm-3" role="presentation">
              <a class="nav-link fs-5 fw-bolder nav-link-underline mx-sm-3 px-0 active" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false"><?= __('Reviews') ?></a>
            </li>

          </ul>
          <!-- / Tab Nav-->

          <!-- Tab Content-->
          <div class="tab-content" id="myTabContent">


            <!-- Reviews -->
            <?php
            $Reviews = new \app\models\Review();
            $Reviews = $Reviews->getAllForProductVerified($data['product']->product_id);
            $this->view('Product/productReviews', $Reviews);
            ?>

            <!-- Reviews-->





    </section>
    </div>


    </div>
    <!-- / Tab Content--> </div>
    </div>
    <!-- / Product Tabs-->

  </section>


  <!-- next part -->


  <!-- Related Products-->
  <div class="container my-8">
    <h3 class="fs-4 fw-bold mb-5 text-center"><?= __('You May Also Like') ?></h3>
    <!-- Swiper Latest -->
    <div class="swiper-container overflow-visible" data-swiper data-options='{
                    "spaceBetween": 25,
                    "cssMode": true,
                    "roundLengths": true,
                    "scrollbar": {
                      "el": ".swiper-scrollbar",
                      "hide": false,
                      "draggable": true
                    },      
                    "navigation": {
                      "nextEl": ".swiper-next",
                      "prevEl": ".swiper-prev"
                    },  
                    "breakpoints": {
                      "576": {
                        "slidesPerView": 1
                      },
                      "768": {
                        "slidesPerView": 2
                      },
                      "992": {
                        "slidesPerView": 3
                      },
                      "1200": {
                        "slidesPerView": 4
                      }            
                    }
                  }'>
      <div class="swiper-wrapper pb-5 pe-1">

        <!-- See more Part-->

        <?php $this->view('Product/productSeeMore'); ?>



        <!--/ Card Product-->

        <div class="swiper-slide d-flex h-auto justify-content-center align-items-center">
          <a href="/Product/viewProductAll?index=1&sort=date" class="d-flex text-decoration-none flex-column justify-content-center align-items-center">
            <span class="btn btn-dark btn-icon mb-3"><i class="ri-arrow-right-line ri-lg lh-1"></i></span>
            <span class="lead fw-bolder"><?= __('See More') ?></span>
          </a>
        </div>
      </div>

      <!-- Buttons-->
      <div class="swiper-btn swiper-disabled-hide swiper-prev swiper-btn-side btn-icon bg-dark text-white ms-3 shadow-lg mt-n5 ms-n4"><i class="ri-arrow-left-s-line ri-lg"></i></div>
      <div class="swiper-btn swiper-disabled-hide swiper-next swiper-btn-side swiper-btn-side-right btn-icon bg-dark text-white me-n4 shadow-lg mt-n5"><i class="ri-arrow-right-s-line ri-lg"></i></div>

      <!-- Add Scrollbar -->
      <div class="swiper-scrollbar"></div>

    </div>
    <!-- / Swiper Latest-->
  </div>
  <!--/ Related Products-->


  <!-- /Page Content -->
  </section>
  <!-- / Main Section-->

  <!-- Footer-->
  <?php $this->view('footer'); ?>

  <!-- Offcanvas Imports-->
  <!-- Cart Offcanvas-->
  <div class="offcanvas offcanvas-end d-none" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header d-flex align-items-center">
      <h5 class="offcanvas-title" id="offcanvasCartLabel"><?= __('Your Cart') ?></h5>
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
          <a href="./checkout.html" class="btn btn-orange btn-orange-chunky mt-5 mb-2 d-block text-center">Checkout</a>
          <a href="./cart.html" class="btn btn-dark fw-bolder d-block text-center transition-all opacity-50-hover">View Cart</a>
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
                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Waterproof Jackets</span> <span class="text-muted ms-4">(21)</span></a>
                </li>
                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Down Jackets</span> <span class="text-muted ms-4">(13)</span></a>
                </li>
                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Windproof Jackets</span> <span class="text-muted ms-4">(18)</span></a>
                </li>
                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Hiking Jackets</span> <span class="text-muted ms-4">(25)</span></a>
                </li>
                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Climbing Jackets</span> <span class="text-muted ms-4">(11)</span></a>
                </li>
                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Trekking Jackets</span> <span class="text-muted ms-4">(19)</span></a>
                </li>
                <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Allround Jackets</span> <span class="text-muted ms-4">(24)</span></a>
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
      <h5 class="offcanvas-title" id="offcanvasReviewLabel"><?= __('Leave A Review') ?></h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <!-- Review Form -->
      <form method='post' action='/Review/writeReview?id=<?php echo $_GET['id']; ?>'>
        <div class="form-group mb-3 mt-2">
          <label class="form-label" for="formReviewTitle"><?= __('Your Review Detail') ?></label>
          <input type="text" class="form-control" name="title" id="formReviewTitle" required placeholder="<?= __('Review Title') ?>">
        </div>
        <div class="form-group mb-3 mt-2">
          <label class="form-label" for="formReviewReview"><?= __('Your Review') ?></label>
          <textarea class="form-control" name="description" id="formReviewReview" required cols="30" rows="5" placeholder="<?= __('Your Review') ?>"></textarea>
        </div>

        <p><?= __('Rating') ?>:</p>
        <p>
          <span style="margin-right: 59.65px;">0</span>
          <span style="margin-right: 59.65px;">1</span>
          <span style="margin-right: 59.65px;">2</span>
          <span style="margin-right: 59.65px;">3</span>
          <span style="margin-right: 59.65px;">4</span>
          <span>5</span>
        </p>
        <input type="range" name="rating" class="form-range" min="0" max="5" id="customRange2">
        <button type="submit" id="submitBtn" class="btn btn-dark hover-lift hover-boxshadow"><?= __('Submit Review') ?></button>
      </form>





      <!-- Script to tell the user that it must be verified before it gets shown-->
      <script>
        document.getElementById('submitBtn').addEventListener('click', function() {
          var title = document.getElementById('formReviewTitle').value.trim();
          var description = document.getElementById('formReviewReview').value.trim();

          if (title !== '' && description !== '') {
            // If both fields are not empty, display the success alert
            alert("<?= __("Review submitted successfully. However your review will be visible as soon as an admin verifies your review.") ?>");

            // Submit the form
            document.querySelector('form').submit();
          }
        });
      </script>
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
  <script src="/app/views/Admin/js/jquery.min.js"></script>
  <script src="/app/views/Admin/js/popper.js"></script>
  <script src="/app/views/Admin/js/bootstrap.min.js"></script>
  <script src="/app/views/Admin/js/main.js"></script>
  <!-- Add To Wish -->
  <script>
    function addToWish(url) {
      //carWishForm id for form
      // /Wish/addToWish?id=$product_it
      document.getElementById("cartWishForm").action = url;;
      document.getElementById("cartWishForm").submit();
    }

    function addToCart(url) {
      document.getElementById("cartWishForm").action = url;;
      document.getElementById("cartWishForm").submit();
    }
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <?php
  if (isset($data['message'])) {
  ?>
    <script>
      function myFunction() {
        // Get the snackbar DIV
        var x = document.getElementById("snackbar");
        // Add the "show" class to DIV
        x.className = "show";
        // After 3 seconds, remove the show class from DIV
        setTimeout(function() {
          x.className = x.className.replace("show", "");
        }, 3000);
      }

      function addToCart(url) {
        document.getElementById("cartWishForm").action = url;;
        document.getElementById("cartWishForm").submit();
      }
    </script>
  <?php
  }
  ?>


</body>

</html>