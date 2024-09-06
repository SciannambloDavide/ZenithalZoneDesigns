<?php
namespace app\models;

use PDO;

class Admin extends \app\core\Model{
	
    public $admin_id;
    public $email;
    public $password_hash;


    //Create Admin Acount
    public function insert(){
        $SQL = 'INSERT INTO admin (email, password_hash) VALUES(:email, :password_hash)';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['email' => $this->email,
                        'password_hash' =>$this->password_hash]);
    }

    //Get Admin account by Email
    public function get($email){
        $SQL = 'SELECT * FROM admin WHERE email = :email';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['email' => $email]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Admin');
        return $STMT->fetch();
    }

    

}