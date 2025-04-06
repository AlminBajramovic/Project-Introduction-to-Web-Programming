<?php
require_once 'users.php';
require_once 'products.php';
require_once 'orders.php';
require_once 'order_items.php';
require_once 'categories.php';
require_once 'reviews.php';

$userDao = new Users();
$productDao = new Products();
$orderDao = new Orders();
$orderItemDao = new OrderItems();
$categoryDao = new Categories();
$reviewDao = new Reviews();

$userDao->insert([
    'name' => 'Almin',
    'surname' => 'Bajramovic',
    'email' => 'almin@bajramovic.com',
    'password' => password_hash('Almin123', PASSWORD_DEFAULT),
    'role' => 'Customer'
]);

$categoryDao->insert([
    'name' => 'Graphics Cards'
]);

$productDao->insert([
    'name' => 'NVIDIA RTX 4080',
    'description' => 'High-end gaming GPU',
    'price' => 1299.99,
    'stock' => '5',
    'category_id' => 1
]);

$orderDao->insert([
    'user_id' => 1,
    'status' => 'Pending',
    'total_price' => 1299.99,
    'order_date' => date('Y-m-d')
]);

$orderItemDao->insert([
    'order_id' => 1,
    'product_id' => 1,
    'quantity' => 1,
    'price' => 1299.99
]);

$reviewDao->insert([
    'user_id' => 1,
    'product_id' => 1,
    'rating' => 5,
    'comment' => 'This GPU is a beast!',
    'review_date' => date('Y-m-d')
]);

echo "<pre>";

echo "Users:\n";
print_r($userDao->getAll());

echo "Categories:\n";
print_r($categoryDao->getAll());

echo "Products:\n";
print_r($productDao->getAll());

echo "Orders:\n";
print_r($orderDao->getAll());

echo "Order Items:\n";
print_r($orderItemDao->getAll());

echo "Reviews:\n";
print_r($reviewDao->getAll());

echo "</pre>";
?>
