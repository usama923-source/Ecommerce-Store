-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2026 at 04:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msgm`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `showall` ()   BEGIN
select * from products;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showonly` ()   BEGIN
select * from products;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(300) NOT NULL,
  `admin_email` varchar(300) NOT NULL,
  `admin_password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_email`, `admin_password`) VALUES
(1, 'usama', 'asifusama923@gmail.com', '$2y$10$Lfcyy9lkxJcN6lwa6dkdhehYW/QXg.BiU0spedjTUy7LfBQK2aWvO'),
(2, 'hasnain', 'hasnain@gmail.com', '$2y$10$iFS6.h4BKyajJUkPhVAlAu4CL0W3GwvZtJ7exWl13Ay4NLfA5atXe');

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_products`
-- (See below for the actual view)
--
CREATE TABLE `all_products` (
`product_id` int(11)
,`product_title` varchar(100)
,`product_description` varchar(300)
);

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(300) NOT NULL,
  `size` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`product_id`, `ip_address`, `size`, `quantity`) VALUES
(6, '::1', 'Medium', 2),
(5, '::1', 'small', 8),
(10, '::1', 'medium', 16);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Mens'),
(2, 'Womens');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `name`, `email`, `message`, `submitted_at`) VALUES
(1, 'USAMA ASIF', 'asifusama923@gmail.com', 'thanks for you services', '2025-07-10 15:25:54'),
(2, 'USAMA ASIF', 'asifusama923@gmail.com', 'hello here', '2025-10-30 18:07:54'),
(3, 'M. moosa', 'moosa@gmail.com', 'services is good ', '2025-12-11 08:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `ip_address` varchar(200) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` bigint(200) NOT NULL,
  `address` text DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `invoice_number` varchar(100) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `ip_address`, `first_name`, `last_name`, `email`, `phone`, `address`, `state`, `zip_code`, `invoice_number`, `total_amount`, `order_status`, `order_date`) VALUES
(1, '::1', 'USAMA', 'ASIF', 'asifusama923@gmail.com', 3052505462, '1 H 4/16 Nazimabad karachi', 'sindh', '74600', 'INV61248', 15600, 'completed', '2025-07-10 22:19:02'),
(3, '::1', 'USAMA', 'ASIF', 'asifusama923@gmail.com', 3052505462, '1 H 4/16 Nazimabad karachi', 'sindh', '74600', 'INV94887', 6400, 'completed', '2025-10-30 02:01:19'),
(4, '::1', 'usama', 'asif', 'asifusama@gmail.com', 3013363288, 'Nazimabad Karachi', 'sindh', '74600', 'INV46112', 3600, 'completed', '2025-12-02 09:58:35'),
(5, '::1', 'usama', 'asif', 'asifusama@gmail.com', 31131321, 'Nazimabad Karachi', 'sindh', '74600', 'INV50455', 92500, 'completed', '2025-12-02 16:16:26'),
(6, '::1', 'usama', 'asif', 'asifusama@gmail.com', 3013363288, 'Nazimabad karachi ', 'Punjab', '74600', 'INV79667', 9000, 'completed', '2025-12-11 13:21:34'),
(7, '::1', 'moosa', 'khan', 'moosa@gmail.com', 30232466933, 'Nazimabad karachi sindh', 'sindh', '76540', 'INV65054', 22500, 'completed', '2025-12-11 13:24:34'),
(8, '::1', 'moosa', 'khan', 'moosa@gmail.com', 30232466933, 'Nazimabad karachi sindh', 'sindh', '76540', 'INV18083', 0, 'pending', '2025-12-11 13:26:00'),
(9, '::1', 'usama', 'asif', 'asifusama@gmail.com', 3013363288, 'Nazimabad Karachi', 'sindh', '74600', 'INV60842', 7800, 'Pending', '2025-12-11 13:26:59'),
(10, '::1', 'usama', 'asif', 'asifusama@gmail.com', 3013363288, 'Nazimabad karachi sindh', 'balochistan', '74600', 'INV84673', 14700, 'completed', '2025-12-11 13:30:57'),
(11, '::1', 'usama', 'asif', 'asifusama@gmail.com', 656565656565, 'Nazimabad Karachi', 'KPK', '74600', 'INV70524', 5600, 'Pending', '2025-12-11 17:54:08'),
(12, '::1', 'usama', 'khan', 'moosa@gmail.com', 323265646461, 'Nazimabad Karachi', 'sindh', '74600', 'INV39529', 24900, 'Pending', '2025-12-17 12:31:51'),
(13, '::1', 'usama', 'khan', 'moosa@gmail.com', 323265646461, 'Nazimabad Karachi', 'sindh', '74600', 'INV65121', 0, 'Pending', '2025-12-17 12:36:00'),
(14, '::1', 'usama', 'khan', 'moosa@gmail.com', 323265646461, 'Nazimabad Karachi', 'sindh', '74600', 'INV11829', 0, 'Pending', '2025-12-17 12:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`, `size`) VALUES
(1, 1, 2, 4, 'Medium'),
(2, 1, 6, 4, 'Small'),
(3, 3, 1, 3, 'Medium'),
(4, 3, 9, 4, 'Small'),
(5, 4, 2, 4, 'Small'),
(6, 5, 5, 5, 'Small'),
(7, 5, 11, 16, 'Large'),
(8, 6, 7, 15, 'Large'),
(9, 7, 5, 9, 'Medium'),
(14, 9, 7, 13, 'Large'),
(15, 10, 1, 9, 'Medium'),
(16, 10, 4, 5, 'medium'),
(17, 11, 10, 2, 'small'),
(18, 11, 7, 1, 'Large'),
(19, 12, 9, 4, 'Medium'),
(20, 12, 8, 1, 'large'),
(21, 12, 11, 4, 'small');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(300) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `category_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `date`, `status`) VALUES
(1, 'White Shirt', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 1, 'white shirt.jpg', 'white shirt1.jpg', 'white shirt2.jpg', 2500, '2025-12-17 07:30:56', 'true'),
(2, 'Yellow Shirt', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 1, 'yellow.jpg', 'yellow1.jpg', 'yellow2.jpg', 900, '2025-12-17 07:28:11', 'true'),
(3, 'Orange shirt', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 1, 'orange.jpg', 'orange1.jpg', 'orange2.jpg', 700, '2025-12-17 07:28:15', 'true'),
(4, 'red dress', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 2, 'red.jpg', 'red1.jpg', 'red2.jpg', 1500, '2025-12-17 07:28:30', 'false'),
(5, 'Satin Maxi', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 2, 'satinMaxi.jpg', 'satinMaxi1.jpg', 'satinMaxi2.jpg', 2500, '2025-12-17 07:28:18', 'true'),
(6, 'flower dress', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 2, 'flower.jpg', 'flower1.jpg', 'flower2.jpg', 3000, '2025-07-10 17:06:13', 'true'),
(7, 'Black Shirt', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 1, 'black.jpg', 'black1.jpg', 'black2.jpg', 600, '2025-07-10 17:06:50', 'true'),
(8, 'Black and White dress', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 2, 'blackAndwhite.jpg', 'blackAndwhite1.jpg', 'blackAndwhite2.jpg', 900, '2025-12-11 08:46:08', 'true'),
(9, 'Design shirt', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 1, 'design.jpg', 'design1.jpg', 'design2.jpg', 1000, '2025-07-10 17:08:42', 'true'),
(10, 'Yellow shirt', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 1, 'yellow.jpg', 'yellow1.jpg', 'yellow2.jpg', 2500, '2025-12-11 08:28:09', 'true'),
(11, 'Long pattern dress', 'Crew-neck T-Shirt in cotton jersey with crayon logo graphics on the front and back. Regular fit. The model wears size M/48.', 2, 'long_pattern.jpg', 'long_pattern1.jpg', 'long_pattern2.jpg', 5000, '2025-07-10 17:09:58', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `product_id`, `size`) VALUES
(11, 6, 'Small'),
(12, 6, 'Medium'),
(13, 7, 'Medium'),
(14, 7, 'Large'),
(17, 9, 'Small'),
(18, 9, 'Medium'),
(19, 9, 'Large'),
(264, 10, 'small'),
(265, 10, 'medium'),
(266, 10, 'large'),
(287, 8, 'medium'),
(288, 8, 'large'),
(332, 11, 'small'),
(440, 2, 'small'),
(441, 2, 'medium'),
(442, 2, 'large'),
(463, 3, 'small'),
(464, 3, 'large'),
(485, 5, 'small'),
(486, 5, 'medium'),
(507, 4, 'medium'),
(508, 4, 'large'),
(539, 1, 'small'),
(540, 1, 'medium'),
(541, 1, 'large');

-- --------------------------------------------------------

--
-- Structure for view `all_products`
--
DROP TABLE IF EXISTS `all_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_products`  AS SELECT `products`.`product_id` AS `product_id`, `products`.`product_title` AS `product_title`, `products`.`product_description` AS `product_description` FROM `products` WHERE `products`.`status` = 'false''false'  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=542;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `cart_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
