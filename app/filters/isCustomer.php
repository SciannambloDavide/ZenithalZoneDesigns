<?php
namespace app\filters;

#[\Attribute]
class isCustomer implements \app\core\AccessFilter {
    
    public function redirected() {
        // Make sure that the user is logged in
        if (!isset($_SESSION['customer_id'])) {
            header('location:/User/login');
            return true;
        }
        
        // Check if $_SESSION['secret'] is set before accessing it
        if (isset($_SESSION['secret']) && $_SESSION['secret'] !== null) {
            header('location:/User/check2fa');
            return true;
        }
        
        return false; // Not denied
    }
}
