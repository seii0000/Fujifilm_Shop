-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 03:06 AM
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
(1, 'GFX Series', 'Mô tả');

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
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `email`, `full_name`, `address`, `phone_number`, `created_at`) VALUES
(1, 'nguyenvana', '$2y$10$nzKAkRIwP0OUU9X7pcV/sezRvSjBM4NAfqjXAeTvemzIHEPh8hg/G', 'nguyenvana@gmail.com', 'Nguyễn Văn A', 'Số 10 đường Láng, Hà Nội', '0912345679', '2024-12-05 11:15:44'),
(2, 'tranthib', '$2y$10$nzKAkRIwP0OUU9X7pcV/sezRvSjBM4NAfqjXAeTvemzIHEPh8hg/G', 'tranthib@gmail.com', 'Trần Thị B', 'Số 15 đường Lê Lợi, TP HCM', '0987654321', '2024-12-05 11:15:44'),
(6, 'abc', '$2y$10$B3AWmriMD5bewNsTIBRZtOAm7KrB./V7Fzii.TKj7dD.R2cpqGuH.', 'thanhkthp2710@gmail.com', 'Nguyễn Văn A', 'Số 405 đường Thuận Thiên, Kiến Thụy, Hải Phòng', '123456781', '2024-12-06 13:12:16'),
(8, 'tphn_pl11', '$2y$10$Pgt9BaQR1WU4Dq1HvhD5EOHXRGbEIqj17WHkBWAZvg0dQ1Fgi7WIC', 'admin@fujiflim.com', 'AThah', '123', '123', '2024-12-07 04:28:35'),
(9, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin@fujifilm.com', 'Admin User', '123 Admin St', '1234567890', '2024-12-08 14:44:36'),
(10, '1', '$2y$10$/HK7zBKBpKDf1NK1Qx9oD.2qX9YaVGmvqlW3CpsNZwpVi1avWN.6C', '1@gmail.com', 'AThah', '1', '1', '2024-12-08 15:03:15'),
(11, '1', '$2y$10$aGPMZJTnlBN9Sf1L3n4aS.m.aBEzn9iRJxRZFNz3PpWSd4Hb3yeB.', '2@gmail.com', '11', '11', '11', '2024-12-09 13:26:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
