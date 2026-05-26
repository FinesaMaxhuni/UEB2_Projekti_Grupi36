<?php

$pageCSS = "edit-user.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("
SELECT * FROM users
WHERE id=?
");

$stmt->execute([$id]);

$user = $stmt->fetch();

if(!$user){
    die("User nuk ekziston.");
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);
    $city = trim($_POST['city']);
    $role = trim($_POST['role']);

    $update = $pdo->prepare("
    UPDATE users
    SET
    fullname=?,
    email=?,
    gender=?,
    city=?,
    role=?
    WHERE id=?
    ");

    $update->execute([
        $fullname,
        $email,
        $gender,
        $city,
        $role,
        $id
    ]);

    header("Location: perdoruesit.php");
    exit();
}
?>

<section class="edit-user-page">

    <div class="edit-user-container">

        <div class="edit-user-card">

            <div class="edit-header">
                <h1>Edit User</h1>
                <p>Menaxho informacionet e përdoruesit</p>
            </div>

            <form method="POST" class="edit-form">

                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input
                    type="text"
                    id="fullname"
                    name="fullname"
                    value="<?php echo htmlspecialchars($user['fullname']); ?>"
                    required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?php echo htmlspecialchars($user['email']); ?>"
                    required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="Mashkull" <?php if($user['gender']=="Mashkull") echo "selected"; ?>>
                            Mashkull
                        </option>
                        <option value="Femër" <?php if($user['gender']=="Femër") echo "selected"; ?>>
                            Femër
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <input
                    type="text"
                    id="city"
                    name="city"
                    value="<?php echo htmlspecialchars($user['city']); ?>"
                    required>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role">
                        <option value="user" <?php if($user['role']=="user") echo "selected"; ?>>
                            User
                        </option>
                        <option value="admin" <?php if($user['role']=="admin") echo "selected"; ?>>
                            Admin
                        </option>
                    </select>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="save-btn">Update User</button>
                    <a href="/UEB2_Projekti_Grupi36/pages/perdoruesit.php" class="cancel-btn">Cancel</a>
                </div>

            </form>

        </div>

    </div>

</section>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
?>