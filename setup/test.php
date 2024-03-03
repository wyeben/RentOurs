<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

extract($db_config);

$sampleData = array(
    array('Ben', 'password123', 'customer', 'individual'),
    array('Esther', 'pass456', 'company', 'company')
);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO Users (username, password, role, user_type) VALUES (:username, :password, :role, :user_type)";
    $stmt = $pdo->prepare($sql);

    foreach ($sampleData as $data) {
        $username = $data[0];
        $password = password_hash($data[1], PASSWORD_DEFAULT);
        $role = $data[2];
        $user_type = $data[3];
    
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':user_type', $user_type);
        $stmt->execute();
    }
    

    $make = 'Toyota';
    $model = 'Corola';
    $year = 2020;
    $type = 'Sedan';
    $availability = true;
    $paymentAmount = 100.00;

    $userId = 4; 
    $stmt = $pdo->prepare("INSERT INTO cars (user_id, make, model, year, type, availability, payment_amount) VALUES (:userId, :make, :model, :year, :type, :availability, :paymentAmount)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':make', $make);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':availability', $availability);
    $stmt->bindParam(':paymentAmount', $paymentAmount);
    $stmt->execute();

    echo "Static data inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
