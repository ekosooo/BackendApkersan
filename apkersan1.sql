-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2019 at 06:02 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apkersan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `kasus`
--

CREATE TABLE `kasus` (
  `kasus_id` int(6) NOT NULL,
  `kasus_nama` varchar(100) NOT NULL,
  `kasus_deskripsi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasus`
--

INSERT INTO `kasus` (`kasus_id`, `kasus_nama`, `kasus_deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Kekerasan Dalam Rumah Tangga', 'Lorem ipsum...', '2019-11-07 13:40:58', '2019-11-07 06:40:58'),
(2, 'Kekerasan Terhadap Anak', 'Lorem..', '2019-11-07 06:42:07', '2019-11-07 06:42:07'),
(3, 'Kekerasan Terhadap Perempuan', 'Lorem..', '2019-11-07 06:42:25', '2019-11-07 06:42:25'),
(4, 'Perdagangan Orang', 'Lorem..', '2019-11-07 06:42:50', '2019-11-07 06:42:50'),
(5, 'Tenaga Kerja', 'Lorem..', '2019-11-07 06:43:08', '2019-11-07 06:43:08');

-- --------------------------------------------------------

--
-- Table structure for table `kekerasan`
--

CREATE TABLE `kekerasan` (
  `kekerasan_id` int(6) NOT NULL,
  `kekerasan_nama` varchar(100) NOT NULL,
  `kekerasan_deskripsi` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kekerasan`
--

INSERT INTO `kekerasan` (`kekerasan_id`, `kekerasan_nama`, `kekerasan_deskripsi`, `updated_at`, `created_at`) VALUES
(1, 'Fisik', 'Lorem..', '2019-11-07 08:14:57', '2019-11-07 08:14:57'),
(2, 'Seksual', 'Lorem..', '2019-11-07 08:15:52', '2019-11-07 08:15:52'),
(3, 'Psikis', 'Lorem..', '2019-11-07 08:16:09', '2019-11-07 08:16:09'),
(4, 'Penelantaran', 'Lorem..', '2019-11-07 08:16:20', '2019-11-07 08:16:20'),
(6, 'Eksploitasi', 'Lorem..', '2019-11-07 08:17:09', '2019-11-07 08:17:09'),
(7, 'Cyber Harasment', 'Lorem..', '2019-11-07 08:25:24', '2019-11-07 08:17:27'),
(8, 'Perdagangan Orang', 'Lorem..', '2019-11-07 08:35:41', '2019-11-07 08:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `pengaduan_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `kasus_id` int(6) NOT NULL,
  `kekerasan_id` int(6) NOT NULL,
  `ticket_number` varchar(50) NOT NULL,
  `status_pelapor` varchar(20) NOT NULL,
  `disabilitas` varchar(10) NOT NULL,
  `korban_nama` varchar(100) NOT NULL,
  `korban_jk` varchar(50) NOT NULL,
  `korban_usia` varchar(10) NOT NULL,
  `korban_pendidikan` varchar(20) NOT NULL,
  `korban_bekerja` varchar(20) NOT NULL,
  `korban_statuskawin` varchar(20) NOT NULL,
  `alamat_kejadian` text NOT NULL,
  `waktu_kejadian` varchar(50) NOT NULL,
  `tempat_kejadian` varchar(50) NOT NULL,
  `kronologi` text NOT NULL,
  `bukti` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(6) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_jk` varchar(50) NOT NULL,
  `user_phone` varchar(30) NOT NULL,
  `user_modifikasi` varchar(50) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `role` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kasus`
--
ALTER TABLE `kasus`
  ADD PRIMARY KEY (`kasus_id`);

--
-- Indexes for table `kekerasan`
--
ALTER TABLE `kekerasan`
  ADD PRIMARY KEY (`kekerasan_id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`pengaduan_id`),
  ADD KEY `pengaduan_fk0` (`user_id`),
  ADD KEY `pengaduan_fk1` (`kasus_id`),
  ADD KEY `pengaduan_fk2` (`kekerasan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kasus`
--
ALTER TABLE `kasus`
  MODIFY `kasus_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kekerasan`
--
ALTER TABLE `kekerasan`
  MODIFY `kekerasan_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `pengaduan_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_fk0` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `pengaduan_fk1` FOREIGN KEY (`kasus_id`) REFERENCES `kasus` (`kasus_id`),
  ADD CONSTRAINT `pengaduan_fk2` FOREIGN KEY (`kekerasan_id`) REFERENCES `kekerasan` (`kekerasan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
