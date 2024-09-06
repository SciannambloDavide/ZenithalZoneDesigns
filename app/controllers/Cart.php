<?php
namespace app\controllers;

#[\app\filters\isCustomer]
class Cart extends \app\core\Controller
{

	function addToCart()
	{
		$product_id = $_GET["product_id"];
		$customer_id = $_SESSION["customer_id"];
		$cart_item = new \app\models\Cart_item();
		$cart_item->product_id = $product_id;
		$quantity = 1;
		$cart_item->customer_id = $customer_id;
		$cart_item->quantity = $quantity;
		//check if item already exists in wish list
		//Return false if not exist
		if ($cart_item->get()) {
			if($_SESSION['lang'] == 'en'){
				echo '<script>alert("Item Already Existed in Cart")</script>';
			}else{
				echo "<script>alert(\"L'article existe déjà dans le panier\")</script>";
			}
			
		} else {
			$cart_item->insert();
			if($_SESSION['lang'] == 'en'){
				echo '<script>alert("Item Added to Cart")</script>';
			}else{
				echo "<script>alert(\"Article ajouté au panier\")</script>";
			}
			
		}
		$this->viewAllCart();
	}
	//function 
	function viewAllCart()
	{
		$Cart_item = new \app\models\Cart_item();
		$product = new \app\models\Product();
		$customer_id = $_SESSION["customer_id"];
		$data = $Cart_item->getAll($customer_id);
		$this->view("Cart/cart", $data);
	}
	function removeFromCart()
	{
		$Cart_item = new \app\models\Cart_item();
		$Cart_item->product_id = $_GET["product_id"];
		$Cart_item->customer_id = $_GET["customer_id"];
		$Cart_item->delete();
		// Check if there are any items left in the cart after deletion
		$remainingItems = $Cart_item->getAll($Cart_item->customer_id);
		if (empty($remainingItems)) {
			// If no items left, redirect to home page
			header("location:/Home");
			exit(); // Make sure to call exit after header to stop further script execution
		} else {
			// If there are still items, redirect back to the cart
			header("location:/Cart/viewAllCart");
			exit();
		}
	}

	function checkout()
	{
		
		$Cart_item = new \app\models\Cart_item();
		$product = new \app\models\Product();
		$customer_id = $_SESSION["customer_id"];
		$data = $Cart_item->getAll($customer_id);
		if(empty($data)){
			echo '<script>alert("Cart is Empty")</script>';
			header("location:/Home");
			exit();
		}
		$this->view("Cart/checkout", $data);
	}
	function editQuantity()
	{
		$product_id = $_GET["product_id"];
		$new_quantity = $_GET["quantity"];

		// Retrieve the cart item based on the product ID
		$cart_item = new \app\models\Cart_item();
		$cart_item->customer_id = $_SESSION["customer_id"];
		$cart_item = $cart_item->getCartItemByID($product_id);

		if ($cart_item) {
			// If the cart item exists, update its quantity
			$cart_item->quantity = $new_quantity;
			$cart_item->update();
			if($_SESSION['lang'] == 'en'){
				echo '<script>alert("Quantity Updated Successfully")</script>';
			}else{
				echo "<script>alert(\"Quantité mise à jour avec succès\")</script>";
			}
			
		} else {
			// If the cart item doesn't exist, display an error message
			if($_SESSION['lang'] == 'en'){
				echo '<script>alert("Cart item not found")</script>';
			}else{
				echo "<script>alert(\"L'article du panier n'a pas été trouvé\")</script>";
			}
			
		}
		// Redirect back to the cart view
		header("location:/Cart/viewAllCart");
	}
	public function updateQuantity()
	{
		// Retrieve product ID and quantity from the POST request
		$product_id = $_POST["product_id"];
		$quantity = $_POST["quantity"];

		// Validate input if necessary

		// Update the quantity for the specific product in the cart
		$cart_item = new \app\models\Cart_item();
		$cart_item->customer_id = $_SESSION["customer_id"];
		$cart_item->product_id = $product_id;
		$cart_item->quantity = $quantity;
		$cart_item->update();

		// Redirect back to the cart page or do any other necessary actions
		header("Location: /Cart/viewAllCart");
		exit;
	}


}