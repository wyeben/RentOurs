<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

extract($db_config);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $data = json_decode(file_get_contents("php://input"));

        if (!$data) {
            http_response_code(400);
            echo json_encode(array("message" => "Invalid JSON data"));
            exit();
        }

        if (!isset($data->action) || $data->action !== 'postCar') {
            http_response_code(400);
            echo json_encode(array("message" => "Invalid action or missing action key in JSON"));
            exit();
        }

        $make = $data->make ?? null;
        $model = $data->model ?? null;
        $year = $data->year ?? null;
        $type = $data->type ?? null;
        $availability = $data->availability ?? null;
        $payment_amount = $data->payment_amount ?? null;

        if (!$make || !$model || !$year || !$type || !$availability || !$payment_amount) {
            http_response_code(400);
            echo json_encode(array("message" => "Missing required car details"));
            exit();
        }

        
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        if (!$userId) {
            http_response_code(401);
            echo json_encode(array("message" => "User not authenticated"));
            exit();
        }

        $stmt = $pdo->prepare("INSERT INTO cars (user_id, make, model, year, type, availability, payment_amount) VALUES (:userId, :make, :model, :year, :type, :availability, :payment_amount)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':make', $make);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':availability', $availability);
        $stmt->bindParam(':payment_amount', $payment_amount);
        $stmt->execute();

        http_response_code(201);
        echo json_encode(array("message" => "Car posted successfully."));
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Internal Server Error: " . $e->getMessage()));
}
?>
