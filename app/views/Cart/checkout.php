<?php $this->view('header'); ?>

<!-- Page Title -->
<title>Checkout</title>

</head>

<body class="">

  <!-- NavBar -->
  <?php $this->view('navBar'); ?>

  <!-- Main Section-->
  <section class="mt-5 container ">
    <!-- Page Content Goes Here -->

    <h1 class="mb-4 display-5 fw-bold text-center"><?= __("Checkout Securely") ?></h1>

    <div class="row g-md-8 mt-4">
      <!-- Checkout Panel Left -->
      <div class="col-12 col-lg-6 col-xl-7">
        <!-- Checkout Panel Contact -->
        <div class="checkout-panel">
          <h5 class="title-checkout"><?= __("Contact information") ?></h5>
          <div class="row">
          <form action="/Cart/checkout" method="post">


            <!-- Email-->
            <div class="col-12">
              <div class="form-group">
                <label for="email" class="form-label"><?= __("Email") ?></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
              </div>

              
            </div>
          </div>
        </div>
        <!-- /Checkout Panel Contact --> <!-- Checkout Shipping Address -->
        <div class="checkout-panel">
          <h5 class="title-checkout"><?= __("Shipping Address") ?></h5>
          <div class="row">
            <!-- First Name-->
            <div class="col-sm-6">
              <div class="form-group">
                <label for="firstName" class="form-label"><?= __("First Name") ?></label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
              </div>
            </div>

            <!-- Last Name-->
            <div class="col-sm-6">
              <div class="form-group">
                <label for="lastName" class="form-label"><?= __("Last Name") ?></label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
              </div>
            </div>

            <!-- Address-->
            <div class="col-12">
              <div class="form-group">
                <label for="address" class="form-label"><?= __("Address") ?></label>
                <input type="text" class="form-control" id="address" name="address" placeholder="123 Some Street Somewhere" required>
              </div>
            </div>

            <!-- Country-->
            <div class="col-md-12">
              <div class="form-group">
                <label for="country" class="form-label"><?= __("Country") ?></label>
                <select class="form-select" id="country" name="country" required>
                  <option value=""><?= __("Please Select") ?></option>
                  <option>Canada</option>
                </select>
              </div>
            </div>

            <!-- State-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="province" class="form-label"><?= __("State") ?></label>
                <select class="form-select" id="province" name="province" required>
                  <option value=""><?= __("Please Select") ?></option>
                  <option>Quebec</option>
                </select>
              </div>
            </div>

            <!-- Post Code-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="zip" class="form-label"><?= __("Zip/Postal Code") ?></label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="A1B 2C3" required>
              </div>
            </div>
          </div>

        </div>
        <!-- /Checkout Shipping Address --> 
        
        <!-- / Checkout Billing Address--> <!-- Checkout Shipping Method-->
        <div class="checkout-panel">
          <h5 class="title-checkout"><?= __("Shipping Method") ?></h5>

          <!-- Shipping Option-->
          <div class="form-check form-group form-check-custom form-radio-custom mb-3">
            <input class="form-check-input" type="radio" name="checkoutShippingMethod" id="checkoutShippingMethodOne" checked>
            <label class="form-check-label" for="checkoutShippingMethodOne">
              <span class="d-flex justify-content-between align-items-start w-100">
                <span>
                  <span class="mb-0 fw-bolder d-block"><?= __("Shipping") ?></span>
                  <small class="fw-bolder">Amazon</small>
                </span>
                <span class="small fw-bolder text-uppercase">$8.95</span>
              </span>
            </label>
          </div>

    
        </div>
        <!-- /Checkout Shipping Method --> <!-- Checkout Payment Method-->
        <div class="checkout-panel">
          <h5 class="title-checkout"><?= __("Payment Information") ?></h5>

          <div class="row">
            <!-- Payment Option-->
            <div class="col-12">
              <div class="form-check form-group form-check-custom form-radio-custom mb-3">
                <input class="form-check-input" type="radio" name="checkoutPaymentMethod" id="checkoutPaymentStripe" checked>
                <label class="form-check-label" for="checkoutPaymentStripe">
                  <span class="d-flex justify-content-between align-items-start">
                    <span>
                      <span class="mb-0 fw-bolder d-block"><?= __("Credit Cart") ?></span>
                    </span>
                    <i class="ri-bank-card-line"></i>
                  </span>
                </label>
              </div>
            </div>

            <!-- Payment Option-->
            <div class="col-12">
              <div class="form-check form-group form-check-custom form-radio-custom mb-3">
                <input class="form-check-input" type="radio" name="checkoutPaymentMethod" id="checkoutPaymentPaypal">
                <label class="form-check-label" for="checkoutPaymentPaypal">
                  <span class="d-flex justify-content-between align-items-start">
                    <span>
                      <span class="mb-0 fw-bolder d-block">PayPal</span>
                    </span>
                    <i class="ri-paypal-line"></i>
                  </span>
                </label>
              </div>
            </div>

          </div>

          <!-- Payment Details-->
          <div class="card-details">
            <div class="row pt-3">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="cc-name" class="form-label"><?= __("Name On Card") ?></label>
                  <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                  <small class="text-muted"><?= __("Full Name Display On Card") ?></small>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="cc-number" class="form-label"><?= __("Credit Card Number") ?></label>
                  <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="cc-expiration" class="form-label"><?= __("Expiration") ?></label>
                  <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <div class="d-flex">
                    <label for="cc-cvv" class="form-label d-flex w-100 justify-content-between align-items-center"><?= __("Security Code") ?></label>
                    <button type="button" class="btn btn-link p-0 fw-bolder fs-xs text-nowrap" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= __("A CVV is a number on your credit card or debit card that's in addition to your credit card number and expiration date") ?>">
                    <?= __("What's This") ?>
                    </button>
                  </div>
                  <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                </div>
              </div>
            </div>
          </div>
          <!-- / Payment Details-->

          <!-- Paypal Info-->
          <div class="paypal-details bg-light p-4 d-none mt-3 fw-bolder">
           <?= __(" Please click on complete order. You will then be transferred to Paypal to enter your payment details.") ?>
          </div>
          <!-- /Paypal Info-->
        </div>
        <!-- /Checkout Payment Method-->
      </div>
      <!-- / Checkout Panel Left -->

      <!-- Checkout Panel Summary -->
      <div class="col-12 col-lg-6 col-xl-5">
        <div class="bg-light p-4 sticky-md-top top-5">
          <div class="border-bottom pb-3">
            <?php
            foreach ($data as $index => $cart_item) {
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
              // Displaying cart item with photo
              echo ("<div class=\"d-none d-md-flex justify-content-between align-items-start py-2\">
                <div class=\"d-flex flex-grow-1 justify-content-start align-items-start\">
                    <div class=\"position-relative f-w-20 border p-2 me-4\">
                        <span class=\"checkout-item-qty\">$cart_item->quantity</span>
                        <img src='/uploads/{$filename}' class=\"rounded img-fluid\">
                    </div>
                    <div>
                        <p class=\"mb-1 fs-6 fw-bolder\">$prod->title</p>
                        <span class=\"fs-xs text-uppercase fw-bolder text-muted\">$Category->title</span>
                    </div>
                </div>
                <div class=\"flex-shrink-0 fw-bolder\">
                    <span>$$priceafterqty</span>
                </div>
            </div>");
            }
            ?>


            <?php
            $subtotal = 0;
            foreach ($data as $index => $cart_item) {
              $prod = new \app\models\Product();
              $prod = $prod->getProductByID($cart_item->product_id);
              $subtotal += $prod->price * $cart_item->quantity;
              echo ("<div class=\"py-3 border-bottom\">
                                  <div class=\"d-flex justify-content-between align-items-center mb-2\">
                                
                                     
                                  </div>
                              </div>");
            }
            ?>
            <?php
            $shipping = 8.95;
            $finalCost = $subtotal + $shipping;
            $tax = $finalCost * 0.15;  // 15% tax on the total after adding shipping
            $finalCost += $tax;
            $tax = number_format($tax, 2);
            $finalCost = number_format($finalCost, 2); // Round to 2 decimal places
            echo ("<div class=\"py-3 border-bottom\">
                                <div class=\"d-flex justify-content-between align-items-center mb-2\">
                                    <p class=\"m-0 fw-bolder fs-6\">". __('Subtotal'). "</p>
                                    <p class=\"m-0 fs-6 fw-bolder\">$$subtotal</p>
                                </div>
                                <div class=\"d-flex justify-content-between align-items-center\">
                                    <p class=\"m-0 fw-bolder fs-6\">". __('Shipping'). "</p>
                                    <p class=\"m-0 fs-6 fw-bolder\">$8.95</p>
                                </div>
                            </div>
                            <div class=\"py-3 border-bottom\">
                            <div class=\"d-flex justify-content-between align-items-center\">
                                <div>
                                    <p class=\"m-0 fw-bold fs-5\">". __('Grand Total'). "</p>
                                    <span class=\"text-muted small\">Inc $tax ". __('Sales Tax'). "</span>
                                </div>
                                <p class=\"m-0 fs-5 fw-bold\">$$finalCost</p>
                            </div>
                        </div>");



            ?>
              <!-- Your checkout panel summary content here -->

              <!-- Accept Terms Checkbox -->
              <div class="form-group form-check my-4">
                <input type="checkbox" class="form-check-input" id="accept-terms" checked>
                <label class="form-check-label fw-bolder" for="accept-terms"><?= __("I Agree To ZZD's ") ?> <a href="#"><?= __("Terms & Conditions") ?></a></label>
              </div>

              <!-- Complete Order Button -->
              <button type="submit" class="btn btn-dark w-100" name="complete_order"><?= __("Complete Order") ?></button>
            </form>


            <?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $productorder = new \app\models\ProductOrder();
    $productorder->customer_id = $_SESSION["customer_id"];
    $productorder->total_price = $finalCost;
    $productorder->time = date("Y-m-d H:i:s");
    $productorder->email = $_POST["email"];
    $productorder->firstname = $_POST["firstName"];
    $productorder->lastname = $_POST["lastName"];
    $productorder->address = $_POST["address"];
    $productorder->country = $_POST["country"];
    $productorder->province = $_POST["province"];
    $productorder->zip = $_POST["zip"];
    
    $productorder->insert();
    $orderid = $productorder->getOrderIdByAllButId();
    
    $orderDetailsHtml = '';
    $totalCost = 0;

    foreach ($data as $index => $cart_item) {
        $product = new \app\models\Product();
        $product = $product->getProductByID($cart_item->product_id);

        $orderdetail = new \app\models\OrderDetail();
        $orderdetail->order_id = $orderid->order_id;
        $orderdetail->product_id = $product->product_id;
        $orderdetail->quantity = $cart_item->quantity;
        $orderdetail->price = $product->price * $cart_item->quantity;

        $orderdetail->insert();

        $totalCost += $orderdetail->price;
        $picture = new \app\models\Picture();
        $picture = $picture->getAllForProductByID($product->product_id);
        $filename = $picture[0]->filename;

        // Build the HTML for each item
        $orderDetailsHtml .= "
            <tr>
                <td><img src='/uploads/{$filename}' alt='{$product->title}' width='100'></td>
                <td>{$product->title}</td>
                <td>{$cart_item->quantity}</td>
                <td>$" . number_format($product->price, 2) . "</td>
                <td>$" . number_format($orderdetail->price, 2) . "</td>
            </tr>";
    }

    // Complete email body with total cost
    $emailBody = "
        <html>
        <body>
            <h1>Order Confirmation</h1>
            <p>Hello,</p>
            <p>Your order has been placed successfully.</p>
            <p>Your order id is {$orderid->order_id}</p>
            <table border='1'>
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Product name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    $orderDetailsHtml
                </tbody>
            </table>
            <p>Products Cost: $" . number_format($totalCost, 2) . "</p>
            <p>Shipping Cost: $" . number_format($shipping, 2) . "</p>
            <p>Tax: $" . $tax . "</p>
            <p>Total Cost: $" . number_format($finalCost, 2) . "</p>
            <p>Thank you for shopping with Zenithal Zone Designs.</p>
        </body>
        </html>";

    $mailer = new \app\models\Mailer();
    $mailer->sendEmail($_POST["email"], "Order Confirmation", $emailBody);

    echo "<script>window.location.href='/Home';</script>";
    var_dump($emailBody);

}
?>

          </div>
        </div>
        <!-- /Checkout Panel Summary -->
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
      </div>
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