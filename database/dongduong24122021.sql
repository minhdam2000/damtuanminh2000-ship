-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2021 at 08:49 PM
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
-- Table structure for table `finance_asset`
--

CREATE TABLE `finance_asset` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(560) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `amount` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `finance_asset`
--

INSERT INTO `finance_asset` (`id`, `user_id`, `title`, `description`, `type`, `amount`, `date`, `updated_at`, `created_at`) VALUES
(1, 17, 'ô tô honda', 'test', 1, '1000000000', '2021-12-01', '2021-12-20 06:22:12', '2021-12-20 06:22:12'),
(2, 17, 'văn phòng', 'oek', 2, '1000000000', '2021-12-08', '2021-12-20 06:26:41', '2021-12-20 06:26:41'),
(3, 17, 'Tiền góp vốn', 'test', 1, '1000000000000', '2021-12-20', '2021-12-20 08:08:03', '2021-12-20 08:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `finance_asset_type`
--

CREATE TABLE `finance_asset_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `finance_asset_type`
--

INSERT INTO `finance_asset_type` (`id`, `name`, `description`, `updated_at`, `created_at`) VALUES
(1, 'Phương tiện đi lại', NULL, '2021-12-20 06:18:31', '2021-12-20 06:18:31'),
(2, 'Văn phòng', NULL, '2021-12-20 06:18:31', '2021-12-20 06:18:31'),
(3, 'Tiền mặt', NULL, '2021-12-20 08:07:23', '2021-12-20 08:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `finance_dept`
--

CREATE TABLE `finance_dept` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(560) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `amount` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `finance_dept`
--

INSERT INTO `finance_dept` (`id`, `user_id`, `title`, `description`, `type`, `amount`, `date`, `updated_at`, `created_at`) VALUES
(1, 17, 'Hợp đồng A', 'Cập nhật móng nhà', 1, '1000000000', '2021-12-16', '2021-12-20 06:31:44', '2021-12-20 06:31:44'),
(2, 17, 'Hợp đồng B', '124124', 1, '4000000000', '2021-12-05', '2021-12-20 06:32:04', '2021-12-20 06:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `finance_dept_type`
--

CREATE TABLE `finance_dept_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `finance_dept_type`
--

INSERT INTO `finance_dept_type` (`id`, `name`, `description`, `updated_at`, `created_at`) VALUES
(1, 'Nợ hợp đồng', NULL, '2021-12-20 06:17:59', '2021-12-20 06:17:59'),
(2, 'Nợ tài sản', NULL, '2021-12-20 06:17:59', '2021-12-20 06:17:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `finance_asset`
--
ALTER TABLE `finance_asset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_asset_type`
--
ALTER TABLE `finance_asset_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_dept`
--
ALTER TABLE `finance_dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_dept_type`
--
ALTER TABLE `finance_dept_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `finance_asset`
--
ALTER TABLE `finance_asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `finance_asset_type`
--
ALTER TABLE `finance_asset_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `finance_dept`
--
ALTER TABLE `finance_dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `finance_dept_type`
--
ALTER TABLE `finance_dept_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
