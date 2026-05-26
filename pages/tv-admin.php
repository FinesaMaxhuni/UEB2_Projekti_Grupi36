<?php

$pageCSS = "tv-admin.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

$action = $_GET['action'] ?? 'list';
$errors = [];

function redirectTvAdmin(){
    header("Location: /UEB2_Projekti_Grupi36/pages/tv-admin.php");
    exit();
}

function getChannels($pdo){
    return $pdo->query("
    SELECT id, channel_name, category
    FROM channels
    ORDER BY category, channel_name
    ")->fetchAll();
}

function channelTags($channels, $totalChannels){
    $items = array_filter(array_map('trim', explode(',', (string)$channels)));
    $visibleItems = array_slice($items, 0, 4);
    $html = '';

    foreach($visibleItems as $item){
        $html .= '<span>' . htmlspecialchars($item) . '</span>';
    }

    $html .= '<span class="plus-tag">' . htmlspecialchars($totalChannels) . ' kanale</span>';

    return $html;
}

function requireNumericId($id, $message){
    if(!ctype_digit((string)$id)){
        die($message);
    }
}

if($action == 'delete_package'){
    $type = $_GET['type'] ?? '';
    $id = $_GET['id'] ?? '';

    requireNumericId($id, "Paketa nuk eshte valide.");

    if($type == 'tv'){
        $pdo->beginTransaction();
        $pdo->prepare("DELETE FROM permbajtja WHERE tv_package_id=?")->execute([$id]);
        $pdo->prepare("UPDATE aktivizo SET tv_package_id=NULL WHERE tv_package_id=?")->execute([$id]);
        $pdo->prepare("DELETE FROM tv_packages WHERE id=?")->execute([$id]);
        $pdo->commit();
    }elseif($type == 'tv_internet'){
        $pdo->beginTransaction();
        $pdo->prepare("UPDATE aktivizo SET tv_internet_package_id=NULL WHERE tv_internet_package_id=?")->execute([$id]);
        $pdo->prepare("DELETE FROM tv_internet_packages WHERE id=?")->execute([$id]);
        $pdo->commit();
    }

    redirectTvAdmin();
}

if($action == 'delete_channel'){
    $id = $_GET['id'] ?? '';

    requireNumericId($id, "Kanali nuk eshte valid.");

    $pdo->beginTransaction();
    $pdo->prepare("DELETE FROM permbajtja WHERE channel_id=?")->execute([$id]);
    $pdo->prepare("DELETE FROM channels WHERE id=?")->execute([$id]);
    $pdo->commit();

    redirectTvAdmin();
}

if($action == 'add_package' || $action == 'edit_package'){
    $type = $_GET['type'] ?? ($_POST['type'] ?? 'tv');
    $id = $_GET['id'] ?? '';
    $package = [
        'package_name' => '',
        'internet_speed' => '',
        'price' => '',
        'channels_count' => '',
        'description' => ''
    ];
    $selectedChannels = [];

    if($action == 'edit_package'){
        requireNumericId($id, "Paketa nuk eshte valide.");

        if($type == 'tv'){
            $stmt = $pdo->prepare("
            SELECT id, package_name, price, channels_count, description
            FROM tv_packages
            WHERE id=?
            ");
        }elseif($type == 'tv_internet'){
            $stmt = $pdo->prepare("
            SELECT id, package_name, internet_speed, price, channels_count, description
            FROM tv_internet_packages
            WHERE id=?
            ");
        }else{
            die("Paketa nuk eshte valide.");
        }

        $stmt->execute([$id]);
        $package = $stmt->fetch();

        if(!$package){
            die("Paketa nuk ekziston.");
        }

        if($type == 'tv'){
            $selectedStmt = $pdo->prepare("
            SELECT channel_id
            FROM permbajtja
            WHERE tv_package_id=?
            ");
            $selectedStmt->execute([$id]);
            $selectedChannels = $selectedStmt->fetchAll(PDO::FETCH_COLUMN);
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $type = $_POST['type'] ?? $type;
        $packageName = trim($_POST['package_name'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $channelsCount = trim($_POST['channels_count'] ?? '');
        $internetSpeed = trim($_POST['internet_speed'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $postedChannels = $_POST['channels'] ?? [];

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

                if($action == 'add_package'){
                    $stmt = $pdo->prepare("
                    INSERT INTO tv_packages(package_name, price, channels_count, description)
                    VALUES(?, ?, ?, ?)
                    ");
                    $stmt->execute([$packageName, $price, $channelsCount, $description]);
                    $packageId = $pdo->lastInsertId();
                }else{
                    $stmt = $pdo->prepare("
                    UPDATE tv_packages
                    SET package_name=?, price=?, channels_count=?, description=?
                    WHERE id=?
                    ");
                    $stmt->execute([$packageName, $price, $channelsCount, $description, $id]);
                    $packageId = $id;
                    $pdo->prepare("DELETE FROM permbajtja WHERE tv_package_id=?")->execute([$id]);
                }

                $linkChannel = $pdo->prepare("
                INSERT INTO permbajtja(tv_package_id, channel_id)
                VALUES(?, ?)
                ");

                foreach($postedChannels as $channelId){
                    if(ctype_digit((string)$channelId)){
                        $linkChannel->execute([$packageId, $channelId]);
                    }
                }

                $pdo->commit();
            }else{
                if($action == 'add_package'){
                    $stmt = $pdo->prepare("
                    INSERT INTO tv_internet_packages(package_name, internet_speed, price, channels_count, description)
                    VALUES(?, ?, ?, ?, ?)
                    ");
                    $stmt->execute([$packageName, $internetSpeed, $price, $channelsCount, $description]);
                }else{
                    $stmt = $pdo->prepare("
                    UPDATE tv_internet_packages
                    SET package_name=?, internet_speed=?, price=?, channels_count=?, description=?
                    WHERE id=?
                    ");
                    $stmt->execute([$packageName, $internetSpeed, $price, $channelsCount, $description, $id]);
                }
            }

            redirectTvAdmin();
        }

        $package = [
            'package_name' => $packageName,
            'internet_speed' => $internetSpeed,
            'price' => $price,
            'channels_count' => $channelsCount,
            'description' => $description
        ];
        $selectedChannels = $postedChannels;
    }
}

if($action == 'add_channel' || $action == 'edit_channel'){
    $id = $_GET['id'] ?? '';
    $channel = [
        'channel_name' => '',
        'category' => ''
    ];

    if($action == 'edit_channel'){
        requireNumericId($id, "Kanali nuk eshte valid.");

        $stmt = $pdo->prepare("
        SELECT id, channel_name, category
        FROM channels
        WHERE id=?
        ");
        $stmt->execute([$id]);
        $channel = $stmt->fetch();

        if(!$channel){
            die("Kanali nuk ekziston.");
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $channelName = trim($_POST['channel_name'] ?? '');
        $category = trim($_POST['category'] ?? '');

        if($channelName == ''){
            $errors[] = "Emri i kanalit eshte i detyrueshem.";
        }

        if($category == ''){
            $errors[] = "Kategoria eshte e detyrueshme.";
        }

        if(empty($errors)){
            if($action == 'add_channel'){
                $stmt = $pdo->prepare("
                INSERT INTO channels(channel_name, category)
                VALUES(?, ?)
                ");
                $stmt->execute([$channelName, $category]);
            }else{
                $stmt = $pdo->prepare("
                UPDATE channels
                SET channel_name=?, category=?
                WHERE id=?
                ");
                $stmt->execute([$channelName, $category, $id]);
            }

            redirectTvAdmin();
        }

        $channel['channel_name'] = $channelName;
        $channel['category'] = $category;
    }
}

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

function renderErrors($errors){
    if(empty($errors)){
        return;
    }
    ?>
    <div class="form-errors">
        <?php foreach($errors as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
    <?php
}

if($action == 'add_package' || $action == 'edit_package'):
    $channels = getChannels($pdo);
    $isEdit = $action == 'edit_package';
?>

<section class="tv-admin-page">
<div class="container">
    <div class="package-form-card">
        <div class="form-title-row">
            <div>
                <h1><?php echo $isEdit ? 'Edito Pakete' : 'Shto Pakete'; ?></h1>
                <p><?php echo $isEdit ? 'Ndrysho te dhenat e paketes.' : 'Ploteso te dhenat per paketen e re.'; ?></p>
            </div>
            <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php" class="show-btn">Kthehu</a>
        </div>

        <?php renderErrors($errors); ?>

        <form method="POST" class="package-form">
            <div class="form-group">
                <label>Lloji</label>
                <?php if($isEdit): ?>
                    <input type="text" value="<?php echo $type == 'tv' ? 'TV' : 'TV + Internet'; ?>" disabled>
                    <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
                <?php else: ?>
                    <select name="type" id="packageType">
                        <option value="tv" <?php if($type == 'tv') echo 'selected'; ?>>TV</option>
                        <option value="tv_internet" <?php if($type == 'tv_internet') echo 'selected'; ?>>TV + Internet</option>
                    </select>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Emri i paketes</label>
                <input type="text" name="package_name" value="<?php echo htmlspecialchars($package['package_name']); ?>" required>
            </div>

            <div class="form-group internet-field">
                <label>Shpejtesia e internetit</label>
                <input type="text" name="internet_speed" value="<?php echo htmlspecialchars($package['internet_speed'] ?? ''); ?>" placeholder="p.sh. 100 Mbps">
            </div>

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
                <textarea name="description" rows="4"><?php echo htmlspecialchars($package['description'] ?? ''); ?></textarea>
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
                        <?php if(in_array($channel['id'], $selectedChannels)) echo 'checked'; ?>>
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
const typeValue = packageType ? packageType.value : '<?php echo $type; ?>';
const internetFields = document.querySelectorAll('.internet-field');
const channelFields = document.querySelectorAll('.channel-field');

function syncPackageFields(){
    const currentType = packageType ? packageType.value : typeValue;
    const isInternet = currentType === 'tv_internet';
    internetFields.forEach(field => field.style.display = isInternet ? 'grid' : 'none');
    channelFields.forEach(field => field.style.display = isInternet ? 'none' : 'grid');
}

if(packageType){
    packageType.addEventListener('change', syncPackageFields);
}
syncPackageFields();
</script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
exit();
endif;

if($action == 'add_channel' || $action == 'edit_channel'):
    $isEdit = $action == 'edit_channel';
?>

<section class="tv-admin-page">
<div class="container">
    <div class="package-form-card">
        <div class="form-title-row">
            <div>
                <h1><?php echo $isEdit ? 'Edito Kanal' : 'Shto Kanal'; ?></h1>
                <p><?php echo $isEdit ? 'Ndrysho te dhenat e kanalit.' : 'Regjistro kanal te ri per paketat TV.'; ?></p>
            </div>
            <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php" class="show-btn">Kthehu</a>
        </div>

        <?php renderErrors($errors); ?>

        <form method="POST" class="package-form">
            <div class="form-group">
                <label>Emri i kanalit</label>
                <input type="text" name="channel_name" value="<?php echo htmlspecialchars($channel['channel_name']); ?>" required>
            </div>

            <div class="form-group">
                <label>Kategoria</label>
                <input type="text" name="category" value="<?php echo htmlspecialchars($channel['category']); ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="add-btn">Ruaj Kanalin</button>
                <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php" class="cancel-link">Anulo</a>
            </div>
        </form>
    </div>
</div>
</section>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
exit();
endif;

$totalTvPackages = $pdo->query("
SELECT COUNT(*) FROM tv_packages
")->fetchColumn();

$totalTvInternetPackages = $pdo->query("
SELECT COUNT(*) FROM tv_internet_packages
")->fetchColumn();

$channelsPage = $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/pages/channels-list.php';
$totalChannels = file_exists($channelsPage)
    ? substr_count(file_get_contents($channelsPage), 'class="channel-item"')
    : 0;

$tvPackages = $pdo->query("
SELECT
    p.id,
    p.package_name,
    p.price,
    p.channels_count,
    GROUP_CONCAT(c.channel_name ORDER BY c.channel_name SEPARATOR ', ') AS channels
FROM tv_packages p
LEFT JOIN permbajtja pc ON pc.tv_package_id = p.id
LEFT JOIN channels c ON c.id = pc.channel_id
GROUP BY p.id, p.package_name, p.price, p.channels_count
ORDER BY p.id
")->fetchAll();

$tvInternetPackages = $pdo->query("
SELECT
    id,
    package_name,
    internet_speed,
    price,
    channels_count
FROM tv_internet_packages
ORDER BY id
")->fetchAll();

$allPackages = [];

foreach($tvPackages as $package){
    $allPackages[] = [
        'id' => $package['id'],
        'type_key' => 'tv',
        'name' => $package['package_name'],
        'type' => 'TV',
        'price' => $package['price'],
        'channels_count' => $package['channels_count']
    ];
}

foreach($tvInternetPackages as $package){
    $allPackages[] = [
        'id' => $package['id'],
        'type_key' => 'tv_internet',
        'name' => $package['package_name'],
        'type' => 'TV + Internet',
        'price' => $package['price'],
        'channels_count' => $package['channels_count']
    ];
}

$filter = $_GET['filter'] ?? 'all';

if($filter == 'tv'){
    $visiblePackages = array_filter($allPackages, function($package){
        return $package['type_key'] == 'tv';
    });
}elseif($filter == 'tv_internet'){
    $visiblePackages = array_filter($allPackages, function($package){
        return $package['type_key'] == 'tv_internet';
    });
}else{
    $visiblePackages = $allPackages;
}

$addPackageType = $filter == 'tv_internet' ? 'tv_internet' : 'tv';
?>

<section class="tv-admin-page">

<div class="container">

    <div class="tv-top">
        <h1>TV</h1>
    </div>

    <div class="tv-stats-grid">

        <div class="tv-stat-card">
            <div class="tv-icon blue-bg">
                &#128250;
            </div>

            <div class="tv-stat-content">
                <h3>Paketat TV<br>Total</h3>
                <span><?php echo $totalTvPackages; ?></span>
            </div>
        </div>

        <div class="tv-stat-card">
            <div class="tv-icon green-bg">
                &#128225;
            </div>

            <div class="tv-stat-content">
                <h3>Paketat TV + Internet<br>Total</h3>
                <span><?php echo $totalTvInternetPackages; ?></span>
            </div>
        </div>

        <div class="tv-stat-card">
            <div class="tv-icon purple-bg">
                &#9654;&#65039;
            </div>

            <div class="tv-stat-content">
                <h3>Kanale Total</h3>
                <span><?php echo $totalChannels; ?></span>
            </div>
        </div>

    </div>

    <div class="tv-boxes">

        <div class="tv-box">
            <h2>Paketat TV dhe Kanale</h2>

            <table class="tv-table">
                <tr>
                    <th>Paketat TV</th>
                    <th>Kanale te perfshira</th>
                </tr>

                <?php foreach($tvPackages as $package): ?>
                <tr>
                    <td><?php echo htmlspecialchars($package['package_name']); ?></td>
                    <td>
                        <div class="channel-tags">
                            <?php echo channelTags($package['channels'], $package['channels_count']); ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

            <a href="/UEB2_Projekti_Grupi36/pages/channels-list.php" class="show-btn">
                Shiko te gjitha kanalet
            </a>
        </div>

        <div class="tv-box">
            <h2>Paketat TV + Internet</h2>

            <table class="tv-table">
                <tr>
                    <th>Paketat TV + Internet</th>
                    <th>Detaje</th>
                </tr>

                <?php foreach($tvInternetPackages as $package): ?>
                <tr>
                    <td><?php echo htmlspecialchars($package['package_name']); ?></td>
                    <td>
                        <div class="channel-tags">
                            <span><?php echo htmlspecialchars($package['internet_speed']); ?></span>
                            <span><?php echo htmlspecialchars($package['channels_count']); ?> kanale</span>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

            <a href="/UEB2_Projekti_Grupi36/pages/tv+internet.php" class="show-btn">
                Shiko paketat TV + Internet
            </a>
        </div>

    </div>

    <div class="manage-box">
        <div class="manage-top">
            <div>
                <h2>Menaxho Paketat</h2>
                <div class="tabs">
                    <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php?filter=all" class="<?php if($filter == 'all') echo 'active-tab'; ?>">Te gjitha Paketat</a>
                    <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php?filter=tv" class="<?php if($filter == 'tv') echo 'active-tab'; ?>">Paketat TV</a>
                    <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php?filter=tv_internet" class="<?php if($filter == 'tv_internet') echo 'active-tab'; ?>">Paketat TV + Internet</a>
                </div>
            </div>

            <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php?action=add_package&type=<?php echo $addPackageType; ?>" class="add-btn">
                + Shto Pakete te Re
            </a>
        </div>

        <table class="tv-table manage-table">
            <tr>
                <th>ID</th>
                <th>Emri i Paketes</th>
                <th>Lloji</th>
                <th>Cmimi</th>
                <th>Kanale</th>
                <th>Veprimet</th>
            </tr>

            <?php foreach($visiblePackages as $package): ?>
                <tr id="package-row-<?php echo $package['id']; ?>">
                    <td><?php echo htmlspecialchars($package['id']); ?></td>
                    <td><?php echo htmlspecialchars($package['name']); ?></td>
                    <td><?php echo htmlspecialchars($package['type']); ?></td>
                    <td>
                        <?php echo htmlspecialchars($package['price']); ?> EUR / muaj
                    </td>
                    <td><?php echo htmlspecialchars($package['channels_count']); ?></td>
                    <td>
                        <div class="actions">
                            <a
                                href="/UEB2_Projekti_Grupi36/pages/tv-admin.php?action=edit_package&type=<?php echo urlencode($package['type_key']); ?>&id=<?php echo $package['id']; ?>"
                                class="edit-btn">
                                Edito
                            </a>
                            <button
                                class="delete-btn delete-package-btn"
                                data-id="<?php echo $package['id']; ?>"
                                data-type="<?php echo $package['type_key']; ?>">
                                Fshi
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</div>

</section>

<script src="/UEB2_Projekti_Grupi36/assets/js/tv-admin.js"></script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
?>
