<?php
$pageCSS = "telefona.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

$stmt = $pdo->prepare("
    SELECT *
    FROM eshop_products
    WHERE category = ?
");

$stmt->execute(['tv']);

$televizorat = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- MAIN CONTENT -->
<main class="main">

    <section class="products">

        <div class="container">

            <h2 class="section-title">Televizorë</h2>

            <div class="product-grid">

                <?php foreach($televizorat as $tv): ?>

                <div class="product-item">

                    <img
                        src="/UEB2_Projekti_Grupi36/<?php echo htmlspecialchars($tv['image']); ?>"
                        alt="<?php echo htmlspecialchars($tv['product_name']); ?>"
                    >

                    <h3>
                        <?php echo htmlspecialchars($tv['product_name']); ?>
                    </h3>

                    <p class="product-price">
                        <?php echo htmlspecialchars($tv['price']); ?>€
                    </p>

                    <a
                        href="/UEB2_Projekti_Grupi36/pages/pagesa.php?id=<?php echo $tv['id']; ?>"
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