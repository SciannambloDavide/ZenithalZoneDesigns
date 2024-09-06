<?php
namespace app\models;

class Picture extends \app\core\Model{
	public $picture_id;
	public $filename;
	public $product_id;

	public function __construct(){
		parent::__construct();
	}

	public function getAll(){
		$SQL = 'SELECT * FROM picture';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute([]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\models\Picture');
		return $STMT->fetchAll();//returns an array of all the records
	}
	//this is used to retrieve all the pictures that exist (array)
	public function getAllForProduct(){
		$SQL = 'SELECT * FROM picture WHERE product_id = :product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['product_id'=>$_GET['id']]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\models\Picture');
		return $STMT->fetchAll();//returns an array of all the records
	}

	public function getAllForProductCartItem($product_id){
		$SQL = 'SELECT * FROM picture WHERE product_id = :product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['product_id'=>$product_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\models\Picture');
		return $STMT->fetchAll();//returns an array of all the records
	}

	//this is used to retrieve all the pictures that exist (array) (used for show more items)
	public function getAllForProductByID($product_id){
		$SQL = 'SELECT * FROM picture WHERE product_id = :product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['product_id'=>$product_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\models\Picture');
		return $STMT->fetchAll();//returns an array of all the records
	}

	//dedicated for deleting an image of a product
	public function getCountForProduct($product_id){
		$SQL = 'SELECT * FROM picture WHERE product_id = :product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['product_id'=>$product_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\models\Picture');
		return $STMT->fetchAll();//returns an array of all the records
	}


	public function get($picture_id){
		$SQL = 'SELECT * FROM picture WHERE picture_id = :picture_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['picture_id'=>$picture_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\models\Picture');
		return $STMT->fetch();//return the record
	}

	public function insert(){
		//here we will have to add `` around field names
		$SQL = 'INSERT INTO picture(filename,product_id) VALUES (:filename,:product_id)';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute([
			'filename'=>$this->filename,
			'product_id'=>$_GET['id']
			
	
	
	]);//associative array with key => value pairs
	}

	//when you first add an image to a new product
	public function FirstProductinsert(){
		//here we will have to add `` around field names
		$SQL = 'INSERT INTO picture(filename,product_id) VALUES (:filename,:product_id)';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute([
			'filename'=>$this->filename,
			'product_id'=>$this->product_id
			
	
	
	]);//associative array with key => value pairs
	}

	public function update(){//update an picture record but don't change the FK value and don't change the picture filename either....
		$SQL = 'UPDATE `picture` SET `filename`=:filename WHERE picture_id = :picture_id';//always use the PK in the where clause
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['filename'=>$this->filename,'picture_id'=>$this->picture_id]);//associative array with key => value pairs
	}

	public function delete($picture_id){//delete a picture record
		$SQL = 'DELETE FROM `picture` WHERE picture_id = :picture_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['picture_id'=>$picture_id]);//associative array with key => value pairs
    //optionally unlink the deleted picture here to delete the file as well
	}

}
