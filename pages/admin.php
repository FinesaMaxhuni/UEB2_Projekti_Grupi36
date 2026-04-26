<?php
include 'config.php';

if(!isset($_SESSION['user']) || $_SESSION['role']!="admin")
{
    die("Nuk ke qasje.");
}
?>

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<style>
/* ADMIN PANEL */
.admin-page{
    background: linear-gradient(135deg,#f5f7fb 0%,#eef2f7 100%);
    min-height: 100vh;
    padding: 50px 0;
}

.admin-container{
    max-width: 1300px;
    margin: auto;
    padding: 0 20px;
}

.admin-grid{
    display:grid;
    grid-template-columns: 260px 1fr;
    gap:30px;
}

/* Sidebar */
.admin-sidebar{
    background:#ffffff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.admin-sidebar h3{
    font-size:22px;
    margin-bottom:25px;
    color:#0a2540;
}

.admin-menu{
    list-style:none;
    padding:0;
    margin:0;
}

.admin-menu li{
    margin-bottom:12px;
}

.admin-menu a{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px 16px;
    text-decoration:none;
    background:#f7f9fc;
    color:#0a2540;
    border-radius:12px;
    font-weight:700;
    transition:0.3s;
}

.admin-menu a:hover{
    background:#0a2540;
    color:#fff;
    transform:translateX(5px);
}

.admin-menu span{
    font-size:18px;
}

/* Main */
.admin-main{
    background:#ffffff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.admin-title{
    font-size:34px;
    font-weight:800;
    color:#0a2540;
    margin-bottom:30px;
}

/* Stats */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:35px;
}

.stat-box{
    background:linear-gradient(135deg,#0a2540,#1c4a78);
    color:white;
    border-radius:18px;
    padding:25px;
}

.stat-box h4{
    font-size:16px;
    margin-bottom:12px;
    opacity:0.9;
}

.stat-number{
    font-size:34px;
    font-weight:800;
}

/* Table */
.admin-table{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:14px;
}

.admin-table th{
    background:#0a2540;
    color:#fff;
    text-align:left;
    padding:15px;
}

.admin-table td{
    padding:15px;
    border-bottom:1px solid #eee;
}

.admin-table tr:hover{
    background:#f8f9fc;
}

.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    font-weight:700;
}

.green{background:#d1fae5;color:#065f46;}
.blue{background:#dbeafe;color:#1d4ed8;}
.red{background:#fee2e2;color:#b91c1c;}

@media(max-width:900px){
    .admin-grid{
        grid-template-columns:1fr;
    }
}
</style>

<section class="admin-page">
<div class="admin-container">

<div class="admin-grid">

    <!-- Sidebar -->
    <div class="admin-sidebar">
        <h3>Admin Menu</h3>

        <ul class="admin-menu">
            <li><a href="#"><span>📺</span> TV Paketa <span>›</span></a></li>
            <li><a href="#"><span>🌐</span> Internet <span>›</span></a></li>
            <li><a href="#"><span>🛒</span> E-Shop <span>›</span></a></li>
            <li><a href="#"><span>☎️</span> Telefonia Fikse <span>›</span></a></li>
            <li><a href="#"><span>👥</span> Përdoruesit <span>›</span></a></li>
            <li><a href="#"><span>⚙️</span> Settings <span>›</span></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="admin-main">

        <div class="admin-title">Admin Dashboard</div>

        <div class="stats-grid">

            <div class="stat-box">
                <h4>Përdorues Total</h4>
                <div class="stat-number">1,245</div>
            </div>

            <div class="stat-box">
                <h4>Paketa TV Shit</h4>
                <div class="stat-number">386</div>
            </div>

            <div class="stat-box">
                <h4>Telefoni Fikse</h4>
                <div class="stat-number">212</div>
            </div>

            <div class="stat-box">
                <h4>E-Shop Shitje</h4>
                <div class="stat-number">€14,520</div>
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

<?php include 'footer.php'; ?>