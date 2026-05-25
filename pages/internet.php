<?php

$pageCSS = "internet.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="internet-admin-container">

    <!-- ========================= -->
    <!-- TOP STATISTICS -->
    <!-- ========================= -->

    <div class="stats-grid">

        <div class="stat-card">

            <div class="icon purple">
                <i class="fa-solid fa-wifi"></i>
            </div>

            <div>
                <h3>Paketat Fiber Internet Total</h3>
                <h2>5</h2>
            </div>

        </div>

        <div class="stat-card">

            <div class="icon green">
                <i class="fa-solid fa-signal"></i>
            </div>

            <div>
                <h3>Paketat 5G Total</h3>
                <h2>3</h2>
            </div>

        </div>

        <div class="stat-card">

            <div class="icon blue">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>

            <div>
                <h3>Abonime Totale Aktive</h3>
                <h2>27</h2>
            </div>

        </div>

    </div>

    <!-- ========================= -->
    <!-- PACKAGE TABLES -->
    <!-- ========================= -->

    <div class="package-grid">

        <!-- Fiber -->

        <div class="table-card">

            <div class="table-header">

                <h2>Paketat Fiber Internet</h2>

                <a href="#" class="add-btn">
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

                        <tr>
                            <td>1</td>
                            <td>Fiber 100 Mbps (Wi-Fi 6)</td>
                            <td>100/50 Mbps</td>
                            <td>29.90 € / muaj</td>

                            <td class="actions">
                                <a href="#" class="edit-btn">Edito</a>
                                <a href="#" class="delete-btn">Fshi</a>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Fiber 300 Mbps (Wi-Fi 6)</td>
                            <td>300/100 Mbps</td>
                            <td>39.90 € / muaj</td>

                            <td class="actions">
                                <a href="#" class="edit-btn">Edito</a>
                                <a href="#" class="delete-btn">Fshi</a>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Fiber 1 Gbps (Wi-Fi 6)</td>
                            <td>1 Gbps / 100 Mbps</td>
                            <td>49.90 € / muaj</td>

                            <td class="actions">
                                <a href="#" class="edit-btn">Edito</a>
                                <a href="#" class="delete-btn">Fshi</a>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Fiber 2.5 Gbps (Wi-Fi 6)</td>
                            <td>2.5 Gbps / 500 Mbps</td>
                            <td>69.90 € / muaj</td>

                            <td class="actions">
                                <a href="#" class="edit-btn">Edito</a>
                                <a href="#" class="delete-btn">Fshi</a>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>Fiber 10 Gbps (Wi-Fi 6 Pro)</td>
                            <td>10 Gbps / 10 Gbps</td>
                            <td>99.90 € / muaj</td>

                            <td class="actions">
                                <a href="#" class="edit-btn">Edito</a>
                                <a href="#" class="delete-btn">Fshi</a>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- 5G -->

        <div class="table-card">

            <div class="table-header">

                <h2>Paketat 5G</h2>

                <a href="#" class="add-btn">
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

                        <tr>
                            <td>1</td>
                            <td>5G Basic</td>
                            <td>Deri 150 Mbps</td>
                            <td>24.90 € / muaj</td>

                            <td class="actions">
                                <a href="#" class="edit-btn">Edito</a>
                                <a href="#" class="delete-btn">Fshi</a>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>5G Plus</td>
                            <td>Deri 500 Mbps</td>
                            <td>34.90 € / muaj</td>

                            <td class="actions">
                                <a href="#" class="edit-btn">Edito</a>
                                <a href="#" class="delete-btn">Fshi</a>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>5G Premium</td>
                            <td>Deri 1 Gbps</td>
                            <td>49.90 € / muaj</td>

                            <td class="actions">
                                <a href="#" class="edit-btn">Edito</a>
                                <a href="#" class="delete-btn">Fshi</a>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- ========================= -->
    <!-- SUBSCRIPTIONS -->
    <!-- ========================= -->

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

                    <tr>

                        <td>1</td>
                        <td>Arben Krasniqi</td>
                        <td>arben@example.com</td>
                        <td>Fiber 300 Mbps</td>
                        <td>Internet</td>
                      

                        <td>
                            <a href="#" class="cancel-btn">
                                Ndal Abonimin
                            </a>
                        </td>

                    </tr>

                    <tr>

                        <td>2</td>
                        <td>Blerina Pllana</td>
                        <td>blerina@example.com</td>
                        <td>5G Plus</td>
                        <td>5G</td>
                    

                        <td>
                            <a href="#" class="cancel-btn">
                                Ndal Abonimin
                            </a>
                        </td>

                    </tr>

                    <tr>

                        <td>3</td>
                        <td>Driton Maliqi</td>
                        <td>driton@example.com</td>
                        <td>Fiber 1 Gbps</td>
                        <td>Internet</td>
                
                        <td>
                            <a href="#" class="cancel-btn">
                                Ndal Abonimin
                            </a>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';

?>