<?php $this->view('header'); ?>
<!-- Page Title -->
<title>Zenithal Zone Designs | Home</title>
</head>

<body>

    <!-- Navbar -->
    <?php $this->view('navBar'); ?>
    <!-- / Navbar-->

    <!-- Main Section-->
    <section class="mt-0 ">
        <!-- Page Content Goes Here -->

        <!-- / Hero Section -->
        <section class="vh-100 position-relative bg-overlay-dark ">
            <div class="container d-flex h-100 justify-content-center align-items-center position-relative z-index-10">
                <div class="d-flex justify-content-center align-items-center h-100 position-relative z-index-10 text-white">
                    <div>
                        <h1 class="display-1 fw-bold px-2 px-md-5 text-center mx-auto col-lg-8 mt-md-0" data-aos="fade-up" data-aos-delay="1000"><?= __('Where will your next adventure take you?')?></h1>
                        <div data-aos="fade-in" data-aos-delay="2000">
                            <div class="d-md-flex justify-content-center mt-4 mb-3 my-md-5">
                                <a href="/Product/viewProductAll?index=1&sort=date" class="btn btn-skew-left btn-orange btn-orange-chunky text-white mx-1 w-100 w-md-auto mb-2 mb-md-0"><span><?= __('View All Product')?><i class="ri-arrow-right-line align-middle fw-bold"></i></span></a>

                            </div>
                            <i class="ri-mouse-line d-block text-center animation-float ri-2x transition-all opacity-50-hover text-white" data-pixr-scrollto data-target=".brand-section" data-aos="fade-up" data-aos-delay="700"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-absolute z-index-1 top-0 bottom-0 start-0 end-0">
                <!-- Swiper Info -->
                <div class="swiper-container overflow-hidden bg-light w-100 h-100" data-swiper data-options='{
                    "slidesPerView": 1,
                    "speed": 1500,
                    "loop": true,
                    "effect": "fade",
                    "autoplay": {
                      "delay": 5000
                    }
                  }'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide position-relative">
                            <div class="w-100 h-100 bg-img-cover animation-move bg-pos-center-center" style="background-image: url(../../assets/images/slideshows/slideshow-1.jpg);">
                            </div>
                        </div>
                        <div class="swiper-slide position-relative">
                            <div class="w-100 h-100 bg-img-cover animation-move bg-pos-center-center" style="background-image: url(../../assets/images/slideshows/slideshow-2.jpg);">
                            </div>
                        </div>
                        <div class="swiper-slide position-relative">
                            <div class="w-100 h-100 bg-img-cover animation-move bg-pos-center-center" style="background-image: url(../../assets/images/slideshows/slideshow-3.jpg);">
                            </div>
                        </div>
                    </div>

                </div>
                <!-- / Swiper Info-->
            </div>
        </section>
        <!--/ Hero Section-->


        <!-- Staff Picks-->
        <section class="mb-9 mt-5" data-aos="fade-up">
            <div class="container">
                <div class="w-md-50 mb-5">
                    <p class="small fw-bolder text-uppercase tracking-wider mb-2 text-muted"><?= __('Products') ?></p>
                    <h2 class="display-5 fw-bold mb-3"><?= __('Lucky Finds') ?></h2>
                    <p class="lead"><?= __('Each item on this list has been curated for its potential to bring a stroke of luck into your life. Who knows? Your next lucky break might just be a click away!')?>
                    </p>
                </div>
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


                    <!--products -->
                    <div class="swiper-wrapper pb-5 pe-1">
                        <?php
                        $products = new \app\models\Product();
                        $products = $products->getAllRandom();

                        $Reviews = new \app\models\Review();
                        $pictures = new \app\models\Picture();

                        $limit = 0;
                        foreach ($products as $index => $product) {
                            if ($limit < 6) { //to check if its hitting the limit of items shown in the "see more"

                                $rating0 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 0);
                                $rating1 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 1);
                                $rating2 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 2);
                                $rating3 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 3);
                                $rating4 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 4);
                                $rating5 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 5);


                                $ReviewsCount = $Reviews->getAllForProductVerified($product->product_id);
                                $ReviewsCount = count($ReviewsCount);
                                $combinedRatings = (($rating1 * 1) + ($rating2 * 2) + ($rating3 * 3) + ($rating4 * 4) + ($rating5 * 5));
                                if ($combinedRatings != 0) {
                                    //avg out of 5
                                    $OverallRating = $combinedRatings / $ReviewsCount;
                                    $OverallRating5 = $OverallRating;
                                    //avg out of 100%
                                    $OverallRating = $OverallRating * 100 / 5;
                                } else {
                                    $OverallRating = 0;
                                    $OverallRating5 = 0;
                                }
                                //round the ratings.
                                $OverallRating5 = number_format($OverallRating5, 2);
                                $OverallRating = number_format($OverallRating, 2);


                                // for picture
                                $picturesForProduct = $pictures->getAllForProductByID($product->product_id);

                                //to make sure we dont show the same product

                                $limit++;
                                //printing the choices 
                                echo "

                <!-- Card Product-->
                
<div class='swiper-slide d-flex h-auto'>
    <div class='card position-relative h-100 card-listing hover-trigger'>
        <div class='card-header'>
       
";
                                //if it has more than 2 photos, show two of the images.
                                if (count($picturesForProduct) > 1) {
                                    echo "
    <picture class='position-relative overflow-hidden d-block bg-light' style='width: 300px; height: 300px;'>
        <img class='w-100   w-150 position-relative z-index-10' title='' src='/uploads/" . $picturesForProduct[0]->filename . "' alt='' width='300' height='300'>
        </picture>
        <picture class='position-absolute z-index-10 top-0  hover-show bg-light' style='width: 300px; height: 300px;'>
        <img class=' w-100 ' title='' src='/uploads/" . $picturesForProduct[1]->filename . "' alt='' width='300' height='300'>
    </picture>
    
            </div> 
    
    ";
                                } else {
                                    echo "
    <picture class='position-relative overflow-hidden d-block bg-light '>
    <img class='position-relative z-index-10' title='' src='/uploads/" . $picturesForProduct[0]->filename . "' alt='' width='300' height='300'>
    </picture>
    </div>";
                                }


                                echo " <div class='card-body px-0 text-center'>
<div class='d-flex justify-content-center align-items-center mx-auto mb-1'>
    <!-- Review Stars Small-->
    <div class='rating position-relative d-table'>";



                                echo "<div class='position-absolute stars' style='width: $OverallRating%'>
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
              
              ";

                                echo "
              </div> <span class='small fw-bolder ms-2 text-muted'> $OverallRating5 ($ReviewsCount)</span>

              </div>
              <a class='mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center' href='/Product/viewProduct?id=$product->product_id'>$product->title</a>
              <p class='fw-bolder m-0 mt-2'>$ $product->price</p>
              </div>
              </div>
</div>



              ";
                            }
                        }
                        ?>

                        <div class="swiper-slide d-flex h-auto justify-content-center align-items-center">
                            <a href="/Product/viewProductAll?index=1&sort=date" class="d-flex text-decoration-none flex-column justify-content-center align-items-center">
                                <span class="btn btn-dark btn-icon mb-3"><i class="ri-arrow-right-line ri-lg lh-1"></i></span>
                                <span class="lead fw-bolder"><?= __('See All') ?></span>
                            </a>
                        </div>
                    </div>
                    <!--/products -->


                    <!-- Buttons-->
                    <div class="swiper-btn swiper-disabled-hide swiper-prev swiper-btn-side btn-icon bg-dark text-white ms-3 shadow-lg mt-n5 ms-n4"><i class="ri-arrow-left-s-line ri-lg"></i></div>
                    <div class="swiper-btn swiper-disabled-hide swiper-next swiper-btn-side swiper-btn-side-right btn-icon bg-dark text-white me-n4 shadow-lg mt-n5"><i class="ri-arrow-right-s-line ri-lg"></i></div>

                    <!-- Add Scrollbar -->
                    <div class="swiper-scrollbar"></div>

                </div>
                <!-- / Swiper Latest-->
            </div>
        </section>
        <!-- / Staff Picks-->

        <!-- Image Hotspot Banner-->
        <section class="my-10 position-relative">
            <!-- SVG Shape Divider-->
            <div class="position-absolute z-index-50 text-white top-0 start-0 end-0">
                <svg class="align-self-start d-flex" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1283 53.25">
                    <polygon fill="currentColor" points="1283 0 0 0 0 53.25 1283 0" />
                </svg>
            </div>
            <!-- /SVG Shape Divider-->

            <div class="w-100 h-100 bg-img-cover bg-pos-center-center hotspot-container py-5 py-md-7 py-lg-10" style="background-image: url(/assets/images/voiceAssistantEnvironment.png);">

                <div class="hotspot d-none d-lg-block" data-options='{
                    "placement": {
                        "left": "23%",
                        "top": "10%"
                    },
                    "alwaysVisible": true,
                    "alwaysAnimate": true,
                    "contentTarget": "#hotspot-one"
                }'>
                </div>
                <!-- this code requires electronics and voice assistant to work -->
                <div class="container py-lg-8 position-relative z-index-10 d-flex align-items-center" data-aos="fade-left">
                    <div class="py-8 d-flex justify-content-end align-items-start align-items-lg-end flex-column col-lg-4 text-lg-end">
                        <p class="small fw-bolder text-uppercase tracking-wider mb-2 text-muted"><?= __('Extreme Peformance') ?></p>
                        <h2 class="display-5 fw-bold mb-3 text-white"><?= __('Electronics') ?></h2>
                        <p class="lead d-none d-lg-block text-white"><?= __('Be ready all year round with our selection of North Face outdoor jackets, perfect for any time of the year and year round. Choose from a variety of colour shades and styles to warm you up in cold conditions.')?></p>
                        <a class="text-decoration-none fw-bolder  text-muted" href="/Product/Category?id=18&sort=date&index=1"><?= __('Shop For Electronics') ?>&rarr;</a>
                    </div>
                </div>

                <!-- Example Hotspot HTML Content -->
                <?php
                //get needed data
                $title = $data['hospotProduct']->title;
                $price = $data['hospotProduct']->price;
                $product_id = $data['hospotProduct']->product_id;
                //rating
                //title
                //price
                //full details link

                ?>
                <div id="hotspot-one" class="d-none">
                    <div class="m-n2 rounded overflow-hidden">
                        <div class="mb-1 bg-light d-flex justify-content-center">
                            <div class="f-w-48 px-3 pt-3">
                                <?php echo "<img src='/uploads/{$data['image']}' alt='{$data['hospotProduct']->title}' style='width:100px; height:auto;'>"; ?>
                            </div>
                        </div>
                        <div class="px-4 py-4 text-center">
                            <div class="d-flex justify-content-center align-items-center mx-auto mb-1">
                                <!-- Review Stars Small
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
                                </div> <span class="small fw-bolder ms-2 text-muted"> 4.4 (1289)</span> -->
                                <?php
                                //this is to get the overall rating
                                $Reviews = new \app\models\Review();
                                $ReviewsCount = $Reviews->getAllForProductVerified($product_id);
                                $rating1 = $Reviews->getCountForProductRatingCountVerified($product_id, 1);
                                $rating2 = $Reviews->getCountForProductRatingCountVerified($product_id, 2);
                                $rating3 = $Reviews->getCountForProductRatingCountVerified($product_id, 3);
                                $rating4 = $Reviews->getCountForProductRatingCountVerified($product_id, 4);
                                $rating5 = $Reviews->getCountForProductRatingCountVerified($product_id, 5);
                                $Reviews = $Reviews->getAllForProductVerified($product_id);
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
                                echo "<div class='rating position-relative d-table'>
                                  
                  <div class='position-absolute stars' style='width: $OverallRating%'>
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
                            <p class="mb-0 mx-4"><?php echo $title ?></p>
                            <p class="lead lh-1 m-0 fw-bolder mt-2 mb-3">$ <?php echo $price ?></p>
                            <a href="/Product/viewProduct&id=<?php echo $product_id ?>" class="fw-bolder text-link-border pb-1 fs-6">Full details <i class="ri-arrow-right-line align-bottom"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SVG Shape Divider-->
            <div class="position-absolute z-index-50 text-white bottom-0 start-0 end-0">
                <svg class="align-self-end d-flex" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1283 53.25">
                    <polygon fill="currentColor" points="0 53.25 1283 53.25 1283 0 0 53.25" />
                </svg>
            </div>
            <!-- /SVG Shape Divider-->
        </section>
        <!-- / Image Hotspot Banner-->



        <!-- Staff Picks-->
        <section class="mb-9 mt-5" data-aos="fade-up">
            <div class="container">
                <div class="w-md-50 mb-5">
                    <p class="small fw-bolder text-uppercase tracking-wider mb-2 text-muted"><?= __('Products') ?></p>
                    <h2 class="display-5 fw-bold mb-3"><?= __('New Products') ?></h2>
                    <p class="lead"><?= __('Introducing our freshest arrivals, carefully curated to captivate your imagination and elevate your lifestyle. Unveil the allure of innovation with our newest products, each one a testament to quality, creativity, and ingenuity.') ?></p>
                </div>
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


                    <!--products -->
                    <div class="swiper-wrapper pb-5 pe-1">
                        <?php
                        $products = new \app\models\Product();
                        $products = $products->getAllNew();

                        $Reviews = new \app\models\Review();
                        $pictures = new \app\models\Picture();

                        $limit = 0;
                        foreach ($products as $index => $product) {
                            if ($limit < 6) { //to check if its hitting the limit of items shown in the "see more"

                                $rating0 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 0);
                                $rating1 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 1);
                                $rating2 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 2);
                                $rating3 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 3);
                                $rating4 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 4);
                                $rating5 = $Reviews->getCountForProductRatingCountVerified($product->product_id, 5);


                                $ReviewsCount = $Reviews->getAllForProductVerified($product->product_id);
                                $ReviewsCount = count($ReviewsCount);
                                $combinedRatings = (($rating1 * 1) + ($rating2 * 2) + ($rating3 * 3) + ($rating4 * 4) + ($rating5 * 5));
                                if ($combinedRatings != 0) {
                                    //avg out of 5
                                    $OverallRating = $combinedRatings / $ReviewsCount;
                                    $OverallRating5 = $OverallRating;
                                    //avg out of 100%
                                    $OverallRating = $OverallRating * 100 / 5;
                                } else {
                                    $OverallRating = 0;
                                    $OverallRating5 = 0;
                                }
                                //round the ratings.
                                $OverallRating5 = number_format($OverallRating5, 2);
                                $OverallRating = number_format($OverallRating, 2);


                                // for picture
                                $picturesForProduct = $pictures->getAllForProductByID($product->product_id);

                                //to make sure we dont show the same product

                                $limit++;
                                //printing the choices 
                                echo "

                <!-- Card Product-->
                
<div class='swiper-slide d-flex h-auto'>
    <div class='card position-relative h-100 card-listing hover-trigger'>
        <div class='card-header'>
       
";
                                //if it has more than 2 photos, show two of the images.
                                if (count($picturesForProduct) > 1) {
                                    echo "
    <picture class='position-relative overflow-hidden d-block bg-light' style='width: 300px; height: 300px;'>
        <img class='w-100   w-150 position-relative z-index-10' title='' src='/uploads/" . $picturesForProduct[0]->filename . "' alt='' width='300' height='300'>
        </picture>
        <picture class='position-absolute z-index-10 top-0  hover-show bg-light' style='width: 300px; height: 300px;'>
        <img class=' w-100 ' title='' src='/uploads/" . $picturesForProduct[1]->filename . "' alt='' width='300' height='300'>
    </picture>
    
            </div> 
    
    ";
                                } else {
                                    echo "
    <picture class='position-relative overflow-hidden d-block bg-light '>
    <img class='position-relative z-index-10' title='' src='/uploads/" . $picturesForProduct[0]->filename . "' alt='' width='300' height='300'>
    </picture>
    </div>";
                                }


                                echo " <div class='card-body px-0 text-center'>
<div class='d-flex justify-content-center align-items-center mx-auto mb-1'>
    <!-- Review Stars Small-->
    <div class='rating position-relative d-table'>";



                                echo "<div class='position-absolute stars' style='width: $OverallRating%'>
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
              
              ";

                                echo "
              </div> <span class='small fw-bolder ms-2 text-muted'> $OverallRating5 ($ReviewsCount)</span>

              </div>
              <a class='mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center' href='/Product/viewProduct?id=$product->product_id'>$product->title</a>
              <p class='fw-bolder m-0 mt-2'>$ $product->price</p>
              </div>
              </div>
</div>



              ";
                            }
                        }
                        ?>

                        <div class="swiper-slide d-flex h-auto justify-content-center align-items-center">
                            <a href="/Product/viewProductAll?index=1&sort=date" class="d-flex text-decoration-none flex-column justify-content-center align-items-center">
                                <span class="btn btn-dark btn-icon mb-3"><i class="ri-arrow-right-line ri-lg lh-1"></i></span>
                                <span class="lead fw-bolder"><?= __('See All') ?></span>
                            </a>
                        </div>
                    </div>
                    <!--/products -->


                    <!-- Buttons-->
                    <div class="swiper-btn swiper-disabled-hide swiper-prev swiper-btn-side btn-icon bg-dark text-white ms-3 shadow-lg mt-n5 ms-n4"><i class="ri-arrow-left-s-line ri-lg"></i></div>
                    <div class="swiper-btn swiper-disabled-hide swiper-next swiper-btn-side swiper-btn-side-right btn-icon bg-dark text-white me-n4 shadow-lg mt-n5"><i class="ri-arrow-right-s-line ri-lg"></i></div>

                    <!-- Add Scrollbar -->
                    <div class="swiper-scrollbar"></div>

                </div>
                <!-- / Swiper Latest-->
            </div>
        </section>
        <!-- / Staff Picks-->



        <!-- /Page Content -->
    </section>
    <!-- / Main Section-->

    <!-- Footer -->
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