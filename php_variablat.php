<?php
/**
 * PHP Variablat - NetWave
 * Përfshin: Variabla globale, lokale dhe scope
 */

// VARIABLA GLOBALE
$companyName = "NetWave";
$baseUrl = "http://localhost/UEB1_Projekti_Grupi19";
$yearFounded = 2025;

// Funksion me variabla LOKALE
function calculateDiscount($price, $discountPercent) {
    // $discountAmount është variabla LOKALE (ekziston vetëm në këtë funksion)
    $discountAmount = ($price * $discountPercent) / 100;
    $finalPrice = $price - $discountAmount;
    return $finalPrice;
}

// Shembull përdorimi
function getUserInfo($firstName, $lastName) {
    // $fullName është variabla LOKALE
    $fullName = $firstName . " " . $lastName;
    return $fullName;
}

?>
