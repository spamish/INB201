-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2014 at 11:31 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inb201project`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `addressID` int(24) NOT NULL AUTO_INCREMENT,
  `unit` int(6) DEFAULT NULL,
  `house` int(6) DEFAULT NULL,
  `street` varchar(128) DEFAULT NULL,
  `suburb` varchar(128) DEFAULT NULL,
  `postcode` int(6) DEFAULT NULL,
  `region` varchar(128) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`addressID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`addressID`, `unit`, `house`, `street`, `suburb`, `postcode`, `region`, `country`) VALUES
(1, 2, 26, 'Latrobe Street', 'East Brisbane', 4169, 'Queensland', 'Australia'),
(2, NULL, 43, 'Banks Street', 'Newmarket', 4059, 'Queensland', 'Australia');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
  `equipmentID` int(12) NOT NULL AUTO_INCREMENT,
  `roomNumber` int(6) NOT NULL,
  `code` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `duration` time NOT NULL,
  `cost` double NOT NULL DEFAULT '0',
  `technicians` text NOT NULL,
  PRIMARY KEY (`equipmentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipmentID`, `roomNumber`, `code`, `description`, `duration`, `cost`, `technicians`) VALUES
(1, 101, 'XR', 'X-ray scan.', '00:20:00', 17, 'a:8:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";i:6;s:1:"7";i:7;s:1:"8";}'),
(2, 204, 'CT', 'X-ray computed topography.', '00:40:00', 22.5, 'a:1:{i:0;s:1:"5";}'),
(3, 308, 'MRI', 'Magnetic resonance imaging.', '01:20:00', 0, 'a:1:{i:0;s:2:"14";}'),
(4, 408, 'US', 'Ultrasound.', '00:30:00', 10, 'a:2:{i:0;s:1:"5";i:1;s:2:"14";}');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `fileID` int(24) NOT NULL AUTO_INCREMENT,
  `patient` int(12) DEFAULT NULL,
  `admission` datetime NOT NULL,
  `discharge` datetime DEFAULT NULL,
  `state` double NOT NULL,
  `doctor` int(12) DEFAULT NULL,
  `room` int(12) DEFAULT NULL,
  `bedNumber` int(6) DEFAULT NULL,
  `balance` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`fileID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`fileID`, `patient`, `admission`, `discharge`, `state`, `doctor`, `room`, `bedNumber`, `balance`) VALUES
(1, NULL, '2014-05-21 15:26:38', '2014-06-05 20:02:06', 0.5, NULL, NULL, NULL, 11.25),
(2, 1, '2014-05-23 11:01:16', '2014-06-05 20:09:36', 0.7, 16, 4, NULL, 0),
(3, NULL, '2014-05-23 11:03:10', NULL, 0.5, NULL, NULL, NULL, 0),
(4, NULL, '2014-05-23 11:05:50', NULL, 0.9, 1, NULL, NULL, 0),
(5, 1, '2014-05-24 07:47:02', '2014-05-27 16:15:19', 0.9, NULL, NULL, NULL, 0),
(6, 1, '2014-06-05 15:03:37', NULL, 0.5, NULL, NULL, NULL, 0),
(7, 4, '2014-06-05 22:06:23', NULL, 0, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE IF NOT EXISTS `guardians` (
  `guardianID` int(24) NOT NULL,
  `firstName` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `mobilePhone` char(10) NOT NULL,
  `homePhone` char(10) NOT NULL,
  `address` int(24) NOT NULL,
  PRIMARY KEY (`guardianID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`guardianID`, `firstName`, `surname`, `gender`, `mobilePhone`, `homePhone`, `address`) VALUES
(1, 'Leanne', 'Pollock', 'f', '0421798606', '0755324265', 1),
(2, 'Darcy', 'Collins', 'm', '0421798606', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE IF NOT EXISTS `insurance` (
  `insuranceID` int(4) NOT NULL AUTO_INCREMENT,
  `policy` varchar(128) NOT NULL,
  `provider` varchar(128) NOT NULL,
  `percent` double DEFAULT NULL,
  `maximum` int(12) DEFAULT NULL,
  PRIMARY KEY (`insuranceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`insuranceID`, `policy`, `provider`, `percent`, `maximum`) VALUES
(1, 'Basic Care', 'Medibank', 10, NULL),
(2, 'Basic Care', 'AHM', NULL, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `noteID` int(48) NOT NULL,
  `file` int(24) NOT NULL,
  `type` varchar(128) NOT NULL,
  `staff` int(12) NOT NULL,
  `timestamp` datetime NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`noteID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`noteID`, `file`, `type`, `staff`, `timestamp`, `details`) VALUES
(0, 6, 'admission', 2, '2014-05-27 02:38:06', 'Admitted with mild concussion.'),
(1, 1, 'admission', 1, '2014-05-21 15:26:38', 'Was found screaming out random words, suspected tourettes.'),
(2, 2, 'admission', 1, '2014-05-23 11:01:16', 'Was found unconscious with no signs of response, all vital signs show no irregularities but cause of state is unknown.'),
(3, 3, 'admission', 1, '2014-05-23 11:03:10', 'Eye jabbed out with a fucking pen.'),
(4, 4, 'admission', 1, '2014-05-23 11:05:50', 'Head is detached from the body, somehow still living and talking.'),
(5, 5, 'admission', 1, '2014-05-24 07:47:02', 'Broken, cause unknown.'),
(6, 4, 'transfer', 2, '2014-05-26 02:13:09', 'Patient assigned to Georgia Dean'),
(7, 5, 'transfer', 2, '2014-05-27 02:38:06', 'Patient assigned to Georgia Dean'),
(8, 5, 'discharge', 2, '2014-05-27 16:15:19', 'Dead. Deceased. No longer of this world.'),
(9, 3, 'note', 2, '2014-05-27 17:52:15', 'Gone completely batshit insane.'),
(10, 0, 'transfer', 2, '2014-05-29 17:51:48', 'Patient transferred to room b204.'),
(11, 0, 'transfer', 2, '2014-05-29 17:53:05', 'Patient transferred to room b101.'),
(12, 1, 'transfer', 2, '2014-05-29 17:56:35', 'Patient transferred to room b101.'),
(13, 1, 'transfer', 2, '2014-05-29 17:58:02', 'Patient transferred to room c101 and assigned to doctor Chris Larter.'),
(14, 1, 'transfer', 2, '2014-05-29 18:00:16', 'Patient assigned to doctor Gabriel Grassi.'),
(15, 4, 'transfer', 2, '2014-05-30 10:15:35', 'Patient assigned to Alex Mansour'),
(16, 3, 'transfer', 2, '2014-05-30 10:15:49', 'Patient assigned to Alex Mansour'),
(17, 1, 'order', 2, '2014-06-01 12:46:04', 'Patient prescribed 20MSO4'),
(18, 1, 'order', 2, '2014-06-01 13:35:12', 'Patient prescribed 20MSO4'),
(19, 1, 'test', 2, '2014-06-01 15:17:35', 'CT booked at 03:27pm on 1st Jun 2014.'),
(20, 3, 'test', 2, '2014-06-01 16:38:04', 'XR booked at 05:00pm on 1st Jun 2014.'),
(21, 3, 'test', 2, '2014-06-01 16:38:19', 'MRI booked at 05:20pm on 1st Jun 2014.'),
(22, 3, 'test', 2, '2014-06-01 16:39:08', 'CT booked at 07:20pm on 1st Jun 2014.'),
(23, 4, 'test', 2, '2014-06-01 18:03:18', 'US booked at 06:03pm on 1st Jun 2014.'),
(24, 2, 'test', 2, '2014-06-01 18:04:11', 'MRI booked at 08:00pm on 1st Jun 2014.'),
(25, 3, 'test', 2, '2014-06-01 18:21:53', 'US booked at 10:00pm on 1st Jun 2014.'),
(26, 1, 'operation', 2, '2014-06-02 00:11:08', 'Appendectomy booked at 12:11am on 2nd Jun 2014 in g101.'),
(27, 2, 'operation', 2, '2014-06-02 00:14:04', 'Appendectomy booked at 02:26am on 2nd Jun 2014 in g204.'),
(28, 1, 'observation', 4, '2014-06-02 01:51:03', 'Patient has developed a mild fever.'),
(29, 1, 'observation', 4, '2014-06-02 01:52:32', 'Patient is now on the floor. No one has helped her up.'),
(30, 1, 'results', 8, '2014-06-02 12:10:28', 'Patient is prescribed tequila sunrises.<br>Results have been uploaded to <a href="http://107.170.200.157/inb201/results/30.jpg">Results</a> at 2nd Jun 2014 on 12:10pm'),
(31, 2, 'transfer', 2, '2014-06-02 12:29:47', 'Patient transferred to room b101 and assigned to doctor Alex Mansour.'),
(32, 1, 'transfer', 2, '2014-06-02 12:30:44', 'Patient transferred to room c204 and assigned to doctor Chris Larter.'),
(33, 2, 'post-op', 6, '2014-06-02 13:57:43', 'Patients appendix went off like a grenade just before we took it out. Was somewhat messy, but we rebuilt him. Stronger, better, faster.'),
(34, 1, 'post-op', 6, '2014-06-02 13:58:14', 'Patients appendix went off like a grenade just before we took it out. Was somewhat messy, but we rebuilt him. Stronger, better, faster.'),
(35, 5, 'payment', 4, '2014-06-03 00:37:35', 'Portion of file balance paid off.'),
(36, 5, 'payment', 4, '2014-06-03 00:41:05', 'File balance paid off.'),
(37, 0, 'transfer', 1, '2014-06-03 09:08:00', 'Patient assigned to Georgia Dean'),
(38, 0, 'transfer', 1, '2014-06-03 09:08:47', 'Patient assigned to Georgia Dean'),
(39, 0, 'transfer', 1, '2014-06-03 09:13:47', 'Patient assigned to Georgia Dean'),
(40, 0, 'transfer', 1, '2014-06-03 09:14:07', 'Patient assigned to Georgia Dean'),
(41, 1, 'payment', 7, '2014-06-03 09:30:41', 'File balance paid off.'),
(42, 0, 'transfer', 1, '2014-06-03 09:31:16', 'Patient assigned to Georgia Dean'),
(43, 0, 'transfer', 1, '2014-06-03 09:33:50', 'Patient assigned to Georgia Dean'),
(44, 0, 'transfer', 1, '2014-06-03 09:33:55', 'Patient assigned to Georgia Dean'),
(45, 1, 'test', 1, '2014-06-03 09:34:06', 'CT booked at 09:34am on 3rd Jun 2014 in e204.'),
(46, 1, 'order', 1, '2014-06-03 09:34:18', 'Patient prescribed 20MSO4'),
(47, 3, 'operation', 1, '2014-06-03 09:37:19', 'Appendectomy booked at 09:37am on 3rd Jun 2014 in g204.'),
(48, 0, 'transfer', 1, '2014-06-03 16:22:03', 'Patient assigned to Georgia Dean'),
(51, 1, 'discharge', 1, '2014-06-05 20:01:23', 'Blah blah blah.'),
(52, 1, 'discharge', 1, '2014-06-05 20:01:46', 'Blah blah blah.'),
(53, 1, 'discharge', 1, '2014-06-05 20:01:50', 'Blah blah blah.'),
(54, 1, 'discharge', 1, '2014-06-05 20:02:06', 'Blah blah blah.'),
(55, 2, 'discharge', 1, '2014-06-05 20:09:36', 'Bahahahahaha.'),
(56, 2, 'transfer', 1, '2014-06-05 20:16:32', 'Patient transferred to room b204 and assigned to doctor Eman John.'),
(57, 4, 'transfer', 1, '2014-06-05 21:44:21', 'Patient assigned to Georgia Dean');

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE IF NOT EXISTS `operations` (
  `operationID` int(48) NOT NULL AUTO_INCREMENT,
  `file` int(24) NOT NULL,
  `theater` int(12) NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime NOT NULL,
  `procedure` int(12) NOT NULL,
  `surgeons` text NOT NULL,
  PRIMARY KEY (`operationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`operationID`, `file`, `theater`, `start`, `finish`, `procedure`, `surgeons`) VALUES
(1, 1, 1, '2014-06-02 15:11:08', '2014-06-02 17:26:08', 1, 'a:2:{i:0;s:1:"7";i:1;s:1:"5";}'),
(2, 6, 2, '2014-06-02 14:26:08', '2014-06-02 15:41:08', 1, 'a:2:{i:0;s:1:"6";i:1;s:1:"9";}'),
(3, 3, 2, '2014-06-03 09:37:19', '2014-06-03 11:52:19', 1, 'a:2:{i:0;s:2:"12";i:1;s:2:"11";}');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `patientID` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `dateOfBirth` date NOT NULL,
  `mobilePhone` char(10) DEFAULT NULL,
  `homePhone` char(10) DEFAULT NULL,
  `address` int(24) DEFAULT NULL,
  `insurance` int(12) DEFAULT NULL,
  `guardian` int(12) DEFAULT NULL,
  PRIMARY KEY (`patientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patientID`, `firstName`, `surname`, `gender`, `dateOfBirth`, `mobilePhone`, `homePhone`, `address`, `insurance`, `guardian`) VALUES
(1, 'Joel', 'Beaumont', 'm', '1994-08-24', '0402370465', '0755324265', 1, 1, 2),
(2, 'Samuel', 'Janetzki', 'm', '1992-11-28', '0402370465', NULL, 1, 2, 2),
(3, 'Darcy', 'Collins', 'f', '1994-08-24', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE IF NOT EXISTS `prescriptions` (
  `prescriptionID` int(24) NOT NULL AUTO_INCREMENT,
  `code` varchar(128) NOT NULL,
  `cost` float NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  PRIMARY KEY (`prescriptionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prescriptionID`, `code`, `cost`, `description`) VALUES
(1, '20MSO4', 11.25, '20cc of Morphine Sulphate.');

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE IF NOT EXISTS `procedures` (
  `procedureID` int(12) NOT NULL AUTO_INCREMENT,
  `code` varchar(128) NOT NULL,
  `description` text,
  `duration` time NOT NULL,
  `surgeons` text NOT NULL,
  `required` int(3) NOT NULL,
  `cost` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`procedureID`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `procedures`
--

INSERT INTO `procedures` (`procedureID`, `code`, `description`, `duration`, `surgeons`, `required`, `cost`) VALUES
(1, 'Appendectomy', 'Removal of the appendix irish abortion style.', '01:35:00', 'a:5:{i:0;s:1:"7";i:1;s:1:"9";i:2;s:2:"10";i:3;s:2:"11";i:4;s:2:"12";}', 2, 86),
(2, 'HipRep', 'Replacement of hip joint.', '02:43:00', 'a:5:{i:0;s:1:"7";i:1;s:1:"9";i:2;s:2:"10";i:3;s:2:"11";i:4;s:2:"12";}', 0, 127),
(3, 'GenStch', 'General stitching of small cuts and wounds that are too sever to complete without anesthetic.', '00:10:00', 'a:5:{i:0;s:1:"7";i:1;s:1:"9";i:2;s:2:"10";i:3;s:2:"11";i:4;s:2:"12";}', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `roomID` int(12) NOT NULL,
  `roomNumber` int(6) NOT NULL,
  `ward` enum('B','C','D') NOT NULL,
  `capacity` int(3) NOT NULL DEFAULT '0',
  `occupied` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`roomID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomID`, `roomNumber`, `ward`, `capacity`, `occupied`) VALUES
(1, 101, 'B', 3, 1),
(2, 101, 'C', 6, 0),
(4, 204, 'B', 8, 1),
(5, 204, 'C', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rosters`
--

CREATE TABLE IF NOT EXISTS `rosters` (
  `rosterID` int(12) NOT NULL AUTO_INCREMENT,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  PRIMARY KEY (`rosterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rosters`
--

INSERT INTO `rosters` (`rosterID`, `start`, `finish`) VALUES
(1, '09:00:00', '17:00:00'),
(2, '00:00:00', '08:00:00'),
(3, '15:30:00', '20:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE IF NOT EXISTS `salaries` (
  `salaryID` int(12) NOT NULL AUTO_INCREMENT,
  `payRate` double NOT NULL,
  `nextDate` date DEFAULT NULL,
  PRIMARY KEY (`salaryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`salaryID`, `payRate`, `nextDate`) VALUES
(1, 17.5, '2014-06-02'),
(2, 21.85, '2014-06-02'),
(3, 20, '2014-06-06'),
(4, 20, '2014-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `staffID` int(12) NOT NULL AUTO_INCREMENT,
  `username` int(12) NOT NULL,
  `firstName` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `dateOfBirth` date NOT NULL,
  `mobilePhone` char(10) DEFAULT NULL,
  `homePhone` char(10) DEFAULT NULL,
  `address` int(24) NOT NULL,
  `roster` int(12) NOT NULL,
  `salary` int(12) NOT NULL,
  `position` enum('inactive','doctor','surgeon','nurse','receptionist','technician','administrator') NOT NULL,
  `ward` enum('A','B','C','D','E','F','G') NOT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `hash` char(128) NOT NULL,
  PRIMARY KEY (`staffID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `username`, `firstName`, `surname`, `gender`, `dateOfBirth`, `mobilePhone`, `homePhone`, `address`, `roster`, `salary`, `position`, `ward`, `lastLogin`, `hash`) VALUES
(1, 1, 'Georgia', 'Dean', 'f', '1980-11-14', '0422138221', '', 1, 1, 3, 'doctor', 'A', '2014-06-05 22:32:38', '$2y$10$Yz14hRK/aZ/RpY5t1PKzDOaEbaLy/572GcWc3plQbvoyyXaP7xPXu'),
(2, 2, 'Alex', 'Mansour', 'm', '1977-06-13', '0495444587', '', 1, 1, 3, 'nurse', 'A', '2014-06-05 22:03:00', '$2y$10$KpBy9IH/X.TvjmtAjs.8c.xukBKxT/Hj3GS9hYZsfxO4w1ZvosfeS'),
(3, 3, 'Chris', 'Larter', 'm', '1985-10-07', '0478638364', '', 1, 1, 3, 'receptionist', 'A', '2014-06-05 22:34:37', '$2y$10$adAP93u.kq/oF6WwFVgcduiPdhr3fIE5leYmj9o.JWPISqwU76eoi'),
(4, 4, 'Gabriel', 'Grassi', 'm', '1981-03-12', '0440201071', '', 1, 1, 3, 'technician', 'E', '2014-06-05 22:45:04', '$2y$10$BxcFplNZ7jl8LSRpRsfaz.u6u8iUnnNx4Hz3teHl0Kd5afpBwSt/m'),
(5, 5, 'Jade', 'Paidel', 'f', '1976-12-08', '0445004083', '', 1, 1, 3, 'surgeon', 'G', '2014-06-05 23:20:20', '$2y$10$yzlaGNTbIinoawCoLaPeLuKGGqvy27u0qqGrOyk/XhznPwxRCAnIW'),
(6, 6, 'Monique', 'Atarniw', 'f', '1975-11-27', '0441220233', '', 1, 1, 3, 'administrator', 'F', '2014-06-05 23:26:39', '$2y$10$h7WPyUy55eMtwveEc/HqIeyxsTH7UKoX8zsbHBKlUOPnpY6TOQRQG'),
(7, 8, 'Shon', 'Tapper', 'f', '1969-09-20', '0476471787', '', 1, 1, 3, 'receptionist', 'A', '2014-06-05 16:04:21', '$2y$10$g1tcRnKbEGAcTCYbgAZLKeBe2XpbFSFLaACzO2aTtQWkChnT6YU1e'),
(8, 7, 'Dario', 'Rona', 'm', '1984-10-23', '0481701002', '', 1, 1, 3, 'surgeon', 'G', '2014-06-05 17:05:17', '$2y$10$.BHO5PLu2lXPs6/fo16DDeVlqVBPj2AOpazavRQ5QBSecH24yxZeq'),
(9, 9, 'Lakita', 'Oakes', 'f', '1988-09-01', '0440501598', '', 1, 1, 3, 'surgeon', 'G', '2014-06-02 12:55:58', '$2y$10$CvaD9f2Ij1vLlPb1hHTST.sJTjkiZbvkLdb79ehCyEMetU7xdaaDK'),
(10, 10, 'Muriel', 'Natal', 'f', '1977-01-28', '0421302725', '', 1, 1, 3, 'surgeon', 'G', '2014-06-02 19:04:33', '$2y$10$R/LfPP7jzLyjNuAHhEyrRefWfiEi1FtIHx9QDF7q3eFdwHwOtXnvm'),
(11, 11, 'Kendall', 'Harrison', 'm', '1970-11-04', '0441211269', '', 1, 1, 3, 'surgeon', 'G', '2014-06-02 20:21:49', '$2y$10$0AsZYqed4/fiHTC.ZVM5u.atUxLQ4UefHTGl8.NipEzE2y60tC.MK'),
(12, 12, 'Laura', 'Brown', 'f', '1975-01-10', '0457065027', '', 1, 1, 3, 'surgeon', 'G', '2014-05-28 21:50:28', '$2y$10$6n9Ry.iJ6MvkWEbTZMXPkOKYuQhjb42JeDTZrYOTKuBXpyUr4BLMe'),
(13, 13, 'Gary', 'Fan', 'm', '1994-07-07', '0426887080', '', 0, 3, 4, 'doctor', 'A', '2014-05-30 09:13:21', '$2y$10$/pY0kLLIOYaOoGdwMkdfIeg78y0ZUkACgnGI/XO/lxoT6eUSTrXOG'),
(14, 14, 'Joseph', 'Wagmann', 'm', '1989-11-25', '0472822176', '', 0, 1, 3, 'technician', 'E', NULL, '$2y$10$slaSGzS6mA81Ls3udZXLJuFrQ7qKPepTG8Vi1Hcuw6xQiFIvzEqPC'),
(15, 15, 'Samuel', 'Janetzki', 'm', '1992-11-28', '0402370465', '', 1, 1, 3, 'doctor', 'A', NULL, '$2y$10$eZfhgM4jlG7VWkIDwz7oCuI5IxmU38CVjHfWqkKw2Csnrd9exSt2y'),
(16, 16, 'Eman', 'John', 'm', '1979-07-14', '0401527175', '0732357642', 1, 1, 3, 'doctor', 'B', NULL, '$2y$10$pbEOyq0Vp0CfAUZsJfH4wOyQuz30bU/Jji1hgp0M2VLmuEkg6bSM.');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `testID` int(48) NOT NULL AUTO_INCREMENT,
  `file` int(24) NOT NULL,
  `equipment` int(12) NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime NOT NULL,
  `technician` int(12) NOT NULL,
  PRIMARY KEY (`testID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`testID`, `file`, `equipment`, `start`, `finish`, `technician`) VALUES
(1, 1, 2, '2014-06-02 15:27:35', '2014-06-02 17:00:00', 8),
(2, 3, 1, '2014-06-02 17:00:00', '2014-06-02 17:20:00', 8),
(3, 3, 3, '2014-06-02 17:20:00', '2014-06-02 19:20:00', 8),
(4, 3, 2, '2014-06-01 19:20:00', '2014-06-01 20:00:00', 8),
(5, 4, 4, '2014-06-01 18:03:18', '2014-06-01 18:33:18', 9),
(6, 6, 3, '2014-06-05 20:00:00', '2014-06-05 22:00:00', 10),
(7, 6, 4, '2014-06-06 10:00:00', '2014-06-06 11:30:00', 9),
(8, 6, 2, '2014-06-06 14:34:06', '2014-06-06 16:14:06', 5);

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE IF NOT EXISTS `theaters` (
  `theaterID` int(12) NOT NULL,
  `roomNumber` int(6) NOT NULL,
  PRIMARY KEY (`theaterID`),
  UNIQUE KEY `roomNumber` (`roomNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`theaterID`, `roomNumber`) VALUES
(1, 101),
(2, 204);

-- --------------------------------------------------------

--
-- Table structure for table `unidentified`
--

CREATE TABLE IF NOT EXISTS `unidentified` (
  `file` int(24) NOT NULL,
  `firstName` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  UNIQUE KEY `file` (`file`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unidentified`
--

INSERT INTO `unidentified` (`file`, `firstName`, `surname`, `gender`) VALUES
(0, '', '', ''),
(1, 'Rachael.5', 'Grange', 'f'),
(3, 'Peter.1', 'Baelish', 'm'),
(4, 'Echo', '2305', 'm');

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE IF NOT EXISTS `wards` (
  `wardID` enum('A','B','C','D','E','F','G') NOT NULL,
  `wardInfo` text NOT NULL,
  UNIQUE KEY `wardID` (`wardID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`wardID`, `wardInfo`) VALUES
('A', 'Admissions: Covers Emergency entrance, Walk-In entrance and Paramedics entrance. Staffed by a several key doctors and nurses as well as all receptionists.'),
('B', 'Basic Care Unit I: Covers general admissions and non critical patients. Staffed by doctors and nurses.'),
('C', 'Intensive Care Unit: Covers critical patients. Staffed by highly trained doctors and nurses.'),
('D', 'Basic Care Unit II: Covers post-op patients and maternity ward. Staffed by doctors and nurses.'),
('E', 'Medical Equipment: Covers all medical testing equipment such as X-rays and MRI''s. Staffed by medical technicians.'),
('F', 'Administrative Faculties: Covers all hospital and staff management. Staffed by system administrators.'),
('G', 'General Surgery: Covers all operating theaters. Staffed by surgeons.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
