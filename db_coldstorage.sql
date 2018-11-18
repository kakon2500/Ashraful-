-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2018 at 05:19 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_coldstorage`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `storage_id` int(11) NOT NULL,
  `storage_location` varchar(50) NOT NULL,
  `booking_space` varchar(30) NOT NULL,
  `total_bill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `client_id`, `owner_id`, `storage_id`, `storage_location`, `booking_space`, `total_bill`) VALUES
(1, 1, 1, 1, 'mymensingh', '100', 1000),
(2, 1, 1, 1, 'mymensingh', '50', 500),
(3, 3, 3, 3, 'Rangamati', '111', 3330);

-- --------------------------------------------------------

--
-- Table structure for table `storage_info`
--

CREATE TABLE `storage_info` (
  `storage_id` int(11) NOT NULL,
  `storage_name` varchar(50) NOT NULL,
  `product_type` varchar(100) DEFAULT NULL,
  `storage_location` varchar(50) NOT NULL,
  `payment` int(10) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `storage_capacity` varchar(50) DEFAULT NULL,
  `storage_temperature` varchar(50) DEFAULT NULL,
  `space_booked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage_info`
--

INSERT INTO `storage_info` (`storage_id`, `storage_name`, `product_type`, `storage_location`, `payment`, `contact`, `storage_capacity`, `storage_temperature`, `space_booked`) VALUES
(1, 'imran Ltd.', 'Egg', 'mymensingh', 10, '123456789', '200', '2', 150),
(2, 'hadid Ltd.', 'Egg', 'Comilla', 30, 'dadasd', '200', '2', 200),
(3, 'rifat Ltd.', 'Chicken', 'Rangamati', 30, '2345678', '150', '2', 39),
(4, 'ina co Ltd.', 'Fish', 'Narayanganj', 20, '12345678', '200', '2', 200),
(5, 'kakon Ltd.', 'Fruit', 'Khulna', 40, '23456789', '250', '8', 250),
(6, 'utpal Ltd.', 'Meat', 'Bogra', 80, '2345678', '500', '1', 500),
(7, 'hero alam Ltd.', 'Chicken', 'Pabna', 30, '2345678', '200', '2', 200);

-- --------------------------------------------------------

--
-- Table structure for table `storage_reg_client`
--

CREATE TABLE `storage_reg_client` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_contact` varchar(50) NOT NULL,
  `client_email` varchar(30) NOT NULL,
  `client_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage_reg_client`
--

INSERT INTO `storage_reg_client` (`client_id`, `client_name`, `client_contact`, `client_email`, `client_password`) VALUES
(1, 'imran', '234567890', 'imran@hadid.com', '$2y$10$OdRdVSoK3yeRzwBqwkMoZOZlIo2t4fUVnUllt9uJtfQiIB4sS4c6e'),
(2, 'hadid', '987643456789', 'hadid@imran.com', '$2y$10$BoqgluRtTOojl267I4CUUO2eiQBP2/ifzP864RTPHb4udeMPXZqVm'),
(3, 'angkon', '01521495757', 'kakon25000@gmail.com', '$2y$10$ZYMPYan1mnoX4.992Z2qYO6eqnM3DGMpJJ3Wml0LmAOPLbF14M3Kq');

-- --------------------------------------------------------

--
-- Table structure for table `storage_reg_owner`
--

CREATE TABLE `storage_reg_owner` (
  `storage_id` int(11) NOT NULL,
  `storage_name` varchar(50) NOT NULL,
  `storage_location` varchar(50) NOT NULL,
  `own_id` int(11) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `owner_email` varchar(50) NOT NULL,
  `owner_password` varchar(200) NOT NULL,
  `owner_contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage_reg_owner`
--

INSERT INTO `storage_reg_owner` (`storage_id`, `storage_name`, `storage_location`, `own_id`, `owner_name`, `owner_email`, `owner_password`, `owner_contact`) VALUES
(1, 'imran Ltd.', 'mymensingh', 1, 'Imran', 'imran@hadid.com', '$2y$10$2xXEn9WtVyXGjX5uTBwjvOrqoLqlvXR3c2DxSLLHppMkYqNZdPK0a', '123456789'),
(2, 'hadid Ltd.', 'Comilla', 2, 'hadid', 'hadid@imran.com', '$2y$10$UdIQdBR/K0KLBjcCo4wNpOGZiS18DZFfb36Mu6eniUVF1JI/JMY4.', '12345678'),
(3, 'rifat Ltd.', 'Rangamati', 3, 'rifat', 'rifat@imran.com', '$2y$10$rNSF3ztDwVBeIZlO6VxrUeDOvN8rqRCUhrD03lCcQ9PzjxB5f85P6', '2345678'),
(4, 'ina co Ltd.', 'Narayanganj', 4, 'ina', 'ina@yat.com', '$2y$10$vjp1cn.uGREPBuu8ByIh.OoUldRDkLfGFAyYHWDsaFu5GZ0iNNDVK', '12345678'),
(5, 'kakon Ltd.', 'Khulna', 5, 'kakon', 'kakon@k.com', '$2y$10$PfNpyJdI4Wv800DZ1/4euOnk7y7kOt3uDfTdTXmiYyTeXDytDZUs2', '23456789'),
(6, 'utpal Ltd.', 'Bogra', 6, 'Utpal', 'utpal@das.com', '$2y$10$p6t7ww4PJU6aKyiD4xVZueDgS9oZolwF7VlUU9jj/vTj5ERS1lp.6', '2345678'),
(7, 'hero alam Ltd.', 'Pabna', 7, 'Hero alam', 'hero@alam.com', '$2y$10$3AJObq5n2FWG1VrdEIkbK.vqW9KHl7ZUF.ZGqeCQHEtuNAN.NJttO', '2345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `storage_info`
--
ALTER TABLE `storage_info`
  ADD PRIMARY KEY (`storage_id`);

--
-- Indexes for table `storage_reg_client`
--
ALTER TABLE `storage_reg_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `storage_reg_owner`
--
ALTER TABLE `storage_reg_owner`
  ADD PRIMARY KEY (`own_id`),
  ADD KEY `storage_id` (`storage_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `storage_info`
--
ALTER TABLE `storage_info`
  MODIFY `storage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `storage_reg_client`
--
ALTER TABLE `storage_reg_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `storage_reg_owner`
--
ALTER TABLE `storage_reg_owner`
  MODIFY `own_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `storage_reg_client` (`client_id`);

--
-- Constraints for table `storage_reg_owner`
--
ALTER TABLE `storage_reg_owner`
  ADD CONSTRAINT `storage_reg_owner_ibfk_1` FOREIGN KEY (`storage_id`) REFERENCES `storage_info` (`storage_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
