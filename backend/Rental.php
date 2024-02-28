<?php

class Rental {
    private $car;
    private $bookingHistory = [];
    
    public function __construct($car) {
        $this->car = $car;
    }
    
    public function addBooking($booking) {
        $this->bookingHistory[] = $booking;
    }
    
    public function removeBooking($booking) {
        // Implementation
    }
    
    public function getCar() {
        return $this->car;
    }
    
    public function getBookingHistory() {
        return $this->bookingHistory;
    }
}

?>
