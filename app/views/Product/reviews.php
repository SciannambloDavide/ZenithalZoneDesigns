
<?php 
            $Reviews = new \app\models\Review();
            $ratingAll= count($data);
            $rating1 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],1);
            $rating2 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],2);
            $rating3 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],3);
            $rating4 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],4);
            $rating5 = $Reviews->getCountForProductRatingCountVerified($_GET['id'],5);
            $combinedRatings = (($rating1 * 1) + ($rating2 * 2) + ($rating3 * 3) + ($rating4 * 4) + ($rating5 * 5));
            if($combinedRatings != 0){
            $OverallRating =  $combinedRatings / $ratingAll;
            }
          else{
            $OverallRating =  0;
          }
           
            $OverallRating = number_format($OverallRating, 2);

	
	?>
	<!--Rating and button-->
  <div class="row">
	
	<div class="col">
    
	<div style=" margin-bottom:10px" class="progress"  role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
  <div class="progress-bar progress-bar-striped bg-success text-dark overflow-visible" style="width: <?=$rating5 == 0 ? 0 : $rating5 / $ratingAll * 100?>%"><?=$rating5?> reviews</div>
</div>

<div style=" margin-bottom:10px" class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
  <div class="progress-bar progress-bar-striped bg-success text-dark overflow-visible" style="width: <?=$rating4 == 0 ? 0 : $rating4 / $ratingAll * 100?>%"><?=$rating4?> reviews </div>
</div>

<div style=" margin-bottom:10px" class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
  <div class="progress-bar progress-bar-striped bg-warning text-dark overflow-visible" style="width: <?=$rating3 == 0 ? 0 : $rating3 / $ratingAll * 100?>%"><?=$rating3?> reviews</div> 
</div>
<div style=" margin-bottom:10px" class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
  <div class="progress-bar progress-bar-striped bg-danger text-dark overflow-visible" style="width: <?=$rating2 == 0 ? 0 : $rating2 / $ratingAll * 100?>%"><?=$rating2?> reviews</div>
</div>

<div style=" margin-bottom:10px" class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
  <div class="progress-bar progress-bar-striped bg-danger text-dark overflow-visible" style="width: <?=$rating1 == 0 ? 0 : $rating1 / $ratingAll * 100?>%"><?=$rating1?> reviews</div>
</div>

    </div>
    <div class="col text-start">
    
    
    <div class="row">
        <div class="col">
        5 Stars
        <br>
        4 Stars
        <br>
        3 Stars
        <br>
        2 Stars
        <br>
        1 Stars
      
        
    </div>
    <div class="col text-center">
       <?=$ratingAll?> ratings in total
       <br>
    <p>Ratings: <?=$OverallRating?>/5</p>
		<a href='/Review/writeReview?id=<?= $_GET['id'] ?>' class="btn btn-primary btn-lg">Create a Review</a>

</div>
</div>
		
    </div>
</div>



<!-- THIS IS THE REVIEWS PART  -->
<div class="container text-start">

<table>		

		<?php
		foreach($data as $index => $review){
            $Customer = new \app\models\Customer();
	$Customer = $Customer->getById($review->customer_id);
  if($review->rating > 3){
  echo "
  <div class=\"alert alert-success\" role=\"alert\">
";
  }
  else if($review->rating < 3){
    echo "
    <div class=\"alert alert-danger\" role=\"alert\">
  ";
  }
  else {
    echo "
    <div class=\"alert alert-warning\" role=\"alert\">
  ";
  }
    
if(isset($_SESSION['customer_id'])){
  if($_SESSION['customer_id'] == $review->customer_id){
    echo"
    <a href='/Review/edit?reviewid=$review->review_id&productid=$review->product_id'>edit</a>
    <a href='/Review/delete?id=$review->review_id'>delete</a>
    <h4 class=\"alert-heading\"> $review->title</h4>
    ";
  }
}
      else{
       echo" <h4 class=\"alert-heading\"> $review->title</h4>";
      }

echo "
      <h5> rating: $review->rating/5</h5>
      <p>$review->description</p>
      <hr>
      <p class=\"mb-0\">Review from $Customer->username. &nbsp;&nbsp;&nbsp;(Posted at: $review->date)</p>
  </div>
";
		}
		?>
</table>
</div>
