<?php
$pageCSS = "telefona.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/navbar.php';

// Array e laptopëve me sorting by price
$laptops = [
    ["name" => "HP Pavilion 15", "price" => 749, "image" => "assets/images/laptopa/hp_pavilion.jpg"],
    ["name" => "Dell Inspiron 14", "price" => 799, "image" => "assets/images/laptopa/dell_inspiron.jpg"],
    ["name" => "Lenovo IdeaPad 5", "price" => 849, "image" => "assets/images/laptopa/lenovo_idepad.jpg"],
    ["name" => "Acer Swift 5", "price" => 899, "image" => "assets/images/laptopa/acer_swift.jpg"],
    ["name" => "ASUS TUF Gaming F15", "price" => 1099, "image" => "assets/images/laptopa/asus_tuf_gaming.jpg"],
    ["name" => "Acer Nitro 5", "price" => 999, "image" => "assets/images/laptopa/acer_nitro.jpg"],
    ["name" => "HP Spectre x360", "price" => 1249, "image" => "assets/images/laptopa/hp_spectre1.jpg"],
    ["name" => "Dell XPS 13", "price" => 1299, "image" => "assets/images/laptopa/dell_xps_13.jpg"],
    ["name" => "MacBook Air M2", "price" => 1399, "image" => "assets/images/laptopa/macbook_air.webp"],
    ["name" => "Lenovo ThinkPad X1 Carbon", "price" => 1399, "image" => "assets/images/laptopa/lenovo_idepad.jpg"],
    ["name" => "MSI GS66 Stealth", "price" => 1499, "image" => "assets/images/laptopa/msi_gs66_stealth.jpg"],
    ["name" => "Lenovo Legion 7", "price" => 1599, "image" => "assets/images/laptopa/lenovo_legion7.avif"],
    ["name" => "ASUS ROG Zephyrus G14", "price" => 1799, "image" => "assets/images/laptopa/asus_rog_zephyrus.jpg"],
    ["name" => "MacBook Pro M3", "price" => 1999, "image" => "assets/images/laptopa/macbook_pro.jpeg"],
];

// SORT SIPAS CMIMIT - ASC
usort($laptops, function($a, $b) {
    return $a['price'] - $b['price'];
});
?>

  <!-- MAIN CONTENT -->
  <main class="main">
    <section class="products">
      <div class="container">
        <h2 class="section-title">Laptopë (Renditur sipas çmimit)</h2>
        <div class="product-grid">

          <!-- Loop përmes laptopëve të sortuar -->
          <?php foreach ($laptops as $laptop): ?>
          <div class="product-item">
            <img src="<?php echo htmlspecialchars($laptop['image']); ?>" alt="<?php echo htmlspecialchars($laptop['name']); ?>">
            <h3><?php echo htmlspecialchars($laptop['name']); ?></h3>
            <p class="product-price"><?php echo number_format($laptop['price'], 0); ?>€</p>
            <a href="pages/pagesa.php" class="btn btn-primary">Bleje tani</a>
          </div>
          <?php endforeach; ?>

        </div>
      </div>
    </section>
  </main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>