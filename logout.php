<?php
session_start();

$page = $_GET['page'] ?? 'telecomoperator.php';

session_destroy();

header("Location: $page");
exit();
?>