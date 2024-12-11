-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 11:11 AM
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
(1, 'FUJIFILM GFX100S II', 'fujifilm-gfx100s-ii', 'Máy ảnh Medium Format 102MP với cảm biến BSI CMOS', 99999999.99, 99999999.99, 1, '/Fujifilm_Shop/images/gallery/PRODUCT/gfx_series/gfx100sii/gfx100siifront.png', 10, '2024-12-11 03:06:50'),
(2, 'FUJIFILM X-T5', 'fujifilm-x-t5', 'Máy ảnh mirrorless 40.2MP với cảm biến X-Trans CMOS 5', 45990000.00, 49990000.00, 2, '/Fujifilm_Shop/images/gallery/PRODUCT/x_series/xt5/xt5front.jpg', 15, '2024-12-11 03:06:50'),
(3, 'FUJINON GF 80mm f/1.7 R WR', 'fujinon-gf-80mm-f1-7', 'Ống kính Medium Format với khẩu độ lớn f/1.7', 65990000.00, NULL, 3, '/Fujifilm_Shop/images/gallery/PRODUCT/lens/gf80mmf1.7/gf80mmf1.7front.jpg', 5, '2024-12-11 03:06:50'),
(4, 'FUJIFILM X100VI', 'fujifilm-x100vi', 'Máy ảnh compact cao cấp với cảm biến X-Trans CMOS 5', 44990000.00, 54990000.00, 2, '/Fujifilm_Shop/images/gallery/PRODUCT/x_series/x100vi/x100vifront.png', 8, '2024-12-11 03:06:50'),
(5, 'FUJINON XF 56mm f/1.2 R WR', 'fujinon-xf-56mm-f1-2', 'Ống kính chân dung cao cấp cho dòng X Series', 22990000.00, 24990000.00, 3, '/Fujifilm_Shop/images/gallery/PRODUCT/Lens/xf56mmf1.2lm/xf56mmf1.2lmfront.jpg', 12, '2024-12-11 03:06:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_handle` (`product_handle`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
