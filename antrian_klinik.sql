-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2026 pada 03.40
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
-- Database: `antrian_klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(0, 'admin', 123);

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(11) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `nomor_antrian` int(11) NOT NULL,
  `status` enum('menunggu','dipanggil','selesai') DEFAULT 'menunggu',
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `nama_pasien`, `nomor_antrian`, `status`, `tanggal`) VALUES
(21, 'budi', 1, 'selesai', '2026-06-23'),
(22, 'arief', 2, 'selesai', '2026-06-23'),
(23, 'rahman', 3, 'selesai', '2026-06-23'),
(24, 'prabowo', 4, 'selesai', '2026-06-23'),
(25, 'prabowo', 5, 'selesai', '2026-06-23'),
(26, 'munawir', 1, 'selesai', '2026-06-24'),
(27, 'siska', 2, 'selesai', '2026-06-24'),
(28, 'saini', 3, 'selesai', '2026-06-24'),
(29, 'kevin', 4, 'selesai', '2026-06-24'),
(31, 'rasidin', 5, 'selesai', '2026-06-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(100) DEFAULT NULL,
  `riwayat_sakit` text DEFAULT NULL,
  `jenis_penyakit` varchar(100) DEFAULT NULL,
  `tanggal_periksa` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `riwayat_sakit`, `jenis_penyakit`, `tanggal_periksa`) VALUES
(1, 'Budi Santoso', 'Demam tinggi selama 3 hari, mual, dan pusing', 'Gejala Tipes', '2026-06-20'),
(2, 'Siti Aminah', 'Batuk berdahak dan sesak napas saat malam', 'Infeksi Saluran Pernapasan', '2026-06-21'),
(3, 'Ahmad Dahlan', 'Sakit kepala sebelah kiri berdenyut dan mual', 'Migrain', '2026-06-22'),
(4, 'Rina Melati', 'Nyeri perih di lambung setelah makan pedas', 'Asam Lambung', '2026-06-23'),
(5, 'Tono Wibowo', 'Gatal-gatal kemerahan di seluruh tubuh setelah makan *seafood*', 'Alergi', '2026-06-23'),
(6, 'Joko Susanto', 'Sakit tenggorokan, batuk kering, dan sulit menelan', 'Radang Tenggorokan', '2026-06-24'),
(7, 'Maya Sari', 'Pusing di leher belakang dan tekanan darah tinggi', 'Hipertensi', '2026-06-24'),
(8, 'diana', 'Nyeri hebat pada persendian lutut dan bengkak', 'Asam Urat', '2026-06-25'),
(9, 'Reza Rahadian', 'Demam tinggi naik turun selama 4 hari dan muncul ruam', 'Gejala DBD', '2026-06-25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
