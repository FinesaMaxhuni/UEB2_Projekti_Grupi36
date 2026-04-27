<?php
  $gabime = [];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $emri = $_POST["emri"] ?? "";
    $mbiemri = $_POST["mbiemri"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefon = $_POST["telefon"] ?? "";

    if (!preg_match("/^[a-zA-ZëËçÇ]{2,}$/u", $emri)) {
      $gabime[] = "Emri duhet të përmbajë vetëm shkronja pa hapësira.";
    }
    if (!preg_match("/^[a-zA-ZëËçÇ]{2,}$/u", $mbiemri)) {
      $gabime[] = "Mbiemri duhet të përmbajë vetëm shkronja pa hapësira.";
    }
    if (!preg_match("/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $gabime[] = "Email nuk është valid.";
    }
    if (!preg_match("/^\+?[0-9\s]{9,15}$/", $telefon)) {
      $gabime[] = "Numri i telefonit nuk është valid. Numri duhet të përmbajë 9-15 shifra.";
    }

    if (empty($gabime)) {
    header("Location: abonohu.php?sukses=1");
    exit();
    }
  }

?>
<?php
  $pageCSS = "abonohu.css";
  require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/config.php';
  require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/header.php';
  require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/navbar.php';
?>


  <section class="abonohu-page">
    <div class="container">
      <div class="abonohu-container">

        <h2>Abonohu Online</h2>
        <?php if (!empty($gabime)): ?>
          <div class="error-messages">
            <ul>
              <?php foreach ($gabime as $gabim): ?>
                <li><?php echo htmlspecialchars($gabim); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <form id="abonohuForm" method="POST" novalidate>
          <label for="emri">Emri</label>
          <input type="text" id="emri" name="emri" placeholder="Shkruaj emrin" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($emri) : ''; ?>" required>

          <label for="mbiemri">Mbiemri</label>
          <input type="text" id="mbiemri" name="mbiemri" placeholder="Shkruaj mbiemrin" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($mbiemri) : ''; ?>" required>

          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Shkruaj emailin" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($email) : ''; ?>" required>

          <label for="telefon">Numri i telefonit</label>
          <input type="tel" id="telefon" name="telefon" placeholder="P.sh. +383 44 123 456" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($telefon) : ''; ?>" required>

          <button type="submit" class="btn-submit">Dërgo aplikimin</button>
        </form>

        <?php if (isset($_GET['sukses'])): ?>
          <div class="success-message">
            <h3>Faleminderit për abonimin tuaj!</h3>
            <p>Kërkesa jote u dërgua me sukses. Do të kontaktohesh nga ekipi NetWave.</p>
            <a href="fiber_internet.php" class="back-link">← Kthehu në faqen kryesore</a>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </section>

<script src="abonohu.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>