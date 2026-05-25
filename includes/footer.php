<footer class="footer">
  <div class="container">
    
    <div class="footer-grid">
      <div class="footer-col">
        <h4>Per NetWave</h4>
        <ul>
          <li><a href="pages/telecomeoperator.php#rreth">Rreth Nesh</a></li>
          <li><a href="pages/telecomeoperator.php#rreth">Informata</a></li>
          <li><a href="pages/telecomeoperator.php">Kryesore</a></li>
        </ul>
      </div>
      
      <div class="footer-col">
        <h4>Sherbimet</h4>
        <ul>
          <li><a href="pages/fiber_internet.php">Internet</a></li>
          <li><a href="pages/5G.php">Mobile</a></li>
          <li><a href="pages/tv-packages.php">TV</a></li>
          <li><a href="pages/abonohu.php">Sherbime shtese</a></li>
        </ul>
      </div>
      
      <div class="footer-col">
        <h4>Kontakti</h4>
        <ul>
          <li><a href="tel:048312252">048/312 252</a></li>
          <li><a href="javascript:void(0)" id="openContactBtn">Na dërgo Email</a></li>
          <li><a href="pages/telecomeoperator.php#rreth">Pikat e shitjes</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <small>&copy; 2026 NetWave. Te gjitha te drejtat e rezervuara.</small>
    </div>
  </div>
</footer>

<div id="contactModal" class="contact-modal">
  <div class="modal-overlay" id="modalOverlay"></div>
  <div class="contact-container modal-content">
      <span class="close-modal-btn" id="closeContactBtn">&times;</span>
      
      <div class="contact-header">
          <h2>Na Kontaktoni</h2>
          <p>Keni ndonjë pyetje? Na shkruani menjëherë.</p>
      </div>
      
      <form action="/UEB2_Projekti_Grupi36/pages/send-email.php" method="POST" class="main-contact-form">
          <div class="form-input-group">
              <label for="fullname">Emri dhe Mbiemri</label>
              <input type="text" id="fullname" name="fullname" placeholder="Shkruani emrin tuaj..." required>
          </div>
          
          <div class="form-input-group">
              <label for="email">Adresa e Email-it</label>
              <input type="email" id="email" name="email" placeholder="emri@gmail.com" required>
          </div>
          
          <div class="form-input-group">
              <label for="message">Mesazhi juaj</label>
              <textarea id="message" name="message" rows="4" placeholder="Shkruani mesazhin këtu..." required></textarea>
          </div>
          
          <button type="submit" class="contact-submit-btn">
              <span>Dërgo Mesazhin</span> ➔
          </button>
      </form>
  </div>
</div>

<script>
  const modal = document.getElementById("contactModal");
  const openBtn = document.getElementById("openContactBtn");
  const closeBtn = document.getElementById("closeContactBtn");
  const overlay = document.getElementById("modalOverlay");

  // Kur klikohet linku, shfaqet modali
  openBtn.addEventListener("click", function() {
      modal.classList.add("active");
      document.body.style.overflow = "hidden"; // Ndalon skrollimin e faqes mbrapa
  });

  // Kur klikohet 'X', mbyllet modali
  closeBtn.addEventListener("click", closeModal);
  
  // Kur klikohet jashtë kutisë së formës (në pjesën e errët), mbyllet modali
  overlay.addEventListener("click", closeModal);

  function closeModal() {
      modal.classList.remove("active");
      document.body.style.overflow = "auto"; // Rikthen skrollimin
  }
</script>

<script src="assets/js/telecomoperator.js?v=2"></script>
</body>
</html>