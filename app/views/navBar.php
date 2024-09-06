 <!-- Navbar -->
 <!-- Navbar -->
 <script src="../../assets/js/vendor.bundle.js"></script>

 <!-- Theme JS -->
 <script src="../../assets/js/theme.bundle.js"></script>
 <?php $product = new \app\models\Product();
    ?>
 <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mx-0 p-0 flex-column  ">
     <div class="w-100 pb-lg-0 pt-lg-0 pt-4 pb-3">
         <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">

             <!-- Logo-->
             <a class="navbar-brand fw-bold fs-3 m-0 p-0 flex-shrink-0" href="/Home">
                 <!-- Start of Logo-->
                 <div class="d-flex align-items-center">
                     <div class="f-w-6 d-flex align-items-center me-2 lh-1">
                         <img src="/images/logo1.png" alt="Your Alt Text" class="f-w-7 d-flex me-0" width="50px" height="30px" />

                     </div> <span class="fs-5">ZZD</span>
                 </div>
                 <!-- / Logo-->
             </a>
             <!-- / Logo-->

             <!-- Main Navigation-->
             <div class="ms-5 flex-shrink-0 collapse navbar-collapse navbar-collapse-light w-auto flex-grow-1" id="navbarNavDropdown">

                 <!-- Mobile Nav Toggler-->
                 <button class="btn btn-link px-2 text-decoration-none navbar-toggler border-0 position-absolute top-0 end-0 mt-3 me-2" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                     <i class="ri-close-circle-line ri-2x"></i>
                 </button>
                 <!-- / Mobile Nav Toggler-->

                 <ul class="navbar-nav py-lg-2 mx-auto">
                     <li class="nav-item me-lg-4 dropdown position-static">
                         <a class="nav-link fw-bolder dropdown-toggle py-lg-4" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <?= __('Products') ?>
                         </a>
                         <!-- Menswear dropdown menu-->
                         <div class="dropdown-menu dropdown-megamenu">
                             <div class="container">
                                 <div class="row g-0">
                                     <!-- Dropdown Menu Links Section-->
                                     <div class="col-12 col-lg-7">
                                         <div class="row py-lg-5">

                                             <!-- menu row-->
                                             <div class="col col-lg-6 mb-5 mb-sm-0">
                                                 <h6 class="dropdown-heading"><?= __('Categories') ?></h6>
                                                 <ul class="list-unstyled">
                                                     <?php
                                                        $Categories = new \app\models\Category();
                                                        $Categories = $Categories->getAll();
                                                        $counter = 0;
                                                        $firstRowAmount = 0;
                                                        $maxPerColumn = 6;
                                                        foreach ($Categories as $Category) {
                                                            $counter++;
                                                            //adds the chosen amount of entries
                                                            if ($counter <= $maxPerColumn) {

                                                                //to write the amount of the category product
                                                                $Product_Category = new \app\models\Product_Category();
                                                                $Product_Category = $Product_Category->getAllByCatId($Category->category_id);
                                                                $count = count($Product_Category);

                                                                echo "<li class='dropdown-list-item'><a class='dropdown-item' href='/Product/Category?id=$Category->category_id&sort=date&index=1'>$Category->title ($count)</a></li>";
                                                                $firstRowAmount++;
                                                            }
                                                        }

                                                        //check if it has the right amount of slots, if not, add empty slots
                                                        while ($firstRowAmount < $maxPerColumn) {
                                                            echo "<li class='dropdown-list-item'><a class='dropdown-item'>ㅤ</a></li>";
                                                            $firstRowAmount++;
                                                        }
                                                        ?>

                                                     <li class="dropdown-list-item"><a class="dropdown-item dropdown-link-all" href="/Product/viewProductAll?index=1&sort=date"><?= __('View All Product') ?> <?php
                                                                                                                                                                                                    $products = new \app\models\Product();
                                                                                                                                                                                                    $products = $products->getAll();
                                                                                                                                                                                                    $ProductsCount = count($products);
                                                                                                                                                                                                    echo " ($ProductsCount)";

                                                                                                                                                                                                    ?></a></li>
                                                 </ul>

                                             </div>

                                             <!-- /menu row-->

                                             <!-- menu row-->
                                             <div class="col col-lg-6">
                                                 <h6 class="dropdown-heading">ㅤ</h6>
                                                 <ul class="list-unstyled">
                                                     <?php
                                                        $Categories = new \app\models\Category();
                                                        $Categories = $Categories->getAll();
                                                        $counter = 0;
                                                        //if it has more than this slots, prepare to add the other categories
                                                        if (count($Categories) > $maxPerColumn) {
                                                            foreach ($Categories as $Category) {
                                                                $counter++;
                                                                //if its past the first 8th categories, show the new ones
                                                                if ($counter > $maxPerColumn) {
                                                                    //to write the amount of the category product
                                                                    $Product_Category = new \app\models\Product_Category();
                                                                    $Product_Category = $Product_Category->getAllByCatId($Category->category_id);
                                                                    $count = count($Product_Category);
                                                                    echo "<li class='dropdown-list-item'><a class='dropdown-item' href='/Product/Category?id=$Category->category_id&sort=date&index=1'>$Category->title ($count)</a></li>";
                                                                    $firstRowAmount++;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                 </ul>
                                             </div>
                                             <!-- /menu row-->

                                         </div>
                                     </div>
                                     <!-- /Dropdown Menu Links Section-->

                                     <!-- Dropdown Menu Images Section-->
                                     <div class="d-none d-lg-block col-lg-5">
                                         <div class="vw-50 h-100 bg-img-cover bg-pos-center-center position-absolute" style="background-image: url(../../images/NavBarLogo.png);"></div>
                                     </div>
                                     <!-- Dropdown Menu Images Section-->
                                 </div>
                             </div>
                         </div>
                         <!-- / Menswear dropdown menu-->
                     </li> 

                     <li class="nav-item me-lg-4">
                         <a class="nav-link fw-bolder py-lg-4" href="/Home">
                         <?= __('Home') ?>
                         </a>
                     </li>
                     <li class="nav-item me-lg-4">
                         <a class="nav-link fw-bolder py-lg-4" href="/Contact/Contact_us">
                         <?= __('Contact') ?>
                         </a>
                     </li>
                 </ul>
             </div>
             <!-- / Main Navigation-->

             <!-- Navbar Icons-->
             <ul class="list-unstyled mb-0 d-flex align-items-center">

                 <!-- Navbar Toggle Icon-->
                 <li class="d-inline-block d-lg-none">
                     <button class="btn btn-link px-2 text-decoration-none navbar-toggler border-0 d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                         <i class="ri-menu-line ri-lg align-middle"></i>
                     </button>
                 </li>
                 <!-- /Navbar Toggle Icon-->

                 <!-- Navbar Search-->
                 <li class="ms-1 d-inline-block">
                     <button class="btn btn-link px-2 text-decoration-none d-flex align-items-center" data-pr-search>
                         <i class="ri-search-2-line ri-lg align-middle"></i>
                     </button>
                 </li>
                 <!-- /Navbar Search-->
                 <!-- Navbar Wishlist-->
                 <?php
                    if (isset($_SESSION["customer_id"])) {
                    ?>
                     <li class="ms-1 d-none d-lg-inline-block">
                         <a class="btn btn-link px-2 py-0 text-decoration-none d-flex align-items-center" href="/Wish/viewAllWish">
                             <i class="ri-heart-line ri-lg align-middle"></i>
                         </a>
                     </li>
                 <?php
                    }
                    ?>
                 <!-- /Navbar Wishlist-->

                 <!-- Navbar Login-->
                 <li class="ms-1 d-none d-lg-inline-block">
                     <a class="btn btn-link px-2 text-decoration-none d-flex align-items-center" href="/ProfileIcon">
                         <i class="ri-user-line ri-lg align-middle"></i>
                     </a>
                 </li>
                 <!-- /Navbar Login-->

                 <?php if (isset($_SESSION["customer_id"])) : ?>
                     <li class="ms-1 d-inline-block position-relative">
                         <button class="btn btn-link px-2 text-decoration-none d-flex align-items-center disable-child-pointer" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                             <i class="ri-shopping-cart-2-line ri-lg align-middle position-relative z-index-10"></i>
                             <span class="fs-xs fw-bolder f-w-5 f-h-5 bg-orange rounded-lg d-block lh-1 pt-1 position-absolute top-0 end-0 z-index-20 mt-2 text-white">
                                 <?php
                                    //get cart count
                                    $cartSumary = \app\models\Cart_item::cartSummary($_SESSION["customer_id"]);
                                    if ($cartSumary['total_quantity'] > 0) {
                                        echo $cartSumary['total_quantity'];
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                             </span>
                         </button>
                     </li>
                     <!-- Offcanvas Sidebar for Cart -->
                     <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
                         <div class="offcanvas-header">
                             <h5 class="offcanvas-title" id="offcanvasCartLabel"><?= __('Your Cart') ?></h5>
                             <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                         </div>
                         <div class="offcanvas-body">
                             <?php
                                $cartItemModel = new \app\models\Cart_item();
                                $cartItems = $cartItemModel->getCartDetails($_SESSION["customer_id"]);
                                if (!empty($cartItems)) {
                                    foreach ($cartItems as $item) {
                                        $picture = new \app\models\Picture();
                                        $picture = $picture->getAllForProductCartItem($item->product_id);
                                        $filename = $picture[0]->filename;
                                        echo "<div class='cart-item d-flex justify-content-between align-items-center'>";
                                        echo "<img src='/uploads/{$filename}' alt='" . htmlspecialchars($item->title) . "' style='width:100px; height:auto; margin:10px'>";
                                        echo "<div>" . htmlspecialchars($item->title) . " - Qty: " . $item->quantity . " - $" . number_format($item->price, 2) . "</div>";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    if (!empty($cartItems)) : ?>
                                     <a href="/Cart/checkout" class="btn btn-primary mt-3"><?= __('Proceed to Checkout') ?></a>
                                     <a href="/Cart/cart" class="btn btn-primary mt-3"><?= __('View Cart') ?></a>
                             <?php endif;
                                } else {
                                    echo "<p>Your cart is empty.</p>";
                                }
                                ?>
                         </div>
                     </div>
                 <?php endif; ?>

                 <!-- if logged in -->
                 <?php
                    if (isset($_SESSION["customer_id"]) || isset($_SESSION["admin_id"])) {
                    ?>
                     <li class="ms-1 d-none d-lg-inline-block">
                         <a class="btn btn-link px-2 py-0 text-decoration-none d-flex align-items-center" href="/User/logout">
                             <i class="align-middle"><?= __('Log Out') ?></i>
                         </a>
                     </li>
                 <?php
                    }
                    ?>
             </ul>
             <!-- Navbar Icons-->
            <?php
                if($_SESSION['lang'] == 'en'){
                    echo "<a href=\"/Home/langChecker\">EN</a>";
                }else{
                    echo "<a href=\"/Home/langChecker\">FR</a>";    
                }
            ?>
         </div>
     </div>
 </nav>
 <!-- / Navbar--> <!-- / Navbar-->