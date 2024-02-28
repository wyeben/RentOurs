<?php

class Profile {
    private $name;
    private $address;
    private $additionalInfo;
    
    public function __construct($name, $address, $additionalInfo) {
        $this->name = $name;
        $this->address = $address;
        $this->additionalInfo = $additionalInfo;
    }
    
    public function updateName($name) {
        $this->name = $name;
    }
    
    public function updateAddress($address) {
        $this->address = $address;
    }
    
    public function updateAdditionalInfo($additionalInfo) {
        $this->additionalInfo = $additionalInfo;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getAddress() {
        return $this->address;
    }
    
    public function getAdditionalInfo() {
        return $this->additionalInfo;
    }
}

?>
