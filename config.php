<?php

session_start();

$host = "localhost";
$dbname = "netwave";
$user = "root";
$pass = "";

try{

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

}catch(PDOException $e){

    die("Gabim ne databaze: " . $e->getMessage());
}
?>