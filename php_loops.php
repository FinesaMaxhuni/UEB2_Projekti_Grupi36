<?php
/**
 * PHP Loops - NetWave Implementim
 * for, while, do-while, foreach
 */

// ========== FOR LOOP ==========
// Përdorim në Loops
function printForLoop() {
    echo "For Loop - Numra 1 deri 10:<br>";
    for ($i = 1; $i <= 10; $i++) {
        echo $i . " ";
    }
}

// ========== WHILE LOOP ==========
function printWhileLoop() {
    echo "<br><br>While Loop - Numra 1 deri 5:<br>";
    $i = 1;
    while ($i <= 5) {
        echo $i . " ";
        $i++;
    }
}

// ========== DO-WHILE LOOP ==========
function printDoWhileLoop() {
    echo "<br><br>Do-While Loop - Numra 1 deri 3:<br>";
    $i = 1;
    do {
        echo $i . " ";
        $i++;
    } while ($i <= 3);
}

// ========== FOREACH LOOP - NUMERIC ARRAY ==========
function displayChannels($channels) {
    echo "<br><br>Foreach Loop - Kanalet:<br>";
    echo "<ul>";
    foreach ($channels as $channel) {
        echo "<li>" . htmlspecialchars($channel) . "</li>";
    }
    echo "</ul>";
}

// ========== FOREACH LOOP - ASSOCIATIVE ARRAY ==========
function displayProductInfo($product) {
    echo "<br><br>Foreach Loop - Produkti:<br>";
    foreach ($product as $key => $value) {
        echo $key . ": " . htmlspecialchars($value) . "<br>";
    }
}

// ========== FOREACH LOOP - MULTIDIMENSIONAL ARRAY ==========
function displayProductsList($products) {
    echo "<br><br>Foreach Loop - Lista Produktesh:<br>";
    echo "<table border='1'>";
    echo "<tr><th>Emri</th><th>Çmimi</th></tr>";
    
    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($product['name']) . "</td>";
        echo "<td>" . number_format($product['price'], 0) . "€</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

// ========== LOOP ME BREAK ==========
function loopWithBreak() {
    echo "<br><br>Loop me Break (ndalo në 5):<br>";
    for ($i = 1; $i <= 10; $i++) {
        if ($i === 5) break;
        echo $i . " ";
    }
}

// ========== LOOP ME CONTINUE ==========
function loopWithContinue() {
    echo "<br><br>Loop me Continue (kapërceje 3):<br>";
    for ($i = 1; $i <= 5; $i++) {
        if ($i === 3) continue;
        echo $i . " ";
    }
}

// Shembuj për përdorim
$channels = ["HBO", "Netflix", "Disney+"];
$product = ["name" => "iPhone 17", "price" => 999, "stock" => 15];
$products = [
    ["name" => "iPhone 17", "price" => 999],
    ["name" => "Samsung S24", "price" => 899],
    ["name" => "MacBook Air", "price" => 1399]
];

// printForLoop();
// printWhileLoop();
// printDoWhileLoop();
// displayChannels($channels);
// displayProductInfo($product);
// displayProductsList($products);
// loopWithBreak();
// loopWithContinue();

?>
