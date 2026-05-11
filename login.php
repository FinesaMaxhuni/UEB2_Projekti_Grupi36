<?php
include 'config.php';

$page = $_GET['page'] ?? '/pages/telecomeoperator.php';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // REGEX për username
    if(!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username))
    {
        $error = "Username duhet të ketë 3-20 karaktere dhe vetëm shkronja, numra ose _.";
    }

    // REGEX për password
    elseif(!preg_match("/^[a-zA-Z0-9!@#$%^&*]{4,20}$/", $password))
    {
        $error = "Password jo valid.";
    }

    // LOGIN CHECK
    elseif(isset($users[$username]) &&
           $users[$username]['password'] == $password)
    {
        // SESSION
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $users[$username]['role'];
        $_SESSION['login_time'] = date("H:i:s");

        // COOKIE
        setcookie("netwave_user", $username, time() + (86400 * 7), "/");
        setcookie("netwave_role", $users[$username]['role'], time() + (86400 * 7), "/");

        header("Location: ".$_POST['page']);
        exit();
    }
    else
    {
        $error = "Gabim kredencialet!";
    }
}
?>


<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet"
    href="/UEB2_Projekti_Grupi36/assets/css/login.css">

    <title>Login</title>
</head>

<body>


<section class="login-page">

<div class="login-card">

    

    <h2>Kyçu në NetWave</h2>

    <?php if(isset($error)): ?>
        <div class="error-box"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">

        <input type="hidden" name="page"
        value="<?php echo htmlspecialchars($page); ?>">

        <label>Përdoruesi</label>
        <input type="text" name="username"
        placeholder="Shkruani username" required>

        <label>Fjalëkalimi</label>
        <input type="password" name="password"
        placeholder="Shkruani fjalëkalimin" required>

        <div class="login-links">
            <a href="#">Keni harruar fjalëkalimin?</a>
        </div>

        <button type="submit" class="login-btn">
            Kyçu
        </button>

    </form>

    <div class="demo-users">
        <p><span>Admin:</span> admin / 1234</p>
        <p><span>User:</span> user / 1234</p>
    </div>

</div>
</section>

</body>
</html>