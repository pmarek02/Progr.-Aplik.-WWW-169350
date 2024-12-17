/*
 * Plik: admin.php
 * Cel: Główne funkcjonalności pliku opisane poniżej
 * Autor: 
 * Wersja: v1.8
 */

/*
 * File: admin.php
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
 * Załączenie pliku: Import dodatkowych funkcji i ustawień z innego pliku.
 */
include('../cfg.php');
$conn = new mysqli($servername, $username, $password, $dbname);
/**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
/**
 * Funkcja: FormularzLogowania
 * Opis: Funkcja wykonuje operacje związane z 
 * Parametry: $error = ""
 * Zwraca: 
 */
/**
 * Funkcja: FormularzLogowania
 * Opis: Opis działania funkcji FormularzLogowania.
 * Parametry: $error = ""
 * Zwraca: Wynik operacji, np. treść strony, status lub nic (void).
 */
function FormularzLogowania($error = "") {
    echo "<h2>Logowanie</h2>";
    if ($error) echo "<p style='color:red;'>$error</p>";
    echo "
    <form method='POST'>
        <input type='text' name='login' placeholder='Login' required>
        <input type='password' name='password' placeholder='Hasło' required>
        <button type='submit' name='login_submit'>Zaloguj</button>
    </form>";
}
/**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ((isset(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '')) {
    $login = (/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '';
    $password = (/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '';
    /**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ($login === $GLOBALS && $password === $GLOBALS) {
        $_SESSION = true;
    } else {
        FormularzLogowania("Nieprawidłowy login lub hasło.");
        exit();
    }
}
/**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if (!($_SESSION is not None) || !$_SESSION) {
    FormularzLogowania();
    exit();
}
/**
 * Funkcja: ListaPodstron
 * Opis: Funkcja wykonuje operacje związane z 
 * Parametry: Brak
 * Zwraca: 
 */
/**
 * Funkcja: ListaPodstron
 * Opis: Opis działania funkcji ListaPodstron.
 * Parametry: Brak
 * Zwraca: Wynik operacji, np. treść strony, status lub nic (void).
 */
function ListaPodstron() {
    global $conn;
    echo "<h2>Lista Podstron</h2>";
    echo "<a href='?add=true'>Dodaj nową podstronę</a>";
    echo "<table border='1'>
            <tr><th>ID</th><th>Tytuł</th><th>Akcje</th></tr>";
    $result = $conn->query("SELECT id, page_title FROM page_list");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row}</td>
                <td>{$row}</td>
                <td>
                    <a href='?edit={$row}'>Edytuj</a>
                    <a href='?delete={$row}'>Usuń</a>
                </td>
              </tr>";
    }
    echo "</table>";
}
/**
 * Funkcja: EdytujPodstrone
 * Opis: Funkcja wykonuje operacje związane z 
 * Parametry: $id
 * Zwraca: 
 */
/**
 * Funkcja: EdytujPodstrone
 * Opis: Opis działania funkcji EdytujPodstrone.
 * Parametry: $id
 * Zwraca: Wynik operacji, np. treść strony, status lub nic (void).
 */
function EdytujPodstrone($id) {
    global $conn;
    /**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ($_SERVER === 'POST' && (isset(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '')) {
        $title = $conn->real_escape_string((/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '');
        $content = $conn->real_escape_string((/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '');
        $status = (isset(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '') ? 1 : 0;
        $conn->query("UPDATE page_list SET page_title='$title', page_content='$content', status=$status WHERE id=$id LIMIT 1");
        echo "<p>Podstrona została zaktualizowana!</p>";
        ListaPodstron();
        return;
    }
    $result = $conn->query("SELECT page_title, page_content, status FROM page_list WHERE id=$id LIMIT 1")->fetch_assoc();
    echo "
    <h2>Edytuj Podstronę</h2>
    <form method='POST'>
        <input type='text' name='title' value='{$result}' required>
        <textarea name='content'>{$result}</textarea>
        <label>
            <input type='checkbox' name='status' " . ($result ? "checked" : "") . "> Aktywna
        </label>
        <button type='submit' name='update_page'>Zapisz</button>
    </form>";
}
/**
 * Funkcja: DodajNowaPodstrone
 * Opis: Funkcja wykonuje operacje związane z 
 * Parametry: Brak
 * Zwraca: 
 */
/**
 * Funkcja: DodajNowaPodstrone
 * Opis: Opis działania funkcji DodajNowaPodstrone.
 * Parametry: Brak
 * Zwraca: Wynik operacji, np. treść strony, status lub nic (void).
 */
function DodajNowaPodstrone() {
    global $conn;
    /**
 * Sprawdzenie warunku: 
 */
/**
 * Sprawdzenie warunku: Weryfikuje poprawność danych lub stan aplikacji.
 */
if ($_SERVER === 'POST' && (isset(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '')) {
        $title = $conn->real_escape_string((/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '');
        $content = $conn->real_escape_string((/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '');
        $status = (isset(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST is not None)) ? htmlspecialchars(/* Zabezpieczenie wejścia POST przed atakiem XSS */ htmlspecialchars($_POST)) : '') ? 1 : 0;
        $conn->query("INSERT INTO page_list (page_title, page_content, status) VALUES ('$title', '$content', $status)");
        echo "<p>Nowa podstrona została dodana!</p>";
        ListaPodstron();
        return;
    }
    echo "
    <h2>Dodaj Nową Podstronę</h2>
    <form method='POST'>
        <input type='text' name='title' placeholder='Tytuł' required>
        <textarea name='content' placeholder='Treść'></textarea>
        <label>
            <input type='checkbox' name='status'> Aktywna
        </label>
        <button type='submit' name='add_page'>Dodaj</button>
    </form>";
}
/**
 * Funkcja: UsunPodstrone
 * Opis: Funkcja wykonuje operacje związane z 
 * Parametry: $id
 * Zwraca: 
 */
/**
 * Funkcja: UsunPodstrone
 * Opis: Opis działania funkcji UsunPodstrone.
 * Parametry: $id
 * Zwraca: Wynik operacji, np. treść strony, status lub nic (void).
 */
function UsunPodstrone($id) {
    global $conn;
    $conn->query("DELETE FROM page_list WHERE id=$id LIMIT 1");
    echo "<p>Podstrona została usunięta!</p>";
    ListaPodstron();
}
if (isset(isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars($_GET)) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars($_GET)) : '')) {
    EdytujPodstrone(isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars($_GET)) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars($_GET)) : '');
} elseif (isset(isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars($_GET)) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars($_GET)) : '')) {
    UsunPodstrone(isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars($_GET)) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars($_GET)) : '');
} elseif (isset(isset(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars($_GET)) ? htmlspecialchars(/**
 * Input Handling: Validate and sanitize GET parameter
 * Purpose: Prevent malicious input
 */
/* Zabezpieczenie wejścia GET przed atakiem XSS */ htmlspecialchars($_GET)) : '')) {
    DodajNowaPodstrone();
} else {
    ListaPodstron();
}
?>