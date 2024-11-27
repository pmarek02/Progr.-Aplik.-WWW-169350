<?php
$nr_indeksu = '169350';
$nrGrupy = 'isi3';

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

// Determine the page to include
if ($_GET['idp'] == '') {
    $strona = 'html/glowna.html';
} elseif ($_GET['idp'] == 'fungi') {
    $strona = 'html/fungi.html';
} elseif ($_GET['idp'] == 'wysiew') {
    $strona = 'html/wysiew.html';
} elseif ($_GET['idp'] == 'nawozenie_przed') {
    $strona = 'html/nawozenie_przed.html';
} elseif ($_GET['idp'] == 'nawozenie_wios') {
    $strona = 'html/nawozenie_wios.html';
} elseif ($_GET['idp'] == 'ochwaszczanie') {
    $strona = 'html/ochwaszczanie.html';
} else {
    $strona = 'html/glowna.html';
}

// Check if the file exists
if (!file_exists($strona)) {
    $strona = 'html/glowna.html';
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Uprawa Pszenżyta</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/kolorujto.js"></script>
    <script src="js/timedate.js"></script>
</head>
<body onload="startclock()">
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
        <p>Autor: Kosiasz 33 pl <?php echo $nr_indeksu; ?> grupa <?php echo $nrGrupy; ?></p>
    </footer>
</body>
</html>
