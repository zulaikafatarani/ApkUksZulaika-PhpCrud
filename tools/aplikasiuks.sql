-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 05, 2026 at 03:10 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasiuks`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idbarang` int NOT NULL,
  `idkategori` int NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `satuan` varchar(50) NOT NULL DEFAULT 'pcs',
  `tanggalkadaluarsa` date NOT NULL,
  `tanggalmasuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idbarang`, `idkategori`, `namabarang`, `stok`, `satuan`, `tanggalkadaluarsa`, `tanggalmasuk`) VALUES
(1, 1, 'Antalgin 500mg', 150, 'Tablet', '2028-06-20', '2026-09-26'),
(2, 2, 'Amoxicillin 500mg', 80, 'Tablet', '2027-11-15', '2026-09-26'),
(3, 3, 'Tensimeter Digital', 4, 'Unit', '2036-01-01', '2026-09-26'),
(4, 4, 'Minyak Kayu Putih 60ml', 25, 'Botol', '2029-03-10', '2026-09-26');

-- --------------------------------------------------------

--
-- Table structure for table `detailpenanganan`
--

CREATE TABLE `detailpenanganan` (
  `iddetailpenanganan` int NOT NULL,
  `idpenanganan` int NOT NULL,
  `idbarang` int NOT NULL,
  `jumlahkeluar` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detailpenanganan`
--

INSERT INTO `detailpenanganan` (`iddetailpenanganan`, `idpenanganan`, `idbarang`, `jumlahkeluar`) VALUES
(1, 1, 1, 2),
(2, 2, 3, 1),
(3, 3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `idguru` int NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `namaguru` varchar(50) NOT NULL,
  `riwayatpenyakit` varchar(50) DEFAULT NULL,
  `jeniskelamin` enum('L','P') NOT NULL,
  `foto` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nohp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idguru`, `nip`, `namaguru`, `riwayatpenyakit`, `jeniskelamin`, `foto`, `alamat`, `nohp`) VALUES
(1, '02331222233', 'Buk Mawar', '-', 'P', 'foto.png', 'Medang Ara', '088888888'),
(2, '02330000000', 'Pak Ahmadi', 'Lambung', 'L', 'foto2.png', 'Karang Baru', '08899999999'),
(3, '02331666666', 'Buk Mnarti', '-', 'P', 'foto3.png', 'Kampung Dalam', '08444444444');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int NOT NULL,
  `namakategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`) VALUES
(1, 'Obat Bebas'),
(2, 'Obat Keras'),
(3, 'Alat Kesehatan'),
(4, 'Peralatan P3K');

-- --------------------------------------------------------

--
-- Table structure for table `penanganan`
--

CREATE TABLE `penanganan` (
  `idpenanganan` int NOT NULL,
  `iduser` int NOT NULL,
  `idsiswa` int DEFAULT NULL,
  `idguru` int DEFAULT NULL,
  `tanggalpenanganan` date NOT NULL,
  `keluhan` varchar(50) NOT NULL,
  `tindakan` varchar(50) NOT NULL,
  `statuspasien` enum('kembali ke kelas','istirahat di uks','pulang','rujuk ke puskesmas/RS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penanganan`
--

INSERT INTO `penanganan` (`idpenanganan`, `iduser`, `idsiswa`, `idguru`, `tanggalpenanganan`, `keluhan`, `tindakan`, `statuspasien`) VALUES
(1, 1, 1, NULL, '2026-09-26', 'Demam tinggi dan pusing', 'Diberikan Antalgin', 'istirahat di uks'),
(2, 1, NULL, 1, '2026-09-26', 'Batuk dan sesak napas', 'Diberikan tabung oksigen', 'rujuk ke puskesmas/RS'),
(3, 2, 2, 2, '2026-09-26', 'Luka lecet akibat jatuh', 'Dibersihkan dan diberi kasa', 'kembali ke kelas');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `idsiswa` int NOT NULL,
  `nis` varchar(30) DEFAULT NULL,
  `namasiswa` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jeniskelamin` enum('L','P') DEFAULT NULL,
  `golongandarah` enum('A','B','AB','O','Tidak Tahu') NOT NULL DEFAULT 'Tidak Tahu',
  `riwayatpenyakit` varchar(50) DEFAULT NULL,
  `riwayatalergi` varchar(50) DEFAULT NULL,
  `foto` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nohp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`idsiswa`, `nis`, `namasiswa`, `kelas`, `jeniskelamin`, `golongandarah`, `riwayatpenyakit`, `riwayatalergi`, `foto`, `alamat`, `nohp`) VALUES
(1, '0103786196', 'Zulaika Fatarani', 'XI RPL 2', 'P', 'B', 'Penyakit Tipes', '-', 'ika.jpeg', 'Medang Ara', '+62 812-6938-9167'),
(2, '0199999996', 'Eka Lisa Apriliani', 'XI RPL 2', 'P', 'Tidak Tahu', 'Lambung', 'Kacang', 'lisa.jpeg', 'Terban', '+62 823-7931-7557'),
(3, '0199000096', 'Novi Yanti', 'XI RPL 1', 'P', 'O', '-', 'Udang', 'novi.jpeg', 'Sekrak Kanan', '+62 822-7519-8932'),
(4, '0199999888', 'Mariescha', 'XI RPL 2', 'P', 'AB', '-', '-', 'memer.jpeg', 'Kuala Simpang', '081234567890');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `namauser` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `role` enum('admin','petugas','anggota') NOT NULL DEFAULT 'petugas',
  `nohp` varchar(30) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `namauser`, `alamat`, `role`, `nohp`, `foto`) VALUES
(1, 'adminuks', '123', 'Buk Ely', 'Karang Baru', 'admin', '089999999912', 'admin.jpeg'),
(2, 'petugaszulaika', '222', 'zulaika fatarani', 'Medang Ara', 'petugas', '081499909912', 'petugas.jpeg'),
(3, 'anggotauks', '333', 'Izza', 'Kuala Simpang', 'anggota', '085559999915', 'anggota.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idbarang`),
  ADD KEY `fkbarangidkategori` (`idkategori`);

--
-- Indexes for table `detailpenanganan`
--
ALTER TABLE `detailpenanganan`
  ADD PRIMARY KEY (`iddetailpenanganan`),
  ADD KEY `fkdetailidpenanganan` (`idpenanganan`),
  ADD KEY `fkdetailidbarang` (`idbarang`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`idguru`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD PRIMARY KEY (`idpenanganan`),
  ADD KEY `fkpenangananiduser` (`iduser`),
  ADD KEY `fkpenangananidsiswa` (`idsiswa`),
  ADD KEY `fkpenangananidguru` (`idguru`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`idsiswa`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `idbarang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detailpenanganan`
--
ALTER TABLE `detailpenanganan`
  MODIFY `iddetailpenanganan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `idguru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penanganan`
--
ALTER TABLE `penanganan`
  MODIFY `idpenanganan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `idsiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fkbarangidkategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `detailpenanganan`
--
ALTER TABLE `detailpenanganan`
  ADD CONSTRAINT `fkdetailidbarang` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fkdetailidpenanganan` FOREIGN KEY (`idpenanganan`) REFERENCES `penanganan` (`idpenanganan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD CONSTRAINT `fkpenangananidguru` FOREIGN KEY (`idguru`) REFERENCES `guru` (`idguru`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fkpenangananidsiswa` FOREIGN KEY (`idsiswa`) REFERENCES `siswa` (`idsiswa`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fkpenangananiduser` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
