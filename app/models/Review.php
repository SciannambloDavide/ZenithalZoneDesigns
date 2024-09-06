<?php
namespace app\models;

use PDO;

class Review extends \app\core\Model{
	
    public $review_id;
    public $customer_id;
    public $product_id;
    public $title;
    public $description;
    public $date;
    public $status;
    public $rating;


    //Create Admin Acount
    public function insert(){
        $SQL = 'INSERT INTO review (customer_id, product_id, title, description, status,rating) VALUES(:customer_id, :product_id, :title, :description, :status,:rating)';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['customer_id' => $this->customer_id,
                        'product_id' =>$this->product_id,
                        'title' =>$this->title,
                        'description' =>$this->description,
                        'status' =>0,
                        'rating' =>$this->rating,

                    ]);
    }

    public static function getAllForProduct($product_id){
		$SQL = 'SELECT * FROM review WHERE product_id = :product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['product_id' =>$product_id]);
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\review');//set the type of data returned by fetches
		return $STMT->fetchAll();//return all records
	}
    //get the rating in class
    public static function getAllForProductRating($product_id,$rating){
		$SQL = 'SELECT * FROM review WHERE product_id = :product_id AND rating = $rating';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['product_id' =>$product_id,
    'rating' =>$rating]);
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\review');//set the type of data returned by fetches
		return $STMT->fetchAll();//return all records
	}
    //get the rating in number
    public static function getCountForProductRatingCount($product_id, $rating){
        $SQL = 'SELECT COUNT(*) AS count FROM review WHERE product_id = :product_id AND rating = :rating';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['product_id' => $product_id, 'rating' => $rating]);
        return $STMT->fetchColumn();
    }

    //get the rating in number
    public static function getCountForProductRatingCountVerified($product_id, $rating){
        $SQL = 'SELECT COUNT(*) AS count FROM review WHERE product_id = :product_id AND rating = :rating AND status = :status';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['product_id' => $product_id, 'rating' => $rating, 'status'=>1]);
        return $STMT->fetchColumn();
    }

    public static function getAllForProductVerified($product_id){
		$SQL = 'SELECT * FROM review WHERE product_id = :product_id AND status = :status';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['product_id' =>$product_id,
    'status'=>1]);
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\review');//set the type of data returned by fetches
		return $STMT->fetchAll();//return all records
	}

	//this is so that its already sorted for newest. note: this is the same for getAllForProductVerified method.
	public static function getAllForProductVerifiedSortNew($product_id){
		$SQL = 'SELECT * FROM review WHERE product_id = :product_id AND status = :status ORDER BY review_Id DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['product_id' =>$product_id,
    'status'=>1]);
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\review');//set the type of data returned by fetches
		return $STMT->fetchAll();//return all records
	}

    public static function getAllReviews(){
		$SQL = 'SELECT * FROM review' ;
		$STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\review');//set the type of data returned by fetches
		return $STMT->fetchAll();//return all records
	}

    public static function getAllForUser($customer_id){
		$SQL = 'SELECT * FROM review WHERE customer_id = :customer_id' ;
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['customer_id' =>$customer_id]);
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\review');//set the type of data returned by fetches
		return $STMT->fetchAll();//return all records
	}


    public static function getReview($review_id){
		$SQL = 'SELECT * FROM review WHERE review_id = :review_id' ;
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['review_id' => $review_id]);
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\review');//set the type of data returned by fetches
		return $STMT->fetch();//return all records
	}
    public function update(){
		//change anything but the PK
		$SQL = 'UPDATE review SET title = :title, description = :description,rating = :rating WHERE review_id = :review_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['title'=>$this->title,
		'description'=>$this->description,
        'rating'=>$this->rating,
        'review_id'=>$this->review_id,
        

		]);
	}

    public function updateStatus(){
		//change anything but the PK
		$SQL = 'UPDATE review SET status = :status WHERE review_id = :review_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['status'=>$this->status,
        'review_id'=>$this->review_id,
		]);
	}

    public function delete(){
		$SQL = 'DELETE FROM review WHERE review_id = :review_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['review_id'=>$this->review_id]
		);
	}

    public function updateEnable(){
		//change anything but the PK
		$SQL = 'UPDATE review SET status = :status WHERE review_id = :review_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['status'=>1,
		'review_id'=>$this->review_id
		]);
	}
    public function updateDisabled(){
		//change anything but the PK
		$SQL = 'UPDATE review SET status = :status WHERE review_id = :review_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(['status'=>0,
		'review_id'=>$this->review_id
		]);
	}

	//percy's method
	public function searchByTitle($title){
		$SQL = 'SELECT * FROM review WHERE title LIKE :title';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['title'=>'%' . $title . '%']
		);
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Review');
		return $STMT->fetchAll();
	}

	//percy's method
	public function getReviewById($review_id){
		$SQL = 'SELECT * FROM review WHERE review_id LIKE :review_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['review_id'=>$review_id]
		);
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Review');
		return $STMT->fetch();
	}

	//percy's method SORT BY NAME ASC
	public static function sortByNameASC(){
		$SQL = 'SELECT * FROM review ORDER BY title ASC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Review');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME DESC
	public static function sortByNameDESC(){
		$SQL = 'SELECT * FROM review ORDER BY title DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Review');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME ASC
	public static function sortByStatusASC(){
		$SQL = 'SELECT * FROM review ORDER BY status ASC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Review');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME DESC
	public static function sortByStatusDESC(){
		$SQL = 'SELECT * FROM review ORDER BY status DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Review');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME ASC
	public static function sortByDateASC(){
		$SQL = 'SELECT * FROM review ORDER BY date ASC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Review');
		return $STMT->fetchAll();
	}

	//percy's method SORT BY NAME DESC
	public static function sortByDateDESC(){
		$SQL = 'SELECT * FROM review ORDER BY date DESC';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Review');
		return $STMT->fetchAll();
	}

	public function searchByProduct($product_id){
		$SQL = 'SELECT * FROM review WHERE product_id LIKE :product_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['product_id'=>$product_id]
		);
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Review');
		return $STMT->fetchAll();
	}
}