-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql103.byetcluster.com
-- Generation Time: Dec 04, 2019 at 04:15 AM
-- Server version: 5.6.45-86.1
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_24648743_Retail_Management_System`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bill_Items`
--

CREATE TABLE `Bill_Items` (
  `item_id` varchar(6) NOT NULL,
  `sale_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `cat_id` varchar(6) NOT NULL DEFAULT '',
  `cat_name` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`cat_id`, `cat_name`) VALUES
('cat001', 'Cosmetics'),
('cat002', 'Cereal_Pulses'),
('cat003', 'Toiletries'),
('cat004', 'Frozen_Food');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `cust_id` int(11) NOT NULL,
  `fanme` varchar(10) DEFAULT NULL,
  `lname` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `phone_no` char(10) DEFAULT NULL,
  `email_id` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`cust_id`, `fanme`, `lname`, `gender`, `birth_date`, `phone_no`, `email_id`) VALUES
(1, 'Kunal', 'Ojha', 'Male', '1999-10-27', '9331005932', 'kunalojha1999@gmail.com'),
(2, 'David', '', '', '1992-02-10', '9374827461', ''),
(3, 'Kunal', '', '', '2000-02-10', '9330005932', ''),
(4, 'Davi', 'Attenbourg', 'Male', '2002-02-12', '8204928471', ''),
(5, 'Jaimini', 'Rana', 'F', '1998-11-18', '0960032145', '');

-- --------------------------------------------------------

--
-- Table structure for table `Distributor`
--

CREATE TABLE `Distributor` (
  `dist_id` int(11) NOT NULL,
  `email_id` varchar(30) DEFAULT NULL,
  `phone_no` char(10) DEFAULT NULL,
  `dist_name` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Distributor`
--

INSERT INTO `Distributor` (`dist_id`, `email_id`, `phone_no`, `dist_name`) VALUES
(1, 'abc.sup@gmail.com', '9999111111', 'ABC Suppliers'),
(2, 'bac.sup@gmail.com', '9999911111', 'BAC Suppliers');

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `emp_id` varchar(6) NOT NULL DEFAULT '',
  `fname` varchar(10) DEFAULT NULL,
  `lname` varchar(10) DEFAULT NULL,
  `phone_no` char(10) DEFAULT NULL,
  `email_id` varchar(30) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `pos` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `salary` double(8,2) DEFAULT NULL,
  `cat_id` varchar(6) DEFAULT NULL,
  `supervisor_id` varchar(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`emp_id`, `fname`, `lname`, `phone_no`, `email_id`, `birth_date`, `hire_date`, `pos`, `gender`, `salary`, `cat_id`, `supervisor_id`) VALUES
('emp101', 'Sanas', 'Goyal', '9827276151', 'mangoya1989@gmail.com', '1989-10-29', '2011-11-13', 'Admin', 'Male', 35000.00, NULL, NULL),
('emp102', 'Seep', 'Kakkar', '8937462536', 'kakkar.deep2001@yahoo.co.in', '1994-06-21', '2013-12-22', 'Cashier', 'Male', 21000.00, NULL, 'emp101'),
('emp103', 'Anirrudh', 'Mathur', '9273645183', 'matanir1234@gmail.com', '1990-07-12', '2012-02-23', 'Purchaser', 'Male', 25000.00, NULL, NULL),
('emp104', 'Sindira', 'Ganguly', '9826051853', 'ganguly.Indira@yahoo.co.in', '1995-03-23', '2016-08-02', 'Store_emp', 'Female', 17000.00, 'cat001', NULL),
('emp105', 'Shawn', 'Michaels', '4585956525', 'shawn@michaels.com', '2019-12-01', '2019-12-11', 'Store_emp', 'male', 30000.00, 'cat001', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` varchar(6) NOT NULL DEFAULT '',
  `cost_price` double(7,2) DEFAULT NULL,
  `sale_price` double(7,2) DEFAULT NULL,
  `marked_price` double(7,2) DEFAULT NULL,
  `item_name` varchar(20) DEFAULT NULL,
  `cat_id` varchar(6) DEFAULT NULL,
  `qty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `cost_price`, `sale_price`, `marked_price`, `item_name`, `cat_id`, `qty`) VALUES
('itm001', 19.00, 57.00, 62.00, 'Rice 2Kg', 'cat002', 106),
('itm002', 37.00, 41.00, 44.00, 'Toor Dal 1kg', 'cat002', 15),
('itm003', 45.00, 47.00, 47.00, 'Masoor Dal 1Kg', 'cat002', 34);

-- --------------------------------------------------------

--
-- Table structure for table `LoginCredentials`
--

CREATE TABLE `LoginCredentials` (
  `login_id` varchar(10) NOT NULL DEFAULT '',
  `passwd` varchar(20) DEFAULT NULL,
  `login_type` varchar(6) DEFAULT NULL,
  `emp_id` varchar(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LoginCredentials`
--

INSERT INTO `LoginCredentials` (`login_id`, `passwd`, `login_type`, `emp_id`) VALUES
('EMPADM001', 'password', 'Admin', 'emp101'),
('EMPCSH001', 'password', 'Cash', 'emp102'),
('EMPPUR001', 'password', 'Purch', 'emp103'),
('EMPSTR001', 'password', 'Store', 'emp104'),
('EMPSTR002', 'password', 'Store', 'emp103'),
('ritesh', 'ritesh', 'Admin', 'admin0'),
('blast', 'blast', 'Admin', 'emp107'),
('sahil', 'sahil', 'Admin', 'Admin3'),
('emp', 'blast', 'purcha', 'emp108'),
('EMPSTR005', 'blast', 'Store', 'emp104');

-- --------------------------------------------------------

--
-- Table structure for table `PurchaseRecord`
--

CREATE TABLE `PurchaseRecord` (
  `purchase_id` int(11) NOT NULL DEFAULT '0',
  `purchase_date` date DEFAULT NULL,
  `amount` double(6,2) DEFAULT NULL,
  `emp_id` varchar(6) NOT NULL,
  `dist_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Purchase_Items`
--

CREATE TABLE `Purchase_Items` (
  `item_id` varchar(6) NOT NULL,
  `purchase_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SalesRecord`
--

CREATE TABLE `SalesRecord` (
  `sale_id` int(11) NOT NULL,
  `sale_date` date DEFAULT NULL,
  `amount` double(6,2) DEFAULT NULL,
  `emp_id` varchar(6) NOT NULL,
  `cust_id` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Shift`
--

CREATE TABLE `Shift` (
  `entr_date` date NOT NULL DEFAULT '0000-00-00',
  `emp_id` varchar(6) NOT NULL DEFAULT '',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Shift`
--

INSERT INTO `Shift` (`entr_date`, `emp_id`, `start_time`, `end_time`) VALUES
('2019-12-02', 'emp102', '00:18:17', '12:08:29'),
('2019-12-01', 'emp104', '22:27:23', '14:02:31'),
('2019-12-01', 'emp102', '13:14:01', '12:08:29'),
('2019-12-03', 'emp101', '13:50:28', '13:50:58'),
('2019-12-03', 'emp104', '14:02:28', '14:02:31'),
('2019-12-03', 'emp103', '14:32:20', '20:40:56'),
('2019-12-04', 'emp107', '11:10:59', '11:11:02'),
('2019-12-04', 'emp103', '14:30:14', '00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bill_Items`
--
ALTER TABLE `Bill_Items`
  ADD PRIMARY KEY (`item_id`,`sale_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `Distributor`
--
ALTER TABLE `Distributor`
  ADD PRIMARY KEY (`dist_id`);

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `LoginCredentials`
--
ALTER TABLE `LoginCredentials`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `PurchaseRecord`
--
ALTER TABLE `PurchaseRecord`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `dist_id` (`dist_id`);

--
-- Indexes for table `Purchase_Items`
--
ALTER TABLE `Purchase_Items`
  ADD PRIMARY KEY (`item_id`,`purchase_id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `SalesRecord`
--
ALTER TABLE `SalesRecord`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `Shift`
--
ALTER TABLE `Shift`
  ADD PRIMARY KEY (`entr_date`,`emp_id`),
  ADD KEY `emp_id` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
