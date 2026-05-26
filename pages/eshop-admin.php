<?php

$pageCSS = "eshop-admin.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

// TELEFONA TOTAL
$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM eshop_products
    WHERE category = ?
    
");

$stmt->execute(['telefon']);

$totalTelefona = $stmt->fetchColumn();


// LAPTOPA TOTAL
$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM eshop_products
    WHERE category = ?
    
");

$stmt->execute(['laptop']);

$totalLaptopa = $stmt->fetchColumn();


// ROUTERA TOTAL
$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM eshop_products
    WHERE category = ?
    
");

$stmt->execute(['router']);

$totalRoutera = $stmt->fetchColumn();


// TV TOTAL
$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM eshop_products
    WHERE category = ?
");

$stmt->execute(['tv']);

$totalTV = $stmt->fetchColumn();


// ======================
// 5 TELEFONAT
// ======================

$stmt = $pdo->prepare("
    SELECT product_name, price
    FROM eshop_products
    WHERE category = ?
    LIMIT 5
");

$stmt->execute(['telefon']);

$telefonat = $stmt->fetchAll(PDO::FETCH_ASSOC);


// ======================
// 5 LAPTOPAT
// ======================

$stmt = $pdo->prepare("
    SELECT product_name, price
    FROM eshop_products
    WHERE category = ?
    LIMIT 5
");

$stmt->execute(['laptop']);

$laptopat = $stmt->fetchAll(PDO::FETCH_ASSOC);


// ======================
// 5 ROUTERAT
// ======================

$stmt = $pdo->prepare("
    SELECT product_name, price
    FROM eshop_products
    WHERE category = ?
    LIMIT 5
");

$stmt->execute(['router']);

$routerat = $stmt->fetchAll(PDO::FETCH_ASSOC);


// ======================
// 5 TV
// ======================

$stmt = $pdo->prepare("
    SELECT product_name, price
    FROM eshop_products
    WHERE category = ?
    LIMIT 5
");

$stmt->execute(['tv']);

$tv = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<main class="eshop-admin">

<section class="top-header">

    <div class="header-left">
        <h1>E-Shop</h1>
        <p>Menaxho produktet e dyqanit</p>
    </div>

    <a href="#" class="add-product-btn">
        + Shto Produkt
    </a>

</section>

    <!-- STATISTIKAT -->

    <div class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon blue">
            📱
        </div>

        <div class="stat-info">
            <h3>Telefona Total</h3>

            <div class="stat-bottom">
<span class="stat-number">
    <?php echo $totalTelefona; ?>
</span>
    
            </div>
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon green">
            💻
        </div>

        <div class="stat-info">
            <h3>Laptopa Total</h3>

            <div class="stat-bottom">
            <span class="stat-number">
    <?php echo $totalLaptopa; ?>
</span>

            </div>
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon purple">
            📶
        </div>

        <div class="stat-info">
            <h3>Routera Total</h3>

            <div class="stat-bottom">
              <span class="stat-number">
    <?php echo $totalRoutera; ?>
</span>

            </div>
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon orange">
            📺
        </div>

        <div class="stat-info">
            <h3>Televizora Total</h3>

            <div class="stat-bottom">
               <span class="stat-number">
    <?php echo $totalTV; ?>
</span>

            </div>
        </div>

    </div>

</div>

</div>

    </section>

    <!-- PRODUKTET -->

    <section class="products-grid">

        <!-- TELEFONA -->

        <div class="product-box">

            <div class="box-header">
                <h2>📱 Telefona</h2>
                <p>Menaxho telefonat</p>
            </div>

             <div class="product-list">

    <?php foreach($telefonat as $telefon): ?>

        <div class="product-item">

            <span>
                <?php echo htmlspecialchars($telefon['product_name']); ?>
            </span>

            <strong>
                <?php echo htmlspecialchars($telefon['price']); ?>€
            </strong>

        </div>

    <?php endforeach; ?>

</div>

            <a href="/UEB2_Projekti_Grupi36/pages/telefona.php" class="show-more">
                Shiko të gjitha telefonat →
            </a>

        </div>

        <!-- LAPTOPA -->

        <div class="product-box">

            <div class="box-header">
                <h2>💻 Laptopa</h2>
                <p>Menaxho laptopët</p>
            </div>

            <div class="product-list">

    <?php foreach($laptopat as $laptop): ?>

        <div class="product-item">

            <span>
                <?php echo htmlspecialchars($laptop['product_name']); ?>
            </span>

            <strong>
                <?php echo htmlspecialchars($laptop['price']); ?>€
            </strong>

        </div>

    <?php endforeach; ?>

</div>

            <a href="/UEB2_Projekti_Grupi36/pages/laptopa.php" class="show-more">
                Shiko të gjitha laptopët →
            </a>

        </div>

        <!-- ROUTERA -->

        <div class="product-box">

            <div class="box-header">
                <h2>📶 Routera</h2>
                <p>Menaxho routerat</p>
            </div>

            <div class="product-list">

    <?php foreach($routerat as $router): ?>

        <div class="product-item">

            <span>
                <?php echo htmlspecialchars($router['product_name']); ?>
            </span>

            <strong>
                <?php echo htmlspecialchars($router['price']); ?>€
            </strong>

        </div>

    <?php endforeach; ?>

</div>

            <a href="/UEB2_Projekti_Grupi36/pages/routera.php" class="show-more">
                Shiko të gjitha routerat →
            </a>

        </div>

        <!-- TELEVIZORA -->

        <div class="product-box">

            <div class="box-header">
                <h2>📺 Televizora</h2>
                <p>Menaxho televizorët</p>
            </div>

            <div class="product-list">

    <?php foreach($tv as $televizor): ?>

        <div class="product-item">

            <span>
                <?php echo htmlspecialchars($televizor['product_name']); ?>
            </span>

            <strong>
                <?php echo htmlspecialchars($televizor['price']); ?>€
            </strong>

        </div>

    <?php endforeach; ?>

</div>

            <a href="/UEB2_Projekti_Grupi36/pages/televizora.php" class="show-more">
                Shiko të gjitha televizorët →
            </a>

        </div>

    </section>

    <!-- MENAXHO BLERJET -->

    <section class="orders-section">

        <div class="section-title">
            <h2>Menaxho Blerjet</h2>
            <p>Lista e të gjitha blerjeve të klientëve</p>
        </div>

        <div class="table-container">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Klienti</th>
                        <th>Produkti</th>
                        <th>Kategoria</th>
                        <th>Çmimi</th>
                        <th>Sasia</th>
                        <th>Data e Blerjes</th>
                        <th>Veprimet</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>#1025</td>
                        <td>Finesa Maxhuni</td>
                        <td>iPhone 15</td>
                        <td>Telefona</td>
                        <td>899€</td>
                        <td>1</td>
                        <td>20/05/2025</td>
                        <td>
                            <button class="view-btn">👁</button>
                        </td>
                    </tr>

                    <tr>
                        <td>#1024</td>
                        <td>Arben Krasniqi</td>
                        <td>MacBook Air M2</td>
                        <td>Laptopa</td>
                        <td>1399€</td>
                        <td>1</td>
                        <td>19/05/2025</td>
                        <td>
                        <td>
                            <button class="view-btn">👁</button>
                        </td>
                    </tr>

                    <tr>
                        <td>#1023</td>
                        <td>Elira Gashi</td>
                        <td>TP-Link Archer</td>
                        <td>Routera</td>
                        <td>119€</td>
                        <td>2</td>
                        <td>18/05/2025</td>
                        <td>
                            <button class="view-btn">👁</button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </section>

</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>