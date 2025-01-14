
<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

// Połączenie z bazą danych
include '../../includes/db.php';

// Obsługa usuwania kategorii
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query = "DELETE FROM categories WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([$delete_id])) {
        // Usuwanie podkategorii i produktów (opcjonalne)
        $conn->prepare("DELETE FROM categories WHERE parent_id = ?")->execute([$delete_id]);
        $conn->prepare("UPDATE produkty SET kategoria = NULL WHERE kategoria = ?")->execute([$delete_id]);
        header('Location: categories.php');
        exit;
    } else {
        $error = "Nie udało się usunąć kategorii.";
    }
}

// Pobranie kategorii
$query = "SELECT c.id, c.name, p.name AS parent_name FROM categories c LEFT JOIN categories p ON c.parent_id = p.id";
$stmt = $conn->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../../templates/header.php';
?>

<div class="container">
    <h1>Zarządzanie kategoriami</h1>
    <a href="add_category.php" class="btn btn-primary">Dodaj nową kategorię</a>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Kategoria nadrzędna</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= htmlspecialchars($category['id']) ?></td>
                    <td><?= htmlspecialchars($category['name'] ?? 'Brak nazwy') ?></td>
                    <td><?= htmlspecialchars($category['parent_name'] ?? 'Brak') ?></td>
                    <td>
                        <a href="edit_category.php?id=<?= htmlspecialchars($category['id']) ?>" class="btn btn-warning btn-sm">Edytuj</a>
                        <a href="categories.php?delete_id=<?= htmlspecialchars($category['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć tę kategorię? Wszystkie podkategorie i produkty zostaną również usunięte.');">Usuń</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../../templates/footer.php'; ?>
