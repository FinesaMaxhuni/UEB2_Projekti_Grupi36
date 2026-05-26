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

$stmt->execute(['telefon']);

$telefonat = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- MAIN CONTENT -->
<main class="main">
  <section class="products">
    <div class="container">
      <h2 class="section-title">Telefona</h2>

      <div class="product-grid">

        <!-- Produktet -->
         <?php foreach($telefonat as $telefon): ?>

<div class="product-item">

    <img
        src="<?php echo htmlspecialchars($telefon['image']); ?>"
        alt="<?php echo htmlspecialchars($telefon['product_name']); ?>"
    >

    <h3>
        <?php echo htmlspecialchars($telefon['product_name']); ?>
    </h3>

    <p class="product-price">
        <?php echo htmlspecialchars($telefon['price']); ?>€
    </p>

    <a
        href="pages/pagesa.php?id=<?php echo $telefon['id']; ?>"
        class="btn btn-primary"
    >
        Bleje tani
    </a>

</div>

<?php endforeach; ?>
    </div>
  </section>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>