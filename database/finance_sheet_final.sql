-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2022 at 12:25 PM
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
-- Table structure for table `finance_sheet`
--

CREATE TABLE `finance_sheet` (
  `id` int(11) NOT NULL,
  `stt` int(11) NOT NULL DEFAULT '0',
  `root_id` int(11) NOT NULL DEFAULT '0',
  `last_id` int(11) NOT NULL DEFAULT '0',
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `amount` bigint(16) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `sender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `finance_sheet`
--

INSERT INTO `finance_sheet` (`id`, `stt`, `root_id`, `last_id`, `title`, `description`, `amount`, `date`, `sender`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 'THU', '.', 100000000, '2022-01-27', '17', 1, '2022-01-27 09:22:58', '2022-01-27 09:22:58'),
(2, 2, 0, 0, 'CHI', '.', 140000000, '2022-01-01', '17', 1, '2022-01-27 09:23:17', '2022-01-27 09:23:17'),
(3, 3, 0, 0, 'TÀI SẢN', 'TÀI SẢN', 1000000000, '2022-01-01', '17', 1, '2022-01-27 09:23:30', '2022-01-27 09:23:30'),
(4, 4, 0, 0, 'PHẢI THU', 'PHẢI THU', 2000000000, '2022-01-01', '17', 1, '2022-01-27 09:23:53', '2022-01-27 09:23:53'),
(5, 5, 0, 0, 'PHẢI TRẢ', 'PHẢI TRẢ', 1000000000, '2022-01-27', '17', 1, '2022-01-27 09:24:08', '2022-01-27 09:24:08'),
(6, 6, 0, 0, 'TIỀN', 'TIỀN', -40000000, '2022-01-01', '17', 2, '2022-01-27 09:24:32', '2022-01-27 09:24:32'),
(7, 1, 1, 1, 'Vốn góp cổ đông', 'Vốn góp cổ đông', 100000000, '2022-01-01', '17', 1, '2022-01-27 09:40:15', '2022-01-27 09:40:15'),
(8, 2, 1, 1, 'Khách hàng', 'Khách hàng', 0, '2022-01-06', '17', 1, '2022-01-27 09:45:33', '2022-01-27 09:45:33'),
(9, 0, 1, 8, 'Đặt cọc', 'Đặt cọc', 0, '2022-01-01', '17', 1, '2022-01-27 09:52:27', '2022-01-27 09:52:27'),
(10, 0, 1, 8, 'Thanh toán', 'Thanh toán', 0, '2022-01-01', '17', 1, '2022-01-27 09:52:50', '2022-01-27 09:52:50'),
(11, 3, 1, 1, 'Vay / Huy động', 'Vay / Huy động', 0, '2022-01-01', '17', 1, '2022-01-27 23:41:43', '2022-01-27 23:41:43'),
(12, 0, 1, 11, 'Ngân hàng', 'Ngân hàng', 0, '2022-01-01', '17', 1, '2022-01-27 23:42:13', '2022-01-27 23:42:13'),
(13, 0, 1, 11, 'Đối tác', 'Đối tác', 0, '2022-01-01', '17', 1, '2022-01-27 23:42:27', '2022-01-27 23:42:27'),
(14, 0, 1, 11, 'Khác', 'Khác', 0, '2022-01-01', '17', 1, '2022-01-27 23:42:45', '2022-01-27 23:42:45'),
(15, 4, 1, 1, 'Thu khác', '1', 0, '2022-01-01', '17', 1, '2022-01-27 23:43:05', '2022-01-27 23:43:05'),
(16, 1, 2, 2, 'Giải phòng mặt bằng', 'Giải phòng mặt bằng', 0, '2022-01-01', '17', 1, '2022-01-27 23:43:33', '2022-01-27 23:43:33'),
(17, 2, 2, 2, 'Nhà thầu', 'Nhà thầu', 0, '2022-01-01', '17', 1, '2022-01-27 23:43:51', '2022-01-27 23:43:51'),
(18, 0, 2, 17, 'Tư vấn', 'Tư vấn', 0, '2022-01-01', '17', 1, '2022-01-27 23:44:09', '2022-01-27 23:44:09'),
(19, 0, 2, 17, 'Cây xanh', 'Cây xanh', 0, '2022-01-01', '17', 1, '2022-01-27 23:44:56', '2022-01-27 23:44:56'),
(20, 0, 2, 17, 'Hạ tầng', 'Hạ tầng', 0, '2022-01-01', '17', 1, '2022-01-27 23:45:08', '2022-01-27 23:45:08'),
(21, 0, 2, 17, 'Nhà xây thô', 'Nhà xây thô', 0, '2022-01-01', '17', 1, '2022-01-27 23:45:27', '2022-01-27 23:45:27'),
(22, 0, 2, 17, 'Nội thất', 'Nội thất', 0, '2022-01-01', '17', 1, '2022-01-27 23:45:41', '2022-01-27 23:45:41'),
(23, 0, 2, 17, 'Khác', 'Khác', 0, '2022-01-01', '17', 1, '2022-01-27 23:45:54', '2022-01-27 23:45:54'),
(24, 3, 3, 2, 'PTDA/ngoại giao', 'PTDA/ngoại giao', 0, '2022-01-01', '17', 1, '2022-01-27 23:46:09', '2022-01-27 23:46:09'),
(25, 4, 4, 2, 'Chi hoạt động vp', 'Chi hoạt động vp', 140000000, '2022-01-01', '17', 1, '2022-01-27 23:46:27', '2022-01-27 23:46:27'),
(26, 0, 2, 25, 'Nhà cửa/văn phòng', 'Nhà cửa/văn phòng', 0, '2022-01-01', '17', 1, '2022-01-27 23:46:49', '2022-01-27 23:46:49'),
(27, 0, 2, 25, 'Máy móc, thiết bị', 'Máy móc, thiết bị', 140000000, '2022-01-01', '17', 1, '2022-01-27 23:47:09', '2022-01-27 23:47:09'),
(28, 0, 2, 25, 'Phương tiện đi lại', 'Phương tiện đi lại', 0, '2022-01-01', '17', 1, '2022-01-27 23:47:27', '2022-01-27 23:47:27'),
(29, 5, 2, 2, 'Khác', 'Khác', 0, '2022-01-01', '17', 1, '2022-01-27 23:48:21', '2022-01-27 23:48:21'),
(30, 1, 3, 3, 'Bất động sản', 'Bất động sản', 1000000000, '2022-01-01', '17', 1, '2022-01-27 23:48:50', '2022-01-27 23:48:50'),
(31, 2, 3, 3, 'Nhà cửa/văn phòng', 'Nhà cửa/văn phòng', 0, '2022-01-01', '17', 1, '2022-01-27 23:49:05', '2022-01-27 23:49:05'),
(32, 3, 3, 3, 'Máy móc, thiết bị', 'Máy móc, thiết bị', 0, '2022-01-01', '17', 1, '2022-01-27 23:49:23', '2022-01-27 23:49:23'),
(33, 4, 3, 3, 'Phương tiện đi lại', 'Phương tiện đi lại', 0, '2022-01-01', '17', 1, '2022-01-27 23:49:35', '2022-01-27 23:49:35'),
(34, 1, 4, 4, 'Khách hàng', 'Khách hàng', 2000000000, '2022-01-01', '17', 1, '2022-01-27 23:49:53', '2022-01-27 23:49:53'),
(35, 2, 4, 4, 'Nhà thầu', 'Theo hợp đồng', 0, '2022-01-01', '17', 1, '2022-01-27 23:50:17', '2022-01-27 23:50:17'),
(36, 3, 4, 4, 'Khác', 'Theo hợp đồng', 0, '2022-01-01', '17', 1, '2022-01-27 23:50:38', '2022-01-27 23:50:38'),
(37, 1, 5, 5, 'Khách hàng', 'Theo hợp đồng', 0, '2022-01-01', '17', 1, '2022-01-27 23:51:02', '2022-01-27 23:51:02'),
(38, 2, 5, 5, 'Nhà thầu', 'Theo hợp đồng', 1000000000, '2022-01-01', '17', 1, '2022-01-27 23:51:14', '2022-01-27 23:51:14'),
(39, 3, 5, 5, 'Khác', 'Theo hợp đồng', 0, '2022-01-01', '17', 1, '2022-01-27 23:51:41', '2022-01-27 23:51:41'),
(41, 0, 2, 27, 'phần mềm quản lý', 'Theo hợp đồng', 140000000, '2022-01-01', '17', 0, '2022-01-28 00:13:56', '2022-01-28 00:13:56'),
(42, 0, 3, 30, 'vp công ty', 'v[p', 1000000000, '2022-01-28', '17', 0, '2022-01-28 00:55:06', '2022-01-28 00:55:06'),
(43, 0, 1, 7, 'ông AVG', 'avf', 100000000, '2022-01-28', '17', 0, '2022-01-28 00:55:35', '2022-01-28 00:55:35'),
(45, 0, 4, 34, 'Tiền cọc NVA', 'Tiền cọc NVA', 1000000000, '2022-02-03', '17', 0, '2022-02-03 04:54:14', '2022-02-03 04:54:14'),
(46, 0, 5, 38, 'Nhà thầu A', 'Nhà thầu A', 1000000000, '2022-02-03', '17', 0, '2022-02-03 04:54:45', '2022-02-03 04:54:45'),
(47, 0, 4, 34, 'tiền cọc NVB', 'tiền cọc NVB', 1000000000, '2022-02-03', '17', 0, '2022-02-03 05:04:26', '2022-02-03 05:04:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `finance_sheet`
--
ALTER TABLE `finance_sheet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `finance_sheet`
--
ALTER TABLE `finance_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;