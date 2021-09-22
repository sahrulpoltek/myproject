-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2020 pada 18.48
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sahrul`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `pswrd` varchar(256) NOT NULL,
  `no_induk` varchar(128) NOT NULL,
  `user_type` varchar(128) NOT NULL,
  `level` varchar(128) NOT NULL,
  `status` int(1) NOT NULL,
  `created` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_akun`
--

INSERT INTO `tb_akun` (`id`, `nama`, `email`, `password`, `pswrd`, `no_induk`, `user_type`, `level`, `status`, `created`) VALUES
(1, 'Palpal', 'nurfadli231298@gmail.com', '8fa01a3320a7b75ea327a1f2c616656b', 'palpal', '42617016', 'Mahasiswa', 'user', 1, '25-07-2020'),
(9999, 'Admin', 'admin@ta.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', '00000', 'Administrator', 'admin', 1, '00000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_template`
--

CREATE TABLE `tb_template` (
  `id` int(11) NOT NULL,
  `template` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_vps`
--

CREATE TABLE `tb_vps` (
  `id` int(11) NOT NULL,
  `vps_id` varchar(11) NOT NULL,
  `hostname` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `template_id` varchar(256) NOT NULL,
  `ip_address` varchar(128) NOT NULL,
  `memory` varchar(11) NOT NULL,
  `disk` varchar(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created` varchar(128) NOT NULL,
  `user_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_template`
--
ALTER TABLE `tb_template`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_vps`
--
ALTER TABLE `tb_vps`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;

--
-- AUTO_INCREMENT untuk tabel `tb_template`
--
ALTER TABLE `tb_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_vps`
--
ALTER TABLE `tb_vps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
