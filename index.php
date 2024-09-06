<?php
use app\core\App;
require('app/core/init.php');
if(!isset($_SESSION['lang'])){$_SESSION['lang']= 'en';} 
new App();