<?php
require_once 'BaseDao.php';

class OrderItems extends BaseDao {
    public function __construct() {
        parent::__construct("order_items");
    }

    public function getByOrderId($order_id) {
        $stmt = $this->connection->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByProductId($product_id) {
        $stmt = $this->connection->prepare("SELECT * FROM order_items WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
