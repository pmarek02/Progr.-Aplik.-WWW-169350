
<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Połączenie z bazą danych
include '../includes/db.php';

// Sprawdzenie ID produktu
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM produkty WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([$id])) {
        header('Location: produkty.php');
        exit;
    } else {
        die("Nie udało się usunąć produktu.");
    }
} else {
    die("Brak ID produktu.");
}
?>
