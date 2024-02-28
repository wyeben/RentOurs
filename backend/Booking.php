<?php

class Booking {
    private $customer;
    private $car;
    private $pickupDate;
    private $dropOffDate;
    private $price;
    
    public function __construct($customer, $car, $pickupDate, $dropOffDate, $price) {
        $this->customer = $customer;
        $this->car = $car;
        $this->pickupDate = $pickupDate;
        $this->dropOffDate = $dropOffDate;
        $this->price = $price;
    }
    
    public function cancelBooking() {
    }

    public function bookCar() {
        echo "Booking car '{$this->car->getMake()} {$this->car->getModel()}'
         for '{$this->customer->getName()}' from {$this->pickupDate} to {$this->dropOffDate}.\n";
        echo "Total price: {$this->price}\n";
    }
    
    public function getCustomer() {
        return $this->customer;
    }
    
    public function getCar() {
        return $this->car;
    }
    
    public function getPickupDate() {
        return $this->pickupDate;
    }
    
    public function getDropOffDate() {
        return $this->dropOffDate;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function setCustomer($customer) {
        $this->customer = $customer;
    }
    
    public function setCar($car) {
        $this->car = $car;
    }
    
    public function setPickupDate($pickupDate) {
        $this->pickupDate = $pickupDate;
    }
    
    public function setDropOffDate($dropOffDate) {
        $this->dropOffDate = $dropOffDate;
    }
    
    public function setPrice($price) {
        $this->price = $price;
    }
}

?>
