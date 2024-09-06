<?php
namespace app\models;

use PDO;

class OrderDetail extends \app\core\Model {

    public $order_detail_id;
    public $order_id;
    public $product_id;
    public $quantity;
    public $price;


    public function insert() 
    {
        $SQL = 'INSERT INTO order_detail (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)';
        //prepare the statement
        $STMT = self::$_conn->prepare($SQL);
        //execute
        $data = [
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price'=> $this->price
        ];
        $STMT->execute($data);
    }

    //get all the order details for a given order
    public function getAllByOrderId($order_id)
    {
        $SQL = 'SELECT * FROM order_detail WHERE order_id = :order_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['order_id' => $order_id]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\OrderDetail');
        return $STMT->fetchAll();
    }

    public function getAllByProductrId($product_id)
    {
        $SQL = 'SELECT * FROM order_detail WHERE product_id = :product_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['product_id' => $product_id]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\OrderDetail');
        return $STMT->fetchAll();
    }

    //get a single order detail by its id
    public function getById($order_detail_id)
    {
        $SQL = 'SELECT * FROM order_detail WHERE order_detail_id = :order_detail_id';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute(['order_detail_id' => $order_detail_id]);//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\OrderDetail');
        return $STMT->fetch();//fetch
    }

    

}

