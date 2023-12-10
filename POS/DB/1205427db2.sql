-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 01, 2023 lúc 03:37 PM
-- Phiên bản máy phục vụ: 10.3.22-MariaDB-log
-- Phiên bản PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `1205427db2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_category`
--

CREATE TABLE `db_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_category`
--

INSERT INTO `db_category` (`id`, `name`, `slug`, `created_at`) VALUES
(1, 'Ăn vặt', 'apple', '2019-05-22 16:15:39'),
(20, 'Nước uống', '', '2023-11-26 18:31:57'),
(21, 'Trà Sữa', '', '2023-11-26 18:33:27'),
(22, 'Soda', '', '2023-11-29 03:21:56'),
(23, 'Sinh tố', '', '2023-11-29 03:22:09'),
(24, 'Cafe', '', '2023-11-29 03:23:06'),
(25, 'Trà', '', '2023-11-29 03:23:15'),
(26, 'Best Seler', '', '2023-11-29 13:20:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_customer`
--

CREATE TABLE `db_customer` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(13) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_customer`
--

INSERT INTO `db_customer` (`id`, `fullname`, `address`, `phone`, `email`, `created`) VALUES
(67, 'Nông Nguyễn Bảo Trung', 'Vĩnh Long', '0774082908', 'trung@gmail.com', '2022-11-04 00:00:00'),
(75, 'Khách Lẻ', '', '', '', '2022-12-08 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_order`
--

CREATE TABLE `db_order` (
  `id` int(11) NOT NULL,
  `orderCode` varchar(8) CHARACTER SET utf8 NOT NULL,
  `userid` int(10) NOT NULL,
  `customerid` int(11) NOT NULL,
  `orderdate` text COLLATE utf8_unicode_ci NOT NULL,
  `total_billding` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_checkout` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_order`
--

INSERT INTO `db_order` (`id`, `orderCode`, `userid`, `customerid`, `orderdate`, `total_billding`, `sale`, `total_checkout`) VALUES
(124, 'HDeb02d', 13, 75, '2023-12-01 20:31:37', '80000', '0', 80000),
(125, 'HD947ca', 13, 75, '2023-12-01 20:31:55', '20000', '0', 20000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_orderdetail`
--

CREATE TABLE `db_orderdetail` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `count` int(10) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_orderdetail`
--

INSERT INTO `db_orderdetail` (`id`, `orderid`, `productid`, `count`, `price`) VALUES
(199, 124, 54, 2, 40000),
(200, 124, 73, 1, 20000),
(201, 124, 56, 1, 20000),
(202, 125, 54, 1, 20000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_product`
--

CREATE TABLE `db_product` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `images` varchar(255) CHARACTER SET utf8 NOT NULL,
  `detail` text CHARACTER SET utf8 NOT NULL,
  `price` int(255) NOT NULL,
  `created` text COLLATE utf8_unicode_ci NOT NULL,
  `created_after` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_product`
--

INSERT INTO `db_product` (`id`, `catid`, `name`, `images`, `detail`, `price`, `created`, `created_after`) VALUES
(52, 21, 'Trà sữa matcha M', 'uploads/', '', 20000, '2023-11-29 03:23:49', ''),
(53, 21, 'Trà sữa matcha L', 'uploads/', '', 25000, '2023-11-29 03:24:23', ''),
(54, 21, 'Trà sữa truyền thống M', 'uploads/', '', 20000, '2023-11-29 03:24:48', ''),
(55, 21, 'Trà sữa truyền thống L', 'uploads/', '', 25000, '2023-11-29 03:25:12', ''),
(56, 25, 'Trà đào M', 'uploads/', '', 20000, '2023-11-29 03:25:42', '2023-11-30 17:20:13'),
(57, 25, 'Trà đào L', 'uploads/', '', 25000, '2023-11-29 03:26:28', '2023-11-29 03:27:20'),
(58, 24, 'Cafe đá', 'uploads/', '', 15000, '2023-11-29 03:27:22', ''),
(59, 24, 'Cafe sửa', 'uploads/', '', 20000, '2023-11-29 03:27:53', ''),
(60, 22, 'Soda chanh dây M', 'uploads/', '', 20000, '2023-11-29 03:28:13', ''),
(61, 22, 'Soda chanh dây L', 'uploads/', '', 25000, '2023-11-29 03:28:48', ''),
(62, 22, 'Soda bạc hà M', 'uploads/', '', 20000, '2023-11-29 03:29:07', ''),
(63, 22, 'Soda bạc hà L', 'uploads/', '', 25000, '2023-11-29 03:29:29', '2023-11-29 03:30:55'),
(64, 1, 'Xiêng nướng', 'uploads/', '<p>10k / 1xi&ecirc;ng</p>\r\n', 10000, '2023-11-29 03:29:48', ''),
(65, 21, 'Trà sữa thái M', '', '', 20000, '2023-11-23 12:33:55', ''),
(66, 21, 'Trà sữa thái L', '', '', 25000, '2023-11-23 12:33:55', ''),
(67, 21, 'Trà sữa khoai môn M', '', '', 20000, '2023-11-23 12:33:55', ''),
(68, 21, 'Trà sữa khoai môn L', '', '', 25000, '2023-11-23 12:33:55', ''),
(69, 21, 'Trà sữa trân châu đường đen M', '', '', 20000, '2023-11-23 12:33:55', ''),
(70, 21, 'Trà sữa trân châu đương đen L', '', '', 25000, '2023-11-23 12:33:55', ''),
(71, 21, 'Sữa tươi trân châu đường đen M', '', '', 20000, '2023-11-23 12:33:55', ''),
(72, 21, 'Sữa tươi trân châu đương đen L', '', '', 25000, '2023-11-23 12:33:55', ''),
(73, 21, 'Sữa tươi matcha đường đen M', '', '', 20000, '2023-11-23 12:33:55', ''),
(74, 21, 'Sữa tươi matcha đương đen L', '', '', 25000, '2023-11-23 12:33:55', ''),
(75, 21, 'Trà sữa ván phô mai M', '', '', 20000, '2023-11-23 12:33:55', ''),
(76, 21, 'Trà sữa ván phô mai L', '', '', 25000, '2023-11-23 12:33:55', ''),
(77, 21, 'Trà sữa bóng đêm M', '', '', 20000, '2023-11-23 12:33:55', ''),
(78, 21, 'Trà sữa bóng đêm L', '', '', 25000, '2023-11-23 12:33:55', ''),
(79, 21, 'Trà sữa socala M', '', '', 20000, '2023-11-23 12:33:55', ''),
(80, 21, 'Trà sữa socala L', '', '', 25000, '2023-11-23 12:33:55', ''),
(81, 21, 'Trà sữa bạc hà M', '', '', 20000, '2023-11-23 12:33:55', ''),
(82, 21, 'Trà sữa bạc hà L', '', '', 25000, '2023-11-23 12:33:55', ''),
(83, 21, 'Trà sữa trân châu olong M', '', '', 20000, '2023-11-23 12:33:55', ''),
(84, 21, 'Trà sữa trân châu olong L', '', '', 25000, '2023-11-23 12:33:55', ''),
(85, 25, 'Trà tắt xí muộ M', '', '', 20000, '2023-11-23 12:33:55', ''),
(86, 25, 'Trà tắt xí muộ L', '', '', 25000, '2023-11-23 12:33:55', ''),
(87, 25, 'Trà tắc, đá me M', '', '', 20000, '2023-11-23 12:33:55', ''),
(88, 25, 'Trà tắc, đá me L', '', '', 25000, '2023-11-23 12:33:55', ''),
(89, 25, 'Hồng trà trân châu M', '', '', 20000, '2023-11-23 12:33:55', ''),
(90, 25, 'Hồng trà trân châu L', '', '', 25000, '2023-11-23 12:33:55', ''),
(91, 25, 'Trà (atiso, chanh dây) M', '', '', 20000, '2023-11-23 12:33:55', ''),
(92, 25, 'Trà (atiso, chanh dây) L', '', '', 25000, '2023-11-23 12:33:55', ''),
(93, 25, 'Trà đào kem sữa M', '', '', 20000, '2023-11-23 12:33:55', ''),
(94, 25, 'Trà đào kem sữa L', '', '', 25000, '2023-11-23 12:33:55', ''),
(95, 22, 'Soda việt quốc M', '', '', 20000, '2023-11-23 12:33:55', ''),
(96, 22, 'Soda việt quốc L', '', '', 25000, '2023-11-23 12:33:55', ''),
(97, 22, 'Soda dâu tầm M', '', '', 20000, '2023-11-23 12:33:55', ''),
(98, 22, 'Soda dâu tầm L', '', '', 25000, '2023-11-23 12:33:55', ''),
(99, 22, 'Soda đào M', '', '', 20000, '2023-11-23 12:33:55', ''),
(100, 22, 'Soda đào L', '', '', 25000, '2023-11-23 12:33:55', ''),
(101, 22, 'Soda blue M', '', '', 20000, '2023-11-23 12:33:55', ''),
(102, 22, 'Soda blue L', '', '', 25000, '2023-11-23 12:33:55', ''),
(103, 24, 'Cafe sữa', '', '', 20000, '2023-11-23 12:33:55', ''),
(104, 24, 'Cafe bọt biển', '', '', 20000, '2023-11-23 12:33:55', ''),
(105, 24, 'Cafe muối', '', '', 25000, '2023-11-23 12:33:55', ''),
(106, 24, 'Cafe pha phin', '', '', 20000, '2023-11-23 12:33:55', ''),
(107, 24, 'Bạc xỉu', '', '', 20000, '2023-11-23 12:33:55', ''),
(108, 20, 'Yaourt việt quốc', '', '', 25000, '2023-11-23 12:33:55', ''),
(109, 20, 'Cacao sữa đá', '', '', 25000, '2023-11-23 12:33:55', ''),
(110, 20, 'Hồng trà', '', '', 20000, '2023-11-23 12:33:55', ''),
(111, 20, 'Sâm dứa sữa', '', '', 25000, '2023-11-23 12:33:55', ''),
(112, 20, 'Đá xay vị (matcha,...)', '', '', 25000, '2023-11-23 12:33:55', ''),
(113, 20, 'Thêm topping', '', '', 5000, '2023-11-23 12:33:55', ''),
(114, 20, 'Thêm kem chesse', '', '', 10000, '2023-11-23 12:33:55', ''),
(115, 1, 'Trâu gác bếp M', '', '', 45000, '2023-11-23 12:33:55', ''),
(116, 1, 'Trâu gác bếp L', '', '', 90000, '2023-11-23 12:33:55', ''),
(117, 1, 'Thịt chua TT M', '', '', 35000, '2023-11-23 12:33:55', ''),
(118, 1, 'Thịt chua TT L', '', '', 70000, '2023-11-23 12:33:55', ''),
(119, 1, 'Thịt chua ống nứa TT M', '', '', 40000, '2023-11-23 12:33:55', ''),
(120, 1, 'Thịt chua ống nứa TT L', '', '', 80000, '2023-11-23 12:33:55', ''),
(121, 1, 'Thịt chua ống nứa ĐB M', '', '', 55000, '2023-11-23 12:33:55', ''),
(122, 1, 'Thịt chua ống nứa ĐB L', '', '', 110000, '2023-11-23 12:33:55', ''),
(123, 1, 'Mực xe hấp nước dừa M', '', '', 35000, '2023-11-23 12:33:55', ''),
(124, 1, 'Mực xe hấp nước dừa L', '', '', 70000, '2023-11-23 12:33:55', ''),
(125, 1, 'Thập cẩm trâu mực M', '', '', 40000, '2023-11-23 12:33:55', ''),
(126, 1, 'Thập cẩm trâu mực L', '', '', 80000, '2023-11-23 12:33:55', ''),
(127, 26, 'Trà sữa mơ mơ đặt biệt M', '', '', 30000, '2023-11-23 12:33:55', ''),
(128, 26, 'Trà sữa mơ mơ đặt biệt L', '', '', 35000, '2023-11-23 12:33:55', ''),
(129, 26, 'Trà sữa bạc hà sữa tươi cacao M', '', '', 30000, '2023-11-23 12:33:55', ''),
(130, 26, 'Trà sữa bạc hà sữa tươi cacao L', '', '', 35000, '2023-11-23 12:33:55', ''),
(131, 26, 'Matcha 3 tầng trân châu đường đen M', '', '', 30000, '2023-11-23 12:33:55', ''),
(132, 26, 'Matcha 3 tầng trân châu đường đen L', '', '', 35000, '2023-11-23 12:33:55', ''),
(133, 26, 'Dâu tầm nho đặt biệt M', '', '', 30000, '2023-11-23 12:33:55', ''),
(134, 26, 'Dâu tầm nho đặt biệt L', '', '', 35000, '2023-11-23 12:33:55', ''),
(135, 26, 'Dâu tây nho đặt biệt M', '', '', 30000, '2023-11-23 12:33:55', ''),
(136, 26, 'Dâu tây nho đặt biệt L', '', '', 35000, '2023-11-23 12:33:55', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_table`
--

CREATE TABLE `db_table` (
  `id_table` int(10) NOT NULL,
  `name_table` varchar(50) NOT NULL,
  `status` text NOT NULL,
  `code_table` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `db_table`
--

INSERT INTO `db_table` (`id_table`, `name_table`, `status`, `code_table`) VALUES
(1, 'Bàn 1', '0', 'ban-1'),
(2, 'Bàn 2', '0', 'ban-2'),
(3, 'Bàn 3', '0', 'ban-3'),
(4, 'Bàn 4', '0', 'ban-4'),
(5, 'Bàn 5', '0', 'ban-5'),
(6, 'Bàn 6', '0', 'ban-6'),
(7, 'Bàn 7', '0', 'ban-7'),
(8, 'Bàn 8', '0', 'ban-8'),
(9, 'Bàn 9', '0', 'ban-9'),
(10, 'Bàn 10', '0', 'ban-10'),
(11, 'Bàn 11', '0', 'ban-11'),
(12, 'Bàn 12', '0', 'ban-12'),
(13, 'Bàn 13', '0', 'ban-13'),
(14, 'Bàn 14', '0', 'ban-14'),
(15, 'Bàn 15', '0', 'ban-15'),
(16, 'Bàn 16', '0', 'ban-16'),
(17, 'Bàn 17', '0', 'ban-17'),
(18, 'Bàn 18', '0', 'ban-18'),
(19, 'Bàn 19', '0', 'ban-19'),
(20, 'Bàn 20', '0', 'ban-20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_table_detail`
--

CREATE TABLE `db_table_detail` (
  `id` int(10) NOT NULL,
  `id_table` int(10) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` text NOT NULL,
  `price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(225) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `created_after` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_user`
--

INSERT INTO `db_user` (`id`, `fullname`, `username`, `password`, `role`, `email`, `gender`, `phone`, `address`, `img`, `created`, `created_after`, `status`) VALUES
(10, 'Quốc Huy', 'admin', '123', 'Admin', '', 'Nam', '', 'Vĩnh Long', '19bea02cea50758fbedada5aaffaab7d.jpg', '2022-11-04 16:18:49', '2023-11-29 11:44:46', 1),
(13, 'Trang', 'trang', '123', 'NhanVien', '', 'Nữ', '', '', '', '2023-11-30 17:23:21', '', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `db_category`
--
ALTER TABLE `db_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_customer`
--
ALTER TABLE `db_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_order`
--
ALTER TABLE `db_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerid` (`customerid`);

--
-- Chỉ mục cho bảng `db_orderdetail`
--
ALTER TABLE `db_orderdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `orderid` (`orderid`);

--
-- Chỉ mục cho bảng `db_product`
--
ALTER TABLE `db_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catid` (`catid`);

--
-- Chỉ mục cho bảng `db_table`
--
ALTER TABLE `db_table`
  ADD PRIMARY KEY (`id_table`);

--
-- Chỉ mục cho bảng `db_table_detail`
--
ALTER TABLE `db_table_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `db_category`
--
ALTER TABLE `db_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `db_customer`
--
ALTER TABLE `db_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `db_order`
--
ALTER TABLE `db_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT cho bảng `db_orderdetail`
--
ALTER TABLE `db_orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT cho bảng `db_product`
--
ALTER TABLE `db_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT cho bảng `db_table`
--
ALTER TABLE `db_table`
  MODIFY `id_table` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `db_table_detail`
--
ALTER TABLE `db_table_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT cho bảng `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
