<?php
$nr_indeksu = '169350';
$nrGrupy = 'isi3';

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

// Określenie strony do załączenia
$strona = 'html/glowna.html';
if (isset($_GET['idp']) && $_GET['idp'] !== '') {
    $valid_pages = ['fungi', 'wysiew', 'nawozenie_przed', 'nawozenie_wios', 'ochwaszczanie'];
    if (in_array($_GET['idp'], $valid_pages)) {
        $strona = "html/{$_GET['idp']}.html";
    }
}

// Sprawdzenie, czy plik istnieje
if (!file_exists($strona)) {
    $strona = 'html/glowna.html';
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uprawa Pszenżyta</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Uprawa Pszenżyta</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php?idp=">Strona Główna</a></li>
            <li><a href="index.php?idp=wysiew">Wysiew</a></li>
            <li><a href="index.php?idp=nawozenie_przed">Nawożenie Przedsiewne</a></li>
            <li><a href="index.php?idp=nawozenie_wios">Nawożenie Wiosenne</a></li>
            <li><a href="index.php?idp=fungi">Ochrona Fungicydowa</a></li>
            <li><a href="index.php?idp=ochwaszczanie">Odchwaszczanie</a></li>
        </ul>
    </nav>
    <main>
        <?php include($strona); ?>
    </main>
    <footer>
        <p>Autor: Marek Piotrowski <?php echo $nr_indeksu; ?> grupa <?php echo $nrGrupy; ?></p>
        <p>
            <a href="admin/admin.php" class="admin-link">Panel administracyjny</a>
            <a href="showpage.php?page_id=1" class="content-link">Zobacz stronę</a>
        </p>
    </footer>
</body>
</html>
