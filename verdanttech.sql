-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 02, 2021 at 04:41 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verdanttech`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `addressId` int(11) NOT NULL AUTO_INCREMENT,
  `addressLine1` varchar(50) NOT NULL,
  `addressLine2` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `postalCode` int(11) DEFAULT NULL,
  PRIMARY KEY (`addressId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `addressLine1`, `addressLine2`, `city`, `postalCode`) VALUES
(1, '80/A, 1st Street', 'Main Road', 'Nugegoda', 25000),
(2, '34/B, Main Street', 'Kohuwala', 'Nugegoda', 25000),
(3, '#23', 'Park Street', 'Colombo', 12345),
(4, '432/d efhwiehf', 'fwgewygfevuy', 'sbcfhgfyce', 43432),
(5, '432/d efhwiehf', 'fwgewygfevuy', 'sbcfhgfyce', 43432),
(6, 'ehwruihieuwr', 'fregiuyyuyrer', 'rewret', NULL),
(7, '54/B, Block D', 'Kohuwala', 'Nugegoda', 11800);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE IF NOT EXISTS `checkout` (
  `referenceId` int(15) NOT NULL AUTO_INCREMENT,
  `orderId` int(10) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `paymentMethod` varchar(5) NOT NULL DEFAULT 'Cash',
  `addressId` int(10) NOT NULL,
  `checkoutDate` date NOT NULL DEFAULT current_timestamp(),
  `deliveryDate` date DEFAULT NULL,
  `statusId` int(15) NOT NULL,
  PRIMARY KEY (`referenceId`),
  KEY `orderId` (`orderId`),
  KEY `addressId` (`addressId`),
  KEY `statusId` (`statusId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`referenceId`, `orderId`, `amount`, `paymentMethod`, `addressId`, `checkoutDate`, `deliveryDate`, `statusId`) VALUES
(11, 20, 126000.00, 'Cash', 7, '2021-01-02', NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customerId` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `firstName` varchar(60) NOT NULL,
  `lastName` varchar(60) NOT NULL,
  `addressId` int(10) NOT NULL,
  `mobile` int(15) NOT NULL,
  `statusId` int(15) NOT NULL,
  PRIMARY KEY (`customerId`),
  KEY `addressId` (`addressId`),
  KEY `userId` (`userId`),
  KEY `statusId` (`statusId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `userId`, `firstName`, `lastName`, `addressId`, `mobile`, `statusId`) VALUES
(3, 1, 'Dilshan', 'Shanaka', 1, 777123456, 1),
(6, 12, 'John', 'Paul', 7, 777123456, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employeeId` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `firstName` varchar(60) NOT NULL,
  `lastName` varchar(60) NOT NULL,
  `position` varchar(60) NOT NULL,
  `registeredDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `statusId` int(15) NOT NULL,
  PRIMARY KEY (`employeeId`),
  KEY `userId` (`userId`),
  KEY `statusId` (`statusId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeId`, `userId`, `firstName`, `lastName`, `position`, `registeredDate`, `statusId`) VALUES
(1, 1, 'Dilshan', 'Shanaka', 'Web Admin', '2020-12-22 15:40:06', 1),
(2, 2, 'John', 'Doe', 'Manager', '2020-12-22 15:40:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `stockId` int(10) NOT NULL AUTO_INCREMENT,
  `productId` int(10) NOT NULL,
  `quantity` int(5) NOT NULL,
  `statusId` int(15) NOT NULL,
  `createdUser` int(10) DEFAULT NULL,
  `modifiedUser` int(10) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`stockId`),
  KEY `createdUser` (`createdUser`),
  KEY `modifiedUser` (`modifiedUser`),
  KEY `productId` (`productId`),
  KEY `statusId` (`statusId`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`stockId`, `productId`, `quantity`, `statusId`, `createdUser`, `modifiedUser`, `createdDate`, `modifiedDate`) VALUES
(1, 1, 12, 7, 1, NULL, '2020-12-24 04:24:30', NULL),
(2, 2, 32, 9, 1, NULL, '2020-12-24 04:32:25', NULL),
(3, 3, 3, 7, 1, NULL, '2020-12-24 04:36:11', NULL),
(4, 17, 78, 1, 1, NULL, '2020-12-24 04:57:58', NULL),
(5, 18, 12, 1, 1, NULL, '2020-12-24 04:59:49', NULL),
(6, 19, 3424, 1, 1, NULL, '2020-12-24 05:04:43', NULL),
(7, 20, 1, 1, 1, NULL, '2020-12-24 05:12:34', NULL),
(8, 21, 233, 1, 1, NULL, '2020-12-24 05:13:25', NULL),
(9, 22, 5, 5, 1, NULL, '2020-12-25 01:18:57', NULL),
(10, 23, 43, 8, 1, NULL, '2020-12-25 01:23:04', NULL),
(11, 24, 235, 1, 1, NULL, '2020-12-25 01:26:15', NULL),
(12, 25, 3, 1, 1, NULL, '2020-12-25 01:29:39', NULL),
(13, 26, 12, 5, 1, NULL, '2020-12-25 01:40:55', NULL),
(14, 27, 3, 5, 1, 1, '2020-12-25 01:43:21', '2020-12-25 02:36:21'),
(15, 0, 23, 4, 1, NULL, '2020-12-25 02:40:53', NULL),
(16, 28, 89, 5, 1, 1, '2020-12-25 02:42:50', '2020-12-25 02:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `maincategory`
--

DROP TABLE IF EXISTS `maincategory`;
CREATE TABLE IF NOT EXISTS `maincategory` (
  `mainCatId` int(5) NOT NULL AUTO_INCREMENT,
  `mainCatName` varchar(40) NOT NULL,
  `statusId` int(15) NOT NULL,
  PRIMARY KEY (`mainCatId`),
  KEY `statusId` (`statusId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maincategory`
--

INSERT INTO `maincategory` (`mainCatId`, `mainCatName`, `statusId`) VALUES
(1, 'Laptops', 1),
(2, 'Computers', 1),
(3, 'TV & Audio', 1),
(4, 'Wearable Tech', 1),
(5, 'Gaming Devices', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

DROP TABLE IF EXISTS `orderitem`;
CREATE TABLE IF NOT EXISTS `orderitem` (
  `orderItemId` int(15) NOT NULL AUTO_INCREMENT,
  `orderId` int(10) NOT NULL,
  `stockId` int(10) NOT NULL,
  `qty` int(4) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `warrentyPeriod` int(3) NOT NULL,
  `statusId` int(15) NOT NULL,
  PRIMARY KEY (`orderItemId`),
  KEY `orderId` (`orderId`),
  KEY `statusId` (`statusId`),
  KEY `stockId` (`stockId`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`orderItemId`, `orderId`, `stockId`, `qty`, `amount`, `warrentyPeriod`, `statusId`) VALUES
(34, 20, 2, 1, 50000.00, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int(10) NOT NULL AUTO_INCREMENT,
  `customerId` int(10) NOT NULL,
  `orderDate` date NOT NULL,
  `statusId` int(15) NOT NULL,
  PRIMARY KEY (`orderId`),
  KEY `customerId` (`customerId`),
  KEY `statusId` (`statusId`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `customerId`, `orderDate`, `statusId`) VALUES
(22, 6, '2021-01-02', 6),
(20, 6, '2020-12-30', 9);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `productId` int(10) NOT NULL AUTO_INCREMENT,
  `subCatId` int(5) NOT NULL,
  `brandName` varchar(40) NOT NULL,
  `productName` varchar(40) NOT NULL,
  `productDesc` varchar(255) NOT NULL,
  `price` float(8,2) NOT NULL,
  PRIMARY KEY (`productId`),
  KEY `subCatId` (`subCatId`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `subCatId`, `brandName`, `productName`, `productDesc`, `price`) VALUES
(1, 1, 'HP', 'Notebook 14s', 'AMD A8 2.8ghz | 4GB Ram | 500GB | 1GB VGA | WIN 10', 65000.00),
(2, 1, 'HP', 'Notebook 15.6', 'Intel i5 10th Gen | Windows 10 | 8GB Ram | 1TB HDD | 4GB Nividia VGA', 125000.00),
(4, 9, 'Sony', 'PlayStation 4 ', 'Sony PlayStation 4 with Two controller. Launched on November 15, 2013, in North America', 70000.00),
(5, 9, 'Sony', 'PlayStation 5', 'PlayStation 5 Digital edition | SSD | 3D Audio ', 85000.00),
(6, 5, 'PHILIPS ', 'LED 4K TV', '50\" 4K LED TV | High quality viewing experience with built in android OS | Wifi', 180000.00),
(7, 10, 'Sony', 'PS4 Controller', 'PS4 Controller Red', 7000.00),
(8, 2, 'Acer', 'Notebook i5', 'Core i5 10th Gen | 8GB RAM | 1TB HDD | 4GB Nividia VGA ', 125000.00),
(9, 5, 'PHILIPS', 'FHD LED TV', '40\" FHD LED | 1080p | High quality sounds', 85000.00),
(10, 3, 'HP', 'GT 290 MT', 'Windows 10 | Core i3 9th Gen | 4GB Ram | 500GB Hard disk | 2GB VGA |  Free Keyboard & Mouse', 68000.00),
(11, 4, 'HP', 'LED 19 Monitor', 'FULL HD HP Monitor HDMI support\r\n', 24000.00),
(12, 6, 'PHILIPS', 'Blu-Ray Player', 'Explore 4K, 3D ', 18500.00),
(13, 8, 'Samsung', 'Galaxy Active 2', 'Super AMOLED | Corning Gorilla Glass DX+ | CPU Dual-core 1.15 GHz Cortex-A53 | 4GB ROM 1.5GB RAM', 40000.00),
(14, 8, 'Samsung', 'Galaxy Fit', 'AMOLED touch screen enclosed in a silicone band | Works with Android and iOS | Waterproof up to 50 meters', 30000.00),
(29, 1, 'Acer', 'Swift 3', '10th Gen Core i5 14-inch Ultra Thin and Light Laptop (8GB/512GB SSD/Windows 10/Steel Gray/1.19kg)', 95000.00);

-- --------------------------------------------------------

--
-- Table structure for table `productimage`
--

DROP TABLE IF EXISTS `productimage`;
CREATE TABLE IF NOT EXISTS `productimage` (
  `productImgId` int(10) NOT NULL AUTO_INCREMENT,
  `productId` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`productImgId`),
  KEY `productId` (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productimage`
--

INSERT INTO `productimage` (`productImgId`, `productId`, `image`) VALUES
(1, 1, 'images/products/hp14amd.jpg'),
(2, 2, 'images/products/hp15intel.jpg'),
(3, 29, 'images/products/acerswift3.jpg'),
(4, 4, 'images/products/sonyps4.jpeg'),
(5, 5, 'images/products/sonyps5.jpeg'),
(6, 6, 'images/products/philips504k.jpeg'),
(7, 7, 'images/products/ps4controller.jpg'),
(8, 8, 'images/products/acer15inteli5.jpg'),
(9, 9, 'images/products/philips42FHD.jpg'),
(10, 10, 'images/products/hp290mt.jpg'),
(11, 11, 'images/products/hp19m.jpg'),
(12, 12, 'images/products/blurayphilips.jpeg'),
(13, 13, 'images/products/sgalaxywatch2.jpg'),
(14, 14, 'images/products/sgalaxyfite.jpg'),
(32, 25, 'images/products/apple.jpg'),
(33, 26, 'images/products/apple.jpg'),
(35, 0, 'images/products/apple.jpg'),
(36, 28, 'images/products/apple.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `productreview`
--

DROP TABLE IF EXISTS `productreview`;
CREATE TABLE IF NOT EXISTS `productreview` (
  `reviewId` int(10) NOT NULL AUTO_INCREMENT,
  `productId` int(10) NOT NULL,
  `customerId` int(10) NOT NULL,
  `reviewMessage` text NOT NULL,
  `starRating` int(1) NOT NULL,
  `submitDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`reviewId`),
  KEY `customerId` (`customerId`),
  KEY `productId` (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productreview`
--

INSERT INTO `productreview` (`reviewId`, `productId`, `customerId`, `reviewMessage`, `starRating`, `submitDate`) VALUES
(1, 2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 4, '2020-12-29 17:18:23'),
(2, 2, 3, 'This review is for test. Good products', 3, '2021-01-02 01:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `roleId` int(10) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(50) NOT NULL,
  `createdUser` int(15) NOT NULL,
  `modifiedUser` int(15) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifiedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`roleId`),
  KEY `createdUser` (`createdUser`),
  KEY `modifiedUser` (`modifiedUser`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleId`, `roleName`, `createdUser`, `modifiedUser`, `createdDate`, `modifiedDate`) VALUES
(1, 'admin', 1, 1, '2020-12-10 17:22:50', '2020-12-10 17:22:50'),
(2, 'employee', 1, 1, '2020-12-10 17:23:36', '2020-12-10 17:23:36'),
(3, 'customer', 1, 1, '2020-12-10 17:23:55', '2020-12-10 17:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `statusId` int(15) NOT NULL AUTO_INCREMENT,
  `status` varchar(60) NOT NULL,
  `createdUser` int(15) NOT NULL,
  `modifiedUser` int(15) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifiedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`statusId`),
  KEY `createdUser` (`createdUser`),
  KEY `modifiedUser` (`modifiedUser`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusId`, `status`, `createdUser`, `modifiedUser`, `createdDate`, `modifiedDate`) VALUES
(1, 'Active', 1, 1, '2020-12-22 09:53:44', '2020-12-22 09:53:44'),
(2, 'Blocked', 1, 1, '2020-12-22 09:57:07', '2020-12-22 09:57:07'),
(3, 'In Stock', 1, 1, '2020-12-22 09:58:05', '2020-12-22 09:58:05'),
(4, 'Out Of Stock', 1, 1, '2020-12-22 09:58:05', '2020-12-22 09:58:05'),
(5, 'Pre Order', 1, 1, '2020-12-22 09:58:05', '2020-12-22 09:58:05'),
(6, 'Pending', 1, 1, '2020-12-22 10:01:47', '2020-12-22 10:01:47'),
(7, 'Delivered', 1, 1, '2020-12-22 10:01:47', '2020-12-22 10:01:47'),
(8, 'Removed', 1, 1, '2020-12-30 17:10:47', '2020-12-30 17:10:47'),
(9, 'Ordered ', 1, 1, '2020-12-31 14:18:19', '2020-12-31 14:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `subCatId` int(5) NOT NULL AUTO_INCREMENT,
  `mainCatId` int(5) NOT NULL,
  `subCatName` varchar(50) NOT NULL,
  `statusId` int(11) NOT NULL,
  PRIMARY KEY (`subCatId`),
  KEY `statusId` (`statusId`),
  KEY `mainCatId` (`mainCatId`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subCatId`, `mainCatId`, `subCatName`, `statusId`) VALUES
(1, 1, 'Notebooks', 1),
(2, 1, 'Gaming Laptops', 1),
(3, 2, 'Desktop PC', 1),
(4, 2, 'Monitors', 1),
(5, 3, 'TV', 1),
(6, 3, 'Blu-Ray Players', 1),
(7, 3, 'Audio Devices', 1),
(8, 4, 'Smart Watches ', 1),
(9, 5, 'Gaming Consoles', 1),
(10, 5, 'Accessories ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `roleId` int(10) NOT NULL DEFAULT 3,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `email` (`email`),
  KEY `roleId` (`roleId`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `roleId`, `email`, `password`) VALUES
(1, 1, 'admin@verdanttech.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 2, 'employee@verdanttech.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(12, 3, 'customer@verdanttech.com', '5f4dcc3b5aa765d61d8327deb882cf99');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
