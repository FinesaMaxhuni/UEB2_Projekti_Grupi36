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


