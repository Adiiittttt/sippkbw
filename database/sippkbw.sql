-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2024 pada 04.19
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sippkbw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `IDadmin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`IDadmin`, `nama`, `username`, `password`, `email`) VALUES
(1, 'Muhammad Aditia', 'admin', 'admin', 'mhmdaditia21@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `IDkategori` int(11) NOT NULL,
  `namakategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`IDkategori`, `namakategori`) VALUES
(1, 'Laptop'),
(6, 'Sparepart'),
(7, 'Aksesoris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbaikan`
--

CREATE TABLE `perbaikan` (
  `IDperbaikan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `jenis_perangkat` varchar(100) NOT NULL,
  `deskripsi_masalah` text NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status` enum('Menunggu','Dalam Proses','Selesai','Dibatalkan') NOT NULL DEFAULT 'Menunggu',
  `biaya` varchar(100) DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perbaikan`
--

INSERT INTO `perbaikan` (`IDperbaikan`, `nama_pelanggan`, `no_telp`, `email`, `jenis_perangkat`, `deskripsi_masalah`, `tanggal_masuk`, `tanggal_selesai`, `status`, `biaya`, `catatan`) VALUES
(3, 'adit', '085828119907', 'adit@gmail.com', 'laptop', 'install', '2024-06-16', NULL, 'Menunggu', NULL, NULL),
(6, 'umi', '086757476787', 'umi@gmail.com', 'laptop', 'tidak bisa nyalaa', '2024-06-20', '0000-00-00', 'Dalam Proses', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `IDproduk` int(11) NOT NULL,
  `IDkategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `unggulan` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`IDproduk`, `IDkategori`, `nama`, `deskripsi`, `harga`, `stok`, `gambar`, `unggulan`) VALUES
(2, 1, 'ASUS Vivobook Go 14 (E1404F)', 'Ringan dan Ringkas, ini adalah ASUS Vivobook Go 14, laptop yang dirancang untuk membuat para pelajar lebih produktif dan tetap terhibur dimanapun! Dengan engsel lay-flat 180°, pelindung webcam fisik, dan banyak fitur desain yang cermat, Vivobook Go 14 adalah laptop yang membebaskan Anda!', '9800000', 10, 'laptopp.png', 1),
(9, 6, 'Hardisk WD Green 1TB', 'Penyimpanan internal merupakan komponen yang diperlukan dari sistem apa pun. Di situlah tempat Anda menyimpan file data, dokumen, foto, musik, dan lainnya. Di situlah juga tempat aplikasi, program, dan sistem operasi Anda disimpan. Warna drive Western Digital mempermudah Anda mengidentifikasi drive yang tepat untuk kebutuhan Anda.', '300000', 100, '../../assets/images/hdd.jpeg', 0),
(10, 7, 'logitech MX MASTER 3S', 'Sambutlah MX Master 3S – mouse ikonik yang dirancang ulang.\r\nRasakan setiap momen alur kerjamu dengan lebih presisi, tactility, dan kinerja, berkat Quiet Clicks dan sensor 8.000 DPI track-on-glass13ketebalan kaca minimum 4 mm..', '1689000', 10, '../../assets/images/mousdee.png', 0),
(11, 1, 'Acer Nitro 16 AMD', 'Sambut kehadiran perangkat yang memungkinkan Anda untuk bekerja dan bermain tanpa hambatan dengan Acer Nitro 16 AMD. Dirancang untuk usahawan dan gamer yang penuh dengan antusiasme, laptop ini bisa berfungsi sebagai katalisator untuk inovasi dan kegembiraan. Laptop ini bukan hanya sebuah alat, tetapi juga pendamping dalam perjalanan Anda untuk menuju kesuksesan dan bertualang.', '41100000', 1, '../../assets/images/acer.png', 0),
(12, 1, 'Lenovo ThinkPad X13 2-in-1 Gen 5 (13″ Intel)', 'Power Meets Portability & Security\r\nCompact convertible 13.3″ business laptop\r\n\r\nAI-assisted productivity with Intel vPro® powered by Intel Core Ultra processors\r\n\r\nThinkShield security to safeguard critical data\r\n\r\nVibrant, high quality sound with Dolby Audio®\r\n\r\nHigh speed connectivity – faster data transfer & smooth streaming\r\n\r\nIntegrated rechargeable stylus for hassle-free designing, drawing, & note taking', '53800000', 1, '../../assets/images/lenovo.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IDadmin`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`IDkategori`);

--
-- Indeks untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD PRIMARY KEY (`IDperbaikan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`IDproduk`),
  ADD KEY `IDkategori` (`IDkategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `IDadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `IDkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  MODIFY `IDperbaikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `IDproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`IDkategori`) REFERENCES `kategori` (`IDkategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
