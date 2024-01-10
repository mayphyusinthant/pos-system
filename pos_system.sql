-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2022 at 02:44 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountlevel`
--

CREATE TABLE `accountlevel` (
  `level` varchar(255) NOT NULL COMMENT 'Operational, Tactical & Strategic Levels'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accountlevel`
--

INSERT INTO `accountlevel` (`level`) VALUES
('Operational'),
('Strategic'),
('Tactical');

-- --------------------------------------------------------

--
-- Table structure for table `companyinfo`
--

CREATE TABLE `companyinfo` (
  `ID` int(11) NOT NULL COMMENT 'ID',
  `companyName` varchar(255) NOT NULL COMMENT 'Company/Organization who is using this POS System',
  `logo` varchar(255) DEFAULT NULL COMMENT 'Business Owners'' can set Company Logo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companyinfo`
--

INSERT INTO `companyinfo` (`ID`, `companyName`, `logo`) VALUES
(1, 'May\'s Collection', 'companyLogo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL COMMENT 'ID Numbers of Customers',
  `customerName` varchar(255) NOT NULL COMMENT 'Name of Customer',
  `address` varchar(255) DEFAULT NULL COMMENT 'Customer Address (only required for whole sale customers and for delivery purpose. Not required for retail customer)',
  `region` varchar(255) DEFAULT NULL COMMENT 'Customer''s Region (only required for whole sale customers and for delivery purpose. Not required for retail customer)',
  `phone` int(11) DEFAULT NULL COMMENT 'Customer''s Phone No:(only required for whole sale customers and for delivery purpose. Not required for retail customer)',
  `remark` varchar(255) DEFAULT NULL COMMENT 'Set Remark - Blacklist as required'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `customerName`, `address`, `region`, `phone`, `remark`) VALUES
(4, 'Pont', 'Yangon', '', 0, ''),
(6, 'May', 'Yangon', '-', 0, '-'),
(25, 'Retail Buyer', '', '', 0, ''),
(26, 'Su Su', '', '', 0, ''),
(27, 'Pont', '', '', 0, ''),
(28, 'Daw Saw', '', '', 0, ''),
(29, 'May', '', '', 0, ''),
(30, 'Kyae', '', '', 0, ''),
(31, 'Pont', 'No: 100, Room 10, York Street, Dagon Township, Yangon', 'Yangon', 2147483647, ''),
(32, 'Yu', '', '', 0, ''),
(33, 'Papaya', '', '', 0, ''),
(34, 'Su Su', 'No: 11, Mandalay Lashio Road, Pyin Oo Lwin, Mandalay Region', 'Mandalay', 2147483647, '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL COMMENT 'Employee ID',
  `employeeName` varchar(255) NOT NULL COMMENT 'Employee Name',
  `password` varchar(255) NOT NULL COMMENT 'Hashed Password',
  `profileImage` varchar(255) DEFAULT NULL COMMENT 'Profile Photo',
  `address` varchar(255) DEFAULT NULL COMMENT 'Employee''s Address',
  `phone` int(11) NOT NULL COMMENT 'Employee''s Phone Number',
  `email` varchar(255) NOT NULL COMMENT 'Email',
  `position` varchar(255) NOT NULL COMMENT 'Positions such as cashier, marketing leader, CEO, CFO, etc.',
  `level` varchar(255) NOT NULL COMMENT 'Operational, Tactical & Strategic Levels',
  `storeNo` int(11) NOT NULL COMMENT 'Store Number when organization has multiple branches',
  `remark` varchar(255) NOT NULL COMMENT 'Set Remark - Active or Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `employeeName`, `password`, `profileImage`, `address`, `phone`, `email`, `position`, `level`, `storeNo`, `remark`) VALUES
(2, 'Amelia                                                                                                                        ', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', '-                                                                                                ', 0, 'amelia@gmail.com                                                                                                                        ', 'Cashier', 'Operational', 1, 'Active'),
(4, 'Ryan                                                                                                                        ', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', '                                                                                                                                                                                        ', 0, 'ryan@gmail.com                                                                                                                                                                                                ', 'Sale Dept Manager                                                                                                                                                                                                ', 'Tactical', 1, 'Active'),
(5, 'Rockly                        ', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', 'Yangon                        ', 934643523, 'rockly@gmail.com                        ', 'Financial Executive                        ', 'Tactical', 2, 'Active'),
(7, 'May                                                       ', '$2y$10$Ew7XhFoeozF1o0Deo8ydr.i2w.LLZffIYJTg1RWBbWixbHa9tOZ8a', '', 'No: 100, Room 10, York Street, Dagon Township, Yangon', 2147483647, 'phyusint@gmail.com                                                                        ', 'CEO                                                                        ', 'Strategic', 1, 'Active'),
(8, 'Ms Lisa                                                                        ', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', 'Yangon                                                                                                   ', 964534546, 'lisa@gmail.com                                                                        ', ' Manager', 'Strategic', 3, 'Active'),
(9, 'Ms Linn ', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', '-', 0, 'linn@gmail.com', 'Cashier                 ', 'Operational', 2, 'Active'),
(10, 'Ms Su Thiri                                                ', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', '-                                                ', 0, 'suthiri@gmail.com                                                ', 'Cashier', 'Operational', 2, 'Active'),
(11, 'Ms Emma Clever                                                                                                                                                                                                                                                 ', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', '-                                                                                                                                                                                                                                                              ', 0, 'emmaclever@gmail.com                                                                                                                                                                                                                                           ', 'Cashier', 'Operational', 3, 'Active'),
(12, 'Ms Anastaia', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', '-', 0, 'anastatia@gmail.com', 'Human Resource Manager', 'Strategic', 1, 'Active'),
(15, 'May Phyu Sin                                               ', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', '-                        ', 0, 'mayphyu@gmail.com                        ', 'Inventory Manager               ', 'Tactical', 3, 'Active'),
(16, 'Mr Jerry                        ', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', '                        ', 934643523, 'jerry@gmail.com                        ', 'Inventory Manager               ', 'Tactical', 2, 'Active'),
(17, 'Mr Rio', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', '', 934643523, 'rio@gmail.com', ' Marketing Team Worker', 'Operational', 2, 'Active'),
(18, 'Ms Yie Mon                                                ', '$2y$10$98h/G8XQR9NEP9yfJdHoc.q0eas1luKghbVvxdi1AbGAqKrBsmDj.', '', '                                                ', 0, 'yiemon@gmail.com                                                ', ' Marketing Executive', 'Strategic', 1, 'Active'),
(19, 'Ms Charlotte', '$2y$10$WXGrQ7ULonwkRRhsier48uX2NJYp4D0IksAEpBaKHouNeGYXh58a.', '', 'Mandalay', 0, 'charlotte@gmail.com', 'Financial Executive                        ', 'Strategic', 3, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventoryID` int(11) NOT NULL COMMENT 'Inventory ID',
  `itemID` int(11) NOT NULL COMMENT 'Item ID',
  `instockqty` int(11) NOT NULL COMMENT 'In Stock Quantity of Each Item Type in Inventory',
  `purchasePrice` int(11) NOT NULL COMMENT 'Purchased or Original Price',
  `discount` int(11) NOT NULL COMMENT 'Discount',
  `tagPrice` int(11) NOT NULL COMMENT 'Sale Price or Tag Price',
  `supplierID` int(11) NOT NULL COMMENT 'Supplier ID',
  `storeNo` int(11) NOT NULL COMMENT 'Store Number when organization has multiple branches',
  `remark` varchar(255) DEFAULT NULL COMMENT 'Set Remark',
  `purchasedDate` date NOT NULL COMMENT 'The Date when an item is purchased from supplier',
  `modifiedUser` varchar(255) NOT NULL COMMENT 'Employee Name who modified this record'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryID`, `itemID`, `instockqty`, `purchasePrice`, `discount`, `tagPrice`, `supplierID`, `storeNo`, `remark`, `purchasedDate`, `modifiedUser`) VALUES
(21, 11, 32, 55000, 0, 18000, 2, 1, '', '2022-03-07', 'phyusint@gmail.com                                                                        '),
(25, 13, 20, 9000, 5, 18000, 4, 2, '', '2022-03-04', 'jerry@gmail.com                        '),
(26, 27, 6, 8500, 3, 25500, 4, 2, '', '2022-03-04', 'jerry@gmail.com                        '),
(27, 14, 15, 7500, 10, 18000, 4, 2, '', '2022-03-04', 'jerry@gmail.com                        '),
(28, 29, 25, 9000, 3, 25000, 4, 2, '', '2022-03-04', 'jerry@gmail.com                        '),
(29, 12, 9, 8500, 5, 15000, 4, 2, '', '2022-03-04', 'jerry@gmail.com                        '),
(31, 30, 18, 7500, 5, 18000, 4, 2, '', '2022-03-07', 'linn@gmail.com'),
(33, 25, 15, 9000, 10, 21000, 5, 2, '', '2022-03-04', 'jerry@gmail.com                        '),
(35, 22, 25, 7500, 0, 25000, 2, 1, '', '2022-03-10', 'phyusint@gmail.com                                                                        '),
(36, 13, 7, 9000, 5, 18000, 2, 1, '', '2022-03-04', 'phyusint@gmail.com                                                                        '),
(37, 9, 11, 12000, 0, 18000, 4, 1, '', '2022-03-04', 'phyusint@gmail.com                                                                        '),
(38, 27, 25, 8500, 3, 25500, 4, 1, '', '2022-03-04', 'phyusint@gmail.com                                                                        '),
(42, 13, 5, 7500, 5, 18000, 2, 3, '', '2022-03-04', 'lisa@gmail.com                                                                        '),
(43, 14, 25, 5500, 0, 12000, 2, 3, '', '2022-03-04', 'lisa@gmail.com                                                                        '),
(44, 16, 32, 7500, 0, 13000, 4, 3, '', '2022-03-07', 'lisa@gmail.com                                                                        '),
(45, 28, 48, 7500, 0, 19000, 2, 1, '-', '2022-03-07', 'phyusint@gmail.com                                                                        '),
(46, 24, 7, 7500, 5, 18000, 4, 3, '', '2022-03-07', 'lisa@gmail.com                                                                        '),
(47, 25, 11, 8500, 10, 13000, 2, 3, '', '2022-03-04', 'lisa@gmail.com                                                                        '),
(48, 25, 7, 8000, 3, 18000, 2, 1, '', '2022-03-07', 'phyusint@gmail.com'),
(49, 29, 20, 5500, 5, 25000, 5, 1, '', '2022-03-07', 'phyusint@gmail.com                                                                        '),
(50, 28, 29, 7500, 5, 25000, 6, 2, '', '2022-03-07', 'linn@gmail.com'),
(51, 18, 7, 7500, 0, 14000, 2, 2, '', '2022-03-07', 'linn@gmail.com'),
(55, 21, 14, 7500, 3, 13000, 4, 3, '', '2022-03-07', 'lisa@gmail.com                                                                        '),
(56, 27, 4, 7500, 0, 18000, 6, 3, '', '2022-03-07', 'lisa@gmail.com                                                                        '),
(57, 28, 28, 7500, 5, 21000, 6, 3, '', '2022-03-07', 'lisa@gmail.com                                                                        ');

-- --------------------------------------------------------

--
-- Table structure for table `itemlist`
--

CREATE TABLE `itemlist` (
  `itemID` int(11) NOT NULL COMMENT 'Item ID',
  `itemName` varchar(255) NOT NULL COMMENT 'Item/Product Name',
  `categoryName` varchar(255) NOT NULL COMMENT 'Category Name',
  `description` varchar(255) DEFAULT NULL COMMENT 'Item/ Product Description',
  `image` varchar(255) NOT NULL COMMENT 'item image'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemlist`
--

INSERT INTO `itemlist` (`itemID`, `itemName`, `categoryName`, `description`, `image`) VALUES
(9, 'Dinner Dress', 'Dress', '-', ''),
(10, 'T Shirt', 'Shirt', '', ''),
(11, 'Mini Skirt', 'Skirt', '', ''),
(12, 'Long Dress', 'Dress', '-', ''),
(13, 'Floral Print Dress', 'Dress', '-', 'floral-print-dress.jpg'),
(14, 'Jeans', 'Trousers', '', ''),
(16, 'Short Pants', 'Pants', '-', ''),
(18, 'Summer Dress', 'Dress', '-', ''),
(19, 'Red Dress', 'Dress', '', ''),
(21, 'Allisa Dress', 'Body Fit Dress', '-', ''),
(22, 'Black Suits', 'Night Dress', '-', ''),
(24, 'White Dress', 'Night Dress', '-', ''),
(25, 'Red Serenity Dress', 'Body Fit Dress', '', ''),
(27, 'Harper Dress', 'Body Fit Dress', '', ''),
(28, 'Olivia Mesh', 'Body Fit Dress', '-', ''),
(29, 'Kaylee Dress', 'Dress', '', ''),
(30, 'Crop Top', ' Blouse', '-', '');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `companyID` int(11) NOT NULL COMMENT 'Company/Organization ID who is using this POS System',
  `storeNo` int(11) NOT NULL COMMENT 'Store Number when organization has multiple branches',
  `address` varchar(255) DEFAULT NULL COMMENT 'Address of Each Store Branch',
  `officePhone` int(11) DEFAULT NULL COMMENT 'Office Phone in Each Store Branch',
  `officeEmail` varchar(255) DEFAULT NULL COMMENT 'Office Email',
  `storeManager` varchar(255) DEFAULT NULL COMMENT 'Store Manager in Each Store Branch'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`companyID`, `storeNo`, `address`, `officePhone`, `officeEmail`, `storeManager`) VALUES
(1, 1, 'No: 100, Room 10, York Street, Dagon Township, Yangon                                                ', 932424324, 'maycollection@gmail.com                                                ', 'Ryan                                                                                                                        '),
(1, 2, 'No: 11, Mandalay Lashio Road, Pyin Oo Lwin, Mandalay Region                        ', 2147483647, 'maycollection@gmail.com                        ', 'Rockly                        '),
(1, 3, 'No: 111, Inya Road, Yangon, Myanmar                        ', 932432424, 'maycollection@gmail.com                        ', 'Ms Lisa');

-- --------------------------------------------------------

--
-- Table structure for table `saleinfo`
--

CREATE TABLE `saleinfo` (
  `saleID` int(11) NOT NULL COMMENT 'Sale ID',
  `customerID` int(11) NOT NULL COMMENT 'Customer ID',
  `storeNo` int(11) NOT NULL COMMENT 'Store Branch Number that customer purchased from',
  `saleDate` date NOT NULL COMMENT 'Date when customer purchased product(s)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saleinfo`
--

INSERT INTO `saleinfo` (`saleID`, `customerID`, `storeNo`, `saleDate`) VALUES
(26, 25, 1, '2022-03-03'),
(28, 26, 1, '2022-03-04'),
(50, 27, 1, '2022-03-04'),
(75, 28, 1, '2022-03-07'),
(76, 28, 1, '2022-03-07'),
(77, 29, 1, '2022-03-07'),
(78, 4, 1, '2022-03-07'),
(79, 4, 1, '2022-03-07'),
(80, 25, 1, '2022-03-07'),
(81, 25, 1, '2022-03-07'),
(82, 25, 1, '2022-03-07'),
(83, 26, 1, '2022-03-07'),
(84, 25, 2, '2022-03-07'),
(85, 30, 2, '2022-03-07'),
(86, 25, 2, '2022-03-07'),
(87, 25, 2, '2022-03-07'),
(88, 25, 2, '2022-03-06'),
(89, 25, 2, '2022-03-07'),
(90, 29, 2, '2022-03-07'),
(91, 25, 3, '2022-03-07'),
(92, 26, 3, '2022-03-03'),
(93, 31, 3, '2022-03-05'),
(94, 25, 3, '2022-03-07'),
(95, 25, 3, '2022-03-07'),
(96, 25, 3, '2022-03-07'),
(97, 29, 3, '2022-03-07'),
(98, 25, 3, '2022-03-07'),
(99, 28, 3, '2022-03-07'),
(100, 25, 3, '2022-03-07'),
(101, 25, 1, '2022-03-07'),
(102, 25, 1, '2022-03-09'),
(103, 25, 1, '2022-03-09'),
(104, 25, 2, '2022-03-09'),
(105, 25, 2, '2022-03-09'),
(106, 25, 3, '2022-03-09'),
(107, 25, 3, '2022-03-09'),
(108, 32, 3, '2022-03-09'),
(109, 29, 3, '2022-03-09'),
(110, 29, 3, '2022-03-09'),
(111, 33, 3, '2022-03-09'),
(112, 25, 1, '2022-03-09'),
(113, 29, 1, '2022-03-09'),
(114, 25, 1, '2022-03-10'),
(115, 25, 1, '2022-03-10'),
(116, 34, 1, '2022-03-10'),
(117, 26, 1, '2022-03-10'),
(118, 25, 1, '2022-03-10'),
(119, 25, 2, '2022-03-10'),
(120, 25, 2, '2022-03-10'),
(121, 25, 2, '2022-03-10'),
(122, 25, 2, '2022-03-10'),
(123, 25, 3, '2022-03-10'),
(124, 25, 3, '2022-03-10'),
(125, 25, 3, '2022-03-10'),
(126, 29, 3, '2022-03-10'),
(127, 25, 2, '2022-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `saleID` int(11) NOT NULL COMMENT 'Sale ID',
  `itemID` int(11) NOT NULL COMMENT 'Item ID',
  `qty` int(11) NOT NULL COMMENT 'Number of Sold out Quantity',
  `actualsalePrice` int(11) NOT NULL COMMENT 'Actual Sale Price'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`saleID`, `itemID`, `qty`, `actualsalePrice`) VALUES
(26, 11, 1, 9500),
(28, 21, 1, 18900),
(50, 9, 1, 17100),
(50, 13, 2, 17100),
(50, 21, 2, 17100),
(75, 21, 3, 25000),
(75, 22, 3, 25000),
(75, 30, 1, 25000),
(76, 21, 1, 19950),
(77, 9, 4, 18000),
(78, 9, 1, 18000),
(79, 11, 1, 24735),
(79, 27, 4, 24735),
(80, 13, 9, 17100),
(81, 22, 2, 18900),
(82, 25, 1, 17460),
(82, 28, 3, 17460),
(83, 22, 1, 18900),
(84, 22, 3, 12350),
(85, 9, 1, 16200),
(85, 14, 3, 16200),
(85, 30, 1, 16200),
(86, 25, 1, 24250),
(86, 29, 3, 24250),
(87, 9, 1, 18000),
(87, 25, 2, 18000),
(88, 9, 1, 18000),
(88, 25, 2, 18000),
(89, 22, 4, 12350),
(89, 25, 2, 12350),
(90, 9, 1, 16200),
(90, 14, 1, 16200),
(90, 18, 1, 16200),
(90, 27, 1, 16200),
(90, 30, 1, 16200),
(91, 27, 3, 18000),
(92, 13, 1, 18000),
(92, 22, 1, 18000),
(92, 28, 1, 18000),
(93, 21, 3, 17100),
(93, 24, 1, 17100),
(93, 25, 1, 17100),
(94, 16, 1, 13000),
(94, 25, 3, 13000),
(95, 13, 1, 17100),
(96, 13, 2, 17100),
(97, 22, 1, 18000),
(98, 21, 1, 12610),
(98, 22, 3, 12610),
(99, 21, 1, 12610),
(100, 13, 2, 17100),
(101, 21, 1, 19950),
(102, 9, 1, 18000),
(102, 21, 3, 18000),
(102, 22, 1, 18000),
(103, 25, 3, 17460),
(104, 22, 1, 17100),
(104, 30, 2, 17100),
(105, 27, 1, 23750),
(105, 28, 1, 23750),
(106, 16, 1, 17100),
(106, 24, 4, 17100),
(106, 25, 5, 17100),
(107, 21, 1, 12610),
(108, 22, 2, 18000),
(109, 13, 1, 17100),
(110, 27, 3, 18000),
(111, 13, 1, 17100),
(111, 28, 1, 17100),
(112, 9, 1, 18000),
(112, 21, 2, 18000),
(113, 21, 1, 19950),
(114, 9, 1, 17100),
(114, 13, 1, 17100),
(114, 22, 4, 17100),
(115, 25, 4, 17460),
(115, 27, 1, 17460),
(116, 13, 10, 17100),
(116, 29, 10, 17100),
(117, 22, 10, 18900),
(118, 22, 10, 18900),
(119, 9, 1, 24735),
(119, 22, 2, 24735),
(119, 27, 3, 24735),
(120, 30, 10, 17100),
(121, 18, 5, 14000),
(121, 25, 5, 14000),
(122, 14, 1, 16200),
(122, 27, 5, 16200),
(123, 13, 5, 18000),
(123, 14, 5, 18000),
(123, 22, 10, 18000),
(124, 25, 5, 11700),
(124, 27, 5, 11700),
(125, 25, 5, 11700),
(125, 27, 5, 11700),
(126, 22, 4, 18000),
(127, 9, 3, 18000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL COMMENT 'Supplier ID',
  `supplierName` varchar(255) NOT NULL COMMENT 'Supplier Name or Supplier''s Company Name',
  `address` varchar(255) DEFAULT NULL COMMENT 'Supplier''s Company / Office Address',
  `region` varchar(255) DEFAULT NULL COMMENT 'Region',
  `phone` int(11) DEFAULT NULL COMMENT 'Supplier''s Phone Number',
  `email` varchar(255) DEFAULT NULL COMMENT 'Supplier''s Email',
  `modifiedDate` date NOT NULL COMMENT 'The Date when the data is modified'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `supplierName`, `address`, `region`, `phone`, `email`, `modifiedDate`) VALUES
(2, 'Empire Collection                                                ', '-                                                ', 'Mandalay', 984130431, 'empire@gmail.com', '2022-02-24'),
(4, 'Madam\'s Online Shop                                                                                                                                                                                                                     ', '-                                                                        ', 'Yangon', 0, 'madamonlineshop@gmail.com', '2022-02-24'),
(5, 'Yamona Clothing Shop                        ', 'Mandalay-Lashio Road, Pyin Oo Lwin                        ', 'Mandalay', 85242321, 'yamona@gmail.com', '2022-03-04'),
(6, 'MKS Local Sweater Shop                        ', 'No(34), Chan Mya Thar Si Street, Mandalay                        ', 'Mandalay', 934234243, '-', '2022-03-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountlevel`
--
ALTER TABLE `accountlevel`
  ADD PRIMARY KEY (`level`);

--
-- Indexes for table `companyinfo`
--
ALTER TABLE `companyinfo`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`),
  ADD KEY `level` (`level`),
  ADD KEY `storeNo` (`storeNo`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventoryID`),
  ADD KEY `storeNo` (`storeNo`),
  ADD KEY `supplierID` (`supplierID`),
  ADD KEY `itemID` (`itemID`);

--
-- Indexes for table `itemlist`
--
ALTER TABLE `itemlist`
  ADD PRIMARY KEY (`itemID`) USING BTREE,
  ADD UNIQUE KEY `itemName` (`itemName`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`storeNo`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `saleinfo`
--
ALTER TABLE `saleinfo`
  ADD PRIMARY KEY (`saleID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `storeNo` (`storeNo`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`saleID`,`itemID`),
  ADD KEY `itemID` (`itemID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`),
  ADD UNIQUE KEY `supplierName` (`supplierName`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companyinfo`
--
ALTER TABLE `companyinfo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Numbers of Customers', AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Employee ID', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Inventory ID', AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `itemlist`
--
ALTER TABLE `itemlist`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Item ID', AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `saleinfo`
--
ALTER TABLE `saleinfo`
  MODIFY `saleID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Sale ID', AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Supplier ID', AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`storeNo`) REFERENCES `location` (`storeNo`),
  ADD CONSTRAINT `level` FOREIGN KEY (`level`) REFERENCES `accountlevel` (`level`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `itemID` FOREIGN KEY (`itemID`) REFERENCES `itemlist` (`itemID`),
  ADD CONSTRAINT `storeNo` FOREIGN KEY (`storeNo`) REFERENCES `location` (`storeNo`),
  ADD CONSTRAINT `supplierID` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`companyID`) REFERENCES `companyinfo` (`ID`);

--
-- Constraints for table `saleinfo`
--
ALTER TABLE `saleinfo`
  ADD CONSTRAINT `saleinfo_ibfk_1` FOREIGN KEY (`storeNo`) REFERENCES `location` (`storeNo`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`saleID`) REFERENCES `saleinfo` (`saleID`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`itemID`) REFERENCES `itemlist` (`itemID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
