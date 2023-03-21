-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2022 at 10:02 AM
-- Server version: 5.7.37-0ubuntu0.18.04.1
-- PHP Version: 7.3.31-2+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dongduong`
--

-- --------------------------------------------------------

--
-- Table structure for table `building_messages`
--

CREATE TABLE `building_messages` (
  `id` bigint(20) NOT NULL,
  `building_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `pin` smallint(1) NOT NULL DEFAULT '0',
  `storage` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `building_messages`
--

INSERT INTO `building_messages` (`id`, `building_id`, `user_id`, `body`, `attachment`, `seen`, `pin`, `storage`, `created_at`, `updated_at`) VALUES
(1, 1, 17, '123\r\n1', NULL, 0, 1, 0, '2022-01-15 03:48:14', '2022-01-15 03:48:14'),
(2, 1, 17, '25124', NULL, 0, 1, 0, '2022-01-15 03:48:14', '2022-01-15 03:48:14'),
(4, 1, 17, NULL, '40e45f42-04c7-496b-be82-0a8fb5b6820b.png,Screenshot from 2022-01-13 20-31-22.png', 0, 0, 1, '2022-01-15 08:22:12', '2022-01-15 08:22:12'),
(5, 1, 17, NULL, '6470ed70-4042-454f-9461-34076aca41f2.png,Screenshot from 2022-01-13 17-29-34.png', 0, 0, 0, '2022-01-15 08:22:23', '2022-01-15 08:22:23'),
(6, 1, 17, NULL, 'af0b3ac8-508e-4e3b-b46a-d79370d530a3.png,Screenshot from 2022-01-13 20-31-22.png', 0, 1, 1, '2022-01-15 08:26:46', '2022-01-15 08:26:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building_messages`
--
ALTER TABLE `building_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building_messages`
--
ALTER TABLE `building_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
