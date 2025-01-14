
<?php
// Połączenie z bazą danych
include '../includes/db.php';

// Pobranie listy kategorii
$query = "SELECT id, name FROM categories WHERE parent_id = 0";
$stmt = $conn->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../templates/header.php';
?>

<div class="container">
    <h1>Witamy w naszym sklepie</h1>
    <h2>Kategorie:</h2>
    <ul>
        <li><a href="produkty.php">Pokaż wszystkie produkty</a></li>
        <?php foreach ($categories as $category): ?>
            <li><a href="produkty.php?category_id=<?= htmlspecialchars($category['id']) ?>"><?= htmlspecialchars($category['name']) ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include '../templates/footer.php'; ?>
