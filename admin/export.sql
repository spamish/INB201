--
-- MySQL 5.6.12
-- Wed, 16 Apr 2014 06:08:31 +0000
--

CREATE DATABASE `inb201project` DEFAULT CHARSET latin1;

USE `inb201project`;

CREATE TABLE `employeeinfo` (
   `id` int(9) not null auto_increment,
   `username` char(9) not null,
   `firstName` varchar(128) not null,
   `surname` varchar(128) not null,
   `dateOfBirth` varchar(10) not null,
   `phoneNumber` char(10),
   `payGrade` enum('A','B','C','D','E') not null,
   `position` enum('inactive','doctor','nurse','receptionist','technician','administrator'),
   `ward` enum('A','B','C','D','E','F'),
   `hash` char(128) not null,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

INSERT INTO `employeeinfo` (`id`, `username`, `firstName`, `surname`, `dateOfBirth`, `phoneNumber`, `payGrade`, `position`, `ward`, `hash`) VALUES 
('1', 'a08426992', 'Samuel', 'Janetzki', '28/11/1992', '0402370465', 'C', 'administrator', 'F', '$2y$10$D.SgKani5EB9btd.KlDnmuyHCSxSjcieoLoCt0ae1n36CIN.zv0oS');