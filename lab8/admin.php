<?php
session_start();
include('cfg.php');


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}


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


if (isset($_POST['login_submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE login = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['logged_in'] = true;
        } else {
            FormularzLogowania("Nieprawidłowe hasło.");
            exit();
        }
    } else {
        FormularzLogowania("Nie znaleziono użytkownika.");
        exit();
    }
}


if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    FormularzLogowania();
    exit();
}


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


function UsunPodstrone($id) {
    global $conn;
    $conn->query("DELETE FROM page_list WHERE id=$id LIMIT 1");
    echo "<p>Podstrona została usunięta!</p>";
    ListaPodstron();
}


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