<?php

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

$page = $_GET['page']
?? '/UEB2_Projekti_Grupi36/pages/telecomeoperator.php';

$_SESSION = [];

session_unset();
session_destroy();

setcookie(
    "netwave_user",
    "",
    time() - 3600,
    "/"
);

header("Location: " . $page);
exit();

?>