
<?php
$nr_indeksu = '169350';
$nrGrupy = 'isi3';
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include('cfg.php');
$strona_tytul = "Strona Główna";
$strona_tresc = <<<HTML
<div style="text-align: center; margin-bottom: 20px;">
    <h2>Witamy na stronie głównej!</h2>
    <p>Znajdziesz tutaj wszystkie najważniejsze informacje dotyczące upraw, nawożenia oraz pielęgnacji roślin.</p>
</div>
HTML;
$page_id = isset($_GET['page_id']) ? htmlspecialchars($_GET['page_id']) : null;
if ($page_id !== null && is_numeric($page_id)) {
    $query = "SELECT page_title, page_content FROM page_list WHERE id = ? AND status = 1 LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
        $page = $result->fetch_assoc();
        $strona_tytul = $page;
        $strona_tresc = $page;
    } else {
        $strona_tytul = "Błąd";
        $strona_tresc = "<p>Nie znaleziono podstrony lub jest nieaktywna.</p>";
    }
if (file_exists($static_page)) {
        $strona_tresc = file_get_contents($static_page);
        $strona_tresc = "<p>Nie znaleziono podstrony statycznej.</p>";
include('contact.php');
    $contact = new Contact();
    ob_start();
    $contact->PokazKontakt();
    $strona_tytul = "Kontakt";
    $strona_tresc = ob_get_clean();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/kolorujto.js"></script>
</head>
<body onload="initializeBackground();">
    <header>
        <h1>Uprawa Pszenżyta</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Strona Główna</a></li>
            <li><a href="admin.php">Panel Administracyjny</a></li>
            <li><a href="index.php?contact=1">Kontakt</a></li>
            <?php
            $static_pages = [
                "wysiew" => "Wysiew",
                "nawozenie_przed" => "Nawożenie przedsiewne",
                "nawozenie_wios" => "Nawożenie wiosenne",
                "ochwaszczanie" => "Odchwaszczanie",
                "fungi" => "Fungi"
            ];
            foreach ($static_pages as $key => $title) {
                echo "<li><a href='index.php?static={$key}'>{$title}</a></li>";
            }
            $query = "SELECT id, page_title FROM page_list WHERE status = 1";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
            ?>
        </ul>
    </nav>
    <main>
        <?php echo $strona_tresc; ?>
    </main>
    <footer>
        <p>Autor: Marek Piotrowski <?php echo $nr_indeksu; ?> grupa <?php echo $nrGrupy; ?></p>
    </footer>
</body>
</html>}
}
