
<?php
// Połączenie z bazą danych
include '../includes/db.php';
include '../includes/cart_functions.php';

// Handle adding a product to the cart
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $vat = $_POST['vat'];  // Adding VAT to the form data
    $quantity = 1; // Default quantity is 1
    addToCart($productId, $productName, $price, $vat, $quantity);  // Passing VAT as an argument
}

// Pobranie produktów według kategorii
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;
if ($category_id) {
    $query = "SELECT * FROM produkty WHERE kategoria = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$category_id]);
} else {
    $query = "SELECT * FROM produkty";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../templates/header.php';
?>

<div class="container">
    <h1>Produkty</h1>
    <a href="koszyk.php" class="btn btn-info mb-3">Zobacz koszyk</a>
    <div class="row">
        <?php if ($products): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="uploads/<?= htmlspecialchars($product['zdjecie']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['tytul']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['tytul']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($product['opis'], 0, 100)) ?>...</p>
                            <p><strong>Price:</strong> <?= htmlspecialchars($product['cena_netto']) ?> PLN</p>
                            <form action="produkty.php" method="post">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['tytul']) ?>">
                                <input type="hidden" name="price" value="<?= htmlspecialchars($product['cena_netto']) ?>">
                                <input type="hidden" name="vat" value="<?= htmlspecialchars($product['vat']) ?>"> <!-- Adding VAT value -->
                                <button type="submit" name="add_to_cart" class="btn btn-primary">Dodaj do koszyka</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Brak produktów w tej kategorii.</p>
        <?php endif; ?>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
