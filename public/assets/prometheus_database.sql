-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 02, 2024 at 01:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prometheus_database`
--
CREATE DATABASE IF NOT EXISTS `prometheus_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `prometheus_database`;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int NOT NULL,
  `brand_img` varchar(255) NOT NULL,
  `brand_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `brand_description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_img`, `brand_name`, `brand_description`) VALUES
(1, '', 'Apple', 'Apple la nha NSX so 1 the gioi hehe');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `phone_details_id` int NOT NULL,
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `phone_details_id`, `quantity`) VALUES
(9, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int NOT NULL,
  `phone_details_id` int NOT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `phone_details_id`, `file_path`) VALUES
(1, 1, 'den-1.jpg'),
(2, 1, 'den-2.jpg'),
(3, 1, 'den-3.jpg'),
(4, 1, 'den-4.jpg'),
(5, 1, 'den-5.jpg'),
(6, 2, 'xanh-1.jpg'),
(7, 2, 'xanh-2.jpg'),
(8, 3, 'xanh-1.jpg'),
(9, 3, 'xanh-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(21, '2014_10_12_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  `payment_method_id` int DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_total_price` decimal(10,0) DEFAULT NULL,
  `order_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `phone_details_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `total_price` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int NOT NULL,
  `status_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int NOT NULL,
  `payment_method_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `phone_id` int NOT NULL,
  `brand_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `phone_name` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`phone_id`, `brand_id`, `category_id`, `phone_name`, `description`) VALUES
(1, 1, NULL, 'iPhone 15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phone_category`
--

CREATE TABLE `phone_category` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `category_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_colors`
--

CREATE TABLE `phone_colors` (
  `color_id` int NOT NULL,
  `phone_id` int DEFAULT NULL,
  `color_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phone_colors`
--

INSERT INTO `phone_colors` (`color_id`, `phone_id`, `color_name`) VALUES
(1, 1, 'Xanh lá nhạt'),
(2, 1, 'Đen');

-- --------------------------------------------------------

--
-- Table structure for table `phone_details`
--

CREATE TABLE `phone_details` (
  `phone_details_id` int NOT NULL,
  `phone_id` int DEFAULT NULL,
  `specific_id` int DEFAULT NULL,
  `color_id` int DEFAULT NULL,
  `screen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cpu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `front_cam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rear_cam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bluetooth_ver` varchar(255) DEFAULT NULL,
  `wifi_ver` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nfc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `discount_percent` float DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `thumbnail_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phone_details`
--

INSERT INTO `phone_details` (`phone_details_id`, `phone_id`, `specific_id`, `color_id`, `screen`, `ram`, `rom`, `cpu`, `front_cam`, `rear_cam`, `bluetooth_ver`, `wifi_ver`, `nfc`, `price`, `discount_percent`, `quantity`, `thumbnail_img`) VALUES
(1, 1, 1, 2, '6.7 inches', '8GB', '256GB', 'Apple A16', '12MP', '18MP & 5 MP & 12MP', '5.1', '802', 'Có', 29000000, NULL, 53, 'thumbnail_den.jpg'),
(2, 1, 1, 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 21500000, NULL, 53, 'thumbnail_xanh.jpg'),
(3, 1, 2, 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 31000000, NULL, 53, 'thumbnail_xanh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `phone_specifics`
--

CREATE TABLE `phone_specifics` (
  `specific_id` int NOT NULL,
  `phone_id` int DEFAULT NULL,
  `specific_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phone_specifics`
--

INSERT INTO `phone_specifics` (`specific_id`, `phone_id`, `specific_name`) VALUES
(1, 1, '256GB'),
(2, 1, '512GB');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int NOT NULL,
  `phone_details_id` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `content` text,
  `rating` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_point` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone_number`, `gender`, `address`, `user_point`, `role_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hubert Muller', '356', NULL, NULL, NULL, NULL, 'ali.toy@example.org', '2024-03-17 09:45:55', '$2y$12$QePcm6cWRfVUvVZtJ.LWbeB7hQlybE5ISF.9EwTtGtLMM7GRZZfJi', 'qz7KSI2JLR', '2024-03-17 09:45:56', '2024-03-17 09:45:56'),
(2, 'Lionel Doyle', '1-341-608-2052', NULL, NULL, NULL, NULL, 'tracey83@example.com', '2024-03-17 09:45:56', '$2y$12$JlziNp/yD.wAHB2nK6sskupxJ6kCKNdbC4lk2gV0Kt7ezJWprxrt6', 'xKe0090brq', '2024-03-17 09:45:56', '2024-03-17 09:45:56'),
(3, 'Marian Haag', '+1.770.872.6712', NULL, NULL, NULL, NULL, 'eulalia.auer@example.org', '2024-03-17 09:45:56', '$2y$12$JlziNp/yD.wAHB2nK6sskupxJ6kCKNdbC4lk2gV0Kt7ezJWprxrt6', '5bAKgGMgae', '2024-03-17 09:45:56', '2024-03-17 09:45:56'),
(4, 'Tito Bednar', '+1.217.962.4310', NULL, NULL, NULL, NULL, 'karelle.hauck@example.com', '2024-03-17 09:45:56', '$2y$12$JlziNp/yD.wAHB2nK6sskupxJ6kCKNdbC4lk2gV0Kt7ezJWprxrt6', 'm9saosFbmE', '2024-03-17 09:45:56', '2024-03-17 09:45:56'),
(5, 'Kailee Stiedemann', '(814) 452-3242', NULL, NULL, NULL, NULL, 'feeney.manley@example.com', '2024-03-17 09:45:56', '$2y$12$JlziNp/yD.wAHB2nK6sskupxJ6kCKNdbC4lk2gV0Kt7ezJWprxrt6', '33p8D8FnuR', '2024-03-17 09:45:56', '2024-03-17 09:45:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `FK_Cart_Phone_Details` (`phone_details_id`),
  ADD KEY `FK_Cart_Users` (`user_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `FK_Image_Phone_Details` (`phone_details_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_Order_Payment_Method` (`payment_method_id`),
  ADD KEY `FK_Order_Order_Status` (`status_id`),
  ADD KEY `FK_Order_Users` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `FK_Order_Details_Phone_Details` (`phone_details_id`),
  ADD KEY `FK_Order_Details_Order` (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`phone_id`);

--
-- Indexes for table `phone_category`
--
ALTER TABLE `phone_category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `phone_colors`
--
ALTER TABLE `phone_colors`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `phone_details`
--
ALTER TABLE `phone_details`
  ADD PRIMARY KEY (`phone_details_id`),
  ADD KEY `FK_Phone_Details_Phone` (`phone_id`),
  ADD KEY `FK_Phone_Details_Phone_Specifics` (`specific_id`),
  ADD KEY `FK_Phone_Details_Phone_Colors` (`color_id`);

--
-- Indexes for table `phone_specifics`
--
ALTER TABLE `phone_specifics`
  ADD PRIMARY KEY (`specific_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `FK_Review_Phone_Details` (`phone_details_id`),
  ADD KEY `FK_Review_User` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `phone_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phone_category`
--
ALTER TABLE `phone_category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `phone_colors`
--
ALTER TABLE `phone_colors`
  MODIFY `color_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phone_details`
--
ALTER TABLE `phone_details`
  MODIFY `phone_details_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `phone_specifics`
--
ALTER TABLE `phone_specifics`
  MODIFY `specific_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_Cart_Phone_Details` FOREIGN KEY (`phone_details_id`) REFERENCES `phone_details` (`phone_details_id`),
  ADD CONSTRAINT `FK_Cart_Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_Image_Phone_Details` FOREIGN KEY (`phone_details_id`) REFERENCES `phone_details` (`phone_details_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_Order_Order_Status` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`status_id`),
  ADD CONSTRAINT `FK_Order_Payment_Method` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`payment_method_id`),
  ADD CONSTRAINT `FK_Order_Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_Order_Details_Order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Order_Details_Phone_Details` FOREIGN KEY (`phone_details_id`) REFERENCES `phone_details` (`phone_details_id`);

--
-- Constraints for table `phone_details`
--
ALTER TABLE `phone_details`
  ADD CONSTRAINT `FK_Phone_Details_Phone` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`phone_id`),
  ADD CONSTRAINT `FK_Phone_Details_Phone_Colors` FOREIGN KEY (`color_id`) REFERENCES `phone_colors` (`color_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Phone_Details_Phone_Specifics` FOREIGN KEY (`specific_id`) REFERENCES `phone_specifics` (`specific_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_Review_Phone_Details` FOREIGN KEY (`phone_details_id`) REFERENCES `phone_details` (`phone_details_id`),
  ADD CONSTRAINT `FK_Review_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
