<?php
$nr_indeksu = '169350';
$nrGrupy = 'isi3';

echo 'Imię: Marek Piotrowski<br />';
echo 'Numer indeksu: '.$nr_indeksu.'<br />';
echo 'Grupa: '.$nrGrupy.'<br /><br />';


echo 'Zastosowanie metody include() i require_once()<br />';
include('przykladowy_plik.php'); 
require_once('inny_przykladowy_plik.php');


echo 'Warunki: if, else, elseif, switch<br />';
$warunek = 1;
if ($warunek === 1) {
    echo 'Warunek równy 1<br />';
} elseif ($warunek === 2) {
    echo 'Warunek równy 2<br />';
} else {
    echo 'Inny warunek<br />';
}

switch ($warunek) {
    case 1:
        echo 'Switch: 1<br />';
        break;
    case 2:
        echo 'Switch: 2<br />';
        break;
    default:
        echo 'Switch: domyślnie<br />';
}


echo 'Pętle: while() i for()<br />';
$i = 0;
while ($i < 5) {
    echo 'while: '.$i.'<br />';
    $i++;
}

for ($j = 0; $j < 5; $j++) {
    echo 'for: '.$j.'<br />';
}


echo 'Typy zmiennych: $_GET, $_POST, $_SESSION<br />';
session_start();
$_GET['przyklad'] = 'wartość GET';
$_POST['przyklad'] = 'wartość POST';
$_SESSION['przyklad'] = 'wartość SESSION';

echo 'GET: '.$_GET['przyklad'].'<br />';
echo 'POST: '.$_POST['przyklad'].'<br />';
echo 'SESSION: '.$_SESSION['przyklad'].'<br />';
?>
