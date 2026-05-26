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
<script src="/UEB2_Projekti_Grupi36/assets/js/contact-validation.js"></script>