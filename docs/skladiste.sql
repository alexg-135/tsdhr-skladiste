CREATE DATABASE `skladiste`;
USE `skladiste`;

CREATE TABLE `zakupac` (
  `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `Ime` char(35) NOT NULL,
  `Prezime` varchar(35) NOT NULL,
  `Telefon` varchar(20) NOT NULL,
  `Mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `zakupac` (`ID`, `Ime`, `Prezime`, `Telefon`, `Mail`) VALUES
(1, 'Pero', 'Perić', '+385991231234', 'pero.peric@gmail.com'),
(2, 'Ana', 'Perić', '+385991231234', 'ana.peric@gmail.com'),
(3, 'Tomislav', 'Tomić', '+123121231234', 'tomislav.tomic@gmail.com'),
(4, 'Random', 'Names', '+123121231234', 'user4@gmail.com'),
(5, 'Nikolas', 'Mann', '+123121231234', 'user5@gmail.com'),
(6, 'Sandra', 'Hunt', '+123121231234', 'user6@gmail.com'),
(7, 'Adam', 'Kelley', '+123121231234', 'user7@gmail.com'),
(8, 'Annika', 'Mcdonald', '+123121231234', 'user8@gmail.com'),
(9, 'Alexandre', 'Rogers', '+123121231234', 'user9@gmail.com'),
(10, 'Rebecca', 'Stone', '+123121231234', 'user10@gmail.com'),
(11, 'Matteo', 'Rosales', '+123121231234', 'user11@gmail.com'),
(12, 'Kacper', 'Perez', '+123121231234', 'user12@gmail.com'),
(13, 'Carla', 'Craig', '+123121231234', 'user13@gmail.com'),
(14, 'Gloria', 'Fry', '+123121231234', 'user14@gmail.com'),
(15, 'Cory', 'Harris', '+123121231234', 'user15@gmail.com'),
(16, 'Sally', 'Armstrong', '+123121231234', 'user16@gmail.com'),
(17, 'Jennie', 'Fulton', '+123121231234', 'user17@gmail.com'),
(18, 'Omari', 'Randall', '+123121231234', 'user18@gmail.com'),
(19, 'Justin', 'Morrow', '+123121231234', 'user19@gmail.com'),
(20, 'Karen', 'Harrington', '+123121231234', 'user20@gmail.com'),
(21, 'Benedict', 'Petty', '+123121231234', 'user21@gmail.com'),
(22, 'Denise', 'Mcpherson', '+123121231234', 'user22@gmail.com'),
(23, 'Farhan', 'Morrison', '+123121231234', 'user23@gmail.com'),
(24, 'Candice', 'Villegas', '+123121231234', 'user24@gmail.com'),
(25, 'Armaan', 'Beasley', '+123121231234', 'user25@gmail.com'),
(26, 'Dulcie', 'Arnold', '+123121231234', 'user26@gmail.com'),
(27, 'Isra', 'Murray', '+123121231234', 'user27@gmail.com'),
(28, 'Ciara', 'Hoover', '+123121231234', 'user28@gmail.com'),
(29, 'Peggy', 'Reese', '+123121231234', 'user29@gmail.com'),
(30, 'Carlos', 'Lucas', '+123121231234', 'user30@gmail.com');

CREATE TABLE `vrstarobe` (
  `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `Naziv` char(25) NOT NULL,
  `Napomena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `vrstarobe` (`ID`, `Naziv`, `Napomena`) VALUES
(1, 'Ostalo', '-'),
(2, 'Vrsta 1', '-'),
(3, 'Vrsta 2', '-'),
(4, 'Vrsta 3', '-'),
(5, 'Vrsta 4', '-'),
(6, 'Vrsta 5', '-'),
(7, 'Vrsta 6', '-'),
(8, 'Vrsta 7', '-'),
(9, 'Vrsta 8', '-'),
(10, 'Vrsta 9', '-');

CREATE TABLE `roba` (
  `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `Naziv` varchar(50) NOT NULL,
  `Istjece` datetime NOT NULL,
  `VrstaRobe_ID` int(11) NOT NULL,
  `Zakupac_ID` int(11) NOT NULL,

  FOREIGN KEY (`VrstaRobe_ID`) REFERENCES `vrstarobe`(`ID`),
  FOREIGN KEY (`Zakupac_ID`) REFERENCES `zakupac`(`ID`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `roba` (`ID`, `Naziv`, `Istjece`, `VrstaRobe_ID`, `Zakupac_ID`) VALUES
(1, 'Roba 1', '2022-01-01 00:00:00', 1, 1),
(2, 'Roba 2', '2022-01-01 00:00:00', 2, 2),
(3, 'Roba 3', '2022-01-01 00:00:00', 1, 3),
(4, 'Roba 4', '2022-01-01 00:00:00', 1, 4),
(5, 'Roba 5', '2022-01-01 00:00:00', 2, 5),
(6, 'Roba 6', '2022-01-01 00:00:00', 2, 6),
(7, 'Roba 7', '2022-01-01 00:00:00', 2, 7),
(8, 'Roba 8', '2022-01-01 00:00:00', 3, 8),
(9, 'Roba 9', '2022-01-01 00:00:00', 3, 9),
(10, 'Roba 10', '2022-01-01 00:00:00', 1, 10),
(11, 'Roba 11', '2022-01-01 00:00:00', 3, 11),
(12, 'Roba 12', '2022-01-01 00:00:00', 3, 12),
(13, 'Roba 13', '2022-01-01 00:00:00', 1, 13),
(14, 'Roba 14', '2022-01-01 00:00:00', 4, 14),
(15, 'Roba 15', '2022-01-01 00:00:00', 3, 15),
(16, 'Roba 16', '2022-01-01 00:00:00', 1, 16),
(17, 'Roba 17', '2022-01-01 00:00:00', 2, 17),
(18, 'Roba 18', '2022-01-01 00:00:00', 4, 18),
(19, 'Roba 19', '2022-01-01 00:00:00', 1, 19),
(20, 'Roba 20', '2022-01-01 00:00:00', 2, 20);

CREATE TABLE `polica` (
  `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `Broj` int(11) NOT NULL,
  `Roba_ID` int(11) NULL,
  `Napomena` varchar(100) DEFAULT NULL,
  FOREIGN KEY (`Roba_ID`) REFERENCES `roba`(`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `polica` (`ID`, `Broj`, `Roba_ID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2),
(5, 5, 3),
(6, 6, 3),
(7, 7, NULL),
(8, 8, NULL),
(9, 9, 5),
(10, 10, 5),
(11, 11, 6),
(12, 12, NULL),
(13, 13, 7),
(14, 14, 7),
(15, 15, 8),
(16, 16, NULL),
(17, 17, 9),
(18, 18, 9),
(19, 19, 10),
(20, 20, 10),
(21, 21, 11),
(22, 22, 11),
(23, 23, 12),
(24, 24, 12),
(25, 25, 13),
(26, 26, 13),
(27, 27, 14),
(28, 28, 15),
(29, 29, 16),
(30, 30, 17),
(31, 31, 18),
(32, 32, 19),
(33, 33, 20);

