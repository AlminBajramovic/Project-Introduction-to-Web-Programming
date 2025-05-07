<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/categories.php';

class CategoryService extends BaseService {

    public function __construct() {
        $dao = new Categories();
        parent::__construct($dao);
    }

    public function createCategory($data) {
        if (empty($data['name'])) {
            throw new Exception('Category name is required.');
        }
        return $this->create($data);
    }
}

?>
