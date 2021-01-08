-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 10:31 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbagent`
--
CREATE DATABASE IF NOT EXISTS `dbagent` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbagent`;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingid` varchar(45) NOT NULL,
  `customerid` varchar(45) NOT NULL,
  `bookingdate` date NOT NULL,
  `paymentid` varchar(45) NOT NULL,
  `totalamount` int(11) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingid`, `customerid`, `bookingdate`, `paymentid`, `totalamount`, `status`) VALUES
('bk_0000001', 'C_00001', '2020-11-25', 'Pay_0000001', 100000, 'receive'),
('bk_0000002', 'C_00001', '2020-11-25', 'Pay_0000002', 20000, 'receive'),
('bk_0000003', 'C_00001', '2020-11-25', 'Pay_0000003', 1890000, 'receive'),
('bk_0000004', 'C_00001', '2020-11-25', 'Pay_0000004', 200000, 'receive'),
('bk_0000005', 'C_00001', '2020-11-26', 'Pay_0000005', 450000, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `bookingdetail`
--

CREATE TABLE `bookingdetail` (
  `bookingid` varchar(45) NOT NULL,
  `roomid` varchar(45) NOT NULL,
  `price` int(11) NOT NULL,
  `checkindate` date NOT NULL,
  `checkoutdate` date NOT NULL,
  `totaldays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookingdetail`
--

INSERT INTO `bookingdetail` (`bookingid`, `roomid`, `price`, `checkindate`, `checkoutdate`, `totaldays`) VALUES
('bk_0000001', 'R_00003', 10000, '2020-11-25', '2020-11-27', 2),
('bk_0000001', 'R_00006', 10000, '2020-11-25', '2020-11-27', 2),
('bk_0000002', 'R_00003', 10000, '2020-11-29', '2020-11-30', 2),
('bk_0000002', 'R_00004', 10000, '2020-11-29', '2020-11-30', 2),
('bk_0000003', 'R_00004', 90000, '2020-11-26', '2020-11-26', 1),
('bk_0000003', 'R_00009', 300000, '2020-11-26', '2020-11-28', 2),
('bk_0000003', 'R_00010', 300000, '2020-11-26', '2020-11-28', 2),
('bk_0000003', 'R_00011', 300000, '2020-11-26', '2020-11-28', 2),
('bk_0000004', 'R_00008', 100000, '2020-11-26', '2020-11-28', 2),
('bk_0000005', 'R_00012', 100000, '2020-11-27', '2020-11-30', 3),
('bk_0000005', 'R_00007', 50000, '2020-11-27', '2020-11-30', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `bookingdetail_view`
-- (See below for the actual view)
--
CREATE TABLE `bookingdetail_view` (
`bookingid` varchar(45)
,`customerid` varchar(45)
,`bookingdate` date
,`paymentid` varchar(45)
,`totalamount` int(11)
,`bookingstatus` varchar(45)
,`roomid` varchar(45)
,`price` int(11)
,`checkindate` date
,`checkoutdate` date
,`totaldays` int(11)
,`roomno` varchar(45)
,`roomtypeid` varchar(45)
,`hotelid` varchar(45)
,`facilities` varchar(200)
,`roomtypename` varchar(45)
,`hotelname` varchar(45)
,`customername` varchar(45)
,`nrcno` varchar(45)
,`address` varchar(200)
,`phoneno` varchar(45)
,`dateofbirth` varchar(45)
,`email` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `booking_payment_view`
-- (See below for the actual view)
--
CREATE TABLE `booking_payment_view` (
`bookingid` varchar(45)
,`customerid` varchar(45)
,`bookingdate` date
,`paymentid` varchar(45)
,`totalamount` int(11)
,`bookingstatus` varchar(45)
,`paymentamount` int(11)
,`cardno` varchar(45)
,`expiredate` varchar(45)
,`paymentdate` date
,`commisionid` varchar(45)
,`staffid` varchar(45)
,`paymentstatus` varchar(45)
,`commisionpercent` varchar(45)
,`commisionamount` int(11)
,`commisiondate` date
,`customername` varchar(45)
,`nrcno` varchar(45)
,`address` varchar(200)
,`phoneno` varchar(45)
,`dateofbirth` varchar(45)
,`email` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cityid` varchar(45) NOT NULL,
  `cityname` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityid`, `cityname`, `status`) VALUES
('CT_00001', 'Mudon', 'true'),
('CT_00002', 'Mawlamying', 'false'),
('CT_00003', 'Kyite Hto', 'true'),
('CT_00004', 'yangon', 'true'),
('CT_00005', 'nat mauk', 'true'),
('CT_00006', 'Myeik', 'true'),
('CT_00007', 'Myint Kyi Nar', 'true'),
('CT_00008', 'Phar Kant', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `commision`
--

CREATE TABLE `commision` (
  `commisionid` varchar(45) NOT NULL,
  `commisionpercent` varchar(45) NOT NULL,
  `commisionamount` int(11) NOT NULL,
  `commisiondate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commision`
--

INSERT INTO `commision` (`commisionid`, `commisionpercent`, `commisionamount`, `commisiondate`) VALUES
('Com_0000001', '5', 5000, '2020-11-25'),
('Com_0000002', '5', 1000, '2020-11-25'),
('Com_0000003', '5', 94500, '2020-11-25'),
('Com_0000004', '5', 10000, '2020-11-26'),
('Com_0000005', '5', 22500, '2020-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` varchar(45) NOT NULL,
  `customername` varchar(45) NOT NULL,
  `nrcno` varchar(45) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phoneno` varchar(45) NOT NULL,
  `dateofbirth` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `customername`, `nrcno`, `address`, `phoneno`, `dateofbirth`, `email`, `password`) VALUES
('C_00001', 'Mg Mg', '12/yaya(N)258148', 'ygn', '09458741254', '2020-11-02', 'mgmg@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotelid` varchar(45) NOT NULL,
  `hotelname` varchar(45) NOT NULL,
  `hoteladdress` varchar(200) NOT NULL,
  `cityid` varchar(45) NOT NULL,
  `fontimage` varchar(100) NOT NULL,
  `backimage` varchar(100) NOT NULL,
  `fullimage` varchar(100) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotelid`, `hotelname`, `hoteladdress`, `cityid`, `fontimage`, `backimage`, `fullimage`, `status`) VALUES
('H_00001', 'strand', 'mon', 'CT_00003', 'image/upload/hotelfont01.jpg', 'image/upload/hotelback01.jpg', 'image/upload/hotelfull01.jpg', 'available'),
('H_00002', 'Vista', 'yankin', 'CT_00004', 'image/upload/hotelfont01.jpg', 'image/upload/hotelback01.jpg', 'image/upload/hotelfull01.jpg', 'available'),
('H_00003', 'Sedona ', 'yankin', 'CT_00004', 'image/upload/hotelfont01.jpg', 'image/upload/hotelback01.jpg', 'image/upload/hotelfull03.jpg', 'available'),
('H_00004', 'Strand Yangon', 'yangon', 'CT_00004', 'image/upload/hotelfont01.jpg', 'image/upload/hotelback01.jpg', 'image/upload/hotelfull04.jpg', 'available');

-- --------------------------------------------------------

--
-- Stand-in structure for view `hotel_view`
-- (See below for the actual view)
--
CREATE TABLE `hotel_view` (
`hotelid` varchar(45)
,`hotelname` varchar(45)
,`hoteladdress` varchar(200)
,`fontimage` varchar(100)
,`backimage` varchar(100)
,`fullimage` varchar(100)
,`status` varchar(45)
,`cityid` varchar(45)
,`cityname` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentid` varchar(45) NOT NULL,
  `paymentamount` int(11) NOT NULL,
  `cardno` varchar(45) NOT NULL,
  `expiredate` varchar(45) NOT NULL,
  `paymentdate` date NOT NULL,
  `commisionid` varchar(45) NOT NULL,
  `staffid` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentid`, `paymentamount`, `cardno`, `expiredate`, `paymentdate`, `commisionid`, `staffid`, `status`) VALUES
('Pay_0000001', 100000, '-', '-', '2020-11-25', 'Com_0000001', 'S_00001', 'receive'),
('Pay_0000002', 20000, '-', '-', '2020-11-25', 'Com_0000002', 'S_00001', 'receive'),
('Pay_0000003', 1890000, '54645646', '3/2022', '2020-11-25', 'Com_0000003', 'S_00001', 'receive'),
('Pay_0000004', 200000, '2', '1/2020', '2020-11-26', 'Com_0000004', 'S_00001', 'receive'),
('Pay_0000005', 450000, '3232', '5/2021', '2020-11-26', 'Com_0000005', '-', 'pending');

-- --------------------------------------------------------

--
-- Stand-in structure for view `payment_view`
-- (See below for the actual view)
--
CREATE TABLE `payment_view` (
`paymentid` varchar(45)
,`paymentamount` int(11)
,`cardno` varchar(45)
,`expiredate` varchar(45)
,`paymentdate` date
,`commisionid` varchar(45)
,`staffid` varchar(45)
,`status` varchar(45)
,`commisionpercent` varchar(45)
,`commisionamount` int(11)
,`commisiondate` date
);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `promotionid` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `staffid` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`promotionid`, `name`, `startdate`, `enddate`, `staffid`, `status`) VALUES
('P_00001', 'Promotion01', '2020-11-25', '2020-12-03', 'S_00001', 'available'),
('P_00001', 'Promotion01', '2020-11-25', '2020-12-03', 'S_00001', 'available'),
('P_00002', 'Promotion02', '2020-11-18', '2020-12-03', 'S_00001', 'available'),
('P_00003', 'Feb 14', '2021-02-26', '2021-02-28', 'S_00001', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `promotiondetail`
--

CREATE TABLE `promotiondetail` (
  `promotionid` varchar(45) NOT NULL,
  `roomtypeid` varchar(45) NOT NULL,
  `percent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotiondetail`
--

INSERT INTO `promotiondetail` (`promotionid`, `roomtypeid`, `percent`) VALUES
('P_00001', 'RT_00004', 10),
('P_00001', 'RT_00006', 10),
('P_00001', 'RT_00001', 10),
('P_00001', 'RT_00004', 10),
('P_00001', 'RT_00006', 10),
('P_00001', 'RT_00001', 10),
('P_00002', 'RT_00001', 10),
('P_00002', 'RT_00002', 10),
('P_00003', 'RT_00001', 10);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomid` varchar(45) NOT NULL,
  `roomno` varchar(45) NOT NULL,
  `roomtypeid` varchar(45) NOT NULL,
  `hotelid` varchar(45) NOT NULL,
  `facilities` varchar(200) NOT NULL,
  `fontimage` varchar(100) NOT NULL,
  `backimage` varchar(100) NOT NULL,
  `fullimage` varchar(100) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomid`, `roomno`, `roomtypeid`, `hotelid`, `facilities`, `fontimage`, `backimage`, `fullimage`, `status`) VALUES
('R_00003', '1', 'RT_00001', 'H_00002', 'wifi, coffee, heater, aircon, TV', 'image/upload/back01.jpg', 'image/upload/font01.jpg', 'image/upload/full01.jpg', 'available'),
('R_00004', '2', 'RT_00002', 'H_00002', 'wifi, coffee, heater, aircon, TV, cool drink', 'image/upload/back01.jpg', 'image/upload/font01.jpg', 'image/upload/full01.jpg', 'available'),
('R_00005', '3', 'RT_00010', 'H_00003', 'wifi, coffee, heater, aircon, TV, cool drink', 'image/upload/back01.jpg', 'image/upload/font01.jpg', 'image/upload/full01.jpg', 'available'),
('R_00006', '4', 'RT_00009', 'H_00003', 'wifi, coffee, heater, aircon, TV, cool drink', 'image/upload/back01.jpg', 'image/upload/font01.jpg', 'image/upload/full01.jpg', 'available'),
('R_00007', 'S001', 'RT_00007', 'H_00004', 'wifi, coffee, heater, aircon, TV, cool drink', 'image/upload/back01.jpg', 'image/upload/font01.jpg', 'image/upload/full01.jpg', 'available'),
('R_00008', 'S002', 'RT_00008', 'H_00004', 'wifi, coffee, heater, aircon, TV, cool drink', 'image/upload/font01.jpg', 'image/upload/back01.jpg', 'image/upload/full01.jpg', 'available'),
('R_00009', '3', 'RT_00012', 'H_00004', 'wifi, coffee, heater, aircon, TV, cool drink', 'image/upload/back01.jpg', 'image/upload/font01.jpg', 'image/upload/full01.jpg', 'available'),
('R_00010', '3', 'RT_00012', 'H_00004', 'wifi, coffee, heater, aircon, TV, cool drink', 'image/upload/back01.jpg', 'image/upload/font01.jpg', 'image/upload/full01.jpg', 'available'),
('R_00011', '3', 'RT_00012', 'H_00004', 'wifi, coffee, heater, aircon, TV, cool drink', 'image/upload/back01.jpg', 'image/upload/font01.jpg', 'image/upload/full01.jpg', 'available'),
('R_00012', '4', 'RT_00011', 'H_00003', 'wifi, coffee, heater, aircon, TV, cool drink', 'image/upload/back01.jpg', 'image/upload/font01.jpg', 'image/upload/full01.jpg', 'available'),
('R_00013', '4', 'RT_00011', 'H_00003', 'wifi, coffee, heater, aircon, TV, cool drink', 'image/upload/back01.jpg', 'image/upload/font01.jpg', 'image/upload/full01.jpg', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `roomtypeid` varchar(45) NOT NULL,
  `roomtypename` varchar(45) NOT NULL,
  `price` int(11) NOT NULL,
  `noofperson` int(11) NOT NULL,
  `hotelid` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`roomtypeid`, `roomtypename`, `price`, `noofperson`, `hotelid`, `status`) VALUES
('RT_00001', 'single', 50000, 1, 'H_00002', 'true'),
('RT_00002', 'double', 100000, 2, 'H_00002', 'true'),
('RT_00003', 'family', 200000, 5, 'H_00002', 'true'),
('RT_00004', 'single', 30000, 1, 'H_00001', 'true'),
('RT_00005', 'double', 50000, 2, 'H_00001', 'true'),
('RT_00006', 'family', 100000, 5, 'H_00001', 'true'),
('RT_00007', 'Gold', 50000, 2, 'H_00004', 'true'),
('RT_00008', 'Silver', 100000, 5, 'H_00004', 'true'),
('RT_00009', 'Standard', 100000, 5, 'H_00003', 'true'),
('RT_00010', 'Delux', 100000, 5, 'H_00003', 'true'),
('RT_00011', 'VIP', 100000, 5, 'H_00003', 'true'),
('RT_00012', 'Platinum', 300000, 2, 'H_00004', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `roomtypedetail`
--

CREATE TABLE `roomtypedetail` (
  `roomtypeid` varchar(45) NOT NULL,
  `serviceid` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roomtypedetail`
--

INSERT INTO `roomtypedetail` (`roomtypeid`, `serviceid`) VALUES
('RT_00001', 'Ser_00001'),
('RT_00001', 'Ser_00002'),
('RT_00002', 'Ser_00001'),
('RT_00002', 'Ser_00002'),
('RT_00002', 'Ser_00003'),
('RT_00003', 'Ser_00001'),
('RT_00003', 'Ser_00002'),
('RT_00003', 'Ser_00003'),
('RT_00004', 'Ser_00001'),
('RT_00004', 'Ser_00003'),
('RT_00004', 'Ser_00001'),
('RT_00004', 'Ser_00003'),
('RT_00005', 'Ser_00001'),
('RT_00005', 'Ser_00002'),
('RT_00006', 'Ser_00001'),
('RT_00006', 'Ser_00002'),
('RT_00006', 'Ser_00003'),
('RT_00007', 'Ser_00001'),
('RT_00007', 'Ser_00002'),
('RT_00008', 'Ser_00001'),
('RT_00008', 'Ser_00002'),
('RT_00008', 'Ser_00003'),
('RT_00012', 'Ser_00001'),
('RT_00012', 'Ser_00002'),
('RT_00012', 'Ser_00003'),
('RT_00012', 'Ser_00004'),
('RT_00009', 'Ser_00001'),
('RT_00009', 'Ser_00002'),
('RT_00010', 'Ser_00001'),
('RT_00010', 'Ser_00003'),
('RT_00010', 'Ser_00002'),
('RT_00011', 'Ser_00002'),
('RT_00011', 'Ser_00001'),
('RT_00011', 'Ser_00003'),
('RT_00011', 'Ser_00004');

-- --------------------------------------------------------

--
-- Stand-in structure for view `roomtype_view`
-- (See below for the actual view)
--
CREATE TABLE `roomtype_view` (
`roomtypeid` varchar(45)
,`roomtypename` varchar(45)
,`price` int(11)
,`noofperson` int(11)
,`serviceid` varchar(45)
,`servicename` varchar(45)
,`hotelid` varchar(45)
,`hotelname` varchar(45)
,`status` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `room_hotel_view`
-- (See below for the actual view)
--
CREATE TABLE `room_hotel_view` (
`roomid` varchar(45)
,`roomno` varchar(45)
,`facilities` varchar(200)
,`fontimage` varchar(100)
,`backimage` varchar(100)
,`fullimage` varchar(100)
,`status` varchar(45)
,`roomtypeid` varchar(45)
,`roomtypename` varchar(45)
,`price` int(11)
,`noofperson` int(11)
,`hotelid` varchar(45)
,`hotelname` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `room_view`
-- (See below for the actual view)
--
CREATE TABLE `room_view` (
`roomid` varchar(45)
,`roomno` varchar(45)
,`facilities` varchar(200)
,`fontimage` varchar(100)
,`backimage` varchar(100)
,`fullimage` varchar(100)
,`status` varchar(45)
,`roomtypeid` varchar(45)
,`roomtypename` varchar(45)
,`price` int(11)
,`noofperson` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `serviceid` varchar(45) NOT NULL,
  `servicename` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`serviceid`, `servicename`, `status`) VALUES
('Ser_00001', 'Gym', 'true'),
('Ser_00002', 'breakfast', 'true'),
('Ser_00003', 'dinner', 'true'),
('Ser_00004', 'club access', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` varchar(45) NOT NULL,
  `staffname` varchar(45) NOT NULL,
  `nrcno` varchar(45) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `position` varchar(45) NOT NULL,
  `salary` varchar(45) NOT NULL,
  `dateofbirth` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `staffname`, `nrcno`, `gender`, `position`, `salary`, `dateofbirth`, `phone`, `address`, `email`, `password`) VALUES
('S_00001', 'admin', '12/sss(N)024558', 'male', 'manager', '500000', '1993-11-10', '0985714581', 'ygn', 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Structure for view `bookingdetail_view`
--
DROP TABLE IF EXISTS `bookingdetail_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bookingdetail_view`  AS  (select `b`.`bookingid` AS `bookingid`,`b`.`customerid` AS `customerid`,`b`.`bookingdate` AS `bookingdate`,`b`.`paymentid` AS `paymentid`,`b`.`totalamount` AS `totalamount`,`b`.`status` AS `bookingstatus`,`bd`.`roomid` AS `roomid`,`bd`.`price` AS `price`,`bd`.`checkindate` AS `checkindate`,`bd`.`checkoutdate` AS `checkoutdate`,`bd`.`totaldays` AS `totaldays`,`r`.`roomno` AS `roomno`,`r`.`roomtypeid` AS `roomtypeid`,`r`.`hotelid` AS `hotelid`,`r`.`facilities` AS `facilities`,`rt`.`roomtypename` AS `roomtypename`,`h`.`hotelname` AS `hotelname`,`cu`.`customername` AS `customername`,`cu`.`nrcno` AS `nrcno`,`cu`.`address` AS `address`,`cu`.`phoneno` AS `phoneno`,`cu`.`dateofbirth` AS `dateofbirth`,`cu`.`email` AS `email` from (((((`booking` `b` join `bookingdetail` `bd`) join `room` `r`) join `roomtype` `rt`) join `hotel` `h`) join `customer` `cu`) where `b`.`bookingid` = `bd`.`bookingid` and `r`.`roomid` = `bd`.`roomid` and `rt`.`roomtypeid` = `r`.`roomtypeid` and `h`.`hotelid` = `r`.`hotelid` and `cu`.`customerid` = `b`.`customerid`) ;

-- --------------------------------------------------------

--
-- Structure for view `booking_payment_view`
--
DROP TABLE IF EXISTS `booking_payment_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `booking_payment_view`  AS  (select `b`.`bookingid` AS `bookingid`,`b`.`customerid` AS `customerid`,`b`.`bookingdate` AS `bookingdate`,`b`.`paymentid` AS `paymentid`,`b`.`totalamount` AS `totalamount`,`b`.`status` AS `bookingstatus`,`p`.`paymentamount` AS `paymentamount`,`p`.`cardno` AS `cardno`,`p`.`expiredate` AS `expiredate`,`p`.`paymentdate` AS `paymentdate`,`p`.`commisionid` AS `commisionid`,`p`.`staffid` AS `staffid`,`p`.`status` AS `paymentstatus`,`c`.`commisionpercent` AS `commisionpercent`,`c`.`commisionamount` AS `commisionamount`,`c`.`commisiondate` AS `commisiondate`,`cu`.`customername` AS `customername`,`cu`.`nrcno` AS `nrcno`,`cu`.`address` AS `address`,`cu`.`phoneno` AS `phoneno`,`cu`.`dateofbirth` AS `dateofbirth`,`cu`.`email` AS `email` from (((`booking` `b` join `payment` `p`) join `commision` `c`) join `customer` `cu`) where `cu`.`customerid` = `b`.`customerid` and `b`.`paymentid` = `p`.`paymentid` and `p`.`commisionid` = `c`.`commisionid`) ;

-- --------------------------------------------------------

--
-- Structure for view `hotel_view`
--
DROP TABLE IF EXISTS `hotel_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hotel_view`  AS  (select `h`.`hotelid` AS `hotelid`,`h`.`hotelname` AS `hotelname`,`h`.`hoteladdress` AS `hoteladdress`,`h`.`fontimage` AS `fontimage`,`h`.`backimage` AS `backimage`,`h`.`fullimage` AS `fullimage`,`h`.`status` AS `status`,`c`.`cityid` AS `cityid`,`c`.`cityname` AS `cityname` from (`hotel` `h` join `city` `c`) where `c`.`cityid` = `h`.`cityid`) ;

-- --------------------------------------------------------

--
-- Structure for view `payment_view`
--
DROP TABLE IF EXISTS `payment_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payment_view`  AS  (select `p`.`paymentid` AS `paymentid`,`p`.`paymentamount` AS `paymentamount`,`p`.`cardno` AS `cardno`,`p`.`expiredate` AS `expiredate`,`p`.`paymentdate` AS `paymentdate`,`p`.`commisionid` AS `commisionid`,`p`.`staffid` AS `staffid`,`p`.`status` AS `status`,`c`.`commisionpercent` AS `commisionpercent`,`c`.`commisionamount` AS `commisionamount`,`c`.`commisiondate` AS `commisiondate` from (`payment` `p` join `commision` `c`) where `p`.`commisionid` = `c`.`commisionid`) ;

-- --------------------------------------------------------

--
-- Structure for view `roomtype_view`
--
DROP TABLE IF EXISTS `roomtype_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `roomtype_view`  AS  (select `r`.`roomtypeid` AS `roomtypeid`,`r`.`roomtypename` AS `roomtypename`,`r`.`price` AS `price`,`r`.`noofperson` AS `noofperson`,`s`.`serviceid` AS `serviceid`,`s`.`servicename` AS `servicename`,`h`.`hotelid` AS `hotelid`,`h`.`hotelname` AS `hotelname`,`r`.`status` AS `status` from (((`roomtype` `r` join `service` `s`) join `roomtypedetail` `rd`) join `hotel` `h`) where `r`.`roomtypeid` = `rd`.`roomtypeid` and `rd`.`serviceid` = `s`.`serviceid` and `h`.`hotelid` = `r`.`hotelid`) ;

-- --------------------------------------------------------

--
-- Structure for view `room_hotel_view`
--
DROP TABLE IF EXISTS `room_hotel_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `room_hotel_view`  AS  (select `r`.`roomid` AS `roomid`,`r`.`roomno` AS `roomno`,`r`.`facilities` AS `facilities`,`r`.`fontimage` AS `fontimage`,`r`.`backimage` AS `backimage`,`r`.`fullimage` AS `fullimage`,`r`.`status` AS `status`,`rt`.`roomtypeid` AS `roomtypeid`,`rt`.`roomtypename` AS `roomtypename`,`rt`.`price` AS `price`,`rt`.`noofperson` AS `noofperson`,`h`.`hotelid` AS `hotelid`,`h`.`hotelname` AS `hotelname` from ((`room` `r` join `roomtype` `rt`) join `hotel` `h`) where `r`.`roomtypeid` = `rt`.`roomtypeid` and `h`.`hotelid` = `r`.`hotelid`) ;

-- --------------------------------------------------------

--
-- Structure for view `room_view`
--
DROP TABLE IF EXISTS `room_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `room_view`  AS  (select `r`.`roomid` AS `roomid`,`r`.`roomno` AS `roomno`,`r`.`facilities` AS `facilities`,`r`.`fontimage` AS `fontimage`,`r`.`backimage` AS `backimage`,`r`.`fullimage` AS `fullimage`,`r`.`status` AS `status`,`rt`.`roomtypeid` AS `roomtypeid`,`rt`.`roomtypename` AS `roomtypename`,`rt`.`price` AS `price`,`rt`.`noofperson` AS `noofperson` from (`room` `r` join `roomtype` `rt`) where `r`.`roomtypeid` = `rt`.`roomtypeid`) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
