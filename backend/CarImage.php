<?php

class CarImage {
    private $imageData;
    private $car;
    
    public function __construct($imageData, $car) {
        $this->imageData = $imageData;
        $this->car = $car;
    }
    
    public function getImageData() {
        return $this->imageData;
    }
    
    public function getCar() {
        return $this->car;
    }
    
    public function setImageData($imageData) {
        $this->imageData = $imageData;
    }
    
    public function setCar($car) {
        $this->car = $car;
    }
}

?>
