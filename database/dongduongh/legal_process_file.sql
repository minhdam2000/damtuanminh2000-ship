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
(1, 2, 1, NULL, '/storage/system/W8PsGWNbjeodYB5pyHysscioYn3LPBjroEYnWns1.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(2, 3, 1, NULL, '/storage/system/ciamktjG0XLgBeyUzC2VMJ29XefBNzN40lbGIfWA.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(3, 5, 1, NULL, '/storage/system/m2aNkleE7lxE63xV8dDdlalxwev8R6yEdveJxbGx.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(4, 6, 1, NULL, '/storage/system/LhIBqpiNrLxmWi4xea4OZaPEtBV9NNnKmFCaHJ0r.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(5, 7, 1, NULL, '/storage/system/6lCp2E5d6y6ghGcIiWNAgL0Ig6q6cNaRjzEepNY6.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(6, 8, 1, NULL, '/storage/system/NiMTT9U8KMGhuqCOhp5k2DHDTCfSvQbFR9i93GER.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(7, 9, 1, NULL, '/storage/system/20T45AWkXnelZq9JLDAPiZnDnlZQnVODPCfCFbnU.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(8, 10, 1, NULL, '/storage/system/fEFHzK757Cr0MRH0MPANMjZrMxQkwdFhSeEZSPZR.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(9, 11, 1, NULL, '/storage/system/QKVx8rZAIj7mujBpcelQcM4oNqGDg85oWP9G8ejs.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(10, 12, 1, NULL, '/storage/system/9jjbu8r3iZAO2u9OrdS6jFGFTXAxezcHo9KABjDj.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(11, 13, 1, NULL, '/storage/system/2YXFsGPwXXX5xBYW16ldAG9eMawEE4ICFANkssac.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(12, 14, 1, NULL, '/storage/system/zYfwSqfug4QNlOBR0SttPdY3UieISsj0nOq9iPEu.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(13, 15, 1, NULL, '/storage/system/fyZCgFCx2F5rKt1MPFW7CQb1Vb2HyU8D5RYBeA8Y.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(14, 16, 1, NULL, '/storage/system/XR8h7ytyYFDmPtfpq2QuIk8EUyg4pA1oo6WuXJ1X.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(15, 17, 1, NULL, '/storage/system/I6P1Gfg3HH0YGKzbnT8el20DaZ9QWsJ7CHuRJKEo.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(16, 18, 1, NULL, '/storage/system/RkKTy2DqQiEZuLAIlzcDNhTfxrNHHn6LhQpDP79C.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(17, 19, 1, NULL, '/storage/system/QZGvOab4s2zVKwvm0chThLUs8OP8c9enDYbDadcn.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(18, 23, 1, NULL, '/storage/system/YWyg1b62cJSzDyfJAIpTEXWf1fweTSIFoKvR6fes.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(19, 24, 1, NULL, '/storage/system/I96t4OLl89bNY41N4LCC3RWP2a4smKhqOlkPWpB5.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(20, 25, 1, NULL, '/storage/system/xlruqENwHYByKc1uwwl1aCcVxCtH8yrfP2XZ9KoG.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(21, 28, 1, NULL, '/storage/system/FDJ5CZLjLQ4Oct2xlGvJu6lIs9JxOdgm2X6m74iz.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(22, 29, 1, 'UBND huyện rà soát và trình các diện tích cần chuyển đổi', '/storage/system/CRf0s9O6PBBIfXibU4Uc22S6FSfMmxNrKQMBqphb.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(23, 30, 1, NULL, '/storage/system/waCmsXF64EvqDHcPO45oIgl4h4vtkevCD17tNvRJ.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(24, 31, 1, NULL, '/storage/system/he8TxKSyPLivnNXIOQrhDQUHtvMBpVMV1YgdeGEN.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(25, 32, 1, NULL, '/storage/system/ctNh55rHldwbW8wCOj76IPOOC4fyrXHASIDip1om.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(26, 35, 1, NULL, '/storage/system/Z56UUuXlfWXxeE1A7S0TgJuxB30LPurDe8iJS5xo.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(27, 36, 1, NULL, '/storage/system/tahrpqOEfH26P9jihujpd7tPuGLsEQMgJO1hfGsd.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(28, 37, 1, NULL, '/storage/system/3ZIY7eeSQUE43Cm2EoT0inEseo2ltMmQkYxMir3p.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(29, 38, 1, NULL, '/storage/system/cNA3AhRyttspgFuZFEsheZPhc6A33NjUzARgUlqt.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(30, 39, 1, NULL, '/storage/system/uBNc18BAUza6vtnCUDvwPqTlULhD0XnFWUDLvCzx.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(31, 40, 1, NULL, '/storage/system/aBn7drLVxtch0PZagSONmDb5IW3Mx1U44uIEc8vi.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(32, 41, 1, NULL, '/storage/system/ccEMCOAOTCzxrzB4ipVKMNqNwSQZI9wbi7te34I3.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(33, 42, 1, NULL, '/storage/system/eeRKhcVSsd9UTpKbwJeKelngUMTLFM07O0KHLWIC.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(34, 44, 1, NULL, '/storage/system/IGXzV70wMTcpsogfruajPfNkzeLhfIhXg82I483z.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(35, 45, 1, NULL, '/storage/system/O8B5OYUd18WBjrFBJLtNwBsEH0ika57ytMVMY0Cn.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(36, 46, 1, NULL, '/storage/system/yANDqQXNs0oa5L2tTNleWSnIrAorrvCjW8QePQP8.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(37, 47, 1, NULL, '/storage/system/l9mRAGzTAgXcVAfy0s3bp3kLthnTveEbyW5Ec8Bm.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(38, 49, 1, NULL, '/storage/system/JkETkvjKPrMVkcWXp67C4XcRRSUQNRgMVBBbXCxo.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(39, 50, 1, NULL, '/storage/system/7YInLQvLq0zc9jmJMvjVfgtHU6mMZkUz0AkoBTFx.pdf', '2022-01-09 13:49:25', '2022-01-09 13:49:25'),
(40, 52, 1, NULL, '/storage/system/ri9mLKkRjU8jbotwSLTenfu6SJCIwO6NpZUbDl5x.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(41, 53, 1, NULL, '/storage/system/TJbl77BGDdW1REllFebPeEMnzOfVqZw529XHlAv5.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(42, 54, 1, NULL, '/storage/system/wixPoRO4om0quzmUgRv8BgTsCrt8ttIjtDY8OC69.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(43, 55, 1, NULL, '/storage/system/ns4JfHBKUiZpv62guXO62A52NhNNWoMbBnO85egx.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(44, 57, 1, NULL, '/storage/system/5EPZYwnS1iuO6tbl1CPxKiwEne2MCkEClEsQojxy.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(45, 58, 1, NULL, '/storage/system/wvppg59zuw3QJ8nEUpvW1uwaHVyOHiTzAfeSvNq7.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(46, 60, 1, NULL, '/storage/system/qRRYUNuFazTMCM3mbh5YnkatXSDjgUkaL1Wbj9Nn.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(47, 61, 1, NULL, '/storage/system/rG1WtGmR69HKTJVsZkeZVKdC4YNDbOXXavEI3T0b.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(48, 62, 1, NULL, '/storage/system/RkK4zNWkuErtAHL7frmXseCoh3osowXQX56rTxz6.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(49, 63, 1, NULL, '/storage/system/PXy9QrZbBnIxpcZjAPIudWEnUrqSezYCqRGEtnk8.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(50, 65, 1, NULL, '/storage/system/0rNsG5DWFfroL0KfSUJtVxeT5txVKNIQhpj0KdEk.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(51, 66, 1, NULL, '/storage/system/tcrpi543KKdsSzUPsnunv7hEVhaKEFyl2KicwMe8.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(52, 67, 1, NULL, '/storage/system/5zNVhHMD9rG7zryLoXY0PhlmSxYDbsN1PWMXU3XK.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(53, 69, 1, NULL, '/storage/system/d514lvviqG0IzEF9nu7RD8AHAlmUwmb6H5IOx3pZ.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(54, 70, 1, NULL, '/storage/system/BJF78C767rEsZSZ8tXlcarVmZAUFEj7t7Mz04BLy.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(55, 71, 1, NULL, '/storage/system/RBRYP5iyrtqqmF9HGxijxDU760N7KUIlhhZofrfZ.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(56, 72, 1, NULL, '/storage/system/AaQ2PNNdOEMEN5PpI7XkNstXoT3b4z1fKL9zVX7O.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(57, 73, 1, NULL, '/storage/system/lOQIdzLQHhkHW2vskGEiUb6bTeVYC6p8Fwnm0jb4.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(58, 74, 1, NULL, '/storage/system/g2GjZxcJKEqQDyd20LXTLTQr3OBF84MGjt0mxX4Y.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(59, 75, 1, NULL, '/storage/system/pctV4fdI5jupk0eRgnqr8i3xwFC3AN8Bosxou284.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(60, 77, 1, NULL, '/storage/system/QHcXZ1nwtjIXn3IqGhsbCDBZNFEgURIEszUqAEcV.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(61, 78, 1, NULL, '/storage/system/DNxKxIw1teCnayWofYRsApwlseCOQk4s0VtUXJHu.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(62, 79, 1, NULL, '/storage/system/oEtxKbtceFo7pae0ptdEtT5Iy5wV4bD5GUNg8kSE.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(63, 80, 1, NULL, '/storage/system/EzdWmGX9SbAeKJfYZggW144YpesCmU9ozmZYprqC.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(64, 81, 1, NULL, '/storage/system/MbSCAlMaeSAcveGR5je9qa1cONPLFRT0hush13qZ.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(65, 82, 1, 'Sở tài chính tính ra số tiền phải nộp còn lại,', '/storage/system/D9Nuku3YvPIZ0Fv7V8xTCn4YL2lLUNTu1Vo5uEfD.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(66, 83, 1, NULL, '/storage/system/Wmf5CZ35lwQFUPoknYK49oLr2carJ0LRQVzqSix9.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(67, 84, 1, NULL, '/storage/system/wi7g4p0AIyY3wRpYs2dM4sORpS2CIYC5GSeDBMgG.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(68, 87, 1, NULL, '/storage/system/Xhc0AofwJuinzEClSMX77yWiLyujoQrPrslmXs3V.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(69, 88, 1, NULL, '/storage/system/lVqUm0RBgbG8LnLrzJLg1ceWbJTTngu6OZy4RkSc.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(70, 89, 1, NULL, '/storage/system/zk8hSnIzTdGjN3MhopAbcwi3FuOUxWPU7nIlIHuM.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(71, 90, 1, NULL, '/storage/system/3SuIjeLUYTM76CcRLiqv9tNMt20eWu3ScwS6tZ2T.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(72, 91, 1, NULL, '/storage/system/vyYkYokczJKHU9qJlJu8v072KUP6Si8FZBSKGT3m.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(73, 93, 1, NULL, '/storage/system/fv9NnUFGBlEtfJKNjSGe0CN7XjUlVUiZNvqJ6JOr.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(74, 94, 1, NULL, '/storage/system/cGjXu9uPl4amgZlQeyf1JuTXDp2FpKEbdzdinURX.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(75, 96, 1, NULL, '/storage/system/hzdoNKoz1m04dzTbR0MdNFU9sVpyAE594E9DnvJt.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(76, 97, 1, NULL, '/storage/system/CNjjRewabBnxifYmObeHuG5gkqefYcBZcWamN7oX.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(77, 98, 1, NULL, '/storage/system/5ndeFPgT8pyhDIbWlmnitGREVpko4HkyUY9TEorr.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(78, 99, 1, NULL, '/storage/system/9SOOYOvCOlkpTDZX8wllHzfITaE1mFSUfKn9SApY.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(79, 101, 1, NULL, '/storage/system/SaQmrLgg11ahZvNslaUvvr7j7pXS5FYoXDUW98mT.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(80, 102, 1, NULL, '/storage/system/ZXMFZf7Gf9T9d1fIDxG6ec9k4HkhZCOl8rWTC8RW.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(81, 104, 1, NULL, '/storage/system/ZwRET75ayq6uzVuBlh36Lj6Mxv3L68TNGszsmatc.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(82, 107, 1, NULL, '/storage/system/8Ek1dmWFbEJQYE8kxIbmzR1rktB7mtHX9sEINkPW.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(83, 109, 1, NULL, '/storage/system/qkuaMEK2kbV1TChJdalNOfi2ISHAKxW3RFHlaIjq.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(84, 110, 1, NULL, '/storage/system/9HZyGYcbcyBni2D3mDgU4H5JfwNLveGmpYHzEW9h.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(85, 113, 1, NULL, '/storage/system/93IeePioYYWEUUdlIoHEKwviHAqALre7u6XlThlS.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(86, 115, 1, NULL, '/storage/system/j4OJfjIL3IiilatMLpD8Qnk6yE27ulk46yFUqtaR.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(87, 118, 1, NULL, '/storage/system/DTZmEOIqywvQS5JWAcZ9V1wT55yaH9OclCubchZj.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(88, 120, 1, NULL, '/storage/system/q99mZ04kPUNeSmXnBazdKNtnPF6vaj7Pb1xWfjAo.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(89, 121, 1, NULL, '/storage/system/HezXA1FlieoIznvKAlyC72BB1AtawFcRuQFFHmyh.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(90, 123, 1, NULL, '/storage/system/PLCn53R1FFf7bhGyjo7oP438uLeWzkKXwl7WHvlO.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(91, 126, 1, NULL, '/storage/system/n7d29R7yLzaRS8FYtVG3z0jQHfQapz2DIWhYiaxQ.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(92, 127, 1, NULL, '/storage/system/vI2gDMnC9ZlzKRIuauLsLAswsludadjwVWFndUSK.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(93, 128, 1, NULL, '/storage/system/Wg92RrGk0S2btL6OEzRmILpj9iH1KnezNbUcWisn.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(94, 129, 1, NULL, '/storage/system/hw7vdhcv0ETSfdMpzWarWPHMdssEv6UJz4Ym05wE.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(95, 131, 1, NULL, '/storage/system/WfRJrxs0CPeIyyZ1TcEEBFXritgeYgk1bqFV4IUz.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(96, 132, 1, NULL, '/storage/system/Mn3JKF8ctjyHPsgkAQDIejzbqU3ZqjWpxJYRwHtj.pdf', '2022-01-09 13:49:26', '2022-01-09 13:49:26'),
(97, 135, 1, NULL, '/storage/system/zA9TmDQSzOmNERFfSoCKO1YVnH7js1FXOCxcGuTI.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(98, 136, 1, NULL, '/storage/system/1OX7GeLnP91csvLrYu1nKYLKgjxwI2QhnM3kGGIi.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(99, 137, 1, NULL, '/storage/system/ILsNOo4nTiq1GMsRNj06iOsgbDFeETkuueP1vaQC.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(100, 138, 1, NULL, '/storage/system/lS3RgotvMioDJSFv870NkT5uXLNAKf9hZdkE8eAZ.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(101, 139, 1, NULL, '/storage/system/zFMdJA5VLhpcwZu6EvzYCIgXYCpK56O0COvChZRu.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(102, 140, 1, NULL, '/storage/system/8ebI2ED6gpnxyegI4I41ZGMKFUO6nyYY1qXFSyXr.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(103, 140, 2, 'hồ sơ nhiệm vụ khảo sát lập quy hoạch', '/storage/system/dAaAYGQMyO35W3rhIdviTZYb2zbzmFjgQkLZtOM2.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(104, 141, 1, NULL, '/storage/system/0CROt1K7Ei95Wv1LidUUhKLB3TtU1tI8bbG6ZLMu.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(105, 141, 2, 'hồ sơ nhiệm vụ quy hoạch chi tiết xây dựng 1/500', '/storage/system/HSvzF79jMraBXTs0mnPojfNhoLJs0768Gwhv3quZ.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(106, 142, 1, NULL, '/storage/system/JEGgzsnQ6DEpXz2gLWj0ysM0Dkdwi7xln9e4RgOy.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(107, 143, 1, NULL, '/storage/system/wFOph2AGrettXQZBGq19cKljP83L8sOlbHBo3fR7.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(108, 144, 1, NULL, '/storage/system/pNtUetzutjGenp7VIc9CkShqcJgRyr8M014bSJ2w.pdf', '2022-01-09 13:55:36', '2022-01-09 13:55:36'),
(109, 171, 1, NULL, '/storage/system/3ySMn6QPcf0wgPSqEkR28JvTI0nhRAl0zASgN8zE.pdf', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(110, 172, 1, NULL, '/storage/system/HESJifvjaC5SaihomPrvZhwFk1AbTMsL5tlixezs.jpg', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(111, 173, 1, NULL, '/storage/system/vIXVydsf2OhTAEdPPsFqFnaycwrnEB5NiyQVyuTE.pdf', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(112, 174, 1, NULL, '/storage/system/sLa41qEz7j0dwgOXa1LUSzRQPzDqu9d6fpV8XR0y.jpg', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(113, 176, 1, NULL, '/storage/system/LFNJHRkdGQxAc0X75WogTgS8q767s8Dq3FCBpfRi.pdf', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(114, 177, 1, NULL, '/storage/system/sQBA35fcIeOG0ZLZTyyJ19bMp62yy7lBSu5XOIJv.jpg', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(115, 178, 1, NULL, '/storage/system/xLVN8JJQmuDUAZM1D4eZzyRvGyrqsgMzCMqoKgDA.pdf', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(116, 180, 1, NULL, '/storage/system/FqWC4JwZadVK0rS7mEUmjOIwMeVuUueCTpladnXj.pdf', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(117, 181, 1, NULL, '/storage/system/ORsGyPXXAqO8h7HMOvuWh9163IHUhhrwmhIkhFNQ.pdf', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(118, 182, 1, NULL, '/storage/system/gu4nNmucTMa83rMUoFyqS1ZvElR3hvmGdeXpHdeG.pdf', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(119, 184, 1, NULL, '/storage/system/IHsRgG7sibD8jJEoaOQgJqU6s3JFbCrZW94uNnR7.pdf', '2022-01-09 13:55:39', '2022-01-09 13:55:39'),
(120, 186, 1, NULL, '/storage/system/VPx8eT2IcHixNFpSbk1EiNTmgq3rmo4H2DYIVnZa.docx', '2022-01-09 13:55:39', '2022-01-09 13:55:39');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
