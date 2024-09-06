<?php

namespace app\controllers;

#[\app\filters\isAdmin]
class Admin extends \app\core\Controller
{

	function langChecker(){
		if($_SESSION['lang'] == 'en'){
			$_SESSION['lang'] = 'fr';
		}else{
			$_SESSION['lang'] = 'en';
		}
		header("location:/Admin/dashboard?lang=" . $_SESSION['lang']);
	}

	function productManagement()
	{
		$products = new \app\models\Product();
		$data = [];
		if (isset($_GET["sortOption"])) {
			//if sort option is selected
			//if Admin select sort products by Name Ascending
			if ($_GET["sortOption"] === "nameASC") {
				$products = \app\models\Product::sortByNameASC();
				$data = ['products' => $products];
				//if Admin select sort products by Name DESC
			} else if ($_GET["sortOption"] === "nameDESC") {
				$products = \app\models\Product::sortByNameDESC();

				//if Admin select sort products by Price ASC
			} else if ($_GET["sortOption"] === "priceASC") {
				$products = \app\models\Product::sortByPriceASC();

				//if Admin select sort products by Price DESC
			} else if ($_GET["sortOption"] === "priceDESC") {
				$products = \app\models\Product::sortByPriceDESC();

				//if Admin select sort products by type DESC
			} else if ($_GET["sortOption"] === "idASC") {
				$products = \app\models\Product::sortByIdASC();

				//if Admin select sort products by type DESC
			} else if ($_GET["sortOption"] === "idDESC") {
				$products = \app\models\Product::sortByIdDESC();
			} else {
				$products = \app\models\Product::getAll();
			}
			$data = ['products' => $products];
			$this->view("Admin/productManagement", $data);
		} else if (isset($_GET["content"])) {
			$products = $products->searchByTitle($_GET["content"]);
			$data = ['products' => $products];
			$this->view("Admin/productManagement", $data);
		} else if (isset($_GET["message"])) {
			$products = \app\models\Product::getAll();

			if(isset($_GET["noError"])){
				$data = ['products' => $products, 'message' => $_GET["message"], 'noError' => "no"];
			}else{
				$data = ['products' => $products, 'message' => $_GET["message"]];
			}
				
			$this->view("Admin/productManagement", $data);
		} else {
			$products = \app\models\Product::getAll();
			$data = ['products' => $products];
			$this->view("Admin/productManagement", $data);
		}
	}

	//for order management page
	public function updateOrderStatus()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$order = new \app\models\ProductOrder();
			$order_id = $_POST['order_id'] ?? null;
			$status = $_POST['status'] ?? null;

			if ($order_id !== null && $status !== null) {
				$order->updateStatus($order_id, $status);
			}

			header('Location: ' . $_SERVER['HTTP_REFERER']); // Redirect back to the same page
			exit;
		}
	}

	function producttest()
	{
		$reviews = new \app\models\Review();
		$reviews = \app\models\Review::getAllReviews();
		$this->view("Admin/producttest", $reviews);
	}

	function reviewManagement()
	{
		$reviews = new \app\models\Review();
		if (isset($_GET["sortOption"])) {
			//if sort option is selected
			//if Admin select sort products by Name Ascending
			if ($_GET["sortOption"] === "nameASC") {
				$reviews = \app\models\Review::sortByNameASC();
				$this->view("Admin/reviewManagement", $reviews);
			} else if ($_GET["sortOption"] === "nameDESC") {
				$reviews = \app\models\Review::sortByNameDESC();
				$this->view("Admin/reviewManagement", $reviews);
			} else if ($_GET["sortOption"] === "statusASC") {
				$reviews = \app\models\Review::sortByStatusASC();
				$this->view("Admin/reviewManagement", $reviews);
				//if Admin select sort products by Price DESC
			} else if ($_GET["sortOption"] === "statusDESC") {
				$reviews = \app\models\Review::sortByStatusDESC();
				$this->view("Admin/reviewManagement", $reviews);
			} else if ($_GET["sortOption"] === "dateASC") {
				$reviews = \app\models\Review::sortByDateASC();
				$this->view("Admin/reviewManagement", $reviews);
			} else if ($_GET["sortOption"] === "dateDESC") {
				$reviews = \app\models\Review::sortByDateDESC();
				$this->view("Admin/reviewManagement", $reviews);
			} else {
				$reviews = \app\models\Review::sortByDateDESC();
				$this->view("Admin/reviewManagement", $reviews);
			}
		} else if (isset($_GET["content"])) {
			$reviews = $reviews->searchByProduct($_GET["content"]);
			$this->view("Admin/reviewManagement", $reviews);
		} else {
			$reviews = \app\models\Review::sortByDateDESC();
			$this->view("Admin/reviewManagement", $reviews);
		}
	}

	function categoryManagement()
	{
		$category = new \app\models\Category();
		if (isset($_GET["sortOption"])) {
			//if sort option is selected
			//if Admin select sort products by Name Ascending
			if ($_GET["sortOption"] === "nameASC") {
				$category = \app\models\Category::sortByNameASC();
				$data = ['category' => $category];
				$this->view("Admin/categoryManagement", $data);
			} else if ($_GET["sortOption"] === "nameDESC") {
				$category = \app\models\Category::sortByNameDESC();
				$data = ['category' => $category];
				$this->view("Admin/categoryManagement", $data);
			} else if ($_GET["sortOption"] === "countDESC") {
				$product_cat = \app\models\Category::sortByCountASC();
				$data = [];
				foreach ($product_cat as $index => $product_category) {
					$category = new \app\models\Category();
					$category = $category->getByCatId($product_category->category_id);
					$data[] = $category;
				}
				$category = new \app\models\Category();
				$category = $category->getAll();
				foreach ($category as $index => $cat) {
					//IF cat id doesnt exist in data, basically cat_id where theres no item under it
					if (!in_array($cat->category_id, array_column($data, 'category_id'))) {
						$data[] = $cat;
					}
				}
				$data = ['category' => $data];
				$this->view("Admin/categoryManagement", $data);

				//if Admin select sort category by Count DESC
			} else if ($_GET["sortOption"] === "countASC") {
				$product_cat = \app\models\Category::sortByCountDESC();
				$data = [];
				foreach ($product_cat as $index => $product_category) {
					$category = new \app\models\Category();
					$category = $category->getByCatId($product_category->category_id);
					$data[] = $category;
				}
				$category = new \app\models\Category();
				$category = $category->getAll();
				foreach ($category as $index => $cat) {
					//IF cat id doesnt exist in data, basically cat_id where theres no item under it
					if (!in_array($cat->category_id, array_column($data, 'category_id'))) {
						array_unshift($data, $cat);
					}
				}
				$data = ['category' => $data];
				$this->view("Admin/categoryManagement", $data);
			} else {
				$category = $category->getAll();
				$data = ['category' => $category];
				$this->view("Admin/categoryManagement", $data);
			}
		} else if (isset($_GET["content"])) {
			$category = $category->searchByTitle($_GET["content"]);
			$data = ['category' => $category];
			$this->view("Admin/categoryManagement", $data);
		} else {
			$category = new \app\models\Category();
			$category = $category->getAll();
			$data = ['category' => $category];
			$this->view("Admin/categoryManagement", $data);
		}
	}

	function orderManagement()
	{
		$order = new \app\models\ProductOrder();

		if (isset($_GET["sortOption"])) {
			switch ($_GET["sortOption"]) {
				case "timeASC":
					$orders = $order->sortByTimeASC();
					break;
				case "timeDESC":
					$orders = $order->sortByTimeDESC();
					break;
				case "priceASC":
					$orders = $order->sortByPriceASC();
					break;
				case "priceDESC":
					$orders = $order->sortByPriceDESC();
					break;
				default:
					$orders = $order->getAll();
					break;
			}
			$data = ['orders' => $orders];
			$this->view("Admin/orderManagement", $data);
		} elseif (isset($_GET["search"]) && !empty($_GET["search"])) {
			$orders = $order->searchByOrderIdOrCustomerName($_GET["search"]);
			$data = ['orders' => $orders];
			$this->view("Admin/orderManagement", $data);
		} else {
			$orders = $order->getAll();
			$data = ['orders' => $orders];
			$this->view("Admin/orderManagement", $data);
		}
	}

	function dashboard()
	{
		$this->view("Admin/dashboard");
	}

	function searchReview()
	{
		if (isset($_POST["content"])) {
			$content = $_POST["content"];
			$review = new \app\models\Review();
			$review = $review->searchByTitle($content);
			$this->view("Admin/reviewManagement", $review);
		} else {
			// Handle case when searchBy or content is not set
			header("location:/Admin/reviewManagement");
		}
	}

	function viewReview()
	{
		$review = new \app\models\Review();
		$review_id = $_GET["review_id"];
		$review = $review->getReviewByID($review_id);
		$this->view("Admin/viewReview", $review);
	}

	//Temporary Function for creating Admin Account
	// function create(){
	// 	if($_SERVER['REQUEST_METHOD'] === 'POST'){
	// 		//getting the user input and place it in an object
	// 		//create the new User
	// 		$user = new \app\models\Admin();
	// 		//populate the User
	// 		$user->email = "testadmin2@gmail.com";
	// 		$user->password_hash = password_hash("testadmin", PASSWORD_DEFAULT);
	// 		//insert the user
	// 		$user->insert();
	// 		//redirect to a good place
	// 		header('location:/User/login');
	// 	}else{
	// 		$this->view("Admin/dashboard");
	// 	}
	// }



	// FOR REVIEW MANAGING:
	function toggleStatus()
	{
		$review = new \app\models\review();
		//specify the publication
		$review = $review->getReview($_GET["id"]);
		//this is to gatekeep the guest (Security gatekeeping)
		//process the update
		if ($review->status == 1) {
			$review->status = 0;
		} else {
			$review->status = 1;
		}

		$review->updateStatus();
		//Shouldve used publication_comments's field But I guess this can serve as two ways to do it (from view/footer)
		header('location:/Admin/reviewManagement');
	}

	function approveMultipleStatus()
	{
		if (isset($_GET["review_ids"])) {
			$review_ids = explode(",", $_GET["review_ids"]);
			// Process approval for each review ID
			foreach ($review_ids as $review_id) {
				$review = new \app\models\review();
				$review = $review->getReview($review_id);
				$review->status = 1;
				$review->updateStatus();
			}
			header('location:/Admin/reviewManagement');
		} else {
			header('location:/Admin/reviewManagement');
		}
	}

	function denyMultipleStatus()
	{
		if (isset($_GET["review_ids"])) {
			$review_ids = explode(",", $_GET["review_ids"]);
			//Deny each review ID
			foreach ($review_ids as $review_id) {
				$review = new \app\models\review();
				$review = $review->getReview($review_id);

				$review->status = 0;
				$review->updateStatus();
			}
			header('location:/Admin/reviewManagement');
		} else {
			header('location:/Admin/reviewManagement');
		}
	}

	public function adminDeleteReview()
	{

		$review = new \app\models\review();
		//specify the publication
		$review = $review->getReview($_GET["id"]);
		//this is to gatekeep the guest (Security gatekeeping)
		//the other delete uses a form ( dont know but this is more quick but somewhat risky -> no warnings.)

		$review->delete();
		header('location:/Admin/reviewManagement');
	}
	// FOR REVIEW MANAGING^
}
