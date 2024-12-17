/*
 * Plik: showpage.php
 * Cel: Główne funkcjonalności pliku opisane poniżej
 * Autor: 
 * Wersja: v1.8
 */

/*
 * File: showpage.php
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
$page_id = isset(isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) : '') ? intval(isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) : '') : null;
$page_alias = isset(isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) : '') ? $conn->real_escape_string(isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) : '') : null;
/**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Ocena podanego warunku i reakcja na wynik.
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ($page_id !== null) {
    $sql = "SELECT page_title, page_content FROM page_list WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $page_id);
} else/**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Ocena podanego warunku i reakcja na wynik.
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ($page_alias !== null) {
    $sql = "SELECT page_title, page_content FROM page_list WHERE alias = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $page_alias);
} else {
    die("Nieprawidłowy parametr zapytania.");
}
$stmt->execute();
$result = $stmt->get_result();
/**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Ocena podanego warunku i reakcja na wynik.
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h1>" . htmlspecialchars($row) . "</h1>";
        echo "<p>" . htmlspecialchars($row) . "</p>";
    }
} else {
    echo "Strona nie została znaleziona.";
}
$stmt->close();
$conn->close();
?>