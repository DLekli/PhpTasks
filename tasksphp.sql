-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2024 at 10:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authKey` varchar(32) DEFAULT NULL,
  `accessToken` varchar(255) DEFAULT NULL,
  `role` varchar(32) NOT NULL,
  `password_hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `authKey`, `accessToken`, `role`, `password_hash`) VALUES
(38, 'admin', '', 'EnSWva97Rr_LI1KoKKjp3_ITPpRRUCav', 'Ip4xQn_6S-lxDp-kOWMQ6CNh3-yzZwP2', 'admin', '$2y$13$u2hkDB5eMKDcI58ShuuyI.uNKlnOPOhst/rXsF6qUtPs5/ab2p4pC'),
(39, 'user', '', 'mOf4Sw8dKN-tvHR8RXmRsesOlmCqchk_', '-0ubmd7QZlmo4JRzW-i_coGjyIzBJ1Cu', 'user', '$2y$13$MA3ce7xDny/qPntF3S.h8e26gZEsMlBz4Ne4LwW2hlEN7rzd2hQei'),
(60, 'newuser2024', '', 'd3aHooTxt8h9irBt7WaS66XeRDmd9F6D', 'RglMUQo9adA9ZtNAmY-BnRfYRpq0JsVj', 'user', '$2y$13$xCHAbPNsQS70f4/wAYI4qeNyNHs10JViPUY9Oc8JLyGI1jlSTNUbq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
