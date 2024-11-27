-- Utworzenie bazy danych
CREATE DATABASE IF NOT EXISTS moja_strona;

-- Użycie bazy danych
USE moja_strona;

-- Utworzenie tabeli page_list
CREATE TABLE IF NOT EXISTS page_list (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_title VARCHAR(255) NOT NULL,
    page_content TEXT NOT NULL,
    status INTEGER DEFAULT 1,
    alias VARCHAR(20) UNIQUE
);

-- Dodanie przykładowych danych zgodnych z projektem użytkownika
INSERT INTO page_list (page_title, page_content, status, alias) VALUES
('Kosiasz 33 pl', 'Witamy na stronie Kosiasz 33 pl. Tutaj znajdziesz wszystkie informacje o moich ulubionych grach i aktywnościach.', 1, 'home'),
('Gry', 'Moje ulubione gry to: League of Legends, CS2, Farming Simulator, oraz My Summer Car. W League of Legends gram głównie jako Yasuo, a w CS2 używam AWP.', 1, 'games'),
('Ulubione skiny', 'Mój ulubiony skin w CS2 to Asimov. Uwielbiam wszystkie bronie, a szczególnie AWP.', 1, 'skins'),
('Farming Simulator', 'W Farming Simulator moim ulubionym traktorem jest Ursus, a także rozrzutnik obornika Ursus.', 1, 'farming');
