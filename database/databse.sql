CREATE DATABASE netwave;

use netwave;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL ,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'user',
    gender VARCHAR(20),
    city VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users(fullname,username, email, password, role, gender, city)
VALUES
('Finesa Maxhuni','finesa','finesa@gmail.com','$2y$10$VxQ7x9u2x9fKQeY5nR4k8uVQ8g3zJ2fT9eY2hM7vN4bX1zL0sW6aK','admin',  'Femer','Prishtine'),

CREATE TABLE tv_packages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    package_name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    channels_count INT NOT NULL,
    description TEXT
);

CREATE TABLE tv_internet_packages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    package_name VARCHAR(100) NOT NULL,
    internet_speed VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    channels_count INT NOT NULL,
    description TEXT
);

CREATE TABLE channels(
    id INT AUTO_INCREMENT PRIMARY KEY,
    channel_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL
);

CREATE TABLE permbajtja(
    tv_package_id INT NOT NULL,
    channel_id INT NOT NULL,
    PRIMARY KEY(tv_package_id, channel_id),
    FOREIGN KEY(tv_package_id) REFERENCES tv_packages(id),
    FOREIGN KEY(channel_id) REFERENCES channels(id)
);

CREATE TABLE aktivizo(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tv_package_id INT,
    tv_internet_package_id INT,
    activated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(tv_package_id) REFERENCES tv_packages(id),
    FOREIGN KEY(tv_internet_package_id) REFERENCES tv_internet_packages(id)
);

CREATE TABLE fiber_packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    package_name VARCHAR(100) NOT NULL,
    speed VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT
);

CREATE TABLE fiveg_packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    package_name VARCHAR(100) NOT NULL,
    speed VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT
);

CREATE TABLE internet_subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,

    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(30) NOT NULL,

    package_type ENUM('fiber','5g') NOT NULL,
    package_id INT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO fiber_packages (package_name, speed, price, description)
VALUES
('Fiber 100', '100 Mbps', 29.90, 'Basic Fiber'),
('Fiber 300', '300 Mbps', 39.90, 'Medium Fiber'),
('Fiber 1G', '1 Gbps', 49.90, 'Premium Fiber');

INSERT INTO fiveg_packages (package_name, speed, price, description)
VALUES
('5G Basic', '150 Mbps', 24.90, 'Basic 5G'),
('5G Plus', '500 Mbps', 34.90, 'Plus 5G');
