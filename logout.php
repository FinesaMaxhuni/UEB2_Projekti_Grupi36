<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page = $_GET['page'] ?? 'pages/telecomoperator.php';

$_SESSION = [];
session_unset();
session_destroy();

setcookie("netwave_user", "", time() - 3600, "/");
setcookie("netwave_role", "", time() - 3600, "/");

header("Location: $page");
exit();
?>