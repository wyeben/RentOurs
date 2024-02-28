<?php

require_once 'User.php';

class Individual extends User {
    public function __construct($security, $profile) {
        parent::__construct($security, $profile);
    }
    
    public function registerCar() {
        // Implementation
    }
    
    public function uploadCarPictures() {
        // Implementation
    }
}

?>
