<?php

require_once 'backend/User.php';
require_once 'backend/Customer.php';
require_once 'backend/Company.php';
require_once 'backend/Individual.php';
require_once 'backend/Admin.php';
require_once 'backend/Car.php';
require_once 'backend/Booking.php';
require_once 'backend/Review.php';
require_once 'backend/ContactInformation.php';
require_once 'backend/Profile.php';
require_once 'backend/Security.php';
require_once 'backend/ReviewModeration.php';
require_once 'backend/Advertisement.php';
require_once 'backend/Payment.php';
require_once 'backend/AdvertisementTier.php';
require_once 'backend/CarImage.php';
require_once 'backend/UserImage.php';


$security = new Security("Yila", "password", true);
$profile = new Profile("Yila", "Lekki", "Greatful");
$customer = new Customer($security, $profile);

$car = new Car("Toyota", "Camry", 2022, "Sedan", true);


$searchResults = $customer->searchForCars("Toyota");

foreach ($searchResults as $car) {
    echo "Make: " . $car->getMake() . ", Model: " . $car->getModel() . ", Year: " . $car->getYear() . "\n";
}

$pickupDate = date('Y-m-d');
$dropoffDate = date('Y-m-d', strtotime('+7 days')); 
$price = 200; 

$booking = new Booking($customer, $car, $pickupDate, $dropoffDate, $price);

$booking->bookCar();

echo "Booking confirmed!\n";

?>
