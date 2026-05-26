<?php

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

header('Content-Type: application/json');

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    echo json_encode([
        "success" => false,
        "message" => "Nuk ke qasje."
    ]);
    exit();
}

$id = $_POST['id'] ?? '';
$type = $_POST['type'] ?? '';

if(!ctype_digit($id)){
    echo json_encode([
        "success" => false,
        "message" => "ID nuk eshte valid."
    ]);
    exit();
}

try{

    if($type == 'tv'){

        $pdo->beginTransaction();

        $pdo->prepare("
            DELETE FROM permbajtja
            WHERE tv_package_id=?
        ")->execute([$id]);

        $pdo->prepare("
            UPDATE aktivizo
            SET tv_package_id=NULL
            WHERE tv_package_id=?
        ")->execute([$id]);

        $pdo->prepare("
            DELETE FROM tv_packages
            WHERE id=?
        ")->execute([$id]);

        $pdo->commit();

    }elseif($type == 'tv_internet'){

        $pdo->beginTransaction();

        $pdo->prepare("
            UPDATE aktivizo
            SET tv_internet_package_id=NULL
            WHERE tv_internet_package_id=?
        ")->execute([$id]);

        $pdo->prepare("
            DELETE FROM tv_internet_packages
            WHERE id=?
        ")->execute([$id]);

        $pdo->commit();

    }else{

        echo json_encode([
            "success" => false,
            "message" => "Tipi nuk eshte valid."
        ]);
        exit();
    }

    echo json_encode([
        "success" => true
    ]);

}catch(Exception $e){

    $pdo->rollBack();

    echo json_encode([
        "success" => false,
        "message" => "Gabim gjate fshirjes."
    ]);
}