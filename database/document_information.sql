-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2022 at 07:25 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `document_information`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `admin_id` int(4) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin_uploads`
--

CREATE TABLE `admin_uploads` (
  `doc_id` int(4) NOT NULL,
  `admin_id` int(4) NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `doc_size` varchar(255) NOT NULL,
  `upload_date` date NOT NULL,
  `document_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `document_details`
--

CREATE TABLE `document_details` (
  `doc_id` int(4) NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `doc_size` varchar(255) NOT NULL,
  `upload_date` date NOT NULL,
  `document_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

CREATE TABLE `user_credentials` (
  `user_id` int(4) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `create_date` date NOT NULL,
  `user_mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_uploads`
--

CREATE TABLE `user_uploads` (
  `doc_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `doc_size` varchar(255) NOT NULL,
  `upload_date` date NOT NULL,
  `document_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_uploads`
--
ALTER TABLE `admin_uploads`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `document_details`
--
ALTER TABLE `document_details`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_uploads`
--
ALTER TABLE `user_uploads`
  ADD PRIMARY KEY (`doc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  MODIFY `admin_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_uploads`
--
ALTER TABLE `admin_uploads`
  MODIFY `doc_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_details`
--
ALTER TABLE `document_details`
  MODIFY `doc_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_credentials`
--
ALTER TABLE `user_credentials`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_uploads`
--
ALTER TABLE `user_uploads`
  MODIFY `doc_id` int(4) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
