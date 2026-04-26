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
          <input type="tel" id="telefoni" placeholder="+383 44 123 456">

          <label for="pagesa">Mënyra e pagesës</label>
          <select id="pagesa">
            <option value="">Zgjidh mënyrën e pagesës</option>
            <option value="card">Kartë Krediti / Debiti</option>
            <option value="cash">Pagesë në dorëzim</option>
          </select>

          <div id="cardDetails" style="display:none;">
            <!-- pjesa e kartës mbetet njësoj -->
          </div>

          <button type="submit" class="btn-submit">Konfirmo Pagesën</button>
        </form>

        <div class="loading" id="loadingScreen">
          <div class="spinner"></div>
          <p>Duke përpunuar pagesën tuaj...</p>
        </div>

        <div class="success-message" id="successMessage">
          <h3>Faleminderit për porosinë tuaj!</h3>
          <a href="telefona.php" class="back-link">← Kthehu tek produktet</a>
        </div>

      </div>
    </div>
  </section>
</main>

<script src="assets/js/pagesa.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>