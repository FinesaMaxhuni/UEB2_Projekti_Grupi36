<?php

$pageCSS = "edit-product.css";

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/header.php';

require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/navbar.php';

if(!isset($_SESSION['user']) || $_SESSION['role'] != "admin"){
    die("Nuk ke qasje.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("
SELECT * FROM eshop_products
WHERE id=?
");

$stmt->execute([$id]);

$product = $stmt->fetch();

if(!$product){
    die("Produkti nuk ekziston.");
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $product_name = trim($_POST['product_name']);
    $category = trim($_POST['category']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    $update = $pdo->prepare("
    UPDATE eshop_products
    SET
    product_name=?,
    category=?,
    price=?,
    description=?
    WHERE id=?
    ");

    $update->execute([
        $product_name,
        $category,
        $price,
        $description,
        $id
    ]);

    header("Location: eshop-admin.php");
    exit();
}
?>

<section class="edit-user-page">

<div class="edit-user-container">

    <div class="edit-user-card">

        <div class="edit-header">

            <h1>Edit Product</h1>

            <p>
                Menaxho informacionet e produktit
            </p>

        </div>

        <form method="POST" class="edit-form">

            <div class="form-group">

                <label>Emri i Produktit</label>

                <input
                type="text"
                name="product_name"
                value="<?php echo htmlspecialchars($product['product_name']); ?>"
                required>

            </div>

            <div class="form-group">

                <label>Kategoria</label>

                <select name="category">

                    <option value="telefon"
                    <?php if($product['category']=="telefon") echo "selected"; ?>>
                    Telefon
                    </option>

                    <option value="laptop"
                    <?php if($product['category']=="laptop") echo "selected"; ?>>
                    Laptop
                    </option>

                    <option value="router"
                    <?php if($product['category']=="router") echo "selected"; ?>>
                    Router
                    </option>

                    <option value="tv"
                    <?php if($product['category']=="tv") echo "selected"; ?>>
                    TV
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>Çmimi</label>

                <input
                type="number"
                step="0.01"
                name="price"
                value="<?php echo htmlspecialchars($product['price']); ?>"
                required>

            </div>

            <div class="form-group">

                <label>Përshkrimi</label>

                <textarea
                name="description"
                required><?php echo htmlspecialchars($product['description']); ?></textarea>

            </div>

            <div class="form-buttons">

                <button type="submit" class="save-btn">

                    Ruaj Ndryshimet

                </button>

                <a href="/UEB2_Projekti_Grupi36/pages/eshop-admin.php" class="cancel-btn">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

</section>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/includes/footer.php';
?>