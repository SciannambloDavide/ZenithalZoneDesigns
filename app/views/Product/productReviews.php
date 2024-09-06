<?php
                                    //this is to get the overall rating
                                    $Reviews = new \app\models\Review();
                                    $ReviewsCount = $Reviews->getAllForProductVerifiedSortNew($_GET['id']);
                                    $AllReviews = $ReviewsCount;

                                    $rating0 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],0);

                                    $rating1 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],1);
                                    $rating2 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],2);
                                    $rating3 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],3);
                                    $rating4 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],4);
                                    $rating5 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],5);

                                    $ReviewsCount= count($ReviewsCount); 
            $combinedRatings = (($rating1 * 1) + ($rating2 * 2) + ($rating3 * 3) + ($rating4 * 4) + ($rating5 * 5));
            if($combinedRatings != 0){
                //avg out of 5
            $OverallRating =  $combinedRatings / $ReviewsCount;
            $OverallRating5 = $OverallRating;
            //avg out of 100%
            $OverallRating = $OverallRating * 100 / 5;
            
            }
          else{
            $OverallRating =  0;
            $OverallRating5 = 0;
          }
          //round the ratings.
            $OverallRating5 = number_format($OverallRating5, 2);
            $OverallRating = number_format($OverallRating, 2);
            echo "         
            <!-- Review Tab Content-->                         
            <div class='tab-pane fade show active py-5' id='reviews' role='tabpanel' aria-labelledby='reviews-tab'>
            <!-- Customer Reviews-->
            <section class='reviews'>
            <div class='col-lg-12 text-center pb-5'>
            <h2 class='fs-1 fw-bold d-flex align-items-center justify-content-center'>$OverallRating5<small
            class='text-muted fw-bolder ms-3 fw-bolder fs-6'>($ReviewsCount " .  __('reviews') .")</small></h2>


            <div class='d-flex justify-content-center'>
                                    <!-- Review Stars Medium-->
                                    <div class='rating position-relative d-table'>
                                        <div class='position-absolute stars' style='width: $OverallRating%'>
                                            <i class='ri-star-fill text-dark ri-2x mr-1'></i>
                                            <i class='ri-star-fill text-dark ri-2x mr-1'></i>
                                            <i class='ri-star-fill text-dark ri-2x mr-1'></i>
                                            <i class='ri-star-fill text-dark ri-2x mr-1'></i>
                                            <i class='ri-star-fill text-dark ri-2x mr-1'></i>
                                        </div>
                                        <div class='stars'>
                                            <i class='ri-star-fill ri-2x mr-1 text-muted'></i>
                                            <i class='ri-star-fill ri-2x mr-1 text-muted'></i>
                                            <i class='ri-star-fill ri-2x mr-1 text-muted'></i>
                                            <i class='ri-star-fill ri-2x mr-1 text-muted'></i>
                                            <i class='ri-star-fill ri-2x mr-1 text-muted'></i>
                                        </div>
                                    </div>       
                                   </div>


                                   <div class='bg-light rounded py-3 px-4 mt-3 col-12 col-md-6 col-lg-5 mx-auto'>
                                    <ul class='list-group list-group-flush'>
                                    
                                        <li
                                            class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 bg-transparent'>
                                            <span class='fw-bolder'> $rating5 " .__('Reviews')."</span>
                                            <!-- Review Stars Small-->
                                            <div class='rating position-relative d-table'>
                                                <div class='position-absolute stars' style='width: 100%'>
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
                                                   </li>

                                                   <li
                                            class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 bg-transparent'>
                                            <span class='fw-bolder'>$rating4 " .__('Reviews')."</span>
                                            <!-- Review Stars Small-->
                                            <div class='rating position-relative d-table'>
                                                <div class='position-absolute stars' style='width: 80%'>
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
                                                   </li>

                                                   
                                                   </li>

                                                   <li
                                            class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 bg-transparent'>
                                            <span class='fw-bolder'>$rating3 " .__('Reviews')."</span>
                                            <!-- Review Stars Small-->
                                            <div class='rating position-relative d-table'>
                                                <div class='position-absolute stars' style='width: 60%'>
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
                                                   </li>


                                                   </li>

                                                   <li
                                            class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 bg-transparent'>
                                            <span class='fw-bolder'>$rating2 " .__('Reviews')."</span>
                                            <!-- Review Stars Small-->
                                            <div class='rating position-relative d-table'>
                                                <div class='position-absolute stars' style='width: 40%'>
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
                                                   </li>


                                                   </li>

                                                   <li
                                            class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 bg-transparent'>
                                            <span class='fw-bolder'>$rating1 " .__('Reviews')."</span>
                                            <!-- Review Stars Small-->
                                            <div class='rating position-relative d-table'>
                                                <div class='position-absolute stars' style='width: 20%'>
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
                                                   </li>


                                                   <li
                                            class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 bg-transparent'>
                                            <span class='fw-bolder'>$rating0 " .__('Reviews')."</span>
                                            <!-- Review Stars Small-->
                                            <div class='rating position-relative d-table'>
                                                <div class='position-absolute stars' style='width: 0%'>
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
                                                   </li>

                                                   <!-- button review create -->
                                    </ul>
                                </div>
                                
                                <!-- Review Modal-->
                               ";
                               //to see if your a customer ( to be able to send a review)
                               echo '<button type="button" ' . (isset($_SESSION['customer_id']) ? '' : 'disabled') . ' class="btn btn-dark mt-4 hover-lift-sm hover-boxshadow disable-child-pointer" data-bs-toggle="offcanvas" data-bs-target="#offcanvasReview" aria-controls="offcanvasReview">
                               ' . (isset($_SESSION['customer_id']) ? __('Write a review')  :  __('Please log in to write a review') ).' <i class="ri-discuss-line align-bottom ms-1"></i>
                            </button>';

                               echo"
                                <!-- / Review Modal Button-->
                            </div>

                            <article class='border-bottom border-top'>

                            <!-- Reviews-->
            ";
          
            /// This is for each Review box
            $count = 0;
            foreach($AllReviews as $index => $OneReview){
                if($count < 3){
             $Customer = new \app\models\Customer();
	            $Customer = $Customer->getById($OneReview->customer_id);
              $ratingPercent = $OneReview->rating * 20;
              echo"
              <article class='py-5 border-bottom '>
              <div class='row'>
                  <div class='col-12 col-md-4'>
                      <small class='text-muted fw-bolder'>$OneReview->date</small>
                      <p class='fw-bolder'>$Customer->username ($Customer->name)</p>
                      <span class='bg-success-faded fs-xs fw-bolder text-uppercase p-2'>". __('Verified Customer') ."</span>
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
                        echo"                      <small class='fw-bolder bg-success d-table rounded py-1 px-2'> ". __('Yes, I would recommend the product') ." </small>
                        ";
                      }
                      else{
                        echo"                      <small class='fw-bolder bg-danger d-table rounded py-1 px-2'> ". __("No, I wouldn't recommend the product") ." </small>
                        ";
                      }
                      if(isset($_SESSION['customer_id'])){

                      if( $_SESSION['customer_id'] == $OneReview->customer_id){
                      echo "<div class='d-block d-md-flex mt-3 justify-content-between align-items-center'>
                      
                      <a href='/Review/edit?id=$OneReview->review_id' class='btn btn-link text-muted p-0 text-decoration-none w-100 w-md-auto fw-bolder text-start mt-3 mt-md-0' title=''><small>Edit </small></a>

                               
                     <a href='/Review/delete?id=$OneReview->review_id' class='btn btn-link text-muted p-0 text-decoration-none w-100 w-md-auto fw-bolder text-start mt-3 mt-md-0' title=''><small>Delete </small></a>
                      </div>";
                      }}
                echo"  </div>
              </div>
          </article>";

          $count++;
                    } 

            }
             ///See all review buttons and verification that you are a customer.
             if(isset($_SESSION['customer_id'])){
                echo"
            <a href='/Review/viewAllFromProduct?id=" . $_GET['id'] . "' class='btn btn-dark d-table mx-auto mt-6 mb-3 hover-lift-sm hover-boxshadow' title=''>" . __('View All Reviews')  . "</a>
";
             }
             else{
                echo "<button type='button' disabled  class='btn btn-dark d-table mx-auto mt-6 mb-3 hover-lift-sm hover-boxshadow' data-bs-toggle='offcanvas' data-bs-target='#offcanvasReview' aria-controls='offcanvasReview'>
                ". __('Please log in to view all Reviews')  ."
             </button>";
             }
            
                         echo"   <p class='text-muted text-center fw-bolder'>". __("Showing") ." $count ". __("of") ." $ReviewsCount</p>";
            
            
            

            ?>
   


