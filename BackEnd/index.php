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

require_once 'services/AuthService.php';
require_once 'routes/AuthRoutes.php';
Flight::register('auth_service', 'AuthService');

require_once 'middleware/AuthMiddleware.php';
Flight::register('auth_middleware', 'AuthMiddleware');


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route('/*', function() {
    if (
        strpos(Flight::request()->url, '/auth/login') === 0 ||
        strpos(Flight::request()->url, '/auth/register') === 0 ||
        strpos(Flight::request()->url, '/docs') === 0
    ) {
        return TRUE;
    } else {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if (!$token) {
                Flight::halt(401, "Missing authentication header");
            }

            $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

            Flight::set('user', $decoded_token->user);
            Flight::set('jwt_token', $token);

            return TRUE;
        } catch (Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    }
});



Flight::route('/', function(){
   echo 'Hello world!';
});

Flight::start();  
?>
