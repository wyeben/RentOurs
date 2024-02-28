<?php

abstract class Advertisement {
    private $car;
    private $owner;
    private $content;
    private $status;
    
    public function __construct($car, $owner, $content, $status) {
        $this->car = $car;
        $this->owner = $owner;
        $this->content = $content;
        $this->status = $status;
    }
    
    public function updateContent($content) {
        $this->content = $content;
    }
    
    public function changeStatus($status) {
        $this->status = $status;
    }
    
    public function getCar() {
        return $this->car;
    }
    
    public function getOwner() {
        return $this->owner;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setCar($car) {
        $this->car = $car;
    }
    
    public function setOwner($owner) {
        $this->owner = $owner;
    }
    
    public function setContent($content) {
        $this->content = $content;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
}

?>
