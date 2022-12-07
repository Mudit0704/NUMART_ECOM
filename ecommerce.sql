-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 06:12 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--
CREATE DATABASE IF NOT EXISTS `ecommerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecommerce`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `addAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addAdmin` (IN `admin_name` VARCHAR(255), IN `userId` VARCHAR(255), IN `admin_password` VARCHAR(255), IN `admin_type` VARCHAR(2))   INSERT INTO admin VALUES ('', admin_name, userId, admin_password, admin_type)$$

DROP PROCEDURE IF EXISTS `addBrand`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addBrand` (IN `brand_name` VARCHAR(255))   INSERT INTO brand VALUES ('', brand_name)$$

DROP PROCEDURE IF EXISTS `addCart`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addCart` (IN `user_email` VARCHAR(255), IN `date` VARCHAR(255), IN `status` VARCHAR(255)) INSERT INTO cart VALUES ('', user_email, date, status)$$

DROP PROCEDURE IF EXISTS `addOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addOrder` (IN `cart_id` INT, IN `user_email` VARCHAR(255), IN `date` VARCHAR(255), IN `payment_type` VARCHAR(10), IN `address_type` VARCHAR(255), IN `total_amount` INT, IN `status` VARCHAR(500)) INSERT INTO `order` VALUES ('', cart_id, user_email, date, payment_type, address_type, total_amount, status)$$

DROP PROCEDURE IF EXISTS `addOrderDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addOrderDetails` (IN `order_id` INT, IN `product_id` INT, IN `quantity` INT, IN `price` INT, IN `status` VARCHAR(255))   INSERT INTO orderdetails VALUES ('', order_id, product_id, quantity, price, status)$$

DROP PROCEDURE IF EXISTS `addProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addProduct` (IN `product_name` VARCHAR(255), IN `brand_id` INT, IN `type_id` INT, IN `file_name` VARCHAR(500), IN `price` INT, IN `addition_date` VARCHAR(255), IN `availability` VARCHAR(1), IN `addedBy` VARCHAR(255))   INSERT INTO product VALUES ('', product_name, brand_id, type_id, file_name, price, addition_date, availability, addedBy)$$

DROP PROCEDURE IF EXISTS `addToDetailCart`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addToDetailCart` (IN `cart_id` INT, IN `product_id` INT, IN `quantity` INT, IN `amount` INT)   INSERT INTO detailedcart VALUES ('', cart_id, product_id, quantity, amount)$$

DROP PROCEDURE IF EXISTS `addType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addType` (IN `type_name` VARCHAR(255))   INSERT INTO producttype VALUES ('', type_name)$$

DROP PROCEDURE IF EXISTS `addUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addUser` (IN `user_name` VARCHAR(255), IN `user_email` VARCHAR(255), IN `user_password` VARCHAR(255), IN `user_gender` VARCHAR(1), IN `user_address` VARCHAR(5000))   INSERT INTO userdetails VALUES ('', user_name, user_email, user_password, user_gender, user_address)$$

DROP PROCEDURE IF EXISTS `addUserAddress`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addUserAddress` (IN `user_id` INT, IN `user_email` VARCHAR(255), IN `address_type` VARCHAR(255), IN `preferred_time` VARCHAR(255), IN `address` VARCHAR(5000))   INSERT INTO useraddress VALUES ('', user_id, user_email, address_type, preferred_time, address)$$

DROP PROCEDURE IF EXISTS `cancelOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cancelOrder` (IN `order_id` INT)   UPDATE `order` SET order.status = "Cancelled" WHERE order.order_Id = order_id$$

DROP PROCEDURE IF EXISTS `checkAdminCredentials`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkAdminCredentials` (IN `userId` VARCHAR(255), IN `password` VARCHAR(255))  DETERMINISTIC select * from admin a where a.userId=userId and a.password=password$$

DROP PROCEDURE IF EXISTS `checkUserCredentials`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkUserCredentials` (IN `user_email` VARCHAR(255), IN `user_password` VARCHAR(255))   SELECT * FROM userdetails WHERE userdetails.user_email = user_email and userdetails.user_pass = user_password$$

DROP PROCEDURE IF EXISTS `deleteAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteAdmin` (IN `admin_id` INT)  DETERMINISTIC DELETE from admin where admin.admin_id = admin_id$$

DROP PROCEDURE IF EXISTS `deleteBrand`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteBrand` (IN `brand_id` INT)   DELETE FROM brand where brand.brand_id = brand_id$$

DROP PROCEDURE IF EXISTS `deleteFromDetailedCart`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteFromDetailedCart` (IN `detailCart_id` INT)   DELETE FROM detailedcart WHERE detailedcart.detailCart_ID = detailCart_id$$

DROP PROCEDURE IF EXISTS `deleteProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteProduct` (IN `product_id` INT)   DELETE FROM product WHERE product.product_id = product_id$$

DROP PROCEDURE IF EXISTS `deleteType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteType` (IN `type_id` INT)   DELETE FROM producttype where producttype.type_id = type_id$$

DROP PROCEDURE IF EXISTS `getAdminDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAdminDetails` (IN `admin_id` INT)  DETERMINISTIC SELECT * FROM admin WHERE admin.admin_id = admin_id$$

DROP PROCEDURE IF EXISTS `getAllAdmins`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllAdmins` ()   SELECT * FROM admin$$

DROP PROCEDURE IF EXISTS `getAllBrands`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllBrands` ()   SELECT * FROM brand$$

DROP PROCEDURE IF EXISTS `getAllOrders`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllOrders` ()   SELECT * FROM `order` ORDER BY order_id DESC$$

DROP PROCEDURE IF EXISTS `getAllProductDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllProductDetails` ()   SELECT * FROM product p INNER JOIN brand b on b.brand_id = p.brand_id INNER JOIN producttype pt on pt.type_id = p.producttype_id$$

DROP PROCEDURE IF EXISTS `getAllTypes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllTypes` ()   SELECT * FROM producttype$$

DROP PROCEDURE IF EXISTS `getBrandDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getBrandDetails` (IN `brand_id` INT)   SELECT * FROM brand where brand.brand_id = brand_id$$

DROP PROCEDURE IF EXISTS `getCartOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCartOrder` (IN `cart_id` INT)   SELECT * FROM `order` where order.cart_Id = cart_id$$

DROP PROCEDURE IF EXISTS `getDetailedCart`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailedCart` (IN `cart_id` INT)   SELECT * FROM detailedcart WHERE detailedcart.cart_id = cart_id$$

DROP PROCEDURE IF EXISTS `getDetailedOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailedOrder` (IN `order_id` INT)   SELECT p.product_id
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOngoingUserCart` (IN `user_email` VARCHAR(255))   SELECT * FROM cart where cart.user_id = user_email and cart.status = "ongoing"$$

DROP PROCEDURE IF EXISTS `getOrderDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrderDetails` (IN `order_id` INT)   SELECT * FROM orderdetails WHERE orderdetails.order_id = order_id$$

DROP PROCEDURE IF EXISTS `getProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProduct` (IN `product_id` INT)   SELECT * FROM product WHERE product.product_id = product_id$$

DROP PROCEDURE IF EXISTS `getTypeDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getTypeDetails` (IN `type_id` INT)   SELECT * FROM producttype where producttype.type_id = type_id$$

DROP PROCEDURE IF EXISTS `getUserDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserDetails` (IN `user_id` INT)   SELECT * FROM userdetails WHERE userdetails.user_id = user_id$$

DROP PROCEDURE IF EXISTS `getUserOrders`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserOrders` (IN `user_email` VARCHAR(255))   SELECT * FROM `order` WHERE order.user_Id = user_email ORDER BY order.order_Id DESC$$

DROP PROCEDURE IF EXISTS `getUserSavedAddresses`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserSavedAddresses` (IN `user_email` VARCHAR(255))   SELECT * FROM useraddress WHERE useraddress.user_email = user_email$$

DROP PROCEDURE IF EXISTS `getUserSpecificAddress`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserSpecificAddress` (IN `user_email` VARCHAR(255), IN `address_type` VARCHAR(255))   SELECT useraddress.address FROM useraddress where useraddress.user_email = user_email and useraddress.address_type = address_type$$

DROP PROCEDURE IF EXISTS `updateAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateAdmin` (IN `admin_id` INT, IN `admin_name` VARCHAR(255), IN `userId` VARCHAR(255), IN `admin_password` VARCHAR(255), IN `admin_type` VARCHAR(2))   UPDATE admin a SET a.admin_name = admin_name, a.userId = userId, a.password = admin_password, a.admintype = admin_type WHERE a.admin_id = admin_id$$

DROP PROCEDURE IF EXISTS `updateBrand`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateBrand` (IN `brand_id` INT, IN `brand_name` VARCHAR(255))   UPDATE brand SET brand.brand_name = brand_name WHERE brand.brand_id = brand_id$$

DROP PROCEDURE IF EXISTS `updateCartStatus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateCartStatus` (IN `cart_id` INT, IN `status` VARCHAR(255))   UPDATE cart SET cart.status = status WHERE cart.cart_id = cart_id$$

DROP PROCEDURE IF EXISTS `updateProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProduct` (IN `product_id` INT, IN `product_name` VARCHAR(500), IN `brand_id` INT, IN `type_id` INT, IN `image_file` VARCHAR(500), IN `price` INT, IN `creation_date` VARCHAR(255), IN `availability` VARCHAR(1), IN `addedBy` VARCHAR(255))   UPDATE product p SET p.product_name = product_name, p.brand_id = brand_id, p.producttype_id = type_id, p.product_image = image_file, p.price = price, p.addition_date = creation_date, p.availability = availability, p.addedby = addedBy$$

DROP PROCEDURE IF EXISTS `updateType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateType` (IN `type_id` INT, IN `type_name` VARCHAR(255))   UPDATE producttype SET producttype.type_name = type_name WHERE producttype.type_id = type_id$$

DROP PROCEDURE IF EXISTS `updateUserDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUserDetails` (IN `user_id` INT, IN `user_name` VARCHAR(255), IN `user_gender` VARCHAR(1), IN `user_address` VARCHAR(5000), IN `user_password` VARCHAR(255))   UPDATE userdetails SET userdetails.user_name = user_name, userdetails.gender = user_gender, userdetails.address = user_address, userdetails.user_pass = user_password WHERE userdetails.user_id = user_id$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `checkUserWithEmailExists`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `checkUserWithEmailExists` (`user_email` VARCHAR(255)) RETURNS INT(11) DETERMINISTIC READS SQL DATA BEGIN
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `userId`, `password`, `admintype`) VALUES
(1, 'Mudit', 'm', 'm', 'SA'),
(12, 'Arush', 'a', 'a', 'SA');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(500) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(12, 'Samsung'),
(13, 'Apple');

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `creation_date`, `status`) VALUES
(41, 'UT1@gmail.com', '2022/12/03', ''),
(42, 'UT1@gmail.com', '2022/12/03', ''),
(43, 'UT1@gmail.com', '2022/12/03', 'ongoing');

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
  KEY `detailCart_cart_fk` (`cart_id`),
  KEY `detailCart_product_fk` (`product_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailedcart`
--

INSERT INTO `detailedcart` (`detailCart_ID`, `cart_id`, `product_Id`, `quantity`, `price`) VALUES
(57, 41, 7, 2, 4000),
(62, 42, 7, 1, 2000);

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_Id`, `cart_Id`, `user_Id`, `creation_date`, `payment_type`, `address_type`, `total_amt`, `status`) VALUES
(22, 41, 'UT1@gmail.com', '', 'CARD', 'Home', 4000, 'Cancelled'),
(23, 42, 'UT1@gmail.com', '', 'COD', 'Home', 2000, 'Cancelled');

--
-- Triggers `order`
--
DROP TRIGGER IF EXISTS `order_after_update`;
DELIMITER $$
CREATE TRIGGER `order_after_update` AFTER UPDATE ON `order` FOR EACH ROW BEGIN

UPDATE orderdetails SET orderdetails.status = "Cancelled" WHERE orderdetails.order_id = Old.order_Id;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderDetails_id`, `order_id`, `product_id`, `quantity`, `price`, `status`) VALUES
(18, 22, 7, 2, 4000, 'Cancelled'),
(19, 23, 7, 1, 2000, 'Cancelled');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `brand_id`, `producttype_id`, `product_image`, `price`, `addition_date`, `availability`, `addedby`) VALUES
(7, 'New Product Two', 13, 9, 'wallpapersden.com_k-summer-time-night_5120x2880.jpg', 2000, '2022/12/03', 'Y', 'Mudit');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

DROP TABLE IF EXISTS `producttype`;
CREATE TABLE IF NOT EXISTS `producttype` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(500) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`type_id`, `type_name`) VALUES
(1, 'Mobile'),
(9, 'Laptop');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraddress`
--

INSERT INTO `useraddress` (`address_id`, `user_id`, `user_email`, `address_type`, `preferred_time`, `address`) VALUES
(10, 13, 'UT1@gmail.com', 'Home', '', 'Home, Avenue#4, MA 02115');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`user_id`, `user_name`, `user_email`, `user_pass`, `gender`, `address`) VALUES
(13, 'UT1', 'UT1@gmail.com', 'test', 'M', 'ut1 address'),
(15, 'UT2', 'UT2@gmail.com', 'UT2', 'M', 'UT2 Address');

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
