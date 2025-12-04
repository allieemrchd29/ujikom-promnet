-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 02:18 AM
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
-- Database: `simbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `jenis_buku` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` int(100) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `no_isbn` bigint(20) NOT NULL,
  `jml_hal` int(100) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `jenis_buku`, `penulis`, `penerbit`, `tahun_terbit`, `cover`, `no_isbn`, `jml_hal`, `id_kategori`) VALUES
(3, 'A Curse For True Love: the thrilling final book in the Once Upon a Broken Heart series', 'Romance', 'Stephanie Garber', 'Paperback', 2024, 'book1.jpg', 9781529399325, 400, 2),
(4, 'Unravel Me', 'Fantasy', 'Tahereh Mafi', 'Paperback', 2018, 'book2.jpg', 9781529399325, 480, 2),
(5, 'The Midnight Library', 'Novel', 'Matt Haig', 'Canongate Books', 2020, 'book3.jpg', 9781786892790, 304, 2),
(6, 'Sapiens: A Brief History of Humankind', 'Non-Fiction', 'Yuval Noah Harari', 'Harver', 2014, 'book4.jpg', 9780062316097, 464, 2),
(7, 'The Silent Patient', 'Thriller', 'Alex Michaelides', 'Celadon Books', 2019, 'book5.jpg', 9781250301697, 336, 1),
(8, 'Where the Crawdads Sing', 'Fiction/Mystery', 'Delia Owens', 'G.P. Putnams Sons', 2018, 'book6.jpg', 9780735219106, 384, 1),
(9, 'Ikigai: The Japanese Secret to a Long and Happy Life', 'Self-Improvement', 'Héctor García, Francesc Miralles', 'Penguin Books', 2017, 'book7.jpg', 9781786337045, 208, 2),
(10, 'Kafka on the Shore', 'Magical Realism', 'Haruki Murakami', 'Vintage', 2005, 'book8.jpg', 9780099496954, 505, 1),
(11, 'The Hitchhikers Guide to the Galaxy', 'Sci-Fi/Comedy', 'Douglas Adams', 'Harmony Books', 1979, 'book9.jpg', 9780345391803, 216, 2),
(12, 'The Body Keeps the Score', 'Psychology', 'Bessel van der Kolk', 'Penguin Books', 2016, 'book10.jpg', 9780143127741, 464, 2),
(13, 'Alster Lake', 'Romance', 'Auryn Vientania', 'Bukune', 2021, 'book11.jpg', 9786022204251, 320, 2),
(14, 'Malioboro at Midnight', 'Romance', 'Skysphire', 'Bukune', 2023, 'Malioboro at Midnight_Skysphire.jpg', 9786022204909, 436, 2),
(21, 'Atomic Habits', 'Self-Improvement', 'James Clear', 'Avery', 2018, 'Atomic Habits_James Clear.jpg', 9780735211292, 320, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`, `tgl_input`) VALUES
(1, 'Fiksi', '2025-11-29 01:40:49'),
(2, 'Non-fiksi', '2025-11-29 04:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(1, 'yaya', 'yaya@gmail.com', '$2y$10$JU8AONZM52e.UdJZGCgvGOLElI2XdTXBC8jUQEiv69PBIPabXjgDi'),
(2, 'celi', 'celi@gmail.com', '$2y$10$jhOucCi7LeuVIvPx10gHJ.6wTSHdClKjv6UnyaJ0hxQ8bYc6/8De6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
