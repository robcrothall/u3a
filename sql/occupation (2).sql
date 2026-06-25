-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2026 at 03:23 AM
-- Server version: 10.6.27-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afpxyykk_sprv_v1`
--

-- --------------------------------------------------------
drop table if exists `occupation`;
--
-- Table structure for table `occupation`
--

CREATE TABLE `occupation` (
  `id` int(8) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `occupation`
--

INSERT INTO `occupation` (`id`, `occupation`, `notes`, `user_id`, `changed`) VALUES
(1, 'Manager', NULL, 1, '2020-04-27 17:49:57'),
(2, 'Engineer, Mechanical', NULL, 1, '2020-04-27 17:50:56'),
(3, 'Engineer, Civil', NULL, 1, '2020-04-27 17:51:20'),
(4, 'Medical Doctor', NULL, 1, '2020-04-27 17:52:56'),
(5, 'Information Technology', '', 1, '2020-05-02 04:54:20'),
(6, 'Information Management', '', 1, '2020-05-02 04:54:41'),
(7, 'Project Management', '', 1, '2020-05-02 04:55:34'),
(8, 'Sales', '', 1, '2020-05-02 04:58:29'),
(9, 'Mining Management', '', 1, '2020-05-02 04:59:13'),
(10, 'Diamond Valuation', '', 1, '2020-05-02 04:59:55'),
(11, 'Investment Management', '', 1, '2020-05-02 05:00:17'),
(12, 'Medical Industry', '', 1, '2020-05-02 05:00:48'),
(13, 'Textile Industry', '', 1, '2020-05-02 05:01:16'),
(14, 'Quantity Surveyer', '', 1, '2020-05-02 10:55:18'),
(15, 'Ichthyologist', NULL, 1, '2020-09-17 09:39:54'),
(16, 'Receptionist', NULL, 1, '2020-10-03 12:45:42'),
(17, 'Accounts Clerk', NULL, 1, '2020-10-03 12:46:24'),
(18, 'Nurse', NULL, 1, '2020-10-03 12:46:47'),
(19, 'Registered Nurse', NULL, 1, '2020-10-03 12:47:06'),
(20, 'Sister', NULL, 1, '2020-10-03 12:47:29'),
(21, 'Carer', NULL, 1, '2020-10-03 12:47:43'),
(22, 'Restaurant Supervisor', NULL, 1, '2020-10-03 12:48:17'),
(23, 'Restaurant Manager', NULL, 1, '2020-10-03 12:48:39'),
(24, 'Catering Manager', NULL, 1, '2020-10-03 12:48:58'),
(25, 'Housekeeper', NULL, 1, '2020-10-03 12:49:14'),
(26, 'General Manager', NULL, 1, '2020-10-03 12:49:32'),
(27, 'Welfare Officer', NULL, 1, '2020-10-03 12:50:08'),
(28, 'Security Supervisor', NULL, 1, '2020-10-03 12:50:43'),
(29, 'Security Officer', NULL, 1, '2020-10-03 12:50:58'),
(30, 'Hairdresser', NULL, 1, '2020-10-03 12:51:16'),
(31, 'Systems and Administration Manager', NULL, 1, '2020-10-03 12:51:46'),
(32, 'Maintenance Administrator', NULL, 1, '2020-10-03 12:52:13'),
(33, 'Facilities Manager', NULL, 1, '2020-10-03 12:52:33'),
(34, 'Finance Manager', NULL, 1, '2020-10-03 12:52:52'),
(35, 'Chief Librarian', NULL, 1, '2020-10-03 12:53:18'),
(36, 'Librarian', NULL, 1, '2020-10-03 12:53:34'),
(37, 'Occupational Therapist', NULL, 1, '2020-10-03 12:54:04'),
(38, 'Management Trainee', NULL, 1, '2020-10-03 12:54:25'),
(39, 'Driver Messenger', NULL, 1, '2020-10-03 12:55:04'),
(40, 'Sales Manager', NULL, 1, '2020-10-03 12:55:27'),
(41, 'Care Manager', NULL, 1, '2020-10-03 12:55:47'),
(42, 'Painter', NULL, 1, '2020-10-03 12:57:37'),
(43, 'Plumber', NULL, 1, '2020-10-03 12:57:37'),
(44, 'Carpenter', NULL, 1, '2020-10-03 12:57:55'),
(45, 'Gardener', NULL, 1, '2020-10-03 12:58:14'),
(46, 'Cleaner', NULL, 1, '2020-10-03 12:58:56'),
(47, 'Labourer', NULL, 1, '2020-10-03 12:59:24'),
(48, 'Farmer', NULL, 1, '2020-10-03 13:01:26'),
(49, 'Academic', NULL, 1, '2020-10-03 13:01:53'),
(50, 'Dentist', NULL, 1, '2020-10-03 13:02:08'),
(51, 'Geologist', NULL, 1, '2020-10-03 13:02:24'),
(52, 'Economist', NULL, 1, '2020-10-03 13:02:44'),
(53, 'Historian', NULL, 1, '2020-10-03 13:02:59'),
(54, 'Minister of Religion', '', 1, '2020-10-18 06:58:42'),
(55, 'Lawyer', '', 1, '2020-10-18 06:59:00'),
(56, 'Accountant', '', 1, '2021-01-28 11:56:58'),
(57, 'Chartered Accountant', '', 1, '2021-01-28 11:57:20'),
(58, 'Electrician', '', 1, '2021-02-03 17:04:54'),
(59, 'Teacher', '', 1, '2021-02-15 14:15:13'),
(61, 'None or unknown', NULL, 1, '2020-02-25 11:51:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `occupation`
--
ALTER TABLE `occupation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `occupation`
--
ALTER TABLE `occupation`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
