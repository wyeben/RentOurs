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

require_once 'setup/config.php';
extract($db_config);
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function registerUser($username, $password, $role, $user_type) {
    global $pdo;
    
    $stmt = $pdo->prepare("INSERT INTO Users (username, password, role, user_type) VALUES (:username, :password, :role, :user_type)");

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':user_type', $user_type);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return true; 
    } else {
        return false; 
    }
}

function authenticateUser($username, $password) {
    global $pdo;


    $stmt = $pdo->prepare("SELECT * FROM Users WHERE username = :username");

    $stmt->bindParam(':username', $username);

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user; 
    } else {
        return false; 
    }
}

function bookCar($customerId, $carId, $pickupDate, $dropoffDate, $price) {
    global $pdo;
    
    $stmt = $pdo->prepare("INSERT INTO bookings (customer_id, car_id, pickup_date, dropoff_date, price) VALUES (:customerId, :carId, :pickupDate, :dropoffDate, :price)");

    $stmt->bindParam(':customerId', $customerId);
    $stmt->bindParam(':carId', $carId);
    $stmt->bindParam(':pickupDate', $pickupDate);
    $stmt->bindParam(':dropoffDate', $dropoffDate);
    $stmt->bindParam(':price', $price);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return true; 
    } else {
        return false; 
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $data = json_decode(file_get_contents("php://input"));

        if (!isset($data->action)) {
            http_response_code(400); 
            echo json_encode(array("message" => "Missing action parameter"));
        } else {
            $action = $data->action;

            if ($action == "register") {
                if (!isset($data->username) || !isset($data->password) || !isset($data->role) || !isset($data->user_type)) {
                    http_response_code(400); 
                    echo json_encode(array("message" => "Missing required parameters"));
                } else {
                    if (registerUser($data->username, password_hash($data->password, PASSWORD_DEFAULT), $data->role, $data->user_type)) {
                        echo json_encode(array("message" => "Registration successful"));
                    } else {
                        http_response_code(500); 
                        echo json_encode(array("message" => "Registration failed"));
                    }
                }
            } elseif ($action == "login") {
                if (!isset($data->username) || !isset($data->password)) {
                    http_response_code(400); 
                    echo json_encode(array("message" => "Missing required parameters"));
                } else {
                    $user = authenticateUser($data->username, $data->password);
                    if ($user) {
                        session_start();

                        $_SESSION['user_id'] = $user['id'];
                        exit();
                        echo json_encode(array("message" => "Login successful", "user" => $user));
                    } else {
                        http_response_code(401); 
                        echo json_encode(array("message" => "Login failed"));
                    }
                }
            } elseif ($action == "bookCar") {
                if (!isset($data->customerId) || !isset($data->carId) || !isset($data->pickupDate) || !isset($data->dropoffDate) || !isset($data->price)) {
                    http_response_code(400); 
                    echo json_encode(array("message" => "Missing required parameters"));
                } else {
                    if (bookCar($data->customerId, $data->carId, $data->pickupDate, $data->dropoffDate, $data->price)) {
                        echo json_encode(array("message" => "Car booked successfully"));
                    } else {
                        http_response_code(500); 
                        echo json_encode(array("message" => "Failed to book car"));
                    }
                }
            } elseif ($action == "logout") {
                session_start();
                session_unset();
                session_destroy();
                echo json_encode(array("message" => "Logout successful"));
            } elseif ($action == 'postCar') {
                    session_start();
                    if (!isset($_SESSION['user_id'])) {
                        http_response_code(400);
                        echo json_encode(array("message" => "User ID not found in session. Please log in."));
                        return;
                    }
                    $userId = $_SESSION['user_id'];
                
                    $requiredParams = array("make", "model", "year", "type", "availability", "payment_amount");
                    $missingParams = array_diff($requiredParams, array_keys((array) $data));
                
                    if (!empty($missingParams)) {
                        http_response_code(400);
                        echo json_encode(array("message" => "Missing required parameters: " . implode(", ", $missingParams)));
                    } else {
                        $make = $data->make;
                        $model = $data->model;
                        $year = $data->year;
                        $type = $data->type;
                        $availability = $data->availability;
                        $paymentAmount = $data->payment_amount;
                
                        postCar($userId, $make, $model, $year, $type, $availability, $paymentAmount);
                    }
                
            }
            else {
                http_response_code(400); 
                echo json_encode(array("message" => "Invalid action"));
            }
        }
    } catch (Exception $e) {
        http_response_code(500); 
        echo json_encode(array("message" => "Internal Server Error: " . $e->getMessage()));
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET['action'] == 'searchCars') {
        $make = isset($_GET['make']) ? $_GET['make'] : null;
        $model = isset($_GET['model']) ? $_GET['model'] : null;
        $year = isset($_GET['year']) ? $_GET['year'] : null;
    
        $results = searchAvailableCars($make, $model, $year);
        echo json_encode($results);
    } else {
        http_response_code(405); 
        echo json_encode(array("message" => "Method not allowed"));
    }
} else {
    http_response_code(405); 
    echo json_encode(array("message" => "Method not allowed"));
}

function postCar($make, $model, $year, $type, $availability, $paymentAmount) {
    global $pdo;
    
    session_start();
    if (!isset($_SESSION['user_id'])) {
        return "User ID not found in session. Please log in.";
    }
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT role, user_type FROM users WHERE id = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$userData || $userData['role'] !== 'customer' || $userData['user_type'] !== 'individual') {
        http_response_code(403); 
        echo json_encode(array("message" => "User is not eligible to post a car."));
        return;
    }

    $paymentSuccessful = true; 
    if (!$paymentSuccessful) {
        http_response_code(400); 
        echo json_encode(array("message" => "Payment failed. Car listing not posted."));
        return;
    }

    $stmt = $pdo->prepare("INSERT INTO payments (user_id, amount) VALUES (:userId, :amount)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':amount', $paymentAmount);
    $stmt->execute();

    $stmt = $pdo->prepare("INSERT INTO cars (user_id, make, model, year, type, availability, payment_amount) VALUES (:userId, :make, :model, :year, :type, :availability, :paymentAmount)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':make', $make);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':availability', $availability);
    $stmt->bindParam(':paymentAmount', $paymentAmount);
    $stmt->execute();

    http_response_code(201); 
    echo json_encode(array("message" => "Car listing posted successfully."));
}



function searchAvailableCars($make, $model, $year) {
    global $pdo;
    
    $query = "SELECT * FROM cars WHERE availability = 1";
    $params = [];
    
    if (!empty($make)) {
        $query .= " AND make = :make";
        $params[':make'] = $make;
    }
    
    if (!empty($model)) {
        $query .= " AND model = :model";
        $params[':model'] = $model;
    }
    
    if (!empty($year)) {
        $query .= " AND year = :year";
        $params[':year'] = $year;
    }
    
    $stmt = $pdo->prepare($query);
    
    $stmt->execute($params);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

