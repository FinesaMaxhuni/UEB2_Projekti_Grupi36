<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page = $_GET['page'] ?? 'pages/telecomeoperator.php';

$_SESSION = [];
session_unset();
session_destroy();

setcookie("netwave_user", "", time() - 3600, "/", "", false, true);
setcookie("netwave_role", "", time() - 3600, "/", "", false, true);

header("Location: $page");
exit();
?>