/*
 * Plik: kontakt.php
 * Cel: Główne funkcjonalności pliku opisane poniżej
 * Autor: 
 * Wersja: v1.8
 */

/*
 * File: kontakt.php
 * Purpose: 
 * Author: 
 * Version: v1.8
 */
<?php
/**
 * Załączenie pliku: Dodaje funkcjonalności z innego pliku
 */
/**
 * Załączenie pliku: Import dodatkowych funkcji i ustawień.
 */
/**
 * Załączenie pliku: Import dodatkowych funkcji i ustawień z innego pliku.
 */
include('cfg.php');
/**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Ocena podanego warunku i reakcja na wynik.
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ($_SERVER === 'POST') {
    $imie = $conn->real_escape_string((/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST is not None))) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST))) : '');
    $nazwisko = $conn->real_escape_string((/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST is not None))) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST))) : '');
    $email = $conn->real_escape_string((/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST is not None))) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST))) : '');
    $wiadomosc = $conn->real_escape_string((/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST is not None))) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST))) : '');
    $query = "INSERT INTO kontakty (imie, nazwisko, email, wiadomosc) VALUES ('$imie', '$nazwisko', '$email', '$wiadomosc')";
    /**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Ocena podanego warunku i reakcja na wynik.
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ($conn->query($query)) {
        echo "<p>Dziękujemy za wiadomość. Skontaktujemy się z Tobą wkrótce.</p>";
    } else {
        echo "<p>Błąd: Nie udało się zapisać wiadomości.</p>";
    }
} else {
    echo "<p>Nieprawidłowa metoda żądania.</p>";
}
?>