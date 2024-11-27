<?php
$servername = "localhost"; // Adres serwera bazy danych
$username = "root";        // Nazwa użytkownika bazy danych
$password = "";            // Hasło użytkownika bazy danych
$dbname = "moja_strona";   // Nazwa bazy danych

// Dane logowania dla panelu admina (do weryfikacji logowania z bazy)
$login = "admin";
$pass = "admin"; // Hasło (domyślne)

// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
?>
