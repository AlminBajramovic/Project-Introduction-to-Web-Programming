<?php
require 'vendor/autoload.php'; 
require_once 'services/ProductService.php';
require_once 'routes/ProductRoutes.php';
Flight::register('productService', 'ProductService');

require_once 'services/OrderService.php';
require_once 'routes/OrderRoutes.php';
Flight::register('orderService', 'OrderService');

require_once 'services/ReviewService.php';
require_once 'routes/ReviewRoutes.php';
Flight::register('reviewService', 'ReviewService');

require_once 'services/UserService.php';
require_once 'routes/UserRoutes.php';
Flight::register('userService', 'UserService');

require_once 'services/CategoryService.php';
require_once 'routes/CategoryRoutes.php';
Flight::register('categoryService', 'CategoryService');

require_once 'services/OrderItemService.php';
require_once 'routes/OrderItemRoutes.php';
Flight::register('orderItemService', 'OrderItemService');



Flight::route('/', function(){
   echo 'Hello world!';
});

Flight::start();  
?>
