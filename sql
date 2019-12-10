-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 dec 2019 om 14:54
-- Serverversie: 10.4.6-MariaDB
-- PHP-versie: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autozooi`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers`
--

CREATE TABLE `customers` (
  `bedrijf` varchar(22) NOT NULL,
  `plaats` varchar(22) NOT NULL,
  `adres` varchar(22) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `klantnummer` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `customers`
--

INSERT INTO `customers` (`bedrijf`, `plaats`, `adres`, `postcode`, `klantnummer`) VALUES
('Expert Veendam BV', 'Delfzijl', 'Paddenweg 3', '9948AA', 75775433),
('Cashflowcoach David BV', 'Groningen', 'Sontplein 23', '9728AX', 75802287),
('Continuum BV', 'Groningen', 'Laan1', '9718HF', 75786273),
('Digi Assets BV', 'Groningen', 'Wilhelminaweg 23', '9714CV', 75773570),
('GoudMunt Holding BV', 'Groningen', 'Miloweg 8', '9687KJ', 75784602),
('Guts & Gusto Groningen', 'Groningen', 'Wezerperveldweg 543', '9715KA', 75778653),
('Nedin Holding BV', 'Groningen', 'Laan van de Vrede 1a', '9728AC', 75785285),
('Verfspuiters BV', 'Groningen', 'Kielerbocht 21', '9726AB', 75796031),
('WMGZ BV', 'Groningen', 'Paterswoldseweg 3', '9728CT', 75802171),
('WMGZ Holding BV', 'Groningen', 'Paterswoldseweg 3a', '9728CT', 75800683),
('Jacobien Life & Style ', 'Grootegast', 'Groningerstraat 23', '9860AF', 75778491),
('Jacobien Mode BV', 'Grootegast', 'Grootlaan 1', '9860CA', 75777703),
('Nedeko BV', 'Hellum', 'Waddenpad 5', '9627DA', 75787512),
('R.W. de Koning Holding', 'Hellum', 'Wakenslaan 1', '9627DA', 75785269),
('SW Aeolus Holding BV', 'Holwierde', 'Wierdeweg 12', '9905AB', 75823365),
('SW Aeolus Management B', 'Holwierde', 'Wierdeweg 14', '9905AB', 75825899),
('CeSo Leek BV', 'Leek', 'Koffiebrander 2', '9350ED', 75778580),
('Nextheat BV', 'Leek', 'Kielsterweg 62', '9350CA', 75827654),
('Sustainable Comfort Ho', 'Leek', 'Groningestraat 100', '9351TR', 75824019),
('DPG Beheer BV', 'Marum', 'Kooiker 32', '9363AV', 75810360),
('Dania Holding BV', 'Midwolda', 'Molenhof 23', '9681AA', 75777819),
('Zonnepark Schoorlemmer', 'Nieuwe Pekela', 'Winschoterlaan 21', '9663AF', 75809915),
('360 Holding BV', 'Oude Pekela', 'Nieuwepekelderweg 3', '9665AC', 75827123),
('Conan Groep BV', 'Oude Pekela', 'Nieuwepekelderweg 9', '9665AC', 75827093),
('Daadkrachtig.nu BV', 'Oude Pekela', 'Weg 2', '9664AB', 75827603),
('Sch?fer Mechanical Ser', 'Sappemeer', 'Hoogezandsterweg 4', '9610FE', 75807718),
('De Pelletkachel Reinig', 'Siddeburen', 'Beverlaan 43', '9628AR', 75790548),
('Automotive Insights & ', 'Stadskanaal', 'Kanaalweg 69', '9501BS', 75821524),
('Saivs Holding BV', 'Uithuizermeeden', 'Zeeweg 65b', '9982LG', 75832488),
('MEK Paardensport BV', 'Winschoten', 'St. Vitusholt 34a', '9671HK', 75773481);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `invoices`
--

CREATE TABLE `invoices` (
  `ID` int(11) NOT NULL,
  `factuurdatum` datetime NOT NULL,
  `klantnummer` int(8) NOT NULL,
  `aantallen` mediumblob NOT NULL,
  `artikelnummers` mediumblob NOT NULL,
  `prijzen` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `parts`
--

CREATE TABLE `parts` (
  `kolom1` int(5) NOT NULL,
  `kolom2` int(3) NOT NULL,
  `kolom3` int(6) NOT NULL,
  `artikelgroep` varchar(40) NOT NULL,
  `artikelnummer` varchar(30) NOT NULL,
  `omschrijving` varchar(50) DEFAULT NULL,
  `prijs` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hj@hotmail.com', '$2y$10$8/mqdr7ozH64SqYhLQTWY.56ERaY9FrAq7LGF0/TRX0DywlN8gP9q', '2019-10-15 07:00:41');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Henk', 'hj@hotmail.com', NULL, '$2y$10$y3p0aJGK3HW1AleeFrKOGuUBQt5k3XWuFhk3eCt3UT7wkStS9S3zy', NULL, '2019-10-09 09:44:07', '2019-10-09 09:44:07'),
(2, 'asd asd', 'asd@hotmail.com', NULL, '$2y$10$VJVjaInle901zJdkzhlS8.JUylibMS/HlY51RjVYSGe3sIdHlzIRe', 'UK6vx4JHSrQsEbMoIfz5W9z9NuXFLLF6o5EtuSiMb74fLVOvhzNhMLOlo8KK', '2019-10-10 06:47:57', '2019-10-10 06:47:57');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
