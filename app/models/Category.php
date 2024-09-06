<?php

namespace app\models;

use PDO;

class Category extends \app\core\Model
{

    public $category_id;
    public $title;

    //Create Admin Acount
    public function insert()
    {
        $SQL = 'INSERT INTO category (title) VALUES(:title)';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['title' => $this->title]);
    }

    //Return category with the inputted cat_id
    public function getByCatId($category_id)
    {
        $SQL = 'SELECT * FROM category WHERE category_id = :category_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['category_id' => $category_id]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Category');
        return $STMT->fetch();
    }


    public function getCategoryByTitle($title)
    {
        $SQL = 'SELECT * FROM category WHERE title = :title';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['title' => $title]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Category');
        return $STMT->fetch();
    }

    public function getAll()
    {
        $SQL = 'SELECT * FROM category';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Category');
        return $STMT->fetchAll();
    }

    //percy's method
    public function searchByTitle($title)
    {
        $SQL = 'SELECT * FROM category WHERE title LIKE :title';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(
            ['title' => '%' . $title . '%']
        );
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Category');
        return $STMT->fetchAll();
    }

    //percy's method SORT BY NAME ASC
    public static function sortByNameASC()
    {
        $SQL = 'SELECT * FROM category ORDER BY title ASC';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\category');
        return $STMT->fetchAll();
    }

    //percy's method SORT BY NAME DESC
    public static function sortByNameDESC()
    {
        $SQL = 'SELECT * FROM category ORDER BY title DESC';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\category');
        return $STMT->fetchAll();
    }

    //percy's method SORT BY NAME ASC
    public static function sortByCountASC()
    {
        $SQL = "SELECT * FROM product_category
        GROUP BY category_id
        ORDER BY COUNT(product_id) ASC";
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\product_category');
        return $STMT->fetchAll();
    }

    //percy's method SORT BY NAME DESC
    public static function sortByCountDESC()
    {
        $SQL = "SELECT * FROM product_category
        GROUP BY category_id
        ORDER BY COUNT(product_id) DESC";
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\product_category');
        return $STMT->fetchAll();
    }

    public function update(){
        $SQL = 'UPDATE category SET title=:title WHERE category_id = :category_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['title'=>$this->title,
            'category_id'=>$this->category_id]
		);
    }

    public function delete(){
        $SQL = 'DELETE FROM category WHERE category_id = :category_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['category_id'=>$this->category_id]
		);
    }
}
