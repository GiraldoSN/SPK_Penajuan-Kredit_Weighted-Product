-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2024 pada 06.22
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
-- Database: `spk-wp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` varchar(20) NOT NULL,
  `alternatif` varchar(20) NOT NULL,
  `k1` varchar(20) NOT NULL,
  `k2` varchar(20) NOT NULL,
  `k3` varchar(20) NOT NULL,
  `k4` varchar(20) NOT NULL,
  `k5` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `alternatif`, `k1`, `k2`, `k3`, `k4`, `k5`) VALUES
('175900', 'I', '5', '5', '5', '2', '3'),
('180385', 'FA', '5', '1', '4', '4', '3'),
('201691', 'BDG', '3', '5', '4', '1', '3'),
('203483', 'HY', '1', '1', '5', '1', '3'),
('215193', 'SMY', '2', '1', '1', '1', '3'),
('231889', 'PA', '2', '5', '5', '1', '3'),
('232688', 'ES', '2', '2', '5', '1', '3'),
('235681', 'OIA', '5', '5', '5', '1', '3'),
('268505', 'FDA', '5', '5', '5', '2', '3'),
('288577', 'NNP', '5', '5', '4', '5', '3'),
('299840', 'PAP ', '1', '1', '5', '2', '3'),
('302009', 'HK', '1', '2', '5', '1', '3'),
('312092', 'DN', '2', '1', '2', '1', '2'),
('316660', 'FY', '1', '3', '4', '2', '3'),
('386005', 'BA', '5', '5', '4', '4', '3'),
('409315', 'DAH', '5', '1', '4', '3', '3'),
('417803', 'AK', '1', '1', '5', '1', '2'),
('421334', 'ZF', '1', '1', '5', '1', '3'),
('450275', 'VBWB', '1', '1', '4', '2', '3'),
('458235', 'NA', '1', '2', '5', '1', '3'),
('465292', 'DA', '5', '5', '2', '4', '3'),
('50048', 'BD', '1', '1', '5', '2', '3'),
('520946', 'MPP', '5', '5', '4', '3', '2'),
('58081', 'DS', '5', '5', '4', '1', '3'),
('586903', 'IP', '1', '5', '4', '1', '3'),
('600526', 'KAD', '5', '5', '4', '2', '3'),
('64091', 'TA', '1', '3', '4', '1', '3'),
('671548', 'AP', '1', '1', '4', '2', '3'),
('682474', 'IA', '5', '5', '4', '2', '3'),
('68465', 'MP', '1', '1', '5', '1', '3'),
('701479', 'IPS', '2', '2', '5', '1', '3'),
('718222', 'YC', '5', '5', '1', '1', '3'),
('723557', 'RH', '5', '5', '4', '5', '3'),
('724307', 'PH ', '1', '1', '5', '1', '3'),
('741080', 'DPA', '1', '2', '5', '1', '3'),
('742000', 'ABS', '1', '5', '5', '1', '3'),
('743515', 'RAS', '5', '5', '5', '3', '3'),
('766721', 'NA', '5', '5', '5', '1', '3'),
('799487', 'HDH', '5', '1', '4', '4', '3'),
('808666', 'TD', '2', '2', '5', '1', '3'),
('81094', 'CW', '1', '1', '5', '1', '3'),
('875504', 'MI', '5', '5', '5', '1', '3'),
('882739', 'NS', '5', '5', '3', '2', '2'),
('899478', 'FR', '5', '2', '4', '5', '3'),
('910592', 'YIS', '1', '4', '4', '4', '3'),
('914077', 'DH', '5', '1', '4', '3', '3'),
('914533', 'NTH', '2', '4', '5', '1', '3'),
('944375', 'RI', '5', '5', '5', '1', '3'),
('977545', 'TLP', '2', '2', '1', '1', '3'),
('994242', 'DN', '5', '5', '2', '4', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` varchar(20) NOT NULL,
  `kriteria` varchar(20) NOT NULL,
  `kepentingan` varchar(20) NOT NULL,
  `cost_benefit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `kepentingan`, `cost_benefit`) VALUES
('1', 'c1 harga', '1', 'cost'),
('2', 'c2 merk', '3', 'benefit'),
('3', 'c3 warna', '5', 'benefit'),
('4', 'c4 spesifikasi', '2', 'benefit'),
('5', 'c5 purna jual', '4', 'cost');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
