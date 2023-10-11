-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 05:31 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `id` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `sid` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `Detail` varchar(500) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Action` varchar(50) DEFAULT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`sid`, `type`, `Detail`, `Date`, `Action`, `cid`) VALUES
(8, 'Plumber', 'aaaaaaaaaaaaaaaaaaaaaa', '2023-05-03', 'Completed', 21),
(8, 'Electrician', 'bbbbbbbbbbbbbbbb', '2023-05-03', 'Completed', 22),
(8, 'CarPenter', 'cccccccccccccccccccccc', '2023-05-03', 'Take Action', 23),
(8, 'CarPenter', 'fxg', '2023-05-05', 'Take Action', 24),
(8, 'CarPenter', 'fxg', '2023-05-05', 'Take Action', 25),
(8, 'Plumber', '', '2023-05-05', 'Take Action', 26),
(8, 'Plumber', '', '2023-05-05', 'Take Action', 27),
(8, 'Plumber', '', '2023-05-05', 'Take Action', 28),
(8, 'Plumber', '', '2023-05-05', 'Take Action', 29),
(8, 'Plumber', '', '2023-05-05', 'Take Action', 30),
(8, 'Plumber', '', '2023-05-05', 'Take Action', 31),
(8, 'Plumber', 'cdhxg', '2023-05-06', 'Take Action', 32),
(8, 'Plumber', 'cdhxg', '2023-05-06', 'Take Action', 33),
(7, 'Electrician', 'Fan is not working in room 234', '2023-05-07', 'Take Action', 35),
(7, 'Electrician', 'LED not working in bathroom of room no 123', '2023-05-07', 'Completed', 36),
(7, 'Plumber', 'Tap not working', '2023-05-09', 'Take Action', 38),
(24, 'Plumber', 'Led not working properly', '2023-05-09', 'Completed', 39);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(20) NOT NULL,
  `room_no` int(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` int(8) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `room_no`, `email`, `password`, `phone_number`, `gender`, `sid`) VALUES
('Prasad', 102, 'services.propad@gmail.com', 1234, '2147483647', 'male', 7),
('dhanu', 103, 'ghadagedhanashri95@gmail.com', 1234, '2147483647', 'female', 8),
('neha', 223, 'neha123@gmail.com', 1234, '2147483647', 'female', 9),
('Pankaj', 143, 'pankaj@gmail.com', 1234, '9067404012', 'male', 23),
('snehal', 134, 'snehaldahake19@gmail.com', 1234, '9860684680', 'female', 24);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `Id` int(2) NOT NULL,
  `Workname` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Gmail` varchar(50) DEFAULT NULL,
  `Action` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`Id`, `Workname`, `Name`, `Gmail`, `Action`) VALUES
(1, 'Plumber', 'sd', 'services.propad@gmail.com', 'update'),
(2, 'Electrician', 'xy', 'dhobaleprasad3@gmail.com', 'update'),
(3, 'Carpenter', 'xyz', 'ghadagedhanashri95@gmail.com', 'update');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `users` (`sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
