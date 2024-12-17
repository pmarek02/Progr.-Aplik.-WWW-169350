/*
 * Plik: cfg.php
 * Cel: Główne funkcjonalności pliku opisane poniżej
 * Autor: 
 * Wersja: v1.8
 */

/*
 * File: cfg.php
 * Purpose: 
 * Author: 
 * Version: v1.8
 */
<?php
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "moja_strona";   
$login = "admin";
$pass = "admin"; 
$conn = new mysqli($servername, $username, $password, $dbname);
/**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Ocena podanego warunku i reakcja na wynik.
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
?>