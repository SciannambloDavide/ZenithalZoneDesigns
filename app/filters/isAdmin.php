<?php
namespace app\filters;

#[\Attribute]
class isAdmin implements \app\core\AccessFilter{
	//This is a verifier (Think of it as __verify, this will call method getForUser(userID) to see if the profile exist!)
	
		public function redirected(){
			//make sure that the user is logged in
			if(!isset($_SESSION['admin_id'])){			
				header('location:/User/login');
				return true;
			}
			return false;//not denied
		}
	
	}