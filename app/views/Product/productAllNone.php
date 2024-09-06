<?php $this->view('header'); ?>
<!-- Page Title -->
<title>Zenithal Zone Designs | Category</title>


</head>

<body class="">
  <!-- NavBar -->
  <?php $this->view('navBar'); ?>

  <!-- Main Section-->
  <section class="mt-0 ">

    <!-- Category Top Banner -->
    <div class="py-6 bg-img-cover bg-dark bg-overlay-gradient-dark position-relative overflow-hidden mb-4 bg-pos-center-center" style="background-image: url(../../images/ProductViewLogo.png);">
      <div class="container position-relative z-index-20" data-aos="fade-right" data-aos-delay="300">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item breadcrumb-light"><a href="/Home"><?= __('Home') ?></a></li>
            <li class="breadcrumb-item active breadcrumb-light" aria-current="page"><?= __('Products') ?></li>
          </ol>
        </nav>
        <h1 class="fw-bold display-6 mb-4 text-white"><?= __('All Products') ?></h1>
        <div class="col-12 col-md-6">
          <p class="lead text-white mb-0"><?= __('At Zenthial Zone Design, innovation meets versatility, providing a comprehensive solution for all your product needs. From stylish apparel to cutting-edge aquatic and industrial goods, Zenthial Zone Designs is your one-stop destination. Discover a world of possibilities with ZZD, where excellence and diversity converge to bring your visions to life.') ?>
          </p>
        </div>
      </div>
    </div>
    <!-- Category Top Banner -->

    <div class="container">

      <div class="row">

        <!-- Category Aside/Sidebar -->
        <div class="d-none d-lg-flex col-lg-3">
          <div class="pe-4">
            <!-- Category Aside -->
            <aside>





              <!-- Category Filter -->
              <div class="py-4 widget-filter border-top border-bottom">
                <p class="small text-body text-decoration-none text-secondary-hover fs-6 fw-bolder d-block">
                <?= __('Category') ?>
                </p>
                <div id="filter-sizes" class="collapse show">
                  <div class="filter-options mt-3">
                    <?php

                    $Categories = new \app\models\Category();
                    $Categories = $Categories->getAll();

                    foreach ($Categories as $Category) {

                      $currentURL = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

                      echo "<a href='/Product/viewProductAll?index=1" . (strpos($currentURL, '&id=') === false ? $currentURL : '') . "' class='form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom' onclick='return redirectToCategory(event, {$Category->category_id}, \"" . htmlspecialchars($currentURL) . "\")'>
                                                         <input type='checkbox' class='form-check-bg-input' id='{$Category->category_id}' " . (isset($_GET['id']) && strpos($_GET['id'], $Category->category_id) !== false ? 'checked' : '') . " style='display:none;'>
                                                         <label class='form-check-label fw-normal' for='{$Category->category_id}'>{$Category->title}</label>
                                                      </a>";

                      // JavaScript function to redirect based on category id
                      echo "<script>
                                                         function redirectToCategory(event, categoryId, url) {
                                                             event.preventDefault(); // Prevents default behavior of the anchor tag (redirecting)
                                                             
                                                             // Check if '&id=' parameter already exists
                                                             var indexOfId = url.indexOf('&id=');
                                                             if (indexOfId !== -1) {
                                                                 var idPart = url.substring(indexOfId + 4); // Extract the part after '&id='
                                                                 var idArray = idPart.split(','); // Split the IDs into an array
                                                                 var indexToRemove = idArray.indexOf(categoryId.toString()); // Check if the category ID exists
                                                                 if (indexToRemove !== -1) {
                                                                     idArray.splice(indexToRemove, 1); // Remove the category ID from the array
                                                                     if (idArray.length > 0) {
                                                                         url = url.substring(0, indexOfId + 4) + idArray.join(','); // Reconstruct the URL without the removed category ID
                                                                     } else {
                                                                         url = url.substring(0, indexOfId); // If no IDs left, remove the '&id=' part
                                                                     }
                                                                 } else {
                                                                     url += ',' + categoryId; // Append categoryId to existing '&id=' parameter
                                                                 }
                                                             } else {
                                                                 // Append new '&id=' parameter with categoryId
                                                                 url += '&id=' + categoryId;
                                                             }
                                                             
                                                             // Redirect to the updated URL
                                                             window.location.href = url;
                                                             return false; // Prevents any further event propagation
                                                         }
                                                      </script>";
                    }
                    ?>


                  </div>
                </div>
              </div>
              <!-- / Category Filter -->

            </aside>
            <!-- / Category Aside-->
          </div>
        </div>
        <!-- / Category Aside/Sidebar -->

        <!-- Category Products-->
        <div class="col-12 col-lg-9">

          <!-- Top Toolbar-->
          <div class="mb-4 d-md-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center flex-column flex-md-row">
              <!-- Filter Trigger-->
              <!--
                            <button class="btn bg-light p-3 d-flex d-lg-none align-items-center fs-xs fw-bold text-uppercase w-100 mb-2 mb-md-0 w-md-auto"
                                type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilters"
                                aria-controls="offcanvasFilters">
                                <i class="ri-equalizer-line me-2"></i> Filters
                            </button>
-->
              <!-- / Filter Trigger-->


            </div>

            <h6><?= __('There Is No Product') ?></h6>





          </div> <!-- / Top Toolbar-->







        </div>
        <!-- / Category Products-->

      </div>
    </div>

  </section>
  <!-- / Main Section-->

  <!-- Footer-->
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
  <section class="search-overlay">
    <div class="container search-container">
      <div class="py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <p class="lead lh-1 m-0 fw-bold">What are you looking for?</p>
          <button class="btn btn-light btn-close-search"><i class="ri-close-circle-line align-bottom"></i> Close search</button>
        </div>
        <form>
          <input type="text" class="form-control" id="searchForm" placeholder="Search by product or category name...">
        </form>
        <div class="my-5">
          <p class="lead fw-bolder">2 results found for <span class="fw-bold">"Waterproof Jacket"</span></p>
          <div class="row">
            <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
              <!-- Card Product-->
              <div class="card position-relative h-100 card-listing hover-trigger">
                <div class="card-header">
                  <picture class="position-relative overflow-hidden d-block bg-light">
                    <img class="w-100 img-fluid position-relative z-index-10" title="" src="../../assets/images/products/product-1.jpg" alt="Bootstrap 5 Template by Pixel Rocket">
                  </picture>
                  <div class="card-actions">
                    <span class="small text-uppercase tracking-wide fw-bolder text-center d-block">Quick Add</span>
                    <div class="d-flex justify-content-center align-items-center flex-wrap mt-3">
                      <button class="btn btn-outline-dark btn-sm mx-2">S</button>
                      <button class="btn btn-outline-dark btn-sm mx-2">M</button>
                      <button class="btn btn-outline-dark btn-sm mx-2">L</button>
                    </div>
                  </div>
                </div>
                <div class="card-body px-0 text-center">
                  <div class="d-flex justify-content-center align-items-center mx-auto mb-1">
                    <!-- Review Stars Small-->
                    <div class="rating position-relative d-table">
                      <div class="position-absolute stars" style="width: 80%">
                        <i class="ri-star-fill text-dark mr-1"></i>
                        <i class="ri-star-fill text-dark mr-1"></i>
                        <i class="ri-star-fill text-dark mr-1"></i>
                        <i class="ri-star-fill text-dark mr-1"></i>
                        <i class="ri-star-fill text-dark mr-1"></i>
                      </div>
                      <div class="stars">
                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                      </div>
                    </div> <span class="small fw-bolder ms-2 text-muted"> 4.2 (123)</span>
                  </div>
                  <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center" href="./product.html">Mens Pennie II Waterproof Jacket</a>
                  <p class="fw-bolder m-0 mt-2">$325.66</p>
                </div>
              </div>
              <!--/ Card Product-->
            </div>
            <div class="col-12 col-md-6 col-lg-3">
              <!-- Card Product-->
              <div class="card position-relative h-100 card-listing hover-trigger">
                <div class="card-header">
                  <picture class="position-relative overflow-hidden d-block bg-light">
                    <img class="w-100 img-fluid position-relative z-index-10" title="" src="../../assets/images/products/product-2.jpg" alt="Bootstrap 5 Template by Pixel Rocket">
                  </picture>
                  <div class="card-actions">
                    <span class="small text-uppercase tracking-wide fw-bolder text-center d-block">Quick Add</span>
                    <div class="d-flex justify-content-center align-items-center flex-wrap mt-3">
                      <button class="btn btn-outline-dark btn-sm mx-2">S</button>
                      <button class="btn btn-outline-dark btn-sm mx-2">M</button>
                      <button class="btn btn-outline-dark btn-sm mx-2">L</button>
                    </div>
                  </div>
                </div>
                <div class="card-body px-0 text-center">
                  <div class="d-flex justify-content-center align-items-center mx-auto mb-1">
                    <!-- Review Stars Small-->
                    <div class="rating position-relative d-table">
                      <div class="position-absolute stars" style="width: 70%">
                        <i class="ri-star-fill text-dark mr-1"></i>
                        <i class="ri-star-fill text-dark mr-1"></i>
                        <i class="ri-star-fill text-dark mr-1"></i>
                        <i class="ri-star-fill text-dark mr-1"></i>
                        <i class="ri-star-fill text-dark mr-1"></i>
                      </div>
                      <div class="stars">
                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                      </div>
                    </div> <span class="small fw-bolder ms-2 text-muted"> 4.5 (1289)</span>
                  </div>
                  <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center" href="./product.html">Mens Storm Waterproof Jacket</a>
                  <p class="fw-bolder m-0 mt-2">$499.99</p>
                </div>
              </div>
              <!--/ Card Product-->
            </div>
          </div>
        </div>

        <div class="bg-dark p-4 text-white">
          <p class="lead m-0">Didn't find what you are looking for? <a class="transition-all opacity-50-hover text-white text-link-border border-white pb-1 border-2" href="#">Send us a message.</a></p>
        </div>
      </div>
    </div>
  </section>
  <!-- Theme JS -->
  <!-- Vendor JS -->
  <script src="../../assets/js/vendor.bundle.js"></script>

  <!-- Theme JS -->
  <script src="../../assets/js/theme.bundle.js"></script>
</body>

</html>