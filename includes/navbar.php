<header class="header">
<div class="container">
<div class="header-content">

 <div class="logo">
          <a href="telecomeoperator.php">
            <img src="telecomoperator_foto/NETWAVE Logo Design.png" alt="NetWave Logo">
          </a>
        </div>

         <!-- Menu Toggle (mobile) -->
        <input type="checkbox" id="menu-toggle" class="menu-toggle-input">
        <label for="menu-toggle" class="menu-toggle-label">
          <span class="hamburger"></span>
        </label>

<nav class="nav">
<ul class="nav-list">

<li class="nav-item-dropdown">
               <a href="tv-packages.html" class="nav-link">TV <span class="chevron"><svg viewBox="0 0 16 10"><path d="M2 3 L8 8 L14 3"/></svg></span></a>
                <ul class="dropdown">
                    <li><a href="tv-packages.html">Pakot TV</a></li>
                    <li><a href="tv+internet.html">Pakot TV + internet</a></li>
                    <li><a href="channels-list.html">Lista e kanaleve</a></li>
                </ul>
            </li>

            <li class="nav-item-dropdown">
              <a href="fiber_internet.html" class="nav-link">Internet <span class="chevron"><svg viewBox="0 0 16 10"><path d="M2 3 L8 8 L14 3"/></svg></span></a>
              <ul class="dropdown">
                <li><a href="fiber_internet.html">Fiber Internet</a></li>
                <li><a href="5G.html">5G</a></li>
                <li><a href="telefoniafikse">Telefonia Fikse</a></li>
              </ul>
            </li>

            <li class="nav-item-dropdown">
              <a href="telefona.html" class="nav-link">E-Shop <span class="chevron"><svg viewBox="0 0 16 10"><path d="M2 3 L8 8 L14 3"/></svg></span></a>
              <ul class="dropdown">
                <li><a href="telefona.html">Telefona</a></li>
                <li><a href="laptopa.html">Laptopë</a></li>
                <li><a href="televizora.html">Televizorë</a></li>
                <li><a href="routera.html">Routera</a></li>
              </ul>
            </li>

<?php if(isset($_SESSION['user'])): ?>

    <?php if($_SESSION['role']=="admin"): ?>
        <li class="nav-item-dropdown">
            <a href="admin.php" class="nav-link">
                Admin Panel
                <span class="chevron">
                    <svg viewBox="0 0 16 10">
                        <path d="M2 3 L8 8 L14 3"/>
                    </svg>
                </span>
            </a>
        </li>
    <?php endif; ?>

    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);

    if($currentPage == "admin.php"){
        $redirectPage = "telecomoperator.php";
    } else {
        $redirectPage = $_SERVER['REQUEST_URI'];
    }
    ?>

    <li>
        <a class="btn-login"
        href="logout.php?page=<?php echo urlencode($redirectPage); ?>">
        Logout
        </a>
    </li>

<?php else: ?>

    <li>
        <a class="btn-login"
        href="login.php?page=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
        Login
        </a>
    </li>

<?php endif; ?>

</ul>
</nav>

</div>
</div>
</header>