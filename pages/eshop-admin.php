<?php

$pageCSS = "eshop-admin.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

?>

<main class="eshop-admin">

<section class="top-header">

    <div class="header-left">
        <h1>E-Shop</h1>
        <p>Menaxho produktet e dyqanit</p>
    </div>

    <a href="#" class="add-product-btn">
        + Shto Produkt
    </a>

</section>

    <!-- STATISTIKAT -->

    <div class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon blue">
            📱
        </div>

        <div class="stat-info">
            <h3>Telefona Total</h3>

            <div class="stat-bottom">
                <span class="stat-number">15</span>

    
            </div>
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon green">
            💻
        </div>

        <div class="stat-info">
            <h3>Laptopa Total</h3>

            <div class="stat-bottom">
                <span class="stat-number">14</span>

            </div>
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon purple">
            📶
        </div>

        <div class="stat-info">
            <h3>Routera Total</h3>

            <div class="stat-bottom">
                <span class="stat-number">15</span>

            </div>
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon orange">
            📺
        </div>

        <div class="stat-info">
            <h3>Televizora Total</h3>

            <div class="stat-bottom">
                <span class="stat-number">16</span>

            </div>
        </div>

    </div>

</div>

</div>

    </section>

    <!-- PRODUKTET -->

    <section class="products-grid">

        <!-- TELEFONA -->

        <div class="product-box">

            <div class="box-header">
                <h2>📱 Telefona</h2>
                <p>Menaxho telefonat</p>
            </div>

            <div class="product-list">

                <div class="product-item">
                    <span>iPhone 15</span>
                    <strong>899€</strong>
                </div>

                <div class="product-item">
                    <span>Samsung Galaxy S24</span>
                    <strong>1199€</strong>
                </div>

                <div class="product-item">
                    <span>Xiaomi 14</span>
                    <strong>699€</strong>
                </div>

                <div class="product-item">
                    <span>Google Pixel 8</span>
                    <strong>799€</strong>
                </div>

            </div>

            <a href="#" class="show-more">
                Shiko të gjitha telefonat →
            </a>

        </div>

        <!-- LAPTOPA -->

        <div class="product-box">

            <div class="box-header">
                <h2>💻 Laptopa</h2>
                <p>Menaxho laptopët</p>
            </div>

            <div class="product-list">

                <div class="product-item">
                    <span>MacBook Air M2</span>
                    <strong>1399€</strong>
                </div>

                <div class="product-item">
                    <span>Dell XPS 13</span>
                    <strong>1299€</strong>
                </div>

                <div class="product-item">
                    <span>Lenovo ThinkPad X1</span>
                    <strong>1399€</strong>
                </div>

                <div class="product-item">
                    <span>ASUS ROG Zephyrus</span>
                    <strong>1799€</strong>
                </div>

            </div>

            <a href="#" class="show-more">
                Shiko të gjitha laptopët →
            </a>

        </div>

        <!-- ROUTERA -->

        <div class="product-box">

            <div class="box-header">
                <h2>📶 Routera</h2>
                <p>Menaxho routerat</p>
            </div>

            <div class="product-list">

                <div class="product-item">
                    <span>TP-Link Archer AX1800</span>
                    <strong>119€</strong>
                </div>

                <div class="product-item">
                    <span>Huawei WiFi AX3</span>
                    <strong>89€</strong>
                </div>

                <div class="product-item">
                    <span>ASUS RT-AX86U</span>
                    <strong>229€</strong>
                </div>

                <div class="product-item">
                    <span>Netgear Nighthawk</span>
                    <strong>299€</strong>
                </div>

            </div>

            <a href="#" class="show-more">
                Shiko të gjitha routerat →
            </a>

        </div>

        <!-- TELEVIZORA -->

        <div class="product-box">

            <div class="box-header">
                <h2>📺 Televizora</h2>
                <p>Menaxho televizorët</p>
            </div>

            <div class="product-list">

                <div class="product-item">
                    <span>Samsung QLED 65"</span>
                    <strong>1299€</strong>
                </div>

                <div class="product-item">
                    <span>LG OLED 55"</span>
                    <strong>1099€</strong>
                </div>

                <div class="product-item">
                    <span>Sony Bravia 4K</span>
                    <strong>999€</strong>
                </div>

                <div class="product-item">
                    <span>Philips Ambilight</span>
                    <strong>899€</strong>
                </div>

            </div>

            <a href="#" class="show-more">
                Shiko të gjitha televizorët →
            </a>

        </div>

    </section>

    <!-- MENAXHO BLERJET -->

    <section class="orders-section">

        <div class="section-title">
            <h2>Menaxho Blerjet</h2>
            <p>Lista e të gjitha blerjeve të klientëve</p>
        </div>

        <div class="table-container">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Klienti</th>
                        <th>Produkti</th>
                        <th>Kategoria</th>
                        <th>Çmimi</th>
                        <th>Sasia</th>
                        <th>Data e Blerjes</th>
                        <th>Veprimet</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>#1025</td>
                        <td>Finesa Maxhuni</td>
                        <td>iPhone 15</td>
                        <td>Telefona</td>
                        <td>899€</td>
                        <td>1</td>
                        <td>20/05/2025</td>
                        <td>
                            <button class="view-btn">👁</button>
                        </td>
                    </tr>

                    <tr>
                        <td>#1024</td>
                        <td>Arben Krasniqi</td>
                        <td>MacBook Air M2</td>
                        <td>Laptopa</td>
                        <td>1399€</td>
                        <td>1</td>
                        <td>19/05/2025</td>
                        <td>
                        <td>
                            <button class="view-btn">👁</button>
                        </td>
                    </tr>

                    <tr>
                        <td>#1023</td>
                        <td>Elira Gashi</td>
                        <td>TP-Link Archer</td>
                        <td>Routera</td>
                        <td>119€</td>
                        <td>2</td>
                        <td>18/05/2025</td>
                        <td>
                            <button class="view-btn">👁</button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </section>

</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php'; ?>