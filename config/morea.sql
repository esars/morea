-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Oct 07, 2014 at 09:36 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `landare`
--

-- --------------------------------------------------------

--
-- Table structure for table `erabiltzaile`
--

CREATE TABLE `erabiltzaile` (
  `izena` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `abizena` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `telefonoa` int(12) NOT NULL,
  `pasahitza_hash` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pasahitza_salt` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `helbidea` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
`id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `produktu`
--

CREATE TABLE `produktu` (
`id` int(5) NOT NULL,
  `izena` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `deskripzioa` text COLLATE utf8_spanish_ci NOT NULL,
  `prezioa` float(7,2) NOT NULL,
  `stock` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salmentak`
--

CREATE TABLE `salmentak` (
`id` int(5) NOT NULL,
  `id_er` int(5) NOT NULL,
  `id_prod` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `erabiltzaile`
--
ALTER TABLE `erabiltzaile`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produktu`
--
ALTER TABLE `produktu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salmentak`
--
ALTER TABLE `salmentak`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `erabiltzaile`
--
ALTER TABLE `erabiltzaile`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produktu`
--
ALTER TABLE `produktu`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `salmentak`
--
ALTER TABLE `salmentak`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;