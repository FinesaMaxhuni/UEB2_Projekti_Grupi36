<?php
$pageCSS = "tv+internet.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';
?>

<main class="main">

<!-- TV Packages Hero -->
    <section class="tv-packages-hero">
        <div class="container">
            <h1>Pakot e kombinuara TV + INTERNET</h1>
            <p>Zgjedh pakon që i ke të gjitha në një vend!</p>
        </div>
    </section>

    <section class="offers">
        <div class="container">
            <ul><a href="javascript:void(0);" class="package-btn">Aktivizo Pakon</a></ul>
            <div class="packages-grid">

                <!-- Combo Basic -->
                <div class="package-card">
                    <h3 class="package-name">Combo Basic</h3>
                    <div class="package-price">14.90€</div>
                    <div class="package-period">/muaj</div>
                    <div class="package-channels">100 Mbps + 90+ Kanale</div>
                    <ul class="package-features">
                        <li>100 Mbps Internet Fiber</li>
                        <li>90+ kanale TV në HD</li>
                        <li>Kanale kombëtare & lajme 24/7</li>
                        <li>Filma & muzikë</li>
                        <li>Catch-up 3 ditë</li>
                    </ul>
                </div>

                <!-- Combo Plus -->
                <div class="package-card">
                    <h3 class="package-name">Combo Plus</h3>
                    <div class="package-price">20.90€</div>
                    <div class="package-period">/muaj</div>
                    <div class="package-channels">200 Mbps + 150+ Kanale</div>
                    <ul class="package-features">
                        <li>200 Mbps Internet Fiber</li>
                        <li>150+ kanale HD / disa 4K</li>
                        <li>Filma & Seriale Premium</li>
                        <li>Dokumentarë ekskluzivë</li>
                        <li>Catch-up 5 ditë</li>
                    </ul>
                </div>

                <!-- Combo Sport -->
                <div class="package-card featured">
                    <h3 class="package-name">Combo Sport</h3>
                    <div class="package-price">29.90€</div>
                    <div class="package-period">/muaj</div>
                    <div class="package-channels">300 Mbps + 200+ Kanale</div>
                    <ul class="package-features">
                        <li>300 Mbps Internet Fiber</li>
                        <li>Premier League, La Liga, Serie A</li>
                        <li>Champions League & Europa League</li>
                        <li>NBA, Formula 1, MotoGP, UFC & Boxing</li>
                        <li>Kanale HD/4K + Catch-up 7 ditë</li>
                    </ul>
                </div>

                <!-- Combo Ultra -->
                <div class="package-card">
                    <h3 class="package-name">Combo Ultra</h3>
                    <div class="package-price">39.90€</div>
                    <div class="package-period">/muaj</div>
                    <div class="package-channels">500 Mbps + 250+ Kanale</div>
                    <ul class="package-features">
                        <li>500 Mbps Internet Fiber</li>
                        <li>Të gjitha kanalet HD/4K & Premium</li>
                        <li>Filma, Seriale, Dokumentarë & Sport</li>
                        <li>Catch-up 10 ditë</li>
                        <li>Ideal për familje & streaming 4K</li>
                    </ul>
                </div>
                
            </div>
        </div>
    </section>
</main>

<!-- Activation Modal -->
<div id="activationModal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Aktivizo Pakon</h2>
        <div class="success-message" id="successMessage">
            ✓ Pako u aktivizua me sukses!
        </div>
        <form id="activationForm">
            <input type="text" placeholder="Emri i plotë" required>
            <input type="email" placeholder="Email" required>
            <input type="tel" placeholder="Numri i telefonit" required>
            <select id="packageSelect" required>
                <option value="">Zgjidh pakon...</option>
                <option value="combo-basic">Combo Basic - 14.90€</option>
                <option value="combo-plus">Combo Plus - 20.90€</option>
                <option value="combo-sport">Combo Sport - 29.90€</option>
                <option value="combo-ultra">Combo Ultra - 39.90€</option>
            </select>
            <button type="submit" class="modal-btn">Përfundo</button>
        </form>
    </div>
</div>

<!-- Success Popup Modal -->
<div class="success-popup" id="successPopup">
    <div id="successPopupText">✓ Pako u aktivizua me sukses!</div>
</div>

<script src="assets/js/telecomeoperator.js"></script>
<script src="assets/js/tv+internet.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>