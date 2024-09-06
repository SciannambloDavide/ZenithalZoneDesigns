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
        if ($product->product_id != $_GET['id']) {
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
}
?>