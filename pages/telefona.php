<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$pageCSS = "telefona.css";

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/navbar.php';

require_once __DIR__ . '/../classes/Telefoni.php';
require_once __DIR__ . '/../classes/MenaxheriProdukteve.php';

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
 //variabla globale
$GLOBALS['monedha'] = "€";
$GLOBALS['tvsh'] = 0.18;

// 2 numeric arrays
$kategorite = ["Telefona", "Smartphone", "5G", "Premium"];
$zbritjet = [5, 10, 15, 20];

// 2 funksione
function shfaqCmimin($cmimi) {
    return number_format($cmimi, 0) . $GLOBALS['monedha'];
}

function cmimiMeTVSH($cmimi) {
    return $cmimi + ($cmimi * $GLOBALS['tvsh']);
}

//  2 kushte
function kontrolloProduktin($cmimi) {
    if ($cmimi >= 1000) {
        return "Premium";
    } else {
        return "Standard";
    }
}

function kontrolloZbritjen($cmimi) {
    if ($cmimi >= 900) {
        return "Ka zbritje speciale";
    } else {
        return "Pa zbritje";
    }
}
// SORT SIPAS CMIMIT - ASC
usort($phones, function($a, $b) {
    return $a['price'] - $b['price'];
});

// KËRKESA OOP: krijimi i objekteve nga array ekzistues
$objekteTelefona = [];

foreach ($phones as $p) {
    $marka = explode(" ", $p['name'])[0];

    $objekteTelefona[] = new Telefoni(
        $p['name'],
        $p['price'],
        $p['image'],
        $marka
    );
}

// KËRKESA OOP: përdorim i klasës ndihmëse për analiza
$meILire = MenaxheriProdukteve::produktiMeILire($objekteTelefona);
$meIShtrenjte = MenaxheriProdukteve::produktiMeIShtrenjte($objekteTelefona);
$cmimiMesatar = MenaxheriProdukteve::cmimiMesatar($objekteTelefona);
?>

<main class="main">

  <!-- ANALIZA OOP -->
  <section style="background:linear-gradient(135deg,#0a1929,#1a2845); padding:40px 0; color:white;">
    <div class="container">
      <h2 style="text-align:center; margin-bottom:30px;">Analizë e Produkteve</h2>

      <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:20px;">

        <div style="background:rgba(255,255,255,0.08); padding:25px; border-radius:15px; text-align:center;">
          <h3>Produkti më i lirë</h3>
          <p style="font-size:20px; color:#60a5fa;">
            <?php echo htmlspecialchars($meILire->getEmri()); ?>
          </p>
          <strong><?php echo number_format($meILire->getCmimi(), 0); ?>€</strong>
        </div>

        <div style="background:rgba(255,255,255,0.08); padding:25px; border-radius:15px; text-align:center;">
          <h3>Produkti më i shtrenjtë</h3>
          <p style="font-size:20px; color:#60a5fa;">
            <?php echo htmlspecialchars($meIShtrenjte->getEmri()); ?>
          </p>
          <strong><?php echo number_format($meIShtrenjte->getCmimi(), 0); ?>€</strong>
        </div>

        <div style="background:rgba(255,255,255,0.08); padding:25px; border-radius:15px; text-align:center;">
          <h3>Çmimi mesatar</h3>
          <p style="font-size:28px; color:#22c55e;">
            <?php echo number_format($cmimiMesatar, 2); ?>€
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <section class="products">
    <div class="container">
      <h2 class="section-title">Telefona (Renditur sipas çmimit)</h2>

      <div class="product-grid">
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

<?php require __DIR__ . '/../includes/footer.php'; ?>