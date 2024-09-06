<?php
namespace app\models;

use PDO;

class Customer extends \app\core\Model{
	public $customer_id;
    public $name;
    public $email;
    public $password_hash;
    public $username;
    public $secret;

    public function add2FA(){
		//change anything but the PK
		$SQL = 'UPDATE customer SET secret = :secret WHERE customer_id = :customer_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['customer_id'=>$this->customer_id,
						'secret'=>$this->secret]);
	}

    public function insert() 
    {
        $SQL = 'INSERT INTO customer (username, password_hash, email, name) VALUES (:username, :password_hash, :email, :name)';
        //prepare the statement
        $STMT = self::$_conn->prepare($SQL);
        //execute
        $data = [
            'username' => $this->username,
            'password_hash' => $this->password_hash,
            'email' => $this->email,
            'name' => $this->name
        ];
        $STMT->execute($data);
    }

    //get
    public function get($username)
    {
        $SQL = 'SELECT * FROM customer WHERE username = :username';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute(['username' => $username]);//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Customer');//choose the type of return from fetch
        return $STMT->fetch();//fetch
    }

    public function getById($customer_id)
    {
        $SQL = 'SELECT * FROM customer WHERE customer_id = :customer_id';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute(['customer_id' => $customer_id]);//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Customer');//choose the type of return from fetch
        return $STMT->fetch();//fetch
    }

    //get all
    public function getAll()
    {
        $SQL = 'SELECT * FROM customer';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute();//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Customer');//choose the type of return from fetch
        return $STMT->fetchAll();//fetch
    }
    //get emails of all customers
    public static function getAllEmails()
    {
        $SQL = 'SELECT email FROM customer';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute();//run
        return $STMT->fetchAll(PDO::FETCH_COLUMN);//fetch emails as an array
    }

    //update
	public function update(){
		$SQL = 'UPDATE customer SET username=:username, email=:email, password_hash=:password_hash, name = :name, secret=:secret WHERE customer_id = :customer_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['username'=>$this->username,
			'email'=>$this->email,
            'password_hash'=>$this->password_hash,
			'name'=>$this->name,
			"customer_id" => $this->customer_id,
            "secret"=> $this->secret]
		);
	}

    public function existsUsername($username) {
        $SQL = 'SELECT COUNT(*) FROM customer WHERE username = :username';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['username' => $username]);
        return $STMT->fetchColumn() > 0;
    }

    public function existsEmail($email) {
        $SQL = 'SELECT COUNT(*) FROM customer WHERE email = :email';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['email' => $email]);
        return $STMT->fetchColumn() > 0;
    }

    public function getByName($name)
    {
        $SQL = 'SELECT * FROM customer WHERE LOWER(name) LIKE LOWER(:name)';//define the SQL
        $STMT = self::$_conn->prepare($SQL);//prepare
        $STMT->execute(['name' => '%' . $name . '%']);//run
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Customer');//choose the type of return from fetch
        return $STMT->fetchAll();//fetch
    }

}