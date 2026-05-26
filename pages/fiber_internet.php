<?php
$pageCSS = "fiber_internet.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

$stmt = $pdo->prepare("SELECT * FROM fiber_packages");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- HERO -->
<section class="fiber-hero">
  <div class="container hero-content">
    <h1>NetWave Ultra Fiber</h1>
    <p>Përjeto fuqinë e lidhjes më të shpejtë dhe më të qëndrueshme të internetit në Kosovë.</p>
    <a href="pages/fiber_internet.php#paketat" class="btn btn-primary">Zbulo paketat</a>
  </div>
</section>

<!-- FEATURES -->
<section class="fiber-features">
  <div class="container feature-grid">
    <div class="feature-item">
      <img src="assets/images/fiber/coverage.png" alt="">
      <h3>Mbulimi</h3>
      <p>Rrjeti ynë Fiber mbulon mbi 90% të territorit urban me lidhje ultra të shpejta.</p>
    </div>

    <div class="feature-item">
      <img src="assets/images/fiber/speed.jpg" alt="">
      <h3>Shpejtësia</h3>
      <p>Derivoni shpejtësi deri në 10 Gbps — perfekt për streaming, gaming dhe pune online.</p>
    </div>

    <div class="feature-item">
      <img src="assets/images/fiber/security.jpg" alt="">
      <h3>Siguria</h3>
      <p>Infrastrukturë optike që garanton stabilitet maksimal dhe mbrojtje të të dhënave.</p>
    </div>
  </div>
</section>

<!-- PAKETAT -->
<section class="fiber-plans" id="paketat">
  <div class="container">
    <h2 class="section-title">Zgjidh paketën tënde Fiber</h2>

    <div class="plans-grid">

      <?php foreach($result as $row) { ?>

        <div class="plan-card">
          <h3><?= htmlspecialchars($row['package_name']) ?></h3>

          <p class="price">
            <?= htmlspecialchars($row['price']) ?> €/muaj
          </p>

          <ul>
            <li><?= htmlspecialchars($row['speed']) ?></li>
            <li><?= htmlspecialchars($row['description']) ?></li>
          </ul>

          <a href="/UEB2_Projekti_Grupi36/pages/abonohu.php?type=fiber&id=<?= (int)$row['id'] ?>" class="btn btn-primary">
            Abonohu
          </a>
        </div>

      <?php } ?>

    </div>

  </div>
</section>

<!-- KRAHASIMI -->
<section class="fiber-compare">
  <div class="container">
    <h2 class="section-title">Fiber vs Internet Kabllor</h2>

    <div class="compare-grid">

      <div class="compare-col fiber">
        <h3>NetWave Fiber</h3>
        <ul>
          <li>Shpejtësi deri në 10 Gbps upload & download</li>
          <li>Latencë shumë e ulët për gaming dhe video call</li>
          <li>Stabilitet pa ngarkesa në orët piku</li>
          <li>Teknologji e ardhmes me fiber optik</li>
        </ul>
      </div>

      <div class="compare-col cable">
        <h3>Internet Kabllor</h3>
        <ul>
          <li>Upload më i ngadalshëm se download</li>
          <li>Latencë e lartë për shkak të kabllove bakri</li>
          <li>Ngarkesa në rrjet në orët piku</li>
          <li>Kufizime në shpejtësi dhe skalueshmëri</li>
        </ul>
      </div>

    </div>
  </div>
</section>

<!-- HARTA -->
<section class="fiber-map">
  <div class="container">
    <h2 class="section-title">Harta e rrjetit Fiber</h2>

    <div class="map-wrapper">
      <iframe
        src="https://map.kmcd.dev/?year=2025"
        width="100%"
        height="480"
        style="border:0;"
        allowfullscreen
        loading="lazy">
      </iframe>
    </div>

    <p class="map-note">
      Harta interaktive e rrjeteve globale të internetit, përfshirë edhe fiber dhe lidhjet kryesore.
    </p>
  </div>
</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>
