<?php

$pageCSS = "tv-admin.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

?>

<section class="tv-admin-page">

<div class="container">

    <!-- TITLE -->

    <div class="tv-top">

        <h1>TV</h1>

    </div>

    <!-- STATS -->

    <div class="tv-stats-grid">

        <div class="tv-stat-card">

            <div class="tv-icon blue-bg">
                📺
            </div>

            <div class="tv-stat-content">

                <h3>Paketat TV<br>të shitura</h3>

                <span>386</span>

            </div>

        </div>

        <div class="tv-stat-card">

            <div class="tv-icon green-bg">
                📡
            </div>

            <div class="tv-stat-content">

                <h3>Paketat TV + Internet<br>të shitura</h3>

                <span>214</span>

            </div>

        </div>

        <div class="tv-stat-card">

            <div class="tv-icon purple-bg">
                ▶️
            </div>

            <div class="tv-stat-content">

                <h3>Kanale Total</h3>

                <span>124</span>

            </div>

        </div>

        

    </div>

    <!-- BOXES -->

    <div class="tv-boxes">

        <!-- BOX 1 -->

        <div class="tv-box">

            <h2>Paketat TV dhe Kanale</h2>

            <table class="tv-table">

                <tr>
                    <th>Paketat TV</th>
                    <th>Kanale të përfshira</th>
                </tr>

                <tr>

                    <td>Basic TV</td>

                    <td>

                        <div class="channel-tags">

                            <span>RTK1</span>
                            <span>Klan</span>
                            <span>TV21</span>
                            <span>D</span>
                            <span class="plus-tag">+12</span>

                        </div>

                    </td>

                </tr>

                <tr>

                    <td>Premium TV</td>

                    <td>

                        <div class="channel-tags">

                            <span>HBO</span>
                            <span>Cinemax</span>
                            <span>Sport 1</span>
                            <span>N</span>
                            <span class="plus-tag">+28</span>

                        </div>

                    </td>

                </tr>

                <tr>

                    <td>Sport TV</td>

                    <td>

                        <div class="channel-tags">

                            <span>Arena</span>
                            <span>SK1</span>
                            <span>Eurosport</span>
                            <span>Sport 2</span>
                            <span class="plus-tag">+18</span>

                        </div>

                    </td>

                </tr>

                <tr>

                    <td>Kids TV</td>

                    <td>

                        <div class="channel-tags">

                            <span>Boomerang</span>
                            <span>Disney</span>
                            <span>Nick</span>
                            <span>CN</span>
                            <span class="plus-tag">+15</span>

                        </div>

                    </td>

                </tr>

            </table>

            <a href="" class="show-btn">
                👁 Shiko të gjitha kanalet
            </a>

        </div>

        <!-- BOX 2 -->

        <div class="tv-box">

            <h2>Paketat TV + Internet dhe Kanale</h2>

            <table class="tv-table">

                <tr>
                    <th>Paketat TV + Internet</th>
                    <th>Kanale të përfshira</th>
                </tr>

                <tr>

                    <td>Basic TV + 100 Mbps</td>

                    <td>

                        <div class="channel-tags">

                            <span>RTK1</span>
                            <span>Klan</span>
                            <span>TV21</span>
                            <span>D</span>
                            <span class="plus-tag">+20</span>

                        </div>

                    </td>

                </tr>

                <tr>

                    <td>Premium TV + 300 Mbps</td>

                    <td>

                        <div class="channel-tags">

                            <span>HBO</span>
                            <span>Cinemax</span>
                            <span>Sport 1</span>
                            <span>N</span>
                            <span class="plus-tag">+36</span>

                        </div>

                    </td>

                </tr>

                <tr>

                    <td>Sport TV + 500 Mbps</td>

                    <td>

                        <div class="channel-tags">

                            <span>Arena</span>
                            <span>SK1</span>
                            <span>Eurosport</span>
                            <span>Sport 2</span>
                            <span class="plus-tag">+25</span>

                        </div>

                    </td>

                </tr>

                <tr>

                    <td>Premium TV + 1 Gbps</td>

                    <td>

                        <div class="channel-tags">

                            <span>HBO</span>
                            <span>Cinemax</span>
                            <span>National</span>
                            <span>AXN</span>
                            <span class="plus-tag">+45</span>

                        </div>

                    </td>

                </tr>

            </table>

            <a href="" class="show-btn">
                👁 Shiko të gjitha kanalet
            </a>

        </div>

    </div>

    <!-- MANAXHO -->

    <div class="manage-box">

        <div class="manage-top">

            <div>

                <h2>Menaxho Paketat</h2>

                <div class="tabs">

                    <a href="" class="active-tab">
                        Të gjitha Paketat
                    </a>

                    <a href="">
                        Paketat TV
                    </a>

                    <a href="">
                        Paketat TV + Internet
                    </a>

                </div>

            </div>

            <a href="" class="add-btn">
                + Shto Paketë të Re
            </a>

        </div>

        <table class="tv-table manage-table">

            <tr>

                <th>ID</th>
                <th>Emri i Paketës</th>
                <th>Lloji</th>
                <th>Çmimi</th>
                <th>Kanale</th>
                <th>Veprimet</th>

            </tr>

            <tr>

                <td>1</td>
                <td>Basic TV</td>
                <td>TV</td>
                <td>€9.99 / muaj</td>
                <td>16</td>


                <td>

                    <div class="actions">

                        <a href="" class="edit-btn">
                            ✏ Edito
                        </a>

                        <a href="" class="delete-btn">
                            🗑 Fshi
                        </a>

                    </div>

                </td>

            </tr>

            <tr>

                <td>2</td>
                <td>Premium TV</td>
                <td>TV</td>
                <td>€14.99 / muaj</td>
                <td>32</td>

             

                <td>

                    <div class="actions">

                        <a href="" class="edit-btn">
                            ✏ Edito
                        </a>

                        <a href="" class="delete-btn">
                            🗑 Fshi
                        </a>

                    </div>

                </td>

            </tr>

            <tr>

                <td>3</td>
                <td>Sport TV</td>
                <td>TV</td>
                <td>€11.99 / muaj</td>
                <td>24</td>

             

                <td>

                    <div class="actions">

                        <a href="" class="edit-btn">
                            ✏ Edito
                        </a>

                        <a href="" class="delete-btn">
                            🗑 Fshi
                        </a>

                    </div>

                </td>

            </tr>

            <tr>

                <td>4</td>
                <td>Basic TV + 100 Mbps</td>
                <td>TV + Internet</td>
                <td>€19.99 / muaj</td>
                <td>20</td>

            

                <td>

                    <div class="actions">

                        <a href="" class="edit-btn">
                            ✏ Edito
                        </a>

                        <a href="" class="delete-btn">
                            🗑 Fshi
                        </a>

                    </div>

                </td>

            </tr>

            <tr>

                <td>5</td>
                <td>Premium TV + 300 Mbps</td>
                <td>TV + Internet</td>
                <td>€24.99 / muaj</td>
                <td>36</td>

             

                <td>

                    <div class="actions">

                        <a href="" class="edit-btn">
                            ✏ Edito
                        </a>

                        <a href="" class="delete-btn">
                            🗑 Fshi
                        </a>

                    </div>

                </td>

            </tr>

            <tr>

                <td>6</td>
                <td>Sport TV + 500 Mbps</td>
                <td>TV + Internet</td>
                <td>€22.99 / muaj</td>
                <td>25</td>

              

                <td>

                    <div class="actions">

                        <a href="" class="edit-btn">
                            ✏ Edito
                        </a>

                        <a href="" class="delete-btn">
                            🗑 Fshi
                        </a>

                    </div>

                </td>

            </tr>

        </table>

    </div>

</div>

</section>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
?>