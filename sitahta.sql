-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2015 at 09:46 AM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sitahta`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `nip` int(11) NOT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `jenis_kelamin` varchar(3) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `kewenangan` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`nip`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `nama`, `jenis_kelamin`, `alamat`, `email`, `no_telp`, `password`, `kewenangan`) VALUES
(1, 'admin', 'L', 'foo city', 'foo@google.com', '08674839291', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'admin'),
(2, 'guru', 'P', 'Magelang', 'sss@ss.com', '+62874938182', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `hafalan_awal`
--

CREATE TABLE IF NOT EXISTS `hafalan_awal` (
  `nis` int(11) NOT NULL,
  `juz` int(11) NOT NULL,
  PRIMARY KEY (`nis`,`juz`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `no_uh` varchar(3) NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `nis` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `juz` int(11) DEFAULT NULL,
  `halaman` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `penguji` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_uh`,`kelas`,`nis`),
  KEY `fk_nilai_1_idx` (`nis`),
  KEY `fk_nilai_2_idx` (`penguji`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`no_uh`, `kelas`, `nis`, `tanggal`, `juz`, `halaman`, `nilai`, `penguji`) VALUES
('1', 'XI', 1001, '2015-12-12', 4, 4, 78, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_uas`
--

CREATE TABLE IF NOT EXISTS `nilai_uas` (
  `nis` int(11) NOT NULL,
  `kelas` varchar(3) NOT NULL,
  `semester` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`nis`,`kelas`,`semester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_uts`
--

CREATE TABLE IF NOT EXISTS `nilai_uts` (
  `nis` int(11) NOT NULL,
  `kelas` varchar(3) NOT NULL,
  `semester` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`nis`,`kelas`,`semester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikasi`
--

CREATE TABLE IF NOT EXISTS `sertifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` int(11) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `tempat_ujian` varchar(100) DEFAULT NULL,
  `tgl_ujian` date DEFAULT NULL,
  `juz` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `predikat` varchar(15) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sertifikasi_1_idx` (`nis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12349 ;

--
-- Dumping data for table `sertifikasi`
--

INSERT INTO `sertifikasi` (`id`, `nis`, `nama`, `tempat_ujian`, `tgl_ujian`, `juz`, `nilai`, `predikat`, `keterangan`) VALUES
(12345, 1001, 'user', 'SMA IT Ihsanul Fikri Magelang', '2014-12-12', 4, 89, 'Jayyid Jiddan', 'terferifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` int(11) NOT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `jenis_kelamin` varchar(3) DEFAULT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `kelas` varchar(5) DEFAULT NULL,
  `jurusan` varchar(9) DEFAULT NULL,
  `no_kelas` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nama_ortu` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `kelas`, `jurusan`, `no_kelas`, `password`, `nama_ortu`) VALUES
(1001, 'user', 'L', 'magelang', '2000-12-12', 'XI', 'IPS', 2, 'd8578edf8458ce06fbc5bb76a58c5ca4', 'ortu'),
(1002, 'user2', 'P', 'Kebumen', '2001-01-01', 'X', 'Tahfidz', 2, '', 'Orang Tua2'),
(1003, 'User3', 'P', 'Tenggarong', '1999-01-01', 'XII', 'IPS', 2, 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Ortu 3');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hafalan_awal`
--
ALTER TABLE `hafalan_awal`
  ADD CONSTRAINT `fk_hafalan_awal_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `fk_nilai_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_2` FOREIGN KEY (`penguji`) REFERENCES `guru` (`nip`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `nilai_uas`
--
ALTER TABLE `nilai_uas`
  ADD CONSTRAINT `fk_nilai_uas_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nilai_uts`
--
ALTER TABLE `nilai_uts`
  ADD CONSTRAINT `fk_nilai_uts_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sertifikasi`
--
ALTER TABLE `sertifikasi`
  ADD CONSTRAINT `fk_sertifikasi_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
