-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2020 at 03:32 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

CREATE DATABASE IF NOT EXISTS OrderInSystem DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE OrderInSystem;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orderinsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_city` varchar(100) NOT NULL,
  `address_state` varchar(100) NOT NULL,
  `address_zip` varchar(50) NOT NULL,
  `address_country` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `rID` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `first_name`, `last_name`, `address_street`, `address_city`, `address_state`, `address_zip`, `address_country`, `admin`, `rID`) VALUES
(6, 'admin@orderin.com', '$2y$10$iJkSl2l6qhqMtx7FGRxxh.9sfEMrXKaYfAwd1mi6cDH.GWEIZvFV.', '', '', '', '', '', '', '', 1, 0),
(12, 'manager1@orderin.com', '$2y$10$MF1vq1l9bB1y.F92Z2nkKODUSljZRIxZ/4/97lBkk3QANnHyRASk.', '', '', '', '', '', '', 'United States', 0, 1),
(13, 'manager2@orderin.com', '$2y$10$wwKEB3LcB3aNztkMM2RQXu/hDzyZ0ga5jG6cIGmJOYn/6K13Oskya', '', '', '', '', '', '', 'United States', 0, 2),
(14, 'manager3@orderin.com', '$2y$10$grB6Qk8JI9RSMZN/exMZKeszQqEofI1OB5d23bdUXYb4PXfp0R0RO', '', '', '', '', '', '', 'United States', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Appetizer'),
(2, 'Entree'),
(3, 'Dessert'),
(4, 'Lunch');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `time` int(2) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `desc`, `price`, `quantity`, `img`, `time`, `date_added`) VALUES
(1, 'Pizza', 'A robust crust with the freshest mozzarella cheese from local farms.', '19.99', 10, 'pizza.jpg', 10, '2020-11-09 02:01:18'),
(2, 'Calzone', 'A pizza that is baked ', '10.99', 65, 'calzone.jpg', 15, '2020-11-09 02:02:32'),
(3, 'Fries', 'Thin cut crispy fries', '5.99', 100, 'fries.jpg', 5, '2020-11-11 18:40:59'),
(4, 'Pasta', 'A homemade pasta with the most robust vodka sauce topped with parsley and parmesan cheese.', '12.99', 49, 'pasta.jpg', 12, '2020-11-11 18:41:42'),
(5, 'Rock Shrimp Tempura', 'Rock shrimp fried in a light tempura batter covered in a sweet and spicy sauce.', '6.99', 50, 'rockshrimp.jpg', 16, '2020-11-11 18:50:40'),
(6, 'Ganga-Style Duck Roll', 'A fried egg role with duck and an assortment of vegetables with a spicy sauce drizzled over the top.', '6.99', 50, 'duckroll.jpg', 7, '2020-11-11 18:53:34'),
(7, 'Soft-Shell Crab Roll', 'Soft shell crab tempura, spicy tuna, avocado and roe wrapped in a soybean nori and served with a spicy eel sauce', '8.99', 50, 'softshellcrab.jpg', 7, '2020-11-11 18:56:22'),
(8, '6x Nigiri Set', 'An assortment of fish with rice on the bottom and a little dollop of wasabi in between. ', '6.99', 49, 'nigiri.jpg', 7, '2020-11-12 01:47:14'),
(9, 'Bacon Cheeseburger', 'Our secret blend, topped with Applewood smoked bacon, American cheese, lettuce, tomato and red onion.', '12.99', 50, 'baconcheeseburger.jpg', 5, '2020-11-12 01:53:06'),
(10, 'Mushroom Cheeseburger', 'Our secret blend topped with the sweetest onions, mushroom and swiss cheese.', '12.99', 1, 'mushroomburger.jpg', 8, '2020-11-12 01:55:19'),
(11, 'BBQ Burger', 'Our secret blend, topped with American cheese, Applewood smoked bacon, fried onion rings, and our house made mesquite BBQ sauce.', '15.99', 50, 'BBQburger.jpg', 12, '2020-11-12 02:02:11'),
(12, 'Cajun Fries', 'Thin cut fries seasoned with our house made Cajun seasoning.', '4.99', 49, 'cajunfries.jpg', 3, '2020-11-12 02:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `items_categories`
--

CREATE TABLE `items_categories` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items_categories`
--

INSERT INTO `items_categories` (`id`, `item_id`, `category_id`) VALUES
(56, 0, 1),
(39, 1, 2),
(40, 2, 2),
(38, 3, 1),
(41, 4, 2),
(42, 5, 1),
(43, 6, 1),
(44, 7, 2),
(45, 8, 2),
(46, 9, 2),
(47, 10, 2),
(48, 11, 2),
(49, 12, 1),
(86, 21, 2);

-- --------------------------------------------------------

--
-- Table structure for table `items_images`
--

CREATE TABLE `items_images` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items_images`
--

INSERT INTO `items_images` (`id`, `item_id`, `img`) VALUES
(150, 0, 'pizza.jpg'),
(88, 1, 'pizza.jpg'),
(90, 2, 'calzone.jpg'),
(99, 3, 'fries.jpg'),
(100, 4, 'pasta.jpg'),
(104, 5, 'rockshrimp.jpg'),
(105, 6, 'duckroll.jpg'),
(106, 7, 'softshellcrab.jpg'),
(114, 8, 'nigiri.jpg'),
(116, 9, 'baconcheeseburger.jpg'),
(118, 10, 'mushroomburger.jpg'),
(120, 11, 'BBQburger.jpg'),
(122, 12, 'cajunfries.jpg'),
(179, 21, 'download.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `items_options`
--

CREATE TABLE `items_options` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items_restaurants`
--

CREATE TABLE `items_restaurants` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items_restaurants`
--

INSERT INTO `items_restaurants` (`id`, `item_id`, `restaurant_id`) VALUES
(41, 0, 0),
(39, 0, 1),
(14, 1, 1),
(15, 2, 1),
(18, 3, 1),
(19, 4, 1),
(24, 5, 2),
(25, 6, 2),
(26, 7, 2),
(29, 8, 2),
(31, 9, 3),
(33, 10, 3),
(35, 11, 3),
(59, 12, 0),
(37, 12, 3),
(61, 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`) VALUES
(1, 'Gino\'s Pizza'),
(2, 'Fancy Lee'),
(3, 'Burger Bar'),
(4, 'Tokyo Ramen'),
(5, 'Better Ramen');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `payment_amount` decimal(7,2) NOT NULL,
  `payment_status` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `payer_email` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(100) NOT NULL DEFAULT '',
  `last_name` varchar(100) NOT NULL DEFAULT '',
  `address_street` varchar(255) NOT NULL DEFAULT '',
  `address_city` varchar(100) NOT NULL DEFAULT '',
  `address_state` varchar(100) NOT NULL DEFAULT '',
  `address_zip` varchar(50) NOT NULL DEFAULT '',
  `address_country` varchar(100) NOT NULL DEFAULT '',
  `account_id` int(11) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'website'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `txn_id`, `payment_amount`, `payment_status`, `created`, `payer_email`, `first_name`, `last_name`, `address_street`, `address_city`, `address_state`, `address_zip`, `address_country`, `account_id`, `payment_method`) VALUES
(18, 'SC5FC913CD87A8DAEA0E', '15.99', 'Completed', '2020-12-03 17:35:25', 'dgee@gmail.com', 'Adam', 'Chin', '28 St Marks Place', 'Roslyn Heights', 'NEW YORK', '11577', 'United States', 1, 'website'),
(19, 'SC5FC914FA70BE4B49CD', '4.99', 'Completed', '2020-12-03 17:40:26', 'dgee@gmail.com', 'Adam', 'Chin', '28 St Marks Place', 'Roslyn Heights', 'NEW YORK', '11577', 'United States', 1, 'website'),
(20, 'SC5FC9167AA49083FFF6', '12.99', 'Completed', '2020-12-03 17:46:50', 'dgee@gmail.com', 'Adam', 'Chin', '28 St Marks Place', 'Roslyn Heights', 'NEW YORK', '11577', 'United States', 1, 'website'),
(21, 'SC5FC9167BEB8A58158C', '12.99', 'Completed', '2020-12-03 17:46:51', 'dgee@gmail.com', 'Adam', 'Chin', '28 St Marks Place', 'Roslyn Heights', 'NEW YORK', '11577', 'United States', 1, 'website'),
(22, 'SC5FC91733B498E640A6', '6.99', 'Completed', '2020-12-03 17:49:55', 'dgee@gmail.com', 'Adam', 'Chin', '28 St Marks Place', 'Roslyn Heights', 'NEW YORK', '11577', 'United States', 1, 'website'),
(23, 'SC5FC9183C9D7AB2709A', '8.99', 'Completed', '2020-12-03 17:54:20', 'dgee@gmail.com', 'Adam', 'Chin', '28 St Marks Place', 'Roslyn Heights', 'NEW YORK', '11577', 'United States', 1, 'website'),
(24, 'SC5FC92A7A88DA1EDB43', '15.99', 'In Progress', '2020-12-03 19:12:10', 'slannon@yahoo.com', 'steven', 'lannon', '23 high street', 'centereach', 'NY', '11720', 'United States', 8, 'website'),
(25, 'SC5FC92C5662EDBFC6CC', '386.33', 'In Progress', '2020-12-03 19:20:06', 'slannon@yahoo.com', 'steven', 'lannon', '23 high street', 'centereach', 'NY', '11720', 'United States', 8, 'website'),
(26, 'SC5FC92C724774448515', '6.99', 'In Progress', '2020-12-03 19:20:34', 'slannon@yahoo.com', 'steven', 'lannon', '23 high street', 'centereach', 'NY', '11720', 'United States', 8, 'website'),
(27, 'SC5FC92CA1AE30D4716C', '15.99', 'In Progress', '2020-12-03 19:21:21', 'slannon@yahoo.com', 'steven', 'lannon', '23 high street', 'centereach', 'NY', '11720', 'United States', 8, 'website'),
(28, 'SC5FC92CBA3DB9E8DA07', '6.99', 'In Progress', '2020-12-03 19:21:46', 'ssss@hotmail.com', 'ssss', 'ssssssss', '234 Mark tree rd', 'ssssss', 'Arkansas', '11720', 'United States', 9, 'website'),
(30, 'SC5FCD8F8ADE0D8C0920', '8.99', 'Completed', '2020-12-07 03:12:26', 'chins5@farmingdale.edu', 'Adam', 'Chin', '500 Street Street', 'Roslyn Heights', 'NEW YORK', '11577', 'United States', 11, 'website'),
(31, 'SC5FD6E4A000B49CE613', '11.98', 'Completed', '2020-12-14 05:05:52', 'chins5@farmingdale.edu', 'Adam', 'Chin', '500 Street Street', 'Roslyn Heights', 'NEW YORK', '11577', 'United States', 11, 'website'),
(32, 'SC5FD9559B02D15ABC19', '12.99', 'In Progress', '2020-12-16 01:32:27', 'chins5@farmingdale.edu', 'Adam', 'Chin', '500 Street Street', 'Roslyn Heights', 'NEW YORK', '11577', 'United States', 11, 'website');

-- --------------------------------------------------------

--
-- Table structure for table `transactions_items`
--

CREATE TABLE `transactions_items` (
  `id` int(11) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` decimal(7,2) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_options` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions_items`
--

INSERT INTO `transactions_items` (`id`, `txn_id`, `item_id`, `item_price`, `item_quantity`, `item_options`) VALUES
(28, 'SC5FC9183C9D7AB2709A', 7, '8.99', 1, ''),
(29, 'SC5FC92A7A88DA1EDB43', 11, '15.99', 1, ''),
(30, 'SC5FC92C5662EDBFC6CC', 12, '4.99', 44, ''),
(31, 'SC5FC92C5662EDBFC6CC', 10, '12.99', 1, ''),
(32, 'SC5FC92C5662EDBFC6CC', 5, '6.99', 22, ''),
(33, 'SC5FC92C724774448515', 8, '6.99', 1, ''),
(34, 'SC5FC92CA1AE30D4716C', 11, '15.99', 1, ''),
(35, 'SC5FC92CBA3DB9E8DA07', 5, '6.99', 1, ''),
(36, 'SC5FCD8F72E13C6D8B61', 12, '4.99', 1, ''),
(37, 'SC5FCD8F8ADE0D8C0920', 7, '8.99', 1, ''),
(38, 'SC5FD6E4A000B49CE613', 12, '4.99', 1, ''),
(39, 'SC5FD6E4A000B49CE613', 8, '6.99', 1, ''),
(40, 'SC5FD9559B02D15ABC19', 4, '12.99', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_categories`
--
ALTER TABLE `items_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_id` (`item_id`,`category_id`);

--
-- Indexes for table `items_images`
--
ALTER TABLE `items_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_id` (`item_id`,`img`);

--
-- Indexes for table `items_options`
--
ALTER TABLE `items_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_restaurants`
--
ALTER TABLE `items_restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_id` (`item_id`,`restaurant_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `txn_id` (`txn_id`);

--
-- Indexes for table `transactions_items`
--
ALTER TABLE `transactions_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items_categories`
--
ALTER TABLE `items_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `items_images`
--
ALTER TABLE `items_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `items_options`
--
ALTER TABLE `items_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `items_restaurants`
--
ALTER TABLE `items_restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `transactions_items`
--
ALTER TABLE `transactions_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
