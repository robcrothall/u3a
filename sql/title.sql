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
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `id` int(8) NOT NULL,
  `title` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`id`, `title`, `user_id`, `changed`) VALUES
(1, 'Dr', 1, '2022-09-06 08:39:10'),
(2, 'Judge', 1, '2022-09-06 08:39:34'),
(3, 'Miss', 1, '2022-09-06 08:40:00'),
(4, 'Mr', 1, '2022-09-06 08:54:46'),
(5, 'Mrs', 1, '2022-09-06 09:04:33'),
(6, 'Ms', 1, '2022-09-06 09:04:56'),
(7, 'Prof', 1, '2022-09-06 09:05:16'),
(8, 'Rev', 1, '2022-09-06 09:05:32'),
(9, 'Sr', 1, '2022-09-06 09:06:36'),
(32, 'Mr and Mrs', 1, '2022-09-06 09:54:43'),
(33, 'Prof and Mrs', 1, '2022-09-06 09:55:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
