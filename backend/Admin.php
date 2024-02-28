<?php

require_once 'User.php';

class Admin extends User {
    public function __construct($security, $profile) {
        parent::__construct($security, $profile);
    }
    
    public function moderateReviews() {
    }
    
    public function moderateAdvertisement() {
    }
}

?>
