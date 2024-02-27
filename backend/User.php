<?php

abstract class User {
    private $security;
    private $profile;
    private $accountType; 
    
    public function __construct($security, $profile, $accountType) {
        $this->security = $security;
        $this->profile = $profile;
        $this->accountType = $accountType;
    }
    
    public static function createAccount($security, $profile, $accountType) {
        return new User($security, $profile, $accountType);
    }
    
    public function getAccountType() {
        return $this->accountType;
    }
    
    public function login($username, $password) {
    }
}

?>