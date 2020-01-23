-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Sty 2020, 16:59
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ssd`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `company`
--

CREATE TABLE `company` (
  `CompanyID` int(50) NOT NULL,
  `LicenseID` int(50) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `company`
--

INSERT INTO `company` (`CompanyID`, `LicenseID`, `Name`, `Address`, `Phone`, `Email`) VALUES
(2, 1, 'Bratan', 'Ulica Stroitelej 3b, Moskow, Russia', '481294124', 'bratan@info.ru'),
(3, 2, 'Don&Berry', 'Milton Drive 142, California, US', '42019295958', 'db@info.com'),
(4, 3, 'Abbibas', 'Kim Chong street 24', '2144141241', 'legitabbibas@legit.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(50) NOT NULL,
  `CompanyID` int(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `filepath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `customer`
--

INSERT INTO `customer` (`CustomerID`, `CompanyID`, `username`, `customer_name`, `phone`, `email`, `password`, `filepath`) VALUES
(2, 3, 'John Doe', 'John', '38483298423', 'John@mam.com', 'password', '../userImg/download.png'),
(3, 4, 'Nick', 'Nickboi', '543958432', 'nick@gege', 'password', NULL),
(8, NULL, 'Chiki465', 'Tomek', '999888222', 'ss@gmail.com', '$2y$10$gsOSlKZJTVHWO', 'userImg/pobrane.jpg'),
(9, NULL, 'Tokk', 'Tomek', '999888222', 'ss@gmail.com', '$2y$10$JWG8ILjAa5HUw', '../userImg/pobrane.jpg'),
(10, 2, 'afasfasfas', 'fsafas', '999888222', 'grondofrondo@gmail.com', '$2y$10$dp6wCK.UQYfib', '../userImg/Rick_Sanchez.png'),
(11, NULL, 'afasfasfasfsfasfas', 'fsafas', '999888222', 'grondofrondo@gmail.com', '$2y$10$KtNh4zfuv02hP', '../userImg/Rick_Sanchez.png'),
(14, 2, 'david', 'david', 'david', 'david@magic.com', '$2y$10$xH.kbwv5ke02L7pOVyk3vOWxLN.9WMa07eGUllJiqZJ8dP5Jt6SfW', '../userImg/zuck.png'),
(15, NULL, 'nghi.banh', 'Nghi Hao', '06836112225', 'banhhaonghi02@gmail.com', '$2y$10$lSfyVRKzS7A5wJekE2N2c.g.OZmcOZrpLbV8MrTZrVTZpW3nUmUN6', '../userImg/'),
(16, 2, 'marek', 'marek', '123456789', 'grondofrondo@gmail.com', '$2y$10$M.gXowdfWHYGnisWE5N1IODaRiGobQbv89Ijm57VpRVhl59/3/J7i', '../userImg/pobrane.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `frequency`
--

CREATE TABLE `frequency` (
  `FrequencyID` int(10) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `frequency`
--

INSERT INTO `frequency` (`FrequencyID`, `description`) VALUES
(1, 'hardly_ever'),
(2, 'sometimes'),
(3, 'often'),
(4, 'always');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incident`
--

CREATE TABLE `incident` (
  `IncidentID` int(255) NOT NULL,
  `SolutionID` int(50) DEFAULT 5,
  `TypeID` int(50) NOT NULL,
  `OperatorID` int(50) DEFAULT NULL,
  `StatusID` int(50) NOT NULL,
  `CustomerID` int(50) NOT NULL,
  `FrequencyID` int(10) NOT NULL,
  `Topic` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `RegisteredBy` varchar(30) NOT NULL,
  `report_date` date NOT NULL,
  `resolution_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `incident`
--

INSERT INTO `incident` (`IncidentID`, `SolutionID`, `TypeID`, `OperatorID`, `StatusID`, `CustomerID`, `FrequencyID`, `Topic`, `Description`, `RegisteredBy`, `report_date`, `resolution_date`) VALUES
(1, 11, 1, 5, 2, 2, 1, 'fasfasf', 'fasfasfas', 'customer', '2020-01-13', NULL),
(23, 12, 5, 5, 2, 14, 4, 'MY DED GO LEFT HOUSE', 'HE SED &quot;I GO GET CIAGERET&quot; AND NEVRE CEYM BAC', 'customer', '2020-01-17', '2020-01-20'),
(24, 13, 5, 10, 2, 14, 1, 'Nothing is working', '0', 'customer', '2020-01-17', '2020-01-20'),
(25, 18, 5, 3, 2, 14, 2, 'When life gives you lemons', 'When I find myself in times of trouble\r\nMother Mary comes to me\r\nSpeaking words of wisdom\r\nLet it be\r\n\r\nAnd in my hour of darkness\r\nShe is standing right in front of me\r\nSpeaking words of wisdom\r\nLet it be', 'customer', '2020-01-17', '2020-01-20'),
(26, 28, 5, 10, 2, 14, 1, 'ADS', 'ASFASFASFA', 'customer', '2020-01-17', '2020-01-20'),
(27, 29, 5, 10, 2, 14, 1, 'asf', 'fasf\r\n', 'customer', '2020-01-17', '2020-01-20'),
(28, 27, 5, 10, 2, 14, 1, 'saf', 'fas', 'customer', '2020-01-17', '2020-01-20'),
(29, 30, 5, 10, 2, 14, 3, 'Error #13 Crash', 'Crash', 'customer', '2020-01-17', '2020-01-20'),
(30, 31, 5, 10, 2, 14, 1, ',', 'k\r\n', 'customer', '2020-01-17', '2020-01-20'),
(31, 32, 5, 10, 2, 14, 1, 'jkahdkjas', 'dsjhbdh', 'customer', '2020-01-17', '2020-01-20'),
(33, 5, 3, NULL, 1, 14, 1, 'fasfasf', 'ASFASf', 'customer', '2020-01-21', '2020-01-24'),
(34, 5, 3, NULL, 1, 14, 1, 'fasfasf', 'ASFASf', 'customer', '2020-01-21', '2020-01-24'),
(36, 5, 3, NULL, 1, 14, 1, 'fasfasf', 'ASFASf', 'customer', '2020-01-21', '2020-01-24'),
(37, 33, 1, 10, 2, 14, 4, 'SOCK ARE NICE', 'I LIKE WHEN MY FEET are WARM', 'customer', '2020-01-21', '2020-01-24'),
(38, 34, 1, 10, 2, 14, 1, 'PROBLEM', 'PLES HALP\r\n', 'customer', '2020-01-21', '2020-01-24'),
(39, 53, 3, 10, 2, 14, 4, 'SOSAT SUKI', 'SAKI PIT SUKI\r\nAZAZAZA', 'customer', '2020-01-21', '2020-01-24'),
(40, 60, 1, 10, 2, 14, 4, 'The program is crashing randomly', 'I cannot get my work done as every 15 minutes it crashes', 'customer', '2020-01-21', '2020-01-24'),
(42, 5, 1, 10, 1, 14, 4, 'What is love', 'Baby dont hurt me', 'customer', '2020-01-21', '2020-01-24'),
(43, 5, 5, 10, 1, 14, 1, 'aSFASF', 'asfasf', 'phone', '2020-01-21', '2020-01-24'),
(44, 62, 1, 10, 3, 14, 1, 'fasf', 'fsaf', 'phone', '2020-01-21', '2020-01-24'),
(45, 66, 1, 7, 1, 16, 2, 'avenus', 'kokoko afffffffffff asssssssssss', 'customer', '2020-01-23', '2020-01-26'),
(46, 67, 1, 7, 2, 3, 1, 'fsafas', 'saf', 'phone', '2020-01-23', '2020-01-24'),
(48, 68, 1, 5, 1, 3, 1, 'uuuuuuuuuuuuuuu', 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu', 'phone', '2020-01-23', '2020-01-24'),
(49, 5, 1, 5, 2, 3, 1, 'hhhhhhhhhhhhhhhhhhh', 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'phone', '2020-01-23', '2020-01-24'),
(50, 5, 1, 10, 1, 16, 1, 'fasfasfas', 'fsafa', 'customer', '2020-01-23', '2020-01-26'),
(51, 5, 1, 10, 1, 3, 1, 'fasfas', 'fasfa', 'phone', '2020-01-23', '2020-01-24'),
(52, 70, 1, 5, 2, 16, 1, 'hdthdthtt', 'dhhthd', 'customer', '2020-01-23', '2020-01-26'),
(53, 5, 4, 5, 1, 16, 1, 'ticket submit', 'error', 'customer', '2020-01-23', '2020-01-26'),
(54, 74, 1, 2, 2, 16, 1, 'ooooooooooooooooooooooooo', 'ja pierdole\r\n', 'customer', '2020-01-23', '2020-01-26'),
(55, 76, 1, 5, 2, 16, 1, 'chuj', 'submit chuj', 'customer', '2020-01-23', '2020-01-26'),
(56, 5, 1, 3, 1, 16, 1, 'wwwwwwwwwwwwww', 'wwwwwwwwwwwwwwwwww', 'customer', '2020-01-23', '2020-01-26');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `license`
--

CREATE TABLE `license` (
  `LicenseID` int(4) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `license`
--

INSERT INTO `license` (`LicenseID`, `description`) VALUES
(1, 'Bronze licence'),
(2, 'Silver licence'),
(3, 'Gold licence');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `operator`
--

CREATE TABLE `operator` (
  `OperatorID` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Operator_name` varchar(50) NOT NULL,
  `Clearance` int(4) NOT NULL,
  `password` varchar(250) NOT NULL,
  `filepath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `operator`
--

INSERT INTO `operator` (`OperatorID`, `username`, `Operator_name`, `Clearance`, `password`, `filepath`) VALUES
(1, 'René Laan', 'René', 1, 'password', NULL),
(2, 'Bert', 'Bert Meijrink', 3, '$2y$10$VMYfhyRzeAk6m3I0Db.V4eFID9IOIB/YKB9FZqZhTIFh3zBZOCOVe', '../userImg/download.png'),
(3, 'no operator assigned', 'no operator assigned', 1, 'mein swamp', NULL),
(4, 'Moo', 'Motoo', 2, '$2y$10$VMYfhyRzeAk6m3I0Db.V4eFID9IOIB/YKB9FZqZhTIFh3zBZOCOVe', '../userImg/download.png'),
(5, 'Nick', 'Nickboi', 1, 'password', NULL),
(6, 'John Doe', 'John', 1, 'password', NULL),
(7, 'Aleksii', 'aleks69', 1, 'password', NULL),
(8, 'John Doe', 'John', 1, 'password', NULL),
(9, 'John Doe', 'John', 1, 'password', NULL),
(10, 'dave', 'dave', 1, '$2y$10$VMYfhyRzeAk6m3I0Db.V4eFID9IOIB/YKB9FZqZhTIFh3zBZOCOVe', '../userImg/download.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `solution`
--

CREATE TABLE `solution` (
  `SolutionID` int(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `solution`
--

INSERT INTO `solution` (`SolutionID`, `Description`) VALUES
(1, 'Turn the system OFF and ON again'),
(2, 'Turn the system OFF and ON again'),
(3, 'Go into the SETTINGS tab in the MENU and press VERIFY THE VERSION'),
(4, 'Try Reinstalling the program, 1) Go into your start menu in windows, then type the apps & features 2) find the program and uninstall it, 3) Go to https://stendensoftware.nl/download login and download the .EXE file. 4) Install the downladed file'),
(5, ''),
(7, 'SAFASFASF'),
(9, 'aFSAFASFASFASFAf'),
(10, 'asdasdas'),
(11, 'asdasdas'),
(12, 'Yo Dady is a bitch boi'),
(13, 'asFASFAF'),
(14, 'Cheddar'),
(15, 'Cheddar'),
(16, 'cheddar'),
(17, 'cheddar'),
(18, 'ASFASF'),
(19, 'ASFASF'),
(20, 'ASFASF'),
(21, 'asfasf'),
(22, 'asfasf'),
(23, 'asASFASF'),
(24, 'asASFASF'),
(25, 'asfasf'),
(26, 'asfasf'),
(27, 'ASFSF'),
(28, '1'),
(29, 'YA YEEEEEEEEEEEEEEEEEET'),
(30, 'DAMN FEELS BAD MAN. *Team Leader Added*: dolbaeb. *Team Leader Added*: dolbaeb'),
(31, 'EZ FIX'),
(32, 'SHIET'),
(33, 'SKEET THE YEET, YA BEEEEEET. *Team Leader Added*: WHATCHA SAY ABOUT MA MAMA?. *Team Leader Added*: YO WHAT THE FUCK. *Team Leader Added*: ARE U CRAY CRAY?'),
(34, 'YOOOOOOOOOO'),
(35, 'Yo deal with it urself ADDED on: \"04:18:17 pm\" Whats ur problem man.    On: \"04:19:11 pm\" Added: This is the anwser.    On: \"04:19:25 pm\" Added: This is hardcore.    <br>On: \"04:19:38 pm\" Added: ASFASFASF.    <br>On: \"04:19:40 pm\" Added: ASFASFSAF.    <br'),
(36, 'A'),
(37, 'AAAAAAAAAAAAAAAAAAAAAA'),
(38, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),
(39, 'A'),
(40, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),
(41, ''),
(42, 'AAAAAAAAAAAAAAAAAAAA.<br>On: \"04:40:18 pm\" Added: AAAAAAAAAAAA.<br>On: \"04:40:22 pm\" Added: AAAAAAAAAAAAAAAAAAA.<br>On: \"04:40:25 pm\" Added: ASFASFASFSAFSAFA.<br>On: \"04:40:27 pm\" Added: AFSFASFASFSAF.<br>On: \"04:40:29 pm\" Added: AFSAFSAFASFASF.<br>On: \"0'),
(43, 'AAAAAAAAAAAA'),
(44, 'AAAAAAAAAAAAAAAAAAA'),
(45, 'ASFASFASFSAFSAFA'),
(46, 'AFSFASFASFSAF'),
(47, 'AFSAFSAFASFASF'),
(48, 'ASFASFASFASFSAFASFASFASFASFASFASFASF'),
(49, 'FSFASF'),
(50, ''),
(51, ''),
(52, 'aasf'),
(53, 'AJFASNLKFKLASNFLKNSAFLKASNFLKASNFLKNSAF.<br>On: \"04:42:39 pm\" Added: bKAJNFJLSANFJKASNKFJNASJFNKJASNFJASNFKJSNA.<br>On: \"04:42:43 pm\" Added: bKAJNFJLSANFJKASNKFJNASJFNKJASNFJASNFKJSNA\r\n.<br>On: \"04:42:44 pm\" Added: bKAJNFJLSANFJKASNKFJNASJFNKJASNFJASNFKJS'),
(54, 'bKAJNFJLSANFJKASNKFJNASJFNKJASNFJASNFKJSNA'),
(55, 'bKAJNFJLSANFJKASNKFJNASJFNKJASNFJASNFKJSNA\r\n'),
(56, 'bKAJNFJLSANFJKASNKFJNASJFNKJASNFJASNFKJSNA'),
(57, 'bKAJNFJLSANFJKASNKFJNASJFNKJASNFJASNFKJSNA'),
(58, 'bKAJNFJLSANFJKASNKFJNASJFNKJASNFJASNFKJSNA'),
(59, ''),
(60, 'Yo you need to get some stuff done, ok?.<br>On: \"05:35:17 pm\" Added: Like something nice.<br>On: \"05:39:37 pm\"TEAM LEADER Added: YO WTF.<br>On: \"05:39:53 pm\" Team Leader Added: Like Cmon'),
(61, 'Like something nice'),
(62, 'YO BIH.<br>@: \"06:38:51 pm\" Added: WHADUP.<br>@: \"06:40:08 pm\"dave: LIKE YO.<br>@: \"06:40:21 pm\" dave: Yo.<br>@: \"12:09:00 pm\" Team Leader Added: BOI.<br>@: \"04:21:07 pm\" Team Leader Added: y.<br>@: \"04:32:27 pm\" Team Leader Added: ssss'),
(63, 'WHADUP'),
(64, 'LIKE YO'),
(65, 'Yo'),
(66, 'biggus dickus jan pawel piaty\r\n'),
(67, 'hdhthd.<br>@: \"01:39:09 pm\" Team Leader Added: grsgr'),
(68, 'chiki briki.<br>@: \"04:17:12 pm\" Nick: hdthdt'),
(69, 'hdthdt'),
(70, 'chuje muje dzikie weze\r\n.<br>@: \"04:19:41 pm\" Nick: chiki brki.<br>@: \"04:19:42 pm\" Nick: fsa.<br>@: \"04:19:44 pm\" Nick: fsa'),
(71, 'chiki brki'),
(72, 'fsa'),
(73, 'fsa'),
(74, 'chuje muje dzikie weze\r\n.<br>@: \"04:32:04 pm\" Bert: ass'),
(75, 'ass'),
(76, 'chiki briki.<br>@: \"04:52:27 pm\" Team Leader Added: dsadsaas');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE `status` (
  `StatusID` int(50) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `status`
--

INSERT INTO `status` (`StatusID`, `Description`) VALUES
(1, 'opened'),
(2, 'closed'),
(3, 'Pending for TL`s approval');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `type`
--

CREATE TABLE `type` (
  `TypeID` int(50) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `type`
--

INSERT INTO `type` (`TypeID`, `Description`) VALUES
(1, 'query'),
(2, 'wish'),
(3, 'crash'),
(4, 'functional_problem'),
(5, 'technical_problem');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`CompanyID`),
  ADD KEY `Company_fk0` (`LicenseID`);

--
-- Indeksy dla tabeli `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `Customer_fk0` (`CompanyID`);

--
-- Indeksy dla tabeli `frequency`
--
ALTER TABLE `frequency`
  ADD PRIMARY KEY (`FrequencyID`);

--
-- Indeksy dla tabeli `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`IncidentID`),
  ADD KEY `Incident_fk0` (`SolutionID`),
  ADD KEY `Incident_fk1` (`TypeID`),
  ADD KEY `Incident_fk2` (`OperatorID`),
  ADD KEY `Incident_fk3` (`StatusID`),
  ADD KEY `Incident_fk4` (`CustomerID`);

--
-- Indeksy dla tabeli `license`
--
ALTER TABLE `license`
  ADD PRIMARY KEY (`LicenseID`);

--
-- Indeksy dla tabeli `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`OperatorID`);

--
-- Indeksy dla tabeli `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`SolutionID`);

--
-- Indeksy dla tabeli `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indeksy dla tabeli `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`TypeID`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `company`
--
ALTER TABLE `company`
  MODIFY `CompanyID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `frequency`
--
ALTER TABLE `frequency`
  MODIFY `FrequencyID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `incident`
--
ALTER TABLE `incident`
  MODIFY `IncidentID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT dla tabeli `license`
--
ALTER TABLE `license`
  MODIFY `LicenseID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `operator`
--
ALTER TABLE `operator`
  MODIFY `OperatorID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `solution`
--
ALTER TABLE `solution`
  MODIFY `SolutionID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT dla tabeli `status`
--
ALTER TABLE `status`
  MODIFY `StatusID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `type`
--
ALTER TABLE `type`
  MODIFY `TypeID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `Company_fk0` FOREIGN KEY (`LicenseID`) REFERENCES `license` (`LicenseID`);

--
-- Ograniczenia dla tabeli `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `Customer_fk0` FOREIGN KEY (`CompanyID`) REFERENCES `company` (`CompanyID`);

--
-- Ograniczenia dla tabeli `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `Incident_fk0` FOREIGN KEY (`SolutionID`) REFERENCES `solution` (`SolutionID`),
  ADD CONSTRAINT `Incident_fk1` FOREIGN KEY (`TypeID`) REFERENCES `type` (`TypeID`),
  ADD CONSTRAINT `Incident_fk2` FOREIGN KEY (`OperatorID`) REFERENCES `operator` (`OperatorID`),
  ADD CONSTRAINT `Incident_fk3` FOREIGN KEY (`StatusID`) REFERENCES `status` (`StatusID`),
  ADD CONSTRAINT `Incident_fk4` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
