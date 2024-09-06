<html>
<head>
	<title><?= $name ?> view</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<?php
include('/opt/lampp/htdocs/app/includes/header.php');
?>
<?php
include('app/includes/navBar.php');
?>



	
<!--include('app/includes/image.php');-->
<div class="container text-center">
  <div class="row align-items-start">

	<!--Image! PHP code shall be used for such commoditiy.-->
<div class="col">
<div id="carouselExampleFade" class="carousel slide carousel-fade">
  <div class="carousel-inner">
<!-- to add the images-->
  <?php 
 	$pictures = new \app\models\Picture();
     $pictures = $pictures->getAllForProduct($data->product_id);

     foreach($pictures as $index => $picture){
        if($index == 0){
            echo "
            <div class='carousel-item active'>
            <img src='/uploads/$picture->filename' style='margin:20px' height=500 width='600' class='d-block w-100'>
          </div>
            ";
        }
        else{
            echo "
            <div class='carousel-item'>
            <img src='/uploads/$picture->filename' style='margin:20px' height=500 width='600' class='d-block w-100'>
          </div>
            ";
        }

     }

  ?>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>

	<!---->
<div class="col">

    <h1 style="margin-top:20px"><?= $data->title ?></h1>
    <hr>
    <p>Price:</p>
    <p class="fs-2"><?= $data->price ?></p>

    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Description:
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?= $data->description ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Details:
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p><strong>Type of product:</strong> <?= $data->product_type ?></p>
                    <p><strong>Is it a physical object?:</strong> <?= $data->in_stock == "1" ? "Yes" : "No" ?></p>
                </div>
            </div>
        </div>
    </div>
  

    <p style="margin-top:20px"><strong>Is it in stock:</strong> <?= $data->in_stock == "1" ? "Yes" : "No" ?>
	<!-- SCRIPT for the increment -->
	<script>
    document.addEventListener("DOMContentLoaded", function() {
        var quantityInput = document.getElementById('quantity');
		var decrementButton10 = document.getElementById('decrementButton10');
        var decrementButton = document.getElementById('decrementButton');
        var incrementButton = document.getElementById('incrementButton');
		var incrementButton10 = document.getElementById('incrementButton10');

		decrementButton10.addEventListener('click', function() {
            // Decrement the value in the input field if it's greater than 0
            if (parseInt(quantityInput.value) >= 10) {
                quantityInput.value = parseInt(quantityInput.value) - 10;
            }
        });
        decrementButton.addEventListener('click', function() {
            // Decrement the value in the input field if it's greater than 0
            if (parseInt(quantityInput.value) > 0) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });

        incrementButton.addEventListener('click', function() {
            // Increment the value in the input field
			if (parseInt(quantityInput.value) < 100) {
            quantityInput.value = parseInt(quantityInput.value) + 1;
			}
        });
		incrementButton10.addEventListener('click', function() {
            // Increment the value in the input field
			if (parseInt(quantityInput.value) < 90) {
            quantityInput.value = parseInt(quantityInput.value) + 10;
			}
        });
    });
</script>
	<?php
	if($data->in_stock=='1'){
		echo '	
		<div class="col">
		<div style="text-align: center;">
    <p>
	<button id="decrementButton10" style="margin-bottom:15px" type="button" class="btn btn-danger">-10</button>
        <button id="decrementButton" style="margin-bottom:15px" type="button" class="btn btn-danger">-</button>
        <input type="number" name="quantity" id="quantity" value="0"  readonly style="width: 50px; text-align:center;" >
        <button id="incrementButton" style="margin-bottom:15px" type="button" class="btn btn-success">+</button>
		<button id="incrementButton10" style="margin-bottom:15px" type="button" class="btn btn-success">+10</button>

    </p>
</div>
		<p><button type="button" class="btn btn-primary btn-lg">Buy item</button></p>

</div>

		';
		
	}
	else{
		echo '
		<p><button type="button" class="btn btn-primary" disabled>Out of stock</button></p>
		';
	}
	
	?>

	<p><a href="\Wish\addToWish?id=<?= $data->product_id?>" class="btn btn-outline-primary">Add To Wish</a></p>
	<p><a href="\Cart\addToCart?id=<?= $data->product_id?>" class="btn btn-primary">Add To Cart</a></p>
	</div>
    <hr>



</body>
</html>