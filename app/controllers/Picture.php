<?php

namespace app\controllers;

#[\app\filters\isAdmin]
class Picture extends \app\core\Controller
{
	private $folder = 'uploads/';


	//implement file uploads
	public function ProductImage()
	{

		//also to see if we hit the max amount of images
		$picturesProducts = new \app\models\Picture();
		$picturesProducts = $picturesProducts->getAllForProduct();

		if (isset($_POST['action']) && count($picturesProducts) < 5) {
			//if there's already 5 pics
			//present the form

			//get the form data and process it
			if (isset($_FILES['newPicture'])) {

				//variables created to see if were re-using an imported image (switched it to pictures2 because it causes errors with the other $pictures when viewing the page)
				$pictures2 = new \app\models\Picture();
				$pictures2 = $pictures2->getAll();
				$duplicateStatus = false;
				//if it detects, it will turn the boolean duplicate status to true
				foreach ($pictures2 as $pic) {
					if ($pic->filename == $_FILES['newPicture']['name']) {
						$duplicateStatus = true;
						break;
					}
				}
				//if theres no duplicates
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
						$picture->insert();
						header('location:/Picture/ProductImage?id=' . $_GET['id']);
					} else
						echo "There was an error";
					//if its updating to an existing imported file, it will re-use it
				} else {
					$picture = new \app\models\Picture();
					$picture->filename = $_FILES['newPicture']['name'];
					$picture->insert();
					header('location:/Picture/ProductImage?id=' . $_GET['id']);
				}
				//if its not set the image
			}
		} else if (isset($_POST['action']) && count($picturesProducts) == 5) {
			//If user already have maximum images
			$picture = new \app\models\Picture();
			$pictures = $picture->getAllForProduct();
			$message = "Please Add a Maximum of 5 Pictures";
			$this->view('Picture/ProductImage', ['error' => null, 'pictures' => $pictures, 'message' => $message]);
			return;
		} else {
			$picture = new \app\models\Picture();
			$pictures = $picture->getAllForProduct();
			$this->view('Picture/ProductImage', ['error' => null, 'pictures' => $pictures]);
		}
	}



	public function deletePhoto()
	{
		$picture = new \app\models\Picture();
		$picture = $picture->get($_GET['id']);
		$productID = $picture->product_id;
		//to make sure that it has at least one photo
		$pictureCount = $picture->getCountForProduct($productID);
		$size = count($pictureCount);
		if ($size > 1) {

			$picture->delete($_GET['id']);
		}
		header('location:/Picture/ProductImage?id=' . $productID);
	}



	public function editImage()
	{
		//implement file uploads

		if (isset($_POST['action'])) {
			//get the form data and process it
			if (isset($_FILES['newPicture'])) {
				//variables created to see if were re-using an imported image
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
					//if the file is new, it will import a new file and update the filename
					if (move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)) {
						$picture = new \app\models\Picture();
						$picture = $picture->get($_GET['id']);
						$picture->filename = $filename;
						$picture->update();
						header('location:/Picture/ProductImage?id=' . $picture->product_id);
					} else
						echo "There was an error";
					//if its updating to an existing imported file, it will re-use it
				} else {
					$picture = new \app\models\Picture();
					$picture = $picture->get($_GET['id']);
					$picture->filename = $_FILES['newPicture']['name'];
					$picture->update();
					header('location:/Picture/ProductImage?id=' . $picture->product_id);
				}
				//if its not set the image
			}
		} else {
			//present the form
			$picture = new \app\models\Picture();
			$picture = $picture->get($_GET['id']);
			$this->view('Picture/editImage', ['error' => null, 'picture' => $picture]);
		}
	}
}
