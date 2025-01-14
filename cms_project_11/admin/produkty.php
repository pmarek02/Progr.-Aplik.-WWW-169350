
<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Połączenie z bazą danych
include '../includes/db.php';

// Pobieranie produktów z bazy danych
$query = "SELECT * FROM produkty";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../templates/header.php';
?>

<div class="container">
    <h1>Zarządzanie produktami</h1>
    <a href="dodaj_produkt.php" class="btn btn-primary">Dodaj nowy produkt</a>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tytuł</th>
                <th>Opis</th>
                <th>Cena Netto</th>
                <th>VAT</th>
                <th>Ilość</th>
                <th>Status</th>
                <th>Kategoria</th>
                <th>Gabaryt</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['tytul']) ?></td>
                    <td><?= htmlspecialchars($row['opis']) ?></td>
                    <td><?= htmlspecialchars($row['cena_netto']) ?> zł</td>
                    <td><?= htmlspecialchars($row['vat']) ?>%</td>
                    <td><?= htmlspecialchars($row['ilosc']) ?></td>
                    <td><?= htmlspecialchars($row['status_dostepnosci']) ?></td>
                    <td><?= htmlspecialchars($row['kategoria']) ?></td>
                    <td><?= htmlspecialchars($row['gabaryt']) ?></td>
                    <td>
                        <a href="edytuj_produkt.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-warning btn-sm">Edytuj</a>
                        <a href="usun_produkt.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć ten produkt?');">Usuń</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>
