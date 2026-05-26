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


CREATE TABLE eshop_products (
id INT AUTO_INCREMENT PRIMARY KEY,

category ENUM('telefon','laptop','router','tv') NOT NULL,
product_name VARCHAR(150) NOT NULL,
price DECIMAL(10,2) NOT NULL,
image VARCHAR(255) NOT NULL,
description TEXT,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE orders (
id INT AUTO_INCREMENT PRIMARY KEY,

fullname VARCHAR(150) NOT NULL,
address TEXT NOT NULL,
phone VARCHAR(30) NOT NULL,
payment_method VARCHAR(50) NOT NULL,
product_id INT NOT NULL,
quantity INT DEFAULT 1,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (product_id)
REFERENCES eshop_products(id)
ON DELETE CASCADE
);

-- =========================
-- TELEFONA
-- =========================

INSERT INTO eshop_products
(category, product_name, price, image, description)
VALUES

('telefon', 'iPhone 17', 999.00,'assets/images/phones/iphone17.webp','iPhone 17 me performancë premium'),
('telefon', 'Samsung Galaxy S23 Ultra', 899.00,'assets/images/phones/s23ultra.jpg','Telefon flagship Samsung'),
('telefon', 'Xiaomi 14', 699.00,'assets/images/phones/xiamoi14.jpg','Telefon Xiaomi me performancë të lartë'),
('telefon', 'iPhone 15 Pro', 1149.00,'assets/images/phones/iphone15pro.jpg','iPhone 15 Pro me kamerë profesionale'),
('telefon', 'Samsung Galaxy A55', 499.00,'assets/images/phones/galaxyA55.jpg','Telefon Samsung i kategorisë mid-range'),
('telefon', 'Iphone 13', 699.00,'assets/images/phones/iphone13.webp','iPhone 13 me performancë stabile'),
('telefon', 'Iphone 16', 849.00,'assets/images/phones/iphone16.webp','Gjenerata e re e iPhone'),
('telefon', 'Google Pixel 8', 799.00,'assets/images/phones/googlepixel8.jpg','Google Pixel me Android të pastër'),
('telefon', 'Samsung Galaxy Z Flip5', 749.00,'assets/images/phones/samsung_galxy_z_flip5.jpg','Telefon foldable modern'),
('telefon', 'Samsung Galaxy A32', 829.00,'assets/images/phones/Samsung_galaxy_a32.jpg','Telefon Samsung me ekran AMOLED'),
('telefon', 'iPhone 15', 899.00,'assets/images/phones/iphone15.webp','iPhone 15 me performancë të avancuar'),
('telefon', 'Samsung Galaxy S24 Ultra', 1199.00,'assets/images/phones/samsung_galaxy_s24_ultra.png','Flagship Samsung 2025'),
('telefon', 'Xiaomi 17', 549.00,'assets/images/phones/xiaomi17.jpg','Telefon Xiaomi me çmim ekonomik'),
('telefon', 'Iphone 17 Pro Max', 1299.00,'assets/images/phones/iphone17promax.webp','iPhone premium me ekran të madh'),
('telefon', 'Samsung Galaxy A54', 679.00,'assets/images/phones/samsung_galaxy_a54.jpg','Samsung A54 me bateri të fuqishme');

-- =========================
-- LAPTOPA
-- =========================

INSERT INTO eshop_products
(category, product_name, price, image, description)
VALUES

('laptop', 'Dell XPS 13', 1299.00,'assets/images/laptopa/dell_xps_13.jpg','Laptop premium Dell'),
('laptop', 'MacBook Air M2', 1399.00,'assets/images/laptopa/macbook_air.webp','Laptop ultra i lehtë Apple'),
('laptop', 'HP Spectre x360', 1249.00,'assets/images/laptopa/hp_spectre1.jpg','Laptop 2-in-1 premium'),
('laptop', 'Lenovo IdeaPad 5', 849.00,'assets/images/laptopa/lenovo_idepad.jpg','Laptop për përdorim të përditshëm'),
('laptop', 'ASUS ZenBook 14', 999.00,'assets/images/laptopa/asus_zenbook.png','Laptop elegant ASUS'),
('laptop', 'Acer Swift 5', 899.00,'assets/images/laptopa/acer_swift.jpg','Laptop i lehtë Acer'),
('laptop', 'MSI GS66 Stealth', 1499.00,'assets/images/laptopa/msi_gs66_stealth.jpg','Gaming laptop MSI'),
('laptop', 'HP Pavilion 15', 749.00,'assets/images/laptopa/hp_pavilion.jpg','Laptop HP për studentë'),
('laptop', 'Lenovo ThinkPad X1 Carbon', 1399.00,'assets/images/laptopa/lenovo_idepad.jpg','Laptop biznesi Lenovo'),
('laptop', 'ASUS TUF Gaming F15', 1099.00,'assets/images/laptopa/asus_tuf_gaming.jpg','Gaming laptop ASUS'),
('laptop', 'Dell Inspiron 14', 799.00,'assets/images/laptopa/dell_inspiron.jpg','Laptop Dell për punë'),
('laptop', 'Acer Nitro 5', 999.00,'assets/images/laptopa/acer_nitro.jpg','Gaming laptop Acer'),
('laptop', 'MacBook Pro M3', 1999.00,'assets/images/laptopa/macbook_pro.jpeg','MacBook Pro me Apple M3'),
('laptop', 'Lenovo Legion 7', 1599.00,'assets/images/laptopa/lenovo_legion7.avif','Gaming laptop Lenovo'),
('laptop', 'ASUS ROG Zephyrus G14', 1799.00,'assets/images/laptopa/asus_rog_zephyrus.jpg','Laptop gaming premium');

-- =========================
-- ROUTERA
-- =========================

INSERT INTO eshop_products
(category, product_name, price, image, description)
VALUES

('router', 'TP-Link Archer AX1800', 119.00,'assets/images/routera/tp_link_archer.jpg','Router WiFi 6'),
('router', 'ASUS RT-AX88U WiFi 6', 249.00,'assets/images/routera/asus_rt_ax888u_wifi6.webp','Router gaming ASUS'),
('router', 'Netgear Nighthawk RAX120', 299.00,'assets/images/routera/netgear_nighthawk_rax120.png','Router premium Netgear'),
('router', 'Huawei WiFi AX3', 89.00,'assets/images/routera/huawei_ax3.jpg','Router Huawei dual-band'),
('router', 'D-Link DIR-2150 AC2100', 99.00,'assets/images/routera/d_link_dir.jpg','Router D-Link performant'),
('router', 'TP-Link Archer AX5400', 189.00,'assets/images/routera/tp-link_archer_ax54000.jpg','Router TP-Link me shpejtësi të lartë'),
('router', 'ASUS RT-AX86U Dual Band', 229.00,'assets/images/routera/asus_rt_ax86U.jpg','Router ASUS dual band'),
('router', 'Netgear Orbi RBKE963 Mesh', 999.00,'assets/images/routera/netgear_orbi.jpg','Mesh router premium'),
('router', 'Huawei 5G CPE Pro', 349.00,'assets/images/routera/huawei_5g_cpe.jpg','Router Huawei 5G'),
('router', 'Tenda AC10U Smart Dual Band', 69.00,'assets/images/routera/tenda_ac10U.webp','Router ekonomik Tenda'),
('router', 'ASUS ROG GT-AX11000', 479.00,'assets/images/routera/asus_rog.jpg','Gaming router ASUS ROG'),
('router', 'Linksys MR7350 WiFi 6', 139.00,'assets/images/routera/linksys_mr7350.jpg','Router Linksys WiFi 6'),
('router', 'Xiaomi Mi Router AX3200', 129.00,'assets/images/routera/xiaomi_mi.jpg','Router Xiaomi AX3200'),
('router', 'Netis AC1200 Dual Band', 79.00,'assets/images/routera/netis.webp','Router dual band'),
('router', 'TP-Link Deco X20 Mesh WiFi 6', 249.00,'assets/images/routera/tp_link_deco.jpg','Mesh system TP-Link');

-- =========================
-- TELEVIZORA
-- =========================

INSERT INTO eshop_products
(category, product_name, price, image, description)
VALUES

('tv', 'Samsung QLED 65', 1299.00,'assets/images/televizora/samsunng1.jpg','Smart TV Samsung QLED'),
('tv', 'LG OLED 55', 1099.00,'assets/images/televizora/lg_oled_55.jpg','LG OLED 4K'),
('tv', 'Sony Bravia 4K', 999.00,'assets/images/televizora/sony_bravia_4k.webp','Sony Smart TV 4K'),
('tv', 'Hisense Smart TV 50', 749.00,'assets/images/televizora/hisene_smarttv.jpg','Smart TV Hisense'),
('tv', 'Philips Ambilight 58', 899.00,'assets/images/televizora/philips_ambilight.webp','TV me Ambilight'),
('tv', 'TCL UHD 4K 65', 849.00,'assets/images/televizora/tcl_uhd.webp','TCL UHD Smart TV'),
('tv', 'Samsung Crystal UHD 75', 1399.00,'assets/images/televizora/samsung_crystal.jpg','Samsung Crystal UHD'),
('tv', 'LG NanoCell 65', 999.00,'assets/images/televizora/lgnano.webp','LG NanoCell Smart TV'),
('tv', 'Samsung OLED S90C 65', 1549.00,'assets/images/televizora/samsung_oled.webp','Samsung OLED premium'),
('tv', 'Sony XR A80L 55 OLED', 1399.00,'assets/images/televizora/sonyxr.jpg','Sony OLED flagship'),
('tv', 'Hisense U8K Mini LED 65', 1199.00,'assets/images/televizora/hisene_mini.jpg','Mini LED TV'),
('tv', 'Philips OLED 708 55', 1249.00,'assets/images/televizora/philips_oled.webp','Philips OLED Smart TV'),
('tv', 'TCL QD-Mini LED 75', 1599.00,'assets/images/televizora/tcl_mini.jpg','TCL Mini LED'),
('tv', 'Xiaomi TV P1 55', 699.00,'assets/images/televizora/xiaomi_tv.jpg','Xiaomi Smart TV'),
('tv', 'Panasonic LX650 50', 749.00,'assets/images/televizora/panasonic.jpg','Panasonic Smart TV');

