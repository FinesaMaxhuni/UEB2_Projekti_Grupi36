<?php
$pageCSS = "pagesa.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/navbar.php';
?>

<main class="main">
  <section class="pagesa-page">
    <div class="container">
      <div class="payment-container">

        <h2>Paguaj Online</h2>

        <form id="paymentForm" novalidate>

          <label for="emri">Emri</label>
          <input type="text" id="emri" placeholder="Shkruaj emrin">

          <label for="mbiemri">Mbiemri</label>
          <input type="text" id="mbiemri" placeholder="Shkruaj mbiemrin">

          <label for="adresa">Adresa</label>
          <input type="text" id="adresa" placeholder="P.sh. Rr. Nënë Tereza 12">

          <label for="telefoni">Numri i telefonit</label>
          <input type="tel" id="telefoni" placeholder="P.sh. +383 44 123 456">

          <label for="pagesa">Mënyra e pagesës</label>
          <select id="pagesa">
            <option value="">Zgjidh mënyrën e pagesës</option>
            <option value="card">Kartë Krediti / Debiti</option>
            <option value="cash">Pagesë në dorëzim</option>
          </select>

          <!-- Karta -->
          <div id="cardDetails" style="display:none;">

            <div class="card-pair">
              <div class="field">
                <label for="cardName">Emri në kartë</label>
                <input type="text" id="cardName" placeholder="P.sh. Arben Krasniqi">
              </div>

              <div class="field">
                <label for="cardNumber">Numri i kartës</label>
                <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
              </div>
            </div>

            <div class="card-pair">
              <div class="field">
                <label for="cvv">CVV2/CVC2</label>
                <input type="text" id="cvv" placeholder="123" maxlength="4">
              </div>

              <div class="field">
                <label>Data e skadimit</label>

                <div class="expiry-row">
                  <select id="month">
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

                  <select id="year">
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

          <button type="submit" class="btn-submit">Konfirmo Pagesën</button>
        </form>

        <!-- Loading -->
        <div class="loading" id="loadingScreen">
          <div class="spinner"></div>
          <p>Duke përpunuar pagesën tuaj...</p>
        </div>

        <!-- Success -->
        <div class="success-message" id="successMessage">
          <h3>Faleminderit për porosinë tuaj!</h3>
          <p>Porosia dhe pagesa janë kryer me sukses.</p>
          <a href="pages/telefona.php" class="back-link">← Kthehu tek produktet</a>
        </div>

      </div>
    </div>
  </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/UEB1_Projekti_Grupi19/assets/js/pagesa.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>