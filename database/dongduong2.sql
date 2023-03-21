-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2021 at 09:13 AM
-- Server version: 5.7.36-0ubuntu0.18.04.1
-- PHP Version: 7.3.31-2+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dongduong2`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountant`
--

CREATE TABLE `accountant` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` int(15) NOT NULL,
  `identify_card` int(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accountant`
--

INSERT INTO `accountant` (`id`, `user_id`, `name`, `phone_number`, `identify_card`, `created_at`, `updated_at`) VALUES
(1, 16, 'Nguyễn Trúc Cầm', 123123123, 12412124, '2020-11-27 04:13:09', '2020-11-27 04:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `name`, `des`, `created_at`, `updated_at`) VALUES
(1, 'rzm', 'detect_zone', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zone` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `display` int(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `project_id`, `name`, `description`, `url`, `zone`, `display`, `updated_at`, `created_at`) VALUES
(8, 1, 'd4', '4.png', '4.png', '\"577.6043998209376,301.3365735115432,500.35172987145876,340.7303191149198,473.7481614120356,478.35262518385883,671.740103600435,514.1651211869284,700.3901004028907,517.2347637014773\"', 0, '2020-12-07 12:44:29', '2020-12-07 12:44:29'),
(9, 1, 'd5', '5.png', '5.png', '\"293.15086013941294,329.98657031399887,219.99104687599925,414.91334654984973,447.1445929526124,463.00441261111473,480.9106606126495,457.37673466777517,499.3285156999425,370.9151371746499\"', 0, '2020-12-07 12:45:21', '2020-12-07 12:45:21'),
(10, 1, 'd6', '6.png', '6.png', '\"292.63925305365484,326.91692779945004,227.15354607661317,401.61156232013815,126.87855726801817,220.5026539617574,141.71516275500417,188.78301464475285,238.4089019632922,222.54908230478995\"', 1, '2020-12-07 12:46:05', '2020-12-07 12:46:05'),
(12, 1, 'd1', '1.png', '1.png', '\"155.5285540704739,125.34373601074375,141.71516275500417,184.1785508729296,241.47854447784104,221.01426104751553,427.7035236938032,176.50444458655753,433.8428087229008,84.41516915009274,461.4695913538403,70.60177783462302,431.7963803798683,22.510711773358064,157.57498241350643,121.7624864104368\"', 0, '2020-12-07 13:34:31', '2020-12-07 13:34:31'),
(13, 1, 'd2', '2.png', '2.png', '\"452.7722708959519,72.64820617765557,433.8428087229008,85.43838332160901,425.65709535077065,181.10890835838077,452.7722708959519,227.66515316237133,528.4901195881563,193.38747841657607,462.4928055253566,70.60177783462302\"', 1, '2020-12-07 13:34:53', '2020-12-07 13:34:53'),
(14, 1, 'd3', '3.png', '3.png', '\"522.8624416448168,193.89908550233423,453.2838779817101,228.68836733388758,501.8865511287332,334.07942700006396,583.232077764277,297.7553239112362\"', 1, '2020-12-07 13:35:13', '2020-12-07 13:35:13'),
(15, 1, 'Văn phòng công ty Đông dương - Thăng long', 'văn phòng', NULL, '\"460.91017612934303,420.699909945758,449.8523529288571,462.92068943852223,473.9785126390081,450.85760958344673,479.00479591195625,425.22356489141134\"', 0, '2021-03-30 09:25:07', '2021-03-30 09:25:07'),
(17, 4, 'hv1', 'hv1', 'hv1.png', '\"35.614179719703216,58.7633965375103,9.497114591920857,256.42209398186316,39.76916735366859,265.32563891178893,430.33800494641383,194.09727947238252,427.96372629843364,94.97114591920857\"', 0, '2021-10-05 10:15:48', '2021-10-05 10:15:48'),
(18, 4, 'hv2', 'hv2', 'hv2.png', '\"69.44765045342128,283.72629843363563,506.31492168178073,243.957131079967,354.95465787304204,476.04286892003296,270.6677658697444,474.2621599340478\"', 0, '2021-10-05 10:16:13', '2021-10-05 10:16:13'),
(19, 4, 'hv3', 'hv3', 'hv3.png', '\"597.7246496290189,125.24319868095631,477.23000824402305,303.3140972794724,597.1310799670239,355.5482275350371,713.4707337180544,147.79884583676835,598.318219291014,122.27535037098104\"', 0, '2021-10-05 10:16:38', '2021-10-05 10:16:38'),
(20, 2, 'xa2-1', 'xa2-1', 'xa2-1.png', '\"43.92415498763396,299.75267930750204,130.5853256389118,377.5103050288541,296.19126133553175,297.37840065952184,235.0535861500412,176.88375927452597\"', 0, '2021-10-05 08:14:19', '2021-10-05 08:14:19'),
(21, 2, 'xa2-2', 'xa2-2', 'xa2-2.png', '\"211.90436933223413,123.46248969497114,290.84913437757626,293.8169826875515,514.0313272877164,187.56801319043694\"', 0, '2021-10-05 08:15:11', '2021-10-05 08:15:11'),
(22, 2, 'xa2-3', 'xa2-3', 'xa2-3.png', '\"296.19126133553175,289.0684253915911,293.8169826875515,314.5919208573784,343.676834295136,423.80873866446825,382.85243198680956,435.08656224237427,499.19208573784005,371.57460840890354,423.80873866446825,231.4921681780709\"', 0, '2021-10-05 08:15:40', '2021-10-05 08:15:39'),
(23, 2, 'xa2-4', 'xa2-4', 'xa2-4.png', '\"426.77658697444355,229.71145919208573,514.6248969497115,188.161582852432,602.4732069249794,211.31079967023908,644.0230832646331,306.8755152514427,505.7213520197856,370.38746908491345\"', 0, '2021-10-05 08:16:07', '2021-10-05 08:16:07'),
(24, 3, 'hb1', 'test', 'test.png', '\"91.86477644492912,427.1319520174482,419.28026172300986,323.88222464558345,463.2497273718648,115.8124318429662,222.20283533260633,105.21264994547438,56.9247546346783,223.3805888767721\"', 0, '2021-10-12 06:53:04', '2021-10-12 06:53:04'),
(25, 3, 'hbf2', 'hbf2', 'hbf2.png', '\"439.41875825627477,341.45310435931304,112.23249669749009,579.7093791281374,377.1202113606341,875.0330250990753,605.3896961690884,875.5085865257596,691.4663143989432,603.4874504623514\"', 0, '2021-10-12 18:09:05', '2021-10-12 18:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `big_process`
--

CREATE TABLE `big_process` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `curstep` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `big_process`
--

INSERT INTO `big_process` (`id`, `name`, `curstep`, `created_at`, `updated_at`) VALUES
(1, 'Quy trình bán hàng', 1, '2020-12-26 05:09:59', '2020-12-26 05:09:59'),
(2, 'Khung pháp lý dự án', 1, '2020-12-28 06:39:59', '2020-12-28 06:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `big_process_step`
--

CREATE TABLE `big_process_step` (
  `id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `pos` int(11) NOT NULL,
  `case_num` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `big_process_step`
--

INSERT INTO `big_process_step` (`id`, `process_id`, `step_id`, `pos`, `case_num`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2020-12-26 05:15:58', '2020-12-26 05:15:58'),
(3, 1, 2, 2, 1, '2020-12-26 06:53:26', '2020-12-26 06:53:26'),
(4, 2, 3, 1, 1, '2020-12-28 06:42:21', '2020-12-28 06:42:21'),
(5, 2, 4, 2, 1, '2020-12-28 06:42:21', '2020-12-28 06:42:21'),
(6, 2, 5, 3, 1, '2020-12-28 06:42:34', '2020-12-28 06:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `big_step`
--

CREATE TABLE `big_step` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci NOT NULL,
  `legal` text COLLATE utf8_unicode_ci,
  `action` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `big_step`
--

INSERT INTO `big_step` (`id`, `state`, `name`, `des`, `legal`, `action`, `created_at`, `updated_at`) VALUES
(1, 0, 'Chuẩn bị dự án', '1', NULL, 'Hoàn Thành', '2020-12-26 05:15:25', '2020-12-26 05:15:25'),
(2, 0, 'Bán hàng', '1', NULL, 'Khởi tạo', '2020-12-26 05:15:25', '2020-12-26 05:15:25'),
(3, 1, 'Chuẩn bị đầu tư', '1', NULL, 'Hoàn tất', '2020-12-28 06:40:51', '2020-12-28 06:40:51'),
(4, 0, 'Đầu tư', '1', NULL, 'Hoàn tất', '2020-12-28 06:40:51', '2020-12-28 06:40:51'),
(5, 0, 'Kết thúc đầu tư, bàn giao', '1', NULL, 'Hoàn tất', '2020-12-28 06:41:14', '2020-12-28 06:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `big_step_to_process`
--

CREATE TABLE `big_step_to_process` (
  `id` int(11) NOT NULL,
  `big_step_id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `big_step_to_process`
--

INSERT INTO `big_step_to_process` (`id`, `big_step_id`, `process_id`, `created_at`, `updated_at`) VALUES
(1, 1, 8, '2020-12-27 12:42:44', '2020-12-27 12:42:44'),
(2, 1, 9, '2020-12-27 12:42:44', '2020-12-27 12:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `bosses`
--

CREATE TABLE `bosses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bosses`
--

INSERT INTO `bosses` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 18, 'Nguyễn Đình Chiến', '2020-12-08 10:31:10', '2020-12-08 10:31:10'),
(2, 20, 'dung truong1', '2021-01-15 03:08:16', '2021-01-15 03:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `buiding_contract`
--

CREATE TABLE `buiding_contract` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `contractor_id` int(11) NOT NULL,
  `doc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `mpp` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `buiding_contract`
--

INSERT INTO `buiding_contract` (`id`, `project_id`, `contractor_id`, `doc`, `mpp`, `amount`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '/storage/contribute/MsFa7b7qRbRtflqMvecorcklKAxVRuu4AVX0uuJH.png', '/storage/contribute/Vu6IYEaDrRINWBOl4t7JSj3RV4BB7JzpgOX6HJyu.png', '100000000000', 'Hơp đồng điện', '2021-05-20 15:06:38', '2021-05-20 15:06:38');

-- --------------------------------------------------------

--
-- Table structure for table `building_history`
--

CREATE TABLE `building_history` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `machine` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lead` int(11) DEFAULT NULL,
  `worker` int(11) DEFAULT NULL,
  `input` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acceptance` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `vstm` int(11) NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_history_img`
--

CREATE TABLE `building_history_img` (
  `id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url_small` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_history_tag`
--

CREATE TABLE `building_history_tag` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_job`
--

CREATE TABLE `building_job` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `level` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `pre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ss` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fs` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delay` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `real_percent` float NOT NULL DEFAULT '0',
  `acceptance_percent` float DEFAULT NULL,
  `acceptance_status` smallint(1) NOT NULL,
  `payment_percent` float DEFAULT NULL,
  `payment_status` smallint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `building_job`
--

INSERT INTO `building_job` (`id`, `project_id`, `name`, `duration`, `start`, `end`, `level`, `task_id`, `pre`, `ss`, `fs`, `delay`, `note`, `real_percent`, `acceptance_percent`, `acceptance_status`, `payment_percent`, `payment_status`, `created_at`, `updated_at`) VALUES
(267, 4, 'TIẾN ĐỘ THI CÔNG HỘI VÂN (17 HECTA)', 465, '2021-05-31', '2022-05-31', '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, '2021-05-26 14:41:02', '2021-05-26 14:41:02'),
(268, 4, 'TIẾN ĐỘ THI CÔNG HỘI VÂN (24 HECTA DỊCH VỤ)', 365, '2021-05-31', '2022-05-31', '0', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, '2021-05-26 14:41:34', '2021-05-26 14:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Kinh doanh', '2019-05-14 10:28:25', '2019-05-14 10:28:25'),
(2, 'Hệ thống', '2019-05-14 10:28:30', '2019-05-14 10:28:30'),
(10, 'Pháp lý', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `var` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `value` float NOT NULL,
  `dept_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `var`, `name`, `value`, `dept_id`, `created_at`, `updated_at`) VALUES
(2, 'deposit1', 'Hoa hồng loại 1', 7, 1, '2021-03-22 08:16:01', '2021-03-22 08:16:01'),
(3, 'deposit2', 'Hoa hồng loại 2', 10, 1, '2021-03-22 08:16:30', '2021-03-22 08:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `consumer`
--

CREATE TABLE `consumer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identify_card` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iden_date` date DEFAULT NULL,
  `iden_location` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `married` smallint(1) NOT NULL DEFAULT '1',
  `married_role` smallint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consumer2`
--

CREATE TABLE `consumer2` (
  `id` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identify_card` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iden_date` date DEFAULT NULL,
  `iden_location` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contractors`
--

CREATE TABLE `contractors` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `proxy` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contractors`
--

INSERT INTO `contractors` (`id`, `name`, `proxy`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Nhà thầu A', 'mrT', '567856654', '2021-05-20 08:28:25', '2021-05-20 08:28:25'),
(4, 'Nhà thầu ABC', 'ông TTT', '0936167485', '2021-05-20 15:06:38', '2021-05-20 15:06:38'),
(5, 'Nhà thầu A', 'Sơn', '0943228989', '2021-09-13 09:21:49', '2021-09-13 09:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `contributes`
--

CREATE TABLE `contributes` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contributes`
--

INSERT INTO `contributes` (`id`, `name`, `user_id`, `updated_at`, `created_at`) VALUES
(1, 'huy dang', 19, '2020-12-08 10:32:05', '2020-12-08 10:32:05'),
(2, 'dung truong123', 22, '2021-01-19 23:12:41', '2021-01-19 23:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `contribute_file`
--

CREATE TABLE `contribute_file` (
  `id` int(11) NOT NULL,
  `open` smallint(1) NOT NULL DEFAULT '0',
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url_resize` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contribute_file`
--

INSERT INTO `contribute_file` (`id`, `open`, `project_id`, `user_id`, `type`, `name`, `url`, `url_resize`, `updated_at`, `created_at`) VALUES
(466, 0, 0, 26, 0, 'Mẫu báo cáo pháp lý về việc chuyển nhượng toàn bộ Nhà máy thủy điện', '/storage/system/rDJoB3kx4ZTIspyE4NHK0egatpcSCqPzjK5JxdrY.pdf', NULL, '2021-05-06 02:50:35', '2021-05-06 02:50:35'),
(467, 0, 0, 28, 0, 'Ảnh cây xanh', '/storage/system/T0apUfa4Fw9xBPufxPZqLJ7VA2FXfCNTUfzS1EfC.jpg', NULL, '2021-05-07 11:50:51', '2021-05-07 11:50:51'),
(468, 0, 0, 28, 0, 'Ảnh cây xanh', '/storage/system/jpkUi4fW41jug3HlssOWem29fUrTjlL123elsIdM.jpg', NULL, '2021-05-07 11:50:51', '2021-05-07 11:50:51'),
(469, 0, 0, 28, 0, 'Ảnh cây xanh', '/storage/system/EnVfk6sbWOi0SzFNLiJHEOM7XFJFHuzvR1CKvZJN.jpg', NULL, '2021-05-07 11:50:51', '2021-05-07 11:50:51'),
(473, 0, 0, 26, 0, 'Hồ sơ quan tâm dự án khu du lịch nghỉ dưỡng, chăm sóc sức khỏe và dân cư khu vực suối nước nóng Hội VÂn', '/storage/system/oxTpREo2oYQ18fFprbn92Ks2NZQAJzst13b4CdH8.pdf', '/storage/public/oxTpREo2oYQ18fFprbn92Ks2NZQAJzst13b4CdH8.pdf', '2021-05-21 10:48:57', '2021-05-21 10:48:57'),
(474, 0, 0, 26, 0, 'Sơ đồ quy hoạch không gian kiến trúc cảnh quan Hội Vân', '/storage/system/rpMvStaxMTwtsDm0n27srNQM4idBjOSO8xcPGsMc.pdf', '/storage/public/rpMvStaxMTwtsDm0n27srNQM4idBjOSO8xcPGsMc.pdf', '2021-05-21 11:01:23', '2021-05-21 11:01:23'),
(475, 0, 0, 26, 0, 'Hồ sơ năng lực và kinh nghiệm nhà thầu liên doanh - Hội Vân', '/storage/system/5zpQVdewTMSSn93yrLzsbnlnbMJTGBRTfC5bkHAG.pdf', '/storage/public/5zpQVdewTMSSn93yrLzsbnlnbMJTGBRTfC5bkHAG.pdf', '2021-05-21 11:03:32', '2021-05-21 11:03:32'),
(476, 0, 0, 26, 0, 'Tài liệu về năng lực Đông Dương Thăng Long - đấu thấu - Hội Vân', '/storage/system/sZaNgnhr2h51b4eXAOzkmzPSDKyIeRAvQzdotjpI.pdf', '/storage/public/sZaNgnhr2h51b4eXAOzkmzPSDKyIeRAvQzdotjpI.pdf', '2021-05-21 11:07:37', '2021-05-21 11:07:37'),
(477, 0, 0, 26, 0, 'Danh mục hồ sơ dự án Xuân An', '/storage/system/AYPWNkh6vd8RtMaxBSYz1xUIVAzWgCF6KPN82Ene.pdf', '/storage/public/AYPWNkh6vd8RtMaxBSYz1xUIVAzWgCF6KPN82Ene.pdf', '2021-05-21 11:10:27', '2021-05-21 11:10:27'),
(478, 0, 0, 28, 0, 'Làm rõ hồ sơ tham gia dự thầu Hội Vân', '/storage/system/XnrOFk4FVbKAyS1QSzAJRpNCz5Vri1EA4t1jrbG5.jpg', '/storage/public/XnrOFk4FVbKAyS1QSzAJRpNCz5Vri1EA4t1jrbG5.jpg', '2021-05-26 14:20:26', '2021-05-26 14:20:26'),
(479, 0, 0, 26, 0, 'Kết quả trúng thầu hội vân', '/storage/system/i31LQCHhBR3hlnhjlaEcFe0veppyrOGnUXxIUhfs.pdf', '/storage/public/i31LQCHhBR3hlnhjlaEcFe0veppyrOGnUXxIUhfs.pdf', '2021-06-22 01:32:35', '2021-06-22 01:32:35'),
(480, 0, 0, 26, 0, 'số điện thoại nhân viên trung tâm xúc tiến thương mại Bình Định', '/storage/system/1MV68Zlvut0Cd2P2YkzjWlqk3oCSTnQlTuXnrNkk.png', '/storage/public/1MV68Zlvut0Cd2P2YkzjWlqk3oCSTnQlTuXnrNkk.png', '2021-07-01 02:36:02', '2021-07-01 02:36:02'),
(481, 0, 0, 28, 0, 'UBND tỉnh quyết định phê duyệt kết quả lựa chon nhà đầu tư', '/storage/system/oUrFbDzaPzVFkGKwOfWW49rGMmx6CHoxucRtkH77.jpg', '/storage/public/oUrFbDzaPzVFkGKwOfWW49rGMmx6CHoxucRtkH77.jpg', '2021-07-03 06:46:08', '2021-07-03 06:46:08'),
(482, 0, 0, 28, 0, 'UBND tỉnh quyết định phê duyệt kết quả lựa chon nhà đầu tư', '/storage/system/0LrQFyT3WgJDvqA141o5Iew9Hdh0YL04Ir5WPOby.jpg', '/storage/public/0LrQFyT3WgJDvqA141o5Iew9Hdh0YL04Ir5WPOby.jpg', '2021-07-03 06:46:08', '2021-07-03 06:46:08'),
(483, 0, 0, 28, 0, 'UBND tỉnh quyết định phê duyệt kết quả lựa chon nhà đầu tư', '/storage/system/iMsUQEDYX58vlxHRvmC5tI7bqwxs7CyL4MXqj11j.jpg', '/storage/public/iMsUQEDYX58vlxHRvmC5tI7bqwxs7CyL4MXqj11j.jpg', '2021-07-03 06:46:09', '2021-07-03 06:46:09'),
(484, 0, 0, 28, 0, 'UBND tỉnh quyết định phê duyệt kết quả lựa chon nhà đầu tư', '/storage/system/hY5iRppEmdVqtgFTefM6uIyLG3tQLJWn97gjwH6E.jpg', '/storage/public/hY5iRppEmdVqtgFTefM6uIyLG3tQLJWn97gjwH6E.jpg', '2021-07-03 06:46:09', '2021-07-03 06:46:09'),
(492, 0, 0, 26, 0, 'Ảnh mô phỏng khu đô thị hoà bình', '/storage/system/VKamj4REFe5Zv6AX0LkIL3UlJGk2p8pOcebdBRKp.jpg', '/storage/public/VKamj4REFe5Zv6AX0LkIL3UlJGk2p8pOcebdBRKp.jpg', '2021-10-04 04:08:25', '2021-10-04 04:08:25'),
(493, 0, 0, 26, 0, 'Ảnh mô phỏng khu đô thị hoà bình', '/storage/system/qXFvcMkz6aXzMVopRnrAX91qLch4lwupQxHiW3Tj.jpg', '/storage/public/qXFvcMkz6aXzMVopRnrAX91qLch4lwupQxHiW3Tj.jpg', '2021-10-04 04:08:25', '2021-10-04 04:08:25'),
(494, 0, 0, 26, 0, 'Ảnh mô phỏng khu đô thị hoà bình', '/storage/system/Yui3xPhGwbO6DgickO47X2kj1Q4mD4PyaA4ii0Yk.jpg', '/storage/public/Yui3xPhGwbO6DgickO47X2kj1Q4mD4PyaA4ii0Yk.jpg', '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(495, 0, 0, 26, 0, 'Ảnh mô phỏng khu đô thị hoà bình', '/storage/system/xIpQRPVMsxreX0lZxCsqTG5JTDnr3HWgxNh1ukfn.jpg', '/storage/public/xIpQRPVMsxreX0lZxCsqTG5JTDnr3HWgxNh1ukfn.jpg', '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(496, 0, 0, 26, 0, 'Ảnh mô phỏng khu đô thị hoà bình', '/storage/system/1fCxNu4AUsGr9DLQGDYOwECjl1hX2vITOkVcJsmi.jpg', '/storage/public/1fCxNu4AUsGr9DLQGDYOwECjl1hX2vITOkVcJsmi.jpg', '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(497, 0, 0, 26, 0, 'Ảnh mô phỏng khu đô thị hoà bình', '/storage/system/eYQ5rdZEqOj3S8CnotrFmMeGxCQl1C7RTWoCGAbL.jpg', '/storage/public/eYQ5rdZEqOj3S8CnotrFmMeGxCQl1C7RTWoCGAbL.jpg', '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(498, 0, 0, 26, 0, 'Ảnh mô phỏng khu đô thị hoà bình', '/storage/system/ShJlR6aqvCGJivbTsgFOEEEMqzpMGQ1BcbsTNUB6.jpg', '/storage/public/ShJlR6aqvCGJivbTsgFOEEEMqzpMGQ1BcbsTNUB6.jpg', '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(499, 0, 0, 26, 0, 'Ảnh mô phỏng khu đô thị hoà bình', '/storage/system/o8H72pCD07TtCOSxt1ivcE4vAHDVxMsyjDmjRg4a.jpg', '/storage/public/o8H72pCD07TtCOSxt1ivcE4vAHDVxMsyjDmjRg4a.jpg', '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(500, 0, 0, 26, 0, 'Chấp thuận chủ trương đầu tư hội vân', '/storage/system/U3VCOaI42GukmzrTePPzDbrvwQdgXC29gLmvviqK', '/storage/public/U3VCOaI42GukmzrTePPzDbrvwQdgXC29gLmvviqK', '2021-11-21 07:19:07', '2021-11-21 07:19:07'),
(501, 0, 0, 26, 0, 'Chấp thuận chủ trương đầu tư hội vân', '/storage/system/XLkTVtp8oC494Z9bEQBVIHwaTQTApwSelS3cWIZQ.pdf', '/storage/public/XLkTVtp8oC494Z9bEQBVIHwaTQTApwSelS3cWIZQ.pdf', '2021-11-21 07:19:56', '2021-11-21 07:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `contribute_file_department`
--

CREATE TABLE `contribute_file_department` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contribute_file_tags`
--

CREATE TABLE `contribute_file_tags` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contribute_file_tags`
--

INSERT INTO `contribute_file_tags` (`id`, `file_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(5, 0, 12, '2021-05-05 13:29:15', '2021-05-05 13:29:15'),
(6, 0, 11, '2021-05-05 13:29:15', '2021-05-05 13:29:15'),
(12, 404, 14, '2021-05-05 16:11:15', '2021-05-05 16:11:15'),
(13, 396, 11, '2021-05-05 16:21:11', '2021-05-05 16:21:11'),
(14, 396, 14, '2021-05-05 16:21:11', '2021-05-05 16:21:11'),
(17, 467, 7, '2021-05-06 05:07:25', '2021-05-06 05:07:25'),
(18, 468, 15, '2021-05-10 03:03:22', '2021-05-10 03:03:22'),
(19, 469, 16, '2021-05-10 03:03:39', '2021-05-10 03:03:39'),
(20, 3, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(21, 3, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(22, 4, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(23, 4, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(24, 5, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(25, 5, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(26, 6, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(27, 6, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(28, 7, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(29, 7, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(30, 8, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(31, 8, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(32, 9, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(33, 9, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(34, 10, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(35, 10, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(36, 11, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(37, 11, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(38, 12, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(39, 12, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(40, 13, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(41, 13, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(42, 14, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(43, 14, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(44, 15, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(45, 15, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(46, 16, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(47, 16, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(48, 17, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(49, 17, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(50, 18, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(51, 18, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(52, 19, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(53, 19, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(54, 20, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(55, 20, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(56, 21, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(57, 21, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(58, 22, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(59, 22, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(60, 23, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(61, 23, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(62, 24, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(63, 24, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(64, 25, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(65, 25, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(66, 26, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(67, 26, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(68, 27, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(69, 27, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(72, 29, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(73, 29, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(74, 30, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(75, 30, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(80, 33, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(81, 33, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(82, 34, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(83, 34, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(86, 36, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(87, 36, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(88, 37, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(89, 37, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(90, 38, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(91, 38, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(92, 39, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(93, 39, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(94, 40, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(95, 40, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(96, 41, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(97, 41, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(98, 42, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(99, 42, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(100, 43, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(101, 43, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(102, 44, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(103, 44, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(104, 45, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(105, 45, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(106, 46, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(107, 46, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(108, 47, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(109, 47, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(110, 48, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(111, 48, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(112, 49, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(113, 49, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(114, 50, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(115, 50, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(116, 51, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(117, 51, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(118, 52, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(119, 52, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(120, 53, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(121, 53, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(122, 54, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(123, 54, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(124, 55, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(125, 55, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(126, 56, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(127, 56, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(128, 57, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(129, 57, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(130, 58, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(131, 58, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(132, 59, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(133, 59, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(134, 60, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(135, 60, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(136, 61, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(137, 61, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(138, 207, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(139, 207, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(140, 208, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(141, 208, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(142, 209, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(143, 209, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(144, 210, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(145, 210, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(146, 211, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(147, 211, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(148, 212, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(149, 212, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(150, 213, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(151, 213, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(152, 214, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(153, 214, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(154, 215, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(155, 215, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(156, 216, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(157, 216, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(158, 217, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(159, 217, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(160, 218, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(161, 218, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(162, 219, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(163, 219, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(164, 220, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(165, 220, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(166, 221, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(167, 221, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(168, 222, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(169, 222, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(170, 223, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(171, 223, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(172, 224, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(173, 224, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(174, 225, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(175, 225, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(176, 226, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(177, 226, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(178, 227, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(179, 227, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(180, 228, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(181, 228, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(182, 229, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(183, 229, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(184, 230, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(185, 230, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(186, 231, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(187, 231, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(188, 232, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(189, 232, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(190, 233, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(191, 233, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(192, 234, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(193, 234, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(194, 235, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(195, 235, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(196, 236, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(197, 236, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(198, 237, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(199, 237, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(200, 238, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(201, 238, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(202, 239, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(203, 239, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(204, 240, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(205, 240, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(206, 241, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(207, 241, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(208, 242, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(209, 242, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(210, 243, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(211, 243, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(212, 244, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(213, 244, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(214, 245, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(215, 245, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(216, 246, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(217, 246, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(218, 247, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(219, 247, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(220, 248, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(221, 248, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(222, 249, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(223, 249, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(224, 250, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(225, 250, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(226, 251, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(227, 251, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(228, 252, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(229, 252, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(230, 253, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(231, 253, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(232, 254, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(233, 254, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(234, 255, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(235, 255, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(236, 256, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(237, 256, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(238, 257, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(239, 257, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(240, 327, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(241, 327, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(242, 328, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(243, 328, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(244, 329, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(245, 329, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(246, 330, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(247, 330, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(248, 331, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(249, 331, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(250, 332, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(251, 332, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(252, 333, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(253, 333, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(254, 334, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(255, 334, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(256, 335, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(257, 335, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(258, 336, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(259, 336, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(260, 337, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(261, 337, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(262, 338, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(263, 338, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(264, 339, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(265, 339, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(266, 340, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(267, 340, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(268, 341, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(269, 341, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(270, 342, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(271, 342, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(272, 343, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(273, 343, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(274, 344, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(275, 344, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(276, 345, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(277, 345, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(278, 346, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(279, 346, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(280, 347, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(281, 347, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(282, 348, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(283, 348, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(284, 349, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(285, 349, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(286, 350, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(287, 350, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(288, 351, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(289, 351, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(290, 352, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(291, 352, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(292, 353, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(293, 353, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(294, 354, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(295, 354, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(296, 355, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(297, 355, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(298, 356, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(299, 356, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(300, 357, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(301, 357, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(302, 358, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(303, 358, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(304, 359, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(305, 359, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(306, 360, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(307, 360, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(308, 361, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(309, 361, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(310, 362, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(311, 362, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(312, 363, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(313, 363, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(314, 364, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(315, 364, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(316, 365, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(317, 365, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(318, 366, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(319, 366, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(320, 367, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(321, 367, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(322, 368, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(323, 368, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(324, 369, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(325, 369, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(326, 370, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(327, 370, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(328, 371, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(329, 371, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(330, 372, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(331, 372, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(332, 373, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(333, 373, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(334, 374, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(335, 374, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(336, 375, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(337, 375, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(338, 376, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(339, 376, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(340, 377, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(341, 377, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(342, 378, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(343, 378, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(344, 379, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(345, 379, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(346, 380, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(347, 380, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(348, 381, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(349, 381, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(350, 382, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(351, 382, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(352, 383, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(353, 383, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(354, 384, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(355, 384, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(356, 385, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(357, 385, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(358, 386, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(359, 386, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(360, 387, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(361, 387, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(362, 388, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(363, 388, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(364, 389, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(365, 389, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(366, 390, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(367, 390, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(368, 391, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(369, 391, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(370, 392, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(371, 392, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(372, 393, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(373, 393, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(374, 394, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(375, 394, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(376, 395, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(377, 395, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(378, 396, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(379, 396, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(380, 397, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(381, 397, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(384, 399, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(385, 399, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(386, 400, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(387, 400, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(388, 401, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(389, 401, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(390, 402, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(391, 402, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(392, 403, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(393, 403, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(394, 404, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(395, 404, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(396, 405, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(397, 405, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(398, 406, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(399, 406, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(400, 407, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(401, 407, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(402, 408, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(403, 408, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(404, 409, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(405, 409, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(406, 410, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(407, 410, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(408, 411, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(409, 411, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(410, 412, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(411, 412, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(412, 413, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(413, 413, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(414, 414, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(415, 414, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(416, 415, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(417, 415, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(418, 416, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(419, 416, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(420, 417, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(421, 417, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(422, 418, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(423, 418, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(424, 419, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(425, 419, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(426, 420, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(427, 420, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(428, 421, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(429, 421, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(430, 422, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(431, 422, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(432, 423, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(433, 423, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(434, 424, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(435, 424, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(436, 425, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(437, 425, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(438, 426, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(439, 426, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(440, 427, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(441, 427, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(442, 428, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(443, 428, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(444, 429, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(445, 429, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(446, 430, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(447, 430, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(448, 431, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(449, 431, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(450, 432, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(451, 432, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(452, 433, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(453, 433, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(454, 434, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(455, 434, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(456, 435, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(457, 435, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(458, 436, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(459, 436, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(460, 437, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(461, 437, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(462, 438, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(463, 438, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(464, 439, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(465, 439, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(466, 440, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(467, 440, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(468, 441, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(469, 441, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(470, 442, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(471, 442, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(472, 443, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(473, 443, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(474, 444, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(475, 444, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(476, 445, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(477, 445, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(478, 446, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(479, 446, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(480, 447, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(481, 447, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(482, 448, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(483, 448, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(484, 449, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(485, 449, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(486, 450, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(487, 450, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(488, 451, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(489, 451, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(490, 452, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(491, 452, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(492, 453, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(493, 453, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(494, 454, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(495, 454, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(496, 455, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(497, 455, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(498, 456, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(499, 456, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(500, 457, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(501, 457, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(502, 458, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(503, 458, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(504, 459, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(505, 459, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(506, 460, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(507, 460, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(508, 461, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(509, 461, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(510, 462, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(511, 462, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(512, 463, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(513, 463, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(514, 464, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(515, 464, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(518, 467, 14, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(519, 467, 11, '2021-05-13 16:23:47', '2021-05-13 16:23:47'),
(520, 468, 14, '2021-05-13 16:23:48', '2021-05-13 16:23:48'),
(521, 468, 11, '2021-05-13 16:23:48', '2021-05-13 16:23:48'),
(522, 469, 14, '2021-05-13 16:23:48', '2021-05-13 16:23:48'),
(523, 469, 11, '2021-05-13 16:23:48', '2021-05-13 16:23:48'),
(530, 35, 14, '2021-05-13 16:30:08', '2021-05-13 16:30:08'),
(531, 35, 24, '2021-05-13 16:30:08', '2021-05-13 16:30:08'),
(532, 32, 14, '2021-05-13 16:30:16', '2021-05-13 16:30:16'),
(533, 32, 26, '2021-05-13 16:30:16', '2021-05-13 16:30:16'),
(534, 32, 27, '2021-05-13 16:30:16', '2021-05-13 16:30:16'),
(535, 31, 14, '2021-05-13 16:30:22', '2021-05-13 16:30:22'),
(536, 31, 26, '2021-05-13 16:30:22', '2021-05-13 16:30:22'),
(537, 31, 27, '2021-05-13 16:30:22', '2021-05-13 16:30:22'),
(538, 28, 24, '2021-05-13 16:30:30', '2021-05-13 16:30:30'),
(539, 28, 28, '2021-05-13 16:30:30', '2021-05-13 16:30:30'),
(540, 28, 27, '2021-05-13 16:30:30', '2021-05-13 16:30:30'),
(541, 398, 14, '2021-05-21 08:17:34', '2021-05-21 08:17:34'),
(542, 398, 11, '2021-05-21 08:17:34', '2021-05-21 08:17:34'),
(543, 398, 31, '2021-05-21 08:17:34', '2021-05-21 08:17:34'),
(549, 473, 32, '2021-05-21 10:48:57', '2021-05-21 10:48:57'),
(550, 473, 33, '2021-05-21 10:48:57', '2021-05-21 10:48:57'),
(551, 473, 34, '2021-05-21 10:48:57', '2021-05-21 10:48:57'),
(552, 473, 35, '2021-05-21 10:48:57', '2021-05-21 10:48:57'),
(553, 474, 35, '2021-05-21 11:01:23', '2021-05-21 11:01:23'),
(554, 474, 33, '2021-05-21 11:01:23', '2021-05-21 11:01:23'),
(555, 474, 37, '2021-05-21 11:01:23', '2021-05-21 11:01:23'),
(556, 474, 38, '2021-05-21 11:01:23', '2021-05-21 11:01:23'),
(557, 475, 39, '2021-05-21 11:03:32', '2021-05-21 11:03:32'),
(558, 475, 33, '2021-05-21 11:03:32', '2021-05-21 11:03:32'),
(559, 475, 35, '2021-05-21 11:03:32', '2021-05-21 11:03:32'),
(560, 475, 37, '2021-05-21 11:03:32', '2021-05-21 11:03:32'),
(561, 475, 40, '2021-05-21 11:03:32', '2021-05-21 11:03:32'),
(562, 476, 41, '2021-05-21 11:07:37', '2021-05-21 11:07:37'),
(563, 476, 33, '2021-05-21 11:07:37', '2021-05-21 11:07:37'),
(564, 476, 35, '2021-05-21 11:07:37', '2021-05-21 11:07:37'),
(565, 476, 37, '2021-05-21 11:07:37', '2021-05-21 11:07:37'),
(566, 477, 42, '2021-05-21 11:10:27', '2021-05-21 11:10:27'),
(567, 477, 43, '2021-05-21 11:10:27', '2021-05-21 11:10:27'),
(568, 477, 44, '2021-05-21 11:10:27', '2021-05-21 11:10:27'),
(569, 477, 37, '2021-05-21 11:10:27', '2021-05-21 11:10:27'),
(570, 478, 45, '2021-05-26 14:20:26', '2021-05-26 14:20:26'),
(571, 478, 35, '2021-05-26 14:20:26', '2021-05-26 14:20:26'),
(572, 479, 46, '2021-06-22 01:32:35', '2021-06-22 01:32:35'),
(573, 479, 33, '2021-06-22 01:32:35', '2021-06-22 01:32:35'),
(574, 479, 35, '2021-06-22 01:32:35', '2021-06-22 01:32:35'),
(575, 480, 47, '2021-07-01 02:36:02', '2021-07-01 02:36:02'),
(576, 481, 45, '2021-07-03 06:46:08', '2021-07-03 06:46:08'),
(577, 481, 35, '2021-07-03 06:46:08', '2021-07-03 06:46:08'),
(578, 482, 45, '2021-07-03 06:46:08', '2021-07-03 06:46:08'),
(579, 482, 35, '2021-07-03 06:46:08', '2021-07-03 06:46:08'),
(580, 483, 45, '2021-07-03 06:46:09', '2021-07-03 06:46:09'),
(581, 483, 35, '2021-07-03 06:46:09', '2021-07-03 06:46:09'),
(582, 484, 45, '2021-07-03 06:46:09', '2021-07-03 06:46:09'),
(583, 484, 35, '2021-07-03 06:46:09', '2021-07-03 06:46:09'),
(591, 492, 8, '2021-10-04 04:08:25', '2021-10-04 04:08:25'),
(592, 493, 8, '2021-10-04 04:08:25', '2021-10-04 04:08:25'),
(593, 494, 8, '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(594, 495, 8, '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(595, 496, 8, '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(596, 497, 8, '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(597, 498, 8, '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(598, 499, 8, '2021-10-04 04:08:26', '2021-10-04 04:08:26'),
(599, 500, 35, '2021-11-21 07:19:07', '2021-11-21 07:19:07'),
(600, 500, 48, '2021-11-21 07:19:07', '2021-11-21 07:19:07'),
(601, 501, 35, '2021-11-21 07:19:56', '2021-11-21 07:19:56'),
(602, 501, 48, '2021-11-21 07:19:56', '2021-11-21 07:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `contribute_file_user`
--

CREATE TABLE `contribute_file_user` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contribute_taskfile`
--

CREATE TABLE `contribute_taskfile` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url_resize` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contribute_taskfile_tags`
--

CREATE TABLE `contribute_taskfile_tags` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `name` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `mid`, `name`, `des`, `url`, `created_at`, `updated_at`) VALUES
(1, 5, 'Phòng kinh doanh', '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"text-align:center; vertical-align:top\"><strong>C&Ocirc;NG VIỆC CHUNG</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>C&ocirc;ng t&aacute;c b&aacute;n h&agrave;ng</td>\r\n			<td>- Lập kế hoạch kinh doanh theo y&ecirc;u cầu doanh số BLĐ đề ra;<br />\r\n			- Lập kế hoạch Marketing từng giai đoạn;<br />\r\n			- Truyền th&ocirc;ng quảng c&aacute;o, tiếp thị, t&igrave;m kiếm kh&aacute;ch h&agrave;ng;<br />\r\n			- Tư vấn, chăm s&oacute;c kh&aacute;ch h&agrave;ng, chốt kh&aacute;ch.<br />\r\n			&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>C&ocirc;ng t&aacute;c thủ tục&nbsp;</td>\r\n			<td>- Hướng dẫn, tư vấn kh&aacute;ch h&agrave;ng hiểu nội dung v&agrave; k&yacute; đơn cọc,k&yacute; hợp đồng giao dịch;<br />\r\n			&nbsp;- Lập b&aacute;o c&aacute;o doanh thu, c&ocirc;ng nợ h&agrave;ng th&aacute;ng;<br />\r\n			- Lưu trữ hợp đồng, bảo mật th&ocirc;ng tin kh&aacute;ch h&agrave;ng;<br />\r\n			- L&agrave;m sổ đỏ cho kh&aacute;ch h&agrave;ng;<br />\r\n			- Đặt lịch b&agrave;n giao nh&agrave;/b&agrave;n giao mốc giới đất cho kh&aacute;ch h&agrave;ng;<br />\r\n			- Chăm s&oacute;c kh&aacute;ch h&agrave;ng để tiếp tục duy tr&igrave; ph&aacute;t sinh kh&aacute;ch mới từ kh&aacute;ch h&agrave;ng.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '', '2020-12-23 00:33:50', '2021-03-25 02:45:23'),
(3, 5, 'Phòng kế hoạch - kỹ thuật', '1', 'js-css/img/history/d3.png', '2020-12-23 00:34:16', '2021-03-09 05:36:51'),
(4, 5, 'Phòng hành chính nhân sự', '', 'js-css/img/history/d1.png', '2020-12-23 00:34:16', '2021-03-09 05:36:59'),
(5, 10, 'Ban giám đốc', '', '', '2021-01-19 01:03:41', '2021-03-23 23:37:57'),
(6, -1, 'Ban Quản trị', '', '', '2021-01-19 01:07:19', '2021-01-19 01:07:19'),
(7, -1, 'Phòng phát triển dự án', NULL, '', '2021-03-09 05:36:05', '2021-03-09 05:36:39'),
(8, 5, 'Phòng  kế toán', NULL, 'js-css/img/history/d2.png', '2021-03-09 05:37:11', '2021-03-09 05:40:13'),
(10, 0, 'Hội đồng quản trị', NULL, '', '2021-03-23 23:37:22', '2021-03-23 23:37:22'),
(11, 10, 'Ban kiểm soát', NULL, '', '2021-03-23 23:37:51', '2021-03-23 23:37:51'),
(12, 5, 'Nhà thầu', '<p>1</p>', NULL, '2021-09-14 18:02:13', '2021-09-14 18:02:13'),
(13, 1, 'Khác', '<p>1</p>', NULL, '2021-09-14 18:02:28', '2021-09-14 18:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `department_legal`
--

CREATE TABLE `department_legal` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_legal`
--

INSERT INTO `department_legal` (`id`, `task_id`, `dept_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-03-07 07:05:30', '2021-03-07 07:05:30'),
(2, 10, 1, '2021-03-07 07:06:52', '2021-03-07 07:06:52'),
(3, 12, 1, '2021-03-07 07:06:57', '2021-03-07 07:06:57'),
(4, 13, 1, '2021-03-07 07:07:02', '2021-03-07 07:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `dictrict`
--

CREATE TABLE `dictrict` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acreage` int(10) NOT NULL,
  `num_zone` int(5) NOT NULL,
  `contribute_id` int(11) NOT NULL DEFAULT '0',
  `zone` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dictrict`
--

INSERT INTO `dictrict` (`id`, `project_id`, `name`, `description`, `url`, `acreage`, `num_zone`, `contribute_id`, `zone`, `updated_at`, `created_at`) VALUES
(1, 1, 'LK-01', 'Khu liên kề 01', NULL, 1471, 12, 0, '', '2020-12-07 13:38:55', '2020-12-07 13:38:55'),
(2, 1, 'LK-02', 'Khu liên kề 02', NULL, 3550, 19, 0, '', '2020-12-07 13:38:55', '2020-12-07 13:38:55'),
(5, 1, 'LK-03', 'Khu Liền Kề 03', '', 1471, 12, 0, '', '2020-12-07 13:39:58', '2020-12-07 13:39:58'),
(6, 1, 'LK-04', 'Khu Liền Kề 04', NULL, 1923, 16, 0, '', '2020-12-07 13:39:58', '2020-12-07 13:39:58'),
(9, 1, 'LK-05', 'Khu Liền Kề 05', NULL, 2063, 17, 0, '', '2020-12-07 13:44:21', '2020-12-07 13:44:21'),
(10, 1, 'LK-06', 'Khu Liền Kề 06', NULL, 2780, 23, 0, '', '2020-12-07 13:44:21', '2020-12-07 13:44:21'),
(11, 1, 'LK-07', 'Khu Liền Kề 07', NULL, 2661, 22, 0, '', '2020-12-07 13:44:51', '2020-12-07 13:44:51'),
(12, 1, 'LK-08', 'Khu Liền Kề 08', NULL, 1444, 12, 0, '', '2020-12-07 13:44:51', '2020-12-07 13:44:51'),
(13, 1, 'LK-09', 'Khu Liền Kề 09', NULL, 4100, 34, 0, '', '2020-12-07 13:45:11', '2020-12-07 13:45:11'),
(14, 1, 'LK-10', 'Khu Liền Kề 10', NULL, 1564, 13, 0, '', '2020-12-07 13:45:11', '2020-12-07 13:45:11'),
(15, 1, 'LK-11', 'Khu Liền Kề 11', NULL, 2875, 23, 0, '', '2020-12-07 13:45:30', '2020-12-07 13:45:30'),
(16, 1, 'LK-12', 'Khu Liền Kề 12', NULL, 3003, 24, 0, '', '2020-12-07 13:45:30', '2020-12-07 13:45:30'),
(17, 1, 'LK-13', 'Khu Liền Kề 13', NULL, 409, 3, 0, '', '2020-12-07 13:45:50', '2020-12-07 13:45:50'),
(18, 1, 'LK-14', 'Khu Liền Kề 14', NULL, 3277, 26, 0, '', '2020-12-07 13:45:50', '2020-12-07 13:45:50'),
(19, 1, 'LK-15', 'Khu Liền Kề 15', NULL, 2648, 22, 0, '', '2020-12-07 13:46:14', '2020-12-07 13:46:14'),
(20, 1, 'LK-16', 'Khu Liền Kề 16', NULL, 2528, 21, 0, '', '2020-12-07 13:46:14', '2020-12-07 13:46:14'),
(21, 1, 'LK-17', 'Khu Liền Kề 17', NULL, 2680, 22, 0, '', '2020-12-07 13:46:42', '2020-12-07 13:46:42'),
(22, 1, 'BT-01', 'Khu Biệt Thự 01', NULL, 3497, 3, 0, '', '2020-12-07 13:50:53', '2020-12-07 13:50:53'),
(23, 1, 'BT-02', 'Khu Biệt Thự 02', NULL, 13536, 24, 0, '', '2020-12-07 13:50:53', '2020-12-07 13:50:53'),
(24, 1, 'BT-03', 'Khu Biệt Thự 03', NULL, 8052, 16, 0, '', '2020-12-07 13:51:16', '2020-12-07 13:51:16'),
(25, 1, 'BT-04', 'Khu Biệt Thự 04', NULL, 7650, 14, 0, '', '2020-12-07 13:51:16', '2020-12-07 13:51:16'),
(26, 1, 'BT-05', 'Khu Biệt Thự 05', NULL, 9774, 17, 0, '', '2020-12-07 13:51:34', '2020-12-07 13:51:34'),
(27, 1, 'BT-06', 'Khu Biệt Thự 06', NULL, 2091, 3, 0, '', '2020-12-07 13:51:34', '2020-12-07 13:51:34'),
(28, 1, 'BT-07', 'Khu Biệt Thự 07', NULL, 7184, 13, 1, '', '2020-12-07 13:52:09', '2020-12-07 13:52:09'),
(29, 1, 'BT-08', 'Khu Biệt Thự 08', NULL, 3512, 3, 1, '', '2020-12-07 13:52:09', '2020-12-07 13:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE `discussions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discussions`
--

INSERT INTO `discussions` (`id`, `user_id`, `channel_id`, `title`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(7, 4, 1, 'Khách hàng quá hạn 2 tuần do covid thi xử lý như thế nào ạ', 'the-wonders-of-js-framework', 'Do tình hình covid, khách hàng bị chậm tiến độ, co inh động dược không ạ', '2019-07-01 10:47:43', '2019-07-01 10:47:43'),
(8, 4, 5, 'Khách hàng chỉ nộp 15% đầu có được làm hợp đồng không', 'the-importance-of-ruby-on-rails', '<p>Kh&aacute;ch h&agrave;ng hiện chưa c&oacute; đủ, nhưng muốn đặt c&oacute;c trước mức thấp hơn th&igrave; m&igrave;nh xử l&yacute; như thế n&agrave;o ạ</p>', '2019-07-03 11:49:13', '2019-07-03 11:49:13'),
(9, 17, 1, 'tesst', 'tesst', '<p>123</p>', '2021-03-16 00:10:41', '2021-03-16 00:10:41'),
(10, 28, 1, 'tesst', 'tesst', '<p>123213</p>', '2021-03-20 06:08:06', '2021-03-20 06:08:06'),
(11, 28, 1, 'tesst', 'tesst', '<p>43646346</p>', '2021-03-20 09:23:21', '2021-03-20 09:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `discussions_url`
--

CREATE TABLE `discussions_url` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discussions_url`
--

INSERT INTO `discussions_url` (`id`, `blog_id`, `url`, `created_at`, `updated_at`) VALUES
(1, 13, '/storage/discuss/nWJ4qzVCcpbEaPTcloEj8vYMT10IeO4QmMpdn5OI.png', '2021-03-15 13:53:03', '2021-03-15 13:53:03'),
(2, 13, '/storage/discuss/WHtcs5BlMzzjX0lRRVVO5nX7jr09Sv62hnRxiynF.png', '2021-03-15 13:53:03', '2021-03-15 13:53:03'),
(3, 8, '/storage/discuss/z0LXDTk3JXHJPHHoiGjR7iA11oD8cAJ6mgBpqPwJ.png', '2021-03-15 14:56:28', '2021-03-15 14:56:28'),
(4, 11, '/storage/discuss/INgYMkvg7cy2j1dSyMWQpEJvcB9I8gBpdxfGJxKG.png', '2021-03-20 09:23:21', '2021-03-20 09:23:21'),
(5, 11, '/storage/discuss/mRwEHujTh6KNwnd1jLCy5EC0sLJLCVRNE3ECLX3h.png', '2021-03-20 09:23:21', '2021-03-20 09:23:21'),
(6, 11, '/storage/discuss/FjEedhx6rkZDd3dlkSlzuiXMmh2yECROgyHxpzJl.png', '2021-03-20 09:23:21', '2021-03-20 09:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `permiss` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `type`, `title`, `description`, `permiss`, `user_id`, `updated_at`, `created_at`) VALUES
(1, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà LK-16-14', 0, 26, '2021-03-06 01:46:50', '2021-03-06 01:46:50'),
(2, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT-08-1', 0, 26, '2021-03-06 02:13:37', '2021-03-06 02:13:37'),
(3, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT-07-9', 0, 26, '2021-03-06 02:40:44', '2021-03-06 02:40:44'),
(4, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT-07-10', 0, 26, '2021-03-07 03:28:11', '2021-03-07 03:28:11'),
(5, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT-07-6', 0, 26, '2021-03-07 03:41:51', '2021-03-07 03:41:51'),
(6, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT-07-7', 0, 26, '2021-03-07 03:47:16', '2021-03-07 03:47:16'),
(7, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT-07-11', 0, 26, '2021-03-07 03:54:31', '2021-03-07 03:54:31'),
(8, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT-07-4', 0, 26, '2021-03-07 04:15:04', '2021-03-07 04:15:04'),
(9, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà LK-16-17', 0, 26, '2021-03-07 04:25:32', '2021-03-07 04:25:32'),
(10, 1, 'Công việc mới', 'báo cáo trong xuân an', 0, 28, '2021-03-08 09:29:03', '2021-03-08 09:29:03'),
(11, 1, 'Cập nhật tiến độ công việc', 'báo cáo trong xuân an', 0, 28, '2021-03-08 09:34:45', '2021-03-08 09:34:45'),
(12, 1, 'Cập nhật tiến độ công việc', 'báo cáo trong xuân an', 0, 28, '2021-03-08 09:37:45', '2021-03-08 09:37:45'),
(13, 1, 'Công việc hoàn thành', 'báo cáo trong xuân an', 0, 28, '2021-03-08 09:38:55', '2021-03-08 09:38:55'),
(14, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-03-10 14:11:37', '2021-03-10 14:11:37'),
(15, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-03', 0, 17, '2021-03-10 14:19:16', '2021-03-10 14:19:16'),
(16, 1, 'Công việc mới', 'test', 0, 17, '2021-03-15 12:54:20', '2021-03-15 12:54:20'),
(17, 1, 'Công việc mới', 'test', 0, 17, '2021-03-15 12:54:21', '2021-03-15 12:54:21'),
(18, 1, 'Cập nhật tiến độ công việc', 'test', 0, 17, '2021-03-16 08:12:00', '2021-03-16 08:12:00'),
(19, 1, 'Cập nhật tiến độ công việc', 'test', 0, 17, '2021-03-16 08:43:17', '2021-03-16 08:43:17'),
(20, 1, 'Cập nhật tiến độ công việc', 'test', 0, 17, '2021-03-20 02:58:39', '2021-03-20 02:58:39'),
(21, 1, 'Cập nhật bình luận', 'test', 0, 17, '2021-03-20 03:00:17', '2021-03-20 03:00:17'),
(22, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-04', 0, 17, '2021-03-23 05:28:47', '2021-03-23 05:28:47'),
(23, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-05', 0, 17, '2021-03-23 06:27:39', '2021-03-23 06:27:39'),
(24, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-02', 0, 17, '2021-03-23 08:09:50', '2021-03-23 08:09:50'),
(25, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-02', 0, 17, '2021-03-23 12:10:54', '2021-03-23 12:10:54'),
(26, 1, 'Cập nhật tiến độ công việc', 'báo cáo trong xuân an', 0, 28, '2021-03-23 22:35:54', '2021-03-23 22:35:54'),
(27, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-10', 0, 26, '2021-03-24 09:46:13', '2021-03-24 09:46:13'),
(28, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-03-24 22:06:40', '2021-03-24 22:06:40'),
(29, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-03-24 22:12:01', '2021-03-24 22:12:01'),
(30, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-11', 0, 26, '2021-03-25 21:30:44', '2021-03-25 21:30:44'),
(31, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-11', 0, 26, '2021-03-25 21:31:14', '2021-03-25 21:31:14'),
(32, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-11', 0, 26, '2021-03-25 21:32:37', '2021-03-25 21:32:37'),
(33, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-11', 0, 26, '2021-03-25 21:37:53', '2021-03-25 21:37:53'),
(34, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-11', 0, 26, '2021-03-25 21:48:51', '2021-03-25 21:48:51'),
(35, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-01', 0, 26, '2021-03-25 21:55:32', '2021-03-25 21:55:32'),
(36, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-21', 0, 26, '2021-03-26 11:48:11', '2021-03-26 11:48:11'),
(37, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-03', 0, 17, '2021-03-26 11:49:11', '2021-03-26 11:49:11'),
(38, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 2, '2021-03-26 14:15:57', '2021-03-26 14:15:57'),
(39, 1, 'Công việc mới', 'Test hệ thống lần cuối', 0, 145, '2021-03-26 15:41:47', '2021-03-26 15:41:47'),
(40, 1, 'Cập nhật tiến độ công việc', 'Test hệ thống lần cuối', 0, 145, '2021-03-26 15:42:13', '2021-03-26 15:42:13'),
(41, 1, 'Công việc hoàn thành', 'Test hệ thống lần cuối', 0, 145, '2021-03-26 15:50:58', '2021-03-26 15:50:58'),
(42, 1, 'Công việc hoàn thành', 'Test hệ thống lần cuối', 0, 145, '2021-03-26 15:50:59', '2021-03-26 15:50:59'),
(43, 1, 'Công việc mới', 'Quay video hướng dấn', 0, 145, '2021-03-26 15:51:37', '2021-03-26 15:51:37'),
(44, 1, 'Cập nhật tiến độ công việc', 'Quay video hướng dấn', 0, 145, '2021-03-26 15:52:05', '2021-03-26 15:52:05'),
(45, 1, 'Công việc hoàn thành', 'Quay video hướng dấn', 0, 145, '2021-03-26 16:12:20', '2021-03-26 16:12:20'),
(46, 1, 'Công việc hoàn thành', 'Quay video hướng dấn', 0, 147, '2021-03-26 16:12:20', '2021-03-26 16:12:20'),
(47, 1, 'Công việc mới', 'Quay video hướng dấn', 0, 145, '2021-03-26 16:12:49', '2021-03-26 16:12:49'),
(48, 1, 'Cập nhật tiến độ công việc', 'Quay video hướng dấn', 0, 145, '2021-03-26 16:13:11', '2021-03-26 16:13:11'),
(49, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-17', 0, 26, '2021-03-27 17:43:49', '2021-03-27 17:43:49'),
(50, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-02', 0, 17, '2021-03-27 21:53:35', '2021-03-27 21:53:35'),
(51, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-18', 0, 26, '2021-03-27 22:45:28', '2021-03-27 22:45:28'),
(52, 1, 'Công việc mới', 'Bàn giao sử dụng phần quản trị bán hàng cho công ty Đông Dương Thăng Long', 0, 26, '2021-03-28 13:31:31', '2021-03-28 13:31:31'),
(53, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-03', 0, 17, '2021-03-28 15:26:29', '2021-03-28 15:26:29'),
(54, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-04', 0, 2, '2021-03-28 17:02:32', '2021-03-28 17:02:32'),
(55, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 28, '2021-03-28 17:04:45', '2021-03-28 17:04:45'),
(56, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-03-28 21:55:33', '2021-03-28 21:55:33'),
(57, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 124, '2021-03-29 07:22:14', '2021-03-29 07:22:14'),
(58, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 145, '2021-03-29 08:31:25', '2021-03-29 08:31:25'),
(59, 1, 'Căn hộ BT07-02', 'Đã  cập nhật Hợp đồng góp vốn lô không xây thô', 0, 17, '2021-03-29 08:34:36', '2021-03-29 08:34:36'),
(60, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-08', 0, 150, '2021-03-29 09:06:23', '2021-03-29 09:06:23'),
(61, 1, 'Căn hộ BT02-08', 'Đã  cập nhật Phiếu cọc', 0, 150, '2021-03-29 09:09:27', '2021-03-29 09:09:27'),
(62, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-02', 0, 142, '2021-03-29 09:13:39', '2021-03-29 09:13:39'),
(63, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-04', 0, 17, '2021-03-29 22:39:00', '2021-03-29 22:39:00'),
(64, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-03-30 07:48:01', '2021-03-30 07:48:01'),
(65, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-03-30 07:49:58', '2021-03-30 07:49:58'),
(66, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-03-30 08:24:03', '2021-03-30 08:24:03'),
(67, 1, 'Công việc mới', 'Rà soát xây thô', 0, 145, '2021-04-01 08:06:07', '2021-04-01 08:06:07'),
(68, 1, 'Công việc mới', 'Scan hợp đồng cập nhật số hóa giai đoạn 1', 0, 145, '2021-04-01 08:09:52', '2021-04-01 08:09:52'),
(69, 1, 'Công việc mới', 'Cập nhật báo cáo bán hàng đến 31/3/2021', 0, 145, '2021-04-01 08:11:57', '2021-04-01 08:11:57'),
(70, 1, 'Công việc mới', 'Làm nguồn ký gửi liền kề giai đoạn 1', 0, 145, '2021-04-01 08:15:49', '2021-04-01 08:15:49'),
(71, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-04-01 08:57:10', '2021-04-01 08:57:10'),
(72, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 142, '2021-04-01 09:33:20', '2021-04-01 09:33:20'),
(73, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-04-01 13:20:17', '2021-04-01 13:20:17'),
(74, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-04-02 08:08:50', '2021-04-02 08:08:50'),
(75, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-02', 0, 142, '2021-04-03 08:35:13', '2021-04-03 08:35:13'),
(76, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-04-03 10:25:18', '2021-04-03 10:25:18'),
(77, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-04-03 10:27:24', '2021-04-03 10:27:24'),
(78, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-04-03 10:34:23', '2021-04-03 10:34:23'),
(79, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-04-05 15:18:50', '2021-04-05 15:18:50'),
(80, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-04-06 15:27:20', '2021-04-06 15:27:20'),
(81, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 2, '2021-04-12 09:11:24', '2021-04-12 09:11:24'),
(82, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 28, '2021-04-16 08:35:40', '2021-04-16 08:35:40'),
(83, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-14', 0, 142, '2021-04-16 16:19:31', '2021-04-16 16:19:31'),
(84, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 28, '2021-04-16 17:51:08', '2021-04-16 17:51:08'),
(85, 1, 'Căn hộ BT01-03', 'Đã  cập nhật Hợp đồng góp vốn lô xây thô', 0, 2, '2021-04-19 12:11:57', '2021-04-19 12:11:57'),
(86, 1, 'Căn hộ BT02-07', 'Đã  cập nhật Hợp đồng mua bán nhà ở', 0, 2, '2021-04-19 12:18:30', '2021-04-19 12:18:30'),
(87, 1, 'Căn hộ BT07-06', 'Đã  cập nhật Hợp đồng mua bán nhà ở', 0, 2, '2021-04-19 12:22:31', '2021-04-19 12:22:31'),
(88, 1, 'Căn hộ BT07-08', 'Đã  cập nhật Phiếu cọc', 0, 2, '2021-04-19 12:22:53', '2021-04-19 12:22:53'),
(89, 1, 'Căn hộ BT07-09', 'Đã  cập nhật Hợp đồng mua bán nhà ở', 0, 2, '2021-04-19 12:23:33', '2021-04-19 12:23:33'),
(90, 1, 'Căn hộ BT08-02', 'Đã  cập nhật Hợp đồng mua bán nhà ở', 0, 2, '2021-04-19 12:24:08', '2021-04-19 12:24:08'),
(91, 1, 'Căn hộ BT08-03', 'Đã  cập nhật Hợp đồng mua bán nhà ở', 0, 2, '2021-04-19 12:24:29', '2021-04-19 12:24:29'),
(92, 1, 'Căn hộ BT08-03', 'Đã  cập nhật Phiếu cọc', 0, 2, '2021-04-19 12:24:34', '2021-04-19 12:24:34'),
(93, 1, 'Căn hộ LK02-05', 'Đã  cập nhật Phiếu cọc', 0, 2, '2021-04-19 12:25:10', '2021-04-19 12:25:10'),
(94, 1, 'Căn hộ LK02-05', 'Đã  cập nhật Hợp đồng mua bán nhà ở', 0, 2, '2021-04-19 12:25:21', '2021-04-19 12:25:21'),
(95, 1, 'Căn hộ LK14-15', 'Đã  cập nhật Phiếu cọc', 0, 2, '2021-04-19 12:25:57', '2021-04-19 12:25:57'),
(96, 1, 'Căn hộ LK17-17', 'Đã  cập nhật Hợp đồng mua bán nhà ở', 0, 2, '2021-04-19 12:26:53', '2021-04-19 12:26:53'),
(97, 1, 'Căn hộ BT02-02', 'Đã thanh toán tiến độ  đợt 1', 0, 28, '2021-04-19 21:39:39', '2021-04-19 21:39:39'),
(98, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-04-20 16:27:25', '2021-04-20 16:27:25'),
(99, 1, 'Căn hộ BT07-02', 'Đã thanh toán tiến độ  đợt 1(Số tiền 6028785800)', 0, 17, '2021-04-20 16:27:53', '2021-04-20 16:27:53'),
(100, 1, 'Công việc mới', 'Tinh chỉnh lại kho dữ liệu', 0, 28, '2021-04-30 12:29:02', '2021-04-30 12:29:02'),
(101, 1, 'Công việc mới', 'Hoàn thiện thông báo, tạo trang ngoài cho kho dữ liệu, tinh tỉnh module tài chính, họp 1 buổi về xây dựng', 0, 26, '2021-05-10 10:09:35', '2021-05-10 10:09:35'),
(102, 3, 'Công văn mới', 'Đã có công văn 21.04.01 Biên bản làm việc  vv bàn giao tiếp nhận hệ thống hạ tầng kỹ thuật dự án GĐ 1 - UBND Huyện', 0, 127, '2021-05-13 08:55:55', '2021-05-13 08:55:55'),
(103, 3, 'Công văn mới', 'Đã có công văn 21.05.11 Số 1160 SXD Thông tin về tổng mức đầu tư dự án GĐ 1', 0, 127, '2021-05-13 08:56:39', '2021-05-13 08:56:39'),
(104, 3, 'Công văn mới', 'Đã có công văn 21.05.11 Số 1650 STNMT Thông báo kết quả kiểm tra điều kiện chuyển nhượng quyền SDĐ LK14-11', 0, 127, '2021-05-13 08:57:10', '2021-05-13 08:57:10'),
(105, 3, 'Công văn mới', 'Đã có công văn 21.05.12 Số 1676 STNMT Xác nhận điều kiện chuyển nhượng quyền sử dụng đất, QSHNO và tài sản khác gắn liền với đất GĐ 1', 0, 127, '2021-05-13 08:57:34', '2021-05-13 08:57:34'),
(106, 1, 'Công việc hoàn thành', 'Tinh chỉnh lại kho dữ liệu', 0, 28, '2021-05-13 09:18:24', '2021-05-13 09:18:24'),
(107, 1, 'Cập nhật bình luận', 'Hoàn thiện thông báo, tạo trang ngoài cho kho dữ liệu, tinh tỉnh module tài chính, họp 1 buổi về xây dựng', 0, 26, '2021-05-19 09:56:53', '2021-05-19 09:56:53'),
(108, 1, 'Công việc hoàn thành', 'Hoàn thiện thông báo, tạo trang ngoài cho kho dữ liệu, tinh tỉnh module tài chính, họp 1 buổi về xây dựng', 0, 26, '2021-05-19 09:57:04', '2021-05-19 09:57:04'),
(109, 1, 'Công việc hoàn thành', 'Hoàn thiện thông báo, tạo trang ngoài cho kho dữ liệu, tinh tỉnh module tài chính, họp 1 buổi về xây dựng', 0, 17, '2021-05-19 09:57:05', '2021-05-19 09:57:05'),
(110, 1, 'Công việc hoàn thành', 'Hoàn thiện thông báo, tạo trang ngoài cho kho dữ liệu, tinh tỉnh module tài chính, họp 1 buổi về xây dựng', 0, 26, '2021-05-19 09:57:05', '2021-05-19 09:57:05'),
(111, 1, 'Công việc mới', 'module xây dựng', 0, 26, '2021-05-19 10:01:02', '2021-05-19 10:01:02'),
(112, 1, 'Công việc mới', 'nghiên cứu mẫu hồ sơ xây dựng', 0, 28, '2021-05-19 10:04:18', '2021-05-19 10:04:18'),
(113, 1, 'Cập nhật bình luận', 'nghiên cứu mẫu hồ sơ xây dựng', 0, 26, '2021-05-19 10:05:48', '2021-05-19 10:05:48'),
(114, 1, 'Cập nhật tiến độ công việc', 'nghiên cứu mẫu hồ sơ xây dựng', 0, 28, '2021-05-21 17:30:04', '2021-05-21 17:30:04'),
(115, 1, 'Cập nhật tiến độ công việc', 'module xây dựng', 0, 17, '2021-05-21 17:31:34', '2021-05-21 17:31:34'),
(116, 1, 'Cập nhật tiến độ công việc', 'module xây dựng', 0, 17, '2021-05-21 17:31:50', '2021-05-21 17:31:50'),
(117, 1, 'Cập nhật bình luận', 'module xây dựng', 0, 26, '2021-05-21 18:16:06', '2021-05-21 18:16:06'),
(118, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT04-02', 0, 142, '2021-05-24 11:03:50', '2021-05-24 11:03:50'),
(119, 1, 'Căn hộ BT04-02', 'Đã  cập nhật Phiếu cọc', 0, 142, '2021-05-24 11:07:45', '2021-05-24 11:07:45'),
(120, 1, 'Căn hộ BT04-02', 'Đã  cập nhật Phiếu cọc', 0, 142, '2021-05-24 11:08:06', '2021-05-24 11:08:06'),
(121, 1, 'Căn hộ BT04-02', 'Đã thanh toán tiến độ  đợt 1(Số tiền 200000000)', 0, 142, '2021-05-24 14:24:09', '2021-05-24 14:24:09'),
(122, 1, 'Cập nhật tiến độ công việc', 'module xây dựng', 0, 17, '2021-05-27 10:57:30', '2021-05-27 10:57:30'),
(123, 1, 'Công việc hoàn thành', 'module xây dựng', 0, 26, '2021-05-29 19:23:30', '2021-05-29 19:23:30'),
(124, 1, 'Công việc hoàn thành', 'module xây dựng', 0, 17, '2021-05-29 19:23:30', '2021-05-29 19:23:30'),
(125, 1, 'Công việc hoàn thành', 'nghiên cứu mẫu hồ sơ xây dựng', 0, 28, '2021-05-29 19:24:04', '2021-05-29 19:24:04'),
(126, 1, 'Công việc hoàn thành', 'nghiên cứu mẫu hồ sơ xây dựng', 0, 26, '2021-05-29 19:24:04', '2021-05-29 19:24:04'),
(127, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT04-07', 0, 142, '2021-05-31 15:57:33', '2021-05-31 15:57:33'),
(128, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT04-01', 0, 142, '2021-06-08 14:01:30', '2021-06-08 14:01:30'),
(129, 1, 'Công việc mới', 'thêm chức năng giao việc cho từng thành viên trong ban quản trị', 0, 17, '2021-06-17 09:35:55', '2021-06-17 09:35:55'),
(130, 1, 'Công việc con mới', 'thêm chức năng giao việc cho từng thành viên trong ban quản trị', 0, 17, '2021-06-17 09:36:14', '2021-06-17 09:36:14'),
(131, 1, 'Công việc con mới', 'thêm chức năng giao việc cho từng thành viên trong ban quản trị', 0, 17, '2021-06-17 09:36:29', '2021-06-17 09:36:29'),
(132, 1, 'Cập nhật tiến độ công việc', 'thêm chức năng giao việc cho từng thành viên trong ban quản trị', 0, 17, '2021-06-17 09:37:03', '2021-06-17 09:37:03'),
(133, 1, 'Công việc mới', 'Test công việc nhỏ', 0, 26, '2021-06-18 10:24:11', '2021-06-18 10:24:11'),
(134, 1, 'Công việc con mới', 'Test công việc nhỏ', 0, 26, '2021-06-18 10:24:45', '2021-06-18 10:24:45'),
(135, 1, 'Công việc con mới', 'Test công việc nhỏ', 0, 26, '2021-06-18 10:24:51', '2021-06-18 10:24:51'),
(136, 1, 'Công việc con mới', 'Test công việc nhỏ', 0, 26, '2021-06-18 10:24:52', '2021-06-18 10:24:52'),
(137, 1, 'Công việc con mới', 'Test công việc nhỏ', 0, 26, '2021-06-18 10:25:50', '2021-06-18 10:25:50'),
(138, 1, 'Cập nhật tiến độ công việc', 'thêm chức năng giao việc cho từng thành viên trong ban quản trị', 0, 26, '2021-06-20 09:42:18', '2021-06-20 09:42:18'),
(139, 1, 'Cập nhật bình luận', 'thêm chức năng giao việc cho từng thành viên trong ban quản trị', 0, 26, '2021-06-20 09:44:55', '2021-06-20 09:44:55'),
(140, 1, 'Công việc mới', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 09:52:20', '2021-06-20 09:52:20'),
(141, 1, 'Công việc con mới', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 09:54:58', '2021-06-20 09:54:58'),
(142, 1, 'Công việc con mới', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 09:56:09', '2021-06-20 09:56:09'),
(143, 1, 'Công việc con mới', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 09:57:26', '2021-06-20 09:57:26'),
(144, 1, 'Công việc con mới', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 09:59:04', '2021-06-20 09:59:04'),
(145, 1, 'Cập nhật tiến độ công việc', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 10:00:06', '2021-06-20 10:00:06'),
(146, 1, 'Cập nhật tiến độ công việc', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 10:00:56', '2021-06-20 10:00:56'),
(147, 1, 'Cập nhật tiến độ công việc', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 10:01:44', '2021-06-20 10:01:44'),
(148, 1, 'Cập nhật tiến độ công việc', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 10:04:15', '2021-06-20 10:04:15'),
(149, 1, 'Cập nhật tiến độ công việc', 'thêm chức năng giao việc cho từng thành viên trong ban quản trị', 0, 26, '2021-06-20 10:06:15', '2021-06-20 10:06:15'),
(150, 1, 'Công việc hoàn thành', 'Test công việc nhỏ', 0, 26, '2021-06-20 10:07:00', '2021-06-20 10:07:00'),
(151, 1, 'Công việc hoàn thành', 'Test công việc nhỏ', 0, 17, '2021-06-20 10:07:01', '2021-06-20 10:07:01'),
(152, 1, 'Công việc hoàn thành', 'Test công việc nhỏ', 0, 26, '2021-06-20 10:07:01', '2021-06-20 10:07:01'),
(153, 1, 'Công việc hoàn thành', 'thêm chức năng giao việc cho từng thành viên trong ban quản trị', 0, 17, '2021-06-20 10:08:25', '2021-06-20 10:08:25'),
(154, 1, 'Công việc hoàn thành', 'thêm chức năng giao việc cho từng thành viên trong ban quản trị', 0, 17, '2021-06-20 10:08:26', '2021-06-20 10:08:26'),
(155, 1, 'Công việc hoàn thành', 'thêm chức năng giao việc cho từng thành viên trong ban quản trị', 0, 26, '2021-06-20 10:08:26', '2021-06-20 10:08:26'),
(156, 1, 'Cập nhật bình luận', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 17, '2021-06-20 10:10:10', '2021-06-20 10:10:10'),
(157, 1, 'Cập nhật bình luận', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 17, '2021-06-20 10:10:51', '2021-06-20 10:10:51'),
(158, 1, 'Cập nhật bình luận', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 10:12:42', '2021-06-20 10:12:42'),
(159, 1, 'Cập nhật bình luận', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 10:13:14', '2021-06-20 10:13:14'),
(160, 1, 'Cập nhật bình luận', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-20 10:14:32', '2021-06-20 10:14:32'),
(161, 1, 'Công việc mới', 'meow', 0, 26, '2021-06-24 12:08:44', '2021-06-24 12:08:44'),
(162, 1, 'Cập nhật bình luận', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-24 12:09:45', '2021-06-24 12:09:45'),
(163, 1, 'Công việc hoàn thành', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-24 12:09:49', '2021-06-24 12:09:49'),
(164, 1, 'Công việc hoàn thành', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 17, '2021-06-24 12:09:49', '2021-06-24 12:09:49'),
(165, 1, 'Công việc hoàn thành', 'Chỉnh sửa giao diện vc đang thực hiện', 0, 26, '2021-06-24 12:09:50', '2021-06-24 12:09:50'),
(166, 1, 'Công việc đã ngưng', 'meow', 0, 26, '2021-06-24 12:09:59', '2021-06-24 12:09:59'),
(167, 1, 'Công việc đã ngưng', 'meow', 0, 26, '2021-06-24 12:10:00', '2021-06-24 12:10:00'),
(168, 1, 'Công việc mới', 'công việc tháng 7', 0, 26, '2021-06-24 12:20:36', '2021-06-24 12:20:36'),
(169, 1, 'Công việc con mới', 'công việc tháng 7', 0, 26, '2021-06-24 12:21:57', '2021-06-24 12:21:57'),
(170, 1, 'Công việc con mới', 'công việc tháng 7', 0, 26, '2021-06-24 12:22:13', '2021-06-24 12:22:13'),
(171, 1, 'Công việc con mới', 'công việc tháng 7', 0, 26, '2021-06-24 12:22:30', '2021-06-24 12:22:30'),
(172, 1, 'Công việc con mới', 'công việc tháng 7', 0, 26, '2021-06-24 12:22:45', '2021-06-24 12:22:45'),
(173, 1, 'Công việc mới', 'Điều chỉnh phần tìm kiếm trong mục bản đồ', 0, 26, '2021-08-21 14:21:53', '2021-08-21 14:21:53'),
(174, 1, 'Công việc hoàn thành', 'công việc tháng 7', 0, 26, '2021-08-21 14:59:23', '2021-08-21 14:59:23'),
(175, 1, 'Công việc hoàn thành', 'công việc tháng 7', 0, 17, '2021-08-21 14:59:23', '2021-08-21 14:59:23'),
(176, 1, 'Công việc hoàn thành', 'công việc tháng 7', 0, 26, '2021-08-21 14:59:24', '2021-08-21 14:59:24'),
(177, 1, 'Cập nhật bình luận', 'Điều chỉnh phần tìm kiếm trong mục bản đồ', 0, 26, '2021-09-01 19:28:51', '2021-09-01 19:28:51'),
(178, 1, 'Cập nhật bình luận', 'Điều chỉnh phần tìm kiếm trong mục bản đồ', 0, 26, '2021-09-01 19:29:13', '2021-09-01 19:29:13'),
(179, 1, 'Cập nhật bình luận', 'Điều chỉnh phần tìm kiếm trong mục bản đồ', 0, 26, '2021-09-01 19:31:20', '2021-09-01 19:31:20'),
(180, 1, 'Công việc con mới', 'Điều chỉnh phần tìm kiếm trong mục bản đồ', 0, 26, '2021-09-01 19:32:56', '2021-09-01 19:32:56'),
(181, 1, 'Công việc con mới', 'Điều chỉnh phần tìm kiếm trong mục bản đồ', 0, 26, '2021-09-01 19:33:16', '2021-09-01 19:33:16'),
(182, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-18', 0, 159, '2021-09-07 14:46:52', '2021-09-07 14:46:52'),
(183, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT02-17', 0, 158, '2021-09-07 14:52:47', '2021-09-07 14:52:47'),
(184, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT07-02', 0, 17, '2021-09-07 16:37:47', '2021-09-07 16:37:47'),
(185, 1, 'Căn hộ BT02-18', 'Đã  cập nhật Phiếu cọc', 0, 159, '2021-09-07 16:46:13', '2021-09-07 16:46:13'),
(186, 1, 'Căn hộ BT02-18', 'Đã  cập nhật Hợp đồng chuyển nhượng quyền sử dụng đất nền', 0, 26, '2021-09-09 10:31:48', '2021-09-09 10:31:48'),
(187, 1, 'Cập nhật bình luận', 'Hoàn thiện thông báo, tạo trang ngoài cho kho dữ liệu, tinh tỉnh module tài chính, họp 1 buổi về xây dựng', 0, 26, '2021-09-13 16:15:50', '2021-09-13 16:15:50'),
(188, 1, 'Cập nhật bình luận', 'Hoàn thiện thông báo, tạo trang ngoài cho kho dữ liệu, tinh tỉnh module tài chính, họp 1 buổi về xây dựng', 0, 26, '2021-09-13 16:16:14', '2021-09-13 16:16:14'),
(189, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-08', 0, 28, '2021-09-18 10:25:50', '2021-09-18 10:25:50'),
(190, 1, 'Căn hộ BT05-08', 'Đã thanh toán tiến độ  đợt 1(Số tiền 200000000000)', 0, 28, '2021-09-18 11:42:58', '2021-09-18 11:42:58'),
(191, 1, 'Căn hộ BT05-08', 'Đã thanh toán tiến độ  đợt 1(Số tiền 200000000)', 0, 28, '2021-09-18 11:43:24', '2021-09-18 11:43:24'),
(192, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-09', 0, 17, '2021-09-30 19:44:22', '2021-09-30 19:44:22'),
(193, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-07', 0, 161, '2021-10-01 04:59:52', '2021-10-01 04:59:52'),
(194, 1, 'Căn hộ BT05-09', 'Đã thanh toán tiến độ  đợt 1(Số tiền 200000000)', 0, 17, '2021-10-01 07:31:26', '2021-10-01 07:31:26'),
(195, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-10', 0, 161, '2021-10-01 07:41:46', '2021-10-01 07:41:46'),
(196, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-11', 0, 161, '2021-10-01 07:44:59', '2021-10-01 07:44:59'),
(197, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-06', 0, 161, '2021-10-01 07:46:51', '2021-10-01 07:46:51'),
(198, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-05', 0, 161, '2021-10-01 10:59:26', '2021-10-01 10:59:26'),
(199, 0, 'Cập nhật bình luận', 'BT05-05', 0, 168, '2021-10-01 11:03:12', '2021-10-01 11:03:12'),
(200, 1, 'Hủy hợp đồng', 'Hủy hợp đồng BT05-11', 0, 17, '2021-10-01 19:43:20', '2021-10-01 19:43:20'),
(201, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT05-11', 0, 161, '2021-10-03 07:09:08', '2021-10-03 07:09:08'),
(202, 1, 'Hợp đồng mới', 'Đã kí hợp đồng nhà BT06-03', 0, 17, '2021-10-03 10:12:01', '2021-10-03 10:12:01'),
(203, 1, 'Công việc mới', 'việc 1', 0, 17, '2021-10-03 10:17:31', '2021-10-03 10:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `event_noti`
--

CREATE TABLE `event_noti` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` smallint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event_noti`
--

INSERT INTO `event_noti` (`id`, `event_id`, `user_id`, `seen`, `created_at`, `updated_at`) VALUES
(1, 196, 1, 1, '2021-05-06 02:09:26', '2021-05-06 02:09:26'),
(2, 196, 2, 1, '2021-05-06 02:09:26', '2021-05-06 02:09:26'),
(3, 196, 26, 1, '2021-05-06 02:09:26', '2021-05-06 02:09:26'),
(4, 196, 28, 1, '2021-05-06 02:09:26', '2021-05-06 02:09:26'),
(5, 196, 29, 1, '2021-05-06 02:09:26', '2021-05-06 02:09:26'),
(6, 196, 119, 1, '2021-05-06 02:09:26', '2021-05-06 02:09:26'),
(7, 196, 122, 1, '2021-05-06 02:09:26', '2021-05-06 02:09:26'),
(8, 196, 123, 1, '2021-05-06 02:09:26', '2021-05-06 02:09:26'),
(9, 196, 124, 1, '2021-05-06 02:09:26', '2021-05-06 02:09:26'),
(10, 102, 1, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(11, 102, 2, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(12, 102, 17, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(13, 102, 26, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(14, 102, 28, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(15, 102, 29, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(16, 102, 118, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(17, 102, 119, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(18, 102, 122, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(19, 102, 123, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(20, 102, 124, 1, '2021-05-13 01:55:55', '2021-05-13 01:55:55'),
(21, 103, 1, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(22, 103, 2, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(23, 103, 17, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(24, 103, 26, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(25, 103, 28, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(26, 103, 29, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(27, 103, 118, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(28, 103, 119, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(29, 103, 122, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(30, 103, 123, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(31, 103, 124, 1, '2021-05-13 01:56:39', '2021-05-13 01:56:39'),
(32, 104, 1, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(33, 104, 2, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(34, 104, 17, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(35, 104, 26, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(36, 104, 28, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(37, 104, 29, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(38, 104, 118, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(39, 104, 119, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(40, 104, 122, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(41, 104, 123, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(42, 104, 124, 1, '2021-05-13 01:57:10', '2021-05-13 01:57:10'),
(43, 105, 1, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(44, 105, 2, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(45, 105, 17, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(46, 105, 26, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(47, 105, 28, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(48, 105, 29, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(49, 105, 118, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(50, 105, 119, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(51, 105, 122, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(52, 105, 123, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(53, 105, 124, 1, '2021-05-13 01:57:34', '2021-05-13 01:57:34'),
(54, 118, 1, 1, '2021-05-24 04:03:50', '2021-05-24 04:03:50'),
(55, 118, 2, 1, '2021-05-24 04:03:51', '2021-05-24 04:03:51'),
(56, 118, 17, 1, '2021-05-24 04:03:51', '2021-05-24 04:03:51'),
(57, 118, 26, 1, '2021-05-24 04:03:51', '2021-05-24 04:03:51'),
(58, 118, 28, 1, '2021-05-24 04:03:51', '2021-05-24 04:03:51'),
(59, 118, 29, 1, '2021-05-24 04:03:51', '2021-05-24 04:03:51'),
(60, 118, 118, 1, '2021-05-24 04:03:51', '2021-05-24 04:03:51'),
(61, 118, 119, 1, '2021-05-24 04:03:51', '2021-05-24 04:03:51'),
(62, 118, 122, 1, '2021-05-24 04:03:51', '2021-05-24 04:03:51'),
(63, 118, 123, 1, '2021-05-24 04:03:51', '2021-05-24 04:03:51'),
(64, 118, 124, 1, '2021-05-24 04:03:51', '2021-05-24 04:03:51'),
(65, 127, 1, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(66, 127, 2, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(67, 127, 17, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(68, 127, 26, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(69, 127, 28, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(70, 127, 29, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(71, 127, 118, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(72, 127, 119, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(73, 127, 122, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(74, 127, 123, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(75, 127, 124, 1, '2021-05-31 08:57:33', '2021-05-31 08:57:33'),
(76, 128, 1, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(77, 128, 2, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(78, 128, 17, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(79, 128, 26, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(80, 128, 28, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(81, 128, 29, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(82, 128, 118, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(83, 128, 119, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(84, 128, 122, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(85, 128, 123, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(86, 128, 124, 1, '2021-06-08 07:01:30', '2021-06-08 07:01:30'),
(87, 182, 1, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(88, 182, 2, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(89, 182, 17, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(90, 182, 26, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(91, 182, 28, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(92, 182, 29, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(93, 182, 118, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(94, 182, 119, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(95, 182, 122, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(96, 182, 123, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(97, 182, 124, 1, '2021-09-07 07:46:52', '2021-09-07 07:46:52'),
(98, 183, 1, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(99, 183, 2, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(100, 183, 17, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(101, 183, 26, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(102, 183, 28, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(103, 183, 29, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(104, 183, 118, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(105, 183, 119, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(106, 183, 122, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(107, 183, 123, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(108, 183, 124, 1, '2021-09-07 07:52:47', '2021-09-07 07:52:47'),
(109, 184, 1, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(110, 184, 2, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(111, 184, 17, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(112, 184, 26, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(113, 184, 28, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(114, 184, 29, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(115, 184, 118, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(116, 184, 119, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(117, 184, 122, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(118, 184, 123, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(119, 184, 124, 1, '2021-09-07 09:37:47', '2021-09-07 09:37:47'),
(120, 189, 1, 1, '2021-09-18 03:25:50', '2021-09-18 03:25:50'),
(121, 189, 2, 1, '2021-09-18 03:25:50', '2021-09-18 03:25:50'),
(122, 189, 17, 1, '2021-09-18 03:25:51', '2021-09-18 03:25:51'),
(123, 189, 26, 1, '2021-09-18 03:25:51', '2021-09-18 03:25:51'),
(124, 189, 28, 1, '2021-09-18 03:25:51', '2021-09-18 03:25:51'),
(125, 189, 29, 1, '2021-09-18 03:25:51', '2021-09-18 03:25:51'),
(126, 189, 118, 1, '2021-09-18 03:25:51', '2021-09-18 03:25:51'),
(127, 189, 119, 1, '2021-09-18 03:25:51', '2021-09-18 03:25:51'),
(128, 189, 122, 1, '2021-09-18 03:25:51', '2021-09-18 03:25:51'),
(129, 189, 123, 1, '2021-09-18 03:25:51', '2021-09-18 03:25:51'),
(130, 189, 124, 1, '2021-09-18 03:25:51', '2021-09-18 03:25:51'),
(131, 189, 159, 1, '2021-09-18 03:25:51', '2021-09-18 03:25:51'),
(132, 192, 1, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(133, 192, 2, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(134, 192, 17, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(135, 192, 26, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(136, 192, 28, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(137, 192, 29, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(138, 192, 118, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(139, 192, 119, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(140, 192, 122, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(141, 192, 123, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(142, 192, 124, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(143, 192, 159, 1, '2021-09-30 12:44:22', '2021-09-30 12:44:22'),
(144, 193, 1, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(145, 193, 2, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(146, 193, 17, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(147, 193, 26, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(148, 193, 28, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(149, 193, 29, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(150, 193, 118, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(151, 193, 119, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(152, 193, 122, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(153, 193, 123, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(154, 193, 124, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(155, 193, 159, 1, '2021-09-30 21:59:52', '2021-09-30 21:59:52'),
(156, 195, 1, 1, '2021-10-01 00:41:46', '2021-10-01 00:41:46'),
(157, 195, 2, 1, '2021-10-01 00:41:46', '2021-10-01 00:41:46'),
(158, 195, 17, 1, '2021-10-01 00:41:46', '2021-10-01 00:41:46'),
(159, 195, 26, 1, '2021-10-01 00:41:46', '2021-10-01 00:41:46'),
(160, 195, 28, 1, '2021-10-01 00:41:46', '2021-10-01 00:41:46'),
(161, 195, 29, 1, '2021-10-01 00:41:46', '2021-10-01 00:41:46'),
(162, 195, 118, 1, '2021-10-01 00:41:46', '2021-10-01 00:41:46'),
(163, 195, 119, 1, '2021-10-01 00:41:47', '2021-10-01 00:41:47'),
(164, 195, 122, 1, '2021-10-01 00:41:47', '2021-10-01 00:41:47'),
(165, 195, 123, 1, '2021-10-01 00:41:47', '2021-10-01 00:41:47'),
(166, 195, 124, 1, '2021-10-01 00:41:47', '2021-10-01 00:41:47'),
(167, 195, 159, 1, '2021-10-01 00:41:47', '2021-10-01 00:41:47'),
(168, 196, 1, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(169, 196, 2, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(170, 196, 17, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(171, 196, 26, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(172, 196, 28, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(173, 196, 29, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(174, 196, 118, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(175, 196, 119, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(176, 196, 122, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(177, 196, 123, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(178, 196, 124, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(179, 196, 159, 1, '2021-10-01 00:44:59', '2021-10-01 00:44:59'),
(180, 197, 1, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(181, 197, 2, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(182, 197, 17, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(183, 197, 26, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(184, 197, 28, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(185, 197, 29, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(186, 197, 118, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(187, 197, 119, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(188, 197, 122, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(189, 197, 123, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(190, 197, 124, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(191, 197, 159, 1, '2021-10-01 00:46:51', '2021-10-01 00:46:51'),
(192, 198, 1, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(193, 198, 2, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(194, 198, 17, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(195, 198, 26, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(196, 198, 28, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(197, 198, 29, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(198, 198, 118, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(199, 198, 119, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(200, 198, 122, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(201, 198, 123, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(202, 198, 124, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(203, 198, 159, 1, '2021-10-01 03:59:26', '2021-10-01 03:59:26'),
(204, 200, 1, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(205, 200, 2, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(206, 200, 17, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(207, 200, 26, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(208, 200, 28, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(209, 200, 29, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(210, 200, 118, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(211, 200, 119, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(212, 200, 122, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(213, 200, 123, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(214, 200, 124, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(215, 200, 159, 1, '2021-10-01 12:43:20', '2021-10-01 12:43:20'),
(216, 201, 1, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(217, 201, 2, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(218, 201, 17, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(219, 201, 26, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(220, 201, 28, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(221, 201, 29, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(222, 201, 118, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(223, 201, 119, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(224, 201, 122, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(225, 201, 123, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(226, 201, 124, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(227, 201, 159, 1, '2021-10-03 00:09:08', '2021-10-03 00:09:08'),
(228, 202, 1, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(229, 202, 2, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(230, 202, 17, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(231, 202, 26, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(232, 202, 28, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(233, 202, 29, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(234, 202, 118, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(235, 202, 119, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(236, 202, 122, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(237, 202, 123, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(238, 202, 124, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01'),
(239, 202, 159, 1, '2021-10-03 03:12:01', '2021-10-03 03:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
(17459454, 28, 17, '2021-03-20 10:34:13', '2021-03-20 10:34:13'),
(73922537, 17, 26, '2021-03-25 12:36:32', '2021-03-25 12:36:32'),
(75045460, 17, 28, '2021-03-17 14:09:23', '2021-03-17 14:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_noti`
--

CREATE TABLE `file_noti` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` smallint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance_input`
--

CREATE TABLE `finance_input` (
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

-- --------------------------------------------------------

--
-- Table structure for table `finance_input_type`
--

CREATE TABLE `finance_input_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `finance_input_type`
--

INSERT INTO `finance_input_type` (`id`, `name`, `description`, `updated_at`, `created_at`) VALUES
(1, 'Tiền mặt', 'Tiền bán biệt thự', '2020-12-08 14:25:15', '2020-12-08 14:25:15'),
(4, 'Góp vốn', NULL, '2021-04-13 10:49:16', '2021-04-13 10:49:16'),
(5, 'Nguồn cổ đông góp vốn', NULL, '2021-04-13 10:50:43', '2021-04-13 10:50:43'),
(6, 'Nguồn vay tín dụng', NULL, '2021-04-13 10:50:59', '2021-04-13 10:50:59'),
(7, 'Huy động vốn', NULL, '2021-04-13 11:09:47', '2021-04-13 11:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `finance_output`
--

CREATE TABLE `finance_output` (
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

-- --------------------------------------------------------

--
-- Table structure for table `finance_output_type`
--

CREATE TABLE `finance_output_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance_tax`
--

CREATE TABLE `finance_tax` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `des` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `total` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance_tax_file`
--

CREATE TABLE `finance_tax_file` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fintem`
--

CREATE TABLE `fintem` (
  `id` int(11) NOT NULL,
  `stt` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `myid` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `money` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fintem`
--

INSERT INTO `fintem` (`id`, `stt`, `name`, `des`, `myid`, `money`, `created_at`, `updated_at`) VALUES
(937, 'A', 'Thu trong ngày (I+II+III)', NULL, NULL, '=D3+D6+D9', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(938, 'I', 'Góp vốn', NULL, 'A.1', '=SUM(D4:D5)', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(939, '1', 'Bà Phạm Thị Kim Ngân Nộp tiền xây thô và tiền đất LK17-03', NULL, 'A.1.1', '262083592', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(940, '2', NULL, NULL, 'A.1.2', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(941, 'II', 'Tiền vay ', NULL, 'A.2', '=SUM(D7:D8)', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(942, '1', 'Ngân hàng A', NULL, 'A.2.1', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(943, '2', 'Ngân hàng B', NULL, 'A.2.3', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(944, 'III', 'Thu khác (điện, nước …)', NULL, 'A.3', '=SUM(D10)', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(945, NULL, 'Thu CBCNV Hoàn ứng lương', NULL, 'A.3.1', '11000000', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(946, 'B', 'Chi trong ngày (I+II+III+IV+V)', NULL, NULL, '=D12+D21+D24+D26+D30', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(947, 'I', 'Chi phí hoạt động', NULL, 'B.1', '=SUM(D13:D20)', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(948, '1', 'Tiền lương tháng 04/2021 + Tiền lễ 30/4', NULL, 'B.1.1', '=427646430+15916666', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(949, '2', 'Điện, nước, Internet, dịch vụ mua ngoài', NULL, 'B.1.2', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(950, '3', 'Tiếp khách', NULL, 'B.1.3', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(951, '4', 'Chi phí cho biệt thự (phục vụ lãnh đạo, tiếp khách …)', NULL, 'B.1.4', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(952, '5', 'Chi mua công cụ, dụng cụ', NULL, 'B.1.5', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(953, '6', 'Chi phí xe Ô Tô ( Xăng dâu, vé cầu,..)', NULL, 'B.1.6', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(954, '7', 'Chi tiền ăn CBCNV', NULL, 'B.1.7', '5570000', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(955, '8', 'Chi khác', NULL, 'B.1.8', '1380000', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(956, 'II', 'Chi cho các nhà thầu', NULL, 'B.2', '=SUM(D22:D23)', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(957, '1', 'Sữa chữa khu vui chơi trẻ em', NULL, 'B.2.1', '4850000', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(958, '2', 'Xây thô và hoàn thiện mặt ngoài Lô LK17-03', NULL, 'B.2.2', '6047943', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(959, 'III', 'Chi phí dự án Hòa Bình', NULL, 'B.3', '=SUM(D25)', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(960, '1', NULL, NULL, 'B.3.1', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(961, 'IV', 'Chi tạm ứng', NULL, 'B.4', '=SUM(D27:D29)', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(962, '1', 'Mr Chiến', NULL, 'B.4.1', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(963, '2', NULL, NULL, 'B.4.2', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(964, '3', NULL, NULL, 'B.4.3', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(965, 'V', 'Chi khác ', NULL, 'B.5', '=SUM(D31)', '2021-04-29 16:00:59', '2021-04-29 16:00:59'),
(966, '1', NULL, NULL, 'B.5.1', NULL, '2021-04-29 16:00:59', '2021-04-29 16:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `history_zone`
--

CREATE TABLE `history_zone` (
  `id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_small` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_zone_tag`
--

CREATE TABLE `history_zone_tag` (
  `id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '17',
  `department_id` int(11) NOT NULL,
  `type_id` int(2) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `start_date` date DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `end_date` date DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_comments`
--

CREATE TABLE `job_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_comments_url`
--

CREATE TABLE `job_comments_url` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_imgs`
--

CREATE TABLE `job_imgs` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'tést',
  `job_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url_resize` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_init`
--

CREATE TABLE `job_init` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_moniters`
--

CREATE TABLE `job_moniters` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jobs_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_noti`
--

CREATE TABLE `job_noti` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` smallint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_tag`
--

CREATE TABLE `job_tag` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_task`
--

CREATE TABLE `job_task` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `flag` int(1) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_task_imgs`
--

CREATE TABLE `job_task_imgs` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'test',
  `task_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url_resize` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_task_users`
--

CREATE TABLE `job_task_users` (
  `id` int(11) NOT NULL,
  `task_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_users`
--

CREATE TABLE `job_users` (
  `id` int(11) NOT NULL,
  `job_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `legal_form`
--

CREATE TABLE `legal_form` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `legal_form`
--

INSERT INTO `legal_form` (`id`, `name`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Thỏa thuận đặt cọc', NULL, '2021-01-02 08:43:12', '2021-01-02 08:43:12'),
(2, 'HĐMB/HĐCN', '/storage/system/6y80g9Gdyfm7xvebqASLSz3doDlLRjjf3ASBXXMv.doc', '2021-01-02 08:43:12', '2021-01-02 08:43:12'),
(3, 'Phụ lục giá và tiến độ thanh toán', NULL, '2021-01-02 08:43:57', '2021-01-02 08:43:57'),
(4, 'Phụ lục sơ đồ mặt bằng căn hộ, tầng căn hộ, tòa nhà (Chung cư) ', NULL, '2021-01-02 08:43:57', '2021-01-02 08:43:57'),
(7, 'Phụ lục Quản lý sử dụng chung cư (Chung cư)/ Quy định quản lý nhà ở', NULL, '2021-01-02 08:44:23', '2021-01-02 08:44:23'),
(9, 'Mẫu Hồ sơ bảo lãnh Ngân hàng', NULL, '2021-01-02 08:45:00', '2021-01-02 08:45:00'),
(11, 'Hợp đồng góp vốn xây thô', '/storage/system/9RIkowU6prokjOLrdpodFc994ocYpdAJYyx9VFEk.docx', '2021-03-07 07:13:55', '2021-03-07 07:13:55'),
(12, 'Hợp đồng góp vốn không  xây thô', '/storage/system/3BtTN3PUVC9qan8nygdU2vas6RJycY1XbzOIZT5I.docx', '2021-03-07 07:14:08', '2021-03-07 07:14:08'),
(13, 'Hợp đồng chuyển nhượng', '/storage/system/abI3Wro9A32oMxKa6om1yWPR7UYoHM0puyTXuFDw.doc', '2021-03-07 07:14:32', '2021-03-07 07:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reply_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `reply_id`, `user_id`, `created_at`, `updated_at`) VALUES
(20, 9, 2, '2021-01-15 09:23:58', '2021-01-15 09:23:58'),
(22, 9, 17, '2021-01-28 08:25:55', '2021-01-28 08:25:55'),
(23, 9, 26, '2021-01-29 09:33:09', '2021-01-29 09:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `map_config`
--

CREATE TABLE `map_config` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT '1',
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `map_config`
--

INSERT INTO `map_config` (`id`, `project_id`, `name`, `zone`, `created_at`, `updated_at`) VALUES
(505, 4, 'BT06-1', '\"216.70323012503235,98.50146823865107,214.94427533505643,110.81415176848245,202.63159180522507,109.40698793650172,204.74233755319617,96.74251344867515,216.70323012503235,98.1496772806559\"', '2021-10-06 02:59:26', '2021-10-06 02:59:26'),
(506, 4, 'BT06-2', '\"204.03875563720578,96.74251344867515,192.0778630653696,94.98355865869925,190.67069923338886,106.24086931454508,200.87263701524915,109.05519697850654\"', '2021-10-06 02:59:54', '2021-10-06 02:59:54'),
(507, 4, 'BT06-3', '\"192.0778630653696,95.68714057468961,179.7651795355382,93.9281857847137,176.95085187157673,105.53728739855472,189.6153263594033,107.999824104521\"', '2021-10-06 03:00:20', '2021-10-06 03:00:20'),
(508, 4, 'BT06-4', '\"179.41338857754303,92.16923099473779,166.74891408971646,91.11385812075224,165.34175025773573,104.83370548256435,178.0062247455623,105.18549644055953\"', '2021-10-06 03:01:36', '2021-10-06 03:01:36'),
(509, 4, 'BT06-5', '\"166.74891408971646,91.11385812075224,154.78802151788025,90.41027620476187,153.02906672790434,101.66758686060771,164.28637738375016,104.13012356657399\"', '2021-10-06 03:02:11', '2021-10-06 03:02:11'),
(510, 4, 'BT06-6', '\"154.43623055988508,91.11385812075224,142.82712894604404,88.65132141478597,140.36459224007777,100.61221398662217,151.27011193792842,102.01937781860289\"', '2021-10-06 03:03:13', '2021-10-06 03:03:13'),
(511, 4, 'BT06-7', '\"142.1235470300537,88.65132141478597,129.45907254222712,86.89236662481005,127.7001177522512,99.20505015464144,138.95742840809706,100.96400494461734\"', '2021-10-06 03:03:42', '2021-10-06 03:03:42'),
(512, 4, 'BT06-8', '\"129.45907254222712,87.24415758280523,117.49817997039092,84.42982991884378,115.38743422241983,96.74251344867515,126.64474487826566,98.50146823865107\"', '2021-10-06 03:04:08', '2021-10-06 03:04:08'),
(513, 4, 'BT06-9', '\"116.44280709640537,84.42982991884378,104.13012356657399,83.02266608686304,102.37116877659808,95.68714057468961,114.68385230642946,97.44609536466552\"', '2021-10-06 03:06:37', '2021-10-06 03:06:37'),
(514, 4, 'BT06-10', '\"104.83370548256435,83.72624800285341,90.0584852467667,81.9672932128775,91.11385812075224,94.98355865869925,102.01937781860289,96.74251344867515\"', '2021-10-06 03:07:45', '2021-10-06 03:07:45'),
(515, 4, 'BT06-11', '\"89.35490333077632,80.91192033889195,73.17251926299794,79.50475650691122,80.20833842290159,99.20505015464144,91.46564907874742,97.09430440667035\"', '2021-10-06 03:08:14', '2021-10-06 03:08:14'),
(516, 4, '01', '\"571.4884081342018,303.0848813587719\"', '2021-10-06 03:08:57', '2021-10-06 03:08:57'),
(518, 4, 'SH01-24', '\"576.5146914071498,306.6032796498356,579.0278330436239,301.57699637688745,567.4673815158433,296.04808477664454,566.4621248612536,301.57699637688745\"', '2021-10-06 03:10:59', '2021-10-06 03:10:59'),
(519, 4, 'BT06-12', '\"72.82072830500276,79.50475650691122,50.30610699331108,77.04221980094495,71.06177351502684,104.83370548256435,81.26371129688714,99.55684111263662\"', '2021-10-06 03:11:03', '2021-10-06 03:11:03'),
(520, 4, 'BT06-13', '\"50.30610699331108,77.04221980094495,36.234468673503784,74.93147405297385,34.475513883527874,91.46564907874742,62.618790523142465,112.22131560046319,71.06177351502684,104.48191452456918\"', '2021-10-06 03:11:50', '2021-10-06 03:11:50'),
(521, 4, 'SH01-12', '\"575.5094347525602,307.1059079771304,578.0225763890343,301.07436804959264,590.0856562441098,308.61379295901486,587.5725146076358,310.62430626819406,583.0488596619824,312.1321912500785\"', '2021-10-06 03:12:03', '2021-10-06 03:12:03'),
(522, 4, 'BT06-14', '\"35.17909579951824,91.11385812075224,32.012977177561595,110.81415176848245,58.397299027200276,122.42325338232347,62.97058148113765,111.16594272647764\"', '2021-10-06 03:12:53', '2021-10-06 03:12:53'),
(524, 4, 'BT06-15', '\"32.36476813555678,110.81415176848245,29.55044047159532,129.45907254222712,54.87938944724845,132.62519116418378,58.397299027200276,121.01608955034274\"', '2021-10-06 03:14:15', '2021-10-06 03:14:15'),
(525, 4, 'BT06-16', '\"29.55044047159532,127.7001177522512,27.79148568161941,141.06817415606815,54.17580753125809,145.2896656520103,55.58297136323882,131.9216092481934\"', '2021-10-06 03:14:40', '2021-10-06 03:14:40'),
(527, 4, 'BT06-17', '\"28.846858555604957,141.7717560720585,26.736112807633862,154.0844396018899,51.36147986729663,158.3059310978321,53.472225615267725,144.58608373601996\"', '2021-10-06 03:14:59', '2021-10-06 03:14:59'),
(528, 4, 'SH01-1', '\"598.1277094808268,269.40878343001947,599.6355944627112,266.3930134662506,611.6986743177868,273.9324383756728,608.180276026723,275.942951684852\"', '2021-10-06 03:15:18', '2021-10-06 03:15:18'),
(529, 4, 'BT06-18', '\"26.38432184963868,153.02906672790434,24.97715801765795,165.6935412157309,50.65789795130627,171.32219654365383,52.06506178328699,157.95414013983688,26.032530891643496,154.43623055988508\"', '2021-10-06 03:15:30', '2021-10-06 03:15:30'),
(530, 4, 'BT06-19', '\"25.328948975653134,166.74891408971646,50.30610699331108,170.61861462766345,48.89894316133035,182.22771624150448,23.921785143672402,181.17234336751892\"', '2021-10-06 03:15:56', '2021-10-06 03:15:56'),
(532, 4, 'BT06-20', '\"23.56999418567722,180.82055240952374,21.811039395701307,191.37428114937921,47.491779329349626,195.5957726453214,48.54715220333517,182.22771624150448\"', '2021-10-06 03:16:15', '2021-10-06 03:16:15'),
(533, 4, 'BT06-21', '\"47.13998837135444,194.54039977133587,23.21820322768204,191.37428114937921,20.75566652171576,203.6869646792106,45.02924262338335,208.61203809114315\"', '2021-10-06 03:16:36', '2021-10-06 03:16:36'),
(534, 4, 'SH01-2', '\"596.6198244989423,272.9271817210832,598.1277094808268,269.9114117573143,609.1855326813127,276.4455800121468,606.6723910448386,279.4613499759157\"', '2021-10-06 03:16:45', '2021-10-06 03:16:45'),
(535, 4, 'BT06-22', '\"45.73282453937371,207.9084561751528,20.40387556372058,204.39054659520096,18.293129815749484,215.999648209042,45.02924262338335,221.27651257896972\"', '2021-10-06 03:16:59', '2021-10-06 03:16:59'),
(537, 4, 'BT07-1', '\"216.35143916703717,119.9607166763572,189.9671173173985,116.44280709640537,187.15278965343703,130.51444541621268,216.35143916703717,135.43951882814522,218.81397587300344,122.77504434031866\"', '2021-10-06 03:17:44', '2021-10-06 03:17:44'),
(538, 4, 'BT07-2', '\"189.26353540140812,116.09101613841018,157.6023491818417,111.869524642468,155.8433943918658,126.29295392027048,187.15278965343703,130.16265445821747\"', '2021-10-06 03:18:01', '2021-10-06 03:18:01'),
(540, 4, 'BT07-3', '\"157.25055822384653,110.11056985249209,126.64474487826566,107.29624218853063,124.53399913029456,121.71967146633311,155.4916034338706,125.9411629622753\"', '2021-10-06 03:18:26', '2021-10-06 03:18:26'),
(541, 4, 'SH01-3', '\"594.6093111897632,275.942951684852,596.1171961716475,272.9271817210832,607.1750193721334,279.4613499759157,605.1645060629542,281.9744916123898\"', '2021-10-06 03:18:43', '2021-10-06 03:18:43'),
(542, 4, 'BT07-4', '\"126.29295392027048,107.6480331465258,95.68714057468961,103.42654165058363,92.87281291072816,104.48191452456918,95.33534961669443,118.90534380237165,100.96400494461734,119.25713476036682,124.88579008828975,122.77504434031866\"', '2021-10-06 03:19:07', '2021-10-06 03:19:07'),
(543, 4, 'SH01-4', '\"592.5987978805839,279.4613499759157,594.1066828624683,275.942951684852,605.1645060629542,281.9744916123898,602.6513644264801,285.4928899034535\"', '2021-10-06 03:19:17', '2021-10-06 03:19:17'),
(544, 4, 'BT07-5', '\"92.87281291072816,103.77833260857881,76.69042884294976,110.11056985249209,65.7849091450991,123.47862625630901,78.80117459092085,131.21802733220304,85.13341183483413,123.12683529831384,93.9281857847137,119.25713476036682\"', '2021-10-06 03:19:51', '2021-10-06 03:19:51'),
(545, 4, 'SH01-5', '\"590.5882845714046,282.4771199396846,592.0961695532891,279.4613499759157,603.1539927537749,285.99551823074825,600.6408511173008,289.51391652181195\"', '2021-10-06 03:19:58', '2021-10-06 03:19:58'),
(546, 4, 'BT07-6', '\"64.72953627111356,124.88579008828975,79.50475650691122,130.51444541621268,75.28326501096903,160.76846780379836,59.10088094319064,158.65772205582726,61.56341764915692,138.95742840809706\"', '2021-10-06 03:20:13', '2021-10-06 03:20:13'),
(548, 4, 'BT07-7', '\"75.28326501096903,160.41667684580318,59.10088094319064,158.3059310978321,55.58297136323882,190.67069923338886,58.397299027200276,193.4850268973503,65.7849091450991,193.8368178553455,71.41356447302202,192.78144498135995\"', '2021-10-06 03:22:12', '2021-10-06 03:22:12'),
(550, 4, 'BT08-1', '\"201.22442797324433,162.87921355176945,205.09412851119134,169.9150327116731,199.11368222527324,175.8954789975912,192.78144498135995,186.0974167794515,188.2081625274226,186.80099869544185,175.54368803959602,183.28308911549001,161.4720497197887,179.7651795355382,164.63816834174537,150.56653002193806,182.57950719949966,156.54697630785617\"', '2021-10-06 03:23:02', '2021-10-06 03:23:02'),
(551, 4, 'BT08-2', '\"164.28637738375016,151.6219028959236,145.64145661000552,151.27011193792842,124.88579008828975,160.06488588780797,134.38414595415966,183.63488007348522,147.7522023579766,180.82055240952374,162.52742259377428,180.82055240952374\"', '2021-10-06 03:23:25', '2021-10-06 03:23:25'),
(552, 4, 'SH01-6', '\"589.0803995895202,285.99551823074825,590.5882845714046,281.9744916123898,601.6461077718905,289.51391652181195,599.1329661354164,292.027058158286\"', '2021-10-06 03:23:47', '2021-10-06 03:23:47'),
(553, 4, 'BT08-3', '\"124.53399913029456,158.3059310978321,111.869524642468,168.85965983768756,97.09430440667035,183.9866710314804,107.999824104521,198.41010030928288,120.66429859234756,188.2081625274226,135.08772787015005,183.63488007348522\"', '2021-10-06 03:23:52', '2021-10-06 03:23:52'),
(554, 4, 'BT08-4', '\"96.39072249067998,184.33846198947558,107.6480331465258,198.05830935128768,96.74251344867515,209.6674109651287,83.02266608686304,221.6283035369649,70.0064006410413,201.22442797324433,84.07803896084859,193.4850268973503\"', '2021-10-06 03:24:15', '2021-10-06 03:24:15'),
(555, 4, 'SH01-7', '\"586.0646296257513,289.01128819451714,588.0751429349306,285.99551823074825,599.6355944627112,292.52968648558084,596.1171961716475,295.54545644934973\"', '2021-10-06 03:24:23', '2021-10-06 03:24:23'),
(556, 4, 'BT08-5', '\"69.65460968304612,201.9280098892347,56.990135195219544,201.22442797324433,53.472225615267725,204.74233755319617,49.9543160353159,229.36770461285892,49.250734119325536,238.86606047872885,52.76864369927736,244.14292484865658,82.31908417087269,221.6283035369649\"', '2021-10-06 03:24:45', '2021-10-06 03:24:45'),
(557, 4, 'SH01-8', '\"585.0593729711617,292.027058158286,586.5672579530461,289.51391652181195,597.1224528262371,295.54545644934973,595.111939517058,298.05859808582375\"', '2021-10-06 03:25:00', '2021-10-06 03:25:00'),
(558, 4, 'BT05-1', '\"378.52707080281624,119.25713476036682,366.91796918897523,118.20176188638128,364.10364152501376,129.45907254222712,377.11990697083553,130.86623637420786\"', '2021-10-06 03:25:26', '2021-10-06 03:25:26'),
(559, 4, 'SH01-9', '\"583.0488596619824,296.04808477664454,585.0593729711617,292.52968648558084,596.1171961716475,298.56122641311856,594.1066828624683,302.07962470418227\"', '2021-10-06 03:25:32', '2021-10-06 03:25:32'),
(560, 4, 'BT05-2', '\"366.56617823098003,117.14638901239573,353.90170374315346,115.739225180415,352.49453991117275,127.7001177522512,365.1590143989993,129.10728158423194\"', '2021-10-06 03:25:46', '2021-10-06 03:25:46'),
(561, 4, 'SH01-10', '\"581.540974680098,299.5664830677082,583.0488596619824,296.04808477664454,593.1014262078787,302.5822530314771,591.5935412259943,305.59802299524597\"', '2021-10-06 03:26:04', '2021-10-06 03:26:04'),
(562, 4, 'BT05-3', '\"353.1981218271631,116.09101613841018,341.9408111713173,114.68385230642946,339.8300654233462,127.34832679425602,351.7909579951824,127.34832679425602\"', '2021-10-06 03:26:04', '2021-10-06 03:26:04'),
(563, 4, 'BT05-4', '\"340.53364733933654,113.62847943244391,328.92454572549553,112.22131560046319,327.5173818935148,124.88579008828975,340.1818563813414,126.99653583626085\"', '2021-10-06 03:26:23', '2021-10-06 03:26:23'),
(564, 4, 'SH01-11', '\"579.5304613709187,302.07962470418227,581.0383463528032,298.05859808582375,592.0961695532891,305.09539466795115,590.0856562441098,308.11116463172004\"', '2021-10-06 03:26:35', '2021-10-06 03:26:35'),
(565, 4, 'BT05-5', '\"328.92454572549553,111.869524642468,316.6118621956642,110.81415176848245,314.85290740568826,123.12683529831384,327.1655909355196,124.88579008828975\"', '2021-10-06 03:26:40', '2021-10-06 03:26:40'),
(566, 4, 'BT05-6', '\"315.2046983636834,110.11056985249209,304.65096962382796,109.40698793650172,302.1884329178617,120.66429859234756,314.50111644769305,123.12683529831384\"', '2021-10-06 03:26:59', '2021-10-06 03:26:59'),
(567, 4, 'BT05-7', '\"303.2438057918472,108.35161506251617,292.33828609399654,107.29624218853063,289.5239584300351,119.60892571836202,301.8366419598665,121.36788050833792\"', '2021-10-06 03:27:17', '2021-10-06 03:27:17'),
(568, 4, 'SH01-13', '\"587.5725146076358,262.8746151751869,590.0856562441098,259.85884521141804,600.138222790006,266.3930134662506,597.6250811535319,269.40878343001947\"', '2021-10-06 03:27:19', '2021-10-06 03:27:19'),
(569, 4, 'BT05-8', '\"291.28291322001104,107.6480331465258,279.3220206481748,106.59266027254026,276.85948394220856,118.90534380237165,289.5239584300351,119.25713476036682\"', '2021-10-06 03:27:35', '2021-10-06 03:27:35'),
(570, 4, 'SH01-14', '\"585.5620012984565,266.8956417935454,587.5725146076358,262.8746151751869,597.6250811535319,269.40878343001947,595.6145678443527,272.42455339378836\"', '2021-10-06 03:27:50', '2021-10-06 03:27:50'),
(571, 4, 'SH01-15', '\"583.0488596619824,270.4140400846091,585.0593729711617,266.8956417935454,595.6145678443527,272.42455339378836,592.5987978805839,275.942951684852\"', '2021-10-06 03:28:25', '2021-10-06 03:28:25'),
(572, 4, 'BT02-1', '\"312.0385797417268,331.738873389457,313.4457435737075,338.07111063337027,306.761715371799,344.0515569192884,296.91156854793394,340.1818563813414,302.54022387585684,328.2209638095052\"', '2021-10-06 03:28:46', '2021-10-06 03:28:46'),
(573, 4, 'SH01-16', '\"581.540974680098,272.9271817210832,584.054116316572,269.9114117573143,594.1066828624683,275.942951684852,591.5935412259943,278.4560933213261\"', '2021-10-06 03:28:59', '2021-10-06 03:28:59'),
(574, 4, 'BT02-2', '\"302.54022387585684,328.2209638095052,293.3936589679821,322.9440994395774,286.35783980807844,332.7942462634425,296.2079866319436,340.1818563813414\"', '2021-10-06 03:29:13', '2021-10-06 03:29:13'),
(575, 4, 'BT02-3', '\"291.28291322001104,321.88872656559187,285.6542578920881,314.85290740568826,276.50769298421335,324.70305422955335,285.6542578920881,333.49782817943293,293.3936589679821,321.88872656559187\"', '2021-10-06 03:29:35', '2021-10-06 03:29:35'),
(576, 4, 'SH01-17', '\"580.0330896982135,276.4455800121468,581.540974680098,272.9271817210832,591.5935412259943,279.4613499759157,589.0803995895202,282.4771199396846\"', '2021-10-06 03:29:55', '2021-10-06 03:29:55'),
(577, 4, 'BT02-4', '\"283.89530310211217,314.50111644769305,278.6184387321845,306.4099244138039,268.4165009503242,314.85290740568826,275.804111068223,324.35126327155814,285.6542578920881,315.90828027967376\"', '2021-10-06 03:29:57', '2021-10-06 03:29:57'),
(578, 4, 'BT02-5', '\"278.26664777418927,307.11350632979423,269.8236647823049,297.9669414219195,261.02889083242536,306.4099244138039,265.6021732863627,311.3349978257364,268.4165009503242,314.85290740568826\"', '2021-10-06 03:30:25', '2021-10-06 03:30:25'),
(579, 4, 'SH01-18', '\"578.0225763890343,279.9639783032105,580.0330896982135,276.4455800121468,589.583027916815,282.4771199396846,587.5725146076358,285.4928899034535\"', '2021-10-06 03:30:32', '2021-10-06 03:30:32'),
(580, 4, 'BT02-6', '\"269.47187382430974,297.26335950592915,260.32530891643495,288.82037651404477,252.58590784054095,299.3741052539002,260.32530891643495,306.761715371799\"', '2021-10-06 03:30:54', '2021-10-06 03:30:54'),
(581, 4, 'SH01-19', '\"576.012063079855,282.9797482669794,578.0225763890343,279.4613499759157,587.0698862803409,285.4928899034535,586.0646296257513,288.5086598672223\"', '2021-10-06 03:31:12', '2021-10-06 03:31:12'),
(583, 4, 'SH01-20', '\"574.5041780979706,286.49814655804306,575.5094347525602,282.9797482669794,586.0646296257513,289.01128819451714,584.054116316572,292.027058158286\"', '2021-10-06 03:31:38', '2021-10-06 03:31:38'),
(584, 4, 'BT02-7', '\"259.9735179584398,289.5239584300351,249.06799826058912,282.83993022812666,243.43934293266622,293.04186800998696,252.93769879853613,299.7258962118954\"', '2021-10-06 03:31:48', '2021-10-06 03:31:48'),
(585, 4, 'BT02-8', '\"248.71620730259394,282.48813927013146,237.45889664674812,277.2112749002037,233.5891961088011,289.5239584300351,242.03217910068548,294.09724088397246\"', '2021-10-06 03:32:06', '2021-10-06 03:32:06'),
(586, 4, 'SH01-21', '\"571.9910364614965,290.01654484910677,574.0015497706758,286.49814655804306,584.5567446438669,292.52968648558084,582.5462313346876,296.04808477664454\"', '2021-10-06 03:32:16', '2021-10-06 03:32:16'),
(587, 4, 'BT02-9', '\"237.10710568875294,276.50769298421335,224.79442215892155,274.0451562782471,222.33188545295528,285.6542578920881,233.23740515080593,289.8757493880303\"', '2021-10-06 03:32:29', '2021-10-06 03:32:29'),
(588, 4, 'SH01-22', '\"570.4831514796122,293.03231481287565,571.9910364614965,289.51391652181195,582.5462313346876,295.54545644934973,580.5357180255083,299.0638547404134\"', '2021-10-06 03:32:40', '2021-10-06 03:32:40'),
(589, 4, 'SH01-23', '\"568.9752664977277,296.04808477664454,569.9805231523173,293.03231481287565,580.5357180255083,298.56122641311856,579.0278330436239,302.07962470418227\"', '2021-10-06 03:33:08', '2021-10-06 03:33:08'),
(590, 4, 'BT02-10', '\"307.4652972877894,343.347975003298,297.6151504639243,340.1818563813414,289.8757493880303,350.0320032052065,297.9669414219195,354.25349470114867,302.1884329178617,353.1981218271631\"', '2021-10-06 03:33:21', '2021-10-06 03:33:21'),
(591, 4, 'BT02-11', '\"296.91156854793394,338.7746925493606,287.7650036400592,333.49782817943293,279.67381160617,343.347975003298,284.9506759760977,347.9212574572354,289.8757493880303,350.3837941632017\"', '2021-10-06 03:33:53', '2021-10-06 03:33:53'),
(592, 4, 'BT02-12', '\"286.70963076607364,333.8496191374281,278.6184387321845,327.5173818935148,269.8236647823049,336.66394680138956,275.804111068223,340.53364733933654,278.6184387321845,343.347975003298\"', '2021-10-06 03:34:12', '2021-10-06 03:34:12'),
(593, 4, 'LK01-1', '\"643.3642589373599,191.50139269932353,646.3800289011288,186.4751094263754,654.9247104651406,192.00402102661835,654.9247104651406,197.03030429956647\"', '2021-10-06 03:34:19', '2021-10-06 03:34:19'),
(594, 4, 'BT02-13', '\"278.6184387321845,326.81379997752447,272.28620148827116,320.12977177561595,261.3806817904205,327.5173818935148,269.8236647823049,337.3675287173799\"', '2021-10-06 03:34:38', '2021-10-06 03:34:38'),
(595, 4, 'LK01-2', '\"641.8563739554754,195.01979099038724,643.3642589373599,191.50139269932353,654.4220821378458,198.0355609541561,651.9089405013717,201.051330917925\"', '2021-10-06 03:34:52', '2021-10-06 03:34:52'),
(596, 4, 'BT02-14', '\"272.28620148827116,320.12977177561595,264.54680041237714,310.27962495175086,255.4002355045024,319.7779808176208,261.7324727484157,327.5173818935148\"', '2021-10-06 03:35:05', '2021-10-06 03:35:05'),
(597, 4, 'LK01-3', '\"640.3484889735911,198.5381892814509,641.8563739554754,195.01979099038724,651.4063121740769,200.54870259063017,649.8984271921925,204.06710088169385\"', '2021-10-06 03:35:22', '2021-10-06 03:35:22'),
(599, 4, 'LK01-4', '\"637.835347337117,201.051330917925,640.3484889735911,197.53293262686128,650.9036838467821,204.06710088169385,648.390542210308,207.08287084546274\"', '2021-10-06 03:35:57', '2021-10-06 03:35:57'),
(600, 4, 'BT02-15', '\"264.195009454382,310.63141590974607,255.4002355045024,302.1884329178617,247.30904347061323,311.6867887837316,254.69665358851205,319.4261898596256\"', '2021-10-06 03:36:00', '2021-10-06 03:36:00'),
(601, 4, 'LK01-5', '\"636.3274623552326,204.56972920898866,637.835347337117,201.55395924521977,647.8879138830132,207.08287084546274,646.3800289011288,210.0986408092316\"', '2021-10-06 03:36:24', '2021-10-06 03:36:24'),
(602, 4, 'BT02-16', '\"254.69665358851205,301.48485100187133,245.55008868063732,295.8561956739484,239.21785143672403,306.4099244138039,247.6608344286084,312.0385797417268\"', '2021-10-06 03:36:24', '2021-10-06 03:36:24'),
(603, 4, 'BT02-17', '\"245.55008868063732,294.8008227999628,233.5891961088011,290.2275403460255,229.36770461285892,301.48485100187133,238.51426952073365,306.0581334558087\"', '2021-10-06 03:36:42', '2021-10-06 03:36:42'),
(604, 4, 'LK01-6', '\"634.3169490460533,207.08287084546274,635.8248340279378,204.06710088169385,646.3800289011288,210.6012691365264,644.8721439192443,213.11441077300046\"', '2021-10-06 03:37:01', '2021-10-06 03:37:01'),
(605, 4, 'BT02-18', '\"233.23740515080593,288.82037651404477,221.9800944949601,287.413212682064,218.81397587300344,299.3741052539002,230.42307748684448,302.54022387585684\"', '2021-10-06 03:37:04', '2021-10-06 03:37:04'),
(606, 4, 'LK01-7', '\"631.8038074095792,210.6012691365264,634.3169490460533,207.58549917275752,645.3747722465391,214.1196674275901,642.861630610065,217.13543739135898\"', '2021-10-06 03:37:28', '2021-10-06 03:37:28'),
(607, 4, 'LK01-8', '\"630.7985507549896,214.6222957548849,632.306435736874,211.10389746382123,642.861630610065,217.13543739135898,640.8511173008859,220.15120735512784\"', '2021-10-06 03:37:59', '2021-10-06 03:37:59'),
(608, 4, 'LK01-9', '\"629.2906657731052,217.13543739135898,630.7985507549896,214.6222957548849,640.8511173008859,220.65383568242265,639.3432323190015,223.66960564619154\"', '2021-10-06 03:38:24', '2021-10-06 03:38:24'),
(609, 4, 'LK01-10', '\"627.2801524639259,221.15646400971747,629.2906657731052,217.6380657186538,639.8458606462963,224.17223397348636,636.8300906825274,226.6853756099604\"', '2021-10-06 03:38:54', '2021-10-06 03:38:54'),
(610, 4, 'LK01-11', '\"625.2696391547466,224.67486230078114,626.7775241366311,221.15646400971747,637.3327190098222,227.18800393725522,635.3222057006429,230.7064022283189\"', '2021-10-06 03:39:20', '2021-10-06 03:39:20'),
(612, 4, 'BT03-1', '\"206.14950138517688,271.934410530276,192.42965402336478,273.3415743622567,193.8368178553455,286.0060488500833,201.22442797324433,285.30246693409293,206.50129234317205,285.30246693409293\"', '2021-10-06 03:40:47', '2021-10-06 03:40:47'),
(613, 4, 'LK01-12', '\"633.3116923914637,185.46985277178578,636.8300906825274,181.4488261534273,645.8774005738339,186.4751094263754,642.861630610065,190.99876437202872\"', '2021-10-06 03:40:50', '2021-10-06 03:40:50'),
(614, 4, 'LK01-13', '\"631.8038074095792,188.98825106284949,632.8090640641689,185.46985277178578,643.3642589373599,191.50139269932353,641.3537456281807,195.01979099038724\"', '2021-10-06 03:41:27', '2021-10-06 03:41:27'),
(615, 4, 'BT03-2', '\"192.42965402336478,272.9897834042615,180.1169704935334,276.1559020262182,182.93129815749484,288.11679459805435,188.2081625274226,286.70963076607364,194.1886088133407,286.0060488500833\"', '2021-10-06 03:41:29', '2021-10-06 03:41:29'),
(616, 4, 'LK01-14', '\"629.7932941004,192.00402102661835,631.3011790822844,188.98825106284949,641.3537456281807,194.51716266309242,639.3432323190015,198.0355609541561\"', '2021-10-06 03:42:18', '2021-10-06 03:42:18'),
(618, 4, 'BT03-3', '\"178.35801570355747,275.4523201102278,166.04533217372608,280.72918448015554,170.97040558565865,292.69007705199175,182.93129815749484,288.46858555604956\"', '2021-10-06 03:43:00', '2021-10-06 03:43:00'),
(619, 4, 'BT03-4', '\"167.10070504771164,280.72918448015554,154.43623055988508,286.35783980807844,160.06488588780797,297.6151504639243,171.673987501649,291.9864951360014\"', '2021-10-06 03:43:33', '2021-10-06 03:43:33'),
(620, 4, 'LK01-15', '\"627.7827807912207,195.52241931768202,629.2906657731052,192.00402102661835,639.8458606462963,198.5381892814509,637.3327190098222,201.051330917925\"', '2021-10-06 03:43:33', '2021-10-06 03:43:33'),
(621, 4, 'BT04-5', '\"154.43623055988508,285.6542578920881,143.17891990403922,292.33828609399654,149.8629481059477,303.9473877078376,161.12025876179354,296.55977758993873\"', '2021-10-06 03:43:55', '2021-10-06 03:43:55'),
(622, 4, 'LK01-16', '\"625.7722674820415,199.04081760874573,627.2801524639259,195.52241931768202,637.3327190098222,201.051330917925,635.8248340279378,204.56972920898866\"', '2021-10-06 03:44:13', '2021-10-06 03:44:13'),
(623, 4, 'BT03-6', '\"149.8629481059477,302.89201483385204,143.17891990403922,291.9864951360014,132.27340020618857,299.3741052539002,132.97698212217895,303.2438057918472,142.82712894604404,309.9278339937557\"', '2021-10-06 03:44:20', '2021-10-06 03:44:20'),
(624, 4, 'LK01-17', '\"623.2591258455674,201.55395924521977,625.2696391547466,199.04081760874573,635.3222057006429,204.56972920898866,632.8090640641689,207.08287084546274\"', '2021-10-06 03:44:49', '2021-10-06 03:44:49'),
(625, 4, 'BT03-7', '\"206.50129234317205,297.26335950592915,206.14950138517688,283.89530310211217,193.8368178553455,286.0060488500833,194.89219072933105,298.67052333790986,206.14950138517688,297.6151504639243\"', '2021-10-06 03:44:59', '2021-10-06 03:44:59'),
(626, 4, 'LK01-18', '\"621.7512408636829,205.5749858635783,623.2591258455674,201.55395924521977,633.3116923914637,207.58549917275752,631.3011790822844,210.6012691365264\"', '2021-10-06 03:45:18', '2021-10-06 03:45:18'),
(627, 4, 'BT03-8', '\"193.8368178553455,285.6542578920881,182.22771624150448,288.82037651404477,185.04204390546593,301.1330600438761,195.24398168732623,298.31873237991465\"', '2021-10-06 03:45:22', '2021-10-06 03:45:22'),
(628, 4, 'BT03-9', '\"181.17234336751892,288.46858555604956,168.85965983768756,293.04186800998696,173.7847332496201,305.7063424978135,185.04204390546593,301.1330600438761\"', '2021-10-06 03:45:45', '2021-10-06 03:45:45'),
(629, 4, 'LK01-19', '\"620.2433558817985,208.59075582734715,621.7512408636829,205.5749858635783,631.8038074095792,211.10389746382123,629.7932941004,214.6222957548849\"', '2021-10-06 03:45:56', '2021-10-06 03:45:56'),
(630, 4, 'BT03-10', '\"170.26682366966827,292.33828609399654,158.3059310978321,299.3741052539002,163.23100450976463,310.63141590974607,174.13652420761528,305.0027605818231\"', '2021-10-06 03:46:13', '2021-10-06 03:46:13'),
(631, 4, 'LK01-20', '\"617.7302142453245,211.60652579111604,619.7407275545037,208.59075582734715,629.7932941004,214.1196674275901,627.7827807912207,217.13543739135898\"', '2021-10-06 03:46:34', '2021-10-06 03:46:34'),
(632, 4, 'BT03-11', '\"158.3059310978321,298.31873237991465,142.82712894604404,307.8170882457846,151.6219028959236,315.5564893216786,155.4916034338706,315.5564893216786,164.28637738375016,309.5760430357605\"', '2021-10-06 03:46:37', '2021-10-06 03:46:37'),
(633, 4, 'LK01-21', '\"616.2223292634401,215.12492408217972,617.2275859180297,211.60652579111604,627.7827807912207,217.13543739135898,626.2748958093363,221.15646400971747\"', '2021-10-06 03:46:56', '2021-10-06 03:46:56'),
(634, 4, 'LK01-22', '\"614.7144442815556,218.1406940459486,615.7197009361453,215.12492408217972,626.2748958093363,221.15646400971747,624.264382500157,225.17749062807596\"', '2021-10-06 03:47:24', '2021-10-06 03:47:24'),
(635, 4, 'LK02-1', '\"621.2486125363881,230.7064022283189,622.7564975182726,226.6853756099604,633.3116923914637,232.71691553749815,631.3011790822844,236.23531382856186\"', '2021-10-06 03:49:23', '2021-10-06 03:49:23'),
(636, 4, 'LK02-2', '\"619.7407275545037,234.2248005193826,621.2486125363881,230.7064022283189,631.8038074095792,236.73794215585664,629.7932941004,240.25634044692035\"', '2021-10-06 03:49:48', '2021-10-06 03:49:48'),
(637, 4, 'LK02-3', '\"617.7302142453245,236.73794215585664,619.2380992272089,233.72217219208778,630.2959224276948,240.25634044692035,627.7827807912207,243.77473873798402\"', '2021-10-06 03:50:11', '2021-10-06 03:50:11'),
(638, 4, 'LK02-4', '\"615.7197009361453,240.25634044692035,617.2275859180297,237.24057048315146,627.7827807912207,243.77473873798402,626.2748958093363,246.7905087017529\"', '2021-10-06 03:50:36', '2021-10-06 03:50:36'),
(639, 4, 'LK02-5', '\"614.2118159542608,244.27736706527884,615.7197009361453,240.25634044692035,626.2748958093363,246.2878803744581,624.264382500157,249.80627866552177\"', '2021-10-06 03:51:00', '2021-10-06 03:51:00'),
(641, 4, 'LK02-6', '\"612.2013026450816,246.7905087017529,613.2065592996712,242.7694820833944,624.7670108274518,249.80627866552177,622.2538691909778,253.82730528388026\"', '2021-10-06 03:51:27', '2021-10-06 03:51:27'),
(642, 4, 'BT04-1', '\"351.4391670371872,466.12301934361665,351.08737607919204,461.90152784767446,343.347975003298,456.9764544357419,335.608573927404,467.5301831755974,344.75513883527873,473.86242041951067\"', '2021-10-06 03:51:54', '2021-10-06 03:51:54'),
(643, 4, 'LK02-7', '\"610.1907893359023,250.3089069928166,611.6986743177868,246.7905087017529,622.7564975182726,253.82730528388026,620.7459842090933,256.34044692035434\"', '2021-10-06 03:52:08', '2021-10-06 03:52:08'),
(644, 4, 'BT04-2', '\"342.64439308730766,455.92108156175635,335.608573927404,451.69959006581416,327.86917285151,461.1979459316841,335.608573927404,466.47481030161185\"', '2021-10-06 03:52:19', '2021-10-06 03:52:19'),
(645, 4, 'LK02-8', '\"609.1855326813127,253.32467695658548,610.1907893359023,250.3089069928166,620.7459842090933,256.34044692035434,619.2380992272089,259.85884521141804\"', '2021-10-06 03:52:35', '2021-10-06 03:52:35'),
(646, 4, 'BT04-3', '\"334.55320105341843,451.347799107819,327.5173818935148,446.7745166538816,320.12977177561595,455.5692906037612,328.5727547675003,462.60510976366487\"', '2021-10-06 03:52:36', '2021-10-06 03:52:36'),
(647, 4, 'BT04-4', '\"326.46200901952926,446.7745166538816,320.12977177561595,441.8494432419491,312.0385797417268,450.9960081498238,319.4261898596256,456.62466347774676\"', '2021-10-06 03:52:52', '2021-10-06 03:52:52'),
(648, 4, 'LK02-9', '\"606.1697627175438,256.84307524764915,608.180276026723,253.82730528388026,619.2380992272089,259.85884521141804,617.2275859180297,262.8746151751869\"', '2021-10-06 03:53:00', '2021-10-06 03:53:00'),
(649, 4, 'LK02-10', '\"604.6618777356593,260.36147353871286,606.1697627175438,256.84307524764915,616.7249575907349,262.3719868478921,615.2170726088505,266.3930134662506\"', '2021-10-06 03:53:30', '2021-10-06 03:53:30'),
(650, 4, 'LK02-11', '\"602.1487360991853,262.8746151751869,604.6618777356593,260.36147353871286,615.2170726088505,265.89038513895576,612.7039309723764,269.9114117573143\"', '2021-10-06 03:54:36', '2021-10-06 03:54:36'),
(651, 4, 'BT04-5', '\"318.72260794363524,440.44227940996836,311.6867887837316,436.2207879140262,305.0027605818231,445.7191437798961,312.0385797417268,451.69959006581416\"', '2021-10-06 03:55:26', '2021-10-06 03:55:26'),
(652, 4, 'BT04-6', '\"310.9832068677412,435.5172059980358,303.9473877078376,430.24034162810807,296.91156854793394,440.09048845197316,303.2438057918472,445.7191437798961\"', '2021-10-06 03:55:46', '2021-10-06 03:55:46'),
(653, 4, 'BT04-7', '\"303.9473877078376,430.24034162810807,295.5044047159532,424.9634772581803,288.11679459805435,434.46183312405026,295.5044047159532,439.738697493978\"', '2021-10-06 03:56:05', '2021-10-06 03:56:05'),
(654, 4, 'BT04-8', '\"295.152613757958,424.61168630018517,288.46858555604956,420.0384038462478,280.72918448015554,429.88855067011286,288.11679459805435,435.5172059980358\"', '2021-10-06 03:56:26', '2021-10-06 03:56:26'),
(655, 4, 'BT04-9', '\"287.7650036400592,418.9830309722622,280.72918448015554,415.11333043431523,272.63799244626637,424.25989534218996,279.67381160617,429.1849687541225\"', '2021-10-06 03:56:53', '2021-10-06 03:56:53'),
(656, 4, 'BT04-10', '\"280.72918448015554,414.4097485183249,272.28620148827116,409.1328841483971,265.25038232836755,419.3348219302574,273.6933653202519,426.0188501321659\"', '2021-10-06 03:57:13', '2021-10-06 03:57:13'),
(657, 4, 'LK02-12', '\"610.6934176631971,224.67486230078114,612.2013026450816,220.15120735512784,622.7564975182726,226.6853756099604,620.7459842090933,230.2037739010241\"', '2021-10-06 03:57:17', '2021-10-06 03:57:17'),
(658, 4, 'BT04-11', '\"272.63799244626637,409.1328841483971,263.8432184963868,403.8560197784694,256.8073993364832,413.3543756443393,265.6021732863627,417.9276580982767\"', '2021-10-06 03:57:49', '2021-10-06 03:57:49'),
(659, 4, 'LK02-13', '\"609.1855326813127,227.18800393725522,610.1907893359023,224.67486230078114,620.7459842090933,230.7064022283189,618.2328425726193,234.2248005193826\"', '2021-10-06 03:57:49', '2021-10-06 03:57:49'),
(660, 4, 'BT04-12', '\"264.54680041237714,403.152437862479,257.1591902944783,397.87557349255127,249.06799826058912,407.7257203164164,257.5109812524735,414.4097485183249\"', '2021-10-06 03:58:09', '2021-10-06 03:58:09'),
(661, 4, 'LK02-14', '\"606.6723910448386,231.2090305556137,609.1855326813127,227.18800393725522,618.2328425726193,233.21954386479297,616.7249575907349,236.73794215585664\"', '2021-10-06 03:58:16', '2021-10-06 03:58:16'),
(662, 4, 'BT04-13', '\"255.4002355045024,397.5237825345561,249.7715801765795,392.5987091226236,241.6803881426903,403.152437862479,249.7715801765795,407.7257203164164\"', '2021-10-06 03:58:28', '2021-10-06 03:58:28'),
(663, 4, 'LK02-15', '\"605.1645060629542,234.7274288466774,606.6723910448386,231.2090305556137,616.2223292634401,236.73794215585664,614.7144442815556,240.25634044692035\"', '2021-10-06 03:58:43', '2021-10-06 03:58:43'),
(664, 4, 'BT04-14', '\"249.06799826058912,392.5987091226236,241.6803881426903,387.3218447526958,233.5891961088011,397.1719915765609,241.6803881426903,402.09706498849346\"', '2021-10-06 03:58:48', '2021-10-06 03:58:48'),
(665, 4, 'LK02-16', '\"603.1539927537749,238.2458271377411,604.6618777356593,234.7274288466774,614.7144442815556,240.25634044692035,612.2013026450816,244.27736706527884\"', '2021-10-06 03:59:08', '2021-10-06 03:59:08'),
(666, 4, 'BT04-15', '\"240.62501526870474,387.3218447526958,233.23740515080593,381.69318942477287,226.2015859909023,392.24691816462837,233.5891961088011,397.5237825345561\"', '2021-10-06 03:59:19', '2021-10-06 03:59:19'),
(667, 4, 'BT04-16', '\"232.88561419281075,381.69318942477287,224.79442215892155,377.4716979288307,218.1103939570131,386.9700537947006,225.84979503290708,392.24691816462837\"', '2021-10-06 03:59:38', '2021-10-06 03:59:38'),
(668, 4, 'LK02-17', '\"601.1434794445956,241.26159710150998,603.1539927537749,237.74319881044627,612.7039309723764,243.2721104106892,610.1907893359023,247.29313702904773\"', '2021-10-06 03:59:50', '2021-10-06 03:59:50'),
(669, 4, 'BT04-17', '\"225.84979503290708,375.7127431388548,217.4068120410227,371.1394606849174,210.37099288111907,381.3413984667777,218.81397587300344,387.673635710691\"', '2021-10-06 04:00:02', '2021-10-06 04:00:02'),
(670, 4, 'LK02-18', '\"599.6355944627112,244.27736706527884,600.6408511173008,240.75896877421516,610.6934176631971,246.7905087017529,608.180276026723,249.80627866552177\"', '2021-10-06 04:00:16', '2021-10-06 04:00:16'),
(671, 4, 'BT04-18', '\"217.7586029990179,371.8430426009078,210.37099288111907,366.91796918897523,202.63159180522507,376.06453409684997,209.6674109651287,381.69318942477287\"', '2021-10-06 04:00:25', '2021-10-06 04:00:25'),
(672, 4, 'LK02-19', '\"597.1224528262371,247.29313702904773,599.1329661354164,244.27736706527884,609.6881610086075,249.80627866552177,607.1750193721334,253.82730528388026\"', '2021-10-06 04:00:42', '2021-10-06 04:00:42'),
(673, 4, 'BT04-19', '\"210.37099288111907,365.5108053569945,201.9280098892347,361.28931386105234,194.89219072933105,371.8430426009078,202.27980084722986,376.7681160128403\"', '2021-10-06 04:00:44', '2021-10-06 04:00:44'),
(674, 4, 'BT04-20', '\"201.9280098892347,360.5857319450619,193.4850268973503,354.957076617139,186.44920773744667,366.2143872729849,194.89219072933105,371.49125164291263,203.6869646792106,359.1785681130812\"', '2021-10-06 04:01:01', '2021-10-06 04:01:01'),
(675, 4, 'LK02-20', '\"595.6145678443527,250.8115353201114,597.1224528262371,247.29313702904773,607.1750193721334,252.82204862929066,605.667134390249,256.34044692035434\"', '2021-10-06 04:01:16', '2021-10-06 04:01:16'),
(676, 4, 'BT04-21', '\"194.1886088133407,355.6606585331294,187.15278965343703,350.0320032052065,179.41338857754303,359.88215002907157,187.8563715694274,365.5108053569945\"', '2021-10-06 04:01:28', '2021-10-06 04:01:28'),
(677, 4, 'LK02-21', '\"594.1066828624683,254.32993361117508,595.111939517058,250.8115353201114,605.667134390249,256.34044692035434,603.1539927537749,260.36147353871286\"', '2021-10-06 04:01:39', '2021-10-06 04:01:39'),
(678, 4, 'BT04-22', '\"185.74562582145631,349.3284212892161,178.70980666155265,344.75513883527873,170.97040558565865,355.6606585331294,178.70980666155265,361.28931386105234\"', '2021-10-06 04:01:43', '2021-10-06 04:01:43'),
(679, 4, 'LK02-22', '\"592.0961695532891,257.34570357494397,593.1014262078787,253.82730528388026,604.1592494083645,260.36147353871286,601.6461077718905,263.8798718297765\"', '2021-10-06 04:01:58', '2021-10-06 04:01:58'),
(680, 4, 'BT04-23', '\"178.0062247455623,344.0515569192884,170.26682366966827,339.47827446535103,163.934586425755,349.6802122472113,172.37756941763936,355.30886757513423\"', '2021-10-06 04:02:05', '2021-10-06 04:02:05'),
(681, 4, 'BT04-24', '\"172.37756941763936,340.53364733933654,162.87921355176945,333.8496191374281,155.4916034338706,343.6997659612932,162.52742259377428,349.3284212892161\"', '2021-10-06 04:02:34', '2021-10-06 04:02:34'),
(683, 4, 'BT04-25', '\"162.87921355176945,334.2014100954233,154.78802151788025,328.5727547675003,147.7522023579766,338.7746925493606,155.8433943918658,344.0515569192884\"', '2021-10-06 04:04:05', '2021-10-06 04:04:05'),
(684, 4, 'BT04-26', '\"155.4916034338706,328.5727547675003,147.4004113999814,323.999472313563,139.30921936609224,333.8496191374281,147.7522023579766,338.4229015913655\"', '2021-10-06 04:04:27', '2021-10-06 04:04:27'),
(685, 4, 'BT04-27', '\"147.7522023579766,322.2405175235871,139.30921936609224,316.6118621956642,131.9216092481934,328.92454572549553,140.36459224007777,333.49782817943293\"', '2021-10-06 04:04:44', '2021-10-06 04:04:44'),
(686, 4, 'BT04-28', '\"140.0128012820826,317.6672350696497,131.5698182901982,313.09395261571234,123.8304172143042,322.2405175235871,131.5698182901982,328.5727547675003\"', '2021-10-06 04:05:01', '2021-10-06 04:05:01'),
(687, 4, 'BT04-29', '\"131.9216092481934,313.09395261571234,123.47862625630901,307.4652972877894,116.79459805440055,317.31544411165453,124.53399913029456,324.35126327155814\"', '2021-10-06 04:05:22', '2021-10-06 04:05:22'),
(688, 4, 'BT04-30', '\"123.47862625630901,307.8170882457846,115.38743422241983,302.1884329178617,108.35161506251617,312.0385797417268,116.79459805440055,319.07439890163045\"', '2021-10-06 04:05:43', '2021-10-06 04:05:43'),
(689, 4, 'BT04-31', '\"115.38743422241983,302.1884329178617,107.999824104521,296.55977758993873,99.9086320706318,307.8170882457846,108.35161506251617,311.6867887837316\"', '2021-10-06 04:05:57', '2021-10-06 04:05:57'),
(690, 4, 'BT04-32', '\"108.35161506251617,296.55977758993873,99.9086320706318,290.93112226201583,92.52102195273297,300.7812690858809,99.55684111263662,306.761715371799\"', '2021-10-06 04:06:12', '2021-10-06 04:06:12'),
(691, 4, 'BT01-1', '\"685.9923680906056,155.4916034338706,690.9174415025382,154.0844396018899,701.4711702423937,161.12025876179354,697.2496787464515,168.50786887969235,685.9923680906056,163.23100450976463,687.3995319225864,159.7130949298128\"', '2021-10-06 04:09:51', '2021-10-06 04:09:51'),
(692, 4, 'BT01-2', '\"697.6014697044467,168.50786887969235,685.9923680906056,162.87921355176945,681.0672946786731,170.61861462766345,692.324605334519,178.35801570355747\"', '2021-10-06 04:10:34', '2021-10-06 04:10:34'),
(693, 4, 'BT01-3', '\"691.9728143765237,176.59906091358155,680.7155037206779,170.26682366966827,675.4386393507502,178.70980666155265,687.3995319225864,185.74562582145631\"', '2021-10-06 04:10:54', '2021-10-06 04:10:54'),
(694, 4, 'LK03-1', '\"592.5987978805839,159.33317975245555,594.1066828624683,155.31215313409703,603.1539927537749,161.34369306163478,602.1487360991853,166.3699763345829\"', '2021-10-06 04:11:00', '2021-10-06 04:11:00'),
(695, 4, 'BT01-4', '\"687.3995319225864,184.33846198947558,675.4386393507502,178.0062247455623,669.8099840228273,186.44920773744667,682.4744585106538,193.4850268973503\"', '2021-10-06 04:11:16', '2021-10-06 04:11:16'),
(696, 4, 'BT01-5', '\"683.1780404266442,191.7260721073744,670.8653568968128,186.80099869544185,665.588492526885,195.24398168732623,677.5493850987212,201.5762189312395\"', '2021-10-06 04:11:32', '2021-10-06 04:11:32'),
(697, 4, 'LK03-2', '\"589.583027916815,163.35420637081404,591.5935412259943,159.83580807975036,601.6461077718905,166.3699763345829,599.6355944627112,169.8883746256466\"', '2021-10-06 04:11:34', '2021-10-06 04:11:34'),
(698, 4, 'BT01-6', '\"677.9011760567165,201.22442797324433,665.2367015688899,196.65114551930697,661.3670010309429,202.63159180522507,672.6243116867887,210.0192019231239\"', '2021-10-06 04:11:51', '2021-10-06 04:11:51'),
(699, 4, 'LK03-3', '\"587.5725146076358,166.3699763345829,589.583027916815,163.35420637081404,599.6355944627112,170.39100295294142,597.6250811535319,173.40677291671028\"', '2021-10-06 04:12:09', '2021-10-06 04:12:09'),
(700, 4, 'BT01-7', '\"673.6796845607743,210.37099288111907,661.0152100729478,204.03875563720578,656.4419276190104,209.6674109651287,669.4581930648321,218.81397587300344\"', '2021-10-06 04:12:10', '2021-10-06 04:12:10'),
(701, 4, 'BT01-8', '\"669.8099840228273,218.81397587300344,655.73834570302,211.42636575510463,651.1650632490826,220.22113970498418,663.477746778914,227.608749822883\"', '2021-10-06 04:12:32', '2021-10-06 04:12:32'),
(702, 4, 'LK03-4', '\"585.5620012984565,169.3857462983518,587.0698862803409,166.3699763345829,597.1224528262371,173.40677291671028,595.111939517058,175.91991455318436\"', '2021-10-06 04:12:34', '2021-10-06 04:12:34'),
(703, 4, 'BT01-9', '\"664.1813286949043,227.25695886488782,651.5168542070778,220.57293066297936,647.2953627111356,228.66412269686856,658.5526733669815,235.34815089877702\"', '2021-10-06 04:13:00', '2021-10-06 04:13:00'),
(704, 4, 'LK03-5', '\"584.054116316572,172.90414458941547,585.0593729711617,169.8883746256466,595.111939517058,176.42254288047917,593.1014262078787,179.43831284424803\"', '2021-10-06 04:13:06', '2021-10-06 04:13:06'),
(705, 4, 'BT01-10', '\"659.9598371989622,234.64456898278667,647.2953627111356,227.96054078087818,642.7220802571982,235.6999418567722,655.3865547450248,243.08755197467104\"', '2021-10-06 04:13:18', '2021-10-06 04:13:18'),
(706, 4, 'BT01-11', '\"655.0347637870296,242.73576101667584,642.370289299203,236.40352377276255,637.4452158872705,244.14292484865658,649.4061084591067,251.8823259245506\"', '2021-10-06 04:13:39', '2021-10-06 04:13:39'),
(707, 4, 'LK03-6', '\"581.0383463528032,175.91991455318436,583.0488596619824,172.90414458941547,593.1014262078787,179.43831284424803,591.5935412259943,182.95671113531174\"', '2021-10-06 04:13:44', '2021-10-06 04:13:44'),
(708, 4, 'BT01-12', '\"650.8132722910874,251.17874400856022,638.1487978032609,244.14292484865658,632.8719334333331,252.93769879853613,644.4810350471741,259.6217270004446\"', '2021-10-06 04:13:58', '2021-10-06 04:13:58'),
(709, 4, 'LK03-7', '\"580.0330896982135,179.43831284424803,582.0436030073928,176.92517120777399,591.0909128986995,182.45408280801692,589.0803995895202,185.46985277178578\"', '2021-10-06 04:14:15', '2021-10-06 04:14:15'),
(710, 4, 'BT01-13', '\"645.8881988791549,260.32530891643495,632.5201424753379,251.53053496655542,627.5950690634054,260.67709987443016,639.9077525932368,268.4165009503242\"', '2021-10-06 04:14:16', '2021-10-06 04:14:16'),
(711, 4, 'BT01-14', '\"641.3149164252175,267.3611280763386,628.2986509793958,261.3806817904205,623.021786609468,268.4165009503242,636.0380520552898,274.74873819423743\"', '2021-10-06 04:14:35', '2021-10-06 04:14:35'),
(712, 4, 'LK03-8', '\"577.0173197344446,181.9514544807221,579.0278330436239,178.93568451695322,589.0803995895202,185.46985277178578,587.0698862803409,188.98825106284949\"', '2021-10-06 04:14:41', '2021-10-06 04:14:41'),
(713, 4, 'BT01-15', '\"636.0380520552898,275.4523201102278,623.3735775674631,268.4165009503242,618.4485041555306,277.2112749002037,632.8719334333331,286.70963076607364\"', '2021-10-06 04:14:53', '2021-10-06 04:14:53'),
(714, 4, 'LK03-9', '\"575.0068064252654,184.96722444449097,577.0173197344446,182.45408280801692,587.0698862803409,188.98825106284949,584.5567446438669,192.00402102661835\"', '2021-10-06 04:15:11', '2021-10-06 04:15:11'),
(715, 4, 'BT01-16', '\"631.4647696013524,283.89530310211217,618.8002951135259,276.85948394220856,612.8198488276078,283.89530310211217,627.2432781054102,291.9864951360014\"', '2021-10-06 04:15:23', '2021-10-06 04:15:23'),
(716, 4, 'LK03-10', '\"572.9962931160861,188.98825106284949,574.5041780979706,185.46985277178578,585.0593729711617,192.00402102661835,583.0488596619824,195.01979099038724\"', '2021-10-06 04:15:37', '2021-10-06 04:15:37'),
(717, 4, 'BT01-17', '\"627.2432781054102,292.33828609399654,614.2270126595885,283.543512144117,608.9501482896608,293.7454499259773,622.6699956514728,300.7812690858809\"', '2021-10-06 04:15:43', '2021-10-06 04:15:43'),
(718, 4, 'LK03-11', '\"570.985779806907,191.50139269932353,572.4936647887913,187.48036608096504,582.5462313346876,195.52241931768202,581.0383463528032,198.5381892814509\"', '2021-10-06 04:16:02', '2021-10-06 04:16:02'),
(719, 4, 'BT01-18', '\"621.6146227774873,300.4294781278858,607.8947754156752,291.9864951360014,603.3214929617378,300.4294781278858,617.0413403235499,308.52067016177494\"', '2021-10-06 04:16:03', '2021-10-06 04:16:03'),
(720, 4, 'BT01-19', '\"616.3377584075596,308.87246111977015,604.7286567937185,302.1884329178617,599.4517924237908,309.9278339937557,612.8198488276078,316.9636531536593\"', '2021-10-06 04:16:18', '2021-10-06 04:16:18'),
(721, 4, 'LK03-12', '\"568.9752664977277,195.01979099038724,570.985779806907,191.50139269932353,581.0383463528032,198.5381892814509,579.0278330436239,201.55395924521977\"', '2021-10-06 04:16:25', '2021-10-06 04:16:25'),
(722, 4, 'BT01-20', '\"612.1162669116173,317.6672350696497,600.1553743397811,310.27962495175086,594.5267190118583,318.0190260276449,607.54298445768,324.70305422955335\"', '2021-10-06 04:16:41', '2021-10-06 04:16:41'),
(723, 4, 'BT01-21', '\"607.8947754156752,325.05484518754855,595.2303009278486,318.3708169856401,589.6016455999256,326.46200901952926,601.9143291297571,333.8496191374281\"', '2021-10-06 04:16:57', '2021-10-06 04:16:57'),
(725, 4, 'LK03-13', '\"581.540974680098,153.3016398249178,583.0488596619824,150.2858698611489,586.5672579530461,149.28061320655928,594.1066828624683,155.81478146139185,591.5935412259943,159.83580807975036\"', '2021-10-06 04:17:41', '2021-10-06 04:17:41'),
(726, 4, 'LK03-14', '\"580.0330896982135,155.81478146139185,581.540974680098,153.3016398249178,591.0909128986995,159.83580807975036,589.0803995895202,162.3489497162244\"', '2021-10-06 04:18:08', '2021-10-06 04:18:08'),
(727, 4, 'LK03-15', '\"577.5199480617395,159.33317975245555,579.5304613709187,156.31740978868666,589.0803995895202,162.85157804351923,587.0698862803409,166.3699763345829\"', '2021-10-06 04:18:31', '2021-10-06 04:18:31'),
(729, 4, 'LK03-16', '\"575.5094347525602,162.85157804351923,577.0173197344446,159.33317975245555,587.0698862803409,165.86734800728811,585.5620012984565,169.3857462983518\"', '2021-10-06 04:19:32', '2021-10-06 04:19:32'),
(730, 4, 'LK03-17', '\"572.9962931160861,165.86734800728811,575.0068064252654,162.85157804351923,585.0593729711617,169.3857462983518,583.0488596619824,172.90414458941547\"', '2021-10-06 04:19:57', '2021-10-06 04:19:57'),
(731, 4, 'LK03-18', '\"570.985779806907,169.3857462983518,572.4936647887913,165.3647196799933,582.5462313346876,171.89888793482586,580.0330896982135,175.41728622588954\"', '2021-10-06 04:20:20', '2021-10-06 04:20:20'),
(732, 4, 'LK03-19', '\"569.4778948250225,171.89888793482586,570.4831514796122,168.88311797105698,580.0330896982135,175.91991455318436,578.0225763890343,179.43831284424803\"', '2021-10-06 04:20:46', '2021-10-06 04:20:46'),
(735, 4, 'LK03-20', '\"566.9647531885485,175.41728622588954,568.9752664977277,171.89888793482586,579.0278330436239,178.4330561896584,576.5146914071498,180.94619782613248\"', '2021-10-06 04:21:45', '2021-10-06 04:21:45'),
(736, 4, 'SH03-1', '\"480.54644862141913,275.10052915223264,476.67674808347215,280.0256025641652,466.47481030161185,272.9897834042615,468.5855560495829,267.3611280763386\"', '2021-10-06 04:22:06', '2021-10-06 04:22:06'),
(738, 4, 'SH03-2', '\"477.7321209574577,279.67381160617,466.47481030161185,272.63799244626637,463.6604826376504,275.804111068223,474.2142113775059,282.48813927013146\"', '2021-10-06 04:22:37', '2021-10-06 04:22:37'),
(739, 4, 'LK03-21', '\"564.9542398793692,178.4330561896584,566.4621248612536,174.91465789859473,576.012063079855,181.4488261534273,574.5041780979706,184.96722444449097\"', '2021-10-06 04:22:38', '2021-10-06 04:22:38'),
(740, 4, 'SH03-3', '\"475.26958425149144,282.48813927013146,463.6604826376504,275.804111068223,461.5497368896793,279.3220206481748,472.8070475455251,286.35783980807844\"', '2021-10-06 04:22:59', '2021-10-06 04:22:59'),
(741, 4, 'LK03-22', '\"562.4410982428951,181.4488261534273,564.4516115520744,178.4330561896584,574.0015497706758,184.46459611719615,571.9910364614965,187.98299440825986\"', '2021-10-06 04:23:04', '2021-10-06 04:23:04'),
(743, 4, 'LK03-23', '\"560.9332132610107,184.46459611719615,562.4410982428951,181.4488261534273,571.9910364614965,187.48036608096504,570.4831514796122,190.99876437202872\"', '2021-10-06 04:23:36', '2021-10-06 04:23:36'),
(744, 4, 'SH03-4', '\"472.8070475455251,285.6542578920881,462.25331880566966,279.67381160617,460.84615497368895,282.1363483121363,470.69630179755404,289.5239584300351\"', '2021-10-06 04:23:46', '2021-10-06 04:23:46'),
(745, 4, 'LK03-24', '\"558.9226999518314,187.48036608096504,560.4305849337159,184.96722444449097,569.9805231523173,190.99876437202872,567.9700098431381,194.51716266309242\"', '2021-10-06 04:24:06', '2021-10-06 04:24:06');
INSERT INTO `map_config` (`id`, `project_id`, `name`, `zone`, `created_at`, `updated_at`) VALUES
(746, 4, 'SH03-5', '\"471.3998837135444,289.1721674720399,459.7907820997034,282.48813927013146,456.9764544357419,284.9506759760977,467.1783922176022,292.33828609399654\"', '2021-10-06 04:24:15', '2021-10-06 04:24:15'),
(747, 4, 'SH03-6', '\"468.23376509158777,291.28291322001104,458.0318273097275,284.5988850181026,455.217499645766,288.11679459805435,465.7712283856215,295.5044047159532\"', '2021-10-06 04:24:50', '2021-10-06 04:24:50'),
(748, 4, 'LK04-1', '\"565.456868206664,200.04607426333536,567.4673815158433,197.03030429956647,577.0173197344446,203.56447255439903,575.0068064252654,207.08287084546274\"', '2021-10-06 04:25:22', '2021-10-06 04:25:22'),
(750, 4, 'LK04-2', '\"562.9437265701899,203.56447255439903,564.9542398793692,200.54870259063017,575.0068064252654,207.08287084546274,572.4936647887913,210.0986408092316\"', '2021-10-06 04:25:46', '2021-10-06 04:25:46'),
(751, 4, 'SH03-8', '\"465.4194374276263,298.31873237991465,453.10675389779493,291.28291322001104,450.29242623383345,295.152613757958,461.5497368896793,301.48485100187133\"', '2021-10-06 04:26:02', '2021-10-06 04:26:02'),
(752, 4, 'LK04-3', '\"561.4358415883055,206.58024251816792,562.4410982428951,203.56447255439903,572.4936647887913,210.0986408092316,570.985779806907,212.61178244570567\"', '2021-10-06 04:26:16', '2021-10-06 04:26:16'),
(753, 4, 'LK04-4', '\"558.9226999518314,209.59601248193678,560.4305849337159,206.0776141908731,570.4831514796122,212.61178244570567,568.9752664977277,216.13018073676935\"', '2021-10-06 04:26:47', '2021-10-06 04:26:47'),
(754, 4, 'SH03-9', '\"469.28913796557333,267.0093371183434,458.73540922571783,261.7324727484157,455.5692906037612,265.6021732863627,465.7712283856215,271.934410530276\"', '2021-10-06 04:27:04', '2021-10-06 04:27:04'),
(755, 4, 'LK04-5', '\"556.4095583153573,212.61178244570567,558.9226999518314,210.0986408092316,568.9752664977277,216.63280906406416,565.9594965339588,220.15120735512784\"', '2021-10-06 04:27:18', '2021-10-06 04:27:18'),
(756, 4, 'LK04-6', '\"554.3990450061781,215.62755240947453,555.9069299880625,212.61178244570567,565.9594965339588,220.15120735512784,564.4516115520744,222.6643489916019\"', '2021-10-06 04:27:49', '2021-10-06 04:27:49'),
(757, 4, 'LK04-7', '\"552.3885316969988,219.1459507005382,554.3990450061781,216.13018073676935,564.4516115520744,222.6643489916019,561.9384699156003,225.68011895537077\"', '2021-10-06 04:28:17', '2021-10-06 04:28:17'),
(758, 4, 'SH03-10', '\"466.47481030161185,271.934410530276,454.51391772977564,265.6021732863627,452.4031719818046,268.7682919083193,463.6604826376504,275.4523201102278\"', '2021-10-06 04:28:30', '2021-10-06 04:28:30'),
(759, 4, 'LK04-8', '\"550.3780183878196,222.1617206643071,552.3885316969988,219.64857902783302,561.4358415883055,225.17749062807596,559.4253282791262,228.69588891913966\"', '2021-10-06 04:28:40', '2021-10-06 04:28:40'),
(760, 4, 'SH03-11', '\"463.6604826376504,274.74873819423743,453.8103358137853,269.12008286631453,451.347799107819,272.28620148827116,461.1979459316841,278.9702296901796\"', '2021-10-06 04:29:00', '2021-10-06 04:29:00'),
(761, 4, 'LK04-9', '\"547.8648767513456,225.17749062807596,550.3780183878196,222.6643489916019,559.927956606421,228.69588891913966,557.9174432972418,232.21428721020334\"', '2021-10-06 04:29:11', '2021-10-06 04:29:11'),
(762, 4, 'test', '\"455.217499645766,276.85948394220856,458.3836182677227,278.9702296901796\"', '2021-10-06 04:30:36', '2021-10-06 04:30:36'),
(763, 4, 'LK04-10', '\"546.3569917694612,228.19326059184485,547.8648767513456,225.68011895537077,557.414814969947,231.71165888290852,555.4043016607677,235.23005717397223\"', '2021-10-06 04:31:34', '2021-10-06 04:31:34'),
(764, 4, 'LK04-11', '\"543.8438501329871,231.71165888290852,545.3517351148715,228.19326059184485,555.4043016607677,235.23005717397223,553.8964166788833,237.74319881044627\"', '2021-10-06 04:32:00', '2021-10-06 04:32:00'),
(765, 4, 'LK04-12', '\"554.9016733334729,192.50664935391316,556.4095583153573,189.9935077174391,565.9594965339588,196.52767597227165,562.9437265701899,199.54344593604054\"', '2021-10-06 04:32:28', '2021-10-06 04:32:28'),
(766, 4, 'LK04-13', '\"552.3885316969988,196.52767597227165,554.3990450061781,193.5119060085028,563.9489832247796,199.54344593604054,561.4358415883055,203.56447255439903\"', '2021-10-06 04:32:53', '2021-10-06 04:32:53'),
(767, 4, 'LK04-14', '\"550.8806467151144,200.04607426333536,551.885903369704,196.52767597227165,561.4358415883055,203.56447255439903,559.927956606421,206.0776141908731\"', '2021-10-06 04:33:26', '2021-10-06 04:33:26'),
(769, 4, 'LK04-15', '\"548.8701334059351,203.06184422710422,550.3780183878196,199.54344593604054,559.927956606421,206.0776141908731,557.9174432972418,209.59601248193678\"', '2021-10-06 04:44:35', '2021-10-06 04:44:35'),
(770, 4, 'LK04-16', '\"546.3569917694612,205.5749858635783,547.8648767513456,203.06184422710422,557.414814969947,209.09338415464197,555.9069299880625,212.10915411841086\"', '2021-10-06 04:45:05', '2021-10-06 04:45:05'),
(771, 4, 'SH03-12', '\"462.25331880566966,279.67381160617,451.69959006581416,271.5826195722808,448.53347144385754,275.10052915223264,458.73540922571783,282.1363483121363,461.5497368896793,279.67381160617,462.25331880566966,279.3220206481748\"', '2021-10-06 04:49:43', '2021-10-06 04:49:43'),
(773, 4, 'SH02-13', '\"449.5888443178431,275.4523201102278,447.1263076118768,277.5630658581989,458.0318273097275,285.30246693409293,460.14257305769854,281.4327663961459\"', '2021-10-06 04:51:04', '2021-10-06 04:51:04'),
(774, 4, 'SH03-14', '\"457.3282453937371,284.2470940601074,447.478098569872,277.9148568161941,445.3673528219009,281.08097543815074,454.51391772977564,287.7650036400592\"', '2021-10-06 04:51:41', '2021-10-06 04:51:41'),
(775, 4, 'SH03-15', '\"455.5692906037612,288.11679459805435,444.66377090591055,281.08097543815074,441.4976522839539,283.1917211861218,453.10675389779493,290.93112226201583\"', '2021-10-06 04:52:04', '2021-10-06 04:52:04'),
(776, 4, 'LK04-17', '\"544.3464784602819,209.09338415464197,545.8543634421663,206.0776141908731,555.9069299880625,213.11441077300046,553.8964166788833,216.13018073676935\"', '2021-10-06 04:52:10', '2021-10-06 04:52:10'),
(777, 4, 'LK04-18', '\"542.3359651511026,212.10915411841086,543.8438501329871,209.59601248193678,551.885903369704,215.62755240947453,550.8806467151144,218.64332237324342\"', '2021-10-06 04:52:38', '2021-10-06 04:52:38'),
(778, 4, 'SH03-7', '\"466.47481030161185,294.8008227999628,455.92108156175635,289.1721674720399,454.51391772977564,290.93112226201583,464.36406455364073,299.022314295905\"', '2021-10-06 04:52:41', '2021-10-06 04:52:41'),
(779, 4, 'LK04-19', '\"539.8228235146286,215.12492408217972,541.330708496513,212.10915411841086,551.3832750424092,218.64332237324342,549.3727617332299,222.1617206643071\"', '2021-10-06 04:53:03', '2021-10-06 04:53:03'),
(780, 4, 'LK04-20', '\"537.8123102054493,218.64332237324342,539.3201951873338,215.12492408217972,549.3727617332299,222.1617206643071,547.3622484240508,225.17749062807596\"', '2021-10-06 04:53:25', '2021-10-06 04:53:25'),
(781, 4, 'LK04-21', '\"535.80179689627,221.65909233701228,537.3096818781545,218.64332237324342,546.859620096756,225.17749062807596,545.3517351148715,228.69588891913966\"', '2021-10-06 04:53:49', '2021-10-06 04:53:49'),
(782, 4, 'SH03-16', '\"453.8103358137853,290.93112226201583,442.55302515793943,284.2470940601074,440.09048845197316,288.11679459805435,450.29242623383345,295.152613757958\"', '2021-10-06 04:53:58', '2021-10-06 04:53:58'),
(783, 4, 'LK04-22', '\"534.2939119143856,224.67486230078114,535.2991685689752,221.15646400971747,544.8491067875767,227.69063226455003,542.8385934783975,231.71165888290852\"', '2021-10-06 04:54:13', '2021-10-06 04:54:13'),
(784, 4, 'SH02-1', '\"540.3254518419234,237.24057048315146,542.3359651511026,233.72217219208778,552.3885316969988,240.75896877421516,549.8753900605248,244.27736706527884\"', '2021-10-06 04:54:53', '2021-10-06 04:54:53'),
(785, 4, 'SH02-2', '\"537.8123102054493,240.75896877421516,539.8228235146286,237.24057048315146,550.3780183878196,244.77999539257365,547.3622484240508,247.29313702904773\"', '2021-10-06 04:55:26', '2021-10-06 04:55:26'),
(786, 4, 'SH02-3', '\"536.3044252235649,243.77473873798402,537.8123102054493,240.25634044692035,547.3622484240508,246.7905087017529,545.3517351148715,250.3089069928166\"', '2021-10-06 04:55:50', '2021-10-06 04:55:50'),
(787, 4, 'SH02-4', '\"534.2939119143856,246.2878803744581,535.80179689627,243.77473873798402,545.8543634421663,250.8115353201114,543.8438501329871,254.32993361117508\"', '2021-10-06 04:56:19', '2021-10-06 04:56:19'),
(788, 4, 'SH02-5', '\"531.7807702779115,250.3089069928166,533.7912835870908,246.7905087017529,543.8438501329871,253.82730528388026,541.330708496513,256.84307524764915\"', '2021-10-06 04:56:42', '2021-10-06 04:56:42'),
(789, 4, 'SH02-6', '\"529.7702569687323,252.82204862929066,531.7807702779115,250.3089069928166,541.330708496513,256.34044692035434,539.8228235146286,259.85884521141804\"', '2021-10-06 04:57:16', '2021-10-06 04:57:16'),
(790, 4, 'SH02-7', '\"527.2571153322582,255.83781859305952,530.2728852960271,252.82204862929066,539.8228235146286,259.85884521141804,536.8070535508597,262.3719868478921\"', '2021-10-06 04:57:41', '2021-10-06 04:57:41'),
(792, 4, 'SH02-8', '\"525.7492303503738,259.3562168841232,527.2571153322582,256.34044692035434,537.3096818781545,262.8746151751869,535.2991685689752,265.89038513895576\"', '2021-10-06 04:59:12', '2021-10-06 04:59:12'),
(793, 4, 'SH02-9', '\"522.733460386605,263.3772435024817,525.2466020230789,259.3562168841232,536.8070535508597,265.89038513895576,533.7912835870908,267.900898448135,529.2676286414375,268.40352677542984\"', '2021-10-06 04:59:35', '2021-10-06 04:59:35'),
(794, 4, 'SH02-10', '\"529.2676286414375,230.7064022283189,531.7807702779115,226.6853756099604,541.8333368238078,234.2248005193826,539.8228235146286,237.24057048315146\"', '2021-10-06 05:00:00', '2021-10-06 05:00:00'),
(795, 4, 'SH02-11', '\"527.759743659553,233.72217219208778,529.7702569687323,230.7064022283189,539.3201951873338,236.73794215585664,537.3096818781545,239.75371211962553\"', '2021-10-06 05:00:23', '2021-10-06 05:00:23'),
(796, 4, 'SH02-12', '\"525.7492303503738,236.23531382856186,527.759743659553,233.72217219208778,536.8070535508597,239.75371211962553,535.2991685689752,243.77473873798402\"', '2021-10-06 05:00:54', '2021-10-06 05:00:54'),
(797, 4, 'SH02-13', '\"523.7387170411946,239.75371211962553,525.2466020230789,236.73794215585664,535.2991685689752,243.2721104106892,533.7912835870908,246.7905087017529\"', '2021-10-06 05:01:26', '2021-10-06 05:01:26'),
(798, 4, 'SH02-14', '\"521.2255754047205,243.77473873798402,523.7387170411946,239.75371211962553,532.7860269325012,246.2878803744581,530.2728852960271,249.80627866552177\"', '2021-10-06 05:01:54', '2021-10-06 05:01:54'),
(799, 4, 'SH02-15', '\"519.2150620955413,246.2878803744581,521.2255754047205,242.7694820833944,530.7755136233219,249.80627866552177,528.7650003141426,252.31942030199585\"', '2021-10-06 05:02:23', '2021-10-06 05:02:23'),
(801, 4, 'SH02-16', '\"516.7019204590672,249.30365033822696,519.2150620955413,246.2878803744581,527.759743659553,252.31942030199585,526.2518586776686,255.83781859305952\"', '2021-10-06 05:27:05', '2021-10-06 05:27:05'),
(802, 4, 'SH02-17', '\"515.1940354771828,252.31942030199585,516.7019204590672,249.30365033822696,526.7544870049634,255.3351902657647,524.7439736957842,258.8535885568284\"', '2021-10-06 05:27:39', '2021-10-06 05:27:39'),
(804, 4, 'SH02-18', '\"514.6914071498879,257.34570357494397,512.1782655134139,254.8325619384699,514.1887788225931,251.81679197470103,524.7439736957842,259.3562168841232,521.7282037320153,262.8746151751869\"', '2021-10-06 05:28:46', '2021-10-06 05:28:46'),
(805, 4, 'SH04-1', '\"448.3444679469727,301.07436804959264,450.3549812561519,298.05859808582375,459.4022911474586,304.59276634065634,458.39703449286895,307.60853630442523\"', '2021-10-06 06:56:33', '2021-10-06 06:56:33'),
(806, 4, 'SH04-1', '\"448.3444679469727,301.07436804959264,450.3549812561519,298.05859808582375,459.4022911474586,304.59276634065634,458.39703449286895,307.60853630442523\"', '2021-10-06 06:56:33', '2021-10-06 06:56:33'),
(807, 4, 'SH04-2', '\"445.83132631049864,304.59276634065634,448.3444679469727,301.07436804959264,458.39703449286895,308.11116463172004,456.3865211836897,311.6295629227837\"', '2021-10-06 06:58:01', '2021-10-06 06:58:01'),
(808, 4, 'SH04-3', '\"443.8208130013194,307.1059079771304,445.83132631049864,304.59276634065634,455.38126452910006,311.1269345954889,453.8733795472156,314.14270455925777\"', '2021-10-06 06:58:31', '2021-10-06 06:58:31'),
(809, 4, 'SH04-4', '\"441.8102996921401,310.62430626819406,443.8208130013194,307.60853630442523,453.8733795472156,314.14270455925777,450.3549812561519,317.15847452302665\"', '2021-10-06 06:59:04', '2021-10-06 06:59:04'),
(810, 4, 'SH04-5', '\"439.79978638296086,313.64007623196295,440.8050430375505,310.12167794089925,451.86286623803636,317.66110285032147,450.3549812561519,321.1795011413851\"', '2021-10-06 06:59:33', '2021-10-06 06:59:33'),
(811, 4, 'SH04-6', '\"437.28664474648684,316.65584619573184,439.79978638296086,313.64007623196295,449.3497246015623,320.17424448679554,446.83658296508827,323.1900144505644\"', '2021-10-06 07:00:26', '2021-10-06 07:00:26'),
(812, 4, 'SH04-7', '\"435.2761314373076,320.17424448679554,436.784016419192,316.65584619573184,446.83658296508827,323.1900144505644,445.3286979832038,326.7084127416281\"', '2021-10-06 07:01:00', '2021-10-06 07:01:00'),
(813, 4, 'SH04-8', '\"433.2656181281283,323.1900144505644,434.77350311001277,320.17424448679554,444.3234413286142,326.7084127416281,443.8208130013194,330.2268110326918\"', '2021-10-06 07:01:40', '2021-10-06 07:01:40'),
(814, 4, 'SH04-9', '\"437.28664474648684,294.5401997947601,439.79978638296086,290.5191731764016,449.8523529288571,297.0533414312342,447.3392112923831,301.07436804959264\"', '2021-10-06 07:02:32', '2021-10-06 07:02:32'),
(815, 4, 'SH04-10', '\"435.2761314373076,297.0533414312342,437.28664474648684,293.53494314017047,446.83658296508827,300.5717397222978,445.3286979832038,303.5875096860667\"', '2021-10-06 07:03:04', '2021-10-06 07:03:04'),
(816, 4, 'SH04-11', '\"433.2656181281283,301.07436804959264,435.2761314373076,297.0533414312342,444.826069655909,303.5875096860667,442.31292801943493,307.1059079771304\"', '2021-10-06 07:03:35', '2021-10-06 07:03:35'),
(817, 4, 'SH04-12', '\"431.25510481894906,304.0901380133615,433.2656181281283,300.5717397222978,442.31292801943493,307.1059079771304,440.3024147102557,310.62430626819406\"', '2021-10-06 07:04:16', '2021-10-06 07:04:16'),
(818, 4, 'SH04-13', '\"429.2445915097698,307.1059079771304,430.75247649165425,303.0848813587719,440.8050430375505,310.12167794089925,438.79452972837123,313.64007623196295\"', '2021-10-06 07:04:42', '2021-10-06 07:04:42'),
(819, 4, 'SH04-15', '\"427.23407820059055,310.62430626819406,428.741963182475,306.6032796498356,438.79452972837123,313.13744790466814,436.784016419192,316.65584619573184\"', '2021-10-06 07:05:32', '2021-10-06 07:05:32'),
(820, 4, 'SH04-15', '\"425.22356489141134,313.13744790466814,427.23407820059055,309.61904961360443,436.784016419192,316.153217868437,434.77350311001277,320.17424448679554\"', '2021-10-06 07:05:57', '2021-10-06 07:05:57'),
(821, 4, 'SH04-16', '\"423.2130515822321,317.15847452302665,424.7209365641165,313.13744790466814,434.27087478271795,320.17424448679554,432.2603614735387,323.1900144505644\"', '2021-10-06 07:06:22', '2021-10-06 07:06:22'),
(822, 4, 'SH05-1', '\"430.24984816435943,328.71892605080734,431.7577331462439,326.20578441433327,441.3076713648453,332.23732434187104,439.29715805566605,335.7557226329347\"', '2021-10-06 07:07:01', '2021-10-06 07:07:01'),
(823, 4, 'SH05-2', '\"427.23407820059055,332.23732434187104,429.2445915097698,328.71892605080734,439.29715805566605,335.2530943056399,436.784016419192,338.7714925967036\"', '2021-10-06 07:07:22', '2021-10-06 07:07:22'),
(824, 4, 'SH05-3', '\"425.22356489141134,335.7557226329347,426.73144987329573,331.2320676872814,436.784016419192,338.26886426940877,435.2761314373076,342.2898908877673\"', '2021-10-06 07:07:41', '2021-10-06 07:07:41'),
(825, 4, 'SH05-4', '\"424.2183082368217,338.26886426940877,425.22356489141134,335.2530943056399,436.2813880918972,342.2898908877673,433.76824645542314,345.3056608515361\"', '2021-10-06 07:08:10', '2021-10-06 07:08:10'),
(826, 4, 'SH05-5', '\"421.2025382730528,341.78726256047247,423.2130515822321,338.26886426940877,433.2656181281283,345.3056608515361,431.25510481894906,348.321430815305\"', '2021-10-06 07:08:34', '2021-10-06 07:08:34'),
(827, 4, 'SH05-6', '\"419.19202496387356,344.8030325242413,420.699909945758,341.28463423317766,430.75247649165425,347.8188024880102,429.2445915097698,351.3372007790739\"', '2021-10-06 07:09:00', '2021-10-06 07:09:00'),
(828, 4, 'SH05-7', '\"416.1762550001047,348.321430815305,418.68939663657875,344.8030325242413,429.2445915097698,351.8398291063687,426.73144987329573,353.85034241554797,422.20779492764245,353.85034241554797\"', '2021-10-06 07:09:27', '2021-10-06 07:09:27'),
(830, 4, 'SH05-8', '\"421.70516660034764,318.1637311776163,419.19202496387356,321.68212946867993,428.741963182475,328.71892605080734,431.25510481894906,325.20052775974364\"', '2021-10-06 07:09:59', '2021-10-06 07:09:59'),
(831, 4, 'SH05-9', '\"416.6788833273995,325.20052775974364,418.68939663657875,322.18475779597475,428.741963182475,328.71892605080734,425.72619321870616,331.73469601457623\"', '2021-10-06 07:10:24', '2021-10-06 07:10:24'),
(832, 4, 'LK13-1', '\"284.9506759760977,379.2306527188066,283.89530310211217,373.9537883488789,281.08097543815074,371.49125164291263,274.0451562782471,382.0449803827681,278.6184387321845,386.26647187871026\"', '2021-10-06 07:10:25', '2021-10-06 07:10:25'),
(833, 4, 'SH05-10', '\"415.17099834551505,327.7136693962177,416.6788833273995,325.20052775974364,426.73144987329573,331.73469601457623,424.7209365641165,335.2530943056399\"', '2021-10-06 07:11:00', '2021-10-06 07:11:00'),
(834, 4, 'SH05-11', '\"413.66311336363066,331.73469601457623,414.66837001822023,328.2162977235125,424.7209365641165,335.7557226329347,422.20779492764245,338.26886426940877\"', '2021-10-06 07:11:23', '2021-10-06 07:11:23'),
(835, 4, 'SH05-12', '\"410.64734339986177,335.2530943056399,413.16048503633584,331.73469601457623,422.20779492764245,337.76623594211395,419.6946532911684,341.28463423317766\"', '2021-10-06 07:11:44', '2021-10-06 07:11:44'),
(836, 4, 'SH05-13', '\"408.6368300906825,337.26360761481914,410.14471507256695,333.74520932375543,420.1972816184632,340.78200590588284,418.68939663657875,344.8030325242413\"', '2021-10-06 07:12:05', '2021-10-06 07:12:05'),
(837, 4, 'SH05-14', '\"408.6368300906825,342.7925192150621,408.1342017633877,337.76623594211395,418.68939663657875,345.3056608515361,415.67362667280986,348.8240591425998\"', '2021-10-06 07:12:37', '2021-10-06 07:12:37'),
(838, 4, 'LK05-1', '\"407.12894510879806,361.89239565226495,409.64208674527214,357.3687407066116,418.68939663657875,363.4002806341494,418.18676830928393,368.4265639070975\"', '2021-10-06 07:13:33', '2021-10-06 07:13:33'),
(840, 4, 'LK05-2', '\"405.6210601269136,365.41079394332866,407.12894510879806,361.89239565226495,417.1815116546943,368.4265639070975,415.17099834551505,371.9449621981612\"', '2021-10-06 07:14:06', '2021-10-06 07:14:06'),
(842, 4, 'LK05-3', '\"403.61054681773436,367.9239355798027,405.1184317996188,364.405537288739,414.66837001822023,371.4423338708664,413.16048503633584,374.45810383463527\"', '2021-10-06 07:14:32', '2021-10-06 07:14:32'),
(843, 4, 'LK13-2', '\"276.85948394220856,369.7322968529367,270.1754557403001,379.934234634797,272.63799244626637,382.3967713407633,279.67381160617,371.49125164291263\"', '2021-10-06 07:14:55', '2021-10-06 07:14:55'),
(844, 4, 'LK05-4', '\"401.09740518126034,371.4423338708664,403.10791849043954,367.9239355798027,413.16048503633584,374.45810383463527,410.64734339986177,377.97650212569897\"', '2021-10-06 07:14:57', '2021-10-06 07:14:57'),
(845, 4, 'LK13-3', '\"275.4523201102278,369.3805058949415,272.28620148827116,366.56617823098003,265.9539642443579,375.0091612228644,268.7682919083193,378.87886176081145\"', '2021-10-06 07:15:20', '2021-10-06 07:15:20'),
(846, 4, 'LK05-5', '\"399.5895201993759,374.45810383463527,401.09740518126034,371.4423338708664,410.64734339986177,377.97650212569897,409.1394584179773,381.4949004167626\"', '2021-10-06 07:15:22', '2021-10-06 07:15:22'),
(847, 4, 'LK05-6', '\"397.0763785629018,377.97650212569897,399.0868918720811,373.95547550734045,408.6368300906825,380.489643762173,406.62631678150325,384.5106703805315\"', '2021-10-06 07:15:51', '2021-10-06 07:15:51'),
(848, 4, 'LK13-4', '\"271.5826195722808,365.5108053569945,264.54680041237714,376.4163250548452,261.3806817904205,373.9537883488789,268.4165009503242,363.4000596090234\"', '2021-10-06 07:15:54', '2021-10-06 07:15:54'),
(849, 4, 'LK13-5', '\"267.0093371183434,362.69647769303305,262.7878456224012,360.93752290305713,257.1591902944783,369.7322968529367,261.02889083242536,373.6019973908837\"', '2021-10-06 07:16:15', '2021-10-06 07:16:15'),
(850, 4, 'LK05-7', '\"394.56323692642775,380.9922720894678,396.573750235607,376.97124547110934,406.62631678150325,383.5054137259419,404.615803472324,387.5264403443004\"', '2021-10-06 07:16:18', '2021-10-06 07:16:18'),
(851, 4, 'LK13-6', '\"263.8432184963868,360.2339409870668,259.9735179584398,356.71603140711494,251.8823259245506,367.9733420629608,256.10381742049276,370.7876697269222\"', '2021-10-06 07:16:43', '2021-10-06 07:16:43'),
(852, 4, 'LK13-7', '\"258.91814508445424,357.06782236511015,254.69665358851205,353.90170374315346,247.6608344286084,364.45543248300896,251.53053496655542,367.26976014697044\"', '2021-10-06 07:17:04', '2021-10-06 07:17:04'),
(853, 4, 'LK13-8', '\"278.6184387321845,386.9700537947006,274.0451562782471,383.4521442147488,265.6021732863627,394.0058729546043,268.7682919083193,395.06124582858985,272.63799244626637,395.413036786585\"', '2021-10-06 07:17:41', '2021-10-06 07:17:41'),
(855, 4, 'LK05-8', '\"393.0553519445433,383.5054137259419,394.56323692642775,380.489643762173,404.615803472324,387.0238120170056,402.10266183585,391.04483863536404\"', '2021-10-06 07:18:27', '2021-10-06 07:18:27'),
(856, 4, 'LK13-9', '\"274.0451562782471,382.0449803827681,269.8236647823049,380.28602559279216,262.4360546644061,390.48796337465245,265.6021732863627,392.24691816462837\"', '2021-10-06 07:18:39', '2021-10-06 07:18:39'),
(857, 4, 'LK05-9', '\"390.5422103080693,386.52118368971077,391.54746696265886,383.5054137259419,401.60003350855516,390.5422103080693,400.5947768539655,393.5579802718381\"', '2021-10-06 07:18:51', '2021-10-06 07:18:51'),
(860, 4, 'LK05-10', '\"397.0763785629018,354.3529707428428,402.10266183585,351.8398291063687,410.14471507256695,357.3687407066116,406.62631678150325,361.38976732497014\"', '2021-10-06 07:19:22', '2021-10-06 07:19:22'),
(861, 4, 'LK05-11', '\"395.06586525372256,357.87136903390643,397.0763785629018,354.3529707428428,406.62631678150325,361.38976732497014,404.615803472324,364.405537288739\"', '2021-10-06 07:19:56', '2021-10-06 07:19:56'),
(863, 4, 'LK05-12', '\"393.0553519445433,360.8871389976753,394.06060859913293,357.3687407066116,404.615803472324,364.405537288739,402.10266183585,367.9239355798027\"', '2021-10-06 07:20:21', '2021-10-06 07:20:21'),
(864, 4, 'LK13-10', '\"269.47187382430974,380.28602559279216,265.25038232836755,377.11990697083553,257.5109812524735,386.9700537947006,261.7324727484157,388.72900858467654\"', '2021-10-06 07:20:55', '2021-10-06 07:20:55'),
(865, 4, 'LK05-13', '\"390.5422103080693,363.9029089614442,392.0500952899537,360.8871389976753,403.10791849043954,368.4265639070975,400.5947768539655,371.4423338708664\"', '2021-10-06 07:21:02', '2021-10-06 07:21:02'),
(866, 4, 'LK13-11', '\"265.25038232836755,376.7681160128403,261.3806817904205,373.9537883488789,253.2894897565313,383.803935172744,257.5109812524735,386.61826283670547\"', '2021-10-06 07:21:17', '2021-10-06 07:21:17'),
(867, 4, 'LK05-14', '\"389.03432532618484,367.4213072525079,390.03958198077447,363.9029089614442,400.0921485266707,370.93970554357156,398.08163521749145,374.9607321619301\"', '2021-10-06 07:21:30', '2021-10-06 07:21:30'),
(868, 4, 'LK05-15', '\"386.52118368971077,370.93970554357156,388.53169699889,366.9186789252131,397.0763785629018,372.9502188527508,395.06586525372256,377.47387379840416\"', '2021-10-06 07:22:03', '2021-10-06 07:22:03'),
(869, 4, 'LK13-12', '\"260.32530891643495,372.89841547489334,256.8073993364832,370.7876697269222,249.7715801765795,380.9896075087825,253.2894897565313,384.1557261307392\"', '2021-10-06 07:22:08', '2021-10-06 07:22:08'),
(870, 4, 'LK05-16', '\"384.5106703805315,373.45284718004564,386.01855536241595,370.43707721627675,396.0711219083122,376.97124547110934,394.06060859913293,380.489643762173\"', '2021-10-06 07:22:31', '2021-10-06 07:22:31'),
(871, 4, 'LK13-13', '\"256.10381742049276,370.08408781093186,252.58590784054095,368.32513302095595,245.55008868063732,379.2306527188066,249.06799826058912,381.3413984667777\"', '2021-10-06 07:22:49', '2021-10-06 07:22:49'),
(872, 4, 'LK05-17', '\"383.00278539864706,376.4686171438145,384.0080420532367,372.9502188527508,394.56323692642775,380.489643762173,392.0500952899537,383.5054137259419\"', '2021-10-06 07:23:23', '2021-10-06 07:23:23'),
(873, 4, 'LK13-14', '\"252.58590784054095,368.32513302095595,248.71620730259394,364.45543248300896,240.62501526870474,375.3609521808596,244.49471580665175,377.8234888868259\"', '2021-10-06 07:23:30', '2021-10-06 07:23:30'),
(874, 4, 'LK05-18', '\"379.9870154348782,379.9870154348782,381.99752874405743,376.4686171438145,391.54746696265886,383.00278539864706,389.53695365347966,386.52118368971077\"', '2021-10-06 07:23:49', '2021-10-06 07:23:49'),
(875, 4, 'LK06-1', '\"387.0238120170056,392.5527236172485,389.03432532618484,389.03432532618484,399.0868918720811,396.0711219083122,396.573750235607,399.5895201993759\"', '2021-10-06 07:24:28', '2021-10-06 07:24:28'),
(876, 4, 'LK06-2', '\"385.0132987078263,396.0711219083122,386.01855536241595,392.0500952899537,396.573750235607,399.0868918720811,394.56323692642775,402.60529016314473\"', '2021-10-06 07:25:01', '2021-10-06 07:25:01'),
(877, 4, 'LK06-3', '\"381.99752874405743,398.08163521749145,384.0080420532367,395.06586525372256,394.56323692642775,402.10266183585,392.0500952899537,406.12368845420843\"', '2021-10-06 07:25:33', '2021-10-06 07:25:33'),
(878, 4, 'LK06-4', '\"379.9870154348782,401.60003350855516,381.4949004167626,398.58426354478627,392.0500952899537,405.6210601269136,390.03958198077447,408.6368300906825\"', '2021-10-06 07:26:00', '2021-10-06 07:26:00'),
(879, 4, 'LK06-5', '\"378.4791304529938,404.615803472324,379.48438710758336,402.10266183585,390.03958198077447,408.6368300906825,388.0290686715952,412.1552283817462\"', '2021-10-06 07:26:27', '2021-10-06 07:26:27'),
(880, 4, 'LK06-6', '\"375.9659888165197,408.1342017633877,377.97650212569897,404.615803472324,388.0290686715952,411.6526000544514,386.01855536241595,414.66837001822023\"', '2021-10-06 07:26:58', '2021-10-06 07:26:58'),
(881, 4, 'LK06-7', '\"373.45284718004564,411.1499717271566,375.9659888165197,407.6315734360929,386.01855536241595,414.66837001822023,383.5054137259419,418.18676830928393\"', '2021-10-06 07:27:36', '2021-10-06 07:27:36'),
(882, 4, 'LK06-8', '\"371.9449621981612,414.1657416909255,373.45284718004564,411.1499717271566,383.5054137259419,417.6841399819891,380.9922720894678,421.2025382730528\"', '2021-10-06 07:28:02', '2021-10-06 07:28:02'),
(884, 4, 'LK06-9', '\"369.4318205616871,417.1815116546943,371.4423338708664,414.1657416909255,381.4949004167626,421.2025382730528,379.48438710758336,424.7209365641165\"', '2021-10-06 07:28:26', '2021-10-06 07:28:26'),
(887, 4, 'LK06-10', '\"375.9659888165197,385.51592703512114,378.4791304529938,381.4949004167626,388.53169699889,388.53169699889,385.51592703512114,392.5527236172485\"', '2021-10-06 07:29:08', '2021-10-06 07:29:08'),
(888, 4, 'LK06-11', '\"373.95547550734045,388.0290686715952,375.4633604892249,385.0132987078263,385.51592703512114,392.0500952899537,383.5054137259419,395.5684935810174\"', '2021-10-06 07:29:32', '2021-10-06 07:29:32'),
(889, 4, 'test', '\"244.14292484865658,352.84633086916796\"', '2021-10-06 07:29:41', '2021-10-06 07:29:41'),
(890, 4, 'LK06-12', '\"371.9449621981612,391.54746696265886,373.95547550734045,388.53169699889,383.5054137259419,395.5684935810174,381.4949004167626,398.58426354478627\"', '2021-10-06 07:30:01', '2021-10-06 07:30:01'),
(891, 4, 'LK06-13', '\"369.93444888898193,395.06586525372256,370.93970554357156,391.54746696265886,380.9922720894678,398.58426354478627,379.48438710758336,402.10266183585\"', '2021-10-06 07:30:35', '2021-10-06 07:30:35'),
(893, 4, 'LK06-14', '\"367.9239355798027,398.08163521749145,369.4318205616871,394.56323692642775,379.48438710758336,401.60003350855516,376.97124547110934,404.615803472324\"', '2021-10-06 07:31:01', '2021-10-06 07:31:01'),
(895, 4, 'LK06-15', '\"365.41079394332866,401.09740518126034,367.9239355798027,397.57900689019664,376.97124547110934,404.615803472324,374.45810383463527,408.1342017633877\"', '2021-10-06 07:31:36', '2021-10-06 07:31:36'),
(896, 4, 'LK14-1', '\"253.2894897565313,353.1981218271631,249.06799826058912,350.3837941632017,243.08755197467104,360.93752290305713,244.84650676464693,363.04826865102825\"', '2021-10-06 07:31:49', '2021-10-06 07:31:49'),
(897, 4, 'LK06-16', '\"363.9029089614442,404.1131751450292,365.41079394332866,400.5947768539655,374.9607321619301,407.6315734360929,372.9502188527508,410.64734339986177\"', '2021-10-06 07:32:03', '2021-10-06 07:32:03'),
(898, 4, 'LK14-2', '\"248.71620730259394,349.6802122472113,245.55008868063732,347.217675541245,238.86606047872885,358.12319523909565,241.6803881426903,360.2339409870668\"', '2021-10-06 07:32:10', '2021-10-06 07:32:10'),
(899, 4, 'LK14-3', '\"244.14292484865658,347.217675541245,240.27322431070957,344.4033478772836,234.64456898278667,354.957076617139,237.10710568875294,357.7714042811005\"', '2021-10-06 07:32:37', '2021-10-06 07:32:37'),
(900, 4, 'LK06-17', '\"361.38976732497014,407.6315734360929,362.8976523068546,404.1131751450292,372.9502188527508,411.1499717271566,370.93970554357156,414.1657416909255\"', '2021-10-06 07:32:40', '2021-10-06 07:32:40'),
(901, 4, 'LK14-4', '\"240.27322431070957,344.0515569192884,236.40352377276255,341.9408111713173,230.77486844483965,351.08737607919204,232.88561419281075,354.25349470114867\"', '2021-10-06 07:33:05', '2021-10-06 07:33:05'),
(902, 4, 'LK06-18', '\"358.87662568849606,410.64734339986177,360.8871389976753,407.12894510879806,370.93970554357156,414.1657416909255,368.9291922343923,417.6841399819891\"', '2021-10-06 07:33:11', '2021-10-06 07:33:11'),
(903, 4, 'LK07-1', '\"365.41079394332866,422.71042325493727,367.9239355798027,419.19202496387356,377.97650212569897,426.73144987329573,375.9659888165197,429.7472198370646\"', '2021-10-06 07:33:40', '2021-10-06 07:33:40'),
(904, 4, 'LK14-5', '\"236.05173281476738,341.5890202133221,233.23740515080593,338.7746925493606,226.2015859909023,349.3284212892161,228.66412269686856,350.73558512119683\"', '2021-10-06 07:33:41', '2021-10-06 07:33:41'),
(905, 4, 'LK07-2', '\"363.4002806341494,426.2288215460009,365.91342227062347,422.71042325493727,374.9607321619301,429.2445915097698,373.45284718004564,432.7629898008335\"', '2021-10-06 07:34:06', '2021-10-06 07:34:06'),
(906, 4, 'LK14-6', '\"232.18203227682037,338.7746925493606,227.25695886488782,335.9603648853992,222.33188545295528,345.8105117092643,224.44263120092637,347.5694664992402\"', '2021-10-06 07:34:07', '2021-10-06 07:34:07'),
(908, 4, 'LK07-3', '\"360.8871389976753,429.2445915097698,363.4002806341494,425.22356489141134,372.9502188527508,432.7629898008335,370.93970554357156,436.784016419192\"', '2021-10-06 07:34:33', '2021-10-06 07:34:33'),
(909, 4, 'LK14-7', '\"227.608749822883,335.608573927404,223.739049284936,333.1460372214377,217.4068120410227,343.6997659612932,220.57293066297936,345.8105117092643\"', '2021-10-06 07:34:58', '2021-10-06 07:34:58'),
(910, 4, 'LK07-4', '\"359.3792540157909,432.7629898008335,360.8871389976753,429.2445915097698,370.93970554357156,436.2813880918972,368.9291922343923,439.29715805566605\"', '2021-10-06 07:34:58', '2021-10-06 07:34:58'),
(912, 4, 'LK07-5', '\"356.363484052022,436.2813880918972,358.87662568849606,432.7629898008335,369.4318205616871,439.29715805566605,366.9186789252131,442.31292801943493\"', '2021-10-06 07:35:20', '2021-10-06 07:35:20'),
(913, 4, 'LK07-6', '\"354.3529707428428,439.29715805566605,355.86085572472723,436.2813880918972,366.4160505979183,442.81555634672975,364.405537288739,446.33395463779345\"', '2021-10-06 07:35:43', '2021-10-06 07:35:43'),
(914, 4, 'LK07-7', '\"353.34771408825316,442.31292801943493,354.8555990701376,438.79452972837123,364.405537288739,445.83132631049864,362.8976523068546,448.8470962742675\"', '2021-10-06 07:36:11', '2021-10-06 07:36:11'),
(915, 4, 'LK07-8', '\"350.8345724517791,444.826069655909,352.84508576095834,441.8102996921401,362.8976523068546,448.3444679469727,360.8871389976753,452.3654945653312\"', '2021-10-06 07:36:35', '2021-10-06 07:36:35'),
(916, 4, 'LK07-9', '\"347.8188024880102,448.3444679469727,349.82931579718945,444.826069655909,360.3845106703805,451.86286623803636,356.363484052022,453.8733795472156\"', '2021-10-06 07:37:04', '2021-10-06 07:37:04'),
(917, 4, 'LK07-10', '\"355.3582273974324,416.1762550001047,356.8661123793168,412.657856709041,366.9186789252131,419.19202496387356,364.405537288739,422.20779492764245\"', '2021-10-06 07:37:39', '2021-10-06 07:37:39'),
(918, 4, 'LK14-8', '\"223.03546736894563,332.44245530544737,215.999648209042,343.6997659612932,212.48173862909016,340.1818563813414,218.81397587300344,330.33170955747624\"', '2021-10-06 07:37:45', '2021-10-06 07:37:45'),
(920, 4, 'LK07-11', '\"353.34771408825316,419.19202496387356,354.3529707428428,415.17099834551505,364.90816561603384,422.71042325493727,362.8976523068546,426.2288215460009\"', '2021-10-06 07:38:19', '2021-10-06 07:38:19'),
(922, 4, 'LK07-12', '\"350.8345724517791,422.20779492764245,352.84508576095834,419.19202496387356,362.8976523068546,426.2288215460009,360.8871389976753,428.741963182475\"', '2021-10-06 07:39:20', '2021-10-06 07:39:20'),
(923, 4, 'LK07-13', '\"348.8240591425998,425.22356489141134,350.33194412448427,422.20779492764245,360.3845106703805,428.741963182475,358.37399736120125,432.2603614735387\"', '2021-10-06 07:39:46', '2021-10-06 07:39:46'),
(924, 4, 'LK07-14', '\"346.81354583342056,428.741963182475,348.321430815305,425.72619321870616,358.87662568849606,432.7629898008335,356.363484052022,436.784016419192\"', '2021-10-06 07:40:07', '2021-10-06 07:40:07'),
(925, 4, 'LK07-15', '\"344.8030325242413,431.7577331462439,346.31091750612575,428.741963182475,355.86085572472723,436.2813880918972,353.34771408825316,439.29715805566605\"', '2021-10-06 07:40:33', '2021-10-06 07:40:33'),
(926, 4, 'LK07-16', '\"342.7925192150621,434.77350311001277,344.3004041969465,431.7577331462439,354.3529707428428,438.79452972837123,351.8398291063687,441.8102996921401\"', '2021-10-06 07:41:03', '2021-10-06 07:41:03'),
(927, 4, 'LK07-17', '\"340.279377578588,438.2919014010764,341.78726256047247,434.77350311001277,352.84508576095834,441.8102996921401,349.82931579718945,444.826069655909\"', '2021-10-06 07:41:27', '2021-10-06 07:41:27'),
(928, 4, 'LK07-18', '\"340.279377578588,443.8208130013194,339.7767492512932,437.7892730737816,350.33194412448427,444.826069655909,347.8188024880102,449.8523529288571\"', '2021-10-06 07:41:49', '2021-10-06 07:41:49'),
(929, 4, 'LK14-9', '\"245.9018796386325,364.10364152501376,242.03217910068548,361.28931386105234,234.64456898278667,370.43587876892707,238.51426952073365,373.2502064328885\"', '2021-10-06 07:42:30', '2021-10-06 07:42:30'),
(930, 4, 'LK14-10', '\"241.32859718469513,360.2339409870668,237.8106876047433,358.12319523909565,230.77486844483965,368.32513302095595,233.5891961088011,369.7322968529367\"', '2021-10-06 07:43:01', '2021-10-06 07:43:01'),
(931, 4, 'LK08-1', '\"377.97650212569897,343.2951475423569,380.9922720894678,337.26360761481914,390.5422103080693,344.8030325242413,388.0290686715952,350.8345724517791\"', '2021-10-06 07:44:37', '2021-10-06 07:44:37'),
(932, 4, 'LK08-2', '\"374.9607321619301,347.8188024880102,376.97124547110934,343.79777586965173,387.0238120170056,350.33194412448427,384.5106703805315,354.8555990701376\"', '2021-10-06 07:44:57', '2021-10-06 07:44:57'),
(933, 4, 'LK14-11', '\"237.10710568875294,357.06782236511015,233.5891961088011,356.0124494911246,227.25695886488782,365.1590143989993,230.42307748684448,367.26976014697044\"', '2021-10-06 07:45:07', '2021-10-06 07:45:07'),
(934, 4, 'LK08-3', '\"372.9502188527508,352.3424574336635,374.45810383463527,348.321430815305,384.5106703805315,355.3582273974324,381.4949004167626,358.87662568849606\"', '2021-10-06 07:45:22', '2021-10-06 07:45:22'),
(935, 4, 'LK14-12', '\"233.5891961088011,354.6052856591439,229.01591365486374,352.84633086916796,221.9800944949601,362.34468673503784,225.14621311691673,364.45543248300896\"', '2021-10-06 07:45:29', '2021-10-06 07:45:29'),
(937, 4, 'LK14-13', '\"229.01591365486374,351.4391670371872,225.14621311691673,349.6802122472113,217.7586029990179,359.88215002907157,221.6283035369649,363.4000596090234\"', '2021-10-06 07:45:58', '2021-10-06 07:45:58'),
(938, 4, 'LK08-4', '\"368.9291922343923,356.363484052022,371.9449621981612,351.8398291063687,381.99752874405743,358.87662568849606,379.48438710758336,362.8976523068546\"', '2021-10-06 07:46:27', '2021-10-06 07:46:27'),
(939, 4, 'LK08-5', '\"366.9186789252131,361.38976732497014,368.9291922343923,356.8661123793168,378.9817587802886,363.4002806341494,375.9659888165197,367.9239355798027\"', '2021-10-06 07:46:51', '2021-10-06 07:46:51'),
(940, 4, 'LK08-6', '\"364.405537288739,365.41079394332866,365.91342227062347,360.8871389976753,375.4633604892249,367.4213072525079,373.45284718004564,371.9449621981612\"', '2021-10-06 07:47:15', '2021-10-06 07:47:15'),
(941, 4, 'LK08-7', '\"360.3845106703805,368.9291922343923,362.8976523068546,364.405537288739,372.9502188527508,371.4423338708664,370.43707721627675,375.9659888165197\"', '2021-10-06 07:47:38', '2021-10-06 07:47:38'),
(942, 4, 'LK14-14', '\"224.79442215892155,350.3837941632017,220.92472162097454,347.5694664992402,214.94427533505643,357.06782236511015,216.35143916703717,359.5303590710764\"', '2021-10-06 07:48:04', '2021-10-06 07:48:04'),
(944, 4, 'LK14-15', '\"220.57293066297936,346.51409362525465,217.4068120410227,344.4033478772836,209.6674109651287,353.90170374315346,213.53711150307572,356.36424044911973\"', '2021-10-06 07:48:27', '2021-10-06 07:48:27'),
(946, 4, 'LK14-16', '\"216.35143916703717,342.9961840453028,213.18532054508051,341.2372292553269,205.44591946918652,351.4391670371872,208.96382904913835,354.25349470114867\"', '2021-10-06 07:48:54', '2021-10-06 07:48:54'),
(947, 4, 'LK08-8', '\"367.9239355798027,336.7609792875243,370.93970554357156,331.73469601457623,381.4949004167626,337.76623594211395,377.97650212569897,344.8030325242413\"', '2021-10-06 07:49:14', '2021-10-06 07:49:14'),
(948, 4, 'LK08-9', '\"364.405537288739,341.28463423317766,366.9186789252131,336.7609792875243,376.97124547110934,343.2951475423569,374.45810383463527,347.8188024880102\"', '2021-10-06 07:49:37', '2021-10-06 07:49:37'),
(949, 4, 'LK08-10', '\"361.38976732497014,344.8030325242413,363.9029089614442,340.78200590588284,373.95547550734045,347.3161741607154,371.4423338708664,352.3424574336635\"', '2021-10-06 07:50:10', '2021-10-06 07:50:10'),
(950, 4, 'LK08-11', '\"358.87662568849606,349.82931579718945,361.38976732497014,344.8030325242413,371.4423338708664,352.3424574336635,368.4265639070975,356.363484052022\"', '2021-10-06 07:50:43', '2021-10-06 07:50:43'),
(952, 4, 'LK08-12', '\"355.86085572472723,353.34771408825316,358.37399736120125,348.321430815305,368.4265639070975,355.86085572472723,365.41079394332866,360.3845106703805\"', '2021-10-06 07:51:36', '2021-10-06 07:51:36'),
(953, 4, 'LK08-13', '\"353.34771408825316,357.3687407066116,355.3582273974324,353.34771408825316,365.41079394332866,360.3845106703805,361.89239565226495,364.405537288739\"', '2021-10-06 07:52:10', '2021-10-06 07:52:10'),
(954, 4, 'LK08-14', '\"349.32668746989464,361.89239565226495,352.84508576095834,357.3687407066116,362.8976523068546,365.41079394332866,359.8818823430857,368.4265639070975\"', '2021-10-06 07:52:50', '2021-10-06 07:52:50'),
(956, 4, 'LK09-1', '\"356.363484052022,375.4633604892249,359.3792540157909,371.4423338708664,369.4318205616871,378.4791304529938,365.91342227062347,382.50015707135225\"', '2021-10-06 07:54:02', '2021-10-06 07:54:02'),
(957, 4, 'LK09-2', '\"353.85034241554797,379.9870154348782,355.86085572472723,374.9607321619301,365.91342227062347,381.99752874405743,362.8976523068546,387.0238120170056\"', '2021-10-06 07:54:26', '2021-10-06 07:54:26'),
(958, 4, 'LK09-3', '\"350.33194412448427,384.0080420532367,352.84508576095834,379.48438710758336,363.4002806341494,387.0238120170056,360.3845106703805,391.04483863536404\"', '2021-10-06 07:54:51', '2021-10-06 07:54:51'),
(959, 4, 'LK15-1', '\"216.70323012503235,328.2209638095052,213.18532054508051,326.11021806153406,206.50129234317205,335.9603648853992,210.72278383911424,337.3675287173799\"', '2021-10-06 07:55:12', '2021-10-06 07:55:12'),
(960, 4, 'LK09-4', '\"348.321430815305,388.53169699889,350.33194412448427,384.0080420532367,360.3845106703805,391.04483863536404,357.87136903390643,395.06586525372256\"', '2021-10-06 07:55:15', '2021-10-06 07:55:15'),
(962, 4, 'LK09-5', '\"344.8030325242413,392.0500952899537,347.8188024880102,387.5264403443004,357.87136903390643,395.5684935810174,354.8555990701376,399.0868918720811\"', '2021-10-06 07:55:43', '2021-10-06 07:55:43'),
(963, 4, 'LK09-6', '\"342.7925192150621,397.0763785629018,344.8030325242413,392.5527236172485,354.8555990701376,399.5895201993759,351.8398291063687,403.61054681773436\"', '2021-10-06 07:56:12', '2021-10-06 07:56:12'),
(964, 4, 'LK09-7', '\"345.3056608515361,368.4265639070975,348.321430815305,363.9029089614442,359.3792540157909,371.4423338708664,355.3582273974324,374.9607321619301\"', '2021-10-06 07:56:41', '2021-10-06 07:56:41'),
(965, 4, 'LK09-8', '\"343.2951475423569,373.45284718004564,345.3056608515361,368.4265639070975,355.86085572472723,375.9659888165197,352.84508576095834,379.9870154348782\"', '2021-10-06 07:57:06', '2021-10-06 07:57:06'),
(966, 4, 'LK09-9', '\"339.7767492512932,376.97124547110934,342.7925192150621,372.9502188527508,352.84508576095834,380.489643762173,349.82931579718945,384.0080420532367\"', '2021-10-06 07:57:35', '2021-10-06 07:57:35'),
(967, 4, 'LK09-10', '\"337.76623594211395,381.4949004167626,339.7767492512932,376.97124547110934,349.32668746989464,384.0080420532367,346.31091750612575,388.0290686715952\"', '2021-10-06 07:58:07', '2021-10-06 07:58:07'),
(968, 4, 'LK09-11', '\"334.75046597834506,385.0132987078263,336.7609792875243,381.4949004167626,346.81354583342056,388.0290686715952,343.79777586965173,392.0500952899537\"', '2021-10-06 07:58:28', '2021-10-06 07:58:28'),
(969, 4, 'LK09-12', '\"331.73469601457623,389.03432532618484,334.24783765105025,384.5106703805315,344.3004041969465,392.5527236172485,341.78726256047247,396.573750235607\"', '2021-10-06 07:58:52', '2021-10-06 07:58:52'),
(970, 4, 'LK10-1', '\"336.7609792875243,403.10791849043954,339.7767492512932,398.58426354478627,350.33194412448427,406.12368845420843,346.81354583342056,410.64734339986177\"', '2021-10-06 07:59:18', '2021-10-06 07:59:18'),
(971, 4, 'LK10-2', '\"334.75046597834506,408.1342017633877,336.7609792875243,403.61054681773436,347.8188024880102,410.64734339986177,344.8030325242413,415.67362667280986\"', '2021-10-06 07:59:39', '2021-10-06 07:59:39'),
(972, 4, 'LK10-3', '\"331.2320676872814,412.1552283817462,334.24783765105025,407.6315734360929,344.3004041969465,414.66837001822023,340.78200590588284,418.68939663657875\"', '2021-10-06 08:00:03', '2021-10-06 08:00:03'),
(974, 4, 'LK10-4', '\"329.22155437810216,416.6788833273995,331.73469601457623,411.6526000544514,341.28463423317766,418.18676830928393,338.7714925967036,423.2130515822321\"', '2021-10-06 08:00:29', '2021-10-06 08:00:29'),
(976, 4, 'LK10-5', '\"325.70315608703845,419.6946532911684,328.71892605080734,416.1762550001047,338.7714925967036,422.20779492764245,335.7557226329347,427.23407820059055\"', '2021-10-06 08:00:51', '2021-10-06 08:00:51'),
(977, 4, 'LK15-2', '\"212.48173862909016,324.70305422955335,208.26024713314797,322.2405175235871,201.22442797324433,333.1460372214377,205.09412851119134,335.9603648853992\"', '2021-10-06 08:01:17', '2021-10-06 08:01:17'),
(978, 4, 'LK10-6', '\"323.1900144505644,424.7209365641165,325.70315608703845,420.1972816184632,335.2530943056399,427.23407820059055,333.2425809964606,431.25510481894906\"', '2021-10-06 08:01:26', '2021-10-06 08:01:26'),
(979, 4, 'LK15-3', '\"208.96382904913835,322.9440994395774,205.09412851119134,320.83335369160636,198.05830935128768,329.9799185994811,200.87263701524915,332.09066434745216\"', '2021-10-06 08:01:41', '2021-10-06 08:01:41'),
(980, 4, 'LK10-7', '\"320.17424448679554,429.2445915097698,322.68738612326956,424.2183082368217,333.2425809964606,431.25510481894906,329.22155437810216,435.2761314373076\"', '2021-10-06 08:01:50', '2021-10-06 08:01:50'),
(981, 4, 'LK15-4', '\"204.03875563720578,320.12977177561595,200.52084605725398,316.9636531536593,193.4850268973503,327.1655909355196,197.00293647730214,329.9799185994811\"', '2021-10-06 08:02:18', '2021-10-06 08:02:18'),
(982, 4, 'LK10-8', '\"326.7084127416281,396.0711219083122,329.72418270539697,391.04483863536404,339.2741209239984,398.58426354478627,336.7609792875243,403.61054681773436\"', '2021-10-06 08:02:28', '2021-10-06 08:02:28'),
(983, 4, 'LK15-5', '\"200.52084605725398,316.26007123766897,196.2993545613118,314.50111644769305,188.55995348541776,324.70305422955335,192.78144498135995,327.1655909355196\"', '2021-10-06 08:02:45', '2021-10-06 08:02:45'),
(984, 4, 'LK10-9', '\"324.195271105154,400.0921485266707,326.20578441433327,395.06586525372256,336.7609792875243,402.60529016314473,333.74520932375543,407.12894510879806\"', '2021-10-06 08:03:06', '2021-10-06 08:03:06'),
(985, 4, 'LK15-6', '\"196.2993545613118,314.50111644769305,192.0778630653696,310.9832068677412,185.3938348634611,320.83335369160636,188.2081625274226,323.6476813555678\"', '2021-10-06 08:03:07', '2021-10-06 08:03:07'),
(986, 4, 'LK10-10', '\"321.1795011413851,404.615803472324,323.6926427778592,400.5947768539655,333.74520932375543,407.6315734360929,330.7294393599866,412.1552283817462\"', '2021-10-06 08:03:28', '2021-10-06 08:03:28'),
(987, 4, 'LK15-7', '\"191.02249019138404,311.3349978257364,187.8563715694274,310.27962495175086,183.9866710314804,312.74216165771713,179.7651795355382,317.6672350696497,183.63488007348522,321.1851446496015\"', '2021-10-06 08:03:35', '2021-10-06 08:03:35'),
(988, 4, 'LK10-11', '\"318.6663595049111,408.6368300906825,320.67687281409036,404.1131751450292,330.7294393599866,412.1552283817462,327.7136693962177,416.1762550001047\"', '2021-10-06 08:03:54', '2021-10-06 08:03:54'),
(989, 4, 'LK10-12', '\"315.1479612138474,412.657856709041,318.1637311776163,408.1342017633877,328.2162977235125,415.67362667280986,325.20052775974364,419.6946532911684\"', '2021-10-06 08:04:21', '2021-10-06 08:04:21'),
(990, 4, 'LK10-13', '\"312.6348195773733,416.6788833273995,314.6453328865526,412.657856709041,325.70315608703845,419.6946532911684,322.68738612326956,424.2183082368217\"', '2021-10-06 08:04:53', '2021-10-06 08:04:53'),
(991, 4, 'LK10-14', '\"311.1269345954889,423.7156799095269,312.6348195773733,416.6788833273995,322.68738612326956,424.2183082368217,319.67161615950073,429.7472198370646\"', '2021-10-06 08:05:15', '2021-10-06 08:05:15'),
(992, 4, 'LK15-8', '\"210.72278383911424,339.12648350735583,205.44591946918652,335.9603648853992,198.41010030928288,346.1623026672595,202.27980084722986,349.6802122472113\"', '2021-10-06 08:05:45', '2021-10-06 08:05:45'),
(993, 4, 'LK11-1', '\"335.7557226329347,343.2951475423569,339.2741209239984,337.76623594211395,349.82931579718945,345.3056608515361,345.80828917883093,350.8345724517791\"', '2021-10-06 08:06:25', '2021-10-06 08:06:25'),
(994, 4, 'LK15-9', '\"205.44591946918652,335.9603648853992,201.9280098892347,334.2014100954233,194.1886088133407,344.0515569192884,198.05830935128768,346.1623026672595\"', '2021-10-06 08:06:33', '2021-10-06 08:06:33'),
(995, 4, 'LK11-2', '\"333.74520932375543,347.8188024880102,335.7557226329347,343.2951475423569,345.80828917883093,350.8345724517791,343.2951475423569,354.3529707428428\"', '2021-10-06 08:06:47', '2021-10-06 08:06:47'),
(996, 4, 'LK11-3', '\"330.2268110326918,351.8398291063687,332.7399526691658,347.3161741607154,342.7925192150621,354.3529707428428,339.7767492512932,358.37399736120125\"', '2021-10-06 08:07:08', '2021-10-06 08:07:08'),
(997, 4, 'LK11-4', '\"327.7136693962177,355.86085572472723,329.72418270539697,351.3372007790739,340.279377578588,358.37399736120125,336.7609792875243,362.8976523068546\"', '2021-10-06 08:07:41', '2021-10-06 08:07:41'),
(998, 4, 'LK11-5', '\"325.20052775974364,360.8871389976753,327.7136693962177,356.363484052022,337.76623594211395,363.9029089614442,334.75046597834506,367.4213072525079\"', '2021-10-06 08:08:06', '2021-10-06 08:08:06'),
(999, 4, 'LK11-6', '\"321.68212946867993,364.405537288739,324.195271105154,360.3845106703805,334.24783765105025,367.4213072525079,331.2320676872814,371.4423338708664\"', '2021-10-06 08:08:33', '2021-10-06 08:08:33'),
(1000, 4, 'LK15-10', '\"201.9280098892347,333.1460372214377,198.05830935128768,331.738873389457,191.02249019138404,340.88543829733175,193.8368178553455,343.6997659612932\"', '2021-10-06 08:08:47', '2021-10-06 08:08:47'),
(1001, 4, 'LK11-7', '\"319.1689878322059,368.4265639070975,321.1795011413851,363.9029089614442,331.73469601457623,371.4423338708664,328.71892605080734,376.4686171438145\"', '2021-10-06 08:08:52', '2021-10-06 08:08:52'),
(1002, 4, 'LK11-8', '\"316.153217868437,372.9502188527508,319.1689878322059,368.4265639070975,328.71892605080734,375.4633604892249,325.70315608703845,379.48438710758336\"', '2021-10-06 08:09:14', '2021-10-06 08:09:14'),
(1004, 4, 'LK11-9', '\"313.64007623196295,377.47387379840416,316.153217868437,372.9502188527508,326.20578441433327,379.48438710758336,323.6926427778592,384.0080420532367\"', '2021-10-06 08:10:09', '2021-10-06 08:10:09');
INSERT INTO `map_config` (`id`, `project_id`, `name`, `zone`, `created_at`, `updated_at`) VALUES
(1005, 4, 'LK15-11', '\"197.7065183932925,329.6281276414859,193.8368178553455,328.92454572549553,186.80099869544185,338.07111063337027,189.26353540140812,340.1818563813414\"', '2021-10-06 08:10:24', '2021-10-06 08:10:24'),
(1006, 4, 'LK11-10', '\"325.70315608703845,336.7609792875243,331.2320676872814,332.23732434187104,339.7767492512932,337.76623594211395,335.7557226329347,343.79777586965173\"', '2021-10-06 08:10:39', '2021-10-06 08:10:39'),
(1007, 4, 'LK15-12', '\"192.42965402336478,327.5173818935148,189.6153263594033,326.46200901952926,181.52413432551413,335.608573927404,185.3938348634611,337.3675287173799\"', '2021-10-06 08:10:53', '2021-10-06 08:10:53'),
(1008, 4, 'LK11-11', '\"322.68738612326956,340.78200590588284,325.70315608703845,336.7609792875243,335.2530943056399,343.2951475423569,332.7399526691658,347.8188024880102\"', '2021-10-06 08:11:03', '2021-10-06 08:11:03'),
(1011, 4, 'LK11-12', '\"320.17424448679554,345.3056608515361,322.68738612326956,340.78200590588284,332.7399526691658,347.8188024880102,329.72418270539697,352.3424574336635\"', '2021-10-06 08:11:59', '2021-10-06 08:11:59'),
(1012, 4, 'LK11-13', '\"316.65584619573184,348.8240591425998,320.17424448679554,344.8030325242413,329.22155437810216,351.8398291063687,327.7136693962177,356.363484052022\"', '2021-10-06 08:12:27', '2021-10-06 08:12:27'),
(1014, 4, 'LK11-14', '\"314.6453328865526,353.34771408825316,316.153217868437,348.8240591425998,326.7084127416281,356.363484052022,324.195271105154,360.3845106703805\"', '2021-10-06 08:12:55', '2021-10-06 08:12:55'),
(1015, 4, 'LK11-15', '\"311.1269345954889,357.87136903390643,314.14270455925777,353.34771408825316,324.195271105154,360.8871389976753,320.67687281409036,363.9029089614442\"', '2021-10-06 08:13:26', '2021-10-06 08:13:26'),
(1016, 4, 'LK15-13', '\"188.55995348541776,323.6476813555678,185.04204390546593,322.2405175235871,178.0062247455623,332.09066434745216,180.82055240952374,334.2014100954233\"', '2021-10-06 08:13:44', '2021-10-06 08:13:44'),
(1017, 4, 'LK11-16', '\"308.61379295901486,362.39502397955977,311.1269345954889,357.3687407066116,321.1795011413851,364.405537288739,318.6663595049111,368.9291922343923\"', '2021-10-06 08:13:53', '2021-10-06 08:13:53'),
(1018, 4, 'LK15-14', '\"183.63488007348522,321.5369356075967,179.41338857754303,319.07439890163045,172.72936037563454,328.5727547675003,176.59906091358155,331.738873389457\"', '2021-10-06 08:14:14', '2021-10-06 08:14:14'),
(1019, 4, 'LK11-17', '\"305.59802299524597,365.91342227062347,308.11116463172004,361.38976732497014,318.6663595049111,368.4265639070975,315.6505895411422,372.9502188527508\"', '2021-10-06 08:14:14', '2021-10-06 08:14:14'),
(1020, 4, 'LK11-18', '\"303.0848813587719,369.93444888898193,305.59802299524597,365.91342227062347,315.6505895411422,372.9502188527508,313.64007623196295,378.4791304529938\"', '2021-10-06 08:14:45', '2021-10-06 08:14:45'),
(1021, 4, 'LK12-1', '\"309.1164212863097,384.0080420532367,312.6348195773733,378.9817587802886,321.1795011413851,386.52118368971077,318.6663595049111,391.04483863536404\"', '2021-10-06 08:15:16', '2021-10-06 08:15:16'),
(1022, 4, 'LK12-2', '\"305.59802299524597,388.0290686715952,308.61379295901486,383.00278539864706,319.1689878322059,391.54746696265886,316.153217868437,394.56323692642775\"', '2021-10-06 08:15:38', '2021-10-06 08:15:38'),
(1023, 4, 'LK12-3', '\"303.5875096860667,392.5527236172485,305.59802299524597,388.0290686715952,316.153217868437,395.5684935810174,313.64007623196295,399.0868918720811\"', '2021-10-06 08:15:57', '2021-10-06 08:15:57'),
(1024, 4, 'LK12-4', '\"300.069111395003,396.573750235607,303.0848813587719,392.0500952899537,313.13744790466814,399.5895201993759,310.62430626819406,403.61054681773436\"', '2021-10-06 08:16:23', '2021-10-06 08:16:23'),
(1026, 4, 'LK12-5', '\"298.05859808582375,400.5947768539655,301.07436804959264,397.0763785629018,310.62430626819406,404.1131751450292,306.6032796498356,408.1342017633877\"', '2021-10-06 08:17:42', '2021-10-06 08:17:42'),
(1027, 4, 'LK12-6', '\"295.0428281220549,404.615803472324,298.05859808582375,400.0921485266707,306.6032796498356,407.6315734360929,304.59276634065634,411.6526000544514\"', '2021-10-06 08:18:08', '2021-10-06 08:18:08'),
(1028, 4, 'LK12-7', '\"290.5191731764016,409.64208674527214,294.0375714674653,404.615803472324,304.59276634065634,412.1552283817462,299.0638547404134,416.1762550001047\"', '2021-10-06 08:18:39', '2021-10-06 08:18:39'),
(1029, 4, 'LK12-8', '\"298.56122641311856,376.97124547110934,301.07436804959264,372.447590525456,311.1269345954889,378.9817587802886,308.61379295901486,383.5054137259419\"', '2021-10-06 08:19:06', '2021-10-06 08:19:06'),
(1030, 4, 'LK12-9', '\"295.0428281220549,380.9922720894678,298.56122641311856,376.4686171438145,308.11116463172004,383.5054137259419,305.09539466795115,388.0290686715952\"', '2021-10-06 08:19:27', '2021-10-06 08:19:27'),
(1031, 4, 'LK12-10', '\"293.03231481287565,385.51592703512114,295.54545644934973,380.9922720894678,305.09539466795115,388.0290686715952,301.57699637688745,392.0500952899537\"', '2021-10-06 08:19:49', '2021-10-06 08:19:49'),
(1032, 4, 'LK12-11', '\"289.51391652181195,388.53169699889,292.52968648558084,384.5106703805315,303.0848813587719,392.0500952899537,299.5664830677082,396.573750235607\"', '2021-10-06 08:20:18', '2021-10-06 08:20:18'),
(1033, 4, 'LK12-12', '\"287.5034032126327,393.5579802718381,289.51391652181195,389.03432532618484,299.5664830677082,397.0763785629018,296.55071310393936,400.5947768539655\"', '2021-10-06 08:20:46', '2021-10-06 08:20:46'),
(1034, 4, 'LK12-13', '\"283.98500492156904,398.08163521749145,286.49814655804306,393.0553519445433,297.555969758529,401.09740518126034,293.53494314017047,404.1131751450292\"', '2021-10-06 08:21:08', '2021-10-06 08:21:08'),
(1035, 4, 'LK12-14', '\"283.4823765942742,404.615803472324,283.4823765942742,397.0763785629018,294.5401997947601,404.615803472324,290.5191731764016,410.64734339986177\"', '2021-10-06 08:21:30', '2021-10-06 08:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `type`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
(1619422863, 'user', 17, 28, 'tiền khớp hết rồi ạ', NULL, 1, '2021-03-30 11:14:06', '2021-03-30 11:14:07'),
(1620403796, 'user', 17, 26, 'l&ocirc; tự mở m&agrave;', NULL, 1, '2021-04-29 11:20:32', '2021-04-29 11:20:33'),
(1621769809, 'user', 26, 26, '', 'a99dba32-bd0b-40fd-b0d0-4e442dc3d2bf.doc,91_2015_QH13_296215.doc', 1, '2021-04-16 17:15:49', '2021-04-16 17:15:50'),
(1623481902, 'user', 17, 17, 'oke', NULL, 1, '2021-03-24 11:46:42', '2021-03-24 11:46:42'),
(1628941891, 'user', 26, 17, '7h', NULL, 1, '2021-03-25 20:27:30', '2021-03-25 20:27:55'),
(1635528842, 'user', 26, 17, '=)))', NULL, 1, '2021-04-29 11:25:12', '2021-04-29 11:25:13'),
(1637412351, 'user', 17, 28, 'tối con up phần đấy ạ', NULL, 1, '2021-04-20 15:53:50', '2021-04-20 17:55:41'),
(1642433122, 'user', 26, 17, 'test 123', NULL, 1, '2021-06-06 20:56:44', '2021-06-07 17:43:28'),
(1648768447, 'user', 17, 26, '', '44c7ae99-913f-4dd1-a5a0-4a4c3abccdd5.jpg,IMG_20210326_002920_556.jpg', 1, '2021-03-26 15:53:42', '2021-03-26 15:53:43'),
(1652044757, 'user', 26, 28, 'ch&uacute; cường n&agrave;o đấy ạ', NULL, 1, '2021-04-26 11:02:43', '2021-04-27 13:06:53'),
(1654153091, 'user', 17, 26, 'Hello', NULL, 1, '2021-03-26 15:42:56', '2021-03-26 15:42:57'),
(1657075766, 'user', 17, 26, 'cần th&igrave; l&agrave;m', NULL, 1, '2021-04-29 11:21:04', '2021-04-29 11:21:05'),
(1657710151, 'user', 17, 26, '??', NULL, 1, '2021-04-27 17:45:26', '2021-04-28 14:56:18'),
(1664716126, 'user', 17, 26, 'Ph&ograve;ng ph&aacute;t triển l&agrave; ch&uacute; Hưng', NULL, 1, '2021-03-28 13:34:20', '2021-03-28 13:34:41'),
(1669833884, 'user', 17, 28, 'dạ rồi ạ', NULL, 1, '2021-05-06 11:51:57', '2021-05-06 12:17:50'),
(1670836623, 'user', 26, 17, '', 'cb89d46b-ddbb-4453-b9c1-e834b53f91f5.png,5.png', 1, '2021-03-26 15:53:55', '2021-03-26 15:53:55'),
(1673219165, 'user', 26, 17, 'để bảo mng nh&eacute;t văn bản biểu mẫu l&ecirc;n', NULL, 1, '2021-04-29 11:23:49', '2021-04-29 11:23:49'),
(1673583994, 'user', 26, 26, '', '59df6d68-cf7b-4906-a529-e5dc746d94be.docx,Mục lục Văn bản hợp nhất 17.docx', 1, '2021-04-16 17:16:12', '2021-04-16 17:16:13'),
(1673612558, 'user', 26, 17, 't ko biết mở kh&oacute;a l&ocirc;', NULL, 1, '2021-04-29 11:20:13', '2021-04-29 11:20:26'),
(1679627289, 'user', 26, 17, ';\'v', NULL, 1, '2021-03-28 13:34:50', '2021-03-28 13:34:52'),
(1680258863, 'user', 17, 28, 'dạ v&acirc;ng ạ', NULL, 1, '2021-03-30 11:13:37', '2021-03-30 11:13:38'),
(1680450861, 'user', 17, 26, '', 'e9390877-8880-479f-86cb-5264ba0046a3.pdf,FORM ĐƠN XIN MUA ĐẤT.pdf', 1, '2021-03-26 10:13:25', '2021-03-26 11:56:25'),
(1681770667, 'user', 26, 17, '', 'fcf78022-9da7-402b-8008-93c02353fe79.gif,pussinboots.gif', 1, '2021-06-06 20:57:08', '2021-06-07 17:43:28'),
(1688197598, 'user', 26, 17, 'bh lu&ocirc;n', NULL, 1, '2021-04-29 11:24:11', '2021-04-29 11:24:11'),
(1691540312, 'user', 26, 17, '????', NULL, 1, '2021-04-01 08:51:20', '2021-04-01 08:51:21'),
(1693712279, 'user', 26, 17, 'hello', NULL, 1, '2021-03-24 09:39:05', '2021-03-24 09:39:50'),
(1695081335, 'user', 17, 26, 'v&igrave; k cần', NULL, 1, '2021-04-29 11:21:01', '2021-04-29 11:21:02'),
(1696892467, 'user', 26, 17, '', 'a94b2900-26e7-418f-b60b-5796cde4c4e1.png,1920px-Generation_timeline.png', 1, '2021-03-26 15:43:17', '2021-03-26 15:43:17'),
(1705865837, 'user', 17, 26, 'khong sao dau', NULL, 1, '2021-03-25 20:21:07', '2021-03-25 20:21:08'),
(1707602610, 'user', 26, 17, 'hello', NULL, 1, '2021-03-26 15:43:00', '2021-03-26 15:43:01'),
(1709807477, 'user', 17, 26, 'H&ecirc;lo', NULL, 1, '2021-03-26 16:13:58', '2021-03-26 16:13:58'),
(1713047156, 'user', 17, 26, '', 'ee8428dd-de40-4682-92da-9e72802c5def.jpg,IMG_20210326_002924_353.jpg', 1, '2021-03-26 15:14:28', '2021-03-26 15:24:18'),
(1727171004, 'user', 26, 26, '', 'fd2e8df1-be03-48d6-90be-7371fa6538be.pdf,54_2010_QH12_108083.pdf', 1, '2021-04-16 17:17:49', '2021-04-16 17:17:50'),
(1727946466, 'user', 17, 28, 'v&acirc;ng ạ', NULL, 1, '2021-04-15 16:30:27', '2021-04-16 14:53:50'),
(1733473703, 'user', 17, 26, 'Tối sửa lại', NULL, 1, '2021-03-28 08:27:40', '2021-03-28 08:34:54'),
(1735007181, 'user', 26, 17, 'gửi lại anh nh&eacute;', NULL, 1, '2021-03-26 15:43:08', '2021-03-26 15:43:08'),
(1745866148, 'user', 28, 17, 'Ch&uacute; Ki&ecirc;n CT TTVN con ạ', NULL, 1, '2021-03-30 11:13:18', '2021-03-30 11:13:31'),
(1754010273, 'user', 17, 26, 'th&igrave; t&ocirc;i cấp quyền cho mọi người v&agrave;o kho văn bản l&agrave; đc m&agrave;', NULL, 1, '2021-04-29 11:25:21', '2021-04-29 11:25:26'),
(1758219031, 'user', 17, 26, '', 'df62fffe-ee68-48d1-9f21-24860bb5e320.jpg,IMG_20210326_002924_353.jpg', 1, '2021-03-26 16:14:35', '2021-03-26 16:14:36'),
(1777220067, 'user', 26, 17, 'Alo', NULL, 1, '2021-05-05 22:04:42', '2021-05-05 22:06:24'),
(1783307038, 'user', 17, 2, '', '86dcf8b4-399b-490b-b8d6-94f32c80e5b5.jpg,image.jpg', 0, '2021-05-13 14:03:37', '2021-05-13 14:03:37'),
(1791117532, 'user', 17, 26, 'Oke', NULL, 1, '2021-03-28 12:21:22', '2021-03-28 12:24:31'),
(1796838204, 'user', 17, 26, 'Ava ny cc &agrave;', NULL, 1, '2021-03-28 12:21:38', '2021-03-28 12:24:31'),
(1800170798, 'user', 17, 26, 'l&agrave; ntn', NULL, 1, '2021-04-29 11:20:29', '2021-04-29 11:20:30'),
(1801398288, 'user', 17, 26, 'sắp sửa xong rồi', NULL, 1, '2021-04-01 08:43:10', '2021-04-01 08:43:10'),
(1803105777, 'user', 26, 17, 'đẩy l&ecirc;n đi', NULL, 1, '2021-04-29 11:23:51', '2021-04-29 11:23:52'),
(1807785298, 'user', 28, 26, '', 'd949fa18-9f82-49ed-b8c8-7e0adb9ddd81.jpg,image.jpg', 1, '2021-04-27 19:18:00', '2021-04-28 14:56:08'),
(1809081932, 'user', 28, 26, 'Ch&uacute; cường', NULL, 1, '2021-04-26 08:45:22', '2021-04-26 11:02:20'),
(1810234004, 'user', 17, 28, 'Con ch&agrave;o b&aacute;c', NULL, 1, '2021-03-28 17:11:59', '2021-03-28 17:12:17'),
(1811935829, 'user', 26, 17, '&agrave;', NULL, 1, '2021-04-01 08:47:39', '2021-04-01 08:47:39'),
(1812012003, 'user', 17, 26, '=)))', NULL, 1, '2021-04-29 11:49:23', '2021-04-29 11:49:23'),
(1816859221, 'user', 17, 26, 'Đang tr&ecirc;n xe', NULL, 1, '2021-03-28 08:27:34', '2021-03-28 08:34:54'),
(1819367224, 'user', 17, 26, 'n&oacute; k tự convert đc', NULL, 1, '2021-04-29 11:17:59', '2021-04-29 11:20:00'),
(1820618390, 'user', 26, 28, 'đ&atilde; điều chỉnh khớp xong rồi ạ, bố v&agrave;o kiểm tra lại đi ạ', NULL, 1, '2021-03-30 10:10:29', '2021-03-30 16:09:04'),
(1822740756, 'user', 26, 17, 'idiot', NULL, 1, '2021-04-01 08:45:36', '2021-04-01 08:46:09'),
(1826839523, 'user', 28, 17, 'Ch&agrave;o con', NULL, 1, '2021-03-28 17:11:21', '2021-03-28 17:11:50'),
(1828973942, 'user', 26, 17, '=)))', NULL, 1, '2021-04-29 11:48:10', '2021-04-29 11:48:33'),
(1831788471, 'user', 26, 17, 'test t&igrave;nh năng th&ocirc;ng b&aacute;o tin nhắn', NULL, 1, '2021-03-26 15:53:23', '2021-03-26 15:53:24'),
(1834884263, 'user', 26, 17, ':v', NULL, 1, '2021-04-01 08:47:11', '2021-04-01 08:47:12'),
(1840896554, 'user', 28, 26, 'Con up cả Ho&agrave; B&igrave;nh v&agrave; giai đoạn 2 l&ecirc;n nh&eacute;!', NULL, 1, '2021-03-30 08:54:44', '2021-03-30 09:07:47'),
(1843915233, 'user', 26, 17, 'thử k&egrave;m ảnh', NULL, 1, '2021-04-01 08:36:47', '2021-04-01 08:36:48'),
(1846269732, 'user', 28, 17, 'B&aacute;c thử chụp ch&uacute; Di&ecirc;n con ạ', NULL, 1, '2021-04-27 13:06:35', '2021-04-27 13:07:25'),
(1850895030, 'user', 17, 28, 'con đang sừa phần b&aacute;n h&agrave;ng', NULL, 1, '2021-04-20 15:53:45', '2021-04-20 17:55:41'),
(1855284907, 'user', 26, 17, 'okie', NULL, 1, '2021-03-28 08:34:59', '2021-03-28 12:21:19'),
(1856539321, 'user', 17, 26, 'yo', NULL, 1, '2021-03-25 20:20:48', '2021-03-25 20:20:48'),
(1857635260, 'user', 26, 17, '', 'e3061238-2e8b-42e9-8aaa-5dc42c59cc45.xlsx,TIẾN ĐỘ DỰ ÁN HÒA BÌNH- XUÂN AN GĐ2.xlsx', 1, '2021-03-25 20:21:17', '2021-03-25 20:21:17'),
(1871989250, 'user', 26, 17, 'rứa ơi', NULL, 1, '2021-04-29 11:20:08', '2021-04-29 11:20:26'),
(1873612421, 'user', 26, 28, 'Bản đồ chưa đc đẹp lắm đang muốn li&ecirc;n hệ với b&ecirc;n ch&uacute; qu&acirc;n xin 1 bản đồ đẹp hơn ạ', NULL, 1, '2021-04-15 16:58:45', '2021-04-16 14:54:08'),
(1877169546, 'user', 17, 2, 'test', NULL, 0, '2021-11-27 00:50:54', '2021-11-27 00:50:54'),
(1877372967, 'user', 28, 26, 'C&oacute; lương chưa con?', NULL, 1, '2021-05-06 11:51:04', '2021-05-06 12:30:18'),
(1878941480, 'user', 17, 17, 'Hi', NULL, 1, '2021-03-24 11:47:49', '2021-03-24 11:47:50'),
(1895446250, 'user', 17, 26, 'hello', NULL, 1, '2021-03-24 09:39:54', '2021-03-24 09:39:54'),
(1900837424, 'user', 17, 26, 'Ọe', NULL, 1, '2021-03-26 15:53:32', '2021-03-26 15:53:33'),
(1912801124, 'user', 17, 26, 'c&oacute; rồi', NULL, 1, '2021-04-29 11:23:45', '2021-04-29 11:23:46'),
(1913690011, 'user', 26, 17, ';\'v t đang c&oacute; c&aacute;i task việc ph&ograve;ng truyền th&ocirc;ng, với ch&uacute; trọng c&oacute; nhieu&egrave; vb tr&igrave;nh', NULL, 1, '2021-04-29 11:24:33', '2021-04-29 11:24:33'),
(1915951582, 'user', 17, 26, 'qquyền chụp của ophone', NULL, 1, '2021-04-01 09:06:16', '2021-04-01 17:07:29'),
(1920250490, 'user', 17, 26, 'sao the', NULL, 1, '2021-03-25 20:21:01', '2021-03-25 20:21:02'),
(1920817135, 'user', 26, 17, 'đ&acirc;y m&agrave; c&oacute; n&uacute;t meme tao sẽ thả meme con cac', NULL, 1, '2021-04-01 08:51:43', '2021-04-01 08:51:43'),
(1923001125, 'user', 26, 17, '', 'da15be7c-f239-4850-9f94-a2bbf49ac0b4.png,5DDFE0EB-FED2-4EF6-951E-3A3B90305A53.png', 1, '2021-04-29 11:33:01', '2021-04-29 11:33:01'),
(1925428921, 'user', 17, 26, 'bạn cũng c&oacute; quyền mở m&agrave;', NULL, 1, '2021-04-29 11:22:18', '2021-04-29 11:22:34'),
(1930137520, 'user', 17, 26, 'discord', NULL, 1, '2021-04-29 11:25:51', '2021-04-29 11:25:52'),
(1948705421, 'user', 26, 17, '312312', NULL, 1, '2021-03-25 20:21:03', '2021-03-25 20:21:04'),
(1960600917, 'user', 17, 26, '=))', NULL, 1, '2021-04-29 11:48:40', '2021-04-29 11:49:01'),
(1961755923, 'user', 28, 17, 'Con nhận lương chưa?', NULL, 1, '2021-05-06 11:50:13', '2021-05-06 11:51:47'),
(1968784609, 'user', 17, 28, 'con nhận từ h&ocirc;m qua rồi ạ', NULL, 1, '2021-05-06 11:52:05', '2021-05-06 12:17:50'),
(1977294889, 'user', 26, 17, '', '04b751d6-c694-40e5-90b7-b05a686c8eb2.jpeg,069EB951-AC7F-4A74-9D47-7FBC447A28AD.jpeg', 1, '2021-03-24 15:03:30', '2021-03-25 12:35:46'),
(1979499120, 'user', 26, 26, '', '7da4fc39-2e04-47f7-a343-75c1218b13c9.doc,59_2020_QH14_427301.doc', 1, '2021-04-16 17:16:35', '2021-04-16 17:16:35'),
(1989591535, 'user', 17, 26, 'Test emoji', NULL, 1, '2021-04-27 17:45:33', '2021-04-28 14:56:18'),
(2000844236, 'user', 26, 17, '', '1a1e0045-efbe-4ac6-9c9f-54ae67985409.png,7719B449-3C75-4677-BEB1-016C706D2DA0.png', 1, '2021-05-05 22:05:21', '2021-05-05 22:06:24'),
(2001346615, 'user', 26, 17, 'ok', NULL, 1, '2021-03-27 22:34:39', '2021-03-28 08:27:14'),
(2008521149, 'user', 26, 17, 'M&igrave;nh l&agrave; ph&ograve;ng ph&aacute;t triển dự &aacute;n nhể. T&ocirc;i tạo job cho &ocirc; rồi đấy =))))', NULL, 1, '2021-03-28 13:32:59', '2021-03-28 13:33:27'),
(2015305784, 'user', 28, 17, '', '86dcf8b4-399b-490b-b8d6-94f32c80e5b5.jpg,image.jpg', 1, '2021-05-06 11:07:16', '2021-05-06 11:08:49'),
(2021858996, 'user', 26, 17, '&yacute; chị Linh ko chụp m&agrave;n h&igrave;nh được l&agrave; sao', NULL, 1, '2021-04-01 08:47:09', '2021-04-01 08:47:10'),
(2033564672, 'user', 28, 17, '', 'd70d361c-f257-4aeb-96b2-d2b8c5437806.jpg,image.jpg', 1, '2021-03-30 10:30:21', '2021-03-30 10:31:49'),
(2034112277, 'user', 26, 17, 'đang l&agrave;m c&aacute;i web &agrave;\\', NULL, 1, '2021-04-29 11:21:26', '2021-04-29 11:21:26'),
(2034407401, 'user', 26, 17, '1', NULL, 1, '2021-03-25 20:20:58', '2021-03-25 20:20:59'),
(2039036414, 'user', 26, 17, '??? cấp quyền chụp', NULL, 1, '2021-04-01 08:51:03', '2021-04-01 08:51:04'),
(2046779934, 'user', 17, 26, 'đợi hết thời gian ?', NULL, 1, '2021-04-29 11:20:38', '2021-04-29 11:20:38'),
(2050293271, 'user', 17, 28, 'con nhận tin nhắn ạ', NULL, 1, '2021-04-27 11:40:42', '2021-04-27 13:05:58'),
(2053746865, 'user', 26, 17, '', '4a39934d-510b-4cfd-94d1-0fb05e95ce2b.png,26969052-2EE1-408B-948E-8EC3A53A92B7.png', 1, '2021-05-05 22:06:13', '2021-05-05 22:06:24'),
(2057668179, 'user', 17, 26, 'c&ograve;n admin th&igrave; bạn c&oacute; quyền mở v&agrave; kh&oacute;a ấy', NULL, 1, '2021-04-29 11:20:50', '2021-04-29 11:20:51'),
(2063811484, 'user', 26, 26, 'https://www.cambridge.org/core/journals/world-trade-review/article/us-antidumping-measures-on-certain-shrimp-from-viet-nam-a-stirfry-of-seafood-statistics-and-lacunae/2609ECD845582A61394BD0DB0FE9B5B8', NULL, 1, '2021-05-12 20:14:20', '2021-05-12 20:14:21'),
(2067882849, 'user', 17, 26, 'nhưng d&ugrave;ng đc tr&ecirc;n điện thoại', NULL, 1, '2021-04-29 11:18:05', '2021-04-29 11:20:00'),
(2068574060, 'user', 17, 26, 'ukm', NULL, 1, '2021-04-29 11:22:00', '2021-04-29 11:22:34'),
(2071479229, 'user', 26, 17, 'yep', NULL, 1, '2021-04-29 11:25:30', '2021-04-29 11:25:31'),
(2074051445, 'user', 26, 17, 'Cơ m&agrave; sao sang đ&acirc;y lại bị ngang', NULL, 1, '2021-05-05 22:05:35', '2021-05-05 22:06:24'),
(2083998838, 'user', 26, 17, 'chỉ ở VP để nhận hoặc l&agrave;m g&igrave; đ&oacute; t cũng hơm b&iacute;t', NULL, 1, '2021-04-29 11:25:11', '2021-04-29 11:25:12'),
(2084837028, 'user', 26, 17, 'chi Hoa nhiều l&uacute;c ko phải ng gửi đ&acirc;u', NULL, 1, '2021-04-29 11:24:56', '2021-04-29 11:24:57'),
(2088207319, 'user', 26, 17, 'dược kh&ocirc;ng', NULL, 1, '2021-03-25 20:27:35', '2021-03-25 20:27:55'),
(2106750896, 'user', 26, 17, 'ok để sửa', NULL, 1, '2021-03-28 13:34:56', '2021-03-28 13:34:56'),
(2107093392, 'user', 17, 26, 'oke', NULL, 1, '2021-04-29 11:21:14', '2021-04-29 11:21:16'),
(2111815702, 'user', 17, 26, 'Nbuwng ch&uacute; k d&ugrave;ng hệ thống bh đ&acirc;u', NULL, 1, '2021-03-28 13:34:30', '2021-03-28 13:34:41'),
(2112650480, 'user', 26, 26, 'http://www.lawandmethod.nl/tijdschrift/lawandmethod/2015/12/RENM-D-14-00001', NULL, 1, '2021-05-14 23:09:48', '2021-05-14 23:09:49'),
(2119172214, 'user', 17, 26, 'oke bạn', NULL, 1, '2021-04-29 11:23:23', '2021-04-29 11:23:32'),
(2147075906, 'user', 17, 26, 'chưa cấp quyền thoi', NULL, 1, '2021-04-01 08:48:40', '2021-04-01 08:50:52'),
(2150302363, 'user', 17, 26, ':v', NULL, 1, '2021-03-28 12:21:43', '2021-03-28 12:24:31'),
(2152556003, 'user', 17, 26, 'oke de xem', NULL, 1, '2021-05-05 22:06:58', '2021-05-06 09:48:46'),
(2154693845, 'user', 28, 17, '', '36e54de1-a850-4809-9997-9e0f10e880fc.jpg,image.jpg', 1, '2021-03-30 08:50:33', '2021-03-30 08:53:25'),
(2155777007, 'user', 17, 26, 'nhanh len', NULL, 1, '2021-03-25 20:21:09', '2021-03-25 20:21:10'),
(2163047347, 'user', 17, 26, 'oke', NULL, 1, '2021-04-29 11:24:43', '2021-04-29 11:24:43'),
(2168703670, 'user', 17, 26, 'Hello', NULL, 1, '2021-03-26 15:53:04', '2021-03-26 15:53:04'),
(2173073971, 'user', 26, 17, 'nhận được', NULL, 1, '2021-03-27 22:34:45', '2021-03-28 08:27:14'),
(2173392758, 'user', 26, 17, ';\'v bh th&ecirc;m v&agrave;o nh&eacute;', NULL, 1, '2021-04-29 11:21:07', '2021-04-29 11:21:08'),
(2176327726, 'user', 26, 17, 'sau để thằng n&agrave;o kh&oacute;a c&oacute; quyền tự mở l&ocirc; n&oacute; kh&oacute;a nh&eacute;', NULL, 1, '2021-04-29 11:23:11', '2021-04-29 11:23:11'),
(2181073601, 'user', 17, 26, 'K bạn ơi', NULL, 1, '2021-03-28 13:34:04', '2021-03-28 13:34:41'),
(2181267326, 'user', 26, 17, 'c&aacute;i g&igrave; c&oacute; n&eacute;m l&ecirc;n', NULL, 1, '2021-04-29 11:24:48', '2021-04-29 11:24:48'),
(2182648317, 'user', 26, 17, '', 'a03f0f71-11cd-4a80-b69a-5c285be7085e.pdf,FORM ĐƠN XIN MUA ĐẤT.pdf', 1, '2021-03-26 16:14:48', '2021-03-26 16:14:49'),
(2183826748, 'user', 26, 17, 'nhưng ko đ&aacute;i', NULL, 1, '2021-04-29 11:49:09', '2021-04-29 11:49:10'),
(2190584085, 'user', 28, 26, 'Bố ngồi với ch&uacute; Ho&agrave; con ạ', NULL, 1, '2021-04-27 19:18:17', '2021-04-28 14:56:08'),
(2192216363, 'user', 17, 26, 'ukm, &ocirc;ng bảo chị Hoa đi', NULL, 1, '2021-04-29 11:24:29', '2021-04-29 11:24:29'),
(2193989912, 'user', 26, 26, '', 'a6b94df4-493e-4d6c-974e-c2ee591a834b.doc,92_2015_QH13_296861.doc', 1, '2021-04-16 17:17:17', '2021-04-16 17:17:17'),
(2194998328, 'user', 26, 17, 'helol\\', NULL, 1, '2021-03-26 16:14:06', '2021-03-26 16:14:07'),
(2199372424, 'user', 17, 26, 'mở kh&oacute;a từng khu lu&ocirc;n', NULL, 1, '2021-04-29 11:20:58', '2021-04-29 11:20:58'),
(2210580057, 'user', 26, 17, 'd&ugrave;ng zalo', NULL, 1, '2021-04-01 08:45:26', '2021-04-01 08:46:09'),
(2211092422, 'user', 26, 26, '', 'a1460d98-bd0e-435c-9ce8-807a0ace10d6.docx,MỤC LỤC BỘ LUẬT DÂN SỰ 2015.docx', 1, '2021-04-16 17:16:24', '2021-04-16 17:16:24'),
(2216070026, 'user', 26, 17, '', 'dc41b699-6e7d-4fca-b47d-3eec828ef2fc.jpeg,705B5320-A1F1-43B4-B3B8-27A00B597735.jpeg', 1, '2021-03-24 09:40:34', '2021-03-24 09:40:35'),
(2223762864, 'user', 26, 17, 'hello', NULL, 1, '2021-03-26 15:52:59', '2021-03-26 15:53:00'),
(2225097979, 'user', 26, 17, 'tin nhắn guiwt th&agrave;nh c&ocirc;ng', NULL, 1, '2021-03-26 16:14:14', '2021-03-26 16:14:14'),
(2232231874, 'user', 26, 17, 'Avatar mới đc k', NULL, 1, '2021-05-05 22:05:03', '2021-05-05 22:06:24'),
(2233954728, 'user', 17, 26, '?', NULL, 1, '2021-04-01 08:36:33', '2021-04-01 08:36:40'),
(2235298215, 'user', 17, 28, 'b&aacute;c v&agrave;o xem gi&uacute;p con ạ', NULL, 1, '2021-04-20 16:35:09', '2021-04-20 17:55:41'),
(2257900025, 'user', 26, 17, 'chỉnh form mẫu đi nh&eacute;, với xem lại c&ocirc;ng thức tại sao gi&aacute; 2 hđ lại kh&aacute;c nhau', NULL, 1, '2021-03-28 08:26:22', '2021-03-28 08:27:14'),
(2266886455, 'user', 17, 26, 'yeu ban', NULL, 1, '2021-03-24 09:40:02', '2021-03-24 09:40:03'),
(2268425542, 'user', 26, 17, 'Alo thằng loz n&oacute;i g&igrave; đi', NULL, 1, '2021-03-24 20:04:40', '2021-03-25 12:35:46'),
(2268504491, 'user', 26, 17, '', '279f514c-6a0a-42e7-9675-2acaec4f7bb1.png,36CCEE01-0EB8-41EC-9518-67A078B9E4B2.png', 1, '2021-05-05 22:04:55', '2021-05-05 22:06:24'),
(2269752126, 'user', 26, 17, ';v up l&ecirc;n d&acirc;u', NULL, 1, '2021-04-29 11:25:45', '2021-04-29 11:25:45'),
(2274950251, 'user', 26, 17, 'Alo', NULL, 1, '2021-03-25 20:24:17', '2021-03-25 20:25:06'),
(2277574836, 'user', 17, 28, 'con cập nhật lại đ&uacute;ng bản đồ của m&igrave;nh rồi', NULL, 1, '2021-03-30 11:13:58', '2021-03-30 11:14:07'),
(2278819925, 'user', 28, 26, 'Ok con', NULL, 1, '2021-03-30 16:09:30', '2021-03-30 19:47:59'),
(2283305051, 'user', 26, 17, 'đợt n&agrave;y c&oacute; nhiều đầu vb', NULL, 1, '2021-04-29 11:24:00', '2021-04-29 11:24:01'),
(2290893291, 'user', 26, 17, 'xem c&oacute; vấn đề g&igrave;', NULL, 1, '2021-04-01 08:37:01', '2021-04-01 08:37:02'),
(2291080940, 'user', 17, 26, '213123', NULL, 1, '2021-03-27 22:34:16', '2021-03-27 22:34:37'),
(2293737917, 'user', 28, 17, 'Con up bản đồ của Ho&agrave; B&igrave;nh l&ecirc;n đi, xong QH 1/500 rồi con ạ', NULL, 1, '2021-04-15 16:10:40', '2021-04-15 16:30:23'),
(2294069351, 'user', 26, 17, '=))))', NULL, 1, '2021-04-29 11:49:11', '2021-04-29 11:49:11'),
(2296008472, 'user', 17, 26, '&ocirc;ng cứ up l&ecirc;n đi', NULL, 1, '2021-04-29 11:25:38', '2021-04-29 11:25:39'),
(2301149083, 'user', 26, 17, '&Agrave;, cứ để mng tải chrome xong đặt lopital l&agrave;m trang chủ (lưu đăng nhập) để mng v&agrave;o cho dễ', NULL, 1, '2021-03-28 13:38:23', '2021-03-28 13:38:24'),
(2309803485, 'user', 17, 26, 'seo', NULL, 1, '2021-03-25 20:21:15', '2021-03-25 20:21:16'),
(2322980223, 'user', 26, 28, 'Alo', NULL, 1, '2021-03-30 07:12:48', '2021-03-30 08:53:07'),
(2324879787, 'user', 17, 26, 'Hello', NULL, 1, '2021-03-26 15:13:50', '2021-03-26 15:24:18'),
(2325942202, 'user', 17, 26, 'asfrasf', NULL, 1, '2021-03-27 22:34:17', '2021-03-27 22:34:37'),
(2326941008, 'user', 17, 28, 'dạ v&acirc;ng ạ', NULL, 1, '2021-03-30 08:53:38', '2021-03-30 08:54:58'),
(2332550827, 'user', 26, 26, '', 'c79ee6d0-6516-4178-8d94-dfc4cb412836.doc,92_2015_QH13_296861.doc', 1, '2021-04-16 17:17:27', '2021-04-16 17:17:28'),
(2336587063, 'user', 26, 17, '', 'fdde0402-8faf-4ee6-bf45-7d8ed1ad4c9b.png,02BFF5B4-6B34-4546-AC4D-C1D5BBCAB550.png', 1, '2021-04-01 08:32:36', '2021-04-01 08:36:19'),
(2336768804, 'user', 26, 26, '', '1946fd8f-d796-4960-93b4-5cd0b31c572c.docx,mục lục luật trọng tài thương mại.docx', 1, '2021-04-16 17:18:01', '2021-04-16 17:18:02'),
(2346618140, 'user', 17, 26, '', '5c2b54e5-16c6-4dbb-9df1-d320dc6a9a08.pdf,FORM ĐƠN XIN MUA ĐẤT.pdf', 1, '2021-03-25 20:25:21', '2021-03-25 20:25:21'),
(2353382706, 'user', 17, 26, 'c&oacute; ch&uacute;t lỗi', NULL, 1, '2021-04-01 08:43:07', '2021-04-01 08:43:07'),
(2357578361, 'user', 26, 17, 'Kho d&ugrave;ng chung cho mng &yacute;', NULL, 1, '2021-04-29 11:24:43', '2021-04-29 11:24:43'),
(2359028667, 'user', 17, 26, 'bh mới h&ograve;m h&ograve;m', NULL, 1, '2021-03-25 12:36:01', '2021-03-25 20:15:03'),
(2361446959, 'user', 26, 17, 'c&aacute;i giao việc bị sao đấy', NULL, 1, '2021-04-01 08:42:48', '2021-04-01 08:43:00'),
(2361612161, 'user', 17, 26, 'day ban oi', NULL, 1, '2021-03-25 20:20:59', '2021-03-25 20:21:00'),
(2368107074, 'user', 28, 17, 'Ok con', NULL, 1, '2021-03-30 11:14:25', '2021-03-30 11:14:26'),
(2372912052, 'user', 26, 17, 'Xin kiểu ảnh xem thế n&agrave;o r n&agrave;o đang chơi g&agrave; hả', NULL, 1, '2021-03-28 17:57:14', '2021-03-28 18:32:48'),
(2375088822, 'user', 26, 17, 'yo', NULL, 1, '2021-03-25 20:15:19', '2021-03-25 20:20:46'),
(2375255634, 'user', 17, 28, 'con up phần x&acirc;y dựng r&ocirc;i', NULL, 1, '2021-04-20 16:35:01', '2021-04-20 17:55:41'),
(2376740038, 'user', 26, 26, '', '48b67061-234a-4191-8a2d-784ce304e39c.doc,59_2020_QH14_427301.doc', 1, '2021-04-16 17:16:45', '2021-04-16 17:16:45'),
(2401696462, 'user', 26, 17, 'sau l&agrave;m mẫu', NULL, 1, '2021-04-29 11:24:36', '2021-04-29 11:24:37'),
(2410624279, 'user', 26, 28, 'V&acirc;ng ạ bố cho con xin số li&ecirc;n hệ với ch&uacute; Qu&acirc;n ạ', NULL, 1, '2021-03-30 09:08:08', '2021-03-30 16:09:04'),
(2413116094, 'user', 28, 17, '', 'e50d4ed4-2ca3-446a-ba31-2f24806fc3c8.jpg,image.jpg', 1, '2021-04-27 11:40:15', '2021-04-27 11:40:30'),
(2413998182, 'user', 17, 26, 'bạn test đi xem n&agrave;o', NULL, 1, '2021-03-25 12:36:07', '2021-03-25 20:15:03'),
(2414816712, 'user', 17, 26, 'Ae l&agrave; ph&ograve;ng quản trị', NULL, 1, '2021-03-28 13:34:11', '2021-03-28 13:34:41'),
(2415858968, 'user', 26, 28, 'bo goi gi con a', NULL, 1, '2021-04-01 17:07:40', '2021-04-03 17:58:50'),
(2418449200, 'user', 26, 142, 'em thử gửi c&aacute;i ảnh xem c&oacute; tr&egrave;n ảnh đc kh&ocirc;ng ạ', 'a91b2185-340e-42e5-879b-349163fa44c0.png,Screenshot (194).png', 1, '2021-04-01 08:33:36', '2021-04-01 08:35:37'),
(2427653222, 'user', 17, 26, 'Mẫu bị sao &agrave;', NULL, 1, '2021-03-28 08:27:26', '2021-03-28 08:34:54'),
(2429748134, 'user', 17, 26, 'đợt n&agrave;o &ocirc;ng', NULL, 1, '2021-04-29 11:24:07', '2021-04-29 11:24:08'),
(2440386846, 'user', 17, 26, 'rồi &ocirc;ng', NULL, 1, '2021-04-29 11:24:03', '2021-04-29 11:24:04'),
(2450229661, 'user', 26, 17, '&Agrave; c&aacute;i giao việc up h&igrave;nh vẫn chưa như chat nhể', NULL, 1, '2021-05-05 22:06:00', '2021-05-05 22:06:24'),
(2451458734, 'user', 26, 17, 'su&yacute;t đ&aacute;i', NULL, 1, '2021-04-29 11:49:07', '2021-04-29 11:49:08'),
(2453415782, 'user', 17, 26, 'Đến rồi', NULL, 1, '2021-03-28 15:31:23', '2021-03-28 16:43:15'),
(2456002719, 'user', 17, 28, '', '6cce1b29-f6d3-40b3-b2b3-46241e3b2e2d.jpg,16169263525484682725556434403504.jpg', 1, '2021-03-28 17:12:47', '2021-03-28 17:12:55'),
(2462413225, 'user', 26, 17, '', '7c16f878-4e9b-4034-97e6-5ba99e9597fc.xlsx,wind.xlsx', 1, '2021-03-26 15:54:09', '2021-03-26 15:54:10'),
(2464674407, 'user', 28, 17, '', '7ed280ea-c8e3-4929-978c-c33b522a1640.jpg,image.jpg', 1, '2021-05-08 13:32:49', '2021-05-08 13:33:08'),
(2475763046, 'user', 28, 26, 'Rảnh up bản đồ Ho&agrave; B&igrave;nh l&ecirc;n đi con, c&oacute; 1/500 rồi m&agrave;', NULL, 1, '2021-04-15 16:12:32', '2021-04-15 16:58:09'),
(2477635294, 'user', 28, 17, 'Ch&uacute; với ch&uacute; Trọng đang chuẩn bị l&agrave;m việc với TTVN', NULL, 1, '2021-03-30 08:52:11', '2021-03-30 08:53:25'),
(2489517918, 'user', 17, 28, 'con đang xem lại phần thống k&ecirc; ạ', NULL, 1, '2021-03-30 08:53:48', '2021-03-30 08:54:58'),
(2500290662, 'user', 28, 26, '', 'ceccb866-0ed6-44ac-8490-12aafb69ae13.jpg,image.jpg', 1, '2021-04-26 08:45:10', '2021-04-26 11:02:20'),
(2507218027, 'user', 26, 17, ';\'v', NULL, 1, '2021-04-29 11:22:39', '2021-04-29 11:22:40'),
(2508059427, 'user', 17, 26, 'gọi đi', NULL, 1, '2021-04-29 11:26:02', '2021-04-29 11:26:03'),
(2508156701, 'user', 17, 28, 'v&acirc;ng ạ', NULL, 1, '2021-04-27 13:07:35', '2021-04-27 13:07:36'),
(2515196665, 'user', 26, 17, '', 'd6bf1d1a-e1b5-4ace-b275-716e422dee53.png,417B6671-EDFB-47F5-B89B-15894704575E.png', 1, '2021-04-29 11:33:40', '2021-04-29 11:33:41'),
(2518879800, 'user', 26, 17, 'alo', NULL, 1, '2021-03-25 20:20:51', '2021-03-25 20:20:52'),
(2521701457, 'user', 17, 26, 'chưa l&agrave;m', NULL, 1, '2021-04-29 11:20:59', '2021-04-29 11:21:00'),
(2523441448, 'user', 17, 26, 'Mai b&aacute;o c&aacute;o', NULL, 1, '2021-03-28 15:31:31', '2021-03-28 16:43:15'),
(2525035371, 'user', 26, 118, 'Ch&uacute; ạ cho ch&aacute;u xin bản đồ ho&agrave; b&igrave;nh để up lệ hệ thống với ạ', NULL, 0, '2021-03-30 09:08:42', '2021-03-30 09:08:42'),
(2528720670, 'user', 26, 17, 'th&igrave; hashtag @', NULL, 1, '2021-04-01 08:45:32', '2021-04-01 08:46:09'),
(2543902202, 'user', 26, 17, 'nhận được th&ocirc;ng b&aacute;o', NULL, 1, '2021-03-26 16:14:19', '2021-03-26 16:14:19'),
(2543994226, 'user', 26, 26, '', '84f157dd-97f0-4d24-ba0d-82fa705f59e6.docx,mục lục luật tố tụng dân sự.docx', 1, '2021-04-16 17:17:37', '2021-04-16 17:17:38'),
(2563176665, 'user', 17, 26, '', '4b212368-bed5-4010-a0e7-4b2a7dde49b2.jpg,IMG_20210325_130545.jpg', 1, '2021-03-26 15:43:34', '2021-03-26 15:43:34'),
(2564313878, 'user', 26, 17, 'bh đến nơi nhắn t qua đ&acirc;y nh&eacute;', NULL, 1, '2021-03-28 12:20:44', '2021-03-28 12:21:19'),
(2564569116, 'user', 26, 17, '', 'e086671c-3fbc-4f2d-88d6-6ad95bad6fab.png,Screenshot (245).png', 1, '2021-03-25 20:28:34', '2021-03-25 20:28:35'),
(2565794957, 'user', 26, 17, '', '1daf286b-0c3f-48e5-88b0-68355e079017.xlsx,TASK LIST -  TOÀN CẦU XUÂN THÀNH (1).xlsx', 1, '2021-04-29 11:30:39', '2021-04-29 11:30:39'),
(2574528460, 'user', 26, 28, 'ch&uacute; dhi&ecirc;n ạ', NULL, 1, '2021-05-05 16:13:48', '2021-05-05 17:32:28'),
(2577511171, 'user', 157, 158, 'alo', NULL, 1, '2021-09-07 14:16:10', '2021-09-07 14:20:09'),
(2584992180, 'user', 17, 26, 'Oke', NULL, 1, '2021-03-28 13:39:11', '2021-03-28 13:39:54'),
(2585573660, 'user', 17, 26, 'ote bạn', NULL, 1, '2021-04-29 11:48:42', '2021-04-29 11:49:01'),
(2586447181, 'user', 26, 17, '312312312', NULL, 1, '2021-03-25 20:21:02', '2021-03-25 20:21:03'),
(2591832785, 'user', 26, 17, 'm&agrave;y giới hạn quyền chụp', NULL, 1, '2021-04-01 08:51:18', '2021-04-01 08:51:19'),
(2592153904, 'user', 28, 17, 'Ok con', NULL, 1, '2021-03-30 08:55:16', '2021-03-30 08:55:17'),
(2594491311, 'user', 26, 17, ';\'v ko c&oacute; n&uacute;t mở &agrave;', NULL, 1, '2021-04-29 11:20:46', '2021-04-29 11:20:46'),
(2595450268, 'user', 17, 28, 'đợi b&ecirc;n ph&ograve;ng kinh doanh cập nhật dần dần th&ocirc;i ạ', NULL, 1, '2021-03-30 11:14:20', '2021-03-30 11:14:21'),
(2598322244, 'user', 26, 17, 'Theo t ph&acirc;n t&iacute;ch th&igrave; phải đấu thầu lại do ng&agrave;y xưa l&uacute;c ra QĐ chấp thuận chủ trương đầu tư k c&oacute; ph&acirc;n kỳ 02 giai đoạn (mặc d&ugrave; CĐT xin đầu tư 02 giai đoạn) n&ecirc;n giờ phải đấu thầu GĐ2. C&aacute;i c&ocirc;ng văn năm 2011 l&agrave; chấp thuận khảo s&aacute;t lập quy hoạch th&ocirc;i =)))', NULL, 1, '2021-03-24 15:03:05', '2021-03-25 12:35:46'),
(2598348618, 'user', 26, 17, 't kh&oacute;a nhầm rồi', NULL, 1, '2021-04-29 11:20:59', '2021-04-29 11:21:00'),
(2601890999, 'user', 26, 17, '&agrave; PVS hồi về gần mốc mua rồi nh&eacute;', NULL, 1, '2021-04-29 11:48:09', '2021-04-29 11:48:33'),
(2602336426, 'user', 17, 26, 'mở kh&oacute;a l&ocirc; rồi nh&eacute;', NULL, 1, '2021-04-29 11:22:06', '2021-04-29 11:22:34'),
(2602553801, 'user', 26, 26, '', '492e639d-7636-4b62-b1e0-4880dce1c746.docx,mục lục luật doanh nghiệp 2020.docx', 1, '2021-04-16 17:17:02', '2021-04-16 17:17:03'),
(2604840536, 'user', 26, 17, ':)', NULL, 1, '2021-04-29 11:17:34', '2021-04-29 11:17:50'),
(2604953332, 'user', 28, 17, 'con đang viết sửa phần b&aacute;n h&agrave;ng', NULL, 1, '2021-04-20 15:53:26', '2021-04-20 15:53:37'),
(2607699866, 'user', 17, 26, 'code sml', NULL, 1, '2021-03-25 12:35:56', '2021-03-25 20:15:03'),
(2610514260, 'user', 26, 17, 'Yo bạn ơi tối đi cafe v&aacute;c lap ra trao đổi ch&uacute;t ko', NULL, 1, '2021-03-24 15:01:03', '2021-03-25 12:35:46'),
(2610850413, 'user', 28, 17, 'Con chưa up thử v&agrave;o kho dữ liệu của phần xd hả?', NULL, 1, '2021-04-20 15:52:59', '2021-04-20 15:53:37'),
(2612437194, 'user', 28, 26, '', '1955f21a-f6a2-4f6c-875c-de8f35092600.jpg,image.jpg', 1, '2021-05-05 16:13:18', '2021-05-05 16:13:39'),
(2613300747, 'user', 26, 17, '&agrave; đ&atilde; c&oacute; kho chưa', NULL, 1, '2021-04-29 11:23:38', '2021-04-29 11:23:39'),
(2615252577, 'user', 17, 26, 'Sửa r&ocirc;id', NULL, 1, '2021-03-28 15:31:26', '2021-03-28 16:43:15'),
(2616577783, 'user', 28, 26, 'Bố thử', NULL, 1, '2021-05-05 17:32:49', '2021-05-05 20:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `mess_url`
--

CREATE TABLE `mess_url` (
  `id` int(11) NOT NULL,
  `mess_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_23_083532_create_table_edges_table', 1),
(3, '2019_08_23_083533_create-cameras-table', 1),
(4, '2019_08_23_083534_create-key_streams-table', 1),
(5, '2019_08_23_083535_create-users-table', 1),
(6, '2019_08_23_083537_create-nvrs-table', 1),
(7, '2019_08_23_083539_create-nvr_permissions-table', 1),
(8, '2019_08_23_083545_create-nvr_cameras-table', 1),
(9, '2019_08_23_084026_create-camera_permissions-table', 1),
(10, '2019_08_28_034607_create_info_nvrs', 1),
(11, '2019_09_04_081405_create_users_location_access_table', 1),
(12, '2020_08_04_153403_create_table_edge-permissions_table', 1),
(13, '2020_08_04_153542_create_table_applications_table', 1),
(14, '2020_08_04_153543_create_table_app-rzm-events_table', 1),
(15, '2020_08_04_155601_create_table_info-edges_table', 1),
(16, '2020_08_06_102626_create_table_cam-app-rzm-events_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `old_messages`
--

CREATE TABLE `old_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `old_messages`
--

INSERT INTO `old_messages` (`id`, `thread_id`, `user_id`, `body`, `attachment`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 26, 'hi', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_read` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `thread_id`, `user_id`, `last_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 26, '2021-11-21 10:37:39', '2021-11-21 10:37:39', '2021-11-21 10:37:39', NULL),
(2, 1, 1, NULL, '2021-11-21 10:37:39', '2021-11-21 10:37:39', NULL),
(3, 1, 2, NULL, '2021-11-21 10:37:39', '2021-11-21 10:37:39', NULL),
(4, 1, 4, NULL, '2021-11-21 10:37:39', '2021-11-21 10:37:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(3) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `curstep` int(11) NOT NULL DEFAULT '1',
  `state` int(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`id`, `type`, `name`, `curstep`, `state`, `created_at`, `updated_at`, `project_id`) VALUES
(14, NULL, 'Hội Vân 24 héc ta (dịch vụ)', 1, 0, '2021-10-05 02:20:45', '2021-10-05 02:20:45', 4),
(16, NULL, 'Hội Vân 17 héc ta', 1, 0, '2021-10-05 04:10:23', '2021-10-05 04:10:23', 4);

-- --------------------------------------------------------

--
-- Table structure for table `process_file`
--

CREATE TABLE `process_file` (
  `id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `process_step`
--

CREATE TABLE `process_step` (
  `id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `pos` int(11) NOT NULL,
  `case_num` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `process_step`
--

INSERT INTO `process_step` (`id`, `process_id`, `step_id`, `pos`, `case_num`, `created_at`, `updated_at`) VALUES
(40, 11, 31, 3, NULL, '2021-03-24 07:13:13', '2021-03-24 07:13:13'),
(41, 12, 32, 1, NULL, '2021-03-24 07:46:05', '2021-03-24 07:46:05'),
(42, 12, 33, 2, NULL, '2021-03-24 07:46:09', '2021-03-24 07:46:09'),
(43, 12, 34, 3, NULL, '2021-03-24 07:46:12', '2021-03-24 07:46:12'),
(44, 14, 35, 1, NULL, '2021-10-05 02:23:17', '2021-10-05 02:23:17'),
(45, 14, 36, 2, NULL, '2021-10-05 02:23:26', '2021-10-05 02:23:26'),
(46, 14, 37, 3, NULL, '2021-10-05 02:23:36', '2021-10-05 02:23:36'),
(48, 16, 39, 1, NULL, '2021-10-05 04:10:42', '2021-10-05 04:10:42'),
(49, 16, 40, 2, NULL, '2021-10-05 04:10:48', '2021-10-05 04:10:48'),
(50, 16, 41, 3, NULL, '2021-10-05 04:11:00', '2021-10-05 04:11:00'),
(51, 17, 42, 1, NULL, '2021-10-05 13:09:41', '2021-10-05 13:09:41'),
(52, 17, 43, 2, NULL, '2021-10-05 13:09:47', '2021-10-05 13:09:47'),
(53, 17, 44, 3, NULL, '2021-10-05 13:10:00', '2021-10-05 13:10:00'),
(54, 18, 45, 1, NULL, '2021-10-05 13:33:08', '2021-10-05 13:33:08'),
(55, 18, 46, 2, NULL, '2021-10-05 13:38:10', '2021-10-05 13:38:10'),
(56, 18, 47, 3, NULL, '2021-10-05 13:38:22', '2021-10-05 13:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `display` int(11) NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `display`, `name`, `city`, `description`, `url`, `created_at`, `updated_at`) VALUES
(4, 0, 'Hội vân', 'Quy nhơn', NULL, '4.jpg', '2021-09-10 07:38:35', '2021-09-10 07:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `discussion_id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `user_id`, `discussion_id`, `content`, `created_at`, `updated_at`) VALUES
(9, 17, 8, 'Xử lý theo quy trinh em nhé', '2020-12-17 05:32:11', '2020-12-17 05:32:11'),
(10, 17, 8, '<h1><strong>test 123</strong></h1>\r\n\r\n<p><strong>nội dung owre đ&acirc;y</strong></p>', '2021-01-03 10:43:47', '2021-01-03 10:43:47'),
(11, 17, 8, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>1</td>\r\n			<td>1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2</td>\r\n			<td>3</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4</td>\r\n			<td>5</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>', '2021-01-03 10:44:32', '2021-01-03 10:44:32'),
(15, 17, 8, '<p>test</p>', '2021-03-15 23:29:36', '2021-03-15 23:29:36'),
(24, 17, 9, '<p>123</p>', '2021-03-16 08:23:52', '2021-03-16 08:23:52'),
(25, 17, 9, '<p>123</p>', '2021-03-16 08:23:58', '2021-03-16 08:23:58'),
(26, 17, 9, '<p>123</p>', '2021-03-16 08:24:09', '2021-03-16 08:24:09'),
(27, 17, 9, '<p>123</p>', '2021-03-16 08:24:55', '2021-03-16 08:24:55'),
(28, 17, 9, '<p>test</p>', '2021-03-16 08:25:25', '2021-03-16 08:25:25'),
(29, 17, 9, '<p>`123</p>', '2021-03-16 08:25:39', '2021-03-16 08:25:39'),
(30, 17, 9, '<p>quy</p>', '2021-03-16 08:26:08', '2021-03-16 08:26:08'),
(31, 17, 9, '<p>test</p>', '2021-03-16 08:30:58', '2021-03-16 08:30:58'),
(32, 17, 9, '<p>test</p>', '2021-03-16 08:31:15', '2021-03-16 08:31:15'),
(33, 17, 9, '<p>tw</p>', '2021-03-16 08:34:41', '2021-03-16 08:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `replies_url`
--

CREATE TABLE `replies_url` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies_url`
--

INSERT INTO `replies_url` (`id`, `blog_id`, `url`, `created_at`, `updated_at`) VALUES
(1, 8, '/storage/discuss/l84h0HtAGCGhFo7JM2MA96Jp8KoRoNCBrcLibnn9.png', '2021-03-15 23:20:03', '2021-03-15 23:20:03'),
(2, 15, '/storage/discuss/yFRHSuXXe9O03Q79enCUOrfpkODSEDbHz2Ne0FYL.png', '2021-03-15 23:29:36', '2021-03-15 23:29:36'),
(4, 26, '/storage/discuss/uLY9lTYjwHIhO2kUbQUjxazxsaEee4n0Th0LkBcw.jpg', '2021-03-16 08:24:09', '2021-03-16 08:24:09'),
(5, 26, '/storage/discuss/KNj13CJ9SGtgFnO8bp0lNlE2J56ABOnSLQMeWKjC.jpg', '2021-03-16 08:24:09', '2021-03-16 08:24:09'),
(6, 27, '/storage/discuss/A4snpIfT0jUDV1iGooMc0N6tFsQmrqtiONX5cY6A.xlsx', '2021-03-16 08:24:55', '2021-03-16 08:24:55'),
(7, 29, '/storage/discuss/z9kPpS1VKZ18IIbF4xR9egmLWdMjKXxLysPRNBbS.pdf', '2021-03-16 08:25:39', '2021-03-16 08:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `des` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `des`, `department_id`, `name`, `level`, `created_at`, `updated_at`) VALUES
(1, NULL, 6, 'Quản trị viên', 1, '2021-01-19 01:08:05', '2021-01-19 01:08:05'),
(2, NULL, 1, 'Trưởng phòng', 1, '2021-01-19 01:08:25', '2021-01-19 02:50:17'),
(3, NULL, 1, 'Pháp lý bán hàng', 2, '2021-01-19 02:37:25', '2021-04-16 10:38:21'),
(4, NULL, 1, 'Nhân viên', 3, '2021-01-19 02:39:51', '2021-01-19 02:50:23'),
(5, NULL, 1, 'Cộng tác viên', 3, '2021-01-19 02:39:57', '2021-01-19 02:50:26'),
(7, NULL, 2, 'Quản lý thi công', 1, '2021-01-19 02:40:25', '2021-01-19 02:50:09'),
(8, NULL, 2, 'Nhân viên', 3, '2021-01-19 02:50:39', '2021-01-19 02:50:39'),
(9, NULL, 3, 'nhân viên', 3, '2021-01-19 02:51:02', '2021-01-19 02:51:02'),
(10, NULL, 4, 'Nhân viên', 3, '2021-01-19 02:51:18', '2021-01-19 02:51:18'),
(11, NULL, 5, 'Tổng giám đốc', 1, '2021-01-19 02:52:26', '2021-01-19 02:52:26'),
(12, NULL, 5, 'Thành viên hội đồng quản trị', 1, '2021-01-19 02:52:38', '2021-01-19 02:52:38'),
(13, NULL, 5, 'Phó Tổng Giám Đốc', 1, '2021-03-09 05:37:58', '2021-11-27 01:58:08'),
(14, NULL, 7, 'Nhân viên', 1, '2021-03-09 05:39:22', '2021-03-09 05:39:22'),
(15, NULL, 8, 'Kế toán trưởng', 1, '2021-03-09 05:40:22', '2021-03-09 05:40:22'),
(16, NULL, 8, 'Nhân viên', 3, '2021-03-09 05:40:36', '2021-03-09 05:40:36'),
(17, NULL, 8, 'Kế toán', 2, '2021-03-09 05:40:45', '2021-03-09 05:40:45'),
(18, NULL, 4, 'Trưởng phòng', 1, '2021-03-09 05:41:40', '2021-03-09 05:41:40'),
(19, NULL, 4, 'Hành chính - Nhân sự', 2, '2021-03-09 05:42:07', '2021-03-09 05:42:41'),
(20, NULL, 4, 'Lễ tân', 3, '2021-03-09 05:42:31', '2021-03-09 05:42:46'),
(21, NULL, 4, 'Bảo vệ', 3, '2021-03-09 05:42:53', '2021-03-09 05:42:53'),
(22, NULL, 4, 'Tạp vụ', 3, '2021-03-09 05:43:06', '2021-03-09 05:43:06'),
(23, NULL, 3, 'kỹ sư', 1, '2021-03-09 05:47:49', '2021-03-09 05:47:49'),
(24, NULL, 10, 'Chủ tịch hội đồng quản trị', 1, '2021-03-28 09:46:00', '2021-03-28 09:46:00'),
(25, NULL, 10, 'Phó chủ tịch hội đồng quản trị', 1, '2021-03-28 09:46:13', '2021-03-28 09:46:13'),
(27, NULL, 13, 'Khách hàng', 1, '2021-09-14 18:03:20', '2021-09-14 18:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `role_legal`
--

CREATE TABLE `role_legal` (
  `id` int(11) NOT NULL,
  `user_role` int(5) NOT NULL,
  `legal_id` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_legal`
--

INSERT INTO `role_legal` (`id`, `user_role`, `legal_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-01-02 08:46:41', '2021-01-02 08:46:41'),
(2, 1, 2, '2021-01-02 08:46:41', '2021-01-02 08:46:41'),
(3, 1, 3, '2021-01-02 08:46:57', '2021-01-02 08:46:57'),
(4, 1, 4, '2021-01-02 08:46:57', '2021-01-02 08:46:57'),
(7, 1, 7, '2021-01-02 08:47:25', '2021-01-02 08:47:25'),
(9, 1, 9, '2021-01-02 08:47:34', '2021-01-02 08:47:34'),
(17, 1, 11, '2021-03-07 07:15:19', '2021-03-07 07:15:19'),
(18, 1, 12, '2021-03-07 07:15:22', '2021-03-07 07:15:22'),
(19, 1, 13, '2021-03-07 07:15:25', '2021-03-07 07:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `root_id` int(11) NOT NULL DEFAULT '0',
  `last_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_department`
--

CREATE TABLE `schedule_department` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_file`
--

CREATE TABLE `schedule_file` (
  `id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `open` smallint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_file_tag`
--

CREATE TABLE `schedule_file_tag` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_guest`
--

CREATE TABLE `schedule_guest` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_messages`
--

CREATE TABLE `schedule_messages` (
  `id` bigint(20) NOT NULL,
  `pin` int(11) NOT NULL DEFAULT '0',
  `schedule_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_messages_tag`
--

CREATE TABLE `schedule_messages_tag` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_sub_messages`
--

CREATE TABLE `schedule_sub_messages` (
  `id` bigint(20) NOT NULL,
  `messages_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_sub_messages_tag`
--

CREATE TABLE `schedule_sub_messages_tag` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_threads`
--

CREATE TABLE `schedule_threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `schedule_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `open` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remove` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_thread_user`
--

CREATE TABLE `schedule_thread_user` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_user`
--

CREATE TABLE `schedule_user` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` int(15) NOT NULL,
  `identify_card` int(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `name`, `phone_number`, `identify_card`, `created_at`, `updated_at`) VALUES
(1, 13, 'Truong Tien Dung', 936167485, 123213456, '2020-11-27 04:09:51', '2020-11-27 04:09:51'),
(2, 17, 'dung truong', 936167485, 213123412, '2020-11-27 04:58:36', '2020-11-27 04:58:36'),
(3, 21, 'dung truong123', 936167485, 123123, '2021-01-15 03:10:02', '2021-01-15 03:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `staff_event`
--

CREATE TABLE `staff_event` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_event`
--

INSERT INTO `staff_event` (`id`, `staff_id`, `name`, `des`, `date`, `created_at`, `updated_at`) VALUES
(1, 17, 'Gia nhập công ty', '', '2019-02-01', '2021-01-20 15:44:33', '2021-01-20 15:44:33'),
(3, 17, 'Đào tạo thành công', '', '2019-06-04', '2021-01-20 16:06:52', '2021-01-20 16:06:52'),
(4, 17, 'Nhân viên xuất xắc năm', '', '2020-05-20', '2021-01-20 16:07:13', '2021-01-20 16:07:13'),
(5, 17, 'Bổ nhiệm phó phòng', '', '2020-11-20', '2021-01-20 16:07:42', '2021-01-20 16:07:42'),
(6, 145, 'Bổ nhiệm làm Trưởng Phòng Kinh doanh', '<p>Bổ nhiệu chị Nguyễn Thị Thu Thảo đảm nhận chức vụ mới, thực hiện c&aacute;c c&ocirc;ng việc như sau:</p>\r\n\r\n<p>- Quản l&yacute; chung c&ocirc;ng việc trong ph&ograve;ng;<br />\r\n- Giao việc cho nh&acirc;n vi&ecirc;n h&agrave;ng tuần, h&agrave;ng ng&agrave;y;<br />\r\n- X&acirc;y dựng kế hoạch kinh doanh h&agrave;ng th&aacute;ng, h&agrave;ng tuần b&aacute;m s&aacute;t mục ti&ecirc;u BGĐ đề ra;<br />\r\n- X&acirc;y dừng kế hoạch truyền th&ocirc;ng quảng b&aacute; sản phẩm từng giai đoạn, gi&aacute;m s&aacute;t lựa chọn, s&agrave;ng lọc nh&agrave; cung cấp, đề xuất k&yacute; hợp đồng với nh&agrave; cung cấp dịch vụ truyền th&ocirc;ng;<br />\r\n- Tham mưu chiến lược kinh doanh c&ugrave;ng BGĐ;<br />\r\n- Thiết lập lực lượng b&aacute;n h&agrave;ng (sales);<br />\r\n- Đ&agrave;o tạo, dẫn dắt lực lượng b&aacute;n h&agrave;ng nắm bắt th&ocirc;ng tin, hiểu chuy&ecirc;n s&acirc;u về sản phẩm, l&ecirc;n kịch bản chốt kh&aacute;ch cho sales;<br />\r\n- Hỗ trợ sales tư vấn, chốt kh&aacute;ch h&agrave;ng;<br />\r\n- &nbsp;Gi&aacute;m s&aacute;t, k&yacute; nh&aacute;y v&agrave;o c&aacute;c văn bản ph&aacute;t h&agrave;nh từ ph&ograve;ng như: đơn cọc, hợp đồng giao dịch, th&ocirc;ng b&aacute;o b&aacute;n h&agrave;ng, bảng h&agrave;ng,...;<br />\r\n- Cập nhật t&igrave;nh h&igrave;nh b&aacute;n h&agrave;ng, b&aacute;o c&aacute;o doanh thu, c&ocirc;ng nợ h&agrave;ng ng&agrave;y, h&agrave;ng tuần, h&agrave;ng th&aacute;ng cho BGĐ;<br />\r\n- Đ&ocirc;n đốc nh&acirc;n vi&ecirc;n thực hiện c&ocirc;ng t&aacute;c b&aacute;n h&agrave;ng, thu hồi c&ocirc;ng nợ, l&agrave;m sổ đỏ, b&agrave;n giao nh&agrave;/đất cho kh&aacute;ch h&agrave;ng;<br />\r\n- Gi&aacute;m s&aacute;t lưu trữ to&agrave;n bộ th&ocirc;ng tin kh&aacute;ch h&agrave;ng, văn bản giao dịch giữa c&ocirc;ng ty v&agrave; kh&aacute;ch h&agrave;ng, bảo mật th&ocirc;ng tin kh&aacute;ch h&agrave;ng;<br />\r\n- Đối chiếu doanh thu, c&ocirc;ng nợ h&agrave;ng th&aacute;ng với ph&ograve;ng Kế to&aacute;n;<br />\r\n&nbsp;- Duy tr&igrave; chăm s&oacute;c kh&aacute;ch h&agrave;ng hậu hợp đồng.</p>', '2018-08-11', '2021-03-25 02:58:46', '2021-03-25 02:58:46'),
(7, 144, 'Đã bổ nhiệm làm nhân viên phòng kinh doanh', '<p>Bổ nhiệm chị Phan Thị Như Quỳnh v&agrave;o vị tr&iacute; nh&acirc;n vi&ecirc;n kinh doanh, đảm nhận c&aacute;c nhiệm vụ như sau:</p>\r\n\r\n<p>- Theo d&otilde;i chăm s&oacute;c hậu hợp đồng, quản l&yacute; data kh&aacute;ch h&agrave;ng đ&atilde; giao dịch với C&ocirc;ng ty qua s&agrave;n BĐS Đất Xanh, qua hệ thống CTV;<br />\r\n- Hỗ trợ l&agrave;m sổ đỏ to&agrave;n bộ dự &aacute;n cho kh&aacute;ch h&agrave;ng;<br />\r\n- Tiếp thị, quảng c&aacute;o, t&igrave;m kiếm kh&aacute;ch h&agrave;ng mới, tư vấn b&aacute;n h&agrave;ng, chạy chỉ ti&ecirc;u doanh số b&aacute;n mới;<br />\r\n- Soạn c&aacute;c văn bản giao dịch với kh&aacute;ch h&agrave;ng: đơn cọc, hợp đồng giao dịch,...;<br />\r\n- Hướng dẫn kh&aacute;ch h&agrave;ng nộp tiền, phối hợp ph&ograve;ng kế to&aacute;n l&agrave;m phiếu thu chi;<br />\r\n- Cập nhật b&aacute;o c&aacute;o c&ocirc;ng nợ, doanh thu h&agrave;ng tuần, h&agrave;ng th&aacute;ng.&nbsp;</p>', '2018-08-01', '2021-03-25 03:09:50', '2021-03-25 03:09:50'),
(8, 142, 'Bổ nhiệm nhân viên kinh doanh', '<p>Bổ nhiệm chị Nguyễn Thị Phương Linh l&agrave;m nh&acirc;n vi&ecirc;n kinh doanh, chịu tr&aacute;ch nhiệm c&aacute;c c&ocirc;ng việc sau:</p>\r\n\r\n<p>- Theo d&otilde;i chăm s&oacute;c hậu hợp đồng quản l&yacute; data kh&aacute;ch h&agrave;ng ngoại giao, kh&aacute;ch h&agrave;ng do C&ocirc;ng ty trực tiếp b&aacute;n;&nbsp;<br />\r\n- Quản l&yacute; data kh&aacute;ch h&agrave;ng x&acirc;y th&ocirc;, đ&ocirc;n đốc cập nhật tiến độ l&agrave;m việc của nh&agrave; thầu, cập nhật c&ocirc;ng nợ, đốc th&uacute;c b&agrave;n giao đ&uacute;ng tiến độ cho kh&aacute;ch h&agrave;ng, phối hợp c&ugrave;ng phong kỹ thuật tr&iacute;ch đo, l&agrave;m thủ tục l&agrave;m b&igrave;a cho kh&aacute;ch h&agrave;ng;<br />\r\n- Tiếp thị, quảng c&aacute;o, t&igrave;m kiếm kh&aacute;ch h&agrave;ng mới, tư vấn b&aacute;n h&agrave;ng, chạy chỉ ti&ecirc;u doanh số b&aacute;n mới;<br />\r\n- Soạn c&aacute;c văn bản giao dịch với kh&aacute;ch h&agrave;ng: đơn cọc, hợp đồng giao dịch,...;<br />\r\n- Hướng dẫn kh&aacute;ch h&agrave;ng nộp tiền, phối hợp ph&ograve;ng kế to&aacute;n l&agrave;m phiếu thu chi;<br />\r\n- Cập nhật b&aacute;o c&aacute;o c&ocirc;ng nợ, doanh thu h&agrave;ng tuần, h&agrave;ng th&aacute;ng.&nbsp;</p>', '2016-03-01', '2021-03-25 03:10:49', '2021-03-25 03:10:49'),
(9, 126, 'Bổ nhiệm nhân viên kinh doanh', '<p>Quyết định bổ nhiệm anh Nguyễn Th&agrave;nh Chung l&agrave;m nh&acirc;n vi&ecirc;n kinh doanh, chịu tr&aacute;ch nhiệm c&aacute;c c&ocirc;ng việc sau:</p>\r\n\r\n<p>- Tiếp thị, quảng c&aacute;o, đẩy mạnh truyền th&ocirc;ng phủ to&agrave;n dự &aacute;n, phục vụ s&oacute;ng I13;<br />\r\n- T&igrave;m kiếm kh&aacute;ch h&agrave;ng mới, tư vấn, chốt kh&aacute;ch;<br />\r\n- Hỗ trợ hệ thống CTV tư vấn, chốt kh&aacute;ch.<br />\r\n&nbsp;</p>', '2016-08-01', '2021-03-25 03:12:41', '2021-03-25 03:12:41'),
(10, 150, 'Công việc', '<p>- Tiếp thị, quảng c&aacute;o, đẩy mạnh truyền th&ocirc;ng phủ to&agrave;n dự &aacute;n, phục vụ s&oacute;ng I13;<br />\r\n- T&igrave;m kiếm kh&aacute;ch h&agrave;ng mới, tư vấn, chốt kh&aacute;ch;<br />\r\n- Hỗ trợ hệ thống CTV tư vấn, chốt kh&aacute;ch.<br />\r\n&nbsp;</p>', '2021-03-27', '2021-03-27 13:41:05', '2021-03-27 13:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `staff_process`
--

CREATE TABLE `staff_process` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_process`
--

INSERT INTO `staff_process` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Mua bán nhà có sẵn', '2020-12-29 10:08:25', '2020-12-29 10:08:25'),
(2, 'Phân lô bán nền', '2021-03-06 00:11:59', '2021-03-06 00:11:59'),
(3, 'Mua bán nhà ở hình thành trong tương lai', '2021-03-06 00:12:21', '2021-03-06 00:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `staff_process_lock`
--

CREATE TABLE `staff_process_lock` (
  `id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_process_lock`
--

INSERT INTO `staff_process_lock` (`id`, `process_id`, `name`, `url`, `created_at`, `updated_at`) VALUES
(1, 2, 'Đủ điều kiện huy động vốn', '/storage/system/ZCCJWmbx0BukHBZ4mxSqVmQ3gEBeHgfKI5gRu9rw.pdf', '2021-09-29 08:53:20', '2021-09-29 08:53:20'),
(2, 2, 'Cấp phép xây dựng hạ tầng', '/storage/system/8OUQwsySwUZML2bbUPWxqOFXz9dn584NIUqPgXeS.pdf', '2021-09-29 08:57:57', '2021-09-29 08:57:57'),
(3, 2, 'Nộp tiền sử dụng đất, cấp giấy chứng nhận', '/storage/system/AU6oT6u2ZjIvdsJilagAG04OgWFnMUqAlWiHxPz7.pdf', '2021-09-29 09:08:43', '2021-09-29 09:08:43'),
(4, 2, 'Cấp phép phân lô bán nền', '/storage/system/TyyIxTVGKKiXHRInX0mBckdEReUqiY6YtWL2U5TN.pdf', '2021-09-30 12:43:08', '2021-09-30 12:43:08');

-- --------------------------------------------------------

--
-- Table structure for table `staff_process_step`
--

CREATE TABLE `staff_process_step` (
  `id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `pos` int(11) NOT NULL,
  `case_num` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_process_step`
--

INSERT INTO `staff_process_step` (`id`, `process_id`, `step_id`, `pos`, `case_num`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2020-12-29 10:11:16', '2020-12-29 10:11:16'),
(2, 1, 2, 2, 2, '2020-12-29 10:11:16', '2020-12-29 10:11:16'),
(3, 1, 3, 3, 1, '2020-12-29 10:11:30', '2020-12-29 10:11:30'),
(4, 2, 4, 1, 1, '2021-03-06 02:11:51', '2021-03-06 02:11:51'),
(5, 2, 5, 3, 1, '2021-03-06 02:12:13', '2021-03-06 02:12:13'),
(6, 3, 6, 1, 1, '2021-03-06 02:12:26', '2021-03-06 02:12:26'),
(7, 3, 5, 2, 1, '2021-03-06 02:12:47', '2021-03-06 02:12:47'),
(8, 2, 8, 2, 1, '2021-09-30 12:41:29', '2021-09-30 12:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `staff_step`
--

CREATE TABLE `staff_step` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pay_flag` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_step`
--

INSERT INTO `staff_step` (`id`, `name`, `pay_flag`, `created_at`, `updated_at`) VALUES
(1, 'Đặt cọc', 0, '2020-12-29 10:09:16', '2020-12-29 10:09:16'),
(2, 'Ký hợp đồng mua bán', 1, '2020-12-29 10:09:16', '2020-12-29 10:09:16'),
(3, 'Thanh lý hợp dông', 0, '2020-12-29 10:09:34', '2020-12-29 10:09:34'),
(4, 'Ký hợp đồng mua bán', 1, '2021-03-06 00:16:03', '2021-03-06 00:16:03'),
(5, 'Thanh lý hợp đồng', 0, '2021-03-06 00:16:33', '2021-03-06 00:16:33'),
(6, 'Ký hợp đồng mua bán', 1, '2021-03-06 00:17:01', '2021-03-06 00:17:01'),
(7, 'Thanh lý hợp đồng', 0, '2021-03-06 00:17:15', '2021-03-06 00:17:15'),
(8, 'Kiểm tra chéo', 0, '2021-09-30 12:41:29', '2021-09-30 12:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `staff_step_task`
--

CREATE TABLE `staff_step_task` (
  `id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `pos` int(11) DEFAULT NULL,
  `day` int(11) NOT NULL DEFAULT '0',
  `month` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_step_task`
--

INSERT INTO `staff_step_task` (`id`, `step_id`, `task_id`, `pos`, `day`, `month`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 0, 0, '2020-12-29 10:15:46', '2020-12-29 10:15:46'),
(2, 1, 2, NULL, 0, 0, '2020-12-29 10:15:46', '2020-12-29 10:15:46'),
(3, 2, 3, NULL, 0, 0, '2020-12-29 10:15:57', '2020-12-29 10:15:57'),
(7, 3, 7, NULL, 0, 0, '2020-12-29 10:16:25', '2020-12-29 10:16:25'),
(8, 3, 8, NULL, 0, 0, '2020-12-29 10:16:25', '2020-12-29 10:16:25'),
(9, 3, 9, NULL, 0, 0, '2020-12-29 10:16:31', '2020-12-29 10:16:31'),
(10, 2, 10, NULL, 0, 0, '2020-12-30 02:37:36', '2020-12-30 02:37:36'),
(12, 4, 13, 2, 0, 1, '2021-03-06 00:21:06', '2021-03-06 00:21:06'),
(13, 6, 11, 1, 0, 1, '2021-03-06 00:22:33', '2021-03-06 00:22:33'),
(14, 6, 14, 2, 0, 1, '2021-03-06 00:22:39', '2021-03-06 00:22:39'),
(15, 5, 8, 0, 0, 3, '2021-03-06 00:31:43', '2021-03-06 00:31:43'),
(16, 5, 1, 0, 0, 3, '2021-03-06 00:31:51', '2021-03-06 00:31:51'),
(17, 5, 10, 0, 0, 3, '2021-03-06 00:32:05', '2021-03-06 00:32:05'),
(18, 1, 1, NULL, 0, 0, '2021-03-07 06:31:22', '2021-03-07 06:31:22'),
(19, 1, 3, NULL, 0, 0, '2021-03-07 06:32:37', '2021-03-07 06:32:37'),
(22, 4, 15, 0, 0, 1, '2021-03-24 14:45:08', '2021-03-24 14:45:08'),
(23, 6, 15, 0, 0, 1, '2021-03-24 14:46:02', '2021-03-24 14:46:02'),
(24, 6, 17, 4, 0, 0, '2021-04-02 02:44:52', '2021-04-02 02:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `staff_task`
--

CREATE TABLE `staff_task` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_task`
--

INSERT INTO `staff_task` (`id`, `name`, `type`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Hợp đồng đặt cọc', 0, '', '2020-12-29 10:11:54', '2020-12-29 10:11:54'),
(2, 'Biên nhận tiền cọc', 0, '', '2020-12-29 10:11:54', '2020-12-29 10:11:54'),
(3, 'Hợp đồng mua bán', 0, '', '2020-12-29 10:12:15', '2020-12-29 10:12:15'),
(4, 'Biên nhận tiến độ đợt 1', 0, '', '2020-12-29 10:12:15', '2020-12-29 10:12:15'),
(5, 'Biên nhận tiến độ đợt 2', 0, '', '2020-12-29 10:12:23', '2020-12-29 10:12:23'),
(6, 'Biên nhận tiến độ đợt 3', 0, '', '2020-12-29 10:12:23', '2020-12-29 10:12:23'),
(7, 'Ký hợp đồng mới', 1, '', '2020-12-29 10:14:08', '2020-12-29 10:14:08'),
(8, 'Biện nhận nốt 5% tiền mua bán', 0, '', '2020-12-29 10:14:08', '2020-12-29 10:14:08'),
(9, 'Sổ đỏ', 0, '', '2020-12-29 10:14:29', '2020-12-29 10:14:29'),
(10, 'Bàn giao nhà', 0, '', '2020-12-30 02:35:28', '2020-12-30 02:35:28'),
(11, 'Hợp đồng góp vốn lô xây thô', 0, 'h1', '2021-03-06 00:18:31', '2021-03-06 00:18:31'),
(12, 'Hợp đồng góp vốn lô không xây thô', 0, 'l1', '2021-03-06 00:18:53', '2021-03-06 00:18:53'),
(13, 'Hợp đồng chuyển nhượng quyền sử dụng đất nền', 0, 'l2', '2021-03-06 00:19:21', '2021-03-06 00:19:21'),
(14, 'Hợp đồng mua bán nhà ở', 0, 'h2', '2021-03-06 00:19:43', '2021-03-06 00:19:43'),
(15, 'Phiếu cọc', 1, 'c1', '2021-03-24 07:26:20', '2021-03-24 07:26:20'),
(16, 'Biên nhận đặt cọc', 1, NULL, '2021-03-24 07:28:21', '2021-03-24 07:28:21'),
(17, 'Phiếu thu', 0, NULL, '2021-04-02 02:44:52', '2021-04-02 02:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `step`
--

CREATE TABLE `step` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `legal` text COLLATE utf8_unicode_ci,
  `urlfull` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urlnonfull` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Triển khai',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `step`
--

INSERT INTO `step` (`id`, `state`, `name`, `des`, `legal`, `urlfull`, `urlnonfull`, `action`, `created_at`, `updated_at`) VALUES
(1, 0, 'Chuẩn bị đầu tư', NULL, NULL, '', NULL, 'Hoàn thành', '2020-12-28 07:05:16', '2020-12-28 07:05:16'),
(2, 0, 'Đầu tư', '', NULL, '', NULL, 'Hoàn thành', '2020-12-28 07:05:16', '2020-12-28 07:05:16'),
(3, 0, 'Kết thúc đầu tư, bàn giao ', '', NULL, '', NULL, 'Hoàn thành', '2020-12-28 07:05:39', '2020-12-28 07:05:39'),
(4, 0, 'Đặt cọc', '<p><strong><span style=\"font-size: 22px;\">Luật tham chiếu </span></strong></p>\n<ul>\n    <li> <span style=\"font-size: 18px;\">Văn bản 153/BXD-QLN ng&agrave;y 05/7/2019 của Bộ X&acirc;y Dựng trả lời Sở X&acirc;y Dựng&nbsp;</span></li>\n    <li><span style=\"font-size: 18px;\">Bản &aacute;n số 210/2017/DS-PT ng&agrave;y 01/12/2017 của t&ograve;a &aacute;n nh&acirc;n d&acirc;n tỉnh H&agrave; Nội</span></li>\n    <li><span style=\"font-size: 18px;\">Điều 328.1 BLDS 2015</span></li>\n    <li><span style=\"font-size: 18px;\">Điều 8.5 Luật KDBĐS 2014</span></li>\n    <li><span style=\"font-size: 18px;\">Án lệ số 25/2018/AL</span></li>\n</ul>', '<p><strong><span style=\"font-size: 22px;\">Giải th&iacute;ch cơ sở ph&aacute;p l&yacute;:</span></strong></p>\n<p><span style=\"font-size: 18px;\">Trước đ&acirc;y, c&aacute;c DN kinh doanh BĐS thường sử dụng hợp đồng g&oacute;p vốn, hợp t&aacute;c kinh doanh, ..., để huy động động vốn từ kh&aacute;ch h&agrave;ng v&agrave; cho ph&eacute;p kh&aacute;ch đặt chỗ sớm. Cơ sở ph&aacute;p l&yacute; cho việc huy động vốn tr&ecirc;n quy định tại khoản 3 điều 19 nghị định 99/2015/NĐ-CP. Theo đ&oacute; sau khi đ&aacute;p ứng c&aacute;c quy dịnh tại điều 19 v&agrave; c&oacute; th&ocirc;ng b&aacute;o đủ điều kiện được huy động vốn của Sở X&acirc;y Dựng nơi c&oacute; dự &aacute;n, th&igrave; chủ đầu tư mới được ph&eacute;p huy động vốn. Tuy nhi&ecirc;n theo khoản 2 điều 19. B&ecirc;n tham gia g&oacute;p vốn, hợp t&aacute;c đầu tư, hợp t&aacute;c kinh doanh, li&ecirc;n doanh, li&ecirc;n kết quy định tại điểm n&agrave;y chỉ được ph&acirc;n chia lợi nhuận bằng tiền v&agrave; cổ phiếu; kh&ocirc;ng được &aacute;p dụng h&igrave;nh thức huy động vốn tại điểm n&agrave;y hoặc c&aacute;c h&igrave;nh thức huy động vốn kh&aacute;c để ph&acirc;n chia sản phẩm l&agrave; nh&agrave; ở hoặc để ưu ti&ecirc;n đang k&yacute;, đặt cọc .. Ph&acirc;n chia quyền sử dụng đất trong dự &aacute;n cho b&ecirc;n huy dộng vốn.</span></p>\n<p><span style=\"font-size: 22px;\"><span style=\"color: rgb(184, 49, 47);\"><strong>Trong vụ Sun Bay Park Hotel, chủ đầu tư đ&atilde; lobby Bộ X&acirc;y Dựng để ra văn bản 153/BCS/QLN ng&agrave;y 05/7/2019 theo đ&oacute;:</strong></span></span></p>\n<ol>\n    <li><span style=\"font-size: 18px;\">L&uacute;c n&agrave;y chủ đầu tư Sunbay mới đủ 2 điều kiện: l&agrave; chủ đầu tư dự &aacute;n v&agrave; đ&atilde; được UBND tỉnh ph&ecirc; duyệt QĐ 1/500.</span></li>\n    <li><span style=\"font-size: 18px;\">Theo &yacute; kiến BXD: nếu mục đ&iacute;ch của việc đặt cọc chỉ l&agrave; để đảm bảo giao kết hoặc thực hiện hợp đồng mua b&aacute;n c&aacute;c sản phẩm l&agrave; BĐS (sau khi c&aacute;c sản phẩm n&agrave;y đủ điều kiện được mua b&aacute;n theo quy định của ph&aacute;p luật sẽ được chủ đầu tư v&agrave; b&ecirc;n mua k&yacute; kết; chủ đầu tư cam kết kh&ocirc;ng sử dụng tiền thỏa thuận đặt cọc sai mục đ&iacute;c; kh&ocirc;ng sử dụng tiền đặt cọc để huy động vốn (theo điều 19 nghị định 99) th&igrave; kh&ocirc;ng bị cấm theo quy định của ph&aacute;p luật.</span></li>\n    <li><span style=\"font-size: 18px;\">Ph&aacute;p luật về d&acirc;n sự v&agrave; ph&aacute;p luật về nh&agrave; ở kh&ocirc;ng c&oacute; quy định bắt buộc c&aacute;c tổ chức, c&aacute; nh&acirc;n phải xin &yacute; kiến thống nhất của cơ quan nh&agrave; nước khi thực hiện việc đặt cọc theo đ&uacute;ng quy định của ph&aacute;p lu&acirc;t.</span></li>\n    <li><span style=\"font-size: 18px;\">&Yacute; kiến tr&ecirc;n của Bộ X&acirc;y Dựng được ủng hộ v&agrave; củng cố bởi bản &aacute;n 210/2017/DS-PT, theo đ&oacute; T&ograve;a H&agrave; Nội cho rằng khoản tiền đặt cọc kh&ocirc;ng phải huy động vốn x&acirc;y dựng v&agrave; hiện tại ph&aacute;p luật kh&ocirc;ng cấm việc k&yacute; thỏa thuận đặt cọc n&agrave;y.</span></li>\n</ol>\n<p><span style=\"font-size: 22px;\"><strong>Kết luận:</strong></span></p>\n<p><span style=\"font-size: 18px;\">Sử dụng hợp đồng &nbsp;đặt cọc nhằm mục đ&iacute;ch giao kết v&agrave; thực hiện hợp đồng chuyển nhượng gi&uacute;p chủ đầu tư chủ động trong việc k&yacute; kết hợp đồng đặt cọc với kh&aacute;ch h&agrave;ng; kh&ocirc;ng phải đợi th&ocirc;ng b&aacute;o từ Sở x&acirc;y dựng &nbsp;như huy động vốn; tỷ lệ đặt cọc kh&ocirc;ng bị giới hạn.</span></p>\n<ul>\n    <li><span style=\"font-size: 18px;\">Kh&aacute;ch h&agrave;ng cảm thấy y&ecirc;n t&acirc;m v&igrave; đ&atilde; được đặt cọc.</span></li>\n    <li><span style=\"font-size: 18px;\">Tuy nhi&ecirc;n c&oacute; vấn đề cần phải lưu &yacute; v&igrave; thời điểm ph&ecirc; duyệt 1/500 vẫn chưa biết được phần diện t&iacute;ch n&agrave;o phải x&acirc;y dựng, phần diện t&iacute;ch n&agrave;o được chuyển nhượng cho kh&aacute;ch được tự x&acirc;y n&ecirc;n cần phải lưu &yacute; kh&aacute;ch v&agrave; quy định r&otilde; trong hợp đồng.</span></li>\n    <li><span style=\"font-size: 18px;\">Chủ đầu tư đưa ra một mốc cụ thể hiến h&agrave;nh hợp đồng chuyển nhượng.</span></li>\n</ul>', '', NULL, 'Tiến hành đặt cọc', '2020-12-28 15:51:07', '2020-12-28 15:51:07'),
(5, 0, 'Ký hợp đồng mua bán', '<p><strong>Luật tham chiếu</strong></p>\r\n\r\n<ul>\r\n	<li>Điều 139, nghị định 2017/NĐ-CP</li>\r\n</ul>', NULL, '', NULL, 'Triển khai', '2020-12-28 15:51:07', '2020-12-28 15:51:07'),
(6, 0, 'Thanh lý hợp đồng', '<p><strong><span style=\"font-size: 22px;\">Luật tham chiếu </span></strong></p> <ul>     <li><span style=\"font-size: 18px;\">Điều 9, luật kinh doanh bất động sản/2011</span></li>     <li><span style=\"font-size: 18px;\">Điều 72, nghị định 43/2014/NĐ-CP</span></li>     <li><span style=\"font-size: 18px;\">Nghị định 01/2017/NĐ-CP</span></li> </ul> <p><br></p>', NULL, '', NULL, '', '2020-12-28 15:52:25', '2020-12-28 15:52:25'),
(7, 0, 'Hiện thị pháp lý bán hàng', '1', NULL, NULL, NULL, '', '2021-01-02 08:27:49', '2021-01-02 08:27:49'),
(8, 0, 'giấy đăng ký kinh doanh', NULL, NULL, NULL, NULL, 'cấp giấy đăng ký kinh doanh', '2021-03-09 08:54:01', '2021-03-09 08:54:01'),
(9, 0, 'mẫu dấu', NULL, NULL, NULL, NULL, 'cấp mẫu dấu', '2021-03-09 08:54:48', '2021-03-09 08:54:48'),
(10, 0, 'Điều lệ', NULL, NULL, NULL, NULL, 'điều lệ', '2021-03-09 08:55:07', '2021-03-09 08:55:07'),
(11, 0, 'Nội quy lao động', NULL, NULL, NULL, NULL, 'nội quy lao động', '2021-03-09 08:55:33', '2021-03-09 08:55:33'),
(12, 0, 'Hồ sơ năng lực công ty', NULL, NULL, NULL, NULL, 'Hồ sơ năng lực công ty', '2021-03-09 08:58:58', '2021-03-09 08:58:58'),
(13, 0, 'quy chế tiền lương', NULL, NULL, NULL, NULL, 'quy chế tiền lương', '2021-03-09 09:02:17', '2021-03-09 09:02:17'),
(14, 0, 'quy chế tài chính', NULL, NULL, NULL, NULL, 'quy chế tài chính', '2021-03-09 09:02:29', '2021-03-09 09:02:29'),
(15, 0, 'quyết định thành lập ban quản lý dự án xuân an 1', NULL, NULL, NULL, NULL, 'quyết định thành lập ban quản lý dự án xuân an 1', '2021-03-09 09:02:55', '2021-03-09 09:02:55'),
(16, 0, 'giai đoạn đầu tư ', NULL, NULL, NULL, NULL, 'xây dựng, bán hàng', '2021-03-09 10:10:07', '2021-03-09 10:10:07'),
(17, 0, 'kết thúc đầu tư, bàn giao ', NULL, NULL, NULL, NULL, 'kết thúc đầu tư, bàn giao hòa bình 1', '2021-03-09 10:35:50', '2021-03-09 10:35:50'),
(18, 2, 'Chuẩn bị đầu tư', NULL, NULL, NULL, NULL, 'Triển khai', '2021-03-09 13:12:50', '2021-03-09 13:12:50'),
(19, 0, 'Khảo sát, thiết kê', NULL, NULL, NULL, NULL, 'Triển khai', '2021-03-09 13:13:27', '2021-03-09 13:13:27'),
(20, 0, 'Thi công và nghiêm thu', NULL, NULL, NULL, NULL, 'Triển khai', '2021-03-09 13:13:45', '2021-03-09 13:13:45'),
(21, 0, 'xin khảo sát thực địa', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-12 10:10:42', '2021-03-12 10:10:42'),
(22, 0, 'chuẩn bị đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-12 10:15:07', '2021-03-12 10:15:07'),
(23, 0, 'đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-12 10:26:02', '2021-03-12 10:26:02'),
(24, 0, 'kết thúc và bàn giao', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-12 10:26:22', '2021-03-12 10:26:22'),
(25, 0, 'chuẩn bị đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-17 08:18:04', '2021-03-17 08:18:04'),
(26, 0, 'đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-17 08:18:15', '2021-03-17 08:18:15'),
(27, 0, 'kết thúc và bàn giao', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-17 08:18:23', '2021-03-17 08:18:23'),
(28, 0, '1', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-24 02:53:26', '2021-03-24 02:53:26'),
(29, 0, 'chuẩn bị đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-24 07:13:04', '2021-03-24 07:13:04'),
(30, 0, 'đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-24 07:13:08', '2021-03-24 07:13:08'),
(31, 0, 'kết thúc và bàn giao', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-24 07:13:13', '2021-03-24 07:13:13'),
(32, 0, 'chuẩn bị đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-24 07:46:05', '2021-03-24 07:46:05'),
(33, 0, 'đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-24 07:46:09', '2021-03-24 07:46:09'),
(34, 0, 'kết thúc và bàn giao', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-03-24 07:46:12', '2021-03-24 07:46:12'),
(35, 0, 'chuẩn bị đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 02:23:17', '2021-10-05 02:23:17'),
(36, 0, 'đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 02:23:26', '2021-10-05 02:23:26'),
(37, 0, 'kết thúc và bàn giao', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 02:23:36', '2021-10-05 02:23:36'),
(38, 0, 'I - Chuẩn bị đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 02:24:57', '2021-10-05 02:24:57'),
(39, 0, 'Chuẩn bị đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 04:10:42', '2021-10-05 04:10:42'),
(40, 0, 'Đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 04:10:48', '2021-10-05 04:10:48'),
(41, 0, 'Kết thúc và bàn giao', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 04:11:00', '2021-10-05 04:11:00'),
(42, 0, 'chuẩn bị đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 13:09:41', '2021-10-05 13:09:41'),
(43, 0, 'đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 13:09:47', '2021-10-05 13:09:47'),
(44, 0, 'kết thúc và bàn giao', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 13:10:00', '2021-10-05 13:10:00'),
(45, 0, 'Chuẩn bị đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 13:33:08', '2021-10-05 13:33:08'),
(46, 0, 'Đầu tư', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 13:38:10', '2021-10-05 13:38:10'),
(47, 0, 'Kết thúc và bàn giao', 'Bước tự động', NULL, '', '', 'Triển khai', '2021-10-05 13:38:22', '2021-10-05 13:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `step_process`
--

CREATE TABLE `step_process` (
  `id` int(11) NOT NULL,
  `process_id` int(3) NOT NULL,
  `process_step` int(3) NOT NULL,
  `step_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `legal` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `step_task`
--

CREATE TABLE `step_task` (
  `id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `pos` int(5) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `step_task`
--

INSERT INTO `step_task` (`id`, `step_id`, `task_id`, `pos`, `created_at`, `updated_at`) VALUES
(1, 4, 10, 0, '2020-12-28 15:56:03', '2020-12-28 15:56:03'),
(2, 4, 12, 0, '2020-12-28 15:56:03', '2020-12-28 15:56:03'),
(3, 7, 12, 0, '2021-01-02 08:31:25', '2021-01-02 08:31:25'),
(4, 7, 10, 0, '2021-01-02 08:31:25', '2021-01-02 08:31:25'),
(5, 7, 24, 0, '2021-01-02 08:37:05', '2021-01-02 08:37:05'),
(6, 7, 17, 0, '2021-01-02 08:37:05', '2021-01-02 08:37:05'),
(7, 7, 15, 0, '2021-01-02 08:39:40', '2021-01-02 08:39:40'),
(8, 7, 13, 0, '2021-01-02 08:39:40', '2021-01-02 08:39:40'),
(9, 7, 21, 0, '2021-01-02 08:40:48', '2021-01-02 08:40:48'),
(13, 1, 1, 1, '2021-03-09 09:12:17', '2021-03-09 09:12:17'),
(14, 1, 2, 2, '2021-03-09 09:14:22', '2021-03-09 09:14:22'),
(15, 1, 3, 3, '2021-03-09 09:15:08', '2021-03-09 09:15:08'),
(16, 1, 4, 4, '2021-03-09 09:15:11', '2021-03-09 09:15:11'),
(17, 1, 6, 5, '2021-03-09 09:15:16', '2021-03-09 09:15:16'),
(18, 1, 7, 6, '2021-03-09 09:15:26', '2021-03-09 09:15:26'),
(19, 1, 8, 6, '2021-03-09 09:15:35', '2021-03-09 09:15:35'),
(21, 1, 10, 8, '2021-03-09 09:15:46', '2021-03-09 09:15:46'),
(22, 1, 11, 9, '2021-03-09 09:15:57', '2021-03-09 09:15:57'),
(23, 1, 12, 10, '2021-03-09 09:16:05', '2021-03-09 09:16:05'),
(24, 1, 13, 11, '2021-03-09 09:16:10', '2021-03-09 09:16:10'),
(25, 16, 25, 1, '2021-03-09 10:22:08', '2021-03-09 10:22:08'),
(26, 16, 26, 2, '2021-03-09 10:22:30', '2021-03-09 10:22:30'),
(27, 16, 27, 3, '2021-03-09 10:23:51', '2021-03-09 10:23:51'),
(28, 16, 28, 4, '2021-03-09 10:24:18', '2021-03-09 10:24:18'),
(29, 16, 29, 5, '2021-03-09 10:24:30', '2021-03-09 10:24:30'),
(30, 16, 30, 6, '2021-03-09 10:24:59', '2021-03-09 10:24:59'),
(31, 16, 31, 7, '2021-03-09 10:26:32', '2021-03-09 10:26:32'),
(32, 16, 32, 8, '2021-03-09 10:26:41', '2021-03-09 10:26:41'),
(33, 16, 35, 9, '2021-03-09 10:31:50', '2021-03-09 10:31:50'),
(34, 16, 36, 10, '2021-03-09 10:31:58', '2021-03-09 10:31:58'),
(35, 16, 37, 11, '2021-03-09 10:32:06', '2021-03-09 10:32:06'),
(36, 16, 33, 12, '2021-03-09 10:32:17', '2021-03-09 10:32:17'),
(37, 16, 34, 13, '2021-03-09 10:32:27', '2021-03-09 10:32:27'),
(38, 18, 38, 1, '2021-03-09 13:23:49', '2021-03-09 13:23:49'),
(39, 18, 40, 4, '2021-03-09 13:24:00', '2021-03-09 13:24:00'),
(40, 18, 39, 2, '2021-03-09 13:24:26', '2021-03-09 13:24:26'),
(41, 18, 41, 3, '2021-03-09 13:24:52', '2021-03-09 13:24:52'),
(42, 18, 42, 5, '2021-03-09 13:25:02', '2021-03-09 13:25:02'),
(43, 18, 43, 6, '2021-03-09 13:25:11', '2021-03-09 13:25:11'),
(44, 18, 44, 7, '2021-03-09 13:25:20', '2021-03-09 13:25:20'),
(45, 18, 45, 8, '2021-03-09 13:25:25', '2021-03-09 13:25:25'),
(46, 19, 46, 1, '2021-03-09 13:29:32', '2021-03-09 13:29:32'),
(47, 19, 49, 2, '2021-03-09 13:29:50', '2021-03-09 13:29:50'),
(48, 19, 47, 3, '2021-03-09 13:29:58', '2021-03-09 13:29:58'),
(50, 19, 48, 4, '2021-03-09 13:30:23', '2021-03-09 13:30:23'),
(51, 20, 49, 1, '2021-03-09 13:31:35', '2021-03-09 13:31:35'),
(52, 20, 50, 2, '2021-03-09 13:31:55', '2021-03-09 13:31:55'),
(53, 20, 47, 3, '2021-03-09 13:32:03', '2021-03-09 13:32:03'),
(54, 20, 48, 4, '2021-03-09 13:32:09', '2021-03-09 13:32:09'),
(55, 20, 51, 5, '2021-03-09 13:32:16', '2021-03-09 13:32:16'),
(56, 20, 52, 6, '2021-03-09 13:32:25', '2021-03-09 13:32:25'),
(57, 20, 53, 7, '2021-03-09 13:32:33', '2021-03-09 13:32:33'),
(58, 20, 1, 8, '2021-03-09 13:32:53', '2021-03-09 13:32:53'),
(59, 20, 54, 8, '2021-03-09 13:33:06', '2021-03-09 13:33:06'),
(60, 20, 55, 9, '2021-03-09 13:33:17', '2021-03-09 13:33:17'),
(61, 20, 56, 9, '2021-03-09 13:33:26', '2021-03-09 13:33:26'),
(62, 20, 57, 9, '2021-03-09 13:33:35', '2021-03-09 13:33:35'),
(64, 21, 59, 1, '2021-03-12 10:11:45', '2021-03-12 10:11:45'),
(65, 21, 60, 2, '2021-03-12 10:13:31', '2021-03-12 10:13:31'),
(68, 22, 63, 1, '2021-03-12 10:27:03', '2021-03-12 10:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `substep`
--

CREATE TABLE `substep` (
  `id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `legal` text COLLATE utf8_unicode_ci,
  `urlfull` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urlnonfull` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pos` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `substep`
--

INSERT INTO `substep` (`id`, `step_id`, `state`, `name`, `des`, `legal`, `urlfull`, `urlnonfull`, `pos`, `created_at`, `updated_at`) VALUES
(11, 2, 0, 'Thực hiện Dự án đầu tư ', NULL, NULL, NULL, NULL, 0, '2020-12-28 07:11:59', '2020-12-28 07:11:59'),
(12, 2, 0, 'Xin phép xây dựng ( nếu có)', NULL, NULL, NULL, NULL, 0, '2020-12-28 07:11:59', '2020-12-28 07:11:59'),
(13, 2, 0, 'Tổ chức thi công hạ tầng kỹ thuật', NULL, NULL, NULL, NULL, 0, '2020-12-28 07:12:06', '2020-12-28 07:12:06'),
(15, 5, 0, 'Phân lô bán nền', '<p><strong><span style=\"font-size: 22px;\">Luật tham chiếu</span></strong></p>\n<ul>\n    <li><span style=\"font-size: 18px;\">Điều 41, nghị định 43/2014/NĐ-CP</span></li>\n    <li><span style=\"font-size: 18px;\">Nghị định 91/2019/NĐ-CP</span></li>\n    <li><span style=\"font-size: 18px;\">Điều 4, nghị định 11/2013/NĐ-CP</span></li>\n    <li><span style=\"font-size: 18px;\">Điều 11, th&ocirc;ng tư 10/2013/TTLT-BXD-BNV</span></li>\n</ul>', NULL, '/files/system/2.png', '/files/system/3.png', 0, '2020-12-28 15:57:34', '2020-12-28 15:57:34'),
(16, 5, 0, 'Nhà ở hình thành trong tương lai', '<p><span style=\"font-size: 22px;\"><strong>Luật tham chiếu</strong></span></p> <ul>     <li><span style=\"font-size: 18px;\">Điều 139, nghị định 2017/NĐ-CP</span></li> </ul>', NULL, '/files/system/4.png', NULL, 0, '2020-12-28 15:57:34', '2020-12-28 15:57:34'),
(17, 5, 0, 'Nhà ở riêng lẻ trên đất', '<p><strong><span style=\"font-size: 22px;\">Luật tham chiếu </span></strong></p> <ul>     <li><span style=\"font-size: 18px;\">Điều 9, luật kinh doanh bất động sản/2011</span></li>     <li><span style=\"font-size: 18px;\">Điều 72, nghị định 43/2014/NĐ-CP</span></li>     <li><span style=\"font-size: 18px;\">Nghị định 01/2017/NĐ-CP</span></li> </ul> <p><br></p>', NULL, '/files/system/5.png', NULL, 0, '2020-12-28 15:58:34', '2020-12-28 15:58:34'),
(18, 25, 2, 'xin khảo sát ngoài thực địa', NULL, NULL, NULL, NULL, 1, '2021-03-17 08:18:55', '2021-03-17 08:18:55'),
(19, 25, 2, 'lập quy hoạch chi tiết 1/500', NULL, NULL, NULL, NULL, 2, '2021-03-17 08:19:33', '2021-03-17 08:19:33'),
(20, 25, 2, 'xin chấp thuận chủ trương đầu tư', NULL, NULL, NULL, NULL, 3, '2021-03-17 08:19:50', '2021-03-17 08:19:50'),
(21, 25, 2, 'XIn chuyển đổi mục đích sử dụng đất lúa', NULL, NULL, NULL, NULL, 4, '2021-03-17 08:40:25', '2021-03-17 08:40:25'),
(25, 26, 2, 'đền bù giải phóng mặt bằng (GĐ1+GĐ2)', NULL, NULL, NULL, NULL, 1, '2021-03-17 08:43:36', '2021-03-17 08:43:36'),
(26, 26, 2, 'di dời đường điện tạm thời để phục vụ dự án (phát sinh)', NULL, NULL, NULL, NULL, 2, '2021-03-17 08:43:44', '2021-03-17 08:43:44'),
(27, 26, 2, 'xin đấu nối dường tạm thời để phục vụ thi công', NULL, NULL, NULL, NULL, 2, '2021-03-17 08:43:54', '2021-03-17 08:43:54'),
(28, 26, 2, 'xin phép PCCC', NULL, NULL, NULL, NULL, 2, '2021-03-17 08:44:19', '2021-03-17 08:44:19'),
(29, 26, 2, 'bàn giao đất thực hiện dự án đợt 1', NULL, NULL, NULL, NULL, 3, '2021-03-17 09:04:48', '2021-03-17 09:04:48'),
(30, 26, 2, 'Đề nghị sở xây dựng thông báo đủ điều kiện huy động vốn phát triển hạ tầng dự án', NULL, NULL, NULL, NULL, 4, '2021-03-17 09:41:08', '2021-03-17 09:41:08'),
(31, 26, 2, 'xin phép xây dựng hạ tầng kỹ thuật (giao thông; điện; nước; etc.)', NULL, NULL, NULL, NULL, 4, '2021-03-17 09:42:01', '2021-03-17 09:42:01'),
(32, 26, 2, 'tính tiền sử dụng đất nộp cho nhà nước', NULL, NULL, NULL, NULL, 5, '2021-03-17 09:53:37', '2021-03-17 09:53:37'),
(33, 26, 2, 'cấp giấy chứng nhận QSDĐ cho CĐT', NULL, NULL, NULL, NULL, 6, '2021-03-17 10:02:05', '2021-03-17 10:02:05'),
(34, 26, 2, 'xin phép bán nhà ở hình thành trong tương lai', NULL, NULL, NULL, NULL, 7, '2021-03-17 10:07:53', '2021-03-17 10:07:53'),
(35, 26, 2, 'xin phép phân lô bán nền', NULL, NULL, NULL, NULL, 7, '2021-03-17 10:08:11', '2021-03-17 10:08:11'),
(36, 26, 2, 'xin giấy phép xả thải (tùy dự án)', NULL, NULL, NULL, NULL, 7, '2021-03-17 10:10:01', '2021-03-17 10:10:01'),
(37, 26, 2, 'xin giấy phép xây dựng nhà ở thấp tầng', NULL, NULL, NULL, NULL, 7, '2021-03-17 10:10:42', '2021-03-17 10:10:42'),
(38, 26, 2, 'xin phép xây dựng trung tâm thương mại', NULL, NULL, NULL, NULL, 7, '2021-03-17 10:24:44', '2021-03-17 10:24:44'),
(39, 26, 2, 'Nghiệm thu PCCC', NULL, NULL, NULL, NULL, 8, '2021-03-17 10:25:21', '2021-03-17 10:25:21'),
(40, 26, 2, 'cấp giấy chứng nhận quyền sử dụng đất và quyền sở hữu nhà cho CĐT', NULL, NULL, NULL, NULL, 9, '2021-03-17 10:28:41', '2021-03-17 10:28:41'),
(41, 27, 0, 'bàn giao lại cơ sở hạ tầng cho UBND quản lý', NULL, NULL, NULL, NULL, 1, '2021-03-17 10:30:04', '2021-03-17 10:30:04'),
(42, 27, 0, 'quyết toán thuế', NULL, NULL, NULL, NULL, 2, '2021-03-17 10:30:17', '2021-03-17 10:30:17'),
(43, 26, 2, 'ban hành quy định quản lý khu đô thị theo đồ án đã điều chỉnh quy hoạch 1/500', NULL, NULL, NULL, NULL, 8, '2021-03-17 10:37:54', '2021-03-17 10:37:54'),
(44, 29, 0, 'xin khảo sát, lập quy hoạch chi tiết 1/500; 1/2000', '<p>Do quyết định ph&ecirc; duyệt chủ trương cũ của UBND tỉnh kh&ocirc;ng c&oacute; ph&acirc;n kỳ giai đoạn m&agrave; chỉ chấp thuận chủ trương để CĐT thực hiện GĐ1 n&ecirc;n đến GĐ 2 cần đấu thầu, thực hiện lại thủ tục</p>', NULL, NULL, NULL, 1, '2021-03-24 07:15:11', '2021-03-24 07:15:11'),
(45, 29, 0, 'đấu thầu lựa chọn CĐT', NULL, NULL, NULL, NULL, 2, '2021-03-24 07:16:01', '2021-03-24 07:16:01'),
(46, 29, 0, 'đền bù giải phóng mặt bằng', NULL, NULL, NULL, NULL, 3, '2021-03-24 07:16:20', '2021-03-24 07:16:20'),
(47, 29, 0, 'xin chuyển đổi mục đích sử dụng đất trồng rừng', NULL, NULL, NULL, NULL, 4, '2021-03-24 07:16:53', '2021-03-24 07:16:53'),
(48, 30, 0, 'đền bù giải phóng mặt bằng', NULL, NULL, NULL, NULL, 1, '2021-03-24 07:17:27', '2021-03-24 07:17:27'),
(49, 30, 0, 'bàn giao đất thực hiện dự án', NULL, NULL, NULL, NULL, 2, '2021-03-24 07:17:48', '2021-03-24 07:17:48'),
(50, 30, 0, 'Đề nghị sở xây dựng thông báo đủ điều kiện huy động vốn phát triển hạ tầng dự án', NULL, NULL, NULL, NULL, 3, '2021-03-24 07:18:19', '2021-03-24 07:18:19'),
(51, 30, 0, 'xin phép xây dựng hạ tầng kỹ thuật (giao thông; điện; nước; etc.)', NULL, NULL, NULL, NULL, 4, '2021-03-24 07:18:58', '2021-03-24 07:18:58'),
(52, 30, 0, 'tính tiền sử dụng đất nộp cho nhà nước', NULL, NULL, NULL, NULL, 5, '2021-03-24 07:19:26', '2021-03-24 07:19:26'),
(53, 30, 0, 'cấp giấy chứng nhận qsdđ cho CĐT', NULL, NULL, NULL, NULL, 6, '2021-03-24 07:19:52', '2021-03-24 07:19:52'),
(54, 30, 0, 'giấy phép xả thải', NULL, NULL, NULL, NULL, 7, '2021-03-24 07:20:25', '2021-03-24 07:20:25'),
(55, 30, 0, 'giấy phép phòng cháy chữa cháy', NULL, NULL, NULL, NULL, 7, '2021-03-24 07:20:37', '2021-03-24 07:20:37'),
(56, 30, 0, 'đấu nối nguồn điện', NULL, NULL, NULL, NULL, 7, '2021-03-24 07:20:49', '2021-03-24 07:20:49'),
(57, 30, 0, 'đấu nối nguồn nước', NULL, NULL, NULL, NULL, 7, '2021-03-24 07:20:59', '2021-03-24 07:20:59'),
(58, 30, 0, 'xin phép bán nhà ở hình thành trong tương lai', NULL, NULL, NULL, NULL, 8, '2021-03-24 07:21:44', '2021-03-24 07:21:44'),
(59, 30, 0, 'xin phép phân lô bán nền', NULL, NULL, NULL, NULL, 8, '2021-03-24 07:21:58', '2021-03-24 07:21:58'),
(60, 30, 0, 'xin phép xây dựng nhà ở', NULL, NULL, NULL, NULL, 8, '2021-03-24 07:22:13', '2021-03-24 07:22:13'),
(61, 30, 0, 'xin phép xây TTTM', NULL, NULL, NULL, NULL, 8, '2021-03-24 07:22:37', '2021-03-24 07:22:37'),
(62, 30, 0, 'xin phép xây dựng Chung cư', NULL, NULL, NULL, NULL, 8, '2021-03-24 07:22:51', '2021-03-24 07:22:51'),
(63, 30, 0, 'cấp giấy chứng nhận quyền sử dụng đất và quyền sở hữu nhà cho CĐT', NULL, NULL, NULL, NULL, 9, '2021-03-24 07:23:16', '2021-03-24 07:23:16'),
(64, 31, 0, 'bàn giao lại cơ sở hạ tầng cho UBND quản lý', NULL, NULL, NULL, NULL, 1, '2021-03-24 07:23:33', '2021-03-24 07:23:33'),
(65, 31, 0, 'quyết toán thuế', NULL, NULL, NULL, NULL, 2, '2021-03-24 07:23:41', '2021-03-24 07:23:41'),
(69, 32, 2, 'xin khảo sát ngoài thực địa', NULL, NULL, NULL, NULL, 1, '2021-03-24 07:56:27', '2021-03-24 07:56:27'),
(70, 32, 2, 'xin lập quy hoạch chi tiết 1/500', NULL, NULL, NULL, NULL, 2, '2021-03-24 07:56:45', '2021-03-24 07:56:45'),
(71, 32, 0, 'đấu thầu lựa chọn CĐT', NULL, NULL, NULL, NULL, 3, '2021-03-24 07:57:02', '2021-03-24 07:57:02'),
(72, 32, 0, 'xin chuyển đổi mục đích sử dụng đất trồng rừng', NULL, NULL, NULL, NULL, 4, '2021-03-24 07:57:32', '2021-03-24 07:57:32'),
(75, 39, 0, '1. Khảo sát và quy hoạch 1/2000', NULL, NULL, NULL, NULL, 1, '2021-10-05 04:11:49', '2021-10-05 04:11:49'),
(76, 39, 0, '2. Lựa chọn nhà đầu tư', NULL, NULL, NULL, NULL, 2, '2021-10-05 04:14:22', '2021-10-05 04:14:22'),
(78, 35, 2, 'Khảo sát', NULL, NULL, NULL, NULL, 1, '2021-10-05 05:09:47', '2021-10-05 05:09:47'),
(79, 35, 2, 'lập quy hoạch 1/2000', NULL, NULL, NULL, NULL, 2, '2021-10-05 05:10:30', '2021-10-05 05:10:30'),
(80, 35, 2, 'xin chấp thuận chủ trương đầu tư', NULL, NULL, NULL, NULL, 3, '2021-10-05 05:11:36', '2021-10-05 05:11:36'),
(81, 35, 2, 'lập quy hoạch 1/500', NULL, NULL, NULL, NULL, 5, '2021-10-05 05:11:55', '2021-10-05 05:11:55'),
(82, 36, 0, 'đền bù giải phóng mặt bằng', NULL, NULL, NULL, NULL, 1, '2021-10-05 05:14:14', '2021-10-05 05:14:14'),
(83, 36, 0, 'Bàn giao mặt bằng và tính tiền thuê đất', NULL, NULL, NULL, NULL, 2, '2021-10-05 05:14:57', '2021-10-05 05:14:57'),
(84, 36, 0, 'cấp sổ đỏ cho chủ đầu tư', NULL, NULL, NULL, NULL, 3, '2021-10-05 05:19:20', '2021-10-05 05:19:20'),
(85, 36, 0, 'xin giấy phép xây dựng hạ tầng, nước, điện etc.', NULL, NULL, NULL, NULL, 4, '2021-10-05 05:20:00', '2021-10-05 05:20:00'),
(86, 36, 0, 'xin giấy phép khai thác nước ngầm', NULL, NULL, NULL, NULL, 5, '2021-10-05 05:20:22', '2021-10-05 05:20:22'),
(87, 37, 0, 'bàn giao', NULL, NULL, NULL, NULL, 1, '2021-10-05 05:20:49', '2021-10-05 05:20:49'),
(88, 37, 0, 'quyết toán', NULL, NULL, NULL, NULL, 2, '2021-10-05 05:21:08', '2021-10-05 05:21:08'),
(89, 35, 0, 'ký quỹ đảm bảo thực hiện dự án', NULL, NULL, NULL, NULL, 4, '2021-10-05 07:48:32', '2021-10-05 07:48:32'),
(90, 40, 0, '1. Đền bù và giải phóng mặt bằng', NULL, NULL, NULL, NULL, 1, '2021-10-05 08:39:52', '2021-10-05 08:39:52'),
(91, 39, 0, '3. Chấp thuận chủ trương đầu tư', '<p>điểm c Khoản &nbsp;điều 31 nghị định 31/2020 hướng dẫn luật đầu tư 2020:&nbsp;</p><p>c) Đối với quy hoạch đô thị, nội dung thẩm định phải có đánh giá về sự phù hợp của dự án đầu tư với quy hoạch chi tiết (nếu có), quy hoạch phân khu (nếu có); trường hợp quy hoạch chi tiết, quy hoạch phân khu chưa được cấp có thẩm quyền phê duyệt thì đánh giá sự phù hợp của dự án đầu tư với quy hoạch chung.</p>', NULL, NULL, NULL, 3, '2021-10-05 08:43:46', '2021-10-05 08:43:46'),
(92, 36, 0, 'đăng ký cho thuê lại (nếu để bên khác vào thuê lại xây dựng, kinh doanh dịch vụ)', NULL, NULL, NULL, NULL, 6, '2021-10-05 08:51:01', '2021-10-05 08:51:01'),
(93, 40, 0, '2. Xin đấu nối dường tạm thời để phục vụ thi công', NULL, NULL, NULL, NULL, 2, '2021-10-05 09:48:42', '2021-10-05 09:48:42'),
(94, 40, 0, '3. Bàn giao đất thực hiện dự án', NULL, NULL, NULL, NULL, 3, '2021-10-05 09:49:14', '2021-10-05 09:49:14'),
(95, 40, 0, '4. Đề nghị sở xây dựng thông báo đủ điều kiện huy động vốn phát triển hạ tầng dự án', NULL, NULL, NULL, NULL, 4, '2021-10-05 09:49:39', '2021-10-05 09:49:39'),
(96, 40, 0, '5. Xin phép xây dựng hạ tầng kỹ thuật (giao thông; điện; nước; etc.)', NULL, NULL, NULL, NULL, 5, '2021-10-05 09:50:25', '2021-10-05 09:50:25'),
(97, 40, 0, '6. Tính tiền sử dụng đất nộp cho nhà nước', NULL, NULL, NULL, NULL, 6, '2021-10-05 09:50:47', '2021-10-05 09:50:47'),
(98, 40, 0, '7. Cấp giấy chứng nhận QSDĐ cho CĐT', NULL, NULL, NULL, NULL, 7, '2021-10-05 09:51:24', '2021-10-05 09:51:24'),
(99, 40, 0, '8. Xin phép bán nhà ở hình thành trong tương lai', NULL, NULL, NULL, NULL, 8, '2021-10-05 09:51:44', '2021-10-05 09:51:44'),
(100, 40, 0, '9. Xin phép phân lô bán nền', NULL, NULL, NULL, NULL, 9, '2021-10-05 09:52:04', '2021-10-05 09:52:04'),
(101, 40, 0, '10. Xin giấy phép xả thải (tùy dự án)', NULL, NULL, NULL, NULL, 10, '2021-10-05 09:52:26', '2021-10-05 09:52:26'),
(102, 40, 0, '11. Xin giấy phép xây dựng nhà ở thấp tầng', NULL, NULL, NULL, NULL, 11, '2021-10-05 09:52:41', '2021-10-05 09:52:41'),
(103, 40, 0, '12. Xin phép xây dựng trung tâm thương mại', NULL, NULL, NULL, NULL, 12, '2021-10-05 09:52:58', '2021-10-05 09:52:58'),
(104, 40, 0, '13. Xin phép PCCC', NULL, NULL, NULL, NULL, 13, '2021-10-05 09:53:21', '2021-10-05 09:53:21'),
(105, 40, 0, '14. Nghiệm thu PCCC', NULL, NULL, NULL, NULL, 14, '2021-10-05 09:54:13', '2021-10-05 09:54:13'),
(106, 40, 0, '15. Cấp giấy chứng nhận quyền sử dụng đất và quyền sở hữu nhà cho CĐT', NULL, NULL, NULL, NULL, 15, '2021-10-05 09:54:26', '2021-10-05 09:54:26'),
(107, 40, 0, '16. Ban hành quy định quản lý khu đô thị theo đồ án đã điều chỉnh quy hoạch 1/500', NULL, NULL, NULL, NULL, 16, '2021-10-05 09:54:46', '2021-10-05 09:54:46'),
(108, 41, 0, 'Bàn giao lại cơ sở hạ tầng cho UBND quản lý', NULL, NULL, NULL, NULL, 1, '2021-10-05 09:55:34', '2021-10-05 09:55:34'),
(109, 41, 0, 'Quyết toán thuế', NULL, NULL, NULL, NULL, 2, '2021-10-05 09:55:45', '2021-10-05 09:55:45'),
(110, 39, 0, '4. Lập quy hoạch chi tiết 1/500', NULL, NULL, NULL, NULL, 4, '2021-10-05 11:11:42', '2021-10-05 11:11:42'),
(111, 42, 0, '1. Khảo sát và lập quy hoạch 1/2000', NULL, NULL, NULL, NULL, 1, '2021-10-05 13:40:44', '2021-10-05 13:40:44'),
(112, 42, 0, 'chấp thuận chủ trương đầu tư', '<p>điểm c Khoản &nbsp;điều 31 nghị định 31/2020 hướng dẫn luật đầu tư 2020:&nbsp;</p><p>c) Đối với quy hoạch đô thị, nội dung thẩm định phải có đánh giá về sự phù hợp của dự án đầu tư với quy hoạch chi tiết (nếu có), quy hoạch phân khu (nếu có); trường hợp quy hoạch chi tiết, quy hoạch phân khu chưa được cấp có thẩm quyền phê duyệt thì đánh giá sự phù hợp của dự án đầu tư với quy hoạch chung.</p>', NULL, NULL, NULL, 2, '2021-10-05 13:46:35', '2021-10-05 13:46:35'),
(113, 45, 2, '1. Xin khảo sát ngoài thực địa', NULL, NULL, NULL, NULL, 1, '2021-10-05 13:46:40', '2021-10-05 13:46:40'),
(114, 42, 0, 'đấu thầu lựa chọn CĐT', '<p>Luật đấu thầu; nghị định 25 hướng dẫn luật đấu thầu</p>', NULL, NULL, NULL, 3, '2021-10-05 13:48:16', '2021-10-05 13:48:16'),
(115, 45, 0, '2. Lập quy hoạch 1/2000', NULL, NULL, NULL, NULL, 2, '2021-10-05 13:50:28', '2021-10-05 13:50:28'),
(116, 42, 0, 'lập quy hoạch 1/500', NULL, NULL, NULL, NULL, 4, '2021-10-05 13:50:28', '2021-10-05 13:50:28'),
(117, 45, 0, '3.  Lập  quy hoạch 1/500', NULL, NULL, NULL, NULL, 3, '2021-10-05 14:10:38', '2021-10-05 14:10:38'),
(118, 45, 0, '4. Xin chấp thuận chủ trương đầu tư', NULL, NULL, NULL, NULL, 4, '2021-10-05 14:10:55', '2021-10-05 14:10:55'),
(119, 46, 0, 'đền bù giải phóng mặt bằng', NULL, NULL, NULL, NULL, 1, '2021-10-06 02:09:15', '2021-10-06 02:09:15'),
(120, 46, 0, 'xin đấu nối đường tạm thời để phục vụ thi công', NULL, NULL, NULL, NULL, 2, '2021-10-06 02:09:29', '2021-10-06 02:09:29'),
(121, 46, 0, 'bàn giao đất thực hiện dự án', NULL, NULL, NULL, NULL, 3, '2021-10-06 02:09:45', '2021-10-06 02:09:45'),
(122, 46, 0, 'Đề nghị sở xây dựng thông báo đủ điều kiện huy động vốn phát triển hạ tầng dự án', NULL, NULL, NULL, NULL, 4, '2021-10-06 02:10:04', '2021-10-06 02:10:04'),
(123, 46, 0, 'xin phép xây dựng hạ tầng kỹ thuật (giao thông; điện; nước; etc.)', NULL, NULL, NULL, NULL, 4, '2021-10-06 02:10:20', '2021-10-06 02:10:20'),
(124, 46, 0, 'tính tiền sử dụng đất nộp cho nhà nước', NULL, NULL, NULL, NULL, 5, '2021-10-06 02:10:31', '2021-10-06 02:10:31'),
(125, 46, 0, 'cấp giấy chứng nhận QSDĐ cho CĐT', NULL, NULL, NULL, NULL, 6, '2021-10-06 02:10:38', '2021-10-06 02:10:38'),
(126, 46, 0, 'xin phép bán nhà ở hình thành trong tương lai', NULL, NULL, NULL, NULL, 7, '2021-10-06 02:10:44', '2021-10-06 02:10:44'),
(127, 46, 0, 'xin phép phân lô bán nền', NULL, NULL, NULL, NULL, 7, '2021-10-06 02:10:52', '2021-10-06 02:10:52'),
(128, 46, 0, 'xin giấy phép xả thải (tùy dự án)', NULL, NULL, NULL, NULL, 7, '2021-10-06 02:11:02', '2021-10-06 02:11:02'),
(129, 46, 0, 'xin phép xây dựng trung tâm thương mại', NULL, NULL, NULL, NULL, 7, '2021-10-06 02:11:12', '2021-10-06 02:11:12'),
(130, 46, 0, 'xin phép PCCC', NULL, NULL, NULL, NULL, 8, '2021-10-06 02:11:24', '2021-10-06 02:11:24'),
(131, 46, 0, 'Nghiệm thu PCCC', NULL, NULL, NULL, NULL, 9, '2021-10-06 02:11:38', '2021-10-06 02:11:38'),
(132, 46, 0, 'cấp giấy chứng nhận quyền sử dụng đất và quyền sở hữu nhà cho CĐT', NULL, NULL, NULL, NULL, 10, '2021-10-06 02:11:54', '2021-10-06 02:11:54'),
(133, 46, 0, 'ban hành quy định quản lý khu đô thị theo đồ án đã điều chỉnh quy hoạch 1/500', NULL, NULL, NULL, NULL, 11, '2021-10-06 02:12:09', '2021-10-06 02:12:09'),
(134, 46, 0, 'xin giấy phép xây dựng nhà ở thấp tầng', NULL, NULL, NULL, NULL, 7, '2021-10-06 02:50:18', '2021-10-06 02:50:18'),
(135, 47, 0, 'Bàn giao lại cơ sở hạ tầng cho UBND quản lý', NULL, NULL, NULL, NULL, 1, '2021-10-06 02:57:40', '2021-10-06 02:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `substep_task`
--

CREATE TABLE `substep_task` (
  `id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `pos` int(5) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `substep_task`
--

INSERT INTO `substep_task` (`id`, `step_id`, `task_id`, `pos`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2020-12-28 07:43:16', '2020-12-28 07:43:16'),
(2, 2, 2, 0, '2020-12-28 07:43:16', '2020-12-28 07:43:16'),
(3, 3, 10, 0, '2020-12-28 07:43:59', '2020-12-28 07:43:59'),
(4, 4, 3, 0, '2020-12-28 07:43:59', '2020-12-28 07:43:59'),
(5, 4, 4, 0, '2020-12-28 07:45:22', '2020-12-28 07:45:22'),
(6, 14, 6, 0, '2020-12-28 07:45:22', '2020-12-28 07:45:22'),
(7, 5, 11, 0, '2020-12-28 07:51:52', '2020-12-28 07:51:52'),
(8, 6, 12, 0, '2020-12-28 07:51:52', '2020-12-28 07:51:52'),
(9, 7, 13, 0, '2020-12-28 07:53:27', '2020-12-28 07:53:27'),
(10, 8, 7, 0, '2020-12-28 07:53:27', '2020-12-28 07:53:27'),
(11, 8, 8, 0, '2020-12-28 07:54:38', '2020-12-28 07:54:38'),
(12, 10, 9, 0, '2020-12-28 07:54:38', '2020-12-28 07:54:38'),
(13, 15, 14, 0, '2020-12-28 16:05:58', '2020-12-28 16:05:58'),
(14, 15, 15, 0, '2020-12-28 16:05:58', '2020-12-28 16:05:58'),
(15, 15, 16, 0, '2020-12-28 16:09:24', '2020-12-28 16:09:24'),
(16, 16, 17, 0, '2020-12-28 16:09:24', '2020-12-28 16:09:24'),
(17, 16, 18, 0, '2020-12-28 16:09:37', '2020-12-28 16:09:37'),
(18, 16, 21, 0, '2020-12-28 16:09:37', '2020-12-28 16:09:37'),
(19, 17, 15, 0, '2020-12-28 16:10:06', '2020-12-28 16:10:06'),
(20, 17, 22, 0, '2020-12-28 16:10:06', '2020-12-28 16:10:06'),
(21, 17, 23, 0, '2020-12-28 16:10:22', '2020-12-28 16:10:22'),
(22, 18, 64, 1, '2021-03-17 08:21:27', '2021-03-17 08:21:27'),
(23, 18, 65, 2, '2021-03-17 08:21:53', '2021-03-17 08:21:53'),
(24, 19, 66, 1, '2021-03-17 08:22:59', '2021-03-17 08:22:59'),
(25, 19, 67, 2, '2021-03-17 08:23:29', '2021-03-17 08:23:29'),
(26, 19, 68, 3, '2021-03-17 08:23:59', '2021-03-17 08:23:59'),
(27, 19, 69, 4, '2021-03-17 08:24:28', '2021-03-17 08:24:28'),
(28, 19, 70, 5, '2021-03-17 08:25:05', '2021-03-17 08:25:05'),
(29, 19, 71, 6, '2021-03-17 08:25:39', '2021-03-17 08:25:39'),
(30, 19, 72, 7, '2021-03-17 08:26:29', '2021-03-17 08:26:29'),
(31, 19, 73, 8, '2021-03-17 08:27:03', '2021-03-17 08:27:03'),
(32, 19, 74, 9, '2021-03-17 08:28:19', '2021-03-17 08:28:19'),
(33, 19, 75, 10, '2021-03-17 08:29:06', '2021-03-17 08:29:06'),
(34, 19, 76, 10, '2021-03-17 08:29:52', '2021-03-17 08:29:52'),
(35, 19, 77, 10, '2021-03-17 08:30:36', '2021-03-17 08:30:36'),
(36, 19, 78, 10, '2021-03-17 08:32:28', '2021-03-17 08:32:28'),
(37, 19, 79, 11, '2021-03-17 08:34:01', '2021-03-17 08:34:01'),
(38, 19, 80, 11, '2021-03-17 08:34:47', '2021-03-17 08:34:47'),
(39, 19, 81, 12, '2021-03-17 08:35:45', '2021-03-17 08:35:45'),
(40, 19, 82, 12, '2021-03-17 08:36:10', '2021-03-17 08:36:10'),
(41, 20, 83, 1, '2021-03-17 08:37:45', '2021-03-17 08:37:45'),
(42, 20, 84, 2, '2021-03-17 08:38:06', '2021-03-17 08:38:06'),
(43, 20, 85, 3, '2021-03-17 08:39:00', '2021-03-17 08:39:00'),
(44, 20, 86, 4, '2021-03-17 08:39:31', '2021-03-17 08:39:31'),
(45, 25, 87, 1, '2021-03-17 08:45:27', '2021-03-17 08:45:27'),
(46, 25, 88, 2, '2021-03-17 08:46:05', '2021-03-17 08:46:05'),
(47, 25, 89, 3, '2021-03-17 08:46:32', '2021-03-17 08:46:32'),
(48, 25, 90, 4, '2021-03-17 08:47:03', '2021-03-17 08:47:03'),
(49, 25, 91, 5, '2021-03-17 08:47:47', '2021-03-17 08:47:47'),
(50, 25, 92, 6, '2021-03-17 08:48:29', '2021-03-17 08:48:29'),
(51, 25, 93, 7, '2021-03-17 08:49:07', '2021-03-17 08:49:07'),
(52, 25, 94, 7, '2021-03-17 08:49:58', '2021-03-17 08:49:58'),
(53, 25, 95, 7, '2021-03-17 08:50:33', '2021-03-17 08:50:33'),
(54, 25, 96, 8, '2021-03-17 08:50:56', '2021-03-17 08:50:56'),
(55, 25, 97, 9, '2021-03-17 08:51:27', '2021-03-17 08:51:27'),
(56, 21, 98, 1, '2021-03-17 08:52:38', '2021-03-17 08:52:38'),
(57, 21, 99, 2, '2021-03-17 08:53:07', '2021-03-17 08:53:07'),
(58, 21, 100, 3, '2021-03-17 08:54:19', '2021-03-17 08:54:19'),
(59, 21, 101, 4, '2021-03-17 08:54:49', '2021-03-17 08:54:49'),
(60, 21, 102, 5, '2021-03-17 08:55:47', '2021-03-17 08:55:47'),
(61, 25, 103, 10, '2021-03-17 08:56:50', '2021-03-17 08:56:50'),
(62, 25, 104, 11, '2021-03-17 08:57:34', '2021-03-17 08:57:34'),
(63, 26, 105, 1, '2021-03-17 08:58:40', '2021-03-17 08:58:40'),
(64, 26, 106, 2, '2021-03-17 08:59:00', '2021-03-17 08:59:00'),
(65, 27, 107, 1, '2021-03-17 09:00:28', '2021-03-17 09:00:28'),
(66, 27, 108, 1, '2021-03-17 09:01:00', '2021-03-17 09:01:00'),
(67, 27, 109, 2, '2021-03-17 09:01:31', '2021-03-17 09:01:31'),
(68, 27, 110, 3, '2021-03-17 09:01:54', '2021-03-17 09:01:54'),
(69, 28, 111, 1, '2021-03-17 09:03:33', '2021-03-17 09:03:33'),
(70, 28, 112, 2, '2021-03-17 09:04:04', '2021-03-17 09:04:04'),
(71, 29, 113, 1, '2021-03-17 09:27:54', '2021-03-17 09:27:54'),
(72, 29, 114, 2, '2021-03-17 09:28:27', '2021-03-17 09:28:27'),
(73, 29, 115, 3, '2021-03-17 09:28:58', '2021-03-17 09:28:58'),
(74, 29, 116, 4, '2021-03-17 09:29:21', '2021-03-17 09:29:21'),
(75, 30, 117, 1, '2021-03-17 09:43:31', '2021-03-17 09:43:31'),
(76, 30, 118, 2, '2021-03-17 09:44:34', '2021-03-17 09:44:34'),
(77, 30, 119, 3, '2021-03-17 09:44:51', '2021-03-17 09:44:51'),
(78, 31, 120, 1, '2021-03-17 09:48:25', '2021-03-17 09:48:25'),
(79, 31, 121, 2, '2021-03-17 09:50:21', '2021-03-17 09:50:21'),
(80, 31, 122, 3, '2021-03-17 09:50:44', '2021-03-17 09:50:44'),
(81, 31, 123, 4, '2021-03-17 09:51:14', '2021-03-17 09:51:14'),
(82, 31, 124, 5, '2021-03-17 09:51:36', '2021-03-17 09:51:36'),
(83, 31, 125, 5, '2021-03-17 09:52:09', '2021-03-17 09:52:09'),
(84, 31, 126, 6, '2021-03-17 09:52:37', '2021-03-17 09:52:37'),
(85, 32, 127, 1, '2021-03-17 09:56:17', '2021-03-17 09:56:17'),
(86, 32, 128, 2, '2021-03-17 09:56:37', '2021-03-17 09:56:37'),
(87, 32, 129, 2, '2021-03-17 09:57:03', '2021-03-17 09:57:03'),
(88, 32, 130, 2, '2021-03-17 09:58:31', '2021-03-17 09:58:31'),
(89, 32, 131, 3, '2021-03-17 09:59:03', '2021-03-17 09:59:03'),
(90, 32, 132, 3, '2021-03-17 10:00:09', '2021-03-17 10:00:09'),
(91, 32, 133, 4, '2021-03-17 10:00:48', '2021-03-17 10:00:48'),
(92, 32, 134, 4, '2021-03-17 10:01:13', '2021-03-17 10:01:13'),
(93, 33, 135, 1, '2021-03-17 10:04:37', '2021-03-17 10:04:37'),
(94, 33, 136, 2, '2021-03-17 10:05:10', '2021-03-17 10:05:10'),
(95, 33, 137, 2, '2021-03-17 10:05:31', '2021-03-17 10:05:31'),
(96, 33, 138, 3, '2021-03-17 10:05:48', '2021-03-17 10:05:48'),
(97, 33, 139, 3, '2021-03-17 10:06:32', '2021-03-17 10:06:32'),
(98, 34, 140, 1, '2021-03-17 10:11:43', '2021-03-17 10:11:43'),
(99, 34, 141, 2, '2021-03-17 10:12:31', '2021-03-17 10:12:31'),
(100, 35, 142, 1, '2021-03-17 10:13:39', '2021-03-17 10:13:39'),
(101, 35, 143, 2, '2021-03-17 10:13:59', '2021-03-17 10:13:59'),
(102, 35, 144, 3, '2021-03-17 10:15:00', '2021-03-17 10:15:00'),
(103, 35, 145, 4, '2021-03-17 10:15:31', '2021-03-17 10:15:31'),
(104, 35, 146, 5, '2021-03-17 10:15:52', '2021-03-17 10:15:52'),
(105, 35, 147, 6, '2021-03-17 10:16:19', '2021-03-17 10:16:19'),
(106, 35, 148, 7, '2021-03-17 10:17:11', '2021-03-17 10:17:11'),
(107, 36, 149, 1, '2021-03-17 10:19:03', '2021-03-17 10:19:03'),
(108, 37, 150, 1, '2021-03-17 10:20:26', '2021-03-17 10:20:26'),
(109, 37, 151, 2, '2021-03-17 10:21:01', '2021-03-17 10:21:01'),
(110, 37, 152, 3, '2021-03-17 10:22:39', '2021-03-17 10:22:39'),
(111, 37, 153, 4, '2021-03-17 10:23:01', '2021-03-17 10:23:01'),
(112, 37, 154, 5, '2021-03-17 10:23:25', '2021-03-17 10:23:25'),
(113, 38, 155, 1, '2021-03-17 10:26:05', '2021-03-17 10:26:05'),
(114, 38, 156, 2, '2021-03-17 10:26:32', '2021-03-17 10:26:32'),
(115, 38, 157, 3, '2021-03-17 10:26:56', '2021-03-17 10:26:56'),
(116, 38, 158, 4, '2021-03-17 10:27:13', '2021-03-17 10:27:13'),
(117, 39, 159, 1, '2021-03-17 10:27:56', '2021-03-17 10:27:56'),
(118, 39, 160, 2, '2021-03-17 10:28:14', '2021-03-17 10:28:14'),
(119, 40, 161, 1, '2021-03-17 10:29:18', '2021-03-17 10:29:18'),
(120, 41, 162, 1, '2021-03-17 10:33:00', '2021-03-17 10:33:00'),
(121, 41, 163, 2, '2021-03-17 10:33:31', '2021-03-17 10:33:31'),
(122, 41, 164, 3, '2021-03-17 10:34:02', '2021-03-17 10:34:02'),
(123, 41, 165, 4, '2021-03-17 10:34:26', '2021-03-17 10:34:26'),
(124, 41, 166, 4, '2021-03-17 10:35:08', '2021-03-17 10:35:08'),
(125, 41, 167, 5, '2021-03-17 10:35:40', '2021-03-17 10:35:40'),
(126, 41, 168, 6, '2021-03-17 10:36:05', '2021-03-17 10:36:05'),
(127, 41, 169, 6, '2021-03-17 10:36:21', '2021-03-17 10:36:21'),
(128, 43, 170, 1, '2021-03-17 10:38:21', '2021-03-17 10:38:21'),
(129, 43, 171, 2, '2021-03-17 10:38:40', '2021-03-17 10:38:40'),
(130, 21, 172, 6, '2021-03-20 01:42:13', '2021-03-20 01:42:13'),
(131, 32, 173, 3, '2021-03-20 05:53:33', '2021-03-20 05:53:33'),
(132, 44, 174, 1, '2021-03-24 07:24:51', '2021-03-24 07:24:51'),
(133, 44, 175, 2, '2021-03-24 07:25:32', '2021-03-24 07:25:32'),
(134, 44, 176, 3, '2021-03-24 07:25:54', '2021-03-24 07:25:54'),
(135, 44, 177, 4, '2021-03-24 07:26:20', '2021-03-24 07:26:20'),
(136, 44, 178, 5, '2021-03-24 07:26:38', '2021-03-24 07:26:38'),
(137, 44, 179, 6, '2021-03-24 07:27:13', '2021-03-24 07:27:13'),
(138, 44, 180, 7, '2021-03-24 07:27:52', '2021-03-24 07:27:52'),
(139, 44, 181, 7, '2021-03-24 07:28:32', '2021-03-24 07:28:32'),
(140, 44, 182, 8, '2021-03-24 07:29:30', '2021-03-24 07:29:30'),
(141, 44, 183, 9, '2021-03-24 07:29:58', '2021-03-24 07:29:58'),
(142, 44, 184, 10, '2021-03-24 07:30:34', '2021-03-24 07:30:34'),
(143, 44, 191, 11, '2021-03-24 07:37:59', '2021-03-24 07:37:59'),
(144, 44, 192, 12, '2021-03-24 07:39:25', '2021-03-24 07:39:25'),
(145, 44, 193, 12, '2021-03-24 07:40:29', '2021-03-24 07:40:29'),
(146, 71, 194, 1, '2021-04-02 02:03:47', '2021-04-02 02:03:47'),
(147, 70, 195, 4, '2021-04-02 02:06:19', '2021-04-02 02:06:19'),
(148, 69, 196, 1, '2021-04-02 02:10:22', '2021-04-02 02:10:22'),
(149, 69, 197, 2, '2021-04-02 02:11:44', '2021-04-02 02:11:44'),
(150, 69, 198, 3, '2021-04-02 02:13:27', '2021-04-02 02:13:27'),
(151, 69, 199, 4, '2021-04-02 02:14:43', '2021-04-02 02:14:43'),
(152, 69, 200, 4, '2021-04-02 02:16:09', '2021-04-02 02:16:09'),
(153, 69, 201, 4, '2021-04-02 02:18:09', '2021-04-02 02:18:09'),
(154, 69, 202, 5, '2021-04-02 02:18:44', '2021-04-02 02:18:44'),
(155, 69, 203, 6, '2021-04-02 02:21:37', '2021-04-02 02:21:37'),
(156, 70, 204, 1, '2021-04-02 02:32:10', '2021-04-02 02:32:10'),
(157, 70, 205, 3, '2021-04-02 02:33:40', '2021-04-02 02:33:40'),
(158, 70, 206, 3, '2021-04-02 02:35:12', '2021-04-02 02:35:12'),
(159, 70, 207, 3, '2021-04-02 02:38:10', '2021-04-02 02:38:10'),
(161, 75, 209, 1, '2021-10-05 04:16:09', '2021-10-05 04:16:09'),
(163, 75, 211, 2, '2021-10-05 04:37:14', '2021-10-05 04:37:14'),
(165, 75, 213, 2, '2021-10-05 04:49:31', '2021-10-05 04:49:31'),
(166, 75, 214, 2, '2021-10-05 04:50:16', '2021-10-05 04:50:16'),
(167, 75, 215, 2, '2021-10-05 04:53:23', '2021-10-05 04:53:23'),
(169, 75, 217, 2, '2021-10-05 05:00:24', '2021-10-05 05:00:24'),
(170, 75, 218, 2, '2021-10-05 05:01:01', '2021-10-05 05:01:01'),
(171, 75, 219, 3, '2021-10-05 05:02:21', '2021-10-05 05:02:21'),
(172, 79, 220, 1, '2021-10-05 05:22:21', '2021-10-05 05:22:21'),
(173, 79, 221, 2, '2021-10-05 05:23:13', '2021-10-05 05:23:13'),
(174, 79, 222, 3, '2021-10-05 05:25:05', '2021-10-05 05:25:05'),
(175, 79, 223, 4, '2021-10-05 05:25:45', '2021-10-05 05:25:45'),
(176, 79, 224, 5, '2021-10-05 05:26:06', '2021-10-05 05:26:06'),
(177, 79, 225, 6, '2021-10-05 05:26:55', '2021-10-05 05:26:55'),
(178, 79, 226, 7, '2021-10-05 05:27:10', '2021-10-05 05:27:10'),
(179, 79, 227, 8, '2021-10-05 05:27:25', '2021-10-05 05:27:25'),
(180, 80, 228, 1, '2021-10-05 05:30:50', '2021-10-05 05:30:50'),
(181, 80, 229, 2, '2021-10-05 05:31:30', '2021-10-05 05:31:30'),
(182, 80, 230, 3, '2021-10-05 05:32:14', '2021-10-05 05:32:14'),
(183, 80, 231, 4, '2021-10-05 05:32:46', '2021-10-05 05:32:46'),
(194, 76, 242, 1, '2021-10-05 07:30:33', '2021-10-05 07:30:33'),
(195, 76, 243, 2, '2021-10-05 07:32:56', '2021-10-05 07:32:56'),
(196, 76, 244, 2, '2021-10-05 07:37:27', '2021-10-05 07:37:27'),
(197, 76, 245, 2, '2021-10-05 07:38:48', '2021-10-05 07:38:48'),
(198, 76, 246, 2, '2021-10-05 07:44:53', '2021-10-05 07:44:53'),
(199, 76, 247, 3, '2021-10-05 07:47:17', '2021-10-05 07:47:17'),
(200, 76, 248, 3, '2021-10-05 07:49:15', '2021-10-05 07:49:15'),
(201, 89, 249, 1, '2021-10-05 07:49:24', '2021-10-05 07:49:24'),
(202, 89, 250, 2, '2021-10-05 07:49:47', '2021-10-05 07:49:47'),
(203, 89, 251, 3, '2021-10-05 07:50:09', '2021-10-05 07:50:09'),
(204, 76, 252, 4, '2021-10-05 07:51:05', '2021-10-05 07:51:05'),
(205, 76, 253, 4, '2021-10-05 07:52:40', '2021-10-05 07:52:40'),
(206, 81, 254, 1, '2021-10-05 07:53:58', '2021-10-05 07:53:58'),
(207, 81, 255, 2, '2021-10-05 07:54:17', '2021-10-05 07:54:17'),
(208, 76, 256, 4, '2021-10-05 07:54:38', '2021-10-05 07:54:38'),
(209, 81, 257, 3, '2021-10-05 07:54:52', '2021-10-05 07:54:52'),
(210, 81, 258, 4, '2021-10-05 07:56:27', '2021-10-05 07:56:27'),
(211, 81, 259, 5, '2021-10-05 07:57:26', '2021-10-05 07:57:26'),
(213, 81, 261, 6, '2021-10-05 07:58:29', '2021-10-05 07:58:29'),
(214, 81, 262, 7, '2021-10-05 07:59:16', '2021-10-05 07:59:16'),
(215, 81, 263, 8, '2021-10-05 08:00:02', '2021-10-05 08:00:02'),
(216, 82, 264, 1, '2021-10-05 08:04:14', '2021-10-05 08:04:14'),
(217, 82, 265, 2, '2021-10-05 08:04:36', '2021-10-05 08:04:36'),
(219, 82, 267, 3, '2021-10-05 08:05:59', '2021-10-05 08:05:59'),
(220, 82, 268, 3, '2021-10-05 08:06:27', '2021-10-05 08:06:27'),
(222, 82, 270, 5, '2021-10-05 08:07:28', '2021-10-05 08:07:28'),
(223, 82, 271, 6, '2021-10-05 08:07:53', '2021-10-05 08:07:53'),
(225, 83, 273, 1, '2021-10-05 08:09:43', '2021-10-05 08:09:43'),
(226, 83, 274, 2, '2021-10-05 08:09:59', '2021-10-05 08:09:59'),
(227, 83, 275, 3, '2021-10-05 08:10:09', '2021-10-05 08:10:09'),
(228, 83, 276, 4, '2021-10-05 08:10:26', '2021-10-05 08:10:26'),
(229, 83, 277, 5, '2021-10-05 08:11:29', '2021-10-05 08:11:29'),
(230, 83, 278, 6, '2021-10-05 08:12:01', '2021-10-05 08:12:01'),
(231, 83, 279, 7, '2021-10-05 08:12:17', '2021-10-05 08:12:17'),
(233, 84, 281, 1, '2021-10-05 08:14:35', '2021-10-05 08:14:35'),
(234, 84, 282, 2, '2021-10-05 08:15:19', '2021-10-05 08:15:19'),
(235, 89, 283, 4, '2021-10-05 08:50:10', '2021-10-05 08:50:10'),
(236, 78, 284, 1, '2021-10-05 08:55:04', '2021-10-05 08:55:04'),
(237, 78, 285, 2, '2021-10-05 08:55:18', '2021-10-05 08:55:18'),
(238, 91, 286, 1, '2021-10-05 09:19:06', '2021-10-05 09:19:06'),
(239, 91, 287, 2, '2021-10-05 09:22:52', '2021-10-05 09:22:52'),
(240, 108, 288, 1, '2021-10-05 09:56:27', '2021-10-05 09:56:27'),
(241, 108, 289, 2, '2021-10-05 09:56:44', '2021-10-05 09:56:44'),
(242, 108, 290, 3, '2021-10-05 09:56:58', '2021-10-05 09:56:58'),
(243, 108, 291, 4, '2021-10-05 09:57:19', '2021-10-05 09:57:19'),
(244, 108, 292, 4, '2021-10-05 09:59:59', '2021-10-05 09:59:59'),
(245, 91, 293, 3, '2021-10-05 10:03:19', '2021-10-05 10:03:19'),
(246, 91, 294, 4, '2021-10-05 10:03:47', '2021-10-05 10:03:47'),
(247, 108, 295, 5, '2021-10-05 10:05:51', '2021-10-05 10:05:51'),
(248, 108, 296, 6, '2021-10-05 10:06:55', '2021-10-05 10:06:55'),
(249, 108, 297, 7, '2021-10-05 10:08:09', '2021-10-05 10:08:09'),
(250, 90, 298, 1, '2021-10-05 10:13:02', '2021-10-05 10:13:02'),
(251, 90, 299, 2, '2021-10-05 10:13:16', '2021-10-05 10:13:16'),
(252, 90, 300, 3, '2021-10-05 10:13:28', '2021-10-05 10:13:28'),
(253, 90, 301, 4, '2021-10-05 10:14:32', '2021-10-05 10:14:32'),
(254, 90, 302, 5, '2021-10-05 10:15:05', '2021-10-05 10:15:05'),
(255, 90, 303, 6, '2021-10-05 10:15:48', '2021-10-05 10:15:48'),
(256, 90, 304, 7, '2021-10-05 10:16:18', '2021-10-05 10:16:18'),
(257, 90, 305, 7, '2021-10-05 10:16:30', '2021-10-05 10:16:30'),
(258, 90, 306, 7, '2021-10-05 10:16:53', '2021-10-05 10:16:53'),
(259, 90, 307, 7, '2021-10-05 10:17:06', '2021-10-05 10:17:06'),
(260, 90, 308, 8, '2021-10-05 10:17:22', '2021-10-05 10:17:22'),
(261, 90, 309, 9, '2021-10-05 10:17:40', '2021-10-05 10:17:40'),
(262, 90, 310, 10, '2021-10-05 10:25:02', '2021-10-05 10:25:02'),
(263, 93, 311, 1, '2021-10-05 10:33:35', '2021-10-05 10:33:35'),
(264, 93, 312, 1, '2021-10-05 10:34:07', '2021-10-05 10:34:07'),
(265, 93, 313, 2, '2021-10-05 10:34:22', '2021-10-05 10:34:22'),
(266, 93, 314, 3, '2021-10-05 10:35:26', '2021-10-05 10:35:26'),
(267, 104, 315, 1, '2021-10-05 10:36:14', '2021-10-05 10:36:14'),
(268, 104, 316, 2, '2021-10-05 10:36:58', '2021-10-05 10:36:58'),
(269, 94, 317, 1, '2021-10-05 10:37:57', '2021-10-05 10:37:57'),
(270, 94, 318, 2, '2021-10-05 10:38:10', '2021-10-05 10:38:10'),
(271, 94, 319, 3, '2021-10-05 10:38:29', '2021-10-05 10:38:29'),
(272, 94, 320, 4, '2021-10-05 10:39:31', '2021-10-05 10:39:31'),
(273, 95, 321, 1, '2021-10-05 10:40:36', '2021-10-05 10:40:36'),
(274, 95, 322, 2, '2021-10-05 10:40:46', '2021-10-05 10:40:46'),
(275, 95, 323, 3, '2021-10-05 10:40:58', '2021-10-05 10:40:58'),
(276, 96, 324, 1, '2021-10-05 10:42:21', '2021-10-05 10:42:21'),
(277, 96, 325, 2, '2021-10-05 10:42:44', '2021-10-05 10:42:44'),
(278, 96, 326, 3, '2021-10-05 10:43:17', '2021-10-05 10:43:17'),
(279, 96, 327, 4, '2021-10-05 10:43:30', '2021-10-05 10:43:30'),
(280, 96, 328, 5, '2021-10-05 10:44:19', '2021-10-05 10:44:19'),
(281, 96, 329, 6, '2021-10-05 10:47:19', '2021-10-05 10:47:19'),
(282, 97, 330, 1, '2021-10-05 10:52:43', '2021-10-05 10:52:43'),
(283, 97, 331, 2, '2021-10-05 10:53:10', '2021-10-05 10:53:10'),
(284, 97, 332, 2, '2021-10-05 10:53:34', '2021-10-05 10:53:34'),
(285, 97, 333, 2, '2021-10-05 10:53:52', '2021-10-05 10:53:52'),
(286, 97, 334, 3, '2021-10-05 10:54:02', '2021-10-05 10:54:02'),
(287, 97, 335, 3, '2021-10-05 10:54:18', '2021-10-05 10:54:18'),
(288, 97, 336, 4, '2021-10-05 10:54:36', '2021-10-05 10:54:36'),
(289, 97, 337, 4, '2021-10-05 10:54:52', '2021-10-05 10:54:52'),
(290, 97, 338, 3, '2021-10-05 10:55:12', '2021-10-05 10:55:12'),
(291, 98, 339, 1, '2021-10-05 10:55:44', '2021-10-05 10:55:44'),
(292, 98, 340, 2, '2021-10-05 10:56:17', '2021-10-05 10:56:17'),
(293, 98, 341, 2, '2021-10-05 10:56:34', '2021-10-05 10:56:34'),
(294, 98, 342, 3, '2021-10-05 10:56:42', '2021-10-05 10:56:42'),
(295, 98, 343, 3, '2021-10-05 10:56:53', '2021-10-05 10:56:53'),
(298, 100, 346, 1, '2021-10-05 10:58:37', '2021-10-05 10:58:37'),
(299, 100, 347, 2, '2021-10-05 10:58:48', '2021-10-05 10:58:48'),
(300, 100, 348, 3, '2021-10-05 10:58:58', '2021-10-05 10:58:58'),
(301, 100, 349, 4, '2021-10-05 10:59:16', '2021-10-05 10:59:16'),
(302, 100, 350, 5, '2021-10-05 10:59:27', '2021-10-05 10:59:27'),
(303, 100, 351, 6, '2021-10-05 10:59:40', '2021-10-05 10:59:40'),
(304, 100, 352, 7, '2021-10-05 10:59:53', '2021-10-05 10:59:53'),
(305, 99, 353, 1, '2021-10-05 11:01:33', '2021-10-05 11:01:33'),
(306, 99, 354, 2, '2021-10-05 11:01:44', '2021-10-05 11:01:44'),
(307, 101, 355, 1, '2021-10-05 11:03:09', '2021-10-05 11:03:09'),
(308, 102, 356, 1, '2021-10-05 11:04:12', '2021-10-05 11:04:12'),
(309, 102, 357, 2, '2021-10-05 11:04:23', '2021-10-05 11:04:23'),
(310, 102, 358, 3, '2021-10-05 11:04:58', '2021-10-05 11:04:58'),
(311, 102, 359, 4, '2021-10-05 11:05:30', '2021-10-05 11:05:30'),
(312, 102, 360, 5, '2021-10-05 11:05:59', '2021-10-05 11:05:59'),
(313, 103, 361, 1, '2021-10-05 11:06:23', '2021-10-05 11:06:23'),
(314, 103, 362, 2, '2021-10-05 11:06:38', '2021-10-05 11:06:38'),
(315, 103, 363, 3, '2021-10-05 11:06:48', '2021-10-05 11:06:48'),
(316, 103, 364, 4, '2021-10-05 11:07:00', '2021-10-05 11:07:00'),
(317, 105, 365, 1, '2021-10-05 11:07:29', '2021-10-05 11:07:29'),
(318, 105, 366, 2, '2021-10-05 11:08:00', '2021-10-05 11:08:00'),
(319, 106, 367, 1, '2021-10-05 11:08:34', '2021-10-05 11:08:34'),
(320, 107, 368, 1, '2021-10-05 11:09:32', '2021-10-05 11:09:32'),
(321, 107, 369, 2, '2021-10-05 11:09:54', '2021-10-05 11:09:54'),
(324, 110, 372, 1, '2021-10-05 12:54:45', '2021-10-05 12:54:45'),
(325, 110, 373, 2, '2021-10-05 12:55:00', '2021-10-05 12:55:00'),
(326, 110, 374, 3, '2021-10-05 12:55:16', '2021-10-05 12:55:16'),
(327, 110, 375, 4, '2021-10-05 12:55:45', '2021-10-05 12:55:45'),
(328, 110, 376, 5, '2021-10-05 12:56:15', '2021-10-05 12:56:15'),
(329, 110, 377, 7, '2021-10-05 12:56:40', '2021-10-05 12:56:40'),
(330, 110, 378, 8, '2021-10-05 12:57:01', '2021-10-05 12:57:01'),
(331, 111, 379, 1, '2021-10-05 13:52:24', '2021-10-05 13:52:24'),
(332, 113, 380, 1, '2021-10-05 14:11:10', '2021-10-05 14:11:10'),
(333, 113, 381, 2, '2021-10-05 14:11:26', '2021-10-05 14:11:26'),
(334, 117, 382, 1, '2021-10-05 14:14:06', '2021-10-05 14:14:06'),
(335, 117, 383, 2, '2021-10-05 14:17:06', '2021-10-05 14:17:06'),
(336, 117, 384, 3, '2021-10-05 14:18:51', '2021-10-05 14:18:51'),
(337, 117, 385, 4, '2021-10-05 14:21:13', '2021-10-05 14:21:13'),
(338, 117, 386, 5, '2021-10-05 14:27:44', '2021-10-05 14:27:44'),
(339, 117, 387, 6, '2021-10-05 14:29:24', '2021-10-05 14:29:24'),
(340, 117, 388, 7, '2021-10-05 14:31:18', '2021-10-05 14:31:18'),
(341, 117, 389, 8, '2021-10-05 14:34:58', '2021-10-05 14:34:58'),
(342, 117, 390, 9, '2021-10-05 14:35:19', '2021-10-05 14:35:19'),
(343, 118, 391, 1, '2021-10-06 01:59:56', '2021-10-06 01:59:56'),
(344, 118, 392, 2, '2021-10-06 02:01:07', '2021-10-06 02:01:07'),
(345, 118, 393, 3, '2021-10-06 02:04:11', '2021-10-06 02:04:11'),
(346, 118, 394, 4, '2021-10-06 02:04:43', '2021-10-06 02:04:43'),
(347, 118, 395, 5, '2021-10-06 02:05:30', '2021-10-06 02:05:30'),
(348, 119, 396, 1, '2021-10-06 02:14:00', '2021-10-06 02:14:00'),
(349, 119, 397, 2, '2021-10-06 02:14:22', '2021-10-06 02:14:22'),
(350, 119, 398, 3, '2021-10-06 02:14:32', '2021-10-06 02:14:32'),
(351, 119, 399, 4, '2021-10-06 02:15:17', '2021-10-06 02:15:17'),
(352, 119, 400, 5, '2021-10-06 02:15:26', '2021-10-06 02:15:26'),
(353, 119, 401, 6, '2021-10-06 02:15:51', '2021-10-06 02:15:51'),
(354, 119, 402, 7, '2021-10-06 02:16:22', '2021-10-06 02:16:22'),
(355, 119, 403, 7, '2021-10-06 02:16:37', '2021-10-06 02:16:37'),
(356, 119, 404, 7, '2021-10-06 02:16:48', '2021-10-06 02:16:48'),
(357, 119, 405, 8, '2021-10-06 02:17:29', '2021-10-06 02:17:29'),
(358, 119, 406, 9, '2021-10-06 02:17:40', '2021-10-06 02:17:40'),
(359, 119, 407, 10, '2021-10-06 02:18:19', '2021-10-06 02:18:19'),
(360, 120, 408, 1, '2021-10-06 02:19:22', '2021-10-06 02:19:22'),
(361, 120, 409, 1, '2021-10-06 02:19:32', '2021-10-06 02:19:32'),
(362, 120, 410, 2, '2021-10-06 02:19:54', '2021-10-06 02:19:54'),
(363, 120, 411, 3, '2021-10-06 02:20:04', '2021-10-06 02:20:04'),
(364, 130, 412, 1, '2021-10-06 02:20:49', '2021-10-06 02:20:49'),
(365, 130, 413, 2, '2021-10-06 02:22:12', '2021-10-06 02:22:12'),
(366, 121, 414, 1, '2021-10-06 02:23:48', '2021-10-06 02:23:48'),
(367, 121, 415, 2, '2021-10-06 02:24:34', '2021-10-06 02:24:34'),
(368, 121, 416, 3, '2021-10-06 02:24:51', '2021-10-06 02:24:51'),
(369, 121, 417, 4, '2021-10-06 02:26:19', '2021-10-06 02:26:19'),
(370, 122, 418, 1, '2021-10-06 02:27:11', '2021-10-06 02:27:11'),
(371, 122, 419, 2, '2021-10-06 02:27:21', '2021-10-06 02:27:21'),
(372, 122, 420, 3, '2021-10-06 02:27:30', '2021-10-06 02:27:30'),
(373, 123, 421, 1, '2021-10-06 02:28:26', '2021-10-06 02:28:26'),
(374, 123, 422, 2, '2021-10-06 02:28:56', '2021-10-06 02:28:56'),
(375, 123, 423, 3, '2021-10-06 02:29:20', '2021-10-06 02:29:20'),
(376, 123, 424, 4, '2021-10-06 02:30:14', '2021-10-06 02:30:14'),
(377, 123, 425, 5, '2021-10-06 02:30:49', '2021-10-06 02:30:49'),
(378, 123, 426, 6, '2021-10-06 02:31:41', '2021-10-06 02:31:41'),
(379, 123, 427, 7, '2021-10-06 02:32:26', '2021-10-06 02:32:26'),
(380, 124, 428, 1, '2021-10-06 02:34:35', '2021-10-06 02:34:35'),
(381, 124, 429, 2, '2021-10-06 02:34:57', '2021-10-06 02:34:57'),
(382, 124, 430, 2, '2021-10-06 02:35:23', '2021-10-06 02:35:23'),
(383, 124, 431, 2, '2021-10-06 02:35:51', '2021-10-06 02:35:51'),
(384, 124, 432, 3, '2021-10-06 02:35:59', '2021-10-06 02:35:59'),
(385, 124, 433, 3, '2021-10-06 02:36:16', '2021-10-06 02:36:16'),
(386, 124, 434, 4, '2021-10-06 02:36:35', '2021-10-06 02:36:35'),
(387, 124, 435, 4, '2021-10-06 02:36:45', '2021-10-06 02:36:45'),
(388, 124, 436, 5, '2021-10-06 02:36:58', '2021-10-06 02:36:58'),
(389, 125, 437, 1, '2021-10-06 02:37:40', '2021-10-06 02:37:40'),
(390, 125, 438, 2, '2021-10-06 02:38:22', '2021-10-06 02:38:22'),
(391, 125, 439, 3, '2021-10-06 02:38:33', '2021-10-06 02:38:33'),
(392, 125, 440, 3, '2021-10-06 02:38:42', '2021-10-06 02:38:42'),
(393, 126, 441, 1, '2021-10-06 02:39:15', '2021-10-06 02:39:15'),
(394, 126, 442, 2, '2021-10-06 02:39:26', '2021-10-06 02:39:26'),
(395, 127, 443, 1, '2021-10-06 02:40:14', '2021-10-06 02:40:14'),
(396, 127, 444, 2, '2021-10-06 02:40:28', '2021-10-06 02:40:28'),
(397, 127, 445, 3, '2021-10-06 02:40:40', '2021-10-06 02:40:40'),
(398, 127, 446, 4, '2021-10-06 02:40:56', '2021-10-06 02:40:56'),
(399, 127, 447, 5, '2021-10-06 02:41:08', '2021-10-06 02:41:08'),
(400, 127, 448, 6, '2021-10-06 02:41:18', '2021-10-06 02:41:18'),
(401, 127, 449, 7, '2021-10-06 02:46:27', '2021-10-06 02:46:27'),
(402, 128, 450, 1, '2021-10-06 02:48:35', '2021-10-06 02:48:35'),
(403, 134, 451, 1, '2021-10-06 02:50:34', '2021-10-06 02:50:34'),
(404, 134, 452, 2, '2021-10-06 02:50:50', '2021-10-06 02:50:50'),
(405, 134, 453, 3, '2021-10-06 02:51:00', '2021-10-06 02:51:00'),
(406, 134, 454, 4, '2021-10-06 02:51:11', '2021-10-06 02:51:11'),
(407, 134, 455, 5, '2021-10-06 02:51:21', '2021-10-06 02:51:21'),
(408, 129, 456, 1, '2021-10-06 02:51:54', '2021-10-06 02:51:54'),
(409, 129, 457, 2, '2021-10-06 02:52:05', '2021-10-06 02:52:05'),
(410, 129, 458, 3, '2021-10-06 02:52:14', '2021-10-06 02:52:14'),
(411, 129, 459, 4, '2021-10-06 02:52:24', '2021-10-06 02:52:24'),
(412, 131, 460, 1, '2021-10-06 02:52:46', '2021-10-06 02:52:46'),
(413, 131, 461, 2, '2021-10-06 02:52:57', '2021-10-06 02:52:57'),
(414, 132, 462, 1, '2021-10-06 02:53:28', '2021-10-06 02:53:28'),
(415, 133, 463, 1, '2021-10-06 02:54:12', '2021-10-06 02:54:12'),
(416, 133, 464, 2, '2021-10-06 02:54:54', '2021-10-06 02:54:54'),
(417, 135, 465, 1, '2021-10-06 02:58:06', '2021-10-06 02:58:06'),
(418, 135, 466, 2, '2021-10-06 02:58:21', '2021-10-06 02:58:21'),
(419, 135, 467, 3, '2021-10-06 02:58:34', '2021-10-06 02:58:34'),
(420, 135, 468, 4, '2021-10-06 02:58:52', '2021-10-06 02:58:52'),
(421, 135, 469, 4, '2021-10-06 02:59:12', '2021-10-06 02:59:12'),
(422, 135, 470, 5, '2021-10-06 02:59:23', '2021-10-06 02:59:23'),
(423, 135, 471, 6, '2021-10-06 02:59:35', '2021-10-06 02:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'cd,xd', '2021-05-03 06:20:36', '2021-05-03 06:20:36'),
(2, 'xd', '2021-05-03 06:23:02', '2021-05-03 06:23:02'),
(3, 'cs', '2021-05-03 06:23:02', '2021-05-03 06:23:02'),
(4, ' cs', '2021-05-03 06:57:09', '2021-05-03 06:57:09'),
(5, 'cd', '2021-05-03 06:57:09', '2021-05-03 06:57:09'),
(6, ' cd', '2021-05-03 06:57:16', '2021-05-03 06:57:16'),
(7, '1', '2021-05-03 08:48:41', '2021-05-03 08:48:41'),
(8, '', '2021-05-05 00:34:03', '2021-05-05 00:34:03'),
(9, '123', '2021-05-05 09:50:45', '2021-05-05 09:50:45'),
(10, 'test', '2021-05-05 12:46:35', '2021-05-05 12:46:35'),
(11, 'xuân an', '2021-05-05 13:02:14', '2021-05-05 13:02:14'),
(12, 'xu', '2021-05-05 13:29:15', '2021-05-05 13:29:15'),
(13, 'x', '2021-05-05 13:30:18', '2021-05-05 13:30:18'),
(14, 'đô thị', '2021-05-05 16:11:15', '2021-05-05 16:11:15'),
(15, '123123', '2021-05-10 03:03:22', '2021-05-10 03:03:22'),
(16, '12412', '2021-05-10 03:03:39', '2021-05-10 03:03:39'),
(17, 'Xuân An 123', '2021-05-10 14:51:52', '2021-05-10 14:51:52'),
(18, 'Xuân An 123124', '2021-05-10 14:51:55', '2021-05-10 14:51:55'),
(19, 'Xuân', '2021-05-10 15:01:47', '2021-05-10 15:01:47'),
(20, 'An', '2021-05-10 15:01:47', '2021-05-10 15:01:47'),
(22, 'hạ', '2021-05-10 15:01:54', '2021-05-10 15:01:54'),
(23, 'xuân 1', '2021-05-10 15:02:35', '2021-05-10 15:02:35'),
(24, 'hòa bình', '2021-05-13 16:21:52', '2021-05-13 16:21:52'),
(25, 'xuân an 2', '2021-05-13 16:22:09', '2021-05-13 16:22:09'),
(26, 'thi công', '2021-05-20 01:58:30', '2021-05-20 01:58:30'),
(27, 'tiến độ', '2021-05-20 01:58:30', '2021-05-20 01:58:30'),
(30, ' xuân an', '2021-05-20 05:15:35', '2021-05-20 05:15:35'),
(31, 'gia đình', '2021-05-21 08:17:34', '2021-05-21 08:17:34'),
(32, 'Hồ sơ quan tâm dự án', '2021-05-21 10:34:09', '2021-05-21 10:34:09'),
(33, 'đấu thầu', '2021-05-21 10:34:09', '2021-05-21 10:34:09'),
(34, 'đấu thầu qua mạng', '2021-05-21 10:34:09', '2021-05-21 10:34:09'),
(35, 'Hội Vân', '2021-05-21 10:34:09', '2021-05-21 10:34:09'),
(36, '213', '2021-05-21 10:39:03', '2021-05-21 10:39:03'),
(37, 'phụ lục hồ sơ quan tâm', '2021-05-21 11:01:23', '2021-05-21 11:01:23'),
(38, 'sơ đồ quy hoạch không gian kiến trúc cảnh quan', '2021-05-21 11:01:23', '2021-05-21 11:01:23'),
(39, 'Hồ sơ quan tâm', '2021-05-21 11:03:32', '2021-05-21 11:03:32'),
(40, 'Hồ sơ năng lực và kinh nghiệm', '2021-05-21 11:03:32', '2021-05-21 11:03:32'),
(41, 'Tài liệu về năng lực Đông Dương Thăng Long', '2021-05-21 11:07:37', '2021-05-21 11:07:37'),
(42, 'Danh mục hồ sơ dự án Xuân An', '2021-05-21 11:10:27', '2021-05-21 11:10:27'),
(43, 'Danh mục tổng thể hồ sơ dự án', '2021-05-21 11:10:27', '2021-05-21 11:10:27'),
(44, 'Phụ', '2021-05-21 11:10:27', '2021-05-21 11:10:27'),
(45, 'Hội', '2021-05-26 14:20:26', '2021-05-26 14:20:26'),
(46, 'kết quả trúng thầu', '2021-06-22 01:32:35', '2021-06-22 01:32:35'),
(47, 'số điện thoại nhân viên trung tâm xúc tiến thương mại Bình Định', '2021-07-01 02:36:02', '2021-07-01 02:36:02'),
(48, 'Chấp thuận chủ trương đầu tư', '2021-11-21 07:19:07', '2021-11-21 07:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `file_flag` int(11) NOT NULL DEFAULT '0',
  `url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `legal` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  `department_id` int(5) DEFAULT NULL,
  `legal_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `duration` int(4) DEFAULT NULL,
  `more` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `file_flag`, `url`, `des`, `legal`, `status`, `type`, `department_id`, `legal_type`, `start_date`, `duration`, `more`, `created_at`, `updated_at`) VALUES
(1, 'UBND tỉnh có văn bản về việc đồng ý chủ trương cho Công ty cổ phần ĐT&XD Đông Dương Thăng Long vào khảo sát, lập quy hoạch chi tiết xây dựng tỷ lệ 1/500 dự án Khu đô thị ', 1, NULL, NULL, NULL, 1, 0, 5, 'UNDT tỉnh', '2020-12-01', 30, NULL, '2020-12-28 07:22:21', '2020-12-28 07:22:21'),
(2, 'UBND Tỉnh phê duyệt nhiệm vụ đồ án Quy hoạch chi tiết xây dựng tỷ lệ 1/500', 1, NULL, NULL, NULL, 0, 0, 5, 'UNDT tỉnh', '2021-01-27', 30, NULL, '2020-12-28 07:22:21', '2020-12-28 07:22:21'),
(3, 'UBND tỉnh Phê duyệt bổ sung kế hoạch phát triển nhà ở của dự án', 1, NULL, NULL, NULL, 0, 0, 5, 'UNDT tỉnh', NULL, NULL, '', '2020-12-28 07:23:02', '2020-12-28 07:23:02'),
(4, 'UBND tỉnh phê duyệt quy hoạch, kế hoạch sử dụng đất hàng năm cho dự án.', 1, NULL, NULL, NULL, 0, 0, 5, 'UNDT tỉnh', NULL, NULL, '', '2020-12-28 07:23:02', '2020-12-28 07:23:02'),
(6, 'Thủ tướng CP ra văn bản chấp thuận cho phép cho chuyển đồi đất trồng lúa để thực hiện dự án', 1, NULL, NULL, NULL, 0, 0, 5, 'Thủ tướng', NULL, NULL, '', '2020-12-28 07:24:07', '2020-12-28 07:24:07'),
(7, 'Lập, thẩm định Phê duyệt Dự án đầu tư ( BCNCKT)  và TKCS', 1, NULL, 'UBND tỉnh có văn bản Quyết đinh/ chấp thuận Đầu tư dự án nhà ở', NULL, 0, 0, 5, 'UNDT tỉnh', NULL, NULL, '', '2020-12-28 07:35:49', '2020-12-28 07:35:49'),
(8, 'Thẩm định nhu cầu sử dụng đất của dự án cùng với thời điểm thẩm định BC NCKT', 1, NULL, 'Thủ tướng CP ra văn bản chấp thuận cho phép cho chuyển đồi đất trồng lúa để thực hiện dự án', NULL, 0, 0, 5, 'UNDT tỉnh', NULL, NULL, '', '2020-12-28 07:35:49', '2020-12-28 07:35:49'),
(9, 'Bàn giao mốc giới ngoài thực địa để tổ chức xin Giấy phép xây dựng và thi công', 1, NULL, NULL, NULL, 0, 0, 5, 'Sở TNMT', NULL, NULL, '', '2020-12-28 07:36:50', '2020-12-28 07:36:50'),
(10, 'UBND Tỉnh ra Quyết định phê duyệt Quy hoạch  chi tiết xây dựng tỷ lệ 1/500', 1, NULL, NULL, NULL, 0, 0, 5, '', '2021-01-08', 30, 'test', '2020-12-28 07:40:38', '2020-12-28 07:40:38'),
(11, 'UBND tỉnh phê duyệt kết quả sơ tuyển  NĐT', 1, NULL, NULL, NULL, 0, 0, 5, '', NULL, NULL, '', '2020-12-28 07:47:49', '2020-12-28 07:47:49'),
(12, 'UBND tỉnh ra Quyết định phê duyệt Đơn vị trúng thầu Chủ đầu tư thực hiện dự án', 1, NULL, NULL, NULL, 0, 0, 5, '', NULL, NULL, '', '2020-12-28 07:51:41', '2020-12-28 07:51:41'),
(13, 'UBND tỉnh có văn bản Quyết đinh/ chấp thuận Đầu tư dự án nhà ở', 1, NULL, NULL, NULL, 0, 0, 5, '', NULL, NULL, '', '2020-12-28 07:53:04', '2020-12-28 07:53:04'),
(14, 'CĐT hoàn thành việc đầu tư xây dựng kết cấu hạ tầng gồm các công trình dịch vụ, công trình hạ tầng kỹ thuật, hạ tầng xã hội theo quy hoạch chi tiết xây dựng 1/500 đã được phê duyệt; đảm bảo kết nối với hệ thống hạ tầng chung', 1, NULL, NULL, NULL, 0, 0, NULL, '', NULL, NULL, '', '2020-12-28 16:00:30', '2020-12-28 16:00:30'),
(15, 'Chủ đầu tư phải hoàn thành nghĩa vụ tài chính liên quan đến đất đai của dự án gồm tiền sử dụng đất, tiền thuê đất; thuế, phí, lệ phí liên quan đến đất đai (nếu có);', 1, NULL, NULL, NULL, 0, 0, NULL, '', NULL, NULL, '', '2020-12-28 16:00:30', '2020-12-28 16:00:30'),
(16, 'Ủy ban nhân dân cấp tỉnh quy định cụ thể những khu vực được thực hiện chuyển quyền sử dụng đất đã được đầu tư hạ tầng cho người dân tự xây dựng nhà ở theo quy hoạch chi tiết của dự án đã được phê duyệt, sau khi có ý kiến thống nhất bằng văn bản của Bộ Xây dựng.', 1, NULL, NULL, NULL, 0, 0, NULL, '', NULL, NULL, '', '2020-12-28 16:00:43', '2020-12-28 16:00:43'),
(17, 'Bàn giao mốc giới ngoài thực địa để tổ chức xin Giấy phép xây dựng và thi công, cấp sổ đỏ cho chủ đầu tư', 1, NULL, NULL, NULL, 0, 0, NULL, '', NULL, NULL, '', '2020-12-28 16:01:39', '2020-12-28 16:01:39'),
(18, 'Văn bản thông báo cho cơ quan quản lý nhà ở cấp tỉnh về việc nhà ở đủ điều kiện được bán, cho thuê mua', 1, NULL, NULL, NULL, 0, 0, NULL, '', NULL, NULL, '', '2020-12-28 16:01:39', '2020-12-28 16:01:39'),
(21, 'Được ngân hàng thương mại có đủ năng lực thực hiện bảo lãnh nghĩa vụ tài chính của chủ đầu tư đối với khách hàng ', 1, NULL, NULL, NULL, 0, 0, NULL, '', NULL, NULL, '', '2020-12-28 16:04:41', '2020-12-28 16:04:41'),
(22, 'Hoàn thành công trình xây dựng (xây thô mặt ngoài)', 1, NULL, NULL, NULL, 0, 0, NULL, '', NULL, NULL, '', '2020-12-28 16:04:41', '2020-12-28 16:04:41'),
(23, 'Gửi hồ sơ tới Sở TNMT , ra Thông báo đủ điều kiện đưa vào chuyển nhượng', 1, NULL, NULL, NULL, 0, 0, NULL, '', NULL, NULL, '', '2020-12-28 16:04:51', '2020-12-28 16:04:51'),
(24, 'Bản đồ quy hoạch dự án 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, '', NULL, NULL, NULL, '2021-01-02 08:32:03', '2021-01-02 08:32:03'),
(25, 'lựa chọn đơn vị thiết kế bản vẽ thi công, lập dự toán', 0, NULL, NULL, NULL, 0, NULL, NULL, 'chủ đầu tư', NULL, NULL, NULL, '2021-03-09 10:18:05', '2021-03-09 10:18:05'),
(26, 'Lập, thẩm tra, trình thẩm định và phe duyệt thiết kế bản vẽ thi công, dự toán', 0, NULL, NULL, NULL, 0, NULL, NULL, 'chủ đầu tư', NULL, NULL, NULL, '2021-03-09 10:19:29', '2021-03-09 10:19:29'),
(27, 'lập và thẩm duyệt thiết kế thi công phòng cháy chữa cháy, dự toán', 0, NULL, NULL, NULL, 0, NULL, NULL, 'công an phòng cháy chữa cháy', NULL, NULL, NULL, '2021-03-09 10:20:42', '2021-03-09 10:20:42'),
(28, 'Phân chia gói thầu, phê duyệt dự toán gói thầu, lập và phê duyệt kế hoạch lựa chọn Nhà thầu thi công', 0, NULL, NULL, NULL, 0, NULL, NULL, 'chủ đầu tư', NULL, NULL, NULL, '2021-03-09 10:21:09', '2021-03-09 10:21:09'),
(29, 'Đấu thầu lựa chọn Nhà thầu thi công theo phân kỳ đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'chủ đầu tư', NULL, NULL, NULL, '2021-03-09 10:21:22', '2021-03-09 10:21:22'),
(30, 'Đàm phán ký kết hợp đồng thi công các gói thầu theo kế hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, 'chủ đầu tư', NULL, NULL, NULL, '2021-03-09 10:21:32', '2021-03-09 10:21:32'),
(31, 'xin phép xây dựng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-09 10:25:47', '2021-03-09 10:25:47'),
(32, 'tổ chức thi công hạ tầng kỹ thuật', 0, NULL, NULL, NULL, 0, NULL, NULL, 'nhà thầu', NULL, NULL, NULL, '2021-03-09 10:26:15', '2021-03-09 10:26:15'),
(33, 'cấp phép phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh phối hợp Bộ Xây dựng', NULL, NULL, NULL, '2021-03-09 10:29:39', '2021-03-09 10:29:39'),
(34, 'cấp phép bán nhà ở hình thành trong tương lai', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh phối hợp Bộ Xây dựng', NULL, NULL, NULL, '2021-03-09 10:30:05', '2021-03-09 10:30:05'),
(35, 'đấu nối nguồn nước', 0, NULL, NULL, NULL, 0, NULL, NULL, 'cơ quan nhà nước', NULL, NULL, NULL, '2021-03-09 10:30:45', '2021-03-09 10:30:45'),
(36, 'đấu nối đường điện', 0, NULL, NULL, NULL, 0, NULL, NULL, 'cơ quan nhà nước', NULL, NULL, NULL, '2021-03-09 10:30:58', '2021-03-09 10:30:58'),
(37, 'biện pháp xử lý chất thải', 0, NULL, NULL, NULL, 0, NULL, NULL, 'cơ quan nahf nước', NULL, NULL, NULL, '2021-03-09 10:31:17', '2021-03-09 10:31:17'),
(38, 'Quyết định về chủ trương đầu tư kèm theo Báo cáo đầu tư xây dựng công trình (báo cáo nghiên cứu tiền khả thi) hoặc quyết định phê duyệt chủ trương đầu tư.', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND', NULL, NULL, NULL, '2021-03-09 13:15:23', '2021-03-09 13:15:23'),
(39, 'Quyết định phê duyệt dự án đầu tư xây dựng công trình hoặc dự án thành phần của cấp có thẩm quyền kèm theo Dự án đầu tư xây dựng công trình (báo cáo nghiên cứu khả thi).', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND', NULL, NULL, NULL, '2021-03-09 13:15:47', '2021-03-09 13:15:47'),
(40, 'Phương án đền bù giải phóng mặt bằng và xây dựng tái định cư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:19:48', '2021-03-09 13:19:48'),
(41, 'Văn bản của các tổ chức, cơ quan nhà nước có thẩm quyền (nếu có) về: thỏa thuận quy hoạch, thỏa thuận hoặc chấp thuận sử dụng hoặc đấu nối với công trình kỹ thuật bên ngoài hàng rào; đánh giá tác động môi trường, đảm bảo an toàn (an toàn giao thông, an toàn các công trình lân cận) và các văn bản khác có liên quan.', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND', NULL, NULL, NULL, '2021-03-09 13:20:09', '2021-03-09 13:20:09'),
(42, 'Quyết định cấp đất, cho thuê đất của cơ quan có thẩm quyền hoặc hợp đồng thuê đất đối với trường hợp không được cấp đất.', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND', NULL, NULL, NULL, '2021-03-09 13:20:32', '2021-03-09 13:20:32'),
(43, 'Giấy phép xây dựng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND', NULL, NULL, NULL, '2021-03-09 13:20:52', '2021-03-09 13:20:52'),
(44, 'Quyết định chỉ định thầu, phê duyệt kết quả lựa chọn các nhà thầu và các hợp đồng giữa chủ đầu tư với các nhà thầu.', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND', NULL, NULL, NULL, '2021-03-09 13:21:02', '2021-03-09 13:21:02'),
(45, 'Quyết định chỉ định thầu, phê duyệt kết quả lựa chọn các nhà thầu và các hợp đồng giữa chủ đầu tư với các nhà thầu.', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND', NULL, NULL, NULL, '2021-03-09 13:23:03', '2021-03-09 13:23:03'),
(46, 'Hồ sơ khảo sát xây dựng:', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:26:15', '2021-03-09 13:26:15'),
(47, 'Kết quả thẩm tra, thẩm định thiết kế; quyết định phê duyệt thiết kế kỹ thuật, kèm theo: hồ sơ thiết kế kỹ thuật đã được phê duyệt (có danh mục bản vẽ kèm theo); chỉ dẫn kỹ thuật; văn bản thông báo kết quả thẩm tra thiết kế của cơ quan chuyên môn về xây dựng.', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND', NULL, NULL, NULL, '2021-03-09 13:26:24', '2021-03-09 13:26:24'),
(48, 'Hồ sơ thiết kế xây dựng công trình', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:26:36', '2021-03-09 13:26:36'),
(49, 'Hồ sơ pháp lý và hồ sơ quản lý chất lượng, hồ sơ hoàn công các Nhà thầu thi công', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:26:57', '2021-03-09 13:26:57'),
(50, 'Các kế hoạch, biện pháp kiểm tra, kiểm soát chất lượng thi công xây dựng công trình', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:27:05', '2021-03-09 13:27:05'),
(51, 'Các chứng chỉ xuất xứ, nhãn mác hàng hóa, công bố sự phù hợp về chất lượng của nhà sản xuất, chứng nhận hợp quy, chứng nhận hợp chuẩn (nếu có) theo quy định của Luật chất lượng sản phẩm hàng hóa, Luật Thương Mại và các quy định pháp luật khác có liên quan', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:27:14', '2021-03-09 13:27:14'),
(52, 'Các kết quả quan trắc, đo đạc, thí nghiệm trong quá trình thi công và quan trắc trong quá trình vận hành', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:27:27', '2021-03-09 13:27:27'),
(53, 'Các biên bản nghiệm thu công việc xây dựng, nghiệm thu giai đoạn (nếu có) trong quá trình thi công xây dựng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:27:34', '2021-03-09 13:27:34'),
(54, 'Các kết quả thí nghiệm đối chứng, kiểm định chất lượng công trình, thí nghiệm khả năng chịu lực kết cấu xây dựng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:27:42', '2021-03-09 13:27:42'),
(55, 'Quy trình vận hành, khai thác công trình, quy trình bảo trì', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:27:49', '2021-03-09 13:27:49'),
(56, 'Văn bản thỏa thuận,chấp thuận, xác nhận của các tổ chức, cơ quan Nhà nước có thẩm quyền về ngoại cảnh', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:27:58', '2021-03-09 13:27:58'),
(57, 'Biên bản nghiệm thu hoàn thành công trình, hạng mục công trình đưa vào sử dụng giữa Chủ đầu tư, Tư vấn Quản lý dự án giám sát thi công và các Nhà thầu thi công.', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CDT', NULL, NULL, NULL, '2021-03-09 13:28:52', '2021-03-09 13:28:52'),
(58, 'test1', 0, NULL, NULL, NULL, 0, NULL, NULL, 'chủ đầu tư', NULL, NULL, NULL, '2021-03-11 16:17:09', '2021-03-11 16:17:09'),
(59, 'CĐT có văn bản xin khảo sát thực địa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'chủ đầu tư', NULL, NULL, NULL, '2021-03-12 10:11:45', '2021-03-12 10:11:45'),
(60, 'UBND tỉnh đồng ý cho khảo sát ngoài thực địa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-12 10:13:31', '2021-03-12 10:13:31'),
(61, 'chuẩn bị đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'cơ quan nhà nước', NULL, NULL, NULL, '2021-03-12 10:17:07', '2021-03-12 10:17:07'),
(62, 'dsds', 0, NULL, NULL, NULL, 0, NULL, NULL, 'dsds', NULL, NULL, NULL, '2021-03-12 10:24:54', '2021-03-12 10:24:54'),
(63, 'xin khảo sát thực địa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'cơ quan nhà nước', NULL, NULL, NULL, '2021-03-12 10:27:03', '2021-03-12 10:27:03'),
(64, 'CĐT xin phép khảo sát ngoài thực địa', 0, NULL, NULL, NULL, 1, NULL, NULL, 'chủ đầu tư', NULL, NULL, NULL, '2021-03-17 08:21:27', '2021-03-17 08:21:27'),
(65, 'UBND tỉnh đồng ý cho khảo sát ngoài thực địa', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND  tỉnh', NULL, NULL, NULL, '2021-03-17 08:21:53', '2021-03-17 08:21:53'),
(66, 'CĐT xin lập quy hoạch 1/500; 1/2000', 0, NULL, NULL, NULL, 1, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 08:22:59', '2021-03-17 08:22:59'),
(67, 'UBND huyện xin ý kiến của UBND tỉnh', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 08:23:29', '2021-03-17 08:23:29'),
(68, 'UBND tỉnh đồng ý chủ trương để CĐT lập quy hoạch', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 08:23:59', '2021-03-17 08:23:59'),
(69, 'Sở xây dựng giới thiệu địa điểm khảo sát', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 08:24:28', '2021-03-17 08:24:28'),
(70, 'CĐT xin khảo sát, lập quy hoạch thực hiện dự án', 0, NULL, NULL, NULL, 1, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 08:25:05', '2021-03-17 08:25:05'),
(71, 'UBND tỉnh cho phép khảo sát, lập quy hoạch thực hiện dự án đầu tư', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 08:25:39', '2021-03-17 08:25:39'),
(72, 'Sở xây dựng báo cáo kết quả thẩm định nhiệm vụ, dự toán khảo sát', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 08:26:29', '2021-03-17 08:26:29'),
(73, 'UBND tỉnh phê duyệt nhiệm vụ, dự toán khảo sát', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 08:27:03', '2021-03-17 08:27:03'),
(74, 'UBND tỉnh tổ chức họp giữa CĐT và các sở ban nghành đề nghị giúp đỡ CĐT trong việc lập quy hoạch', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 08:28:19', '2021-03-17 08:28:19'),
(75, 'CĐT xin cấp thông tin chỉ giới đường đỏ, thông tin đấu nối giao thông', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở giao thông vận tải', NULL, NULL, NULL, '2021-03-17 08:29:06', '2021-03-17 08:29:06'),
(76, 'Sở GTVT trả lời về chỉ giới đường đỏ, đấu nối giao thông', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở giao thông vận tải', NULL, NULL, NULL, '2021-03-17 08:29:52', '2021-03-17 08:29:52'),
(77, 'UBND huyên cung cấp số liệu phục vụ quy hoạch', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 08:30:36', '2021-03-17 08:30:36'),
(78, 'CĐT trình sở XD đề nghị thẩm định dự toán : trính đo bản đồ khu vực đô thị mới xuân an', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 08:32:28', '2021-03-17 08:32:28'),
(79, 'CĐT đề nghị UBND tỉnh giao nhiệm vụ dự toán tiền sử dụng đất để thực hiện dự án đầu tư', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 08:34:01', '2021-03-17 08:34:01'),
(80, 'UBND tỉnh giao sở TNMT phối hợp sở ban ngành tính tiền SDĐ', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 08:34:47', '2021-03-17 08:34:47'),
(81, 'CĐT nộp, xin phê duyệt quy hoạch 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 08:35:45', '2021-03-17 08:35:45'),
(82, 'UBND tỉnh phê duyệt quy hoạch chi tiết 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 08:36:10', '2021-03-17 08:36:10'),
(83, 'CĐT trình xin chấp thuận chủ trương đầu tư', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh; Sở xây dựng, Sở TNMT', NULL, NULL, NULL, '2021-03-17 08:37:45', '2021-03-17 08:37:45'),
(84, 'UBND huyện đề nghị bổ sung kế hoạch sử dụng đất hằng năm', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 08:38:06', '2021-03-17 08:38:06'),
(85, 'UBND tỉnh giao các sở ban nggành tham mưu', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở KHĐT, sở TNMT; sở XD, sở TC', NULL, NULL, NULL, '2021-03-17 08:39:00', '2021-03-17 08:39:00'),
(86, 'UBND tỉnh phê duyệt chủ trương đầu tư', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 08:39:31', '2021-03-17 08:39:31'),
(87, 'CĐT đề nghị thu hồi đất, thành lập hội đồng đền bù giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 08:45:27', '2021-03-17 08:45:27'),
(88, 'UBND huyện tuyên truyền thực hiện giải phóng mặt bằng để hỗ trợ CĐT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 08:46:05', '2021-03-17 08:46:05'),
(89, 'UBND huyện ra quyết định thành lập hội đồng đền bù giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 08:46:32', '2021-03-17 08:46:32'),
(90, 'bàn giao mốc giới để giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 08:47:03', '2021-03-17 08:47:03'),
(91, 'CĐT cam kết đền bù và đưa ra mức chi phí hỗ trợ các hộ dân', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 08:47:47', '2021-03-17 08:47:47'),
(92, 'hội đồng đền bù GPMB tổ chức xác nhận các hộ, các cá nhân bị ảnh hưởng bởi GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'hội đồng GPMB', NULL, NULL, NULL, '2021-03-17 08:48:29', '2021-03-17 08:48:29'),
(93, 'UBND huyện phê duyệt phương án đền bù, giải phóng mặt bằng,; tái định cư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 08:49:07', '2021-03-17 08:49:07'),
(94, 'hội đồng GPMB yêu cầu CĐT chuyển kinh phí đền bù GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'hội đồng GPMB', NULL, NULL, NULL, '2021-03-17 08:49:58', '2021-03-17 08:49:58'),
(95, 'CĐT chuyển kinh phí', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 08:50:33', '2021-03-17 08:50:33'),
(96, 'CĐT đề nghị chuyển trả kinh phí thừa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'hội đồng GPMB', NULL, NULL, NULL, '2021-03-17 08:50:56', '2021-03-17 08:50:56'),
(97, 'CĐT xin bàn giao mặt bằng tạm thời để làm lễ khởi công', 0, NULL, NULL, NULL, 0, NULL, NULL, 'chủ đầu tư', NULL, NULL, NULL, '2021-03-17 08:51:27', '2021-03-17 08:51:27'),
(98, 'CĐT đề nghị chuyển đổi mục đích SDĐ trồng lúa', 0, NULL, NULL, NULL, 1, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 08:52:38', '2021-03-17 08:52:38'),
(99, 'UBND huyện rà soát và trình các diện tích cânf chuyển đổi', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 08:53:07', '2021-03-17 08:53:07'),
(100, 'sở TNMT đề nghị UBND tỉnh trình Thủ tướng chính phủ chuyển đổi mục đích SDĐ', 0, NULL, NULL, NULL, 1, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-03-17 08:54:19', '2021-03-17 08:54:19'),
(101, 'UBND tỉnh giao sở TNMT xin ý kiến các sở ban ngành', 0, NULL, NULL, NULL, 1, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-03-17 08:54:49', '2021-03-17 08:54:49'),
(102, 'UBND tỉnh trình thủ tướng CP về việc chuyển đổi mục đích sử dụng đất', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 08:55:47', '2021-03-17 08:55:47'),
(103, 'UBND huyện phê duyệt phương án đền bù, giải phóng mặt bằng,; tái định cư đợt 2', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 08:56:50', '2021-03-17 08:56:50'),
(104, 'Hội đồng GPMB báo cáo hoàn thành công tác đền bù GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'hội đồng GPMB', NULL, NULL, NULL, '2021-03-17 08:57:34', '2021-03-17 08:57:34'),
(105, 'CĐT đề nghị khảo sát di dời đường điện đang chạy qua dự án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 08:58:40', '2021-03-17 08:58:40'),
(106, 'Công ty điện lực cho phép di rời', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Công ty điện lực', NULL, NULL, NULL, '2021-03-17 08:59:00', '2021-03-17 08:59:00'),
(107, 'CĐT xin đấu nối nút giao thông tạm thời để phục vụ thi công', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 09:00:28', '2021-03-17 09:00:28'),
(108, 'CĐT gửi sở giao thông xin chấp thuận thiết kế nút giao thông tạm', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 09:01:00', '2021-03-17 09:01:00'),
(109, 'Sở GTVT chấp thuận thiết kế nút giao tạm thời', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở GTVT', NULL, NULL, NULL, '2021-03-17 09:01:31', '2021-03-17 09:01:31'),
(110, 'cấp giấy phép thi công cho nút giao tạm thời', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở giao thông vận tải', NULL, NULL, NULL, '2021-03-17 09:01:54', '2021-03-17 09:01:54'),
(111, 'CĐT yêu cầu thẩm duyệt hồ sơ thiết kế PCCC cho hạ tầng kỹ thuật dự án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 09:03:33', '2021-03-17 09:03:33'),
(112, 'Cấp giấy chứng nhận đã thẩm duyệt PCCC', 0, NULL, NULL, NULL, 0, NULL, NULL, 'công an phòng cháy chữa cháy', NULL, NULL, NULL, '2021-03-17 09:04:04', '2021-03-17 09:04:04'),
(113, 'CĐT báo cáo tiến độ dự án, xin bàn giao đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 09:27:54', '2021-03-17 09:27:54'),
(114, 'UBND tỉnh quyết định giao đất, cho thuê đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 09:28:27', '2021-03-17 09:28:27'),
(115, 'CĐT yêu cầu sở TNMT tiến hành bàn gioa đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-03-17 09:28:58', '2021-03-17 09:28:58'),
(116, 'bàn giao đất ngoài thực địa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-03-17 09:29:21', '2021-03-17 09:29:21'),
(117, 'CĐT đề nghị thông báo đủ điều kiện huy động vốn', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 09:43:31', '2021-03-17 09:43:31'),
(118, 'SXD thông báo đủ điều kiện huy động vốn xây dựng hạ tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'SXD', NULL, NULL, NULL, '2021-03-17 09:44:34', '2021-03-17 09:44:34'),
(119, 'CĐT xin ý kiến về cách xuất hóa đơn', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 09:44:51', '2021-03-17 09:44:51'),
(120, 'phê duyệt bản vẽ thi công và dự toán dự án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 09:48:25', '2021-03-17 09:48:25'),
(121, 'điều chỉnh xử lý hồ sơ theo tham vấn của các sở ban nghành', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 09:50:21', '2021-03-17 09:50:21'),
(122, 'Công ty tư vấn ngoài thẩm tra', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Công ty tư vấn', NULL, NULL, NULL, '2021-03-17 09:50:44', '2021-03-17 09:50:44'),
(123, 'Sở xây dựng thẩm định, yêu cầu bổ sung', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 09:51:14', '2021-03-17 09:51:14'),
(124, 'lên phương án hệ thống thoát nước mưa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 09:51:36', '2021-03-17 09:51:36'),
(125, 'thiết kế hệ tthống điện', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở công thương', NULL, NULL, NULL, '2021-03-17 09:52:09', '2021-03-17 09:52:09'),
(126, 'cấp giấy phép xây dựng hạ tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 09:52:37', '2021-03-17 09:52:37'),
(127, 'Hội đồng thẩm định giá đất để làm cơ sở tính tiền sử dụng đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh thành lập Hội đồng thẩm định giá', NULL, NULL, NULL, '2021-03-17 09:56:17', '2021-03-17 09:56:17'),
(128, 'UBND tỉnh phê duyệt giá đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 09:56:37', '2021-03-17 09:56:37'),
(129, 'CĐT cõ văn bản xin hưởng ưu đãi, miễn tiền thuế', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 09:57:03', '2021-03-17 09:57:03'),
(130, 'UBND huyện phê duyệt quyết toán tiền đền bù giải phóng mặt bằng làm cơ sở đối trừ tiền SDĐ cho CĐT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 09:58:31', '2021-03-17 09:58:31'),
(131, 'CĐT đề nghị khấu trừ tiền GPMB vào tiền SDĐ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 09:59:03', '2021-03-17 09:59:03'),
(132, 'Sở tài chính tính ra số tiền phải nôi còn lại,', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở tài chính', NULL, NULL, NULL, '2021-03-17 10:00:09', '2021-03-17 10:00:09'),
(133, 'Cục thuế thông báo tiền SDĐ mà CĐT phải nộp', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở tài chính', NULL, NULL, NULL, '2021-03-17 10:00:48', '2021-03-17 10:00:48'),
(134, 'CĐT nộp tiền SDĐ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:01:13', '2021-03-17 10:01:13'),
(135, 'CĐT đề nghị được cấp giấy CNQSDĐ tương ứng với số tiền SDĐ đã nộp', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:04:37', '2021-03-17 10:04:37'),
(136, 'cấp giấy CNQSDĐ cho CĐT đợt 1', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-03-17 10:05:10', '2021-03-17 10:05:10'),
(137, 'cấp giấy CNQSDĐ cho CĐT đợt 2', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-03-17 10:05:31', '2021-03-17 10:05:31'),
(138, 'CĐT đề nghị tách thửa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:05:48', '2021-03-17 10:05:48'),
(139, 'Sở TNMT tách thửa cho chủ đầu tư để tiện bán hàng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-03-17 10:06:32', '2021-03-17 10:06:32'),
(140, 'CĐT đề nghị SXD ra thông báo các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:11:43', '2021-03-17 10:11:43'),
(141, 'Sở xây dựng thông báo về các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 10:12:31', '2021-03-17 10:12:31'),
(142, 'CĐT gửi Sở xây dựng vv ra thông báo đủ điều kiện phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:13:39', '2021-03-17 10:13:39'),
(143, 'SXD có ý kiến lên UBND tỉnh', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 10:13:59', '2021-03-17 10:13:59'),
(144, 'UBND tỉnh yêu cầu SXD phối hợp kiểm tra các điều kiện phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 10:15:00', '2021-03-17 10:15:00'),
(145, 'SXD tham mưu UBND tỉnh về các điều kiện phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 10:15:31', '2021-03-17 10:15:31'),
(146, 'Bộ xây dựng cho ý kiến', 0, NULL, NULL, NULL, 0, NULL, NULL, 'bộ xây dựng', NULL, NULL, NULL, '2021-03-17 10:15:52', '2021-03-17 10:15:52'),
(147, 'UBND tỉnh ra quyết định về các lô được phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 10:16:19', '2021-03-17 10:16:19'),
(148, 'sở TNMT thông báo kiểm tra về điều kiện chuyển nhượng dưới hình thức phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-03-17 10:17:11', '2021-03-17 10:17:11'),
(149, 'UBND tỉnh cấp phép xả thải', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 10:19:03', '2021-03-17 10:19:03'),
(150, 'CĐT nộp thiết kế thi công nhà thấp tầng cho SXD', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:20:26', '2021-03-17 10:20:26'),
(151, 'SXD phê duyệt hồ sơ thiết kế thi công nhà ở thấp tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'SXD', NULL, NULL, NULL, '2021-03-17 10:21:01', '2021-03-17 10:21:01'),
(152, 'CĐT giao nhà thầu thực hiện mẫu nahf ở', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:22:39', '2021-03-17 10:22:39'),
(153, 'CĐT đề nghị thẩm định mẫu nhà ở LK', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:23:01', '2021-03-17 10:23:01'),
(154, 'SXD thông báo về kết quả thẩm định mẫu nhà ở LK', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 10:23:25', '2021-03-17 10:23:25'),
(155, 'CĐT nộp hồ sơ thiết kế TTTM xin thẩm định', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:26:05', '2021-03-17 10:26:05'),
(156, 'sở xây dựng thẩm định hồ sơ thiết kế TTTM', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 10:26:32', '2021-03-17 10:26:32'),
(157, 'CĐT xin cấp phép xây dựng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:26:56', '2021-03-17 10:26:56'),
(158, 'Sở xây dựng cấp giấy phép xây dựng TTTM', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 10:27:13', '2021-03-17 10:27:13'),
(159, 'CĐT đề nghị nghiệm thu các hạng mục PCCC', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:27:56', '2021-03-17 10:27:56'),
(160, 'công an PCCC nghiệm thu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'công an phòng cháy chữa cháy', NULL, NULL, NULL, '2021-03-17 10:28:14', '2021-03-17 10:28:14'),
(161, 'cấp giấy CNQSDĐ và quyền sở hữu nhà cho chủ đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-03-17 10:29:18', '2021-03-17 10:29:18'),
(162, 'CĐT đề nghị UBND tỉnh kiểm tra việc nghiệm thu hạ tầng kỹ thuật', 0, NULL, NULL, NULL, 1, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-17 10:33:00', '2021-03-17 10:33:00'),
(163, 'SXD thông báo kết quả kiểm tra, chỉ ra các hồ sơ còn thiếu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-17 10:33:31', '2021-03-17 10:33:31'),
(164, 'UBND tỉnh yêu cầu huyện và các sở ban nghành hỗ trợ CĐT hoàn thành nghiệm thu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 10:34:02', '2021-03-17 10:34:02'),
(165, 'UBND huyên xin ý kiến về việc bàn giao', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 10:34:26', '2021-03-17 10:34:26'),
(166, 'UBND tỉnh yêu cầu các sở ban nghành phối hợp nhận bàn giao hạ tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 10:35:08', '2021-03-17 10:35:08'),
(167, 'UBND Huyện nhận bàn giao ngoài thực địa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 10:35:40', '2021-03-17 10:35:40'),
(168, '6.UBND tỉnh ban hành quy định về quản lý công trình hạ tầng kỹ thuật', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 10:36:05', '2021-03-17 10:36:05'),
(169, 'thu hồi, hủy, hồ sơ cũ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 10:36:21', '2021-03-17 10:36:21'),
(170, 'UBND huyện xin ý  kiến sở XD', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-17 10:38:21', '2021-03-17 10:38:21'),
(171, 'ban hành quy định quản lý theo đồ án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-17 10:38:40', '2021-03-17 10:38:40'),
(172, 'Thủ tướng chính phủ chấp thuận chuyền đổi mục đích sử dụng đất', 0, NULL, NULL, NULL, 1, NULL, NULL, 'thủ tướng chính phủ', NULL, NULL, NULL, '2021-03-20 01:42:13', '2021-03-20 01:42:13'),
(173, 'cục thuế thông báo đóng tiền thuê đất (với phần đất thuê)', 0, NULL, NULL, NULL, 0, NULL, NULL, 'cục thuế', NULL, NULL, NULL, '2021-03-20 05:53:33', '2021-03-20 05:53:33'),
(174, 'CĐT trình UBND huyện xin khảo sất, lập quy hoạch 1/500; 1/2000 GĐ2', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-24 07:24:51', '2021-03-24 07:24:51'),
(175, 'UBND huyện xin chủ trương của UBND tỉnh về lập quy hoạch chi tiết 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-24 07:25:32', '2021-03-24 07:25:32'),
(176, 'UBND tỉnh giao SXD phối hợp các sở ban nghành tham mưu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-24 07:25:54', '2021-03-24 07:25:54'),
(177, 'ubnd tỉnh chấp thuận để UBND huyện lập quy hoạch chi tiết 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-24 07:26:20', '2021-03-24 07:26:20'),
(178, 'CĐT xin tài trợ UBND tỉnh trong việc lập quy hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-24 07:26:38', '2021-03-24 07:26:38'),
(179, 'CĐT chỉ định thầu lập bản đồ hiện trạng khu đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-24 07:27:13', '2021-03-24 07:27:13'),
(180, 'CĐT chỉ định thầu lập nhiệm vụ, quy hoạch chi tiết xây dựng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-24 07:27:52', '2021-03-24 07:27:52'),
(181, 'CĐT trình UBND huyện phê duyệt nhiệm vụ khảo sát và nhiệm vụ thiết kế chi tiết 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-03-24 07:28:32', '2021-03-24 07:28:32'),
(182, 'UBND huyện trình SXD và UBND tỉnh phê duyệt nhiệm vụ khảo sát và nhiệm vụ lập quy hoạch 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-03-24 07:29:30', '2021-03-24 07:29:30'),
(183, 'SXD báo cáo kết quả thẩm định nhiệm vụ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-03-24 07:29:58', '2021-03-24 07:29:58'),
(184, 'UBND tỉnh phê duyệt nhiệm vụ, dự toán khảo sát và lập quy hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-24 07:30:34', '2021-03-24 07:30:34'),
(185, 'UBND tỉnh tổ chức họp giữa CĐT và các sở ban nghành đề nghị giúp đỡ CĐT trong việc lập quy hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, '11', NULL, NULL, NULL, '2021-03-24 07:31:36', '2021-03-24 07:31:36'),
(186, 'UBND tỉnh tổ chức họp giữa CĐT và các sở ban nghành đề nghị giúp đỡ CĐT trong việc lập quy hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, '11', NULL, NULL, NULL, '2021-03-24 07:31:50', '2021-03-24 07:31:50'),
(187, 'UBND tỉnh tổ chức họp giữa CĐT và các sở ban nghành đề nghị giúp đỡ CĐT trong việc lập quy hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, '11', NULL, NULL, NULL, '2021-03-24 07:37:08', '2021-03-24 07:37:08'),
(188, 'UBND tỉnh tổ chức họp giữa CĐT và các sở ban nghành đề nghị giúp đỡ CĐT trong việc lập quy hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, '11', NULL, NULL, NULL, '2021-03-24 07:37:20', '2021-03-24 07:37:20'),
(189, 'UBND tỉnh tổ chức họp giữa CĐT và các sở ban nghành đề nghị giúp đỡ CĐT trong việc lập quy hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, '11', NULL, NULL, NULL, '2021-03-24 07:37:31', '2021-03-24 07:37:31'),
(190, 'UBND tỉnh tổ chức họp giữa CĐT và các sở ban nghành đề nghị giúp đỡ CĐT trong việc lập quy hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, '11', NULL, NULL, NULL, '2021-03-24 07:37:45', '2021-03-24 07:37:45'),
(191, 'UBND tỉnh tổ chức họp giữa CĐT và các sở ban nghành đề nghị giúp đỡ CĐT trong việc lập quy hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-24 07:37:59', '2021-03-24 07:37:59'),
(192, 'cấp số liệu để lập quy hoạch 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện, sở ban nghành', NULL, NULL, NULL, '2021-03-24 07:39:25', '2021-03-24 07:39:25'),
(193, 'UBND tỉnh phê duyệt quy hoạch chi tiết 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-03-24 07:40:29', '2021-03-24 07:40:29'),
(194, 'Đề xuất dự án gửi thủ tướng chính phủ', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-04-02 02:03:47', '2021-04-02 02:03:47'),
(195, 'UBND tỉnh phê duyệt đồ án chi tiết 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-04-02 02:06:19', '2021-04-02 02:06:19'),
(196, 'CĐT gửi văn bản xin đầu tư tới UBND tỉnh Hòa BÌnh', 0, NULL, NULL, NULL, 1, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-04-02 02:10:22', '2021-04-02 02:10:22'),
(197, 'UBND tỉnh giao các sở ban nghành rà soát. báo cáo', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-04-02 02:11:44', '2021-04-02 02:11:44'),
(198, 'SXD xin ý kiến các sở ban nghành về việc cho phép CĐT khảo sát lập dự án', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-04-02 02:13:27', '2021-04-02 02:13:27'),
(199, 'Sở nông nghiệp trả lời', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở nông nghiệp', NULL, NULL, NULL, '2021-04-02 02:14:43', '2021-04-02 02:14:43'),
(200, 'sở tài nguyên môi trường trả lời', 0, NULL, NULL, NULL, 1, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-04-02 02:16:09', '2021-04-02 02:16:09'),
(201, 'SXD trình UBND tỉnh thu hồi các quyết định cũ về việc cho các công ty khác  khảo sát tại vị trí này nhưng không tiến hành', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-04-02 02:18:09', '2021-04-02 02:18:09'),
(202, 'SXD đề xuất UBND tỉnh cho phép CĐT khảo sát lập quy hoạch', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-04-02 02:18:44', '2021-04-02 02:18:44'),
(203, 'UBND tỉnh đồng ý cho phép CĐT vào khảo sát lập quy hoạch 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-04-02 02:21:37', '2021-04-02 02:21:37'),
(204, 'CĐT trình thẩm định nhiệm vụ thiết kế quy hoạch chi tiết 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-04-02 02:32:10', '2021-04-02 02:32:10'),
(205, 'lấy ý kiến các hộ dân cư', 0, NULL, NULL, NULL, 1, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-04-02 02:33:40', '2021-04-02 02:33:40'),
(206, 'xin sở nông nghiệp xác nhận trong dự án có đất rừng tự nhiên không', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở nông nghiệp', NULL, NULL, NULL, '2021-04-02 02:35:12', '2021-04-02 02:35:12'),
(207, 'sxd trình UBND tỉnh phê duyệt đồ án quy hoach 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-04-02 02:38:10', '2021-04-02 02:38:10'),
(208, 'Điều chỉnh cục bộ quy hoạch', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 02:29:41', '2021-10-05 02:29:41'),
(209, '1. UBND Phê duyệt quy hoạch phân khu 1/2000', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh Bình Định', NULL, NULL, NULL, '2021-10-05 04:16:09', '2021-10-05 04:16:09'),
(210, 'Sở KHĐT lấy ý kiến các Sở', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT tỉnh Bình Đình', NULL, NULL, NULL, '2021-10-05 04:27:06', '2021-10-05 04:27:06'),
(211, '2. Sở Tài chính ý kiến về đất BVYHCT: thuộc tiểu khu 1', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài chính', NULL, NULL, NULL, '2021-10-05 04:37:14', '2021-10-05 04:37:14'),
(212, 'Sở Tài chính đề nghị UBND xây dựng quy hoạch 1/500 Tiểu khu 1', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài chính', NULL, NULL, NULL, '2021-10-05 04:44:02', '2021-10-05 04:44:02'),
(213, '2. Sở KHĐT đề nghị các sở ban ngành cung cấp thông tin', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 04:49:31', '2021-10-05 04:49:31'),
(214, '2. Sở Tài chính đề nghị xây dựng quy hoạch 1/500 cho Tiểu khu 1', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài chính', NULL, NULL, NULL, '2021-10-05 04:50:16', '2021-10-05 04:50:16'),
(215, '2. Sở KHĐT đề xuất UBND tỉnh thực tổ chức đấu thầu, đưa BVYHCT vào giá trị m2', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 04:53:23', '2021-10-05 04:53:23'),
(216, 'UBND tỉnh phê duyệt giá trị tài sản BVYHCT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 04:55:41', '2021-10-05 04:55:41'),
(217, '2. UBND tỉnh giao SXD là bên mời thầu, giao STC định giá BVYHCT để đưa vào m2', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 05:00:24', '2021-10-05 05:00:24'),
(218, '2. UBND tỉnh phê duyệt giá trị tài sản BVYHCT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 05:01:01', '2021-10-05 05:01:01'),
(219, '3. UBND tỉnh phê duyệt điều chỉnh quy hoạch 1/2000', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 05:02:21', '2021-10-05 05:02:21'),
(220, '1. Nhà đầu tư xin tài trợ kinh phí để lập QH 1/2000', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 05:22:21', '2021-10-05 05:22:21'),
(221, '2. SXD đề nghị huyện lấy ý kiến cộng đồng dân cư về điều chỉnh quy hoạch 1 phần 2000', 0, NULL, NULL, NULL, 1, NULL, NULL, 'Sở Xây Dựng', NULL, NULL, NULL, '2021-10-05 05:23:13', '2021-10-05 05:23:13'),
(222, 'SXD trình điều chỉnh nhiệm vụ quy hoạch 1/2000', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-10-05 05:25:05', '2021-10-05 05:25:05'),
(223, '4. UBND tỉnh chấp thuận chủ trương lập quy hoạch 1/2000', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 05:25:45', '2021-10-05 05:25:45'),
(224, '5. SXD trình kế hoạch lựa chọn nhà thầu lập QH 1/2000', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-10-05 05:26:06', '2021-10-05 05:26:06'),
(225, '6.UBND tỉnh phê duyệt kế hoạch lựa chọn nhà thầu lập QH 1/2000', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 05:26:55', '2021-10-05 05:26:55'),
(226, '7.SXD trình UBND tỉnh phê duyệt QH 1/2000', 0, NULL, NULL, NULL, 1, NULL, NULL, 'Sở xây dựng', NULL, NULL, NULL, '2021-10-05 05:27:10', '2021-10-05 05:27:10'),
(227, '8.UBND tỉnh phê duyệt điều chỉnh quy hoạch 1/2000', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 05:27:25', '2021-10-05 05:27:25'),
(228, '1.UBND tỉnh chủ trương giao SKHĐT chủ trì lấy ý kiến các sở ban nghành về chấp thuận CTĐT', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 05:30:50', '2021-10-05 05:30:50'),
(229, 'Sở KHĐT lấy ý kiến của các sở ban ngành', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở kế hoạch đầu tư', NULL, NULL, NULL, '2021-10-05 05:31:30', '2021-10-05 05:31:30'),
(230, 'SKHĐT báo cáo thẩm định về chủ trương đầu tư lên UBND tỉnh', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở kế hoạch đầu tư', NULL, NULL, NULL, '2021-10-05 05:32:14', '2021-10-05 05:32:14'),
(231, 'UBND tỉnh chấp thuận chủ trương đầu tư (lựa chọn nhà đầu tư)', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 05:32:46', '2021-10-05 05:32:46'),
(232, '', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Nhà đầu tư', NULL, NULL, NULL, '2021-10-05 05:33:45', '2021-10-05 05:33:45'),
(233, 'Đền bù giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 05:34:05', '2021-10-05 05:34:05'),
(234, 'UBND tỉnh giao đất, cho thuê đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 05:35:10', '2021-10-05 05:35:10'),
(235, 'CĐT nộp tiền thuê đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 05:35:31', '2021-10-05 05:35:31'),
(236, 'xin cấp sổ đỏ cho CĐT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-05 05:36:22', '2021-10-05 05:36:22'),
(237, 'xin phép xây dựng hạ tầng (thiết kế cơ sở giao thông, điện, nước)', 0, NULL, NULL, NULL, 0, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-10-05 05:37:00', '2021-10-05 05:37:00'),
(238, 'xin phép khai thác nước ngầm', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-05 05:37:34', '2021-10-05 05:37:34'),
(239, 'thông báo cho thuê lại đất dịch vụ (nếu cho thuê lại)', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 05:38:42', '2021-10-05 05:38:42'),
(240, 'Bàn giao', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 07:27:35', '2021-10-05 07:27:35'),
(241, 'quyết toán', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 07:27:46', '2021-10-05 07:27:46'),
(242, '1. Sở KHĐT đề nghị SXD công bố thông tin dự án, triển khai mời thầu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 07:30:33', '2021-10-05 07:30:33'),
(243, '2. UBND huyện tạm tính giá trị GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện Phù Cát', NULL, NULL, NULL, '2021-10-05 07:32:56', '2021-10-05 07:32:56'),
(244, '2. Sở TNMT trình UBND tỉnh phê duyệt chi phí GPMB sơ bộ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-05 07:37:27', '2021-10-05 07:37:27'),
(245, '2. UBND tỉnh phê duyệt chi phí GPMB sơ bộ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 07:38:48', '2021-10-05 07:38:48'),
(246, '2. Sở Tài chính tạm tính giá sàn m3', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài chính', NULL, NULL, NULL, '2021-10-05 07:44:53', '2021-10-05 07:44:53'),
(247, '3. Sở KHĐT đề nghị UBND tỉnh phê duyệt danh mục dự án có sử dụng đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 07:47:17', '2021-10-05 07:47:17'),
(248, '3. UBND tỉnh phê duyệt danh mục dự án có sử dụng đất để đấu thầu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 07:49:15', '2021-10-05 07:49:15'),
(249, 'sở TNMT gửi thông báo yêu cầu CĐT ký quỹ thực hiện dự án', 0, NULL, NULL, NULL, 1, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-10-05 07:49:24', '2021-10-05 07:49:24'),
(250, 'nhà đầu tư xin gia hạn thời gian đóng tiền ký quỹ', 0, NULL, NULL, NULL, 1, NULL, NULL, 'Nhà đầu tư', NULL, NULL, NULL, '2021-10-05 07:49:47', '2021-10-05 07:49:47'),
(251, 'UBND tỉnh dồng ý cho gia hạn thời gian ký quỹ', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 07:50:09', '2021-10-05 07:50:09'),
(252, '4. Sở KHĐT thông báo mời quan tâm dự án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 07:51:05', '2021-10-05 07:51:05'),
(253, '4. Sở KHĐT báo cáo UBND kết quả chấm thầu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 07:52:40', '2021-10-05 07:52:40'),
(254, 'SXD trình phê duyệt nhiệm vụ quy hoạch 1/500 lên UBND tỉnh', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-10-05 07:53:58', '2021-10-05 07:53:58'),
(255, 'UBND tỉnh phê duyệt nhiệm vụ quy hoạch 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 07:54:17', '2021-10-05 07:54:17'),
(256, '4. UBND tỉnh phê duyệt kết quả đánh giá năng lực NĐT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 07:54:38', '2021-10-05 07:54:38'),
(257, 'NĐT trình thẩm định phê duyệt quy hoạch 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'NĐT', NULL, NULL, NULL, '2021-10-05 07:54:52', '2021-10-05 07:54:52'),
(258, 'sở xây dựng lấy ý kiến các sở ban ngành và ubnd huyện về quy hoạch 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở xây dựng', NULL, NULL, NULL, '2021-10-05 07:56:27', '2021-10-05 07:56:27'),
(259, 'các sở ban nghành trả lời về quy hoạch 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'sở nông nghiệp, sở xây dựng,', NULL, NULL, NULL, '2021-10-05 07:57:26', '2021-10-05 07:57:26'),
(260, 'UBND tỉnh hướng dẫn hồ sơ chấp thuận chủ trương đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 07:57:35', '2021-10-05 07:57:35'),
(261, 'NĐT trình thẩm định phê duyệt đồ án điều chỉnh quy hoạch 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'NĐT', NULL, NULL, NULL, '2021-10-05 07:58:28', '2021-10-05 07:58:28'),
(262, 'sở xây dựng trình UBND tỉnh phê duyệt quy hoạch 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 07:59:16', '2021-10-05 07:59:16'),
(263, 'UBND tỉnh phê duyệt quy hoạch chi tiết 1/500', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 08:00:02', '2021-10-05 08:00:02'),
(264, 'NĐT nhờ UBND huyện hỗ trợ đền bù giải phóng mặt bằng', 0, NULL, NULL, NULL, 1, NULL, NULL, 'Nhà đầu tư', NULL, NULL, NULL, '2021-10-05 08:04:14', '2021-10-05 08:04:14'),
(265, 'UBND huyện trả lời về việc hỗ trợ ĐBGPMB', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 08:04:36', '2021-10-05 08:04:36'),
(266, 'thành lập hội đồng đèn bù GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 08:05:32', '2021-10-05 08:05:32'),
(267, 'CĐT cam kết đền bù và đưa ra mức chi phí hỗ trợ các hộ dân', 0, NULL, NULL, NULL, 0, NULL, NULL, '4', NULL, NULL, NULL, '2021-10-05 08:05:59', '2021-10-05 08:05:59'),
(268, 'kiểm đếm, xác nhận các hộ dân bị ảnh hưởng và tái sản trên đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 08:06:27', '2021-10-05 08:06:27'),
(269, 'UBND huyện phê duyệt phương án đền bù giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 08:07:12', '2021-10-05 08:07:12'),
(270, 'CĐT chuyển kinh phí đền bù GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 08:07:28', '2021-10-05 08:07:28'),
(271, 'báo cáo hoàn thành công tác đền bù GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'hội đồng GPMB', NULL, NULL, NULL, '2021-10-05 08:07:53', '2021-10-05 08:07:53'),
(272, 'Sở KHĐT hướng dẫn NĐT nộp hồ sơ CTCTĐT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 08:08:32', '2021-10-05 08:08:32'),
(273, 'CĐT báo cáo tiến độ dự án, xin bàn giao đất. ký hđ thuê đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 08:09:43', '2021-10-05 08:09:43'),
(274, 'UBND tỉnh quyết định giao đất, cho thuê đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 08:09:59', '2021-10-05 08:09:59'),
(275, 'CĐT yêu cầu sở TNMT tiến hành bàn gioa đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 08:10:09', '2021-10-05 08:10:09'),
(276, 'bàn giao đất ngoài thực địa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-10-05 08:10:26', '2021-10-05 08:10:26'),
(277, 'UBND tỉnh phê duyệt giá thuê đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 08:11:29', '2021-10-05 08:11:29'),
(278, 'cục thuế thông báo đóng tiền thuê đất (với phần đất thuê)', 0, NULL, NULL, NULL, 0, NULL, NULL, 'cục thuế', NULL, NULL, NULL, '2021-10-05 08:12:01', '2021-10-05 08:12:01');
INSERT INTO `task` (`id`, `name`, `file_flag`, `url`, `des`, `legal`, `status`, `type`, `department_id`, `legal_type`, `start_date`, `duration`, `more`, `created_at`, `updated_at`) VALUES
(279, 'CĐT nộp tiền thuê đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 08:12:17', '2021-10-05 08:12:17'),
(280, 'Sở KHĐT lấy ý kiến các sở ngành về dự án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 08:14:34', '2021-10-05 08:14:34'),
(281, 'CĐT đề nghị được cấp giấy CNQSDĐ cho phần đất thuê', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 08:14:35', '2021-10-05 08:14:35'),
(282, 'cấp giấy chứng nhận QSDĐ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài nguyên Môi trường', NULL, NULL, NULL, '2021-10-05 08:15:19', '2021-10-05 08:15:19'),
(283, 'CĐT nộp tiền ký quỹ hoặc bảo lãnh thực hiện dự án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 08:50:10', '2021-10-05 08:50:10'),
(284, 'CĐT xin khảo sát, lập quy hoạch thực hiện dự án', 0, NULL, NULL, NULL, 1, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 08:55:04', '2021-10-05 08:55:04'),
(285, 'UBND tỉnh đồng ý cho khảo sát ngoài thực địa', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 08:55:18', '2021-10-05 08:55:18'),
(286, '1. Sở KHĐT hướng dẫn NĐT nộp hồ sơ Chấp thuận chủ trương đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 09:19:06', '2021-10-05 09:19:06'),
(287, '2. Sở KHĐT lấy ý kiến thẩm định dự án, chấp thuận chủ trương đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 09:22:52', '2021-10-05 09:22:52'),
(288, 'CĐT đề nghị UBND tỉnh kiểm tra việc nghiệm thu hạ tầng kỹ thuật', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 09:56:27', '2021-10-05 09:56:27'),
(289, 'SXD thông báo kết quả kiểm tra, chỉ ra các hồ sơ còn thiếu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 09:56:44', '2021-10-05 09:56:44'),
(290, 'UBND tỉnh yêu cầu huyện và các sở ban nghành hỗ trợ CĐT hoàn thành nghiệm thu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 09:56:58', '2021-10-05 09:56:58'),
(291, 'UBND huyện xin ý kiến về việc bàn giao', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 09:57:19', '2021-10-05 09:57:19'),
(292, 'UBND tỉnh yêu cầu các sở ban ngành phối hợp nhận bàn giao hạ tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 09:59:59', '2021-10-05 09:59:59'),
(293, '3. Sở KHĐT trình UBND tỉnh phê duyệt chấp thuận chủ trương đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-05 10:03:19', '2021-10-05 10:03:19'),
(294, '4. UBND tỉnh phê duyệt chấp thuận chủ trương đầu tư', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 10:03:47', '2021-10-05 10:03:47'),
(295, 'UBND Huyện nhận bàn giao ngoài thực địa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 10:05:51', '2021-10-05 10:05:51'),
(296, 'UBND tỉnh ban hành quy định về quản lý công trình hạ tầng kỹ thuật', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 10:06:55', '2021-10-05 10:06:55'),
(297, 'Thu hồi, hủy, hồ sơ cũ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 10:08:09', '2021-10-05 10:08:09'),
(298, 'CĐT đề nghị thu hồi đất, thành lập hội đồng đền bù giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:13:02', '2021-10-05 10:13:02'),
(299, 'UBND huyện tuyên truyền thực hiện giải phóng mặt bằng để hỗ trợ CĐT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 10:13:16', '2021-10-05 10:13:16'),
(300, 'UBND huyện ra quyết định thành lập hội đồng đền bù giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 10:13:28', '2021-10-05 10:13:28'),
(301, 'Bàn giao mốc giới để giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND - CĐT', NULL, NULL, NULL, '2021-10-05 10:14:32', '2021-10-05 10:14:32'),
(302, 'CĐT cam kết đền bù và đưa ra mức chi phí hỗ trợ các hộ dân', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:15:05', '2021-10-05 10:15:05'),
(303, 'Hội đồng đền bù GPMB tổ chức xác nhận các hộ, các cá nhân bị ảnh hưởng bởi GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 10:15:48', '2021-10-05 10:15:48'),
(304, 'UBND huyện phê duyệt phương án đền bù, giải phóng mặt bằng,; tái định cư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 10:16:18', '2021-10-05 10:16:18'),
(305, 'hội đồng GPMB yêu cầu CĐT chuyển kinh phí đền bù GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:16:30', '2021-10-05 10:16:30'),
(306, 'CĐT chuyển kinh phí', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:16:53', '2021-10-05 10:16:53'),
(307, 'CĐT đề nghị chuyển trả kinh phí thừa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:17:06', '2021-10-05 10:17:06'),
(308, 'CĐT xin bàn giao mặt bằng tạm thời để làm lễ khởi công', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 10:17:22', '2021-10-05 10:17:22'),
(309, 'UBND huyện phê duyệt phương án đền bù, giải phóng mặt bằng,; tái định cư đợt 2', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 10:17:40', '2021-10-05 10:17:40'),
(310, 'Hội đồng GPMB báo cáo hoàn thành công tác đền bù GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 10:25:02', '2021-10-05 10:25:02'),
(311, 'CĐT xin đấu nối nút giao thông tạm thời để phục vụ thi công', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:33:35', '2021-10-05 10:33:35'),
(312, 'CĐT gửi sở giao thông xin chấp thuận thiết kế nút giao thông tạm', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:34:07', '2021-10-05 10:34:07'),
(313, 'Sở GTVT chấp thuận thiết kế nút giao tạm thời', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở GTVT', NULL, NULL, NULL, '2021-10-05 10:34:22', '2021-10-05 10:34:22'),
(314, 'cấp giấy phép thi công cho nút giao tạm thời', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở GTVT', NULL, NULL, NULL, '2021-10-05 10:35:26', '2021-10-05 10:35:26'),
(315, 'CĐT yêu cầu thẩm duyệt hồ sơ thiết kế PCCC cho hạ tầng kỹ thuật dự án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:36:14', '2021-10-05 10:36:14'),
(316, 'Phòng CS PCCC Cấp giấy chứng nhận đã thẩm duyệt PCCC', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Phòng CS PCCC', NULL, NULL, NULL, '2021-10-05 10:36:58', '2021-10-05 10:36:58'),
(317, 'CĐT báo cáo tiến độ dự án, xin bàn giao đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:37:57', '2021-10-05 10:37:57'),
(318, 'UBND tỉnh quyết định giao đất, cho thuê đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 10:38:10', '2021-10-05 10:38:10'),
(319, 'CĐT yêu cầu sở TNMT tiến hành bàn gioa đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:38:29', '2021-10-05 10:38:29'),
(320, 'bàn giao đất ngoài thực địa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT - CĐT', NULL, NULL, NULL, '2021-10-05 10:39:31', '2021-10-05 10:39:31'),
(321, 'CĐT đề nghị thông báo đủ điều kiện huy động vốn', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:40:36', '2021-10-05 10:40:36'),
(322, 'SXD thông báo đủ điều kiện huy động vốn xây dựng hạ tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 10:40:46', '2021-10-05 10:40:46'),
(323, 'CĐT xin ý kiến về cách xuất hóa đơn', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:40:58', '2021-10-05 10:40:58'),
(324, 'phê duyệt bản vẽ thi công và dự toán dự án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:42:21', '2021-10-05 10:42:21'),
(325, 'điều chỉnh xử lý hồ sơ theo tham vấn của các sở ban nghành', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:42:44', '2021-10-05 10:42:44'),
(326, 'Công ty tư vấn ngoài thẩm tra', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Công ty tư vấn', NULL, NULL, NULL, '2021-10-05 10:43:17', '2021-10-05 10:43:17'),
(327, 'Sở xây dựng thẩm định, yêu cầu bổ sung', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 10:43:30', '2021-10-05 10:43:30'),
(328, 'Lên phương án hệ thống thoát nước mưa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 10:44:19', '2021-10-05 10:44:19'),
(329, 'cấp giấy phép xây dựng hạ tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 10:47:19', '2021-10-05 10:47:19'),
(330, 'Hội đồng thẩm định giá đất để làm cơ sở tính tiền sử dụng đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 10:52:43', '2021-10-05 10:52:43'),
(331, 'UBND tỉnh phê duyệt giá đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 10:53:10', '2021-10-05 10:53:10'),
(332, 'CĐT cõ văn bản xin hưởng ưu đãi, miễn tiền thuế', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:53:34', '2021-10-05 10:53:34'),
(333, 'UBND huyện phê duyệt quyết toán tiền đền bù giải phóng mặt bằng làm cơ sở đối trừ tiền SDĐ cho CĐT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 10:53:52', '2021-10-05 10:53:52'),
(334, 'CĐT đề nghị khấu trừ tiền GPMB vào tiền SDĐ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:54:02', '2021-10-05 10:54:02'),
(335, 'Sở tài chính tính ra số tiền phải nôi còn lại,', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài chính', NULL, NULL, NULL, '2021-10-05 10:54:18', '2021-10-05 10:54:18'),
(336, 'Cục thuế thông báo tiền SDĐ mà CĐT phải nộp', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Cục thuế', NULL, NULL, NULL, '2021-10-05 10:54:36', '2021-10-05 10:54:36'),
(337, 'CĐT nộp tiền SDĐ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:54:52', '2021-10-05 10:54:52'),
(338, 'cục thuế thông báo đóng tiền thuê đất (với phần đất thuê)', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Cục thuế', NULL, NULL, NULL, '2021-10-05 10:55:12', '2021-10-05 10:55:12'),
(339, 'CĐT đề nghị được cấp giấy CNQSDĐ tương ứng với số tiền SDĐ đã nộp', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:55:44', '2021-10-05 10:55:44'),
(340, 'cấp giấy CNQSDĐ cho CĐT đợt 1', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-05 10:56:17', '2021-10-05 10:56:17'),
(341, 'cấp giấy CNQSDĐ cho CĐT đợt 2', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-05 10:56:34', '2021-10-05 10:56:34'),
(342, 'CĐT đề nghị tách thửa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:56:42', '2021-10-05 10:56:42'),
(343, 'Sở TNMT tách thửa cho chủ đầu tư để tiện bán hàng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-05 10:56:53', '2021-10-05 10:56:53'),
(344, 'CĐT đề nghị SXD ra thông báo các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:57:46', '2021-10-05 10:57:46'),
(345, 'Sở xây dựng thông báo về các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 10:58:06', '2021-10-05 10:58:06'),
(346, 'CĐT gửi Sở xây dựng vv ra thông báo đủ điều kiện phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 10:58:37', '2021-10-05 10:58:37'),
(347, 'SXD có ý kiến lên UBND tỉnh', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 10:58:48', '2021-10-05 10:58:48'),
(348, 'UBND tỉnh yêu cầu SXD phối hợp kiểm tra các điều kiện phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 10:58:58', '2021-10-05 10:58:58'),
(349, 'SXD tham mưu UBND tỉnh về các điều kiện phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 10:59:16', '2021-10-05 10:59:16'),
(350, 'Bộ xây dựng cho ý kiến', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Bộ Xây dựng', NULL, NULL, NULL, '2021-10-05 10:59:27', '2021-10-05 10:59:27'),
(351, 'UBND tỉnh ra quyết định về các lô được phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 10:59:40', '2021-10-05 10:59:40'),
(352, 'sở TNMT thông báo kiểm tra về điều kiện chuyển nhượng dưới hình thức phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-05 10:59:53', '2021-10-05 10:59:53'),
(353, 'CĐT đề nghị SXD ra thông báo các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 11:01:33', '2021-10-05 11:01:33'),
(354, 'Sở xây dựng thông báo về các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 11:01:44', '2021-10-05 11:01:44'),
(355, 'UBND tỉnh cấp phép xả thải', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 11:03:09', '2021-10-05 11:03:09'),
(356, 'CĐT nộp thiết kế thi công nhà thấp tầng cho SXD', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 11:04:12', '2021-10-05 11:04:12'),
(357, 'SXD phê duyệt hồ sơ thiết kế thi công nhà ở thấp tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 11:04:23', '2021-10-05 11:04:23'),
(358, 'CĐT giao nhà thầu thực hiện mẫu nhà ở', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 11:04:58', '2021-10-05 11:04:58'),
(359, 'CĐT đề nghị thẩm định mẫu nhà ở LK', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 11:05:30', '2021-10-05 11:05:30'),
(360, 'SXD thông báo về kết quả thẩm định mẫu nhà ở LK', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 11:05:59', '2021-10-05 11:05:59'),
(361, 'CĐT nộp hồ sơ thiết kế TTTM xin thẩm định', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 11:06:23', '2021-10-05 11:06:23'),
(362, 'sở xây dựng thẩm định hồ sơ thiết kế TTTM', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 11:06:38', '2021-10-05 11:06:38'),
(363, 'CĐT xin cấp phép xây dựng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 11:06:48', '2021-10-05 11:06:48'),
(364, 'Sở xây dựng cấp giấy phép xây dựng TTTM', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 11:07:00', '2021-10-05 11:07:00'),
(365, 'CĐT đề nghị nghiệm thu các hạng mục PCCC', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 11:07:29', '2021-10-05 11:07:29'),
(366, 'công an PCCC nghiệm thu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Phòng CS PCCC', NULL, NULL, NULL, '2021-10-05 11:08:00', '2021-10-05 11:08:00'),
(367, 'cấp giấy CNQSDĐ và quyền sở hữu nhà cho chủ đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-05 11:08:34', '2021-10-05 11:08:34'),
(368, 'UBND huyện xin ý kiến sở XD', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 11:09:32', '2021-10-05 11:09:32'),
(369, 'ban hành quy định quản lý theo đồ án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 11:09:54', '2021-10-05 11:09:54'),
(370, 'CĐT nộp, xin phê duyệt quy hoạch 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 11:20:29', '2021-10-05 11:20:29'),
(371, 'UBND tỉnh phê duyệt quy hoạch chi tiết 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 11:21:00', '2021-10-05 11:21:00'),
(372, 'SXD trình phê duyệt nhiệm vụ quy hoạch 1/500 lên UBND tỉnh', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 12:54:45', '2021-10-05 12:54:45'),
(373, 'UBND tỉnh phê duyệt nhiệm vụ quy hoạch 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 12:55:00', '2021-10-05 12:55:00'),
(374, 'NĐT trình thẩm định phê duyệt quy hoạch 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'NĐT', NULL, NULL, NULL, '2021-10-05 12:55:16', '2021-10-05 12:55:16'),
(375, 'sở xây dựng lấy ý kiến các sở ban ngành và ubnd huyện về quy hoạch 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 12:55:45', '2021-10-05 12:55:45'),
(376, 'các sở ban ngành trả lời về quy hoạch 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở ngành', NULL, NULL, NULL, '2021-10-05 12:56:15', '2021-10-05 12:56:15'),
(377, 'sở xây dựng trình UBND tỉnh phê duyệt quy hoạch 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 12:56:40', '2021-10-05 12:56:40'),
(378, 'UBND tỉnh phê duyệt quy hoạch chi tiết 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 12:57:01', '2021-10-05 12:57:01'),
(379, 'UBND tỉnh phê duyệt quy hoạch chung  1/2000', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 13:52:24', '2021-10-05 13:52:24'),
(380, 'CĐT xin khảo sát, lập quy hoạch thực hiện dự án', 0, NULL, NULL, NULL, 1, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-05 14:11:10', '2021-10-05 14:11:10'),
(381, 'UBND tỉnh đồng ý cho khảo sát ngoài thực địa', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND', NULL, NULL, NULL, '2021-10-05 14:11:26', '2021-10-05 14:11:26'),
(382, 'UBND đề nghị các sở ngành tham mưu thực hiện dự án', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 14:14:06', '2021-10-05 14:14:06'),
(383, 'UBND tỉnh đề nghị sở ban ngành tham mưu, khảo sát, điều chỉnh quy hoạch', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 14:17:06', '2021-10-05 14:17:06'),
(384, 'Sở Xây dựng lập báo cáo tổng hợp ý kiến sở ban ngành về quy hoạch chi tiết, trình UBND tỉnh', 0, NULL, NULL, NULL, 1, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 14:18:51', '2021-10-05 14:18:51'),
(385, 'UBND tỉnh phê duyệt chủ trương lập quy hoạch chi tiết', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 14:21:13', '2021-10-05 14:21:13'),
(386, 'UBND huyện trình UBND tỉnh và SXD thẩm định, phê duyệt Nhiệm vụ khảo sát địa hình,  lập quy hoạch chi tiết', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-05 14:27:44', '2021-10-05 14:27:44'),
(387, 'Sở Xây dựng báo cáo kết quả thẩm định, nhiệm vụ quy hoạch chi tiết', 0, NULL, NULL, NULL, 1, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 14:29:24', '2021-10-05 14:29:24'),
(388, 'UBND tỉnh phê duyệt nhiệm vụ quy hoạch chi tiết', 0, NULL, NULL, NULL, 1, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 14:31:18', '2021-10-05 14:31:18'),
(389, 'Sở Xây dựng hỏi ý kiến các sở ban ngành về lập quy hoạch 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-05 14:34:58', '2021-10-05 14:34:58'),
(390, 'UBND tỉnh phê duyệt quy hoạch chi tiết 1/500', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-05 14:35:19', '2021-10-05 14:35:19'),
(391, 'CĐT đề nghị UBND tỉnh giao SKHĐT lập chủ trương đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 01:59:56', '2021-10-06 01:59:56'),
(392, 'Sở KHĐT lấy ý kiến các sở ban ngành về chủ trương đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-06 02:01:07', '2021-10-06 02:01:07'),
(393, 'Các sở ban ngành cho ý kiến về chủ trương đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở ngành', NULL, NULL, NULL, '2021-10-06 02:04:11', '2021-10-06 02:04:11'),
(394, 'Sở KHĐT tổng hợp ý kiến các sở ngành, lập báo cáo trình UBND tỉnh', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở KHĐT', NULL, NULL, NULL, '2021-10-06 02:04:43', '2021-10-06 02:04:43'),
(395, 'UBND tỉnh phê duyệt chủ trương đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 02:05:30', '2021-10-06 02:05:30'),
(396, 'CĐT đề nghị thu hồi đất, thành lập hội đồng đền bù giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:14:00', '2021-10-06 02:14:00'),
(397, 'UBND huyện tuyên truyền thực hiện giải phóng mặt bằng để hỗ trợ CĐT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:14:22', '2021-10-06 02:14:22'),
(398, 'UBND huyện ra quyết định thành lập hội đồng đền bù giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:14:32', '2021-10-06 02:14:32'),
(399, 'bàn giao mốc giới để giải phóng mặt bằng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện - CĐT', NULL, NULL, NULL, '2021-10-06 02:15:17', '2021-10-06 02:15:17'),
(400, 'CĐT cam kết đền bù và đưa ra mức chi phí hỗ trợ các hộ dân', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:15:26', '2021-10-06 02:15:26'),
(401, 'hội đồng đền bù GPMB tổ chức xác nhận các hộ, các cá nhân bị ảnh hưởng bởi GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:15:51', '2021-10-06 02:15:51'),
(402, 'UBND huyện phê duyệt phương án đền bù, giải phóng mặt bằng; tái định cư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:16:22', '2021-10-06 02:16:22'),
(403, 'hội đồng GPMB yêu cầu CĐT chuyển kinh phí đền bù GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:16:37', '2021-10-06 02:16:37'),
(404, 'CĐT chuyển kinh phí', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:16:48', '2021-10-06 02:16:48'),
(405, 'CĐT đề nghị chuyển trả kinh phí thừa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:17:29', '2021-10-06 02:17:29'),
(406, 'CĐT xin bàn giao mặt bằng tạm thời để làm lễ khởi công', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:17:40', '2021-10-06 02:17:40'),
(407, 'Hội đồng GPMB báo cáo hoàn thành công tác đền bù GPMB', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:18:19', '2021-10-06 02:18:19'),
(408, 'CĐT xin đấu nối nút giao thông tạm thời để phục vụ thi công', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:19:22', '2021-10-06 02:19:22'),
(409, 'CĐT gửi sở giao thông xin chấp thuận thiết kế nút giao thông tạm', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:19:32', '2021-10-06 02:19:32'),
(410, 'Sở GTVT chấp thuận thiết kế nút giao tạm thời', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở GTVT', NULL, NULL, NULL, '2021-10-06 02:19:54', '2021-10-06 02:19:54'),
(411, 'cấp giấy phép thi công cho nút giao tạm thời', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở GTVT', NULL, NULL, NULL, '2021-10-06 02:20:04', '2021-10-06 02:20:04'),
(412, 'CĐT yêu cầu thẩm duyệt hồ sơ thiết kế PCCC cho hạ tầng kỹ thuật dự án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:20:49', '2021-10-06 02:20:49'),
(413, 'Cấp giấy chứng nhận đã thẩm duyệt PCCC', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Phòng CS PCCC CNCH', NULL, NULL, NULL, '2021-10-06 02:22:12', '2021-10-06 02:22:12'),
(414, 'CĐT báo cáo tiến độ dự án, xin bàn giao đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:23:48', '2021-10-06 02:23:48'),
(415, 'UBND tỉnh quyết định giao đất, cho thuê đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 02:24:34', '2021-10-06 02:24:34'),
(416, 'CĐT yêu cầu sở TNMT tiến hành bàn gioa đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:24:51', '2021-10-06 02:24:51'),
(417, 'Biên bản bàn giao đất ngoài thực địa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT - CĐT', NULL, NULL, NULL, '2021-10-06 02:26:19', '2021-10-06 02:26:19'),
(418, 'CĐT đề nghị thông báo đủ điều kiện huy động vốn', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:27:11', '2021-10-06 02:27:11'),
(419, 'SXD thông báo đủ điều kiện huy động vốn xây dựng hạ tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:27:21', '2021-10-06 02:27:21'),
(420, 'CĐT xin ý kiến về cách xuất hóa đơn', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:27:30', '2021-10-06 02:27:30'),
(421, 'CĐT phê duyệt bản vẽ thi công và dự toán dự án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:28:26', '2021-10-06 02:28:26'),
(422, 'CĐT điều chỉnh xử lý hồ sơ theo tham vấn của các sở ban nghành', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:28:56', '2021-10-06 02:28:56'),
(423, 'Công ty tư vấn ngoài thẩm tra', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Công ty tư vấn', NULL, NULL, NULL, '2021-10-06 02:29:20', '2021-10-06 02:29:20'),
(424, 'Sở Xây dựng thẩm định, yêu cầu bổ sung', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:30:14', '2021-10-06 02:30:14'),
(425, 'UBND huyện lên phương án hệ thống thoát nước mưa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:30:49', '2021-10-06 02:30:49'),
(426, 'Sở Công Thương thẩm định thiết kế hệ tthống điện', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Công Thương', NULL, NULL, NULL, '2021-10-06 02:31:41', '2021-10-06 02:31:41'),
(427, 'Sở Xây dựng cấp giấy phép xây dựng hạ tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:32:26', '2021-10-06 02:32:26'),
(428, 'Hội đồng thẩm định giá đất để làm cơ sở tính tiền sử dụng đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 02:34:35', '2021-10-06 02:34:35'),
(429, 'UBND tỉnh phê duyệt giá đất', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 02:34:57', '2021-10-06 02:34:57'),
(430, 'CĐT có văn bản xin hưởng ưu đãi, miễn tiền thuế', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:35:23', '2021-10-06 02:35:23'),
(431, 'UBND huyện phê duyệt quyết toán tiền đền bù giải phóng mặt bằng làm cơ sở đối trừ tiền SDĐ cho CĐT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:35:51', '2021-10-06 02:35:51'),
(432, 'CĐT đề nghị khấu trừ tiền GPMB vào tiền SDĐ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:35:59', '2021-10-06 02:35:59'),
(433, 'Sở tài chính tính ra số tiền phải nộp còn lại,', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Tài chính', NULL, NULL, NULL, '2021-10-06 02:36:16', '2021-10-06 02:36:16'),
(434, 'Cục thuế thông báo tiền SDĐ mà CĐT phải nộp', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Cục thuế', NULL, NULL, NULL, '2021-10-06 02:36:35', '2021-10-06 02:36:35'),
(435, 'CĐT nộp tiền SDĐ', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:36:45', '2021-10-06 02:36:45'),
(436, 'cục thuế thông báo đóng tiền thuê đất (với phần đất thuê)', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Cục thuế', NULL, NULL, NULL, '2021-10-06 02:36:58', '2021-10-06 02:36:58'),
(437, 'CĐT đề nghị được cấp giấy CNQSDĐ tương ứng với số tiền SDĐ đã nộp', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:37:40', '2021-10-06 02:37:40'),
(438, 'Sở TNMT cấp giấy CNQSDĐ cho CĐT', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-06 02:38:22', '2021-10-06 02:38:22'),
(439, 'CĐT đề nghị tách thửa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:38:33', '2021-10-06 02:38:33'),
(440, 'Sở TNMT tách thửa cho chủ đầu tư để tiện bán hàng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-06 02:38:42', '2021-10-06 02:38:42'),
(441, 'CĐT đề nghị SXD ra thông báo các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:39:15', '2021-10-06 02:39:15'),
(442, 'Sở xây dựng thông báo về các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:39:26', '2021-10-06 02:39:26'),
(443, 'CĐT gửi Sở xây dựng vv ra thông báo đủ điều kiện phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:40:14', '2021-10-06 02:40:14'),
(444, 'SXD có ý kiến lên UBND tỉnh', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:40:28', '2021-10-06 02:40:28'),
(445, 'UBND tỉnh yêu cầu SXD phối hợp kiểm tra các điều kiện phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 02:40:40', '2021-10-06 02:40:40'),
(446, 'Sở Xây dựng tham mưu UBND tỉnh về các điều kiện phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:40:56', '2021-10-06 02:40:56'),
(447, 'Bộ xây dựng cho ý kiến', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Bộ Xây dựng', NULL, NULL, NULL, '2021-10-06 02:41:08', '2021-10-06 02:41:08'),
(448, 'UBND tỉnh ra quyết định về các lô được phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 02:41:18', '2021-10-06 02:41:18'),
(449, 'Sở TNMT thông báo kiểm tra về điều kiện chuyển nhượng dưới hình thức phân lô bán nền', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-06 02:46:27', '2021-10-06 02:46:27'),
(450, 'UBND tỉnh cấp giấy phép xả thải', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 02:48:35', '2021-10-06 02:48:35'),
(451, 'CĐT nộp thiết kế thi công nhà thấp tầng cho SXD', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:50:34', '2021-10-06 02:50:34'),
(452, 'Sở Xây dựng phê duyệt hồ sơ thiết kế thi công nhà ở thấp tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:50:50', '2021-10-06 02:50:50'),
(453, 'CĐT giao nhà thầu thực hiện mẫu nahf ở', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:51:00', '2021-10-06 02:51:00'),
(454, 'CĐT đề nghị thẩm định mẫu nhà ở LK', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:51:11', '2021-10-06 02:51:11'),
(455, 'SXD thông báo về kết quả thẩm định mẫu nhà ở LK', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:51:21', '2021-10-06 02:51:21'),
(456, 'CĐT nộp hồ sơ thiết kế TTTM xin thẩm định', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:51:54', '2021-10-06 02:51:54'),
(457, 'sở xây dựng thẩm định hồ sơ thiết kế TTTM', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:52:05', '2021-10-06 02:52:05'),
(458, 'CĐT xin cấp phép xây dựng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:52:14', '2021-10-06 02:52:14'),
(459, 'Sở xây dựng cấp giấy phép xây dựng TTTM', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:52:24', '2021-10-06 02:52:24'),
(460, 'CĐT đề nghị nghiệm thu các hạng mục PCCC', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:52:46', '2021-10-06 02:52:46'),
(461, 'Công an PCCC nghiệm thu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CS PCCC', NULL, NULL, NULL, '2021-10-06 02:52:57', '2021-10-06 02:52:57'),
(462, 'Cấp giấy CNQSDĐ và quyền sở hữu nhà cho chủ đầu tư', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở TNMT', NULL, NULL, NULL, '2021-10-06 02:53:28', '2021-10-06 02:53:28'),
(463, 'UBND huyện xin ý kiến sở XD', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:54:12', '2021-10-06 02:54:12'),
(464, 'UBND huyện ban hành quy định quản lý theo đồ án', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:54:54', '2021-10-06 02:54:54'),
(465, 'CĐT đề nghị UBND tỉnh kiểm tra việc nghiệm thu hạ tầng kỹ thuật', 0, NULL, NULL, NULL, 0, NULL, NULL, 'CĐT', NULL, NULL, NULL, '2021-10-06 02:58:06', '2021-10-06 02:58:06'),
(466, 'Sở Xây dựng thông báo kết quả kiểm tra, chỉ ra các hồ sơ còn thiếu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Sở Xây dựng', NULL, NULL, NULL, '2021-10-06 02:58:21', '2021-10-06 02:58:21'),
(467, 'UBND tỉnh yêu cầu huyện và các sở ban nghành hỗ trợ CĐT hoàn thành nghiệm thu', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 02:58:34', '2021-10-06 02:58:34'),
(468, 'UBND huyện xin ý kiến về việc bàn giao', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:58:52', '2021-10-06 02:58:52'),
(469, 'UBND tỉnh yêu cầu các sở ban ngành phối hợp nhận bàn giao hạ tầng', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 02:59:12', '2021-10-06 02:59:12'),
(470, 'UBND huyện nhận bàn giao ngoài thực địa', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND huyện', NULL, NULL, NULL, '2021-10-06 02:59:23', '2021-10-06 02:59:23'),
(471, 'UBND tỉnh ban hành quy định về quản lý công trình hạ tầng kỹ thuật', 0, NULL, NULL, NULL, 0, NULL, NULL, 'UBND tỉnh', NULL, NULL, NULL, '2021-10-06 02:59:35', '2021-10-06 02:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `task_url`
--

CREATE TABLE `task_url` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_url`
--

INSERT INTO `task_url` (`id`, `task_id`, `image_id`, `name`, `url`, `created_at`, `updated_at`) VALUES
(2, 64, 1, NULL, '/storage/system/W8PsGWNbjeodYB5pyHysscioYn3LPBjroEYnWns1.pdf', '2021-03-18 04:57:49', '2021-03-18 04:57:49'),
(3, 65, 1, NULL, '/storage/system/ciamktjG0XLgBeyUzC2VMJ29XefBNzN40lbGIfWA.pdf', '2021-03-18 04:58:10', '2021-03-18 04:58:10'),
(5, 66, 1, NULL, '/storage/system/m2aNkleE7lxE63xV8dDdlalxwev8R6yEdveJxbGx.pdf', '2021-03-20 01:26:44', '2021-03-20 01:26:44'),
(6, 67, 1, NULL, '/storage/system/LhIBqpiNrLxmWi4xea4OZaPEtBV9NNnKmFCaHJ0r.pdf', '2021-03-20 01:27:03', '2021-03-20 01:27:03'),
(7, 68, 1, NULL, '/storage/system/6lCp2E5d6y6ghGcIiWNAgL0Ig6q6cNaRjzEepNY6.pdf', '2021-03-20 01:27:22', '2021-03-20 01:27:22'),
(8, 69, 1, NULL, '/storage/system/NiMTT9U8KMGhuqCOhp5k2DHDTCfSvQbFR9i93GER.pdf', '2021-03-20 01:27:39', '2021-03-20 01:27:39'),
(9, 70, 1, NULL, '/storage/system/20T45AWkXnelZq9JLDAPiZnDnlZQnVODPCfCFbnU.pdf', '2021-03-20 01:27:58', '2021-03-20 01:27:58'),
(10, 71, 1, NULL, '/storage/system/fEFHzK757Cr0MRH0MPANMjZrMxQkwdFhSeEZSPZR.pdf', '2021-03-20 01:28:22', '2021-03-20 01:28:22'),
(11, 72, 1, NULL, '/storage/system/QKVx8rZAIj7mujBpcelQcM4oNqGDg85oWP9G8ejs.pdf', '2021-03-20 01:28:53', '2021-03-20 01:28:53'),
(12, 73, 1, NULL, '/storage/system/9jjbu8r3iZAO2u9OrdS6jFGFTXAxezcHo9KABjDj.pdf', '2021-03-20 01:29:24', '2021-03-20 01:29:24'),
(13, 74, 1, NULL, '/storage/system/2YXFsGPwXXX5xBYW16ldAG9eMawEE4ICFANkssac.pdf', '2021-03-20 01:29:51', '2021-03-20 01:29:51'),
(14, 75, 1, NULL, '/storage/system/zYfwSqfug4QNlOBR0SttPdY3UieISsj0nOq9iPEu.pdf', '2021-03-20 01:30:35', '2021-03-20 01:30:35'),
(15, 76, 1, NULL, '/storage/system/fyZCgFCx2F5rKt1MPFW7CQb1Vb2HyU8D5RYBeA8Y.pdf', '2021-03-20 01:31:07', '2021-03-20 01:31:07'),
(16, 77, 1, NULL, '/storage/system/XR8h7ytyYFDmPtfpq2QuIk8EUyg4pA1oo6WuXJ1X.pdf', '2021-03-20 01:31:27', '2021-03-20 01:31:27'),
(17, 78, 1, NULL, '/storage/system/I6P1Gfg3HH0YGKzbnT8el20DaZ9QWsJ7CHuRJKEo.pdf', '2021-03-20 01:31:54', '2021-03-20 01:31:54'),
(18, 79, 1, NULL, '/storage/system/RkKTy2DqQiEZuLAIlzcDNhTfxrNHHn6LhQpDP79C.pdf', '2021-03-20 01:32:20', '2021-03-20 01:32:20'),
(19, 80, 1, NULL, '/storage/system/QZGvOab4s2zVKwvm0chThLUs8OP8c9enDYbDadcn.pdf', '2021-03-20 01:32:46', '2021-03-20 01:32:46'),
(21, 83, 1, NULL, '/storage/system/YWyg1b62cJSzDyfJAIpTEXWf1fweTSIFoKvR6fes.pdf', '2021-03-20 01:34:15', '2021-03-20 01:34:15'),
(22, 84, 1, NULL, '/storage/system/I96t4OLl89bNY41N4LCC3RWP2a4smKhqOlkPWpB5.pdf', '2021-03-20 01:34:46', '2021-03-20 01:34:46'),
(23, 85, 1, NULL, '/storage/system/xlruqENwHYByKc1uwwl1aCcVxCtH8yrfP2XZ9KoG.pdf', '2021-03-20 01:37:18', '2021-03-20 01:37:18'),
(25, 98, 1, NULL, '/storage/system/FDJ5CZLjLQ4Oct2xlGvJu6lIs9JxOdgm2X6m74iz.pdf', '2021-03-20 01:39:18', '2021-03-20 01:39:18'),
(26, 99, 1, 'UBND huyện rà soát và trình các diện tích cần chuyển đổi', '/storage/system/CRf0s9O6PBBIfXibU4Uc22S6FSfMmxNrKQMBqphb.pdf', '2021-03-20 01:39:45', '2021-03-20 01:39:45'),
(27, 100, 1, NULL, '/storage/system/waCmsXF64EvqDHcPO45oIgl4h4vtkevCD17tNvRJ.pdf', '2021-03-20 01:40:28', '2021-03-20 01:40:28'),
(28, 102, 1, NULL, '/storage/system/ctNh55rHldwbW8wCOj76IPOOC4fyrXHASIDip1om.pdf', '2021-03-20 01:41:14', '2021-03-20 01:41:14'),
(29, 101, 1, NULL, '/storage/system/he8TxKSyPLivnNXIOQrhDQUHtvMBpVMV1YgdeGEN.pdf', '2021-03-20 01:41:30', '2021-03-20 01:41:30'),
(31, 88, 1, NULL, '/storage/system/tahrpqOEfH26P9jihujpd7tPuGLsEQMgJO1hfGsd.pdf', '2021-03-20 03:38:49', '2021-03-20 03:38:49'),
(32, 89, 1, NULL, '/storage/system/3ZIY7eeSQUE43Cm2EoT0inEseo2ltMmQkYxMir3p.pdf', '2021-03-20 03:39:07', '2021-03-20 03:39:07'),
(33, 90, 1, NULL, '/storage/system/cNA3AhRyttspgFuZFEsheZPhc6A33NjUzARgUlqt.pdf', '2021-03-20 03:39:25', '2021-03-20 03:39:25'),
(34, 91, 1, NULL, '/storage/system/uBNc18BAUza6vtnCUDvwPqTlULhD0XnFWUDLvCzx.pdf', '2021-03-20 03:40:29', '2021-03-20 03:40:29'),
(35, 92, 1, NULL, '/storage/system/aBn7drLVxtch0PZagSONmDb5IW3Mx1U44uIEc8vi.pdf', '2021-03-20 03:40:45', '2021-03-20 03:40:45'),
(36, 93, 1, NULL, '/storage/system/ccEMCOAOTCzxrzB4ipVKMNqNwSQZI9wbi7te34I3.pdf', '2021-03-20 03:41:14', '2021-03-20 03:41:14'),
(37, 94, 1, NULL, '/storage/system/eeRKhcVSsd9UTpKbwJeKelngUMTLFM07O0KHLWIC.pdf', '2021-03-20 03:41:34', '2021-03-20 03:41:34'),
(38, 96, 1, NULL, '/storage/system/IGXzV70wMTcpsogfruajPfNkzeLhfIhXg82I483z.pdf', '2021-03-20 03:42:02', '2021-03-20 03:42:02'),
(39, 97, 1, NULL, '/storage/system/O8B5OYUd18WBjrFBJLtNwBsEH0ika57ytMVMY0Cn.pdf', '2021-03-20 03:42:22', '2021-03-20 03:42:22'),
(40, 103, 1, NULL, '/storage/system/yANDqQXNs0oa5L2tTNleWSnIrAorrvCjW8QePQP8.pdf', '2021-03-20 05:38:37', '2021-03-20 05:38:37'),
(41, 104, 1, NULL, '/storage/system/l9mRAGzTAgXcVAfy0s3bp3kLthnTveEbyW5Ec8Bm.pdf', '2021-03-20 05:38:53', '2021-03-20 05:38:53'),
(42, 105, 1, NULL, '/storage/system/JkETkvjKPrMVkcWXp67C4XcRRSUQNRgMVBBbXCxo.pdf', '2021-03-20 05:39:26', '2021-03-20 05:39:26'),
(43, 106, 1, NULL, '/storage/system/7YInLQvLq0zc9jmJMvjVfgtHU6mMZkUz0AkoBTFx.pdf', '2021-03-20 05:39:41', '2021-03-20 05:39:41'),
(44, 107, 1, NULL, '/storage/system/ri9mLKkRjU8jbotwSLTenfu6SJCIwO6NpZUbDl5x.pdf', '2021-03-20 05:40:25', '2021-03-20 05:40:25'),
(45, 108, 1, NULL, '/storage/system/TJbl77BGDdW1REllFebPeEMnzOfVqZw529XHlAv5.pdf', '2021-03-20 05:40:39', '2021-03-20 05:40:39'),
(46, 109, 1, NULL, '/storage/system/wixPoRO4om0quzmUgRv8BgTsCrt8ttIjtDY8OC69.pdf', '2021-03-20 05:40:52', '2021-03-20 05:40:52'),
(47, 110, 1, NULL, '/storage/system/ns4JfHBKUiZpv62guXO62A52NhNNWoMbBnO85egx.pdf', '2021-03-20 05:41:07', '2021-03-20 05:41:07'),
(48, 111, 1, NULL, '/storage/system/5EPZYwnS1iuO6tbl1CPxKiwEne2MCkEClEsQojxy.pdf', '2021-03-20 05:42:13', '2021-03-20 05:42:13'),
(49, 112, 1, NULL, '/storage/system/wvppg59zuw3QJ8nEUpvW1uwaHVyOHiTzAfeSvNq7.pdf', '2021-03-20 05:42:46', '2021-03-20 05:42:46'),
(50, 113, 1, NULL, '/storage/system/qRRYUNuFazTMCM3mbh5YnkatXSDjgUkaL1Wbj9Nn.pdf', '2021-03-20 05:43:31', '2021-03-20 05:43:31'),
(51, 114, 1, NULL, '/storage/system/rG1WtGmR69HKTJVsZkeZVKdC4YNDbOXXavEI3T0b.pdf', '2021-03-20 05:43:54', '2021-03-20 05:43:54'),
(52, 115, 1, NULL, '/storage/system/RkK4zNWkuErtAHL7frmXseCoh3osowXQX56rTxz6.pdf', '2021-03-20 05:44:05', '2021-03-20 05:44:05'),
(53, 116, 1, NULL, '/storage/system/PXy9QrZbBnIxpcZjAPIudWEnUrqSezYCqRGEtnk8.pdf', '2021-03-20 05:44:22', '2021-03-20 05:44:22'),
(54, 117, 1, NULL, '/storage/system/0rNsG5DWFfroL0KfSUJtVxeT5txVKNIQhpj0KdEk.pdf', '2021-03-20 05:45:36', '2021-03-20 05:45:36'),
(55, 118, 1, NULL, '/storage/system/tcrpi543KKdsSzUPsnunv7hEVhaKEFyl2KicwMe8.pdf', '2021-03-20 05:45:52', '2021-03-20 05:45:52'),
(56, 119, 1, NULL, '/storage/system/5zNVhHMD9rG7zryLoXY0PhlmSxYDbsN1PWMXU3XK.pdf', '2021-03-20 05:46:08', '2021-03-20 05:46:08'),
(57, 120, 1, NULL, '/storage/system/d514lvviqG0IzEF9nu7RD8AHAlmUwmb6H5IOx3pZ.pdf', '2021-03-20 05:46:54', '2021-03-20 05:46:54'),
(58, 121, 1, NULL, '/storage/system/BJF78C767rEsZSZ8tXlcarVmZAUFEj7t7Mz04BLy.pdf', '2021-03-20 05:47:12', '2021-03-20 05:47:12'),
(59, 122, 1, NULL, '/storage/system/RBRYP5iyrtqqmF9HGxijxDU760N7KUIlhhZofrfZ.pdf', '2021-03-20 05:47:29', '2021-03-20 05:47:29'),
(60, 123, 1, NULL, '/storage/system/AaQ2PNNdOEMEN5PpI7XkNstXoT3b4z1fKL9zVX7O.pdf', '2021-03-20 05:47:48', '2021-03-20 05:47:48'),
(61, 124, 1, NULL, '/storage/system/lOQIdzLQHhkHW2vskGEiUb6bTeVYC6p8Fwnm0jb4.pdf', '2021-03-20 05:48:06', '2021-03-20 05:48:06'),
(62, 125, 1, NULL, '/storage/system/g2GjZxcJKEqQDyd20LXTLTQr3OBF84MGjt0mxX4Y.pdf', '2021-03-20 05:48:22', '2021-03-20 05:48:22'),
(63, 126, 1, NULL, '/storage/system/pctV4fdI5jupk0eRgnqr8i3xwFC3AN8Bosxou284.pdf', '2021-03-20 05:48:51', '2021-03-20 05:48:51'),
(64, 127, 1, NULL, '/storage/system/QHcXZ1nwtjIXn3IqGhsbCDBZNFEgURIEszUqAEcV.pdf', '2021-03-20 05:49:43', '2021-03-20 05:49:43'),
(65, 128, 1, NULL, '/storage/system/DNxKxIw1teCnayWofYRsApwlseCOQk4s0VtUXJHu.pdf', '2021-03-20 05:49:55', '2021-03-20 05:49:55'),
(66, 129, 1, NULL, '/storage/system/oEtxKbtceFo7pae0ptdEtT5Iy5wV4bD5GUNg8kSE.pdf', '2021-03-20 05:50:18', '2021-03-20 05:50:18'),
(67, 130, 1, NULL, '/storage/system/EzdWmGX9SbAeKJfYZggW144YpesCmU9ozmZYprqC.pdf', '2021-03-20 05:50:42', '2021-03-20 05:50:42'),
(68, 131, 1, NULL, '/storage/system/MbSCAlMaeSAcveGR5je9qa1cONPLFRT0hush13qZ.pdf', '2021-03-20 05:51:05', '2021-03-20 05:51:05'),
(69, 132, 1, 'Sở tài chính tính ra số tiền phải nộp còn lại,', '/storage/system/D9Nuku3YvPIZ0Fv7V8xTCn4YL2lLUNTu1Vo5uEfD.pdf', '2021-03-20 05:51:24', '2021-03-20 05:51:24'),
(70, 133, 1, NULL, '/storage/system/wi7g4p0AIyY3wRpYs2dM4sORpS2CIYC5GSeDBMgG.pdf', '2021-03-20 05:52:00', '2021-03-20 05:52:00'),
(71, 173, 1, NULL, '/storage/system/Wmf5CZ35lwQFUPoknYK49oLr2carJ0LRQVzqSix9.pdf', '2021-03-20 05:53:56', '2021-03-20 05:53:56'),
(72, 135, 1, NULL, '/storage/system/Xhc0AofwJuinzEClSMX77yWiLyujoQrPrslmXs3V.pdf', '2021-03-20 05:56:04', '2021-03-20 05:56:04'),
(73, 136, 1, NULL, '/storage/system/lVqUm0RBgbG8LnLrzJLg1ceWbJTTngu6OZy4RkSc.pdf', '2021-03-20 05:56:16', '2021-03-20 05:56:16'),
(74, 137, 1, NULL, '/storage/system/zk8hSnIzTdGjN3MhopAbcwi3FuOUxWPU7nIlIHuM.pdf', '2021-03-20 05:56:27', '2021-03-20 05:56:27'),
(75, 138, 1, NULL, '/storage/system/3SuIjeLUYTM76CcRLiqv9tNMt20eWu3ScwS6tZ2T.pdf', '2021-03-20 05:56:40', '2021-03-20 05:56:40'),
(76, 139, 1, NULL, '/storage/system/vyYkYokczJKHU9qJlJu8v072KUP6Si8FZBSKGT3m.pdf', '2021-03-20 05:56:52', '2021-03-20 05:56:52'),
(77, 140, 1, NULL, '/storage/system/fv9NnUFGBlEtfJKNjSGe0CN7XjUlVUiZNvqJ6JOr.pdf', '2021-03-20 05:57:33', '2021-03-20 05:57:33'),
(78, 141, 1, NULL, '/storage/system/cGjXu9uPl4amgZlQeyf1JuTXDp2FpKEbdzdinURX.pdf', '2021-03-20 05:57:52', '2021-03-20 05:57:52'),
(79, 142, 1, NULL, '/storage/system/hzdoNKoz1m04dzTbR0MdNFU9sVpyAE594E9DnvJt.pdf', '2021-03-20 05:59:48', '2021-03-20 05:59:48'),
(80, 143, 1, NULL, '/storage/system/CNjjRewabBnxifYmObeHuG5gkqefYcBZcWamN7oX.pdf', '2021-03-20 05:59:59', '2021-03-20 05:59:59'),
(81, 144, 1, NULL, '/storage/system/5ndeFPgT8pyhDIbWlmnitGREVpko4HkyUY9TEorr.pdf', '2021-03-20 06:00:09', '2021-03-20 06:00:09'),
(82, 145, 1, NULL, '/storage/system/9SOOYOvCOlkpTDZX8wllHzfITaE1mFSUfKn9SApY.pdf', '2021-03-20 06:00:24', '2021-03-20 06:00:24'),
(83, 147, 1, NULL, '/storage/system/SaQmrLgg11ahZvNslaUvvr7j7pXS5FYoXDUW98mT.pdf', '2021-03-20 06:00:37', '2021-03-20 06:00:37'),
(84, 148, 1, NULL, '/storage/system/ZXMFZf7Gf9T9d1fIDxG6ec9k4HkhZCOl8rWTC8RW.pdf', '2021-03-20 06:00:50', '2021-03-20 06:00:50'),
(85, 149, 1, NULL, '/storage/system/ZwRET75ayq6uzVuBlh36Lj6Mxv3L68TNGszsmatc.pdf', '2021-03-20 06:01:36', '2021-03-20 06:01:36'),
(90, 151, 1, NULL, '/storage/system/8Ek1dmWFbEJQYE8kxIbmzR1rktB7mtHX9sEINkPW.pdf', '2021-03-20 06:06:41', '2021-03-20 06:06:41'),
(91, 153, 1, NULL, '/storage/system/qkuaMEK2kbV1TChJdalNOfi2ISHAKxW3RFHlaIjq.pdf', '2021-03-20 06:07:13', '2021-03-20 06:07:13'),
(92, 154, 1, NULL, '/storage/system/9HZyGYcbcyBni2D3mDgU4H5JfwNLveGmpYHzEW9h.pdf', '2021-03-20 06:07:25', '2021-03-20 06:07:25'),
(93, 156, 1, NULL, '/storage/system/93IeePioYYWEUUdlIoHEKwviHAqALre7u6XlThlS.pdf', '2021-03-20 06:08:59', '2021-03-20 06:08:59'),
(94, 158, 1, NULL, '/storage/system/j4OJfjIL3IiilatMLpD8Qnk6yE27ulk46yFUqtaR.pdf', '2021-03-20 06:09:14', '2021-03-20 06:09:14'),
(95, 160, 1, NULL, '/storage/system/DTZmEOIqywvQS5JWAcZ9V1wT55yaH9OclCubchZj.pdf', '2021-03-20 06:09:39', '2021-03-20 06:09:39'),
(97, 161, 1, NULL, '/storage/system/PLCn53R1FFf7bhGyjo7oP438uLeWzkKXwl7WHvlO.pdf', '2021-03-20 06:10:09', '2021-03-20 06:10:09'),
(98, 170, 1, NULL, '/storage/system/q99mZ04kPUNeSmXnBazdKNtnPF6vaj7Pb1xWfjAo.pdf', '2021-03-20 06:10:40', '2021-03-20 06:10:40'),
(99, 171, 1, NULL, '/storage/system/HezXA1FlieoIznvKAlyC72BB1AtawFcRuQFFHmyh.pdf', '2021-03-20 06:10:51', '2021-03-20 06:10:51'),
(101, 163, 1, NULL, '/storage/system/n7d29R7yLzaRS8FYtVG3z0jQHfQapz2DIWhYiaxQ.pdf', '2021-03-20 06:11:47', '2021-03-20 06:11:47'),
(102, 164, 1, NULL, '/storage/system/vI2gDMnC9ZlzKRIuauLsLAswsludadjwVWFndUSK.pdf', '2021-03-20 06:12:23', '2021-03-20 06:12:23'),
(103, 165, 1, NULL, '/storage/system/Wg92RrGk0S2btL6OEzRmILpj9iH1KnezNbUcWisn.pdf', '2021-03-20 06:12:37', '2021-03-20 06:12:37'),
(104, 166, 1, NULL, '/storage/system/hw7vdhcv0ETSfdMpzWarWPHMdssEv6UJz4Ym05wE.pdf', '2021-03-20 06:12:55', '2021-03-20 06:12:55'),
(105, 168, 1, NULL, '/storage/system/WfRJrxs0CPeIyyZ1TcEEBFXritgeYgk1bqFV4IUz.pdf', '2021-03-20 06:13:17', '2021-03-20 06:13:17'),
(106, 169, 1, NULL, '/storage/system/Mn3JKF8ctjyHPsgkAQDIejzbqU3ZqjWpxJYRwHtj.pdf', '2021-03-20 06:13:30', '2021-03-20 06:13:30'),
(107, 174, 1, NULL, '/storage/system/zA9TmDQSzOmNERFfSoCKO1YVnH7js1FXOCxcGuTI.pdf', '2021-03-24 07:40:54', '2021-03-24 07:40:54'),
(108, 175, 1, NULL, '/storage/system/1OX7GeLnP91csvLrYu1nKYLKgjxwI2QhnM3kGGIi.pdf', '2021-03-24 07:41:13', '2021-03-24 07:41:13'),
(109, 176, 1, NULL, '/storage/system/ILsNOo4nTiq1GMsRNj06iOsgbDFeETkuueP1vaQC.pdf', '2021-03-24 07:41:21', '2021-03-24 07:41:21'),
(111, 177, 1, NULL, '/storage/system/lS3RgotvMioDJSFv870NkT5uXLNAKf9hZdkE8eAZ.pdf', '2021-03-24 07:41:46', '2021-03-24 07:41:46'),
(112, 178, 1, NULL, '/storage/system/zFMdJA5VLhpcwZu6EvzYCIgXYCpK56O0COvChZRu.pdf', '2021-03-24 07:42:31', '2021-03-24 07:42:31'),
(113, 179, 1, NULL, '/storage/system/8ebI2ED6gpnxyegI4I41ZGMKFUO6nyYY1qXFSyXr.pdf', '2021-03-24 07:42:46', '2021-03-24 07:42:46'),
(114, 179, 2, 'hồ sơ nhiệm vụ khảo sát lập quy hoạch', '/storage/system/dAaAYGQMyO35W3rhIdviTZYb2zbzmFjgQkLZtOM2.pdf', '2021-03-24 07:43:28', '2021-03-24 07:43:28'),
(115, 180, 1, NULL, '/storage/system/0CROt1K7Ei95Wv1LidUUhKLB3TtU1tI8bbG6ZLMu.pdf', '2021-03-24 07:43:54', '2021-03-24 07:43:54'),
(116, 180, 2, 'hồ sơ nhiệm vụ quy hoạch chi tiết xây dựng 1/500', '/storage/system/HSvzF79jMraBXTs0mnPojfNhoLJs0768Gwhv3quZ.pdf', '2021-03-24 07:44:18', '2021-03-24 07:44:18'),
(117, 181, 1, NULL, '/storage/system/JEGgzsnQ6DEpXz2gLWj0ysM0Dkdwi7xln9e4RgOy.pdf', '2021-03-24 07:44:48', '2021-03-24 07:44:48'),
(118, 182, 1, NULL, '/storage/system/wFOph2AGrettXQZBGq19cKljP83L8sOlbHBo3fR7.pdf', '2021-03-24 07:45:01', '2021-03-24 07:45:01'),
(119, 183, 1, NULL, '/storage/system/pNtUetzutjGenp7VIc9CkShqcJgRyr8M014bSJ2w.pdf', '2021-03-24 07:45:16', '2021-03-24 07:45:16'),
(120, 194, 1, NULL, '/storage/system/VPx8eT2IcHixNFpSbk1EiNTmgq3rmo4H2DYIVnZa.docx', '2021-04-02 02:03:58', '2021-04-02 02:03:58'),
(121, 196, 1, NULL, '/storage/system/3ySMn6QPcf0wgPSqEkR28JvTI0nhRAl0zASgN8zE.pdf', '2021-04-02 02:10:33', '2021-04-02 02:10:33'),
(122, 197, 1, NULL, '/storage/system/HESJifvjaC5SaihomPrvZhwFk1AbTMsL5tlixezs.jpg', '2021-04-02 02:12:06', '2021-04-02 02:12:06'),
(123, 198, 1, NULL, '/storage/system/vIXVydsf2OhTAEdPPsFqFnaycwrnEB5NiyQVyuTE.pdf', '2021-04-02 02:13:39', '2021-04-02 02:13:39'),
(124, 199, 1, NULL, '/storage/system/sLa41qEz7j0dwgOXa1LUSzRQPzDqu9d6fpV8XR0y.jpg', '2021-04-02 02:15:24', '2021-04-02 02:15:24'),
(125, 201, 1, NULL, '/storage/system/LFNJHRkdGQxAc0X75WogTgS8q767s8Dq3FCBpfRi.pdf', '2021-04-02 02:19:08', '2021-04-02 02:19:08'),
(126, 202, 1, NULL, '/storage/system/sQBA35fcIeOG0ZLZTyyJ19bMp62yy7lBSu5XOIJv.jpg', '2021-04-02 02:20:19', '2021-04-02 02:20:19'),
(127, 203, 1, NULL, '/storage/system/xLVN8JJQmuDUAZM1D4eZzyRvGyrqsgMzCMqoKgDA.pdf', '2021-04-02 02:21:50', '2021-04-02 02:21:50'),
(128, 204, 1, NULL, '/storage/system/FqWC4JwZadVK0rS7mEUmjOIwMeVuUueCTpladnXj.pdf', '2021-04-02 02:32:34', '2021-04-02 02:32:34'),
(129, 205, 1, NULL, '/storage/system/ORsGyPXXAqO8h7HMOvuWh9163IHUhhrwmhIkhFNQ.pdf', '2021-04-02 02:33:56', '2021-04-02 02:33:56'),
(130, 206, 1, NULL, '/storage/system/gu4nNmucTMa83rMUoFyqS1ZvElR3hvmGdeXpHdeG.pdf', '2021-04-02 02:35:22', '2021-04-02 02:35:22'),
(131, 195, 1, NULL, '/storage/system/IHsRgG7sibD8jJEoaOQgJqU6s3JFbCrZW94uNnR7.pdf', '2021-04-02 02:38:31', '2021-04-02 02:38:31'),
(132, 208, 1, 'Điều chỉnh cục bộ QH 1/2000', '/storage/system/ZeezCur6WTna4RmNZw3oL2zohNktktnhI9c1Y01N.pdf', '2021-10-05 02:30:15', '2021-10-05 02:30:15'),
(133, 209, 1, 'QĐ 3873 UBND tỉnh Bình Định phê duyệt điều chỉnh quy hoạch 1/2000', '/storage/system/gD23h94ir6lMTNYGXUqN9oW5ocUWjPfGPg41wIjc.pdf', '2021-10-05 04:17:30', '2021-10-05 04:17:30'),
(134, 220, 1, '2019.06.28-96-CV-TTVN vv tài  trợ kinh phí  lập QHPK 1.2000', '/storage/system/764uB7xB9r3KwMY8Eq2rDEVLVh15R2DJ4h459P3r.pdf', '2021-10-05 05:22:46', '2021-10-05 05:22:46'),
(135, 221, 1, '2019.06.06-946-SXD-QHKT đề nghị huyện lấy ý kiến về đ.c QHPK', '/storage/system/kGdvW4Oc3LoAouPVXS79r0Mj07OMMLO9AtAnuMoe.pdf', '2021-10-05 05:23:34', '2021-10-05 05:23:34'),
(136, 221, 2, 'Biên bản họp lấy ý kiến dân cư', '/storage/system/nMRX0jsxup6dd7acREiHBWy22RxHuYWH7P9frTOx.pdf', '2021-10-05 05:23:57', '2021-10-05 05:23:57'),
(137, 222, 1, '2019.07.30-191-TTr-SXD Trình đ.chỉnh NVQH phân khu 1.2000(42ha)', '/storage/system/ECflqLLuYW0ndWsSq4e3xH6sH3MCHwfLHm2TIFWA.pdf', '2021-10-05 05:27:56', '2021-10-05 05:27:56'),
(138, 223, 1, NULL, '/storage/system/Z9zBcFPAvurJP5rJPFGxAS9iPGwLAeOBVuMpVQzh.pdf', '2021-10-05 05:28:19', '2021-10-05 05:28:19'),
(139, 224, 1, NULL, '/storage/system/EG1cYQOFVa0vPp1RoGIzgtdFrJhJeBP4OQfSoynK.pdf', '2021-10-05 05:28:46', '2021-10-05 05:28:46'),
(140, 225, 1, NULL, '/storage/system/QamHN32nmcmVNJOmGKJnNKNtU5CIWf0I6l8twBM0.pdf', '2021-10-05 05:28:59', '2021-10-05 05:28:59'),
(141, 226, 1, NULL, '/storage/system/DUMa0VIDxcPIxlfFkF46iRduRxZgtmiyjxOUrsZu.pdf', '2021-10-05 05:29:23', '2021-10-05 05:29:23'),
(142, 227, 1, NULL, '/storage/system/ExZYQ6pO0CggWgxZ4CLMcozi9pcg9qMrbzfPnKtG.pdf', '2021-10-05 05:29:42', '2021-10-05 05:29:42'),
(143, 228, 1, NULL, '/storage/system/yLuyv9EDaGmYEcNaiV9eZr2tJTzDAoraaXWc1ntB.pdf', '2021-10-05 07:28:22', '2021-10-05 07:28:22'),
(144, 229, 1, NULL, '/storage/system/5SECIibPYytrBQjFa14ThE9J6BeoQ5pYVsjFWZX9.pdf', '2021-10-05 07:28:34', '2021-10-05 07:28:34'),
(145, 229, 2, 'Các sở ban nghành trả lời', '/storage/system/nAj3izmTrmM0fc8XKscukdos1juHrcNmR03tvQJk.pdf', '2021-10-05 07:29:17', '2021-10-05 07:29:17'),
(146, 229, 3, 'các sở ban nghành trả lời', '/storage/system/IdgXQbnxfTp3mAqp4Gst46sXh9P72M35ybPDmYDr.pdf', '2021-10-05 07:29:41', '2021-10-05 07:29:41'),
(147, 229, 4, 'các sở ban nghành trả lời', '/storage/system/eI620R2Pib8S7oLMxdrm8rfY9yQQ1mJzVbVHfosk.pdf', '2021-10-05 07:29:54', '2021-10-05 07:29:54'),
(148, 229, 5, 'các sở ban nghành trả lời', '/storage/system/0pvO6jgzw3tzGuWmLJ9VVz0yrwY0aG5jRt9YdcEu.pdf', '2021-10-05 07:30:03', '2021-10-05 07:30:03'),
(149, 229, 6, 'các sở ban nghành trả lời', '/storage/system/4aMt9Vgf1TisINZuUHTQPk2072YDJ0mEhpYykTPH.pdf', '2021-10-05 07:30:15', '2021-10-05 07:30:15'),
(150, 229, 7, 'ý kiến cộng đồng dân cư', '/storage/system/7iaeNh56nJGSYbJUG7rg7cTRltm2PaHATmxUewAy.pdf', '2021-10-05 07:30:32', '2021-10-05 07:30:32'),
(151, 229, 8, 'ý kiến của cộng đồng dân cư', '/storage/system/DcQosMDFm9mst708tQuXhSLRWOt6y05wglFzd6Nz.pdf', '2021-10-05 07:31:23', '2021-10-05 07:31:23'),
(152, 229, 9, 'ý kiến của ủy ban nhân dân huyện', '/storage/system/r8nFd6alFE8HykzKUu4Y3mB3aqENuqzDwhVymyZP.pdf', '2021-10-05 07:32:06', '2021-10-05 07:32:06'),
(153, 229, 10, 'ý kiến sở tài chính', '/storage/system/cctKR7sNZw0VzsA4e1l8lgzXAQTa23A5d8MKLIra.pdf', '2021-10-05 07:32:29', '2021-10-05 07:32:29'),
(154, 229, 11, 'ý kiến sở du lịch', '/storage/system/543fMZoHWygP06hiM2b1eucna4fU2uMefRZahA86.pdf', '2021-10-05 07:32:53', '2021-10-05 07:32:53'),
(155, 229, 12, 'ý kiến ủy ban nhân dân huyện', '/storage/system/aRQe9VJR92S6jDvDhAZEB1sWWPFGGxceuucIb3vj.pdf', '2021-10-05 07:33:16', '2021-10-05 07:33:16'),
(156, 230, 1, NULL, '/storage/system/jr31bqDktc4463uB2D7lveQXngZkszwQgbm1osH6.pdf', '2021-10-05 07:35:04', '2021-10-05 07:35:04'),
(157, 231, 1, NULL, '/storage/system/4FkWj93HoQU1GP2Em0U07TVAjOquNccV3uWUZhyv.pdf', '2021-10-05 07:35:18', '2021-10-05 07:35:18'),
(158, 232, 1, 'sở kế hoạch và đầu tư thông báo yêu cầu NĐT ký quỹ', '/storage/system/yMTQ8dvlfz39kiJ5NZHnb4Wm8e5ocpx2vCxhAYup.pdf', '2021-10-05 07:37:56', '2021-10-05 07:37:56'),
(159, 232, 2, 'CĐT đề nghị gia hạn ký quỹ', '/storage/system/00nwG0MMoX8yFFqqF03K506pbi7CSDSGy3QG8k5z.pdf', '2021-10-05 07:38:19', '2021-10-05 07:38:19'),
(160, 232, 3, 'UBND tỉnh đồng ý cho phép gia hạn', '/storage/system/Ypyjuc5s91ldebqHsVRHvSG3TdCGN63Xi1UoTTqV.pdf', '2021-10-05 07:39:13', '2021-10-05 07:39:13'),
(161, 233, 1, 'nhà đầu tư đề nghị UBND huyện hỗ trợ đền bù giải phóng mặt bằng', '/storage/system/Qi2yGWCBsPjupQovcCbEsDOQWd6VfaRFiIC2CiaZ.pdf', '2021-10-05 07:40:38', '2021-10-05 07:40:38'),
(162, 233, 2, 'UBND huyện trả lời vè vấn đề hỗ trợ GPMB', '/storage/system/7jAzkiVrKWbDntHa4snwh1ZuxY0ZNJNSdGNUMOwg.pdf', '2021-10-05 07:41:01', '2021-10-05 07:41:01'),
(163, 249, 1, NULL, '/storage/system/2fLRxtFiI2TRTBJmVg16CaUbg1RgzyND9ih81Hct.pdf', '2021-10-05 07:51:14', '2021-10-05 07:51:14'),
(164, 250, 1, NULL, '/storage/system/O0tNMwdojyjmoqJ1AOtGh14rldmGWM25Z9UJPCzm.pdf', '2021-10-05 07:51:31', '2021-10-05 07:51:31'),
(165, 251, 1, NULL, '/storage/system/ErR3dVEEvi3ddQs54HNNuK996le70rj2f1h5p2PL.pdf', '2021-10-05 07:51:43', '2021-10-05 07:51:43'),
(166, 254, 1, NULL, '/storage/system/lZyrzygQGEAX4lxPbzJOyvuaRuNUqUXzH46183Je.pdf', '2021-10-05 08:00:29', '2021-10-05 08:00:29'),
(167, 255, 1, NULL, '/storage/system/6T5Bo9nYUAvOGHflBS4P8ZtiXXA2R3neo5Rx4ESZ.pdf', '2021-10-05 08:00:39', '2021-10-05 08:00:39'),
(168, 257, 1, NULL, '/storage/system/4kCBWEyWcUj9eHZ7cGVc8F4zB9AvhzKu5i0sQ1SQ.pdf', '2021-10-05 08:01:04', '2021-10-05 08:01:04'),
(169, 258, 1, NULL, '/storage/system/ssR8Zd4RFJvTy6efiviRG4vgPWuwqxHMkdUvH4Ga.pdf', '2021-10-05 08:01:26', '2021-10-05 08:01:26'),
(170, 258, 2, 'trả lời của sở nông nghiệp', '/storage/system/L9CXfzb79PsI959e8Hacrh1mR4YNUVsdfTeOAmKJ.pdf', '2021-10-05 08:01:53', '2021-10-05 08:01:53'),
(171, 258, 3, 'trả lời của sở xây dựng', '/storage/system/Rrc7CAdHP9WjWOBR55GmNK5YHWTivEAOeIoAanj4.pdf', '2021-10-05 08:02:11', '2021-10-05 08:02:11'),
(172, 259, 1, NULL, '/storage/system/xGORPAEZkWgUiR0Ps5mI9snT4MmnwlodwDtkA2L3.pdf', '2021-10-05 08:02:26', '2021-10-05 08:02:26'),
(173, 259, 2, NULL, '/storage/system/XjvrmR29xUIPdax7qqWHkwwCRoufbBnraoMzbS0r.pdf', '2021-10-05 08:02:32', '2021-10-05 08:02:32'),
(174, 261, 1, NULL, '/storage/system/iw86jdZJKeMBENKseTgThcdmybBHSJP1sFHQ18LR.pdf', '2021-10-05 08:02:50', '2021-10-05 08:02:50'),
(175, 262, 1, NULL, '/storage/system/IKGYVObHlhOyV7bmpxBN4xTphFjfjm41OpbGcLkq.pdf', '2021-10-05 08:03:03', '2021-10-05 08:03:03'),
(176, 263, 1, NULL, '/storage/system/UtFUXxm4PGbx3uBWxAHoQrjMiTxtESDCeBDu1KFY.pdf', '2021-10-05 08:03:14', '2021-10-05 08:03:14'),
(177, 264, 1, NULL, '/storage/system/yMZeC6Rhyc2hXNnoN7HRqnw12aF186hSku6PIz3d.pdf', '2021-10-05 08:08:11', '2021-10-05 08:08:11'),
(178, 265, 1, NULL, '/storage/system/x4KPkgwZxjJEKMIrnSHBE3BYDmCu5UOAQRszuOwW.pdf', '2021-10-05 08:08:20', '2021-10-05 08:08:20'),
(179, 211, 1, 'Sở Tài chính ý kiến về đất BVYHCT thuộc tiểu khu 1', '/storage/system/Owr5fT0TckuygZj7vRiIIsALUjE6c3JaWCv5jnXj.pdf', '2021-10-05 08:46:18', '2021-10-05 08:46:18'),
(180, 213, 1, 'Sở KHĐT đề nghị các sở ban ngành cung cấp thông tin thực hiện dự án', '/storage/system/CcFSnGS44DLTIj3ELA2q1QbqZu3hRFiUnUWrpAFg.pdf', '2021-10-05 08:48:55', '2021-10-05 08:48:55'),
(181, 219, 1, 'UBND tỉnh điều chỉnh cục bộ quy hoạch 1/2000', '/storage/system/2EbCS2royILmaMQ6tIXjv7RrlPUAdGURs9OnUvpc.pdf', '2021-10-05 08:51:10', '2021-10-05 08:51:10'),
(182, 214, 1, 'Sở Tài chính đề nghị xây dựng quy hoạch 1/500 cho Tiểu khu 1', '/storage/system/2ep876F6iJLNUDVSzP11m81QI64CjzZWeANn5jMn.pdf', '2021-10-05 08:54:11', '2021-10-05 08:54:11'),
(183, 215, 1, 'Sở KHĐT đề xuất UBND tỉnh thực hiện tổ chức đấu thầu, đưa BVYHCT vào giá trị m2', '/storage/system/1z8SnkP0xrdd5TBd2jouBI7jseatAfKo4UITiQ8b.pdf', '2021-10-05 08:55:03', '2021-10-05 08:55:03'),
(184, 217, 1, 'UBND tỉnh giao SXD là bên mời thầu, giao STC định giá BVYHCT để đưa vào m2', '/storage/system/XE1BU0uSZ6MqaTMSC89gpqel4JFQDy0oqNBij77O.pdf', '2021-10-05 08:56:20', '2021-10-05 08:56:20'),
(185, 218, 1, 'UBND tỉnh phê duyệt giá trị tài sản BVYHCT', '/storage/system/HyLRwCUY61YU1VRMUjQAbxPH1FZVEs62hOxnAg4I.pdf', '2021-10-05 08:57:06', '2021-10-05 08:57:06'),
(186, 242, 1, 'Sở KHĐT đề nghị SXD công bố thông tin dự án, triển khai mời thầu', '/storage/system/CkA8JD1OIi8p1io1KToFRG9dj9hrC5v1QwbY4QET.pdf', '2021-10-05 08:59:34', '2021-10-05 08:59:34'),
(187, 243, 1, 'UBND huyện tạm tính giá trị GPMB', '/storage/system/iClxrx2cchiabx2ujH1EvQM9lahLmoowraQnGTyL.pdf', '2021-10-05 09:00:44', '2021-10-05 09:00:44'),
(188, 244, 1, 'Sở TNMT trình UBND tỉnh phê duyệt chi phí GPMB sơ bộ', '/storage/system/enQwn2kfGX1aPz0JmITKEcSPiiNcouMVPBILvjNL.pdf', '2021-10-05 09:02:51', '2021-10-05 09:02:51'),
(189, 245, 1, 'UBND tỉnh phê duyệt chi phí GPMB sơ bộ', '/storage/system/lE6CWXiS6fcGthGZSDie1Cr2tFEl83E3OKrsy5MH.pdf', '2021-10-05 09:06:56', '2021-10-05 09:06:56'),
(190, 246, 1, 'Sở Tài chính tạm tính giá sàn m3', '/storage/system/wZmhxPYUalCUjVVXa0RjsHZT07Mr4oyJtaCitiEA.pdf', '2021-10-05 09:10:54', '2021-10-05 09:10:54'),
(191, 247, 1, 'Sở KHĐT đề nghị UBND tỉnh phê duyệt danh mục dự án có sử dụng đất', '/storage/system/0aN6RbzMJThnJXeJvNIrctZIZzu9XES45mbFafp3.pdf', '2021-10-05 09:12:07', '2021-10-05 09:12:07'),
(192, 248, 1, NULL, '/storage/system/Q623iCTOqZnk9d4cYQlHNZrxkzG30fyjIRN06LN5.pdf', '2021-10-05 09:14:01', '2021-10-05 09:14:01'),
(193, 252, 1, NULL, '/storage/system/WvzVPLg9zJFQn0Nn6g2lBQxLV55bo4qfCYzYkajp.pdf', '2021-10-05 09:16:53', '2021-10-05 09:16:53'),
(194, 253, 1, NULL, '/storage/system/jV1gm74gh0ad1T8b0sObX29iCb5jfcUGj4CLa4Ae.pdf', '2021-10-05 09:17:20', '2021-10-05 09:17:20'),
(195, 256, 1, NULL, '/storage/system/gmNXtIAp9blZtXGES2iSgK1Cyx0SNX9sGvClXVmA.pdf', '2021-10-05 09:17:58', '2021-10-05 09:17:58'),
(196, 287, 1, '2. Sở KHĐT lấy ý kiến thẩm định dự án, chấp thuận chủ trương đầu tư', '/storage/system/DdTaUfvYbm1l290BPfb7nPF1K7jGlbeLiQOftppk.pdf', '2021-10-05 09:23:54', '2021-10-05 09:23:54'),
(197, 287, 2, 'Ý kiến của Sở Xây dựng', '/storage/system/8awcX6upCsYXlKccjt62W7MUtlb8L7rlkK2CaMqr.pdf', '2021-10-05 09:24:13', '2021-10-05 09:24:13'),
(198, 287, 3, 'Ý kiến của Sở Tài chính', '/storage/system/PH5KIImtKaiEbgQ1sueZnaQoAI0KGrx0jZ2wyqDL.pdf', '2021-10-05 09:24:32', '2021-10-05 09:24:32'),
(199, 286, 1, NULL, '/storage/system/tIiD88cIHg4SPG15wb0FSfjll6TD34p5H67LWHkM.pdf', '2021-10-05 09:27:03', '2021-10-05 09:27:03'),
(200, 382, 1, NULL, '/storage/system/OAS4gigcUGqse61P9PDEq3wskINjoRGis98kakwb.pdf', '2021-10-05 14:31:55', '2021-10-05 14:31:55'),
(201, 383, 1, NULL, '/storage/system/tItHvx1OXRrsGnGBIObZ94wdPQfldyqiDFds3ktD.pdf', '2021-10-05 14:36:05', '2021-10-05 14:36:05'),
(202, 384, 1, NULL, '/storage/system/lOusMjQe5lfIdjMccEOqR8Ww9NMEmboSN2l9u9kB.pdf', '2021-10-05 14:37:04', '2021-10-05 14:37:04'),
(203, 385, 1, NULL, '/storage/system/Wk86CED814FEcFTioeCAKub5larbgUA40fRrKtYg.pdf', '2021-10-05 14:37:23', '2021-10-05 14:37:23'),
(204, 386, 1, NULL, '/storage/system/OP5z8aYauRJ6QdheyuUwiHkz7xjyqwoEYJlem4vs.pdf', '2021-10-05 14:38:31', '2021-10-05 14:38:31'),
(205, 387, 1, NULL, '/storage/system/8hMNfcB7G1RnNM7K9dej9vkoLeQG38jplPzjc8Db.pdf', '2021-10-05 14:39:04', '2021-10-05 14:39:04'),
(206, 388, 1, NULL, '/storage/system/kqM8XNvhbVTpqZ1QpTruAXoEMDvUY0JlPqY5zDko.pdf', '2021-10-05 14:39:18', '2021-10-05 14:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `subject`, `url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'hello', '', '2021-11-21 10:37:39', '2021-11-21 10:37:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identify` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iden_date` date DEFAULT NULL,
  `iden_location` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_code` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `married_status` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT '1',
  `admin_id` bigint(20) DEFAULT '3',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '1',
  `display` tinyint(4) DEFAULT '1',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `begin_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '#2180f3',
  `avatar` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `salary` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '5000000',
  `kpi` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `penalty` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `identify`, `iden_date`, `iden_location`, `tax_code`, `married_status`, `email_verified_at`, `password`, `role_id`, `admin_id`, `description`, `status`, `display`, `location`, `begin_date`, `end_date`, `birth_date`, `active_status`, `dark_mode`, `messenger_color`, `avatar`, `remember_token`, `created_at`, `updated_at`, `salary`, `kpi`, `penalty`) VALUES
(1, 'Super Admintrator', 'super.admin@dascam.com', '', '', NULL, NULL, NULL, NULL, NULL, '$2y$10$01SEpRKq6Oh7pPlvQL04W.s5BpjxsnSvD5e8bgzIDnOzy0TpLAas6', 1, 1, 'System super admin', 1, 1, NULL, NULL, NULL, NULL, 0, 0, '#2180f3', '', NULL, NULL, '2021-03-17 02:50:42', '5000000', '0', '0'),
(2, 'Admin', 'admin@gmail.com', '', '', NULL, NULL, NULL, NULL, NULL, '$2y$10$xvGOstc5Kn29pSfRNsyHuuSvAeg1ki1fr5ucX1L4.lFh9wW58pUWe', 1, 1, NULL, 1, 1, 'Hanoi', NULL, NULL, NULL, 0, 0, '#2180f3', '', NULL, '2020-08-05 03:56:26', '2021-04-01 08:39:56', '5000000', '0', '0'),
(4, 'Nguyễn Hoàng Sơn', 'son@gmail.com', '0943228989', '015126847', NULL, NULL, NULL, NULL, NULL, '$2y$10$lvVD6JVOV7lSfGCej19Qm.clBW089BCoVO8.cpYKMdc8ak937BjVW', 3, 3, NULL, 0, 1, NULL, NULL, NULL, NULL, 0, 0, '#2180f3', '', NULL, '2020-11-26 23:08:43', '2021-03-27 22:26:52', '5000000', '0', '0'),
(17, 'Truong Tien Dung', 'ttdung993@gmail.com', '0936167485', '01337370411', NULL, NULL, NULL, NULL, NULL, '$2y$10$MFhRXmMK3i.D1hK8U1MfheVig2mUUFQXG9Sn5a9lZ5rUArm1uVygq', 1, 2, NULL, 1, 1, NULL, NULL, NULL, NULL, 1, 0, '#2180f3', '/storage/system/77azsPGqh7xbTyoyIxlYtrwLXFF0d0gqklYfya40.jpg', NULL, '2020-11-27 04:58:36', '2021-11-03 05:55:35', '5000000', '0', '0'),
(28, 'Nguyễn Đình Chiến', 'chiennd@lopital.vn', '234234234', '1234563', NULL, NULL, NULL, NULL, NULL, '$2y$10$mEckiIFmn6VsYlmteBYdg.Dzs0AjgPKvyRx2z4G.7PYKX1tETjATe', 24, 2, NULL, 1, 1, NULL, NULL, NULL, NULL, 0, 0, '#2180f3', '/storage/system/IOKShNBtWkSYxS1j4TB5EbFA7VSUeC7UXxwSF7Ym.jpg', NULL, '2021-02-24 05:17:36', '2021-05-08 13:33:15', '5000000', '0', '0'),
(118, 'Trương Đình Trọng', 'trongtd@lopital.vn', '124124124', '13457237', '2011-07-20', 'CA Hà Nội', '', 1, NULL, '$2y$10$GWZ1RbPhX6N/fg2jDnzwO.MD9cQYlqkVPxuWEgKtp7QFknRJxkn3y', 13, 3, NULL, 1, 1, NULL, '2020-02-02', '2020-02-02', '1977-01-31', 0, 0, '#2180f3', '', NULL, NULL, '2021-03-28 19:21:15', '5000000', '0', '0'),
(145, 'Nguyễn Thị Thu Thảo', 'nguyenthithuthao.vp@gmail.com', '0395848688', '26190001875', '2017-01-10', 'Cục trưởng cục cảnh sát ĐKQL cư trú và DLQG về dân cư.', '', 1, NULL, '$2y$10$3slX.3MdtT8YBBbknkQ15.7QEHcC2wvQnEZKV1NaGpqkn9dB86moe', 2, 3, NULL, 1, 1, NULL, '2020-08-11', '2020-02-02', '1990-07-31', 0, 0, '#2180f3', '', NULL, NULL, '2021-04-01 08:28:14', '5000000', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_add_request`
--

CREATE TABLE `users_add_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `identify` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `iden_date` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iden_location` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_code` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date NOT NULL,
  `begin_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_add_request`
--

INSERT INTO `users_add_request` (`id`, `user_id`, `name`, `email`, `password`, `phone`, `role_id`, `identify`, `iden_date`, `iden_location`, `tax_code`, `birth_date`, `begin_date`, `status`, `avatar`, `created_at`, `updated_at`) VALUES
(3, 26, 'nguyễn minh hoàng', 'hoang97@gmail.com', '$2y$10$SNs0ySzfuYQOz5HKlkMujOgj2pTcDTW9h/4cPQ/neRCufy4tKnPOa', '09423423423', 5, '0312938124214', '2001-03-23', 'công an Hà Nội', '432423423423', '2021-07-10', '2021-07-23', 1, NULL, '2021-07-23 12:58:50', '2021-07-23 12:58:50'),
(4, 0, 'dung truong', 'ttdung13081991@gmail.com', '$2y$10$IJ2RjvwvgfNThWhxJnx7UelQFaCojeqg3RtY3HoY5Z7M6aQMH0zWG', '0936167485', 5, '123123', '2021-07-07', '123123', NULL, '2021-06-30', '0000-00-00', 2, '/storage/system/T3fzfakDpXarPt7lUecny23BYrVUluMM6kU64Hvr.png', '2021-07-27 22:13:40', '2021-07-27 22:13:40'),
(5, 0, 'qwrq', 'ttdung13081991@gmail.com', '$2y$10$USpPBraHMsIOsPLlfWHhQ.zEzDZ0DMu18D6uemFX5haEnCPqm7ARq', 'qweqwe', 5, '123123', '2021-07-01', '123123', NULL, '2021-07-13', '0000-00-00', 2, '/storage/system/Blgya3A3BHl4cAqlNCVjyj1QSKftyI0eK9PCqZZ8.png', '2021-07-28 13:36:43', '2021-07-28 13:36:43'),
(6, 0, 'Nguyễn Hoàng Sơn', 'minhvahoang97@gmail.com', '$2y$10$6iegK8TZeORO8JkvIB5xkeXg4F/h09KjQiJ7kjhOzc/90PXcTlvaK', '0943228989', 5, '534534543532', '1997-09-25', 'công an Hà Nội', NULL, '1997-09-25', '0000-00-00', 2, '/storage/system/LwDs7iS0OYlXk3WLBUknINDCxdGpkgWFIkjkHl4v.gif', '2021-08-05 21:38:28', '2021-08-05 21:38:28'),
(7, 0, 'Tăng Thu Thảo', 'dung23@bkcs.com', '$2y$10$m6NetxTM8owJk9S7LZJOiu6NATbuEG8d5ax/BJPi0bnBB8KMHLEA.', '0936167485', 5, '123124', '2021-08-31', '124124', NULL, '2021-09-07', '0000-00-00', 2, '/storage/system/aeYNZIO3dHN9zsM7BcfwyOscSQutzsPC2AME39xb.png', '2021-09-07 13:41:20', '2021-09-07 13:41:20'),
(8, 0, 'Truong Tien Dung', 'dung14@bkcs.com', '$2y$10$LpcPnY2/gu8weI7DbPNVZeltqlDEH1.9urZ1fkQHX5PVF2TXeLLju', '0936167485', 5, '124124', '2021-09-09', '123123123', NULL, '2021-09-14', '0000-00-00', 2, '/storage/system/F1kym2Oav13NmK6fr8d8ajc4dmIZaWLfOGdlXpzm.png', '2021-09-07 13:44:12', '2021-09-07 13:44:12'),
(9, 0, 'nguyen hoang son', 'minhvahoang97@gmail.com', '$2y$10$cglzGK2s4YSKS9RL2JTUTeY9puQ61MhQseNlYbAsBJQk6hK1TaHpG', '0943228989', 5, '0312938124214', '2021-09-08', 'công an Hà Nội', NULL, '2021-09-08', '0000-00-00', 1, '/storage/system/sfUrobcG9NyWz68vBNxUCqzYPcRytIiqRQ0chiqt.png', '2021-09-07 13:57:48', '2021-09-07 13:57:48'),
(10, 0, '111', 'admin211@gmail.com', '$2y$10$eTBDbtxUcK9In4YNgwOkQuEa/66uF9lv./loO4olYUAPMEL6aakEW', '0936167485', 5, '123', '2021-09-10', '2021-09-0w', NULL, '2021-09-11', '0000-00-00', 2, '/storage/system/uq8ANqzewry97Hl0UQLdyQ0fBb9bYQ3oOu5XZyjN.png', '2021-09-07 13:59:00', '2021-09-07 13:59:00'),
(11, 0, 'Nguyen Minh Hoang', 'hoangtuankhang888@gmail.com', '$2y$10$CleOUF64h4VDlX466iJz0Oxfd8S93eSCMz3zQSTmrsB21KPpM8FfK', '0934596789', 5, '024097000022', '2016-01-08', 'CTCCSDKQLCTVDLQGVDC', NULL, '1997-02-22', '0000-00-00', 1, '/storage/system/9ADQiBHF1Ix6F3osnupJtSXmg1lrVEXS3vx5d0r1.jpg', '2021-09-07 14:00:59', '2021-09-07 14:00:59'),
(12, 0, 'Nguyen xuan anh trung', 'nxat97@gmail.com', '$2y$10$.qGwkX9pJ9QN0OwKe.l6mudVH/G99jBBnM9dtqC.MqPckvImkAnnC', '9938939939”3', 5, '84999494', '2021-09-24', 'Ha noi', NULL, '2021-09-16', '0000-00-00', 1, '/storage/system/fVbV7v4PopDkUYuHb3iQyWrVNBDWVTJscESvNT5H.jpg', '2021-09-07 14:18:37', '2021-09-07 14:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `users_delete_request`
--

CREATE TABLE `users_delete_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_location_access`
--

CREATE TABLE `users_location_access` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double(8,2) NOT NULL,
  `longitude` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_location_access`
--

INSERT INTO `users_location_access` (`id`, `user_id`, `ip`, `city`, `country_name`, `isp`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 2, '1.53.36.41', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-08 15:25:25', '2020-08-08 15:25:25'),
(2, 2, '1.53.36.41', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-08 15:27:08', '2020-08-08 15:27:08'),
(3, 2, '1.55.245.4', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-10 12:59:46', '2020-08-10 12:59:46'),
(4, 2, '118.71.206.11', 'Hanoi', 'Vietnam', '', 21.03, 105.85, '2020-08-13 17:48:18', '2020-08-13 17:48:18'),
(5, 2, '1.55.245.4', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-17 09:13:42', '2020-08-17 09:13:42'),
(6, 2, '1.55.245.39', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-19 08:31:03', '2020-08-19 08:31:03'),
(7, 2, '1.55.245.39', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-19 13:23:13', '2020-08-19 13:23:13'),
(8, 2, '1.55.245.4', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-21 11:05:16', '2020-08-21 11:05:16'),
(9, 2, '1.55.245.4', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-24 08:49:25', '2020-08-24 08:49:25'),
(10, 2, '1.55.245.4', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-24 11:09:44', '2020-08-24 11:09:44'),
(11, 2, '1.55.245.4', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-25 16:20:05', '2020-08-25 16:20:05'),
(12, 2, '1.55.245.4', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-26 15:38:57', '2020-08-26 15:38:57'),
(13, 2, '1.55.245.4', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-26 15:59:57', '2020-08-26 15:59:57'),
(14, 2, '1.55.245.4', 'Hanoi', 'Vietnam', 'FPT Telecom Company', 21.03, 105.85, '2020-08-27 08:32:10', '2020-08-27 08:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_confirm`
--

CREATE TABLE `user_confirm` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `front` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `back` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 145, 2, '2021-11-27 01:56:17', '2021-11-27 01:56:17'),
(2, 17, 1, '2021-11-27 01:57:04', '2021-11-27 01:57:04'),
(3, 28, 24, '2021-11-27 01:57:19', '2021-11-27 01:57:19'),
(4, 118, 11, '2021-11-27 01:58:02', '2021-11-27 01:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_salary`
--

CREATE TABLE `user_salary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `salary` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `penalty` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gap` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `kpi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(5) NOT NULL,
  `month` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_noti`
--

CREATE TABLE `warehouse_noti` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seen` smallint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE `weather` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `low` int(11) NOT NULL,
  `high` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `humidity` int(11) NOT NULL,
  `des` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `weather`
--

INSERT INTO `weather` (`id`, `project_id`, `low`, `high`, `start`, `end`, `humidity`, `des`, `updated_at`, `created_at`) VALUES
(71, 0, 27, 34, '2021-06-05', '2021-06-05', 70, 'Có mây. nóng.', '2021-06-05 05:00:16', '2021-06-05 05:00:16'),
(85, 0, 27, 35, '2021-06-06', '2021-06-06', 56, 'Mưa rào trễ. U ám. nóng.', '2021-06-06 05:00:03', '2021-06-06 05:00:03'),
(92, 0, 28, 34, '2021-06-07', '2021-06-07', 59, 'Dông trễ. U ám. nóng.', '2021-06-06 11:00:04', '2021-06-06 11:00:04'),
(99, 0, 27, 34, '2021-06-08', '2021-06-08', 58, 'Mưa nhẹ. U ám. nóng.', '2021-06-07 11:00:03', '2021-06-07 11:00:03'),
(183, 1, 26, 33, '2021-06-09', '2021-06-09', 62, 'U ám. nóng.', '2021-06-09 11:00:05', '2021-06-09 11:00:05'),
(191, 2, 28, 31, '2021-06-09', '2021-06-09', 78, 'U ám. Cảnh báo.', '2021-06-09 11:00:09', '2021-06-09 11:00:09'),
(199, 3, 25, 31, '2021-06-09', '2021-06-09', 62, 'Mây thoáng qua. Cảnh báo.', '2021-06-09 11:00:12', '2021-06-09 11:00:12'),
(231, 1, 26, 33, '2021-06-10', '2021-06-10', 56, 'Nắng từng phần. Cực nóng.', '2021-06-10 11:00:04', '2021-06-10 11:00:04'),
(239, 2, 26, 32, '2021-06-10', '2021-06-10', 45, 'U ám. nóng.', '2021-06-10 11:00:11', '2021-06-10 11:00:11'),
(247, 3, 25, 31, '2021-06-10', '2021-06-10', 70, 'Mây phân tán. Cảnh báo.', '2021-06-10 11:00:14', '2021-06-10 11:00:14'),
(303, 1, 26, 33, '2021-06-11', '2021-06-11', 83, 'U ám. Cảnh báo.', '2021-06-11 17:00:02', '2021-06-11 17:00:02'),
(311, 2, 27, 33, '2021-06-11', '2021-06-11', 65, 'U ám. Cảnh báo.', '2021-06-11 17:00:05', '2021-06-11 17:00:05'),
(319, 3, 25, 30, '2021-06-11', '2021-06-11', 94, 'Trong sáng. Cảnh báo.', '2021-06-11 17:00:08', '2021-06-11 17:00:08'),
(399, 1, 26, 26, '2021-06-12', '2021-06-12', 93, 'Mưa dông. U ám. Cảnh báo.', '2021-06-12 17:00:03', '2021-06-12 17:00:03'),
(407, 2, 28, 31, '2021-06-12', '2021-06-12', 63, 'U ám. Cảnh báo.', '2021-06-12 17:00:05', '2021-06-12 17:00:05'),
(415, 3, 25, 30, '2021-06-12', '2021-06-12', 84, 'Mưa nhẹ. Mây thoáng qua. Cảnh báo.', '2021-06-12 17:00:08', '2021-06-12 17:00:08'),
(495, 1, 25, 32, '2021-06-13', '2021-06-13', 76, 'U ám. Cảnh báo.', '2021-06-13 17:00:02', '2021-06-13 17:00:02'),
(503, 2, 26, 35, '2021-06-13', '2021-06-13', 80, 'Mây thoáng qua. Cảnh báo.', '2021-06-13 17:00:06', '2021-06-13 17:00:06'),
(511, 3, 25, 27, '2021-06-13', '2021-06-13', 94, 'Mây thoáng qua. Cảnh báo.', '2021-06-13 17:00:09', '2021-06-13 17:00:09'),
(591, 1, 27, 34, '2021-06-14', '2021-06-14', 65, 'Mây thoáng qua. nóng.', '2021-06-14 17:00:03', '2021-06-14 17:00:03'),
(599, 2, 26, 33, '2021-06-14', '2021-06-14', 83, 'U ám. Cảnh báo.', '2021-06-14 17:00:06', '2021-06-14 17:00:06'),
(607, 3, 25, 32, '2021-06-14', '2021-06-14', 94, 'Trong sáng. Cảnh báo.', '2021-06-14 17:00:09', '2021-06-14 17:00:09'),
(687, 1, 27, 36, '2021-06-15', '2021-06-15', 64, 'Mây thoáng qua. nóng.', '2021-06-15 17:00:03', '2021-06-15 17:00:03'),
(695, 2, 27, 35, '2021-06-15', '2021-06-15', 54, 'Mây thoáng qua. nóng.', '2021-06-15 17:00:06', '2021-06-15 17:00:06'),
(703, 3, 25, 34, '2021-06-15', '2021-06-15', 89, 'Trong sáng. Cảnh báo.', '2021-06-15 17:00:09', '2021-06-15 17:00:09'),
(783, 1, 28, 37, '2021-06-16', '2021-06-16', 57, 'Mây thoáng qua. nóng.', '2021-06-16 17:00:03', '2021-06-16 17:00:03'),
(791, 2, 26, 36, '2021-06-16', '2021-06-16', 58, 'U ám. nóng.', '2021-06-16 17:00:06', '2021-06-16 17:00:06'),
(799, 3, 26, 35, '2021-06-16', '2021-06-16', 84, 'Trong sáng. Cảnh báo.', '2021-06-16 17:00:09', '2021-06-16 17:00:09'),
(855, 1, 28, 36, '2021-06-17', '2021-06-17', 52, 'Mây thoáng qua. Cực nóng.', '2021-06-17 11:00:03', '2021-06-17 11:00:03'),
(863, 2, 27, 34, '2021-06-17', '2021-06-17', 88, 'U ám. Cảnh báo.', '2021-06-17 11:00:05', '2021-06-17 11:00:05'),
(871, 3, 26, 36, '2021-06-17', '2021-06-17', 42, 'Mây thoáng qua. Cực nóng.', '2021-06-17 11:00:08', '2021-06-17 11:00:08'),
(951, 1, 27, 38, '2021-06-18', '2021-06-18', 58, 'Mây thoáng qua. Cực nóng.', '2021-06-18 17:00:02', '2021-06-18 17:00:02'),
(959, 2, 26, 35, '2021-06-18', '2021-06-18', 86, 'U ám. Cảnh báo.', '2021-06-18 17:00:05', '2021-06-18 17:00:05'),
(967, 3, 27, 38, '2021-06-18', '2021-06-18', 63, 'Trong sáng. nóng.', '2021-06-18 17:00:08', '2021-06-18 17:00:08'),
(1047, 1, 28, 39, '2021-06-19', '2021-06-19', 56, 'Mây thoáng qua. Cực nóng.', '2021-06-19 17:00:03', '2021-06-19 17:00:03'),
(1055, 2, 27, 36, '2021-06-19', '2021-06-19', 62, 'U ám. Cảnh báo.', '2021-06-19 17:00:05', '2021-06-19 17:00:05'),
(1063, 3, 27, 38, '2021-06-19', '2021-06-19', 44, 'Trong sáng. Cực nóng.', '2021-06-19 17:00:08', '2021-06-19 17:00:08'),
(1143, 1, 29, 40, '2021-06-20', '2021-06-20', 50, 'Mây thoáng qua. Cực nóng.', '2021-06-20 17:00:03', '2021-06-20 17:00:03'),
(1151, 2, 27, 37, '2021-06-20', '2021-06-20', 82, 'Mây thoáng qua. Cảnh báo.', '2021-06-20 17:00:06', '2021-06-20 17:00:06'),
(1159, 3, 27, 38, '2021-06-20', '2021-06-20', 53, 'Trong sáng. Cực nóng.', '2021-06-20 17:00:09', '2021-06-20 17:00:09'),
(1239, 1, 29, 39, '2021-06-21', '2021-06-21', 50, 'Mây thoáng qua. Cực nóng.', '2021-06-21 17:00:04', '2021-06-21 17:00:04'),
(1247, 2, 27, 36, '2021-06-21', '2021-06-21', 62, 'Mây thoáng qua. nóng.', '2021-06-21 17:00:07', '2021-06-21 17:00:07'),
(1255, 3, 27, 38, '2021-06-21', '2021-06-21', 63, 'Trong sáng. nóng.', '2021-06-21 17:00:09', '2021-06-21 17:00:09'),
(1335, 1, 29, 39, '2021-06-22', '2021-06-22', 72, 'Mây thoáng qua. Cực nóng.', '2021-06-22 17:00:03', '2021-06-22 17:00:03'),
(1343, 2, 27, 36, '2021-06-22', '2021-06-22', 71, 'U ám. Cảnh báo.', '2021-06-22 17:00:05', '2021-06-22 17:00:05'),
(1351, 3, 27, 36, '2021-06-22', '2021-06-22', 74, 'Mây thoáng qua. Cảnh báo.', '2021-06-22 17:00:08', '2021-06-22 17:00:08'),
(1431, 1, 29, 36, '2021-06-23', '2021-06-23', 61, 'U ám. nóng.', '2021-06-23 17:00:03', '2021-06-23 17:00:03'),
(1439, 2, 26, 36, '2021-06-23', '2021-06-23', 85, 'Mây thoáng qua. Cảnh báo.', '2021-06-23 17:00:06', '2021-06-23 17:00:06'),
(1447, 3, 26, 35, '2021-06-23', '2021-06-23', 84, 'Trong sáng. Cảnh báo.', '2021-06-23 17:00:08', '2021-06-23 17:00:08'),
(1527, 1, 28, 36, '2021-06-24', '2021-06-24', 66, 'U ám. nóng.', '2021-06-24 17:00:03', '2021-06-24 17:00:03'),
(1535, 2, 27, 36, '2021-06-24', '2021-06-24', 84, 'Mây thoáng qua. Cảnh báo.', '2021-06-24 17:00:07', '2021-06-24 17:00:07'),
(1543, 3, 26, 31, '2021-06-24', '2021-06-24', 94, 'Mây thoáng qua. Cảnh báo.', '2021-06-24 17:00:09', '2021-06-24 17:00:09'),
(1623, 1, 28, 37, '2021-06-25', '2021-06-25', 59, 'Mây thoáng qua. nóng.', '2021-06-25 17:00:04', '2021-06-25 17:00:04'),
(1631, 2, 27, 34, '2021-06-25', '2021-06-25', 90, 'U ám. Cảnh báo.', '2021-06-25 17:00:06', '2021-06-25 17:00:06'),
(1639, 3, 26, 33, '2021-06-25', '2021-06-25', 89, 'Mưa nhẹ. Mây thoáng qua. Cảnh báo.', '2021-06-25 17:00:09', '2021-06-25 17:00:09'),
(1719, 1, 28, 35, '2021-06-26', '2021-06-26', 60, 'Mây thoáng qua. nóng.', '2021-06-26 17:00:04', '2021-06-26 17:00:04'),
(1727, 2, 28, 33, '2021-06-26', '2021-06-26', 95, 'U ám. Cảnh báo.', '2021-06-26 17:00:06', '2021-06-26 17:00:06'),
(1735, 3, 25, 35, '2021-06-26', '2021-06-26', 79, 'Trong sáng. Cảnh báo.', '2021-06-26 17:00:08', '2021-06-26 17:00:08'),
(1815, 1, 29, 36, '2021-06-27', '2021-06-27', 58, 'Mây thoáng qua. nóng.', '2021-06-27 17:00:03', '2021-06-27 17:00:03'),
(1823, 2, 27, 34, '2021-06-27', '2021-06-27', 91, 'U ám. Cảnh báo.', '2021-06-27 17:00:05', '2021-06-27 17:00:05'),
(1831, 3, 25, 37, '2021-06-27', '2021-06-27', 59, 'Trong sáng. nóng.', '2021-06-27 17:00:08', '2021-06-27 17:00:08'),
(1911, 1, 30, 37, '2021-06-28', '2021-06-28', 56, 'Mây thoáng qua. nóng.', '2021-06-28 17:00:03', '2021-06-28 17:00:03'),
(1919, 2, 27, 35, '2021-06-28', '2021-06-28', 81, 'Mây thoáng qua. Cảnh báo.', '2021-06-28 17:00:05', '2021-06-28 17:00:05'),
(1927, 3, 27, 37, '2021-06-28', '2021-06-28', 55, 'Trong sáng. nóng.', '2021-06-28 17:00:08', '2021-06-28 17:00:08'),
(2007, 1, 30, 35, '2021-06-29', '2021-06-29', 64, 'U ám. nóng.', '2021-06-29 17:00:02', '2021-06-29 17:00:02'),
(2015, 2, 27, 35, '2021-06-29', '2021-06-29', 82, 'U ám. Cảnh báo.', '2021-06-29 17:00:05', '2021-06-29 17:00:05'),
(2023, 3, 27, 35, '2021-06-29', '2021-06-29', 66, 'Trong sáng. Cảnh báo.', '2021-06-29 17:00:08', '2021-06-29 17:00:08'),
(2103, 1, 29, 37, '2021-06-30', '2021-06-30', 57, 'U ám. nóng.', '2021-06-30 17:00:03', '2021-06-30 17:00:03'),
(2111, 2, 27, 35, '2021-06-30', '2021-06-30', 80, 'U ám. Cảnh báo.', '2021-06-30 17:00:05', '2021-06-30 17:00:05'),
(2119, 3, 26, 36, '2021-06-30', '2021-06-30', 62, 'Mây thoáng qua. Cảnh báo.', '2021-06-30 17:00:08', '2021-06-30 17:00:08'),
(2199, 1, 28, 37, '2021-07-01', '2021-07-01', 51, 'Mây thoáng qua. nóng.', '2021-07-01 17:00:03', '2021-07-01 17:00:03'),
(2207, 2, 27, 35, '2021-07-01', '2021-07-01', 85, 'U ám. Cảnh báo.', '2021-07-01 17:00:06', '2021-07-01 17:00:06'),
(2215, 3, 27, 36, '2021-07-01', '2021-07-01', 62, 'Trong sáng. Cảnh báo.', '2021-07-01 17:00:08', '2021-07-01 17:00:08'),
(2295, 1, 29, 38, '2021-07-02', '2021-07-02', 52, 'Mây thoáng qua. nóng.', '2021-07-02 17:00:03', '2021-07-02 17:00:03'),
(2303, 2, 27, 35, '2021-07-02', '2021-07-02', 88, 'U ám. Cảnh báo.', '2021-07-02 17:00:06', '2021-07-02 17:00:06'),
(2311, 3, 26, 37, '2021-07-02', '2021-07-02', 59, 'Trong sáng. nóng.', '2021-07-02 17:00:08', '2021-07-02 17:00:08'),
(2391, 1, 29, 38, '2021-07-03', '2021-07-03', 57, 'Mây thoáng qua. nóng.', '2021-07-03 17:00:03', '2021-07-03 17:00:03'),
(2399, 2, 26, 35, '2021-07-03', '2021-07-03', 75, 'Mây thoáng qua. Cảnh báo.', '2021-07-03 17:00:06', '2021-07-03 17:00:06'),
(2407, 3, 27, 37, '2021-07-03', '2021-07-03', 62, 'Mây thoáng qua. Cảnh báo.', '2021-07-03 17:00:09', '2021-07-03 17:00:09'),
(2487, 1, 28, 38, '2021-07-04', '2021-07-04', 71, 'U ám. nóng.', '2021-07-04 17:00:02', '2021-07-04 17:00:02'),
(2495, 2, 26, 33, '2021-07-04', '2021-07-04', 57, 'U ám. Cảnh báo.', '2021-07-04 17:00:05', '2021-07-04 17:00:05'),
(2503, 3, 26, 35, '2021-07-04', '2021-07-04', 79, 'Trong sáng. Cảnh báo.', '2021-07-04 17:00:08', '2021-07-04 17:00:08'),
(2583, 1, 28, 36, '2021-07-05', '2021-07-05', 76, 'Mây thoáng qua. nóng.', '2021-07-05 17:00:03', '2021-07-05 17:00:03'),
(2591, 2, 25, 30, '2021-07-05', '2021-07-05', 88, 'U ám. Cảnh báo.', '2021-07-05 17:00:06', '2021-07-05 17:00:06'),
(2599, 3, 26, 33, '2021-07-05', '2021-07-05', 75, 'Mây thoáng qua. Cảnh báo.', '2021-07-05 17:00:09', '2021-07-05 17:00:09'),
(2679, 1, 27, 33, '2021-07-06', '2021-07-06', 75, 'U ám. Cảnh báo.', '2021-07-06 17:00:03', '2021-07-06 17:00:03'),
(2687, 2, 25, 31, '2021-07-06', '2021-07-06', 84, 'U ám. Cảnh báo.', '2021-07-06 17:00:06', '2021-07-06 17:00:06'),
(2695, 3, 26, 34, '2021-07-06', '2021-07-06', 62, 'Mây thoáng qua. Cảnh báo.', '2021-07-06 17:00:09', '2021-07-06 17:00:09'),
(2775, 1, 25, 26, '2021-07-07', '2021-07-07', 85, 'Mưa nhẹ. U ám. Cảnh báo.', '2021-07-07 17:00:03', '2021-07-07 17:00:03'),
(2783, 2, 25, 31, '2021-07-07', '2021-07-07', 77, 'Mây thoáng qua. Cảnh báo.', '2021-07-07 17:00:06', '2021-07-07 17:00:06'),
(2791, 3, 26, 33, '2021-07-07', '2021-07-07', 89, 'Mây thoáng qua. Cảnh báo.', '2021-07-07 17:00:08', '2021-07-07 17:00:08'),
(2871, 1, 25, 31, '2021-07-08', '2021-07-08', 82, 'Trong sáng. Cảnh báo.', '2021-07-08 17:00:03', '2021-07-08 17:00:03'),
(2879, 2, 26, 30, '2021-07-08', '2021-07-08', 92, 'U ám. Cảnh báo.', '2021-07-08 17:00:06', '2021-07-08 17:00:06'),
(2887, 3, 25, 29, '2021-07-08', '2021-07-08', 94, 'Mây thoáng qua. Cảnh báo.', '2021-07-08 17:00:08', '2021-07-08 17:00:08'),
(2967, 1, 26, 33, '2021-07-09', '2021-07-09', 79, 'Mây thoáng qua. Cảnh báo.', '2021-07-09 17:00:03', '2021-07-09 17:00:03'),
(2975, 2, 26, 31, '2021-07-09', '2021-07-09', 87, 'U ám. Cảnh báo.', '2021-07-09 17:00:05', '2021-07-09 17:00:05'),
(2983, 3, 25, 30, '2021-07-09', '2021-07-09', 89, 'Mây thoáng qua. Cảnh báo.', '2021-07-09 17:00:07', '2021-07-09 17:00:07'),
(3063, 1, 26, 33, '2021-07-10', '2021-07-10', 79, 'Mây thoáng qua. Cảnh báo.', '2021-07-10 17:00:02', '2021-07-10 17:00:02'),
(3071, 2, 26, 31, '2021-07-10', '2021-07-10', 87, 'Mây thoáng qua. Cảnh báo.', '2021-07-10 17:00:05', '2021-07-10 17:00:05'),
(3079, 3, 24, 32, '2021-07-10', '2021-07-10', 84, 'Trong sáng. Cảnh báo.', '2021-07-10 17:00:07', '2021-07-10 17:00:07'),
(3159, 1, 26, 32, '2021-07-11', '2021-07-11', 85, 'Mây thoáng qua. Cảnh báo.', '2021-07-11 17:00:04', '2021-07-11 17:00:04'),
(3167, 2, 25, 32, '2021-07-11', '2021-07-11', 85, 'Mây thoáng qua. Cảnh báo.', '2021-07-11 17:00:07', '2021-07-11 17:00:07'),
(3175, 3, 24, 33, '2021-07-11', '2021-07-11', 84, 'Trong sáng. Cảnh báo.', '2021-07-11 17:00:09', '2021-07-11 17:00:09'),
(3255, 1, 26, 33, '2021-07-12', '2021-07-12', 79, 'Mây thoáng qua. Cảnh báo.', '2021-07-12 17:00:02', '2021-07-12 17:00:02'),
(3263, 2, 26, 32, '2021-07-12', '2021-07-12', 82, 'U ám. Cảnh báo.', '2021-07-12 17:00:05', '2021-07-12 17:00:05'),
(3271, 3, 24, 34, '2021-07-12', '2021-07-12', 84, 'Trong sáng. Cảnh báo.', '2021-07-12 17:00:08', '2021-07-12 17:00:08'),
(3351, 1, 26, 34, '2021-07-13', '2021-07-13', 73, 'Mây thoáng qua. Cảnh báo.', '2021-07-13 17:00:03', '2021-07-13 17:00:03'),
(3359, 2, 26, 32, '2021-07-13', '2021-07-13', 84, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-07-13 17:00:06', '2021-07-13 17:00:06'),
(3367, 3, 25, 35, '2021-07-13', '2021-07-13', 89, 'Mây thoáng qua. Cảnh báo.', '2021-07-13 17:00:08', '2021-07-13 17:00:08'),
(3447, 1, 27, 33, '2021-07-14', '2021-07-14', 76, 'Mây thoáng qua. Cảnh báo.', '2021-07-14 17:00:03', '2021-07-14 17:00:03'),
(3455, 2, 26, 32, '2021-07-14', '2021-07-14', 82, 'Mây thoáng qua. Cảnh báo.', '2021-07-14 17:00:06', '2021-07-14 17:00:06'),
(3463, 3, 26, 34, '2021-07-14', '2021-07-14', 84, 'Mây thoáng qua. Cảnh báo.', '2021-07-14 17:00:09', '2021-07-14 17:00:09'),
(3543, 1, 27, 33, '2021-07-15', '2021-07-15', 71, 'Mây thoáng qua. Cảnh báo.', '2021-07-15 17:00:03', '2021-07-15 17:00:03'),
(3551, 2, 26, 31, '2021-07-15', '2021-07-15', 81, 'U ám. Cảnh báo.', '2021-07-15 17:00:06', '2021-07-15 17:00:06'),
(3559, 3, 26, 34, '2021-07-15', '2021-07-15', 84, 'Mây thoáng qua. Cảnh báo.', '2021-07-15 17:00:08', '2021-07-15 17:00:08'),
(3639, 1, 26, 33, '2021-07-16', '2021-07-16', 74, 'Mây thoáng qua. Cảnh báo.', '2021-07-16 17:00:03', '2021-07-16 17:00:03'),
(3647, 2, 25, 33, '2021-07-16', '2021-07-16', 93, 'U ám. Cảnh báo.', '2021-07-16 17:00:09', '2021-07-16 17:00:09'),
(3655, 3, 26, 34, '2021-07-16', '2021-07-16', 70, 'Trong sáng. Cảnh báo.', '2021-07-16 17:00:11', '2021-07-16 17:00:11'),
(3735, 1, 26, 36, '2021-07-17', '2021-07-17', 73, 'Mây thoáng qua. nóng.', '2021-07-17 17:00:09', '2021-07-17 17:00:09'),
(3743, 2, 25, 32, '2021-07-17', '2021-07-17', 78, 'Mây thoáng qua. Cảnh báo.', '2021-07-17 17:00:11', '2021-07-17 17:00:11'),
(3751, 3, 25, 36, '2021-07-17', '2021-07-17', 79, 'Trong sáng. Cảnh báo.', '2021-07-17 17:00:14', '2021-07-17 17:00:14'),
(3831, 1, 27, 37, '2021-07-18', '2021-07-18', 76, 'U ám. nóng.', '2021-07-18 17:00:03', '2021-07-18 17:00:03'),
(3839, 2, 26, 34, '2021-07-18', '2021-07-18', 77, 'U ám. Cảnh báo.', '2021-07-18 17:00:06', '2021-07-18 17:00:06'),
(3847, 3, 26, 33, '2021-07-18', '2021-07-18', 94, 'Mây thoáng qua. Cảnh báo.', '2021-07-18 17:00:08', '2021-07-18 17:00:08'),
(3927, 1, 27, 34, '2021-07-19', '2021-07-19', 67, 'Mây thoáng qua. nóng.', '2021-07-19 17:00:03', '2021-07-19 17:00:03'),
(3935, 2, 26, 32, '2021-07-19', '2021-07-19', 58, 'U ám. Cảnh báo.', '2021-07-19 17:00:05', '2021-07-19 17:00:05'),
(3943, 3, 26, 30, '2021-07-19', '2021-07-19', 89, 'Trong sáng. Cảnh báo.', '2021-07-19 17:00:08', '2021-07-19 17:00:08'),
(4023, 1, 27, 35, '2021-07-20', '2021-07-20', 61, 'Mây thoáng qua. nóng.', '2021-07-20 17:00:03', '2021-07-20 17:00:03'),
(4031, 2, 27, 33, '2021-07-20', '2021-07-20', 59, 'U ám. Cảnh báo.', '2021-07-20 17:00:05', '2021-07-20 17:00:05'),
(4039, 3, 25, 31, '2021-07-20', '2021-07-20', 100, 'Mây thoáng qua. Cảnh báo.', '2021-07-20 17:00:08', '2021-07-20 17:00:08'),
(4119, 1, 28, 35, '2021-07-21', '2021-07-21', 67, 'U ám. Cảnh báo.', '2021-07-21 17:00:04', '2021-07-21 17:00:04'),
(4127, 2, 28, 34, '2021-07-21', '2021-07-21', 60, 'U ám. nóng.', '2021-07-21 17:00:07', '2021-07-21 17:00:07'),
(4135, 3, 25, 31, '2021-07-21', '2021-07-21', 94, 'Trong sáng. Cảnh báo.', '2021-07-21 17:00:09', '2021-07-21 17:00:09'),
(4215, 1, 27, 32, '2021-07-22', '2021-07-22', 67, 'U ám. Cảnh báo.', '2021-07-22 17:00:03', '2021-07-22 17:00:03'),
(4223, 2, 28, 32, '2021-07-22', '2021-07-22', 58, 'Mây thoáng qua. Cảnh báo.', '2021-07-22 17:00:05', '2021-07-22 17:00:05'),
(4231, 3, 26, 31, '2021-07-22', '2021-07-22', 100, 'Mây thoáng qua. Cảnh báo.', '2021-07-22 17:00:08', '2021-07-22 17:00:08'),
(4311, 1, 26, 32, '2021-07-23', '2021-07-23', 89, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-07-23 17:00:03', '2021-07-23 17:00:03'),
(4319, 2, 28, 32, '2021-07-23', '2021-07-23', 62, 'U ám. Cảnh báo.', '2021-07-23 17:00:06', '2021-07-23 17:00:06'),
(4327, 3, 25, 29, '2021-07-23', '2021-07-23', 100, 'Trong sáng. Cảnh báo.', '2021-07-23 17:00:09', '2021-07-23 17:00:09'),
(4407, 1, 26, 27, '2021-07-24', '2021-07-24', 94, 'U ám. Cảnh báo.', '2021-07-24 17:00:03', '2021-07-24 17:00:03'),
(4415, 2, 28, 31, '2021-07-24', '2021-07-24', 52, 'U ám. Cảnh báo.', '2021-07-24 17:00:06', '2021-07-24 17:00:06'),
(4423, 3, 25, 33, '2021-07-24', '2021-07-24', 89, 'Mây thoáng qua. Cảnh báo.', '2021-07-24 17:00:09', '2021-07-24 17:00:09'),
(4503, 1, 26, 28, '2021-07-25', '2021-07-25', 88, 'U ám. Cảnh báo.', '2021-07-25 17:00:02', '2021-07-25 17:00:02'),
(4511, 2, 28, 32, '2021-07-25', '2021-07-25', 53, 'Mây thoáng qua. Cảnh báo.', '2021-07-25 17:00:05', '2021-07-25 17:00:05'),
(4519, 3, 26, 32, '2021-07-25', '2021-07-25', 74, 'Trong sáng. Cảnh báo.', '2021-07-25 17:00:07', '2021-07-25 17:00:07'),
(4599, 1, 26, 34, '2021-07-26', '2021-07-26', 66, 'Mây thoáng qua. nóng.', '2021-07-26 17:00:03', '2021-07-26 17:00:03'),
(4607, 2, 28, 35, '2021-07-26', '2021-07-26', 55, 'Mây thoáng qua. nóng.', '2021-07-26 17:00:06', '2021-07-26 17:00:06'),
(4615, 3, 25, 33, '2021-07-26', '2021-07-26', 89, 'Mây thoáng qua. Cảnh báo.', '2021-07-26 17:00:08', '2021-07-26 17:00:08'),
(4671, 1, 29, 36, '2021-07-27', '2021-07-27', 50, 'Mây thoáng qua. Cực nóng.', '2021-07-27 11:00:04', '2021-07-27 11:00:04'),
(4679, 2, 28, 35, '2021-07-27', '2021-07-27', 45, 'U ám. Cực nóng.', '2021-07-27 11:00:06', '2021-07-27 11:00:06'),
(4687, 3, 26, 35, '2021-07-27', '2021-07-27', 44, 'Đầy nắng. Cực nóng.', '2021-07-27 11:00:09', '2021-07-27 11:00:09'),
(4767, 1, 28, 37, '2021-07-28', '2021-07-28', 65, 'Mây thoáng qua. nóng.', '2021-07-28 17:00:03', '2021-07-28 17:00:03'),
(4775, 2, 28, 35, '2021-07-28', '2021-07-28', 60, 'U ám. nóng.', '2021-07-28 17:00:06', '2021-07-28 17:00:06'),
(4783, 3, 26, 35, '2021-07-28', '2021-07-28', 84, 'Mây thoáng qua. Cảnh báo.', '2021-07-28 17:00:08', '2021-07-28 17:00:08'),
(4863, 1, 29, 36, '2021-07-29', '2021-07-29', 66, 'U ám. nóng.', '2021-07-29 17:00:04', '2021-07-29 17:00:04'),
(4871, 2, 29, 35, '2021-07-29', '2021-07-29', 58, 'Mây thoáng qua. nóng.', '2021-07-29 17:00:07', '2021-07-29 17:00:07'),
(4879, 3, 27, 34, '2021-07-29', '2021-07-29', 94, 'Trong sáng. Cảnh báo.', '2021-07-29 17:00:09', '2021-07-29 17:00:09'),
(4959, 1, 29, 36, '2021-07-30', '2021-07-30', 77, 'Mây thoáng qua. Cảnh báo.', '2021-07-30 17:00:03', '2021-07-30 17:00:03'),
(4967, 2, 28, 35, '2021-07-30', '2021-07-30', 60, 'U ám. nóng.', '2021-07-30 17:00:06', '2021-07-30 17:00:06'),
(4975, 3, 27, 34, '2021-07-30', '2021-07-30', 84, 'Mây thoáng qua. Cảnh báo.', '2021-07-30 17:00:08', '2021-07-30 17:00:08'),
(5071, 3, 26, 37, '2021-07-31', '2021-07-31', 84, 'Mưa nhẹ. Mây thoáng qua. nóng.', '2021-07-31 17:00:08', '2021-07-31 17:00:08'),
(5079, 1, 29, 33, '2021-07-31', '2021-07-31', 60, 'Mây thoáng qua. nóng.', '2021-07-31 23:00:04', '2021-07-31 23:00:04'),
(5087, 2, 28, 34, '2021-07-31', '2021-07-31', 57, 'U ám. nóng.', '2021-07-31 23:00:07', '2021-07-31 23:00:07'),
(5151, 1, 30, 33, '2021-08-01', '2021-08-01', 59, 'Mây thoáng qua. Cảnh báo.', '2021-08-01 17:00:03', '2021-08-01 17:00:03'),
(5159, 2, 28, 34, '2021-08-01', '2021-08-01', 55, 'Mây thoáng qua. nóng.', '2021-08-01 17:00:06', '2021-08-01 17:00:06'),
(5167, 3, 25, 29, '2021-08-01', '2021-08-01', 94, 'Trong sáng. Cảnh báo.', '2021-08-01 17:00:08', '2021-08-01 17:00:08'),
(5247, 1, 28, 33, '2021-08-02', '2021-08-02', 66, 'U ám. nóng.', '2021-08-02 17:00:04', '2021-08-02 17:00:04'),
(5255, 2, 29, 35, '2021-08-02', '2021-08-02', 55, 'U ám. nóng.', '2021-08-02 17:00:06', '2021-08-02 17:00:06'),
(5263, 3, 25, 35, '2021-08-02', '2021-08-02', 89, 'Trong sáng. Cảnh báo.', '2021-08-02 17:00:09', '2021-08-02 17:00:09'),
(5343, 1, 28, 37, '2021-08-03', '2021-08-03', 68, 'Mây thoáng qua. nóng.', '2021-08-03 17:00:03', '2021-08-03 17:00:03'),
(5351, 2, 28, 34, '2021-08-03', '2021-08-03', 56, 'U ám. nóng.', '2021-08-03 17:00:06', '2021-08-03 17:00:06'),
(5359, 3, 26, 36, '2021-08-03', '2021-08-03', 89, 'Trong sáng. Cảnh báo.', '2021-08-03 17:00:09', '2021-08-03 17:00:09'),
(5439, 1, 28, 36, '2021-08-04', '2021-08-04', 60, 'U ám. nóng.', '2021-08-04 17:00:07', '2021-08-04 17:00:07'),
(5447, 2, 29, 34, '2021-08-04', '2021-08-04', 52, 'U ám. nóng.', '2021-08-04 17:00:09', '2021-08-04 17:00:09'),
(5455, 3, 26, 37, '2021-08-04', '2021-08-04', 89, 'Trong sáng. Cảnh báo.', '2021-08-04 17:00:12', '2021-08-04 17:00:12'),
(5543, 2, 29, 33, '2021-08-05', '2021-08-05', 63, 'U ám. nóng.', '2021-08-05 17:00:06', '2021-08-05 17:00:06'),
(5551, 3, 27, 38, '2021-08-05', '2021-08-05', 84, 'Trong sáng. nóng.', '2021-08-05 17:00:08', '2021-08-05 17:00:08'),
(5559, 1, 29, 36, '2021-08-05', '2021-08-05', 61, 'Mây thoáng qua. nóng.', '2021-08-05 23:00:03', '2021-08-05 23:00:03'),
(5631, 1, 29, 38, '2021-08-06', '2021-08-06', 55, 'Mây thoáng qua. Cực nóng.', '2021-08-06 17:00:04', '2021-08-06 17:00:04'),
(5639, 2, 29, 34, '2021-08-06', '2021-08-06', 59, 'U ám. nóng.', '2021-08-06 17:00:07', '2021-08-06 17:00:07'),
(5647, 3, 28, 38, '2021-08-06', '2021-08-06', 67, 'Trong sáng. nóng.', '2021-08-06 17:00:10', '2021-08-06 17:00:10'),
(5727, 1, 30, 38, '2021-08-07', '2021-08-07', 54, 'Mây thoáng qua. Cực nóng.', '2021-08-07 17:00:03', '2021-08-07 17:00:03'),
(5735, 2, 28, 36, '2021-08-07', '2021-08-07', 55, 'U ám. nóng.', '2021-08-07 17:00:06', '2021-08-07 17:00:06'),
(5743, 3, 28, 38, '2021-08-07', '2021-08-07', 79, 'Mây thoáng qua. nóng.', '2021-08-07 17:00:08', '2021-08-07 17:00:08'),
(5823, 1, 30, 39, '2021-08-08', '2021-08-08', 55, 'Mây thoáng qua. Cực nóng.', '2021-08-08 17:00:03', '2021-08-08 17:00:03'),
(5831, 2, 28, 37, '2021-08-08', '2021-08-08', 66, 'U ám. nóng.', '2021-08-08 17:00:05', '2021-08-08 17:00:05'),
(5839, 3, 29, 37, '2021-08-08', '2021-08-08', 94, 'Trong sáng. Cảnh báo.', '2021-08-08 17:00:08', '2021-08-08 17:00:08'),
(5919, 1, 30, 38, '2021-08-09', '2021-08-09', 57, 'U ám. Cực nóng.', '2021-08-09 17:00:03', '2021-08-09 17:00:03'),
(5927, 2, 28, 36, '2021-08-09', '2021-08-09', 96, 'U ám. Cảnh báo.', '2021-08-09 17:00:06', '2021-08-09 17:00:06'),
(5935, 3, 27, 36, '2021-08-09', '2021-08-09', 89, 'Mây thoáng qua. Cảnh báo.', '2021-08-09 17:00:08', '2021-08-09 17:00:08'),
(6015, 1, 28, 37, '2021-08-10', '2021-08-10', 73, 'U ám. nóng.', '2021-08-10 17:00:04', '2021-08-10 17:00:04'),
(6023, 2, 28, 34, '2021-08-10', '2021-08-10', 90, 'U ám. Cảnh báo.', '2021-08-10 17:00:06', '2021-08-10 17:00:06'),
(6031, 3, 26, 32, '2021-08-10', '2021-08-10', 100, 'Mây thoáng qua. Cảnh báo.', '2021-08-10 17:00:09', '2021-08-10 17:00:09'),
(6111, 1, 27, 35, '2021-08-11', '2021-08-11', 74, 'U ám. nóng.', '2021-08-11 17:00:03', '2021-08-11 17:00:03'),
(6119, 2, 27, 34, '2021-08-11', '2021-08-11', 94, 'U ám. Cảnh báo.', '2021-08-11 17:00:05', '2021-08-11 17:00:05'),
(6127, 3, 25, 33, '2021-08-11', '2021-08-11', 100, 'Mưa dông. Mây thoáng qua. Nhẹ.', '2021-08-11 17:00:08', '2021-08-11 17:00:08'),
(6207, 1, 28, 37, '2021-08-12', '2021-08-12', 68, 'Mây thoáng qua. nóng.', '2021-08-12 17:00:04', '2021-08-12 17:00:04'),
(6215, 2, 27, 35, '2021-08-12', '2021-08-12', 92, 'U ám. Cảnh báo.', '2021-08-12 17:00:07', '2021-08-12 17:00:07'),
(6223, 3, 25, 34, '2021-08-12', '2021-08-12', 100, 'Trong sáng. Cảnh báo.', '2021-08-12 17:00:09', '2021-08-12 17:00:09'),
(6303, 1, 29, 37, '2021-08-13', '2021-08-13', 57, 'Mây thoáng qua. nóng.', '2021-08-13 17:00:03', '2021-08-13 17:00:03'),
(6311, 2, 26, 35, '2021-08-13', '2021-08-13', 78, 'Mây thoáng qua. Cảnh báo.', '2021-08-13 17:00:06', '2021-08-13 17:00:06'),
(6319, 3, 26, 34, '2021-08-13', '2021-08-13', 89, 'Trong sáng. Cảnh báo.', '2021-08-13 17:00:09', '2021-08-13 17:00:09'),
(6399, 1, 28, 35, '2021-08-14', '2021-08-14', 59, 'U ám. nóng.', '2021-08-14 17:00:03', '2021-08-14 17:00:03'),
(6407, 2, 27, 34, '2021-08-14', '2021-08-14', 91, 'U ám. Cảnh báo.', '2021-08-14 17:00:06', '2021-08-14 17:00:06'),
(6415, 3, 26, 33, '2021-08-14', '2021-08-14', 100, 'Mây từng phần. Cảnh báo.', '2021-08-14 17:00:08', '2021-08-14 17:00:08'),
(6495, 1, 28, 33, '2021-08-15', '2021-08-15', 76, 'U ám. Cảnh báo.', '2021-08-15 17:00:03', '2021-08-15 17:00:03'),
(6503, 2, 26, 33, '2021-08-15', '2021-08-15', 76, 'U ám. Cảnh báo.', '2021-08-15 17:00:06', '2021-08-15 17:00:06'),
(6511, 3, 26, 30, '2021-08-15', '2021-08-15', 100, 'Trong sáng. Cảnh báo.', '2021-08-15 17:00:08', '2021-08-15 17:00:08'),
(6591, 1, 27, 36, '2021-08-16', '2021-08-16', 69, 'Mây thoáng qua. nóng.', '2021-08-16 17:00:03', '2021-08-16 17:00:03'),
(6599, 2, 24, 32, '2021-08-16', '2021-08-16', 86, 'U ám. Cảnh báo.', '2021-08-16 17:00:06', '2021-08-16 17:00:06'),
(6607, 3, 25, 32, '2021-08-16', '2021-08-16', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-16 17:00:09', '2021-08-16 17:00:09'),
(6687, 1, 27, 37, '2021-08-17', '2021-08-17', 61, 'Mây thoáng qua. nóng.', '2021-08-17 17:00:03', '2021-08-17 17:00:03'),
(6695, 2, 25, 32, '2021-08-17', '2021-08-17', 82, 'Mây thoáng qua. Cảnh báo.', '2021-08-17 17:00:06', '2021-08-17 17:00:06'),
(6703, 3, 25, 34, '2021-08-17', '2021-08-17', 100, 'Mưa dông. Mây mù. Nhẹ.', '2021-08-17 17:00:09', '2021-08-17 17:00:09'),
(6783, 1, 26, 38, '2021-08-18', '2021-08-18', 63, 'Mây thoáng qua. nóng.', '2021-08-18 17:00:03', '2021-08-18 17:00:03'),
(6791, 2, 25, 33, '2021-08-18', '2021-08-18', 85, 'Mây thoáng qua. Cảnh báo.', '2021-08-18 17:00:06', '2021-08-18 17:00:06'),
(6799, 3, 25, 35, '2021-08-18', '2021-08-18', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-18 17:00:09', '2021-08-18 17:00:09'),
(6879, 1, 27, 35, '2021-08-19', '2021-08-19', 67, 'Mây thoáng qua. Cảnh báo.', '2021-08-19 17:00:03', '2021-08-19 17:00:03'),
(6887, 2, 26, 33, '2021-08-19', '2021-08-19', 88, 'U ám. Cảnh báo.', '2021-08-19 17:00:06', '2021-08-19 17:00:06'),
(6895, 3, 25, 34, '2021-08-19', '2021-08-19', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-19 17:00:09', '2021-08-19 17:00:09'),
(6975, 1, 26, 34, '2021-08-20', '2021-08-20', 83, 'Trong sáng. Cảnh báo.', '2021-08-20 17:00:05', '2021-08-20 17:00:05'),
(6983, 2, 25, 32, '2021-08-20', '2021-08-20', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-20 17:00:07', '2021-08-20 17:00:07'),
(6991, 3, 24, 32, '2021-08-20', '2021-08-20', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-20 17:00:10', '2021-08-20 17:00:10'),
(7087, 3, 26, 35, '2021-08-21', '2021-08-21', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-21 17:00:09', '2021-08-21 17:00:09'),
(7095, 1, 27, 37, '2021-08-21', '2021-08-21', 70, 'Mây thoáng qua. nóng.', '2021-08-21 23:00:05', '2021-08-21 23:00:05'),
(7103, 2, 25, 33, '2021-08-21', '2021-08-21', 87, 'Mây thoáng qua. Cảnh báo.', '2021-08-21 23:00:07', '2021-08-21 23:00:07'),
(7167, 1, 27, 37, '2021-08-22', '2021-08-22', 75, 'Mây thoáng qua. Cảnh báo.', '2021-08-22 17:00:16', '2021-08-22 17:00:16'),
(7175, 2, 25, 33, '2021-08-22', '2021-08-22', 85, 'U ám. Cảnh báo.', '2021-08-22 17:00:18', '2021-08-22 17:00:18'),
(7183, 3, 26, 36, '2021-08-22', '2021-08-22', 100, 'Mây thoáng qua. Cảnh báo.', '2021-08-22 17:00:20', '2021-08-22 17:00:20'),
(7263, 1, 28, 39, '2021-08-23', '2021-08-23', 62, 'Mây thoáng qua. nóng.', '2021-08-23 17:00:02', '2021-08-23 17:00:02'),
(7271, 2, 26, 34, '2021-08-23', '2021-08-23', 84, 'U ám. Cảnh báo.', '2021-08-23 17:00:05', '2021-08-23 17:00:05'),
(7279, 3, 26, 36, '2021-08-23', '2021-08-23', 100, 'Mây thoáng qua. Cảnh báo.', '2021-08-23 17:00:07', '2021-08-23 17:00:07'),
(7359, 1, 27, 36, '2021-08-24', '2021-08-24', 72, 'Mây thoáng qua. Cảnh báo.', '2021-08-24 17:00:03', '2021-08-24 17:00:03'),
(7367, 2, 26, 32, '2021-08-24', '2021-08-24', 81, 'U ám. Cảnh báo.', '2021-08-24 17:00:05', '2021-08-24 17:00:05'),
(7375, 3, 26, 34, '2021-08-24', '2021-08-24', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-24 17:00:07', '2021-08-24 17:00:07'),
(7455, 1, 27, 35, '2021-08-25', '2021-08-25', 70, 'Mây thoáng qua. Cảnh báo.', '2021-08-25 17:00:03', '2021-08-25 17:00:03'),
(7463, 2, 25, 31, '2021-08-25', '2021-08-25', 93, 'U ám. Cảnh báo.', '2021-08-25 17:00:05', '2021-08-25 17:00:05'),
(7471, 3, 25, 32, '2021-08-25', '2021-08-25', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-25 17:00:08', '2021-08-25 17:00:08'),
(7551, 1, 26, 33, '2021-08-26', '2021-08-26', 64, 'Nắng từng phần. nóng.', '2021-08-26 17:00:03', '2021-08-26 17:00:03'),
(7559, 2, 26, 31, '2021-08-26', '2021-08-26', 87, 'U ám. Cảnh báo.', '2021-08-26 17:00:06', '2021-08-26 17:00:06'),
(7567, 3, 25, 32, '2021-08-26', '2021-08-26', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-26 17:00:09', '2021-08-26 17:00:09'),
(7647, 1, 26, 32, '2021-08-27', '2021-08-27', 78, 'Mây thoáng qua. Cảnh báo.', '2021-08-27 17:00:03', '2021-08-27 17:00:03'),
(7655, 2, 25, 29, '2021-08-27', '2021-08-27', 96, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-08-27 17:00:05', '2021-08-27 17:00:05'),
(7663, 3, 24, 30, '2021-08-27', '2021-08-27', 100, 'Mây thoáng qua. Cảnh báo.', '2021-08-27 17:00:08', '2021-08-27 17:00:08'),
(7743, 1, 26, 30, '2021-08-28', '2021-08-28', 84, 'Mây thoáng qua. Cảnh báo.', '2021-08-28 17:00:03', '2021-08-28 17:00:03'),
(7751, 2, 26, 30, '2021-08-28', '2021-08-28', 79, 'U ám. Cảnh báo.', '2021-08-28 17:00:05', '2021-08-28 17:00:05'),
(7759, 3, 24, 30, '2021-08-28', '2021-08-28', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-28 17:00:08', '2021-08-28 17:00:08'),
(7839, 1, 25, 31, '2021-08-29', '2021-08-29', 81, 'Mây thoáng qua. Cảnh báo.', '2021-08-29 17:00:02', '2021-08-29 17:00:02'),
(7847, 2, 25, 30, '2021-08-29', '2021-08-29', 84, 'Mây thoáng qua. Cảnh báo.', '2021-08-29 17:00:05', '2021-08-29 17:00:05'),
(7855, 3, 23, 31, '2021-08-29', '2021-08-29', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-29 17:00:07', '2021-08-29 17:00:07'),
(7935, 1, 25, 31, '2021-08-30', '2021-08-30', 77, 'U ám. Cảnh báo.', '2021-08-30 17:00:03', '2021-08-30 17:00:03'),
(7943, 2, 26, 30, '2021-08-30', '2021-08-30', 90, 'U ám. Cảnh báo.', '2021-08-30 17:00:06', '2021-08-30 17:00:06'),
(7951, 3, 24, 32, '2021-08-30', '2021-08-30', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-30 17:00:09', '2021-08-30 17:00:09'),
(8031, 1, 26, 32, '2021-08-31', '2021-08-31', 84, 'Mây thoáng qua. Cảnh báo.', '2021-08-31 17:00:03', '2021-08-31 17:00:03'),
(8039, 2, 26, 31, '2021-08-31', '2021-08-31', 85, 'U ám. Cảnh báo.', '2021-08-31 17:00:05', '2021-08-31 17:00:05'),
(8047, 3, 25, 31, '2021-08-31', '2021-08-31', 94, 'Mây thoáng qua. Cảnh báo.', '2021-08-31 17:00:07', '2021-08-31 17:00:07'),
(8127, 1, 26, 33, '2021-09-01', '2021-09-01', 81, 'Mây thoáng qua. Cảnh báo.', '2021-09-01 17:00:03', '2021-09-01 17:00:03'),
(8135, 2, 25, 31, '2021-09-01', '2021-09-01', 88, 'U ám. Cảnh báo.', '2021-09-01 17:00:05', '2021-09-01 17:00:05'),
(8143, 3, 25, 33, '2021-09-01', '2021-09-01', 84, 'Trong sáng. Cảnh báo.', '2021-09-01 17:00:08', '2021-09-01 17:00:08'),
(8223, 1, 26, 33, '2021-09-02', '2021-09-02', 77, 'Mây thoáng qua. Cảnh báo.', '2021-09-02 17:00:03', '2021-09-02 17:00:03'),
(8231, 2, 26, 32, '2021-09-02', '2021-09-02', 99, 'U ám. Cảnh báo.', '2021-09-02 17:00:05', '2021-09-02 17:00:05'),
(8239, 3, 25, 30, '2021-09-02', '2021-09-02', 94, 'Trong sáng. Cảnh báo.', '2021-09-02 17:00:07', '2021-09-02 17:00:07'),
(8319, 1, 26, 33, '2021-09-03', '2021-09-03', 75, 'Mây thoáng qua. Cảnh báo.', '2021-09-03 17:00:02', '2021-09-03 17:00:02'),
(8327, 2, 26, 32, '2021-09-03', '2021-09-03', 85, 'U ám. Cảnh báo.', '2021-09-03 17:00:05', '2021-09-03 17:00:05'),
(8335, 3, 24, 32, '2021-09-03', '2021-09-03', 94, 'Trong sáng. Cảnh báo.', '2021-09-03 17:00:08', '2021-09-03 17:00:08'),
(8415, 1, 26, 34, '2021-09-04', '2021-09-04', 75, 'Mây thoáng qua. Cảnh báo.', '2021-09-04 17:00:04', '2021-09-04 17:00:04'),
(8423, 2, 25, 31, '2021-09-04', '2021-09-04', 98, 'Mưa dông. U ám. Cảnh báo.', '2021-09-04 17:00:07', '2021-09-04 17:00:07'),
(8431, 3, 25, 31, '2021-09-04', '2021-09-04', 94, 'Mây thoáng qua. Cảnh báo.', '2021-09-04 17:00:10', '2021-09-04 17:00:10'),
(8511, 1, 26, 34, '2021-09-05', '2021-09-05', 83, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-09-05 17:00:03', '2021-09-05 17:00:03'),
(8519, 2, 25, 31, '2021-09-05', '2021-09-05', 68, 'U ám. Cảnh báo.', '2021-09-05 17:00:06', '2021-09-05 17:00:06'),
(8527, 3, 25, 31, '2021-09-05', '2021-09-05', 94, 'Mây thoáng qua. Cảnh báo.', '2021-09-05 17:00:09', '2021-09-05 17:00:09'),
(8607, 1, 26, 31, '2021-09-06', '2021-09-06', 89, 'Mây thoáng qua. Cảnh báo.', '2021-09-06 17:00:03', '2021-09-06 17:00:03'),
(8615, 2, 26, 30, '2021-09-06', '2021-09-06', 84, 'U ám. Cảnh báo.', '2021-09-06 17:00:06', '2021-09-06 17:00:06'),
(8623, 3, 24, 31, '2021-09-06', '2021-09-06', 94, 'Trong sáng. Cảnh báo.', '2021-09-06 17:00:09', '2021-09-06 17:00:09'),
(8703, 1, 26, 31, '2021-09-07', '2021-09-07', 92, 'Mưa dông. U ám. Cảnh báo.', '2021-09-07 17:00:04', '2021-09-07 17:00:04'),
(8711, 2, 26, 28, '2021-09-07', '2021-09-07', 95, 'U ám. Cảnh báo.', '2021-09-07 17:00:08', '2021-09-07 17:00:08'),
(8719, 3, 24, 29, '2021-09-07', '2021-09-07', 94, 'Trong sáng. Cảnh báo.', '2021-09-07 17:00:11', '2021-09-07 17:00:11'),
(8799, 1, 25, 31, '2021-09-08', '2021-09-08', 90, 'Mưa dông. U ám. Cảnh báo.', '2021-09-08 17:00:03', '2021-09-08 17:00:03'),
(8807, 2, 25, 30, '2021-09-08', '2021-09-08', 87, 'U ám. Cảnh báo.', '2021-09-08 17:00:06', '2021-09-08 17:00:06'),
(8815, 3, 24, 28, '2021-09-08', '2021-09-08', 94, 'Mây thoáng qua. Cảnh báo.', '2021-09-08 17:00:09', '2021-09-08 17:00:09'),
(8895, 1, 25, 30, '2021-09-09', '2021-09-09', 93, 'Mây thoáng qua. Cảnh báo.', '2021-09-09 17:00:03', '2021-09-09 17:00:03'),
(8903, 2, 26, 32, '2021-09-09', '2021-09-09', 98, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-09-09 17:00:06', '2021-09-09 17:00:06'),
(8911, 3, 24, 29, '2021-09-09', '2021-09-09', 100, 'Trong sáng. Cảnh báo.', '2021-09-09 17:00:09', '2021-09-09 17:00:09'),
(8999, 1, 25, 32, '2021-09-10', '2021-09-10', 80, 'Mây thoáng qua. Cảnh báo.', '2021-09-10 17:00:04', '2021-09-10 17:00:04'),
(9007, 2, 26, 30, '2021-09-10', '2021-09-10', 71, 'U ám. Cảnh báo.', '2021-09-10 17:00:07', '2021-09-10 17:00:07'),
(9015, 3, 22, 33, '2021-09-10', '2021-09-10', 89, 'Mây thoáng qua. Cảnh báo.', '2021-09-10 17:00:10', '2021-09-10 17:00:10'),
(9023, 4, 25, 30, '2021-09-10', '2021-09-10', 71, 'U ám. Cảnh báo.', '2021-09-10 17:00:14', '2021-09-10 17:00:14'),
(9127, 1, 26, 31, '2021-09-11', '2021-09-11', 89, 'Mây thoáng qua. Cảnh báo.', '2021-09-11 17:00:03', '2021-09-11 17:00:03'),
(9135, 2, 26, 28, '2021-09-11', '2021-09-11', 70, 'Mưa nhẹ. U ám. Cảnh báo.', '2021-09-11 17:00:06', '2021-09-11 17:00:06'),
(9143, 3, 24, 34, '2021-09-11', '2021-09-11', 89, 'Trong sáng. Cảnh báo.', '2021-09-11 17:00:09', '2021-09-11 17:00:09'),
(9151, 4, 26, 28, '2021-09-11', '2021-09-11', 70, 'Mưa nhẹ. U ám. Cảnh báo.', '2021-09-11 17:00:13', '2021-09-11 17:00:13'),
(9255, 1, 26, 33, '2021-09-12', '2021-09-12', 78, 'Mây thoáng qua. Cảnh báo.', '2021-09-12 17:00:03', '2021-09-12 17:00:03'),
(9263, 2, 27, 31, '2021-09-12', '2021-09-12', 66, 'Mây thoáng qua. Cảnh báo.', '2021-09-12 17:00:06', '2021-09-12 17:00:06'),
(9271, 3, 25, 34, '2021-09-12', '2021-09-12', 89, 'Trong sáng. Cảnh báo.', '2021-09-12 17:00:09', '2021-09-12 17:00:09'),
(9279, 4, 27, 31, '2021-09-12', '2021-09-12', 66, 'Mây thoáng qua. Cảnh báo.', '2021-09-12 17:00:12', '2021-09-12 17:00:12'),
(9383, 1, 26, 31, '2021-09-13', '2021-09-13', 94, 'U ám. Cảnh báo.', '2021-09-13 17:00:06', '2021-09-13 17:00:06'),
(9391, 2, 27, 32, '2021-09-13', '2021-09-13', 97, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-09-13 17:00:09', '2021-09-13 17:00:09'),
(9399, 3, 25, 31, '2021-09-13', '2021-09-13', 94, 'Trong sáng. Cảnh báo.', '2021-09-13 17:00:11', '2021-09-13 17:00:11'),
(9407, 4, 27, 32, '2021-09-13', '2021-09-13', 97, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-09-13 17:00:15', '2021-09-13 17:00:15'),
(9511, 1, 27, 31, '2021-09-14', '2021-09-14', 89, 'Mây thoáng qua. Cảnh báo.', '2021-09-14 17:00:03', '2021-09-14 17:00:03'),
(9519, 2, 27, 31, '2021-09-14', '2021-09-14', 87, 'U ám. Cảnh báo.', '2021-09-14 17:00:05', '2021-09-14 17:00:05'),
(9527, 3, 25, 29, '2021-09-14', '2021-09-14', 94, 'Mây thoáng qua. Cảnh báo.', '2021-09-14 17:00:09', '2021-09-14 17:00:09'),
(9535, 4, 27, 31, '2021-09-14', '2021-09-14', 87, 'U ám. Cảnh báo.', '2021-09-14 17:00:12', '2021-09-14 17:00:12'),
(9639, 1, 26, 31, '2021-09-15', '2021-09-15', 90, 'U ám. Cảnh báo.', '2021-09-15 17:00:03', '2021-09-15 17:00:03'),
(9647, 2, 27, 31, '2021-09-15', '2021-09-15', 87, 'Mây thoáng qua. Cảnh báo.', '2021-09-15 17:00:06', '2021-09-15 17:00:06'),
(9655, 3, 25, 30, '2021-09-15', '2021-09-15', 94, 'Mây từng phần. Cảnh báo.', '2021-09-15 17:00:09', '2021-09-15 17:00:09'),
(9663, 4, 26, 31, '2021-09-15', '2021-09-15', 87, 'Mây thoáng qua. Cảnh báo.', '2021-09-15 17:00:12', '2021-09-15 17:00:12'),
(9767, 1, 26, 30, '2021-09-16', '2021-09-16', 86, 'Mưa dông. U ám. Cảnh báo.', '2021-09-16 17:00:03', '2021-09-16 17:00:03'),
(9775, 2, 26, 31, '2021-09-16', '2021-09-16', 87, 'Mây thoáng qua. Cảnh báo.', '2021-09-16 17:00:06', '2021-09-16 17:00:06'),
(9783, 3, 25, 30, '2021-09-16', '2021-09-16', 94, 'Mây thoáng qua. Cảnh báo.', '2021-09-16 17:00:09', '2021-09-16 17:00:09'),
(9791, 4, 26, 31, '2021-09-16', '2021-09-16', 87, 'Mây thoáng qua. Cảnh báo.', '2021-09-16 17:00:12', '2021-09-16 17:00:12'),
(9895, 1, 26, 32, '2021-09-17', '2021-09-17', 88, 'Mây thoáng qua. Cảnh báo.', '2021-09-17 17:00:03', '2021-09-17 17:00:03'),
(9903, 2, 25, 31, '2021-09-17', '2021-09-17', 87, 'Mây thoáng qua. Cảnh báo.', '2021-09-17 17:00:06', '2021-09-17 17:00:06'),
(9911, 3, 25, 32, '2021-09-17', '2021-09-17', 100, 'Mây thoáng qua. Cảnh báo.', '2021-09-17 17:00:10', '2021-09-17 17:00:10'),
(9919, 4, 25, 32, '2021-09-17', '2021-09-17', 87, 'Mây thoáng qua. Cảnh báo.', '2021-09-17 17:00:13', '2021-09-17 17:00:13'),
(10023, 1, 25, 32, '2021-09-18', '2021-09-18', 84, 'Mây thoáng qua. Cảnh báo.', '2021-09-18 17:00:03', '2021-09-18 17:00:03'),
(10031, 2, 25, 29, '2021-09-18', '2021-09-18', 75, 'Mây thoáng qua. Cảnh báo.', '2021-09-18 17:00:06', '2021-09-18 17:00:06'),
(10039, 3, 24, 33, '2021-09-18', '2021-09-18', 94, 'Mây thoáng qua. Cảnh báo.', '2021-09-18 17:00:09', '2021-09-18 17:00:09'),
(10047, 4, 25, 29, '2021-09-18', '2021-09-18', 75, 'Mây thoáng qua. Cảnh báo.', '2021-09-18 17:00:12', '2021-09-18 17:00:12'),
(10151, 1, 26, 32, '2021-09-19', '2021-09-19', 84, 'Trong sáng. Cảnh báo.', '2021-09-19 17:00:03', '2021-09-19 17:00:03'),
(10159, 2, 25, 29, '2021-09-19', '2021-09-19', 86, 'U ám. Cảnh báo.', '2021-09-19 17:00:07', '2021-09-19 17:00:07'),
(10167, 3, 25, 33, '2021-09-19', '2021-09-19', 94, 'Trong sáng. Cảnh báo.', '2021-09-19 17:00:10', '2021-09-19 17:00:10'),
(10175, 4, 25, 29, '2021-09-19', '2021-09-19', 86, 'U ám. Cảnh báo.', '2021-09-19 17:00:13', '2021-09-19 17:00:13'),
(10279, 1, 26, 30, '2021-09-20', '2021-09-20', 91, 'Mưa dông. U ám. Cảnh báo.', '2021-09-20 17:00:03', '2021-09-20 17:00:03'),
(10287, 2, 25, 30, '2021-09-20', '2021-09-20', 96, 'Mưa dông. U ám. Cảnh báo.', '2021-09-20 17:00:06', '2021-09-20 17:00:06'),
(10295, 3, 24, 30, '2021-09-20', '2021-09-20', 94, 'Trong sáng. Cảnh báo.', '2021-09-20 17:00:09', '2021-09-20 17:00:09'),
(10303, 4, 25, 30, '2021-09-20', '2021-09-20', 96, 'Mưa dông. U ám. Cảnh báo.', '2021-09-20 17:00:11', '2021-09-20 17:00:11'),
(10407, 1, 25, 31, '2021-09-21', '2021-09-21', 83, 'Mây thoáng qua. Cảnh báo.', '2021-09-21 17:00:03', '2021-09-21 17:00:03'),
(10415, 2, 25, 30, '2021-09-21', '2021-09-21', 89, 'U ám. Cảnh báo.', '2021-09-21 17:00:07', '2021-09-21 17:00:07'),
(10423, 3, 23, 30, '2021-09-21', '2021-09-21', 89, 'Trong sáng. Cảnh báo.', '2021-09-21 17:00:10', '2021-09-21 17:00:10'),
(10431, 4, 25, 30, '2021-09-21', '2021-09-21', 89, 'U ám. Cảnh báo.', '2021-09-21 17:00:13', '2021-09-21 17:00:13'),
(10535, 1, 25, 30, '2021-09-22', '2021-09-22', 93, 'U ám. Cảnh báo.', '2021-09-22 17:00:03', '2021-09-22 17:00:03'),
(10543, 2, 25, 32, '2021-09-22', '2021-09-22', 82, 'U ám. Cảnh báo.', '2021-09-22 17:00:06', '2021-09-22 17:00:06'),
(10551, 3, 24, 28, '2021-09-22', '2021-09-22', 94, 'Trong sáng. Cảnh báo.', '2021-09-22 17:00:08', '2021-09-22 17:00:08'),
(10559, 4, 25, 32, '2021-09-22', '2021-09-22', 82, 'U ám. Cảnh báo.', '2021-09-22 17:00:11', '2021-09-22 17:00:11'),
(10663, 1, 25, 31, '2021-09-23', '2021-09-23', 77, 'U ám. Cảnh báo.', '2021-09-23 17:00:02', '2021-09-23 17:00:02'),
(10671, 2, 24, 26, '2021-09-23', '2021-09-23', 91, 'Mưa nhẹ. U ám. Cảnh báo.', '2021-09-23 17:00:05', '2021-09-23 17:00:05'),
(10679, 3, 24, 29, '2021-09-23', '2021-09-23', 100, 'Mây thoáng qua. Cảnh báo.', '2021-09-23 17:00:08', '2021-09-23 17:00:08'),
(10687, 4, 24, 26, '2021-09-23', '2021-09-23', 91, 'Mưa nhẹ. U ám. Cảnh báo.', '2021-09-23 17:00:11', '2021-09-23 17:00:11'),
(10791, 1, 26, 29, '2021-09-24', '2021-09-24', 79, 'U ám. Cảnh báo.', '2021-09-24 17:00:04', '2021-09-24 17:00:04'),
(10799, 2, 25, 29, '2021-09-24', '2021-09-24', 95, 'U ám. Cảnh báo.', '2021-09-24 17:00:07', '2021-09-24 17:00:07'),
(10807, 3, 24, 27, '2021-09-24', '2021-09-24', 100, 'Mưa. Mây thoáng qua. Cảnh báo.', '2021-09-24 17:00:09', '2021-09-24 17:00:09'),
(10815, 4, 25, 29, '2021-09-24', '2021-09-24', 95, 'U ám. Cảnh báo.', '2021-09-24 17:00:12', '2021-09-24 17:00:12'),
(10919, 1, 26, 26, '2021-09-25', '2021-09-25', 93, 'Mây thoáng qua. Cảnh báo.', '2021-09-25 17:00:02', '2021-09-25 17:00:02'),
(10927, 2, 25, 28, '2021-09-25', '2021-09-25', 94, 'U ám. Cảnh báo.', '2021-09-25 17:00:05', '2021-09-25 17:00:05'),
(10935, 3, 24, 28, '2021-09-25', '2021-09-25', 100, 'Trong sáng. Cảnh báo.', '2021-09-25 17:00:08', '2021-09-25 17:00:08'),
(10943, 4, 25, 28, '2021-09-25', '2021-09-25', 94, 'U ám. Cảnh báo.', '2021-09-25 17:00:10', '2021-09-25 17:00:10'),
(11047, 1, 25, 30, '2021-09-26', '2021-09-26', 86, 'Mây thoáng qua. Cảnh báo.', '2021-09-26 17:00:03', '2021-09-26 17:00:03'),
(11055, 2, 25, 30, '2021-09-26', '2021-09-26', 84, 'U ám. Cảnh báo.', '2021-09-26 17:00:06', '2021-09-26 17:00:06'),
(11063, 3, 23, 28, '2021-09-26', '2021-09-26', 100, 'Trong sáng. Nhẹ.', '2021-09-26 17:00:09', '2021-09-26 17:00:09'),
(11071, 4, 25, 30, '2021-09-26', '2021-09-26', 84, 'U ám. Cảnh báo.', '2021-09-26 17:00:12', '2021-09-26 17:00:12'),
(11175, 1, 24, 29, '2021-09-27', '2021-09-27', 95, 'Trong sáng. Cảnh báo.', '2021-09-27 17:00:03', '2021-09-27 17:00:03'),
(11183, 2, 25, 31, '2021-09-27', '2021-09-27', 81, 'Mây thoáng qua. Cảnh báo.', '2021-09-27 17:00:06', '2021-09-27 17:00:06'),
(11191, 3, 23, 29, '2021-09-27', '2021-09-27', 94, 'Mây thoáng qua. Cảnh báo.', '2021-09-27 17:00:09', '2021-09-27 17:00:09'),
(11199, 4, 25, 31, '2021-09-27', '2021-09-27', 81, 'Mây thoáng qua. Cảnh báo.', '2021-09-27 17:00:12', '2021-09-27 17:00:12'),
(11303, 1, 24, 32, '2021-09-28', '2021-09-28', 80, 'Mây thoáng qua. Cảnh báo.', '2021-09-28 17:00:04', '2021-09-28 17:00:04'),
(11311, 2, 25, 31, '2021-09-28', '2021-09-28', 86, 'U ám. Cảnh báo.', '2021-09-28 17:00:10', '2021-09-28 17:00:10'),
(11319, 3, 23, 32, '2021-09-28', '2021-09-28', 94, 'Trong sáng. Cảnh báo.', '2021-09-28 17:00:14', '2021-09-28 17:00:14'),
(11327, 4, 25, 32, '2021-09-28', '2021-09-28', 86, 'U ám. Cảnh báo.', '2021-09-28 17:00:16', '2021-09-28 17:00:16'),
(11431, 1, 25, 32, '2021-09-29', '2021-09-29', 87, 'Trong sáng. Cảnh báo.', '2021-09-29 17:00:03', '2021-09-29 17:00:03'),
(11439, 2, 26, 30, '2021-09-29', '2021-09-29', 88, 'Mây thoáng qua. Cảnh báo.', '2021-09-29 17:00:08', '2021-09-29 17:00:08'),
(11447, 3, 24, 33, '2021-09-29', '2021-09-29', 94, 'Mây thoáng qua. Cảnh báo.', '2021-09-29 17:00:13', '2021-09-29 17:00:13'),
(11455, 4, 26, 30, '2021-09-29', '2021-09-29', 88, 'Mây thoáng qua. Cảnh báo.', '2021-09-29 17:00:15', '2021-09-29 17:00:15'),
(11559, 1, 24, 32, '2021-09-30', '2021-09-30', 83, 'Mây thoáng qua. Cảnh báo.', '2021-09-30 17:00:03', '2021-09-30 17:00:03'),
(11567, 2, 25, 31, '2021-09-30', '2021-09-30', 89, 'Mây thoáng qua. Cảnh báo.', '2021-09-30 17:00:06', '2021-09-30 17:00:06'),
(11575, 3, 24, 33, '2021-09-30', '2021-09-30', 94, 'Trong sáng. Cảnh báo.', '2021-09-30 17:00:09', '2021-09-30 17:00:09'),
(11583, 4, 25, 31, '2021-09-30', '2021-09-30', 89, 'Mây thoáng qua. Cảnh báo.', '2021-09-30 17:00:12', '2021-09-30 17:00:12'),
(11687, 1, 25, 30, '2021-10-01', '2021-10-01', 88, 'Mây thoáng qua. Cảnh báo.', '2021-10-01 17:00:04', '2021-10-01 17:00:04'),
(11695, 2, 26, 31, '2021-10-01', '2021-10-01', 89, 'Mây thoáng qua. Cảnh báo.', '2021-10-01 17:00:07', '2021-10-01 17:00:07'),
(11703, 3, 25, 32, '2021-10-01', '2021-10-01', 94, 'Mây thoáng qua. Cảnh báo.', '2021-10-01 17:00:11', '2021-10-01 17:00:11'),
(11711, 4, 26, 31, '2021-10-01', '2021-10-01', 89, 'Mây thoáng qua. Cảnh báo.', '2021-10-01 17:00:14', '2021-10-01 17:00:14'),
(11815, 1, 25, 32, '2021-10-02', '2021-10-02', 84, 'Mưa dông. Mây thoáng qua. Cảnh báo.', '2021-10-02 17:00:04', '2021-10-02 17:00:04'),
(11823, 2, 25, 32, '2021-10-02', '2021-10-02', 84, 'Mây thoáng qua. Cảnh báo.', '2021-10-02 17:00:08', '2021-10-02 17:00:08'),
(11831, 3, 25, 31, '2021-10-02', '2021-10-02', 100, 'Trong sáng. Cảnh báo.', '2021-10-02 17:00:11', '2021-10-02 17:00:11'),
(11839, 4, 25, 32, '2021-10-02', '2021-10-02', 84, 'Mây thoáng qua. Cảnh báo.', '2021-10-02 17:00:15', '2021-10-02 17:00:15'),
(11943, 1, 24, 32, '2021-10-03', '2021-10-03', 86, 'Mây thoáng qua. Cảnh báo.', '2021-10-03 17:00:03', '2021-10-03 17:00:03'),
(11951, 2, 25, 30, '2021-10-03', '2021-10-03', 84, 'Mây thoáng qua. Cảnh báo.', '2021-10-03 17:00:06', '2021-10-03 17:00:06'),
(11959, 3, 24, 32, '2021-10-03', '2021-10-03', 94, 'Mây thoáng qua. Cảnh báo.', '2021-10-03 17:00:09', '2021-10-03 17:00:09'),
(11967, 4, 25, 30, '2021-10-03', '2021-10-03', 84, 'Mây thoáng qua. Cảnh báo.', '2021-10-03 17:00:12', '2021-10-03 17:00:12'),
(12071, 1, 25, 32, '2021-10-04', '2021-10-04', 80, 'Mây thoáng qua. Cảnh báo.', '2021-10-04 17:00:03', '2021-10-04 17:00:03'),
(12079, 2, 25, 31, '2021-10-04', '2021-10-04', 90, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-10-04 17:00:07', '2021-10-04 17:00:07'),
(12087, 3, 23, 31, '2021-10-04', '2021-10-04', 100, 'Trong sáng. Cảnh báo.', '2021-10-04 17:00:09', '2021-10-04 17:00:09'),
(12095, 4, 25, 31, '2021-10-04', '2021-10-04', 90, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-10-04 17:00:12', '2021-10-04 17:00:12'),
(12199, 1, 25, 31, '2021-10-05', '2021-10-05', 94, 'U ám. Nhẹ.', '2021-10-05 17:00:03', '2021-10-05 17:00:03'),
(12207, 2, 25, 31, '2021-10-05', '2021-10-05', 84, 'Mưa rào. U ám. Cảnh báo.', '2021-10-05 17:00:07', '2021-10-05 17:00:07'),
(12215, 3, 24, 31, '2021-10-05', '2021-10-05', 94, 'Trong sáng. Cảnh báo.', '2021-10-05 17:00:10', '2021-10-05 17:00:10'),
(12223, 4, 25, 31, '2021-10-05', '2021-10-05', 84, 'Mưa rào. U ám. Cảnh báo.', '2021-10-05 17:00:14', '2021-10-05 17:00:14'),
(12327, 1, 26, 29, '2021-10-06', '2021-10-06', 91, 'Trong sáng. Cảnh báo.', '2021-10-06 17:00:03', '2021-10-06 17:00:03'),
(12335, 2, 25, 26, '2021-10-06', '2021-10-06', 82, 'U ám. Cảnh báo.', '2021-10-06 17:00:06', '2021-10-06 17:00:06'),
(12343, 3, 24, 32, '2021-10-06', '2021-10-06', 100, 'Trong sáng. Cảnh báo.', '2021-10-06 17:00:09', '2021-10-06 17:00:09'),
(12351, 4, 25, 26, '2021-10-06', '2021-10-06', 82, 'U ám. Cảnh báo.', '2021-10-06 17:00:13', '2021-10-06 17:00:13'),
(12455, 1, 25, 30, '2021-10-07', '2021-10-07', 87, 'Mây thoáng qua. Cảnh báo.', '2021-10-07 17:00:02', '2021-10-07 17:00:02'),
(12463, 2, 25, 29, '2021-10-07', '2021-10-07', 62, 'U ám. Cảnh báo.', '2021-10-07 17:00:05', '2021-10-07 17:00:05'),
(12471, 3, 24, 33, '2021-10-07', '2021-10-07', 94, 'Trong sáng. Cảnh báo.', '2021-10-07 17:00:08', '2021-10-07 17:00:08'),
(12479, 4, 25, 29, '2021-10-07', '2021-10-07', 62, 'U ám. Cảnh báo.', '2021-10-07 17:00:11', '2021-10-07 17:00:11'),
(12583, 1, 26, 33, '2021-10-08', '2021-10-08', 79, 'U ám. Cảnh báo.', '2021-10-08 17:00:04', '2021-10-08 17:00:04'),
(12591, 2, 26, 31, '2021-10-08', '2021-10-08', 60, 'U ám. Cảnh báo.', '2021-10-08 17:00:07', '2021-10-08 17:00:07'),
(12599, 3, 24, 32, '2021-10-08', '2021-10-08', 58, 'Trong sáng. Cảnh báo.', '2021-10-08 17:00:10', '2021-10-08 17:00:10'),
(12607, 4, 26, 31, '2021-10-08', '2021-10-08', 60, 'U ám. Cảnh báo.', '2021-10-08 17:00:13', '2021-10-08 17:00:13'),
(12711, 1, 26, 32, '2021-10-09', '2021-10-09', 76, 'U ám. Cảnh báo.', '2021-10-09 17:00:03', '2021-10-09 17:00:03'),
(12719, 2, 27, 31, '2021-10-09', '2021-10-09', 67, 'U ám. Cảnh báo.', '2021-10-09 17:00:05', '2021-10-09 17:00:05'),
(12727, 3, 25, 31, '2021-10-09', '2021-10-09', 100, 'Mưa nhẹ. U ám. Nhẹ.', '2021-10-09 17:00:08', '2021-10-09 17:00:08'),
(12735, 4, 27, 31, '2021-10-09', '2021-10-09', 67, 'U ám. Cảnh báo.', '2021-10-09 17:00:10', '2021-10-09 17:00:10'),
(12839, 1, 24, 27, '2021-10-10', '2021-10-10', 89, 'U ám. Cảnh báo.', '2021-10-10 17:00:03', '2021-10-10 17:00:03'),
(12847, 2, 26, 34, '2021-10-10', '2021-10-10', 82, 'Mây thoáng qua. Cảnh báo.', '2021-10-10 17:00:05', '2021-10-10 17:00:05'),
(12855, 3, 23, 24, '2021-10-10', '2021-10-10', 100, 'Mưa nhẹ. Mây mù. Nhẹ.', '2021-10-10 17:00:08', '2021-10-10 17:00:08'),
(12863, 4, 26, 34, '2021-10-10', '2021-10-10', 82, 'Mây thoáng qua. Cảnh báo.', '2021-10-10 17:00:10', '2021-10-10 17:00:10'),
(12967, 1, 23, 27, '2021-10-11', '2021-10-11', 95, 'Mưa dông. U ám. Cảnh báo.', '2021-10-11 17:00:02', '2021-10-11 17:00:02'),
(12975, 2, 26, 32, '2021-10-11', '2021-10-11', 88, 'U ám. Cảnh báo.', '2021-10-11 17:00:05', '2021-10-11 17:00:05'),
(12983, 3, 22, 24, '2021-10-11', '2021-10-11', 83, 'Trong sáng. Nhẹ.', '2021-10-11 17:00:07', '2021-10-11 17:00:07'),
(12991, 4, 26, 32, '2021-10-11', '2021-10-11', 88, 'U ám. Cảnh báo.', '2021-10-11 17:00:10', '2021-10-11 17:00:10'),
(13095, 1, 23, 26, '2021-10-12', '2021-10-12', 84, 'Mây thoáng qua. Cảnh báo.', '2021-10-12 17:00:03', '2021-10-12 17:00:03'),
(13103, 2, 25, 31, '2021-10-12', '2021-10-12', 93, 'U ám. Cảnh báo.', '2021-10-12 17:00:06', '2021-10-12 17:00:06'),
(13111, 3, 22, 28, '2021-10-12', '2021-10-12', 61, 'Trong sáng. Nhẹ.', '2021-10-12 17:00:09', '2021-10-12 17:00:09'),
(13119, 4, 25, 31, '2021-10-12', '2021-10-12', 93, 'U ám. Cảnh báo.', '2021-10-12 17:00:11', '2021-10-12 17:00:11'),
(13223, 1, 22, 28, '2021-10-13', '2021-10-13', 94, 'Mưa. U ám. Nhẹ.', '2021-10-13 17:00:02', '2021-10-13 17:00:02');
INSERT INTO `weather` (`id`, `project_id`, `low`, `high`, `start`, `end`, `humidity`, `des`, `updated_at`, `created_at`) VALUES
(13231, 2, 25, 29, '2021-10-13', '2021-10-13', 69, 'U ám. Cảnh báo.', '2021-10-13 17:00:05', '2021-10-13 17:00:05'),
(13239, 3, 21, 25, '2021-10-13', '2021-10-13', 74, 'U ám. Cảnh báo.', '2021-10-13 17:00:07', '2021-10-13 17:00:07'),
(13247, 4, 25, 29, '2021-10-13', '2021-10-13', 69, 'U ám. Cảnh báo.', '2021-10-13 17:00:10', '2021-10-13 17:00:10'),
(13351, 1, 23, 24, '2021-10-14', '2021-10-14', 91, 'U ám. Nhẹ.', '2021-10-14 17:00:03', '2021-10-14 17:00:03'),
(13359, 2, 25, 32, '2021-10-14', '2021-10-14', 90, 'U ám. Cảnh báo.', '2021-10-14 17:00:05', '2021-10-14 17:00:05'),
(13367, 3, 21, 22, '2021-10-14', '2021-10-14', 94, 'Mây thoáng qua. Nhẹ.', '2021-10-14 17:00:08', '2021-10-14 17:00:08'),
(13375, 4, 25, 33, '2021-10-14', '2021-10-14', 90, 'U ám. Cảnh báo.', '2021-10-14 17:00:11', '2021-10-14 17:00:11'),
(13479, 1, 23, 24, '2021-10-15', '2021-10-15', 95, 'Mưa rào nhỏ. U ám. Nhẹ.', '2021-10-15 17:00:02', '2021-10-15 17:00:02'),
(13487, 2, 25, 31, '2021-10-15', '2021-10-15', 89, 'U ám. Cảnh báo.', '2021-10-15 17:00:05', '2021-10-15 17:00:05'),
(13495, 3, 22, 23, '2021-10-15', '2021-10-15', 100, 'Mây mù. Nhẹ.', '2021-10-15 17:00:08', '2021-10-15 17:00:08'),
(13503, 4, 25, 31, '2021-10-15', '2021-10-15', 89, 'U ám. Cảnh báo.', '2021-10-15 17:00:10', '2021-10-15 17:00:10'),
(13607, 1, 21, 23, '2021-10-16', '2021-10-16', 97, 'Mưa. U ám. Nhẹ.', '2021-10-16 17:00:03', '2021-10-16 17:00:03'),
(13615, 2, 25, 30, '2021-10-16', '2021-10-16', 97, 'Mưa nhẹ. U ám. Cảnh báo.', '2021-10-16 17:00:05', '2021-10-16 17:00:05'),
(13623, 3, 20, 22, '2021-10-16', '2021-10-16', 88, 'Mây thoáng qua. Nhẹ.', '2021-10-16 17:00:07', '2021-10-16 17:00:07'),
(13631, 4, 25, 30, '2021-10-16', '2021-10-16', 97, 'Mưa nhẹ. U ám. Cảnh báo.', '2021-10-16 17:00:11', '2021-10-16 17:00:11'),
(13735, 1, 20, 20, '2021-10-17', '2021-10-17', 93, 'Mưa to. U ám. Nhẹ.', '2021-10-17 17:00:03', '2021-10-17 17:00:03'),
(13743, 2, 25, 29, '2021-10-17', '2021-10-17', 97, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-10-17 17:00:05', '2021-10-17 17:00:05'),
(13751, 3, 18, 22, '2021-10-17', '2021-10-17', 83, 'U ám. Nhẹ.', '2021-10-17 17:00:08', '2021-10-17 17:00:08'),
(13759, 4, 25, 29, '2021-10-17', '2021-10-17', 97, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-10-17 17:00:11', '2021-10-17 17:00:11'),
(13863, 1, 20, 22, '2021-10-18', '2021-10-18', 94, 'U ám. Nhẹ.', '2021-10-18 17:00:19', '2021-10-18 17:00:19'),
(13871, 2, 26, 30, '2021-10-18', '2021-10-18', 86, 'U ám. Cảnh báo.', '2021-10-18 17:00:21', '2021-10-18 17:00:21'),
(13879, 3, 19, 20, '2021-10-18', '2021-10-18', 100, 'U ám. Nhẹ.', '2021-10-18 17:00:24', '2021-10-18 17:00:24'),
(13887, 4, 25, 30, '2021-10-18', '2021-10-18', 86, 'U ám. Cảnh báo.', '2021-10-18 17:00:26', '2021-10-18 17:00:26'),
(13991, 1, 20, 24, '2021-10-19', '2021-10-19', 93, 'U ám. Nhẹ.', '2021-10-19 17:00:06', '2021-10-19 17:00:06'),
(13999, 2, 26, 31, '2021-10-19', '2021-10-19', 95, 'U ám. Cảnh báo.', '2021-10-19 17:00:08', '2021-10-19 17:00:08'),
(14007, 3, 19, 24, '2021-10-19', '2021-10-19', 100, 'Sương mù. Nhẹ.', '2021-10-19 17:00:11', '2021-10-19 17:00:11'),
(14015, 4, 26, 31, '2021-10-19', '2021-10-19', 95, 'U ám. Cảnh báo.', '2021-10-19 17:00:13', '2021-10-19 17:00:13'),
(14119, 1, 23, 30, '2021-10-20', '2021-10-20', 92, 'Trong sáng. Cảnh báo.', '2021-10-20 17:00:03', '2021-10-20 17:00:03'),
(14127, 2, 25, 31, '2021-10-20', '2021-10-20', 93, 'U ám. Cảnh báo.', '2021-10-20 17:00:05', '2021-10-20 17:00:05'),
(14135, 3, 21, 32, '2021-10-20', '2021-10-20', 100, 'Sương mù. Cảnh báo.', '2021-10-20 17:00:08', '2021-10-20 17:00:08'),
(14143, 4, 25, 31, '2021-10-20', '2021-10-20', 93, 'U ám. Cảnh báo.', '2021-10-20 17:00:10', '2021-10-20 17:00:10'),
(14247, 1, 22, 30, '2021-10-21', '2021-10-21', 91, 'U ám. Cảnh báo.', '2021-10-21 17:00:02', '2021-10-21 17:00:02'),
(14255, 2, 25, 31, '2021-10-21', '2021-10-21', 87, 'Mây thoáng qua. Cảnh báo.', '2021-10-21 17:00:05', '2021-10-21 17:00:05'),
(14263, 3, 18, 24, '2021-10-21', '2021-10-21', 88, 'Trong sáng. Nhẹ.', '2021-10-21 17:00:07', '2021-10-21 17:00:07'),
(14271, 4, 25, 31, '2021-10-21', '2021-10-21', 87, 'Mây thoáng qua. Cảnh báo.', '2021-10-21 17:00:10', '2021-10-21 17:00:10'),
(14375, 1, 18, 21, '2021-10-22', '2021-10-22', 95, 'Mưa nhẹ. U ám. Nhẹ.', '2021-10-22 17:00:03', '2021-10-22 17:00:03'),
(14383, 2, 25, 30, '2021-10-22', '2021-10-22', 96, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-10-22 17:00:05', '2021-10-22 17:00:05'),
(14391, 3, 17, 19, '2021-10-22', '2021-10-22', 78, 'Trong sáng. Nhẹ.', '2021-10-22 17:00:08', '2021-10-22 17:00:08'),
(14399, 4, 25, 30, '2021-10-22', '2021-10-22', 96, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-10-22 17:00:11', '2021-10-22 17:00:11'),
(14503, 1, 17, 22, '2021-10-23', '2021-10-23', 79, 'Mây thoáng qua. Nhẹ.', '2021-10-23 17:00:07', '2021-10-23 17:00:07'),
(14511, 2, 25, 27, '2021-10-23', '2021-10-23', 98, 'Mưa to. U ám. Nhẹ.', '2021-10-23 17:00:09', '2021-10-23 17:00:09'),
(14519, 3, 16, 22, '2021-10-23', '2021-10-23', 88, 'Mây thoáng qua. Nhẹ.', '2021-10-23 17:00:12', '2021-10-23 17:00:12'),
(14527, 4, 25, 27, '2021-10-23', '2021-10-23', 98, 'Mưa to. U ám. Nhẹ.', '2021-10-23 17:00:14', '2021-10-23 17:00:14'),
(14631, 1, 19, 21, '2021-10-24', '2021-10-24', 83, 'U ám. Nhẹ.', '2021-10-24 17:00:03', '2021-10-24 17:00:03'),
(14639, 2, 25, 27, '2021-10-24', '2021-10-24', 98, 'Mưa. U ám. Cảnh báo.', '2021-10-24 17:00:05', '2021-10-24 17:00:05'),
(14647, 3, 16, 23, '2021-10-24', '2021-10-24', 94, 'Mây thoáng qua. Nhẹ.', '2021-10-24 17:00:08', '2021-10-24 17:00:08'),
(14655, 4, 25, 27, '2021-10-24', '2021-10-24', 98, 'Mưa. U ám. Cảnh báo.', '2021-10-24 17:00:10', '2021-10-24 17:00:10'),
(14727, 1, 18, 25, '2021-10-25', '2021-10-25', 78, 'U ám. Nhẹ.', '2021-10-25 17:00:02', '2021-10-25 17:00:02'),
(14735, 2, 25, 27, '2021-10-25', '2021-10-25', 85, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-10-25 17:00:05', '2021-10-25 17:00:05'),
(14743, 3, 17, 26, '2021-10-25', '2021-10-25', 100, 'Sương mù. Nhẹ.', '2021-10-25 17:00:07', '2021-10-25 17:00:07'),
(14751, 4, 25, 27, '2021-10-25', '2021-10-25', 85, 'Mưa rào nhỏ. U ám. Cảnh báo.', '2021-10-25 17:00:10', '2021-10-25 17:00:10'),
(14855, 1, 19, 26, '2021-10-26', '2021-10-26', 92, 'Trong sáng. Nhẹ.', '2021-10-26 17:00:06', '2021-10-26 17:00:06'),
(14863, 2, 24, 26, '2021-10-26', '2021-10-26', 98, 'Mưa dông. U ám. Nhẹ.', '2021-10-26 17:00:19', '2021-10-26 17:00:19'),
(14871, 3, 17, 26, '2021-10-26', '2021-10-26', 100, 'Sương mù. Nhẹ.', '2021-10-26 17:00:22', '2021-10-26 17:00:22'),
(14879, 4, 24, 26, '2021-10-26', '2021-10-26', 98, 'Mưa dông. U ám. Nhẹ.', '2021-10-26 17:00:25', '2021-10-26 17:00:25'),
(14983, 1, 21, 24, '2021-10-27', '2021-10-27', 97, 'Mưa nhẹ. U ám. Nhẹ.', '2021-10-27 17:00:02', '2021-10-27 17:00:02'),
(14991, 2, 26, 27, '2021-10-27', '2021-10-27', 96, 'Mây thoáng qua. Cảnh báo.', '2021-10-27 17:00:07', '2021-10-27 17:00:07'),
(14999, 3, 19, 28, '2021-10-27', '2021-10-27', 79, 'Mây thoáng qua. Cảnh báo.', '2021-10-27 17:00:10', '2021-10-27 17:00:10'),
(15007, 4, 26, 27, '2021-10-27', '2021-10-27', 96, 'Mây thoáng qua. Cảnh báo.', '2021-10-27 17:00:13', '2021-10-27 17:00:13'),
(15111, 1, 22, 23, '2021-10-28', '2021-10-28', 98, 'Mưa nhẹ. U ám. Nhẹ.', '2021-10-28 17:00:11', '2021-10-28 17:00:11'),
(15119, 2, 25, 29, '2021-10-28', '2021-10-28', 93, 'U ám. Cảnh báo.', '2021-10-28 17:00:13', '2021-10-28 17:00:13'),
(15127, 3, 21, 24, '2021-10-28', '2021-10-28', 100, 'Mưa nhẹ. Sương mù. Nhẹ.', '2021-10-28 17:00:16', '2021-10-28 17:00:16'),
(15135, 4, 25, 29, '2021-10-28', '2021-10-28', 93, 'U ám. Cảnh báo.', '2021-10-28 17:00:19', '2021-10-28 17:00:19'),
(15239, 1, 22, 23, '2021-10-29', '2021-10-29', 92, 'U ám. Nhẹ.', '2021-10-29 17:00:05', '2021-10-29 17:00:05'),
(15247, 2, 25, 29, '2021-10-29', '2021-10-29', 89, 'U ám. Cảnh báo.', '2021-10-29 17:00:07', '2021-10-29 17:00:07'),
(15255, 3, 21, 22, '2021-10-29', '2021-10-29', 100, 'U ám. Nhẹ.', '2021-10-29 17:00:10', '2021-10-29 17:00:10'),
(15263, 4, 25, 29, '2021-10-29', '2021-10-29', 89, 'U ám. Cảnh báo.', '2021-10-29 17:00:13', '2021-10-29 17:00:13'),
(15367, 1, 23, 25, '2021-10-30', '2021-10-30', 96, 'Mưa nhẹ. U ám. Nhẹ.', '2021-10-30 17:00:38', '2021-10-30 17:00:38'),
(15375, 2, 25, 29, '2021-10-30', '2021-10-30', 90, 'U ám. Cảnh báo.', '2021-10-30 17:00:40', '2021-10-30 17:00:40'),
(15383, 3, 20, 21, '2021-10-30', '2021-10-30', 100, 'U ám. Nhẹ.', '2021-10-30 17:00:43', '2021-10-30 17:00:43'),
(15391, 4, 25, 29, '2021-10-30', '2021-10-30', 90, 'U ám. Cảnh báo.', '2021-10-30 17:00:45', '2021-10-30 17:00:45'),
(15495, 1, 21, 24, '2021-10-31', '2021-10-31', 96, 'Mây thoáng qua. Nhẹ.', '2021-10-31 17:00:05', '2021-10-31 17:00:05'),
(15503, 2, 25, 29, '2021-10-31', '2021-10-31', 93, 'U ám. Cảnh báo.', '2021-10-31 17:00:07', '2021-10-31 17:00:07'),
(15511, 3, 20, 22, '2021-10-31', '2021-10-31', 100, 'Mưa nhẹ. Mây thoáng qua. Nhẹ.', '2021-10-31 17:00:10', '2021-10-31 17:00:10'),
(15519, 4, 25, 29, '2021-10-31', '2021-10-31', 93, 'U ám. Cảnh báo.', '2021-10-31 17:00:12', '2021-10-31 17:00:12'),
(15623, 1, 22, 25, '2021-11-01', '2021-11-01', 97, 'U ám. Nhẹ.', '2021-11-01 17:00:05', '2021-11-01 17:00:05'),
(15631, 2, 25, 30, '2021-11-01', '2021-11-01', 86, 'U ám. Cảnh báo.', '2021-11-01 17:00:08', '2021-11-01 17:00:08'),
(15639, 3, 21, 22, '2021-11-01', '2021-11-01', 100, 'U ám. Nhẹ.', '2021-11-01 17:00:10', '2021-11-01 17:00:10'),
(15647, 4, 25, 30, '2021-11-01', '2021-11-01', 86, 'U ám. Cảnh báo.', '2021-11-01 17:00:12', '2021-11-01 17:00:12'),
(15751, 1, 24, 27, '2021-11-02', '2021-11-02', 95, 'U ám. Nhẹ.', '2021-11-02 17:00:05', '2021-11-02 17:00:05'),
(15759, 2, 24, 29, '2021-11-02', '2021-11-02', 83, 'U ám. Cảnh báo.', '2021-11-02 17:00:08', '2021-11-02 17:00:08'),
(15767, 3, 21, 23, '2021-11-02', '2021-11-02', 94, 'U ám. Nhẹ.', '2021-11-02 17:00:10', '2021-11-02 17:00:10'),
(15775, 4, 24, 29, '2021-11-02', '2021-11-02', 83, 'U ám. Cảnh báo.', '2021-11-02 17:00:12', '2021-11-02 17:00:12'),
(15879, 1, 24, 28, '2021-11-03', '2021-11-03', 95, 'Mây thoáng qua. Nhẹ.', '2021-11-03 17:00:07', '2021-11-03 17:00:07'),
(15887, 2, 24, 29, '2021-11-03', '2021-11-03', 90, 'U ám. Cảnh báo.', '2021-11-03 17:00:10', '2021-11-03 17:00:10'),
(15895, 3, 21, 26, '2021-11-03', '2021-11-03', 94, 'Sương mù. Nhẹ.', '2021-11-03 17:00:13', '2021-11-03 17:00:13'),
(15903, 4, 24, 29, '2021-11-03', '2021-11-03', 90, 'U ám. Cảnh báo.', '2021-11-03 17:00:15', '2021-11-03 17:00:15'),
(16007, 1, 23, 28, '2021-11-04', '2021-11-04', 94, 'Trong sáng. Nhẹ.', '2021-11-04 17:00:03', '2021-11-04 17:00:03'),
(16015, 2, 25, 30, '2021-11-04', '2021-11-04', 85, 'U ám. Cảnh báo.', '2021-11-04 17:00:08', '2021-11-04 17:00:08'),
(16023, 3, 22, 30, '2021-11-04', '2021-11-04', 100, 'Trong sáng. Nhẹ.', '2021-11-04 17:00:11', '2021-11-04 17:00:11'),
(16031, 4, 25, 30, '2021-11-04', '2021-11-04', 85, 'U ám. Cảnh báo.', '2021-11-04 17:00:13', '2021-11-04 17:00:13'),
(16135, 1, 23, 30, '2021-11-05', '2021-11-05', 88, 'Trong sáng. Cảnh báo.', '2021-11-05 17:00:04', '2021-11-05 17:00:04'),
(16143, 2, 25, 29, '2021-11-05', '2021-11-05', 84, 'U ám. Cảnh báo.', '2021-11-05 17:00:07', '2021-11-05 17:00:07'),
(16151, 3, 22, 32, '2021-11-05', '2021-11-05', 94, 'Trong sáng. Cảnh báo.', '2021-11-05 17:00:10', '2021-11-05 17:00:10'),
(16159, 4, 25, 29, '2021-11-05', '2021-11-05', 84, 'U ám. Cảnh báo.', '2021-11-05 17:00:12', '2021-11-05 17:00:12'),
(16263, 1, 23, 31, '2021-11-06', '2021-11-06', 88, 'Mây thoáng qua. Cảnh báo.', '2021-11-06 17:00:06', '2021-11-06 17:00:06'),
(16271, 2, 23, 30, '2021-11-06', '2021-11-06', 81, 'U ám. Cảnh báo.', '2021-11-06 17:00:08', '2021-11-06 17:00:08'),
(16279, 3, 23, 30, '2021-11-06', '2021-11-06', 94, 'Mây thoáng qua. Cảnh báo.', '2021-11-06 17:00:11', '2021-11-06 17:00:11'),
(16287, 4, 23, 30, '2021-11-06', '2021-11-06', 81, 'U ám. Cảnh báo.', '2021-11-06 17:00:13', '2021-11-06 17:00:13'),
(16391, 1, 24, 30, '2021-11-07', '2021-11-07', 87, 'Mây thoáng qua. Cảnh báo.', '2021-11-07 17:00:05', '2021-11-07 17:00:05'),
(16399, 2, 25, 30, '2021-11-07', '2021-11-07', 95, 'Mưa to. U ám. Cảnh báo.', '2021-11-07 17:00:08', '2021-11-07 17:00:08'),
(16407, 3, 21, 29, '2021-11-07', '2021-11-07', 100, 'Mưa nhẹ. Mây mù. Nhẹ.', '2021-11-07 17:00:10', '2021-11-07 17:00:10'),
(16415, 4, 25, 30, '2021-11-07', '2021-11-07', 95, 'Mưa to. U ám. Cảnh báo.', '2021-11-07 17:00:12', '2021-11-07 17:00:12'),
(16519, 1, 17, 24, '2021-11-08', '2021-11-08', 81, 'U ám. Nhẹ.', '2021-11-08 17:00:06', '2021-11-08 17:00:06'),
(16527, 2, 25, 29, '2021-11-08', '2021-11-08', 88, 'U ám. Cảnh báo.', '2021-11-08 17:00:10', '2021-11-08 17:00:10'),
(16535, 3, 16, 19, '2021-11-08', '2021-11-08', 60, 'Trong sáng. Nhẹ.', '2021-11-08 17:00:12', '2021-11-08 17:00:12'),
(16543, 4, 25, 29, '2021-11-08', '2021-11-08', 88, 'U ám. Cảnh báo.', '2021-11-08 17:00:15', '2021-11-08 17:00:15'),
(16647, 1, 17, 20, '2021-11-09', '2021-11-09', 72, 'U ám. Nhẹ.', '2021-11-09 17:00:05', '2021-11-09 17:00:05'),
(16655, 2, 25, 27, '2021-11-09', '2021-11-09', 90, 'Mưa rào nhỏ. U ám. Nhẹ.', '2021-11-09 17:00:07', '2021-11-09 17:00:07'),
(16663, 3, 14, 22, '2021-11-09', '2021-11-09', 64, 'Trong sáng. Nhẹ.', '2021-11-09 17:00:11', '2021-11-09 17:00:11'),
(16671, 4, 25, 27, '2021-11-09', '2021-11-09', 90, 'Mưa rào nhỏ. U ám. Nhẹ.', '2021-11-09 17:00:14', '2021-11-09 17:00:14'),
(16736, 4, 25, 27, '2021-11-10', '2021-11-10', 86, 'Mưa dông. U ám. Cảnh báo.', '2021-11-10 05:00:12', '2021-11-10 05:00:12'),
(16737, 4, 25, 26, '2021-11-11', '2021-11-11', 88, 'Mưa to. U ám. Nhẹ.', '2021-11-10 05:00:12', '2021-11-10 05:00:12'),
(16738, 4, 24, 26, '2021-11-12', '2021-11-12', 88, 'Lũ lụt. U ám. Nhẹ.', '2021-11-10 05:00:12', '2021-11-10 05:00:12'),
(16739, 4, 24, 28, '2021-11-13', '2021-11-13', 83, 'Mưa rào. Có mây. Cảnh báo.', '2021-11-10 05:00:12', '2021-11-10 05:00:12'),
(16740, 4, 24, 28, '2021-11-14', '2021-11-14', 84, 'Mưa dông. Tăng mây mù. Cảnh báo.', '2021-11-10 05:00:12', '2021-11-10 05:00:12'),
(16741, 4, 25, 28, '2021-11-15', '2021-11-15', 83, 'Mưa rào. U ám. Cảnh báo.', '2021-11-10 05:00:12', '2021-11-10 05:00:12'),
(16742, 4, 25, 28, '2021-11-16', '2021-11-16', 80, 'Một ít bão. Có mây. Cảnh báo.', '2021-11-10 05:00:12', '2021-11-10 05:00:12'),
(16767, 1, 18, 22, '2021-11-10', '2021-11-10', 70, 'U ám. Nhẹ.', '2021-11-10 17:00:06', '2021-11-10 17:00:06'),
(16775, 2, 25, 27, '2021-11-10', '2021-11-10', 93, 'Mưa rào nhỏ. U ám. Nhẹ.', '2021-11-10 17:00:09', '2021-11-10 17:00:09'),
(16783, 3, 14, 22, '2021-11-10', '2021-11-10', 78, 'Trong sáng. Nhẹ.', '2021-11-10 17:00:11', '2021-11-10 17:00:11'),
(16863, 1, 15, 23, '2021-11-11', '2021-11-11', 78, 'U ám. Nhẹ.', '2021-11-11 17:00:05', '2021-11-11 17:00:05'),
(16871, 2, 24, 25, '2021-11-11', '2021-11-11', 90, 'U ám. Nhẹ.', '2021-11-11 17:00:08', '2021-11-11 17:00:08'),
(16879, 3, 14, 24, '2021-11-11', '2021-11-11', 64, 'Trong sáng. Nhẹ.', '2021-11-11 17:00:10', '2021-11-11 17:00:10'),
(16959, 1, 20, 22, '2021-11-12', '2021-11-12', 90, 'U ám. Nhẹ.', '2021-11-12 17:00:06', '2021-11-12 17:00:06'),
(16967, 2, 23, 27, '2021-11-12', '2021-11-12', 90, 'Mưa rào. U ám. Nhẹ.', '2021-11-12 17:00:08', '2021-11-12 17:00:08'),
(16975, 3, 17, 22, '2021-11-12', '2021-11-12', 60, 'Trong sáng. Nhẹ.', '2021-11-12 17:00:11', '2021-11-12 17:00:11'),
(17055, 1, 20, 20, '2021-11-13', '2021-11-13', 86, 'Mây thoáng qua. Nhẹ.', '2021-11-13 17:00:05', '2021-11-13 17:00:05'),
(17063, 2, 24, 26, '2021-11-13', '2021-11-13', 93, 'Mưa nhẹ. U ám. Nhẹ.', '2021-11-13 17:00:08', '2021-11-13 17:00:08'),
(17071, 3, 15, 23, '2021-11-13', '2021-11-13', 83, 'Trong sáng. Nhẹ.', '2021-11-13 17:00:10', '2021-11-13 17:00:10'),
(17151, 1, 18, 21, '2021-11-14', '2021-11-14', 87, 'Mây thoáng qua. Nhẹ.', '2021-11-14 17:00:05', '2021-11-14 17:00:05'),
(17159, 2, 24, 25, '2021-11-14', '2021-11-14', 94, 'U ám. Nhẹ.', '2021-11-14 17:00:08', '2021-11-14 17:00:08'),
(17167, 3, 15, 24, '2021-11-14', '2021-11-14', 94, 'Trong sáng. Nhẹ.', '2021-11-14 17:00:10', '2021-11-14 17:00:10'),
(17247, 1, 19, 22, '2021-11-15', '2021-11-15', 92, 'Mưa nhẹ. U ám. Nhẹ.', '2021-11-15 17:00:06', '2021-11-15 17:00:06'),
(17255, 2, 24, 25, '2021-11-15', '2021-11-15', 93, 'U ám. Cảnh báo.', '2021-11-15 17:00:09', '2021-11-15 17:00:09'),
(17263, 3, 17, 25, '2021-11-15', '2021-11-15', 94, 'Sương mù. Nhẹ.', '2021-11-15 17:00:11', '2021-11-15 17:00:11'),
(17343, 1, 21, 24, '2021-11-16', '2021-11-16', 92, 'U ám. Nhẹ.', '2021-11-16 17:00:04', '2021-11-16 17:00:04'),
(17351, 2, 25, 27, '2021-11-16', '2021-11-16', 91, 'U ám. Cảnh báo.', '2021-11-16 17:00:09', '2021-11-16 17:00:09'),
(17359, 3, 20, 22, '2021-11-16', '2021-11-16', 88, 'Sương mù. Nhẹ.', '2021-11-16 17:00:13', '2021-11-16 17:00:13'),
(17439, 1, 22, 23, '2021-11-17', '2021-11-17', 93, 'U ám. Nhẹ.', '2021-11-17 17:00:09', '2021-11-17 17:00:09'),
(17447, 2, 25, 29, '2021-11-17', '2021-11-17', 89, 'Mây thoáng qua. Cảnh báo.', '2021-11-17 17:00:12', '2021-11-17 17:00:12'),
(17455, 3, 19, 23, '2021-11-17', '2021-11-17', 60, 'Mây thoáng qua. Nhẹ.', '2021-11-17 17:00:15', '2021-11-17 17:00:15'),
(17535, 1, 19, 22, '2021-11-18', '2021-11-18', 91, 'U ám. Nhẹ.', '2021-11-18 17:00:03', '2021-11-18 17:00:03'),
(17543, 2, 25, 27, '2021-11-18', '2021-11-18', 95, 'U ám. Cảnh báo.', '2021-11-18 17:00:07', '2021-11-18 17:00:07'),
(17551, 3, 18, 24, '2021-11-18', '2021-11-18', 88, 'Sương mù. Nhẹ.', '2021-11-18 17:00:10', '2021-11-18 17:00:10'),
(17631, 1, 19, 26, '2021-11-19', '2021-11-19', 90, 'U ám. Nhẹ.', '2021-11-19 17:00:06', '2021-11-19 17:00:06'),
(17639, 2, 24, 29, '2021-11-19', '2021-11-19', 84, 'Mây thoáng qua. Cảnh báo.', '2021-11-19 17:00:08', '2021-11-19 17:00:08'),
(17647, 3, 17, 24, '2021-11-19', '2021-11-19', 94, 'Mưa phùn. Sương mù. Nhẹ.', '2021-11-19 17:00:11', '2021-11-19 17:00:11'),
(17727, 1, 21, 29, '2021-11-20', '2021-11-20', 88, 'Mây thoáng qua. Cảnh báo.', '2021-11-20 17:00:03', '2021-11-20 17:00:03'),
(17735, 2, 24, 29, '2021-11-20', '2021-11-20', 84, 'U ám. Cảnh báo.', '2021-11-20 17:00:08', '2021-11-20 17:00:08'),
(17743, 3, 21, 29, '2021-11-20', '2021-11-20', 83, 'Mây thoáng qua. Nhẹ.', '2021-11-20 17:00:10', '2021-11-20 17:00:10'),
(17823, 1, 22, 30, '2021-11-21', '2021-11-21', 88, 'Trong sáng. Cảnh báo.', '2021-11-21 17:00:05', '2021-11-21 17:00:05'),
(17831, 2, 24, 28, '2021-11-21', '2021-11-21', 95, 'Mưa. U ám. Cảnh báo.', '2021-11-21 17:00:08', '2021-11-21 17:00:08'),
(17839, 3, 22, 27, '2021-11-21', '2021-11-21', 89, 'Mây thoáng qua. Nhẹ.', '2021-11-21 17:00:10', '2021-11-21 17:00:10'),
(17919, 1, 17, 25, '2021-11-22', '2021-11-22', 97, 'Mưa nhẹ. U ám. Nhẹ.', '2021-11-22 17:00:05', '2021-11-22 17:00:05'),
(17927, 2, 25, 28, '2021-11-22', '2021-11-22', 90, 'U ám. Cảnh báo.', '2021-11-22 17:00:08', '2021-11-22 17:00:08'),
(17935, 3, 16, 20, '2021-11-22', '2021-11-22', 52, 'Trong sáng. Nhẹ.', '2021-11-22 17:00:10', '2021-11-22 17:00:10'),
(18015, 1, 16, 18, '2021-11-23', '2021-11-23', 89, 'U ám. Mát.', '2021-11-23 17:00:05', '2021-11-23 17:00:05'),
(18023, 2, 25, 26, '2021-11-23', '2021-11-23', 89, 'U ám. Cảnh báo.', '2021-11-23 17:00:08', '2021-11-23 17:00:08'),
(18031, 3, 12, 18, '2021-11-23', '2021-11-23', 68, 'Trong sáng. Nhẹ.', '2021-11-23 17:00:10', '2021-11-23 17:00:10'),
(18111, 1, 16, 18, '2021-11-24', '2021-11-24', 84, 'U ám. Nhẹ.', '2021-11-24 17:00:05', '2021-11-24 17:00:05'),
(18119, 2, 25, 27, '2021-11-24', '2021-11-24', 94, 'U ám. Nhẹ.', '2021-11-24 17:00:08', '2021-11-24 17:00:08'),
(18127, 3, 14, 20, '2021-11-24', '2021-11-24', 77, 'Trong sáng. Nhẹ.', '2021-11-24 17:00:10', '2021-11-24 17:00:10'),
(18207, 1, 17, 20, '2021-11-25', '2021-11-25', 78, 'U ám. Nhẹ.', '2021-11-25 17:00:05', '2021-11-25 17:00:05'),
(18215, 2, 24, 27, '2021-11-25', '2021-11-25', 84, 'U ám. Nhẹ.', '2021-11-25 17:00:45', '2021-11-25 17:00:45'),
(18223, 3, 13, 23, '2021-11-25', '2021-11-25', 77, 'Trong sáng. Nhẹ.', '2021-11-25 17:00:47', '2021-11-25 17:00:47'),
(18303, 1, 16, 22, '2021-11-26', '2021-11-26', 80, 'U ám. Nhẹ.', '2021-11-26 17:00:05', '2021-11-26 17:00:05'),
(18311, 2, 23, 25, '2021-11-26', '2021-11-26', 71, 'U ám. Cảnh báo.', '2021-11-26 17:00:08', '2021-11-26 17:00:08'),
(18319, 3, 14, 24, '2021-11-26', '2021-11-26', 88, 'Trong sáng. Nhẹ.', '2021-11-26 17:00:10', '2021-11-26 17:00:10'),
(18328, 1, 18, 24, '2021-11-27', '2021-11-27', 71, 'Mưa nhẹ. Có mây. Nhẹ.', '2021-11-26 23:00:05', '2021-11-26 23:00:05'),
(18329, 1, 18, 22, '2021-11-28', '2021-11-28', 72, 'Mưa rào nhỏ. U ám. Nhẹ.', '2021-11-26 23:00:05', '2021-11-26 23:00:05'),
(18330, 1, 19, 23, '2021-11-29', '2021-11-29', 70, 'Mưa rào nhỏ. U ám. Nhẹ.', '2021-11-26 23:00:05', '2021-11-26 23:00:05'),
(18331, 1, 19, 23, '2021-11-30', '2021-11-30', 69, 'Mưa rào nhỏ. Có mây. Nhẹ.', '2021-11-26 23:00:05', '2021-11-26 23:00:05'),
(18332, 1, 16, 21, '2021-12-01', '2021-12-01', 61, 'Mưa nhẹ. Nắng trễ. Mát.', '2021-11-26 23:00:05', '2021-11-26 23:00:05'),
(18333, 1, 15, 23, '2021-12-02', '2021-12-02', 63, 'Mây thất thường. Nhẹ.', '2021-11-26 23:00:05', '2021-11-26 23:00:05'),
(18334, 1, 14, 23, '2021-12-03', '2021-12-03', 65, 'Mây chiều. Nhẹ.', '2021-11-26 23:00:05', '2021-11-26 23:00:05'),
(18336, 2, 23, 25, '2021-11-27', '2021-11-27', 89, 'Lũ lụt. U ám. Nhẹ.', '2021-11-26 23:00:08', '2021-11-26 23:00:08'),
(18337, 2, 25, 26, '2021-11-28', '2021-11-28', 90, 'Lũ lụt. U ám. Nhẹ.', '2021-11-26 23:00:08', '2021-11-26 23:00:08'),
(18338, 2, 25, 27, '2021-11-29', '2021-11-29', 86, 'Lũ lụt. U ám. Cảnh báo.', '2021-11-26 23:00:08', '2021-11-26 23:00:08'),
(18339, 2, 25, 27, '2021-11-30', '2021-11-30', 86, 'Mưa dông. U ám. Cảnh báo.', '2021-11-26 23:00:08', '2021-11-26 23:00:08'),
(18340, 2, 23, 25, '2021-12-01', '2021-12-01', 82, 'Mưa. U ám. Nhẹ.', '2021-11-26 23:00:08', '2021-11-26 23:00:08'),
(18341, 2, 23, 25, '2021-12-02', '2021-12-02', 78, 'Mưa. U ám. Nhẹ.', '2021-11-26 23:00:08', '2021-11-26 23:00:08'),
(18342, 2, 22, 25, '2021-12-03', '2021-12-03', 73, 'Mưa rào nhẹ. U ám. Nhẹ.', '2021-11-26 23:00:08', '2021-11-26 23:00:08'),
(18344, 3, 15, 25, '2021-11-27', '2021-11-27', 56, 'Nắng. Nhẹ.', '2021-11-26 23:00:10', '2021-11-26 23:00:10'),
(18345, 3, 14, 25, '2021-11-28', '2021-11-28', 59, 'Có mây. Nhẹ.', '2021-11-26 23:00:10', '2021-11-26 23:00:10'),
(18346, 3, 15, 25, '2021-11-29', '2021-11-29', 62, 'Giảm mây. Nhẹ.', '2021-11-26 23:00:10', '2021-11-26 23:00:10'),
(18347, 3, 16, 22, '2021-11-30', '2021-11-30', 68, 'U ám. Mát.', '2021-11-26 23:00:10', '2021-11-26 23:00:10'),
(18348, 3, 13, 22, '2021-12-01', '2021-12-01', 52, 'Có mây. Mát.', '2021-11-26 23:00:10', '2021-11-26 23:00:10'),
(18349, 3, 11, 23, '2021-12-02', '2021-12-02', 46, 'Mây phân tán. Nhẹ.', '2021-11-26 23:00:10', '2021-11-26 23:00:10'),
(18350, 3, 12, 23, '2021-12-03', '2021-12-03', 49, 'Mây thất thường. Nhẹ.', '2021-11-26 23:00:10', '2021-11-26 23:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `id` int(11) NOT NULL,
  `area_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `bid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `dictrict_area` int(11) DEFAULT NULL,
  `consumer_id` int(11) DEFAULT NULL,
  `accountant_id` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `acreage` float DEFAULT NULL,
  `zone` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `trans_type` int(11) NOT NULL DEFAULT '0',
  `final_price` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `unit_price` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `real_price` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_discount` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `con_discount` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `done` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dept` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_type` int(1) DEFAULT NULL,
  `image_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT '1',
  `pay_step` int(2) DEFAULT NULL,
  `position` int(2) DEFAULT '1',
  `view` text COLLATE utf8_unicode_ci,
  `contribute_state` int(2) NOT NULL DEFAULT '0',
  `deposit` int(1) DEFAULT NULL,
  `tax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inner_tax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gap` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deposit_date` datetime DEFAULT NULL,
  `complete_date` datetime DEFAULT NULL,
  `lock` int(11) NOT NULL DEFAULT '0',
  `lock_user` int(11) NOT NULL DEFAULT '0',
  `lock_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`id`, `area_id`, `project_id`, `bid`, `staff_id`, `dictrict_area`, `consumer_id`, `accountant_id`, `name`, `acreage`, `zone`, `state`, `trans_type`, `final_price`, `unit_price`, `real_price`, `price_discount`, `con_discount`, `vat`, `done`, `dept`, `image_type`, `image_name`, `pay_step`, `position`, `view`, `contribute_state`, `deposit`, `tax`, `inner_tax`, `gap`, `deposit_date`, `complete_date`, `lock`, `lock_user`, `lock_time`, `created_at`, `updated_at`) VALUES
(1002, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-1', 338.48, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1003, 19, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-2', 308.18, '\"652.9266281945589,129.39818631492167,635.7131079967024,159.07666941467437,678.4501236603462,182.22588623248146,698.037922506183,151.36026380873867\"', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1004, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-3', 310.71, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1005, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-4', 313.35, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1006, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-5', 315.99, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1007, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-6', 318.63, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1008, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-7', 321.27, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1009, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-8', 323.91, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1010, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-9', 326.55, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1011, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-10', 329.19, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1012, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-11', 331.83, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1013, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-12', 334.47, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1014, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-13', 337.11, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1015, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-14', 339.75, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1016, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-15', 342.39, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1017, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-16', 343.1, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1018, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-17', 339.19, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1019, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-18', 335.08, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1020, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-19', 330.97, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1021, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-20', 329.7, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1022, NULL, 4, 'BT01', NULL, NULL, NULL, NULL, 'BT01-21', 326.92, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1023, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-1', 372.53, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1024, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-2', 376.72, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1025, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-3', 376.71, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1026, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-4', 376.71, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1027, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-5', 376.71, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1028, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-6', 376.71, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1029, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-7', 376.71, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1030, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-8', 376.71, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1031, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-9', 376.71, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1032, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-10', 354.48, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1033, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-11', 358.78, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1034, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-12', 358.73, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1035, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-13', 358.77, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1036, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-14', 358.77, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1037, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-15', 358.77, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1038, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-16', 358.77, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1039, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-17', 358.77, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1040, NULL, 4, 'BT02', NULL, NULL, NULL, NULL, 'BT02-18', 358.77, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1041, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-1', 398.91, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1042, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-2', 398.91, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1043, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-3', 398.91, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1044, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-4', 398.91, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1045, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-5', 398.91, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1046, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-6', 394.63, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1047, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-7', 379.04, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1048, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-8', 379.04, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1049, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-9', 379.04, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1050, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-10', 379.04, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1051, NULL, 4, 'BT03', NULL, NULL, NULL, NULL, 'BT03-11', 475.79, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1052, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-1', 345.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1053, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-2', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1054, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-3', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1055, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-4', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1056, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-5', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1057, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-6', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1058, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-7', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1059, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-8', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1060, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-9', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1061, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-10', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1062, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-11', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1063, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-12', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1064, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-13', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1065, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-14', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1066, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-15', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1067, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-16', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1068, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-17', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1069, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-18', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1070, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-19', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1071, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-20', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1072, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-21', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-18 17:00:01', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1073, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-22', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1074, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-23', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1075, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-24', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1076, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-25', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1077, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-26', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1078, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-27', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1079, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-28', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1080, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-29', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1081, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-30', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1082, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-31', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1083, NULL, 4, 'BT04', NULL, NULL, NULL, NULL, 'BT04-32', 300, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1084, NULL, 4, 'BT05', NULL, NULL, NULL, NULL, 'BT05-1', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1085, NULL, 4, 'BT05', NULL, NULL, NULL, NULL, 'BT05-2', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1086, NULL, 4, 'BT05', NULL, NULL, NULL, NULL, 'BT05-3', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1087, NULL, 4, 'BT05', NULL, NULL, NULL, NULL, 'BT05-4', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1088, NULL, 4, 'BT05', NULL, NULL, NULL, NULL, 'BT05-5', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1089, NULL, 4, 'BT05', NULL, NULL, NULL, NULL, 'BT05-6', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1090, NULL, 4, 'BT05', NULL, NULL, NULL, NULL, 'BT05-7', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1091, NULL, 4, 'BT05', NULL, NULL, NULL, NULL, 'BT05-8', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1092, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-1', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1093, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-2', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1094, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-3', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1095, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-4', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1096, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-5', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1097, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-6', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1098, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-7', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1099, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-8', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1100, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-9', 400, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1101, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-10', 429.33, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1102, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-11', 588.01, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1103, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-12', 1021.54, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1104, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-13', 1645.71, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1105, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-14', 1191.35, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1106, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-15', 951.83, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1107, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-16', 800, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1108, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-17', 800, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1109, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-18', 800, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1110, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-19', 800, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1111, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-20', 800, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1112, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-21', 800, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1113, NULL, 4, 'BT06', NULL, NULL, NULL, NULL, 'BT06-22', 800, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1114, NULL, 4, 'BT07', NULL, NULL, NULL, NULL, 'BT07-1', 1241.53, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1115, NULL, 4, 'BT07', NULL, NULL, NULL, NULL, 'BT07-2', 1250, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1116, NULL, 4, 'BT07', NULL, NULL, NULL, NULL, 'BT07-3', 1250, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1117, NULL, 4, 'BT07', NULL, NULL, NULL, NULL, 'BT07-4', 1274.89, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1118, NULL, 4, 'BT07', NULL, NULL, NULL, NULL, 'BT07-5', 1099.56, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1119, NULL, 4, 'BT07', NULL, NULL, NULL, NULL, 'BT07-6', 1274.89, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1120, NULL, 4, 'BT07', NULL, NULL, NULL, NULL, 'BT07-7', 1405.69, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1121, NULL, 4, 'BT08', NULL, NULL, NULL, NULL, 'BT08-1', 2704.06, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1122, NULL, 4, 'BT08', NULL, NULL, NULL, NULL, 'BT08-2', 2685.15, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1123, NULL, 4, 'BT08', NULL, NULL, NULL, NULL, 'BT08-3', 2087.08, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1124, NULL, 4, 'BT08', NULL, NULL, NULL, NULL, 'BT08-4', 1787.51, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1125, NULL, 4, 'BT08', NULL, NULL, NULL, NULL, 'BT08-5', 2230.52, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1126, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-1', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1127, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1128, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1129, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1130, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1131, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1132, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-7', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1133, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1134, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-9', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1135, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1136, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1137, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-12', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1138, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1139, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1140, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-15', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1141, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1142, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-17', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1143, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-18', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1144, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-19', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1145, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-20', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1146, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-21', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1147, NULL, 4, 'LK01', NULL, NULL, NULL, NULL, 'LK01-22', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1148, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-1', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1149, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1150, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1151, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1152, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1153, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1154, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-7', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1155, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1156, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-9', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1157, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1158, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1159, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-12', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1160, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1161, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1162, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-15', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1163, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1164, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-17', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1165, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-18', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1166, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-19', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1167, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-20', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1168, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-21', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1169, NULL, 4, 'LK02', NULL, NULL, NULL, NULL, 'LK02-22', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1170, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-1', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1171, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1172, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1173, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1174, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1175, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1176, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-7', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1177, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1178, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-9', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1179, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1180, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1181, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-12', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1182, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-13', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1183, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1184, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-15', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1185, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1186, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-17', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1187, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-18', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1188, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-19', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1189, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-20', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1190, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-21', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1191, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-22', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41');
INSERT INTO `zone` (`id`, `area_id`, `project_id`, `bid`, `staff_id`, `dictrict_area`, `consumer_id`, `accountant_id`, `name`, `acreage`, `zone`, `state`, `trans_type`, `final_price`, `unit_price`, `real_price`, `price_discount`, `con_discount`, `vat`, `done`, `dept`, `image_type`, `image_name`, `pay_step`, `position`, `view`, `contribute_state`, `deposit`, `tax`, `inner_tax`, `gap`, `deposit_date`, `complete_date`, `lock`, `lock_user`, `lock_time`, `created_at`, `updated_at`) VALUES
(1192, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-23', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1193, NULL, 4, 'LK03', NULL, NULL, NULL, NULL, 'LK03-24', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1194, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-1', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1195, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1196, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1197, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-12', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1198, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1199, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1200, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-15', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1201, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1202, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-17', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1203, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-18', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1204, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-19', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1205, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1206, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-20', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1207, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-21', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1208, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-22', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1209, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1210, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1211, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1212, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1213, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-7', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1214, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1215, NULL, 4, 'LK04', NULL, NULL, NULL, NULL, 'LK04-9', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1216, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-1', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1217, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-10', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1218, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1219, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-12', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1220, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1221, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1222, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-15', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1223, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1224, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-17', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1225, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-18', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1226, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1227, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1228, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1229, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1230, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1231, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-7', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1232, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1233, NULL, 4, 'LK05', NULL, NULL, NULL, NULL, 'LK05-9', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1234, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-1', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1235, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1236, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1237, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1238, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1239, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1240, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-7', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1241, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1242, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-9', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1243, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1244, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1245, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-12', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1246, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1247, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1248, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-15', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1249, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1250, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-17', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1251, NULL, 4, 'LK06', NULL, NULL, NULL, NULL, 'LK06-18', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1252, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-1', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1253, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1254, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1255, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1256, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1257, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1258, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-7', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1259, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1260, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-9', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1261, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1262, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1263, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-12', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1264, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1265, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1266, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-15', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1267, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1268, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-17', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1269, NULL, 4, 'LK07', NULL, NULL, NULL, NULL, 'LK07-18', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1270, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-1', 215.18, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1271, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-2', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1272, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-3', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1273, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-4', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1274, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-5', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1275, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-6', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1276, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-7', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1277, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-8', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1278, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-9', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1279, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-10', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1280, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-11', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1281, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-12', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1282, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-13', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1283, NULL, 4, 'LK08', NULL, NULL, NULL, NULL, 'LK08-14', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1284, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-1', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1285, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-2', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1286, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-3', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1287, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-4', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1288, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-5', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1289, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-6', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1290, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-7', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1291, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-8', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1292, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-9', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1293, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-10', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1294, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-11', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1295, NULL, 4, 'LK09', NULL, NULL, NULL, NULL, 'LK09-12', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1296, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-1', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1297, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-2', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1298, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-3', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1299, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-4', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1300, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-5', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1301, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-6', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1302, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-7', 195.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1303, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-8', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1304, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-9', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1305, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-10', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1306, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-11', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1307, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-12', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1308, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-13', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1309, NULL, 4, 'LK10', NULL, NULL, NULL, NULL, 'LK10-14', 195.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1310, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-1', 170, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1311, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-2', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1312, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-3', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1313, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-4', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1314, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-5', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1315, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-6', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1316, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-7', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1317, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-8', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1318, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-9', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1319, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-10', 148.83, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1320, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-11', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1321, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-12', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1322, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-13', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1323, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-14', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1324, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-15', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1325, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-16', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1326, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-17', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1327, NULL, 4, 'LK11', NULL, NULL, NULL, NULL, 'LK11-18', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1328, 0, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-1', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1329, 0, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-2', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1330, 0, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-3', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1331, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-4', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1332, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-5', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1333, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-6', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1334, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-6', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1335, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-7', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1336, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-7', 195.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1337, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-8', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1338, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-9', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1339, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-10', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1340, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-11', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1341, NULL, 4, 'LK12', NULL, NULL, NULL, NULL, 'LK12-12', 195.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1342, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-1', 195.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1343, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-2', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1344, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-3', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1345, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-4', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1346, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-5', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1347, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-6', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1348, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-7', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1349, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-8', 195.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1350, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-9', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1351, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-10', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1352, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-11', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1353, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-12', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1354, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-13', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1355, NULL, 4, 'LK13', NULL, NULL, NULL, NULL, 'LK13-14', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1356, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-1', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1357, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-2', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1358, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-3', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-22 08:00:02', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1359, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-4', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1360, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-5', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1361, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-6', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1362, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-7', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1363, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-8', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1364, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-9', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1365, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-10', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1366, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-11', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1367, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-12', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1368, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-13', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1369, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-14', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1370, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-15', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1371, NULL, 4, 'LK14', NULL, NULL, NULL, NULL, 'LK14-16', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1372, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-1', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1373, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-2', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1374, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-3', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1375, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-4', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1376, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-5', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1377, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-6', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1378, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-7', 181.68, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1379, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-8', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1380, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-9', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1381, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-10', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1382, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-11', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41');
INSERT INTO `zone` (`id`, `area_id`, `project_id`, `bid`, `staff_id`, `dictrict_area`, `consumer_id`, `accountant_id`, `name`, `acreage`, `zone`, `state`, `trans_type`, `final_price`, `unit_price`, `real_price`, `price_discount`, `con_discount`, `vat`, `done`, `dept`, `image_type`, `image_name`, `pay_step`, `position`, `view`, `contribute_state`, `deposit`, `tax`, `inner_tax`, `gap`, `deposit_date`, `complete_date`, `lock`, `lock_user`, `lock_time`, `created_at`, `updated_at`) VALUES
(1383, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-12', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1384, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-13', 160, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1385, NULL, 4, 'LK15', NULL, NULL, NULL, NULL, 'LK15-14', 200, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1386, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-1', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1387, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1388, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1389, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1390, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1391, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1392, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-7', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1393, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1394, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-9', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1395, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1396, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1397, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-12', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1398, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1399, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1400, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-15', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1401, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1402, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-17', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1403, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-18', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1404, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-19', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1405, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-20', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1406, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-21', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1407, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-22', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1408, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-23', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1409, NULL, 4, 'SH01', NULL, NULL, NULL, NULL, 'SH01-24', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1410, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-1', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1411, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1412, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1413, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1414, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1415, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1416, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-7', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1417, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1418, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-9', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1419, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1420, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1421, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-12', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1422, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1423, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1424, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-15', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1425, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1426, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-17', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1427, NULL, 4, 'SH02', NULL, NULL, NULL, NULL, 'SH02-18', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1428, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-1', 150, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1429, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1430, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1431, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1432, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1433, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1434, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-7', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1435, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1436, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-9', 148.42, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1437, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1438, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1439, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-12', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1440, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1441, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1442, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-15', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1443, NULL, 4, 'SH03', NULL, NULL, NULL, NULL, 'SH03-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1444, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-1', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1445, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1446, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1447, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1448, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1449, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1450, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-7', 123.98, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1451, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1452, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-9', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1453, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1454, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1455, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-12', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1456, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1457, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-14', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1458, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-15', 121.8, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1459, NULL, 4, 'SH04', NULL, NULL, NULL, NULL, 'SH04-16', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1460, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-1', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1461, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-2', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1462, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-3', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1463, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-4', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1464, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-5', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1465, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-6', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1466, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-7', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1467, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-8', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1468, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-9', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1469, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-10', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1470, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-11', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1471, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-12', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1472, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-13', 120, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41'),
(1473, NULL, 4, 'SH05', NULL, NULL, NULL, NULL, 'SH05-14', 145.5, '', 0, 0, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-05 05:27:41', '2021-10-05 05:27:41', '2021-10-05 05:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `zone_backup`
--

CREATE TABLE `zone_backup` (
  `id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `bid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `dictrict_area` int(11) DEFAULT NULL,
  `consumer_id` int(11) DEFAULT NULL,
  `accountant_id` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `acreage` float DEFAULT NULL,
  `zone` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `trans_type` int(11) NOT NULL DEFAULT '0',
  `final_price` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `unit_price` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `real_price` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_discount` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `con_discount` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `vat` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `done` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dept` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_type` int(1) DEFAULT NULL,
  `image_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT '1',
  `pay_step` int(2) NOT NULL,
  `position` int(2) DEFAULT '1',
  `view` text COLLATE utf8_unicode_ci,
  `contribute_state` int(2) NOT NULL DEFAULT '0',
  `deposit` int(1) DEFAULT NULL,
  `tax` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `inner_tax` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gap` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `deposit_date` datetime DEFAULT NULL,
  `complete_date` datetime DEFAULT NULL,
  `lock` int(11) NOT NULL DEFAULT '0',
  `lock_user` int(11) NOT NULL DEFAULT '0',
  `lock_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zone_backup`
--

INSERT INTO `zone_backup` (`id`, `zone_id`, `bid`, `staff_id`, `dictrict_area`, `consumer_id`, `accountant_id`, `name`, `acreage`, `zone`, `state`, `trans_type`, `final_price`, `unit_price`, `real_price`, `price_discount`, `con_discount`, `vat`, `done`, `dept`, `image_type`, `image_name`, `pay_step`, `position`, `view`, `contribute_state`, `deposit`, `tax`, `inner_tax`, `gap`, `deposit_date`, `complete_date`, `lock`, `lock_user`, `lock_time`, `created_at`, `updated_at`) VALUES
(4, 83, '', NULL, NULL, 423, NULL, 'BT05-11', 500, '\"280.3606829954595,315.14996482701287,187.24819338747844,364.2642450597941,227.15354607661317,435.37762998017524,321.28924985611053,387.2865639189103,282.9187184242502,314.63835774125477\"', -1, 2, '5126785800', '10000000', '7000000', '0', '0', '216785800', '0', '5126785800', NULL, '1', 2, 1, NULL, 0, 0, '', '10000000', '150000000', NULL, NULL, 0, 0, '2021-10-01 12:43:20', '2021-10-01 12:43:20', '2021-10-01 12:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `zone_comments`
--

CREATE TABLE `zone_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_comments_url`
--

CREATE TABLE `zone_comments_url` (
  `id` int(11) NOT NULL,
  `cmt_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_gap`
--

CREATE TABLE `zone_gap` (
  `id` int(11) NOT NULL,
  `zone_id` int(15) NOT NULL,
  `money` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_noti`
--

CREATE TABLE `zone_noti` (
  `id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_pay`
--

CREATE TABLE `zone_pay` (
  `id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `url` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step` int(11) NOT NULL,
  `money` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_pay_detail`
--

CREATE TABLE `zone_pay_detail` (
  `id` int(11) NOT NULL,
  `pay_id` int(11) NOT NULL,
  `money` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_posittion`
--

CREATE TABLE `zone_posittion` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zone_posittion`
--

INSERT INTO `zone_posittion` (`id`, `name`) VALUES
(1, 'Bắc'),
(2, 'Nam'),
(3, 'Đông'),
(4, 'Tây'),
(5, 'Đông Bắc'),
(6, 'Tây Bắc'),
(7, 'Đông Nam'),
(8, 'Tây Nam');

-- --------------------------------------------------------

--
-- Table structure for table `zone_process`
--

CREATE TABLE `zone_process` (
  `id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `curstep` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_remove`
--

CREATE TABLE `zone_remove` (
  `id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `content` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_step`
--

CREATE TABLE `zone_step` (
  `id` int(11) NOT NULL,
  `zone_id` int(2) NOT NULL,
  `step_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_task`
--

CREATE TABLE `zone_task` (
  `id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_task_url`
--

CREATE TABLE `zone_task_url` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountant`
--
ALTER TABLE `accountant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `big_process`
--
ALTER TABLE `big_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `big_process_step`
--
ALTER TABLE `big_process_step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `big_step`
--
ALTER TABLE `big_step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `big_step_to_process`
--
ALTER TABLE `big_step_to_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bosses`
--
ALTER TABLE `bosses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buiding_contract`
--
ALTER TABLE `buiding_contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_history`
--
ALTER TABLE `building_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_history_img`
--
ALTER TABLE `building_history_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_history_tag`
--
ALTER TABLE `building_history_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_job`
--
ALTER TABLE `building_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumer`
--
ALTER TABLE `consumer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumer2`
--
ALTER TABLE `consumer2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contractors`
--
ALTER TABLE `contractors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contributes`
--
ALTER TABLE `contributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribute_file`
--
ALTER TABLE `contribute_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribute_file_department`
--
ALTER TABLE `contribute_file_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribute_file_tags`
--
ALTER TABLE `contribute_file_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribute_file_user`
--
ALTER TABLE `contribute_file_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribute_taskfile`
--
ALTER TABLE `contribute_taskfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_legal`
--
ALTER TABLE `department_legal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dictrict`
--
ALTER TABLE `dictrict`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discussions_url`
--
ALTER TABLE `discussions_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_noti`
--
ALTER TABLE `event_noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_noti`
--
ALTER TABLE `file_noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_input`
--
ALTER TABLE `finance_input`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_input_type`
--
ALTER TABLE `finance_input_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_output`
--
ALTER TABLE `finance_output`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_output_type`
--
ALTER TABLE `finance_output_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_tax`
--
ALTER TABLE `finance_tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_tax_file`
--
ALTER TABLE `finance_tax_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fintem`
--
ALTER TABLE `fintem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_comments`
--
ALTER TABLE `job_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_comments_url`
--
ALTER TABLE `job_comments_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_imgs`
--
ALTER TABLE `job_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_init`
--
ALTER TABLE `job_init`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_moniters`
--
ALTER TABLE `job_moniters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_noti`
--
ALTER TABLE `job_noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_tag`
--
ALTER TABLE `job_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_task`
--
ALTER TABLE `job_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_task_imgs`
--
ALTER TABLE `job_task_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_task_users`
--
ALTER TABLE `job_task_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_users`
--
ALTER TABLE `job_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legal_form`
--
ALTER TABLE `legal_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map_config`
--
ALTER TABLE `map_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mess_url`
--
ALTER TABLE `mess_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_messages`
--
ALTER TABLE `old_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process_file`
--
ALTER TABLE `process_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process_step`
--
ALTER TABLE `process_step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies_url`
--
ALTER TABLE `replies_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_legal`
--
ALTER TABLE `role_legal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_department`
--
ALTER TABLE `schedule_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_file`
--
ALTER TABLE `schedule_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_file_tag`
--
ALTER TABLE `schedule_file_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_guest`
--
ALTER TABLE `schedule_guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_messages`
--
ALTER TABLE `schedule_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_messages_tag`
--
ALTER TABLE `schedule_messages_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_sub_messages`
--
ALTER TABLE `schedule_sub_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_sub_messages_tag`
--
ALTER TABLE `schedule_sub_messages_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_threads`
--
ALTER TABLE `schedule_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_thread_user`
--
ALTER TABLE `schedule_thread_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_user`
--
ALTER TABLE `schedule_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_event`
--
ALTER TABLE `staff_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_process`
--
ALTER TABLE `staff_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_process_lock`
--
ALTER TABLE `staff_process_lock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_process_step`
--
ALTER TABLE `staff_process_step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_step`
--
ALTER TABLE `staff_step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_step_task`
--
ALTER TABLE `staff_step_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_task`
--
ALTER TABLE `staff_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `step`
--
ALTER TABLE `step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `step_process`
--
ALTER TABLE `step_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `step_task`
--
ALTER TABLE `step_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `substep`
--
ALTER TABLE `substep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `substep_task`
--
ALTER TABLE `substep_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_url`
--
ALTER TABLE `task_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_add_request`
--
ALTER TABLE `users_add_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_delete_request`
--
ALTER TABLE `users_delete_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_location_access`
--
ALTER TABLE `users_location_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_location_access_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_confirm`
--
ALTER TABLE `user_confirm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_salary`
--
ALTER TABLE `user_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_noti`
--
ALTER TABLE `warehouse_noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_backup`
--
ALTER TABLE `zone_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_comments`
--
ALTER TABLE `zone_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_comments_url`
--
ALTER TABLE `zone_comments_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_gap`
--
ALTER TABLE `zone_gap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_noti`
--
ALTER TABLE `zone_noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_pay`
--
ALTER TABLE `zone_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_pay_detail`
--
ALTER TABLE `zone_pay_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_posittion`
--
ALTER TABLE `zone_posittion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_process`
--
ALTER TABLE `zone_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_remove`
--
ALTER TABLE `zone_remove`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_step`
--
ALTER TABLE `zone_step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_task`
--
ALTER TABLE `zone_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone_task_url`
--
ALTER TABLE `zone_task_url`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountant`
--
ALTER TABLE `accountant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `big_process`
--
ALTER TABLE `big_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `big_process_step`
--
ALTER TABLE `big_process_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `big_step`
--
ALTER TABLE `big_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `big_step_to_process`
--
ALTER TABLE `big_step_to_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bosses`
--
ALTER TABLE `bosses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `buiding_contract`
--
ALTER TABLE `buiding_contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `building_history`
--
ALTER TABLE `building_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `building_history_img`
--
ALTER TABLE `building_history_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `building_history_tag`
--
ALTER TABLE `building_history_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `building_job`
--
ALTER TABLE `building_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;
--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `consumer`
--
ALTER TABLE `consumer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `consumer2`
--
ALTER TABLE `consumer2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contractors`
--
ALTER TABLE `contractors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `contributes`
--
ALTER TABLE `contributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contribute_file`
--
ALTER TABLE `contribute_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;
--
-- AUTO_INCREMENT for table `contribute_file_department`
--
ALTER TABLE `contribute_file_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `contribute_file_tags`
--
ALTER TABLE `contribute_file_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=603;
--
-- AUTO_INCREMENT for table `contribute_file_user`
--
ALTER TABLE `contribute_file_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `contribute_taskfile`
--
ALTER TABLE `contribute_taskfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `department_legal`
--
ALTER TABLE `department_legal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dictrict`
--
ALTER TABLE `dictrict`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `discussions_url`
--
ALTER TABLE `discussions_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;
--
-- AUTO_INCREMENT for table `event_noti`
--
ALTER TABLE `event_noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `file_noti`
--
ALTER TABLE `file_noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `finance_input`
--
ALTER TABLE `finance_input`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `finance_input_type`
--
ALTER TABLE `finance_input_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `finance_output`
--
ALTER TABLE `finance_output`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `finance_output_type`
--
ALTER TABLE `finance_output_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `finance_tax`
--
ALTER TABLE `finance_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `finance_tax_file`
--
ALTER TABLE `finance_tax_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fintem`
--
ALTER TABLE `fintem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=967;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_comments`
--
ALTER TABLE `job_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_comments_url`
--
ALTER TABLE `job_comments_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_imgs`
--
ALTER TABLE `job_imgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_init`
--
ALTER TABLE `job_init`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_moniters`
--
ALTER TABLE `job_moniters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_noti`
--
ALTER TABLE `job_noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_tag`
--
ALTER TABLE `job_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_task`
--
ALTER TABLE `job_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_task_imgs`
--
ALTER TABLE `job_task_imgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_task_users`
--
ALTER TABLE `job_task_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_users`
--
ALTER TABLE `job_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `legal_form`
--
ALTER TABLE `legal_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `map_config`
--
ALTER TABLE `map_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1036;
--
-- AUTO_INCREMENT for table `mess_url`
--
ALTER TABLE `mess_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `old_messages`
--
ALTER TABLE `old_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `process_file`
--
ALTER TABLE `process_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `process_step`
--
ALTER TABLE `process_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `replies_url`
--
ALTER TABLE `replies_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `role_legal`
--
ALTER TABLE `role_legal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_department`
--
ALTER TABLE `schedule_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_file`
--
ALTER TABLE `schedule_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_file_tag`
--
ALTER TABLE `schedule_file_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_guest`
--
ALTER TABLE `schedule_guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_messages`
--
ALTER TABLE `schedule_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_messages_tag`
--
ALTER TABLE `schedule_messages_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_sub_messages`
--
ALTER TABLE `schedule_sub_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_sub_messages_tag`
--
ALTER TABLE `schedule_sub_messages_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_threads`
--
ALTER TABLE `schedule_threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_thread_user`
--
ALTER TABLE `schedule_thread_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_user`
--
ALTER TABLE `schedule_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staff_event`
--
ALTER TABLE `staff_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `staff_process`
--
ALTER TABLE `staff_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staff_process_lock`
--
ALTER TABLE `staff_process_lock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff_process_step`
--
ALTER TABLE `staff_process_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `staff_step`
--
ALTER TABLE `staff_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `staff_step_task`
--
ALTER TABLE `staff_step_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `staff_task`
--
ALTER TABLE `staff_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `step`
--
ALTER TABLE `step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `step_process`
--
ALTER TABLE `step_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `step_task`
--
ALTER TABLE `step_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `substep`
--
ALTER TABLE `substep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `substep_task`
--
ALTER TABLE `substep_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=472;
--
-- AUTO_INCREMENT for table `task_url`
--
ALTER TABLE `task_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `users_add_request`
--
ALTER TABLE `users_add_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users_delete_request`
--
ALTER TABLE `users_delete_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_location_access`
--
ALTER TABLE `users_location_access`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user_confirm`
--
ALTER TABLE `user_confirm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_salary`
--
ALTER TABLE `user_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `warehouse_noti`
--
ALTER TABLE `warehouse_noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `weather`
--
ALTER TABLE `weather`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18351;
--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2939;
--
-- AUTO_INCREMENT for table `zone_backup`
--
ALTER TABLE `zone_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `zone_comments`
--
ALTER TABLE `zone_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zone_comments_url`
--
ALTER TABLE `zone_comments_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zone_gap`
--
ALTER TABLE `zone_gap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zone_noti`
--
ALTER TABLE `zone_noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zone_pay`
--
ALTER TABLE `zone_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zone_pay_detail`
--
ALTER TABLE `zone_pay_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zone_posittion`
--
ALTER TABLE `zone_posittion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zone_process`
--
ALTER TABLE `zone_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zone_remove`
--
ALTER TABLE `zone_remove`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zone_step`
--
ALTER TABLE `zone_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zone_task`
--
ALTER TABLE `zone_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zone_task_url`
--
ALTER TABLE `zone_task_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_location_access`
--
ALTER TABLE `users_location_access`
  ADD CONSTRAINT `users_location_access_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
