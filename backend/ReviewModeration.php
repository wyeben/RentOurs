<?php

class ReviewModeration {
    private $review;
    private $status;

    public function __construct($review, $status) {
        $this->review = $review;
        $this->status = $status;
    }

    public function getReview() {
        return $this->review;
    }

    public function setReview($review) {
        $this->review = $review;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}

?>