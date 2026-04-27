<?php
$pageCSS = "settings.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/navbar.php';
?>

<section class="settings-hero">
    <div class="container">
        <h1>Admin Settings</h1>
        <p>Menaxho konfigurimet kryesore të NetWave.</p>
    </div>
</section>

<section class="settings-page">
<div class="container">

<form class="settings-grid">

    <!-- Company -->
    <div class="setting-card">
        <h2>🏢 Informacionet e Kompanisë</h2>

        <label>Emri i Kompanisë</label>
        <input type="text" value="NetWave">

        <label>Email</label>
        <input type="email" value="info@netwave.com">

        <label>Telefoni</label>
        <input type="text" value="+383 44 123 456">

        <label>Adresa</label>
        <input type="text" value="Prishtinë, Kosovë">
    </div>

    <!-- Admin -->
    <div class="setting-card">
        <h2>👤 Admin Account</h2>

        <label>Username</label>
        <input type="text" value="admin">

        <label>Password i Ri</label>
        <input type="password" placeholder="********">

        <label>Email Admin</label>
        <input type="email" value="admin@netwave.com">
    </div>

    <!-- Appearance -->
    <div class="setting-card">
        <h2>🎨 Appearance</h2>

        <label>Theme</label>
        <select>
            <option>Dark Mode</option>
            <option>Light Mode</option>
        </select>

        <label>Ngjyra Kryesore</label>
        <select>
            <option>Blue</option>
            <option>Green</option>
            <option>Purple</option>
        </select>
    </div>

    <!-- Services -->
    <div class="setting-card">
        <h2>📡 Shërbimet Aktive</h2>

        <label><input type="checkbox" checked> Fiber Internet</label>
        <label><input type="checkbox" checked> 5G</label>
        <label><input type="checkbox" checked> TV Packages</label>
        <label><input type="checkbox" checked> E-Shop</label>
    </div>

    <!-- Security -->
    <div class="setting-card">
        <h2>🔒 Security</h2>

        <label>Session Timeout</label>
        <select>
            <option>15 min</option>
            <option>30 min</option>
            <option selected>60 min</option>
        </select>

        <label><input type="checkbox" checked> Two Factor Auth</label>
        <label><input type="checkbox" checked> Login Alerts</label>
    </div>

    <!-- Notifications -->
    <div class="setting-card">
        <h2>🔔 Notifications</h2>

        <label><input type="checkbox" checked> New Orders</label>
        <label><input type="checkbox" checked> New Users</label>
        <label><input type="checkbox"> Promotions</label>
        <label><input type="checkbox" checked> Complaints</label>
    </div>

</form>

<div class="save-area">
    <button class="save-btn">Ruaj Ndryshimet</button>
</div>

</div>
</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB1_Projekti_Grupi19/includes/footer.php'; ?>