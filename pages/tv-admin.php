<?php

$pageCSS = "tv-admin.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

$totalTvPackages = $pdo->query("
SELECT COUNT(*) FROM tv_packages
")->fetchColumn();

$totalTvInternetPackages = $pdo->query("
SELECT COUNT(*) FROM tv_internet_packages
")->fetchColumn();

$totalChannels = $pdo->query("
SELECT COUNT(*) FROM channels
")->fetchColumn();

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

function channelTags($channels, $totalChannels){
    $items = array_filter(array_map('trim', explode(',', $channels)));
    $visibleItems = array_slice($items, 0, 4);
    $html = '';

    foreach($visibleItems as $item){
        $html .= '<span>' . htmlspecialchars($item) . '</span>';
    }

    $html .= '<span class="plus-tag">' . htmlspecialchars($totalChannels) . ' kanale</span>';

    return $html;
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
                <h3>Paketat TV</h3>

                <span>
                    <?php echo $totalTvPackages; ?>
                </span>
            </div>
        </div>

        <div class="tv-stat-card">
            <div class="tv-icon green-bg">
                &#128225;
            </div>

            <div class="tv-stat-content">
                <h3>Paketat TV + Internet</h3>

                <span>
                    <?php echo $totalTvInternetPackages; ?>
                </span>
            </div>
        </div>

        <div class="tv-stat-card">
            <div class="tv-icon purple-bg">
                &#9654;&#65039;
            </div>

            <div class="tv-stat-content">
                <h3>Kanale Total</h3>

                <span>
                    <?php echo $totalChannels; ?>
                </span>
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
                    <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php?filter=all"
                    class="<?php if($filter == 'all') echo 'active-tab'; ?>">
                        Te gjitha Paketat
                    </a>

                    <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php?filter=tv"
                    class="<?php if($filter == 'tv') echo 'active-tab'; ?>">
                        Paketat TV
                    </a>

                    <a href="/UEB2_Projekti_Grupi36/pages/tv-admin.php?filter=tv_internet"
                    class="<?php if($filter == 'tv_internet') echo 'active-tab'; ?>">
                        Paketat TV + Internet
                    </a>
                </div>
            </div>

            <a href="/UEB2_Projekti_Grupi36/pages/add-package.php" class="add-btn">
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
            <tr>
                <td><?php echo htmlspecialchars($package['id']); ?></td>
                <td><?php echo htmlspecialchars($package['name']); ?></td>
                <td><?php echo htmlspecialchars($package['type']); ?></td>
                <td><?php echo htmlspecialchars($package['price']); ?> EUR / muaj</td>
                <td><?php echo htmlspecialchars($package['channels_count']); ?></td>

                <td>
                    <div class="actions">
                        <a
                        href="/UEB2_Projekti_Grupi36/pages/edit-package.php?type=<?php echo urlencode($package['type_key']); ?>&id=<?php echo $package['id']; ?>"
                        class="edit-btn">
                            Edito
                        </a>

                        <a
                        href="/UEB2_Projekti_Grupi36/pages/delete-package.php?type=<?php echo urlencode($package['type_key']); ?>&id=<?php echo $package['id']; ?>"
                        class="delete-btn"
                        onclick="return confirm('A je i sigurt qe don me fshi kete pakete?')">
                            Fshi
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>

</div>

</section>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
?>
