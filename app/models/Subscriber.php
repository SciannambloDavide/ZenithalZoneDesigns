<?php
namespace app\models;

use PDO;

class Subscriber extends \app\core\Model{
	
    public $email;
    
    //Add to subscriber Table
    public function insert(){
        $SQL = 'INSERT INTO subscriber (email) VALUES(:email)';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['email' => $this->email]);
    }
    //Delete subscriber record
    public function delete(){
        $SQL = 'DELETE FROM subscriber WHERE email = :email';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['email' => $this->email]);
    }
    // Get all emails from subscriber table
    public static function getAllEmails(){
        $SQL = 'SELECT email FROM subscriber';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        return $STMT->fetchAll(PDO::FETCH_COLUMN);
    }
    //Check if email exists in subscriber table
    public function exists(){
        $SQL = 'SELECT email FROM subscriber WHERE email = :email';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['email' => $this->email]);
        return $STMT->rowCount();
    }

}