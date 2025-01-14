
<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Połączenie z bazą danych
include '../includes/db.php';

// Pobranie danych produktu
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

// Obsługa formularza edycji
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tytul = $_POST['tytul'];
    $opis = $_POST['opis'];
    $cena_netto = $_POST['cena_netto'];
    $vat = $_POST['vat'];
    $ilosc = $_POST['ilosc'];
    $status_dostepnosci = $_POST['status_dostepnosci'];
    $kategoria = $_POST['kategoria'];
    $gabaryt = $_POST['gabaryt'];
    $data_wygasniecia = $_POST['data_wygasniecia'];

    $zdjecie = $product['zdjecie']; // Default to current image
    if (isset($_FILES['zdjecie']) && $_FILES['zdjecie']['error'] == 0) {
        $upload_dir = '../public/uploads/';
        $file_name = basename($_FILES['zdjecie']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['zdjecie']['tmp_name'], $target_file)) {
            $zdjecie = $file_name;
        } else {
            $error = "Nie udało się wgrać pliku.";
        }
    }

    $query = "UPDATE produkty SET tytul = ?, opis = ?, cena_netto = ?, vat = ?, ilosc = ?, status_dostepnosci = ?, kategoria = ?, gabaryt = ?, zdjecie = ?, data_wygasniecia = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([$tytul, $opis, $cena_netto, $vat, $ilosc, $status_dostepnosci, $kategoria, $gabaryt, $zdjecie, $data_wygasniecia, $id])) {
        header('Location: produkty.php');
        exit;
    } else {
        $error = "Błąd podczas edycji produktu.";
    }
}

// Pobranie listy kategorii
$query = "SELECT id, name FROM categories";
$stmt = $conn->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../templates/header.php';
?>

<div class="container">
    <h1>Edytuj produkt</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="tytul">Tytuł</label>
            <input type="text" name="tytul" id="tytul" class="form-control" value="<?= htmlspecialchars($product['tytul']) ?>" required>
        </div>
        <div class="form-group">
            <label for="opis">Opis</label>
            <textarea name="opis" id="opis" class="form-control" required><?= htmlspecialchars($product['opis']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="cena_netto">Cena Netto</label>
            <input type="number" step="0.01" name="cena_netto" id="cena_netto" class="form-control" value="<?= htmlspecialchars($product['cena_netto']) ?>" required>
        </div>
        <div class="form-group">
            <label for="vat">VAT</label>
            <input type="number" name="vat" id="vat" class="form-control" value="<?= htmlspecialchars($product['vat']) ?>" required>
        </div>
        <div class="form-group">
            <label for="ilosc">Ilość</label>
            <input type="number" name="ilosc" id="ilosc" class="form-control" value="<?= htmlspecialchars($product['ilosc']) ?>" required>
        </div>
        <div class="form-group">
            <label for="status_dostepnosci">Status dostępności</label>
            <select name="status_dostepnosci" id="status_dostepnosci" class="form-control" required>
                <option value="dostepny" <?= $product['status_dostepnosci'] == 'dostepny' ? 'selected' : '' ?>>Dostępny</option>
                <option value="niedostepny" <?= $product['status_dostepnosci'] == 'niedostepny' ? 'selected' : '' ?>>Niedostępny</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kategoria">Kategoria</label>
            <select name="kategoria" id="kategoria" class="form-control" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>" <?= $product['kategoria'] == $category['id'] ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="gabaryt">Gabaryt</label>
            <input type="text" name="gabaryt" id="gabaryt" class="form-control" value="<?= htmlspecialchars($product['gabaryt']) ?>">
        </div>
        <div class="form-group">
            <label for="zdjecie">Zdjęcie produktu</label>
            <input type="file" name="zdjecie" id="zdjecie" class="form-control">
        </div>
        <div class="form-group">
            <label for="data_wygasniecia">Data wygaśnięcia</label>
            <input type="date" name="data_wygasniecia" id="data_wygasniecia" class="form-control" value="<?= htmlspecialchars($product['data_wygasniecia']) ?>">
        </div>
        <button type="submit" class="btn btn-success">Zapisz zmiany</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
