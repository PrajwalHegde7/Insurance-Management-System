-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2022 at 02:42 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE IF NOT EXISTS `Agent` (
  `agentID` varchar(10) NOT NULL,
  `passwd` VARCHAR(150) NOT NULL,
  `agentName` varchar(150) NOT NULL,
  `DOB` date NOT NULL,
  `Address` varchar(80) NOT NULL,
  `Branch` varchar(50) NOT NULL,
  `contactNum` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent`
--

INSERT INTO `Agent` (`agentID`, `passwd`, `agentName`, `DOB`, `Address`, `Branch`, `contactNum`) VALUES
('123abc321', '12345678', 'abc', '1966-02-21', 'Banglore', 'xyz', 7016636683);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `Customer` (
  `customerID` bigint(10) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Middle_Name` varchar(50),
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

INSERT INTO `Customer` (`customerID`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `DOB`, `Address`, `contactNumber`, `Mother_Name`, `Mother_Status`, `Father_Name`, `Father_Status`, `Marital_status`, `Spouse`) VALUES
(10002, 'pqr', 'abc', 'xyz', 'M', '2018-10-02', '21/694, Satyam Apartment, Refinery Road, Gorwa', 7016636683, 'Harsha Sheth', 'A', 'Sanjay Sheth', 'A', 'S', '');

-- --------------------------------------------------------

--
-- Table structure for table `Scheme`
--

CREATE TABLE IF NOT EXISTS `Scheme` (
  `schemeID` int(20) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `MaxAge` int(3) NOT NULL,
  `MinAmount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Scheme`
--

INSERT INTO `Scheme` (`schemeID`, `Name`, `MaxAge`,`MinAmount`) VALUES
(10000, 'Jeevan Labh','25','3245698' ),
(10001, 'Jeevan Lakshya','45','6748367' ),
(10002, 'CDE','34','6748632' );

-- --------------------------------------------------------

--
-- Table structure for table `policydata`
--

CREATE TABLE IF NOT EXISTS `PolicyData` (
  `policyNo` int(15) NOT NULL,
  `customerID` bigint(10) NOT NULL,
  `agentID` varchar(10) NOT NULL,
  `schemeID` INT(20) NOT NULL,
  `DOC` date NOT NULL,
  `Sum_Assured` int(10) NOT NULL,
  `Pay_Period` int(2) NOT NULL,
  `Ins_Period` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `policydata`
--

INSERT INTO `PolicyData` (`policyNo`, `customerID`, `agentID`,`schemeID`, `DOC`, `Sum_Assured`, `Pay_Period`, `Ins_Period`) VALUES
(123564789, 10002, '123abc231',10000, '2018-10-02', 35000, 5, 10),
(284049583, 10002, '123abc231',10001, '2007-06-20', 450000, 35, 80);

-- --------------------------------------------------------

--
-- Table structure for table `premium`
--

CREATE TABLE IF NOT EXISTS `Premium` (
  `policyNo` int(15) NOT NULL,
  `Premium` int(10) NOT NULL,
  `Mode` varchar(3) NOT NULL,
  `Last_date` date NOT NULL,
  `ReceiptNo` int(20) not null,
  `ReceiptDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `premium`
--

INSERT INTO `Premium` (`policyNo`, `Premium`, `Mode`, `Last_date`,`ReceiptNo`,`ReceiptDate`) VALUES
(123564789, 3500, 'YLY', '2018-12-01',34526,'2017-10-24'),
(284049583, 469, 'MLY', '2018-12-01',234516,'2017-5-30');

-- --------------------------------------------------------

--
-- Table structure for table `unpaid_premium`
--

CREATE TABLE IF NOT EXISTS `Nominee` (
  `customerID` bigint(10) NOT NULL,
  `Fname` varchar(150) NOT NULL,
  `Mname` varchar(150),
  `Lname` varchar(150) NOT NULL,
  `Relation` varchar(20) NOT NULL,
  `Gender`  char(1) NOT NULL,
  `DOB` date NOT NULL,
  `ContactNo` int(11) NOT NULL,
  `Address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Indexes for table `agent`
--
ALTER TABLE `Agent`
  ADD PRIMARY KEY (`agentID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `paid_premium`
--
ALTER TABLE `Scheme`
  ADD PRIMARY KEY (`schemeID`);

--
-- Indexes for table `policydata`
--
ALTER TABLE `PolicyData`
  ADD PRIMARY KEY (`policyNo`),
  ADD KEY `agentID` (`agentID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `schemeID` (`schemeID`);
--
-- Indexes for table `premium`
--
ALTER TABLE `Premium`
  ADD PRIMARY KEY (`policyNo`);

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `Customer`
  MODIFY `customerID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10003;
--
-- Constraints for table `policydata`
--
ALTER TABLE `PolicyData`
  ADD CONSTRAINT `agentID` FOREIGN KEY (`agentID`) REFERENCES `Agent` (`agentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customerID` FOREIGN KEY (`customerID`) REFERENCES `Customer` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schemeID` FOREIGN KEY (`schemeID`) REFERENCES `Scheme` (`schemeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `premium`
--
ALTER TABLE `Premium`
  ADD CONSTRAINT `premium_ibfk_1` FOREIGN KEY (`policyNo`) REFERENCES `PolicyData` (`policyNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nominee`
--
ALTER TABLE `nominee`
  ADD CONSTRAINT `nominee_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE PROCEDURE `pay_policy`(IN `pol` INT) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER 
  BEGIN
   select * from policydata PD,premium P where P.policyNo=PD.policyNo and PD.policyNo=pol;
  END
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
