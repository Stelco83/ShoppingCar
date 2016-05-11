-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2016 at 03:20 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shoppingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_money` double DEFAULT '200'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_id`, `cart_money`) VALUES
(1, 'Drinks', 4, 200),
(2, 'Food', 4, 200),
(3, 'Non Food', 8, 200);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`) VALUES
(14, 'Coke', 1.2),
(15, 'Fanta', 1.2),
(16, 'Rice', 1.4);

-- --------------------------------------------------------

--
-- Table structure for table `product_level`
--

CREATE TABLE IF NOT EXISTS `product_level` (
  `product_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `cash_consume` double NOT NULL,
  `quantity_consume` int(11) NOT NULL,
  `cash_income` double NOT NULL,
  `quantity_income` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_level`
--

INSERT INTO `product_level` (`product_id`, `level_id`, `cash_consume`, `quantity_consume`, `cash_income`, `quantity_income`) VALUES
(14, 0, 0, 0, 0, 0),
(14, 1, 1.2, 1, 1.2, 1),
(15, 0, 0, 0, 0, 0),
(16, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Cash` double NOT NULL DEFAULT '200'
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `Cash`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 200),
(3, 'gosho', 'caf1a3dfb505ffed0d024130f58c5cfa', 200),
(4, 'ivan', 'caf1a3dfb505ffed0d024130f58c5cfa', 200),
(7, 'penka', 'caf1a3dfb505ffed0d024130f58c5cfa', 200),
(8, 'dido', 'caf1a3dfb505ffed0d024130f58c5cfa', 200),
(13, 'pencho', '202cb962ac59075b964b07152d234b70', 200),
(60, 'nikoj', '202cb962ac59075b964b07152d234b70', 200),
(84, 'Ss', '202cb962ac59075b964b07152d234b70', 200),
(121, 'temelko', '202cb962ac59075b964b07152d234b70', 200),
(123, 'Miliko', '202cb962ac59075b964b07152d234b70', 200),
(126, '11', '6512bd43d9caa6e02c990b0a82652dca', 200),
(144, '1234', '202cb962ac59075b964b07152d234b70', 200),
(145, 'pesho', '202cb962ac59075b964b07152d234b70', 200);

-- --------------------------------------------------------

--
-- Table structure for table `user_products`
--

CREATE TABLE IF NOT EXISTS `user_products` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_products`
--

INSERT INTO `user_products` (`id`, `user_id`, `category_id`, `product_id`, `level_id`) VALUES
(8, 4, 1, 14, 0),
(9, 4, 2, 15, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`), ADD KEY `FK_categories_users` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_level`
--
ALTER TABLE `product_level`
 ADD PRIMARY KEY (`product_id`,`level_id`), ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_products`
--
ALTER TABLE `user_products`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `product_id` (`product_id`), ADD KEY `level_id` (`level_id`), ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `user_products`
--
ALTER TABLE `user_products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
ADD CONSTRAINT `FK_categories_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_level`
--
ALTER TABLE `product_level`
ADD CONSTRAINT `FK_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_products`
--
ALTER TABLE `user_products`
ADD CONSTRAINT `FK_user_products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_user_products_product_level` FOREIGN KEY (`product_id`) REFERENCES `product_level` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_user_products_product_level_2` FOREIGN KEY (`level_id`) REFERENCES `product_level` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_user_products_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
