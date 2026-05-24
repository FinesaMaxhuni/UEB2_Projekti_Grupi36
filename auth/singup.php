<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);

    if(empty($fullname)){

        $error = "Full Name kërkohet.";

    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $error = "Email jo valid.";

    }elseif(!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)){

        $error = "Username jo valid.";

    }elseif(strlen($password) < 6){

        $error = "Password duhet minimum 6 karaktere.";

    }elseif($password !== $confirm){

        $error = "Passwordat nuk përputhen.";

    }else{

        $check = $pdo->prepare("
        SELECT id FROM users
        WHERE username = ?
        OR email = ?
        ");

        $check->execute([$username, $email]);

        if($check->rowCount() > 0){

            $error = "Username ose email ekziston.";

        }else{

            $hashedPassword =
            password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
            INSERT INTO users(
            username,
            email,
            password,
            role
            )
            VALUES(?,?,?,?)
            ");

            $stmt->execute([
                $username,
                $email,
                $hashedPassword,
                'user'
            ]);

            $success = "Llogaria u krijua me sukses.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sq">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
href="../assets/css/signup.css">

<title>Signup</title>

</head>

<body>

<section class="signup-page">

<div class="signup-card">

<h2>Create Account</h2>

<p class="subtitle">
Sign up to get started
</p>

<?php if(isset($error)): ?>

<div class="error-box">
<?php echo $error; ?>
</div>

<?php endif; ?>

<?php if(isset($success)): ?>

<div class="success-box">
<?php echo $success; ?>
</div>

<?php endif; ?>

<form method="POST">

<input
type="text"
name="fullname"
placeholder="Full Name"
required>

<input
type="email"
name="email"
placeholder="Email"
required>

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

<input
type="password"
name="confirm_password"
placeholder="Confirm Password"
required>

<button
type="submit"
class="signup-btn">

Sign Up

</button>

</form>

<div class="auth-switch">

Already have an account?

<a href="auth/login.php">
Login
</a>

</div>

</div>

</section>

</body>
</html>