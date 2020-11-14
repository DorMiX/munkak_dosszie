-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2014. Jún 03. 11:25
-- Szerver verzió: 5.6.12-log
-- PHP verzió: 5.4.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `munkak_dosszie`
--
CREATE DATABASE IF NOT EXISTS `munkak_dosszie` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `munkak_dosszie`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `agazatok`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `agazatok`;
CREATE TABLE IF NOT EXISTS `agazatok` (
  `idAgazat` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nvAgazat` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `allapot` tinyint(1) unsigned NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idAgazat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=7 ;

--
-- Truncate table before insert `agazatok`
--

TRUNCATE TABLE `agazatok`;
--
-- A tábla adatainak kiíratása `agazatok`
--

INSERT INTO `agazatok` (`idAgazat`, `nvAgazat`, `allapot`, `letrehozas`, `last_update`) VALUES
(1, 'Gyógyszeripar', 1, '2014-04-22 06:20:17', '2014-02-24 22:26:47'),
(2, 'Vegyipar', 1, '2014-04-22 06:20:17', '2014-04-21 07:47:59'),
(3, 'Élelmiszeripar', 0, '2014-04-22 06:20:17', '2014-02-24 21:14:05'),
(4, 'Gépipar', 0, '2014-04-22 06:20:17', '2014-02-24 21:14:30'),
(5, 'Autóipar', 0, '2014-04-22 06:20:17', '2014-02-24 21:14:41'),
(6, 'Energiaipar', 1, '2014-05-05 09:12:23', '2014-05-05 07:12:43');

--
-- Eseményindítók `agazatok`
--
DROP TRIGGER IF EXISTS `Agazatok_BINS`;
DELIMITER //
CREATE TRIGGER `Agazatok_BINS` BEFORE INSERT ON `agazatok`
 FOR EACH ROW begin
	set new.letrehozas=now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ajanlatok`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `ajanlatok`;
CREATE TABLE IF NOT EXISTS `ajanlatok` (
  `idAjanlatNr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idAjanlat` varchar(14) COLLATE utf8_hungarian_ci NOT NULL,
  `rleiras` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `idProjektNr` bigint(20) unsigned NOT NULL,
  `eutvonal` longtext COLLATE utf8_hungarian_ci,
  `efajlnev` longtext COLLATE utf8_hungarian_ci,
  `tutvonal` longtext COLLATE utf8_hungarian_ci,
  `tfajlnev` longtext COLLATE utf8_hungarian_ci,
  `tlink` longtext COLLATE utf8_hungarian_ci,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idAjanlatNr`,`idProjektNr`),
  UNIQUE KEY `idAjanlat_uq` (`idAjanlat`),
  KEY `fk_idProjektNr_ajanlatok` (`idProjektNr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `ajanlatok`
--

TRUNCATE TABLE `ajanlatok`;
--
-- Eseményindítók `ajanlatok`
--
DROP TRIGGER IF EXISTS `Ajanlatok_BINS`;
DELIMITER //
CREATE TRIGGER `Ajanlatok_BINS` BEFORE INSERT ON `ajanlatok`
 FOR EACH ROW begin
	SET NEW.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allapotok`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `allapotok`;
CREATE TABLE IF NOT EXISTS `allapotok` (
  `idAllapot` tinyint(1) NOT NULL,
  `nvAllapot` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idAllapot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `allapotok`
--

TRUNCATE TABLE `allapotok`;
--
-- A tábla adatainak kiíratása `allapotok`
--

INSERT INTO `allapotok` (`idAllapot`, `nvAllapot`, `letrehozas`, `last_update`) VALUES
(0, 'Inaktív', '2014-04-22 06:20:20', '2014-02-21 08:33:04'),
(1, 'Aktív', '2014-04-22 06:20:20', '2014-02-21 08:33:04');

--
-- Eseményindítók `allapotok`
--
DROP TRIGGER IF EXISTS `Allapotok_BINS`;
DELIMITER //
CREATE TRIGGER `Allapotok_BINS` BEFORE INSERT ON `allapotok`
 FOR EACH ROW -- Edit trigger body code below this line. Do not edit lines above this one
begin
 set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `atadasatvetelik`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `atadasatvetelik`;
CREATE TABLE IF NOT EXISTS `atadasatvetelik` (
  `idAtadasAtveteliNr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idAtadasAtveteli` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `idProjektNr` bigint(20) unsigned NOT NULL,
  `eutvonal` longtext COLLATE utf8_hungarian_ci,
  `efajlnev` longtext COLLATE utf8_hungarian_ci,
  `tutvonal` longtext COLLATE utf8_hungarian_ci,
  `tfajlnev` longtext COLLATE utf8_hungarian_ci,
  `tlink` longtext COLLATE utf8_hungarian_ci,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idAtadasAtveteliNr`,`idProjektNr`),
  UNIQUE KEY `idAtadasAtveteli_uq` (`idAtadasAtveteli`),
  KEY `fk_idProjektNr_atadasatvetelik` (`idProjektNr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `atadasatvetelik`
--

TRUNCATE TABLE `atadasatvetelik`;
--
-- Eseményindítók `atadasatvetelik`
--
DROP TRIGGER IF EXISTS `atadasatvetelik_BINS`;
DELIMITER //
CREATE TRIGGER `atadasatvetelik_BINS` BEFORE INSERT ON `atadasatvetelik`
 FOR EACH ROW begin
	SET NEW.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bejegyzesek`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `bejegyzesek`;
CREATE TABLE IF NOT EXISTS `bejegyzesek` (
  `idBejegyzes` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idProjektNrX` bigint(20) unsigned NOT NULL,
  `idFelhasznaloX` int(10) unsigned NOT NULL,
  `bejegyzes` longtext COLLATE utf8_hungarian_ci NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idBejegyzes`,`idProjektNrX`,`idFelhasznaloX`),
  KEY `fk_idProjektNr_bejegyzesek` (`idProjektNrX`),
  KEY `fk_idFelhasznalo_bejegyzesek` (`idFelhasznaloX`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=11 ;

--
-- Truncate table before insert `bejegyzesek`
--

TRUNCATE TABLE `bejegyzesek`;
--
-- A tábla adatainak kiíratása `bejegyzesek`
--

INSERT INTO `bejegyzesek` (`idBejegyzes`, `idProjektNrX`, `idFelhasznaloX`, `bejegyzes`, `letrehozas`, `last_update`) VALUES
(2, 1, 1, '2. bejegyzés az 1. projekthez', '2014-04-22 06:20:22', '2014-04-16 21:39:07'),
(3, 2, 1, '1. bejegyzés a 2. projekthez', '2014-04-22 06:20:22', '2014-04-16 21:41:21'),
(4, 2, 2, 'dfghftghdrf', '2014-04-22 06:20:22', '2014-04-20 07:07:01'),
(5, 2, 3, 'rr', '2014-04-22 06:20:22', '2014-04-20 07:11:39'),
(8, 4, 3, 'Mégis', '2014-05-05 09:09:46', '2014-05-05 07:09:46'),
(9, 4, 4, 'Megrendelés után azonnal kezdhető!', '2014-05-07 16:30:49', '2014-05-07 14:30:49');

--
-- Eseményindítók `bejegyzesek`
--
DROP TRIGGER IF EXISTS `Bejegyzesek_BINS`;
DELIMITER //
CREATE TRIGGER `Bejegyzesek_BINS` BEFORE INSERT ON `bejegyzesek`
 FOR EACH ROW begin
	set new.letrehozas=now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cegek`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `cegek`;
CREATE TABLE IF NOT EXISTS `cegek` (
  `idCeg` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nvCeg` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `cegteljesnev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `irsz` varchar(4) COLLATE utf8_hungarian_ci NOT NULL,
  `telepules` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `cim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `agazat` int(11) unsigned NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idCeg`),
  UNIQUE KEY `nvCeg_uq` (`nvCeg`),
  KEY `fk_idAgazat_cegek` (`agazat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=7 ;

--
-- Truncate table before insert `cegek`
--

TRUNCATE TABLE `cegek`;
--
-- A tábla adatainak kiíratása `cegek`
--

INSERT INTO `cegek` (`idCeg`, `nvCeg`, `cegteljesnev`, `irsz`, `telepules`, `cim`, `agazat`, `letrehozas`, `last_update`) VALUES
(1, 'AAA', 'AAA Zrt.', '9999', 'Nekeresed', 'Ipapaifapipa u. 0.', 1, '2014-04-22 06:20:23', '2014-02-24 21:17:37'),
(5, 'BBB', 'BBB Nyrt.', '8888', 'Hencida', 'Boncidai út 9876.', 1, '2014-04-22 06:20:23', '2014-04-08 21:30:08'),
(6, 'CCC', 'CCC Energetikai Kft.', '1919', 'Seholsincs', 'Erőmű utca 9.', 6, '2014-05-05 09:13:41', '2014-05-05 07:13:52');

--
-- Eseményindítók `cegek`
--
DROP TRIGGER IF EXISTS `Cegek_BINS`;
DELIMITER //
CREATE TRIGGER `Cegek_BINS` BEFORE INSERT ON `cegek`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `csoportok`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `csoportok`;
CREATE TABLE IF NOT EXISTS `csoportok` (
  `idCsoport` int(11) NOT NULL AUTO_INCREMENT,
  `nvCsoport` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `allapot` tinyint(1) NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idCsoport`),
  KEY `fk_idAllapot_csoportok` (`allapot`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=7 ;

--
-- Truncate table before insert `csoportok`
--

TRUNCATE TABLE `csoportok`;
--
-- A tábla adatainak kiíratása `csoportok`
--

INSERT INTO `csoportok` (`idCsoport`, `nvCsoport`, `allapot`, `letrehozas`, `last_update`) VALUES
(1, 'Vendég', 1, '2014-04-22 06:20:24', '2014-02-25 20:01:36'),
(2, 'Projekt végrehajtó', 1, '2014-04-22 06:20:24', '2014-02-25 20:38:03'),
(3, 'Projekt vezető', 1, '2014-04-22 06:20:24', '2014-03-04 18:35:54'),
(4, 'Projekt irányító', 1, '2014-04-22 06:20:24', '2014-03-04 18:42:45'),
(5, 'Adminisztrátor', 1, '2014-04-22 06:20:24', '2014-03-04 18:42:39'),
(6, 'Supervisor', 1, '2014-04-22 06:20:24', '2014-05-05 07:29:41');

--
-- Eseményindítók `csoportok`
--
DROP TRIGGER IF EXISTS `Csoportok_BINS`;
DELIMITER //
CREATE TRIGGER `Csoportok_BINS` BEFORE INSERT ON `csoportok`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dokumentek`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `dokumentek`;
CREATE TABLE IF NOT EXISTS `dokumentek` (
  `idDokumentNr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idDokument` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `idProjektNr` bigint(20) unsigned NOT NULL,
  `eutvonal` longtext COLLATE utf8_hungarian_ci,
  `efajlnev` longtext COLLATE utf8_hungarian_ci,
  `tutvonal` longtext COLLATE utf8_hungarian_ci,
  `tfajlnev` longtext COLLATE utf8_hungarian_ci,
  `tlink` longtext COLLATE utf8_hungarian_ci,
  `letrehozas` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idDokumentNr`,`idProjektNr`),
  UNIQUE KEY `idDokument_uq` (`idDokument`),
  KEY `fk_idProjektNr_dokumentek` (`idProjektNr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `dokumentek`
--

TRUNCATE TABLE `dokumentek`;
--
-- Eseményindítók `dokumentek`
--
DROP TRIGGER IF EXISTS `dokumentek_BINS`;
DELIMITER //
CREATE TRIGGER `dokumentek_BINS` BEFORE INSERT ON `dokumentek`
 FOR EACH ROW begin
	SET NEW.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `eszkozok`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `eszkozok`;
CREATE TABLE IF NOT EXISTS `eszkozok` (
  `idEszkozNr` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idEszkoz` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `nvEszkoz` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `gyarto` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `tipus` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `gysz` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `allapot` tinyint(1) NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idEszkozNr`),
  UNIQUE KEY `idEszkoz` (`idEszkoz`),
  KEY `fk_idAllapot_eszkozok` (`allapot`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `eszkozok`
--

TRUNCATE TABLE `eszkozok`;
--
-- A tábla adatainak kiíratása `eszkozok`
--

INSERT INTO `eszkozok` (`idEszkozNr`, `idEszkoz`, `nvEszkoz`, `gyarto`, `tipus`, `gysz`, `allapot`, `letrehozas`, `last_update`) VALUES
(1, 'SZKLT-01', 'Szerszám készlet', 'n.a.', 'n.a.', 'n.a.', 1, '2014-04-22 06:20:27', '2014-03-04 21:54:20'),
(2, 'SZKLT-02', 'Szerszám készlet', 'n.a.', 'n.a.', 'n.a.', 1, '2014-04-22 06:20:27', '2014-03-04 21:54:46'),
(3, 'HOSSZ-01', 'Hosszabbító', 'n.a.', '20 m-es', 'n.a.', 1, '2014-05-05 09:31:24', '2014-05-05 07:31:48');

--
-- Eseményindítók `eszkozok`
--
DROP TRIGGER IF EXISTS `Eszkozok_BINS`;
DELIMITER //
CREATE TRIGGER `Eszkozok_BINS` BEFORE INSERT ON `eszkozok`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `felhasznalok`;
CREATE TABLE IF NOT EXISTS `felhasznalok` (
  `idFelhasznalo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nvFelhasznalo` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `nvEmail` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `csoport` int(11) NOT NULL,
  `jelszo` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `teljesnev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `munkakor` int(11) NOT NULL,
  `mobil` varchar(12) COLLATE utf8_hungarian_ci NOT NULL,
  `allapot` tinyint(1) NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idFelhasznalo`),
  UNIQUE KEY `nvFelhasznalo` (`nvFelhasznalo`),
  UNIQUE KEY `idEmail` (`nvEmail`),
  KEY `fk_idCsoport_felhasznalok` (`csoport`),
  KEY `fk_idMunkakor_felhasznalok` (`munkakor`),
  KEY `fk_idAllapot_felhasznalok` (`allapot`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=5 ;

--
-- Truncate table before insert `felhasznalok`
--

TRUNCATE TABLE `felhasznalok`;
--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`idFelhasznalo`, `nvFelhasznalo`, `nvEmail`, `csoport`, `jelszo`, `teljesnev`, `munkakor`, `mobil`, `allapot`, `letrehozas`, `last_update`) VALUES
(1, 'ootto', 'ootto@localhost.com', 6, 'supervisor', 'Okos Ottó', 5, '+36999999999', 1, '2014-04-22 06:20:30', '2014-03-04 20:45:50'),
(2, 'kkatalin', 'kkatalin@localhost.com', 2, 'projektes', 'Kedves Katalin', 1, '+36991234567', 1, '2014-04-22 06:20:30', '2014-03-04 20:51:11'),
(3, 'rroland', 'rroland@localhost.com', 3, 'projektes', 'Rendes Roland', 3, '+36998888888', 1, '2014-04-22 06:20:30', '2014-03-04 20:52:06'),
(4, 'ppeter', 'ppeter@localhost.com', 1, 'qwertz123', 'Projektes Péter', 1, '+36303333777', 1, '2014-05-05 09:17:51', '2014-05-05 07:25:08');

--
-- Eseményindítók `felhasznalok`
--
DROP TRIGGER IF EXISTS `Felhasznalok_BINS`;
DELIMITER //
CREATE TRIGGER `Felhasznalok_BINS` BEFORE INSERT ON `felhasznalok`
 FOR EACH ROW begin
set new.letrehozas=now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `igennem`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `igennem`;
CREATE TABLE IF NOT EXISTS `igennem` (
  `idIN` tinyint(1) unsigned NOT NULL,
  `nvIN` varchar(4) COLLATE utf8_hungarian_ci NOT NULL,
  `letrehozas` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idIN`),
  UNIQUE KEY `nvIN` (`nvIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `igennem`
--

TRUNCATE TABLE `igennem`;
--
-- A tábla adatainak kiíratása `igennem`
--

INSERT INTO `igennem` (`idIN`, `nvIN`, `letrehozas`, `last_update`) VALUES
(0, 'Nem', '2014-04-22 06:20:31', '2014-02-21 08:32:00'),
(1, 'Igen', '2014-04-22 06:20:31', '2014-02-21 08:32:00');

--
-- Eseményindítók `igennem`
--
DROP TRIGGER IF EXISTS `IgenNem_BINS`;
DELIMITER //
CREATE TRIGGER `IgenNem_BINS` BEFORE INSERT ON `igennem`
 FOR EACH ROW -- Edit trigger body code below this line. Do not edit lines above this one
begin
 set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jogok`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `jogok`;
CREATE TABLE IF NOT EXISTS `jogok` (
  `idJog` int(11) NOT NULL AUTO_INCREMENT,
  `nvJog` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `allapot` tinyint(1) NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idJog`),
  KEY `fk_idAllapot_jogok` (`allapot`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=6 ;

--
-- Truncate table before insert `jogok`
--

TRUNCATE TABLE `jogok`;
--
-- A tábla adatainak kiíratása `jogok`
--

INSERT INTO `jogok` (`idJog`, `nvJog`, `allapot`, `letrehozas`, `last_update`) VALUES
(1, 'Projekt megtekintés', 1, '2014-04-22 06:20:32', '2014-03-04 18:37:55'),
(2, 'Projekt szerkesztés', 1, '2014-04-22 06:20:32', '2014-03-04 18:37:19'),
(3, 'Projekt létrehozás', 1, '2014-04-22 06:20:32', '2014-03-04 18:37:02'),
(4, 'Aktiválás/Inaktiválás', 1, '2014-04-22 06:20:32', '2014-03-04 18:41:51'),
(5, 'Törlés', 1, '2014-04-22 06:20:32', '2014-05-05 07:30:24');

--
-- Eseményindítók `jogok`
--
DROP TRIGGER IF EXISTS `Jogok_BINS`;
DELIMITER //
CREATE TRIGGER `Jogok_BINS` BEFORE INSERT ON `jogok`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `megrendelesek`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `megrendelesek`;
CREATE TABLE IF NOT EXISTS `megrendelesek` (
  `idMegrendelesNr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idMegrendeles` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `idProjektNr` bigint(20) unsigned NOT NULL,
  `eutvonal` longtext COLLATE utf8_hungarian_ci,
  `efajlnev` longtext COLLATE utf8_hungarian_ci,
  `tutvonal` longtext COLLATE utf8_hungarian_ci,
  `tfajlnev` longtext COLLATE utf8_hungarian_ci,
  `tlink` longtext COLLATE utf8_hungarian_ci,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMegrendelesNr`,`idProjektNr`),
  UNIQUE KEY `idMegrendeles_uq` (`idMegrendeles`),
  KEY `fk_idProjektNr_megrendelesek` (`idProjektNr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `megrendelesek`
--

TRUNCATE TABLE `megrendelesek`;
--
-- Eseményindítók `megrendelesek`
--
DROP TRIGGER IF EXISTS `megrendelesek_BINS`;
DELIMITER //
CREATE TRIGGER `megrendelesek_BINS` BEFORE INSERT ON `megrendelesek`
 FOR EACH ROW begin
	SET NEW.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `minugyjegyzetek`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `minugyjegyzetek`;
CREATE TABLE IF NOT EXISTS `minugyjegyzetek` (
  `idMinUgyJegyzet` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idProjektNrX` bigint(20) unsigned NOT NULL,
  `idFelhasznaloX` int(10) unsigned NOT NULL,
  `jegyzet` longtext COLLATE utf8_hungarian_ci NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMinUgyJegyzet`,`idProjektNrX`,`idFelhasznaloX`),
  KEY `fk_idProjektNr_minugyjegyzetek` (`idProjektNrX`),
  KEY `fk_idFelhasznalo_minugyjegyzetek` (`idFelhasznaloX`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=5 ;

--
-- Truncate table before insert `minugyjegyzetek`
--

TRUNCATE TABLE `minugyjegyzetek`;
--
-- A tábla adatainak kiíratása `minugyjegyzetek`
--

INSERT INTO `minugyjegyzetek` (`idMinUgyJegyzet`, `idProjektNrX`, `idFelhasznaloX`, `jegyzet`, `letrehozas`, `last_update`) VALUES
(1, 1, 1, '1. minügyjegy az 1. projekthez', '2014-04-22 06:20:36', '2014-04-16 21:41:57'),
(2, 3, 3, 'eee', '2014-04-22 06:20:36', '2014-04-20 07:09:49'),
(3, 4, 1, 'Sok gyártási szám elírás történt', '2014-05-05 09:10:25', '2014-05-05 07:10:25'),
(4, 1, 1, 'OKOKOK', '2014-05-07 16:31:43', '2014-05-07 14:31:43');

--
-- Eseményindítók `minugyjegyzetek`
--
DROP TRIGGER IF EXISTS `MinUgyJegyzetek_BINS`;
DELIMITER //
CREATE TRIGGER `MinUgyJegyzetek_BINS` BEFORE INSERT ON `minugyjegyzetek`
 FOR EACH ROW -- Edit trigger body code below this line. Do not edit lines above this one
begin
set new.letrehozas=now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `munkakorok`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `munkakorok`;
CREATE TABLE IF NOT EXISTS `munkakorok` (
  `idMunkakor` int(11) NOT NULL AUTO_INCREMENT,
  `nvMunkakor` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `allapot` tinyint(1) NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMunkakor`),
  KEY `fk_idAllapot_munkakorok` (`allapot`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=7 ;

--
-- Truncate table before insert `munkakorok`
--

TRUNCATE TABLE `munkakorok`;
--
-- A tábla adatainak kiíratása `munkakorok`
--

INSERT INTO `munkakorok` (`idMunkakor`, `nvMunkakor`, `allapot`, `letrehozas`, `last_update`) VALUES
(1, 'Adatfeldolgozó', 1, '2014-04-22 06:20:38', '2014-03-04 20:38:22'),
(2, 'Kalibráló/Kvalifikáló', 1, '2014-04-22 06:20:38', '2014-03-04 20:39:21'),
(3, 'Metrológus', 1, '2014-04-22 06:20:38', '2014-05-05 07:28:54'),
(4, 'Minőségirányítási vezető', 1, '2014-04-22 06:20:38', '2014-03-04 20:40:09'),
(5, 'Laboratórium vezető', 1, '2014-04-22 06:20:38', '2014-03-04 20:40:21'),
(6, 'Adminisztrátor', 1, '2014-04-22 06:20:38', '2014-05-05 07:29:06');

--
-- Eseményindítók `munkakorok`
--
DROP TRIGGER IF EXISTS `Munkakorok_BINS`;
DELIMITER //
CREATE TRIGGER `Munkakorok_BINS` BEFORE INSERT ON `munkakorok`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `muszerek`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `muszerek`;
CREATE TABLE IF NOT EXISTS `muszerek` (
  `idMuszerNr` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idMuszer` varchar(4) COLLATE utf8_hungarian_ci NOT NULL,
  `nvMuszer` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `gyarto` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `tipus` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `gysz` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `kalbiz` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `kaldatum` date NOT NULL,
  `kalerv` date NOT NULL,
  `allapot` tinyint(1) NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMuszerNr`),
  UNIQUE KEY `idMuszer` (`idMuszer`),
  KEY `fk_idAllapot_muszerek` (`allapot`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `muszerek`
--

TRUNCATE TABLE `muszerek`;
--
-- A tábla adatainak kiíratása `muszerek`
--

INSERT INTO `muszerek` (`idMuszerNr`, `idMuszer`, `nvMuszer`, `gyarto`, `tipus`, `gysz`, `kalbiz`, `kaldatum`, `kalerv`, `allapot`, `letrehozas`, `last_update`) VALUES
(1, 'M001', 'Hőmérsékletmérő', 'KFT', 'HŐM01', 'HM01-1234', 'H1403567', '2014-03-03', '2015-03-31', 1, '2014-04-22 06:20:40', '2014-03-04 21:56:41'),
(2, 'M002', 'Nyomásmérő etalon', 'DRUCK', 'PM620', '3700927', 'P1403382', '2014-03-16', '2015-03-31', 1, '2014-05-05 09:33:14', '2014-05-05 07:33:46');

--
-- Eseményindítók `muszerek`
--
DROP TRIGGER IF EXISTS `Muszerek_BINS`;
DELIMITER //
CREATE TRIGGER `Muszerek_BINS` BEFORE INSERT ON `muszerek`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `partnerek`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `partnerek`;
CREATE TABLE IF NOT EXISTS `partnerek` (
  `idPartner` int(11) NOT NULL AUTO_INCREMENT,
  `ceg` int(10) unsigned NOT NULL,
  `teljesnev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `beosztas` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `reszleg` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `mobil` varchar(12) COLLATE utf8_hungarian_ci NOT NULL,
  `allapot` tinyint(1) NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPartner`),
  KEY `fk_idAllapot_partnerek` (`allapot`),
  KEY `fk_idCeg_partnerek` (`ceg`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `partnerek`
--

TRUNCATE TABLE `partnerek`;
--
-- A tábla adatainak kiíratása `partnerek`
--

INSERT INTO `partnerek` (`idPartner`, `ceg`, `teljesnev`, `beosztas`, `reszleg`, `email`, `mobil`, `allapot`, `letrehozas`, `last_update`) VALUES
(1, 1, 'Megrendelő Miklós', 'Projekt vezető', 'Projekt Iroda', 'mmiklos@aaa.com', '+36991112223', 1, '2014-04-22 06:20:41', '2014-03-04 21:24:25'),
(2, 6, 'Alapos Arnold', 'Műszaki és karbantartási vezető', 'Karbantartás', 'aarnold@ccc.com', '+36997654321', 1, '2014-05-05 09:15:50', '2014-05-05 07:16:27');

--
-- Eseményindítók `partnerek`
--
DROP TRIGGER IF EXISTS `Partnerek_BINS`;
DELIMITER //
CREATE TRIGGER `Partnerek_BINS` BEFORE INSERT ON `partnerek`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `prjtipusok`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `prjtipusok`;
CREATE TABLE IF NOT EXISTS `prjtipusok` (
  `idPrjTipus` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nvPrjTipus` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `allapot` tinyint(1) NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPrjTipus`),
  KEY `fk_idAllapot_prjtipusok` (`allapot`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `prjtipusok`
--

TRUNCATE TABLE `prjtipusok`;
--
-- A tábla adatainak kiíratása `prjtipusok`
--

INSERT INTO `prjtipusok` (`idPrjTipus`, `nvPrjTipus`, `allapot`, `letrehozas`, `last_update`) VALUES
(1, 'Kalibrálás', 1, '2014-04-22 06:20:42', '2014-04-03 20:37:59'),
(2, 'Kvalifikálás', 1, '2014-04-22 06:20:42', '2014-03-04 20:53:18'),
(3, 'Műszaki vizsgálat', 1, '2014-04-22 06:20:42', '2014-04-08 17:08:03');

--
-- Eseményindítók `prjtipusok`
--
DROP TRIGGER IF EXISTS `PrjTipusok_BINS`;
DELIMITER //
CREATE TRIGGER `PrjTipusok_BINS` BEFORE INSERT ON `prjtipusok`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `projektek`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `projektek`;
CREATE TABLE IF NOT EXISTS `projektek` (
  `idProjektNr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idProjekt` varchar(14) COLLATE utf8_hungarian_ci NOT NULL,
  `nvProjekt` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `prjtipus` int(10) unsigned NOT NULL,
  `allapot` tinyint(1) NOT NULL,
  `letrehozas` datetime NOT NULL,
  `letrehozo` int(10) unsigned NOT NULL,
  `leiras` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `ceg` int(10) unsigned NOT NULL,
  `kezdete` date NOT NULL,
  `vege` date NOT NULL,
  `ajanlatkell` tinyint(1) unsigned NOT NULL,
  `megrendelve` tinyint(1) unsigned NOT NULL,
  `dokukesz` tinyint(1) unsigned NOT NULL,
  `advekesz` tinyint(1) unsigned NOT NULL,
  `tibkesz` tinyint(1) unsigned NOT NULL,
  `szamlazva` tinyint(1) unsigned NOT NULL,
  `utoelet` longtext COLLATE utf8_hungarian_ci,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ellenorzojel` int(11) NOT NULL,
  PRIMARY KEY (`idProjektNr`),
  UNIQUE KEY `idProjekt` (`idProjekt`),
  KEY `prjtipus` (`prjtipus`),
  KEY `allapot` (`allapot`),
  KEY `letrehozo` (`letrehozo`),
  KEY `ceg` (`ceg`),
  KEY `ajanlatkell` (`ajanlatkell`),
  KEY `megrendelve` (`megrendelve`),
  KEY `advekesz` (`advekesz`),
  KEY `tibkesz` (`tibkesz`),
  KEY `szamlazva` (`szamlazva`),
  KEY `dokukesz` (`dokukesz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=5 ;

--
-- Truncate table before insert `projektek`
--

TRUNCATE TABLE `projektek`;
--
-- A tábla adatainak kiíratása `projektek`
--

INSERT INTO `projektek` (`idProjektNr`, `idProjekt`, `nvProjekt`, `prjtipus`, `allapot`, `letrehozas`, `letrehozo`, `leiras`, `ceg`, `kezdete`, `vege`, `ajanlatkell`, `megrendelve`, `dokukesz`, `advekesz`, `tibkesz`, `szamlazva`, `utoelet`, `last_update`, `ellenorzojel`) VALUES
(1, 'M2014031004111', 'Hőmérő kalibrálás', 1, 0, '2014-04-22 06:20:46', 2, '3 hőmérő klaibrálása', 1, '2014-03-08', '2014-03-09', 1, 0, 0, 0, 0, 0, '-', '2014-05-05 07:07:25', 0),
(2, 'M2014031004922', 'Tablettázó berendezés működés kvalifikálása', 2, 1, '2014-04-22 06:20:46', 3, 'FET1 kvalifikálása', 1, '2014-03-10', '2014-03-13', 1, 0, 0, 0, 0, 0, '-', '2014-03-04 21:09:38', 893),
(3, 'M2014031431788', 'Csomagoló gépsor kvalifikálása', 2, 1, '2014-04-22 06:20:46', 3, 'Marchesini csomagoló gépsor kvalifikálás', 5, '2014-04-02', '2014-04-05', 0, 1, 0, 0, 0, 0, '-', '2014-04-03 19:33:15', 43),
(4, 'M2014051905334', 'Nyomásmérő kalibrálás', 1, 1, '2014-05-05 09:04:05', 3, 'Erőmű nyomásmérők kalibrálása', 6, '2014-05-05', '2014-05-09', 1, 1, 0, 0, 0, 0, '', '2014-05-27 12:11:14', 253);

--
-- Eseményindítók `projektek`
--
DROP TRIGGER IF EXISTS `Projektek_BINS`;
DELIMITER //
CREATE TRIGGER `Projektek_BINS` BEFORE INSERT ON `projektek`
 FOR EACH ROW -- Edit trigger body code below this line. Do not edit lines above this one
begin
	set new.letrehozas=now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szamlak`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `szamlak`;
CREATE TABLE IF NOT EXISTS `szamlak` (
  `idSzamlaNr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idSzamla` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `idProjektNr` bigint(20) unsigned NOT NULL,
  `eutvonal` longtext COLLATE utf8_hungarian_ci,
  `efajlnev` longtext COLLATE utf8_hungarian_ci,
  `tutvonal` longtext COLLATE utf8_hungarian_ci,
  `tfajlnev` longtext COLLATE utf8_hungarian_ci,
  `tlink` longtext COLLATE utf8_hungarian_ci,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idSzamlaNr`,`idProjektNr`),
  KEY `fk_idProjektNr_szamlak` (`idProjektNr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `szamlak`
--

TRUNCATE TABLE `szamlak`;
--
-- Eseményindítók `szamlak`
--
DROP TRIGGER IF EXISTS `szamlak_BINS`;
DELIMITER //
CREATE TRIGGER `szamlak_BINS` BEFORE INSERT ON `szamlak`
 FOR EACH ROW begin
	SET NEW.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tibek`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `tibek`;
CREATE TABLE IF NOT EXISTS `tibek` (
  `idTibNr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idTib` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `idProjektNr` bigint(20) unsigned NOT NULL,
  `eutvonal` longtext COLLATE utf8_hungarian_ci,
  `efajlnev` longtext COLLATE utf8_hungarian_ci,
  `tutvonal` longtext COLLATE utf8_hungarian_ci,
  `tfajlnev` longtext COLLATE utf8_hungarian_ci,
  `tlink` longtext COLLATE utf8_hungarian_ci,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idTibNr`,`idProjektNr`),
  UNIQUE KEY `idTib_UNIQUE` (`idTib`),
  KEY `fk_idProjektNr_tibek` (`idProjektNr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `tibek`
--

TRUNCATE TABLE `tibek`;
--
-- Eseményindítók `tibek`
--
DROP TRIGGER IF EXISTS `tibek_BINS`;
DELIMITER //
CREATE TRIGGER `tibek_BINS` BEFORE INSERT ON `tibek`
 FOR EACH ROW begin
	SET NEW.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `xcsop_jog`
--
-- Létrehozás: 2014. Máj 05. 08:14
--

DROP TABLE IF EXISTS `xcsop_jog`;
CREATE TABLE IF NOT EXISTS `xcsop_jog` (
  `idCsoportX` int(11) NOT NULL,
  `idJogX` int(11) NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idCsoportX`,`idJogX`),
  KEY `fk_idJog_xcsj` (`idJogX`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `xcsop_jog`
--

TRUNCATE TABLE `xcsop_jog`;
--
-- A tábla adatainak kiíratása `xcsop_jog`
--

INSERT INTO `xcsop_jog` (`idCsoportX`, `idJogX`, `letrehozas`, `last_update`) VALUES
(1, 1, '2014-05-05 09:42:36', '2014-05-05 07:42:36'),
(2, 1, '2014-04-22 06:20:50', '2014-04-16 21:33:49'),
(2, 2, '2014-04-22 06:20:50', '2014-04-16 21:34:00'),
(3, 1, '2014-04-22 06:20:50', '2014-04-16 21:34:11'),
(3, 2, '2014-04-22 06:20:50', '2014-04-16 21:34:21'),
(3, 3, '2014-04-22 06:20:50', '2014-04-16 21:34:32'),
(4, 1, '2014-04-22 06:20:50', '2014-04-16 21:34:42'),
(4, 2, '2014-04-22 06:20:50', '2014-04-16 21:34:54'),
(4, 3, '2014-04-22 06:20:50', '2014-04-16 21:35:03'),
(5, 2, '2014-04-22 06:20:50', '2014-04-16 21:35:32'),
(5, 3, '2014-04-22 06:20:50', '2014-04-16 21:35:42'),
(5, 4, '2014-04-22 06:20:50', '2014-04-16 21:35:57'),
(5, 5, '2014-05-05 14:54:12', '2014-05-05 12:54:12'),
(6, 1, '2014-04-22 06:20:50', '2014-04-16 21:36:14'),
(6, 2, '2014-04-22 06:20:50', '2014-04-16 21:36:29'),
(6, 3, '2014-04-22 06:20:50', '2014-04-16 21:36:39'),
(6, 4, '2014-04-22 06:20:50', '2014-04-16 21:36:47'),
(6, 5, '2014-04-22 06:20:50', '2014-04-16 21:36:56');

--
-- Eseményindítók `xcsop_jog`
--
DROP TRIGGER IF EXISTS `Xcsj_BINS`;
DELIMITER //
CREATE TRIGGER `Xcsj_BINS` BEFORE INSERT ON `xcsop_jog`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `xproj_adve`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `xproj_adve`;
CREATE TABLE IF NOT EXISTS `xproj_adve` (
  `idProjNr` varchar(14) COLLATE utf8_hungarian_ci NOT NULL,
  `idAdVe` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProjNr`,`idAdVe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `xproj_adve`
--

TRUNCATE TABLE `xproj_adve`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `xproj_ajan`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `xproj_ajan`;
CREATE TABLE IF NOT EXISTS `xproj_ajan` (
  `idProjNr` varchar(14) COLLATE utf8_hungarian_ci NOT NULL,
  `idAjanNr` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProjNr`,`idAjanNr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `xproj_ajan`
--

TRUNCATE TABLE `xproj_ajan`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `xproj_alkm`
--
-- Létrehozás: 2014. Máj 07. 07:54
--

DROP TABLE IF EXISTS `xproj_alkm`;
CREATE TABLE IF NOT EXISTS `xproj_alkm` (
  `idProjektNrX` bigint(20) unsigned NOT NULL,
  `idFelhasznaloX` int(10) unsigned NOT NULL,
  `letrehozas` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProjektNrX`,`idFelhasznaloX`),
  KEY `fk_idFelhasznalo_xpa` (`idFelhasznaloX`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `xproj_alkm`
--

TRUNCATE TABLE `xproj_alkm`;
--
-- A tábla adatainak kiíratása `xproj_alkm`
--

INSERT INTO `xproj_alkm` (`idProjektNrX`, `idFelhasznaloX`, `letrehozas`, `last_update`) VALUES
(1, 1, '2014-04-22 06:20:54', '2014-04-16 21:46:04'),
(1, 2, '2014-04-22 06:20:54', '2014-04-16 21:46:13'),
(2, 1, '2014-05-07 10:21:44', '2014-05-07 08:21:44'),
(2, 2, '2014-04-22 06:20:54', '2014-04-16 21:46:28'),
(2, 3, '2014-04-22 06:20:54', '2014-04-16 21:46:36'),
(3, 1, '2014-05-07 10:21:52', '2014-05-07 08:21:52'),
(3, 3, '2014-04-22 06:20:54', '2014-04-16 21:46:51'),
(4, 1, '2014-05-07 10:22:35', '2014-05-07 08:22:35'),
(4, 2, '2014-05-08 15:06:09', '2014-05-08 13:06:09'),
(4, 3, '2014-05-07 16:40:20', '2014-05-07 14:40:20');

--
-- Eseményindítók `xproj_alkm`
--
DROP TRIGGER IF EXISTS `XProj_Alkm_BINS`;
DELIMITER //
CREATE TRIGGER `XProj_Alkm_BINS` BEFORE INSERT ON `xproj_alkm`
 FOR EACH ROW -- Edit trigger body code below this line. Do not edit lines above this one
begin
set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `xproj_doku`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `xproj_doku`;
CREATE TABLE IF NOT EXISTS `xproj_doku` (
  `idProjNr` varchar(14) COLLATE utf8_hungarian_ci NOT NULL,
  `idDokuNr` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProjNr`,`idDokuNr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `xproj_doku`
--

TRUNCATE TABLE `xproj_doku`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `xproj_eszk`
--
-- Létrehozás: 2014. Máj 07. 10:30
--

DROP TABLE IF EXISTS `xproj_eszk`;
CREATE TABLE IF NOT EXISTS `xproj_eszk` (
  `idProjektNrX` bigint(20) unsigned NOT NULL,
  `idEszkozNrX` int(11) unsigned NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProjektNrX`,`idEszkozNrX`),
  KEY `fk_idEszkozNr_xpe` (`idEszkozNrX`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `xproj_eszk`
--

TRUNCATE TABLE `xproj_eszk`;
--
-- A tábla adatainak kiíratása `xproj_eszk`
--

INSERT INTO `xproj_eszk` (`idProjektNrX`, `idEszkozNrX`, `letrehozas`, `last_update`) VALUES
(1, 1, '2014-05-08 15:19:18', '2014-05-08 13:19:18'),
(2, 3, '2014-05-08 15:19:28', '2014-05-08 13:19:28'),
(3, 2, '2014-05-08 15:19:38', '2014-05-08 13:19:38'),
(3, 3, '2014-05-08 15:20:06', '2014-05-08 13:20:06'),
(4, 1, '2014-05-08 15:19:52', '2014-05-08 13:19:52');

--
-- Eseményindítók `xproj_eszk`
--
DROP TRIGGER IF EXISTS `Xpe_BINS`;
DELIMITER //
CREATE TRIGGER `Xpe_BINS` BEFORE INSERT ON `xproj_eszk`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `xproj_megr`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `xproj_megr`;
CREATE TABLE IF NOT EXISTS `xproj_megr` (
  `idProjekt` varchar(14) COLLATE utf8_hungarian_ci NOT NULL,
  `idMegrendeles` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProjekt`,`idMegrendeles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `xproj_megr`
--

TRUNCATE TABLE `xproj_megr`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `xproj_musz`
--
-- Létrehozás: 2014. Máj 07. 13:04
--

DROP TABLE IF EXISTS `xproj_musz`;
CREATE TABLE IF NOT EXISTS `xproj_musz` (
  `idProjektNrX` bigint(20) unsigned NOT NULL,
  `idMuszerNrX` int(11) unsigned NOT NULL,
  `letrehozas` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProjektNrX`,`idMuszerNrX`),
  KEY `fk_idMuszerNr_xpm` (`idMuszerNrX`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `xproj_musz`
--

TRUNCATE TABLE `xproj_musz`;
--
-- A tábla adatainak kiíratása `xproj_musz`
--

INSERT INTO `xproj_musz` (`idProjektNrX`, `idMuszerNrX`, `letrehozas`, `last_update`) VALUES
(1, 1, '2014-05-08 15:21:17', '2014-05-08 13:21:17'),
(2, 2, '2014-05-08 15:21:48', '2014-05-08 13:21:48'),
(3, 1, '2014-05-08 15:21:37', '2014-05-08 13:21:37'),
(4, 2, '2014-05-08 15:21:26', '2014-05-08 13:21:26');

--
-- Eseményindítók `xproj_musz`
--
DROP TRIGGER IF EXISTS `Xpm_BINS`;
DELIMITER //
CREATE TRIGGER `Xpm_BINS` BEFORE INSERT ON `xproj_musz`
 FOR EACH ROW begin
	set new.letrehozas = now();
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `xproj_szlk`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `xproj_szlk`;
CREATE TABLE IF NOT EXISTS `xproj_szlk` (
  `idProjekt` varchar(14) COLLATE utf8_hungarian_ci NOT NULL,
  `idSzamla` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProjekt`,`idSzamla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `xproj_szlk`
--

TRUNCATE TABLE `xproj_szlk`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `xproj_tibz`
--
-- Létrehozás: 2014. Ápr 22. 06:18
--

DROP TABLE IF EXISTS `xproj_tibz`;
CREATE TABLE IF NOT EXISTS `xproj_tibz` (
  `idProjekt` varchar(14) COLLATE utf8_hungarian_ci NOT NULL,
  `idTib` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProjekt`,`idTib`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Truncate table before insert `xproj_tibz`
--

TRUNCATE TABLE `xproj_tibz`;
--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ajanlatok`
--
ALTER TABLE `ajanlatok`
  ADD CONSTRAINT `fk_idProjektNr_ajanlatok` FOREIGN KEY (`idProjektNr`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `atadasatvetelik`
--
ALTER TABLE `atadasatvetelik`
  ADD CONSTRAINT `fk_idProjektNr_atadasatvetelik` FOREIGN KEY (`idProjektNr`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `bejegyzesek`
--
ALTER TABLE `bejegyzesek`
  ADD CONSTRAINT `fk_idFelhasznalo_bejegyzesek` FOREIGN KEY (`idFelhasznaloX`) REFERENCES `felhasznalok` (`idFelhasznalo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idProjektNr_bejegyzesek` FOREIGN KEY (`idProjektNrX`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `cegek`
--
ALTER TABLE `cegek`
  ADD CONSTRAINT `fk_idAgazat_cegek` FOREIGN KEY (`agazat`) REFERENCES `agazatok` (`idAgazat`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `csoportok`
--
ALTER TABLE `csoportok`
  ADD CONSTRAINT `fk_idAllapot_csoportok` FOREIGN KEY (`allapot`) REFERENCES `allapotok` (`idAllapot`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `dokumentek`
--
ALTER TABLE `dokumentek`
  ADD CONSTRAINT `fk_idProjektNr_dokumentek` FOREIGN KEY (`idProjektNr`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `eszkozok`
--
ALTER TABLE `eszkozok`
  ADD CONSTRAINT `fk_idAllapot_eszkozok` FOREIGN KEY (`allapot`) REFERENCES `allapotok` (`idAllapot`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD CONSTRAINT `fk_idAllapot_felhasznalok` FOREIGN KEY (`allapot`) REFERENCES `allapotok` (`idAllapot`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idCsoport_felhasznalok` FOREIGN KEY (`csoport`) REFERENCES `csoportok` (`idCsoport`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idMunkakor_felhasznalok` FOREIGN KEY (`munkakor`) REFERENCES `munkakorok` (`idMunkakor`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `jogok`
--
ALTER TABLE `jogok`
  ADD CONSTRAINT `fk_idAllapot_jogok` FOREIGN KEY (`allapot`) REFERENCES `allapotok` (`idAllapot`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `megrendelesek`
--
ALTER TABLE `megrendelesek`
  ADD CONSTRAINT `fk_idProjektNr_megrendelesek` FOREIGN KEY (`idProjektNr`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `minugyjegyzetek`
--
ALTER TABLE `minugyjegyzetek`
  ADD CONSTRAINT `fk_idFelhasznalo_minugyjegyzetek` FOREIGN KEY (`idFelhasznaloX`) REFERENCES `felhasznalok` (`idFelhasznalo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idProjektNr_minugyjegyzetek` FOREIGN KEY (`idProjektNrX`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `munkakorok`
--
ALTER TABLE `munkakorok`
  ADD CONSTRAINT `fk_idAllapot_munkakorok` FOREIGN KEY (`allapot`) REFERENCES `allapotok` (`idAllapot`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `muszerek`
--
ALTER TABLE `muszerek`
  ADD CONSTRAINT `fk_idAllapot_muszerek` FOREIGN KEY (`allapot`) REFERENCES `allapotok` (`idAllapot`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `partnerek`
--
ALTER TABLE `partnerek`
  ADD CONSTRAINT `fk_idAllapot_partnerek` FOREIGN KEY (`allapot`) REFERENCES `allapotok` (`idAllapot`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idCeg_partnerek` FOREIGN KEY (`ceg`) REFERENCES `cegek` (`idCeg`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `prjtipusok`
--
ALTER TABLE `prjtipusok`
  ADD CONSTRAINT `fk_idAllapot_prjtipusok` FOREIGN KEY (`allapot`) REFERENCES `allapotok` (`idAllapot`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `projektek`
--
ALTER TABLE `projektek`
  ADD CONSTRAINT `fk_idAllapot_projektek` FOREIGN KEY (`allapot`) REFERENCES `allapotok` (`idAllapot`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idCeg_projektek` FOREIGN KEY (`ceg`) REFERENCES `cegek` (`idCeg`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idFelhasznalo_projektek` FOREIGN KEY (`letrehozo`) REFERENCES `felhasznalok` (`idFelhasznalo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idIN_advekesz` FOREIGN KEY (`advekesz`) REFERENCES `igennem` (`idIN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idIN_ajanlatkell` FOREIGN KEY (`ajanlatkell`) REFERENCES `igennem` (`idIN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idIN_dokukesz` FOREIGN KEY (`dokukesz`) REFERENCES `igennem` (`idIN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idIN_megrendelve` FOREIGN KEY (`megrendelve`) REFERENCES `igennem` (`idIN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idIN_szamlazva` FOREIGN KEY (`szamlazva`) REFERENCES `igennem` (`idIN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idIN_tibkesz` FOREIGN KEY (`tibkesz`) REFERENCES `igennem` (`idIN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idPrjTipus_projektek` FOREIGN KEY (`prjtipus`) REFERENCES `prjtipusok` (`idPrjTipus`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `szamlak`
--
ALTER TABLE `szamlak`
  ADD CONSTRAINT `fk_idProjektNr_szamlak` FOREIGN KEY (`idProjektNr`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `tibek`
--
ALTER TABLE `tibek`
  ADD CONSTRAINT `fk_idProjektNr_tibek` FOREIGN KEY (`idProjektNr`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `xcsop_jog`
--
ALTER TABLE `xcsop_jog`
  ADD CONSTRAINT `fk_idCsoport_xcsj` FOREIGN KEY (`idCsoportX`) REFERENCES `csoportok` (`idCsoport`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idJog_xcsj` FOREIGN KEY (`idJogX`) REFERENCES `jogok` (`idJog`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `xproj_alkm`
--
ALTER TABLE `xproj_alkm`
  ADD CONSTRAINT `fk_idFelhasznalo_xpa` FOREIGN KEY (`idFelhasznaloX`) REFERENCES `felhasznalok` (`idFelhasznalo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idProjektNr_xpa` FOREIGN KEY (`idProjektNrX`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `xproj_eszk`
--
ALTER TABLE `xproj_eszk`
  ADD CONSTRAINT `fk_idEszkozNr_xpe` FOREIGN KEY (`idEszkozNrX`) REFERENCES `eszkozok` (`idEszkozNr`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idProjektNr_xpe` FOREIGN KEY (`idProjektNrX`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `xproj_musz`
--
ALTER TABLE `xproj_musz`
  ADD CONSTRAINT `fk_idMuszerNr_xpm` FOREIGN KEY (`idMuszerNrX`) REFERENCES `muszerek` (`idMuszerNr`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idProjektNr_xpm` FOREIGN KEY (`idProjektNrX`) REFERENCES `projektek` (`idProjektNr`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
