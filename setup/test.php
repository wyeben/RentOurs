<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

extract($db_config);

$sampleData = array(
    array('John Doe', 'password123', 'customer', 'individual'),
    array('Jane Smith', 'pass456', 'company', 'company')
);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO Users (username, password, role, user_type) VALUES (:username, :password, :role, :user_type)";
    $stmt = $pdo->prepare($sql);

    foreach ($sampleData as $data) {
        $stmt->bindParam(':username', $data[0]);
        $stmt->bindParam(':password', $data[1]);
        $stmt->bindParam(':role', $data[2]);
        $stmt->bindParam(':user_type', $data[3]);
        $stmt->execute();
    }

    echo "Static data inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
