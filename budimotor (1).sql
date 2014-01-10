-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2013 at 03:11 PM
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `budimotor`
--
CREATE DATABASE IF NOT EXISTS `budimotor` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `budimotor`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `idbarang` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `idjenis` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `idlokasi` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `date_insert` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`idbarang`, `kode`, `nama`, `idjenis`, `idlokasi`, `date_insert`, `date_update`) VALUES
(1, 'M1', 'MESRAN SUPER 1 LT', 1, 0, '2013-12-09 02:45:13', NULL),
(2, 'M4', 'MESRAN SUPER 4 LT', 1, 0, '2013-12-09 03:08:32', NULL),
(3, 'MD1', 'MEDITRANS S 40 1 LT', 1, 0, '2013-12-09 03:20:24', NULL),
(4, 'MD4', 'MEDITRAN S 40 4 LT', 1, 0, '2013-12-09 03:21:23', NULL),
(5, 'MD5', 'MEDITRAN S 40 5 LT', 0, 0, '2013-12-09 03:22:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_harga`
--

CREATE TABLE IF NOT EXISTS `tbl_harga` (
  `idharga` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) unsigned NOT NULL,
  `idsatuan` tinyint(4) unsigned NOT NULL,
  `harga_beli` float unsigned NOT NULL DEFAULT '0',
  `harga_jual` float unsigned NOT NULL DEFAULT '0',
  `awal_berlaku` date DEFAULT NULL,
  `akhir_berlaku` date DEFAULT NULL,
  `date_insert` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`idharga`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_harga`
--

INSERT INTO `tbl_harga` (`idharga`, `idbarang`, `idsatuan`, `harga_beli`, `harga_jual`, `awal_berlaku`, `akhir_berlaku`, `date_insert`, `date_update`) VALUES
(1, 1, 1, 25000, 35000, '2013-12-09', NULL, '2013-12-09 02:45:13', NULL),
(2, 2, 2, 80000, 100000, '2013-12-09', NULL, '2013-12-09 03:08:32', NULL),
(3, 3, 1, 20000, 25000, '2013-12-09', NULL, '2013-12-09 03:20:24', NULL),
(4, 4, 2, 90000, 100000, '2013-12-09', NULL, '2013-12-09 03:21:23', NULL),
(5, 5, 3, 120000, 130000, '2013-12-09', NULL, '2013-12-09 03:22:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_barang`
--

CREATE TABLE IF NOT EXISTS `tbl_jenis_barang` (
  `idjenis` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `jenis_barang` varchar(50) NOT NULL,
  PRIMARY KEY (`idjenis`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_jenis_barang`
--

INSERT INTO `tbl_jenis_barang` (`idjenis`, `jenis_barang`) VALUES
(1, 'Oli'),
(2, 'Spare Part');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE IF NOT EXISTS `tbl_log` (
  `idlog` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `logtime` datetime NOT NULL,
  `iduser` tinyint(4) unsigned DEFAULT NULL,
  `mode` varchar(10) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `table_id` int(11) unsigned DEFAULT NULL,
  `notes` varchar(100) NOT NULL,
  `sqlquery` text NOT NULL,
  PRIMARY KEY (`idlog`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`idlog`, `logtime`, `iduser`, `mode`, `table_name`, `table_id`, `notes`, `sqlquery`) VALUES
(1, '2013-12-04 02:11:09', 2, 'select', 'tbl_user', 2, 'Login', ''),
(2, '2013-12-04 02:14:05', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(3, '2013-12-04 02:44:37', 2, 'select', 'tbl_user', 2, 'Login', ''),
(4, '2013-12-04 03:04:42', 2, 'select', 'tbl_user', 2, 'Login', ''),
(5, '2013-12-04 03:13:55', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(6, '2013-12-04 03:14:39', 2, 'select', 'tbl_user', 2, 'Login', ''),
(7, '2013-12-04 04:18:40', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(8, '2013-12-04 04:21:17', 2, 'select', 'tbl_user', 2, 'Login', ''),
(9, '2013-12-04 04:24:55', 2, 'select', 'tbl_user', 2, 'Login', ''),
(10, '2013-12-04 04:35:32', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(11, '2013-12-04 04:35:39', 2, 'select', 'tbl_user', 2, 'Login', ''),
(12, '2013-12-04 04:39:04', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(13, '2013-12-04 04:50:15', 2, 'select', 'tbl_user', 2, 'Login', ''),
(14, '2013-12-04 04:50:33', 2, 'update', 'tbl_user', 2, 'Ubah Password', ''),
(15, '2013-12-04 04:54:22', 2, 'select', 'tbl_user', 2, 'Login', ''),
(16, '2013-12-04 04:54:38', 2, 'update', 'tbl_user', 2, 'Ubah Password', ''),
(17, '2013-12-04 04:54:46', 2, 'select', 'tbl_user', 2, 'Login', ''),
(18, '2013-12-04 04:57:13', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(19, '2013-12-04 04:57:19', 2, 'select', 'tbl_user', 2, 'Login', ''),
(20, '2013-12-04 04:57:34', 2, 'update', 'tbl_user', 2, 'Ubah Password', ''),
(21, '2013-12-04 04:57:34', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(22, '2013-12-04 04:58:05', 2, 'select', 'tbl_user', 2, 'Login', ''),
(23, '2013-12-04 04:58:32', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(24, '2013-12-04 04:58:42', 2, 'select', 'tbl_user', 2, 'Login', ''),
(25, '2013-12-04 04:58:51', 2, 'update', 'tbl_user', 2, 'Ubah Password', ''),
(26, '2013-12-04 04:58:51', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(27, '2013-12-04 22:26:47', 3, 'select', 'tbl_user', 3, 'Login', ''),
(28, '2013-12-04 23:14:23', 3, 'select', 'tbl_user', 3, 'Logout', ''),
(29, '2013-12-04 23:14:30', 2, 'select', 'tbl_user', 2, 'Login', ''),
(30, '2013-12-04 23:28:51', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(31, '2013-12-04 23:28:56', 3, 'select', 'tbl_user', 3, 'Login', ''),
(32, '2013-12-04 23:31:21', 3, 'select', 'tbl_user', 3, 'Logout', ''),
(33, '2013-12-04 23:31:30', 2, 'select', 'tbl_user', 2, 'Login', ''),
(34, '2013-12-04 23:33:28', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(35, '2013-12-04 23:33:33', 3, 'select', 'tbl_user', 3, 'Login', ''),
(36, '2013-12-04 23:33:57', 3, 'select', 'tbl_user', 3, 'Logout', ''),
(37, '2013-12-05 00:51:00', 2, 'select', 'tbl_user', 2, 'Login', ''),
(38, '2013-12-05 00:51:20', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(39, '2013-12-05 00:52:52', 2, 'select', 'tbl_user', 2, 'Login', ''),
(40, '2013-12-05 00:52:57', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(41, '2013-12-05 01:06:20', 2, 'select', 'tbl_user', 2, 'Login', ''),
(42, '2013-12-05 01:08:50', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(43, '2013-12-05 01:08:56', 2, 'select', 'tbl_user', 2, 'Login', ''),
(44, '2013-12-05 02:03:08', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(45, '2013-12-05 02:03:27', 2, 'select', 'tbl_user', 2, 'Login', ''),
(46, '2013-12-05 10:37:29', 2, 'select', 'tbl_user', 2, 'Login', ''),
(47, '2013-12-05 14:36:21', 2, 'select', 'tbl_user', 2, 'Login', ''),
(48, '2013-12-05 15:03:57', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(49, '2013-12-05 15:04:18', 2, 'select', 'tbl_user', 2, 'Login', ''),
(50, '2013-12-06 04:13:48', 2, 'select', 'tbl_user', 2, 'Login', ''),
(51, '2013-12-06 14:49:19', 2, 'select', 'tbl_user', 2, 'Login', ''),
(52, '2013-12-06 14:50:23', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(53, '2013-12-06 14:52:40', 3, 'select', 'tbl_user', 3, 'Login', ''),
(54, '2013-12-06 14:52:44', 3, 'select', 'tbl_user', 3, 'Logout', ''),
(55, '2013-12-06 14:56:28', 2, 'select', 'tbl_user', 2, 'Login', ''),
(56, '2013-12-07 03:21:44', 2, 'select', 'tbl_user', 2, 'Login', ''),
(57, '2013-12-07 20:30:05', 2, 'select', 'tbl_user', 2, 'Login', ''),
(58, '2013-12-07 23:54:01', 2, 'select', 'tbl_user', 2, 'Login', ''),
(59, '2013-12-08 02:59:32', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(60, '2013-12-08 02:59:49', 2, 'select', 'tbl_user', 2, 'Login', ''),
(61, '2013-12-08 15:15:28', 2, 'select', 'tbl_user', 2, 'Login', ''),
(62, '2013-12-09 02:38:04', 2, 'select', 'tbl_user', 2, 'Login', ''),
(63, '2013-12-09 03:08:32', 2, 'insert', 'tbl_barang', 2, 'saveBarang', 'INSERT INTO `tbl_barang` (`kode`, `nama`, `idjenis`, `idlokasi`) VALUES (''M4'', ''MESRAN SUPER 4 LT'', ''1'', ''0'')'),
(64, '2013-12-09 03:08:32', 2, 'insert', 'tbl_harga', 2, 'saveBarang', 'INSERT INTO `tbl_harga` (`idsatuan`, `harga_beli`, `harga_jual`, `awal_berlaku`, `idbarang`) VALUES (''2'', ''80000'', ''100000'', ''2013-12-09'', 63)'),
(65, '2013-12-09 03:08:32', 2, 'insert', 'tbl_stock', 2, 'saveBarang', 'INSERT INTO `tbl_stock` (`idmode_stock`, `tbl_mode`, `qty`, `sisa`, `idbarang`, `id_mode`) VALUES (''1'', ''tbl_barang'', ''5'', ''5'', 63, 63)'),
(66, '2013-12-09 03:20:24', 2, 'insert', 'tbl_barang', 2, 'saveBarang', 'INSERT INTO `tbl_barang` (`kode`, `nama`, `idjenis`, `idlokasi`) VALUES (''MD1'', ''MEDITRANS S 40 1 LT'', ''1'', ''0'')'),
(67, '2013-12-09 03:20:24', 2, 'insert', 'tbl_harga', 2, 'saveBarang', 'INSERT INTO `tbl_harga` (`idsatuan`, `harga_beli`, `harga_jual`, `awal_berlaku`, `idbarang`) VALUES (''1'', ''20000'', ''25000'', ''2013-12-09'', 3)'),
(68, '2013-12-09 03:20:24', 2, 'insert', 'tbl_stock', 2, 'saveBarang', 'INSERT INTO `tbl_stock` (`idmode_stock`, `tbl_mode`, `qty`, `sisa`, `idbarang`, `id_mode`) VALUES (''1'', ''tbl_barang'', ''8'', ''8'', 3, 3)'),
(69, '2013-12-09 03:21:23', 2, 'insert', 'tbl_barang', 2, 'saveBarang', 'INSERT INTO `tbl_barang` (`kode`, `nama`, `idjenis`, `idlokasi`) VALUES (''MD4'', ''MEDITRAN S 40 4 LT'', ''1'', ''0'')'),
(70, '2013-12-09 03:21:23', 2, 'insert', 'tbl_harga', 2, 'saveBarang', 'INSERT INTO `tbl_harga` (`idsatuan`, `harga_beli`, `harga_jual`, `awal_berlaku`, `idbarang`) VALUES (''2'', ''90000'', ''100000'', ''2013-12-09'', 4)'),
(71, '2013-12-09 03:21:23', 2, 'insert', 'tbl_stock', 2, 'saveBarang', 'INSERT INTO `tbl_stock` (`idmode_stock`, `tbl_mode`, `qty`, `sisa`, `idbarang`, `id_mode`) VALUES (''1'', ''tbl_barang'', ''4'', ''4'', 4, 4)'),
(72, '2013-12-09 03:22:16', 2, 'insert', 'tbl_barang', 2, 'saveBarang', 'INSERT INTO `tbl_barang` (`kode`, `nama`, `idjenis`, `idlokasi`) VALUES (''MD5'', ''MEDITRAN S 40 5 LT'', ''1'', ''0'')'),
(73, '2013-12-09 03:22:16', 2, 'insert', 'tbl_harga', 2, 'saveBarang', 'INSERT INTO `tbl_harga` (`idsatuan`, `harga_beli`, `harga_jual`, `awal_berlaku`, `idbarang`) VALUES (''3'', ''120000'', ''130000'', ''2013-12-09'', 5)'),
(74, '2013-12-09 03:22:16', 2, 'insert', 'tbl_stock', 2, 'saveBarang', 'INSERT INTO `tbl_stock` (`idmode_stock`, `tbl_mode`, `qty`, `sisa`, `idbarang`, `id_mode`) VALUES (''1'', ''tbl_barang'', ''5'', ''5'', 5, 5)'),
(75, '2013-12-11 00:36:41', NULL, 'select', 'tbl_user', NULL, 'Logout', ''),
(76, '2013-12-11 00:36:48', 2, 'select', 'tbl_user', 2, 'Login', ''),
(77, '2013-12-13 01:38:14', 2, 'select', 'tbl_user', 2, 'Login', ''),
(78, '2013-12-17 13:17:42', 2, 'select', 'tbl_user', 2, 'Login', ''),
(79, '2013-12-17 13:17:47', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(80, '2013-12-17 13:17:59', 2, 'select', 'tbl_user', 2, 'Login', ''),
(81, '2013-12-17 13:18:09', 2, 'select', 'tbl_user', 2, 'Logout', ''),
(82, '2013-12-17 13:18:37', 2, 'select', 'tbl_user', 2, 'Login', ''),
(83, '2013-12-19 01:25:15', 2, 'select', 'tbl_user', 2, 'Login', ''),
(84, '2013-12-19 04:10:08', 2, 'select', 'tbl_user', 2, 'Login', ''),
(85, '2013-12-19 04:10:59', 2, 'select', 'tbl_user', 2, 'Login', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lokasi_barang`
--

CREATE TABLE IF NOT EXISTS `tbl_lokasi_barang` (
  `idlokasi` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `lokasi_barang` varchar(50) NOT NULL,
  PRIMARY KEY (`idlokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mode_stock`
--

CREATE TABLE IF NOT EXISTS `tbl_mode_stock` (
  `idmode_stock` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `mode_stock` varchar(25) NOT NULL,
  `plus_min` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmode_stock`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_mode_stock`
--

INSERT INTO `tbl_mode_stock` (`idmode_stock`, `mode_stock`, `plus_min`) VALUES
(1, 'Stock Awal', 1),
(2, 'Penjualan', 0),
(3, 'Pembelian', 1),
(4, 'Retur Penjualan', 1),
(5, 'Retur Pembelian', 0),
(6, 'Penambahan Stock', 1),
(7, 'Pengurangan Stock', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE IF NOT EXISTS `tbl_sales` (
  `idsales` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_jual` datetime NOT NULL,
  `nofaktur` varchar(15) NOT NULL,
  `nama_customer` varchar(25) DEFAULT NULL,
  `nopolisi` varchar(15) DEFAULT NULL,
  `diskon` float NOT NULL DEFAULT '0',
  `ppn` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `idstatus_sales` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `iduser` tinyint(4) NOT NULL,
  `date_insert` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`idsales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salesdetail`
--

CREATE TABLE IF NOT EXISTS `tbl_salesdetail` (
  `idsalesdetail` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idsales` int(11) unsigned NOT NULL,
  `idbarang` int(11) unsigned NOT NULL,
  `qty` smallint(6) unsigned NOT NULL,
  `date_insert` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`idsalesdetail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

CREATE TABLE IF NOT EXISTS `tbl_satuan` (
  `idsatuan` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `satuan` varchar(10) NOT NULL,
  `satuan_abbr` varchar(5) NOT NULL,
  PRIMARY KEY (`idsatuan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`idsatuan`, `satuan`, `satuan_abbr`) VALUES
(1, 'Liter', 'lt'),
(2, 'Galon', 'gln'),
(3, 'Buah', 'bh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

CREATE TABLE IF NOT EXISTS `tbl_session` (
  `idsession` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `logintime` datetime DEFAULT NULL,
  `logouttime` datetime DEFAULT NULL,
  `iduser` tinyint(4) unsigned DEFAULT NULL,
  `ipaddress` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsession`),
  UNIQUE KEY `idsession_UNIQUE` (`idsession`),
  KEY `ipaddress` (`ipaddress`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `tbl_session`
--

INSERT INTO `tbl_session` (`idsession`, `logintime`, `logouttime`, `iduser`, `ipaddress`) VALUES
(6, '2013-12-02 07:41:56', NULL, 2, '127.0.0.1'),
(7, '2013-12-02 07:48:20', '2013-12-02 07:49:58', 2, '127.0.0.1'),
(8, '2013-12-02 13:58:31', '2013-12-02 14:00:04', 2, '127.0.0.1'),
(9, '2013-12-02 14:01:41', '2013-12-02 14:01:46', 2, '127.0.0.1'),
(10, '2013-12-02 15:03:51', NULL, 2, '127.0.0.1'),
(11, '2013-12-02 20:41:40', '2013-12-02 22:10:53', 2, '127.0.0.1'),
(12, '2013-12-02 22:11:00', '2013-12-02 22:44:11', 2, '127.0.0.1'),
(13, '2013-12-02 22:44:19', '2013-12-03 00:33:35', 2, '127.0.0.1'),
(14, '2013-12-03 00:41:37', '2013-12-03 00:41:54', 2, '127.0.0.1'),
(15, '2013-12-03 00:54:37', '2013-12-03 00:58:54', 2, '127.0.0.1'),
(16, '2013-12-03 00:59:25', '2013-12-03 01:02:45', 2, '127.0.0.1'),
(17, '2013-12-03 01:02:54', '2013-12-03 02:29:56', 2, '127.0.0.1'),
(18, '2013-12-03 02:30:07', '2013-12-03 02:48:31', 2, '127.0.0.1'),
(19, '2013-12-03 02:48:40', '2013-12-03 02:48:50', 2, '127.0.0.1'),
(20, '2013-12-03 02:48:59', NULL, 2, '127.0.0.1'),
(21, '2013-12-03 12:17:53', NULL, 2, '127.0.0.1'),
(22, '2013-12-03 14:52:55', '2013-12-03 14:55:52', 2, '127.0.0.1'),
(23, '2013-12-03 14:55:59', NULL, 2, '127.0.0.1'),
(24, '2013-12-03 15:32:23', '2013-12-03 15:32:36', 2, '127.0.0.1'),
(25, '2013-12-03 15:32:41', NULL, 2, '127.0.0.1'),
(26, '2013-12-03 21:51:33', '2013-12-03 21:51:41', 3, '127.0.0.1'),
(27, '2013-12-03 22:06:09', '2013-12-03 22:12:56', 2, '127.0.0.1'),
(28, '2013-12-03 22:15:32', NULL, 2, '127.0.0.1'),
(29, '2013-12-03 23:33:09', '2013-12-03 23:44:47', 2, '127.0.0.1'),
(30, '2013-12-03 23:44:53', '2013-12-04 00:31:46', 2, '127.0.0.1'),
(31, '2013-12-04 00:31:52', '2013-12-04 00:34:08', 3, '127.0.0.1'),
(32, '2013-12-04 00:34:19', '2013-12-04 01:00:43', 2, '127.0.0.1'),
(33, '2013-12-04 01:00:48', '2013-12-04 01:08:51', 3, '127.0.0.1'),
(34, '2013-12-04 01:08:58', '2013-12-04 01:15:10', 2, '127.0.0.1'),
(35, '2013-12-04 01:15:15', '2013-12-04 01:15:50', 2, '127.0.0.1'),
(36, '2013-12-04 01:15:56', '2013-12-04 01:16:02', 3, '127.0.0.1'),
(37, '2013-12-04 01:17:51', '2013-12-04 01:17:59', 3, '127.0.0.1'),
(38, '2013-12-04 01:19:41', '2013-12-04 01:29:03', 2, '127.0.0.1'),
(39, '2013-12-04 01:29:14', '2013-12-04 01:32:39', 3, '127.0.0.1'),
(40, '2013-12-04 01:32:45', '2013-12-04 01:47:20', 2, '127.0.0.1'),
(41, '2013-12-04 01:47:59', '2013-12-04 01:48:23', 2, '127.0.0.1'),
(42, '2013-12-04 02:11:09', '2013-12-04 02:14:05', 2, '127.0.0.1'),
(43, '2013-12-04 02:44:37', NULL, 2, '127.0.0.1'),
(44, '2013-12-04 03:04:42', '2013-12-04 03:13:55', 2, '127.0.0.1'),
(45, '2013-12-04 03:14:39', '2013-12-04 04:18:40', 2, '127.0.0.1'),
(46, '2013-12-04 04:21:17', NULL, 2, '127.0.0.1'),
(47, '2013-12-04 04:24:55', '2013-12-04 04:35:32', 2, '127.0.0.1'),
(48, '2013-12-04 04:35:39', '2013-12-04 04:39:04', 2, '127.0.0.1'),
(49, '2013-12-04 04:50:15', NULL, 2, '127.0.0.1'),
(50, '2013-12-04 04:54:22', NULL, 2, '127.0.0.1'),
(51, '2013-12-04 04:54:46', '2013-12-04 04:57:13', 2, '127.0.0.1'),
(52, '2013-12-04 04:57:19', '2013-12-04 04:57:34', 2, '127.0.0.1'),
(53, '2013-12-04 04:58:05', '2013-12-04 04:58:32', 2, '127.0.0.1'),
(54, '2013-12-04 04:58:42', '2013-12-04 04:58:51', 2, '127.0.0.1'),
(55, '2013-12-04 22:26:47', '2013-12-04 23:14:23', 3, '127.0.0.1'),
(56, '2013-12-04 23:14:30', '2013-12-04 23:28:50', 2, '127.0.0.1'),
(57, '2013-12-04 23:28:56', '2013-12-04 23:31:21', 3, '127.0.0.1'),
(58, '2013-12-04 23:31:30', '2013-12-04 23:33:28', 2, '127.0.0.1'),
(59, '2013-12-04 23:33:33', '2013-12-04 23:33:57', 3, '127.0.0.1'),
(60, '2013-12-05 00:51:00', '2013-12-05 00:51:20', 2, '127.0.0.1'),
(61, '2013-12-05 00:52:52', '2013-12-05 00:52:57', 2, '127.0.0.1'),
(62, '2013-12-05 01:06:20', '2013-12-05 01:08:50', 2, '127.0.0.1'),
(63, '2013-12-05 01:08:56', '2013-12-05 02:03:08', 2, '127.0.0.1'),
(64, '2013-12-05 02:03:27', NULL, 2, '127.0.0.1'),
(65, '2013-12-05 10:37:29', NULL, 2, '127.0.0.1'),
(66, '2013-12-05 14:36:21', '2013-12-05 15:03:57', 2, '127.0.0.1'),
(67, '2013-12-05 15:04:18', NULL, 2, '127.0.0.1'),
(68, '2013-12-06 04:13:48', NULL, 2, '127.0.0.1'),
(69, '2013-12-06 14:49:19', '2013-12-06 14:50:23', 2, '127.0.0.1'),
(70, '2013-12-06 14:52:40', '2013-12-06 14:52:44', 3, '127.0.0.1'),
(71, '2013-12-06 14:56:28', NULL, 2, '127.0.0.1'),
(72, '2013-12-07 03:21:44', NULL, 2, '127.0.0.1'),
(73, '2013-12-07 20:30:05', NULL, 2, '127.0.0.1'),
(74, '2013-12-07 23:54:01', '2013-12-08 02:59:32', 2, '127.0.0.1'),
(75, '2013-12-08 02:59:49', NULL, 2, '127.0.0.1'),
(76, '2013-12-08 15:15:28', NULL, 2, '127.0.0.1'),
(77, '2013-12-09 02:38:04', NULL, 2, '127.0.0.1'),
(78, '2013-12-11 00:36:48', NULL, 2, '127.0.0.1'),
(79, '2013-12-13 01:38:14', NULL, 2, '127.0.0.1'),
(80, '2013-12-17 13:17:42', '2013-12-17 13:17:47', 2, '127.0.0.1'),
(81, '2013-12-17 13:17:59', '2013-12-17 13:18:09', 2, '127.0.0.1'),
(82, '2013-12-17 13:18:37', NULL, 2, '127.0.0.1'),
(83, '2013-12-19 01:25:15', NULL, 2, '127.0.0.1'),
(84, '2013-12-19 04:10:08', NULL, 2, '127.0.0.1'),
(85, '2013-12-19 04:10:59', NULL, 2, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE IF NOT EXISTS `tbl_setting` (
  `idsetting` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iduser` tinyint(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`idsetting`),
  UNIQUE KEY `idsetting_UNIQUE` (`idsetting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_sales`
--

CREATE TABLE IF NOT EXISTS `tbl_status_sales` (
  `idstatus_sales` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `status_sales` varchar(15) NOT NULL,
  PRIMARY KEY (`idstatus_sales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE IF NOT EXISTS `tbl_stock` (
  `idstock` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) unsigned NOT NULL,
  `idmode_stock` tinyint(4) NOT NULL DEFAULT '0',
  `tbl_mode` varchar(25) NOT NULL,
  `id_mode` int(11) unsigned NOT NULL DEFAULT '0',
  `qty` smallint(6) NOT NULL,
  `sisa` smallint(6) NOT NULL,
  `date_insert` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`idstock`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`idstock`, `idbarang`, `idmode_stock`, `tbl_mode`, `id_mode`, `qty`, `sisa`, `date_insert`, `date_update`) VALUES
(1, 1, 1, 'tbl_barang', 1, 10, 10, '2013-12-09 02:45:13', NULL),
(2, 2, 1, 'tbl_barang', 2, 5, 5, '2013-12-09 03:08:32', NULL),
(3, 3, 1, 'tbl_barang', 3, 8, 8, '2013-12-09 03:20:24', NULL),
(4, 4, 1, 'tbl_barang', 4, 4, 4, '2013-12-09 03:21:23', NULL),
(5, 5, 1, 'tbl_barang', 5, 5, 5, '2013-12-09 03:22:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_theme`
--

CREATE TABLE IF NOT EXISTS `tbl_theme` (
  `idtheme` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `themename` varchar(50) DEFAULT NULL,
  `themeurl` varchar(250) DEFAULT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtheme`),
  UNIQUE KEY `idtheme_UNIQUE` (`idtheme`),
  KEY `themename` (`themename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tbl_theme`
--

INSERT INTO `tbl_theme` (`idtheme`, `themename`, `themeurl`, `enable`) VALUES
(1, 'base', 'bootstrap/themes/base/jquery-ui.css', 1),
(2, 'black-tie', 'bootstrap/themes/black-tie/jquery-ui.css', 1),
(3, 'blitzer', 'bootstrap/themes/blitzer/jquery-ui.css', 1),
(4, 'cupertino', 'bootstrap/themes/cupertino/jquery-ui.css', 1),
(5, 'dark-hive', 'bootstrap/themes/dark-hive/jquery-ui.css', 1),
(6, 'dot-luv', 'bootstrap/themes/dot-luv/jquery-ui.css', 1),
(7, 'eggplant', 'bootstrap/themes/eggplant/jquery-ui.css', 1),
(8, 'excite-bike', 'bootstrap/themes/excite-bike/jquery-ui.css', 1),
(9, 'flick', 'bootstrap/themes/flick/jquery-ui.css', 1),
(10, 'hot-sneaks', 'bootstrap/themes/hot-sneaks/jquery-ui.css', 1),
(11, 'humanity', 'bootstrap/themes/humanity/jquery-ui.css', 1),
(12, 'le-frog', 'bootstrap/themes/le-frog/jquery-ui.css', 1),
(13, 'mint-choc', 'bootstrap/themes/mint-choc/jquery-ui.css', 1),
(14, 'overcast', 'bootstrap/themes/overcast/jquery-ui.css', 1),
(15, 'pepper-grinder', 'bootstrap/themes/pepper-grinder/jquery-ui.css', 1),
(16, 'redmond', 'bootstrap/themes/redmond/jquery-ui.css', 1),
(17, 'smoothness', 'bootstrap/themes/smoothness/jquery-ui.css', 1),
(18, 'south-street', 'bootstrap/themes/south-street/jquery-ui.css', 1),
(19, 'start', 'bootstrap/themes/start/jquery-ui.css', 1),
(20, 'sunny', 'bootstrap/themes/sunny/jquery-ui.css', 1),
(21, 'swanky-purse', 'bootstrap/themes/swanky-purse/jquery-ui.css', 1),
(22, 'trontastic', 'bootstrap/themes/trontastic/jquery-ui.css', 1),
(23, 'ui-darkness', 'bootstrap/themes/ui-darkness/jquery-ui.css', 1),
(24, 'ui-lightness', 'bootstrap/themes/ui-lightness/jquery-ui.css', 1),
(25, 'vader', 'bootstrap/themes/vader/jquery-ui.css', 1),
(26, 'aristo', 'bootstrap/themes/Aristo/Aristo.css', 1),
(27, 'jquery-ui-bootstrap', 'bootstrap/themes/jquery-ui-bootstrap/custom-theme/jquery-ui-1.10.3.custom.css', 1),
(28, 'selene', 'bootstrap/themes/selene/jquery-ui-1.8.17.custom.css', 0),
(29, 'kiandra-delta', 'bootstrap/themes/kiandra-delta/jquery-ui.css', 0),
(30, 'green-eglapper', 'bootstrap/themes/green-eglapper/css/style.css', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `iduser` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `idtheme` tinyint(4) unsigned DEFAULT NULL,
  `iduserlevel` tinyint(4) unsigned DEFAULT NULL,
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `date_insert` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `iduser_UNIQUE` (`iduser`),
  KEY `idtheme` (`idtheme`),
  KEY `username` (`username`),
  KEY `password` (`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`iduser`, `username`, `password`, `name`, `idtheme`, `iduserlevel`, `enable`, `date_insert`, `date_update`) VALUES
(2, 'teddy', '962b2d2b8e72dc6771bca613d49b46fb', 'Satria Faestha', 11, 1, 1, '2013-12-09 02:21:30', '2013-12-09 02:21:30'),
(3, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'Kasir', 24, 3, 0, '2013-12-09 02:21:30', '2013-12-09 02:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlevel`
--

CREATE TABLE IF NOT EXISTS `tbl_userlevel` (
  `iduserlevel` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `userlevel` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`iduserlevel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_userlevel`
--

INSERT INTO `tbl_userlevel` (`iduserlevel`, `userlevel`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'Kasir');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
