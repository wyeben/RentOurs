<?php

class UserImage {
    private $imageData;
    private $user;
    
    public function __construct($imageData, $user) {
        $this->imageData = $imageData;
        $this->user = $user;
    }
    
    public function getImageData() {
        return $this->imageData;
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function setImageData($imageData) {
        $this->imageData = $imageData;
    }
    
    public function setUser($user) {
        $this->user = $user;
    }
}

?>
