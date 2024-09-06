<?php
namespace app\models;

use PDO;

class Wish extends \app\core\Model{
	public $customer_id;
    public $product_id;

    //Insert the wish in to database
    public function insert() 
    {
        $SQL = 'INSERT INTO wish (customer_id, product_id) VALUES (:customer_id, :product_id)';
        //prepare the statement
        $STMT = self::$_conn->prepare($SQL);
        //execute
        $data = [
            'customer_id' => $this->customer_id,
            'product_id' => $this->product_id
        ];
        $STMT->execute($data);
    }

    //return all wish list items that belong to specified customer
    public function getALL($customer_id)
    {
        $SQL = 'SELECT * FROM wish WHERE customer_id = :customer_id';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute(['customer_id' => $customer_id]);//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Wish');//choose the type of return from fetch
        return $STMT->fetchAll();//fetch
    }

    //delete from wish list
	public function delete(){
		$SQL = 'DELETE FROM wish WHERE customer_id = :customer_id AND product_id = :product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['customer_id'=>$this->customer_id,
            'product_id'=>$this->product_id]
		);
	}

    public function deleteAll(){
		$SQL = 'DELETE FROM wish WHERE customer_id = :customer_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['customer_id'=>$this->customer_id]
		);
	}

    //Return if exist
    public function get(){
        $SQL = 'SELECT * FROM wish WHERE customer_id = :customer_id AND product_id = :product_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['customer_id'=> $this->customer_id,
                        'product_id'=> $this->product_id]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Wish');
        return $STMT->fetch();
    }
}