<?php
/**
 * PHP Konceptet - NetWave
 * 1. Variablat (globale, lokale)
 * 2. Funksionet
 * 3. Loops
 * 4. Arrays (numeric, associative, multidimensional)
 * 5. Sorting
 */

// ========== 1. VARIABLAT ==========
// Variabla globale
$companyName = "NetWave";
$baseUrl = "http://localhost/UEB1_Projekti_Grupi19";

// Funksion me variabla lokale
function calculateDiscount($price, $discountPercent) {
    // $discountAmount - variabla lokale
    $discountAmount = ($price * $discountPercent) / 100;
    $finalPrice = $price - $discountAmount;
    return $finalPrice;
}

// ========== 2. FUNKSIONET ==========
// Validim email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
}

// Validim telefon
function validatePhone($phone) {
    return preg_match('/^[0-9]{9,}$/', preg_replace('/[^0-9]/', '', $phone)) ? true : false;
}

// Format price
function formatPrice($price) {
    return number_format($price, 2) . "€";
}

// ========== 3. LOOPS & ARRAYS ==========

// NUMERIC ARRAY - Lista e kanaleve
$channels = [
    "Premier League HD",
    "La Liga HD",
    "Serie A HD",
    "HBO Max",
    "Netflix",
    "Disney+"
];

// Loop me foreach
function displayChannels($channels) {
    echo "<ul>";
    foreach ($channels as $channel) {
        echo "<li>✓ " . htmlspecialchars($channel) . "</li>";
    }
    echo "</ul>";
}

// Loop me for
function printNumbersForLoop($max) {
    for ($i = 1; $i <= $max; $i++) {
        echo "$i ";
    }
}

// Loop me while
function printWhileLoop($start, $end) {
    $i = $start;
    while ($i <= $end) {
        echo "$i ";
        $i++;
    }
}

// ========== 4. ASSOCIATIVE ARRAYS ==========

// Produktet me të dhënat
$products = [
    1 => [
        "name" => "iPhone 17 Pro Max",
        "price" => 999,
        "category" => "Telefona",
        "stock" => 15
    ],
    2 => [
        "name" => "MacBook Air M2",
        "price" => 1399,
        "category" => "Laptopë",
        "stock" => 8
    ],
    3 => [
        "name" => "Samsung QLED 65\"",
        "price" => 1299,
        "category" => "Televizorë",
        "stock" => 12
    ]
];

// MULTIDIMENSIONAL ARRAY - Paketa me kanalet
$packages = [
    "economy" => [
        "name" => "TV Economy",
        "price" => 8.90,
        "channels" => 90,
        "features" => ["HD", "Kombëtare", "Lajme 24/7"]
    ],
    "premium" => [
        "name" => "TV Premium",
        "price" => 15.50,
        "channels" => 150,
        "features" => ["HD/4K", "Filma Premium", "Dokumentarë"]
    ],
    "sport" => [
        "name" => "TV Sport",
        "price" => 23.90,
        "channels" => 200,
        "features" => ["Premier League", "Champions League", "UFC"]
    ]
];

// ========== 5. SORTING ==========

// Rendit produktet sipas çmimit (ascending)
function sortProductsByPrice($products) {
    usort($products, function($a, $b) {
        return $a['price'] - $b['price'];
    });
    return $products;
}

// Rendit sipas zgjidhjeve (descending)
function sortByChoices($items) {
    rsort($items);
    return $items;
}

// Rendit array associative sipas key
function sortPackagesByPrice($packages) {
    uasort($packages, function($a, $b) {
        return $a['price'] - $b['price'];
    });
    return $packages;
}

// ========== FUNKSIONE NDIHMESE ==========

// Shfaq produktet me loop
function displayProducts($products) {
    foreach ($products as $id => $product) {
        echo "<div class='product-summary'>";
        echo "<strong>" . htmlspecialchars($product['name']) . "</strong> - ";
        echo formatPrice($product['price']);
        echo " (Stock: " . $product['stock'] . ")";
        echo "</div>";
    }
}

// Shfaq paketa
function displayPackages($packages) {
    foreach ($packages as $key => $package) {
        echo "<div class='package-summary'>";
        echo "<h4>" . htmlspecialchars($package['name']) . "</h4>";
        echo "Çmim: " . formatPrice($package['price']) . "<br>";
        echo "Kanale: " . $package['channels'] . "<br>";
        echo "</div>";
    }
}

?>
