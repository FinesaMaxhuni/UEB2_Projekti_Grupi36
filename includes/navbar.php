<header class="header">
<div class="container">
<div class="header-content">

 <div class="logo">
          <a href="pages/telecomeoperator.php">
            <img src="assets/images/telecomoperator_foto/NETWAVE Logo Design.png" alt="NetWave Logo">
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
               <a href="pages/tv-packages.php" class="nav-link">TV <span class="chevron"><svg viewBox="0 0 16 10"><path d="M2 3 L8 8 L14 3"/></svg></span></a>
                <ul class="dropdown">
                    <li><a href="pages/tv-packages.php">Pakot TV</a></li>
                    <li><a href="pages/tv+internet.php">Pakot TV + internet</a></li>
                    <li><a href="pages/channels-list.php">Lista e kanaleve</a></li>
                </ul>
            </li>

            <li class="nav-item-dropdown">
              <a href="pages/fiber_internet.php" class="nav-link">Internet <span class="chevron"><svg viewBox="0 0 16 10"><path d="M2 3 L8 8 L14 3"/></svg></span></a>
              <ul class="dropdown">
                <li><a href="pages/fiber_internet.php">Fiber Internet</a></li>
                <li><a href="pages/5G.php">5G</a></li>
                <li><a href="pages/telefoniafikse.php">Telefonia Fikse</a></li>
              </ul>
            </li>

            <li class="nav-item-dropdown">
              <a href="pages/telefona.php" class="nav-link">E-Shop <span class="chevron"><svg viewBox="0 0 16 10"><path d="M2 3 L8 8 L14 3"/></svg></span></a>
              <ul class="dropdown">
                <li><a href="pages/telefona.php">Telefona</a></li>
                <li><a href="pages/laptopa.php">Laptopë</a></li>
                <li><a href="pages/televizora.php">Televizorë</a></li>
                <li><a href="pages/routera.php">Routera</a></li>
              </ul>
            </li>

<?php if(isset($_SESSION['user'])): ?>

    <?php if($_SESSION['role']=="admin"): ?>
        <li class="nav-item-dropdown">
            <a href="pages/admin.php" class="nav-link">
                Admin Panel
                <span class="chevron">
                    <svg viewBox="0 0 16 10">
                        <path d="M2 3 L8 8 L14 3"/>
                    </svg>
                </span>
            </a>
        </li>
    <?php endif; ?>

    <li style="color:white; font-weight:600; margin-left:15px;">
         <?php echo htmlspecialchars($_SESSION['user']); ?>
       
    </li>

    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);

   if($_SESSION['role'] == "admin"){
    $redirectPage = "pages/telecomeoperator.php";
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

    <?php if (isset($_COOKIE['netwave_user'])): ?>
        <li style="color:white; margin-left:15px;">
            Mirë se u ktheve, <?php echo htmlspecialchars($_COOKIE['netwave_user']); ?> 😊
        </li>
    <?php endif; ?>

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