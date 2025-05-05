<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/users.php';

class UserService extends BaseService {

    public function __construct() {
        $dao = new Users();
        parent::__construct($dao);
    }

    public function createUser($data) {
        if (empty($data['email'])) {
            throw new Exception('Email is required.');
        }
        return $this->create($data);
    }
}

?>
