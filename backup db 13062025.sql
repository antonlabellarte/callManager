-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 13, 2025 alle 15:09
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
-- Database: `estate_agency`
--
CREATE DATABASE IF NOT EXISTS `estate_agency` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `estate_agency`;

-- --------------------------------------------------------

--
-- Struttura della tabella `agenti`
--

CREATE TABLE `agenti` (
  `id` int(255) NOT NULL,
  `nome_agente` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `agenti`
--

INSERT INTO `agenti` (`id`, `nome_agente`, `email`, `telefono`, `status`, `updated_at`, `created_at`) VALUES
(4, 'Antonio', 'antonio@mail.it', '1234567890', 'Attivo', '2024-04-22 15:18:43.000000', '2024-04-22 15:18:43.000000'),
(5, 'Francesco', 'francesco@mail.it', '1234567890', 'Attivo', '2024-08-28 13:19:33.000000', '2024-04-22 15:21:00.000000');

-- --------------------------------------------------------

--
-- Struttura della tabella `immobili`
--

CREATE TABLE `immobili` (
  `id` int(255) NOT NULL,
  `nome_immobile` varchar(255) NOT NULL,
  `civico` varchar(255) NOT NULL,
  `città` varchar(255) NOT NULL,
  `interno` varchar(255) NOT NULL,
  `prezzo_immobile` varchar(255) NOT NULL,
  `locazione_mensile` varchar(255) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `parti`
--

CREATE TABLE `parti` (
  `id` int(255) NOT NULL,
  `nome_parte` varchar(255) NOT NULL,
  `tipologia_parte` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `transazioni`
--

CREATE TABLE `transazioni` (
  `id` int(255) NOT NULL,
  `data` date DEFAULT NULL,
  `nome_immobile` varchar(255) DEFAULT NULL,
  `numero_fattura_acquirente` int(255) DEFAULT NULL,
  `acquirente` varchar(255) DEFAULT NULL,
  `locazione_acquirente` int(255) DEFAULT NULL,
  `vendita_acquirente` int(255) DEFAULT NULL,
  `incassato_acquirente` int(255) DEFAULT NULL,
  `saldo_acquirente` int(255) DEFAULT NULL,
  `numero_fattura_venditore` int(255) DEFAULT NULL,
  `venditore` varchar(255) DEFAULT NULL,
  `locazione_venditore` int(255) DEFAULT NULL,
  `vendita_venditore` int(255) DEFAULT NULL,
  `incassato_venditore` int(255) DEFAULT NULL,
  `saldo_venditore` int(255) DEFAULT NULL,
  `totale_locazione` int(255) DEFAULT NULL,
  `totale_vendita` int(255) DEFAULT NULL,
  `totale_incassato` int(255) DEFAULT NULL,
  `totale_saldo` int(255) DEFAULT NULL,
  `id_agente_uno` int(255) DEFAULT NULL,
  `percentuale_agente_uno` int(255) DEFAULT NULL,
  `provv_agente_uno` int(255) DEFAULT NULL,
  `extra_agente_uno` int(255) DEFAULT NULL,
  `totale_agente_uno` int(255) DEFAULT NULL,
  `pagam_agente_uno` int(255) DEFAULT NULL,
  `saldo_agente_uno` int(255) DEFAULT NULL,
  `data_pagamento_agente_uno` date DEFAULT NULL,
  `id_agente_due` int(255) DEFAULT NULL,
  `percentuale_agente_due` int(255) DEFAULT NULL,
  `provv_agente_due` int(255) DEFAULT NULL,
  `extra_agente_due` int(255) DEFAULT NULL,
  `totale_agente_due` int(255) DEFAULT NULL,
  `pagam_agente_due` int(255) DEFAULT NULL,
  `saldo_agente_due` int(11) DEFAULT NULL,
  `data_pagamento_agente_due` date DEFAULT NULL,
  `segnalatore` varchar(255) DEFAULT NULL,
  `importo_segnalatore` int(255) DEFAULT NULL,
  `pagato_segnalatore` int(255) DEFAULT NULL,
  `saldo_segnalatore` int(255) DEFAULT NULL,
  `percmedialocazione_locazione_mensile` int(255) DEFAULT NULL,
  `locazione_annua` int(255) DEFAULT NULL,
  `percentuale_media_locazioneprovvigione_totale` int(255) DEFAULT NULL,
  `percentuale_media_locazione` int(255) DEFAULT NULL,
  `percentuale_media_vendite_prezzo_immobile` int(255) DEFAULT NULL,
  `percentuale_media_vendite_provvigione_totale` int(11) DEFAULT NULL,
  `percentuale_media_vendite` int(11) DEFAULT NULL,
  `transazione` varchar(255) DEFAULT NULL,
  `tipologia` varchar(255) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `transazioni`
--

INSERT INTO `transazioni` (`id`, `data`, `nome_immobile`, `numero_fattura_acquirente`, `acquirente`, `locazione_acquirente`, `vendita_acquirente`, `incassato_acquirente`, `saldo_acquirente`, `numero_fattura_venditore`, `venditore`, `locazione_venditore`, `vendita_venditore`, `incassato_venditore`, `saldo_venditore`, `totale_locazione`, `totale_vendita`, `totale_incassato`, `totale_saldo`, `id_agente_uno`, `percentuale_agente_uno`, `provv_agente_uno`, `extra_agente_uno`, `totale_agente_uno`, `pagam_agente_uno`, `saldo_agente_uno`, `data_pagamento_agente_uno`, `id_agente_due`, `percentuale_agente_due`, `provv_agente_due`, `extra_agente_due`, `totale_agente_due`, `pagam_agente_due`, `saldo_agente_due`, `data_pagamento_agente_due`, `segnalatore`, `importo_segnalatore`, `pagato_segnalatore`, `saldo_segnalatore`, `percmedialocazione_locazione_mensile`, `locazione_annua`, `percentuale_media_locazioneprovvigione_totale`, `percentuale_media_locazione`, `percentuale_media_vendite_prezzo_immobile`, `percentuale_media_vendite_provvigione_totale`, `percentuale_media_vendite`, `transazione`, `tipologia`, `updated_at`, `created_at`) VALUES
(36, '2024-08-20', 'Via Rossi 5', 2, 'Luca Bianchi', 1500, NULL, 1500, 0, 1, 'Mario Verdi', 1500, NULL, 1500, 0, 3000, NULL, 3000, 0, 4, 40, 1200, NULL, 1200, NULL, 1200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1400, 16800, 3000, 18, NULL, NULL, NULL, 'Locazione', 'Capannone', '2024-08-21 08:52:19.000000', '2024-08-21 08:52:19.000000'),
(37, '2024-09-28', 'Viale della Repubblica', 4, 'Giacomo Gialli', NULL, 7650, 7650, 0, 3, 'Fabrizio Verdi', NULL, 5000, 5000, 0, NULL, 12650, 12650, 0, 5, 40, 5060, NULL, 5060, NULL, 5060, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 255000, 12650, 5, 'Locazione', 'Abitazione', '2024-08-21 08:54:58.000000', '2024-08-21 08:54:58.000000');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `gender`) VALUES
(1, 'Admin', '$2y$12$RMgJJ1vQA8iIy.RUa8REc.qB8k6le93cKhTbfU.mBZjmpdLtBg6au', NULL, 'male');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `agenti`
--
ALTER TABLE `agenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `immobili`
--
ALTER TABLE `immobili`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `parti`
--
ALTER TABLE `parti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `transazioni`
--
ALTER TABLE `transazioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agente secondario` (`id_agente_due`),
  ADD KEY `agente primario` (`id_agente_uno`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `agenti`
--
ALTER TABLE `agenti`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `immobili`
--
ALTER TABLE `immobili`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `parti`
--
ALTER TABLE `parti`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `transazioni`
--
ALTER TABLE `transazioni`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `transazioni`
--
ALTER TABLE `transazioni`
  ADD CONSTRAINT `agente primario` FOREIGN KEY (`id_agente_uno`) REFERENCES `agenti` (`id`),
  ADD CONSTRAINT `agente secondario` FOREIGN KEY (`id_agente_due`) REFERENCES `agenti` (`id`);
--
-- Database: `ofc_agency`
--
CREATE DATABASE IF NOT EXISTS `ofc_agency` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ofc_agency`;

-- --------------------------------------------------------

--
-- Struttura della tabella `agenti`
--

CREATE TABLE `agenti` (
  `id` int(255) NOT NULL,
  `agente` varchar(255) NOT NULL,
  `numero_visita` varchar(255) NOT NULL,
  `id_cliente` int(255) NOT NULL,
  `ultima_visita` date NOT NULL,
  `note` varchar(255) NOT NULL,
  `attivita` varchar(255) NOT NULL,
  `aggiornamenti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `altre_posizioni_fornitori`
--

CREATE TABLE `altre_posizioni_fornitori` (
  `id` int(255) NOT NULL,
  `id_fornitore` int(255) DEFAULT NULL,
  `altra_posizione` text DEFAULT NULL,
  `telefono` text DEFAULT NULL,
  `mail` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `altre_posizioni_fornitori`
--

INSERT INTO `altre_posizioni_fornitori` (`id`, `id_fornitore`, `altra_posizione`, `telefono`, `mail`, `created_at`, `updated_at`) VALUES
(6, 1, 'ewre', '1232', 'mail@mail.it', '2025-02-05', '2025-03-18');

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

CREATE TABLE `articoli` (
  `id` int(255) NOT NULL,
  `codice_articolo` varchar(255) NOT NULL,
  `importo_cadauno` varchar(255) NOT NULL,
  `quantita` int(255) NOT NULL,
  `sconto` varchar(255) NOT NULL,
  `id_preventivo` int(255) NOT NULL,
  `importo_scontato` int(255) NOT NULL,
  `descrizione` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE `clienti` (
  `id` int(255) NOT NULL,
  `cliente` varchar(255) DEFAULT NULL,
  `ragione_sociale` varchar(255) DEFAULT NULL,
  `codice_fiscale` varchar(255) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `citta` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `cap` int(255) DEFAULT NULL,
  `regione` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `sito` varchar(255) DEFAULT NULL,
  `chiusura` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `pec` varchar(255) DEFAULT NULL,
  `agente` varchar(255) DEFAULT NULL,
  `sdi` varchar(255) DEFAULT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `partita_iva` varchar(255) DEFAULT NULL,
  `responsabile_scarico` varchar(255) DEFAULT NULL,
  `indirizzo_scarico` varchar(255) DEFAULT NULL,
  `citta_scarico` varchar(255) DEFAULT NULL,
  `telefono_responsabile_scarico` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `clienti`
--

INSERT INTO `clienti` (`id`, `cliente`, `ragione_sociale`, `codice_fiscale`, `indirizzo`, `citta`, `provincia`, `cap`, `regione`, `telefono`, `fax`, `sito`, `chiusura`, `categoria`, `pec`, `agente`, `sdi`, `iban`, `partita_iva`, `responsabile_scarico`, `indirizzo_scarico`, `citta_scarico`, `telefono_responsabile_scarico`, `note`, `tipo`, `created_at`, `updated_at`) VALUES
(1, '1001', 'Alfa S.r.l.', 'RSSMRA85M01H501U', 'Via Roma, 12', NULL, 'MI', 20100, 'Lombardia', '080808080', '02-12345678', 'www.alfasrl.com', '18:00', 'Commercio', 'alfasrl@pec.it', 'Marco Bianchi\"\"\"\"\"', 'ABCD123', 'IT60X0542811101000000123456', '01234567890', 'Luigi Rossi', NULL, NULL, '011-2345678', 'Nessuna', 'Privato', NULL, '2025-03-18 16:55:24.000000'),
(2, '1002', 'Beta S.p.A.', 'CSTFNC80A01F205Y', 'Viale Libertà, 23', 'Roma', 'RM', 185, 'Lazio', '', '06-87654321', 'www.betaspa.it', '19:00', 'Industria', 'betaspa@pec.it', 'Sara Verdi', 'EFGH456', 'IT75P0306909606100000012345', '09876543210', 'Mario Verdi', '', 'Napoli', '081-1234567', 'Ordini prioritari', 'Azienda', NULL, NULL),
(3, '1003', 'Gamma Group', 'CLZPLZ88D13H703S', 'Via dei Mille, 56', 'Firenze', 'FI', 50100, 'Toscana', '', '055-2345678', 'www.gammagroup.com', '17:30', 'Servizi', 'gammagroup@pec.it', 'Elisa Neri', 'IJKL789', 'IT46A0347501601050123456789', '12345678901', 'Antonio Neri', '', 'Bologna', '051-7654321', 'Richiede firma all\'arrivo', 'Azienda', NULL, NULL),
(4, '1004', 'Delta Impianti S.r.l.', 'RSTGVL92R01B208V', 'Corso Italia, 45', 'Napoli', 'NA', 80100, 'Campania', '', '081-9876543', 'www.deltaimpiantisrl.it', '16:00', 'Costruzioni', 'deltaimpianti@pec.it', 'Luca Conti', 'MNOP012', 'IT18D0569601601012345678901', '23456789012', 'Giovanni Conti', '', 'Salerno', '089-1237890', 'Necessaria conferma di scarico', 'Azienda', NULL, NULL),
(5, '1005', 'Epsilon Informatica', 'LZZFBR79S12E793N', 'Via Garibaldi, 78', 'Palermo', 'PA', 90100, 'Sicilia', '', '091-6543210', 'www.epsiloninformatica.it', '20:00', 'Informatica', 'epsilonsrl@pec.it', 'Fabio Rossi', 'QRST345', 'IT91F0103070400012345678901', '34567890123', 'Alessia Bianchi', '', 'Catania', '095-7654321', 'Chiamare prima di scaricare', 'Privato', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `collaboratori_clienti`
--

CREATE TABLE `collaboratori_clienti` (
  `id` int(255) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `responsabile_o_luogo` varchar(255) NOT NULL,
  `cellulare` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `ruolo` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitori`
--

CREATE TABLE `fornitori` (
  `id` int(255) NOT NULL,
  `ditta` varchar(255) DEFAULT NULL,
  `ragione_sociale` varchar(255) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `citta` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `cap` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `pec` varchar(255) DEFAULT NULL,
  `direzione` varchar(255) DEFAULT NULL,
  `telefono_direzione` varchar(255) DEFAULT NULL,
  `mail_direzione` varchar(255) DEFAULT NULL,
  `commerciale` varchar(255) DEFAULT NULL,
  `telefono_commerciale` varchar(255) DEFAULT NULL,
  `mail_commerciale` varchar(255) DEFAULT NULL,
  `amministrazione` varchar(255) DEFAULT NULL,
  `telefono_amministrazione` varchar(255) DEFAULT NULL,
  `mail_amministrazione` varchar(255) DEFAULT NULL,
  `agente` varchar(255) DEFAULT NULL,
  `sdi` varchar(255) DEFAULT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `partita_iva` varchar(255) DEFAULT NULL,
  `costi_di_trasporto` varchar(255) DEFAULT NULL,
  `condizioni_di_vendita` varchar(255) DEFAULT NULL,
  `minimo_dordine` varchar(255) DEFAULT NULL,
  `pagamenti` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `fornitori`
--

INSERT INTO `fornitori` (`id`, `ditta`, `ragione_sociale`, `indirizzo`, `citta`, `provincia`, `cap`, `telefono`, `fax`, `pec`, `direzione`, `telefono_direzione`, `mail_direzione`, `commerciale`, `telefono_commerciale`, `mail_commerciale`, `amministrazione`, `telefono_amministrazione`, `mail_amministrazione`, `agente`, `sdi`, `iban`, `partita_iva`, `costi_di_trasporto`, `condizioni_di_vendita`, `minimo_dordine`, `pagamenti`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Omega Tech S.r.l.', NULL, NULL, 'Milano', 'MI', '20121', '02-6543210', '02-9876543', 'omegatech@pec.it', 'Anna Rossi', '02-6543220', 'a.rossi@omegatech.it', 'Luca Bianchi', '02-6543230', 'l.bianchi@omegatech.it', 'Giulia Verdi', '02-6543240', 'g.verdi@omegatech.it', 'Seleziona un agente', 'ABCD123', 'IT60X0542811101000000654321', '01234567891', '50€', 'Franco fabbrica', '100', 'Bonifico', 'Nessuna', NULL, '2025-03-18'),
(2, 'Sigma S.p.A.', 'Sigma S.p.A.', 'Corso Italia, 55', 'Roma', 'RM', '00185', '06-5432109', '06-8765432', 'sigmaspa@pec.it', 'Paolo Conti', '06-5432110', 'p.conti@sigmaspa.it', 'Francesca Russo', '06-5432120', 'f.russo@sigmaspa.it', 'Roberto Rossi', '06-5432130', 'r.rossi@sigmaspa.it', 'Laura Neri', 'EFGH456', 'IT75P0306909606100000054321', '09876543211', '75€', 'Ex works', '200', 'Assegno', 'Consegne entro 7 giorni', NULL, NULL),
(3, 'Beta Componenti', 'Beta Componenti', 'Via Roma, 30', 'Firenze', 'FI', '50122', '055-7654321', '055-2345670', 'betacomponenti@pec.it', 'Andrea Ferrari', '055-7654331', 'a.ferrari@betacomponenti.it', 'Laura Bianchi', '055-7654341', 'l.bianchi@betacomponenti.it', 'Marco Conti', '055-7654351', 'm.conti@betacomponenti.it', 'Elisa Verdi', 'IJKL789', 'IT46A0347501601050674321012', '12345678912', '100€', 'DDP', '150', 'Contanti', 'Richiedere sconto per ordini', NULL, NULL),
(4, 'Delta Distribuzioni', 'Delta Distribuzioni', 'Via Garibaldi, 85', 'Napoli', 'NA', '80134', '081-8765432', '081-6543219', 'deltadistribuzioni@pec.it', 'Simone Neri', '081-8765443', 's.neri@deltadistribuzioni.it', 'Marta Rossi', '081-8765453', 'm.rossi@deltadistribuzioni.it', 'Chiara Verdi', '081-8765463', 'c.verdi@deltadistribuzioni.it', 'Fabio Bianchi', 'MNOP012', 'IT18D0569601601010765432101', '23456789013', '50€', 'FCA', '250', 'CartaCredito', 'Priorità agli ordini urgenti', NULL, NULL),
(5, 'Gamma Logistica', 'Gamma Logistica S.r.l', 'Strada Statale, 12', 'Torino', 'TO', '10122', '011-5432109', '011-9876543', 'gammalogistica@pec.it', 'Lorenzo Bianchi', '011-5432110', 'l.bianchi@gammalogistica.it', 'Alice Verdi', '011-5432120', 'a.verdi@gammalogistica.it', 'Stefano Rossi', '011-5432130', 's.rossi@gammalogistica.it', 'Seleziona un agente', NULL, NULL, NULL, '60€', 'CIF', '100', NULL, 'test', NULL, '2025-01-20');

-- --------------------------------------------------------

--
-- Struttura della tabella `mail_clienti`
--

CREATE TABLE `mail_clienti` (
  `id` int(255) NOT NULL,
  `id_cliente` int(255) NOT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `id` int(255) NOT NULL,
  `data` date DEFAULT NULL,
  `id_cliente` int(255) DEFAULT NULL,
  `id_fornitore` int(255) DEFAULT NULL,
  `agente` varchar(255) DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `codice_ordine` varchar(255) DEFAULT NULL,
  `pagamento` varchar(255) DEFAULT NULL,
  `oneri_vari` varchar(255) DEFAULT NULL,
  `codice_articolo` varchar(255) DEFAULT NULL,
  `importo_cadauno` varchar(255) DEFAULT NULL,
  `quantita` int(255) DEFAULT NULL,
  `sconto` int(255) DEFAULT NULL,
  `importo_totale` int(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`id`, `data`, `id_cliente`, `id_fornitore`, `agente`, `descrizione`, `codice_ordine`, `pagamento`, `oneri_vari`, `codice_articolo`, `importo_cadauno`, `quantita`, `sconto`, `importo_totale`, `note`, `created_at`, `updated_at`) VALUES
(15, '2024-09-17', 1, 1, 'A', 'test', '0001', 'pagah', '1200', '0101', '2000', 1, 50, 1000, 'musicali', '2024-09-16 21:48:44.000000', '2024-09-17 21:55:39.000000'),
(16, '2024-09-17', 1, 1, 'A', 'test', '010101', 'pagah', NULL, '0001', '1000', 1, 50, 500, '34545', '2024-09-17 21:25:24.000000', '2024-09-17 21:51:11.000000'),
(17, NULL, 1, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2025-03-18 13:46:20.000000', '2025-03-18 13:46:20.000000'),
(18, '2025-03-18', 1, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2025-03-18 14:36:21.000000', '2025-03-18 14:36:21.000000');

-- --------------------------------------------------------

--
-- Struttura della tabella `preventivi`
--

CREATE TABLE `preventivi` (
  `id` int(255) NOT NULL,
  `id_cliente` int(255) NOT NULL,
  `id_fornitore` int(255) NOT NULL,
  `agente` varchar(255) NOT NULL,
  `descrizione` int(255) NOT NULL,
  `codice_ordine` int(255) NOT NULL,
  `pagamento` varchar(255) NOT NULL,
  `onerI_vari` varchar(255) NOT NULL,
  `sconto` int(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `importo_totale` int(255) NOT NULL,
  `iva` int(255) NOT NULL,
  `importo_iva` int(255) NOT NULL,
  `importo_totale_scontato` int(255) NOT NULL,
  `data_di_consegna` date NOT NULL,
  `consegna` varchar(255) NOT NULL,
  `imballo` varchar(255) NOT NULL,
  `resa` varchar(255) NOT NULL,
  `spedizione` varchar(255) NOT NULL,
  `pagamento_preventivo` varchar(255) NOT NULL,
  `trasportoPreventivo` int(255) NOT NULL,
  `banca` int(255) NOT NULL,
  `riferimento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `telefono_clienti`
--

CREATE TABLE `telefono_clienti` (
  `id` int(255) NOT NULL,
  `id_cliente` int(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `telefono_clienti`
--

INSERT INTO `telefono_clienti` (`id`, `id_cliente`, `telefono`, `note`, `created_at`, `updated_at`) VALUES
(5, 1, NULL, NULL, '2025-03-18', '2025-03-18');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`) VALUES
(1, 'Admin', '$2y$12$mS1djrZVAmvSKOcKOBLbQ.KQENHfIKZZ5oCviJDWXui01Sbrc5U.6', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `visite`
--

CREATE TABLE `visite` (
  `id` int(255) NOT NULL,
  `agente` varchar(255) DEFAULT NULL,
  `numero_visita` varchar(255) DEFAULT NULL,
  `cliente` varchar(255) DEFAULT NULL,
  `ultima_visita` date DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `attivita` varchar(255) DEFAULT NULL,
  `aggiornamenti` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `visite`
--

INSERT INTO `visite` (`id`, `agente`, `numero_visita`, `cliente`, `ultima_visita`, `note`, `attivita`, `aggiornamenti`, `created_at`, `updated_at`) VALUES
(1, 'E', '1', 'Alfa S.r.l.', '2025-01-24', 'Testa', 'Testa', 'Testa', '2025-01-25', '2025-01-25'),
(3, 'A', '1', 'Delta Impianti S.r.l.', NULL, NULL, NULL, NULL, '2025-01-25', '2025-01-25'),
(4, 'A', '1', 'Seleziona un Cliente', NULL, NULL, NULL, NULL, '2025-03-11', '2025-03-11');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `agenti`
--
ALTER TABLE `agenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `altre_posizioni_fornitori`
--
ALTER TABLE `altre_posizioni_fornitori`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `collaboratori_clienti`
--
ALTER TABLE `collaboratori_clienti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `fornitori`
--
ALTER TABLE `fornitori`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `mail_clienti`
--
ALTER TABLE `mail_clienti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`id_cliente`),
  ADD KEY `fornitore` (`id_fornitore`);

--
-- Indici per le tabelle `preventivi`
--
ALTER TABLE `preventivi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `telefono_clienti`
--
ALTER TABLE `telefono_clienti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `agenti`
--
ALTER TABLE `agenti`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `altre_posizioni_fornitori`
--
ALTER TABLE `altre_posizioni_fornitori`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `articoli`
--
ALTER TABLE `articoli`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `clienti`
--
ALTER TABLE `clienti`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `collaboratori_clienti`
--
ALTER TABLE `collaboratori_clienti`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `fornitori`
--
ALTER TABLE `fornitori`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `mail_clienti`
--
ALTER TABLE `mail_clienti`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `preventivi`
--
ALTER TABLE `preventivi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `telefono_clienti`
--
ALTER TABLE `telefono_clienti`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `visite`
--
ALTER TABLE `visite`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clienti` (`id`),
  ADD CONSTRAINT `fornitore` FOREIGN KEY (`id_fornitore`) REFERENCES `fornitori` (`id`);
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__bookmark`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__bookmark: #1932 - Table &#039;phpmyadmin.pma__bookmark&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__bookmark: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__bookmark`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__central_columns`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__central_columns: #1932 - Table &#039;phpmyadmin.pma__central_columns&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__central_columns: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__central_columns`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__column_info`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__column_info: #1932 - Table &#039;phpmyadmin.pma__column_info&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__column_info: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__column_info`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__designer_settings`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__designer_settings: #1932 - Table &#039;phpmyadmin.pma__designer_settings&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__designer_settings: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__designer_settings`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__export_templates`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__export_templates: #1932 - Table &#039;phpmyadmin.pma__export_templates&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__export_templates: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__export_templates`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__favorite`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__favorite: #1932 - Table &#039;phpmyadmin.pma__favorite&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__favorite: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__favorite`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__history`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__history: #1932 - Table &#039;phpmyadmin.pma__history&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__history: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__history`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__navigationhiding`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__navigationhiding: #1932 - Table &#039;phpmyadmin.pma__navigationhiding&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__navigationhiding: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__navigationhiding`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__pdf_pages`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__pdf_pages: #1932 - Table &#039;phpmyadmin.pma__pdf_pages&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__pdf_pages: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__pdf_pages`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__recent`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__recent: #1932 - Table &#039;phpmyadmin.pma__recent&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__recent: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__recent`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__relation`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__relation: #1932 - Table &#039;phpmyadmin.pma__relation&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__relation: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__relation`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__savedsearches`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__savedsearches: #1932 - Table &#039;phpmyadmin.pma__savedsearches&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__savedsearches: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__savedsearches`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__table_coords`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__table_coords: #1932 - Table &#039;phpmyadmin.pma__table_coords&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__table_coords: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__table_coords`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__table_info`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__table_info: #1932 - Table &#039;phpmyadmin.pma__table_info&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__table_info: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__table_info`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__table_uiprefs`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__table_uiprefs: #1932 - Table &#039;phpmyadmin.pma__table_uiprefs&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__table_uiprefs: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__table_uiprefs`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__tracking`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__tracking: #1932 - Table &#039;phpmyadmin.pma__tracking&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__tracking: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__tracking`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__userconfig`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__userconfig: #1932 - Table &#039;phpmyadmin.pma__userconfig&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__userconfig: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__userconfig`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__usergroups`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__usergroups: #1932 - Table &#039;phpmyadmin.pma__usergroups&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__usergroups: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__usergroups`&#039; linea 1

-- --------------------------------------------------------

--
-- Struttura della tabella `pma__users`
--
-- Si è verificato un errore durante la lettura della struttura della tabella phpmyadmin.pma__users: #1932 - Table &#039;phpmyadmin.pma__users&#039; doesn&#039;t exist in engine
-- Si è verificato un errore durante la lettura dei dati della tabella phpmyadmin.pma__users: #1064 - Errore di sintassi nella query SQL vicino a &#039;FROM `phpmyadmin`.`pma__users`&#039; linea 1
--
-- Database: `queues`
--
CREATE DATABASE IF NOT EXISTS `queues` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `queues`;

-- --------------------------------------------------------

--
-- Struttura della tabella `campagneduplicate`
--

CREATE TABLE `campagneduplicate` (
  `id` int(255) NOT NULL,
  `regolaid` int(255) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `campagneduplicate`
--

INSERT INTO `campagneduplicate` (`id`, `regolaid`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-05-20 17:34:33.000000', '2025-05-20 17:34:33.000000'),
(2, 1, '2025-05-20 17:34:33.000000', '2025-05-20 17:34:33.000000'),
(3, 1, '2025-05-20 17:34:33.000000', '2025-05-20 17:34:33.000000'),
(4, 1, '2025-05-20 17:34:33.000000', '2025-05-20 17:34:33.000000');

-- --------------------------------------------------------

--
-- Struttura della tabella `campagneliste`
--

CREATE TABLE `campagneliste` (
  `id` int(255) NOT NULL,
  `regolaid` int(255) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `campagneliste`
--

INSERT INTO `campagneliste` (`id`, `regolaid`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-05-20 17:32:35.000000', '2025-05-20 17:32:35.000000'),
(2, 1, '2025-05-20 17:32:35.000000', '2025-05-20 17:32:35.000000'),
(3, 1, '2025-05-20 17:32:35.000000', '2025-05-20 17:32:35.000000'),
(4, 1, '2025-05-20 17:32:35.000000', '2025-05-20 17:32:35.000000');

-- --------------------------------------------------------

--
-- Struttura della tabella `campagneregole`
--

CREATE TABLE `campagneregole` (
  `idCampagna` int(255) NOT NULL,
  `testo` longtext DEFAULT NULL,
  `coda` int(4) DEFAULT NULL,
  `abbattimento` bit(1) DEFAULT NULL,
  `nomeCampagna` varchar(255) DEFAULT NULL,
  `dataInizio` datetime(6) DEFAULT NULL,
  `dataFine` datetime(6) DEFAULT NULL,
  `allCustomer` bit(1) DEFAULT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `campagneregole`
--

INSERT INTO `campagneregole` (`idCampagna`, `testo`, `coda`, `abbattimento`, `nomeCampagna`, `dataInizio`, `dataFine`, `allCustomer`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1000, b'1', 'campagna uno', '2025-05-27 00:00:00.000000', '2025-05-28 00:00:00.000000', b'1', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `queues`
--

CREATE TABLE `queues` (
  `servizio` varchar(255) NOT NULL,
  `coda` varchar(255) NOT NULL,
  `tipologia` varchar(255) NOT NULL,
  `specializzazione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `queues`
--

INSERT INTO `queues` (`servizio`, `coda`, `tipologia`, `specializzazione`) VALUES
('ABC', '1234', 'principale', NULL),
('ABC_DEF', '1234_5678', 'secondaria', NULL),
('DEF', '5678', 'principale', NULL),
('DEF_GHI', '5678_9012', 'secondaria', NULL),
('GHI', '9012', 'principale', NULL),
('GHI_ABC', '9012_1234', 'secondaria', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `rules`
--

CREATE TABLE `rules` (
  `id` int(255) NOT NULL,
  `servizio` varchar(255) DEFAULT NULL,
  `data_iniziale` date DEFAULT NULL,
  `data_finale` date DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `ora_iniziale` time(6) DEFAULT NULL,
  `ora_finale` time(6) DEFAULT NULL,
  `coda_uno` varchar(255) DEFAULT NULL,
  `partizione_uno` varchar(255) DEFAULT NULL,
  `coda_due` varchar(255) DEFAULT NULL,
  `partizione_due` varchar(255) DEFAULT NULL,
  `coda_tre` varchar(255) DEFAULT NULL,
  `partizione_tre` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `rules`
--

INSERT INTO `rules` (`id`, `servizio`, `data_iniziale`, `data_finale`, `flag`, `ora_iniziale`, `ora_finale`, `coda_uno`, `partizione_uno`, `coda_due`, `partizione_due`, `coda_tre`, `partizione_tre`, `created_at`, `updated_at`) VALUES
(8, 'ABC', NULL, NULL, 'ALL', '06:01:00.000000', '08:01:00.000000', 'ABC_DEF', NULL, NULL, NULL, NULL, NULL, '2025-04-22', '2025-04-22'),
(13, 'GHI', '2025-04-24', '2025-04-24', 'GIORNO', '05:00:00.000000', '09:00:00.000000', 'ABC_DEF', NULL, NULL, NULL, NULL, NULL, '2025-04-24', '2025-04-24'),
(15, 'GHI', NULL, NULL, 'SABATO', '02:01:00.000000', '04:01:00.000000', 'DEF_GHI', NULL, 'GHI_ABC', NULL, NULL, NULL, '2025-05-27', '2025-05-27');

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
-- Indici per le tabelle `campagneduplicate`
--
ALTER TABLE `campagneduplicate`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `campagneliste`
--
ALTER TABLE `campagneliste`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `campagneregole`
--
ALTER TABLE `campagneregole`
  ADD PRIMARY KEY (`idCampagna`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`servizio`);

--
-- Indici per le tabelle `rules`
--
ALTER TABLE `rules`
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
-- AUTO_INCREMENT per la tabella `campagneregole`
--
ALTER TABLE `campagneregole`
  MODIFY `idCampagna` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
