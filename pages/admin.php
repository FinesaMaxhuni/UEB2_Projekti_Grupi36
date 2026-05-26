<?php
$pageCSS = "admin.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

if(!isset($_SESSION['user']) || $_SESSION['role']!="admin"){
    die("Nuk ke qasje.");
}
/* TOTAL USERS */

$totalUsers = $pdo->query("
SELECT COUNT(*) FROM users
")->fetchColumn();

$totalSoldTvPackages = $pdo->query("
SELECT COUNT(*)
FROM aktivizo
WHERE tv_package_id IS NOT NULL
   OR tv_internet_package_id IS NOT NULL
")->fetchColumn();

// TOTAL ORDERS ESHOP

$stmt = $pdo->prepare("
    SELECT COUNT(*)
    FROM orders
");

$stmt->execute();

$totalOrders = $stmt->fetchColumn();
?>


<section class="admin-page">
<div class="admin-container">

<div class="admin-grid">

    <!-- Sidebar -->
    <div class="admin-sidebar">
        <h3>Admin Menu</h3>

        <ul class="admin-menu">
    <li>
       <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php">
            <span>📺</span> TV Paketa <span>›</span>
        </a>
    </li>

    <li>
       <a href="/UEB2_Projekti_Grupi36/pages/internet.php">
            <span>🌐</span> Internet <span>›</span>
        </a>
    </li>

    <li>
        <a href="/UEB2_Projekti_Grupi36/pages/eshop-admin.php">
            <span>🛒</span> E-Shop <span>›</span>
        </a>
    </li>


    <li>
        <a href="/UEB2_Projekti_Grupi36/pages/perdoruesit.php">
            <span>👥</span> Përdoruesit <span>›</span>
        </a>
    </li>

</ul>
    </div>

    <!-- Main Content -->
    <div class="admin-main">

        <div class="admin-title">Admin Dashboard</div>

        <div class="stats-grid">

       
            <div class="stat-box">
                <h4>Përdorues Total</h4>
                <div class="stat-number">
    <?php echo $totalUsers; ?>
</div>
            </div>

            <div class="stat-box">
                <h4>Paketa TV të shitura</h4>
                <div class="stat-number"><?php echo $totalSoldTvPackages; ?></div>
            </div>


            <div class="stat-box">
    <h4>E-Shop Shitje</h4>
    <div class="stat-number">
        <?php echo $totalOrders; ?>
    </div>
</div>

        </div>

        <table class="admin-table">
            <tr>
                <th>Shërbimi</th>
                <th>Statusi</th>
                <th>Rritja</th>
            </tr>

            <tr>
                <td>TV Paketa</td>
                <td><span class="badge green">Aktive</span></td>
                <td>+24%</td>
            </tr>

            <tr>
                <td>Internet Fiber</td>
                <td><span class="badge blue">Stabile</span></td>
                <td>+18%</td>
            </tr>

            <tr>
                <td>E-Shop</td>
                <td><span class="badge green">Shitje të mira</span></td>
                <td>+31%</td>
            </tr>

            <tr>
                <td>Telefonia Fikse</td>
                <td><span class="badge red">Rënie</span></td>
                <td>-8%</td>
            </tr>

        </table>

    </div>

</div>
</div>
</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>
