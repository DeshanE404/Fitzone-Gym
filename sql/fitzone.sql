-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2025 at 06:00 AM
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
-- Database: `fitzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `joinforms`
--

CREATE TABLE `joinforms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `joinforms`
--

INSERT INTO `joinforms` (`id`, `name`, `email`, `contact`, `message`, `attachment`) VALUES
(11, 'Vinitha Swarnakanthi', 'gsdeshancoc@gmail.com', '0719768074', '1997-09-25\r\nNo 27 Narammala\r\nFemale', 'attachment/68a4d0919a585.jpg'),
(12, 'Deshan Ranasingha', 'Deshanmayura@gmail.com', '0714618112', '2002-05-09\r\nNarammala road Alawwa\r\nMale', 'attachment/68a4d0c4beef3.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `gym_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `dob` text NOT NULL,
  `gender` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `membership_type` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`gym_id`, `name`, `email`, `dob`, `gender`, `contact`, `address`, `membership_type`, `password`) VALUES
(5, 'Deshan Ranasingha', 'Deshanmayura@gmail.com', '2002-05-09', 'Male', '0714618112', 'Paranawatta,Narammala road Alawwa', 'Student', '$2y$10$kwRt6BbCagPry6/rYVeYeO8KpL9Z8/SJS9H9/CpMk9gYxNG0maPDe'),
(6, 'Vinitha Swarnakanthi', 'gsdeshancoc@gmail.com', '1997-09-25', 'Female', '0719768074', 'No 27 Narammala', 'Adult', '$2y$10$olhCuVPUCvPjHcXiuPDJyecOWHdVjzRxELzRAEU5E1B9Wv7VA5kh2');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL,
  `resource_name` varchar(255) DEFAULT NULL,
  `resource_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resource_id`, `resource_name`, `resource_path`) VALUES
(3, 'Workout plan', 'uploads/resources/68a4d1b9a5001.pdf'),
(4, 'Cardio Training', 'uploads/resources/68a4d1cb4e41c.pdf'),
(5, 'Eating plan', 'uploads/resources/68a4d1dbe890c.pdf'),
(6, 'nutrition plan', 'uploads/resources/68a4d1f65bfbb.pdf'),
(7, 'protine plan', 'uploads/resources/68a4d20f0d1c0.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `name`, `message`) VALUES
(1, 'Deshan Ranasingha', 'Grate Gym for students'),
(2, 'Deshan Ranasingha', 'qadq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `joinforms`
--
ALTER TABLE `joinforms`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`gym_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `joinforms`
--
ALTER TABLE `joinforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `gym_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
