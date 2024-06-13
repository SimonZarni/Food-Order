-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 08:40 PM
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
(3, 'Helilin', 'helilin15@gmail.com', '$2y$10$j23zlTVYKpo.BCFvNHWRHeiyfKKLO1u8AVUYKWdFeGHBkxBqKZLx.');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `item_id`, `quantity`, `status`) VALUES
(292, 3, 13, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `delivery_date` date NOT NULL,
  `township_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `order_code`, `user_id`, `phone`, `address`, `delivery_date`, `township_id`, `status`) VALUES
(3, '50605', 4, 9545454, 'Manaladay', '2024-05-15', 2, 'Delivered'),
(4, '19983', 4, 0, ' City Mart Super Market, 19th St', '2024-05-16', 3, 'Delivered'),
(5, '2433', 4, 0, 'Manaladay', '2024-05-18', 1, 'Delivered'),
(6, '54751', 3, 9585858, '84 street 36x37', '2024-05-24', 1, 'Delivered'),
(7, '67657', 3, 9787878, '35 street', '2024-05-24', 2, 'Delivered'),
(8, '74776', 3, 9525252, '120 street', '2024-05-25', 4, 'Delivered'),
(9, '17796', 3, 9212121, '35 street', '2024-05-25', 2, 'Delivered'),
(10, '44970', 3, 9585858, '84 street 36x37', '2024-06-01', 1, 'Delivered'),
(11, '73220', 3, 9212121, '35 street', '2024-06-02', 2, 'Delivered'),
(12, '94391', 3, 9686868, '120 street', '2024-06-02', 4, 'Delivered'),
(13, '54846', 3, 9525252, '84 street', '2024-06-04', 1, 'Delivered'),
(14, '1547', 3, 9414141, '84 street', '2024-06-06', 1, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`id`, `user_id`, `restaurant_id`) VALUES
(1, 4, 6),
(2, 4, 5);

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
(6, 'Ykko Seafood Kyay Oh', 'photo_9_2024-05-28_10-20-16.jpg', 10000, 'Spicy', 1, 3, ''),
(7, 'Spicy Chicken Wing', 'kfc-spicy.jpg', 3300, 'Spicy Chicken', 3, 7, ''),
(8, 'PHP Laravel', 'bg1.jpg', 4000, 'AKS', 6, 3, ''),
(9, 'Apple Juice', 'juice.jpg', 6000, 'Fresh Apple Juice', 1, 4, ''),
(13, 'Zarni', 'bg2.jpg', 6500, 'AA', 5, 11, ''),
(16, 'JavaScript', 'food2.png', 5500, 'Javascript', 4, 9, ''),
(18, 'JieJie', 'bg3.jpg', 5000, 'JieJie', 6, 3, ''),
(19, 'Ice Latte Coffee', 'food3.jpg', 16000, 'Creamy Ice Latte Coffee', 9, 12, ''),
(20, 'MaLaXiangGuo (Seafood)', 'malaxiangguo.jpg', 20000, '3x spicy', 11, 14, ''),
(21, 'SP Chocolate Cake', 'cake.jpg', 6000, 'Creamy chocolate flavour', 12, 15, ''),
(22, 'Salmon Sushi', 'sushi1.jpg', 15000, 'Salmon', 13, 17, ''),
(23, 'Ykko Oil Noodle', 'photo_9_2024-05-28_10-20-16.jpg', 6700, 'chicken oil noodle', 1, 3, ''),
(24, 'Ykko Chicken Satay', 'photo_13_2024-05-28_10-20-16.jpg', 5000, '3pcs chicken sticks', 1, 18, ''),
(25, 'Ykko Pork Satay', 'photo_5_2024-05-28_10-20-16.jpg', 5500, '3pcs pork sticks', 1, 18, ''),
(26, 'Ykko Kyay Oh set+Cocacola', 'photo_30_2024-05-28_10-20-16.jpg', 11000, 'Kyay Oh+ Cocacola', 1, 19, ''),
(27, 'XiaoLongKhan Hotpot', 'image__1_.0.jpg', 40000, 'Spicy Hotpot', 10, 20, ''),
(28, 'jj', 'bg.jpg', 500000, 'jnj', 3, 4, 'deleted');

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
(4, 'Drinks', 'drink.jpg', ''),
(7, 'Chicken', 'chicken1.png', ''),
(9, 'Pizza', 'food2.png', ''),
(11, 'Fries', 'fried.jpg', ''),
(12, 'Coffee', 'coffee1.jpg', NULL),
(13, 'Chinese', 'chinesefood.jpg', NULL),
(14, 'MaLaXiangGuo', 'malaxiangguo.jpg', NULL),
(15, 'Cake', 'cake.jpg', NULL),
(16, 'Bread', 'bread.jpg', NULL),
(17, 'Japanese', 'food5.png', NULL),
(18, 'Satay', 'photo_13_2024-05-28_10-20-16.jpg', NULL),
(19, 'Set', 'photo_30_2024-05-28_10-20-16.jpg', NULL),
(20, 'Hotpot', 'image__1_.0.jpg', NULL);

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
(144, 50605, 1, '5000', '2024-05-15', '13:33:00', 4, 9, 2, 2),
(146, 19983, 1, '6000', '2024-05-16', '14:23:00', 4, 7, 3, 5),
(147, 2433, 2, '20000', '2024-05-18', '15:09:00', 4, 6, 1, 5),
(148, 54751, 2, '20000', '2024-05-24', '16:27:00', 3, 6, 1, 1),
(149, 54751, 3, '18000', '2024-05-24', '16:27:00', 3, 9, 1, 1),
(150, 67657, 3, '9900', '2024-05-24', '16:37:00', 3, 7, 2, 2),
(151, 74776, 2, '32000', '2024-05-25', '09:20:00', 3, 19, 4, 4),
(152, 17796, 1, '20000', '2024-05-25', '09:32:00', 3, 20, 2, 4),
(153, 44970, 2, '20000', '2024-06-01', '21:13:00', 3, 6, 1, 1),
(154, 73220, 3, '9900', '2024-06-02', '21:15:00', 3, 7, 2, 5),
(155, 94391, 1, '10000', '2024-06-02', '21:19:00', 3, 6, 4, 5),
(156, 94391, 2, '12000', '2024-06-02', '21:19:00', 3, 9, 4, 5),
(157, 18756, 3, '30000', '2024-06-03', '14:33:00', 3, 6, 1, 1),
(158, 18756, 2, '12000', '2024-06-03', '14:33:00', 3, 9, 1, 1),
(159, 54846, 2, '20000', '2024-06-04', '14:08:00', 3, 6, 1, 1),
(160, 12081, 2, '20000', '2024-06-05', '14:20:00', 3, 6, 1, 1),
(161, 27721, 2, '13400', '2024-06-05', '14:33:00', 3, 23, 2, 2),
(162, 1547, 3, '18000', '2024-06-06', '21:34:00', 3, 9, 1, 5),
(163, 1547, 2, '20000', '2024-06-06', '21:34:00', 3, 6, 1, 5),
(164, 78700, 1, '10000', '2024-06-07', '13:58:00', 3, 6, 1, 1),
(165, 13828, 1, '6000', '2024-06-07', '14:04:00', 3, 9, 1, 2),
(166, 13828, 1, '6700', '2024-06-07', '14:04:00', 3, 23, 1, 2),
(167, 83403, 1, '11000', '2024-06-10', '00:59:00', 3, 26, 1, 1),
(168, 83403, 1, '6000', '2024-06-10', '00:59:00', 3, 9, 1, 1),
(169, 99461, 1, '15000', '2024-06-10', '01:03:00', 3, 22, 2, 2);

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
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_code`, `subtotal`, `order_date`, `order_time`, `user_id`, `township_id`, `phone`, `address`, `status`) VALUES
(49, 50605, 6500, '2024-05-15', '13:33:00', 4, 2, 9545454, 'Manaladay', 'Accepted'),
(51, 19983, 8000, '2024-05-16', '14:23:00', 4, 3, 9656565, ' City Mart Super Market, 19th St', 'Accepted'),
(52, 2433, 21000, '2024-05-18', '15:09:00', 4, 1, 989289, 'Manaladay', 'Accepted'),
(53, 54751, 39000, '2024-05-24', '16:27:00', 3, 1, 9585858, '84 street 36x37', 'Accepted'),
(54, 67657, 11400, '2024-05-24', '16:37:00', 3, 2, 9787878, '35 street', 'Accepted'),
(55, 74776, 34000, '2024-05-25', '09:20:00', 3, 4, 9525252, '120 street', 'Accepted'),
(56, 17796, 21500, '2024-05-25', '09:32:00', 3, 2, 9212121, '35 street', 'Accepted'),
(57, 44970, 21000, '2024-06-01', '21:13:00', 3, 1, 9585858, '84 street 36x37', 'Accepted'),
(58, 73220, 11400, '2024-06-02', '21:15:00', 3, 2, 9212121, '35 street', 'Accepted'),
(59, 94391, 24000, '2024-06-02', '21:19:00', 3, 4, 9686868, '120 street', 'Accepted'),
(60, 18756, 43000, '2024-06-03', '14:33:00', 3, 1, 9212121, '84 street', 'Declined'),
(61, 54846, 21000, '2024-06-04', '14:08:00', 3, 1, 9525252, '84 street', 'Accepted'),
(62, 12081, 21000, '2024-06-05', '14:20:00', 3, 1, 9414141, '84 street', 'Declined'),
(63, 27721, 14900, '2024-06-05', '14:33:00', 3, 2, 48789, 'dh', 'Declined'),
(64, 1547, 39000, '2024-06-06', '21:34:00', 3, 1, 9414141, '84 street', 'Accepted'),
(65, 78700, 11000, '2024-06-07', '13:58:00', 3, 1, 9414141, '84 street', 'Pending'),
(66, 13828, 13700, '2024-06-07', '14:04:00', 3, 1, 9525252, '84 street', 'Pending'),
(67, 83403, 18000, '2024-06-10', '00:59:00', 3, 1, 88, '77', 'Pending'),
(68, 99461, 14850, '2024-06-10', '01:03:00', 3, 2, 22, '55', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `method`, `status`) VALUES
(1, 'KBZPay', ''),
(2, 'AyaPay', ''),
(4, 'CBPay', ''),
(5, 'Cash On Delivery', '');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `voucher_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `restaurant_id`, `name`, `discount`, `voucher_code`) VALUES
(4, 1, '', 20, '58896'),
(7, 13, '', 10, '65422'),
(10, 3, '', 10, '325455'),
(11, 4, '', 20, '554714'),
(12, 5, '', 15, '012147'),
(13, 6, '', 15, '652114'),
(14, 9, '', 20, '114565'),
(15, 10, '', 10, '988754'),
(16, 11, '', 15, '232154'),
(17, 12, '', 20, '775474');

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
(1, 'YKKO', 'ykko-logo.jpg', 'ykko.jpg', '68 street', '', '9:30am - 5:30pm', ''),
(3, 'KFC', 'restaurant-logo.png', 'restaurant-bg.jpeg', '73 street', '', '9am - 6pm', ''),
(4, 'Pizza Hut', 'restaurant-logo1.png', 'bg1.png', '73 street', '', '', ''),
(5, 'Lotteria', 'lotteria-log.jpg', 'lotteria.png', '73 street', '', '9am - 5:30pm', ''),
(6, 'OMuk', 'omuk-logo.jpg', 'omuk.jpg', '73 street', '', '9:30am - 5:30pm', ''),
(9, 'Starbuck', 'starbuck-logo.png', 'starbuck.jpg', ' City Mart Super Market, 19th St', '', '9am - 5:30pm', NULL),
(10, 'XiaoLongKan', 'xiaolongkan-logo.jpg', 'laolongkan.jpg', 'Corner of 53rd and 31st x 32nd street, Chan Aye Thazan Township', '', '3pm - 9pm', NULL),
(11, 'Chilli Pot', 'chillipot-logo.jpg', 'chillipot.jpg', '80st 30x31st', '', '9am - 5:30pm', NULL),
(12, 'SP Bakery', 'spbakery.png', 'spbakerybg.jpg', '62st 105st', '', '9am - 6pm', NULL),
(13, 'Sushi Bar', 'sushibar-logo.jpg', 'sushibar.jpg', 'Infront Of Bagaya Monastery,Sagaing-Mandalay Road', '', '9am - 9pm', NULL);

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
(22, 4, 3, 'Pizza Hut Noodle', NULL),
(23, 9, 12, 'Starbuck Coffee', NULL),
(24, 9, 4, 'Starbuck Drinks', NULL),
(25, 11, 13, 'Chilli Pot Chinese', NULL),
(26, 11, 14, 'Chilli Pot MaLaXiangGuo', NULL),
(27, 12, 16, 'SP Bakery Bread', NULL),
(28, 12, 15, 'SP Bakery Cake', NULL),
(29, 12, 4, 'SP Bakery Drinks', NULL),
(30, 13, 17, 'Sushi Bar Japanese', NULL),
(31, 1, 18, 'YKKO Satay', NULL),
(32, 1, 19, 'YKKO set', NULL),
(33, 10, 20, 'XiaoLongKan Hotpot', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `township`
--

CREATE TABLE `township` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fee` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
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
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `address`, `status`) VALUES
(3, 'Simon', 'simonzarni03@gmail.com', '$2y$10$yh11S26KyS6QVU3R8FkIg.vZGA5DM28LpCmiL6fFdCTX7nR2Q/71G', '', ''),
(4, 'Helilin', 'helilin15@gmail.com', '$2y$10$B6s/rR6QxJFKERa6kvoADuOdvUoz28zhqxLP1oHYBJkcwSIr0/Cx2', '', ''),
(5, 'hedowi', 'hedowi2389@funvane.com', '$2y$10$mqaGoBlsGn1LXmKxtMDWzuq6pDCoD7S/HAz4CMr4.GZQPRle7zl2m', '', '');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `township_id` (`township_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `restaurant_menu`
--
ALTER TABLE `restaurant_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `township`
--
ALTER TABLE `township`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`township_id`) REFERENCES `township` (`id`),
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`),
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
-- Constraints for table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `promotion_ibfk_3` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

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