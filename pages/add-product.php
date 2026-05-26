<?php

$pageCSS = "edit-product.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $product_name = trim($_POST['product_name']);
    $category = trim($_POST['category']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    // FOTO
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];

    $folder = $_SERVER['DOCUMENT_ROOT'] .
    '/UEB2_Projekti_Grupi36/assets/images/products/';

    $imagePath =
    '/UEB2_Projekti_Grupi36/assets/images/products/' .
    time() . "_" . $imageName;

    move_uploaded_file(
        $tmpName,
        $_SERVER['DOCUMENT_ROOT'] . $imagePath
    );

    $stmt = $pdo->prepare("
        INSERT INTO eshop_products
        (
            product_name,
            category,
            price,
            description,
            image
        )
        VALUES(?,?,?,?,?)
    ");

    $stmt->execute([
        $product_name,
        $category,
        $price,
        $description,
        $imagePath
    ]);

    header("Location: eshop-admin.php");
    exit();
}
?>

<section class="edit-user-page">

<div class="edit-user-container">

<div class="edit-user-card">

<div class="edit-header">

<h1>Shto Produkt</h1>

<p>Shto produkt të ri në webshop.</p>

</div>

<form
method="POST"
enctype="multipart/form-data"
class="edit-form"
>

<div class="form-group">

<label>Emri i Produktit</label>

<input
type="text"
name="product_name"
required>

</div>

<div class="form-group">

<label>Kategoria</label>

<select name="category">

<option value="telefon">Telefon</option>

<option value="laptop">Laptop</option>

<option value="router">Router</option>

<option value="tv">TV</option>

</select>

</div>

<div class="form-group">

<label>Çmimi</label>

<input
type="number"
step="0.01"
name="price"
required>

</div>

<div class="form-group">

<label>Përshkrimi</label>

<textarea
name="description"
required></textarea>

</div>

<div class="form-group">

<label>Foto e Produktit</label>

<input
type="file"
name="image"
accept="image/*"
required>

</div>

<div class="form-buttons">

<button type="submit" class="save-btn">

Shto Produktin

</button>

<a
href="/UEB2_Projekti_Grupi36/pages/eshop-admin.php"
class="cancel-btn"
>

Kthehu

</a>

</div>

</form>

</div>

</div>

</section>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
?>