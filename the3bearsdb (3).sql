-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 02:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the3bearsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `Customer_ID` int(255) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `MI` varchar(1) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Contact_num` int(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`Customer_ID`, `Fname`, `Lname`, `MI`, `Address`, `Contact_num`, `Gender`, `user_type`) VALUES
(1, 'Yuro', 'More', 'B', 'Guinobatan,Albay', 2147483647, 'male', 'admin'),
(2, 'flor', 'mat', 'c', 'daraga, albay', 2147483647, 'female', 'admin'),
(3, 'boy', 'tokwa', 'c', 'daraga, albay', 2147483647, 'female', 'admin'),
(4, 'Yuro', 'More', 'B', 'sapuro', 2147483647, 'male', 'admin'),
(5, 'manok', 'pula', 'm', 'tinola', 2147483647, 'female', 'user'),
(6, 'yuta', 'okkotsu', 'T', 'Tokyo city', 2147483647, 'male', 'admin'),
(7, 'tanjiro', 'kamado', 'm', 'kyotto', 2147483647, 'male', 'admin'),
(8, 'denji', 'pochi', 't', 'nodick', 2147483647, 'male', 'admin'),
(9, 'andrian', 'cat', 'p', 'catvillage', 2147483647, 'female', 'admin'),
(10, 'Admin', 'Bears', 'B', 'Legazpi,Albay', 2147483647, 'wala', 'admin'),
(11, 'Yuro', 'More', 'B', 'Guinobatan,Albay', 2147483647, 'male', 'user'),
(12, 'naruto', 'uzumaki', 'N', 'konoha', 2147483647, 'male', 'user'),
(13, 'naruto', 'uzumaki', 'N', 'konoha', 2147483647, 'male', 'user'),
(14, 'naruto', 'uzumaki', 'N', 'konoha', 2147483647, 'male', 'user'),
(15, 'naruto', 'uzumaki', 'N', 'konoha', 2147483647, 'male', 'user'),
(16, 'ichigo', 'kurosaki', 'B', 'soul society', 2147483647, 'male', 'user'),
(17, 'zed', 'shadow', 'r', 'Guinobatan,Albay', 2147483647, 'male', 'user'),
(18, 'Yuro', 'edww', 'd', 's', 2147483647, 'wala', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `Date_ordered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders0`
--

CREATE TABLE `orders0` (
  `order_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `total_product` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders0`
--

INSERT INTO `orders0` (`order_id`, `user_id`, `user_name`, `contact_no`, `payment_method`, `Address`, `total_product`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 16, 'zed10', '09394556712', 'Credit Card', 'p1 guinobatan', 'bread x3, chicken x1, burger x1', 210, '2024-12-20 12:49:32', 'pending'),
(2, 16, 'zed10', '09812466773', 'Credit Card', 'morera', 'bread x1, chicken x1, burger x1, tt x1', 930, '2024-12-20 12:51:51', 'pending'),
(3, 16, 'zed10', '09394556712', 'PayPal', 'p1 guinobatan', 'chicken x1', 40, '2024-12-20 13:02:47', 'pending'),
(4, 17, 'mmsm', '09876543424', 'Credit Card', 'daraga', 'bread x2, chicken x2', 160, '2024-12-20 13:11:43', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` int(150) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_keywords`, `product_image1`, `product_image2`, `product_price`, `date`, `status`) VALUES
(6, 'tt', 'bv', 56, 'uploads/Bear-Shaped Macarons3.jpg', 'uploads/Bear-Shaped Macarons2.jpg', '800', '2024-12-16 13:31:01', ''),
(8, 'bread', 'makunat na bread', 34, 'uploads/67626dad272a5_Bear-Bread2.jpg', 'uploads/67626dad65a25_Bear-Bread1.jpg', '40', '2024-12-18 06:37:33', ''),
(9, 'chicken', 'kaso puro leeg lang', 23, 'uploads/67650f214cc74_The Bear Claw Tenders1.jpg', 'uploads/67650f214ce94_The Bear Claw Tenders2.png', '40', '2024-12-20 06:30:57', ''),
(10, 'burger', 'unang kagat tinapay agad', 44, 'uploads/676539106f463_grizzly burger.jpg', 'uploads/67653910b2e73_grizzly burger2.png', '50', '2024-12-20 09:29:52', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT 'user',
  `date-added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Customer_ID` int(255) NOT NULL,
  `orders` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `username`, `Password`, `user_type`, `date-added`, `Customer_ID`, `orders`) VALUES
(1, 'flormat12', '$2y$10$cIxkY1dZS66jU3nwHDrVsOC1Xq2KZ3EoCaKQmPJ1ZXyVwekDRW2yS', 'admin', '2024-12-18 02:17:15', 2, ''),
(2, 'tokwa14', '$2y$10$QoDBdJ.COSzDiVAK/kJzcOCqufNUWws1lI4b2521mgGfY1BWQwNhy', 'admin', '2024-12-18 02:19:09', 3, ''),
(3, 'Ymore12', '$2y$10$oXqImLg4qaxY88DCWnuH3uuWMzoR9hQHutCSlgfAmcbX32C1eKlg6', 'admin', '2024-12-18 02:31:53', 4, ''),
(4, 'redchix12', '$2y$10$BYede3kA7qMWFAYW42Gy1u7WPoRvED0upsBKm5CQgINSNE7Pb4wES', 'user', '2024-12-18 02:37:23', 5, ''),
(5, 'yuta12', '$2y$10$lO4cCY45dAkkQAevo5vyH.KUfXtmlYGpTQUFgiB5FthHY/O74fpva', 'admin', '2024-12-18 02:52:07', 6, ''),
(6, 'rengoku12', '$2y$10$Ogsx2oPF.GrPJZ.DGZ1q0OIXF/L9c.ZSLYX/T3UvUZkq6Kh75xP7O', 'admin', '2024-12-18 03:04:14', 7, ''),
(7, 'den12', '$2y$10$sSEiT.EHRjQb7MU5EeZL3ukwPf4RNtdJw.s5NbdnUz8Wq91q6VkAi', 'admin', '2024-12-18 03:16:10', 8, ''),
(8, 'catdri12', 'catpol', 'admin', '2024-12-18 03:22:16', 9, ''),
(9, 'AdminBears', 'admin003', 'admin', '2024-12-18 07:08:48', 10, ''),
(10, 'ymore@gmail.com', '127127', 'user', '2024-12-18 07:13:53', 11, ''),
(11, 'nuzumaki14', '0000456', 'user', '2024-12-18 07:18:24', 12, ''),
(12, 'nuzumaki14', '0000456', 'user', '2024-12-18 07:24:19', 13, ''),
(13, 'nuzumaki14', '127127', 'user', '2024-12-18 07:24:30', 14, ''),
(14, 'nuzumaki14', '127127', 'user', '2024-12-18 07:29:24', 15, ''),
(15, 'ichini12', '0909091', 'user', '2024-12-18 07:30:34', 16, ''),
(16, 'zed10', '000127', 'user', '2024-12-18 07:34:29', 17, ''),
(17, 'mmsm', '123123', 'user', '2024-12-18 07:36:39', 18, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `Product_ID` (`Product_ID`,`User_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `orders0`
--
ALTER TABLE `orders0`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `Customer_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders0`
--
ALTER TABLE `orders0`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer_info` (`Customer_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
