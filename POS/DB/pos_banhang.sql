-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 28, 2023 lúc 08:36 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pos_banhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_category`
--

CREATE TABLE `db_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_category`
--

INSERT INTO `db_category` (`id`, `name`, `slug`, `created_at`) VALUES
(1, 'Ăn vặt', 'apple', '2019-05-22 16:15:39'),
(20, 'Giải Khát', '', '2023-11-26 18:31:57'),
(21, 'Trà Sữa', '', '2023-11-26 18:33:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_customer`
--

CREATE TABLE `db_customer` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_customer`
--

INSERT INTO `db_customer` (`id`, `fullname`, `address`, `phone`, `email`, `created`) VALUES
(67, 'Nông Nguyễn Bảo Trung', 'Vĩnh Long', '0774082908', 'trung@gmail.com', '2022-11-04 00:00:00'),
(70, 'Phan Trương Lê', '', '0399613736', '', '2022-11-05 02:08:02'),
(71, 'Nguyễn Văn A', '', '7894561230', 'nhocnho721@gmail.com', '2022-11-06 00:00:00'),
(75, 'Khách Lẻ', '', '', '', '2022-12-08 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_order`
--

CREATE TABLE `db_order` (
  `id` int(11) NOT NULL,
  `orderCode` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userid` int(10) NOT NULL,
  `customerid` int(11) NOT NULL,
  `orderdate` text NOT NULL,
  `total_billding` varchar(255) NOT NULL,
  `sale` varchar(255) NOT NULL,
  `total_checkout` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_order`
--

INSERT INTO `db_order` (`id`, `orderCode`, `userid`, `customerid`, `orderdate`, `total_billding`, `sale`, `total_checkout`) VALUES
(98, 'HDa7ebb', 10, 75, '2023-07-25 21:06:04', '60000', '0', 60000),
(99, 'HDe8f05', 10, 75, '2023-09-25 21:06:10', '210000', '0', 210000),
(100, 'HDe9fc8', 10, 67, '2023-09-25 21:07:03', '45000', '4500', 40500),
(101, 'HDa472a', 10, 75, '2023-11-25 23:22:44', '30000', '0', 30000),
(102, 'HD8a02a', 10, 75, '2023-10-25 23:23:31', '45000', '0', 45000),
(103, 'HD44221', 10, 75, '2023-11-24 23:23:37', '45000', '0', 45000),
(104, 'HD6c8ef', 10, 75, '2023-11-25 00:01:43', '120000', '0', 120000),
(105, 'HD38956', 10, 75, '2023-11-25 00:02:11', '60000', '12000', 48000),
(106, 'HD5ba2e', 3, 67, '2023-11-25 00:08:44', '210000', '42000', 168000),
(107, 'HDb4b8d', 10, 70, '2023-11-25 01:14:43', '75000', '0', 75000),
(108, 'HD155bc', 10, 75, '2023-11-25 01:14:58', '90000', '0', 90000),
(109, 'HDd1b6f', 10, 71, '2023-11-26 03:06:14', '135000', '27000', 108000),
(110, 'HD3de20', 10, 75, '2023-11-29 02:22:12', '30000', '0', 30000);

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
(147, 98, 42, 4, 60000),
(148, 99, 40, 1, 15000),
(149, 99, 42, 1, 15000),
(150, 99, 43, 1, 15000),
(151, 99, 44, 1, 15000),
(152, 99, 45, 1, 150000),
(153, 100, 41, 3, 45000),
(154, 101, 40, 2, 30000),
(155, 102, 42, 1, 15000),
(156, 102, 43, 1, 15000),
(157, 102, 41, 1, 15000),
(158, 103, 42, 3, 45000),
(159, 104, 42, 8, 120000),
(160, 105, 42, 1, 15000),
(161, 105, 43, 1, 15000),
(162, 105, 41, 1, 15000),
(163, 105, 40, 1, 15000),
(164, 106, 41, 2, 30000),
(165, 106, 42, 1, 15000),
(166, 106, 43, 1, 15000),
(167, 106, 45, 1, 150000),
(168, 107, 41, 5, 75000),
(169, 108, 43, 2, 30000),
(170, 108, 42, 2, 30000),
(171, 108, 41, 1, 15000),
(172, 108, 40, 1, 15000),
(173, 109, 41, 5, 75000),
(174, 109, 42, 3, 45000),
(175, 109, 43, 1, 15000),
(176, 110, 40, 1, 15000),
(177, 110, 41, 1, 15000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_product`
--

CREATE TABLE `db_product` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `number_buy` int(11) NOT NULL,
  `price` int(255) NOT NULL,
  `created` text NOT NULL,
  `created_after` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_product`
--

INSERT INTO `db_product` (`id`, `catid`, `name`, `images`, `detail`, `number_buy`, `price`, `created`, `created_after`) VALUES
(40, 1, 'Gà Xào', 'uploads/12.jpg', '<p>MO TA 2</p>\r\n', 10000, 15000, '20/11/2023', '2023-11-26 18:33:55'),
(41, 1, 'Mực Ống', 'uploads/8.jpg', '<p>MO TA 3</p>\r\n', 10000, 15000, '20/11/2023', '2023-11-26 18:34:09'),
(42, 1, 'Tôm Chiên Giòng', 'uploads/7.jpg', '<p>MO TA 4</p>\r\n', 10000, 15000, '20/11/2023', '2023-11-26 18:34:20'),
(43, 1, 'Xiêng Nướng Size M', 'uploads/10.jpg', '<p>MO TA 2</p>\r\n', 10000, 25000, '20/11/2023', '2023-11-26 18:35:00'),
(44, 1, 'Xiếng Nướng', 'uploads/11.jpg', '<p>MO TA 5</p>\r\n', 10000, 15000, '20/11/2023', '2023-11-26 18:34:45'),
(45, 1, 'Trà sữa trân châu đường đen ', 'uploads/3.jpg', '<p>MO TA COMBO1</p>\r\n', 100000, 20000, '20/11/2023', '2023-11-26 19:48:45'),
(51, 20, 'Pepsi', 'uploads/product1.jpg', '<p>Peppsi</p>\r\n', 0, 15000, '2023-11-26 18:22:00', '2023-11-26 18:35:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_table`
--

CREATE TABLE `db_table` (
  `id_table` int(10) NOT NULL,
  `name_table` varchar(50) NOT NULL,
  `status` text NOT NULL,
  `code_table` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` datetime NOT NULL,
  `created_after` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `db_user`
--

INSERT INTO `db_user` (`id`, `fullname`, `username`, `password`, `role`, `email`, `gender`, `phone`, `address`, `img`, `created`, `created_after`, `status`) VALUES
(3, 'Nhân viên', 'nhanvien', '123', 'NhânViên', 'nv@gmail.com', 'Nữ', '09990990', 'Gò vấp', 'b78af1dc3e1098f71e7cd607c49f5d51.png', '2019-04-23 09:20:41', '', 1),
(10, 'Bảo Trung', 'admin', '123', 'Admin', 'baotrung@gmail.com', 'Nam', '0321456987', 'Vĩnh Long', '19bea02cea50758fbedada5aaffaab7d.jpg', '2022-11-04 16:18:49', '', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `db_customer`
--
ALTER TABLE `db_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `db_order`
--
ALTER TABLE `db_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT cho bảng `db_orderdetail`
--
ALTER TABLE `db_orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT cho bảng `db_product`
--
ALTER TABLE `db_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `db_table`
--
ALTER TABLE `db_table`
  MODIFY `id_table` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `db_table_detail`
--
ALTER TABLE `db_table_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT cho bảng `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


INSERT INTO `db_product` (`catid`, `name`, `price`, `created`) VALUES
(26, 'Trà sữa mơ mơ đặt biệt M', 30000,'2023-11-23 12:33:55'),
(26, 'Trà sữa mơ mơ đặt biệt L', 35000,'2023-11-23 12:33:55'),
(26, 'Trà sữa bạc hà sữa tươi cacao M', 30000,'2023-11-23 12:33:55'),
(26, 'Trà sữa bạc hà sữa tươi cacao L', 35000,'2023-11-23 12:33:55'),
(26, 'Matcha 3 tầng trân châu đường đen M', 30000,'2023-11-23 12:33:55'),
(26, 'Matcha 3 tầng trân châu đường đen L', 35000,'2023-11-23 12:33:55'),
(26, 'Dâu tầm nho đặt biệt M', 30000,'2023-11-23 12:33:55'),
(26, 'Dâu tầm nho đặt biệt L', 35000,'2023-11-23 12:33:55'),
(26, 'Dâu tây nho đặt biệt M', 30000,'2023-11-23 12:33:55'),
(26, 'Dâu tây nho đặt biệt L', 35000,'2023-11-23 12:33:55'),



