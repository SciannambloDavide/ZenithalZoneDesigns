<?php

namespace app\models;

use PDO;

class Product_category extends \app\core\Model
{

    public $category_id;
    public $product_id;

    //Create Admin Acount
    public function insert()
    {
        $SQL = 'INSERT INTO product_category (category_id, product_id) VALUES(:category_id, :product_id)';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute([
            'category_id' => $this->category_id,
            'product_id' => $this->product_id
        ]);
    }

    //Get All values with certain category id
    public function getAllByCatId($category_id)
    {
        $SQL = 'SELECT * FROM product_category WHERE category_id = :category_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['category_id' => $category_id]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product_category');
        return $STMT->fetchAll();
    }

    //Return values with the inputted product_id
    public function getAllByProductId($product_id)
    {
        $SQL = 'SELECT * FROM product_category WHERE product_id = :product_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['product_id' => $product_id]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Product_Category');
        return $STMT->fetchAll();
    }

    //Return count of records with the inputted product_id and category_id
    public function getCountByProIdCatId()
    {
        $SQL = 'SELECT COUNT(1) AS count FROM product_category WHERE product_id = :product_id AND category_id = :category_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['product_id' => $this->product_id, 'category_id' => $this->category_id]);
        $result = $STMT->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }


    public function deleteProductId($product_id)
    {
        $SQL = 'DELETE FROM product_category WHERE product_id = :product_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(
            ['product_id' => $product_id]
        );
    }

    public function deleteProductAndCategory($product_id, $category_id)
    {
        $SQL = 'DELETE FROM product_category WHERE product_id = :product_id AND category_id = :category_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(
            [
                'product_id' => $product_id,
                'category_id' => $category_id
            ]
        );
    }

    public function getCountForCategory($category_id)
    {
        $SQL = 'SELECT count(*) as total from product_category WHERE category_id = :category_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['category_id' => $category_id]);
        $result = $STMT->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public static function getCountIsOne()
    {
        $SQL = "SELECT *
        FROM product_category
        GROUP BY product_id
        HAVING COUNT(category_id) = 1";
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\product_category');
        return $STMT->fetchAll();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\product_category');
        return $STMT->fetchAll();
    }

    public static function getAllButCatId($category_id)
    {
        $SQL = 'SELECT * FROM product_category WHERE category_id != :category_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(
            ['category_id' => $category_id]
        );
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\product_category');
        return $STMT->fetchAll();
    }
}
