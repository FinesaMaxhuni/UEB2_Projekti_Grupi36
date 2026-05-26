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

// ======================
// BLERJET
// ======================

$stmt = $pdo->prepare("
    SELECT 
        orders.id,
        orders.fullname,
        orders.quantity,
        orders.created_at,

        eshop_products.product_name,
        eshop_products.category,
        eshop_products.price

    FROM orders

    INNER JOIN eshop_products
    ON orders.product_id = eshop_products.id

    ORDER BY orders.created_at DESC
");

$stmt->execute();

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ======================
// FSHI POROSINE
// ======================

if(isset($_GET['delete_order'])){

    $order_id = $_GET['delete_order'];

    $stmt = $pdo->prepare("
        DELETE FROM orders
        WHERE id = ?
    ");

    $stmt->execute([$order_id]);

    header("Location: eshop-admin.php");

    exit();
}


// ======================
// FSHI PRODUKTIN
// ======================

if(isset($_GET['delete_product'])){

    $product_id = $_GET['delete_product'];

    $stmt = $pdo->prepare("
        DELETE FROM eshop_products
        WHERE id = ?
    ");

    $stmt->execute([$product_id]);

    header("Location: eshop-admin.php");

    exit();
}

$stmt = $pdo->prepare("
    SELECT *
    FROM eshop_products
");

$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<main class="eshop-admin">

<section class="top-header">

    <div class="header-left">
        <h1>E-Shop</h1>
        <p>Menaxho produktet e dyqanit</p>
    </div>

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

<?php foreach($orders as $order): ?>

<tr>

    <td>
        #<?php echo htmlspecialchars($order['id']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($order['fullname']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($order['product_name']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($order['category']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($order['price']); ?>€
    </td>

    <td>
        <?php echo htmlspecialchars($order['quantity']); ?>
    </td>

    <td>
        <?php echo date(
            "d/m/Y",
            strtotime($order['created_at'])
        ); ?>
    </td>

   <td>

    <a
        href="/UEB2_Projekti_Grupi36/pages/eshop-admin.php?delete_order=<?php echo $order['id']; ?>"
        onclick="return confirm('A dëshiron ta anulosh porosinë?');"
        class="cancel-order-btn"
    >
        Anulo Porosinë
    </a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

            </table>

        </div>

    </section>

    <!-- MENAXHO PRODUKTET -->

<section class="manage-products-section">

    <div class="products-header">

        <div>
            <h2>Menaxho Produktet</h2>
            <p>Lista e të gjitha produkteve në webshop</p>
        </div>

            <a
href="/UEB2_Projekti_Grupi36/pages/add-product.php"
class="add-product-btn"
>
            + Shto Produkt
        </a>

    </div>

    <div class="products-table-container">

        <table class="products-table">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Produkti</th>
                    <th>Kategoria</th>
                    <th>Çmimi</th>
                    <th>Përshkrimi</th>
                    <th>Veprimet</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach($products as $product): ?>

                <tr>

                    <td>
                        #<?php echo $product['id']; ?>
                    </td>

                    <td class="product-info">

                        <img
                            src="<?php echo htmlspecialchars($product['image']); ?>"
                            alt=""
                        >

                        <span>
                            <?php echo htmlspecialchars($product['product_name']); ?>
                        </span>

                    </td>

                    <td>
                        <?php echo htmlspecialchars($product['category']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($product['price']); ?>€
                    </td>

                    <td class="description-cell">
                        <?php echo htmlspecialchars($product['description']); ?>
                    </td>

                    <td class="action-buttons">

                        <a
    href="/UEB2_Projekti_Grupi36/pages/edit-product.php?id=<?php echo $product['id']; ?>"
    class="edit-btn"
>
    Edito
</a>

                        <a
                            href="/UEB2_Projekti_Grupi36/pages/eshop-admin.php?delete_product=<?php echo $product['id']; ?>"
                            class="delete-btn"
                            onclick="return confirm('A dëshironi ta fshini produktin?');"
                        >
                            Fshi
                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</section>

</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>