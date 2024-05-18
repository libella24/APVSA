-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Mai 2024 um 07:43
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `apvsa`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `firmen`
--

CREATE TABLE `firmen` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Firmen ID',
  `bezeichnung` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `plz` int(10) UNSIGNED DEFAULT NULL,
  `ort` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `benutzer` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `anzahl_logins` int(10) UNSIGNED DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Firmen';

--
-- Daten für Tabelle `firmen`
--

INSERT INTO `firmen` (`id`, `bezeichnung`, `strasse`, `plz`, `ort`, `email`, `benutzer`, `passwort`, `anzahl_logins`, `last_login`) VALUES
(1, 'Lagerplatz OHG', 'Musterstraße 1', 5020, 'Salzburg', 'ernst@lagerplatz.com', 'lagerplatz', '$2y$10$0nYT0ri4kguw8AlcXlaKZOhN9tOlWV7OvhbouqZ1IPNaZ6d8nbWZm', 13, '2024-04-19 08:11:37'),
(2, 'Katz&Co', 'Wieselburgerstraße 24', 5020, 'Salzburg', 'r.fleckl@me.com', 'Katz', '', NULL, NULL),
(3, 'Bürobüro', 'Handelszentrum 7', 5101, 'Bergheim', 'bürohengst@bürobüro.at', 'Bürohengst', '', NULL, NULL),
(4, 'Trumer Brauerei', 'Trumerstraße 21', 5162, 'Obertrum', 'trumer@brauerei.at', 'Trumerbier', '', NULL, NULL),
(5, 'DerLeinerIstMeiner', 'Möbelstraße 33', 5020, 'Salzburg', 'möbelhaus@leiner.at', 'Möbelfuzi', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` varchar(255) DEFAULT NULL,
  `beschreibung` varchar(255) DEFAULT NULL,
  `profil` varchar(255) DEFAULT NULL,
  `dienstort` varchar(255) DEFAULT NULL,
  `stunden` varchar(255) DEFAULT NULL,
  `gehalt` varchar(255) DEFAULT NULL,
  `firmen_id` int(10) UNSIGNED DEFAULT NULL,
  `firmen_bez` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `jobs`
--

INSERT INTO `jobs` (`id`, `titel`, `beschreibung`, `profil`, `dienstort`, `stunden`, `gehalt`, `firmen_id`, `firmen_bez`, `created_at`) VALUES
(1, 'Staplerfahrer', 'Sie halten unser Lager pikobello in Ordnung.', 'Ordnungssinn, Pünktlichkeit,...', 'Wals', '30 Stunden/Woche', '1700 netto', 1, '', '2024-04-01 08:24:09'),
(2, 'Krankenpfleger/in', 'Sie sind für das Wohlergehen der kleinen Gäste in der Kinderabteilung zuständig', 'Gutmütig, geduldig, reinlich', 'Salzburg', 'Vollzeit', '2400 netto', 2, '', '2024-05-05 08:24:09'),
(3, 'Chefsekretärin', 'Diktate abtippen', 'Steno von Vorteil', 'Munderfing', '25', '1400', 1, '', '2024-05-06 08:24:09'),
(4, 'Direktorin', 'Chefin über das Imperium', 'gut ausgebildet', 'Wien', '65', '90000 proJahr', NULL, '', NULL),
(5, 'Malermeister/in', 'malt flink alle Wände weiß', 'flink und fleißig', 'Pinzgau', '40 Stunden/Woche (Vollzeit)', '2400 netto', NULL, '', NULL),
(6, 'Regalbetreuer', 'Schlichtet unsere Produkte ordentlich in den Regalen', 'freundlich und kräftig', 'Hallein', '40 Stunden/Woche (Vollzeit)', '2500 netto', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien`
--

CREATE TABLE `kategorien` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `kategorien`
--

INSERT INTO `kategorien` (`id`, `name`) VALUES
(1, 'Assistenz, Verwaltung'),
(2, 'Beratung, Consulting'),
(3, 'Coaching, Training'),
(4, 'Einkauf, Logistik'),
(5, 'Finanzen, Bankwesen'),
(6, 'Führung, Management'),
(7, 'Gastronomie, Tourismus'),
(8, 'Grafik, Design'),
(9, 'IT, EDV'),
(10, 'Marketing, PR'),
(11, 'Personalwesen'),
(12, 'Pharma, Gesundheit, Soziales'),
(13, 'Produktion, Handwerk'),
(14, 'Rechnungswesen, Controlling'),
(15, 'Rechtswesen'),
(16, 'Sachbearbeitung'),
(17, 'Sonstige Berufe'),
(18, 'Technik, Ingenieurwesen'),
(19, 'Verkauf, Kundenbetreuung'),
(20, 'Wissenschaft, Forschung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien_zu_jobs`
--

CREATE TABLE `kategorien_zu_jobs` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID der Verknüpfung',
  `job_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticker`
--

CREATE TABLE `ticker` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `firmen`
--
ALTER TABLE `firmen`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kategorien_zu_jobs`
--
ALTER TABLE `kategorien_zu_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Kategorie` (`category_id`),
  ADD KEY `Jobs` (`job_id`);

--
-- Indizes für die Tabelle `ticker`
--
ALTER TABLE `ticker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `firmen`
--
ALTER TABLE `firmen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Firmen ID', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `kategorien_zu_jobs`
--
ALTER TABLE `kategorien_zu_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID der Verknüpfung';

--
-- AUTO_INCREMENT für Tabelle `ticker`
--
ALTER TABLE `ticker`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `kategorien_zu_jobs`
--
ALTER TABLE `kategorien_zu_jobs`
  ADD CONSTRAINT `Jobs` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Kategorie` FOREIGN KEY (`category_id`) REFERENCES `kategorien` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
