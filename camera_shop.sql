-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 05:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camera_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `user_id`, `label`, `full_name`, `address`, `phone_number`) VALUES
(1, 1, 'Home', 'Nguyễn Văn A', 'Số 10 đường Láng, Hà Nội', '0912345679'),
(2, 1, 'Work', 'Nguyễn Văn A', 'Số 20 đường Trần Duy Hưng, Hà Nội', '0912345680'),
(3, 2, 'Home', 'Trần Thị B', 'Số 15 đường Lê Lợi, TP HCM', '0987654321'),
(4, 2, 'Work', 'Trần Thị B', 'Số 25 đường Nguyễn Huệ, TP HCM', '0987654322'),
(5, 6, 'Home', 'Nguyễn Văn A', 'Số 405 đường Thuận Thiên, Kiến Thụy, Hải Phòng', '123456781'),
(6, 8, 'Home', 'AThah', '123', '123'),
(7, 9, 'Home', 'Admin User', '123 Admin St', '1234567890'),
(8, 10, 'Home', 'AThah', '1', '1'),
(9, 11, 'Home', '11', '11', '11'),
(13, 27, 'abc', 'abc', 'abc', '111'),
(20, 10, 'Work1', 'abc', 'abc', '123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `created_at`) VALUES
(1, 11, '2024-12-11 03:35:54'),
(2, 10, '2024-12-11 11:04:51'),
(3, 30, '2024-12-11 14:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `cart_id`, `product_id`, `quantity`) VALUES
(7, 2, 1, 2),
(8, 2, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`) VALUES
(1, 'GFX Series', 'Mô tả'),
(2, 'Instax', NULL),
(3, 'Lens', NULL),
(4, 'x-series', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(1, 11, 10, 'dm gui hang nhan len', '2024-12-12 02:43:43'),
(2, 10, 11, 'ok bạn', '2024-12-12 02:46:34'),
(3, 10, 10, 'abcxyz', '2024-12-12 03:51:48'),
(4, 11, 10, 'abcxyz\r\n', '2024-12-12 03:52:21'),
(5, 10, 10, 'ok e', '2024-12-12 03:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `published_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `content`, `author`, `published_date`, `image_url`) VALUES
(1, 'Khám phá thế giới thể thao cùng GFX100S II', 'Dự án này là một cái nhìn hậu trường về cách chụp ảnh cho một bài viết tạp chí được viết bởi nhà báo Alex Workman, khi làm việc với máy ảnh Fujifilm GFX100S II mới và ống kính GF500mmF5.6 R LM OIS WR.', 'fujifilm-xspace', '2024-06-23 17:00:00', '/Fujifilm_Shop/images/gallery/blog/2.jpg'),
(2, 'Cuộc sống hằng ngày của Akipin cùng X-T50', 'Trong khoảng 15 năm, tôi vẫn thường xuyên chụp ảnh vợ và con gái, nhờ FUJIFILM X-T10 mà tôi nhận ra có nhiều sự thay đổi giữa các dòng máy ảnh kỹ thuật số.', 'fujifilm-xspace', '2024-06-19 17:00:00', '//file.hstatic.net/200000396087/article/600_d0b6a912a6254d338299bcdf577836c3_1024x1024.jpg'),
(4, 'ABC', 'ABC', 'fuji-x-space', '2024-12-09 17:00:00', NULL),
(6, 'News Title 2', 'Content for news article 2.', 'Author 2', '2023-01-02 04:00:00', NULL),
(7, 'News Title 3', 'Content for news article 3.', 'Author 3', '2023-01-03 05:00:00', NULL),
(9, 'News Title 5', 'Content for news article 5.', 'Author 5', '2023-01-05 07:00:00', NULL),
(10, 'News Title 6', 'Content for news article 6.', 'Author 6', '2023-01-06 08:00:00', NULL),
(11, 'News Title 7', 'Content for news article 7.', 'Author 7', '2023-01-07 09:00:00', NULL),
(12, 'News Title 8', 'Content for news article 8.', 'Author 8', '2023-01-08 10:00:00', NULL),
(13, 'News Title 9', 'Content for news article 9.', 'Author 9', '2023-01-09 11:00:00', NULL),
(14, 'News Title 10', 'Content for news article 10.', 'Author 10', '2024-12-16 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `status`, `total_amount`) VALUES
(7, 10, '2024-12-11 13:21:38', 'pending', 99999999.99),
(8, 10, '2024-12-11 13:37:14', 'shipped', 99999999.99),
(9, 11, '2024-12-11 13:38:13', 'shipped', 99999999.99),
(10, 30, '2024-12-11 14:47:57', 'pending', 99999999.99),
(11, 11, '2024-12-12 03:46:23', 'shipped', 45000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(2, 7, 1, 1, 99999999.99),
(3, 8, 1, 1, 99999999.99),
(4, 8, 2, 1, 45990000.00),
(5, 9, 1, 1, 99999999.99),
(6, 9, 1, 2, 99999999.99),
(7, 10, 1, 1, 99999999.99),
(8, 11, 8, 3, 15000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'thanh@gmail.com', '2fcae10744c70a4af47f3d508224befc9833c03f12ae0ff9b9a4084c2b7f1e9360970663847b8b590c5dcae70ee8c7f85e2f', '2024-12-12 02:09:44'),
(2, 'thanh@gmail.com', '2f259d9b932baa2883ab2cc4c4045b3ef408da65cf821397b76bd779248380ae587628c827517f8da32f5beb8e6cd96357f9', '2024-12-12 02:10:04'),
(3, 'hai@gmail.com', 'b640cbbe1640ffc8fa72eab8c0e0a2fc798b466be47a86d67584984b9f85e4958e4654b24c1a098898f4bb8eef76af5dc50b', '2024-12-12 02:10:33'),
(4, 'hai@gmail.com', '11f4757501ff5d8ac590f9cb44fb42c1840c4981535ff34e0aad10eca4b26fa93a9c51c11c704d49ce95d357e4998cdfed07', '2024-12-12 02:10:49'),
(5, 'hai@gmail.com', '6f9994afe05f823f21536714eaf45195fc612ab15dce8cadeca48b7d4e17eb8a1b11569f3bf58a17f06768208292dcda6c7a', '2024-12-12 02:11:00'),
(6, '3@gmail.com', '7fd146f56eedc6cd2f64e07d2091b6a3ab03e16707da732c4556c9b7e9436c2f7e181266ac977765bd9087bec96785b47d2c', '2024-12-12 02:11:27'),
(7, '3@gmail.com', '231cdfa57dc4f4b711282e15ddd61e47fadade4bbb54f993ed197065f48d8ee1341cfcfb649a8a2f84200d7e9c943d292d2a', '2024-12-12 02:16:13'),
(8, 'hai@gmail.com', '7ea6730347d9d5eafa46df09214d404e91704620869720daff395398393f69a636a57407fbee3d22005fba0523447927f7cd', '2024-12-12 02:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_handle` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_handle`, `description`, `price`, `compare_price`, `category_id`, `image_path`, `stock`, `created_at`) VALUES
(1, 'FUJIFILM GFX100S II', 'fujifilm-gfx100s-ii', 'Máy ảnh Medium Format 102MP với cảm biến BSI CMOS', 99999999.99, 99999999.99, 1, '/Fujifilm_Shop/images/gallery/PRODUCT/gfx_series/gfx100sii/gfx100siifront.png', 0, '2024-12-11 03:06:50'),
(2, 'FUJIFILM X-T5', 'fujifilm-x-t5', 'Máy ảnh mirrorless 40.2MP với cảm biến X-Trans CMOS 5', 45990000.00, 49990000.00, 2, '/Fujifilm_Shop/images/gallery/PRODUCT/x_series/xt5/xt5front.jpg', 14, '2024-12-11 03:06:50'),
(3, 'FUJINON GF 80mm f/1.7 R WR', 'fujinon-gf-80mm-f1-7', 'Ống kính Medium Format với khẩu độ lớn f/1.7', 65990000.00, NULL, 3, '/Fujifilm_Shop/images/gallery/PRODUCT/lens/gf80mmf1.7/gf80mmf1.7front.jpg', 5, '2024-12-11 03:06:50'),
(4, 'FUJIFILM X100VI', 'fujifilm-x100vi', 'Máy ảnh compact cao cấp với cảm biến X-Trans CMOS 5', 44990000.00, 54990000.00, 2, '/Fujifilm_Shop/images/gallery/PRODUCT/x_series/x100vi/x100vifront.png', 8, '2024-12-11 03:06:50'),
(5, 'FUJINON XF 56mm f/1.2 R WR', 'fujinon-xf-56mm-f1-2', 'Ống kính chân dung cao cấp cho dòng X Series', 22990000.00, 24990000.00, 3, '/Fujifilm_Shop/images/gallery/PRODUCT/Lens/xf56mmf1.2lm/xf56mmf1.2lmfront.jpg', 12, '2024-12-11 03:06:50'),
(8, 'Fujifilm X-T4', 'fujifilm-x-t4', 'The Fujifilm X-T4 is a versatile mirrorless camera that excels in both photography and videography.', 15000000.00, 16000000.00, 1, '/Fujifilm_Shop/images/uploads/xt5back.jpg', 47, '2024-12-12 00:54:40'),
(9, 'Fujifilm X100V', 'fujifilm-x100v', 'The Fujifilm X100V is a premium compact camera with a fixed lens and advanced features.', 20000000.00, 21000000.00, 1, '/Fujifilm_Shop/images/uploads/xt30iifront.png', 30, '2024-12-12 00:54:40'),
(10, 'Fujifilm GFX 100S', 'fujifilm-gfx-100s', 'The Fujifilm GFX 100S is a medium format mirrorless camera with a 102MP sensor.', 60000000.00, 65000000.00, 2, '/Fujifilm_Shop/images/uploads/xh2sfront.jpg', 20, '2024-12-12 00:54:40'),
(11, 'Fujifilm XF 16-55mm f/2.8 R LM WR', 'fujifilm-xf-16-55mm-f2-8-r-lm-wr', 'The Fujifilm XF 16-55mm f/2.8 R LM WR is a high-performance standard zoom lens.', 25000000.00, 26000000.00, 3, '/Fujifilm_Shop/images/uploads/xf16-55mmf2.8front.jpg', 40, '2024-12-12 00:54:40'),
(12, 'Fujifilm XF 50-140mm f/2.8 R LM OIS WR', 'fujifilm-xf-50-140mm-f2-8-r-lm-ois-wr', 'The Fujifilm XF 50-140mm f/2.8 R LM OIS WR is a versatile telephoto zoom lens.', 30000000.00, 32000000.00, 3, '/Fujifilm_Shop/images/uploads/xf55-200mmf3.5-4.8front.jpg', 25, '2024-12-12 00:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `email`, `full_name`, `address`, `phone_number`, `created_at`, `image_path`, `gender`) VALUES
(1, 'nguyenvana', '$2y$10$nzKAkRIwP0OUU9X7pcV/sezRvSjBM4NAfqjXAeTvemzIHEPh8hg/G', 'nguyenvana@gmail.com', 'Nguyễn Văn A', 'Số 10 đường Láng, Hà Nội', '0912345679', '2024-12-05 11:15:44', NULL, NULL),
(2, 'tranthib', '$2y$10$nzKAkRIwP0OUU9X7pcV/sezRvSjBM4NAfqjXAeTvemzIHEPh8hg/G', 'tranthib@gmail.com', 'Trần Thị B', 'Số 15 đường Lê Lợi, TP HCM', '0987654321', '2024-12-05 11:15:44', NULL, NULL),
(6, 'abc', '$2y$10$B3AWmriMD5bewNsTIBRZtOAm7KrB./V7Fzii.TKj7dD.R2cpqGuH.', 'thanhkthp2710@gmail.com', 'Nguyễn Văn A', 'Số 405 đường Thuận Thiên, Kiến Thụy, Hải Phòng', '123456781', '2024-12-06 13:12:16', NULL, NULL),
(8, 'tphn_pl11', '$2y$10$Pgt9BaQR1WU4Dq1HvhD5EOHXRGbEIqj17WHkBWAZvg0dQ1Fgi7WIC', 'admin@fujiflim.com', 'AThah', '123', '123', '2024-12-07 04:28:35', NULL, NULL),
(9, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin@fujifilm.com', 'Admin User', '123 Admin St', '1234567890', '2024-12-08 14:44:36', NULL, NULL),
(10, '1', '$2y$10$/HK7zBKBpKDf1NK1Qx9oD.2qX9YaVGmvqlW3CpsNZwpVi1avWN.6C', '1@gmail.com', 'AThah', 'Địa chỉ 123', '1', '2024-12-08 15:03:15', '/Fujifilm_Shop/images/uploads/chiawu-portfolio-starbucks-posters-02.jpg', NULL),
(11, '1', '$2y$10$aGPMZJTnlBN9Sf1L3n4aS.m.aBEzn9iRJxRZFNz3PpWSd4Hb3yeB.', '2@gmail.com', '11', '1121', '11', '2024-12-09 13:26:02', '/Fujifilm_Shop/images/uploads/chiawu-portfolio-starbucks-posters-02.jpg', NULL),
(15, 'tphn_pl11', '$2y$10$IOXixnEvf4Nc64qNiQPPCeGYLgwESpr2.03ebLX.BqHf6DUaNHOqq', 'hai@gmail.com', '1', '1', '1', '2024-12-10 07:42:55', '/Fujifilm_Shop/images/uploads/z5233767506933_a8ec468983ab08f3725e6668e24a51bb.jpg', NULL),
(27, '123', '$2y$10$poi6zBflTtZYvgNyPNple.R6CmzlNgczwPux2cPfGGLaHeAKTEnmK', 'thanh@gmail.com', '1', '1', '1', '2024-12-10 08:54:59', '/Fujifilm_Shop/images/uploads/pexels-pixabay-301614.jpg', NULL),
(28, 'tts_1', '$2y$10$qVcqUJfrxJhRhBrvaJ.pruII1PKbxYp7r1AhRVOknJ/sWASx24Gca', 'hai@gmail.com', 'a', '1', '1', '2024-12-10 13:07:18', '/Fujifilm_Shop/images/uploads/starbucks-png-starbucks-heading-logo-250.png', NULL),
(30, 'nihongo', '$2y$10$/HK7zBKBpKDf1NK1Qx9oD.2qX9YaVGmvqlW3CpsNZwpVi1avWN.6C', 'vietkawai@gmail.com', '1', 'Địa chỉ 1', '113', '2024-12-11 14:42:05', '/Fujifilm_Shop/images/uploads/Untitled design.jpg', NULL),
(31, 'tphn_pl11', '$2y$10$qWdZd9qz5WNLvdUkbORb5uBInMt2PK/Ny7gKXw0XJ4r9GtwveZNFy', '3@gmail.com', '1', 'a', '11', '2024-12-11 14:51:09', '/Fujifilm_Shop/images/uploads/Untitled1.png', NULL),
(39, 'tts_1', '$2y$10$L255cKoRJmpx403OoOLyoOnsBRVnZ/Te1/Y8ZYsSS9L4VZv/V0j0i', '15@gmail.com', '1', '1', '1', '2024-12-11 15:36:04', '/Fujifilm_Shop/images/uploads/z5420415405754_2afa534621df4e69dc90477425bc3667.jpg', NULL),
(40, 'tphn_pl11', '$2y$10$jzH6zChJt0KdJHghzfgEK.IyLZseIHyYg9YUYHV9vsRvrvQ0xeVxS', '6@gmail.com', '1', '1', '1', '2024-12-11 15:41:18', '/Fujifilm_Shop/images/uploads/z2815453312119_0417339f8f4457d8f2d3e3a94c1be593.jpg', NULL),
(41, 'tphn_pl11', '$2y$10$bGlCZ8AKO3iyTsb9RtAdtONftty/fNNwIaAuaH6v7EQOm7UhFclCW', '111@gmail.com', '1', '11', '1', '2024-12-12 03:44:07', '/Fujifilm_Shop/images/uploads/channels4_profile.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_handle` (`product_handle`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
