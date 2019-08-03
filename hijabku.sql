-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2019 at 10:25 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hijabku`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`, `remember_token`) VALUES
('durika', '$2y$10$0AG5sdHL1v6XzXkiIhCfeOqfG00e25hBaY80EjyMK9rMs4Ld5akGS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(25) NOT NULL,
  `kode_kategori` varchar(25) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `stok` int(3) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga_barang` double NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `diupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `kode_kategori`, `nama_barang`, `stok`, `keterangan`, `gambar`, `harga_barang`, `dibuat`, `diupdate`) VALUES
('BRG-1-1', 'KTG-2', 'Ciput Brokat', 12, 'Secara etimologis jilbab berasal dari bahasa arab jalaba yang berarti menghimpun atau membawa.[1] Istilah jilbab digunakan pada negeri-negeri berpenduduk muslim lain sebagai jenis pakaian dengan penamaan berbeda-beda.[1] Di Iran disebut chador, di India dan Pakistan disebut pardeh, di Libya milayat, di Irak abaya, di Turki charshaf, dan tudung di Malaysia, sementara di negara Arab-Afrika disebut hijab.[1]', '1564760205-ciput brokat.jpg', 12000, '2019-08-02 16:14:32', '2019-08-02 09:14:32'),
('BRG-1-2', 'KTG-2', 'Ciput Ninja', 21, 'Ini adalah Ciput', '1564760253-ciput ninja.jpg', 12000, '2019-08-02 15:37:33', '2019-08-02 08:37:33'),
('BRG-1-4', 'KTG-1', 'Hijab Pashmina', 12, 'Ini adalah Hijab', '1564760387-hijab.jpg', 50000, '2019-08-02 08:39:47', '2019-08-02 08:39:47'),
('BRG-2-3', 'KTG-2', 'Ciput Rajut', 10, 'Ini adalah Ciput', '1564760318-ciput rajut.jpg', 5000, '2019-08-02 08:38:38', '2019-08-02 08:38:38'),
('BRG-3-4', 'KTG-3', 'Celana', 12, 'Ini celana dalam', '1564840980-12412_Kids-party-Happy-Birthday-little-princes.jpg', 2000000, '2019-08-03 07:03:00', '2019-08-03 07:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` varchar(25) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL,
  `gambar` varchar(255) NOT NULL DEFAULT 'https://cdn.shopify.com/s/files/1/0065/3829/7396/products/pins_640x.jpg?v=1558137862'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`, `gambar`) VALUES
('KTG-1', 'Hijab', 'https://cdn.shopify.com/s/files/1/0065/3829/7396/products/pins_640x.jpg?v=1558137862'),
('KTG-2', 'Aksesoris', 'https://cdn.shopify.com/s/files/1/0065/3829/7396/products/pins_640x.jpg?v=1558137862'),
('KTG-3', 'Pashmina', 'https://cdn.shopify.com/s/files/1/0065/3829/7396/products/pins_640x.jpg?v=1558137862');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `kode_keranjang` varchar(25) NOT NULL,
  `kode_barang` varchar(25) NOT NULL,
  `jumlah` int(3) NOT NULL DEFAULT '1',
  `id_member` varchar(25) NOT NULL,
  `total` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`kode_keranjang`, `kode_barang`, `jumlah`, `id_member`, `total`) VALUES
('KRJG-2-1-2', 'BRG-1-1', 5, 'MBR-3', 60000),
('KRJG-2-2-1', 'BRG-1-2', 1, 'MBR-2', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id_member` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_member`, `nama`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('MBR-1', 'durika', 'durika@gmail.com', NULL, '$2y$10$R4fQUKh61FnepEysD33GXOYIf6kNkL6xX/uLtjzVsl1IKRy8Om6da', NULL, '2019-08-02 10:37:01', '2019-08-02 10:37:01'),
('MBR-3', 'durika', 'durika1@gmail.com', NULL, '$2y$10$aHYjHdpTXsqi3kzY61BUfO4yjPf4jKiU19bSLXqzhFrBVJaSQNZvy', NULL, '2019-08-03 07:00:23', '2019-08-03 07:00:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_07_31_121931_create_members_table', 1),
(6, '2019_07_31_123146_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `kd_kategori` (`kode_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`kode_keranjang`),
  ADD KEY `kd_barang` (`kode_barang`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD UNIQUE KEY `member_email_unique` (`email`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD UNIQUE KEY `member_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
