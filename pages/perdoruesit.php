<?php
$pageCSS = "perdoruesit.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/navbar.php';

/* TE DHENA DEMO */
$users = [
    ["emri"=>"Ardit Krasniqi","gjinia"=>"Mashkull","qyteti"=>"Prishtinë","service"=>"Fiber 300 Mbps","tv"=>"SuperSport 1","blerje"=>"iPhone 15"],
    ["emri"=>"Sara Berisha","gjinia"=>"Femër","qyteti"=>"Pejë","service"=>"5G Premium","tv"=>"Klan Kosova","blerje"=>"Samsung Galaxy S24"],
    ["emri"=>"Luan Gashi","gjinia"=>"Mashkull","qyteti"=>"Prizren","service"=>"TV Premium","tv"=>"Top Channel","blerje"=>"LG Smart TV"],
    ["emri"=>"Era Shala","gjinia"=>"Femër","qyteti"=>"Gjilan","service"=>"Fiber 1 Gbps","tv"=>"RTK 1","blerje"=>"MacBook Air"],
    ["emri"=>"Blerim Hoxha","gjinia"=>"Mashkull","qyteti"=>"Mitrovicë","service"=>"Telefoni Fikse","tv"=>"Sport Klub","blerje"=>"Router TP-Link"],
    ["emri"=>"Diona Kelmendi","gjinia"=>"Femër","qyteti"=>"Ferizaj","service"=>"Fiber 100 Mbps","tv"=>"Netflix","blerje"=>"iPhone 16"],
];
?>

<main class="main">

<!-- HERO -->
<section class="users-hero">
  <div class="container hero-content">
    <h1>Menaxhimi i Përdoruesve</h1>
    <p>Statistika, shërbimet aktive dhe sjellja e klientëve NetWave.</p>
    <a href="pages/perdoruesit.php#lista" class="btn btn-primary">Shiko përdoruesit</a>
  </div>
</section>

<!-- KARTELA -->
<section class="users-stats">
  <div class="container stats-grid">

    <div class="stat-card">
      <h3>Përdorues Total</h3>
      <p>1,245</p>
    </div>

    <div class="stat-card">
      <h3>Fiber Aktiv</h3>
      <p>586</p>
    </div>

    <div class="stat-card">
      <h3>E-Shop Blerje</h3>
      <p>324</p>
    </div>

    <div class="stat-card">
      <h3>TV Aktiv</h3>
      <p>447</p>
    </div>

  </div>
</section>

<!-- SIPAS GJINISE -->
<section class="users-section">
  <div class="container">
    <h2 class="section-title">Përdorues sipas Gjinisë</h2>

    <div class="gender-grid">
      <div class="gender-box male">
        <h3>Mashkuj</h3>
        <p>58%</p>
      </div>

      <div class="gender-box female">
        <h3>Femra</h3>
        <p>42%</p>
      </div>
    </div>
  </div>
</section>

<!-- SIPAS VENDIT -->
<section class="users-section">
  <div class="container">
    <h2 class="section-title">Përdorues sipas Qytetit</h2>

    <div class="city-grid">
      <div class="city-card">Prishtinë - 310</div>
      <div class="city-card">Pejë - 142</div>
      <div class="city-card">Prizren - 168</div>
      <div class="city-card">Gjilan - 126</div>
      <div class="city-card">Ferizaj - 111</div>
      <div class="city-card">Mitrovicë - 98</div>
    </div>
  </div>
</section>

<!-- LISTA -->
<section class="users-list" id="lista">
  <div class="container">
    <h2 class="section-title">Lista e Përdoruesve</h2>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Emri</th>
            <th>Gjinia</th>
            <th>Qyteti</th>
            <th>Shërbimi</th>
            <th>Kanali TV</th>
            <th>Blerja</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($users as $u): ?>
          <tr>
            <td><?php echo $u['emri']; ?></td>
            <td><?php echo $u['gjinia']; ?></td>
            <td><?php echo $u['qyteti']; ?></td>
            <td><?php echo $u['service']; ?></td>
            <td><?php echo $u['tv']; ?></td>
            <td><?php echo $u['blerje']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</section>

</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>