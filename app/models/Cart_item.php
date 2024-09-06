<?php
namespace app\models;

use PDO;

class Cart_item extends \app\core\Model
{
    public $customer_id;
    public $product_id;
    public $quantity;
    public function __construct()
    {
        parent::__construct(); // Call parent constructor
    }


    public function insert()
    {
        $SQL = 'INSERT INTO cart_item (customer_id, product_id, quantity) VALUES (:customer_id, :product_id, :quantity)';
        $STMT = self::$_conn->prepare($SQL);

        $data = [
            'customer_id' => $this->customer_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity
        ];
        $STMT->execute($data);
    }

    //customer methods, to be updated
    public function getById($customer_id)
    {
        $SQL = 'SELECT * FROM cart_item WHERE customer_id = :customer_id';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute(['customer_id' => $customer_id]);//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Cart');//choose the type of return from fetch
        return $STMT->fetch();//fetch
    }

    //  public function getById($customer_id)
    //  {
    //      $SQL = 'SELECT * FROM customer WHERE customer_id = :customer_id';//define the SQL
    //      $STMT = self::$_conn->prepare($SQL);//prepare
    //      $STMT->execute(['customer_id' => $customer_id]);//run
    //      $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Customer');//choose the type of return from fetch
    //      return $STMT->fetch();//fetch
    //  }

    //update
    public function update()
    {
        // Update the quantity for the specific product in the cart
        $SQL = 'UPDATE cart_item SET quantity=:quantity WHERE customer_id=:customer_id AND product_id=:product_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute([
            'quantity' => $this->quantity,
            'customer_id' => $this->customer_id,
            'product_id' => $this->product_id
        ]);
    }

    public function get()
    {
        $SQL = 'SELECT * FROM cart_item WHERE customer_id = :customer_id AND product_id = :product_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute([
            'customer_id' => $this->customer_id,
            'product_id' => $this->product_id
        ]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Cart_item');
        return $STMT->fetch();
    }

    public function getAll($customer_id)
    {
        $SQL = 'SELECT * FROM cart_item WHERE customer_id = :customer_id';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute(['customer_id' => $customer_id]);//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Cart_item');//choose the type of return from fetch
        return $STMT->fetchAll();//fetch
    }

    //number of items in the customer's cart
    public static function cartSummary($customer_id)
    {
        // Create an array to store results
        $results = [
            'count' => 0,
            'total_quantity' => 0
        ];

        // Count the number of different products in the cart
        $SQL = 'SELECT COUNT(*) FROM cart_item WHERE customer_id = :customer_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['customer_id' => $customer_id]);
        $results['count'] = $STMT->fetchColumn();

        // Sum the total quantity of products in the cart
        $SQL = 'SELECT SUM(quantity) AS total_quantity FROM cart_item WHERE customer_id = :customer_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['customer_id' => $customer_id]);
        $results['total_quantity'] = $STMT->fetchColumn();
        // Return both count and total quantity
        return $results;
    }


    public function delete()
    {
        $SQL = 'DELETE FROM cart_item WHERE customer_id = :customer_id AND product_id = :product_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(
            [
                'customer_id' => $this->customer_id,
                'product_id' => $this->product_id
            ]
        );
    }

    public function getCartDetails($customer_id)
    {
        $SQL = "SELECT ci.quantity, p.title, p.description, p.price, p.product_id
                FROM cart_item ci
                JOIN product p ON ci.product_id = p.product_id
                WHERE ci.customer_id = :customer_id";
        $STMT = self::$_conn->prepare($SQL);
        $STMT->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $STMT->execute();
        return $STMT->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCartItemByID($product_id)
    {
        $SQL = 'SELECT * FROM cart_item WHERE product_id = :product_id AND customer_id = :customer_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(
            [
                'product_id' => $product_id,
                'customer_id' => $this->customer_id
            ]
        );
        //there is a mistake in the next line
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Cart_item'); //set the type of data returned by fetches
        return $STMT->fetch(); //return (what should be) the only record
    }

}