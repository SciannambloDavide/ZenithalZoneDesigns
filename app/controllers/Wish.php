<?php
namespace app\controllers;

#[\app\filters\isCustomer]
class Wish extends \app\core\Controller{
	
	function test(){
		$this->view("Wish/test");
	}
	
	function addToWish(){
		$product_id = $_GET["product_id"];
		$customer_id = $_SESSION["customer_id"];
		$wish = new \app\models\Wish();
		$wish->product_id = $product_id;
		$wish->customer_id = $customer_id;
		//check if item already exists in wish list
		//Return false if not exist
		$product = new \app\models\Product();
		$product = $product->getProductByID($product_id);
		if($wish->get()){
			$message = "Product Is Already In Your Wish List";
			if ($_SESSION['lang'] == 'fr') {
				$message = "Le produit est déjà dans votre liste de souhaits";
			}
			header("location:/Product/viewProduct?id=$product_id&message=$message");
		}else{
			$wish->insert();
			$message = "Product Is Added To Your Wish List";
			if ($_SESSION['lang'] == 'fr') {
				$message = "Le produit est ajouté à votre liste de souhaits";
			}
			header("location:/Product/viewProduct?id=$product_id&message=$message");
		}	
	}

	function viewAllWish(){
		$wish = new \app\models\Wish();
		$product = new \app\models\Product();
		$customer_id = $_SESSION["customer_id"];
		$data = $wish->getAll($customer_id);
		$this->view("Wish/viewAllWish", $data);
	}

	function removeFromWish(){
		$wish = new \app\models\Wish();
		$wish->product_id = $_GET["product_id"];
		$wish->customer_id = $_SESSION["customer_id"];
		$wish->delete();
		header("location:/Wish/viewAllWish");
	}

	function removeAllFromWish(){
		$wish = new \app\models\Wish();
		$wish->customer_id = $_SESSION["customer_id"];
		$wish->deleteAll();
		header("location:/Wish/viewAllWish");
	}
}