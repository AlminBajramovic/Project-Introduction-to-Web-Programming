<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/order_items.php';

class OrderItemService extends BaseService {

    public function __construct() {
        $dao = new OrderItems();
        parent::__construct($dao);
    }

    public function createOrderItem($data) {
        if ($data['quantity'] <= 0) {
            throw new Exception('Quantity must be a positive value.');
        }
        return $this->create($data);
    }
}

?>
