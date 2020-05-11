-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2020 at 05:09 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dr_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `ID` int(11) NOT NULL,
  `Width` int(11) NOT NULL,
  `Height` int(11) NOT NULL,
  `ImagePath` text NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`ID`, `Width`, `Height`, `ImagePath`, `IsDeleted`) VALUES
(1, 224, 224, 'link', 0),
(2, 224, 224, 'link', 0),
(3, 224, 224, 'link', 0);

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `ID` int(11) NOT NULL,
  `PhysicalAddress` text NOT NULL,
  `FriendlyName` varchar(70) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`ID`, `PhysicalAddress`, `FriendlyName`, `IsDeleted`) VALUES
(1, 'http://localhost/DR_Project/Portals/AdminPortal/viewUsers.php', 'View Users', 0),
(2, 'http://localhost/DR_Project/Portals/DoctorPortal/viewPatients.php', 'View Patients', 0),
(3, 'http://localhost/DR_Project/Portals/PatientPortal/viewReports.php', 'View Reports', 0);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `ID` int(11) NOT NULL,
  `LinkID` int(11) NOT NULL,
  `UserTypeID` int(11) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`ID`, `LinkID`, `UserTypeID`, `IsDeleted`) VALUES
(1, 1, 3, 0),
(2, 2, 1, 0),
(3, 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `RightImageID` int(11) NOT NULL,
  `LeftImageID` int(11) NOT NULL,
  `RightEyeStageID` int(11) NOT NULL,
  `LeftEyeStageID` int(11) NOT NULL,
  `DoctorComment` text NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `ID` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `LevelName` varchar(40) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`ID`, `Level`, `LevelName`, `IsDeleted`) VALUES
(1, 0, 'No DR', 0),
(2, 1, 'Moderate', 0),
(3, 2, 'Severe', 0),
(4, 3, 'Proliferative', 0),
(5, 4, 'Non Proliferative', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `FullName` text NOT NULL,
  `DOB` date NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `UserTypeID` int(11) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `FullName`, `DOB`, `Email`, `Telephone`, `Username`, `Password`, `UserTypeID`, `IsDeleted`) VALUES
(1, 'Mahmoud Hazem', '2019-12-18', 'm@gmail.com', '0186479321', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 3, 0),
(2, 'Ahmed Alaa', '2020-01-11', 'a@gmail.com', '01064867259', 'patient', 'b1b0b8de8a6228f6501c0560365d3a7d74ffcd8e', 2, 0),
(3, 'Hossam Abdullah', '2020-01-11', 'o@gmail.com', '01064867951', 'doctor', '1f0160076c9f42a157f0a8f0dcc68e02ff69045b', 1, 0),
(4, 'Tamer Ali', '1970-01-01', 't@gmail.com', '01264897216', 'tamer', 'tamer', 2, 0),
(5, 'Omar Khaled', '1985-05-14', 't@gmail.com', '01264897216', 'omar', '4a6db2314c199446c0e2d3e48e30295622c96639', 2, 0),
(6, 'Ayman Mohamed', '1960-09-17', 'a@gmail.com', '01264897216', 'ayman', 'ayman', 2, 0),
(7, 'Mohamed Alaa', '1997-09-17', 'm@gmail.com', '01264897216', 'mohamed', 'mohamed', 2, 0),
(8, 'Youssef Talaat', '1998-01-07', 'y@gmail.com', '01264897216', 'youssef', 'youssef', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`ID`, `Name`, `IsDeleted`) VALUES
(1, 'Doctor', 0),
(2, 'Patient', 0),
(3, 'Admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LinkID` (`LinkID`),
  ADD KEY `UserTypeID` (`UserTypeID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DoctorID` (`DoctorID`),
  ADD KEY `ImageID` (`RightImageID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `StageID` (`LeftEyeStageID`),
  ADD KEY `LeftImageID` (`LeftImageID`),
  ADD KEY `RightEyeStageID` (`RightEyeStageID`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserTypeID` (`UserTypeID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`LinkID`) REFERENCES `link` (`ID`),
  ADD CONSTRAINT `permission_ibfk_2` FOREIGN KEY (`UserTypeID`) REFERENCES `usertype` (`ID`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`RightImageID`) REFERENCES `image` (`ID`),
  ADD CONSTRAINT `report_ibfk_3` FOREIGN KEY (`PatientID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `report_ibfk_4` FOREIGN KEY (`LeftEyeStageID`) REFERENCES `stage` (`ID`),
  ADD CONSTRAINT `report_ibfk_5` FOREIGN KEY (`LeftImageID`) REFERENCES `image` (`ID`),
  ADD CONSTRAINT `report_ibfk_6` FOREIGN KEY (`RightEyeStageID`) REFERENCES `stage` (`ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`UserTypeID`) REFERENCES `usertype` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
