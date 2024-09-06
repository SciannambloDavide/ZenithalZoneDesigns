<?php

namespace app\controllers;

use chillerlan\Authenticator\{Authenticator, AuthenticatorOptions};
use chillerlan\QRCode\QRCode;

class User extends \app\core\Controller
{

	//#[\app\filters\isCustomer]
	function check2fa()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$options = new AuthenticatorOptions();
			$authenticator = new Authenticator($options);
			$authenticator->setSecret($_SESSION['secret']);
			if ($authenticator->verify($_POST['totp'])) {
				unset($_SESSION['secret']);
				header('location:/Customer/viewProfile'); //the good place
			} else {
				session_destroy();
				header('location:/User/login');
			}
		} else {
			$this->view('Customer/check2fa');
		}
	}
	//#[\app\filters\isCustomer]
	function setup2fa()
	{
		$options = new AuthenticatorOptions();
		$authenticator = new Authenticator($options);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_SESSION['secret_setup'])) {
				$authenticator->setSecret($_SESSION['secret_setup']);
			} else {
				header('location:/User/setup2fa');
			}
			//was submitted, check the TOTP
			$totp = $_POST['totp'];
			if ($authenticator->verify($totp)) {
				//record to the user record
				$customer = new \app\models\customer();
				$customer = $customer->getById($_SESSION['customer_id']); //or $user->user_id = $_SESSION['user_id']; if the record will not be used further
				$customer->secret = $_SESSION['secret_setup'];
				$customer->add2FA();
				
				if ($_SESSION['lang'] == 'fr') {
					echo '<script>alert("Ajouté avec succès Two FA")</script>';
				}else{
					echo '<script>alert("Successfully added Two FA")</script>';
				}
				header('location:/Customer/viewProfile');
			} else {

			
				if ($_SESSION['lang'] == 'fr') {
					echo "<script>alert(\"Échec de l'ajout de deux FA\")</script>";
				}else{
					echo '<script>alert("Failed to add Two FA")</script>';
				}
				header('location:/Customer/viewProfile');
			}
		} else {
			$_SESSION['secret_setup'] = $authenticator->createSecret();
			//generate the URI with the secret for the user
			$uri = $authenticator->getUri('Superb application', 'localhost');
			$QRCode = (new QRCode)->render($uri);
			$this->view('Customer/setup2fa', ['QRCode' => $QRCode]);
		}
	}

	function index()
	{
		header("location:/Home");
	}

	//If the user clicked profile icon from the navigation bar
	function navClick()
	{
		if (isset($_SESSION['customer_id'])) {
			header('location:/Customer/viewProfile');
		} else {
			header('location:/User/login');
		}
	}

	function logout()
	{
		//$_SESSION['user_id'] = null;

		session_destroy();

		header('location:/Home?lang=en');
	}
	function beUser()
	{
		//session_destroy();
		//$_SESSION['user_id'] = null;

		$_SESSION['customer_id'] = 1;
		header('location:/User/index');
	}
	function beAdmin()
	{
		//session_destroy();
		//$_SESSION['user_id'] = null;

		$_SESSION['admin_id'] = 1;
		header('location:/User/index');
	}
	function test()
	{
		$_SESSION["id"] = 1;
		echo "hey I set session id for testing";
	}

	function login()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username = $_POST['username'];
			$customer = new \app\models\Customer();
			$customer = $customer->get($username);
			$password = $_POST['password'];
			if ($customer && password_verify($password, $customer->password_hash)) {
				$_SESSION['customer_id'] = $customer->customer_id;

				// Retrieve the TOTP secret from the user's record
				$_SESSION['secret'] = $customer->secret;

				// Redirect to the 2FA check page if 2FA is enabled
				if ($_SESSION['secret'] != null) {
					header('location:/User/check2fa');
					exit();
				} else {
					// Proceed to the profile page if 2FA is not enabled
					header('location:/Customer/viewProfile');
					exit();
				}
			} else {
				header('location:/User/login');
				exit();
			}
		} else if (isset($_SESSION['customer_id'])) {
			header('location:/Customer/viewProfile');
			exit();
		} else if (isset($_SESSION['admin_id'])) {
			header('location:/Admin/dashboard');
			exit();
		}
		$this->view("User/login");
	}


	function register()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$customer = new \app\models\Customer();

			// Check if the username or email already exists
			if ($customer->existsUsername($_POST['username'])) {
				// Handle the error, perhaps set a session flash message
				$_SESSION['error'] = 'Username already exists.';
				header('location:/User/register');
				exit();
			}

			if ($customer->existsEmail($_POST['email'])) {
				// Handle the error, perhaps set a session flash message
				$_SESSION['error'] = 'Email already exists.';
				header('location:/User/register');
				exit();
			}

			// If no conflicts, proceed to populate and save the new user
			$customer->email = $_POST['email'];
			$customer->username = $_POST['username'];
			$customer->name = $_POST['name'];
			$customer->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

			// Insert the new user
			$customer->insert();

			// Redirect to the login page
			header('location:/User/login');
			exit();
		} else if (isset($_SESSION['customer_id'])) {
			header('location:/Customer/viewProfile');
			exit();
		} else if (isset($_SESSION['admin_id'])) {
			header('location:/Admin/dashboard');
			exit();
		} else {
			// Show the registration form
			$this->view('User/register');
		}
	}


	function adminLogin()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username = $_POST['username'];
			$user = new \app\models\Admin();
			$user = $user->get($username);
			$pass = $_POST["password"];
			if ($user && password_verify($pass, $user->password_hash)) {
				$_SESSION['admin_id'] = $user->admin_id;
				header('location:/Admin/dashboard');
			} else if ($username == "" || $pass == "") {
				header("location:/User/login");
			} else {
				header("location:/User/login");
			}
		} else if (isset($_SESSION['customer_id'])) {
			header('location:/Customer/viewProfile');
			exit();
		} else if (isset($_SESSION['admin_id'])) {
			header('location:/Admin/dashboard');
			exit();
		} else {
			header("location:/User/login");
		}
	}
}
