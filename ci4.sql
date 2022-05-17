-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 07:49 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `file` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `id_kategori`, `kode`, `nama`, `file`, `harga_beli`, `harga_jual`, `deskripsi`, `created_at`, `updated_at`) VALUES
(11, 5, 'B540132', 'Navy Club Tas Ransel Kasual EBJ - Tas Pria Backpack - Up To 14 Inch - Hitam', '1652188395_6dd2998cb81af9ff2def.jpg', 165000, 199000, 'Kondisi: Baru\r\nBerat: 1.000 Gram\r\nKategori: Tas Ransel Pria\r\nEtalase: Backpack\r\n\r\n&quot;Navy Club tas ransel kasual berbahan nylon halus, pada kolom utama dilengkapi sekat untuk file dan bisa untuk membawa laptop max.14 inch serta kolom dengan resleting untuk menyimpan barang berharga. Tersedia kolom tambahan dibagian depan tas untuk menyimpan barang-barang yang sering diakses dan dua saku samping untuk tempat botol air minum atau barang kecil lainnya.\r\n\r\nDouble kepala resleting memudahkan Anda dalam membuka dan menutup tas, serta tali ransel yang empuk untuk kenyamanan dalam pemakaian.&quot;\r\n\r\nUkuran Produk 32x15x45 cm (PxLxT)\r\nKolom utama dilengkapi dengan sekat untuk file dan kolom dengan resleting\r\nTerbuat dari bahan nylon halus\r\nSatu kolom tambahan dibagian depan untuk menyimpan barang yang sering diakses\r\nDouble kepala resleting untuk memudahkan dalam membuka dan menutup tas\r\nDua saku samping untuk tempat botol air minum atau barang kecil lainnya\r\nTali ransel yang empuk untuk kenyamanan dalam pemakaian', '2022-04-26 14:08:17', '2022-05-10 20:13:15'),
(13, 0, 'B610782', 'Nutriboost', '', 12, 1234, '', '2022-04-26 14:12:24', '2022-05-04 19:45:02'),
(14, 0, 'B623807', 'Oreo', '', 123, 1231312, '', '2022-04-26 14:19:33', '2022-04-30 20:00:44'),
(15, 5, 'B851340', 'Beras', '', 0, 0, '', '2022-04-26 14:20:06', '2022-05-09 10:21:07'),
(16, 2, 'B642809', 'Milkita', '', 3453, 232, '', '2022-04-26 14:25:48', '2022-05-09 07:38:19'),
(17, 1, 'B639421', 'Antimo', '', 0, 80000, '', '2022-04-26 14:32:56', '2022-05-09 06:43:18'),
(25, 0, 'B713650', 'Biore Men Face Wash 40ml (All Varian)', '1651643414_1a3f50921b1fc2a157e5.jpg', 17450, 20000, 'asd', '2022-05-04 12:50:14', '2022-05-04 13:03:19'),
(26, 4, 'B740253', 'asd', '', 1, 2, '', '2022-05-07 13:08:33', '2022-05-09 07:00:43'),
(27, 6, 'B859024', 'Baju Wanita Kemeja Style Korea', '1652076015_7be676d8ce7be638a88b.jpg', 45000, 51900, 'Kondisi: Baru\r\nBerat: 300 Gram\r\nKategori: Kemeja Wanita\r\nEtalase: Baju Wanita\r\nKEMEJA WANITA CASUAL\r\nStyle Korea Modal TWD\r\n\r\nBahan =  MOSSCREPE\r\n\r\nCocok bangat buat lagi santai\r\n\r\nWAJIB TELITI / BACA DESKRIPSI SEBELUM ORDER....\r\nREADY 3 WARNA\r\nREADY 4 SIZE\r\nM : LD:94 CM - PJG:60 CM\r\nL : LD:96 CM - PJG:61 CM\r\nXL : LD:98 CM - PJG:62 CM\r\nXXL : LD:102 CM - PJG:63 CM\r\nESTIMASI 1-CM\r\n\r\nCATATAN:\r\nWARNA BISA SEDIKIT BEDA ITU DIKARENAKAN EFEK CAHAYA KAMERA\r\n\r\nDAN UNTUK KEAMANAN UNBOXING / VIDEOKAN DAHULU SEBELUM BUKA PAKET SUPAYA ADA BUKTI(JIKALAU ADA KESALAHAN)\r\nTANPA BUKTI BEARTI PAKET KITA ANGGAP SESUAI PESANAN/ORDERAN', '2022-05-09 13:00:15', '2022-05-10 14:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Aksesoris Kendaraan', '', '2022-05-07 07:17:42', '2022-05-07 07:17:42'),
(2, 'Baju Koko', '', '2022-05-07 12:36:31', '2022-05-07 12:45:02'),
(4, 'Baju Muslimah', '', '2022-05-07 12:45:47', '2022-05-09 07:10:00'),
(5, 'Tas', '', '2022-05-09 07:24:59', '2022-05-10 20:16:01'),
(6, 'Baju Wanita', '', '2022-05-09 12:58:30', '2022-05-09 12:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_supplier` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id`, `id_barang`, `id_supplier`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 16, '5', 77, 'Pcs', '2022-04-30 15:36:58', '2022-04-30 15:36:58'),
(2, 17, '1,6', 15, 'Dus', '2022-05-01 05:33:49', '2022-05-09 14:01:25'),
(3, 11, '2,4,6', 234, 'Pcs', '2022-05-01 05:43:48', '2022-05-17 12:41:16'),
(4, 15, '2,4,7', 123, 'Pcs', '2022-05-03 08:50:01', '2022-05-17 12:42:29'),
(5, 13, '2,7', 11, 'Dus', '2022-05-03 08:51:31', '2022-05-17 12:42:43'),
(6, 12, '1,2,4,5,7', 21, 'Dus', '2022-05-03 08:51:56', '2022-05-03 08:52:25'),
(7, 25, '1,2,4', 99, 'Dus', '2022-05-04 13:01:34', '2022-05-09 06:38:40'),
(8, 27, '5', 445, 'Pcs', '2022-05-10 14:38:03', '2022-05-10 14:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `kode`, `nama`, `alamat`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'S192375', 'Mulia Grosir', 'Genteng Banyuwangi', 'Pusat grosir dikota genteng', '2022-04-16 11:58:32', '2022-05-16 21:06:23'),
(2, 'S03294', 'Barokah Mall Hedon', 'Sumbersari', 'asdasdasd', '2022-04-18 06:10:54', '2022-04-26 12:29:14'),
(4, 'S23720', 'Karunia Darma Sejahtera', 'Genteng', 'ya gitua', '2022-04-18 16:29:49', '2022-05-09 06:36:21'),
(5, 'S27409', 'Paramita', 'Lidah Gambiran', 'bengkel pokokK', '2022-04-18 16:32:43', '2022-05-16 20:56:25'),
(6, 'S23721', 'Sumber Jaya', 'Glenmore', 'asd', '2022-04-26 12:25:18', '2022-04-29 17:13:10'),
(7, 'S285064', 'PT Bares Grosir', 'Kalibaru', '', '2022-04-26 14:35:02', '2022-05-16 20:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(25) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `foto`, `deskripsi`, `alamat`, `telp`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Fatwa Aulia', 'fatwa@gmail.com', '21bc74c38dd9da2d1bcc59e7bf3297ac', '1652161063_b4da6e192e5886958021.jpeg', 'Tugas manusia hanya berusaha dan taat pada tuhannya.', 'Lidah Gambiran', '082345566500', '44837539ee00e32a115b17403edd5e9a', '2022-03-22 23:45:00', '2022-05-16 21:09:40'),
(2, 'rara', 'rara@gmail.com', 'd8830ed2c45610e528dff4cb229524e9', '', '', 'Glenmore', '6287755123123', '', '0000-00-00 00:00:00', '2022-04-13 04:59:20'),
(7, 'safira', 'safira@gmail.com', 'ea9827e9ad232af00af77b2375693568', '1649840796_d4397d56c0432a656d85.jpg', '', 'Genteng', '12345678910', '', '2022-04-02 07:55:51', '2022-04-13 16:06:36'),
(14, 'Adel', 'adelkeun.sss@gmail.com', '29072e796ffd35d9d821ffea0c63bfdd', '', '', 'Gedangan', '098239230234324', '', '2022-04-15 05:48:27', '2022-05-10 12:43:55'),
(15, 'Ega', 'ega@gmail.com', '241dd5e52a765b6e421a893110391dc3', '', '', 'Bangorejo', '92734892378234', '', '2022-04-15 05:50:14', '2022-04-15 05:50:14'),
(16, 'Ayunda', 'ayunda@gmail.com', 'cc28a988fcbbf651fdfb89ed6cf8810c', '1650025854_5a9874a0b785912b4644.jpg', '', 'NN', '74827402934329', '', '2022-04-15 05:53:21', '2022-04-15 19:30:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
