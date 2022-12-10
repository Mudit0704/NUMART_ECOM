-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2022 at 12:45 AM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id19977229_ecommerce`
--
CREATE DATABASE IF NOT EXISTS `id19977229_ecommerce` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id19977229_ecommerce`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `addAdmin`$$
CREATE  PROCEDURE `addAdmin` (IN `admin_name` VARCHAR(255), IN `userId` VARCHAR(255), IN `admin_password` VARCHAR(255), IN `admin_type` VARCHAR(2))  INSERT INTO admin VALUES (NULL, admin_name, userId, admin_password, admin_type)$$

DROP PROCEDURE IF EXISTS `addBrand`$$
CREATE  PROCEDURE `addBrand` (IN `brand_name` VARCHAR(255))  BEGIN
DECLARE EXIT HANDLER FOR 1062 SELECT 'Duplicate keys error encountered' Message;
INSERT INTO brand VALUES (NULL, brand_name);
END$$

DROP PROCEDURE IF EXISTS `addCart`$$
CREATE  PROCEDURE `addCart` (IN `user_email` VARCHAR(255), IN `date` VARCHAR(255), IN `status` VARCHAR(255))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
INSERT INTO cart VALUES (NULL, user_email, date, status)$$

DROP PROCEDURE IF EXISTS `addOrder`$$
CREATE  PROCEDURE `addOrder` (IN `cart_id` INT, IN `user_email` VARCHAR(255), IN `date` VARCHAR(255), IN `payment_type` VARCHAR(10), IN `address_type` VARCHAR(255), IN `total_amount` INT, IN `status` VARCHAR(500))  INSERT INTO `order` VALUES (NULL, cart_id, user_email, date, payment_type, address_type, total_amount, status)$$

DROP PROCEDURE IF EXISTS `addOrderDetails`$$
CREATE  PROCEDURE `addOrderDetails` (IN `order_id` INT, IN `product_id` INT, IN `quantity` INT, IN `price` INT, IN `status` VARCHAR(255))  INSERT INTO orderdetails VALUES (NULL, order_id, product_id, quantity, price, status)$$

DROP PROCEDURE IF EXISTS `addProduct`$$
CREATE  PROCEDURE `addProduct` (IN `product_name` VARCHAR(255), IN `brand_id` INT, IN `type_id` INT, IN `file_name` VARCHAR(500), IN `price` INT, IN `addition_date` VARCHAR(255), IN `availability` VARCHAR(1), IN `addedBy` VARCHAR(255))  INSERT INTO product VALUES (NULL, product_name, brand_id, type_id, file_name, price, addition_date, availability, addedBy)$$

DROP PROCEDURE IF EXISTS `addToDetailCart`$$
CREATE  PROCEDURE `addToDetailCart` (IN `cart_id` INT, IN `product_id` INT, IN `quantity` INT, IN `amount` INT)  INSERT INTO detailedcart VALUES (NULL, cart_id, product_id, quantity, amount)$$

DROP PROCEDURE IF EXISTS `addType`$$
CREATE  PROCEDURE `addType` (IN `type_name` VARCHAR(255))  BEGIN
DECLARE EXIT HANDLER FOR 1062 SELECT 'Duplicate keys error encountered' Message;
INSERT INTO producttype VALUES (NULL, type_name);
END$$

DROP PROCEDURE IF EXISTS `addUser`$$
CREATE  PROCEDURE `addUser` (IN `user_name` VARCHAR(255), IN `user_email` VARCHAR(255), IN `user_password` VARCHAR(255), IN `user_gender` VARCHAR(1), IN `user_address` VARCHAR(5000))  BEGIN
DECLARE EXIT HANDLER FOR 1062 SELECT 'Duplicate keys error encountered' Message;
INSERT INTO userdetails VALUES (NULL, user_name, user_email, user_password, user_gender, user_address);
END$$

DROP PROCEDURE IF EXISTS `addUserAddress`$$
CREATE  PROCEDURE `addUserAddress` (IN `user_id` INT, IN `user_email` VARCHAR(255), IN `address_type` VARCHAR(255), IN `preferred_time` VARCHAR(255), IN `address` VARCHAR(5000))  INSERT INTO useraddress VALUES (NULL, user_id, user_email, address_type, preferred_time, address)$$

DROP PROCEDURE IF EXISTS `cancelOrder`$$
CREATE  PROCEDURE `cancelOrder` (IN `order_id` INT)  UPDATE `order` SET order.status = "Cancelled" WHERE order.order_Id = order_id$$

DROP PROCEDURE IF EXISTS `checkAdminCredentials`$$
CREATE  PROCEDURE `checkAdminCredentials` (IN `userId` VARCHAR(255), IN `password` VARCHAR(255))  select * from admin a where a.userId=userId and a.password=password$$

DROP PROCEDURE IF EXISTS `checkUserCredentials`$$
CREATE  PROCEDURE `checkUserCredentials` (IN `user_email` VARCHAR(255), IN `user_password` VARCHAR(255))  SELECT * FROM userdetails WHERE userdetails.user_email = user_email and userdetails.user_pass = user_password$$

DROP PROCEDURE IF EXISTS `deleteAdmin`$$
CREATE  PROCEDURE `deleteAdmin` (IN `admin_id` INT)  DELETE from admin where admin.admin_id = admin_id$$

DROP PROCEDURE IF EXISTS `deleteBrand`$$
CREATE  PROCEDURE `deleteBrand` (IN `brand_id` INT)  DELETE FROM brand where brand.brand_id = brand_id$$

DROP PROCEDURE IF EXISTS `deleteFromDetailedCart`$$
CREATE  PROCEDURE `deleteFromDetailedCart` (IN `detailCart_id` INT)  DELETE FROM detailedcart WHERE detailedcart.detailCart_ID = detailCart_id$$

DROP PROCEDURE IF EXISTS `deleteProduct`$$
CREATE  PROCEDURE `deleteProduct` (IN `product_id` INT)  DELETE FROM product WHERE product.product_id = product_id$$

DROP PROCEDURE IF EXISTS `deleteType`$$
CREATE  PROCEDURE `deleteType` (IN `type_id` INT)  DELETE FROM producttype where producttype.type_id = type_id$$

DROP PROCEDURE IF EXISTS `getAdminDetails`$$
CREATE  PROCEDURE `getAdminDetails` (IN `admin_id` INT)  SELECT * FROM admin WHERE admin.admin_id = admin_id$$

DROP PROCEDURE IF EXISTS `getAllAdmins`$$
CREATE  PROCEDURE `getAllAdmins` ()  SELECT * FROM admin$$

DROP PROCEDURE IF EXISTS `getAllBrands`$$
CREATE  PROCEDURE `getAllBrands` ()  BEGIN
DECLARE EXIT HANDLER FOR 1146 SELECT 'Please create table brand first' Message;
SELECT * FROM brand;
END$$

DROP PROCEDURE IF EXISTS `getAllOrders`$$
CREATE  PROCEDURE `getAllOrders` ()  BEGIN
DECLARE EXIT HANDLER FOR 1146 SELECT 'Please create table order first' Message;
SELECT * FROM `order` ORDER BY order_id DESC;
END$$

DROP PROCEDURE IF EXISTS `getAllProductDetails`$$
CREATE  PROCEDURE `getAllProductDetails` ()  SELECT * FROM product p INNER JOIN brand b on b.brand_id = p.brand_id INNER JOIN producttype pt on pt.type_id = p.producttype_id$$

DROP PROCEDURE IF EXISTS `getAllTypes`$$
CREATE  PROCEDURE `getAllTypes` ()  BEGIN
DECLARE EXIT HANDLER FOR 1146 SELECT 'Please create table producttype first' Message;
SELECT * FROM producttype;
END$$

DROP PROCEDURE IF EXISTS `getBrandDetails`$$
CREATE  PROCEDURE `getBrandDetails` (IN `brand_id` INT)  SELECT * FROM brand where brand.brand_id = brand_id$$

DROP PROCEDURE IF EXISTS `getCartOrder`$$
CREATE  PROCEDURE `getCartOrder` (IN `cart_id` INT)  SELECT * FROM `order` where order.cart_Id = cart_id$$

DROP PROCEDURE IF EXISTS `getDetailedCart`$$
CREATE  PROCEDURE `getDetailedCart` (IN `cart_id` INT)  SELECT * FROM detailedcart WHERE detailedcart.cart_id = cart_id$$

DROP PROCEDURE IF EXISTS `getDetailedOrder`$$
CREATE  PROCEDURE `getDetailedOrder` (IN `order_id` INT)  SELECT p.product_id
      ,p.product_name
      ,o2.quantity
      ,p.price
      ,o2.orderDetails_id
      ,o1.address_type
      ,o1.payment_type
      ,o2.status

FROM `order` o1
     INNER JOIN orderdetails o2 ON o2.order_id = o1.order_Id
     INNER JOIN product p ON p.product_id = o2.product_id
     WHERE o1.order_Id = order_id$$

DROP PROCEDURE IF EXISTS `getOngoingUserCart`$$
CREATE  PROCEDURE `getOngoingUserCart` (IN `user_email` VARCHAR(255))  SELECT * FROM cart where cart.user_id = user_email and cart.status = "ongoing"$$

DROP PROCEDURE IF EXISTS `getOrderDetails`$$
CREATE  PROCEDURE `getOrderDetails` (IN `order_id` INT)  SELECT * FROM orderdetails WHERE orderdetails.order_id = order_id$$

DROP PROCEDURE IF EXISTS `getProduct`$$
CREATE  PROCEDURE `getProduct` (IN `product_id` INT)  SELECT * FROM product WHERE product.product_id = product_id$$

DROP PROCEDURE IF EXISTS `getTypeDetails`$$
CREATE  PROCEDURE `getTypeDetails` (IN `type_id` INT)  SELECT * FROM producttype where producttype.type_id = type_id$$

DROP PROCEDURE IF EXISTS `getUserDetails`$$
CREATE  PROCEDURE `getUserDetails` (IN `user_id` INT)  SELECT * FROM userdetails WHERE userdetails.user_id = user_id$$

DROP PROCEDURE IF EXISTS `getUserOrders`$$
CREATE  PROCEDURE `getUserOrders` (IN `user_email` VARCHAR(255))  SELECT * FROM `order` WHERE order.user_Id = user_email ORDER BY order.order_Id DESC$$

DROP PROCEDURE IF EXISTS `getUserSavedAddresses`$$
CREATE  PROCEDURE `getUserSavedAddresses` (IN `user_email` VARCHAR(255))  SELECT * FROM useraddress WHERE useraddress.user_email = user_email$$

DROP PROCEDURE IF EXISTS `getUserSpecificAddress`$$
CREATE  PROCEDURE `getUserSpecificAddress` (IN `user_email` VARCHAR(255), IN `address_type` VARCHAR(255))  SELECT useraddress.address FROM useraddress where useraddress.user_email = user_email and useraddress.address_type = address_type$$

DROP PROCEDURE IF EXISTS `updateAdmin`$$
CREATE  PROCEDURE `updateAdmin` (IN `admin_id` INT, IN `admin_name` VARCHAR(255), IN `userId` VARCHAR(255), IN `admin_password` VARCHAR(255), IN `admin_type` VARCHAR(2))  UPDATE admin a SET a.admin_name = admin_name, a.userId = userId, a.password = admin_password, a.admintype = admin_type WHERE a.admin_id = admin_id$$

DROP PROCEDURE IF EXISTS `updateBrand`$$
CREATE  PROCEDURE `updateBrand` (IN `brand_id` INT, IN `brand_name` VARCHAR(255))  UPDATE brand SET brand.brand_name = brand_name WHERE brand.brand_id = brand_id$$

DROP PROCEDURE IF EXISTS `updateCartStatus`$$
CREATE  PROCEDURE `updateCartStatus` (IN `cart_id` INT, IN `status` VARCHAR(255))  UPDATE cart SET cart.status = status WHERE cart.cart_id = cart_id$$

DROP PROCEDURE IF EXISTS `updateOrderStatus`$$
CREATE  PROCEDURE `updateOrderStatus` (IN `order_id` INT, IN `order_status` VARCHAR(255))  UPDATE
  `order`
SET
  `order`.`status` = order_status
WHERE
  `order`.`order_Id` = order_id$$

DROP PROCEDURE IF EXISTS `updateProduct`$$
CREATE  PROCEDURE `updateProduct` (IN `product_id` INT, IN `product_name` VARCHAR(500), IN `brand_id` INT, IN `type_id` INT, IN `image_file` VARCHAR(500), IN `price` INT, IN `creation_date` VARCHAR(255), IN `availability` VARCHAR(1), IN `addedBy` VARCHAR(255))  UPDATE product p SET p.product_name = product_name, p.brand_id = brand_id, p.producttype_id = type_id, p.product_image = image_file, p.price = price, p.addition_date = creation_date, p.availability = availability, p.addedby = addedBy WHERE p.product_id = product_id$$

DROP PROCEDURE IF EXISTS `updateType`$$
CREATE  PROCEDURE `updateType` (IN `type_id` INT, IN `type_name` VARCHAR(255))  UPDATE producttype SET producttype.type_name = type_name WHERE producttype.type_id = type_id$$

DROP PROCEDURE IF EXISTS `updateUserDetails`$$
CREATE  PROCEDURE `updateUserDetails` (IN `user_id` INT, IN `user_name` VARCHAR(255), IN `user_gender` VARCHAR(1), IN `user_address` VARCHAR(5000), IN `user_password` VARCHAR(255))  UPDATE userdetails SET userdetails.user_name = user_name, userdetails.gender = user_gender, userdetails.address = user_address, userdetails.user_pass = user_password WHERE userdetails.user_id = user_id$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `checkUserWithEmailExists`$$
CREATE  FUNCTION `checkUserWithEmailExists` (`user_email` VARCHAR(255)) RETURNS INT(11) READS SQL DATA
    DETERMINISTIC
BEGIN
DECLARE ALREADYEXIST INT;

SELECT COUNT(*) INTO ALREADYEXIST FROM userdetails WHERE userdetails.user_email = user_email;

RETURN (ALREADYEXIST);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(500) NOT NULL,
  `userId` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `admintype` varchar(2) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `userId`, `password`, `admintype`) VALUES
(1, 'Mudit', 'admin1', 'adminpass1', 'SA'),
(12, 'Arush', 'admin2', 'adminpass1', 'A'),
(14, 'Adesh', 'admin3', 'adesh1890', 'A');

-- --------------------------------------------------------

--
-- Stand-in structure for view `avg_order_values`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `avg_order_values`;
CREATE TABLE IF NOT EXISTS `avg_order_values` (
`avg_orders_value` double
);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(500) NOT NULL,
  PRIMARY KEY (`brand_id`),
  UNIQUE KEY `brand_name` (`brand_name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(13, 'Apple'),
(14, 'Borosil'),
(16, 'Columbia'),
(18, 'Corelle'),
(12, 'IKEA'),
(15, 'North Face'),
(17, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(500) NOT NULL,
  `creation_date` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `cart_user_fk` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `creation_date`, `status`) VALUES
(50, 'mudit@gmail.com', '2022/12/08', ''),
(51, 'mudit@gmail.com', '2022/12/08', ''),
(52, 'arushagarwal@gmail.com', '2022/12/08', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `detailedcart`
--

DROP TABLE IF EXISTS `detailedcart`;
CREATE TABLE IF NOT EXISTS `detailedcart` (
  `detailCart_ID` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_Id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`detailCart_ID`),
  KEY `detailCart_product_fk` (`product_Id`),
  KEY `detailCart_cart_fk` (`cart_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailedcart`
--

INSERT INTO `detailedcart` (`detailCart_ID`, `cart_id`, `product_Id`, `quantity`, `price`) VALUES
(70, 50, 17, 2, 200),
(71, 50, 18, 1, 50),
(72, 50, 19, 3, 75),
(73, 50, 20, 5, 75),
(74, 51, 12, 1, 30),
(75, 51, 13, 1, 50),
(76, 51, 11, 1, 100),
(77, 51, 14, 1, 150),
(78, 52, 21, 1, 100),
(79, 52, 22, 2, 40);

-- --------------------------------------------------------

--
-- Stand-in structure for view `num_of_orders_for_address_type`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `num_of_orders_for_address_type`;
CREATE TABLE IF NOT EXISTS `num_of_orders_for_address_type` (
`address_type` varchar(500)
,`num_of_orders` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `num_of_products_of_a_brand`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `num_of_products_of_a_brand`;
CREATE TABLE IF NOT EXISTS `num_of_products_of_a_brand` (
`brand_name` varchar(500)
,`num_of_products` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `num_of_products_of_a_type`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `num_of_products_of_a_type`;
CREATE TABLE IF NOT EXISTS `num_of_products_of_a_type` (
`type_name` varchar(500)
,`num_of_products` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `order_Id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_Id` int(11) NOT NULL,
  `user_Id` varchar(500) NOT NULL,
  `creation_date` varchar(500) NOT NULL,
  `payment_type` varchar(500) NOT NULL,
  `address_type` varchar(500) NOT NULL,
  `total_amt` double NOT NULL,
  `status` varchar(500) NOT NULL,
  PRIMARY KEY (`order_Id`),
  KEY `order_cart_fk` (`cart_Id`),
  KEY `order_user_fk` (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_Id`, `cart_Id`, `user_Id`, `creation_date`, `payment_type`, `address_type`, `total_amt`, `status`) VALUES
(28, 50, 'mudit@gmail.com', '2022/12/08', 'COD', 'Work', 400, 'Ordered'),
(29, 51, 'mudit@gmail.com', '2022/12/08', 'CARD', 'Home', 330, 'Dispatched');

--
-- Triggers `order`
--
DROP TRIGGER IF EXISTS `order_after_update`;
DELIMITER $$
CREATE TRIGGER `order_after_update` AFTER UPDATE ON `order` FOR EACH ROW BEGIN

UPDATE orderdetails SET orderdetails.status = New.status WHERE orderdetails.order_id = Old.order_Id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderDetails_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `status` varchar(500) NOT NULL,
  PRIMARY KEY (`orderDetails_id`),
  KEY `orderDetails_order_fk` (`order_id`),
  KEY `orderDetails_product_fk` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderDetails_id`, `order_id`, `product_id`, `quantity`, `price`, `status`) VALUES
(24, 28, 17, 2, 200, 'Ordered'),
(25, 28, 18, 1, 50, 'Ordered'),
(26, 28, 19, 3, 75, 'Ordered'),
(27, 28, 20, 5, 75, 'Ordered'),
(28, 29, 12, 1, 30, 'Dispatched'),
(29, 29, 13, 1, 50, 'Dispatched'),
(30, 29, 11, 1, 100, 'Dispatched'),
(31, 29, 14, 1, 150, 'Dispatched');

-- --------------------------------------------------------

--
-- Stand-in structure for view `popular_product`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `popular_product`;
CREATE TABLE IF NOT EXISTS `popular_product` (
`product_name` varchar(500)
,`brand_name` varchar(500)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `preferred_payment_mode`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `preferred_payment_mode`;
CREATE TABLE IF NOT EXISTS `preferred_payment_mode` (
`payment_type` varchar(500)
,`orders_with_payment` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(500) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `producttype_id` int(11) NOT NULL,
  `product_image` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `addition_date` varchar(500) NOT NULL,
  `availability` varchar(1) NOT NULL,
  `addedby` varchar(500) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `product_brand_fk` (`brand_id`),
  KEY `product_type_fk` (`producttype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `brand_id`, `producttype_id`, `product_image`, `price`, `addition_date`, `availability`, `addedby`) VALUES
(11, 'Bed Frame', 12, 1, 'bedFrame.jpeg', 100, '2022/12/08', 'Y', 'Mudit'),
(12, 'Chair', 12, 1, 'chair.jpeg', 30, '2022/12/08', 'Y', 'Mudit'),
(13, 'Desk', 12, 1, 'desk.jpeg', 50, '2022/12/08', 'Y', 'Arush'),
(14, 'Mattress', 12, 1, 'mattress.jpeg', 150, '2022/12/08', 'Y', 'Arush'),
(15, 'Mobile', 13, 9, 'iphone.jpeg', 850, '2022/12/08', 'Y', 'Mudit'),
(16, 'MacBook', 13, 9, 'macbook.jpeg', 1100, '2022/12/08', 'Y', 'Arush'),
(17, 'Jacket', 15, 11, 'jacket.jpeg', 100, '2022/12/08', 'Y', 'Mudit'),
(18, 'Hoodie', 16, 11, 'hoodie.jpg', 50, '2022/12/08', 'Y', 'Mudit'),
(19, 'Winter Cap', 15, 11, 'caps.jpg', 25, '2022/12/08', 'Y', 'Arush'),
(20, 'Gloves', 16, 11, 'gloves.jpeg', 15, '2022/12/08', 'Y', 'Arush'),
(21, 'Utensil Set', 18, 10, 'set.jpg', 100, '2022/12/08', 'Y', 'Mudit'),
(22, 'Pans', 14, 10, 'pan.jpeg', 20, '2022/12/08', 'Y', 'Mudit');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

DROP TABLE IF EXISTS `producttype`;
CREATE TABLE IF NOT EXISTS `producttype` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(500) NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`type_id`, `type_name`) VALUES
(11, 'apparels'),
(1, 'Furniture'),
(9, 'Tech'),
(10, 'Utensils');

-- --------------------------------------------------------

--
-- Table structure for table `useraddress`
--

DROP TABLE IF EXISTS `useraddress`;
CREATE TABLE IF NOT EXISTS `useraddress` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(500) NOT NULL,
  `address_type` varchar(500) NOT NULL,
  `preferred_time` varchar(500) NOT NULL,
  `address` varchar(5000) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `address_user_fk` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraddress`
--

INSERT INTO `useraddress` (`address_id`, `user_id`, `user_email`, `address_type`, `preferred_time`, `address`) VALUES
(13, 18, 'mudit@gmail.com', 'Home', 'morning', '822 Huntington Avenue, Boston-02115'),
(14, 18, 'mudit@gmail.com', 'Work', 'night', '760 Huntington Avenue, Boston-02115'),
(15, 17, 'arushagarwal@gmail.com', 'Home', 'morning', '1209 boylston street, boston-02116');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

DROP TABLE IF EXISTS `userdetails`;
CREATE TABLE IF NOT EXISTS `userdetails` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(500) NOT NULL,
  `user_email` varchar(500) NOT NULL,
  `user_pass` varchar(500) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `address` varchar(2000) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`user_id`, `user_name`, `user_email`, `user_pass`, `gender`, `address`) VALUES
(17, 'arush', 'arushagarwal@gmail.com', 'abcd@1234', 'M', 'A-58 krishan vihar, delhi-110086'),
(18, 'Mudit', 'mudit@gmail.com', 'Mudit1998', 'M', '822 Huntington Avenue, Boston-02115'),
(19, 'Yash', 'yash@hotmail.com', 'Yash2022', 'M', '360, Huntington Avenue, Boston-02115'),
(21, 'Kathleen', 'kathleen@neu.in', 'kathleen', 'M', 'boylston street');

-- --------------------------------------------------------

--
-- Structure for view `avg_order_values`
--
DROP TABLE IF EXISTS `avg_order_values`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `avg_order_values`  AS  select avg(`order`.`total_amt`) AS `avg_orders_value` from `order` ;

-- --------------------------------------------------------

--
-- Structure for view `num_of_orders_for_address_type`
--
DROP TABLE IF EXISTS `num_of_orders_for_address_type`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `num_of_orders_for_address_type`  AS  select `order`.`address_type` AS `address_type`,count(0) AS `num_of_orders` from `order` group by `order`.`address_type` ;

-- --------------------------------------------------------

--
-- Structure for view `num_of_products_of_a_brand`
--
DROP TABLE IF EXISTS `num_of_products_of_a_brand`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `num_of_products_of_a_brand`  AS  select `brand`.`brand_name` AS `brand_name`,count(0) AS `num_of_products` from (`product` join `brand` on(`product`.`brand_id` = `brand`.`brand_id`)) group by `product`.`brand_id` order by `brand`.`brand_name` ;

-- --------------------------------------------------------

--
-- Structure for view `num_of_products_of_a_type`
--
DROP TABLE IF EXISTS `num_of_products_of_a_type`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `num_of_products_of_a_type`  AS  select `producttype`.`type_name` AS `type_name`,count(0) AS `num_of_products` from (`product` join `producttype` on(`producttype`.`type_id` = `product`.`producttype_id`)) group by `product`.`producttype_id` order by `producttype`.`type_name` ;

-- --------------------------------------------------------

--
-- Structure for view `popular_product`
--
DROP TABLE IF EXISTS `popular_product`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `popular_product`  AS  select `product`.`product_name` AS `product_name`,`brand`.`brand_name` AS `brand_name` from (`product` join `brand` on(`product`.`brand_id` = `brand`.`brand_id`)) where `product`.`product_id` = (select `orderdetails`.`product_id` from `orderdetails` group by `orderdetails`.`product_id` order by sum(`orderdetails`.`quantity`) desc limit 1) ;

-- --------------------------------------------------------

--
-- Structure for view `preferred_payment_mode`
--
DROP TABLE IF EXISTS `preferred_payment_mode`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `preferred_payment_mode`  AS  select `order`.`payment_type` AS `payment_type`,count(`order`.`payment_type`) AS `orders_with_payment` from `order` group by `order`.`payment_type` order by count(`order`.`payment_type`) desc limit 1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_user_fk` FOREIGN KEY (`user_id`) REFERENCES `userdetails` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detailedcart`
--
ALTER TABLE `detailedcart`
  ADD CONSTRAINT `detailCart_cart_fk` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailCart_product_fk` FOREIGN KEY (`product_Id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_cart_fk` FOREIGN KEY (`cart_Id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_user_fk` FOREIGN KEY (`user_Id`) REFERENCES `userdetails` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderDetails_order_fk` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderDetails_product_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_brand_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_type_fk` FOREIGN KEY (`producttype_id`) REFERENCES `producttype` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `useraddress`
--
ALTER TABLE `useraddress`
  ADD CONSTRAINT `address_user_fk` FOREIGN KEY (`user_email`) REFERENCES `userdetails` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
