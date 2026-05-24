<?php

$pageCSS = "tv-admin.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

$errors = [];
$channels = $pdo->query("
SELECT id, channel_name, category
FROM channels
ORDER BY category, channel_name
")->fetchAll();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $type = $_POST['type'] ?? 'tv';
    $packageName = trim($_POST['package_name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $channelsCount = trim($_POST['channels_count'] ?? '');
    $internetSpeed = trim($_POST['internet_speed'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $selectedChannels = $_POST['channels'] ?? [];

    if($type != 'tv' && $type != 'tv_internet'){
        $errors[] = "Lloji i paketes nuk eshte valid.";
    }

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

            $insert = $pdo->prepare("
            INSERT INTO tv_packages(package_name, price, channels_count, description)
            VALUES(?, ?, ?, ?)
            ");

            $insert->execute([
                $packageName,
                $price,
                $channelsCount,
                $description
            ]);

            $packageId = $pdo->lastInsertId();

            $linkChannel = $pdo->prepare("
            INSERT INTO permbajtja(tv_package_id, channel_id)
            VALUES(?, ?)
            ");

            foreach($selectedChannels as $channelId){
                if(ctype_digit((string)$channelId)){
                    $linkChannel->execute([$packageId, $channelId]);
                }
            }

            $pdo->commit();
        }else{
            $insert = $pdo->prepare("
            INSERT INTO tv_internet_packages(package_name, internet_speed, price, channels_count, description)
            VALUES(?, ?, ?, ?, ?)
            ");

            $insert->execute([
                $packageName,
                $internetSpeed,
                $price,
                $channelsCount,
                $description
            ]);
        }

        header("Location: tv-admin.php");
        exit();
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
                <h1>Shto Pakete</h1>
                <p>Ploteso te dhenat per paketen e re.</p>
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
                <select name="type" id="packageType">
                    <option value="tv" <?php if(($_POST['type'] ?? '') == 'tv') echo 'selected'; ?>>
                        TV
                    </option>
                    <option value="tv_internet" <?php if(($_POST['type'] ?? '') == 'tv_internet') echo 'selected'; ?>>
                        TV + Internet
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Emri i paketes</label>
                <input type="text" name="package_name" value="<?php echo htmlspecialchars($_POST['package_name'] ?? ''); ?>" required>
            </div>

            <div class="form-group internet-field">
                <label>Shpejtesia e internetit</label>
                <input type="text" name="internet_speed" value="<?php echo htmlspecialchars($_POST['internet_speed'] ?? ''); ?>" placeholder="p.sh. 100 Mbps">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Cmimi</label>
                    <input type="number" step="0.01" min="0" name="price" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label>Numri i kanaleve</label>
                    <input type="number" min="0" name="channels_count" value="<?php echo htmlspecialchars($_POST['channels_count'] ?? ''); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Pershkrimi</label>
                <textarea name="description" rows="4"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-group channel-field">
                <label>Kanalet qe shfaqen te paketa TV</label>

                <div class="checkbox-grid">
                    <?php foreach($channels as $channel): ?>
                    <label>
                        <input
                        type="checkbox"
                        name="channels[]"
                        value="<?php echo $channel['id']; ?>"
                        <?php if(in_array($channel['id'], $_POST['channels'] ?? [])) echo 'checked'; ?>>
                        <?php echo htmlspecialchars($channel['channel_name']); ?>
                        <small><?php echo htmlspecialchars($channel['category']); ?></small>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="add-btn">Ruaj Paketen</button>
                <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php" class="cancel-link">Anulo</a>
            </div>

        </form>

    </div>

</div>

</section>

<script>
const packageType = document.getElementById('packageType');
const internetFields = document.querySelectorAll('.internet-field');
const channelFields = document.querySelectorAll('.channel-field');

function syncPackageFields(){
    const isInternet = packageType.value === 'tv_internet';
    internetFields.forEach(field => field.style.display = isInternet ? 'block' : 'none');
    channelFields.forEach(field => field.style.display = isInternet ? 'none' : 'block');
}

packageType.addEventListener('change', syncPackageFields);
syncPackageFields();
</script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
?>
