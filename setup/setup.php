<?php
require_once 'config.php';

extract($db_config);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $create_db_sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    $pdo->exec($create_db_sql);

    $pdo->exec("USE $dbname");


    $sql = "
    CREATE TABLE IF NOT EXISTS Users (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('customer', 'company', 'admin') NOT NULL,
        user_type ENUM('individual', 'company') NOT NULL
    );
    
    CREATE TABLE IF NOT EXISTS Companies (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        address VARCHAR(255) NOT NULL
    );
    
    CREATE TABLE IF NOT EXISTS Cars (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT, 
        make VARCHAR(50) NOT NULL,
        model VARCHAR(50) NOT NULL,
        year INT NOT NULL,
        type VARCHAR(50) NOT NULL,
        availability BOOLEAN NOT NULL,
        payment_amount DECIMAL(10, 2)
    );
    
    
    CREATE TABLE IF NOT EXISTS Bookings (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        customer_id BIGINT NOT NULL,
        car_id BIGINT NOT NULL,
        pickup_date DATE NOT NULL,
        dropoff_date DATE NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (customer_id) REFERENCES Users(id),
        FOREIGN KEY (car_id) REFERENCES Cars(id)
    );
    
    CREATE TABLE IF NOT EXISTS Reviews (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT NOT NULL,
        car_id BIGINT NOT NULL,
        rating INT NOT NULL,
        comment TEXT,
        FOREIGN KEY (user_id) REFERENCES Users(id),
        FOREIGN KEY (car_id) REFERENCES Cars(id)
    );
    
    CREATE TABLE IF NOT EXISTS Images (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT,
        car_id BIGINT,
        image_type ENUM('user', 'car') NOT NULL,
        image_path VARCHAR(255) NOT NULL,
        FOREIGN KEY (user_id) REFERENCES Users(id),
        FOREIGN KEY (car_id) REFERENCES Cars(id)
    );
    
    CREATE TABLE IF NOT EXISTS Payments (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        booking_id BIGINT NOT NULL,
        amount DECIMAL(10, 2) NOT NULL,
        payment_method VARCHAR(50) NOT NULL,
        FOREIGN KEY (booking_id) REFERENCES Bookings(id)
    );
    
    CREATE TABLE IF NOT EXISTS Advertisement (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT NOT NULL,
        content TEXT,
        status ENUM('pending', 'approved', 'rejected') NOT NULL,
        FOREIGN KEY (user_id) REFERENCES Users(id)
    );
    
    CREATE TABLE IF NOT EXISTS ContactInformation (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT NOT NULL,
        phone_number VARCHAR(20),
        email_address VARCHAR(100),
        account_number VARCHAR(50),
        FOREIGN KEY (user_id) REFERENCES Users(id)
    );
    
    CREATE TABLE IF NOT EXISTS Profile (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT NOT NULL,
        name VARCHAR(100) NOT NULL,
        address VARCHAR(255),
        additional_info TEXT,
        FOREIGN KEY (user_id) REFERENCES Users(id)
    );
    
    CREATE TABLE IF NOT EXISTS Security (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT NOT NULL,
        login_credentials VARCHAR(255) NOT NULL,
        roles VARCHAR(255),
        permissions VARCHAR(255),
        FOREIGN KEY (user_id) REFERENCES Users(id)
    );
    
    CREATE TABLE IF NOT EXISTS CarImages (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        car_id BIGINT NOT NULL,
        image_data BLOB,
        FOREIGN KEY (car_id) REFERENCES Cars(id)
    );
    
    CREATE TABLE IF NOT EXISTS UserImages (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT NOT NULL,
        image_data BLOB,
        FOREIGN KEY (user_id) REFERENCES Users(id)
    );
    
    CREATE TABLE IF NOT EXISTS ReviewModeration (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        review_id BIGINT NOT NULL,
        status ENUM('pending', 'approved', 'rejected') NOT NULL,
        FOREIGN KEY (review_id) REFERENCES Reviews(id)
    );
    
    CREATE TABLE IF NOT EXISTS Rental (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        car_id BIGINT NOT NULL,
        rental_date DATE NOT NULL,
        return_date DATE,
        FOREIGN KEY (car_id) REFERENCES Cars(id)
    );
    
    CREATE TABLE IF NOT EXISTS AdvertisementTier (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        description TEXT,
        cost DECIMAL(10, 2) NOT NULL
    );
    
    
    
    ";

    $pdo->exec($sql);

    echo json_encode(array("message" => "Tables created successfully"));
} catch (PDOException $e) {
    http_response_code(500); 
    echo json_encode(array("message" => "Database error: " . $e->getMessage()));
}
?>
