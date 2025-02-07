<?php
session_start();
include('../cfg.php');
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Funkcja logowania
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

// Logowanie użytkownika
if (isset($_POST['login_submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login === $GLOBALS['login'] && $password === $GLOBALS['pass']) {
        $_SESSION['logged_in'] = true;
    } else {
        FormularzLogowania("Nieprawidłowy login lub hasło.");
        exit();
    }
}

// Sprawdzenie zalogowania
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    FormularzLogowania();
    exit();
}

// Funkcja do listy podstron
function ListaPodstron() {
    global $conn;
    echo "<h2>Lista Podstron</h2>";
    echo "<a href='?add=true'>Dodaj nową podstronę</a>";
    echo "<table border='1'>
            <tr><th>ID</th><th>Tytuł</th><th>Akcje</th></tr>";

    $result = $conn->query("SELECT id, page_title FROM page_list");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['page_title']}</td>
                <td>
                    <a href='?edit={$row['id']}'>Edytuj</a>
                    <a href='?delete={$row['id']}'>Usuń</a>
                </td>
              </tr>";
    }
    echo "</table>";
}

// Funkcja edycji podstrony
function EdytujPodstrone($id) {
    global $conn;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_page'])) {
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);
        $status = isset($_POST['status']) ? 1 : 0;

        $conn->query("UPDATE page_list SET page_title='$title', page_content='$content', status=$status WHERE id=$id LIMIT 1");
        echo "<p>Podstrona została zaktualizowana!</p>";
        ListaPodstron();
        return;
    }

    $result = $conn->query("SELECT page_title, page_content, status FROM page_list WHERE id=$id LIMIT 1")->fetch_assoc();
    echo "
    <h2>Edytuj Podstronę</h2>
    <form method='POST'>
        <input type='text' name='title' value='{$result['page_title']}' required>
        <textarea name='content'>{$result['page_content']}</textarea>
        <label>
            <input type='checkbox' name='status' " . ($result['status'] ? "checked" : "") . "> Aktywna
        </label>
        <button type='submit' name='update_page'>Zapisz</button>
    </form>";
}

// Funkcja dodawania nowej podstrony
function DodajNowaPodstrone() {
    global $conn;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_page'])) {
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);
        $status = isset($_POST['status']) ? 1 : 0;

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

// Funkcja usuwania podstrony
function UsunPodstrone($id) {
    global $conn;
    $conn->query("DELETE FROM page_list WHERE id=$id LIMIT 1");
    echo "<p>Podstrona została usunięta!</p>";
    ListaPodstron();
}

// Routing
if (isset($_GET['edit'])) {
    EdytujPodstrone($_GET['edit']);
} elseif (isset($_GET['delete'])) {
    UsunPodstrone($_GET['delete']);
} elseif (isset($_GET['add'])) {
    DodajNowaPodstrone();
} else {
    ListaPodstron();
}
?>
