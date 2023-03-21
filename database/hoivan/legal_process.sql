-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2022 at 09:38 PM
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
(1, 1, 16, 1, 0, 0, '1. Khảo sát và quy hoạch 1/2000', '', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(2, 1, 16, 1, 1, 1, '1. UBND Phê duyệt quy hoạch phân khu 1/2000', 'UBND tỉnh Bình Định', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(3, 2, 16, 1, 1, 1, '2. Sở Tài chính ý kiến về đất BVYHCT: thuộc tiểu khu 1', 'Sở Tài chính', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(4, 3, 16, 1, 1, 1, '2. Sở KHĐT đề nghị các sở ban ngành cung cấp thông tin', 'Sở KHĐT', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(5, 4, 16, 1, 1, 1, '2. Sở Tài chính đề nghị xây dựng quy hoạch 1/500 cho Tiểu khu 1', 'Sở Tài chính', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(6, 5, 16, 1, 1, 1, '2. Sở KHĐT đề xuất UBND tỉnh thực tổ chức đấu thầu, đưa BVYHCT vào giá trị m2', 'Sở KHĐT', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(7, 6, 16, 1, 1, 1, '2. UBND tỉnh giao SXD là bên mời thầu, giao STC định giá BVYHCT để đưa vào m2', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(8, 7, 16, 1, 1, 1, '2. UBND tỉnh phê duyệt giá trị tài sản BVYHCT', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(9, 8, 16, 1, 1, 1, '3. UBND tỉnh phê duyệt điều chỉnh quy hoạch 1/2000', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(10, 2, 16, 1, 0, 0, '2. Lựa chọn nhà đầu tư', '', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(11, 1, 16, 1, 10, 10, '1. Sở KHĐT đề nghị SXD công bố thông tin dự án, triển khai mời thầu', 'Sở KHĐT', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(12, 2, 16, 1, 10, 10, '2. UBND huyện tạm tính giá trị GPMB', 'UBND huyện Phù Cát', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(13, 3, 16, 1, 10, 10, '2. Sở TNMT trình UBND tỉnh phê duyệt chi phí GPMB sơ bộ', 'Sở TNMT', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(14, 4, 16, 1, 10, 10, '2. UBND tỉnh phê duyệt chi phí GPMB sơ bộ', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(15, 5, 16, 1, 10, 10, '2. Sở Tài chính tạm tính giá sàn m3', 'Sở Tài chính', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(16, 6, 16, 1, 10, 10, '3. Sở KHĐT đề nghị UBND tỉnh phê duyệt danh mục dự án có sử dụng đất', 'Sở KHĐT', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(17, 7, 16, 1, 10, 10, '3. UBND tỉnh phê duyệt danh mục dự án có sử dụng đất để đấu thầu', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(18, 8, 16, 1, 10, 10, '4. Sở KHĐT thông báo mời quan tâm dự án', 'Sở KHĐT', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(19, 9, 16, 1, 10, 10, '4. Sở KHĐT báo cáo UBND kết quả chấm thầu', 'Sở KHĐT', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(20, 10, 16, 1, 10, 10, '4. UBND tỉnh phê duyệt kết quả đánh giá năng lực NĐT', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(21, 3, 16, 1, 0, 0, '3. Chấp thuận chủ trương đầu tư', '', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(22, 1, 16, 1, 21, 21, '1. Sở KHĐT hướng dẫn NĐT nộp hồ sơ Chấp thuận chủ trương đầu tư', 'Sở KHĐT', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(23, 2, 16, 1, 21, 21, '2. Sở KHĐT lấy ý kiến thẩm định dự án, chấp thuận chủ trương đầu tư', 'Sở KHĐT', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(24, 3, 16, 1, 21, 21, '3. Sở KHĐT trình UBND tỉnh phê duyệt chấp thuận chủ trương đầu tư', 'Sở KHĐT', NULL, 1, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(25, 4, 16, 1, 21, 21, '4. UBND tỉnh phê duyệt chấp thuận chủ trương đầu tư', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(26, 4, 16, 1, 0, 0, '4. Lập quy hoạch chi tiết 1/500', '', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(27, 1, 16, 1, 26, 26, 'SXD trình phê duyệt nhiệm vụ quy hoạch 1/500 lên UBND tỉnh', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(28, 2, 16, 1, 26, 26, 'UBND tỉnh phê duyệt nhiệm vụ quy hoạch 1/500', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(29, 3, 16, 1, 26, 26, 'NĐT trình thẩm định phê duyệt quy hoạch 1/500', 'NĐT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(30, 4, 16, 1, 26, 26, 'sở xây dựng lấy ý kiến các sở ban ngành và ubnd huyện về quy hoạch 1/500', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(31, 5, 16, 1, 26, 26, 'các sở ban ngành trả lời về quy hoạch 1/500', 'Sở ngành', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(32, 6, 16, 1, 26, 26, 'sở xây dựng trình UBND tỉnh phê duyệt quy hoạch 1/500', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(33, 7, 16, 1, 26, 26, 'UBND tỉnh phê duyệt quy hoạch chi tiết 1/500', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(34, 1, 16, 2, 0, 0, '1. Đền bù và giải phóng mặt bằng', '', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(35, 1, 16, 2, 34, 34, 'CĐT đề nghị thu hồi đất, thành lập hội đồng đền bù giải phóng mặt bằng', 'CĐT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(36, 2, 16, 2, 34, 34, 'UBND huyện tuyên truyền thực hiện giải phóng mặt bằng để hỗ trợ CĐT', 'UBND huyện', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(37, 3, 16, 2, 34, 34, 'UBND huyện ra quyết định thành lập hội đồng đền bù giải phóng mặt bằng', 'UBND huyện', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(38, 4, 16, 2, 34, 34, 'Bàn giao mốc giới để giải phóng mặt bằng', 'UBND - CĐT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(39, 5, 16, 2, 34, 34, 'CĐT cam kết đền bù và đưa ra mức chi phí hỗ trợ các hộ dân', 'CĐT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(40, 6, 16, 2, 34, 34, 'Hội đồng đền bù GPMB tổ chức xác nhận các hộ, các cá nhân bị ảnh hưởng bởi GPMB', 'UBND huyện', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(41, 7, 16, 2, 34, 34, 'UBND huyện phê duyệt phương án đền bù, giải phóng mặt bằng,; tái định cư', 'UBND huyện', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(42, 8, 16, 2, 34, 34, 'hội đồng GPMB yêu cầu CĐT chuyển kinh phí đền bù GPMB', 'CĐT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(43, 9, 16, 2, 34, 34, 'CĐT chuyển kinh phí', 'CĐT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(44, 10, 16, 2, 34, 34, 'CĐT đề nghị chuyển trả kinh phí thừa', 'CĐT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(45, 11, 16, 2, 34, 34, 'CĐT xin bàn giao mặt bằng tạm thời để làm lễ khởi công', 'UBND huyện', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(46, 12, 16, 2, 34, 34, 'UBND huyện phê duyệt phương án đền bù, giải phóng mặt bằng,; tái định cư đợt 2', 'UBND huyện', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(47, 13, 16, 2, 34, 34, 'Hội đồng GPMB báo cáo hoàn thành công tác đền bù GPMB', 'UBND huyện', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(48, 2, 16, 2, 0, 0, '2. Xin đấu nối dường tạm thời để phục vụ thi công', '', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(49, 1, 16, 2, 48, 48, 'CĐT xin đấu nối nút giao thông tạm thời để phục vụ thi công', 'CĐT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(50, 2, 16, 2, 48, 48, 'CĐT gửi sở giao thông xin chấp thuận thiết kế nút giao thông tạm', 'CĐT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(51, 3, 16, 2, 48, 48, 'Sở GTVT chấp thuận thiết kế nút giao tạm thời', 'Sở GTVT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(52, 4, 16, 2, 48, 48, 'cấp giấy phép thi công cho nút giao tạm thời', 'Sở GTVT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(53, 3, 16, 2, 0, 0, '3. Bàn giao đất thực hiện dự án', '', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(54, 1, 16, 2, 53, 53, 'CĐT báo cáo tiến độ dự án, xin bàn giao đất', 'CĐT', NULL, 0, '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(55, 2, 16, 2, 53, 53, 'UBND tỉnh quyết định giao đất, cho thuê đất', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(56, 3, 16, 2, 53, 53, 'CĐT yêu cầu sở TNMT tiến hành bàn gioa đất', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(57, 4, 16, 2, 53, 53, 'bàn giao đất ngoài thực địa', 'Sở TNMT - CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(58, 4, 16, 2, 0, 0, '4. Đề nghị sở xây dựng thông báo đủ điều kiện huy động vốn phát triển hạ tầng dự án', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(59, 1, 16, 2, 58, 58, 'CĐT đề nghị thông báo đủ điều kiện huy động vốn', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(60, 2, 16, 2, 58, 58, 'SXD thông báo đủ điều kiện huy động vốn xây dựng hạ tầng', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(61, 3, 16, 2, 58, 58, 'CĐT xin ý kiến về cách xuất hóa đơn', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(62, 5, 16, 2, 0, 0, '5. Xin phép xây dựng hạ tầng kỹ thuật (giao thông; điện; nước; etc.)', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(63, 1, 16, 2, 62, 62, 'phê duyệt bản vẽ thi công và dự toán dự án', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(64, 2, 16, 2, 62, 62, 'điều chỉnh xử lý hồ sơ theo tham vấn của các sở ban nghành', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(65, 3, 16, 2, 62, 62, 'Công ty tư vấn ngoài thẩm tra', 'Công ty tư vấn', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(66, 4, 16, 2, 62, 62, 'Sở xây dựng thẩm định, yêu cầu bổ sung', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(67, 5, 16, 2, 62, 62, 'Lên phương án hệ thống thoát nước mưa', 'UBND huyện', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(68, 6, 16, 2, 62, 62, 'cấp giấy phép xây dựng hạ tầng', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(69, 6, 16, 2, 0, 0, '6. Tính tiền sử dụng đất nộp cho nhà nước', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(70, 1, 16, 2, 69, 69, 'Hội đồng thẩm định giá đất để làm cơ sở tính tiền sử dụng đất', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(71, 2, 16, 2, 69, 69, 'UBND tỉnh phê duyệt giá đất', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(72, 3, 16, 2, 69, 69, 'CĐT cõ văn bản xin hưởng ưu đãi, miễn tiền thuế', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(73, 4, 16, 2, 69, 69, 'UBND huyện phê duyệt quyết toán tiền đền bù giải phóng mặt bằng làm cơ sở đối trừ tiền SDĐ cho CĐT', 'UBND huyện', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(74, 5, 16, 2, 69, 69, 'CĐT đề nghị khấu trừ tiền GPMB vào tiền SDĐ', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(75, 6, 16, 2, 69, 69, 'Sở tài chính tính ra số tiền phải nôi còn lại,', 'Sở Tài chính', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(76, 7, 16, 2, 69, 69, 'cục thuế thông báo đóng tiền thuê đất (với phần đất thuê)', 'Cục thuế', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(77, 8, 16, 2, 69, 69, 'Cục thuế thông báo tiền SDĐ mà CĐT phải nộp', 'Cục thuế', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(78, 9, 16, 2, 69, 69, 'CĐT nộp tiền SDĐ', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(79, 7, 16, 2, 0, 0, '7. Cấp giấy chứng nhận QSDĐ cho CĐT', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(80, 1, 16, 2, 79, 79, 'CĐT đề nghị được cấp giấy CNQSDĐ tương ứng với số tiền SDĐ đã nộp', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(81, 2, 16, 2, 79, 79, 'cấp giấy CNQSDĐ cho CĐT đợt 1', 'Sở TNMT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(82, 3, 16, 2, 79, 79, 'cấp giấy CNQSDĐ cho CĐT đợt 2', 'Sở TNMT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(83, 4, 16, 2, 79, 79, 'CĐT đề nghị tách thửa', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(84, 5, 16, 2, 79, 79, 'Sở TNMT tách thửa cho chủ đầu tư để tiện bán hàng', 'Sở TNMT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(85, 8, 16, 2, 0, 0, '8. Xin phép bán nhà ở hình thành trong tương lai', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(86, 1, 16, 2, 85, 85, 'CĐT đề nghị SXD ra thông báo các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(87, 2, 16, 2, 85, 85, 'Sở xây dựng thông báo về các lô đủ điều kiện bán nhà ở hình thành trong tương lai', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(88, 9, 16, 2, 0, 0, '9. Xin phép phân lô bán nền', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(89, 1, 16, 2, 88, 88, 'CĐT gửi Sở xây dựng vv ra thông báo đủ điều kiện phân lô bán nền', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(90, 2, 16, 2, 88, 88, 'SXD có ý kiến lên UBND tỉnh', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(91, 3, 16, 2, 88, 88, 'UBND tỉnh yêu cầu SXD phối hợp kiểm tra các điều kiện phân lô bán nền', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(92, 4, 16, 2, 88, 88, 'SXD tham mưu UBND tỉnh về các điều kiện phân lô bán nền', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(93, 5, 16, 2, 88, 88, 'Bộ xây dựng cho ý kiến', 'Bộ Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(94, 6, 16, 2, 88, 88, 'UBND tỉnh ra quyết định về các lô được phân lô bán nền', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(95, 7, 16, 2, 88, 88, 'sở TNMT thông báo kiểm tra về điều kiện chuyển nhượng dưới hình thức phân lô bán nền', 'Sở TNMT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(96, 10, 16, 2, 0, 0, '10. Xin giấy phép xả thải (tùy dự án)', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(97, 1, 16, 2, 96, 96, 'UBND tỉnh cấp phép xả thải', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(98, 11, 16, 2, 0, 0, '11. Xin giấy phép xây dựng nhà ở thấp tầng', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(99, 1, 16, 2, 98, 98, 'CĐT nộp thiết kế thi công nhà thấp tầng cho SXD', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(100, 2, 16, 2, 98, 98, 'SXD phê duyệt hồ sơ thiết kế thi công nhà ở thấp tầng', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(101, 3, 16, 2, 98, 98, 'CĐT giao nhà thầu thực hiện mẫu nhà ở', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(102, 4, 16, 2, 98, 98, 'CĐT đề nghị thẩm định mẫu nhà ở LK', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(103, 5, 16, 2, 98, 98, 'SXD thông báo về kết quả thẩm định mẫu nhà ở LK', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(104, 12, 16, 2, 0, 0, '12. Xin phép xây dựng trung tâm thương mại', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(105, 1, 16, 2, 104, 104, 'CĐT nộp hồ sơ thiết kế TTTM xin thẩm định', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(106, 2, 16, 2, 104, 104, 'sở xây dựng thẩm định hồ sơ thiết kế TTTM', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(107, 3, 16, 2, 104, 104, 'CĐT xin cấp phép xây dựng', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(108, 4, 16, 2, 104, 104, 'Sở xây dựng cấp giấy phép xây dựng TTTM', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(109, 13, 16, 2, 0, 0, '13. Xin phép PCCC', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(110, 1, 16, 2, 109, 109, 'CĐT yêu cầu thẩm duyệt hồ sơ thiết kế PCCC cho hạ tầng kỹ thuật dự án', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(111, 2, 16, 2, 109, 109, 'Phòng CS PCCC Cấp giấy chứng nhận đã thẩm duyệt PCCC', 'Phòng CS PCCC', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(112, 14, 16, 2, 0, 0, '14. Nghiệm thu PCCC', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(113, 1, 16, 2, 112, 112, 'CĐT đề nghị nghiệm thu các hạng mục PCCC', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(114, 2, 16, 2, 112, 112, 'công an PCCC nghiệm thu', 'Phòng CS PCCC', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(115, 15, 16, 2, 0, 0, '15. Cấp giấy chứng nhận quyền sử dụng đất và quyền sở hữu nhà cho CĐT', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(116, 1, 16, 2, 115, 115, 'cấp giấy CNQSDĐ và quyền sở hữu nhà cho chủ đầu tư', 'Sở TNMT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(117, 16, 16, 2, 0, 0, '16. Ban hành quy định quản lý khu đô thị theo đồ án đã điều chỉnh quy hoạch 1/500', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(118, 1, 16, 2, 117, 117, 'UBND huyện xin ý kiến sở XD', 'UBND huyện', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(119, 2, 16, 2, 117, 117, 'ban hành quy định quản lý theo đồ án', 'UBND huyện', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(120, 1, 16, 3, 0, 0, 'Bàn giao lại cơ sở hạ tầng cho UBND quản lý', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(121, 1, 16, 3, 120, 120, 'CĐT đề nghị UBND tỉnh kiểm tra việc nghiệm thu hạ tầng kỹ thuật', 'CĐT', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(122, 2, 16, 3, 120, 120, 'SXD thông báo kết quả kiểm tra, chỉ ra các hồ sơ còn thiếu', 'Sở Xây dựng', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(123, 3, 16, 3, 120, 120, 'UBND tỉnh yêu cầu huyện và các sở ban nghành hỗ trợ CĐT hoàn thành nghiệm thu', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(124, 4, 16, 3, 120, 120, 'UBND huyện xin ý kiến về việc bàn giao', 'UBND huyện', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(125, 5, 16, 3, 120, 120, 'UBND tỉnh yêu cầu các sở ban ngành phối hợp nhận bàn giao hạ tầng', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(126, 6, 16, 3, 120, 120, 'UBND Huyện nhận bàn giao ngoài thực địa', 'UBND huyện', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(127, 7, 16, 3, 120, 120, 'UBND tỉnh ban hành quy định về quản lý công trình hạ tầng kỹ thuật', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(128, 8, 16, 3, 120, 120, 'Thu hồi, hủy, hồ sơ cũ', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(129, 2, 16, 3, 0, 0, 'Quyết toán thuế', '', NULL, 0, '2022-01-09 14:31:22', '2022-01-09 14:31:22'),
(130, 1, 14, 1, 0, 0, 'Khảo sát', '', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(131, 1, 14, 1, 130, 130, 'CĐT xin khảo sát, lập quy hoạch thực hiện dự án', 'CĐT', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(132, 2, 14, 1, 130, 130, 'UBND tỉnh đồng ý cho khảo sát ngoài thực địa', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(133, 2, 14, 1, 0, 0, 'lập quy hoạch 1/2000', '', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(134, 1, 14, 1, 133, 133, '1. Nhà đầu tư xin tài trợ kinh phí để lập QH 1/2000', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(135, 2, 14, 1, 133, 133, '2. SXD đề nghị huyện lấy ý kiến cộng đồng dân cư về điều chỉnh quy hoạch 1 phần 2000', 'Sở Xây Dựng', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(136, 3, 14, 1, 133, 133, 'SXD trình điều chỉnh nhiệm vụ quy hoạch 1/2000', 'sở xây dựng', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(137, 4, 14, 1, 133, 133, '4. UBND tỉnh chấp thuận chủ trương lập quy hoạch 1/2000', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(138, 5, 14, 1, 133, 133, '5. SXD trình kế hoạch lựa chọn nhà thầu lập QH 1/2000', 'sở xây dựng', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(139, 6, 14, 1, 133, 133, '6.UBND tỉnh phê duyệt kế hoạch lựa chọn nhà thầu lập QH 1/2000', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(140, 7, 14, 1, 133, 133, '7.SXD trình UBND tỉnh phê duyệt QH 1/2000', 'Sở xây dựng', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(141, 8, 14, 1, 133, 133, '8.UBND tỉnh phê duyệt điều chỉnh quy hoạch 1/2000', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(142, 3, 14, 1, 0, 0, 'xin chấp thuận chủ trương đầu tư', '', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(143, 1, 14, 1, 142, 142, '1.UBND tỉnh chủ trương giao SKHĐT chủ trì lấy ý kiến các sở ban nghành về chấp thuận CTĐT', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(144, 2, 14, 1, 142, 142, 'Sở KHĐT lấy ý kiến của các sở ban ngành', 'sở kế hoạch đầu tư', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(145, 3, 14, 1, 142, 142, 'SKHĐT báo cáo thẩm định về chủ trương đầu tư lên UBND tỉnh', 'sở kế hoạch đầu tư', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(146, 4, 14, 1, 142, 142, 'UBND tỉnh chấp thuận chủ trương đầu tư (lựa chọn nhà đầu tư)', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(147, 4, 14, 1, 0, 0, 'ký quỹ đảm bảo thực hiện dự án', '', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(148, 1, 14, 1, 147, 147, 'sở TNMT gửi thông báo yêu cầu CĐT ký quỹ thực hiện dự án', 'Sở Tài nguyên Môi trường', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(149, 2, 14, 1, 147, 147, 'nhà đầu tư xin gia hạn thời gian đóng tiền ký quỹ', 'Nhà đầu tư', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(150, 3, 14, 1, 147, 147, 'UBND tỉnh dồng ý cho gia hạn thời gian ký quỹ', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(151, 4, 14, 1, 147, 147, 'CĐT nộp tiền ký quỹ hoặc bảo lãnh thực hiện dự án', 'CĐT', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(152, 5, 14, 1, 0, 0, 'lập quy hoạch 1/500', '', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(153, 1, 14, 1, 152, 152, 'SXD trình phê duyệt nhiệm vụ quy hoạch 1/500 lên UBND tỉnh', 'sở xây dựng', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(154, 2, 14, 1, 152, 152, 'UBND tỉnh phê duyệt nhiệm vụ quy hoạch 1/500', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(155, 3, 14, 1, 152, 152, 'NĐT trình thẩm định phê duyệt quy hoạch 1/500', 'NĐT', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(156, 4, 14, 1, 152, 152, 'sở xây dựng lấy ý kiến các sở ban ngành và ubnd huyện về quy hoạch 1/500', 'sở xây dựng', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(157, 5, 14, 1, 152, 152, 'các sở ban nghành trả lời về quy hoạch 1/500', 'sở nông nghiệp, sở xây dựng,', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(158, 6, 14, 1, 152, 152, 'NĐT trình thẩm định phê duyệt đồ án điều chỉnh quy hoạch 1/500', 'NĐT', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(159, 7, 14, 1, 152, 152, 'sở xây dựng trình UBND tỉnh phê duyệt quy hoạch 1/500', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(160, 8, 14, 1, 152, 152, 'UBND tỉnh phê duyệt quy hoạch chi tiết 1/500', 'UBND tỉnh', NULL, 1, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(161, 1, 14, 2, 0, 0, 'đền bù giải phóng mặt bằng', '', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(162, 1, 14, 2, 161, 161, 'NĐT nhờ UBND huyện hỗ trợ đền bù giải phóng mặt bằng', 'Nhà đầu tư', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(163, 2, 14, 2, 161, 161, 'UBND huyện trả lời về việc hỗ trợ ĐBGPMB', 'UBND huyện', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(164, 3, 14, 2, 161, 161, 'CĐT cam kết đền bù và đưa ra mức chi phí hỗ trợ các hộ dân', '4', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(165, 4, 14, 2, 161, 161, 'kiểm đếm, xác nhận các hộ dân bị ảnh hưởng và tái sản trên đất', 'CĐT', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(166, 5, 14, 2, 161, 161, 'CĐT chuyển kinh phí đền bù GPMB', 'CĐT', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(167, 6, 14, 2, 161, 161, 'báo cáo hoàn thành công tác đền bù GPMB', 'hội đồng GPMB', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(168, 2, 14, 2, 0, 0, 'Bàn giao mặt bằng và tính tiền thuê đất', '', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(169, 1, 14, 2, 168, 168, 'CĐT báo cáo tiến độ dự án, xin bàn giao đất. ký hđ thuê đất', 'CĐT', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(170, 2, 14, 2, 168, 168, 'UBND tỉnh quyết định giao đất, cho thuê đất', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(171, 3, 14, 2, 168, 168, 'CĐT yêu cầu sở TNMT tiến hành bàn gioa đất', 'CĐT', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(172, 4, 14, 2, 168, 168, 'bàn giao đất ngoài thực địa', 'Sở Tài nguyên Môi trường', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(173, 5, 14, 2, 168, 168, 'UBND tỉnh phê duyệt giá thuê đất', 'UBND tỉnh', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(174, 6, 14, 2, 168, 168, 'cục thuế thông báo đóng tiền thuê đất (với phần đất thuê)', 'cục thuế', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(175, 7, 14, 2, 168, 168, 'CĐT nộp tiền thuê đất', 'CĐT', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(176, 3, 14, 2, 0, 0, 'cấp sổ đỏ cho chủ đầu tư', '', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(177, 1, 14, 2, 176, 176, 'CĐT đề nghị được cấp giấy CNQSDĐ cho phần đất thuê', 'CĐT', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(178, 2, 14, 2, 176, 176, 'cấp giấy chứng nhận QSDĐ', 'Sở Tài nguyên Môi trường', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(179, 4, 14, 2, 0, 0, 'xin giấy phép xây dựng hạ tầng, nước, điện etc.', '', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(180, 5, 14, 2, 0, 0, 'xin giấy phép khai thác nước ngầm', '', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(181, 6, 14, 2, 0, 0, 'đăng ký cho thuê lại (nếu để bên khác vào thuê lại xây dựng, kinh doanh dịch vụ)', '', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(182, 1, 14, 3, 0, 0, 'bàn giao', '', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(183, 2, 14, 3, 0, 0, 'quyết toán', '', NULL, 0, '2022-01-09 14:31:24', '2022-01-09 14:31:24');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
