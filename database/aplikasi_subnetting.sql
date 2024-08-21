-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Agu 2024 pada 16.56
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_subnetting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id` int(20) NOT NULL,
  `id_host` int(20) NOT NULL,
  `network` varchar(30) NOT NULL,
  `ip_awal` varchar(30) NOT NULL,
  `ip_akhir` varchar(30) NOT NULL,
  `broadcast` varchar(30) NOT NULL,
  `prefix` int(20) NOT NULL,
  `subnetmask` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_hasil`
--

INSERT INTO `tb_hasil` (`id`, `id_host`, `network`, `ip_awal`, `ip_akhir`, `broadcast`, `prefix`, `subnetmask`) VALUES
(1, 1, '192.168.10.0', '192.168.10.1', '192.168.10.126', '192.168.10.127', 25, '255.255.255.128'),
(2, 8, '192.168.10.128', '192.168.10.129', '192.168.10.158', '192.168.10.159', 27, '255.255.255.224'),
(3, 18, '192.168.10.160', '192.168.10.161', '192.168.10.174', '192.168.10.175', 28, '255.255.255.240'),
(4, 19, '192.168.10.176', '192.168.10.177', '192.168.10.190', '192.168.10.191', 28, '255.255.255.240'),
(5, 17, '192.168.10.192', '192.168.10.193', '192.168.10.198', '192.168.10.199', 28, '255.255.255.248'),
(6, 24, '192.168.10.200', '192.168.10.201', '192.168.10.206', '192.168.10.207', 29, '255.255.255.248');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_host`
--

CREATE TABLE `tb_host` (
  `id` int(20) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL,
  `jumlah_host` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_host`
--

INSERT INTO `tb_host` (`id`, `nama_divisi`, `jumlah_host`) VALUES
(1, 'CS Dept', '80'),
(8, 'HRD', '20'),
(17, 'Administrasi', '5'),
(18, 'Operator', '12'),
(19, 'Sales', '7'),
(24, 'Direktur', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_network`
--

CREATE TABLE `tb_network` (
  `id` int(20) NOT NULL,
  `alamat_ip` varchar(20) NOT NULL,
  `slash` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_network`
--

INSERT INTO `tb_network` (`id`, `alamat_ip`, `slash`) VALUES
(15, '192.168.10.0', 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(20) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama_user`, `username`, `password`) VALUES
(1, 'Pengguna', 'Pengguna123', 'b0a4b508ff239219a599b4027e2aeb48'),
(3, 'Admin', 'admin123', '0192023a7bbd73250516f069df18b500');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_host` (`id_host`);

--
-- Indeks untuk tabel `tb_host`
--
ALTER TABLE `tb_host`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_network`
--
ALTER TABLE `tb_network`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_host`
--
ALTER TABLE `tb_host`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_network`
--
ALTER TABLE `tb_network`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD CONSTRAINT `tb_hasil_ibfk_1` FOREIGN KEY (`id_host`) REFERENCES `tb_host` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
