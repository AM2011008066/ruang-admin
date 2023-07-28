-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2023 at 07:13 AM
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
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`) VALUES
(12, 'Premium', 1),
(13, 'General', 1),
(14, 'Promotion/Event', 1),
(15, 'Test 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `incoming`
--

CREATE TABLE `incoming` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `media` varchar(250) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incoming`
--

INSERT INTO `incoming` (`id`, `user_id`, `item_id`, `quantity`, `media`, `date`, `description`) VALUES
(34, 1, 38, 100, 'event.png', '2023-03-27 20:12:54', 'test 8');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `quantity`, `categorie_id`, `date`) VALUES
(15, 'Plag', 201, 12, '2023-03-09'),
(16, 'Keychain', 1000, 13, '2023-03-09'),
(18, 'Table', 4, 14, '2023-03-16'),
(19, 'Paperbag', 1000, 12, '2023-03-17'),
(20, 'Tumbler', 100, 12, '2023-03-17'),
(21, 'Power Bank', 50, 12, '2023-03-17'),
(22, 'Facemask', 5000, 13, '2023-03-17'),
(23, 'Pen', 5000, 13, '2023-03-17'),
(24, 'Woven bag', 1000, 13, '2023-03-17'),
(25, 'Notebook', 1000, 13, '2023-03-17'),
(26, 'Stool', 4, 14, '2023-03-17'),
(27, 'Backdrop (large)', 2, 14, '2023-03-17'),
(28, 'LED Screen', 4, 14, '2023-03-17'),
(29, 'Flag', 2, 14, '2023-03-17'),
(30, 'Table Cloth', 4, 14, '2023-03-17'),
(31, 'Brochure Rack', 4, 14, '2023-03-17'),
(32, 'Table Rack', 4, 14, '2023-03-17'),
(33, 'Mini Pillow', 4, 14, '2023-03-17'),
(34, 'Table top', 4, 14, '2023-03-17'),
(38, 'Demo ', 590, 15, '2023-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `outgoing`
--

CREATE TABLE `outgoing` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `media` varchar(250) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outgoing`
--

INSERT INTO `outgoing` (`id`, `user_id`, `item_id`, `quantity`, `media`, `date`, `description`) VALUES
(19, 1, 38, 10, 'f.jpg', '2023-03-26 18:55:30', 'Test 2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(250) DEFAULT 'no_image.jpg',
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `user_level`, `image`, `last_login`) VALUES
(1, 'Muhammad Haniff Bin Hassan', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'haniff@kuptm.edu.my', 1, '5fxxfsjw1.png', '2023-04-03 07:35:20'),
(2, 'Nor Syuhaileyza Binti Shamsuddin ', 'Special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 'syuhaileyza@kuptm.edu.my', 4, 'no_image.png', '2021-04-04 19:53:26'),
(3, 'Zuhaida Binti Zaharuddin', 'Christ', '12dea96fec20593566ab75692c9949596833adc9', 'zuhaida@kuptm.edu.my', 3, 'no_image.png', '2021-04-04 19:54:46'),
(10, 'Islahuddin Bin Mohamad Kusran', 'islahuddin', 'f3440207ec7836b1df622daa967a11bea62711e7', 'Islahuddin@kuptm.edu.my', 2, 'ft2endj610.png', '2023-04-03 07:33:40'),
(11, 'Azizul Hakim Bin Misman', 'Stephen', '462822eefcb1c4f5fe5042228b65f91d7aad4d0b', 'azizul@kuptm.edu.my', 1, 'no_image.jpg', '2023-03-16 04:36:38'),
(12, 'Mohd Hafidzan Bin Yusof', 'hafidzan', '6f3d16d75d9b130ae13d28bc8ca6a1f172845156', 'hafidzan@kuptm.edu.my', 2, 'no_image.jpg', '2023-03-26 16:00:42'),
(13, 'Wan Mohd Syafiq Bin Samaun', 'Wan Syafiq', '409c272b47e9fb3874ef95339653064bf969e68e', 'Wanmohdsyafiq@kuptm.edu.my', 2, 'rcd6u0kw13.png', '2023-03-26 16:07:36'),
(14, 'Mohd Azidee Bin Mohamad Zin', 'azidee', '49029ac782d5fd8545dc70cc040437df44ad68c9', 'azidee@kuptm.edu.my', 2, 'no_image.jpg', '2023-03-19 07:23:47'),
(15, 'Mohamed Farhanuddean Bin Ahmad Najib', 'farhanuddean', 'b071f004347d4e8bc3b473fd1d8e63c3310395d6', 'farhanuddean@kuptm.edu.my', 3, 'no_image.jpg', '2023-03-19 07:23:19'),
(16, 'Mohamad Fairuz Bin Mohamad Khairi', 'fairuz', '7a330c9fab067ad78ae7b215283125b859ca8c6b', 'fairuz@kuptm.edu.my', 3, 'no_image.jpg', '2023-03-19 07:17:54'),
(17, 'Faridah Binti Ishak ', 'faridah', 'aa54c0d6183c9815d3b36c8bc7a7af253198db31', 'faridah@kuptm.edu.my', 4, 'no_image.jpg', '2023-03-19 07:17:17'),
(18, 'Mohd Hamsah Bin Salleh Ajih', 'Hamsah', 'd20521708e37426c2fcdf8e15c85c5ae235c97fb', 'Hamsah@kuptm.edu.my', 5, '3klhxq918.png', '2023-03-29 03:30:24'),
(30, 'Nasuha Bt Zakaria', 'Nasuha', '6658196a012a394d53fc3a904985cecebc83f203', 'Nasuha@gmail.com', 1, '37go1smb30.png', '2023-04-02 20:15:51'),
(37, 'Hamidah Bt Razak', 'hamidah', 'f3440207ec7836b1df622daa967a11bea62711e7', 'hamidah@gmail.com', 1, '4q81su7v37.png', '2023-04-03 07:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'Bahagian Pengambilan Pelajar Dan Pemasaran', 2, 1),
(5, 'Pejabat Pelajar Antarabangsa', 3, 1),
(6, 'Bahagian Pembangunan Perniagaan', 4, 1),
(7, 'Unit Perhubungan Korparat', 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `incoming`
--
ALTER TABLE `incoming`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Indexes for table `outgoing`
--
ALTER TABLE `outgoing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `incoming`
--
ALTER TABLE `incoming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `outgoing`
--
ALTER TABLE `outgoing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
