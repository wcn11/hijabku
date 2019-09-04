-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2019 at 06:34 AM
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
('durika', '$2y$10$R4fQUKh61FnepEysD33GXOYIf6kNkL6xX/uLtjzVsl1IKRy8Om6da', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `kode_bank` varchar(20) NOT NULL,
  `nomor_rekening` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `atas_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`kode_bank`, `nomor_rekening`, `bank`, `atas_nama`) VALUES
('1', '0953831098', 'BCA', 'Durika');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(30) NOT NULL,
  `kode_kategori` varchar(30) NOT NULL,
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
('BRG-1-1', 'KTG-1', 'Hijab Ikat', 10, 'Hijab adalah kata dalam bahasa Arab yang berarti \"penghalang\". Pada beberapa negara berbahasa Arab serta negara-negara Barat, kata hijab lebih sering merujuk kepada kerudung yang digunakan oleh wanita muslim (lihat jilbab).', '1565293493-sample hijab1.jpg', 50000, '2019-08-08 19:44:53', '2019-08-08 12:44:53'),
('BRG-1-2', 'KTG-2', 'Ciput Rajut', 5, 'Ciput rajut menutup seluruh kepala, termasuk jika memiliki rambut panjang, rambut akan masuk kedalam ciput sehingga memberi volume kepala, dan bisa membuat penampilan lebih terkesan rapih, dan kepala terkesan bervolume dan cantik. Ciput rajut yang tersedia di hijabcomplements memiliki bahan rajut grade A, lembut, elastis menyesuaikan bentuk kepala, tapi nggak melar. Nyaman dipakai tidak membuat pusing, budek dan panas :) jadi nyaman banget deh...', '1565082072-ciput rajut.jpg', 12000, '2019-08-08 19:39:20', '2019-08-08 12:39:20'),
('BRG-1-5', 'KTG-1', 'hijab segi empat', 9, 'adem dan nyaman', '1565322122-sample 1.jpg', 15000, '2019-08-08 20:42:02', '2019-08-08 20:42:02'),
('BRG-3-3', 'KTG-2', 'Ciput Brokat', 4, 'Ciput jenis ini sebenarnya merupakan ciput jenis bandana yang dimodifikasi dengan menggunakan bahan lain yaitu brokat atau renda. Kelebihan ciput brokat adalah penggunaan bahannya yang menimbulkan kesan lebih feminim dan stylish.', '1565082109-ciput brokat.jpg', 20000, '2019-08-09 01:20:41', '2019-08-08 18:20:41'),
('BRG-3-4', 'KTG-3', 'Pashmina Oren', 10, 'adalah jenis wol kashmir sempurna dan tekstil yang terbuat dari wol tersebut dan pertama kali ditenun di India. Nama tersebut berasal dari kata Pashmina, bahasa Persia untuk \"terbuat dari wol\".', '1565293593-sample pashmina.jpg', 40000, '2019-08-09 01:09:50', '2019-08-08 18:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `bukti`
--

CREATE TABLE `bukti` (
  `kode_bukti` varchar(30) NOT NULL,
  `id_member` varchar(30) NOT NULL,
  `kode_invoice` varchar(30) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `tanggal_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bukti`
--

INSERT INTO `bukti` (`kode_bukti`, `id_member`, `kode_invoice`, `bukti`, `tanggal_upload`) VALUES
('BKT-2-2-1', 'MBR-1', 'INV-2-1', '1565289848-daftar student.png', '2019-08-08 11:44:08'),
('BKT-3-5-2', 'MBR-2', 'INV-3-4', '1565313357-login admin 1.png', '2019-08-08 18:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `kode_invoice` varchar(30) NOT NULL,
  `id_member` varchar(25) NOT NULL,
  `atas_nama` varchar(50) DEFAULT NULL,
  `ongkir` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `alamat_penerima` varchar(100) DEFAULT NULL,
  `tanggal_invoice` timestamp NULL DEFAULT NULL,
  `jatuh_tempo` timestamp NULL DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`kode_invoice`, `id_member`, `atas_nama`, `ongkir`, `total`, `alamat_penerima`, `tanggal_invoice`, `jatuh_tempo`, `telepon`, `status`) VALUES
('INV-2-1', 'MBR-1', 'durika', 40000, 52000, 'asd', '2019-08-08 18:43:43', '2019-08-15 18:43:43', 'asd', 'menunggu konfirmasi'),
('INV-2-2', 'MBR-1', 'durika', 18000, 58000, 'Bukit Cimanggu City Kota Bogor', '2019-08-08 19:52:56', '2019-08-15 19:52:56', '085791419696', 'jatuh tempo'),
('INV-2-3', 'MBR-1', 'ewr', 9000, 29000, '23', '2019-08-08 21:03:36', '2019-08-15 21:03:36', '23', 'jatuh tempo'),
('INV-3-4', 'MBR-2', 'susiari', 9000, 89000, 'cimanggu city', '2019-08-09 01:11:31', '2019-08-16 01:11:31', '08123456789', 'menunggu konfirmasi'),
('INV-4-5', 'MBR-3', 'vino aqnar', 18000, 38000, 'yasmin raya', '2019-08-09 01:22:31', '2019-08-16 01:22:31', '083819978547', 'menunggu pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_barang`
--

CREATE TABLE `invoice_barang` (
  `kode_invoice_barang` varchar(30) NOT NULL,
  `kode_invoice` varchar(30) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_barang`
--

INSERT INTO `invoice_barang` (`kode_invoice_barang`, `kode_invoice`, `kode_barang`, `jumlah`, `total`) VALUES
('IB-2-1', 'INV-2-1', 'BRG-1-2', 1, 12000),
('IB-3-2', 'INV-2-2', 'BRG-3-4', 1, 40000),
('IB-4-3', 'INV-2-3', 'BRG-3-3', 1, 20000),
('IB-5-4', 'INV-3-4', 'BRG-3-4', 2, 80000),
('IB-6-5', 'INV-4-5', 'BRG-3-3', 1, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` varchar(30) NOT NULL,
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
  `total` int(50) DEFAULT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`kode_keranjang`, `kode_barang`, `jumlah`, `id_member`, `total`, `tanggal_masuk`) VALUES
('KRJG-1-5-1', 'BRG-1-5', 1, 'MBR-1', 15000, '2019-08-09 03:47:10');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id_member` varchar(25) CHARACTER SET latin1 NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_member.png',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_member`, `nama`, `profil`, `email`, `alamat`, `telepon`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('MBR-4', 'diandian', 'default_member.png', 'dian@gmail.com', NULL, NULL, NULL, '$2y$10$c3jDCLdspFC7XiS2nSDDHuACePIvRcYDNfJa89pMycX90ykPZZ7h6', NULL, '2019-08-08 20:53:43', '2019-08-08 20:53:43'),
('MBR-1', 'durika', 'default_member.png', 'durika@gmail.com', NULL, NULL, NULL, '$2y$10$6vuovkCZFn1qXVwztkxlY.IUxiXWcFOJQzwXsiT31JqNH/ksNQZSW', NULL, '2019-08-08 11:35:22', '2019-08-08 11:35:22'),
('MBR-5', 'sam karya', 'default_member.png', 'samkarya@gmail.com', NULL, NULL, NULL, '$2y$10$2sGadqv7oqz/64kK1keBw.sfCrPGJA9kXEAVsoyhpG9zkfROfVGRW', NULL, '2019-08-08 21:00:08', '2019-08-08 21:00:08'),
('MBR-2', 'susiari', 'default_member.png', 'susiari@gmail.com', NULL, NULL, NULL, '$2y$10$qhMWedRUs8KzvGnnCvyofemMbUqmRXAadxV4LliBrCmHYbGS3WzZW', NULL, '2019-08-08 18:08:07', '2019-08-08 18:08:07'),
('MBR-3', 'vino aqnar', 'default_member.png', 'vino@gmail.com', NULL, NULL, NULL, '$2y$10$s5ajfIJE3t8j5k7hRjdazu0VVT7biHfhVltmHKuSgeYGd9OwXKvhu', NULL, '2019-08-08 18:19:30', '2019-08-08 18:19:30');

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
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`kode_bank`) USING BTREE;

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `kd_kategori` (`kode_kategori`);

--
-- Indexes for table `bukti`
--
ALTER TABLE `bukti`
  ADD PRIMARY KEY (`kode_bukti`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`kode_invoice`);

--
-- Indexes for table `invoice_barang`
--
ALTER TABLE `invoice_barang`
  ADD PRIMARY KEY (`kode_invoice_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`kode_keranjang`);

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
