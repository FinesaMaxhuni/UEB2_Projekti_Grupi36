<?php
$pageCSS = "5G.css";
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/navbar.php';
?>


  <!-- HERO -->
  <section class="g5-hero">
    <div class="container">
      <h1>NetWave 5G Internet</h1>
      <p>Lidhje pa kufij me shpejtësi të pabesueshme dhe stabilitet që e ndjen në çdo klikim.</p>
      <a href="pages/5G.php#planet5g" class="btn btn-primary">Shiko paketat 5G</a>
      
    </div>
  </section>

  <!-- PLANET 5G -->
  <section class="g5-plans" id="planet5g">
    <div class="container">
      <h2 class="section-title">Zgjidh planin tënd 5G</h2>
      <div class="plans-grid">
        
        <div class="plan-card">
          <h3>5G Basic</h3>
          <p class="price">24.90 €/muaj</p>
          <ul>
            <li>Shpejtësi deri në 150 Mbps</li>
            <li>Instalim falas</li>
            <li>Router 5G përfshirë</li>
          </ul>
          <a href="pages/abonohu.php" class="btn btn-primary">Abonohu</a>
        </div>

        <div class="plan-card">
          <h3>5G Plus</h3>
          <p class="price">34.90 €/muaj</p>
          <ul>
            <li>Shpejtësi deri në 500 Mbps</li>
            <li>Pa kufizime në përdorim</li>
            <li>Router inteligjent Wi-Fi 6</li>
          </ul>
          <a href="pages/abonohu.php" class="btn btn-primary">Abonohu</a>
        </div>

        <div class="plan-card">
          <h3>5G Premium</h3>
          <p class="price">49.90 €/muaj</p>
          <ul>
            <li>Shpejtësi mbi 1 Gbps</li>
            <li>Prioritet në rrjet 5G</li>
            <li>Suport teknik 24/7</li>
          </ul>
          <a href="pages/abonohu.php" class="btn btn-primary">Abonohu</a>
        </div>
      </div>
    </div>
  </section>

  <!-- KRAHASIMI 5G VS 4G -->
  <section class="g5-compare">
    <div class="container">
      <h2 class="section-title">5G vs 4G</h2>
      <table class="compare-table">
        <thead>
          <tr>
            <th>Karakteristika</th>
            <th>4G</th>
            <th>5G</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>Shpejtësia mesatare</td><td>100 Mbps</td><td>1 Gbps+</td></tr>
          <tr><td>Latenca</td><td>50 ms</td><td>1–5 ms</td></tr>
          <tr><td>Kapaciteti i rrjetit</td><td>Mesatar</td><td>Shumë i lartë</td></tr>
          <tr><td>Mbështetja për pajisje</td><td>Derivon</td><td>Mijëra pajisje për antenë</td></tr>
          <tr><td>Përdorimi për AR/VR & IoT</td><td>I kufizuar</td><td>I plotë</td></tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- AVANTAZHET -->
  <section class="g5-benefits">
    <div class="container">
      <h2 class="section-title">Pse të zgjedhësh NetWave 5G?</h2>
      <div class="benefit-grid">
        <div class="benefit-item">
          <img src="assets/images/icons/speed.png" alt="">
          <h3>Shpejtësi ekstreme</h3>
          <p>Arrin deri në 10x më shumë shpejtësi krahasuar me rrjetet tradicionale.</p>
        </div>
        <div class="benefit-item">
          <img src="assets/images/icons/signal.png" alt="">
          <h3>Lidhje stabile</h3>
          <p>Mbulo territorin urban dhe rural me valë 5G të fuqishme.</p>
        </div>
        <div class="benefit-item">
          <img src="assets/images/icons/support.png" alt="">
          <h3>Suport 24/7</h3>
          <p>Ekipi ynë teknik është gjithmonë aktiv për ndihmë dhe instalim.</p>
        </div>
      </div>
    </div>
  </section>

<!-- FAQ -->
<section class="g5-faq">
  <div class="container">
    <h2 class="section-title">Pyetje të shpeshta</h2>

    <div class="faq-wrapper">
      <!-- Kolona e majtë -->
      <div class="faq-col">
        <div class="faq-item">
          <button class="faq-question">Çfarë është 5G dhe si ndryshon nga 4G?</button>
          <div class="faq-answer">5G është gjenerata më e re e rrjeteve mobile që ofron shpejtësi shumë më të lartë, latencë minimale dhe mbulim më të mirë në çdo zonë.</div>
        </div>
        <div class="faq-item">
          <button class="faq-question">A mund të përdor routerin tim ekzistues?</button>
          <div class="faq-answer">Jo, për rrjetin 5G përdoret një router i ri i dedikuar që mbështet teknologjinë 5G.</div>
        </div>
        <div class="faq-item">
          <button class="faq-question">A ka kufizime në shpejtësi apo sasi të të dhënave?</button>
          <div class="faq-answer">Jo, të gjitha planet tona 5G ofrojnë përdorim të pakufizuar me performancë të qëndrueshme.</div>
        </div>
      </div>

      <!-- Kolona e djathtë -->
      <div class="faq-col">
        <div class="faq-item">
          <button class="faq-question">A funksionon 5G edhe në zonat rurale?</button>
          <div class="faq-answer">Po, rrjeti NetWave 5G mbulon shumicën e zonave urbane dhe rurale me sinjal të qëndrueshëm.</div>
        </div>
        <div class="faq-item">
          <button class="faq-question">A ofroni instalim falas për routerin 5G?</button>
          <div class="faq-answer">Po, instalimi dhe konfigurimi fillestar përfshihen falas për çdo përdorues të ri.</div>
        </div>
        <div class="faq-item">
          <button class="faq-question">Si mund të kontrolloj nëse 5G është i disponueshëm në zonën time?</button>
          <div class="faq-answer">Mund të kontrollosh mbulimin 5G përmes hartës interaktive në faqen tonë kryesore.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
        const answer = btn.nextElementSibling;
        answer.style.display =
            answer.style.display === 'block' ? 'none' : 'block';
    });
});
</script>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>