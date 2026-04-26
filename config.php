<?php
session_start();

// Përfshi konceptet e PHP
require_once __DIR__ . '/php_concepts.php';

$users = [
    "admin" => [
        "password" => "1234",
        "role" => "admin"
    ],

    "user" => [
        "password" => "1234",
        "role" => "user"
    ]
];
?>