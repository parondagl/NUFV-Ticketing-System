-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 05:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `css_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'System performance (latency or blue screen)'),
(2, 'Audio and Visual Assistance'),
(3, 'Missing Peripheral (hdmi, ethernet cable, etc.)'),
(4, 'Hardware Failure or Damage (physical damage on the device)'),
(5, 'Keyboard Damage or Input issues (mismatch keys on the keyboard)'),
(6, 'Account Log in Issue (teams, outlook, nuis)'),
(7, 'Software Setup or Install Assistance'),
(8, 'Network Connectivity'),
(9, 'Security Concern (phishing or suspicious email)'),
(10, 'Others (state below)');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `user_type` tinyint(1) NOT NULL COMMENT '1= admin, 2= staff,3= customer',
  `ticket_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `user_type`, `ticket_id`, `comment`, `date_created`) VALUES
(1, 1, 1, 1, '&lt;p&gt;Okay this is acknowledged please wait in 2 minutes&lt;br&gt;&lt;/p&gt;', '2024-02-29 00:31:35'),
(2, 3, 3, 1, '&lt;p&gt;Okay, Thankyou.&lt;/p&gt;', '2024-02-29 00:31:57'),
(3, 1, 1, 1, '&lt;p&gt;Ticket done!&lt;/p&gt;', '2024-02-29 00:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `middlename`, `contact`, `address`, `email`, `password`, `date_created`) VALUES
(3, 'gab', 'angelo', 'paronda', '09155481841', 'Makawili 2 blk 2 lot 12 llano road caloocan city', 'gabparonda@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-02-29 00:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `date_created`) VALUES
(1, 'Academic Director Office', 'Academic Director Office', '2024-02-11 22:43:07'),
(2, 'Academe Offices', 'Academe Offices', '2024-02-11 22:43:57'),
(3, 'Accounting Office', 'Accounting Office', '2024-02-11 22:44:33'),
(4, 'Academic Services Director Office', 'Academic Services Director Office', '2024-02-11 22:45:33'),
(5, 'Admission', 'Admission', '2024-02-11 22:46:56'),
(6, 'Admin Services Director Office', 'Admin Services Director Office', '2024-02-11 22:47:00'),
(7, 'Clinic', 'Clinic', '2024-02-11 22:47:35'),
(8, 'Comex', 'Comex', '2024-02-11 22:48:44'),
(9, 'D.O', 'D.O', '2024-02-11 22:48:54'),
(10, 'Executive Office', 'Executive Office', '2024-02-11 22:49:17'),
(11, 'F.M.O', 'F.M.O', '2024-02-11 22:49:34'),
(12, 'Guidance', 'Guidance', '2024-02-11 22:50:04'),
(13, 'Human Resource Office', 'Human Resource Office', '2024-02-11 22:50:25'),
(14, 'ITSO', 'ITSO', '2024-02-11 22:50:43'),
(15, 'Library', 'Library', '2024-02-11 22:51:03'),
(16, 'Purchasing', 'Purchasing', '2024-02-11 22:51:29'),
(17, 'Registrar', 'Registrar', '2024-02-11 22:51:54'),
(18, 'SDAO', 'SDAO', '2024-02-11 22:52:21'),
(19, 'Security', 'Security', '2024-02-11 22:52:32'),
(20, 'Treasury Office', 'Treasury Office', '2024-02-11 22:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(30) NOT NULL,
  `department_id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `department_id`, `firstname`, `lastname`, `middlename`, `contact`, `address`, `email`, `password`, `date_created`) VALUES
(1, 14, 'Mark', 'rangel', 'Angelo', '09135451842', 'Sunrise village Blk 2 lot 13', 'markangelo@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-02-22 11:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(30) NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `room` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=Pending,1=on process,2= Closed',
  `department_id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `staff_id` int(30) NOT NULL,
  `admin_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `archived_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `subject`, `description`, `room`, `status`, `department_id`, `category_id`, `customer_id`, `staff_id`, `admin_id`, `date_created`, `archived_date`) VALUES
(1, 'Missing letter L keybaord', '&lt;p&gt;Missing Letter L in keyboard pc 11&lt;/p&gt;', 'Romm 425 Complab 1', 2, 14, 5, 3, 0, 0, '2024-02-29 00:25:26', NULL),
(2, 'Suspicious Email', '&lt;p&gt;Suspicious link and asking for personal details&lt;/p&gt;', 'room 428', 0, 14, 9, 3, 0, 0, '2024-02-29 00:26:23', NULL),
(3, 'No internet', '&lt;p&gt;No internet connection in pc 1 and pc 14&lt;/p&gt;', 'Room 426', 0, 14, 8, 3, 0, 0, '2024-02-29 00:26:49', NULL),
(4, 'Missing hdmi cable', 'There is no HDMI cable&amp;nbsp; connected to the TV', 'room 427', 0, 14, 3, 3, 0, 0, '2024-02-29 00:30:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '1 = Admin,2=support',
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `role`, `username`, `password`, `date_created`) VALUES
(1, 'Administrator', '', '', 1, 'admin', '0192023a7bbd73250516f069df18b500', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
