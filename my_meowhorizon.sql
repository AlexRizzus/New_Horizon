-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 24, 2020 alle 23:28
-- Versione del server: 10.4.13-MariaDB
-- Versione PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_meowhorizon`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi_utenti`
--

CREATE TABLE `messaggi_utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `oggetto` varchar(256) NOT NULL,
  `messaggio` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `messaggi_utenti`
--

INSERT INTO `messaggi_utenti` (`id`, `username`, `oggetto`, `messaggio`) VALUES
(9, 'davide', 'richiesta chiarificazioni', 'Salve, vorrei chiedere qualche approfondimento sui pannelli a neutrini che avete sviluppato come indicato nella pagina RICERCA; mi servirebbe per una ricerca scolastica. Grazie mille in anticipo, Davide.');

-- --------------------------------------------------------

--
-- Struttura della tabella `missioni`
--

CREATE TABLE `missioni` (
  `nome` varchar(25) NOT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `stato` enum('in preparazione','in corso','rientrata','fallita','terminata') NOT NULL,
  `affiliazioni` varchar(200) DEFAULT NULL,
  `destinazione` varchar(40) DEFAULT NULL,
  `scopo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `missioni`
--

INSERT INTO `missioni` (`nome`, `data_inizio`, `data_fine`, `stato`, `affiliazioni`, `destinazione`, `scopo`) VALUES
('Andromeda 1', '2024-04-05', '2030-01-01', 'in preparazione', 'Nasa, Esa', 'marte', 'stabilire una base operativa e prima produzione materiale biologico'),
('Andromeda 2', NULL, NULL, 'in preparazione', 'Nasa, Esa, Unipd', 'Marte', 'studio e raccolta di materiali preziosi da Marte'),
('Andromeda 3', '2024-04-05', '2026-05-23', 'in preparazione', 'Nasa, Asi', 'mercurio', 'studio superficie mercurio'),
('AndromedaX 2', NULL, NULL, 'in preparazione', 'Nasa, Esa', 'Marte', 'studio ghiacciai di marte.'),
('AndromedaX 3', NULL, NULL, 'in preparazione', 'Nasa, Esa', 'Marte', 'esaminazione atmosfera superficiale di marte per determinare i livelli di radiazioni'),
('AndromedaX 5', '1991-01-15', '1991-01-16', 'fallita', 'nessuna', 'alta atmosfera', 'studiare aurora boreale'),
('Deus', '1990-10-10', '1990-12-12', 'rientrata', 'Nasa, Asi', 'Giove', 'raccolta di informazioni'),
('Deus2', '1991-01-15', '1991-05-16', 'terminata', 'Nasa, Asi', 'Giove', 'raccolta di informazioni'),
('Iuran 24', '2020-01-19', NULL, 'in corso', 'Nasa, Unipd, Cnsa', 'Urano', 'raccolta di informazioni riguardanti il pianeta Urano'),
('Mariner 1', '1962-07-22', '1962-07-22', 'fallita', 'Nasa, Asi, Cnsa', 'Venere', 'seconda prova di una sonda per raggiungere Venere'),
('Mariner 2', '1962-08-27', '1962-12-14', 'terminata', 'Nasa, Asi, Cnsa', 'Venere', 'raccolta di informazioni sul pianeta Venere'),
('Venera 1', '1961-02-12', '1961-02-19', 'fallita', 'Nasa, Asi, Cnsa', 'Venere', 'prima prova di una sonda per raggiungere Venere'),
('Voyager 3', '0000-00-00', '0000-00-00', '', 'Nasa, Esa, SpaceX, Maunakea', 'Spazio profondo', 'esplorazione e raccolta dati');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `username` varchar(20) NOT NULL,
  `psswd` varchar(25) NOT NULL,
  `sesso` enum('M','F','A') DEFAULT NULL,
  `e_mail` varchar(30) NOT NULL,
  `occupazione` varchar(50) DEFAULT NULL,
  `livello` enum('generico','dipendente','amministratore') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `psswd`, `sesso`, `e_mail`, `occupazione`, `livello`) VALUES
('admin', 'admin', 'M', 'admin@gmail.com', 'amministratore di questo splendido sito', 'amministratore'),
('davide', 'davide', 'M', 'davide.davide@gmail.com', 'studente', 'generico'),
('emanuele', 'emanuele', 'M', 'emanuele.emanuele@gmail.com', 'amministratore sito', 'amministratore'),
('user', 'user', 'M', 'user@gmail.com', 'utente innamorato del sito', 'generico');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti_missioni`
--

CREATE TABLE `utenti_missioni` (
  `username` varchar(20) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti_missioni`
--

INSERT INTO `utenti_missioni` (`username`, `nome`) VALUES
('davide', 'Andromeda 2'),
('davide', 'AndromedaX 3'),
('davide', 'Deus'),
('davide', 'Mariner 1'),
('davide', 'Venera 1'),
('user', 'Andromeda 1'),
('user', 'Iuran 24');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `messaggi_utenti`
--
ALTER TABLE `messaggi_utenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `missioni`
--
ALTER TABLE `missioni`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `utenti_missioni`
--
ALTER TABLE `utenti_missioni`
  ADD PRIMARY KEY (`username`,`nome`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `messaggi_utenti`
--
ALTER TABLE `messaggi_utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
