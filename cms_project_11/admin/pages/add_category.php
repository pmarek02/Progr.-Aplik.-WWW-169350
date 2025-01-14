
<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

// Połączenie z bazą danych
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'] ?? 0; // Default to 0 for root categories

    $query = "INSERT INTO categories (name, parent_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([$name, $parent_id])) {
        header('Location: categories.php');
        exit;
    } else {
        $error = "Nie udało się dodać kategorii.";
    }
}

include '../../templates/header.php';

// Pobieranie istniejących kategorii dla opcji nadrzędnych
$query = "SELECT id, name FROM categories";
$stmt = $conn->prepare($query);
$stmt->execute();
$existing_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1>Dodaj nową kategorię</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-group">
            <label for="name">Nazwa kategorii</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="parent_id">Kategoria nadrzędna</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="0">Brak</option>
                <?php foreach ($existing_categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat['id']) ?>"><?= htmlspecialchars($cat['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Dodaj kategorię</button>
    </form>
</div>

<?php include '../../templates/footer.php'; ?>
