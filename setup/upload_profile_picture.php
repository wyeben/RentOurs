<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';
require_once 'session.php';

extract($db_config);


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(array("message" => "User not authenticated"));
            exit();
        }

        $userId = $_SESSION['user_id'];

        if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(array("message" => "No file uploaded or an error occurred"));
            exit();
        }

        $uploadDirectory = 'uploads/';
        $tempFile = $_FILES["profile_picture"]["tmp_name"];
        $fileName = basename($_FILES["profile_picture"]["name"]);
        $targetFile = $uploadDirectory . $fileName;

        if (move_uploaded_file($tempFile, $targetFile)) {
            $stmt = $pdo->prepare("UPDATE users SET profile_picture = :profile_picture WHERE id = :userId");
            $stmt->bindParam(':profile_picture', $fileName);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            http_response_code(201);
            echo json_encode(array("message" => "Profile picture uploaded and saved successfully", "filename" => $fileName));
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

