<?php
namespace app\controllers;

class Home extends \app\core\Controller{
	
	function index(){
		$hospotProduct = new \app\models\Product();
        $hospotProduct = $hospotProduct->getProductByID(18);
		$image = new \app\models\Picture();
		$image = $image->getAllForProductByID(18);
		$image = $image[0]->filename;
		$data = ['hospotProduct' => $hospotProduct, 'image' => $image];
		$this->view("Home/index", $data);
	}

	function langChecker(){
		if($_SESSION['lang'] == 'en'){
			$_SESSION['lang'] = 'fr';
		}else{
			$_SESSION['lang'] = 'en';
		}
		header("location:/Home?lang=" . $_SESSION['lang']);
	}
}