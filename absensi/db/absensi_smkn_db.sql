-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Feb 06, 2023 at 10:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_smkn_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_siswa`
--

CREATE TABLE `absensi_siswa` (
  `id_absensi` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `ruangan` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `jurusan` int(11) NOT NULL,
  `ta` int(11) NOT NULL,
  `tgl_absensi` date NOT NULL,
  `jam_absensi` int(11) NOT NULL,
  `absensi` varchar(3) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi_siswa`
--

INSERT INTO `absensi_siswa` (`id_absensi`, `siswa`, `ruangan`, `guru`, `jurusan`, `ta`, `tgl_absensi`, `jam_absensi`, `absensi`, `keterangan`) VALUES
(26, 10, 2, 25, 4, 2, '2023-02-06', 1, 'H', ''),
(27, 10, 2, 25, 4, 2, '2023-02-06', 2, 'H', ''),
(28, 10, 2, 25, 4, 2, '2023-02-09', 1, 'H', '');

-- --------------------------------------------------------

--
-- Table structure for table `biodata_guru`
--

CREATE TABLE `biodata_guru` (
  `id_guru` int(11) NOT NULL,
  `nip_guru` varchar(18) NOT NULL,
  `nama_guru` varchar(60) NOT NULL,
  `jenis_kelamin_guru` varchar(3) NOT NULL,
  `tgl_lahir_guru` date NOT NULL,
  `alamat_guru` varchar(120) NOT NULL,
  `pendidikan_guru` varchar(60) NOT NULL,
  `status_guru` varchar(30) NOT NULL,
  `jabatan_guru` varchar(60) NOT NULL,
  `telepon_guru` varchar(15) NOT NULL,
  `foto_guru` varchar(120) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biodata_guru`
--

INSERT INTO `biodata_guru` (`id_guru`, `nip_guru`, `nama_guru`, `jenis_kelamin_guru`, `tgl_lahir_guru`, `alamat_guru`, `pendidikan_guru`, `status_guru`, `jabatan_guru`, `telepon_guru`, `foto_guru`, `username`, `password`) VALUES
(1, '12345678', 'Azmi Kurniawan', 'L', '0000-00-00', 'Labuah Luruih', 'Sistem Informasi', 'admin', 'admin', '0', 'azmiGonzalo.PNG', 'admin', 'admin'),
(23, '197707052008011006', 'edi supanri, s.pd, m.pd.t', 'L', '2023-02-01', 'Simpang Empat', 'Teknik Informatika', 'pns', 'kepala sekolah', '08xxxxx', 'zMen.png', 'edi supanri, s.pd, m.pd.t', 'edisup87466'),
(24, '198111212011012006', 'desi novita, s.pd', 'P', '2023-02-01', 'Simpang Empat', 'Teknik Informatika', 'pns', 'Wakil Kurikulum/PP', '08xxxxx', 'zWomen.png', 'desi novita, s.pd', 'desinov28782'),
(25, '123', 'hehe', 'L', '2023-02-01', 'Simpang Empat', 'Teknik Informatika', 'pns', '', '08xxxxx', 'hehe.jpg', 'hehe', 'hehe420610'),
(26, '555555', 'hmhm', 'L', '2023-02-02', 'Simpang Empat', 'Teknik Informatika', 'pns', '', '08xxxxx', 'aTopeng.png', 'hmhm', 'hmh490811');

-- --------------------------------------------------------

--
-- Table structure for table `biodata_sekolah`
--

CREATE TABLE `biodata_sekolah` (
  `id_biodata_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(120) NOT NULL,
  `alamat_sekolah` varchar(120) NOT NULL,
  `photo_sekolah` varchar(120) NOT NULL,
  `email_sekolah` varchar(120) NOT NULL,
  `telepon_sekolah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biodata_sekolah`
--

INSERT INTO `biodata_sekolah` (`id_biodata_sekolah`, `nama_sekolah`, `alamat_sekolah`, `photo_sekolah`, `email_sekolah`, `telepon_sekolah`) VALUES
(1, 'smk n 1 pasaman', 'jalur baru', 'logosmk.png', 'smkn1pasaman@gmail.com', 812433355);

-- --------------------------------------------------------

--
-- Table structure for table `biodata_siswa`
--

CREATE TABLE `biodata_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis_siswa` varchar(120) NOT NULL,
  `nama_siswa` varchar(120) NOT NULL,
  `jenis_kelamin_siswa` varchar(120) NOT NULL,
  `tgl_lahir_siswa` date NOT NULL,
  `alamat_siswa` varchar(120) NOT NULL,
  `kelas_siswa` varchar(120) NOT NULL,
  `ruangan_siswa` int(11) NOT NULL,
  `jurusan_siswa` int(11) NOT NULL,
  `telepon_siswa` varchar(120) NOT NULL,
  `foto_siswa` varchar(300) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biodata_siswa`
--

INSERT INTO `biodata_siswa` (`id_siswa`, `nis_siswa`, `nama_siswa`, `jenis_kelamin_siswa`, `tgl_lahir_siswa`, `alamat_siswa`, `kelas_siswa`, `ruangan_siswa`, `jurusan_siswa`, `telepon_siswa`, `foto_siswa`, `username`, `password`) VALUES
(10, '213', 'revami hatsune', 'P', '2023-02-01', 'Simpang Empat', 'X', 2, 4, '08xxxxx', '1042061.jpg', 'revami hatsune', 'revami74341');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_mengajar`
--

CREATE TABLE `jadwal_mengajar` (
  `id_jadwal` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `ruangan` int(11) NOT NULL,
  `jurusan` int(11) NOT NULL,
  `ta` int(11) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_berakhir` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_mengajar`
--

INSERT INTO `jadwal_mengajar` (`id_jadwal`, `guru`, `mapel`, `kelas`, `ruangan`, `jurusan`, `ta`, `hari`, `jam_mulai`, `jam_berakhir`) VALUES
(2, 25, 4, 'X', 2, 4, 2, 'SENIN', '03:16:00', '09:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(120) NOT NULL,
  `kosentrasi_jurusan` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `kosentrasi_jurusan`) VALUES
(4, 'Akuntansi', '');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(120) NOT NULL,
  `kosentrasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`, `kosentrasi`) VALUES
(4, 'Matematika', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `kelas` varchar(3) NOT NULL,
  `nama_ruangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `guru`, `kelas`, `nama_ruangan`) VALUES
(2, 25, 'X', 'Akuntansi'),
(3, 26, 'XI', 'Akuntansi');

-- --------------------------------------------------------

--
-- Table structure for table `ta`
--

CREATE TABLE `ta` (
  `id_ta` int(11) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `tahun_ajaran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ta`
--

INSERT INTO `ta` (`id_ta`, `semester`, `tahun_ajaran`) VALUES
(2, 'GENAP', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `tugas_tambahan`
--

CREATE TABLE `tugas_tambahan` (
  `id_tugas_tambahan` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `nama_tugas_tambahan` varchar(120) NOT NULL,
  `kelas_tugas_tambahan` varchar(3) NOT NULL,
  `jam_tugas_tambahan` int(11) NOT NULL,
  `ta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas_tambahan`
--

INSERT INTO `tugas_tambahan` (`id_tugas_tambahan`, `guru`, `nama_tugas_tambahan`, `kelas_tugas_tambahan`, `jam_tugas_tambahan`, `ta`) VALUES
(5, 25, 'mamanuang', 'X', 24, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_siswa`
--
ALTER TABLE `absensi_siswa`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `biodata_guru`
--
ALTER TABLE `biodata_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `biodata_sekolah`
--
ALTER TABLE `biodata_sekolah`
  ADD PRIMARY KEY (`id_biodata_sekolah`);

--
-- Indexes for table `biodata_siswa`
--
ALTER TABLE `biodata_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `ta`
--
ALTER TABLE `ta`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indexes for table `tugas_tambahan`
--
ALTER TABLE `tugas_tambahan`
  ADD PRIMARY KEY (`id_tugas_tambahan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi_siswa`
--
ALTER TABLE `absensi_siswa`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `biodata_guru`
--
ALTER TABLE `biodata_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `biodata_sekolah`
--
ALTER TABLE `biodata_sekolah`
  MODIFY `id_biodata_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `biodata_siswa`
--
ALTER TABLE `biodata_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ta`
--
ALTER TABLE `ta`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tugas_tambahan`
--
ALTER TABLE `tugas_tambahan`
  MODIFY `id_tugas_tambahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
