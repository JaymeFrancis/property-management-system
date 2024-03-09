-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 02:52 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `memorandum_receipt`
--

CREATE TABLE `memorandum_receipt` (
  `id` int(255) NOT NULL,
  `mr_no` int(255) DEFAULT NULL,
  `particulars` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `locID` int(255) NOT NULL,
  `locations` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `memorandum_receipt`
--

INSERT INTO `memorandum_receipt` (`id`, `mr_no`, `particulars`, `quantity`, `unit`, `price`, `locID`, `locations`, `recipient`, `date`) VALUES
(1, 4000, 'Computer Monitor Led 18.5\" AOC Led', 1, 'Pcs', 4900, 13, 'MIS/ICT', 'Jayme Francis Ramos', '2022-11-28'),
(2, 4000, 'Printer Epson FX 2175 sn GLX015979', 1, 'Pcs', 21900, 13, 'MIS/ICT', 'Jayme Francis Ramos', '2022-11-28'),
(3, 4001, 'UPS Abierey 500 VA, black', 1, 'Pcs', 1650, 1, 'Accounting Office/Auditor', 'Norlita Lopez', '2022-12-04'),
(4, 4001, 'Kingston Flash Drive 16gb', 1, 'Pcs', 299, 1, 'Accounting Office/Auditor', 'Norlita Lopez', '2022-12-04'),
(6, 4002, 'UPS APC 625VA', 1, 'Pcs', 3150, 13, 'MIS/ICT', 'John Doe', '2022-12-04'),
(7, 4002, 'Fan Desk 16\"', 1, 'Pcs', 780, 13, 'MIS/ICT', 'John Doe', '2022-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `sample_order`
--

CREATE TABLE `sample_order` (
  `id` int(11) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL DEFAULT 0,
  `unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sample_order`
--

INSERT INTO `sample_order` (`id`, `particulars`, `quantity`, `unit`) VALUES
(1, 'Baygon', 0, 'Cans'),
(2, 'Dustpan', 0, 'Pcs');

-- --------------------------------------------------------

--
-- Table structure for table `stockroom_issuance_report`
--

CREATE TABLE `stockroom_issuance_report` (
  `id` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `id` int(255) NOT NULL,
  `mr_no` int(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `po` int(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `locID` int(255) NOT NULL,
  `locations` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Decent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id`, `mr_no`, `invoice`, `po`, `particulars`, `supplier`, `date`, `quantity`, `unit`, `price`, `locID`, `locations`, `recipient`, `status`) VALUES
(1, 4000, 'CI 1980', 20109, 'Computer Monitor Led 18.5\" AOC Led', 'SKM Comp. Trade', '2022-11-28', 1, 'Pcs', 4900, 14, 'North Gate', 'John Wall', 'Decent'),
(2, 4000, 'CI 14990', 2210, 'Printer Epson FX 2175 sn GLX015979', 'Bitstop', '2022-11-28', 1, 'Pcs', 21900, 13, 'MIS/ICT', 'Jayme Ramos', 'Decent'),
(3, 4001, 'CI 0226', 17718, 'UPS Abierey 500 VA, black', 'New Gate Comp', '2022-12-04', 1, 'Pcs', 1650, 1, 'Accounting Office/Auditor\r\n', 'Norlita Lopez', 'Decent'),
(4, 4001, 'CSI 0055', 17718, 'Kingston Flash Drive 16gb', 'SKM Comp. Trade', '2022-12-04', 1, 'Pcs', 299, 1, 'Accounting Office/Auditor', 'Norlita Lopez', 'Decent'),
(5, 4002, 'CI 2194', 17718, 'UPS APC 625VA', 'SKM Comp. Trade', '2022-12-04', 1, 'Pcs', 3150, 13, 'MIS/ICT', 'John Doe', 'Decent'),
(6, 4002, 'CI 45629', 17718, 'Fan Desk 16\"', 'National Bazaar', '2022-12-04', 1, 'Pcs', 780, 13, 'MIS/ICT', 'John Wall', 'Decent');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `locID` int(11) NOT NULL,
  `locations` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`locID`, `locations`) VALUES
(1, 'Accounting Office/Auditor'),
(2, 'CASTE-IT, Dean\'s Office'),
(3, 'CCSA, Dean\'s Office'),
(4, 'CEA, Dean\'s Office'),
(5, 'CCAH/Social Science'),
(6, 'CICM Residence'),
(7, 'College Library Basement'),
(8, 'College Library 1st Floor'),
(9, 'College Library 2nd Floor'),
(10, 'Conference Room'),
(11, 'HRM Custodian Office'),
(12, 'General Services Office'),
(13, 'MIS/ICT'),
(14, 'North Gate'),
(15, 'President\'s Office'),
(16, 'Printing Office '),
(17, 'Property Management Office '),
(18, 'Purchasing Office'),
(19, 'Registrar\'s Office '),
(20, 'Research Office'),
(21, 'SAS, Dean\'s Office'),
(22, 'School Clinic'),
(23, 'Secretary, College President'),
(24, 'Secretary, VPAA'),
(25, 'Secretary, VPAdmin'),
(26, 'Student Affairs Office'),
(27, 'Social Center (Technician)'),
(28, 'Treasurer\'s Office'),
(29, 'VP for Academic Affairs'),
(30, 'VP for Administration '),
(31, 'Alumni Office'),
(32, 'Bookstore'),
(33, 'Campus Ministry Office'),
(34, 'College Guidance Center'),
(35, 'Extension Office'),
(36, 'HR Office'),
(37, 'IDQA Office'),
(38, 'Marketing Office'),
(39, 'APPA, Elementary'),
(40, 'Asst. to the BEdS Principal '),
(41, 'BEdS Cashier'),
(42, 'BEdS Principal'),
(43, 'BEdS Record\'s Office'),
(44, 'Elem. Coor\'s Office'),
(45, 'Elementary Library'),
(46, 'Guidance (HS & Elem)'),
(47, 'High School Library'),
(48, 'HS Dep\'t, Heads Office'),
(49, 'SAO-Senior & Junior High School');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_memo_receipt`
--

CREATE TABLE `tbl_memo_receipt` (
  `mr_number` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `recipient` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_memo_receipt`
--

INSERT INTO `tbl_memo_receipt` (`mr_number`, `date`, `recipient`, `position`) VALUES
(4000, '2022-12-04', 'Jayme Francis Ramos', 'Head'),
(4001, '2022-12-04', 'Norlita Lopez', 'Accountant'),
(4002, '2022-12-04', 'John Doe', 'Head');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_particulars_janitorial`
--

CREATE TABLE `tbl_particulars_janitorial` (
  `id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL,
  `order_level` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_particulars_janitorial`
--

INSERT INTO `tbl_particulars_janitorial` (`id`, `item_code`, `particulars`, `unit`, `stock_type`, `order_level`) VALUES
(1, 'BYG00', 'Baygon', 'Cans', 'Janitorial', 5),
(2, 'DP00', 'Dustpan', 'Pcs', 'Janitorial', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_particulars_stockroom`
--

CREATE TABLE `tbl_particulars_stockroom` (
  `id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL,
  `order_level` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_particulars_stockroom`
--

INSERT INTO `tbl_particulars_stockroom` (`id`, `item_code`, `particulars`, `unit`, `stock_type`, `order_level`) VALUES
(2, 'A0006A', 'Pencil Mongol 2', 'Pcs', 'Stockroom', 15),
(3, 'A0022', 'Ballpen Red HBW', 'Pcs', 'Stockroom', 20),
(4, 'A0032', 'Ballpen Black HBW', 'Pcs', 'Stockroom', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchaseitems_janitorial`
--

CREATE TABLE `tbl_purchaseitems_janitorial` (
  `uid` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'stockroom',
  `month` varchar(255) NOT NULL,
  `year` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchaseitems_janitorial`
--

INSERT INTO `tbl_purchaseitems_janitorial` (`uid`, `id`, `particulars`, `quantity`, `unit`, `stock_type`, `month`, `year`) VALUES
(4, 3003, 'Baygon', '60', 'Cans', 'stockroom', 'November', 2022),
(5, 3003, 'Dustpan', '40', 'Pcs', 'stockroom', 'November', 2022),
(6, 3004, 'Baygon', '60', 'Cans', 'stockroom', 'December', 2022),
(7, 3004, 'Dustpan', '20', 'Pcs', 'stockroom', 'December', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchaseitems_stockroom`
--

CREATE TABLE `tbl_purchaseitems_stockroom` (
  `uid` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'stockroom',
  `month` varchar(255) NOT NULL,
  `year` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchaseitems_stockroom`
--

INSERT INTO `tbl_purchaseitems_stockroom` (`uid`, `id`, `particulars`, `quantity`, `unit`, `stock_type`, `month`, `year`) VALUES
(1, 3001, 'Ballpen Black HBW', '45', 'Pcs', 'stockroom', 'November', 2022),
(2, 3001, 'Pencil Mongol 2', '40', 'Pcs', 'stockroom', 'November', 2022),
(3, 3001, 'Ballpen Red HBW', '50', 'Pcs', 'stockroom', 'November', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_janitorial`
--

CREATE TABLE `tbl_purchase_janitorial` (
  `id` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'stockroom',
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_janitorial`
--

INSERT INTO `tbl_purchase_janitorial` (`id`, `month`, `year`, `stock_type`, `date`) VALUES
(3003, 'November', 2022, 'stockroom', '2022-11-28'),
(3004, 'December', 2022, 'stockroom', '2022-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_stockroom`
--

CREATE TABLE `tbl_purchase_stockroom` (
  `id` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'stockroom',
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_stockroom`
--

INSERT INTO `tbl_purchase_stockroom` (`id`, `month`, `year`, `stock_type`, `date`) VALUES
(3001, 'November', 2022, 'stockroom', '2022-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_janitorial`
--

CREATE TABLE `tbl_request_janitorial` (
  `iss_no` int(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `req_date` date NOT NULL,
  `rcv_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request_janitorial`
--

INSERT INTO `tbl_request_janitorial` (`iss_no`, `recipient`, `office`, `req_date`, `rcv_date`, `status`) VALUES
(1000, 'John Wall', 'MIS', '2022-11-19', '2022-11-19', 'Issued'),
(1001, 'John Doe', 'SAO', '2022-11-28', '2022-11-28', 'Issued');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_stockroom`
--

CREATE TABLE `tbl_request_stockroom` (
  `iss_no` int(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `req_date` date NOT NULL,
  `rcv_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request_stockroom`
--

INSERT INTO `tbl_request_stockroom` (`iss_no`, `recipient`, `office`, `req_date`, `rcv_date`, `status`) VALUES
(1001, 'John Doe', 'MIS', '2022-11-18', '2022-11-19', 'Issued'),
(1002, 'John Doe', 'Registrar', '2022-11-19', '2022-11-19', 'Issued'),
(1003, 'John Doe', 'Accounting Office', '2022-11-19', '2022-11-19', 'Issued'),
(1004, 'John Doe', 'Accounting Office', '2022-11-20', '2022-11-28', 'Issued'),
(1005, 'Norlita Lopez', 'Accounting Office', '2022-12-05', NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ris_janitorial`
--

CREATE TABLE `tbl_ris_janitorial` (
  `id` int(255) NOT NULL,
  `iss_no` int(11) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `quantityReq` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'Stockroom',
  `rcv_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ris_janitorial`
--

INSERT INTO `tbl_ris_janitorial` (`id`, `iss_no`, `particulars`, `item_code`, `quantityReq`, `unit`, `stock_type`, `rcv_date`) VALUES
(9, 1000, 'Baygon', 'BYG00', 5, 'Cans', 'Stockroom', '2022-11-19'),
(11, 1000, 'Dustpan', 'DP00', 5, 'Pcs', 'Stockroom', '2022-11-19'),
(12, 1001, 'Baygon', 'BYG00', 25, 'Cans', 'Stockroom', '2022-11-28'),
(13, 1001, 'Baygon', 'BYG001', 33, 'Cans', 'Stockroom', '2022-11-28'),
(14, 1001, 'Dustpan', 'DP00', 33, 'Pcs', 'Stockroom', '2022-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ris_stockroom`
--

CREATE TABLE `tbl_ris_stockroom` (
  `id` int(255) NOT NULL,
  `iss_no` int(11) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `quantityReq` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'Stockroom',
  `rcv_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ris_stockroom`
--

INSERT INTO `tbl_ris_stockroom` (`id`, `iss_no`, `particulars`, `item_code`, `quantityReq`, `unit`, `stock_type`, `rcv_date`) VALUES
(4, 1001, 'Ballpen Black HBW', 'A0032', 10, 'Pcs', 'Stockroom', '2022-11-19'),
(5, 1001, 'Pencil Mongol 2', 'A0006A', 10, 'Pcs', 'Stockroom', '2022-11-19'),
(6, 1002, 'Ballpen Black HBW', 'A0032', 5, 'Pcs', 'Stockroom', '2022-11-19'),
(7, 1002, 'Pencil Mongol 2', 'A0006A', 10, 'Pcs', 'Stockroom', '2022-11-19'),
(8, 1002, 'Ballpen Red HBW', 'A0022', 15, 'Pcs', 'Stockroom', '2022-11-19'),
(9, 1003, 'Ballpen Red HBW', 'A0022', 10, 'Pcs', 'Stockroom', '2022-11-19'),
(10, 1004, 'Pencil Mongol 2', 'A0006A', 50, 'Pcs', 'Stockroom', '2022-11-28'),
(11, 1004, 'Ballpen Black HBW', 'A0032', 30, 'Pcs', 'Stockroom', '2022-11-28'),
(12, 1004, 'Ballpen Black HBW', 'A00321', 40, 'Pcs', 'Stockroom', '2022-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_janitorial`
--

CREATE TABLE `tbl_stock_janitorial` (
  `uid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` float NOT NULL,
  `amount` int(255) NOT NULL,
  `issuance_qty` int(255) NOT NULL,
  `issuance_amt` int(255) NOT NULL,
  `rem_qty` int(255) NOT NULL,
  `rem_amt` int(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stock_janitorial`
--

INSERT INTO `tbl_stock_janitorial` (`uid`, `id`, `item_code`, `particulars`, `unit`, `stock_type`, `quantity`, `price`, `amount`, `issuance_qty`, `issuance_amt`, `rem_qty`, `rem_amt`, `date`) VALUES
(1, 1, '', 'Baygon', 'Cans', 'Janitorial', 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
(2, 1, 'BYG00', 'Baygon', 'Cans', 'Janitorial', 30, 312.45, 0, 30, 0, 0, 0, '2022-11-17'),
(3, 1, 'BYG001', 'Baygon', 'Cans', 'Janitorial', 35, 305.49, 0, 33, 0, 2, 0, '2022-11-17'),
(4, 2, '', 'Dustpan', 'Pcs', 'Janitorial', 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
(5, 2, 'DP00', 'Dustpan', 'Pcs', 'Janitorial', 40, 53.34, 0, 38, 0, 2, 0, '2022-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_stockroom`
--

CREATE TABLE `tbl_stock_stockroom` (
  `uid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL DEFAULT 0,
  `price` float NOT NULL,
  `amount` int(255) NOT NULL,
  `issuance_qty` int(255) NOT NULL DEFAULT 0,
  `issuance_amt` int(255) NOT NULL,
  `rem_qty` int(255) NOT NULL DEFAULT 0,
  `rem_amt` int(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stock_stockroom`
--

INSERT INTO `tbl_stock_stockroom` (`uid`, `id`, `item_code`, `particulars`, `unit`, `stock_type`, `quantity`, `price`, `amount`, `issuance_qty`, `issuance_amt`, `rem_qty`, `rem_amt`, `date`) VALUES
(1, 2, '', 'Pencil Mongol 2', 'Pcs', 'Stockroom', 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
(2, 2, 'A0006A', 'Pencil Mongol 2', 'Pcs', 'Stockroom', 80, 12.04, 0, 70, 0, 10, 0, '2022-11-16'),
(3, 3, '', 'Ballpen Red HBW', 'Pcs', 'Stockroom', 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
(4, 3, 'A0022', 'Ballpen Red HBW', 'Pcs', 'Stockroom', 100, 13.67, 0, 25, 0, 75, 0, '2022-11-16'),
(5, 4, '', 'Ballpen Black HBW', 'Pcs', 'Stockroom', 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
(6, 4, 'A0032', 'Ballpen Black HBW', 'Pcs', 'Stockroom', 50, 12.07, 0, 45, 0, 5, 0, '2022-11-16'),
(7, 4, 'A00321', 'Ballpen Black HBW', 'Pcs', 'Stockroom', 40, 12.28, 0, 40, 0, 0, 0, '2022-11-16'),
(8, 4, 'A00322', 'Ballpen Black HBW', 'Pcs', 'Stockroom', 50, 12, 0, 0, 0, 50, 0, '2022-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `emp_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_lvl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`emp_id`, `fname`, `mname`, `lname`, `user_name`, `password`, `email`, `user_lvl`) VALUES
(12001, 'Christian', 'Sam', 'Newman', 'admin', 'admin', 'admin@slc.com', 'Admin'),
(12002, 'John', 'Wick', 'Lennon', 'custodian', 'custodian', 'pmo@slc.com', 'PMO'),
(12003, 'Chris', 'Ross', 'Brown', 'auditor', 'auditor', 'auditor@slc.com', 'Auditor'),
(12004, 'Jayme Francis', 'Estabillo', 'Ramos', 'jayme', 'jayme', 'jayme@slc.com', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `memorandum_receipt`
--
ALTER TABLE `memorandum_receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample_order`
--
ALTER TABLE `sample_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockroom_issuance_report`
--
ALTER TABLE `stockroom_issuance_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`locID`);

--
-- Indexes for table `tbl_memo_receipt`
--
ALTER TABLE `tbl_memo_receipt`
  ADD PRIMARY KEY (`mr_number`);

--
-- Indexes for table `tbl_particulars_janitorial`
--
ALTER TABLE `tbl_particulars_janitorial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `particulars` (`particulars`),
  ADD KEY `item_code` (`item_code`,`unit`),
  ADD KEY `unit` (`unit`);

--
-- Indexes for table `tbl_particulars_stockroom`
--
ALTER TABLE `tbl_particulars_stockroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `particulars` (`particulars`),
  ADD KEY `particulars_2` (`particulars`),
  ADD KEY `item_code` (`item_code`,`stock_type`,`unit`),
  ADD KEY `unit` (`unit`),
  ADD KEY `stock_type` (`stock_type`);

--
-- Indexes for table `tbl_purchaseitems_janitorial`
--
ALTER TABLE `tbl_purchaseitems_janitorial`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_purchaseitems_stockroom`
--
ALTER TABLE `tbl_purchaseitems_stockroom`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_purchase_janitorial`
--
ALTER TABLE `tbl_purchase_janitorial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchase_stockroom`
--
ALTER TABLE `tbl_purchase_stockroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request_janitorial`
--
ALTER TABLE `tbl_request_janitorial`
  ADD PRIMARY KEY (`iss_no`);

--
-- Indexes for table `tbl_request_stockroom`
--
ALTER TABLE `tbl_request_stockroom`
  ADD PRIMARY KEY (`iss_no`);

--
-- Indexes for table `tbl_ris_janitorial`
--
ALTER TABLE `tbl_ris_janitorial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iss_no` (`iss_no`);

--
-- Indexes for table `tbl_ris_stockroom`
--
ALTER TABLE `tbl_ris_stockroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iss_no` (`iss_no`);

--
-- Indexes for table `tbl_stock_janitorial`
--
ALTER TABLE `tbl_stock_janitorial`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `particulars` (`particulars`),
  ADD KEY `particulars_2` (`particulars`),
  ADD KEY `particulars_3` (`particulars`),
  ADD KEY `unit` (`unit`,`stock_type`),
  ADD KEY `item_code` (`item_code`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_stock_stockroom`
--
ALTER TABLE `tbl_stock_stockroom`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `particulars` (`particulars`),
  ADD KEY `particulars_2` (`particulars`),
  ADD KEY `particulars_3` (`particulars`),
  ADD KEY `unit` (`unit`,`stock_type`),
  ADD KEY `item_code` (`item_code`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `memorandum_receipt`
--
ALTER TABLE `memorandum_receipt`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sample_order`
--
ALTER TABLE `sample_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stockroom_issuance_report`
--
ALTER TABLE `stockroom_issuance_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `locID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_memo_receipt`
--
ALTER TABLE `tbl_memo_receipt`
  MODIFY `mr_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4003;

--
-- AUTO_INCREMENT for table `tbl_particulars_janitorial`
--
ALTER TABLE `tbl_particulars_janitorial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_particulars_stockroom`
--
ALTER TABLE `tbl_particulars_stockroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_purchaseitems_janitorial`
--
ALTER TABLE `tbl_purchaseitems_janitorial`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_purchaseitems_stockroom`
--
ALTER TABLE `tbl_purchaseitems_stockroom`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_purchase_janitorial`
--
ALTER TABLE `tbl_purchase_janitorial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3005;

--
-- AUTO_INCREMENT for table `tbl_purchase_stockroom`
--
ALTER TABLE `tbl_purchase_stockroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3002;

--
-- AUTO_INCREMENT for table `tbl_request_janitorial`
--
ALTER TABLE `tbl_request_janitorial`
  MODIFY `iss_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT for table `tbl_request_stockroom`
--
ALTER TABLE `tbl_request_stockroom`
  MODIFY `iss_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `tbl_ris_janitorial`
--
ALTER TABLE `tbl_ris_janitorial`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_ris_stockroom`
--
ALTER TABLE `tbl_ris_stockroom`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_stock_janitorial`
--
ALTER TABLE `tbl_stock_janitorial`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_stock_stockroom`
--
ALTER TABLE `tbl_stock_stockroom`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_stock_janitorial`
--
ALTER TABLE `tbl_stock_janitorial`
  ADD CONSTRAINT `tbl_stock_janitorial_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_particulars_janitorial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_stock_janitorial_ibfk_3` FOREIGN KEY (`particulars`) REFERENCES `tbl_particulars_janitorial` (`particulars`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_stock_janitorial_ibfk_4` FOREIGN KEY (`unit`) REFERENCES `tbl_particulars_janitorial` (`unit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_stock_stockroom`
--
ALTER TABLE `tbl_stock_stockroom`
  ADD CONSTRAINT `tbl_stock_stockroom_ibfk_2` FOREIGN KEY (`particulars`) REFERENCES `tbl_particulars_stockroom` (`particulars`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_stock_stockroom_ibfk_3` FOREIGN KEY (`id`) REFERENCES `tbl_particulars_stockroom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_stock_stockroom_ibfk_5` FOREIGN KEY (`unit`) REFERENCES `tbl_particulars_stockroom` (`unit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
