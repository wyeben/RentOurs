<?php

abstract class User {
    private $security;
    private $profile;
    
    public function __construct($security, $profile) {
        $this->security = $security;
        $this->profile = $profile;
    }
    
    public function login($username, $password) {
    }
    
    public function logout() {
    }
    
    public function getSecurity() {
        return $this->security;
    }
    
    public function getProfile() {
        return $this->profile;
    }
    
    public function setSecurity($security) {
        $this->security = $security;
    }
    
    public function setProfile($profile) {
        $this->profile = $profile;
    }
}

?>
