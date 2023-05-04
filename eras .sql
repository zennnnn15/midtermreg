-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2023 at 11:36 AM
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
-- Database: `eras`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_registrar`
--

CREATE TABLE `assigned_registrar` (
  `id` int(30) NOT NULL,
  `event_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assigned_registrar`
--

INSERT INTO `assigned_registrar` (`id`, `event_id`, `user_id`) VALUES
(15, 4, 5),
(16, 36, 5),
(17, 6, 5),
(18, 35, 5),
(20, 37, 5),
(21, 37, 6),
(22, 38, 5);

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `id` int(30) NOT NULL,
  `event_id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=Awaiting/Absent=1=Present',
  `date_created` int(11) NOT NULL DEFAULT current_timestamp(),
  `subevent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`id`, `event_id`, `firstname`, `lastname`, `middlename`, `contact`, `gender`, `email`, `address`, `status`, `date_created`, `subevent_id`) VALUES
(32, 38, 'Hikaru ', 'Nakamura', 'Priso', '09277366123', 'Male', 'hikaruGM@gmail.com', 'Ontario, Ohaio', 1, 2147483647, 41),
(33, 38, 'Ian ', 'Neapominachi', 'Jean', '09053423492', 'Male', 'GMian@gmail.com', 'Moscow, Russia', 1, 2147483647, 39),
(34, 38, 'Ding', 'Liren', 'Angbato', '09277361999', 'Male', 'GmDingChilling@gmail.com', 'Beijing , China', 1, 2147483647, 39),
(35, 37, 'Elmar', 'Mako', 'M.', '09123213121', 'Male', 'Elmarmako@gmail.com', 'Urdaneta', 1, 2147483647, 34),
(36, 37, 'John Paul', 'Espiritu', 'C', '09053423499', 'Male', 'jpespiritu@gmail.com', 'Urdaneta', 1, 2147483647, 35),
(37, 39, 'Psu', 'Leo', '', '09053423495', 'Male', 'leo@gmail.com', 'Urdaneta', 0, 2147483647, 44),
(38, 38, 'Magnus', 'Carlsen', 'D.', '09067213212', 'Male', 'GMmagnus@gmail.com', 'Norway', 1, 2147483647, 41);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(30) NOT NULL,
  `event_datetime` datetime NOT NULL,
  `event` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `venue` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 Pending, 1=Open,2=Done',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_datetime`, `event`, `description`, `venue`, `status`, `date_created`) VALUES
(37, '2023-05-12 15:48:00', 'Collide ', '								<p><b>BS Math and IT Week</b></p><p><b><br></b><span style=\"font-size: 1rem;\">Collide 2023: College of Computing Student Fair</span></p><p><b><br></b></p>							', 'PSU Urdantea Campus', 2, '2023-05-04 15:52:04'),
(38, '2023-05-11 16:01:00', 'World Chess Championship', '								<span style=\"font-family: Degular, Arial, sans-serif; font-size: 20px;\"><font color=\"#000000\" style=\"\">The historical pinnacle of&nbsp;the FIDE World Championship Cycle.</font></span>', 'ASTANA KAZAKHSTAN', 1, '2023-05-04 16:02:46'),
(39, '2023-05-05 16:59:00', 'Coding Hub', 'Learn Programming from the pro.', 'Zoom Meeting', 1, '2023-05-04 16:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `event_sub`
--

CREATE TABLE `event_sub` (
  `eventID` int(11) NOT NULL,
  `eventsubName` varchar(250) NOT NULL,
  `idEvent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_sub`
--

INSERT INTO `event_sub` (`eventID`, `eventsubName`, `idEvent`) VALUES
(34, 'Day 1: Amazing Race', 37),
(35, 'Day 1: Chess Tournament', 37),
(36, 'Day 1: Web Design', 37),
(37, 'Day 2: Aquintance Party', 37),
(38, 'Day 3 : Awarding', 37),
(39, 'Classical Chess', 38),
(40, 'Rapid Chess', 38),
(41, 'Blitz Chess', 38),
(42, 'C# Programming', 39),
(43, 'What is Frameworks?', 39),
(44, 'Ways to Improve in Programming', 39);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Admin,2= users',
  `avatar` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `contact`, `address`, `email`, `password`, `type`, `avatar`, `date_created`) VALUES
(4, 'zen', 'Sad', 'Disu', '0906253232', 'Cato\r\n122', 'admin@admin.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, '', '2023-05-02 10:13:57'),
(5, 'Erika', 'Capiral', 'dikoalam', '03265656', 'Urda', 'erika@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, '', '2023-05-02 13:41:07'),
(6, 'Martin', 'Leno', 'E.', '09062532321', 'Belgium', 'znitsu0@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, '', '2023-05-04 15:58:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_registrar`
--
ALTER TABLE `assigned_registrar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_sub`
--
ALTER TABLE `event_sub`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `idEvent` (`idEvent`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_registrar`
--
ALTER TABLE `assigned_registrar`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `event_sub`
--
ALTER TABLE `event_sub`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_sub`
--
ALTER TABLE `event_sub`
  ADD CONSTRAINT `event_sub_ibfk_1` FOREIGN KEY (`idEvent`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
