-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2018 at 06:32 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecommerce`
--
CREATE DATABASE `ecommerce` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ecommerce`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(500) NOT NULL,
  `uid` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `type` varchar(2) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `uid`, `password`, `type`) VALUES
(1, 'Saiyam', '111', '111', 'SA'),
(2, 'SSS', '123', 'sdasd', 'A'),
(3, 'SS1', '123', '213', 'A'),
(4, 'dasdf', 'sdsadsa', 'sadasdsad', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(500) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(1, 'Apple'),
(2, 'OnePlus'),
(4, 'Samsung'),
(5, 'HP');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(500) NOT NULL,
  `dt` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`c_id`, `user_id`, `dt`, `status`) VALUES
(3, 'xyz@gmail.com', '18/06/2018', 'complete'),
(10, 'xyz@gmail.com', '18/06/2018', 'complete'),
(11, 'abc@gmail.com', '19/06/2018', 'complete'),
(14, 'def@gmail.com', '20/06/2018', 'ongoing'),
(15, 'xyz@gmail.com', '23/06/2018', 'complete'),
(16, 'xyz@gmail.com', '25/06/2018', 'complete'),
(17, 'xyz@gmail.com', '25/06/2018', 'complete'),
(18, 'xyz@gmail.com', '25/06/2018', 'complete'),
(19, 'abc@gmail.com', '25/06/2018', 'complete'),
(20, 'abc@gmail.com', '25/06/2018', 'complete'),
(21, 'abc@gmail.com', '25/06/2018', 'ongoing'),
(22, 'xyz@gmail.com', '26/06/2018', 'complete'),
(23, 'xyz@gmail.com', '26/06/2018', 'complete'),
(24, 'xyz@gmail.com', '26/06/2018', 'complete'),
(25, 'xyz@gmail.com', '26/06/2018', 'complete'),
(26, 'xyz@gmail.com', '26/06/2018', 'complete'),
(27, 'xyz@gmail.com', '26/06/2018', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `detail_cart`
--

CREATE TABLE IF NOT EXISTS `detail_cart` (
  `dc_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`dc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `detail_cart`
--

INSERT INTO `detail_cart` (`dc_id`, `c_id`, `pid`, `qty`, `price`) VALUES
(1, 3, 3, 1, 55050),
(2, 10, 1, 1, 33000),
(3, 10, 1, 2, 66000),
(4, 10, 3, 2, 110100),
(5, 12, 1, 2, 66000),
(6, 12, 1, 2, 66000),
(7, 12, 1, 2, 66000),
(8, 12, 1, 2, 66000),
(9, 11, 3, 2, 110100),
(10, 13, 3, 1, 55050),
(11, 14, 3, 1, 55050),
(12, 15, 1, 1, 33000),
(13, 16, 3, 1, 55050),
(16, 17, 1, 1, 33000),
(17, 18, 1, 3, 99000),
(19, 19, 3, 1, 55050),
(20, 20, 3, 2, 110100),
(22, 21, 1, 1, 33000),
(23, 22, 1, 1, 33000),
(24, 22, 3, 2, 110100),
(26, 23, 1, 1, 33000),
(27, 23, 1, 1, 33000),
(28, 24, 1, 1, 33000),
(29, 25, 1, 2, 66000),
(30, 25, 3, 1, 55050),
(31, 26, 1, 3, 99000),
(32, 26, 3, 1, 55050),
(33, 27, 1, 1, 33000),
(37, 27, 3, 1, 55050);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `o_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `st` varchar(500) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`oid`, `o_id`, `pid`, `qty`, `price`, `st`) VALUES
(1, 6, 1, 1, 33000, 'pending'),
(2, 6, 1, 1, 33000, 'pending'),
(3, 8, 1, 1, 33000, 'cancelled'),
(4, 9, 1, 2, 66000, 'pending'),
(5, 9, 3, 1, 55050, 'pending'),
(6, 10, 1, 3, 99000, 'pending'),
(7, 10, 3, 1, 55050, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `ordr`
--

CREATE TABLE IF NOT EXISTS `ordr` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `user_id` varchar(500) NOT NULL,
  `dt` varchar(500) NOT NULL,
  `paytype` varchar(500) NOT NULL,
  `adrtype` varchar(500) NOT NULL,
  `totalamt` double NOT NULL,
  `st` varchar(500) NOT NULL,
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ordr`
--

INSERT INTO `ordr` (`o_id`, `c_id`, `user_id`, `dt`, `paytype`, `adrtype`, `totalamt`, `st`) VALUES
(3, 19, 'abc@gmail.com', '25/06/2018', '', '', 0, 'pending'),
(4, 20, 'abc@gmail.com', '25/06/2018', '', '', 0, 'dispatched'),
(7, 23, 'xyz@gmail.com', '26/06/2018', 'COD', '', 66000, 'pending'),
(8, 24, 'xyz@gmail.com', '26/06/2018', 'COD', 'Residence', 33000, 'pending'),
(9, 25, 'xyz@gmail.com', '26/06/2018', 'CARD', 'Home', 121050, 'pending'),
(10, 26, 'xyz@gmail.com', '26/06/2018', 'COD', 'Residence', 154050, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(500) NOT NULL,
  `bid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `img` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `dt` varchar(500) NOT NULL,
  `isAvail` varchar(1) NOT NULL,
  `addedby` varchar(500) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pname`, `bid`, `tid`, `img`, `price`, `dt`, `isAvail`, `addedby`) VALUES
(1, 'iPhone 6s', 1, 1, 'Lighthouse.jpg', 33000, '13/06/2018', 'Y', 'Saiyam'),
(2, 'Macbook Pro 2017', 1, 3, 'Desert.jpg', 100000, '13/06/2018', 'N', 'Saiyam'),
(3, 'Galaxy S9', 4, 1, 'Jellyfish.jpg', 55050, '18/06/2018', 'Y', 'Saiyam');

-- --------------------------------------------------------

--
-- Table structure for table `subimg`
--

CREATE TABLE IF NOT EXISTS `subimg` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `image_nm` varchar(500) NOT NULL,
  `image_view` varchar(500) NOT NULL,
  `addedby` varchar(500) NOT NULL,
  `dt` varchar(500) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `subimg`
--

INSERT INTO `subimg` (`sub_id`, `pid`, `image_nm`, `image_view`, `addedby`, `dt`) VALUES
(8, 1, 'Koala.jpg', 'front', 'Saiyam', '13/06/2018'),
(9, 2, 'Desert.jpg', 'side', 'Saiyam', '13/06/2018'),
(10, 1, 'Hydrangeas.jpg', 'side', 'Saiyam', '14/06/2018');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(500) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`) VALUES
(1, 'Mobiles'),
(2, 'AirPods'),
(3, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `useradr`
--

CREATE TABLE IF NOT EXISTS `useradr` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `uemail` varchar(500) NOT NULL,
  `adrtype` varchar(500) NOT NULL,
  `time` varchar(500) NOT NULL,
  `addr` varchar(5000) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `useradr`
--

INSERT INTO `useradr` (`aid`, `user_id`, `uemail`, `adrtype`, `time`, `addr`) VALUES
(1, 1, 'xyz@gmail.com', 'Home', '5:00 pm - 9:00 pm', '113 - Indraprasth Bungalows, Bhatar Road, Surat-395017.'),
(2, 1, 'xyz@gmail.com', 'Office', '9:00am - 5:00pm', 'STM Market,Ring Road, Surat.'),
(4, 1, 'xyz@gmail.com', 'Residence', '9:00am - 9:00pm', 'Samarpan soc., Adajan, Surat.'),
(5, 4, 'abc@gmail.com', 'Residence', '9:00am - 5:00pm', 'Near VR Mall, Piplod, Dumas Road, Surat, Gujarat.');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(500) NOT NULL,
  `uemail` varchar(500) NOT NULL,
  `upass` varchar(500) NOT NULL,
  `gen` varchar(1) NOT NULL,
  `addr` varchar(2000) NOT NULL,
  `image` varchar(500) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`uid`, `uname`, `uemail`, `upass`, `gen`, `addr`, `image`) VALUES
(1, 'Saiyam', 'xyz@gmail.com', 'xyz', 'M', 'Surat', ''),
(4, 'SSS', 'abc@gmail.com', 'abc', 'F', 'INDIA', ''),
(8, 'Saiyam', 'def@gmail.com', 'def', 'M', 'kkkkkkkk', ''),
(9, 'Saiyam Jain', 'sj@ymail.in', 'abcdef', 'M', 'Chennai', '');
