<html>
<head>
	<title><?= $name ?> view</title>
    	<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">-->
	<link rel="stylesheet" href="/app/includes/css.css">
    	<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>-->

</head>
<body>
<?php
    include('app/views/header.php');
    include('app/views/navbar.php');
?>
<div id='main'>
		<form method='post' action=''>
			<div class="form-group">
		
<div class="container">
    <div class="row">
        <div>
            <div class="contact-form">
                <h2><?= __("The reviews for") ?> <?=$data->title ?></h2>
                <?php
                $Reviews = new \app\models\Review();
                $ReviewsCount = $Reviews->getAllForProductVerifiedSortNew($_GET['id']);
                $AllReviews = $ReviewsCount;
                
                
                foreach($AllReviews as $index => $OneReview){

                    
              $Customer = new \app\models\Customer();
	            $Customer = $Customer->getById($OneReview->customer_id);
              $ratingPercent = $OneReview->rating * 20;
              echo"
              <article class='py-5 border-bottom' style='width: 1000px;'>
              <div class='row'>
                  <div class='col-12 col-md-4'>
                      <small class='text-muted fw-bolder'>$OneReview->date</small>
                      <p class='fw-bolder'>$Customer->username ($Customer->name)</p>
                      <span class='bg-success-faded fs-xs fw-bolder text-uppercase p-2'>". __("Verified Customer") . "</span>
                  </div>
                  <div class='col-12 col-md-8 mt-4 mt-md-0'>
                      <!-- Review Stars Small-->
                      <div class='rating position-relative d-table'>
                          <div class='position-absolute stars' style='width: $ratingPercent%'>
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
                      </div>
                      <p class='fw-bolder mt-4'>$OneReview->title</p>
                      <p>$OneReview->description</p>
          
                      ";
                      if($OneReview->rating >= 3){
                        echo"                      <small class='fw-bolder bg-success d-table rounded py-1 px-2'>". __("Yes, I would recommend the product") . "</small>
                        ";
                      }
                      else{
                        echo"                      <small class='fw-bolder bg-danger d-table rounded py-1 px-2'>". __("No, I wouldn't recommend the product") . "</small>
                        ";
                      }
                      if(isset($_SESSION['customer_id'])){

                      if( $_SESSION['customer_id'] == $OneReview->customer_id){
                      echo "<div class='d-block d-md-flex mt-3 justify-content-between align-items-center'>
                      
                      <a href='/Review/edit?id=$OneReview->review_id' class='btn btn-link text-muted p-0 text-decoration-none w-100 w-md-auto fw-bolder text-start mt-3 mt-md-0' title=''><small>". __("Edit") . " </small></a>

                               
                     <a href='/Review/delete?id=$OneReview->review_id' class='btn btn-link text-muted p-0 text-decoration-none w-100 w-md-auto fw-bolder text-start mt-3 mt-md-0' title=''><small>". __("Delete") . "  </small></a>
                      </div>";
                      }}
                echo"  </div>
              </div>
          </article>";
                      

            }?>
            </div>
        </div>
    </div>
</div>
</body>
</html>