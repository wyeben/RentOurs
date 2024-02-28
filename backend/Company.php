<?php

require_once 'User.php';

class Company extends User {
    private $rental = [];
    
    public function __construct($security, $profile) {
        parent::__construct($security, $profile);
    }
    
    public function manageRental() {
    }
    
    public function postCar() {
    }
    
    public function respondToReview() {
    }
    
    public function getRental() {
        return $this->rental;
    }
    
    public function setRental($rental) {
        $this->rental = $rental;
    }
}

?>
