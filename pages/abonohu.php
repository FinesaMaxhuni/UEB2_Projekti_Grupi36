<?php
$pageCSS = "abonohu.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/internet_package_tables.php';
ensureInternetPackageTables($pdo);

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

$gabime = [];

// GET nga URL (fiber / 5g + id i paketës)
$type = strtolower(trim($_GET['type'] ?? ''));
$package_id = (int)($_GET['id'] ?? 0);


if (!in_array($type, ['fiber', '5g'])) {
    die("Type gabim: $type");
}

if ($package_id <= 0) {
    die("Invalid package id");
}

// input default
$emri = "";
$mbiemri = "";
$email = "";
$telefon = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $emri = $_POST["emri"] ?? "";
    $mbiemri = $_POST["mbiemri"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefon = $_POST["telefon"] ?? "";

    // VALIDIM
    if (!preg_match("/^[a-zA-ZëËçÇ]{2,}$/u", $emri)) {
        $gabime[] = "Emri nuk është valid.";
    }

    if (!preg_match("/^[a-zA-ZëËçÇ]{2,}$/u", $mbiemri)) {
        $gabime[] = "Mbiemri nuk është valid.";
    }

    if (!preg_match("/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $gabime[] = "Email nuk është valid.";
    }

    if (!preg_match("/^\+?[0-9\s]{9,15}$/", $telefon)) {
        $gabime[] = "Numri i telefonit nuk është valid.";
    }

    // INSERT NË DB
    if (empty($gabime)) {

        $stmt = $pdo->prepare("
            INSERT INTO internet_subscriptions
            (fullname, email, phone, package_type, package_id)
            VALUES (:fullname, :email, :phone, :package_type, :package_id)
        ");

        $stmt->execute([
            ':fullname' => $emri . ' ' . $mbiemri,
            ':email' => $email,
            ':phone' => $telefon,
            ':package_type' => $type,
            ':package_id' => $package_id
        ]);

        header("Location: abonohu.php?type=$type&id=$package_id&sukses=1");
        exit();
    }
}
?>


  <section class="abonohu-page">
    <div class="container">
      <div class="abonohu-container">

        <h2>Abonohu Online</h2>

        <?php if (isset($_GET['sukses'])): ?>
          <div class="success-message server-success">
            <h3>Faleminderit për abonimin tuaj!</h3>
            <p>Kërkesa jote u dërgua me sukses. Do të kontaktohesh nga ekipi NetWave.</p>
            <a href="/UEB2_Projekti_Grupi36/pages/fiber_internet.php" class="back-link">← Kthehu në faqen kryesore</a>
          </div>
        <?php endif; ?>

        <?php if (!empty($gabime)): ?>
          <div class="error-messages">
            <ul>
              <?php foreach ($gabime as $gabim): ?>
                <li><?php echo htmlspecialchars($gabim); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <form id="abonohuForm" method="POST" action="" novalidate>
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


      </div>
    </div>
  </section>

<script src="abonohu.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>
