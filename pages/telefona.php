<?php
$pageCSS = "telefona.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/navbar.php';

// Array e telefonave me sorting by price
$phones = [
    ["name" => "Samsung Galaxy A55", "price" => 499, "image" => "assets/images/phones/galaxyA55.jpg"],
    ["name" => "Xiaomi 17", "price" => 549, "image" => "assets/images/phones/xiaomi17.jpg"],
    ["name" => "Xiaomi 14", "price" => 699, "image" => "assets/images/phones/xiamoi14.jpg"],
    ["name" => "iPhone 13", "price" => 699, "image" => "assets/images/phones/iphone13.webp"],
    ["name" => "Samsung Galaxy A54", "price" => 679, "image" => "assets/images/phones/samsung_galaxy_a54.jpg"],
    ["name" => "Samsung Galaxy Z Flip5", "price" => 749, "image" => "assets/images/phones/samsung_galxy_z_flip5.jpg"],
    ["name" => "Google Pixel 8", "price" => 799, "image" => "assets/images/phones/googlepixel8.jpg"],
    ["name" => "iPhone 16", "price" => 849, "image" => "assets/images/phones/iphone16.webp"],
    ["name" => "Samsung Galaxy A32", "price" => 829, "image" => "assets/images/phones/Samsung_galaxy_a32.jpg"],
    ["name" => "Samsung Galaxy S23 Ultra", "price" => 899, "image" => "assets/images/phones/s23ultra.jpg"],
    ["name" => "iPhone 15", "price" => 899, "image" => "assets/images/phones/iphone15.webp"],
    ["name" => "iPhone 17 Pro Max (Orange)", "price" => 999, "image" => "assets/images/phones/iphone17.webp"],
    ["name" => "iPhone 15 Pro", "price" => 1149, "image" => "assets/images/phones/iphone15pro.jpg"],
    ["name" => "Samsung Galaxy S24 Ultra", "price" => 1199, "image" => "assets/images/phones/samsung_galaxy_s24_ultra.png"],
    ["name" => "iPhone 17 Pro Max (Silver)", "price" => 1299, "image" => "assets/images/phones/iphone17promax.webp"],
];

// SORT SIPAS CMIMIT - ASC
usort($phones, function($a, $b) {
    return $a['price'] - $b['price'];
});
?>

  <!-- MAIN CONTENT -->
  <main class="main">
    <section class="products">
      <div class="container">
        <h2 class="section-title">Telefona (Renditur sipas çmimit)</h2>
        <div class="product-grid">

          <!-- Loop përmes telefonave të sortuar -->
          <?php foreach ($phones as $phone): ?>
          <div class="product-item">
            <img src="<?php echo htmlspecialchars($phone['image']); ?>" alt="<?php echo htmlspecialchars($phone['name']); ?>">
            <h3><?php echo htmlspecialchars($phone['name']); ?></h3>
            <p class="product-price"><?php echo number_format($phone['price'], 0); ?>€</p>
            <a href="pages/pagesa.php" class="btn btn-primary">Bleje tani</a>
          </div>
          <?php endforeach; ?>

      </div>
      </div>
    </section>
  </main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>