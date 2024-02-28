CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'company', 'admin') NOT NULL
    user_type ENUM('individual', 'company') NOT NULL
);

CREATE TABLE Companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL
);

CREATE TABLE Cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    type VARCHAR(50) NOT NULL,
    availability BOOLEAN NOT NULL
);

CREATE TABLE Bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    pickup_date DATE NOT NULL,
    dropoff_date DATE NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    FOREIGN KEY (car_id) REFERENCES Cars(id)
);

CREATE TABLE Reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    rating INT NOT NULL,
    comment TEXT,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    FOREIGN KEY (car_id) REFERENCES Cars(id)
);

CREATE TABLE Images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    car_id INT,
    image_type ENUM('user', 'car') NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    FOREIGN KEY (car_id) REFERENCES Cars(id)
);

CREATE TABLE Payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    FOREIGN KEY (booking_id) REFERENCES Bookings(id)
);

CREATE TABLE Advertisement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT,
    status ENUM('pending', 'approved', 'rejected') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

CREATE TABLE ContactInformation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    phone_number VARCHAR(20),
    email_address VARCHAR(100),
    account_number VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

CREATE TABLE Profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    additional_info TEXT,
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

CREATE TABLE Security (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    login_credentials VARCHAR(255) NOT NULL,
    roles VARCHAR(255),
    permissions VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

CREATE TABLE CarImages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT NOT NULL,
    image_data BLOB,
    FOREIGN KEY (car_id) REFERENCES Cars(id)
);

CREATE TABLE UserImages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    image_data BLOB,
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

CREATE TABLE ReviewModeration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    review_id INT NOT NULL,
    status ENUM('pending', 'approved', 'rejected') NOT NULL,
    FOREIGN KEY (review_id) REFERENCES Reviews(id)
);

CREATE TABLE Rental (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT NOT NULL,
    rental_date DATE NOT NULL,
    return_date DATE,
    FOREIGN KEY (car_id) REFERENCES Cars(id)
);

CREATE TABLE AdvertisementTier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    cost DECIMAL(10, 2) NOT NULL
);
