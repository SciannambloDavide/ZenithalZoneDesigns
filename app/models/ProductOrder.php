<?php
namespace app\models;

use PDO;

class ProductOrder extends \app\core\Model{
    public $order_id;
    public $customer_id;
	public $status;
    public $time;
    public $total_price;
    public $email;
    public $firstname; 
    public $lastname;
    public $address;
    public $country;
    public $province;
    public $zip;

    public function insert() 
    {
        $SQL = 'INSERT INTO product_order (customer_id, total_price,time, email, first_name, last_name, address, country, province, zip)
         VALUES (:customer_id, :total_price,:time, :email, :firstname, :lastname, :address, :country, :province, :zip)';
        //prepare the statement
        $STMT = self::$_conn->prepare($SQL);
        //execute
        foreach($this as $key => $value){
            $STMT->bindValue(":$key", $value);
        }
        $data = [
            'customer_id' => $this->customer_id,
            'total_price'=> $this->total_price,
            'time' => $this->time,
            'email' => $this->email,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'address' => $this->address,
            'country' => $this->country,
            'province' => $this->province,
            'zip' => $this->zip
        ];
        $STMT->execute($data);

    }
    public function getById($order_id)
    {
        $SQL = 'SELECT * FROM product_order WHERE order_id = :order_id';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute(['order_id' => $order_id]);//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\ProductOrder');
        return $STMT->fetch();//fetch
    }

    public function getByIdNotShipped($product_id)
    {
        $SQL = 'SELECT * FROM product_order WHERE product_id = :product_id AND status = 0';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute(['order_id' => $product_id]);//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\ProductOrder');
        return $STMT->fetch();//fetch
    }

    public function getAllForCustomer($customer_id)
    {
        $SQL = 'SELECT * FROM product_order WHERE customer_id = :customer_id';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute(['customer_id' => $customer_id]);//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\ProductOrder');
        return $STMT->fetchAll();//fetch
    }
    

    public function getOrderIdByAllButId(){
		$SQL = 'SELECT * FROM product_order 
		WHERE customer_id = :customer_id AND time = :time AND total_price = :total_price
		ORDER BY order_id DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['customer_id'=>$this->customer_id, 'time'=>$this->time, 'total_price'=>$this->total_price]);
		//there is a mistake in the next line
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\ProductOrder');//set the type of data returned by fetches
		return $STMT->fetch();//return (what should be) the only record
	}
    public function getAll()
    {
        $SQL = 'SELECT * FROM product_order ORDER BY order_id DESC';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\ProductOrder');
        return $STMT->fetchAll();
    }
    public function updateStatus($order_id, $status)
    {
        $SQL = 'UPDATE product_order SET status = :status WHERE order_id = :order_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['status' => $status, 'order_id' => $order_id]);
    }
    public function searchByOrderIdOrCustomerName($searchTerm) {
        $SQL = "SELECT po.* FROM product_order po
                JOIN customer c ON po.customer_id = c.customer_id
                WHERE po.order_id = :searchTerm OR LOWER(c.name) LIKE LOWER(:searchName)";
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute([
            'searchTerm' => $searchTerm,
            'searchName' => "%" . $searchTerm . "%"
        ]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\ProductOrder');
        return $STMT->fetchAll();
    }
    public function sortByTimeASC() {
        $SQL = 'SELECT * FROM product_order ORDER BY time ASC';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\ProductOrder');
        return $STMT->fetchAll();
    }

    public function sortByTimeDESC() {
        $SQL = 'SELECT * FROM product_order ORDER BY time DESC';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\ProductOrder');
        return $STMT->fetchAll();
    }

    public function sortByPriceASC() {
        $SQL = 'SELECT * FROM product_order ORDER BY total_price ASC';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\ProductOrder');
        return $STMT->fetchAll();
    }

    public function sortByPriceDESC() {
        $SQL = 'SELECT * FROM product_order ORDER BY total_price DESC';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\ProductOrder');
        return $STMT->fetchAll();
    }


}