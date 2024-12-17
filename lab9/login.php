/*
 * Plik: login.php
 * Cel: Główne funkcjonalności pliku opisane poniżej
 * Autor: 
 * Wersja: v1.8
 */

/*
 * File: login.php
 * Purpose: 
 * Author: 
 * Version: v1.8
 */
<?php
session_start();
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
    $username = $conn->real_escape_string((/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST is not None))) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST))) : '');
    $password = $conn->real_escape_string((/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST is not None))) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z POST i zabezpiecza przed XSS */ htmlspecialchars($_POST))) : '');
    $query = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    /**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Ocena podanego warunku i reakcja na wynik.
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if (!$stmt) {
        die("Database query preparation failed: " . $conn->error);
    }
    $stmt->bind_param("ss", $username, $password);
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
if ($result && $result->num_rows > 0) {
        $_SESSION = true;
        header('Location: admin.php');
        exit;
    } else {
        echo '<p style="color: red;">Invalid login credentials. Please try again.</p>';
    }
}
if (isset(isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) : '') && isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars(/* Pobiera wartość z GET i zabezpiecza przed XSS */ htmlspecialchars($_GET))) : '' === 'logout') {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<h1>Login</h1>
<form method="post" action="login.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <button type="submit">Login</button>
</form>