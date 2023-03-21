-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2022 at 09:37 PM
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
-- Table structure for table `legal_process_file`
--

CREATE TABLE `legal_process_file` (
  `id` int(11) NOT NULL,
  `lp_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `legal_process_file`
--

INSERT INTO `legal_process_file` (`id`, `lp_id`, `image_id`, `title`, `url`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'QĐ 3873 UBND tỉnh Bình Định phê duyệt điều chỉnh quy hoạch 1/2000', '/storage/system/gD23h94ir6lMTNYGXUqN9oW5ocUWjPfGPg41wIjc.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(2, 3, 1, 'Sở Tài chính ý kiến về đất BVYHCT thuộc tiểu khu 1', '/storage/system/Owr5fT0TckuygZj7vRiIIsALUjE6c3JaWCv5jnXj.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(3, 4, 1, 'Sở KHĐT đề nghị các sở ban ngành cung cấp thông tin thực hiện dự án', '/storage/system/CcFSnGS44DLTIj3ELA2q1QbqZu3hRFiUnUWrpAFg.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(4, 5, 1, 'Sở Tài chính đề nghị xây dựng quy hoạch 1/500 cho Tiểu khu 1', '/storage/system/2ep876F6iJLNUDVSzP11m81QI64CjzZWeANn5jMn.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(5, 6, 1, 'Sở KHĐT đề xuất UBND tỉnh thực hiện tổ chức đấu thầu, đưa BVYHCT vào giá trị m2', '/storage/system/1z8SnkP0xrdd5TBd2jouBI7jseatAfKo4UITiQ8b.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(6, 7, 1, 'UBND tỉnh giao SXD là bên mời thầu, giao STC định giá BVYHCT để đưa vào m2', '/storage/system/XE1BU0uSZ6MqaTMSC89gpqel4JFQDy0oqNBij77O.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(7, 8, 1, 'UBND tỉnh phê duyệt giá trị tài sản BVYHCT', '/storage/system/HyLRwCUY61YU1VRMUjQAbxPH1FZVEs62hOxnAg4I.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(8, 9, 1, 'UBND tỉnh điều chỉnh cục bộ quy hoạch 1/2000', '/storage/system/2EbCS2royILmaMQ6tIXjv7RrlPUAdGURs9OnUvpc.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(9, 11, 1, 'Sở KHĐT đề nghị SXD công bố thông tin dự án, triển khai mời thầu', '/storage/system/CkA8JD1OIi8p1io1KToFRG9dj9hrC5v1QwbY4QET.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(10, 12, 1, 'UBND huyện tạm tính giá trị GPMB', '/storage/system/iClxrx2cchiabx2ujH1EvQM9lahLmoowraQnGTyL.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(11, 13, 1, 'Sở TNMT trình UBND tỉnh phê duyệt chi phí GPMB sơ bộ', '/storage/system/enQwn2kfGX1aPz0JmITKEcSPiiNcouMVPBILvjNL.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(12, 14, 1, 'UBND tỉnh phê duyệt chi phí GPMB sơ bộ', '/storage/system/lE6CWXiS6fcGthGZSDie1Cr2tFEl83E3OKrsy5MH.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(13, 15, 1, 'Sở Tài chính tạm tính giá sàn m3', '/storage/system/wZmhxPYUalCUjVVXa0RjsHZT07Mr4oyJtaCitiEA.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(14, 16, 1, 'Sở KHĐT đề nghị UBND tỉnh phê duyệt danh mục dự án có sử dụng đất', '/storage/system/0aN6RbzMJThnJXeJvNIrctZIZzu9XES45mbFafp3.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(15, 17, 1, NULL, '/storage/system/Q623iCTOqZnk9d4cYQlHNZrxkzG30fyjIRN06LN5.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(16, 18, 1, NULL, '/storage/system/WvzVPLg9zJFQn0Nn6g2lBQxLV55bo4qfCYzYkajp.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(17, 19, 1, NULL, '/storage/system/jV1gm74gh0ad1T8b0sObX29iCb5jfcUGj4CLa4Ae.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(18, 20, 1, NULL, '/storage/system/gmNXtIAp9blZtXGES2iSgK1Cyx0SNX9sGvClXVmA.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(19, 22, 1, NULL, '/storage/system/tIiD88cIHg4SPG15wb0FSfjll6TD34p5H67LWHkM.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(20, 23, 1, '2. Sở KHĐT lấy ý kiến thẩm định dự án, chấp thuận chủ trương đầu tư', '/storage/system/DdTaUfvYbm1l290BPfb7nPF1K7jGlbeLiQOftppk.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(21, 23, 2, 'Ý kiến của Sở Xây dựng', '/storage/system/8awcX6upCsYXlKccjt62W7MUtlb8L7rlkK2CaMqr.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(22, 23, 3, 'Ý kiến của Sở Tài chính', '/storage/system/PH5KIImtKaiEbgQ1sueZnaQoAI0KGrx0jZ2wyqDL.pdf', '2022-01-09 14:31:21', '2022-01-09 14:31:21'),
(23, 134, 1, '2019.06.28-96-CV-TTVN vv tài  trợ kinh phí  lập QHPK 1.2000', '/storage/system/764uB7xB9r3KwMY8Eq2rDEVLVh15R2DJ4h459P3r.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(24, 135, 1, '2019.06.06-946-SXD-QHKT đề nghị huyện lấy ý kiến về đ.c QHPK', '/storage/system/kGdvW4Oc3LoAouPVXS79r0Mj07OMMLO9AtAnuMoe.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(25, 135, 2, 'Biên bản họp lấy ý kiến dân cư', '/storage/system/nMRX0jsxup6dd7acREiHBWy22RxHuYWH7P9frTOx.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(26, 136, 1, '2019.07.30-191-TTr-SXD Trình đ.chỉnh NVQH phân khu 1.2000(42ha)', '/storage/system/ECflqLLuYW0ndWsSq4e3xH6sH3MCHwfLHm2TIFWA.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(27, 137, 1, NULL, '/storage/system/Z9zBcFPAvurJP5rJPFGxAS9iPGwLAeOBVuMpVQzh.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(28, 138, 1, NULL, '/storage/system/EG1cYQOFVa0vPp1RoGIzgtdFrJhJeBP4OQfSoynK.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(29, 139, 1, NULL, '/storage/system/QamHN32nmcmVNJOmGKJnNKNtU5CIWf0I6l8twBM0.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(30, 140, 1, NULL, '/storage/system/DUMa0VIDxcPIxlfFkF46iRduRxZgtmiyjxOUrsZu.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(31, 141, 1, NULL, '/storage/system/ExZYQ6pO0CggWgxZ4CLMcozi9pcg9qMrbzfPnKtG.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(32, 143, 1, NULL, '/storage/system/yLuyv9EDaGmYEcNaiV9eZr2tJTzDAoraaXWc1ntB.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(33, 144, 1, NULL, '/storage/system/5SECIibPYytrBQjFa14ThE9J6BeoQ5pYVsjFWZX9.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(34, 144, 2, 'Các sở ban nghành trả lời', '/storage/system/nAj3izmTrmM0fc8XKscukdos1juHrcNmR03tvQJk.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(35, 144, 3, 'các sở ban nghành trả lời', '/storage/system/IdgXQbnxfTp3mAqp4Gst46sXh9P72M35ybPDmYDr.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(36, 144, 4, 'các sở ban nghành trả lời', '/storage/system/eI620R2Pib8S7oLMxdrm8rfY9yQQ1mJzVbVHfosk.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(37, 144, 5, 'các sở ban nghành trả lời', '/storage/system/0pvO6jgzw3tzGuWmLJ9VVz0yrwY0aG5jRt9YdcEu.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(38, 144, 6, 'các sở ban nghành trả lời', '/storage/system/4aMt9Vgf1TisINZuUHTQPk2072YDJ0mEhpYykTPH.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(39, 144, 7, 'ý kiến cộng đồng dân cư', '/storage/system/7iaeNh56nJGSYbJUG7rg7cTRltm2PaHATmxUewAy.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(40, 144, 8, 'ý kiến của cộng đồng dân cư', '/storage/system/DcQosMDFm9mst708tQuXhSLRWOt6y05wglFzd6Nz.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(41, 144, 9, 'ý kiến của ủy ban nhân dân huyện', '/storage/system/r8nFd6alFE8HykzKUu4Y3mB3aqENuqzDwhVymyZP.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(42, 144, 10, 'ý kiến sở tài chính', '/storage/system/cctKR7sNZw0VzsA4e1l8lgzXAQTa23A5d8MKLIra.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(43, 144, 11, 'ý kiến sở du lịch', '/storage/system/543fMZoHWygP06hiM2b1eucna4fU2uMefRZahA86.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(44, 144, 12, 'ý kiến ủy ban nhân dân huyện', '/storage/system/aRQe9VJR92S6jDvDhAZEB1sWWPFGGxceuucIb3vj.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(45, 145, 1, NULL, '/storage/system/jr31bqDktc4463uB2D7lveQXngZkszwQgbm1osH6.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(46, 146, 1, NULL, '/storage/system/4FkWj93HoQU1GP2Em0U07TVAjOquNccV3uWUZhyv.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(47, 148, 1, NULL, '/storage/system/2fLRxtFiI2TRTBJmVg16CaUbg1RgzyND9ih81Hct.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(48, 149, 1, NULL, '/storage/system/O0tNMwdojyjmoqJ1AOtGh14rldmGWM25Z9UJPCzm.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(49, 150, 1, NULL, '/storage/system/ErR3dVEEvi3ddQs54HNNuK996le70rj2f1h5p2PL.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(50, 153, 1, NULL, '/storage/system/lZyrzygQGEAX4lxPbzJOyvuaRuNUqUXzH46183Je.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(51, 154, 1, NULL, '/storage/system/6T5Bo9nYUAvOGHflBS4P8ZtiXXA2R3neo5Rx4ESZ.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(52, 155, 1, NULL, '/storage/system/4kCBWEyWcUj9eHZ7cGVc8F4zB9AvhzKu5i0sQ1SQ.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(53, 156, 1, NULL, '/storage/system/ssR8Zd4RFJvTy6efiviRG4vgPWuwqxHMkdUvH4Ga.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(54, 156, 2, 'trả lời của sở nông nghiệp', '/storage/system/L9CXfzb79PsI959e8Hacrh1mR4YNUVsdfTeOAmKJ.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(55, 156, 3, 'trả lời của sở xây dựng', '/storage/system/Rrc7CAdHP9WjWOBR55GmNK5YHWTivEAOeIoAanj4.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(56, 157, 1, NULL, '/storage/system/xGORPAEZkWgUiR0Ps5mI9snT4MmnwlodwDtkA2L3.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(57, 157, 2, NULL, '/storage/system/XjvrmR29xUIPdax7qqWHkwwCRoufbBnraoMzbS0r.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(58, 158, 1, NULL, '/storage/system/iw86jdZJKeMBENKseTgThcdmybBHSJP1sFHQ18LR.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(59, 159, 1, NULL, '/storage/system/IKGYVObHlhOyV7bmpxBN4xTphFjfjm41OpbGcLkq.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(60, 160, 1, NULL, '/storage/system/UtFUXxm4PGbx3uBWxAHoQrjMiTxtESDCeBDu1KFY.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(61, 162, 1, NULL, '/storage/system/yMZeC6Rhyc2hXNnoN7HRqnw12aF186hSku6PIz3d.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24'),
(62, 163, 1, NULL, '/storage/system/x4KPkgwZxjJEKMIrnSHBE3BYDmCu5UOAQRszuOwW.pdf', '2022-01-09 14:31:24', '2022-01-09 14:31:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `legal_process_file`
--
ALTER TABLE `legal_process_file`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `legal_process_file`
--
ALTER TABLE `legal_process_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
