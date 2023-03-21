-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 02:54 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `incourt`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_list`
--

CREATE TABLE `booking_list` (
  `id` int(30) NOT NULL,
  `ref_code` varchar(100) NOT NULL,
  `client_id` int(30) NOT NULL,
  `facility_id` int(30) NOT NULL,
  `date_to` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `hours` int(2) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = Pending,\r\n1 = Confirmed,\r\n2 = Done,\r\n3 = Cancelled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_list`
--

INSERT INTO `booking_list` (`id`, `ref_code`, `client_id`, `facility_id`, `date_to`, `start_time`, `end_time`, `hours`, `status`, `date_created`, `date_updated`) VALUES
(1, '202302-00001', 32, 1, '2023-02-20', '21:20:00', '22:20:00', 2, 0, '2023-02-05 03:11:36', '2023-02-19 21:20:57'),
(2, '202302-00002', 32, 2, '2023-02-17', '12:19:00', '13:19:00', 1, 3, '2023-02-05 12:19:17', '2023-02-19 22:02:04'),
(3, '202302-00003', 32, 1, '2023-02-20', '12:55:00', '13:55:00', 1, 1, '2023-02-05 12:55:38', '2023-02-05 13:12:12'),
(4, '202302-00004', 32, 1, '2023-02-20', '00:54:00', '01:54:00', 1, 0, '2023-02-06 11:54:52', NULL),
(5, '202302-00005', 32, 1, '2023-02-20', '00:55:00', '01:55:00', 1, 0, '2023-02-06 11:57:45', NULL),
(12, '202302-00006', 26, 2, '2023-02-21', '17:04:00', '19:04:00', 2, 1, '2023-02-19 22:05:35', '2023-02-19 22:05:56'),
(15, '202302-00007', 26, 1, '2023-02-25', '17:26:00', '19:26:00', 2, 0, '2023-02-24 14:27:03', NULL),
(16, '202303-00001', 38, 1, '2023-03-23', '09:00:00', '11:00:00', 2, 0, '2023-03-12 20:34:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `delete_flag`, `status`, `date_created`, `date_updated`) VALUES
(1, 'BasketBall', '', 0, 1, '2022-03-23 10:34:53', '2023-02-19 21:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `client_list`
--

CREATE TABLE `client_list` (
  `id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `gender` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image_path` text DEFAULT NULL,
  `verification_code` text NOT NULL,
  `email_status` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_added` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`id`, `fullname`, `gender`, `contact`, `address`, `email`, `password`, `image_path`, `verification_code`, `email_status`, `status`, `delete_flag`, `date_created`, `date_added`) VALUES
(7, 'Boom, Shak', 'Female', '6547457', 'hrhdh', 'cha3@gmail.com', 'c2477f223c3c4ca19a5029e0cd91fda8', NULL, '', '', 1, 1, '2022-11-10 01:16:06', '2022-11-10 01:48:41'),
(19, 'Charie Lobo', 'Female', '0932432542', '#Poong bato', 'charie@gmail.com', '26061b02560666c8c5ef966232df4fe3', NULL, '', '', 1, 1, '2022-11-28 15:57:02', '2023-02-19 21:47:29'),
(25, 'leng', 'Female', '09643', '#purok', 'leng@gmail.com', '26061b02560666c8c5ef966232df4fe3', NULL, '', '', 1, 0, '2023-01-07 17:42:31', NULL),
(26, 'Too Long', 'Female', '0964643', '#purok', 'long@gmail.com', '26061b02560666c8c5ef966232df4fe3', NULL, '', '', 1, 0, '2023-01-07 17:43:51', '2023-01-29 12:29:34'),
(32, 'Kim Sejun', 'Male', '09123456789', 'South Korea', 'kimsejun@gmail.com', '0b6dce842e2c1546827cfae22ce98710', NULL, '', '', 1, 0, '2023-02-05 03:09:52', NULL),
(33, 'Admin', 'Male', '09123456789', 'Philippines', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '', '', 1, 0, '2023-02-08 13:08:42', NULL),
(38, 'Charie Ignacio', 'Female', '09324325422', '#49 no where', 'charieignacio3@gmail.com', '$2y$10$a5aAOLFtl.JgbgZW9LoZKuamjMz5bzMEH4uTjOFCwkMAgq1pjSafm', NULL, '357502', 'verified', 1, 0, '2023-03-12 20:32:52', '2023-03-20 20:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `facility_list`
--

CREATE TABLE `facility_list` (
  `id` int(30) NOT NULL,
  `facility_code` varchar(100) NOT NULL,
  `category_id` int(30) NOT NULL,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facility_list`
--

INSERT INTO `facility_list` (`id`, `facility_code`, `category_id`, `image_path`, `status`, `delete_flag`, `date_created`, `date_updated`, `name`, `description`, `price`) VALUES
(1, '202203-00001', 1, 'uploads/facility/1.png?v=1669914471', 1, 0, '2022-03-23 11:07:02', '2023-02-19 21:49:44', 'Court Only', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">No Lights and other utilities.</p>', 250),
(2, '202203-00002', 1, 'uploads/facility/2.png?v=1669914563', 1, 0, '2022-03-23 11:44:34', '2023-02-19 21:49:55', 'Court w/ Utilities', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Kalaklan basketball court you can request for lights or other utilities.</p>', 450);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Barangay Kalaklan Court'),
(6, 'short_name', 'InCourt'),
(11, 'logo', 'uploads/system-logo.png?v=1669888827'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/system-cover.png?v=1670058700');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Rodell', 'Basalla', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'uploads/1624240500_avatar.png', NULL, 1, '2021-01-20 14:02:37', '2023-01-07 21:33:50'),
(10, 'Claire', 'Blake', 'blake', '26061b02560666c8c5ef966232df4fe3', 'uploads/avatar-10.png?v=1648021481', NULL, 2, '2022-03-23 15:44:41', '2023-03-15 21:26:40'),
(13, 'Dave', 'Moe', 'sher', '26061b02560666c8c5ef966232df4fe3', 'uploads/avatar-13.png?v=1670570654', NULL, 2, '2022-12-09 15:24:14', '2023-03-15 18:58:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_list`
--
ALTER TABLE `booking_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cab_id` (`facility_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `facility_list`
--
ALTER TABLE `facility_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
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
-- AUTO_INCREMENT for table `booking_list`
--
ALTER TABLE `booking_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `facility_list`
--
ALTER TABLE `facility_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_list`
--
ALTER TABLE `booking_list`
  ADD CONSTRAINT `booking_list_ibfk_1` FOREIGN KEY (`facility_id`) REFERENCES `facility_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_list_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `facility_list`
--
ALTER TABLE `facility_list`
  ADD CONSTRAINT `facility_list_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
