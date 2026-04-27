<?php
$pageCSS = "telefona.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/navbar.php';

// Array e routerave me sorting by price
$routers = [
    ["name" => "Tenda AC10U Smart Dual Band", "price" => 69, "image" => "assets/images/routera/tenda_ac10U.webp"],
    ["name" => "Netis AC1200 Dual Band", "price" => 79, "image" => "assets/images/routera/netis.webp"],
    ["name" => "Huawei WiFi AX3", "price" => 89, "image" => "assets/images/routera/huawei_ax3.jpg"],
    ["name" => "D-Link DIR-2150 AC2100", "price" => 99, "image" => "assets/images/routera/d_link_dir.jpg"],
    ["name" => "TP-Link Archer AX1800", "price" => 119, "image" => "assets/images/routera/tp_link_archer.jpg"],
    ["name" => "Linksys MR7350 WiFi 6", "price" => 139, "image" => "assets/images/routera/linksys_mr7350.jpg"],
    ["name" => "Xiaomi Mi Router AX3200", "price" => 129, "image" => "assets/images/routera/xiaomi_mi.jpg"],
    ["name" => "TP-Link Archer AX5400", "price" => 189, "image" => "assets/images/routera/tp-link_archer_ax54000.jpg"],
    ["name" => "ASUS RT-AX86U Dual Band", "price" => 229, "image" => "assets/images/routera/asus_rt_ax86U.jpg"],
    ["name" => "TP-Link Deco X20 Mesh WiFi 6", "price" => 249, "image" => "assets/images/routera/tp_link_deco.jpg"],
    ["name" => "ASUS RT-AX88U WiFi 6", "price" => 249, "image" => "assets/images/routera/asus_rt_ax888u_wifi6.webp"],
    ["name" => "Netgear Nighthawk RAX120", "price" => 299, "image" => "assets/images/routera/netgear_nighthawk_rax120.png"],
    ["name" => "Huawei 5G CPE Pro", "price" => 349, "image" => "assets/images/routera/huawei_5g_cpe.jpg"],
    ["name" => "ASUS ROG GT-AX11000", "price" => 479, "image" => "assets/images/routera/asus_rog.jpg"],
    ["name" => "Netgear Orbi RBKE963 Mesh", "price" => 999, "image" => "assets/images/routera/netgear_orbi.jpg"],
];

// SORT SIPAS CMIMIT - ASC
usort($routers, function($a, $b) {
    return $a['price'] - $b['price'];
});
?>

  <!-- MAIN CONTENT -->
  <main class="main">
    <section class="products">
      <div class="container">
        <h2 class="section-title">Routera (Renditur sipas çmimit)</h2>
        <div class="product-grid">

          <!-- Loop përmes routerave të sortuar -->
          <?php foreach ($routers as $router): ?>
          <div class="product-item">
            <img src="<?php echo htmlspecialchars($router['image']); ?>" alt="<?php echo htmlspecialchars($router['name']); ?>">
            <h3><?php echo htmlspecialchars($router['name']); ?></h3>
            <p class="product-price"><?php echo number_format($router['price'], 0); ?>€</p>
            <a href="pages/pagesa.php" class="btn btn-primary">Bleje tani</a>
          </div>
          <?php endforeach; ?>

        </div>
      </div>
    </section>
  </main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>