<?php

namespace app\controllers;

class Product extends \app\core\Controller
{

	function viewProduct()
	{
		$product = new \app\models\Product();
		$product = $product->getProductByID($_GET['id']);
		//to see if it even exists
		if ($product == null) {
			header("location:/Home");
		} else if (isset($_GET["message"])) {
			$data = ['product' => $product, 'message' => $_GET["message"]];
			$this->view("Product/Product", $data);
		} else {
			$data = ['product' => $product];
			$this->view("Product/Product", $data);
		}


		/* Old code
		$product = new \app\models\Product();

		$product = $product->getProductByID($_GET['id']);

		$reviews = new \app\models\Review();
		//Change this to verified or not for testing.
		$reviews = $reviews->getAllForProductVerified($_GET['id']);
		
		if(isset($product->product_id)){

		$this->view("Product/view",$product);
		$this->view("Product/reviews",$reviews);

		}
		else{
			$this->view("Product/error");
		}
		*/
	}

	function productSearch()
	{
		if (isset($_POST["searchBy"]) && isset($_POST["content"])) {
			$searchBy = $_POST["searchBy"];
			$content = $_POST["content"];
			$products = new \app\models\Product();

			// If User Search By Title
			if ($searchBy == "title") {
				$products = $products->searchByTitle($content);
			}
			// If User Search By Description
			else if ($searchBy == "description") {
				$products = $products->searchByDescription($content);
			}
			$this->view("Product/viewAll", $products);
		} else {
			// Handle case when searchBy or content is not set
			header("location:/Product/viewAll");
		}
	}


	function viewAll()
	{
		$products = new \app\models\Product();
		$products = $products->getAll();
		$this->view("Product/viewAll", $products);
	}

	//create() method
	//creation of private variable to store the information properly for images.
	private $folder = 'uploads/';
	#[\app\filters\isAdmin]
	function productCreate()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') { //data is submitted through method POST

			//make a new profile object
			$product = new \app\models\Product();
			//populate it$publication_id;
			$product->title = $_POST['title'];
			$product->price = $_POST['price'];
			$product->description = $_POST['description'];
			if (isset($_POST['in_stock'])) {
				// Checkbox is checked
				$product->in_stock = "1";
				$product->quantity = $_POST['quantity'];
			} else {
				// Checkbox is not checked
				$product->in_stock = "0";
				$product->quantity = 0;
			}

			//insert it
			$product->insert();
			//------------------------------------------------------------------------------- Image part
			//this is to get the ID for it.
			$product = $product->getProductByAllButId();
			$productID = $product->product_id;
			//inserting product_category
			//Set Product Category
			$product_type = $_POST['category'];
			foreach ($product_type as $index => $category_id) {
				$product_cat = new \app\models\Product_category();
				$product_cat->category_id = $category_id;
				$product_cat->product_id = $productID;
				$product_cat->insert();
			}
			//inserting the image
			if (isset($_FILES['newPicture'])) {
				$pictures = new \app\models\Picture();
				$pictures = $pictures->getAll();
				$duplicateStatus = false;
				//if it detects, it will turn the boolean duplicate status to true
				foreach ($pictures as $pic) {
					if ($pic->filename == $_FILES['newPicture']['name']) {
						$duplicateStatus = true;
						break;
					}
				}
				if ($duplicateStatus == false) {
					$check = getimagesize($_FILES['newPicture']['tmp_name']);
					$mime_type_to_extension = [
						'image/jpeg' => '.jpg',
						'image/gif' => '.gif',
						'image/bmp' => '.bmp',
						'image/png' => '.png'
					];

					if ($check !== false && isset($mime_type_to_extension[$check['mime']])) {
						$extension = $mime_type_to_extension[$check['mime']];
					} else {
						$this->view('Picture/ProductImage', ['error' => "Bad file type", 'pictures' => []]);
						return;
					}

					$filename = uniqid() . $extension;
					$filepath = $this->folder . $filename;

					if ($_FILES['newPicture']['size'] > 4000000) {
						$this->view('Picture/ProductImage', ['error' => "File too large", 'pictures' => []]);
						return;
					}
					//if the file is new, it will create a new entry and carrie its filename
					if (move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)) {
						$picture = new \app\models\Picture();
						$picture->filename = $filename;
						$picture->product_id = $productID;
						$picture->FirstProductinsert();
					} else
						echo "There was an error";
					//if its updating to an existing imported file, it will re-use it
				} else {
					$picture = new \app\models\Picture();
					$picture->filename = $_FILES['newPicture']['name'];
					$picture->product_id = $productID;
					$picture->FirstProductinsert();
				}
				//if its not set the image
			}
			//------------------------------------------------------------------------------- Image part
			//redirect		
			header("location:/Picture/ProductImage?id=$productID");
		} else {
			$category = new \app\models\Category();
			$category = $category->getAll();
			$this->view("Product/create", $category);
		}
	}
	#[\app\filters\isAdmin]
	function productModify()
	{
		$product = new \app\models\Product();
		$product = 	$product->getProductByID($_GET['id']);
		if ($_SERVER['REQUEST_METHOD'] === 'POST') { //data is submitted through method POST

			$product->title = $_POST['title'];
			$product->price = $_POST['price'];
			$product->description = $_POST['description'];
			if (isset($_POST['in_stock'])) {
				// Checkbox is checked
				$product->in_stock = "1";
				$product->quantity = $_POST['quantity'];
			} else {
				// Checkbox is not checked
				$product->in_stock = "0";
				$product->quantity = 0;
			}

			$product_type = $_POST['category'];
			$deleteCat = new \app\models\Product_category();
			// print($_GET['id']);
			$deleteCat->deleteProductId($_GET['id']);
			foreach ($product_type as $index => $category_id) {
				$product_cat = new \app\models\Product_category();
				$product_cat->category_id = $category_id;
				$product_cat->product_id = $product->product_id;
				$product_cat->insert();
			}
			$product->update();
			//redirect
			header('location:/Admin/productManagement');
		} else {
			$this->view("Product/update", $product);
		}
	}
	#[\app\filters\isAdmin]
	function productDelete()
	{
		$product = new \app\models\Product();
		$product = 	$product->getProductByID($_GET['id']);
		$ordDetail = new \app\models\OrderDetail();
		$ordDetail = $ordDetail->getAllByProductrId($product->product_id);

		$ordNotShipped = [];

		foreach($ordDetail as $index => $orderDetail){
			$productOrd = new \app\models\ProductOrder();
			$productOrd = $productOrd->getById($orderDetail->order_id);
			if($productOrd->status == 0){
				$ordNotShipped[] = $productOrd;
			}
		}



		if (sizeof($ordNotShipped) > 0) {
			$message = "<p>Cannot Remove The product. <br> There are orders still haven't been shipped.</p>";
			if ($_SESSION['lang'] == 'fr') {
				$message = "Impossible de supprimer le produit. <br> Certaines commandes n'ont pas encore été expédiées.";
			}
			header('location:/Admin/productManagement?message=' . $message);
		} else {
			$product->delete();
			$message = "<p>Product Deleted Successfully</p>";
			if ($_SESSION['lang'] == 'fr') {
				$message = "<p>Produit supprimé avec succès</p>";
			}
			header('location:/Admin/productManagement?message=' . $message . "&noError=noError" );
		}
	}
	function test()
	{
		$this->view("Product/product");
	}

	function productCategory()
	{
		//to get the category
		$category = new \app\models\Category();
		$category = $category->getByCatId($_GET['id']);
		$categoryName = $category->title;
		//to get the products.
		$products = new \app\models\Product();
		$products = $products->getAllWithCategory1($_GET['id']);



		//----------------------------- SORT
		$sort = isset($_GET['sort']) ? $_GET['sort'] : null;
		switch ($sort) {
			case 'date':
				usort($products, function ($a, $b) {
					return strtotime($a->product_id) - strtotime($b->product_id);
				});
				break;
			case 'price':
				usort($products, function ($a, $b) {
					return $a->price - $b->price;
				});
				break;
			case 'name':
				usort($products, function ($a, $b) {
					return strcmp($a->title, $b->title);
				});
				break;
		}
		//----------------------------- SORT


		if ($category == null || !isset($_GET['index']) || !isset($_GET['sort'])) { //this is to check if it even exists
			header('location:/Home');
		} else {
			//and if it does exist, we want pagination that exists (will check if youre changing the index variable)
			$index = $_GET['index'];

			//This is the products entries per page and pagination (maxAmount is max amnt of product entries in a page)

			$maxAmount = 3; //if youre going to change, also change at productCategory view.
			$maxPages = ceil(count($products) / $maxAmount);


			if ($maxPages == 0) { //if its follows the pagination BUT theres no product, show the product category
				$data = ['maxAmount' => $maxAmount, 'products' => $products, 'categoryName' => $categoryName];
				$this->view("Product/productCategoryNone", $data);
			} else if ($index <= 0 || $index > $maxPages) { //if its less than 0 OR more than the max pagination, go back to home
				header('location:/Home');
			} else {
				$data = ['maxAmount' => $maxAmount, 'products' => $products, 'categoryName' => $categoryName];
				$this->view("Product/productCategory", $data); // and if it follows up and there is produc, show category
			}
		}
	}
	//newver version
	//newver version
	function viewProductAll()
	{
		$products = new \app\models\Product();
		$products = $products->getAll();

		//----------------------------- FILTERS
		if (isset($_GET['id'])) {
			$products = new \app\models\Product();
			$products = $products->getAllWithCategories($_GET['id']);
		}
		//----------------------------- FILTERS

		//----------------------------- SORT
		$sort = isset($_GET['sort']) ? $_GET['sort'] : null;
		switch ($sort) {
			case 'date':
				usort($products, function ($a, $b) {
					return strtotime($a->product_id) - strtotime($b->product_id);
				});
				break;
			case 'price':
				usort($products, function ($a, $b) {
					return $a->price - $b->price;
				});
				break;
			case 'name':
				usort($products, function ($a, $b) {
					return strcmp($a->title, $b->title);
				});
				break;
		}
		//----------------------------- SORT

		if (!isset($_GET['index']) || !isset($_GET['sort'])) {
			header('location:/Home');
		} else {
			$index = $_GET['index'];
			$maxAmount = 3; //if youre going to change the amount
			$maxPages = ceil(count($products) / $maxAmount);
			if (count($products) == 0) {
			}
			if ($maxPages == 0) { //if its follows the pagination BUT theres no product, show the product category
				$this->view("Product/productAllNone");
			} else if ($index <= 0 || $index > $maxPages) { //if its less than 0 OR more than the max pagination, go back to home
				header('location:/Home');
			} else {
				$data = ['maxAmount' => $maxAmount, 'products' => $products];
				$this->view("Product/productAll", $data);
			}
		}
	}
	function testProduct()
	{
		$this->view("Product/product");
	}
	function producttest()
	{
		$this->view("Product/producttest");
	}

	public function testAjax()
	{
		$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';
		$products = new \app\models\Product();
		$products = $products->searchByTitle($searchTerm);
		$lenght = sizeof($products);
		$message = "<p class=\"lead fw-bolder\">$lenght results found for <span class=\"fw-bold\">$searchTerm</span></p>";
		if ($_SESSION['lang'] == 'fr') {
			$message = "<p class=\"lead fw-bolder\">$lenght résultats trouvés pour <span class=\"fw-bold\">$searchTerm</span></p>";
		}

		//echo "<img src='' alt='thumbnail' class='img-thumbnail img-fluid' width='100' height='auto'>";


		foreach ($products as $index => $product) {
			$picture = new \app\models\Picture();
			$picture = $picture->getCountForProduct($product->product_id);
			$message .= "
			
			<div class=\"col-12 col-md-6 col-lg-3 mb-3 mb-lg-0\">
				<div class=\"card position-relative h-100 card-listing hover-trigger\">
					<div class=\"card-header\">
						<picture class=\"position-relative overflow-hidden d-block bg-light\">
							<img class=\"w-100 img-fluid position-relative z-index-10\" title=\"\" src=\"/uploads/{$picture[0]->filename}\" alt=\"Bootstrap 5 Template by Pixel Rocket\">
						</picture>
						<div class=\"card-actions\">
							<span class=\"small text-uppercase tracking-wide fw-bolder text-center d-block\">Item</span>
						</div>
					</div>
					<div class=\"card-body px-0 text-center\">
						<a class=\"mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center\" href=\"/Product/viewProduct?id=$product->product_id\">$product->title</a>
						<p class=\"fw-bolder m-0 mt-2\">$product->price$</p>
					</div>
				</div>
			</div>
		";
		}
		echo $message;
		// $message = "hey maate";
		// return $message;
	}
}
