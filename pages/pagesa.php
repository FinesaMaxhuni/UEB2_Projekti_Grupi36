<?php

$pageCSS = "pagesa.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

$gabime = [];

$product_id = $_GET['id'] ?? null;

if(!$product_id){
    die("Produkti nuk u gjet.");
}

$stmt = $pdo->prepare("
    SELECT *
    FROM eshop_products
    WHERE id = ?
");

$stmt->execute([$product_id]);

$produkti = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$produkti){
    die("Produkti nuk ekziston.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $emri     = $_POST["emri"] ?? "";
    $mbiemri  = $_POST["mbiemri"] ?? "";
    $adresa   = $_POST["adresa"] ?? "";
    $telefoni = $_POST["telefoni"] ?? "";
    $pagesa   = $_POST["pagesa"] ?? "";

    $cardName   = $_POST["cardName"] ?? "";
    $cardNumber = $_POST["cardNumber"] ?? "";
    $cvv        = $_POST["cvv"] ?? "";
    $month      = $_POST["month"] ?? "";
    $year       = $_POST["year"] ?? "";

    if (!preg_match("/^[a-zA-ZëËçÇ]{2,}$/u", $emri)) {
        $gabime[] = "Emri duhet të përmbajë vetëm shkronja.";
    }

    if (!preg_match("/^[a-zA-ZëËçÇ]{2,}$/u", $mbiemri)) {
        $gabime[] = "Mbiemri duhet të përmbajë vetëm shkronja.";
    }

    if (strlen(trim($adresa)) < 5) {
        $gabime[] = "Adresa nuk është valide.";
    }

    if (!preg_match("/^\+?[0-9\s]{9,15}$/", $telefoni)) {
        $gabime[] = "Numri i telefonit nuk është valid.";
    }

    if ($pagesa == "") {
        $gabime[] = "Zgjidh mënyrën e pagesës.";
    }

    if (empty($gabime)) {

        $fullname = $emri . " " . $mbiemri;

        $stmt = $pdo->prepare("
            INSERT INTO orders
            (
                fullname,
                address,
                phone,
                payment_method,
                product_id,
                quantity
            )
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $fullname,
            $adresa,
            $telefoni,
            $pagesa,
            $product_id,
            1
        ]);

        header("Location: pagesa.php?id=" . $product_id . "&sukses=1");

        exit();
    }
}
?>

<main class="main">
  <section class="pagesa-page">
    <div class="container">
      <div class="payment-container">

        <h2>Paguaj Online</h2>

<!-- PRODUKTI -->
<div class="selected-product">

    <h3>
        Produkti:
        <?php echo htmlspecialchars($produkti['product_name']); ?>
    </h3>

    <p>
        Çmimi:
        <?php echo htmlspecialchars($produkti['price']); ?>€
    </p>

</div>

<?php if (!empty($gabime)): ?>
<div class="error-messages">
    <ul>
        <?php foreach ($gabime as $g): ?>
            <li><?php echo htmlspecialchars($g); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if (isset($_GET['sukses'])): ?>
<div class="success-message server-success">
    <h3>Faleminderit për porosinë tuaj!</h3>
    <p>Porosia dhe pagesa janë kryer me sukses.</p>
</div>
<?php endif; ?>

<form id="paymentForm" method="POST" action="" novalidate>

    <label for="emri">Emri</label>
    <input type="text" id="emri" name="emri"
        placeholder="Shkruaj emrin"
        value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($emri) : ''; ?>"
        required>

    <label for="mbiemri">Mbiemri</label>
    <input type="text" id="mbiemri" name="mbiemri"
        placeholder="Shkruaj mbiemrin"
        value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($mbiemri) : ''; ?>"
        required>

    <label for="adresa">Adresa</label>
    <input type="text" id="adresa" name="adresa"
        placeholder="P.sh. Rr. Nënë Tereza 12"
        value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($adresa) : ''; ?>"
        required>

    <label for="telefoni">Numri i telefonit</label>
    <input type="tel" id="telefoni" name="telefoni"
        placeholder="P.sh. +383 44 123 456"
        value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($telefoni) : ''; ?>"
        required>

    <label for="pagesa">Mënyra e pagesës</label>

    <select id="pagesa" name="pagesa">

        <option value="">Zgjidh mënyrën e pagesës</option>

        <option value="card">Kartë Krediti / Debiti</option>

        <option value="cash">Pagesë në dorëzim</option>

    </select>

    <!-- KARTA -->
    <div id="cardDetails" style="display:none;">

        <div class="card-pair">

            <div class="field">

                <label for="cardName">Emri në kartë</label>

                <input type="text"
                    id="cardName"
                    name="cardName"
                    placeholder="P.sh. Arben Krasniqi"
                    value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($cardName) : ''; ?>"
                    required>

            </div>

            <div class="field">

                <label for="cardNumber">Numri i kartës</label>

                <input type="text"
                    id="cardNumber"
                    name="cardNumber"
                    placeholder="1234 5678 9012 3456"
                    maxlength="19"
                    value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($cardNumber) : ''; ?>"
                    required>

            </div>

        </div>

        <div class="card-pair">

            <div class="field">

                <label for="cvv">CVV2/CVC2</label>

                <input type="text"
                    id="cvv"
                    name="cvv"
                    placeholder="123"
                    maxlength="4"
                    value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($cvv) : ''; ?>"
                    required>

            </div>

            <div class="field">

                <label>Data e skadimit</label>

                <div class="expiry-row">

                    <select id="month" name="month">

                        <option value="">Muaji</option>

                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>

                    </select>

                    <select id="year" name="year">

                        <option value="">Viti</option>

                        <option>2025</option>
                        <option>2026</option>
                        <option>2027</option>
                        <option>2028</option>
                        <option>2029</option>
                        <option>2030</option>

                    </select>

                </div>

            </div>

        </div>

    </div>

    <button type="submit" class="btn-submit">
        Konfirmo Pagesën
    </button>

</form>

        

      </div>
    </div>
  </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/UEB2_Projekti_Grupi36/assets/js/pagesa.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>