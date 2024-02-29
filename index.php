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

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->security) || !isset($data->profile) || !isset($data->car) || !isset($data->pickupDate) || !isset($data->dropoffDate) || !isset($data->price)) {
        http_response_code(400); 
        echo json_encode(array("message" => "Missing required parameters"));
    } else {
        $securityData = $data->security;
        $security = new Security($securityData->username, $securityData->password, $securityData->isActive);

        $profileData = $data->profile;
        $profile = new Profile($profileData->name, $profileData->address, $profileData->additionalInfo);

        $customer = new Customer($security, $profile);

        $carData = $data->car;
        $car = new Car($carData->make, $carData->model, $carData->year, $carData->type, $carData->availability);

        $pickupDate = $data->pickupDate;
        $dropoffDate = $data->dropoffDate;
        $price = $data->price;
        $booking = new Booking($customer, $car, $pickupDate, $dropoffDate, $price);

        $booking->bookCar();

        echo json_encode(array("message" => "Booking confirmed"));
    }
} else {
    http_response_code(405); 
    echo json_encode(array("message" => "Method not allowed"));
}
?>
