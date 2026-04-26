<?php
 include '../config.php'; 
$pageCSS = "telefoniafikse.css";
include("../includes/header.php");
include("../includes/navbar.php");
?>

  <!-- HERO -->
  <section class="fiber-hero">
    <div class="container hero-content">
      <h1>NetWave Telefoni Fikse</h1>
      <p>Komuniko qartë, me cilësi të lartë dhe me çmimet më të volitshme në Kosovë.</p>
      <a href="#pako-bazike" class="btn btn-primary">Shfleto pakot</a>
    </div>
  </section>

  <!-- PAKO BAZIKE -->
  <section class="fiber-plans" id="pako-bazike">
    <div class="container">
      <h2 class="section-title">Pako Bazike</h2>
      <p class="section-desc">Zgjidh paketën që të përshtatet për komunikim të qartë dhe stabil me familjen apo biznesin tënd.</p>

      <div class="table-wrapper">
        <table class="fixe-table">
          <thead>
            <tr>
              <th>Shërbimi</th>
              <th>Vetëm Telefoni Fikse</th>
              <th>Telefoni Fikse + Internet</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Thirrje në rrjetin NetWave</td>
              <td>0.00 €</td>
              <td>0.00 €</td>
            </tr>
            <tr>
              <td>Thirrje në operatorë tjerë</td>
              <td>0.03 €</td>
              <td>0.02 €</td>
            </tr>
            <tr>
              <td>Thirrje ndërkombëtare</td>
              <td>0.09 €</td>
              <td>0.08 €</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="fixe-info">
        <h3>Përshkrimi</h3>
        <ul>
          <li>Instalim: 10.13 € për një linjë.</li>
          <li>Pagesa mujore: 5.04 € për një numër.</li>
          <li>15 shërbime shtesë falas si “Mbajtja e thirrjes”, “Numri i fundit”, “Mos Pengo”.</li>
          <li>Konferencë me 3 palë dhe thirrje pa pagesë brenda rrjetit NetWave.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- PAKO PREPAID -->
  <section class="fiber-compare">
    <div class="container">
      <h2 class="section-title">Pako Prepaid</h2>
      <p class="section-desc">Fleksibilitet dhe kontroll total mbi shpenzimet e tua me mbushje sipas nevojës.</p>

      <div class="table-wrapper">
        <table class="fixe-table">
          <thead>
            <tr>
              <th>Shërbimi</th>
              <th>Çmimi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Thirrje në rrjetin NetWave</td>
              <td>0.00 €</td>
            </tr>
            <tr>
              <td>Thirrje në operatorë tjerë</td>
              <td>0.05 €</td>
            </tr>
            <tr>
              <td>Thirrje ndërkombëtare</td>
              <td>0.09 €</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="fixe-info">
        <h3>Përshkrimi</h3>
        <ul>
          <li>Mbushje elektronike nga 3 € deri në 50 € në çdo dyqan NetWave.</li>
          <li>Karta të vlefshme për 60 ditë pas aktivizimit.</li>
          <li>Të gjitha funksionet fikse përfshihen falas: Thirrje në pritje, Konferencë, Numri i fundit.</li>
          <li>Thirrje emergjente pa pagesë (112, 192, 194).</li>
        </ul>
      </div>
    </div>
  </section>

<?php include("../includes/footer.php"); ?>


