
<?php
// Połączenie z bazą danych
include '../includes/db.php';

// Pobieranie szczegółów produktu
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM produkty WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        die("Produkt nie został znaleziony.");
    }
} else {
    die("Brak ID produktu.");
}

include '../templates/header.php';
?>

<div class="container">
    <h1><?= htmlspecialchars($product['tytul']) ?></h1>
    <img src="uploads/<?= htmlspecialchars($product['zdjecie']) ?>" class="img-fluid" alt="<?= htmlspecialchars($product['tytul']) ?>">
    <p><?= htmlspecialchars($product['opis']) ?></p>
    <p><strong>Cena Netto:</strong> <?= htmlspecialchars($product['cena_netto']) ?> zł</p>
    <p><strong>VAT:</strong> <?= htmlspecialchars($product['vat']) ?>%</p>
    <p><strong>Ilość:</strong> <?= htmlspecialchars($product['ilosc']) ?></p>
    <p><strong>Kategoria:</strong> <?= htmlspecialchars($product['kategoria']) ?></p>
    <p><strong>Gabaryt:</strong> <?= htmlspecialchars($product['gabaryt']) ?></p>
</div>

<?php include '../templates/footer.php'; ?>
