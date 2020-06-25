-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Giu 25, 2020 alle 15:31
-- Versione del server: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- Versione PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dlazzaro`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Messaggi_utenti`
--

CREATE TABLE `Messaggi_utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `oggetto` varchar(256) NOT NULL,
  `messaggio` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Messaggi_utenti`
--

INSERT INTO `Messaggi_utenti` (`id`, `username`, `oggetto`, `messaggio`) VALUES
(9, 'davide', 'richiesta chiarificazioni', 'Salve, vorrei chiedere qualche approfondimento sui pannelli a neutrini che avete sviluppato come indicato nella pagina RICERCA; mi servirebbe per una ricerca scolastica. Grazie mille in anticipo, Davide.');

-- --------------------------------------------------------

--
-- Struttura della tabella `Missioni`
--

CREATE TABLE `Missioni` (
  `nome` varchar(25) NOT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `stato` enum('in preparazione','in corso','rientrata','fallita','terminata') NOT NULL,
  `affiliazioni` varchar(200) DEFAULT NULL,
  `destinazione` varchar(40) DEFAULT NULL,
  `scopo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Missioni`
--

INSERT INTO `Missioni` (`nome`, `data_inizio`, `data_fine`, `stato`, `affiliazioni`, `destinazione`, `scopo`) VALUES
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
('Voyager 3', '0000-00-00', '0000-00-00', 'in preparazione', 'Nasa, Esa, SpaceX, Maunakea', 'Spazio profondo', 'esplorazione e raccolta dati');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `username` varchar(20) NOT NULL,
  `psswd` varchar(25) NOT NULL,
  `sesso` enum('M','F','A') DEFAULT NULL,
  `e_mail` varchar(30) NOT NULL,
  `occupazione` varchar(50) DEFAULT NULL,
  `livello` enum('generico','dipendente','amministratore') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`username`, `psswd`, `sesso`, `e_mail`, `occupazione`, `livello`) VALUES
('admin', 'admin', 'M', 'admin@gmail.com', 'amministratore di questo splendido sito', 'amministratore'),
('davide', 'davide', 'M', 'davide.davide@gmail.com', 'studente', 'generico'),
('emanuele', 'emanuele', 'M', 'emanuele.emanuele@gmail.com', 'amministratore sito', 'amministratore'),
('user', 'user', 'M', 'user@gmail.com', 'utente innamorato del sito', 'generico');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti_Missioni`
--

CREATE TABLE `Utenti_Missioni` (
  `username` varchar(20) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Utenti_Missioni`
--

INSERT INTO `Utenti_Missioni` (`username`, `nome`) VALUES
('davide', 'Andromeda 2'),
('davide', 'AndromedaX 3'),
('davide', 'Deus'),
('davide', 'Mariner 1'),
('davide', 'Venera 1'),
('user', 'Andromeda 1'),
('user', 'Andromeda 2'),
('user', 'Andromeda 3'),
('user', 'AndromedaX 5'),
('user', 'Iuran 24'),
('user', 'Mariner 2');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Messaggi_utenti`
--
ALTER TABLE `Messaggi_utenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Missioni`
--
ALTER TABLE `Missioni`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `Utenti_Missioni`
--
ALTER TABLE `Utenti_Missioni`
  ADD PRIMARY KEY (`username`,`nome`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Messaggi_utenti`
--
ALTER TABLE `Messaggi_utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
