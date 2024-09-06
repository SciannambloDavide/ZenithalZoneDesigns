<?php

namespace app\controllers;

#[\app\filters\isCustomer]
class Customer extends \app\core\Controller
{

	public function viewProfile()
	{
		$Customer = new \app\models\Customer();
		$Customer = $Customer->getById($_SESSION['customer_id']);
		$email = $Customer->email;
		$subscriber = new \app\models\Subscriber();
		$subscriber->email = $email;
		$isSubscribed = $subscriber->exists();
		$data = [
			'Customer' => $Customer,
			'isSubscribed' => $isSubscribed
		];
		//redirect a user that has no profile to the profile creation URL
		$this->view('Customer/viewProfile', $data);
	}

	public function modify()
	{
		$isSubscribed = false;
		$Customer = new \app\models\Customer();
		$Customer = $Customer->getById($_SESSION['customer_id']);
		if ($_SERVER['REQUEST_METHOD'] === 'POST') { //data is submitted through method POST
			//make a new profile object
			//populate it
			$Customer->name = $_POST['name'];
			$Customer->email = $_POST['email'];
			$Customer->username = $_POST['username'];
			//update it
			$Customer->update();

			//check if the user wants to subscribe to the newsletter
			if (isset($_POST['newsletterCheckbox']) && $_POST['newsletterCheckbox'] == 'on') {
				$isSubscribed = true;
				$email = $Customer->email;
				$subscriber = new \app\models\Subscriber();
				$subscriber->email = $email;
				//check if the user is already subscribed	
				if (!$subscriber->exists()) {
					$subscriber->insert();
					$subject = "Newsletter Subscription";
					$message = "Thank you for subscribing to our newsletter!";
					if ($_SESSION['lang'] == 'fr') {
						$message = "Merci de vous être abonné à notre lettre d'information !";
					}
					\app\models\Mailer::sendEmail($email, $subject, $message);
				}
			} else { //if the user does not want to be subscribed to the newsletter
				$email = $Customer->email;
				$subscriber = new \app\models\Subscriber();
				$subscriber->email = $email;
				//check if the user is already subscribed	
				if ($subscriber->exists()) {
					$subscriber->delete();
					$subject = "Goodbye!";
					$message = "We're sorry to see you go. If you have any feedback or suggestions, please let us know. Thank you for being a part of our Zenithal community!";
					if ($_SESSION['lang'] == 'fr') {
						$message = "Nous sommes désolés de vous voir partir. Si vous avez des commentaires ou des suggestions, n'hésitez pas à nous en faire part. Merci d'avoir fait partie de notre communauté Zenithal !";
					}
					\app\models\Mailer::sendEmail($email, $subject, $message);
				}
			}

			//check if the customer wants to enable 2FA
			if (isset($_POST['twoFactorCheckbox'])) {
				//if the user has already enabled 2FA before
				if ($Customer->secret !== null) {
					header('location:/Customer/viewProfile');
					exit();
				}
				echo 'script>alert("AAAA")</script>';
				// Enable two-factor authentication
				header('location:/User/setup2fa');
			} else {
				// Disable two-factor authentication
				$Customer->secret = null;
				$Customer->update();
				header('location:/Customer/viewProfile');
			}
		} else { //data is not submitted through method POST
			//check if the user is subscribed to the newsletter
			$email = $Customer->email;
			$subscriber = new \app\models\Subscriber();
			$subscriber->email = $email;
			$isSubscribed = $subscriber->exists();
			$data = [
				'isSubscribed' => $isSubscribed,
				'Customer' => $Customer
			];
			//display the form
			$this->view('Customer/modify', $data);
		}
	}



	function orderHistory()
	{
		$order = new \app\models\ProductOrder();
		$order = $order->getAllForCustomer($_SESSION["customer_id"]);
		$this->view("Customer/orderHistory", $order);
	}

	function orderDetail()
	{
		$id = $_GET["order_id"];
		$order = new \app\models\ProductOrder();
		$order = $order->getById($id);
		$this->view("Customer/orderDetail", $order);
	}
	function reviewHistory()
	{
		$reviews = new \app\models\Review();
		$reviews = $reviews->getAllForUser($_SESSION["customer_id"]);
		$this->view("Customer/reviewHistory", $reviews);
	}

	function updatePassword()
	{
		$customer = new \app\models\Customer();
		$customer = $customer->getById($_SESSION["customer_id"]);
		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			$cur_pass = $_POST["password"];
			$new_pass = $_POST["new_password"];
			$confirm_pass = $_POST["confirm_password"];
			//current password matches with og password
			if (password_verify($cur_pass, $customer->password_hash)) {
				//check if new_pass is secured enough, min 8 chars, one cap and one lowercase
				//if confirm pass match with new pass
				if ($new_pass === $cur_pass) {
					echo '<script>alert("New Password Cannot Be The Same as The Old One")</script>';
					$this->view("Customer/updatePassword", $customer);
				}
				else if ($new_pass === $confirm_pass) {
					//Update Passowrd
					$customer->password_hash = password_hash($new_pass, PASSWORD_DEFAULT);
					$customer->update();
					echo '<script>alert("Password Updated")</script>';
					$this->view("Customer/updatePassword", $customer);
				} else {
					//Redirect Back to Update Password Page
					echo '<script>alert("Confirm Password Does Not Match With The New Password")</script>';
					$this->view("Customer/updatePassword", $customer);
				}
			} else {
				echo '<script>alert("Current Password Does Not Match With The Original Password")</script>';
				$this->view("Customer/updatePassword", $customer);
			}
		} else {
			$this->view("Customer/updatePassword", $customer);
		}
	}
}
