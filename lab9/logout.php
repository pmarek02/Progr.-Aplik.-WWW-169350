/*
 * Plik: logout.php
 * Cel: Główne funkcjonalności pliku opisane poniżej
 * Autor: 
 * Wersja: v1.8
 */

/*
 * File: logout.php
 * Purpose: 
 * Author: 
 * Version: v1.8
 */
<?php
session_start();
/**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Ocena podanego warunku i reakcja na wynik.
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if (session_status() === PHP_SESSION_ACTIVE) {
    session_unset();
    session_destroy();
}
header("Location: login.php");
exit();
?>