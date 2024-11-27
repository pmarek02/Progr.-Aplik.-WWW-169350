<?php
include('cfg.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie = $conn->real_escape_string($_POST['imie']);
    $nazwisko = $conn->real_escape_string($_POST['nazwisko']);
    $email = $conn->real_escape_string($_POST['email']);
    $wiadomosc = $conn->real_escape_string($_POST['wiadomosc']);

    $query = "INSERT INTO kontakty (imie, nazwisko, email, wiadomosc) VALUES ('$imie', '$nazwisko', '$email', '$wiadomosc')";
    
    if ($conn->query($query)) {
        echo "<p>Dziękujemy za wiadomość. Skontaktujemy się z Tobą wkrótce.</p>";
    } else {
        echo "<p>Błąd: Nie udało się zapisać wiadomości.</p>";
    }
} else {
    echo "<p>Nieprawidłowa metoda żądania.</p>";
}
?>