-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2020 at 02:34 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staff_jti`
--

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `nip` varchar(90) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `email` varchar(90) NOT NULL,
  `username` varchar(90) NOT NULL,
  `password` varchar(90) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `nip`, `nama`, `email`, `username`, `password`, `jabatan`, `level`) VALUES
(1, '13287462763', 'Budi Wijaya', 'budiw@gmail.com', 'budi', '9c5fa085ce256c7c598f6710584ab25d', 'dosen', 'user'),
(2, '-', 'Ardan Anjung', 'ardananjungkusuma@gmail.com', 'ardan', 'd2219d75098abd01493908d2f7f4d13d', '-', 'admin'),
(3, '123312324', 'Novia Kusumawardani', 'novia@gmail.com', 'novia', 'af2f690d195131f75627ff2b354a9daf', 'staffadmin', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
