-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 06:13 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insurance`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pay_policy` (IN `pol` INT)   BEGIN
select * from policydata PD,premium P where P.policyNo=PD.policyNo and PD.policyNo=pol;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agentID` varchar(10) NOT NULL,
  `passwd` varchar(150) NOT NULL,
  `agentName` varchar(150) NOT NULL,
  `DOB` date NOT NULL,
  `Address` varchar(80) NOT NULL,
  `Branch` varchar(50) NOT NULL,
  `contactNum` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agentID`, `passwd`, `agentName`, `DOB`, `Address`, `Branch`, `contactNum`) VALUES
('123abc122', '12356', 'Saahil kumar', '1992-06-24', '3/21,lalith nagar,Delhi', 'North delhi', 7645687856),
('123abc123', '12345678', 'Pavan Rathore', '1994-06-14', '7/51,baker street,chennai', 'Chennai', 9822344321);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` bigint(10) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Middle_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Gender` char(1) NOT NULL,
  `DOB` date NOT NULL,
  `Address` varchar(70) NOT NULL,
  `contactNumber` bigint(10) NOT NULL,
  `Mother_Name` varchar(150) NOT NULL,
  `Mother_Status` varchar(10) NOT NULL,
  `Father_Name` varchar(150) NOT NULL,
  `Father_Status` varchar(10) NOT NULL,
  `Marital_status` char(1) NOT NULL,
  `Spouse` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `DOB`, `Address`, `contactNumber`, `Mother_Name`, `Mother_Status`, `Father_Name`, `Father_Status`, `Marital_status`, `Spouse`) VALUES
(10005, 'Aditya', 'G', 'Kulkarni', 'M', '2004-05-31', '371, car street, Chennai', 9967890456, 'Amrita', 'A', 'Gopinath Kulkarni', 'A', 'S', ''),
(10007, 'Chandana', '', 'T', 'F', '2002-01-16', '100, Triveni Apartments, Pitam Pura, New Delhi', 9987364535, 'Kumuda', 'A', 'Ananth', 'A', 'S', '');

-- --------------------------------------------------------

--
-- Table structure for table `nominee`
--

CREATE TABLE `nominee` (
  `nomineeID` int(11) NOT NULL,
  `customerID` bigint(10) NOT NULL,
  `Fname` varchar(150) NOT NULL,
  `Mname` varchar(150) DEFAULT NULL,
  `Lname` varchar(150) NOT NULL,
  `Relation` varchar(20) NOT NULL,
  `Gender` char(1) NOT NULL,
  `DOB` date NOT NULL,
  `ContactNo` bigint(10) NOT NULL,
  `Address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nominee`
--

INSERT INTO `nominee` (`nomineeID`, `customerID`, `Fname`, `Mname`, `Lname`, `Relation`, `Gender`, `DOB`, `ContactNo`, `Address`) VALUES
(5, 10007, 'Chandrashekhar', '', 'T', 'Brother', 'M', '1999-10-12', 9872144863, '100, Triveni Apartments, Pitam Pura, New Delhi'),
(7, 10005, 'Subhash', '', 'Kulkarni', 'Uncle', 'M', '1990-05-02', 8721474836, '31, baker street, Chennai');

-- --------------------------------------------------------

--
-- Table structure for table `policydata`
--

CREATE TABLE `policydata` (
  `policyNo` int(15) NOT NULL,
  `customerID` bigint(10) NOT NULL,
  `agentID` varchar(10) NOT NULL,
  `schemeID` int(20) NOT NULL,
  `DOC` date DEFAULT NULL,
  `Sum_Assured` int(10) NOT NULL,
  `Pay_Period` int(2) NOT NULL,
  `Ins_Period` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `policydata`
--

INSERT INTO `policydata` (`policyNo`, `customerID`, `agentID`, `schemeID`, `DOC`, `Sum_Assured`, `Pay_Period`, `Ins_Period`) VALUES
(123456789, 10005, '123abc122', 10000, '2023-01-16', 250000, 25, 30),
(234567890, 10005, '123abc123', 10001, '2023-01-16', 300000, 35, 40),
(234567987, 10007, '123abc122', 10001, '2023-01-16', 250000, 35, 40),
(254678907, 10007, '123abc123', 10000, '2023-01-16', 100000, 15, 20),
(567899998, 10005, '123abc122', 10000, '2023-01-16', 150000, 20, 25);

--
-- Triggers `policydata`
--
DELIMITER $$
CREATE TRIGGER `add_DOC_date` BEFORE INSERT ON `policydata` FOR EACH ROW BEGIN
SET new.DOC = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `premium`
--

CREATE TABLE `premium` (
  `policyNo` int(15) NOT NULL,
  `Premium` int(10) NOT NULL,
  `Mode` varchar(3) NOT NULL,
  `Last_date` date NOT NULL,
  `ReceiptNo` int(20) NOT NULL,
  `ReceiptDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `premium`
--

INSERT INTO `premium` (`policyNo`, `Premium`, `Mode`, `Last_date`, `ReceiptNo`, `ReceiptDate`) VALUES
(123456789, 8333, 'YLY', '2024-01-16', 0, '2023-01-21'),
(123456789, 8333, 'YLY', '2024-01-16', 1673820740, '2023-01-21'),
(123456789, 8333, 'YLY', '2024-01-16', 1673821489, '2023-01-21'),
(234567890, 7500, 'YLY', '2024-01-16', 0, '2023-01-21'),
(234567890, 7500, 'YLY', '2024-01-16', 1673877356, '2023-01-21'),
(234567987, 6250, 'YLY', '2024-01-16', 0, '2023-01-21'),
(254678907, 5000, 'YLY', '2024-01-16', 0, '2023-01-21'),
(254678907, 5000, 'YLY', '2024-01-16', 1673877404, '2023-01-21'),
(567899998, 6000, 'YLY', '2024-01-16', 0, '2023-01-21');

--
-- Triggers `premium`
--
DELIMITER $$
CREATE TRIGGER `add_receipt_date` BEFORE UPDATE ON `premium` FOR EACH ROW BEGIN
SET new.ReceiptDate = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `scheme`
--

CREATE TABLE `scheme` (
  `schemeID` int(20) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `MaxAge` int(3) NOT NULL,
  `MinAmount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scheme`
--

INSERT INTO `scheme` (`schemeID`, `Name`, `MaxAge`, `MinAmount`) VALUES
(10000, 'Jeevan Umang', 90, 100000),
(10001, 'Bima Jyoti', 85, 200000),
(10002, 'Dhan Rekha', 90, 150000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agentID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `nominee`
--
ALTER TABLE `nominee`
  ADD PRIMARY KEY (`nomineeID`),
  ADD KEY `nominee_ibfk_1` (`customerID`);

--
-- Indexes for table `policydata`
--
ALTER TABLE `policydata`
  ADD PRIMARY KEY (`policyNo`),
  ADD KEY `agentID` (`agentID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `schemeID` (`schemeID`);

--
-- Indexes for table `premium`
--
ALTER TABLE `premium`
  ADD PRIMARY KEY (`policyNo`,`ReceiptNo`);

--
-- Indexes for table `scheme`
--
ALTER TABLE `scheme`
  ADD PRIMARY KEY (`schemeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10008;

--
-- AUTO_INCREMENT for table `nominee`
--
ALTER TABLE `nominee`
  MODIFY `nomineeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nominee`
--
ALTER TABLE `nominee`
  ADD CONSTRAINT `nominee_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `policydata`
--
ALTER TABLE `policydata`
  ADD CONSTRAINT `agentID` FOREIGN KEY (`agentID`) REFERENCES `agent` (`agentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customerID` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schemeID` FOREIGN KEY (`schemeID`) REFERENCES `scheme` (`schemeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `premium_ibfk_1` FOREIGN KEY (`policyNo`) REFERENCES `policydata` (`policyNo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
