<?php
$nr_indeksu = '169350';
$nrGrupy = 'isi3';

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

include('cfg.php');

// Określenie strony do załączenia
$strona_tytul = "Strona Główna";
$strona_tresc = <<<HTML
<div style="text-align: center; margin-bottom: 20px;">
    <h2>Witamy na stronie głównej!</h2>
    <p>Znajdziesz tutaj wszystkie najważniejsze informacje dotyczące upraw, nawożenia oraz pielęgnacji roślin.</p>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin: 20px 0;">
        <img src="https://agrotechnika.co/wp-content/uploads/2023/08/su-atletus.jpg" alt="Zdjęcie 1" style="max-width: 30%; height: auto; border-radius: 8px;">
        <img src="https://www.agrofakt.pl/wp-content/uploads/2016/08/triticale-946049_1280.jpg" alt="Zdjęcie 2" style="max-width: 30%; height: auto; border-radius: 8px;">
        <img src="https://sklep262989.shoparena.pl/userdata/public/gfx/1084.png" alt="Zdjęcie 3" style="max-width: 30%; height: auto; border-radius: 8px;">
        <img src="https://a.allegroimg.com/original/11de30/b0359682437fab4f5292428a23b5/Pszenzyto-Nasiona-Ziarno-200-g-pokarm-dla-mrowek-AntHunter" alt="Zdjęcie 4" style="max-width: 30%; height: auto; border-radius: 8px;">
        <img src="https://hr-strzelce.pl/wp-content/uploads/2022/02/DSC04840a-scaled.jpg" alt="Zdjęcie 5" style="max-width: 30%; height: auto; border-radius: 8px;">
        <img src="https://www.agrofakt.pl/wp-content/uploads/2015/09/slajd4_gringo.jpg" alt="Zdjęcie 6" style="max-width: 30%; height: auto; border-radius: 8px;">
    </div>
    
      style="font-size: 14px; background-color: #f5f5f5; color: black; border: 1px solid #aaa; border-radius: 5px; cursor: pointer;"></button>
       style="margin: 20px auto; display: block; font-size: 14px; background-color: #f5f5f5; color: black; border: 1px solid #aaa; border-radius: 5px; cursor: pointer;"></button></button>
</div>
<div style="text-align: center; margin-top: 30px;">
    <h3>Formularz kontaktowy</h3>
    <form method="post" action="kontakt.php" style="max-width: 600px; margin: auto; text-align: left;">
        <label for="imie">Imię:</label><br>
        <input type="text" id="imie" name="imie" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>
        <label for="nazwisko">Nazwisko:</label><br>
        <input type="text" id="nazwisko" name="nazwisko" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>
        <label for="wiadomosc">Wiadomość:</label><br>
        <textarea id="wiadomosc" name="wiadomosc" rows="4" required style="width: 100%; padding: 8px; margin-bottom: 10px;"></textarea><br>
        <input type="submit" value="Wyślij" style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
    </form>
</div>
HTML;

if (isset($_GET['idp']) && $_GET['idp'] !== '') {
    $id = $_GET['idp']; // ID może być nazwą pliku lub ID z bazy danych
    
    // Sprawdzamy, czy podstrona jest w bazie danych
    $query = "SELECT page_title, page_content FROM page_list WHERE id = ? AND status = 1 LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $page = $result->fetch_assoc();
        $strona_tytul = $page['page_title'];
        $strona_tresc = $page['page_content'];
    } else {
        // Jeśli brak w bazie, sprawdzamy, czy to plik HTML
        $file_path = "html/{$id}.html";
        if (file_exists($file_path)) {
            $strona_tytul = ucfirst(str_replace("_", " ", pathinfo($id, PATHINFO_FILENAME)));
            $strona_tresc = file_get_contents($file_path);
        } else {
            $strona_tytul = "Błąd";
            $strona_tresc = "<p>Nie znaleziono podstrony.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $strona_tytul; ?></title>
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
            <?php
            // Stare podstrony HTML (statyczne)
            $static_pages = [
                "wysiew" => "Wysiew",
                "nawozenie_przed" => "Nawożenie przedsiewne",
                "nawozenie_wios" => "Nawożenie wiosenne",
                "ochwaszczanie" => "Odchwaszczanie",
                "fungi" => "Fungi"
            ];
            foreach ($static_pages as $key => $title) {
                echo "<li><a href='index.php?idp={$key}'>{$title}</a></li>";
            }
            // Dodanie nowych podstron z bazy
            $menu_query = "SELECT id, page_title FROM page_list WHERE status = 1";
            $menu_result = $conn->query($menu_query);
            while ($row = $menu_result->fetch_assoc()) {
                echo "<li><a href='index.php?idp={$row['id']}'>{$row['page_title']}</a></li>";
            }
            ?>
        </ul>
    </nav>
    <main>
        <h2><?php echo $strona_tytul; ?></h2>
        <?php echo $strona_tresc; ?>
    </main>
    <footer>
        <p>Autor: Marek Piotrowski <?php echo $nr_indeksu; ?> grupa <?php echo $nrGrupy; ?></p>
        <p>
            <a href="admin/admin.php" class="admin-link">Panel administracyjny</a>
        </p>
    </footer>
</body>
</html>
