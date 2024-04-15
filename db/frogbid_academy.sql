-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 07:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `frogbid_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `program` varchar(500) NOT NULL,
  `age` varchar(500) NOT NULL,
  `course_name` varchar(500) NOT NULL,
  `duration` varchar(500) NOT NULL,
  `inserted_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `program`, `age`, `course_name`, `duration`, `inserted_at`, `updated_at`) VALUES
(1, 'Programming', 'Class 6 to', 'Test', '6 Month', '2024-04-13 01:13:55', '0000-00-00 00:00:00'),
(2, 'Art', '11 to 16 y', 'Test 2', '1 yr', '2024-04-13 01:14:42', '0000-00-00 00:00:00'),
(3, 'Art', 'hhhghg', 'ygyygyhgh', 'jhjhjh', '2024-04-13 02:10:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `e_id` int(11) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `department` varchar(500) NOT NULL,
  `join_date` date NOT NULL,
  `nid_no` varchar(20) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `position` varchar(200) NOT NULL,
  `leave_date` date NOT NULL,
  `role` int(10) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `inserted_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`e_id`, `full_name`, `department`, `join_date`, `nid_no`, `contact_no`, `email`, `password`, `position`, `leave_date`, `role`, `status`, `inserted_at`, `updated_at`) VALUES
(1, 'Test User', 'Software', '2018-10-01', '3302661784', '01679503004', 'test@test.com', '@BCD1234', '', '0000-00-00', 0, 0, '2024-04-11 14:12:53', '0000-00-00 00:00:00'),
(2, 'Test User', 'Graphics', '2024-04-01', '3302661784', '01679503004', 'test1@test.com', '$2y$10$7HASybZlHMiYvBfTstJEF.kTCNSMrjzayit3biYqE5wNk8lQGNIl6', '', '0000-00-00', 0, 0, '2024-04-12 00:16:42', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`e_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
