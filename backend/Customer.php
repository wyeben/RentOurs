<?php

require_once 'User.php';
require_once 'Booking.php'; 

class Customer extends User {
    private $id;
    private $profile;
    private $booking = [];
    private $review = [];
    
    public function __construct($security, $profile) {
        parent::__construct($security, $profile);
        $this->id = uniqid('customer_');

    }
    
    public function searchForCars($criteria) {
        $cars = [
            new Car("Toyota", "Camry", 2022, "Sedan", true),
            new Car("Honda", "Accord", 2021, "Sedan", true),
            new Car("Ford", "Mustang", 2020, "Sports Car", true),
        ];
        
        $filteredCars = [];
        foreach ($cars as $car) {
            if ($car->getMake() === $criteria) {
                $filteredCars[] = $car;
            }
        }
        
        return $filteredCars;
    }
    
    public function viewCarDetails($car) {
        return [
            'make' => $car->getMake(),
            'model' => $car->getModel(),
            'year' => $car->getYear(),
            'type' => $car->getType(),
            'availability' => $car->getAvailability(),
        ];
    }
    
    public function viewCarImages($car) {
        return $car->getImages();
    }
    
    public function bookCar($car, $pickupDate, $dropOffDate, $price) {
        $booking = new Booking($this, $car, $pickupDate, $dropOffDate, $price);
        $this->booking[] = $booking;
        return $booking; 
    }
    
    public function manageBooking($bookingId, $action) {
        foreach ($this->booking as $key => $booking) {
            if ($booking->getId() === $bookingId) {
                unset($this->booking[$key]);
                return true; 
            }
        }
        return false; 
    }
    
    public function getBooking() {
        return $this->booking;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getReview() {
        return $this->review;
    }

    public function getName() {
        if (isset($this->profile['name'])) {
            return $this->profile['name'];
        } else {
            return null; 
        }
    }
    
    public function setBooking($booking) {
        
        $this->booking = $booking;
    }
    
    public function setReview($review) {
        $this->review = $review;
    }
}


?>
