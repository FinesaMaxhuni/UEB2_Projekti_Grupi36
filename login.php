<?php
include 'config.php';

$page = $_GET['page'] ?? '/pages/telecomoperator.php';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(isset($users[$username]) &&
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

    $error = "Gabim kredencialet!";
}
?>



<style>
/* BACKGROUND */
.login-page{
    min-height:100vh;
    background:linear-gradient(135deg,#0a1929,#0f172a);
    display:flex;
    justify-content:center;
    align-items:center;
    padding:40px 20px;
}

/* KARTA */
.login-card{
    width:100%;
    max-width:520px;
    background:rgba(255,255,255,0.05);
    border-radius:18px;
    padding:45px;
    box-shadow:0 10px 40px rgba(0,0,0,0.35);
    backdrop-filter:blur(12px);
    animation:fadeIn .6s ease;
}

/* LOGO */
.login-logo{
    text-align:center;
    margin-bottom:15px;
}

.login-logo img{
    width:90px;
    height:auto;
}

/* TITULLI */
.login-card h2{
    text-align:center;
    color:#60a5fa;
    font-size:34px;
    margin-bottom:30px;
}

/* LABEL */
.login-card label{
    display:block;
    margin-bottom:8px;
    color:#cbd5e1;
    font-weight:600;
    font-size:15px;
}

/* INPUT */
.login-card input{
    width:100%;
    padding:14px;
    border:none;
    outline:none;
    border-radius:10px;
    margin-bottom:18px;
    font-size:15px;
}

.login-card input:focus{
    box-shadow:0 0 0 2px #60a5fa;
}

/* ERROR */
.error-box{
    background:rgba(239,68,68,.15);
    color:#f87171;
    padding:12px;
    border-radius:10px;
    margin-bottom:18px;
    font-size:14px;
}

/* BUTONI */
.login-btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:10px;
    background:#60a5fa;
    color:white;
    font-size:17px;
    font-weight:700;
    cursor:pointer;
    transition:.3s;
}

.login-btn:hover{
    background:#2563eb;
}

/* EXTRA */
.login-links{
    margin-top:18px;
    text-align:right;
}

.login-links a{
    color:#93c5fd;
    text-decoration:none;
    font-size:14px;
}

.login-links a:hover{
    text-decoration:underline;
}

.demo-users{
    margin-top:25px;
    text-align:center;
    color:#cbd5e1;
    font-size:14px;
    line-height:1.8;
}

.demo-users span{
    color:#60a5fa;
    font-weight:bold;
}

@keyframes fadeIn{
    from{opacity:0;transform:translateY(15px);}
    to{opacity:1;transform:translateY(0);}
}

@media(max-width:600px){
    .login-card{
        padding:30px 22px;
    }

    .login-card h2{
        font-size:28px;
    }
}
</style>

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