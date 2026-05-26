<?php

$pageCSS = "internet.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/internet_package_tables.php';
ensureInternetPackageTables($pdo);

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

$action = $_GET['action'] ?? 'list';
$type = strtolower(trim($_GET['type'] ?? ($_POST['type'] ?? 'fiber')));
$id = (int)($_GET['id'] ?? 0);
$errors = [];

$packageTables = [
    'fiber' => 'fiber_packages',
    '5g' => 'fiveg_packages'
];

if (!array_key_exists($type, $packageTables)) {
    $type = 'fiber';
}

function redirectInternetAdmin(): void
{
    header("Location: /UEB2_Projekti_Grupi36/pages/internet.php");
    exit();
}

function packageTypeLabel(string $type): string
{
    return $type === '5g' ? '5G' : 'Fiber';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_subscription'])) {
    $subscriptionId = (int)$_POST['delete_subscription'];
    $stmt = $pdo->prepare("DELETE FROM internet_subscriptions WHERE id = ?");
    $stmt->execute([$subscriptionId]);

    redirectInternetAdmin();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_package'])) {
    $type = strtolower(trim($_POST['type'] ?? 'fiber'));
    $id = (int)($_POST['id'] ?? 0);
    $packageName = trim($_POST['package_name'] ?? '');
    $speed = trim($_POST['speed'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (!array_key_exists($type, $packageTables)) {
        $errors[] = "Lloji i paketës nuk është valid.";
    }

    if ($packageName === '') {
        $errors[] = "Emri i paketës është i detyrueshëm.";
    }

    if ($speed === '') {
        $errors[] = "Shpejtësia është e detyrueshme.";
    }

    if ($price === '' || !is_numeric($price) || $price < 0) {
        $errors[] = "Çmimi duhet të jetë numër valid.";
    }

    if (empty($errors)) {
        $table = $packageTables[$type];

        if ($id > 0) {
            $stmt = $pdo->prepare("
                UPDATE $table
                SET package_name = ?, speed = ?, price = ?, description = ?
                WHERE id = ?
            ");
            $stmt->execute([$packageName, $speed, $price, $description, $id]);
        } else {
            $stmt = $pdo->prepare("
                INSERT INTO $table (package_name, speed, price, description)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$packageName, $speed, $price, $description]);
        }

        redirectInternetAdmin();
    }
}

if ($action === 'delete_package') {
    if ($id > 0 && array_key_exists($type, $packageTables)) {
        $table = $packageTables[$type];
        $stmt = $pdo->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->execute([$id]);
    }

    redirectInternetAdmin();
}

$package = [
    'id' => 0,
    'package_name' => '',
    'speed' => '',
    'price' => '',
    'description' => ''
];

if ($action === 'edit_package' && $id > 0) {
    $table = $packageTables[$type];
    $stmt = $pdo->prepare("
        SELECT id, package_name, speed, price, description
        FROM $table
        WHERE id = ?
    ");
    $stmt->execute([$id]);
    $package = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$package) {
        die("Paketa nuk ekziston.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($errors)) {
    $package = [
        'id' => (int)($_POST['id'] ?? 0),
        'package_name' => $_POST['package_name'] ?? '',
        'speed' => $_POST['speed'] ?? '',
        'price' => $_POST['price'] ?? '',
        'description' => $_POST['description'] ?? ''
    ];
    $action = $package['id'] > 0 ? 'edit_package' : 'add_package';
}

$fiberPackages = $pdo->query("
    SELECT id, package_name, speed, price, description
    FROM fiber_packages
    ORDER BY id
")->fetchAll(PDO::FETCH_ASSOC);

$fivegPackages = $pdo->query("
    SELECT id, package_name, speed, price, description
    FROM fiveg_packages
    ORDER BY id
")->fetchAll(PDO::FETCH_ASSOC);

$subscriptions = $pdo->query("
    SELECT
        s.id,
        s.fullname,
        s.email,
        s.package_type,
        COALESCE(f.package_name, g.package_name, CONCAT('Paketa #', s.package_id)) AS package_name
    FROM internet_subscriptions s
    LEFT JOIN fiber_packages f
        ON s.package_type = 'fiber' AND s.package_id = f.id
    LEFT JOIN fiveg_packages g
        ON s.package_type = '5g' AND s.package_id = g.id
    ORDER BY s.created_at DESC, s.id DESC
")->fetchAll(PDO::FETCH_ASSOC);

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="internet-admin-container">

    <?php if ($action === 'add_package' || $action === 'edit_package'): ?>
        <div class="package-form-card">
            <div class="table-header">
                <h2><?php echo $action === 'edit_package' ? 'Edito Ofertën' : 'Shto Ofertë të Re'; ?></h2>
                <a href="/UEB2_Projekti_Grupi36/pages/internet.php" class="add-btn">Kthehu</a>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="form-errors">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="internet-package-form">
                <input type="hidden" name="save_package" value="1">
                <input type="hidden" name="id" value="<?php echo (int)$package['id']; ?>">

                <div class="form-grid">
                    <div class="form-group">
                        <label>Lloji</label>
                        <?php if ($action === 'edit_package'): ?>
                            <input type="text" value="<?php echo packageTypeLabel($type); ?>" disabled>
                            <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
                        <?php else: ?>
                            <select name="type">
                                <option value="fiber" <?php if ($type === 'fiber') echo 'selected'; ?>>Fiber</option>
                                <option value="5g" <?php if ($type === '5g') echo 'selected'; ?>>5G</option>
                            </select>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Emri i paketës</label>
                        <input type="text" name="package_name" value="<?php echo htmlspecialchars($package['package_name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Shpejtësia</label>
                        <input type="text" name="speed" value="<?php echo htmlspecialchars($package['speed']); ?>" placeholder="p.sh. 300 Mbps" required>
                    </div>

                    <div class="form-group">
                        <label>Çmimi</label>
                        <input type="number" step="0.01" min="0" name="price" value="<?php echo htmlspecialchars($package['price']); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Përshkrimi</label>
                    <textarea name="description" rows="4"><?php echo htmlspecialchars($package['description']); ?></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="add-btn">Ruaj Ofertën</button>
                    <a href="/UEB2_Projekti_Grupi36/pages/internet.php" class="cancel-link">Anulo</a>
                </div>
            </form>
        </div>
    <?php else: ?>

    <div class="stats-grid">

        <div class="stat-card">
            <div class="icon purple">
                <i class="fa-solid fa-wifi"></i>
            </div>

            <div>
                <h3>Paketat Fiber Internet Total</h3>
                <h2><?php echo count($fiberPackages); ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="icon green">
                <i class="fa-solid fa-signal"></i>
            </div>

            <div>
                <h3>Paketat 5G Total</h3>
                <h2><?php echo count($fivegPackages); ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="icon blue">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>

            <div>
                <h3>Abonime Totale Aktive</h3>
                <h2><?php echo count($subscriptions); ?></h2>
            </div>
        </div>

    </div>

    <div class="package-grid">

        <div class="table-card">
            <div class="table-header">
                <h2>Paketat Fiber Internet</h2>

                <a href="/UEB2_Projekti_Grupi36/pages/internet.php?action=add_package&type=fiber" class="add-btn">
                    + Shto Ofertë të Re
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Emri i Paketës</th>
                            <th>Shpejtësia</th>
                            <th>Çmimi</th>
                            <th>Veprimet</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($fiberPackages as $row): ?>
                            <tr>
                                <td><?php echo (int)$row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['speed']); ?></td>
                                <td><?php echo htmlspecialchars($row['price']); ?> € / muaj</td>
                                <td class="actions">
                                    <a href="/UEB2_Projekti_Grupi36/pages/internet.php?action=edit_package&type=fiber&id=<?php echo (int)$row['id']; ?>" class="edit-btn">Edito</a>
                                    <a href="/UEB2_Projekti_Grupi36/pages/internet.php?action=delete_package&type=fiber&id=<?php echo (int)$row['id']; ?>" class="delete-btn" onclick="return confirm('A je i sigurt qe don me fshi kete ofertë?')">Fshi</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <h2>Paketat 5G</h2>

                <a href="/UEB2_Projekti_Grupi36/pages/internet.php?action=add_package&type=5g" class="add-btn">
                    + Shto Ofertë të Re
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Emri i Paketës</th>
                            <th>Shpejtësia</th>
                            <th>Çmimi</th>
                            <th>Veprimet</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($fivegPackages as $row): ?>
                            <tr>
                                <td><?php echo (int)$row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['speed']); ?></td>
                                <td><?php echo htmlspecialchars($row['price']); ?> € / muaj</td>
                                <td class="actions">
                                    <a href="/UEB2_Projekti_Grupi36/pages/internet.php?action=edit_package&type=5g&id=<?php echo (int)$row['id']; ?>" class="edit-btn">Edito</a>
                                    <a href="/UEB2_Projekti_Grupi36/pages/internet.php?action=delete_package&type=5g&id=<?php echo (int)$row['id']; ?>" class="delete-btn" onclick="return confirm('A je i sigurt qe don me fshi kete ofertë?')">Fshi</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="subscriptions-card">
        <div class="subscription-top">
            <h2>Menaxho Abonimet</h2>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Emri i Klientit</th>
                        <th>Email</th>
                        <th>Paketa</th>
                        <th>Lloji</th>
                        <th>Veprimet</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($subscriptions)): ?>
                        <tr>
                            <td colspan="6">Nuk ka ende abonime nga forma Abonohu.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($subscriptions as $subscription): ?>
                        <tr>
                            <td><?php echo (int)$subscription['id']; ?></td>
                            <td><?php echo htmlspecialchars($subscription['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($subscription['email']); ?></td>
                            <td><?php echo htmlspecialchars($subscription['package_name']); ?></td>
                            <td><?php echo $subscription['package_type'] === '5g' ? '5G' : 'Internet'; ?></td>
                            <td>
                                <form method="POST" action="pages/internet.php" onsubmit="return confirm('A je i sigurt qe don me fshi kete abonim?');">
                                    <input type="hidden" name="delete_subscription" value="<?php echo (int)$subscription['id']; ?>">
                                    <a href="#" class="cancel-btn" onclick="this.closest('form').requestSubmit(); return false;">
                                        Ndal Abonimin
                                    </a>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php endif; ?>

</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>
