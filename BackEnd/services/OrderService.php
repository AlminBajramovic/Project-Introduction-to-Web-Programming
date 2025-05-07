<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/orders.php';

class OrderService extends BaseService {

    public function __construct() {
        $dao = new Orders();
        parent::__construct($dao);
    }

    public function createOrder($data) {
        if (empty($data['user_id'])) {
            throw new Exception('User ID is required.');
        }
        return $this->create($data);
    }
}

?>
