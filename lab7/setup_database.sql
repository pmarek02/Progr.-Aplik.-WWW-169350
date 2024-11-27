
-- Tworzenie bazy danych
CREATE DATABASE IF NOT EXISTS moja_strona;
USE moja_strona;

-- Tworzenie tabeli użytkowników
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Dodanie przykładowego użytkownika
INSERT INTO users (login, password)
VALUES ('admin', '$2y$10$eBgbF4P9hIRH4xR9jhCWdugT9Ue.P1/7j8LNHtdp/Jyox6lZwz.yi');

-- Tworzenie tabeli podstron
CREATE TABLE IF NOT EXISTS page_list (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_title VARCHAR(255) NOT NULL,
    page_content TEXT NOT NULL,
    status INT DEFAULT 1
);

-- Dodanie przykładowych podstron
INSERT INTO page_list (page_title, page_content, status)
VALUES
('Strona główna', '<h1>Witamy na naszej stronie głównej!</h1>', 1),
('Kontakt', '<h1>Skontaktuj się z nami</h1><p>Email: kontakt@example.com</p>', 1),
('O nas', '<h1>Kim jesteśmy?</h1><p>Informacje o firmie</p>', 1);
