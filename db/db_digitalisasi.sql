-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2025 pada 10.45
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
-- Database: `db_digitalisasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alats`
--

CREATE TABLE `alats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `volume` varchar(50) DEFAULT NULL,
  `kondisi` varchar(100) DEFAULT NULL,
  `jumlah` varchar(100) DEFAULT NULL,
  `merek` varchar(100) DEFAULT NULL,
  `tahun_pengadaan` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alats`
--

INSERT INTO `alats` (`id`, `nama`, `images`, `volume`, `kondisi`, `jumlah`, `merek`, `tahun_pengadaan`, `created_at`, `updated_at`) VALUES
(1, 'funnel glass', '01JZ2F5B15QPR6XVK5E9AYE1X4.jpg', '100 mm', 'baik', '2', '-', '-', '2025-07-01 00:45:27', '2025-07-01 00:45:27'),
(2, 'dawda', '01JZ2HHYHEKYHSBDE83VHWGPB2.jpeg', 'wdasdaw', 'wasddaw', 'awdawd', 'dawdawd', 'awdwda', '2025-07-01 00:51:51', '2025-07-01 01:27:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_cairan_lamas`
--

CREATE TABLE `bahan_cairan_lamas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `rumus_kimia` varchar(50) NOT NULL,
  `sisa_bahan` varchar(255) NOT NULL,
  `nomor_cas` varchar(20) DEFAULT NULL,
  `letak` varchar(50) DEFAULT NULL,
  `pemilik` varchar(50) DEFAULT NULL,
  `tahun_pengadaan` varchar(50) DEFAULT NULL,
  `expired` varchar(50) DEFAULT NULL,
  `merek` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bahan_cairan_lamas`
--

INSERT INTO `bahan_cairan_lamas` (`id`, `nama`, `rumus_kimia`, `sisa_bahan`, `nomor_cas`, `letak`, `pemilik`, `tahun_pengadaan`, `expired`, `merek`, `created_at`, `updated_at`) VALUES
(1, 'Asam Sulfat', 'H2SO4', '1250 ml', '7664-93-9', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(2, 'Asam Klorida', 'HCl', '800 ml', '7647-01-0', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(3, 'Asam Nitrat', 'HNO3', '400 ml', '7697-37-2', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(4, 'Asam Asetat', 'CH3COOH', '400 ml', '64-19-7', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(5, 'Asam Fomiat', 'CH2O2', '200 ml', '64-18-6', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(6, 'Ammonia', 'NH3', '0 ml', '7664-41-7', '-', '-', '-', '-', '-', '2025-06-10 15:48:09', '2025-06-10 08:48:41'),
(7, 'Amonium Hidroksida', 'NH4OH', '400 ml', '1336-21-6', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(8, 'Aseton', 'C3H6O', '250 ml', '67-64-1', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(9, 'Butanol', 'C4H10O', '500 ml', '71-36-3', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(10, 'Benzil Alkohol', 'C7H8O', '500 ml', '100-51-6', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(11, 'Benedit', '', '0 ml', '63126-89-6', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(12, 'Diklorometana', 'CH2CL2', '0 ml', '200-838-9', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(13, 'Etanol', 'C2H6O', '0 ml', '64-17-5', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(14, 'Etil Asetat', 'C4H8O2', '0 ml', '141-78-6', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(15, 'Fehling A', 'CuH2O4S', '0 ml', '7758-98-7', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(16, 'Fehling B', 'CuSO4', '0 ml', '6381-59-5', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(17, 'Formaldehid', 'CH2O', '1000 ml', '50-00-0', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(18, 'Gliserol', 'C3H8O3', '1000 ml', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(19, 'Hidrogen Peroxide', 'H2O2', '500 ml', '7722-84-1', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(20, 'Iodium', 'I2', '0 ml', '7553-56-2', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(21, 'Klorofom', 'CHCl3', '300 ml', '67-66-3', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(22, 'Metanol', 'CH3OH', '900 ml', '67-56-1', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(23, 'Natrium hipoklorida', 'NaClO', '1000 ml', '7681-52-9', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(24, 'N-heksana', 'C6H14', '500 ml', '110-54-3', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(25, 'p-xilena', 'C8H10', '500 ml', '95-47-6', NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09'),
(26, 'spiritus', '', '200 ml', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 15:48:09', '2025-06-10 15:48:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_padats`
--

CREATE TABLE `bahan_padats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `rumus_kimia` varchar(50) NOT NULL,
  `sisa_bahan` varchar(255) NOT NULL,
  `nomor_cas` varchar(20) DEFAULT NULL,
  `letak` varchar(50) DEFAULT NULL,
  `pemilik` varchar(50) DEFAULT NULL,
  `tahun_pengadaan` varchar(50) DEFAULT NULL,
  `expired` varchar(50) DEFAULT NULL,
  `merek` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bahan_padats`
--

INSERT INTO `bahan_padats` (`id`, `nama`, `rumus_kimia`, `sisa_bahan`, `nomor_cas`, `letak`, `pemilik`, `tahun_pengadaan`, `expired`, `merek`, `created_at`, `updated_at`) VALUES
(1, 'Amonium Klorida', 'NH4Cl', '380 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(2, 'Amilum', '(C6H10O5)n', '250 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(3, 'Amonium Karbonat', '(NH4)2CO3', '500 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(4, 'Amonium Klorida', 'NH4Cl', '1000 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(5, 'Amonium Nitrat', 'NH4NO3', '800 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(6, 'Amonium Oksalat', '(NH4)2C2O4', '500 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(7, 'Asam Adipat', 'C6H10O4', '450 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(8, 'Asam Benzoat', 'C6H5COOH', '450 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(9, 'Asam Salisilat', 'C7H6O3', '400 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(10, 'Asam Sitrat', 'C6H8O7', '400 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(11, 'Barium Hidroksida', 'Ba(OH)2', '325 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(12, 'Barium Klorida', 'BaCl2', '300 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(13, 'Barium Nitrat', 'Ba(NO3)2', '300 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(14, 'Barium Sulfat', 'BaSO4', '300 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(15, 'Bentonit', 'Al2O3.4SiO2.H2O', '400 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(16, 'Besi (II) Klorida', 'FeCl2', '250 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(17, 'Besi (III) Klorida', 'FeCl3', '1400 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(18, 'Besi (II) Sulfat', 'FeSO4.7H2O', '230 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(19, 'Bismut (III) Nitrat', 'Bi(NO3)3', '8 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(20, 'Dinatrium Hidrogen Fosfat', 'Na2HPO4', '100 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(21, 'Eriochrome Black T', 'C20H12N3NaO7S', '1 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(22, 'Ferro Ammonium Sulphat', '(NH4)2Fe(SO4)2', '125 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(23, 'Glukosa', 'C6H12O6', '400 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(24, 'Indikator PP', '', '150 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(25, 'Iodium/Iodine', 'I2', '75 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(26, 'Kalium Bromida', 'KBr', '125 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(27, 'Kalium Klorida', 'KCl', '100 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(28, 'Kalium Dikromat', 'K2Cr2O7', '1000 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(29, 'Kalium Hidroksida', 'KOH', '20 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(30, 'Kalium Iodida', 'KI', '700 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(31, 'Kalium Heksasianoferat', 'K3Fe(CN)6', '50 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(32, 'Kalium Klorat', 'KClO3', '200 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(33, 'Kalium Kromat', 'K2CrO4', '150 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(34, 'Kalium Natrium Tartarat / garam Rochelle', 'KNaC4H4O6·4H2O', '50 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(35, 'Kalium Permanganat', 'KMnO4', '500 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(36, 'Kalium Tiosianat', 'KSCN', '50 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(37, 'Kalsium Karbonat', 'CaCO3', '400 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(38, 'Kalsium Hidroksida', 'Ca(OH)2', '80 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(39, 'Kalsium Nitrat', 'Ca(NO3)2', '80 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(40, 'Kobalt (II) Klorida', 'CoCl2', '400 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(41, 'Kobalt (II) Nitrat', 'Co(NO3)2', '10 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(42, 'Magnesium bubuk', '', '30 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(43, 'Magnesium Nitrat', 'Mg(NO3)2', '10 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(44, 'Magnesium Sulfat', 'MgSO4', '10 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(45, 'Mangan (II) Klorida', 'MnCl2', '30 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(46, 'Merkuri (II) Klorida', 'HgCl2', '10 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(47, 'Natrium Asetat', 'CH3COONa', '200 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(48, 'Natrium Bikarbonat', 'NaHCO3', '100 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(49, 'Natrium Hidroksida', 'NaOH', '1000 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(50, 'Natrium Karbonat', 'Na2CO3', '500 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(51, 'Natrium Klorida', 'NaCl', 'Habis', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(52, 'Natrium Nitrat', 'NaNO3', '50 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(53, 'Natrium Nitrit', 'NaNO2', '100 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(54, 'Natrium Oksalat', 'Na2C2O4', '50 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(55, 'Natrium Sulfat', 'Na2SO4', '900 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(56, 'Natrium Sulfida', 'Na2S', '230 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(57, 'Natrium Thiosulfat', 'Na2S2O3', '50 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(58, 'Nikel (II) Sulfat Heksahidrat', 'NiSO4.6H2O', '10 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(59, 'Nutrient Agar', '', '', NULL, NULL, NULL, NULL, 'Kadaluarsa', NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(60, 'Nutrient Broth', '', '', NULL, NULL, NULL, NULL, 'Kadaluarsa', NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(61, 'Peptone Water', '', '', NULL, NULL, NULL, NULL, 'Kadaluarsa', NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(62, 'Phenolftalein', 'C20H14O4', '25 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(63, 'Serbuk Aluminium', 'Al', '50 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(64, 'Silver Nitrat (perak Nitrat)', 'AgNO3', 'Kosong', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(65, 'Dinatrium Dihidrogen Phospat', 'NaH2PO4', '100 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(66, 'Sukrosa', 'C12H22O11', '125 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(67, 'Tembaga (II) Oksida', 'CuO', '20 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(68, 'Tembaga (II) Sulfat', 'CuSO4', '425 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(69, 'Tembaga nitrat', 'Cu(NO3)2', '100 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(70, 'Tembaga Serbuk', 'Cu', '100 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(71, 'Timbal (II) Asetat', 'SnCl4', '300 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(72, 'Timbal (II) Oksida', 'Pb(NO3)2', '200 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(73, 'Timbal (II) Nitrat', 'Pb(NO3)2', '200 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(74, 'Titriplex (EDTA)', 'C10H14N2Na2O8.2H2O', '50 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(75, 'Zink Nitrat', 'Zn(NO3)2', '50 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(76, 'Zink Serbuk', 'Zn', '125 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43'),
(77, 'Zink Sulfat', 'ZnSO4', '250 g', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-10 14:53:43', '2025-06-10 14:53:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1751358493),
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1751358493;', 1751358493),
('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1751352545),
('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1751352545;', 1751352545);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_26_012157_create_bahan_cairan_lamas_table', 1),
(5, '2025_06_01_111551_create_bahan_padats_table', 2),
(6, '2025_06_11_020345_create_alats_table', 3),
(8, '2025_07_01_072816_add_images_column_to_alats_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8SywHcw9Yj5E2lbtLzpo4UpZynrTg4T7nh0qq8VW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoicTZMdDNCV1BLRUtOaEtoTlVkOHB4Tmcxa2RMM0pwT3FreHBrQ3V3aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9leHBvcnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJG91c3FCeDRPUVFReC9ucUc2Rm5mVHU5R3ZtalFJTGVOcXEzWU1WRnpuenRzZDY3UHdHd2FHIjtzOjg6ImZpbGFtZW50IjthOjA6e319', 1751359446);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$ousqBx4OQQQx/nqG6FnfTu9GvmjQILeNqq3YMVFznztsd67PwGwaG', NULL, '2025-05-28 05:32:19', '2025-05-28 05:32:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alats`
--
ALTER TABLE `alats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bahan_cairan_lamas`
--
ALTER TABLE `bahan_cairan_lamas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bahan_padats`
--
ALTER TABLE `bahan_padats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alats`
--
ALTER TABLE `alats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `bahan_cairan_lamas`
--
ALTER TABLE `bahan_cairan_lamas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `bahan_padats`
--
ALTER TABLE `bahan_padats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
