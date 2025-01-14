
<?php
// Połączenie z bazą danych
include '../includes/db.php';

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
    <a href="produkty.php" class="btn btn-secondary mb-3">Pokaż wszystkie produkty</a>
    <div class="row">
        <?php if ($products): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="uploads/<?= htmlspecialchars($product['zdjecie']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['tytul']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['tytul']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($product['opis'], 0, 100)) ?>...</p>
                            <a href="produkt.php?id=<?= htmlspecialchars($product['id']) ?>" class="btn btn-primary">Zobacz szczegóły</a>
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
