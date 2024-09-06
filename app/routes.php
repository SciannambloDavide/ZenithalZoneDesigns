<?php
//------------------------------------2FA
$this->addRoute('User/setup2fa' , 'User,setup2fa');
$this->addRoute('User/check2fa' , 'User,check2fa');

//------------------------------------ Default Route TEMPLATE.
$this->addRoute('Home','Home,index');
$this->addRoute('home','Home,index');
$this->addRoute('Home/langChecker','Home,langChecker');
$this->addRoute('Product/Category','Product,productCategory');
$this->addRoute('Cart/cart','Cart,cart');
$this->addRoute('Cart/checkout','Cart,checkout');
$this->addRoute('Contact/Contact_us','Contact,contactUs');

//------------------------------------ NavBar Routes.
$this->addRoute('ProfileIcon','User,navClick');
$this->addRoute('Subscribe','Contact,subscribe');

//------------------------------------ User Route.
$this->addRoute('User/adminLogin','User,adminLogin');
$this->addRoute('User/beUser','User,beUser');
$this->addRoute('User/beAdmin','User,beAdmin');

//------------------------------------ Customer Route.
$this->addRoute('Customer/updatePassword','Customer,updatePassword');
$this->addRoute('Customer/orderHistory','Customer,orderHistory');
$this->addRoute('Customer/reviewHistory','Customer,reviewHistory');
$this->addRoute('Customer/orderDetail','Customer,orderDetail');
$this->addRoute('Customer/viewProfile','Customer,viewProfile');
$this->addRoute('Customer/modify','Customer,modify');
//------------------------------------ Review Route.
$this->addRoute('Review/writeReview','Review,writeReview');
$this->addRoute('Review/viewAllForUser','Review,viewAllForUser');
$this->addRoute('Review/viewAllFromProduct','Review,viewAllFromProduct');
$this->addRoute('Review/edit','Review,edit');
$this->addRoute('Review/delete','Review,delete');

//------------------------------------ Product Route.
$this->addRoute('Product/producttest','Product,producttest');
$this->addRoute('Product/create','Product,productCreate');
$this->addRoute('Product/edit','Product,productModify');
$this->addRoute('Product/delete','Product,productDelete');
$this->addRoute('Product/viewProduct','Product,viewProduct'); //New View
$this->addRoute('Product/viewProductAll','Product,viewProductAll'); //new View
$this->addRoute('Product/viewAll','Product,viewAll');
$this->addRoute('Product/productSearch','Product,productSearch');
$this->addRoute('Product/Category','Product,productCategory');
$this->addRoute('Product/testAjax','Product,testAjax');


//------------------------------------ Wish Route.
$this->addRoute('Wish/addToWish','Wish,addToWish');
$this->addRoute('Wish/removeFromWish','Wish,removeFromWish');
$this->addRoute('Wish/viewAllWish','Wish,viewAllWish');
$this->addRoute('Wish/removeAllFromWish','Wish,removeAllFromWish');


//------------------------------------ User Route.
$this->addRoute('User/index' , 'User,index');
$this->addRoute('User/register' , 'User,register');
$this->addRoute('User/login' , 'User,login');
$this->addRoute('User/logout' , 'User,logout');
$this->addRoute('User/update' , 'User,update');
$this->addRoute('User/delete' , 'User,delete');

//------------------------------------ Admin Part.
$this->addRoute('Admin','Admin,dashboard');
$this->addRoute('Admin/dashboard','Admin,dashboard');
$this->addRoute('Admin/create','Admin,create');
$this->addRoute('Admin/productManagement','Admin,productManagement');
$this->addRoute('Admin/reviewManagement','Admin,reviewManagement');
$this->addRoute('Admin/langChecker','Admin,langChecker');

//PERCYS PART
$this->addRoute('Admin/approveReview','Admin,approveReview');
$this->addRoute('Admin/rejectReview','Admin,rejectReview');
$this->addRoute('Admin/viewReview','Admin,viewReview');
$this->addRoute('Admin/categoryManagement','Admin,categoryManagement');
$this->addRoute('Admin/orderManagement','Admin,orderManagement');
//JOSEPH'S PART
$this->addRoute('Admin/producttest','Admin,producttest');
//for review managing
$this->addRoute('Admin/toggleStatus','Admin,toggleStatus');
$this->addRoute('Admin/approveMultipleStatus','Admin,approveMultipleStatus');
$this->addRoute('Admin/denyMultipleStatus','Admin,denyMultipleStatus');
$this->addRoute('Admin/adminEditReview','Admin,adminEditReview');
$this->addRoute('Admin/adminDeleteReview','Admin,adminDeleteReview');
//ZLATIN'S PART
$this->addRoute('Admin/contactUser','Contact,contactUser');
$this->addRoute('Admin/newsletter','Contact,newsletter');
$this->addRoute('Admin/downloadSubscribersList','Contact,downloadSubscribersList');
$this->addRoute('Admin/downloadUserList','Contact,downloadUserList');
$this->addRoute('Admin/updateOrderStatus','Admin,updateOrderStatus');



//------------------------------------ Cart Part
$this->addRoute('Cart/addToCart','Cart,addToCart');
$this->addRoute('Cart/viewAllCart', 'Cart,viewAllCart');
$this->addRoute('Cart/removeFromCart', 'Cart,removeFromCart');
$this->addRoute('Cart/cart', 'Cart,viewAllCart');
$this->addRoute('Cart/updateQuantity', 'Cart,updateQuantity');



//------------------------------------ Image Part
$this->addRoute('Picture/ProductImage', 'Picture,ProductImage');
$this->addRoute('Picture/editImage', 'Picture,editImage');
$this->addRoute('Picture/deletePhoto', 'Picture,deletePhoto');



//------------------------------------ Category Part
$this->addRoute('Category/create','Category,create');
$this->addRoute('Category/edit','Category,update');
$this->addRoute('Category/delete','Category,delete');
$this->addRoute('Category/deleteMultiple','Category,deleteMultiple');
$this->addRoute('Category/addMultiple','Category,addMultiple');

