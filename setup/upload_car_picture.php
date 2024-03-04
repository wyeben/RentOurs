<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

extract($db_config);

try {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(array("message" => "User not authenticated"));
            exit();
        }

        $userId = $_SESSION['user_id'];

        if (!isset($_FILES['car_picture']) || $_FILES['car_picture']['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(array("message" => "No file uploaded or an error occurred"));
            exit();
        }

        $uploadDirectory = 'car_uploads/';
        $tempFile = $_FILES["car_picture"]["tmp_name"];
        $fileName = basename($_FILES["car_picture"]["name"]);
        $targetFile = $uploadDirectory . $fileName;

        if (move_uploaded_file($tempFile, $targetFile)) {
    
            $stmt = $pdo->prepare("INSERT INTO car_pictures (user_id, file_name) VALUES (:userId, :fileName)");
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':fileName', $fileName);
            $stmt->execute();

            http_response_code(201);
            echo json_encode(array("message" => "Car picture uploaded and saved successfully", "filename" => $fileName));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Failed to move uploaded file"));
        }
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Internal Server Error: " . $e->getMessage()));
}
?>
