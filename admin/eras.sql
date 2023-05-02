-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 11:34 AM
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
(11, 4, 5);

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
  `date_created` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`id`, `event_id`, `firstname`, `lastname`, `middlename`, `contact`, `gender`, `email`, `address`, `status`, `date_created`) VALUES
(7, 6, 'Kyzen', 'Campos', 'D.', '0906721321', 'Male', 'kyzen15@gmail.com', 'Cato', 1, 2147483647);

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
(4, '2023-05-03 11:05:00', 'Collide', '								BSIT AND BSMATH							', 'PSU URDANETA Campus', 1, '2023-05-02 11:08:08'),
(6, '2023-05-04 14:00:00', 'FacePainting', '																Art														', 'SM Activity Center', 1, '2023-05-02 12:23:08'),
(7, '2023-05-10 13:00:00', 'Make a Wish', 'An online<br>', 'Auditoruim', 1, '2023-05-02 13:00:51'),
(8, '2023-05-14 14:38:00', 'Chess', 'Chess Tourna<br>', 'auditoroum', 1, '2023-05-02 14:38:20'),
(9, '2023-05-24 14:40:00', 'Scramble', '															', 'ITBuilding', 1, '2023-05-02 14:40:35'),
(10, '2023-05-17 14:42:00', 'SportFest', 'Sport Tournament<br>', 'Venomar', 1, '2023-05-02 14:42:57'),
(11, '2023-05-12 14:45:00', 'Volleyball', 'asdas', 'Genror', 1, '2023-05-02 14:45:35'),
(12, '2023-05-02 18:00:00', 'asdasd', 'qweqwe', 'qweqw', 1, '2023-05-02 14:50:57'),
(13, '2023-05-16 14:51:00', 'asdasqw1111', 'asdad', 'asdddddd', 1, '2023-05-02 14:51:52'),
(14, '2023-05-03 14:52:00', 'aaaaaaa', 'asdasd', 'aaaaaa', 1, '2023-05-02 14:52:59'),
(15, '2023-05-02 14:54:00', 'vfsdfs', 'aas', 'dfsfsdf', 1, '2023-05-02 14:54:53'),
(16, '2023-05-18 15:01:00', 'Hello', 'assddasd', 'Venomar', 1, '2023-05-02 15:01:19'),
(17, '2023-05-15 15:03:00', 'qw', 'sdfsdf', 'asd', 1, '2023-05-02 15:03:56'),
(18, '2023-05-12 15:05:00', 'asdasd', 'asdas', 'qwew', 1, '2023-05-02 15:05:24'),
(19, '2023-05-08 15:07:00', 'dd', 's', 'd', 1, '2023-05-02 15:07:16'),
(20, '2023-05-02 15:08:00', 'asdda', 'asd', 'a', 1, '2023-05-02 15:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `event_sub`
--

CREATE TABLE `event_sub` (
  `eventID` int(11) NOT NULL,
  `eventsubName` varchar(250) NOT NULL,
  `eventDesc` varchar(250) NOT NULL,
  `idEvent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_sub`
--

INSERT INTO `event_sub` (`eventID`, `eventsubName`, `eventDesc`, `idEvent`) VALUES
(1, 'Aquintance Party', 'Dance and meet others', 4),
(2, 'Valorant Tournament', 'Valorant Tournament', 4),
(10, 'Badminton', '', 10),
(15, 'qwe', '', 15);

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
(5, 'Erika', 'Capiral', 'dikoalam', '03265656', 'Urda', 'erika@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, '', '2023-05-02 13:41:07');

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `event_sub`
--
ALTER TABLE `event_sub`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
