-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2019 at 11:56 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s17114146`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Customer_ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PostCode` varchar(10) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Customer_ID`, `Name`, `Address`, `PostCode`, `Email`, `Password`) VALUES
(0, '', '', '', '', ''),
(1, 'Name1', '123 Sample Street', 'S21 4a3', 'customer1@email.com', 'saepDgtryRTsw'),
(2, 'Name2', '1 parliament square', 'S21 4a3', 'customer2@email.com', 'saepDgtryRTsw'),
(9, 'Name3', 'University', 'b21 5ed', 'customer3@email.com', 'saepDgtryRTsw'),
(10, 'Nam4', 'sample road', 'Postcode', 'customer4@email.com', 'saQ30SFLolsHo'),
(14, '123', '123', '123', '123', 'saepDgtryRTsw');

-- --------------------------------------------------------

--
-- Table structure for table `order line`
--

CREATE TABLE `order line` (
  `Order_Line_Number` int(10) NOT NULL,
  `Order_ID` int(10) NOT NULL,
  `Product_ID` int(10) NOT NULL,
  `Size` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order line`
--

INSERT INTO `order line` (`Order_Line_Number`, `Order_ID`, `Product_ID`, `Size`) VALUES
(14, 8, 1, 'S'),
(15, 6, 1, 'S'),
(16, 6, 3, 'L'),
(17, 6, 3, 'L'),
(18, 6, 3, 'L'),
(19, 7, 1, 'S'),
(20, 7, 1, 'S'),
(21, 7, 4, 'L'),
(22, 7, 4, 'L'),
(23, 9, 3, 'S'),
(24, 9, 3, 'S'),
(25, 9, 3, 'S'),
(26, 9, 3, 'S'),
(27, 10, 1, 'S'),
(28, 10, 1, 'S'),
(29, 11, 1, 'S'),
(30, 11, 1, 'S'),
(31, 12, 4, 'S'),
(32, 12, 3, 'S'),
(33, 12, 2, 'S'),
(34, 13, 2, 'S'),
(35, 13, 2, 'S'),
(36, 13, 2, 'S'),
(37, 14, 4, 'S'),
(38, 14, 4, 'S'),
(39, 14, 4, 'S'),
(40, 14, 4, 'S'),
(41, 14, 2, 'S'),
(42, 14, 2, 'S'),
(43, 14, 2, 'S'),
(44, 15, 1, 'S'),
(45, 15, 1, 'S'),
(46, 15, 1, 'S'),
(47, 15, 1, 'S'),
(48, 15, 1, 'S'),
(49, 15, 1, 'S'),
(50, 15, 1, 'S'),
(51, 15, 1, 'S'),
(52, 15, 1, 'S'),
(53, 15, 1, 'S'),
(54, 15, 1, 'S'),
(55, 15, 1, 'S'),
(56, 15, 1, 'S'),
(57, 15, 1, 'S'),
(58, 15, 1, 'S'),
(59, 15, 1, 'S'),
(60, 15, 1, 'S'),
(61, 15, 1, 'S'),
(62, 15, 1, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` int(10) NOT NULL,
  `Customer_ID` int(10) NOT NULL,
  `Deliver_Address` varchar(255) NOT NULL,
  `Delivery_Postcode` varchar(255) NOT NULL,
  `Delivery_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_ID`, `Customer_ID`, `Deliver_Address`, `Delivery_Postcode`, `Delivery_Name`) VALUES
(5, 0, 'test', 'test', 'test'),
(6, 0, 'sample road', 'test', 'test'),
(7, 10, '420 ganga square', 'WE42 0ED', 'bob marley'),
(8, 10, '420 ganga square', 'WE42 0ED', 'bob marley'),
(9, 14, 'test', 'test', 'tes'),
(10, 0, '', '', ''),
(11, 10, 'sample road', 'b21 4up', 'sdf'),
(12, 10, 'test', 'ex4 mpl3', 'test'),
(13, 10, '1 parliament square', 'SW1A 0AA', 'harry a smith'),
(14, 10, 'sample road', 'Postcode', 'sdf'),
(15, 10, 'sample road', 'ex4 mpl3', 'sdf');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` decimal(5,2) NOT NULL,
  `Description` mediumtext NOT NULL,
  `Image` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_ID`, `Name`, `Price`, `Description`, `Image`) VALUES
(1, 'Blue Jeans', '7.49', 'Slim fit Blue Jeans', 'data:image/jpeg;base64,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'),
(2, 'Black Jeans', '7.49', 'Slim fit Black Jeans', 'data:image/jpeg;base64,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'),
(3, 'Skinny black troussers', '10.00', 'Skinny Black Troussers', 'data:image/jpeg;base64,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'),
(4, 'White Jeans', '25.00', 'Skinny White Jeans', 'https://images.asos-media.com/products/asos-design-super-skinny-jeans-in-white/8005338-1-white?$XL$?$XXL$&wid=300&fmt=jpeg&qlt=80,0&op_sharpen=0&resMode=sharp2&op_usm=1,0.4,6,1&iccEmbed=0&printRes=72');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `Review_ID` int(10) NOT NULL,
  `Product_ID` int(10) NOT NULL,
  `ReviewDate` date NOT NULL,
  `Review` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`Review_ID`, `Product_ID`, `ReviewDate`, `Review`) VALUES
(1, 1, '2019-01-14', 'Example Review'),
(2, 1, '2019-01-08', 'Example Review'),
(3, 2, '2019-01-01', 'Example review, Looks pretty'),
(4, 2, '2019-01-09', 'Fits nice'),
(5, 3, '2019-01-11', 'Example Review'),
(6, 4, '2019-01-06', 'Example Review, Some stuff blah blah blah'),
(7, 3, '2019-01-09', 'Stuff Stuff Stuff, Review text Lorum ipsm'),
(8, 4, '2019-01-12', 'The troussers fit nice'),
(9, 3, '2019-01-14', 'Blah blah blah blah blah blaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Permission_Level` int(1) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_ID`, `Name`, `Permission_Level`, `Email`, `Password`) VALUES
(1, 'name', 3, 'admin@admin.com', 'saepDgtryRTsw');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `Q_Index` int(10) NOT NULL,
  `Product_ID` int(10) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `Size` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`Q_Index`, `Product_ID`, `Quantity`, `Size`) VALUES
(1, 1, 118, 'S'),
(2, 1, 211, 'M'),
(3, 1, 74, 'L'),
(4, 2, 55, 'S'),
(5, 2, 83, 'M'),
(6, 2, 98, 'L'),
(7, 3, 47, 'S'),
(8, 3, 59, 'M'),
(9, 3, 70, 'L'),
(10, 4, 95, 'S'),
(11, 4, 70, 'M'),
(12, 4, 150, 'L');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Customer_ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Customer_ID` (`Customer_ID`);

--
-- Indexes for table `order line`
--
ALTER TABLE `order line`
  ADD PRIMARY KEY (`Order_Line_Number`),
  ADD UNIQUE KEY `Order_Line_Number` (`Order_Line_Number`),
  ADD KEY `FKOrder Line395118` (`Product_ID`),
  ADD KEY `FKOrder Line474240` (`Order_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`),
  ADD UNIQUE KEY `Order_ID` (`Order_ID`),
  ADD KEY `FKOrders240764` (`Customer_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_ID`),
  ADD UNIQUE KEY `Product_ID` (`Product_ID`),
  ADD KEY `Product_ID_2` (`Product_ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`Review_ID`),
  ADD UNIQUE KEY `Review_ID` (`Review_ID`),
  ADD KEY `FKReviews500589` (`Product_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Staff_ID` (`Staff_ID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`Q_Index`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Customer_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order line`
--
ALTER TABLE `order line`
  MODIFY `Order_Line_Number` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `Review_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `Staff_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `Q_Index` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order line`
--
ALTER TABLE `order line`
  ADD CONSTRAINT `FKOrder Line395118` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`),
  ADD CONSTRAINT `FKOrder Line474240` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Order_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FKOrders240764` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FKReviews500589` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
