<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/products.php';


class ProductService extends BaseService {

    public function __construct() {
        $dao = new Products();
        parent::__construct($dao);
    }

    public function createProduct($data) {
        if ($data['price'] <= 0) {
            throw new Exception('Price must be a positive value.');
        }
        return $this->create($data);
    }
}

?>
