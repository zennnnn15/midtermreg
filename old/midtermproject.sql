-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 04:23 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `midtermproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(250) NOT NULL,
  `adminUser` varchar(250) NOT NULL,
  `adminPass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `adminUser`, `adminPass`) VALUES
(1, 'PSU Event Admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `dropdown`
--

CREATE TABLE `dropdown` (
  `dropdownID` int(11) NOT NULL,
  `dropdownName` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `fieldID` int(11) NOT NULL,
  `fieldName` varchar(250) NOT NULL,
  `fieldType` varchar(250) NOT NULL,
  `fieldLabel` varchar(250) NOT NULL,
  `formID` int(11) NOT NULL,
  `field_option` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`fieldID`, `fieldName`, `fieldType`, `fieldLabel`, `formID`, `field_option`) VALUES
(4, 'fname', 'text', 'First Name', 1, ''),
(5, 'first_name', 'text', 'First Name', 2, ''),
(6, 'last_name', 'text', 'Last Name', 2, ''),
(7, 'email', 'email', 'Email Address', 2, ''),
(8, 'phone', 'number', 'Phone Number', 2, ''),
(9, 'age', 'number', 'Age', 2, ''),
(10, 'gender', 'radio', 'Gender', 2, ''),
(11, 'date', 'date', 'Date of Event', 2, ''),
(12, 'time', 'time', 'Time of Event', 2, ''),
(13, 'event_type', 'dropdown', 'Type of Event', 2, ''),
(14, 'location', 'text', 'Location of Event', 2, ''),
(15, 'comments', 'textarea', 'Additional Comments', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `formID` int(11) NOT NULL,
  `formName` varchar(250) NOT NULL,
  `image` text NOT NULL,
  `formDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`formID`, `formName`, `image`, `formDesc`) VALUES
(1, 'School Registration', 'https://i.pinimg.com/736x/fc/f2/55/fcf255839185ef5e1e9bcff6c78ba9f5.jpg', '0'),
(2, 'Face Painting Event', 'https://tse4.mm.bing.net/th?id=OIP.4GvLOg1HBzH4WeNMP7yXmQHaJe&pid=Api&P=0', '0'),
(4, 'Team Building', 'https://tse1.mm.bing.net/th?id=OIP.vpY4W1SfwVubWDRy0X-c0wHaE7&pid=Api&P=0', '0'),
(6, 'Collide', 'https://scontent.fmnl3-4.fna.fbcdn.net/v/t39.30808-6/333094270_1289176568610711_1844998234948436919_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHsD6-aJf4U9QQVYlAeNLx3jYOrGEDO0ryNg6sYQM7SvDLjMB1YR-mTd7vCg1JVcg3TqyGFwoy2bNnpwZFaJOOQ&_nc_ohc=0Pjn_qRIkJIAX_FPcjJ&_nc_ht=scontent.fmnl3-4.fna&oh=00_AfCIZzwPYGERp80aRbu_5CR1ECnGPjbMXd7CR5vyS1GSTA&oe=644BABCF', '3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fullName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `dropdown`
--
ALTER TABLE `dropdown`
  ADD PRIMARY KEY (`dropdownID`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`fieldID`),
  ADD KEY `formID` (`formID`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`formID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dropdown`
--
ALTER TABLE `dropdown`
  MODIFY `dropdownID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `fieldID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `formID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `field_ibfk_1` FOREIGN KEY (`formID`) REFERENCES `form` (`formID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
