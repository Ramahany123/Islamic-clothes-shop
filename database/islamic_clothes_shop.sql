-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 01:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `islamic_clothes_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_Username` varchar(100) NOT NULL,
  `Admin_Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Username`, `Admin_Password`) VALUES
(1, 'shahd', '123');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_id` int(11) NOT NULL,
  `Category_name` varchar(30) DEFAULT NULL,
  `Categor_Discription` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_id`, `Category_name`, `Categor_Discription`) VALUES
(1, 'Skirts', NULL),
(2, 'Hijabs', NULL),
(3, 'Dresses', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(30) DEFAULT NULL,
  `customer_username` varchar(30) DEFAULT NULL,
  `customer_phone_number` int(11) DEFAULT NULL,
  `customer_Email` varchar(50) DEFAULT NULL,
  `customer_address` varchar(50) DEFAULT NULL,
  `customer_password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_username`, `customer_phone_number`, `customer_Email`, `customer_address`, `customer_password`) VALUES
(1, 'hany rama', 'rama', 10123432, 'hsafd@gamil.com', 'El Helal, near davinci hotel', '12345678'),
(4, 'rama', 'fiz', 14235213, 'hasf@gamil.com', 'El Helal, near davinci hotel', '123453'),
(5, 'rama hany', 'new', 51235423, 'afsd@gmail.com', 'El Helal, near davinci hotel', '12345'),
(6, 'rama', 'fas', 12434123, 'afds@gamil.com', 'El Helal, near davinci hotel', 'rqwe'),
(7, 'asfd', 'fasd', 1524542, 'fas@gmail.com', 'gafs', '1234'),
(8, 'rama', 'rama34', 98876567, 'fghf@gmil.com', 'El Helal, near davinci hotel', '1234'),
(9, 'rama', 'rama12', 12454351, 'rama@gmail.com', 'El Helal, near davinci hotel', '12345'),
(10, 'ahmed', 'ahmed', 12355434, 'dfsa@gamil.com', 'El Helal, near davinci hotel', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_id` int(11) NOT NULL,
  `Order_date` datetime DEFAULT NULL,
  `Order_total_amount` float DEFAULT NULL,
  `Order_status` varchar(30) DEFAULT NULL,
  `Customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_id`, `Order_date`, `Order_total_amount`, `Order_status`, `Customer_id`) VALUES
(1, '2024-03-23 21:29:29', NULL, 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordersdetails`
--

CREATE TABLE `ordersdetails` (
  `OrdersDetails_id` int(11) NOT NULL,
  `OrdersDetails_Quantity` int(11) DEFAULT NULL,
  `OrdersDetails_payment_methods` varchar(50) DEFAULT NULL,
  `OrdersDetails_shipping_address` varchar(50) DEFAULT NULL,
  `OrdersDetails_orders_id` int(11) DEFAULT NULL,
  `OrdersDetails_product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordersdetails`
--

INSERT INTO `ordersdetails` (`OrdersDetails_id`, `OrdersDetails_Quantity`, `OrdersDetails_payment_methods`, `OrdersDetails_shipping_address`, `OrdersDetails_orders_id`, `OrdersDetails_product_id`) VALUES
(1, 1, 'visa', 'El Helal, near davinci hotel, Hurghada, Egypt, 106', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_QuantityInStock` int(11) DEFAULT NULL,
  `product_Size` varchar(30) DEFAULT NULL,
  `product_Color` varchar(30) DEFAULT NULL,
  `product_details` varchar(1000) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `Category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_QuantityInStock`, `product_Size`, `product_Color`, `product_details`, `product_image`, `Category_id`) VALUES
(1, 'dress', 400, 5, 'M', 'blue', 'it is a dress made with the highest quality in Egypt', 'pro-3.png', 3),
(2, 'skirt', 300, 3, 'L', 'black white beige', 'skirt made with highest quality in Egypt', 'uploaded/skirt1.jpg', 1),
(3, 'Abaya', 600, 3, 'L', 'white', NULL, 'uploaded/dress2.jpeg', 3),
(4, 'genz skirt', 350, 10, 'XL', 'blue', NULL, 'uploaded/genz skirt.jpeg', 1),
(5, 'Hijab', 100, 5, 'onesize', 'black white ', NULL, 'uploaded/pro-4.png', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `ordersdetails`
--
ALTER TABLE `ordersdetails`
  ADD PRIMARY KEY (`OrdersDetails_id`),
  ADD KEY `OrdersDetails_orders_id` (`OrdersDetails_orders_id`),
  ADD KEY `OrdersDetails_product_id` (`OrdersDetails_product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `Category_id` (`Category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ordersdetails`
--
ALTER TABLE `ordersdetails`
  MODIFY `OrdersDetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE SET NULL;

--
-- Constraints for table `ordersdetails`
--
ALTER TABLE `ordersdetails`
  ADD CONSTRAINT `ordersdetails_ibfk_1` FOREIGN KEY (`OrdersDetails_orders_id`) REFERENCES `orders` (`Order_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ordersdetails_ibfk_2` FOREIGN KEY (`OrdersDetails_product_id`) REFERENCES `product` (`product_id`) ON DELETE SET NULL;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Category_id`) REFERENCES `category` (`Category_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
