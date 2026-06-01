<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

$gabime = [];
$sukses = null;

$stmt = $pdo->query("
    SELECT id, package_name, price, channels_count, description
    FROM tv_packages
    ORDER BY id ASC
");
$tvPackages = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = $_POST["emri"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefon = $_POST["telefon"] ?? "";
    $pako = (int)($_POST["pako"] ?? 0);

    if (!preg_match("/^[a-zA-ZëËçÇ\s]{2,}$/u", $emri)) {
        $gabime[] = "Emri nuk është valid.";
    }

    if (!preg_match("/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $gabime[] = "Email nuk është valid.";
    }

    if (!preg_match("/^\+?[0-9\s]{9,15}$/", $telefon)) {
        $gabime[] = "Numri i telefonit nuk është valid.";
    }

    if (!isset($_SESSION['id'])) {
        $gabime[] = "Duhet te kycesh per ta aktivizuar pakon.";
    }

    if ($pako <= 0) {
        $gabime[] = "Zgjedh nje pako valide.";
    }

    if (empty($gabime)) {
        $stmt = $pdo->prepare("
            SELECT id
            FROM tv_packages
            WHERE id = ?
        ");
        $stmt->execute([$pako]);
        $tvPackageId = $stmt->fetchColumn();

        if ($tvPackageId) {
            $stmt = $pdo->prepare("
                INSERT INTO aktivizo(user_id, tv_package_id, tv_internet_package_id)
                VALUES (?, ?, NULL)
            ");
            $stmt->execute([$_SESSION['id'], $tvPackageId]);
            $sukses = "Pako u aktivizua me sukses!";
        } else {
            $gabime[] = "Pako nuk u gjet ne databaze.";
        }
    }
}

$pageCSS = "tv-packages.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';
?>

<main class="main">

    <section class="tv-packages-hero">
        <div class="container">
            <h1>Pakot TV</h1>
            <p>Zgjedh pakon me kanalet tua të preferuara!</p>
        </div>
    </section>

    <!-- TV Packages Grid -->
    <section class="offers">
        <div class="container">
                        <ul><a href="javascript:void(0);" class="package-btn">Aktivizo Pakon</a></ul>

            <div class="packages-grid">

                <?php foreach ($tvPackages as $index => $package): ?>
                    <div class="package-card <?php echo $index === 2 ? 'featured' : ''; ?>">
                        <h3 class="package-name"><?php echo htmlspecialchars($package['package_name']); ?></h3>
                        <div class="package-price"><?php echo htmlspecialchars($package['price']); ?>&euro;</div>
                        <div class="package-period">/muaj</div>
                        <div class="package-channels"><?php echo (int)$package['channels_count']; ?>+ Kanale</div>
                        <ul class="package-features">
                            <li><?php echo (int)$package['channels_count']; ?>+ kanale</li>
                            <?php if (!empty($package['description'])): ?>
                                <li><?php echo htmlspecialchars($package['description']); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>

               
            </div>
        </div>
    </section>
</main>

<!-- Modali per aktivizimin e pakove-->
<div id="activationModal" class="modal" <?php echo ($_SERVER["REQUEST_METHOD"] == "POST") ? 'style="display:block;"' : ''; ?>>
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Aktivizo Pakon</h2>
        <?php if (!empty($gabime)): ?>
    <div class="error-messages">
        <ul>
            <?php foreach ($gabime as $g): ?>
                <li><?php echo htmlspecialchars($g); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (isset($sukses)): ?>
    <div class="success-message server-success">
        <?php echo htmlspecialchars($sukses); ?>
    </div>
<?php endif; ?>
        <form method="POST" id="activationForm" novalidate>
          <input type="text" name="emri" placeholder="Emri & Mbiemri" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="tel" name="telefon" placeholder="Numri i telefonit" required>
            <select id="packageSelect" name="pako" required>
                <option value="">Zgjidh pakon...</option>
                <?php foreach ($tvPackages as $package): ?>
                    <option
                        value="<?php echo (int)$package['id']; ?>"
                        data-custom="<?php echo stripos($package['package_name'], 'custom') !== false ? '1' : '0'; ?>">
                        <?php echo htmlspecialchars($package['package_name']); ?> - <?php echo htmlspecialchars($package['price']); ?>&euro;
                    </option>
                <?php endforeach; ?>
                <?php if (false): ?>
                <option value="economy">TV Economy - 8.90€</option>
                <option value="premium">TV Premium - 15.50€</option>
                <option value="sport">TV Sport - 23.90€</option>
                <option value="custom">TV Custom - Nga 12€</option>
                <?php endif; ?>
            </select>

            <!-- Perzgjedhja e kanaleve per pakon custom -->
            <div id="channelSelection" style="display:none; margin-top:12px; padding:12px; border:1px solid rgba(96,165,250,0.12); border-radius:8px; background:rgba(96,165,250,0.03);">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                    <strong style="color:white;">Zgjedh Kanalet</strong>
                    <div>
                        <button type="button" id="selectAllBtn" style="margin-right:6px; padding:6px 10px; border-radius:6px; background:#60a5fa; color:#fff; border:none; cursor:pointer;">Zgjidh të gjitha</button>
                        <button type="button" id="clearBtn" style="padding:6px 10px; border-radius:6px; background:transparent; color:#60a5fa; border:1px solid rgba(96,165,250,0.12); cursor:pointer;">Pastro</button>
                    </div>
                </div>
                <div style="text-align:right; color:white; margin-bottom:8px;">Të zgjedhura: <span id="selectedCount">0</span></div>
                <div class="channels-grid" style="display:grid; grid-template-columns:1fr; gap:8px; max-height:240px; overflow:auto; text-align:left;">
                    <div class="category-block">
                        <div style="display:flex; align-items:center; cursor:pointer;" class="toggle-header" data-target="filmList">
                            <span style="display:inline-block; width:16px; height:16px; margin-right:8px; margin-left:5px; transition:transform 220ms ease; transform-origin:center;">▶</span>
                            <span>Filma</span>
                        </div>
                        <div id="filmList" style="display:none; padding-left:18px; margin-top:6px;">
                            <label style="display:block;"><input type="checkbox" name="channels" value="film1" style="margin-right:8px;">HBO HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="film2" style="margin-right:8px;">HBO MAX</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="film3" style="margin-right:8px;">Netflix</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="film4" style="margin-right:8px;">Action Channel</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="film5" style="margin-right:8px;">Cinemax</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="film6" style="margin-right:8px;">Disney+</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="film7" style="margin-right:8px;">Comedy Central</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="film8" style="margin-right:8px;">Fox Movie Channel</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="film9" style="margin-right:8px;">Sony Pictures</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="film10" style="margin-right:8px;">Universal Channel</label>
                        </div>
                    </div>
                    <hr style="border-color: white;">
                    <div class="category-block">
                        <div style="display:flex; align-items:center; cursor:pointer;" class="toggle-header" data-target="sportList">
                            <span style="display:inline-block; width:16px; height:16px; margin-right:8px; margin-left:5px; transition:transform 220ms ease; transform-origin:center;">▶</span>
                            <span>Sporti</span>
                        </div>
                        <div id="sportList" style="display:none; padding-left:18px; margin-top:6px;">
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport1" style="margin-right:8px">Premier League HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport2" style="margin-right:8px">La Liga HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport3" style="margin-right:8px">Serie A HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport4" style="margin-right:8px">Bundesliga HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport5" style="margin-right:8px">Ligue 1 HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport6" style="margin-right:8px">Champions League HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport7" style="margin-right:8px">UEFA Nations League</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport8" style="margin-right:8px">UEFA Conference League</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport9" style="margin-right:8px">Europa League HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport10" style="margin-right:8px">Copa Italia HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport11" style="margin-right:8px">NBA HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport12" style="margin-right:8px">Eurosport HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport13" style="margin-right:8px">Superliga Futboll KS</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport14" style="margin-right:8px">Superliga Basket KS</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport15" style="margin-right:8px">FIFA Qualifiers 2026</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="sport16" style="margin-right:8px">Wimbeldon</label>
                        </div>
                    </div>
                    <hr style="border-color: white;">
                    <div class="category-block">
                        <div style="display:flex; align-items:center; cursor:pointer;" class="toggle-header" data-target="muzikeList">
                            <span style="display:inline-block; width:16px; height:16px; margin-right:8px; margin-left:5px; transition:transform 220ms ease; transform-origin:center;">▶</span>
                            <span>Muzikë</span>
                        </div>
                        <div id="muzikeList" style="display:none; padding-left:18px; margin-top:6px;">
                            <label style="display:block;"><input type="checkbox" name="channels" value="muzike" style="margin-right:8px;">First Channel</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="muzike2" style="margin-right:8px;">MTV</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="muzike3" style="margin-right:8px;">Trace Urban</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="muzike4" style="margin-right:8px;">Mezzo</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="muzike5" style="margin-right:8px;">4Music</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="muzike6" style="margin-right:8px;">Deluxe Music</label>
                        </div>
                    </div>
                    <hr style="border-color: white;">
                    <div class="category-block">
                        <div style="display:flex; align-items:center; cursor:pointer;" class="toggle-header" data-target="infoList">
                            <span style="display:inline-block; width:16px; height:16px; margin-right:8px; margin-left:5px; transition:transform 220ms ease; transform-origin:center;">▶</span>
                            <span>Informuese</span>
                        </div>
                        <div id="infoList" style="display:none; padding-left:18px; margin-top:6px;">
                            <label style="display:block;"><input type="checkbox" name="channels" value="info" style="margin-right:8px;">RTK</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info2" style="margin-right:8px;">KTV</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info3" style="margin-right:8px;">RTV Dukagjini</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info4" style="margin-right:8px;">T7</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info5" style="margin-right:8px;">Top Channel</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info6" style="margin-right:8px;">Klan Kosova</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info7" style="margin-right:8px;">TV Klan</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info8" style="margin-right:8px;">News 24</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info9" style="margin-right:8px;">Ora News</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info10" style="margin-right:8px;">Vizion Plus HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info11" style="margin-right:8px;">Euronews</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info12" style="margin-right:8px;">BBC News</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="info13" style="margin-right:8px;">CNN International</label>
                        </div>
                    </div>
                    <hr style="border-color: white;">
                    <div class="category-block">
                        <div style="display:flex; align-items:center; cursor:pointer;" class="toggle-header" data-target="dokumentareList">
                            <span style="display:inline-block; width:16px; height:16px; margin-right:8px; margin-left:5px; transition:transform 220ms ease; transform-origin:center;">▶</span>
                            <span>Dokumentarë</span>
                        </div>
                        <div id="dokumentareList" style="display:none; padding-left:18px; margin-top:6px;">
                            <label style="display:block;"><input type="checkbox" name="channels" value="dokumentare1" style="margin-right:8px;">Discovery HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="dokumentare2" style="margin-right:8px;">National Geographic</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="dokumentare3" style="margin-right:8px;">History Channel</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="dokumentare4" style="margin-right:8px;">Animal Planet</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="dokumentare5" style="margin-right:8px;">Science Channel</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="dokumentare6" style="margin-right:8px;">BBC Earth</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="dokumentare7" style="margin-right:8px;">Viasat History</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="dokumentare8" style="margin-right:8px;">Nat Geo Wild</label>                           
                        </div>
                    </div>
                    <hr style="border-color: white;">
                    <div class="category-block">
                        <div style="display:flex; align-items:center; cursor:pointer;" class="toggle-header" data-target="femijeList">
                            <span style="display:inline-block; width:16px; height:16px; margin-right:8px; margin-left:5px; transition:transform 220ms ease; transform-origin:center;">▶</span>
                            <span>Për Fëmijë</span>
                        </div>
                        <div id="femijeList" style="display:none; padding-left:18px; margin-top:6px;">
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije1" style="margin-right:8px;">Cartoon Network</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije2" style="margin-right:8px;">Tring Kids</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije3" style="margin-right:8px;">Disney Channel</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije4" style="margin-right:8px;">Boomerang</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije5" style="margin-right:8px;">Bang Bang</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije6" style="margin-right:8px;">Cufo TV</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije7" style="margin-right:8px;">Prince Kids</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije8" style="margin-right:8px;">Sofia</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije9" style="margin-right:8px;">Tao Tao</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije10" style="margin-right:8px;">Tip TV</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="femije11" style="margin-right:8px;">Tring Tring</label>
                        </div>
                    </div>
                    <hr style="border-color: white;">
                    <div class="category-block">
                        <div style="display:flex; align-items:center; cursor:pointer;" class="toggle-header" data-target="arteList">
                            <span style="display:inline-block; width:16px; height:16px; margin-right:8px; margin-left:5px; transition:transform 220ms ease; transform-origin:center;">▶</span>
                            <span>Arte Marciale</span>
                        </div>
                        <div id="arteList" style="display:none; padding-left:18px; margin-top:6px;">
                            <label style="display:block;"><input type="checkbox" name="channels" value="arte1" style="margin-right:8px;">UFC</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="arte2" style="margin-right:8px;">DAZN</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="arte3" style="margin-right:8px;">WWE</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="arte4" style="margin-right:8px;">ESPN</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="arte5" style="margin-right:8px;">BOX NATION</label>
                        </div>
                    </div>
                    <hr style="border-color: white;">
                    <div class="category-block">
                        <div style="display:flex; align-items:center; cursor:pointer;" class="toggle-header" data-target="motosportList">
                            <span style="display:inline-block; width:16px; height:16px; margin-right:8px; margin-left:5px; transition:transform 220ms ease; transform-origin:center;">▶</span>
                            <span>Motosport</span>
                        </div>
                        <div id="motosportList" style="display:none; padding-left:18px; margin-top:6px;">
                            <label style="display:block;"><input type="checkbox" name="channels" value="motosport1" style="margin-right:8px;">Formula 1</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="motosport2" style="margin-right:8px;">MotoGP HD</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="motosport3" style="margin-right:8px;">F2 Racing</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="motosport4" style="margin-right:8px;">World Superbike</label>
                            <label style="display:block;"><input type="checkbox" name="channels" value="motosport5" style="margin-right:8px;">RedBull TV</label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="modal-btn">Përfundo</button>
        </form>
    </div>
</div>

<script src="assets/js/telecomeoperator.js"></script>
<script src="assets/js/tv-packages.js?v=php-validation-2"></script>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>
