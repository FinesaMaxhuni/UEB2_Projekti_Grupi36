<?php

$pageCSS = "perdoruesit.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

/* TOTAL USERS */

$totalUsers = $pdo->query("
SELECT COUNT(*) FROM users
")->fetchColumn();

/* USERS */

$stmt = $pdo->query("
SELECT * FROM users
ORDER BY id DESC
");

$users = $stmt->fetchAll();

?>

<!-- HERO -->

<section class="users-hero">

    <div class="container">

        <h1>Menaxhimi i Përdoruesve</h1>

        <p>
            Statistika dhe përdoruesit aktivë të NetWave.
        </p>
  <a href="/UEB2_Projekti_Grupi36/pages/perdoruesit.php#lista" class="btn btn-primary">

            Shiko përdoruesit

        </a>

    </div>

</section>

<!-- STATS -->

<section class="users-stats">

    <div class="container">

        <div class="stats-grid">

            <div class="stat-card">

                <h3>Përdorues Total</h3>

                <span>
                    <?php echo $totalUsers; ?>
                </span>

            </div>

            <div class="stat-card">

                <h3>Admin</h3>

                <span>

                    <?php
                    echo $pdo->query("
                    SELECT COUNT(*) FROM users
                    WHERE role='admin'
                    ")->fetchColumn();
                    ?>

                </span>

            </div>

            <div class="stat-card">

                <h3>User</h3>

                <span>

                    <?php
                    echo $pdo->query("
                    SELECT COUNT(*) FROM users
                    WHERE role='user'
                    ")->fetchColumn();
                    ?>

                </span>

            </div>

        </div>

    </div>

</section>

<!-- USERS -->

<section class="users-list" id="lista">

<div class="container">

<h2 class="section-title">

Lista e Përdoruesve

</h2>

<div class="users-grid">

<?php foreach($users as $u): ?>

<div class="user-card">

    <h3>

        <?php
        echo htmlspecialchars($u['fullname']);
        ?>

    </h3>

    <div class="user-info">

        <span>
            👤
            <?php echo htmlspecialchars($u['gender']); ?>
        </span>

        <span>
            📍
            <?php echo htmlspecialchars($u['city']); ?>
        </span>

        <span>
            📧
            <?php echo htmlspecialchars($u['email']); ?>
        </span>

        <span>
            🛡️
            <?php echo htmlspecialchars($u['role']); ?>
        </span>

    </div>

    <div class="user-actions">

        <a
        class="edit-btn"

    href="/UEB2_Projekti_Grupi36/pages/edit-user.php?id=<?php echo $u['id']; ?>">

            Edit

        </a>

     

        <a
        class="delete-btn"
href="/UEB2_Projekti_Grupi36/pages/delete-user.php?id=<?php echo $u['id']; ?>"

        onclick="return confirm('A je i sigurt?')">

            Delete

        </a>

    </div>

</div>

<?php endforeach; ?>

</div>

</div>

</section>

<?php

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';

?>