<?php

$pageCSS = "telefona.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';


// ROUTERAT NGA DATABASE

$stmt = $pdo->prepare("
    SELECT *
    FROM eshop_products
    WHERE category = ?
");

$stmt->execute(['router']);

$routerat = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- MAIN CONTENT -->

<main class="main">

    <section class="products">

        <div class="container">

            <h2 class="section-title">
                Routera
            </h2>

            <div class="product-grid">

                <?php foreach($routerat as $router): ?>

                <div class="product-item">

                    <img
                        src="<?php echo htmlspecialchars($router['image']); ?>"
                        alt="<?php echo htmlspecialchars($router['product_name']); ?>"
                    >

                    <h3>
                        <?php echo htmlspecialchars($router['product_name']); ?>
                    </h3>

                    <p class="product-price">
                        <?php echo htmlspecialchars($router['price']); ?>€
                    </p>

                    <a
                        href="pages/pagesa.php?id=<?php echo $router['id']; ?>"
                        class="btn btn-primary"
                    >
                        Bleje tani
                    </a>

                </div>

                <?php endforeach; ?>

            </div>

        </div>

    </section>

</main>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
?>