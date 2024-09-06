<?php
namespace app\controllers;
//only added this because in the end, it is supposed to have a profile, and if it doesnt, profile controller got a filter for login :D
#[\app\filters\isCustomer]
class Review extends \app\core\Controller{

	public function writeReview(){
		$product = new \app\models\Product();
        //specify the product
		$product = $product->getProductByID($_GET['id']);

		$review = new \app\models\Review();
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){//data is submitted through method POST
			//make a new profile object
			//populate it
			$review->customer_id = $_SESSION['customer_id'];
			$review->product_id = $_GET['id'];
			$review->title = $_POST['title'];
			$review->description = $_POST['description'];
            $review->rating = $_POST['rating'];


			//update it
			$review->insert();
			//redirect
			//the notification is in the product view (check the form JS)
			header('location:/Product/viewProduct?id=' . $_GET["id"]);

            
		}else{
		//if its not a post, then it will just redirect (It will never do this )
		$this->view("Product/product",$product);

	}
	}
  
    function viewAllForUser(){
        //this is to ONLY view the users publications
     //  $profile_id = $_GET["id"];
     $reviews = new \app\models\review();

        $reviews = \app\models\review::getAllForUser($_SESSION['profile_id']);

        $this->view("Customer/reviewHistory",$reviews);
    }

 
    function edit(){  
        $review = new \app\models\review();
        //specify the publication
		$review = $review->getReview($_GET["id"]);
        //this is to gatekeep the guest (Security gatekeeping)
        if($review->customer_id == $_SESSION["customer_id"]){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			//process the update
			$review->description = $_POST['description'];
			$review->title = $_POST['title'];
            $review->rating = $_POST['rating'];

			$review->update();
            //Shouldve used publication_comments's field But I guess this can serve as two ways to do it (from view/footer)
			header('location:/Product/viewProduct?id=' . $review->product_id);
            
		}else{
			$this->view('Customer/editReview', $review);
            }
		}
        else{
        header('location:/User/index');
        }

    }


    public function delete(){
        $review = new \app\models\review();
        //specify the publication
		$review = $review->getReview($_GET["id"]);
        //this is to gatekeep the guest (Security gatekeeping)
        //the other delete uses a form ( dont know but this is more quick but somewhat risky -> no warnings.)
        if($review->profile_id == $_SESSION["profile_id"]){
			$review->delete();
			header('location:/Product/viewProduct?id=' . $review->product_id);
		}else{
            header('location:/User/index');
		}
	}

	public function viewAllFromProduct(){
		$product = new \app\models\Product();
		$product = $product->getProductByID($_GET['id']);
		$this->view("Product/productAllReviews", $product);

	}
	
	}

    