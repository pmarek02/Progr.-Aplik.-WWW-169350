<?php
$servername = "localhost";
$username = "cms_user"; // Użytkownik bazy danych
$password = "cms_password"; // Hasło użytkownika
$dbname = "moja_strona"; // Nazwa bazy danych

// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
?>
