-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 08:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `founditdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `campusID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `pass`, `campusID`) VALUES
('ASCadmin', 'asinganCampus', 'CAMP1002'),
('UCadmin', 'urdanetaCampus', 'CAMP1001');

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `campusID` varchar(255) NOT NULL,
  `campusName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`campusID`, `campusName`) VALUES
('CAMP1001', 'Urdaneta Campus'),
('CAMP1002', 'Asingan Campus'),
('CAMP1003', 'Binmaley Campus'),
('CAMP1004', 'Alaminos Campus'),
('CAMP1005', 'Bayambang Campus'),
('CAMP1006', 'Infanta Campus'),
('CAMP1007', 'San Carlos Campus'),
('CAMP1008', 'Sta. Maria Campus'),
('CAMP1009', 'Lingayen Campus');

-- --------------------------------------------------------

--
-- Table structure for table `lostitems`
--

CREATE TABLE `lostitems` (
  `itemID` int(11) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `campusID` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `locationLost` varchar(255) NOT NULL,
  `dateFound` datetime NOT NULL,
  `contactInfo` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `claimed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lostitems`
--

INSERT INTO `lostitems` (`itemID`, `ItemName`, `campusID`, `description`, `locationLost`, `dateFound`, `contactInfo`, `image`, `claimed`) VALUES
(1, 'Mobile Phone', 'CAMP1001', 'Navy blue Iphone 12 Pro Max with privacy Screen', 'women\'s Restroom', '2024-03-27 15:39:48', '09391111111', '', 0),
(2, 'Wallet', 'CAMP1002', 'Black mini wallet. A lot of piso with a face of a man in a UPANG uniform', 'Study Shed', '2024-03-26 22:39:48', '01234567891', '', 1),
(4, 'Iphone 15 pro max', 'CAMP1002', 'sjd;wkjdw', 'Urdaneta Campus', '2024-04-06 03:42:00', '0356565', 'uploads/3.png', 0),
(5, 'Iphone 15 pro max', 'CAMP1001', 'ascas', 'Urdaneta Campus', '2024-04-12 03:50:00', '0356565', '../uploads/3.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `studentid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `campusID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `studentid`, `name`, `email`, `password`, `campusID`) VALUES
(1, '21-UR-0193', 'Dessa Gallito', 'dessa@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'CAMP1001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fkk` (`campusID`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`campusID`);

--
-- Indexes for table `lostitems`
--
ALTER TABLE `lostitems`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `fk_campID` (`campusID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fkd` (`campusID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lostitems`
--
ALTER TABLE `lostitems`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fkk` FOREIGN KEY (`campusID`) REFERENCES `campus` (`campusID`);

--
-- Constraints for table `lostitems`
--
ALTER TABLE `lostitems`
  ADD CONSTRAINT `fk_campID` FOREIGN KEY (`campusID`) REFERENCES `campus` (`campusID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fkd` FOREIGN KEY (`campusID`) REFERENCES `campus` (`campusID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
