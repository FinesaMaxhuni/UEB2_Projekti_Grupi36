<?php

$pageCSS = "tv-admin.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';
$errors = [];

if(($type != 'tv' && $type != 'tv_internet') || !ctype_digit((string)$id)){
    die("Paketa nuk eshte valide.");
}

if($type == 'tv'){
    $stmt = $pdo->prepare("
    SELECT id, package_name, price, channels_count, description
    FROM tv_packages
    WHERE id=?
    ");
}else{
    $stmt = $pdo->prepare("
    SELECT id, package_name, internet_speed, price, channels_count, description
    FROM tv_internet_packages
    WHERE id=?
    ");
}

$stmt->execute([$id]);
$package = $stmt->fetch();

if(!$package){
    die("Paketa nuk ekziston.");
}

$channels = $pdo->query("
SELECT id, channel_name, category
FROM channels
ORDER BY category, channel_name
")->fetchAll();

$selectedChannels = [];

if($type == 'tv'){
    $selectedStmt = $pdo->prepare("
    SELECT channel_id
    FROM permbajtja
    WHERE tv_package_id=?
    ");

    $selectedStmt->execute([$id]);
    $selectedChannels = $selectedStmt->fetchAll(PDO::FETCH_COLUMN);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $packageName = trim($_POST['package_name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $channelsCount = trim($_POST['channels_count'] ?? '');
    $internetSpeed = trim($_POST['internet_speed'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $postedChannels = $_POST['channels'] ?? [];

    if($packageName == ''){
        $errors[] = "Emri i paketes eshte i detyrueshem.";
    }

    if($price === '' || !is_numeric($price) || $price < 0){
        $errors[] = "Cmimi duhet te jete numer valid.";
    }

    if($channelsCount === '' || !ctype_digit($channelsCount)){
        $errors[] = "Numri i kanaleve duhet te jete numer i plote.";
    }

    if($type == 'tv_internet' && $internetSpeed == ''){
        $errors[] = "Shpejtesia e internetit eshte e detyrueshme.";
    }

    if(empty($errors)){
        if($type == 'tv'){
            $pdo->beginTransaction();

            $update = $pdo->prepare("
            UPDATE tv_packages
            SET package_name=?, price=?, channels_count=?, description=?
            WHERE id=?
            ");

            $update->execute([
                $packageName,
                $price,
                $channelsCount,
                $description,
                $id
            ]);

            $deleteChannels = $pdo->prepare("
            DELETE FROM permbajtja
            WHERE tv_package_id=?
            ");

            $deleteChannels->execute([$id]);

            $linkChannel = $pdo->prepare("
            INSERT INTO permbajtja(tv_package_id, channel_id)
            VALUES(?, ?)
            ");

            foreach($postedChannels as $channelId){
                if(ctype_digit((string)$channelId)){
                    $linkChannel->execute([$id, $channelId]);
                }
            }

            $pdo->commit();
        }else{
            $update = $pdo->prepare("
            UPDATE tv_internet_packages
            SET package_name=?, internet_speed=?, price=?, channels_count=?, description=?
            WHERE id=?
            ");

            $update->execute([
                $packageName,
                $internetSpeed,
                $price,
                $channelsCount,
                $description,
                $id
            ]);
        }

        header("Location: tv-admin.php");
        exit();
    }

    $package['package_name'] = $packageName;
    $package['price'] = $price;
    $package['channels_count'] = $channelsCount;
    $package['description'] = $description;

    if($type == 'tv_internet'){
        $package['internet_speed'] = $internetSpeed;
    }else{
        $selectedChannels = $postedChannels;
    }
}

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';
?>

<section class="tv-admin-page">

<div class="container">

    <div class="package-form-card">

        <div class="form-title-row">
            <div>
                <h1>Edito Pakete</h1>
                <p>Ndrysho te dhenat e paketes.</p>
            </div>

            <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php" class="show-btn">
                Kthehu
            </a>
        </div>

        <?php if(!empty($errors)): ?>
        <div class="form-errors">
            <?php foreach($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <form method="POST" class="package-form">

            <div class="form-group">
                <label>Lloji</label>
                <input type="text" value="<?php echo $type == 'tv' ? 'TV' : 'TV + Internet'; ?>" disabled>
            </div>

            <div class="form-group">
                <label>Emri i paketes</label>
                <input type="text" name="package_name" value="<?php echo htmlspecialchars($package['package_name']); ?>" required>
            </div>

            <?php if($type == 'tv_internet'): ?>
            <div class="form-group">
                <label>Shpejtesia e internetit</label>
                <input type="text" name="internet_speed" value="<?php echo htmlspecialchars($package['internet_speed']); ?>" required>
            </div>
            <?php endif; ?>

            <div class="form-grid">
                <div class="form-group">
                    <label>Cmimi</label>
                    <input type="number" step="0.01" min="0" name="price" value="<?php echo htmlspecialchars($package['price']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Numri i kanaleve</label>
                    <input type="number" min="0" name="channels_count" value="<?php echo htmlspecialchars($package['channels_count']); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Pershkrimi</label>
                <textarea name="description" rows="4"><?php echo htmlspecialchars($package['description']); ?></textarea>
            </div>

            <?php if($type == 'tv'): ?>
            <div class="form-group">
                <label>Kanalet qe shfaqen te paketa TV</label>

                <div class="checkbox-grid">
                    <?php foreach($channels as $channel): ?>
                    <label>
                        <input
                        type="checkbox"
                        name="channels[]"
                        value="<?php echo $channel['id']; ?>"
                        <?php if(in_array($channel['id'], $selectedChannels)) echo 'checked'; ?>>
                        <?php echo htmlspecialchars($channel['channel_name']); ?>
                        <small><?php echo htmlspecialchars($channel['category']); ?></small>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="form-actions">
                <button type="submit" class="add-btn">Ruaj Ndryshimet</button>
                <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php" class="cancel-link">Anulo</a>
            </div>

        </form>

    </div>

</div>

</section>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
?>
