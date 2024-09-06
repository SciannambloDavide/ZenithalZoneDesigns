<?php

namespace app\models;

use PDO;

class Product extends \app\core\Model
{
	public $product_id; //PK
	public $price;
	public $title;
	public $description;
	public $in_stock;
	public $quantity;

	public function insert()
	{
		$SQL = 'INSERT INTO product (price, title, description, quantity, in_stock) VALUES (:price, :title, :description, :quantity, :in_stock)';
        //prepare the statement
        $STMT = self::$_conn->prepare($SQL);
        //execute
        $data = [
            'price' => $this->price,
            'title' => $this->title,
            'description' => $this->description,
            'quantity' => $this->quantity,
			'in_stock' => $this->in_stock
        ];
        $STMT->execute($data);
	}

	public function update()
	{
		$SQL = 'UPDATE product SET price=:price,title=:title,description=:description,in_stock=:in_stock,quantity=:quantity WHERE product_id = :product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			[
				'price' => $this->price,
				'title' => $this->title,
				'description' => $this->description,
				'in_stock' => $this->in_stock,
				'product_id' => $this->product_id,
				'quantity' => $this->quantity
			]
		);
	}



	public function getProductByID($product_id)
	{
		$SQL = 'SELECT * FROM product WHERE product_id = :product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['product_id' => $product_id]
		);
		//there is a mistake in the next line
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\product'); //set the type of data returned by fetches
		return $STMT->fetch(); //return (what should be) the only record
	}

	public static function getAll()
	{
		$SQL = 'SELECT * FROM product ORDER BY product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product'); //set the type of data returned by fetches
		return $STMT->fetchAll(); //return all records
	}

	public static function getAllNew()
	{
		$SQL = 'SELECT * FROM product ORDER BY product_id DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product'); //set the type of data returned by fetches
		return $STMT->fetchAll(); //return all records
	}

	public static function getAllRandom()
	{
		$SQL = 'SELECT * FROM product ORDER BY RAND()';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}
	
	public function getAllWithCategory1($category_id) {
		$SQL = 'SELECT p.* 
				FROM product p 
				JOIN product_category pc ON p.product_ID = pc.product_ID 
				WHERE pc.category_ID = :category_id 
				ORDER BY p.product_id ASC';

		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['category_id'=>$category_id]);
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	public function getAllWithCategories($category_ids) {
		// Split the comma-separated string into an array of category IDs
		$category_array = explode(',', $category_ids);

		// Build the named placeholders for category IDs in the SQL query
		$placeholders = implode(',', array_map(function ($index) {
			return ':category_id_' . $index;
		}, array_keys($category_array)));

		// Prepare the SQL query with dynamic named placeholders
		$SQL = "SELECT p.* 
				FROM product p 
				JOIN product_category pc ON p.product_ID = pc.product_ID 
				WHERE pc.category_ID IN ($placeholders) 
				GROUP BY p.product_ID
				HAVING COUNT(DISTINCT pc.category_ID) = :total_categories
				ORDER BY p.product_id ASC";

		// Create an associative array with named placeholders and category IDs
		$params = [];
		foreach ($category_array as $index => $category_id) {
			$params[':category_id_' . $index] = $category_id;
		}
		$params[':total_categories'] = count($category_array);

		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute($params);
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	public function delete()
	{
		$SQL = 'DELETE FROM product WHERE product_id = :product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['product_id' => $this->product_id]
		);
	}

	public function searchByTitle($title)
	{
		$SQL = 'SELECT * FROM product WHERE title LIKE :title';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['title' => '%' . $title . '%']
		);
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	public function searchByDescription($description)
	{
		$SQL = 'SELECT * FROM product WHERE description LIKE :description';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['description' => '%' . $description . '%']
		);
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME ASC
	public static function sortByNameASC()
	{
		$SQL = 'SELECT * FROM product ORDER BY title ASC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME DESC
	public static function sortByNameDESC()
	{
		$SQL = 'SELECT * FROM product ORDER BY title DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME ASC
	public static function sortByPriceASC()
	{
		$SQL = 'SELECT * FROM product ORDER BY price ASC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME DESC
	public static function sortByPriceDESC()
	{
		$SQL = 'SELECT * FROM product ORDER BY price DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME ASC
	public static function sortByTypeASC()
	{
		$SQL = 'SELECT * FROM product ORDER BY product_type ASC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME DESC
	public static function sortByTypeDESC()
	{
		$SQL = 'SELECT * FROM product ORDER BY product_type DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
		//this is created to get the ID after creating a new entry (look at productCreate)
	}

	//percy's method SORT BY NAME ASC
	public static function sortByIdASC()
	{
		$SQL = 'SELECT * FROM product ORDER BY product_id ASC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME DESC
	public static function sortByIdDESC()
	{
		$SQL = 'SELECT * FROM product ORDER BY product_id DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product');
		return $STMT->fetchAll();
	}

	//this is created to get the ID after creating a new entry (look at productCreate)
	public function getProductByAllButId()
	{
		$SQL = 'SELECT * FROM product 
		WHERE price = :price AND title = :title AND description = :description AND in_stock = :in_stock 
		ORDER BY product_id DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['price' => $this->price, 'title' => $this->title, 'description' => $this->description, 'in_stock' => $this->in_stock]
		);
		//there is a mistake in the next line
		$STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\product'); //set the type of data returned by fetches
		return $STMT->fetch(); //return (what should be) the only record
	}

	
}
