<?php

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if(($type != 'tv' && $type != 'tv_internet') || !ctype_digit((string)$id)){
    die("Paketa nuk eshte valide.");
}

if($type == 'tv'){
    $pdo->beginTransaction();

    $deleteChannels = $pdo->prepare("
    DELETE FROM permbajtja
    WHERE tv_package_id=?
    ");

    $deleteChannels->execute([$id]);

    $clearActivations = $pdo->prepare("
    UPDATE aktivizo
    SET tv_package_id=NULL
    WHERE tv_package_id=?
    ");

    $clearActivations->execute([$id]);

    $deletePackage = $pdo->prepare("
    DELETE FROM tv_packages
    WHERE id=?
    ");

    $deletePackage->execute([$id]);

    $pdo->commit();
}else{
    $pdo->beginTransaction();

    $clearActivations = $pdo->prepare("
    UPDATE aktivizo
    SET tv_internet_package_id=NULL
    WHERE tv_internet_package_id=?
    ");

    $clearActivations->execute([$id]);

    $deletePackage = $pdo->prepare("
    DELETE FROM tv_internet_packages
    WHERE id=?
    ");

    $deletePackage->execute([$id]);

    $pdo->commit();
}

header("Location: tv-admin.php");
exit();

?>
