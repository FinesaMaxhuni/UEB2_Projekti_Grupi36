<?php
$pageCSS = "abonohu.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/navbar.php';

$gabime = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
}
?>


  <section class="abonohu-page">
    <div class="container">
      <div class="abonohu-container">

        <h2>Abonohu Online</h2>

        <form id="abonohuForm" novalidate>
          <label for="emri">Emri</label>
          <input type="text" id="emri" placeholder="Shkruaj emrin" required>

          <label for="mbiemri">Mbiemri</label>
          <input type="text" id="mbiemri" placeholder="Shkruaj mbiemrin" required>

          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Shkruaj emailin" required>

          <label for="telefon">Numri i telefonit</label>
          <input type="tel" id="telefon" placeholder="P.sh. 383 44 123 456" required>

          <button type="submit" class="btn-submit">Dërgo aplikimin</button>
        </form>

        <div class="loading" id="loadingScreen">
          <div class="spinner"></div>
          <p>Duke përpunuar kërkesën tuaj...</p>
        </div>

        <div class="success-message" id="successMessage">
          <h3>Faleminderit për abonimin tuaj!</h3>
          <p>Kërkesa jote u dërgua me sukses. Do të kontaktohesh nga ekipi NetWave.</p>
          <a href="fiber_internet.php" class="back-link">← Kthehu në faqen kryesore</a>
        </div>

      </div>
    </div>
  </section>

<script src="abonohu.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>