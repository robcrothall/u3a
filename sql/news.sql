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

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `content` text NOT NULL,
  `effective_date` date NOT NULL DEFAULT current_timestamp(),
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `effective_date`, `contact_id`, `user_id`, `changed`) VALUES
(8, 'Jobs has been changed to Tasks', 'As the intranet is being used by all departments now, the &quot;Jobs&quot; menu item has been changed to &quot;Tasks&quot;.  It is now possible for HoDs to delegate tasks, with control, to members of staff and for those staff members to update status or close the task online.\r\n\r\nPlease let Rob Crothall know if there are changes that you would like on this, or any other function on the intranet.', '2021-02-21', 260, 1, '2021-02-21 14:49:54'),
(9, 'Four approved Policies under Documents', 'There are four approved Policy documents under the &quot;Documents&quot; menu item of the intranet, as well as other documents of interest.  More will be added as they are approved by the Board.', '2021-03-05', 260, 1, '2021-03-05 08:13:41'),
(10, 'New version - Intranet User Manual', 'Version 1.7 of the Intranet User Manual has been uploaded and is available under the &quot;Documents&quot; menu item.\r\n\r\nThe recent changes include recommended daily procedures for HoDs or administrators in the easy management of &quot;Tasks&quot; which have been assigned to your department.  Users can see how their Task requests are processed, and how to escalate attention to the tasks.', '2021-04-17', 260, 1, '2021-04-17 10:13:21'),
(11, 'Tasks function has been enhanced', '1. When a task is created or updated, you can now specify the completion criteria that define if the task can be closed, or not.\r\n2. New selection criteria have been added on the list of tasks.  These are selecting tasks that are late, and tasks that are due today, but are not yet complete.', '2021-05-09', 260, 1, '2021-05-09 21:06:39'),
(12, 'Tasks can be linked to Projects', 'Staff will see that the maintenance of projects has been added to the Tasks menu.  You can create (or change) a project and then associate one or more tasks with that project.\r\nOn the list of tasks, you can select a particular project and see only the tasks associated with that project.', '2021-07-05', 260, 1, '2021-07-05 06:41:20'),
(13, 'Revised function for creating new Users', 'A revised function is available to Administrators under the Administration menu item to list, create, and disable user sign-ons.  It now creates the new user and assigns roles in a single step, which reduces complexity.\r\nA function to update User sign-on records will be available in a while.', '2021-07-25', 260, 1, '2021-07-25 15:52:49'),
(14, 'Protection of Personal Information Act (PoPI)', 'The new policy on the Protection of Personal Information, in support of the Act that came into force on 2021-07-01, is now available for viewing under Documents.', '2021-07-30', 522, 1, '2021-07-30 09:26:03'),
(15, 'New Password rules', 'In support of the Protection of Personal Information Act (PoPIA), we have increased the security requirements for new passwords on this site.  When you change your password, please include at least one upper-case character (capital letter), one lower-case character (small letter), one numeral (number), and one special character.  The new password must be more than seven characters long.  This makes it much more difficult for &quot;hackers&quot; to gain access to your account.', '2021-08-04', 260, 1, '2021-08-04 12:50:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `n_contact_id` (`contact_id`),
  ADD KEY `n_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `n_contact_id` FOREIGN KEY (`contact_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `n_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
