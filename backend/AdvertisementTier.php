<?php

class AdvertisementTier {
    private $name;
    private $description;
    private $cost;
    private $features = [];
    
    public function __construct($name, $description, $cost, $features = []) {
        $this->name = $name;
        $this->description = $description;
        $this->cost = $cost;
        $this->features = $features;
    }
    
    public function updateDescription($description) {
        $this->description = $description;
    }
    
    public function updateCost($cost) {
        $this->cost = $cost;
    }
    
    public function addFeature($feature) {
        $this->features[] = $feature;
    }
    
    public function removeFeature($feature) {
        $key = array_search($feature, $this->features);
        if ($key !== false) {
            unset($this->features[$key]);
        }
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function getCost() {
        return $this->cost;
    }
    
    public function getFeatures() {
        return $this->features;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
}

?>
