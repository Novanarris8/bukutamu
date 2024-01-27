-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2024 at 10:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buku_tamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `kode_admin` char(10) NOT NULL,
  `nip` char(15) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `jk` char(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_telp` char(14) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `kode_admin`, `nip`, `nama_admin`, `jk`, `email`, `alamat`, `no_telp`, `foto`) VALUES
(1, 'KP-01', '2010010241', 'Andini1', '1', 'auliaandini532@gmail.com', 'Jl.Kelayan B Gang Setia Rahman No.22 Rt.10 Banjarmasin,Kalimantan Selatan', '0899', '65b4b7d13b2a0.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_konsumsi`
--

CREATE TABLE `tbl_konsumsi` (
  `id_konsumsi` int(11) NOT NULL,
  `id_pemohon` int(11) DEFAULT NULL,
  `makanan_konsumsi` varchar(11) NOT NULL,
  `harga_konsumsi` varchar(11) NOT NULL,
  `total_konsumsi` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_konsumsi`
--

INSERT INTO `tbl_konsumsi` (`id_konsumsi`, `id_pemohon`, `makanan_konsumsi`, `harga_konsumsi`, `total_konsumsi`) VALUES
(37, 23, 'Nasi Goreng', '10000', '20000'),
(38, 24, 'Nasi Padang', '20000', '40000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip_pegawai` varchar(100) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `ttl_pegawai` varchar(100) NOT NULL,
  `jabatan_pegawai` varchar(100) NOT NULL,
  `alamat_pegawai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nip_pegawai`, `nama_pegawai`, `ttl_pegawai`, `jabatan_pegawai`, `alamat_pegawai`) VALUES
(2, '196801152015011002', 'Ari Yani,M.H', '1968-01-15', 'Kepala Dinas', 'Jl.Kelayan B Gang Setia Rahman'),
(3, '197703142020071001', 'Gita Safitri,S.M', '1977-03-14', 'Kepala Bidang Pengaduan', 'Jl.Surgi Mufti');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemohon`
--

CREATE TABLE `tbl_pemohon` (
  `id_pemohon` int(11) NOT NULL,
  `id_daftar` int(11) NOT NULL,
  `kode_user` char(11) NOT NULL,
  `asal_pemohon` varchar(100) NOT NULL,
  `namarekan_pemohon` varchar(100) NOT NULL,
  `jumlahtamu_pemohon` varchar(100) NOT NULL,
  `perihal_pemohon` varchar(100) NOT NULL,
  `surat_pemohon` varchar(100) NOT NULL,
  `status_pemohon` varchar(100) NOT NULL,
  `alasan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pemohon`
--

INSERT INTO `tbl_pemohon` (`id_pemohon`, `id_daftar`, `kode_user`, `asal_pemohon`, `namarekan_pemohon`, `jumlahtamu_pemohon`, `perihal_pemohon`, `surat_pemohon`, `status_pemohon`, `alasan`) VALUES
(23, 5, 'KT-012', 'UNISKA', 'Triana', '2', 'Konsultasi PKL', 'CV Dina.pdf', 'Di Verifikasi', ''),
(24, 8, 'KT-012', 'UNISKA', 'Ratu', '12', 'Acara Menyanyi', 'CV Dina.pdf', 'Menunggu', ''),
(25, 8, 'KT-012', 'UNISKA', 'Ratu', '12', 'Acara Menyanyi', 'CV Dina.pdf', 'Tolak', ''),
(27, 5, 'KT-013', 'we', 'we', 'we', 'we', 'Work Assignment & Final Project Template [BATCH 4].pdf', 'Tolak', 'Berkas Tidak Lengkap'),
(28, 5, 'KT-013', 'UMB', 'Novan', '2', 'Gabut', 'Work Assignment & Final Project Template [BATCH 4].pdf', 'Di Verifikasi', ''),
(29, 8, 'KT-013', 'Kelurahan Surgi Mufti', 'Triana ', '2', 'Gabut', 'pdf.pdf', 'Di Verifikasi', ''),
(30, 9, 'KT-029', 'BPJS KETANAGAKERJAAN', 'Novan Arri Setiadi', '2', 'Rapat', 'Novan.pdf', 'Tolak', 'Berkas Tidak Lengkap');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendaftaran`
--

CREATE TABLE `tbl_pendaftaran` (
  `id_daftar` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `jam_daftar` varchar(20) NOT NULL,
  `status_daftar` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pendaftaran`
--

INSERT INTO `tbl_pendaftaran` (`id_daftar`, `id_pegawai`, `tanggal_daftar`, `jam_daftar`, `status_daftar`) VALUES
(5, 3, '2024-01-23', '11.00', '2'),
(8, 2, '2024-02-03', '10:55', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id` int(11) NOT NULL,
  `kode_pengguna` char(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `peran` enum('ADMIN','USER') DEFAULT NULL,
  `login_terakhir` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `konfirmasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id`, `kode_pengguna`, `username`, `password`, `peran`, `login_terakhir`, `konfirmasi`) VALUES
(1, 'KP-01', 'admin1', '$2y$10$rV4vxMNMljhfd0krwbTDhugABZFHaDG64dyu5YZpeXsnI91SjErnK', 'ADMIN', '2024-01-27 08:40:04', 1),
(11, 'KT-012', 'andini', '$2y$10$a5O8gQh3sWBFRh4KQtxOqeyZwfjlncU7hnhauyPbRoLZuQXWwrKPm', 'USER', '2024-01-27 05:26:03', 1),
(27, 'KT-013', 'ayra', '$2y$10$tFYGylvnMqDBuvUp7JMkEeNw9qz4wEhm9b6ITYes1nqVVxlbPrjeK', 'USER', '2024-01-27 08:15:37', 1),
(28, 'KT-028', 'ratu', '$2y$10$Y3aTPBwjON5GduquVwusaejhyMV27E9jmIuJfmyZxePgJhYES8g1u', 'USER', '2024-01-27 06:11:25', 1),
(29, 'KT-029', 'novan', '$2y$10$WcrZyBU16T53IEtn9JYms.58c2jpiqvT27Ub1cUQFhnuGUKKEI2NS', 'USER', '2024-01-27 07:15:21', 1),
(31, 'KT-030', 'nita', '$2y$10$nU0CbCSpDLBX7AKy3zNOGOi4G5NAkeqTZwQlS0HGN0Z0lVaF.L7Z.', 'USER', '2024-01-27 09:00:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `kode_user` char(10) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `jk` char(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `kode_user`, `nama_user`, `jk`, `email`, `alamat`, `no_telp`, `foto`) VALUES
(1, 'KT-012', 'andini', '2', 'andini@gmail.com', 'Jl.Kelayan', '0892', '65ae6ebf880d4.png'),
(2, 'KT-013', 'andini', '2', 'andini@gmail.com', 'Jl.Kelayan', '0892', '65b4b4351acf8.png'),
(3, 'KT-029', 'Novan Arri Setiadi', '1', 'Novanarris@gmail.com', 'Jl.Sukamara 3', '089790907878', ''),
(4, 'KT-030', '', '', '', '', '', ''),
(5, 'KT-030', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_konsumsi`
--
ALTER TABLE `tbl_konsumsi`
  ADD PRIMARY KEY (`id_konsumsi`),
  ADD KEY `id_pemohon` (`id_pemohon`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `tbl_pemohon`
--
ALTER TABLE `tbl_pemohon`
  ADD PRIMARY KEY (`id_pemohon`),
  ADD KEY `id_pegawai` (`id_daftar`);

--
-- Indexes for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  ADD PRIMARY KEY (`id_daftar`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_konsumsi`
--
ALTER TABLE `tbl_konsumsi`
  MODIFY `id_konsumsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pemohon`
--
ALTER TABLE `tbl_pemohon`
  MODIFY `id_pemohon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  MODIFY `id_daftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
