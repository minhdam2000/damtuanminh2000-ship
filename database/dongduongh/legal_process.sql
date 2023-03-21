-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2022 at 09:28 PM
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
-- Table structure for table `legal_process`
--

CREATE TABLE `legal_process` (
  `id` int(11) NOT NULL,
  `stt` int(11) NOT NULL DEFAULT '0',
  `process_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `root_id` int(11) NOT NULL DEFAULT '0',
  `last_id` int(11) NOT NULL DEFAULT '0',
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `legal_process`
--

INSERT INTO `legal_process` (`id`, `stt`, `process_id`, `step_id`, `root_id`, `last_id`, `title`, `sender`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 1, 0, 0, 'xin khảo sát ngoài thực địa', '', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(2, 1, 9, 1, 1, 1, 'CĐT xin phép khảo sát ngoài thực địa', 'chủ đầu tư', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(3, 2, 9, 1, 1, 1, 'UBND tỉnh đồng ý cho khảo sát ngoài thực địa', 'UBND  tỉnh', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(4, 2, 9, 1, 0, 0, 'lập quy hoạch chi tiết 1/500', '', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(5, 1, 9, 1, 4, 4, 'CĐT xin lập quy hoạch 1/500; 1/2000', 'CĐT', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(6, 2, 9, 1, 4, 4, 'UBND huyện xin ý kiến của UBND tỉnh', 'UBND huyện', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(7, 3, 9, 1, 4, 4, 'UBND tỉnh đồng ý chủ trương để CĐT lập quy hoạch', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(8, 4, 9, 1, 4, 4, 'Sở xây dựng giới thiệu địa điểm khảo sát', 'sở xây dựng', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(9, 5, 9, 1, 4, 4, 'CĐT xin khảo sát, lập quy hoạch thực hiện dự án', 'CĐT', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(10, 6, 9, 1, 4, 4, 'UBND tỉnh cho phép khảo sát, lập quy hoạch thực hiện dự án đầu tư', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(11, 7, 9, 1, 4, 4, 'Sở xây dựng báo cáo kết quả thẩm định nhiệm vụ, dự toán khảo sát', 'sở xây dựng', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(12, 8, 9, 1, 4, 4, 'UBND tỉnh phê duyệt nhiệm vụ, dự toán khảo sát', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(13, 9, 9, 1, 4, 4, 'UBND tỉnh tổ chức họp giữa CĐT và các sở ban nghành đề nghị giúp đỡ CĐT trong việc lập quy hoạch', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(14, 10, 9, 1, 4, 4, 'CĐT xin cấp thông tin chỉ giới đường đỏ, thông tin đấu nối giao thông', 'sở giao thông vận tải', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(15, 11, 9, 1, 4, 4, 'Sở GTVT trả lời về chỉ giới đường đỏ, đấu nối giao thông', 'sở giao thông vận tải', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(16, 12, 9, 1, 4, 4, 'UBND huyên cung cấp số liệu phục vụ quy hoạch', 'UBND huyện', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(17, 13, 9, 1, 4, 4, 'CĐT trình sở XD đề nghị thẩm định dự toán : trính đo bản đồ khu vực đô thị mới xuân an', 'sở xây dựng', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(18, 14, 9, 1, 4, 4, 'CĐT đề nghị UBND tỉnh giao nhiệm vụ dự toán tiền sử dụng đất để thực hiện dự án đầu tư', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(19, 15, 9, 1, 4, 4, 'UBND tỉnh giao sở TNMT phối hợp sở ban ngành tính tiền SDĐ', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(20, 16, 9, 1, 4, 4, 'CĐT nộp, xin phê duyệt quy hoạch 1/500', 'UBND tỉnh', NULL, 0, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(21, 17, 9, 1, 4, 4, 'UBND tỉnh phê duyệt quy hoạch chi tiết 1/500', 'UBND tỉnh', NULL, 0, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(22, 3, 9, 1, 0, 0, 'xin chấp thuận chủ trương đầu tư', '', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(23, 1, 9, 1, 22, 22, 'CĐT trình xin chấp thuận chủ trương đầu tư', 'UBND tỉnh; Sở xây dựng, Sở TNMT', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(24, 2, 9, 1, 22, 22, 'UBND huyện đề nghị bổ sung kế hoạch sử dụng đất hằng năm', 'UBND huyện', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(25, 3, 9, 1, 22, 22, 'UBND tỉnh giao các sở ban nggành tham mưu', 'sở KHĐT, sở TNMT; sở XD, sở TC', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(26, 4, 9, 1, 22, 22, 'UBND tỉnh phê duyệt chủ trương đầu tư', 'UBND tỉnh', NULL, 0, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(27, 4, 9, 1, 0, 0, 'XIn chuyển đổi mục đích sử dụng đất lúa', '', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(28, 1, 9, 1, 27, 27, 'CĐT đề nghị chuyển đổi mục đích SDĐ trồng lúa', 'CĐT', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(29, 2, 9, 1, 27, 27, 'UBND huyện rà soát và trình các diện tích cânf chuyển đổi', 'UBND huyện', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(30, 3, 9, 1, 27, 27, 'sở TNMT đề nghị UBND tỉnh trình Thủ tướng chính phủ chuyển đổi mục đích SDĐ', 'Sở Tài nguyên Môi trường', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(31, 4, 9, 1, 27, 27, 'UBND tỉnh giao sở TNMT xin ý kiến các sở ban ngành', 'Sở Tài nguyên Môi trường', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(32, 5, 9, 1, 27, 27, 'UBND tỉnh trình thủ tướng CP về việc chuyển đổi mục đích sử dụng đất', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(33, 6, 9, 1, 27, 27, 'Thủ tướng chính phủ chấp thuận chuyền đổi mục đích sử dụng đất', 'thủ tướng chính phủ', NULL, 0, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(34, 1, 9, 2, 0, 0, 'đền bù giải phóng mặt bằng (GĐ1+GĐ2)', '', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(35, 1, 9, 2, 34, 34, 'CĐT đề nghị thu hồi đất, thành lập hội đồng đền bù giải phóng mặt bằng', 'UBND huyện', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(36, 2, 9, 2, 34, 34, 'UBND huyện tuyên truyền thực hiện giải phóng mặt bằng để hỗ trợ CĐT', 'UBND huyện', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(37, 3, 9, 2, 34, 34, 'UBND huyện ra quyết định thành lập hội đồng đền bù giải phóng mặt bằng', 'UBND huyện', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(38, 4, 9, 2, 34, 34, 'bàn giao mốc giới để giải phóng mặt bằng', 'UBND huyện', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(39, 5, 9, 2, 34, 34, 'CĐT cam kết đền bù và đưa ra mức chi phí hỗ trợ các hộ dân', 'CĐT', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(40, 6, 9, 2, 34, 34, 'hội đồng đền bù GPMB tổ chức xác nhận các hộ, các cá nhân bị ảnh hưởng bởi GPMB', 'hội đồng GPMB', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(41, 7, 9, 2, 34, 34, 'UBND huyện phê duyệt phương án đền bù, giải phóng mặt bằng,; tái định cư', 'UBND huyện', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(42, 8, 9, 2, 34, 34, 'hội đồng GPMB yêu cầu CĐT chuyển kinh phí đền bù GPMB', 'hội đồng GPMB', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(43, 9, 9, 2, 34, 34, 'CĐT chuyển kinh phí', 'CĐT', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(44, 10, 9, 2, 34, 34, 'CĐT đề nghị chuyển trả kinh phí thừa', 'hội đồng GPMB', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(45, 11, 9, 2, 34, 34, 'CĐT xin bàn giao mặt bằng tạm thời để làm lễ khởi công', 'chủ đầu tư', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(46, 12, 9, 2, 34, 34, 'UBND huyện phê duyệt phương án đền bù, giải phóng mặt bằng,; tái định cư đợt 2', 'UBND huyện', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(47, 13, 9, 2, 34, 34, 'Hội đồng GPMB báo cáo hoàn thành công tác đền bù GPMB', 'hội đồng GPMB', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(48, 2, 9, 2, 0, 0, 'di dời đường điện tạm thời để phục vụ dự án (phát sinh)', '', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(49, 1, 9, 2, 48, 48, 'CĐT đề nghị khảo sát di dời đường điện đang chạy qua dự án', 'CĐT', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(50, 2, 9, 2, 48, 48, 'Công ty điện lực cho phép di rời', 'Công ty điện lực', NULL, 1, '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(51, 3, 9, 2, 0, 0, 'xin đấu nối dường tạm thời để phục vụ thi công', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(52, 1, 9, 2, 51, 51, 'CĐT xin đấu nối nút giao thông tạm thời để phục vụ thi công', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(53, 2, 9, 2, 51, 51, 'CĐT gửi sở giao thông xin chấp thuận thiết kế nút giao thông tạm', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(54, 3, 9, 2, 51, 51, 'Sở GTVT chấp thuận thiết kế nút giao tạm thời', 'Sở GTVT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(55, 4, 9, 2, 51, 51, 'cấp giấy phép thi công cho nút giao tạm thời', 'sở giao thông vận tải', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(56, 4, 9, 2, 0, 0, 'xin phép PCCC', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(57, 1, 9, 2, 56, 56, 'CĐT yêu cầu thẩm duyệt hồ sơ thiết kế PCCC cho hạ tầng kỹ thuật dự án', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(58, 2, 9, 2, 56, 56, 'Cấp giấy chứng nhận đã thẩm duyệt PCCC', 'công an phòng cháy chữa cháy', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(59, 5, 9, 2, 0, 0, 'bàn giao đất thực hiện dự án đợt 1', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(60, 1, 9, 2, 59, 59, 'CĐT báo cáo tiến độ dự án, xin bàn giao đất', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(61, 2, 9, 2, 59, 59, 'UBND tỉnh quyết định giao đất, cho thuê đất', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(62, 3, 9, 2, 59, 59, 'CĐT yêu cầu sở TNMT tiến hành bàn gioa đất', 'Sở TNMT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(63, 4, 9, 2, 59, 59, 'bàn giao đất ngoài thực địa', 'Sở TNMT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(64, 6, 9, 2, 0, 0, 'Đề nghị sở xây dựng thông báo đủ điều kiện huy động vốn phát triển hạ tầng dự án', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(65, 1, 9, 2, 64, 64, 'CĐT đề nghị thông báo đủ điều kiện huy động vốn', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(66, 2, 9, 2, 64, 64, 'SXD thông báo đủ điều kiện huy động vốn xây dựng hạ tầng', 'SXD', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(67, 3, 9, 2, 64, 64, 'CĐT xin ý kiến về cách xuất hóa đơn', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(68, 7, 9, 2, 0, 0, 'xin phép xây dựng hạ tầng kỹ thuật (giao thông; điện; nước; etc.)', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(69, 1, 9, 2, 68, 68, 'phê duyệt bản vẽ thi công và dự toán dự án', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(70, 2, 9, 2, 68, 68, 'điều chỉnh xử lý hồ sơ theo tham vấn của các sở ban nghành', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(71, 3, 9, 2, 68, 68, 'Công ty tư vấn ngoài thẩm tra', 'Công ty tư vấn', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(72, 4, 9, 2, 68, 68, 'Sở xây dựng thẩm định, yêu cầu bổ sung', 'sở xây dựng', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(73, 5, 9, 2, 68, 68, 'lên phương án hệ thống thoát nước mưa', 'UBND huyện', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(74, 6, 9, 2, 68, 68, 'thiết kế hệ tthống điện', 'sở công thương', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(75, 7, 9, 2, 68, 68, 'cấp giấy phép xây dựng hạ tầng', 'sở xây dựng', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(76, 8, 9, 2, 0, 0, 'tính tiền sử dụng đất nộp cho nhà nước', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(77, 1, 9, 2, 76, 76, 'Hội đồng thẩm định giá đất để làm cơ sở tính tiền sử dụng đất', 'UBND tỉnh thành lập Hội đồng thẩm định giá', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(78, 2, 9, 2, 76, 76, 'UBND tỉnh phê duyệt giá đất', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(79, 3, 9, 2, 76, 76, 'CĐT cõ văn bản xin hưởng ưu đãi, miễn tiền thuế', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(80, 4, 9, 2, 76, 76, 'UBND huyện phê duyệt quyết toán tiền đền bù giải phóng mặt bằng làm cơ sở đối trừ tiền SDĐ cho CĐT', 'UBND huyện', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(81, 5, 9, 2, 76, 76, 'CĐT đề nghị khấu trừ tiền GPMB vào tiền SDĐ', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(82, 6, 9, 2, 76, 76, 'Sở tài chính tính ra số tiền phải nôi còn lại,', 'sở tài chính', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(83, 7, 9, 2, 76, 76, 'cục thuế thông báo đóng tiền thuê đất (với phần đất thuê)', 'cục thuế', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(84, 8, 9, 2, 76, 76, 'Cục thuế thông báo tiền SDĐ mà CĐT phải nộp', 'sở tài chính', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(85, 9, 9, 2, 76, 76, 'CĐT nộp tiền SDĐ', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(86, 9, 9, 2, 0, 0, 'cấp giấy chứng nhận QSDĐ cho CĐT', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(87, 1, 9, 2, 86, 86, 'CĐT đề nghị được cấp giấy CNQSDĐ tương ứng với số tiền SDĐ đã nộp', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(88, 2, 9, 2, 86, 86, 'cấp giấy CNQSDĐ cho CĐT đợt 1', 'Sở Tài nguyên Môi trường', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(89, 3, 9, 2, 86, 86, 'cấp giấy CNQSDĐ cho CĐT đợt 2', 'Sở Tài nguyên Môi trường', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(90, 4, 9, 2, 86, 86, 'CĐT đề nghị tách thửa', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(91, 5, 9, 2, 86, 86, 'Sở TNMT tách thửa cho chủ đầu tư để tiện bán hàng', 'Sở Tài nguyên Môi trường', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(92, 10, 9, 2, 0, 0, 'xin phép bán nhà ở hình thành trong tương lai', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(93, 1, 9, 2, 92, 92, 'CĐT đề nghị SXD ra thông báo các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(94, 2, 9, 2, 92, 92, 'Sở xây dựng thông báo về các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 'sở xây dựng', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(95, 11, 9, 2, 0, 0, 'xin phép phân lô bán nền', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(96, 1, 9, 2, 95, 95, 'CĐT gửi Sở xây dựng vv ra thông báo đủ điều kiện phân lô bán nền', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(97, 2, 9, 2, 95, 95, 'SXD có ý kiến lên UBND tỉnh', 'sở xây dựng', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(98, 3, 9, 2, 95, 95, 'UBND tỉnh yêu cầu SXD phối hợp kiểm tra các điều kiện phân lô bán nền', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(99, 4, 9, 2, 95, 95, 'SXD tham mưu UBND tỉnh về các điều kiện phân lô bán nền', 'sở xây dựng', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(100, 5, 9, 2, 95, 95, 'Bộ xây dựng cho ý kiến', 'bộ xây dựng', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(101, 6, 9, 2, 95, 95, 'UBND tỉnh ra quyết định về các lô được phân lô bán nền', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(102, 7, 9, 2, 95, 95, 'sở TNMT thông báo kiểm tra về điều kiện chuyển nhượng dưới hình thức phân lô bán nền', 'Sở Tài nguyên Môi trường', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(103, 12, 9, 2, 0, 0, 'xin giấy phép xả thải (tùy dự án)', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(104, 1, 9, 2, 103, 103, 'UBND tỉnh cấp phép xả thải', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(105, 13, 9, 2, 0, 0, 'xin giấy phép xây dựng nhà ở thấp tầng', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(106, 1, 9, 2, 105, 105, 'CĐT nộp thiết kế thi công nhà thấp tầng cho SXD', 'CĐT', NULL, 0, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(107, 2, 9, 2, 105, 105, 'SXD phê duyệt hồ sơ thiết kế thi công nhà ở thấp tầng', 'SXD', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(108, 3, 9, 2, 105, 105, 'CĐT giao nhà thầu thực hiện mẫu nahf ở', 'CĐT', NULL, 0, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(109, 4, 9, 2, 105, 105, 'CĐT đề nghị thẩm định mẫu nhà ở LK', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(110, 5, 9, 2, 105, 105, 'SXD thông báo về kết quả thẩm định mẫu nhà ở LK', 'sở xây dựng', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(111, 14, 9, 2, 0, 0, 'xin phép xây dựng trung tâm thương mại', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(112, 1, 9, 2, 111, 111, 'CĐT nộp hồ sơ thiết kế TTTM xin thẩm định', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(113, 2, 9, 2, 111, 111, 'sở xây dựng thẩm định hồ sơ thiết kế TTTM', 'sở xây dựng', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(114, 3, 9, 2, 111, 111, 'CĐT xin cấp phép xây dựng', 'CĐT', NULL, 0, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(115, 4, 9, 2, 111, 111, 'Sở xây dựng cấp giấy phép xây dựng TTTM', 'sở xây dựng', NULL, 0, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(116, 15, 9, 2, 0, 0, 'Nghiệm thu PCCC', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(117, 1, 9, 2, 116, 116, 'CĐT đề nghị nghiệm thu các hạng mục PCCC', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(118, 2, 9, 2, 116, 116, 'công an PCCC nghiệm thu', 'công an phòng cháy chữa cháy', NULL, 0, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(119, 16, 9, 2, 0, 0, 'ban hành quy định quản lý khu đô thị theo đồ án đã điều chỉnh quy hoạch 1/500', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(120, 1, 9, 2, 119, 119, 'UBND huyện xin ý  kiến sở XD', 'UBND huyện', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(121, 2, 9, 2, 119, 119, 'ban hành quy định quản lý theo đồ án', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(122, 17, 9, 2, 0, 0, 'cấp giấy chứng nhận quyền sử dụng đất và quyền sở hữu nhà cho CĐT', '', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(123, 1, 9, 2, 122, 122, 'cấp giấy CNQSDĐ và quyền sở hữu nhà cho chủ đầu tư', 'Sở Tài nguyên Môi trường', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(124, 1, 9, 3, 0, 0, 'bàn giao lại cơ sở hạ tầng cho UBND quản lý', '', NULL, 0, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(125, 1, 9, 3, 124, 124, 'CĐT đề nghị UBND tỉnh kiểm tra việc nghiệm thu hạ tầng kỹ thuật', 'CĐT', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(126, 2, 9, 3, 124, 124, 'SXD thông báo kết quả kiểm tra, chỉ ra các hồ sơ còn thiếu', 'sở xây dựng', NULL, 0, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(127, 3, 9, 3, 124, 124, 'UBND tỉnh yêu cầu huyện và các sở ban nghành hỗ trợ CĐT hoàn thành nghiệm thu', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(128, 4, 9, 3, 124, 124, 'UBND huyên xin ý kiến về việc bàn giao', 'UBND huyện', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(129, 5, 9, 3, 124, 124, 'UBND tỉnh yêu cầu các sở ban nghành phối hợp nhận bàn giao hạ tầng', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(130, 6, 9, 3, 124, 124, 'UBND Huyện nhận bàn giao ngoài thực địa', 'UBND huyện', NULL, 0, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(131, 7, 9, 3, 124, 124, '6.UBND tỉnh ban hành quy định về quản lý công trình hạ tầng kỹ thuật', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(132, 8, 9, 3, 124, 124, 'thu hồi, hủy, hồ sơ cũ', 'UBND tỉnh', NULL, 1, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(133, 2, 9, 3, 0, 0, 'quyết toán thuế', '', NULL, 0, '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(134, 1, 11, 1, 0, 0, 'xin khảo sát, lập quy hoạch chi tiết 1/500; 1/2000', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(135, 1, 11, 1, 134, 134, 'CĐT trình UBND huyện xin khảo sất, lập quy hoạch 1/500; 1/2000 GĐ2', 'CĐT', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(136, 2, 11, 1, 134, 134, 'UBND huyện xin chủ trương của UBND tỉnh về lập quy hoạch chi tiết 1/500', 'UBND huyện', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(137, 3, 11, 1, 134, 134, 'UBND tỉnh giao SXD phối hợp các sở ban nghành tham mưu', 'UBND tỉnh', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(138, 4, 11, 1, 134, 134, 'ubnd tỉnh chấp thuận để UBND huyện lập quy hoạch chi tiết 1/500', 'UBND tỉnh', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(139, 5, 11, 1, 134, 134, 'CĐT xin tài trợ UBND tỉnh trong việc lập quy hoạch', 'CĐT', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(140, 6, 11, 1, 134, 134, 'CĐT chỉ định thầu lập bản đồ hiện trạng khu đất', 'CĐT', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(141, 7, 11, 1, 134, 134, 'CĐT chỉ định thầu lập nhiệm vụ, quy hoạch chi tiết xây dựng', 'CĐT', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(142, 8, 11, 1, 134, 134, 'CĐT trình UBND huyện phê duyệt nhiệm vụ khảo sát và nhiệm vụ thiết kế chi tiết 1/500', 'CĐT', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(143, 9, 11, 1, 134, 134, 'UBND huyện trình SXD và UBND tỉnh phê duyệt nhiệm vụ khảo sát và nhiệm vụ lập quy hoạch 1/500', 'UBND huyện', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(144, 10, 11, 1, 134, 134, 'SXD báo cáo kết quả thẩm định nhiệm vụ', 'sở xây dựng', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(145, 11, 11, 1, 134, 134, 'UBND tỉnh phê duyệt nhiệm vụ, dự toán khảo sát và lập quy hoạch', 'UBND tỉnh', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(146, 12, 11, 1, 134, 134, 'UBND tỉnh tổ chức họp giữa CĐT và các sở ban nghành đề nghị giúp đỡ CĐT trong việc lập quy hoạch', 'UBND tỉnh', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(147, 13, 11, 1, 134, 134, 'cấp số liệu để lập quy hoạch 1/500', 'UBND huyện, sở ban nghành', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(148, 14, 11, 1, 134, 134, 'UBND tỉnh phê duyệt quy hoạch chi tiết 1/500', 'UBND tỉnh', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(149, 2, 11, 1, 0, 0, 'đấu thầu lựa chọn CĐT', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(150, 3, 11, 1, 0, 0, 'đền bù giải phóng mặt bằng', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(151, 4, 11, 1, 0, 0, 'xin chuyển đổi mục đích sử dụng đất trồng rừng', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(152, 1, 11, 2, 0, 0, 'đền bù giải phóng mặt bằng', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(153, 2, 11, 2, 0, 0, 'bàn giao đất thực hiện dự án', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(154, 3, 11, 2, 0, 0, 'Đề nghị sở xây dựng thông báo đủ điều kiện huy động vốn phát triển hạ tầng dự án', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(155, 4, 11, 2, 0, 0, 'xin phép xây dựng hạ tầng kỹ thuật (giao thông; điện; nước; etc.)', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(156, 5, 11, 2, 0, 0, 'tính tiền sử dụng đất nộp cho nhà nước', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(157, 6, 11, 2, 0, 0, 'cấp giấy chứng nhận qsdđ cho CĐT', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(158, 7, 11, 2, 0, 0, 'giấy phép xả thải', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(159, 8, 11, 2, 0, 0, 'giấy phép phòng cháy chữa cháy', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(160, 9, 11, 2, 0, 0, 'đấu nối nguồn điện', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(161, 10, 11, 2, 0, 0, 'đấu nối nguồn nước', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(162, 11, 11, 2, 0, 0, 'xin phép bán nhà ở hình thành trong tương lai', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(163, 12, 11, 2, 0, 0, 'xin phép phân lô bán nền', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(164, 13, 11, 2, 0, 0, 'xin phép xây dựng nhà ở', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(165, 14, 11, 2, 0, 0, 'xin phép xây TTTM', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(166, 15, 11, 2, 0, 0, 'xin phép xây dựng Chung cư', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(167, 16, 11, 2, 0, 0, 'cấp giấy chứng nhận quyền sử dụng đất và quyền sở hữu nhà cho CĐT', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(168, 1, 11, 3, 0, 0, 'bàn giao lại cơ sở hạ tầng cho UBND quản lý', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(169, 2, 11, 3, 0, 0, 'quyết toán thuế', '', NULL, 0, '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(170, 1, 12, 1, 0, 0, 'xin khảo sát ngoài thực địa', '', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(171, 1, 12, 1, 170, 170, 'CĐT gửi văn bản xin đầu tư tới UBND tỉnh Hòa BÌnh', 'CĐT', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(172, 2, 12, 1, 170, 170, 'UBND tỉnh giao các sở ban nghành rà soát. báo cáo', 'UBND tỉnh', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(173, 3, 12, 1, 170, 170, 'SXD xin ý kiến các sở ban nghành về việc cho phép CĐT khảo sát lập dự án', 'sở xây dựng', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(174, 4, 12, 1, 170, 170, 'Sở nông nghiệp trả lời', 'sở nông nghiệp', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(175, 5, 12, 1, 170, 170, 'sở tài nguyên môi trường trả lời', 'Sở Tài nguyên Môi trường', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(176, 6, 12, 1, 170, 170, 'SXD trình UBND tỉnh thu hồi các quyết định cũ về việc cho các công ty khác  khảo sát tại vị trí này nhưng không tiến hành', 'sở xây dựng', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(177, 7, 12, 1, 170, 170, 'SXD đề xuất UBND tỉnh cho phép CĐT khảo sát lập quy hoạch', 'sở xây dựng', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(178, 8, 12, 1, 170, 170, 'UBND tỉnh đồng ý cho phép CĐT vào khảo sát lập quy hoạch 1/500', 'UBND tỉnh', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(179, 2, 12, 1, 0, 0, 'xin lập quy hoạch chi tiết 1/500', '', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(180, 1, 12, 1, 179, 179, 'CĐT trình thẩm định nhiệm vụ thiết kế quy hoạch chi tiết 1/500', 'CĐT', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(181, 2, 12, 1, 179, 179, 'lấy ý kiến các hộ dân cư', 'CĐT', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(182, 3, 12, 1, 179, 179, 'xin sở nông nghiệp xác nhận trong dự án có đất rừng tự nhiên không', 'sở nông nghiệp', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(183, 4, 12, 1, 179, 179, 'sxd trình UBND tỉnh phê duyệt đồ án quy hoach 1/500', 'sở xây dựng', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(184, 5, 12, 1, 179, 179, 'UBND tỉnh phê duyệt đồ án chi tiết 1/500', 'UBND tỉnh', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(185, 3, 12, 1, 0, 0, 'đấu thầu lựa chọn CĐT', '', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(186, 1, 12, 1, 185, 185, 'Đề xuất dự án gửi thủ tướng chính phủ', 'UBND tỉnh', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(187, 4, 12, 1, 0, 0, 'xin chuyển đổi mục đích sử dụng đất trồng rừng', '', NULL, 0, '2022-01-09 13:55:39', '2022-01-09 13:55:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `legal_process`
--
ALTER TABLE `legal_process`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `legal_process`
--
ALTER TABLE `legal_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
