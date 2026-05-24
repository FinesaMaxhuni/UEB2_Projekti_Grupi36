<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $username = trim($_POST['username']);
    $newPassword = trim($_POST['new_password']);
    $confirm = trim($_POST['confirm_password']);

    if(strlen($newPassword) < 6){

        $error = "Password minimum 6 karaktere.";

    }elseif($newPassword !== $confirm){

        $error = "Passwordat nuk përputhen.";

    }else{

        $check = $pdo->prepare("
        SELECT id FROM users
        WHERE username = ?
        ");

        $check->execute([$username]);

        if($check->rowCount() == 0){

            $error = "User nuk ekziston.";

        }else{

            $hashedPassword =
            password_hash($newPassword,PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
            UPDATE users
            SET password = ?
            WHERE username = ?
            ");

            $stmt->execute([
                $hashedPassword,
                $username
            ]);

            $success =
            "Password u ndryshua me sukses.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>

<meta charset="UTF-8">

<link rel="stylesheet"
href="assets/css/login.css">

<title>Reset Password</title>

</head>

<body>

<section class="login-page">

<div class="login-card">

<div class="login-logo">
<img src="assets/images/telecomoperator_foto/NETWAVE Logo Design.png">
</div>

<h2>Reset Password</h2>

<p class="login-subtitle">
Ndrysho fjalëkalimin e llogarisë
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

<label>Username</label>

<input type="text"
name="username"
placeholder="Username"
required>

<label>New Password</label>

<input type="password"
name="new_password"
placeholder="New Password"
required>

<label>Confirm Password</label>

<input type="password"
name="confirm_password"
placeholder="Confirm Password"
required>

<button type="submit"
class="login-btn">
Reset Password
</button>

</form>

<div class="auth-switch">
<a href="login.php">
Back To Login
</a>
</div>

</div>
</section>

</body>
</html>