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

INSERT INTO users(fullname, username, email, password, role, gender, city)
VALUES
('Finesa Maxhuni', 'finesa', 'finesa@gmail.com', '$2y$10$VxQ7x9u2x9fKQeY5nR4k8uVQ8g3zJ2fT9eY2hM7vN4bX1zL0sW6aK', 'admin', 'Femer', 'Prishtine');

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

    FOREIGN KEY(tv_package_id)
    REFERENCES tv_packages(id)
    ON DELETE CASCADE,

    FOREIGN KEY(channel_id)
    REFERENCES channels(id)
    ON DELETE CASCADE
);

CREATE TABLE aktivizo(
    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,
    tv_package_id INT NULL,
    tv_internet_package_id INT NULL,

    activated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(user_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY(tv_package_id)
    REFERENCES tv_packages(id)
    ON DELETE CASCADE,

    FOREIGN KEY(tv_internet_package_id)
    REFERENCES tv_internet_packages(id)
    ON DELETE CASCADE
);

INSERT INTO tv_packages(package_name, price, channels_count, description)
VALUES
('TV Economy', 8.90, 90, '90+ kanale ne HD, kanale kombetare, lajme 24/7, filma, seriale dhe muzike.'),
('TV Premium', 15.50, 150, '150+ kanale ne HD/4K, filma dhe seriale premium, dokumentare ekskluzive, entertainment familjar dhe catch-up 5 dite.'),
('TV Sport', 23.90, 200, '200+ kanale HD/4K, Premier League, La Liga, Serie A, Bundesliga, Champions League, Europa League, Formula 1, MotoGP, UFC dhe Boxing.'),
('TV Custom', 12.00, 0, 'Pako e personalizuar ku klienti zgjedh vetem kanalet qe deshiron dhe paguan vetem per ate qe perdor.');

INSERT INTO tv_internet_packages(package_name, internet_speed, price, channels_count, description)
VALUES
('Combo Basic', '100 Mbps', 14.90, 90, '100 Mbps Internet Fiber, 90+ kanale TV ne HD, kanale kombetare dhe lajme 24/7, filma dhe muzike, catch-up 3 dite.'),
('Combo Plus', '200 Mbps', 20.90, 150, '200 Mbps Internet Fiber, 150+ kanale HD dhe disa 4K, filma dhe seriale premium, dokumentare ekskluzive, catch-up 5 dite.'),
('Combo Sport', '300 Mbps', 29.90, 200, '300 Mbps Internet Fiber, Premier League, La Liga, Serie A, Champions League, Europa League, NBA, Formula 1, MotoGP, UFC dhe Boxing.'),
('Combo Ultra', '500 Mbps', 39.90, 250, '500 Mbps Internet Fiber, te gjitha kanalet HD/4K dhe premium, filma, seriale, dokumentare, sport dhe catch-up 10 dite.');

INSERT INTO channels(channel_name, category)
VALUES
('RTK', 'Informuese'),
('KTV', 'Informuese'),
('Klan Kosova', 'Informuese'),
('HBO HD', 'Filma'),
('Cinemax', 'Filma'),
('Premier League HD', 'Sport'),
('La Liga HD', 'Sport'),
('Formula 1 HD', 'Sport'),
('Eurosport HD', 'Sport'),
('Disney Channel', 'Femije'),
('Cartoon Network', 'Femije'),
('Boomerang', 'Femije');

INSERT INTO permbajtja(tv_package_id, channel_id)
VALUES
(1,1),(1,2),(1,3),(1,4),
(2,4),(2,5),(2,10),(2,11),
(3,6),(3,7),(3,8),(3,9),
(4,1),(4,5),(4,10);

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
