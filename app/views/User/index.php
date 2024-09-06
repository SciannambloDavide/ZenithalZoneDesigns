<html>
<head>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/app/includes/css.css">

</head>
<body>
<?php
include('/opt/lampp/htdocs/app/includes/header.php');
?>
<div id='main'>
    <h1> Welcome User! </h1>
    <p></p>
    <p>This is the testing ground.</p>

    <h1 id='main'>User</h1>
    <a href='/Product/viewProduct?id=1'>View Product with ID 1 NEW</a>

  <a href='/Product/view?id=1'>View Product with ID 1 (doesnt work. look up ^^^)</a>
  <a href='/Product/viewAll'>View All</a>

	<h1 id='main'> Customer</h1>
  
	<a href='/Customer/viewProfile'>View Profile</a>
	<a href='/Customer/modify'>Update Profile</a>
	<a href='/Customer/orderHistory'> View Orders</a>
  <a href='/Customer/reviewHistory'> View Reviews</a>


    <h1 id='main'> Admin</h1>
  
  <a href='/Admin/reviewManagement'>Review Management</a>
  <a href='/Admin/productManagement'>Product Management</a>
  <br>
  <br>
  <br>
  <a href='/User/beUser'>Become User1</a>
  <a href='/User/beAdmin'>Become Admin</a>
  <a href='/User/logout'>logout</a>

  <?php
echo "Customer ID: " . (isset($_SESSION["customer_id"]) ? $_SESSION["customer_id"] :"Not defined");
echo "<br>";
echo "Admin ID: " . (isset($_SESSION["admin_id"]) ? $_SESSION["admin_id"] :"Not defined");
?>


</div>

</body>
</html>