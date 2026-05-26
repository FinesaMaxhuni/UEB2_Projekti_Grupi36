<?php

function ensureInternetPackageTables(PDO $pdo): void
{
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS fiber_packages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            package_name VARCHAR(100) NOT NULL,
            speed VARCHAR(50) NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            description TEXT
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS fiveg_packages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            package_name VARCHAR(100) NOT NULL,
            speed VARCHAR(50) NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            description TEXT
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS internet_subscriptions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fullname VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(30) NOT NULL,
            package_type ENUM('fiber','5g') NOT NULL,
            package_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    seedPackagesIfEmpty($pdo, 'fiber_packages', [
        ['Fiber 100', '100 Mbps', 29.90, 'Basic Fiber'],
        ['Fiber 300', '300 Mbps', 39.90, 'Medium Fiber'],
        ['Fiber 1G', '1 Gbps', 49.90, 'Premium Fiber'],
    ]);

    seedPackagesIfEmpty($pdo, 'fiveg_packages', [
        ['5G Basic', '150 Mbps', 24.90, 'Basic 5G'],
        ['5G Plus', '500 Mbps', 34.90, 'Plus 5G'],
        ['5G Premium', '1 Gbps', 49.90, 'Premium 5G'],
    ]);
}

function seedPackagesIfEmpty(PDO $pdo, string $table, array $packages): void
{
    $count = (int)$pdo->query("SELECT COUNT(*) FROM $table")->fetchColumn();

    if ($count > 0) {
        return;
    }

    $stmt = $pdo->prepare("
        INSERT INTO $table (package_name, speed, price, description)
        VALUES (?, ?, ?, ?)
    ");

    foreach ($packages as $package) {
        $stmt->execute($package);
    }
}
