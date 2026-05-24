<?php

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

/*
|-------------------------------------------------
| Merr faqen prej nga erdhi useri
|-------------------------------------------------
*/

$page = $_GET['page']
?? '/UEB2_Projekti_Grupi36/pages/telecomeoperator.php';

/*
|-------------------------------------------------
| Login
|-------------------------------------------------
*/

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("
        SELECT * FROM users
        WHERE username = ?
    ");

    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if(
        $user &&
        password_verify($password, $user['password'])
    ){

        session_regenerate_id(true);

        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        setcookie(
            "netwave_user",
            $user['username'],
            time() + (86400 * 7),
            "/",
            "",
            false,
            true
        );

        /*
        |-------------------------------------------------
        | Ktheje userin ne faqen ku ka qene
        |-------------------------------------------------
        */

        $redirectPage =
        $_POST['page']
        ?? '/UEB2_Projekti_Grupi36/pages/telecomeoperator.php';

        header("Location: " . $redirectPage);
        exit();

    }else{

        $error = "Username ose password gabim.";
    }
}
?>

<!DOCTYPE html>
<html lang="sq">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../assets/css/login.css?v=<?php echo time(); ?>">

<title>Login</title>

</head>

<body>

<section class="login-page">

<div class="login-card">

    <div class="login-logo">
        <img src="../assets/images/telecomoperator_foto/NETWAVE Logo Design.png">
    </div>

    <h2>Kyçu në NetWave</h2>

    <?php if(isset($error)): ?>
        <div class="error-box">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <input
        type="hidden"
        name="page"
        value="<?php echo htmlspecialchars($page); ?>">

        <input
        type="text"
        name="username"
        placeholder="Username"
        required>

        <input
        type="password"
        name="password"
        placeholder="Password"
        required>

        <div class="login-links">

            <a href="../auth/resetpassword.php">
                Forgot Password?
            </a>

        </div>

        <button type="submit" class="login-btn">

            Login

        </button>

    </form>

    <div class="auth-switch">

        Don't have an account?

        <a href="../auth/signup.php">Sign Up</a>
       
    </div>

</div>

</section>

</body>
</html>