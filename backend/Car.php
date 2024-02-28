<?php

class Car {
    private $make;
    private $model;
    private $year;
    private $type;
    private $features = [];
    private $availability;
    private $images = [];
    
    public function __construct($make, $model, $year, $type, $availability) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->type = $type;
        $this->availability = $availability;
    }
    
    public function uploadImage($imageData) {
    }
    
    public function addFeature($feature) {
    }
    
    public function getMake() {
        return $this->make;
    }
    
    public function getModel() {
        return $this->model;
    }
    
    public function getYear() {
        return $this->year;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function getAvailability() {
        return $this->availability;
    }
    
    public function getFeatures() {
        return $this->features;
    }
    
    public function setMake($make) {
        $this->make = $make;
    }
    
    public function setModel($model) {
        $this->model = $model;
    }
    
    public function setYear($year) {
        $this->year = $year;
    }
    
    public function setType($type) {
        $this->type = $type;
    }
    
    public function setAvailability($availability) {
        $this->availability = $availability;
    }
    
    public function setFeatures($features) {
        $this->features = $features;
    }
    
    public function addImage($image) {
        $this->images[] = $image;
    }
    
    public function getImages() {
        return $this->images;
    }
}

?>
