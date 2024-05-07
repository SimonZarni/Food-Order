-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2024 at 06:36 PM
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
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(2, 'Simon', 'simonallen364@gmail.com', '$2y$10$J8Okx/sO/dXHD8i4ehguEOxE426WHuaLpzlgtiKIxnfJul1BuuPiy'),
(3, 'KaNaung', 'naymyokanaung@gmail.com', '$2y$10$JLj0jkaOBEorNq1ObOTf3eOLMsJ48/s5woeMGGfu87Wy3CsSFNHTy');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `order_code` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `delivery_date` varchar(255) NOT NULL,
  `township_id` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `order_code`, `user_id`, `address`, `delivery_date`, `township_id`, `status`) VALUES
(9, 17453, 6, '60 street . 131 . Pyigyitagon Township. Mandalay', '2024-05-06', '4', 'Delivered'),
(10, 50759, 6, '60 street . 131 . Pyigyitagon Township. Mandalay', '2024-05-06', '4', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `image`, `price`, `description`, `restaurant_id`, `menu_id`, `status`) VALUES
(6, 'Simon', 'bg.jpg', 5000, 'Spicy', 1, 11, ''),
(7, 'Java Se', 'bg.png', 6000, 'Delicious', 3, 7, ''),
(8, 'PHP Laravel', 'bg1.jpg', 4000, 'AKS', 6, 3, ''),
(9, 'C++', 'bg1.png', 5000, 'Cold', 1, 4, ''),
(13, 'Zarni', 'bg2.jpg', 6500, 'AA', 5, 11, ''),
(16, 'JavaScript', 'food2.png', 5500, 'Javascript', 4, 9, ''),
(18, 'JieJie', 'bg3.jpg', 5000, 'JieJie', 6, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `image`, `status`) VALUES
(3, 'Noodle', 'noodle.jpg', ''),
(4, 'Drinks', 'drinks.png', ''),
(7, 'Chicken', 'chicken1.png', ''),
(9, 'Pizza', 'pizza.jpg', ''),
(11, 'Fries', 'fries.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_code` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_code`, `quantity`, `total_price`, `order_date`, `order_time`, `user_id`, `item_id`, `township_id`, `payment_id`) VALUES
(182, 55002, 1, '6000', '2024-05-05', '09:37:00', 6, 7, 4, 5),
(183, 86992, 2, '12000', '2024-05-05', '09:37:00', 6, 7, 1, 1),
(184, 30194, 3, '18000', '2024-05-05', '10:43:00', 6, 7, 2, 2),
(185, 90351, 1, '5000', '2024-05-05', '11:16:00', 7, 6, 4, 5),
(186, 90351, 1, '5000', '2024-05-05', '11:16:00', 7, 9, 4, 5),
(187, 1979, 4, '20000', '2024-05-06', '21:06:00', 6, 18, 4, 1),
(188, 32027, 1, '4000', '2024-05-06', '21:10:00', 6, 8, 4, 5),
(189, 17453, 5, '20000', '2024-05-06', '22:21:00', 6, 8, 4, 1),
(190, 50759, 2, '10000', '2024-05-06', '22:22:00', 6, 18, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_code` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_code`, `subtotal`, `order_date`, `order_time`, `user_id`, `township_id`, `address`, `status`) VALUES
(77, 17453, 32000, '2024-05-06', '22:21:00', 6, 4, '60 street . 131 . Pyigyitagon Township. Mandalay', 'Accepted'),
(78, 50759, 32000, '2024-05-06', '22:22:00', 6, 4, '60 street . 131 . Pyigyitagon Township. Mandalay', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `method`, `status`) VALUES
(1, 'KBZPay', ''),
(2, 'AyaPay', ''),
(4, 'CBPay', ''),
(5, 'Cash On Delivery', NULL),
(6, 'Wave Money', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `bg_img` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `time_status` varchar(255) NOT NULL,
  `open_time` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `profile_img`, `bg_img`, `address`, `time_status`, `open_time`, `status`) VALUES
(1, 'YKKO', '', '', '68 street', '', '', ''),
(3, 'KFC', 'restaurant-logo.png', 'restaurant-bg.jpeg', '73 street', '', '9am - 6pm', ''),
(4, 'Pizza Hut', 'restaurant-logo1.png', 'bg1.png', '73 street', '', '', ''),
(5, 'Lotteria', '', '', '73 street', '', '', ''),
(6, 'OMuk', '', '', '73 street', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_menu`
--

CREATE TABLE `restaurant_menu` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `restaurant_menu` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant_menu`
--

INSERT INTO `restaurant_menu` (`id`, `restaurant_id`, `menu_id`, `restaurant_menu`, `status`) VALUES
(1, 1, 3, 'YKKO Noodle', ''),
(2, 1, 4, 'YKKO Drinks', ''),
(3, 3, 4, 'KFC Drinks', ''),
(4, 3, 7, 'KFC Chicken', ''),
(6, 4, 9, 'Pizza Hut Pizza', ''),
(8, 4, 4, 'Pizza Hut Drinks', ''),
(11, 5, 7, 'Lotteria Chicken', ''),
(12, 5, 11, 'Lotteria Fries', ''),
(13, 6, 3, 'OMuk Noodle', ''),
(21, 1, 11, 'YKKO Fries', NULL),
(22, 4, 3, 'Pizza Hut Noodle', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `township`
--

CREATE TABLE `township` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fee` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `township`
--

INSERT INTO `township` (`id`, `name`, `fee`, `status`) VALUES
(1, 'Mahar AungMyay', '1000', ''),
(2, 'Chan Aye Tharzan', '1500', ''),
(3, 'Chan Mya Tharzi', '2000', ''),
(4, 'Pyi Gyi Tagon', '2000', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `address`, `status`) VALUES
(3, 'Simon', 'simonzarni03@gmail.com', '$2y$10$yh11S26KyS6QVU3R8FkIg.vZGA5DM28LpCmiL6fFdCTX7nR2Q/71G', '', ''),
(4, 'Helilin', 'helilin15@gmail.com', '$2y$10$B6s/rR6QxJFKERa6kvoADuOdvUoz28zhqxLP1oHYBJkcwSIr0/Cx2', '', ''),
(5, 'hedowi', 'hedowi2389@funvane.com', '$2y$10$mqaGoBlsGn1LXmKxtMDWzuq6pDCoD7S/HAz4CMr4.GZQPRle7zl2m', '', ''),
(6, 'KaNaung', 'naymyokanaung@gmail.com', '$2y$10$nz2UC993qyCx01SwZDpRZO1PtEGs8vveOhIn70ybO2k4wGCVxeoVC', NULL, NULL),
(7, 'kanaung', 'nayhtet11march@gmail.com', '$2y$10$QTIanvCq6g/2IxRmr8UAuuHZcieS8h2vVGWBo3krgPztv9..SCgsm', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentMethod_id` (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `township_id` (`township_id`),
  ADD KEY `order_ibfk_1` (`item_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `township_id` (`township_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_menu`
--
ALTER TABLE `restaurant_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `township`
--
ALTER TABLE `township`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `restaurant_menu`
--
ALTER TABLE `restaurant_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `township`
--
ALTER TABLE `township`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`),
  ADD CONSTRAINT `item_ibfk_3` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`township_id`) REFERENCES `township` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`township_id`) REFERENCES `township` (`id`);

--
-- Constraints for table `restaurant_menu`
--
ALTER TABLE `restaurant_menu`
  ADD CONSTRAINT `restaurant_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `restaurant_menu_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
