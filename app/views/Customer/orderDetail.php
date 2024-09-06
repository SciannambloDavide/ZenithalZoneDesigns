<?php
include('app/includes/header.php');
?>

<body class="bg-secondary">
<section class="vh-100 gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-10 col-lg-8 col-xl-6">
        <div class="card card-stepper" style="border-radius: 16px;">
          <div class="card-header p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-2"> Order ID <span class="fw-bold text-body"><?= $data->order_id?></span></p>
                <p class="text-muted mb-0"> Place On <span class="fw-bold text-body">12,March 2019</span> </p>
              </div>
              <div>
                <h6 class="mb-0"> <a href="/Customer/orderHistory">Return to Order History</a> </h6>
              </div>
            </div>
          </div>
          <div class="card-body p-4">
            <div class="d-flex flex-row mb-4 pb-2">
              <div class="flex-fill">
                <h5 class="bold"><?php $prod = new \app\models\Product();
                                    $prod = $prod->getProductByID($data->product_id); 
                                    echo $prod->title;
                                ?></h5>
                <!--TODO GET DATE ORDERED, QUANITY AND TOTAL COST-->
                <p class="text-muted"> Qt: 1 item</p>
                <h4 class="mb-3"> $ 299 <span class="small text-muted"> via (CAD) </span></h4>
                <p class="text-muted">Order Status: <span class="text-body">Arrived</span></p>
                <!--TODO GET DATE ORDERED, QUANITY AND TOTAL COST-->
              </div>
              <div>
                <img class="align-self-center img-fluid"
                  src="https://media.gettyimages.com/id/1335295270/photo/global-connection.jpg?s=612x612&w=gi&k=20&c=xs_DvcvEflA-EIRXXGK71Et6OtVHldTx2E7flyjybk0=" width="250">
              </div>
            </div>
          </div>
          <div class="card-footer p-4">
            <div class="d-flex justify-content-between">
              <!-- <h5 class="fw-normal mb-0"><a href="#!">Track</a></h5>
              <div class="border-start h-100"></div>
              <h5 class="fw-normal mb-0"><a href="#!">Cancel</a></h5>
              <div class="border-start h-100"></div>
              <h5 class="fw-normal mb-0"><a href="#!">Pre-pay</a></h5>
              <div class="border-start h-100"></div>
              <h5 class="fw-normal mb-0"><a href="#!" class="text-muted"><i class="fas fa-ellipsis-v"></i></a>
              </h5> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>

</html>