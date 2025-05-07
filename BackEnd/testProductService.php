<?php

require_once 'services/ProductService.php';

$product_service = new ProductService();

echo "<pre>";

echo "TEST 1: GET ALL PRODUCTS\n";
print_r($product_service->getAll());

echo "\nTEST 2: CREATE NEW PRODUCT\n";
$new_product = [
    "name" => "Test Laptop",
    "price" => 899.99,
    "description" => "Test product created from testProductService.php",
    "stock" => 10,
    "category_id" => 1
];

$created = $product_service->createProduct($new_product);
print_r($created);

echo "\nTEST 3: GET PRODUCT BY ID\n";
$product_id = $created ?? null;
if ($product_id) {
    print_r($product_service->getById($product_id));
} else {
    echo "Error: Product ID not found.\n";
}

echo "\nTEST 4: UPDATE PRODUCT\n";
$update_data = [
    "name" => "Updated Test Laptop",
    "price" => 999.99,
    "description" => "Updated from test file."
];
if ($product_id) {
    print_r($product_service->update($product_id, $update_data));
} else {
    echo "Error: No product ID to update.\n";
}

echo "\nTEST 5: DELETE PRODUCT\n";
if ($product_id) {
    print_r($product_service->delete($product_id));
} else {
    echo "Error: No product ID to delete.\n";
}

echo "</pre>";
