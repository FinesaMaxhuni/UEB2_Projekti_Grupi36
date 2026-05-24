<?php

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("
DELETE FROM users
WHERE id=?
");

$stmt->execute([$id]);

header("Location: perdoruesit.php");

exit();

?>