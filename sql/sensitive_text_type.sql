-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2026 at 03:29 AM
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

--
-- Table structure for table `sensitive_text_type`
--

CREATE TABLE `sensitive_text_type` (
  `id` int(8) NOT NULL,
  `text_description` varchar(50) NOT NULL,
  `data_type` varchar(20) NOT NULL DEFAULT 'text',
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sensitive_text_type`
--

INSERT INTO `sensitive_text_type` (`id`, `text_description`, `data_type`, `user_id`, `changed`) VALUES
(1, 'Credit/Debit Card', 'cc', 1, '2022-06-10 14:38:02'),
(2, 'ID No - ZA', 'id', 1, '2022-08-29 10:24:19'),
(3, 'Passport Number', 'id', 1, '2022-08-29 10:24:29'),
(4, 'ID No - Foreign', 'id', 1, '2022-08-29 10:24:40'),
(5, 'Drivers Licence - ZA', 'id', 1, '2022-08-29 10:24:48'),
(6, 'Drivers Licence - Foreign', 'id', 1, '2022-08-29 11:17:33'),
(7, 'Phone - Mobile', 'phone', 1, '2022-08-29 10:16:57'),
(8, 'Phone - Home', 'phone', 1, '2022-08-29 10:17:11'),
(9, 'Birth Date', 'date', 1, '2022-06-10 14:36:38'),
(10, 'Wedding Anniversary', 'date', 1, '2022-06-10 14:36:53'),
(11, 'Phone - Work Switchboard', 'phone', 1, '2022-08-29 10:17:41'),
(12, 'Phone - Direct Work', 'phone', 1, '2022-08-29 10:18:07'),
(13, 'Email - Home', 'email', 1, '2022-08-29 10:18:26'),
(14, 'Email - Work', 'email', 1, '2022-08-29 10:18:45'),
(15, 'Email - Other', 'email', 1, '2022-08-29 10:19:02'),
(16, 'Web site - Personal', 'url', 1, '2022-08-29 10:19:58'),
(17, 'Web site - Business', 'url', 1, '2022-08-29 10:20:19'),
(18, 'Web site - Related', 'url', 1, '2022-08-29 10:20:40'),
(19, 'Sex', 'text', 1, '2022-07-03 20:14:59'),
(20, 'Race', 'index', 1, '2022-09-15 19:29:36'),
(22, 'Photo can be published', 'text', 1, '2022-09-15 19:30:36'),
(23, 'Personal History', 'text', 1, '2022-09-15 19:41:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensitive_text_type`
--
ALTER TABLE `sensitive_text_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sensitive_text_type`
--
ALTER TABLE `sensitive_text_type`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
