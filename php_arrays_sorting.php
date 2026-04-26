<?php
/**
 * PHP Arrays & Sorting - NetWave Implementim
 * Shfaq përdorimin e vargjeve dhe sortimit në faqet e produkteve
 */

// ========== NUMERIC ARRAYS ==========
$channels = [
    "Premier League HD",
    "La Liga HD",
    "Serie A HD",
    "HBO Max",
    "Netflix"
];

// ========== ASSOCIATIVE ARRAYS ==========
$phone = [
    "name" => "iPhone 17 Pro Max",
    "price" => 999,
    "category" => "Telefona",
    "stock" => 15
];

// ========== MULTIDIMENSIONAL ARRAYS (Phonet) ==========
$phones = [
    ["name" => "Samsung Galaxy A55", "price" => 499, "image" => "assets/images/phones/galaxyA55.jpg"],
    ["name" => "Xiaomi 17", "price" => 549, "image" => "assets/images/phones/xiaomi17.jpg"],
    ["name" => "iPhone 17 Pro Max (Orange)", "price" => 999, "image" => "assets/images/phones/iphone17.webp"],
];

// ========== MULTIDIMENSIONAL ARRAYS (Laptopa) ==========
$laptops = [
    ["name" => "HP Pavilion 15", "price" => 749, "image" => "assets/images/laptopa/hp_pavilion.jpg"],
    ["name" => "Dell XPS 13", "price" => 1299, "image" => "assets/images/laptopa/dell_xps_13.jpg"],
    ["name" => "MacBook Pro M3", "price" => 1999, "image" => "assets/images/laptopa/macbook_pro.jpeg"],
];

// ========== MULTIDIMENSIONAL ARRAYS (Televizora) ==========
$tvs = [
    ["name" => "Xiaomi TV P1 55\"", "price" => 699, "image" => "assets/images/televizora/xiaomi_tv.jpg"],
    ["name" => "Samsung QLED 65\"", "price" => 1299, "image" => "assets/images/televizora/samsunng1.jpg"],
    ["name" => "TCL QD-Mini LED 75\"", "price" => 1599, "image" => "assets/images/televizora/tcl_mini.jpg"],
];

// ========== MULTIDIMENSIONAL ARRAYS (Routera) ==========
$routers = [
    ["name" => "Tenda AC10U Smart Dual Band", "price" => 69, "image" => "assets/images/routera/tenda_ac10U.webp"],
    ["name" => "TP-Link Archer AX1800", "price" => 119, "image" => "assets/images/routera/tp_link_archer.jpg"],
    ["name" => "Netgear Orbi RBKE963 Mesh", "price" => 999, "image" => "assets/images/routera/netgear_orbi.jpg"],
];

// ========== SORTING SIPAS CMIMIT ==========

// SORT TELEFONA - usort (numeric array keys)
usort($phones, function($a, $b) {
    return $a['price'] - $b['price'];
    // Rezultat: 499 -> 549 -> 999
});

// SORT LAPTOPA - usort
usort($laptops, function($a, $b) {
    return $a['price'] - $b['price'];
    // Rezultat: 749 -> 1299 -> 1999
});

// SORT TELEVIZORA - usort
usort($tvs, function($a, $b) {
    return $a['price'] - $b['price'];
    // Rezultat: 699 -> 1299 -> 1599
});

// SORT ROUTERA - usort
usort($routers, function($a, $b) {
    return $a['price'] - $b['price'];
    // Rezultat: 69 -> 119 -> 999
});

// ========== SHFAQJA ME FOREACH LOOPS ==========

function displayProducts($products, $category) {
    echo "<h2>$category (Renditur sipas çmimit):</h2>";
    echo "<ul>";
    
    foreach ($products as $product) {
        echo "<li>" . htmlspecialchars($product['name']) . " - " . number_format($product['price'], 0) . "€</li>";
    }
    
    echo "</ul>";
}

// Shembuj përdorimi:
// displayProducts($phones, "Telefona");
// displayProducts($laptops, "Laptopa");
// displayProducts($tvs, "Televizora");
// displayProducts($routers, "Routera");

?>
