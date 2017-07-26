-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2017 at 10:13 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_president_corner`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `abc` (IN `user` INT)  begin
	select * from tbl_customer_info where saved_by = user order by cus_name asc;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `supplier_insert` (IN `company_name` VARCHAR(200), IN `address` TEXT, IN `mobile` VARCHAR(200), IN `email` VARCHAR(200), IN `contact_person` VARCHAR(200), IN `contact_person_mobile` VARCHAR(200), IN `saved_by` INT, IN `payable_amount` DOUBLE, IN `remarks` TEXT, IN `saved_date` DATETIME)  BEGIN

	START TRANSACTION;	
    insert into tbl_supplier (
					c_name,address,mobile,email,contact_person,cp_mobile,saved_by,saved_date
				) values (
					company_name,address,mobile,email,contact_person,contact_person_mobile,saved_by,saved_date
				);
   
      

  insert into tbl_supplier_trans(
      supp_id,total_amount,balance,remarks,saved_by,saved_date
      ) values ( LAST_INSERT_ID(),payable_amount,payable_amount,remarks,saved_by,saved_date);
      
COMMIT;
            END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `test_pro` ()  NO SQL
select * from tbl_customer_info$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) NOT NULL,
  `cat_name` varchar(150) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `saved_by` int(10) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_info`
--

CREATE TABLE `tbl_company_info` (
  `id` int(10) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(200) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `vat_reg_no` varchar(200) NOT NULL,
  `vat_area_code` varchar(200) NOT NULL,
  `vat_status` int(11) NOT NULL,
  `invoice_size` varchar(200) NOT NULL,
  `logo` varchar(40) NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company_info`
--

INSERT INTO `tbl_company_info` (`id`, `company_name`, `address`, `phone`, `mobile`, `email`, `website`, `vat`, `vat_reg_no`, `vat_area_code`, `vat_status`, `invoice_size`, `logo`, `saved_by`, `saved_date`) VALUES
(8, ' President Corner', '', '', '', '', '', '0.00', '', '', 0, '', 'logo.png', 1, '2017-05-17 02:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_info`
--

CREATE TABLE `tbl_customer_info` (
  `id` int(11) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `customer_type` varchar(50) NOT NULL,
  `points` int(11) NOT NULL COMMENT 'Customerm Points',
  `status` int(11) NOT NULL DEFAULT '1',
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_points`
--

CREATE TABLE `tbl_customer_points` (
  `id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='none';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_type`
--

CREATE TABLE `tbl_customer_type` (
  `id` int(10) NOT NULL,
  `cus_type` varchar(150) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `saved_by` int(10) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_damage`
--

CREATE TABLE `tbl_damage` (
  `id` int(11) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qnty` double(10,2) NOT NULL,
  `remarks` text NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL,
  `damage_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `id` int(10) NOT NULL,
  `item_code` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `size` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_exdate`
--

CREATE TABLE `tbl_item_exdate` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `ex_date` date NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='none';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_points`
--

CREATE TABLE `tbl_item_points` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_points` double(10,2) NOT NULL,
  `saved_by` int(11) NOT NULL,
  `tra_date` date NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='none';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_price`
--

CREATE TABLE `tbl_item_price` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `active_date` date NOT NULL,
  `promo_from` date NOT NULL,
  `promo_to` date NOT NULL,
  `remarks` text NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_unit`
--

CREATE TABLE `tbl_item_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `saved_by` int(11) NOT NULL,
  `saved_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_points`
--

CREATE TABLE `tbl_points` (
  `id` int(11) NOT NULL,
  `taka_from` double(10,2) NOT NULL,
  `taka_to` double(10,2) NOT NULL,
  `points` int(5) NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='none';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `id` int(11) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `pur_id` bigint(20) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bonus_quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `ttl_price` int(11) NOT NULL,
  `pur_date` date NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `id` int(11) NOT NULL,
  `invoice_id` bigint(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qnty` double(10,2) NOT NULL,
  `price` double(10,2) NOT NULL,
  `vat` double(10,2) NOT NULL COMMENT 'per Item',
  `total_price` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL COMMENT 'Per Item/Discount not reduce from item here it is calculating in transaction table',
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='none';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_payment`
--

CREATE TABLE `tbl_sales_payment` (
  `id` int(11) NOT NULL,
  `invoice_id` bigint(20) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `transc_no` varchar(100) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `return_amt` double(11,2) NOT NULL,
  `pay_date` date NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='none';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_points`
--

CREATE TABLE `tbl_sales_points` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='none';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_transaction`
--

CREATE TABLE `tbl_sales_transaction` (
  `id` int(11) NOT NULL,
  `invoice_id` bigint(20) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `total_vat` double(10,2) NOT NULL,
  `rounding` double(11,2) NOT NULL,
  `g_total` double(10,2) NOT NULL COMMENT 'total sales amount',
  `payed_total` double(10,2) NOT NULL,
  `due_amount` double(10,2) NOT NULL,
  `remarks` text NOT NULL,
  `saved_by` int(11) NOT NULL,
  `tra_date` date NOT NULL,
  `saved_date` datetime NOT NULL,
  `invoice_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='none';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `available_stock` double(11,2) NOT NULL,
  `last_tra_date` date NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id` int(10) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `cp_mobile` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier_trans`
--

CREATE TABLE `tbl_supplier_trans` (
  `id` int(11) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `pur_id` bigint(20) NOT NULL COMMENT 'purchase id',
  `total_amount` decimal(10,2) NOT NULL,
  `paid` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL COMMENT 'total due',
  `invoice_due` double(11,2) NOT NULL COMMENT 'per invoice due',
  `remarks` text NOT NULL,
  `payment_date` date NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_info`
--

CREATE TABLE `tbl_user_info` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `about` text NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`id`, `name`, `email`, `mobile`, `username`, `password`, `about`, `usertype`, `status`, `saved_by`, `saved_date`) VALUES
(1, 'admin', 'admin@gmail.com', '014622', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 'admin', 1, 1, '2017-05-09 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- Indexes for table `tbl_company_info`
--
ALTER TABLE `tbl_company_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- Indexes for table `tbl_customer_info`
--
ALTER TABLE `tbl_customer_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- Indexes for table `tbl_customer_points`
--
ALTER TABLE `tbl_customer_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_type`
--
ALTER TABLE `tbl_customer_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- Indexes for table `tbl_damage`
--
ALTER TABLE `tbl_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_code` (`item_code`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- Indexes for table `tbl_item_exdate`
--
ALTER TABLE `tbl_item_exdate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item_points`
--
ALTER TABLE `tbl_item_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item_price`
--
ALTER TABLE `tbl_item_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- Indexes for table `tbl_item_unit`
--
ALTER TABLE `tbl_item_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_points`
--
ALTER TABLE `tbl_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `sup_id` (`sup_id`),
  ADD KEY `pur_id` (`pur_id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sales_payment`
--
ALTER TABLE `tbl_sales_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sales_points`
--
ALTER TABLE `tbl_sales_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sales_transaction`
--
ALTER TABLE `tbl_sales_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- Indexes for table `tbl_supplier_trans`
--
ALTER TABLE `tbl_supplier_trans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supp_id` (`supp_id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- Indexes for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_company_info`
--
ALTER TABLE `tbl_company_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_customer_info`
--
ALTER TABLE `tbl_customer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_customer_points`
--
ALTER TABLE `tbl_customer_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_customer_type`
--
ALTER TABLE `tbl_customer_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_damage`
--
ALTER TABLE `tbl_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_item_exdate`
--
ALTER TABLE `tbl_item_exdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_item_points`
--
ALTER TABLE `tbl_item_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_item_price`
--
ALTER TABLE `tbl_item_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_item_unit`
--
ALTER TABLE `tbl_item_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_points`
--
ALTER TABLE `tbl_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sales_payment`
--
ALTER TABLE `tbl_sales_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sales_points`
--
ALTER TABLE `tbl_sales_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sales_transaction`
--
ALTER TABLE `tbl_sales_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_supplier_trans`
--
ALTER TABLE `tbl_supplier_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD CONSTRAINT `tbl_category_ibfk_1` FOREIGN KEY (`saved_by`) REFERENCES `tbl_user_info` (`id`);

--
-- Constraints for table `tbl_company_info`
--
ALTER TABLE `tbl_company_info`
  ADD CONSTRAINT `tbl_company_info_ibfk_1` FOREIGN KEY (`saved_by`) REFERENCES `tbl_user_info` (`id`);

--
-- Constraints for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD CONSTRAINT `tbl_items_ibfk_2` FOREIGN KEY (`saved_by`) REFERENCES `tbl_user_info` (`id`),
  ADD CONSTRAINT `tbl_items_ibfk_3` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`id`);

--
-- Constraints for table `tbl_item_price`
--
ALTER TABLE `tbl_item_price`
  ADD CONSTRAINT `tbl_item_price_ibfk_1` FOREIGN KEY (`saved_by`) REFERENCES `tbl_user_info` (`id`),
  ADD CONSTRAINT `tbl_item_price_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tbl_items` (`id`);

--
-- Constraints for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD CONSTRAINT `tbl_purchase_ibfk_1` FOREIGN KEY (`saved_by`) REFERENCES `tbl_user_info` (`id`),
  ADD CONSTRAINT `tbl_purchase_ibfk_4` FOREIGN KEY (`sup_id`) REFERENCES `tbl_supplier` (`id`),
  ADD CONSTRAINT `tbl_purchase_ibfk_5` FOREIGN KEY (`item_id`) REFERENCES `tbl_items` (`id`);

--
-- Constraints for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD CONSTRAINT `tbl_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tbl_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD CONSTRAINT `tbl_supplier_ibfk_1` FOREIGN KEY (`saved_by`) REFERENCES `tbl_user_info` (`id`);

--
-- Constraints for table `tbl_supplier_trans`
--
ALTER TABLE `tbl_supplier_trans`
  ADD CONSTRAINT `tbl_supplier_trans_ibfk_1` FOREIGN KEY (`saved_by`) REFERENCES `tbl_user_info` (`id`),
  ADD CONSTRAINT `tbl_supplier_trans_ibfk_2` FOREIGN KEY (`supp_id`) REFERENCES `tbl_supplier` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
