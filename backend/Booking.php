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

    public function bookCar($pdo) {
        function extractID($entityID) {
            preg_match('/\d+/', $entityID, $matches);
            return $matches[0];
        }
    
        if ($pdo) {
            $customerID = extractID($this->customer->getId());
            $carID = extractID($this->car->getId());
    
            $stmt = $pdo->prepare("INSERT INTO bookings (customer_id, car_id, pickup_date, dropoff_date, price) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$customerID, $carID, $this->pickupDate, $this->dropOffDate, $this->price]);
    
            echo "Booking confirmed successfully.";
        } else {
            echo "PDO object is null.";
        }
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
