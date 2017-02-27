-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2016 at 03:42 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeigniter_evidence`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_product`
--

CREATE TABLE `add_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `productid` int(10) UNSIGNED NOT NULL,
  `stock` smallint(5) UNSIGNED NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, 'Frozen'),
(4, 'Grocery'),
(3, 'Home Appliance'),
(1, 'Vagetable');

-- --------------------------------------------------------

--
-- Table structure for table `per_page`
--

CREATE TABLE `per_page` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_page`
--

INSERT INTO `per_page` (`id`, `name`) VALUES
(1, 4),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `vat` float(6,2) NOT NULL,
  `discount` float(4,2) NOT NULL,
  `categoryid` tinyint(4) UNSIGNED NOT NULL,
  `type` varchar(1) NOT NULL,
  `stock` smallint(6) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `price`, `vat`, `discount`, `categoryid`, `type`, `stock`, `picture`) VALUES
(55, 'Capsicum', 'No waiting in traffic, no haggling, no worries carrying groceries, they&#039;re delivered right at your door.', 365, 0.00, 0.00, 1, 'N', 30, 'jpg'),
(56, 'Tomato', 'Our fresh produce is sourced every morning, you get the best from us.', 80, 0.00, 0.00, 1, 'N', 50, 'jpg'),
(57, 'Carrot', 'Our fresh produce is sourced every morning, you get the best from us.', 66, 0.00, 0.00, 1, 'N', 100, 'jpg'),
(58, 'Latose Leaf', 'Our fresh produce is sourced every morning, you get the best from us.', 90, 0.00, 0.00, 1, 'N', 5, 'jpg'),
(59, 'Potato', 'Our fresh produce is sourced every morning, you get the best from us.', 27, 0.00, 0.00, 1, 'N', 200, 'jpg'),
(60, 'Pumkin', 'Our fresh produce is sourced every morning, you get the best from us.', 30, 0.00, 0.00, 1, 'N', 100, 'jpg'),
(61, 'White Melone', 'Our fresh produce is sourced every morning, you get the best from us.', 30, 0.00, 0.00, 1, 'N', 50, 'jpg'),
(62, 'Corn', 'Our fresh produce is sourced every morning, you get the best from us.', 23, 0.00, 0.00, 1, 'N', 60, 'jpg'),
(64, 'Ayer Fish (River)', 'Our fresh produce is sourced every morning, you get the best from us.', 700, 0.00, 0.00, 2, 'N', 20, 'jpg'),
(65, 'Baila Fish (Fiver)', 'Our fresh produce is sourced every morning, you get the best from us.', 760, 0.00, 0.00, 2, 'N', 30, 'jpg'),
(66, 'Hislah Fish', 'Our fresh produce is sourced every morning, you get the best from us.', 1200, 0.00, 0.00, 2, 'N', 100, 'jpg'),
(67, 'Beef Meat', 'Our fresh produce is sourced every morning, you get the best from us.', 520, 0.00, 0.00, 2, 'N', 300, 'jpg'),
(68, 'Jhinga', 'Our fresh produce is sourced every morning, you get the best from us.', 60, 0.00, 0.00, 1, 'N', 40, 'jpg'),
(69, 'Kancha Morich', 'Our fresh produce is sourced every morning, you get the best from us.', 200, 0.00, 0.00, 1, 'N', 100, 'jpg'),
(70, 'Pui Shak', 'Our fresh produce is sourced every morning, you get the best from us.', 20, 0.00, 0.00, 1, 'N', 40, 'jpg'),
(71, 'Lal Shak', 'Our fresh produce is sourced every morning, you get the best from us.', 20, 0.00, 0.00, 1, 'N', 30, 'jpg'),
(72, 'Salmon Fish (Rui)', 'Our fresh produce is sourced every morning, you get the best from us.', 280, 0.00, 0.00, 2, 'N', 50, 'jpg'),
(74, 'Shrimp fish', 'Our fresh produce is sourced every morning, you get the best from us.', 700, 0.00, 0.00, 2, 'N', 30, 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` smallint(5) UNSIGNED NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `payment` varchar(30) NOT NULL,
  `date` datetime NOT NULL,
  `ddate` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesdetails`
--

CREATE TABLE `salesdetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `productid` int(10) UNSIGNED NOT NULL,
  `vat` float(6,2) NOT NULL,
  `discount` float(4,2) NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL,
  `salesid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `type` char(1) NOT NULL,
  `status` varchar(12) NOT NULL,
  `reset_pass` varchar(12) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `type`, `status`, `reset_pass`, `datetime`) VALUES
(1, '', 'hasancse016@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'a', '', '8qbtbFHXeKHt', '2016-10-05 12:55:47'),
(2, 'Shah Fuad Md. Tareq', 'tareq142@gmail.com', '202cb962ac59075b964b07152d234b70', 'c', '', '', '0000-00-00 00:00:00'),
(3, 'Muzammil', 'muzammil@gmail.com', '202cb962ac59075b964b07152d234b70', 'c', '', '', '0000-00-00 00:00:00'),
(4, 'shams sumon', 'shams755@gmail.com', '202cb962ac59075b964b07152d234b70', 'c', '', '', '0000-00-00 00:00:00'),
(5, 'Md. Mohsi Patwary', 'patwarydk@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'a', '', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_product`
--
ALTER TABLE `add_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `per_page`
--
ALTER TABLE `per_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `salesdetails`
--
ALTER TABLE `salesdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `salesid` (`salesid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_product`
--
ALTER TABLE `add_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `per_page`
--
ALTER TABLE `per_page`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `salesdetails`
--
ALTER TABLE `salesdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_product`
--
ALTER TABLE `add_product`
  ADD CONSTRAINT `add_product_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `salesdetails`
--
ALTER TABLE `salesdetails`
  ADD CONSTRAINT `salesdetails_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `salesdetails_ibfk_2` FOREIGN KEY (`salesid`) REFERENCES `sales` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
