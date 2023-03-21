-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2021 at 08:06 AM
-- Server version: 5.7.36-0ubuntu0.18.04.1
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
-- Table structure for table `zone_click_statistic`
--

CREATE TABLE `zone_click_statistic` (
  `id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_messages`
--

CREATE TABLE `zone_messages` (
  `id` bigint(20) NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `pin` smallint(1) NOT NULL DEFAULT '0',
  `storage` smallint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_search_statistic`
--

CREATE TABLE `zone_search_statistic` (
  `id` int(11) NOT NULL,
  `unit_price_low` int(11) NOT NULL,
  `unit_price_high` int(11) NOT NULL,
  `total_price_low` int(11) NOT NULL,
  `total_price_high` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_low` int(11) NOT NULL,
  `area_high` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `zone_click_statistic`
--
ALTER TABLE `zone_click_statistic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_messages`
--
ALTER TABLE `zone_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_search_statistic`
--
ALTER TABLE `zone_search_statistic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zone_click_statistic`
--
ALTER TABLE `zone_click_statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;
--
-- AUTO_INCREMENT for table `zone_messages`
--
ALTER TABLE `zone_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `zone_search_statistic`
--
ALTER TABLE `zone_search_statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
