-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 17, 2024 at 07:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ZZD`
--
CREATE DATABASE IF NOT EXISTS `ZZD` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ZZD`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password_hash` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password_hash`) VALUES
(1, 'kourosharani@gmail.com', '$2y$10$crbQIPIxiUyqUDbc3T2xpepZMpcngsPx2XVwgpPFjffb/1G.k5zmS');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`customer_id`, `product_id`, `quantity`) VALUES
(2, 5, 3),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `title`) VALUES
(2, 'Sport'),
(13, 'Swimming'),
(14, 'Clothing'),
(15, 'Women'),
(16, 'Men'),
(17, 'Cosmetics'),
(18, 'Electronics'),
(19, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(200) NOT NULL,
  `username` varchar(40) NOT NULL,
  `secret` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `email`, `password_hash`, `username`, `secret`) VALUES
(1, 'Jojos', 'jojo@baba.com', '123', 'Spaghetti', NULL),
(2, 'a', 'a@a', '$2y$10$k6Msb09SG3AwHapV3xXn3u0RdkfpGKDLlr6nfN86xNrilsdtQcbAW', 'a', NULL),
(4, 'test', 'test@gmail.com', '$2y$10$NLoCpErvqOrqbAvIHoyBpuAmywlW0psNcRkogah3qNnnUUMr3Iu1m', 'test', NULL),
(5, 'Zlatin Tsvetkov', 'zlatintsvetkov@gmail.com', '$2y$10$iWh9iJVlcCFC2N0Y3BxBRuE0SV5KOE8lK8R6GD9DWfVI4qT8ev9YG', 'Zlatin', NULL),
(6, 'z', 'z@z', '$2y$10$mi0yvxnYoXqU5nc8nHhPduc1TGK6P9eZ2LvONhL8eYbHKGBwRQKqG', 'z', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(5, 6, 18, 1, 59.99),
(6, 7, 18, 1, 59.99),
(7, 8, 16, 1, 45.00),
(8, 8, 18, 3, 179.97),
(9, 10, 18, 1, 59.99),
(10, 13, 8, 1, 40.00),
(11, 13, 9, 1, 6.00),
(12, 13, 10, 1, 255.00),
(13, 14, 9, 1, 6.00),
(14, 14, 10, 1, 255.00),
(15, 15, 7, 1, 15.00),
(16, 15, 10, 1, 255.00),
(17, 15, 18, 1, 59.99),
(18, 16, 11, 1, 21.00),
(19, 16, 18, 4, 239.96),
(20, 17, 6, 1, 24.00),
(21, 17, 18, 1, 59.99),
(22, 18, 6, 1, 24.00);

--
-- Triggers `order_detail`
--
DELIMITER $$
CREATE TRIGGER `after_order_detail_insert` AFTER INSERT ON `order_detail` FOR EACH ROW BEGIN
    UPDATE `product`
    SET `quantity` = `quantity` - NEW.`quantity`
    WHERE `product_id` = NEW.`product_id`;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `picture_id` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`picture_id`, `filename`, `product_id`) VALUES
(23, '664272b8369d3.jpg', 5),
(24, '664272bd35fe2.jpg', 5),
(25, '664272d3e49b5.jpg', 6),
(26, '66427312f1b90.jpg', 6),
(37, '664275efec3c5.jpg', 7),
(38, '664275f2e4f95.jpg', 7),
(39, '6642776b1fd5f.jpg', 16),
(40, '6642776fd25e9.jpg', 16),
(41, '66427772be35e.jpg', 16),
(42, '6642777e23cee.jpg', 8),
(43, '66427780519ac.jpg', 8),
(44, '6642778a55d9f.jpg', 9),
(46, '66427792bc7f4.jpg', 9),
(47, '66427798eb092.jpg', 9),
(48, '664277a2f23b7.jpg', 10),
(49, '664277a6ac385.jpg', 10),
(50, '664277b0c61d9.jpg', 11),
(51, '664277b318e0b.jpg', 11),
(52, '664277c6569b1.jpg', 13),
(53, '664277c9271f8.jpg', 13),
(54, '664277d0ba4ef.jpg', 14),
(55, '664277d32d31a.jpg', 14),
(56, '664277e02e08a.png', 15),
(57, '664277e3bbeab.jpg', 15),
(58, '6642785b5084b.jpg', 17),
(59, '66427860a5ceb.jpg', 17),
(60, '6642786445b79.jpg', 17),
(61, '6642f949a2170.png', 18),
(62, '6642f96856f20.png', 18);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `in_stock` tinyint(1) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `price`, `title`, `description`, `in_stock`, `quantity`) VALUES
(5, 25.00, 'Battery Robot', 'Battery Robot is a small robot fueled by batteries.', 0, 0),
(6, 24.00, 'Mammoth Coat', 'A coat makes from the legendary mammoth.', 1, 1),
(7, 15.00, 'Fire Ring', 'This ring fits all fingers', 1, 1),
(8, 40.00, 'Hammer Time', 'A strong hammer\r\n', 1, 1),
(9, 6.00, 'Swirly Headband', 'Flexible and Durable', 1, 1),
(10, 255.00, 'Pills', 'Fake pill toy\r\n', 0, 1),
(11, 21.00, 'Waterproof Short X1', 'Prevent water from touch you', 1, 1),
(13, 100.00, 'Knuckles Taser', 'A taser that fits on your knuckles\r\n', 0, 0),
(14, 10.00, 'Christmas Mug', 'A mug that is red\r\n', 1, 1),
(15, 3.00, 'Cat Bookmark', 'A bookmarker for your cats', 1, 1),
(16, 45.00, 'Royal Purse', 'Purse that is so royal.', 1, 1),
(17, 21.00, 'Future Ball', 'A fun ball to kick at your door\r\n', 1, 1),
(18, 59.99, 'Voice Assistant -KIR', 'A voice assistant to help you navigate the web. Perfect for people with disabilities', 1, 6);

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `before_product_update` BEFORE UPDATE ON `product` FOR EACH ROW BEGIN
    IF NEW.quantity = 0 THEN
        SET NEW.in_stock = 0;
    ELSE
        SET NEW.in_stock = 1;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `product_id`) VALUES
(17, 7),
(16, 8),
(17, 9),
(2, 10),
(13, 11),
(16, 14),
(19, 17),
(14, 11),
(19, 14),
(19, 10),
(19, 8),
(19, 9),
(18, 13),
(2, 15),
(19, 15),
(18, 5),
(14, 6),
(15, 16),
(17, 16),
(18, 18);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_price` double NOT NULL,
  `email` varchar(150) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `country` varchar(45) NOT NULL,
  `province` varchar(20) NOT NULL,
  `zip` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`order_id`, `customer_id`, `status`, `time`, `total_price`, `email`, `first_name`, `last_name`, `address`, `country`, `province`, `zip`) VALUES
(6, 5, 1, '2024-05-15 02:18:51', 79.28, '', '', '', '', '', '', ''),
(7, 5, 0, '2024-05-15 06:20:29', 79.28, '', '', '', '', '', '', ''),
(8, 5, 2, '2024-05-15 02:19:07', 269.01, '', '', '', '', '', '', ''),
(9, 6, 0, '2024-05-17 08:53:29', 10.29, '', '', '', '', '', '', ''),
(10, 6, 0, '2024-05-17 09:10:41', 79.28, '', '', '', '', '', '', ''),
(11, 6, 0, '2024-05-17 03:55:39', 79.28, 'zlatintsvetkov@gmail.com', 'Zlatin', 'Tsvetkov', '911 McDonald Avenue', 'Canada', 'Quebec', 'A1B 2C3'),
(12, 6, 0, '2024-05-17 10:26:32', 218.43, 'zlatintsvetkov@gmail.com', 'Zlatin', 'Tsvetkov', '911 McDonald Avenue', 'Canada', 'Quebec', 'A1B 2C3'),
(13, 6, 0, '2024-05-17 10:31:33', 356.44, 'zlatintsvetkov@gmail.com', 'Zlatin', 'Tsvetkov', '911 McDonald Avenue', 'Canada', 'Quebec', 'A1B 2C3'),
(14, 6, 0, '2024-05-17 10:46:22', 655.39, 'zlatintsvetkov@gmail.com', 'Zlatin', 'Tsvetkov', '4055 Boulevard Cavendish Apt 3', 'Canada', 'Quebec', 'H4B 2N4'),
(15, 6, 0, '2024-05-17 10:51:46', 389.78, 'zlatintsvetkov@gmail.com', 'Zlatin', 'Tsvetkov', '911 McDonald Avenue', 'Canada', 'Quebec', 'A1B 2C3'),
(16, 6, 0, '2024-05-17 10:54:21', 310.4, 'zlatintsvetkov@gmail.com', 'Zlatin', 'Tsvetkov', '911 McDonald Avenue', 'Canada', 'Quebec', 'A1B 2C3'),
(17, 6, 0, '2024-05-17 11:15:05', 106.88, 'zlatintsvetkov@gmail.com', 'Zlatin', 'Tsvetkov', '911 McDonald Avenue', 'Canada', 'Quebec', 'A1B 2C3'),
(18, 6, 0, '2024-05-17 11:16:10', 37.89, 'zlatintsvetkov@gmail.com', 'Zlatin', 'Tsvetkov', '911 McDonald Avenue', 'Canada', 'Quebec', 'H4B 2N4');

--
-- Triggers `product_order`
--
DELIMITER $$
CREATE TRIGGER `after_order_insert` AFTER INSERT ON `product_order` FOR EACH ROW BEGIN
    DELETE FROM `cart_item` WHERE `customer_id` = NEW.`customer_id`;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(4000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `email` varchar(255) NOT NULL,
  `date_subscribed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`email`, `date_subscribed`) VALUES
('2249436@edu.vaniercollege.qc.ca', '2024-05-15 02:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `wish`
--

CREATE TABLE `wish` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`customer_id`,`product_id`),
  ADD KEY `cart_product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_detail_ibfk_1` (`order_id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`picture_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD KEY `product_category_ibfk_2` (`product_id`),
  ADD KEY `product_category_ibfk_1` (`category_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `wish`
--
ALTER TABLE `wish`
  ADD KEY `wish_customer_id` (`customer_id`),
  ADD KEY `wish_product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `cart_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `product_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `order_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `review_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `wish`
--
ALTER TABLE `wish`
  ADD CONSTRAINT `wish_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `wish_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
