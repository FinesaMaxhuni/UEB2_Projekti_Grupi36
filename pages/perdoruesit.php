<?php
$pageCSS = "perdoruesit.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/navbar.php';
?>

<!-- HERO -->
<section class="users-hero">
    <div class="container">
        <h1>Menaxhimi i Përdoruesve</h1>
        <p>Statistika, klientët aktivë dhe shërbimet që përdorin në NetWave.</p>
        <a href="#lista" class="btn btn-primary">Shiko përdoruesit</a>
    </div>
</section>

<!-- STATS -->
<section class="users-stats">
    <div class="container">

        <div class="stats-grid">

            <div class="stat-card">
                <h3>Përdorues Total</h3>
                <span>1,245</span>
            </div>

            <div class="stat-card">
                <h3>Fiber Aktiv</h3>
                <span>586</span>
            </div>

            <div class="stat-card">
                <h3>E-Shop Blerje</h3>
                <span>324</span>
            </div>

            <div class="stat-card">
                <h3>TV Aktiv</h3>
                <span>447</span>
            </div>

        </div>

    </div>
</section>

<!-- GJINIA -->
<section class="info-section">
    <div class="container">
        <h2 class="section-title">Përdorues sipas Gjinisë</h2>

        <div class="mini-grid">
            <div class="mini-box">👨 Mashkuj <strong>58%</strong></div>
            <div class="mini-box">👩 Femra <strong>42%</strong></div>
        </div>
    </div>
</section>

<!-- QYTETI -->
<section class="info-section">
    <div class="container">
        <h2 class="section-title">Përdorues sipas Qytetit</h2>

        <div class="mini-grid">
            <div class="mini-box">Prishtinë <strong>310</strong></div>
            <div class="mini-box">Pejë <strong>142</strong></div>
            <div class="mini-box">Prizren <strong>168</strong></div>
            <div class="mini-box">Gjilan <strong>126</strong></div>
            <div class="mini-box">Ferizaj <strong>111</strong></div>
            <div class="mini-box">Mitrovicë <strong>98</strong></div>
        </div>
    </div>
</section>

<!-- LISTA -->
<section class="users-list" id="lista">
    <div class="container">

        <h2 class="section-title">Lista e Përdoruesve</h2>

        <div class="users-grid">

            <?php
            $users = [
                ["Ardit Krasniqi","Mashkull","Prishtinë","Fiber 300 Mbps","SuperSport 1","iPhone 15"],
                ["Sara Berisha","Femër","Pejë","5G Premium","Klan Kosova","Samsung Galaxy S24"],
                ["Luan Gashi","Mashkull","Prizren","TV Premium","Top Channel","LG Smart TV"],
                ["Era Shala","Femër","Gjilan","Fiber 1 Gbps","RTK 1","MacBook Air"],
                ["Blerim Hoxha","Mashkull","Mitrovicë","Telefoni Fikse","Sport Klub","Router TP-Link"],
                ["Diona Kelmendi","Femër","Ferizaj","Fiber 100 Mbps","Netflix","iPhone 16"]
            ];

            foreach($users as $u):
            ?>

            <div class="user-card">

                <h3><?php echo $u[0]; ?></h3>

                <div class="user-info">
                    <span>👤 <?php echo $u[1]; ?></span>
                    <span>📍 <?php echo $u[2]; ?></span>
                    <span>📶 <?php echo $u[3]; ?></span>
                    <span>📺 <?php echo $u[4]; ?></span>
                    <span>🛒 <?php echo $u[5]; ?></span>
                </div>

            </div>

            <?php endforeach; ?>

        </div>

    </div>
</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>