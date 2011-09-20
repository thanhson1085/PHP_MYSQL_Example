-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 20, 2011 at 12:54 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `btlphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `nhapkho`
--

CREATE TABLE IF NOT EXISTS `nhapkho` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `maphieunhap` varchar(255) NOT NULL,
  `masanpham` varchar(255) NOT NULL,
  `soluong` int(20) NOT NULL,
  `nhacungcap` text NOT NULL,
  `ngaynhap` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `nhapkho`
--

INSERT INTO `nhapkho` (`id`, `maphieunhap`, `masanpham`, `soluong`, `nhacungcap`, `ngaynhap`) VALUES
(4, 'mmmmm', 'ddddd', 0, 'mmmmmmm', '2011-09-08 00:00:00'),
(2, 'mmmmmmf', 'gggg', 0, 'gdfg', '2011-09-16 00:00:00'),
(3, 'hhh', 'gggg', 34123, 'hhh', '2011-09-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(20) NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(200) NOT NULL,
  `permission_desc` varchar(2000) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `permission_name`, `permission_desc`) VALUES
(1, 'admin', 'Administrator'),
(2, 'support', 'Supporter'),
(3, 'customer', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE IF NOT EXISTS `sanpham` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `masanpham` varchar(255) NOT NULL,
  `tensanpham` varchar(255) DEFAULT NULL,
  `mota` text,
  `ngaysanxuat` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `masanpham`, `tensanpham`, `mota`, `ngaysanxuat`) VALUES
(19, 'gggg', 'ggggg', 'gggg', '2011-09-10 00:00:00'),
(20, 'jjjjjj', 'jjj', 'jjjjjjjjjjj', '2011-09-16 00:00:00'),
(12, 'ddddd', 'ddddddd', 'ddddd', '2011-09-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(7) NOT NULL AUTO_INCREMENT,
  `permission_id` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `fist_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `company_name` varchar(500) DEFAULT NULL,
  `nationality` varchar(200) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `permission_id`, `username`, `password`, `fist_name`, `last_name`, `date_created`, `company_name`, `nationality`, `description`) VALUES
(9, 3, 'thanhson1085', 'buithu', 'Nguyá»…n Sá»¹', 'Thanh SÆ¡n', '2011-05-24 22:38:46', 'KVS', 'Vietnam', 'nothing'),
(8, 1, 'admin', 'admin', 'Nguyen Sy', 'Thanh Son', '2011-05-21 01:28:48', 'Esoftflow', 'Vietnam', 'nothing');

-- --------------------------------------------------------

--
-- Table structure for table `xuatkho`
--

CREATE TABLE IF NOT EXISTS `xuatkho` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `maphieuxuat` varchar(255) NOT NULL,
  `masanpham` varchar(255) NOT NULL,
  `khachhang` varchar(255) NOT NULL,
  `soluong` int(20) NOT NULL,
  `ngayxuat` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `xuatkho`
--

INSERT INTO `xuatkho` (`id`, `maphieuxuat`, `masanpham`, `khachhang`, `soluong`, `ngayxuat`) VALUES
(4, 'fsdfsdfs', 'gggg', 'sdfdf', 0, '2011-09-21 00:00:00'),
(3, 'mmmmmmm', 'mmmmmmm', 'mmmmmmm', 0, '2011-09-22 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
