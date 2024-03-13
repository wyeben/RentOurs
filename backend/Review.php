<?php

class Review {
    private $author;
    private $car;
    private $rating;
    private $comment;
    
    public function __construct($author, $car, $rating, $comment) {
        $this->author = $author;
        $this->car = $car;
        $this->rating = $rating;
        $this->comment = $comment;
    }
    
    public function editReview() {
        
    }
    
    public function deleteReview() {
    }
    
    public function getAuthor() {
        return $this->author;
    }
    
    public function getCar() {
        return $this->car;
    }
    
    public function getRating() {
        return $this->rating;
    }
    
    public function getComment() {
        return $this->comment;
    }
    
    public function setAuthor($author) {
        $this->author = $author;
    }
    
    public function setCar($car) {
        $this->car = $car;
    }
    
    public function setRating($rating) {
        $this->rating = $rating;
    }
    
    public function setComment($comment) {
        $this->comment = $comment;
    }
}

?>
