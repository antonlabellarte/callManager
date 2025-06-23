-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 23, 2025 alle 12:50
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queues`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `campaign`
--

CREATE TABLE `campaign` (
  `id` int(255) NOT NULL,
  `message` longtext DEFAULT NULL,
  `queue` int(255) DEFAULT NULL,
  `dropCall` bit(1) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dateStart` datetime(6) NOT NULL,
  `dateEnd` datetime(6) NOT NULL,
  `allCustomers` bit(1) NOT NULL,
  `enabled` bit(1) NOT NULL,
  `toQueue` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `customerslist`
--

CREATE TABLE `customerslist` (
  `id` int(255) NOT NULL,
  `campaignID` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `rules`
--

CREATE TABLE `rules` (
  `id` int(255) NOT NULL,
  `servizioPartizionato` varchar(255) DEFAULT NULL,
  `dataInizio` date DEFAULT NULL,
  `dataFine` date DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `oraInizio` time(6) DEFAULT NULL,
  `oraFine` time(6) DEFAULT NULL,
  `servizioUno` varchar(255) DEFAULT NULL,
  `percentualeUno` varchar(255) DEFAULT NULL,
  `servizioDue` varchar(255) DEFAULT NULL,
  `partizioneDue` varchar(255) DEFAULT NULL,
  `servizioTre` varchar(255) DEFAULT NULL,
  `partizioneTre` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `rules`
--

INSERT INTO `rules` (`id`, `servizioPartizionato`, `dataInizio`, `dataFine`, `flag`, `oraInizio`, `oraFine`, `servizioUno`, `percentualeUno`, `servizioDue`, `partizioneDue`, `servizioTre`, `partizioneTre`, `created_at`, `updated_at`) VALUES
(8, 'ABC', NULL, NULL, 'ALL', '06:01:00.000000', '08:01:00.000000', 'ABC_DEF', NULL, NULL, NULL, NULL, NULL, '2025-04-22', '2025-04-22');

-- --------------------------------------------------------

--
-- Struttura della tabella `services`
--

CREATE TABLE `services` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `queue` int(255) DEFAULT NULL,
  `typology` varchar(255) DEFAULT NULL,
  `skillGroup` varchar(255) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`) VALUES
(1, 'Admin', '$2y$12$BbgS2kqKWcBbHqgm/FJJA.oPYo0mzkw3oZt9.xUripQBEpSxI5QuO', '');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `customerslist`
--
ALTER TABLE `customerslist`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `customerslist`
--
ALTER TABLE `customerslist`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `services`
--
ALTER TABLE `services`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
