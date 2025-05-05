<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/reviews.php';

class ReviewService extends BaseService {

    public function __construct() {
        $dao = new Reviews();
        parent::__construct($dao);
    }

    public function createReview($data) {
        if ($data['rating'] < 1 || $data['rating'] > 5) {
            throw new Exception('Rating must be between 1 and 5.');
        }
        return $this->create($data);
    }
}

?>
