-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 21 Jul 2020 pada 16.06
-- Versi Server: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asets`
--

DROP TABLE IF EXISTS `asets`;
CREATE TABLE IF NOT EXISTS `asets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodebarang` varchar(25) NOT NULL,
  `namabarang` varchar(250) NOT NULL,
  `merk` varchar(250) DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL,
  `idtipe` varchar(25) DEFAULT NULL,
  `idbahan` varchar(25) DEFAULT NULL,
  `tanggal` varchar(25) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `harga` float NOT NULL,
  `unit` int(15) NOT NULL DEFAULT '0',
  `idkondisi` int(11) NOT NULL,
  `keterangan` text,
  `foto` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kodebarang` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `asets_non_ruangan_view`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `asets_non_ruangan_view`;
CREATE TABLE IF NOT EXISTS `asets_non_ruangan_view` (
`kodebarang` varchar(25)
,`namabarang` varchar(250)
,`merk` varchar(250)
,`ukuran` varchar(100)
,`tipe` varchar(250)
,`bahan` varchar(250)
,`tanggal` varchar(25)
,`tahun` varchar(5)
,`harga` float
,`unit` int(15)
,`kondisi` varchar(150)
,`keterangan` text
,`foto` text
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `asets_ruangan`
--

DROP TABLE IF EXISTS `asets_ruangan`;
CREATE TABLE IF NOT EXISTS `asets_ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodebarang` varchar(25) NOT NULL,
  `idruangan` int(11) NOT NULL,
  `namabarang` varchar(250) NOT NULL,
  `merk` varchar(250) DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL,
  `idtipe` varchar(25) DEFAULT NULL,
  `idbahan` varchar(25) DEFAULT NULL,
  `tanggal` varchar(25) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `harga` float NOT NULL,
  `unit` int(15) NOT NULL DEFAULT '0',
  `idkondisi` int(11) NOT NULL,
  `keterangan` text,
  `foto` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kodebarang` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `asets_ruangan_view`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `asets_ruangan_view`;
CREATE TABLE IF NOT EXISTS `asets_ruangan_view` (
`kodebarang` varchar(25)
,`idruangan` int(11)
,`nama_ruangan` varchar(250)
,`namabarang` varchar(250)
,`merk` varchar(250)
,`ukuran` varchar(100)
,`tipe` varchar(250)
,`bahan` varchar(250)
,`tanggal` varchar(25)
,`tahun` varchar(5)
,`harga` float
,`unit` int(15)
,`kondisi` varchar(150)
,`keterangan` text
,`foto` text
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_asets`
--

DROP TABLE IF EXISTS `bahan_asets`;
CREATE TABLE IF NOT EXISTS `bahan_asets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bahan` varchar(250) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan_asets`
--

INSERT INTO `bahan_asets` (`id`, `bahan`, `keterangan`) VALUES
(1, 'Kayu', NULL),
(2, 'Partikel Pres', NULL),
(3, 'Besi', NULL),
(4, 'Besi + Busa', NULL),
(5, 'Stainless', NULL),
(6, 'Stainless + Busa', NULL),
(7, 'Kayu + Busa', NULL),
(8, 'Kaca', NULL),
(9, 'Triplek', NULL),
(10, 'Plastik', ''),
(11, 'Fiber', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_kondisi`
--

DROP TABLE IF EXISTS `list_kondisi`;
CREATE TABLE IF NOT EXISTS `list_kondisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kondisi` varchar(150) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `list_kondisi`
--

INSERT INTO `list_kondisi` (`id`, `kondisi`, `keterangan`) VALUES
(1, 'BAIK', 'Kondisi barang masih sangat bagus.'),
(2, 'KURANG BAIK', 'Kondisi barang sudah mengalami kerusakan, tapi masih layak digunakan'),
(3, 'RUSAK BERAT', 'Kondisi barang sudah tidak dapat digunakan.'),
(4, 'TIDAK DIKETAHUI', 'Barang hilang, Bangunan perbaikan, dll');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi`
--

DROP TABLE IF EXISTS `mutasi`;
CREATE TABLE IF NOT EXISTS `mutasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodebarang_lama` varchar(25) NOT NULL,
  `kodebarang_baru` varchar(25) NOT NULL,
  `idruangan_lama` int(11) DEFAULT NULL,
  `idruangan_baru` int(11) DEFAULT NULL,
  `tanggal` varchar(25) DEFAULT NULL,
  `keterangan` text,
  `user_posting` varchar(35) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kodebarang_baru` (`kodebarang_baru`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `mutasi_view`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `mutasi_view`;
CREATE TABLE IF NOT EXISTS `mutasi_view` (
`id` int(11)
,`kodebarang_lama` varchar(25)
,`kodebarang_baru` varchar(25)
,`idruangan_lama` int(11)
,`idruangan_baru` int(11)
,`tanggal` varchar(25)
,`keterangan` text
,`user_posting` varchar(35)
,`ruangan_lama` varchar(250)
,`ruangan_baru` varchar(250)
,`namabarang` varchar(250)
,`merk` varchar(250)
,`ukuran` varchar(100)
,`tipe` varchar(250)
,`bahan` varchar(250)
,`tanggal_entri` varchar(25)
,`tahun` varchar(5)
,`harga` float
,`unit` int(15)
,`kondisi` varchar(150)
,`foto` text
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `idpeminjaman` varchar(25) NOT NULL,
  `kodeasets` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tanggalpinjam` varchar(25) NOT NULL,
  `tanggalkembali` varchar(25) NOT NULL,
  `status` enum('Masih Dipinjam','Sudah Kembali','Dibatalkan') NOT NULL DEFAULT 'Masih Dipinjam',
  PRIMARY KEY (`idpeminjaman`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `peminjaman_asets_ruangan_view`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `peminjaman_asets_ruangan_view`;
CREATE TABLE IF NOT EXISTS `peminjaman_asets_ruangan_view` (
`idpeminjaman` varchar(25)
,`kodeasets` varchar(25)
,`username` varchar(50)
,`tanggalpinjam` varchar(25)
,`tanggalkembali` varchar(25)
,`status` enum('Masih Dipinjam','Sudah Kembali','Dibatalkan')
,`id` int(11)
,`kodebarang` varchar(25)
,`idruangan` int(11)
,`namabarang` varchar(250)
,`merk` varchar(250)
,`ukuran` varchar(100)
,`idtipe` varchar(25)
,`idbahan` varchar(25)
,`tanggal` varchar(25)
,`tahun` varchar(5)
,`harga` float
,`unit` int(15)
,`idkondisi` int(11)
,`keterangan` text
,`foto` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `peminjaman_asets_view`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `peminjaman_asets_view`;
CREATE TABLE IF NOT EXISTS `peminjaman_asets_view` (
`idpeminjaman` varchar(25)
,`kodeasets` varchar(25)
,`username` varchar(50)
,`tanggalpinjam` varchar(25)
,`tanggalkembali` varchar(25)
,`status` enum('Masih Dipinjam','Sudah Kembali','Dibatalkan')
,`id` int(11)
,`kodebarang` varchar(25)
,`namabarang` varchar(250)
,`merk` varchar(250)
,`ukuran` varchar(100)
,`idtipe` varchar(25)
,`idbahan` varchar(25)
,`tanggal` varchar(25)
,`tahun` varchar(5)
,`harga` float
,`unit` int(15)
,`idkondisi` int(11)
,`keterangan` text
,`foto` text
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE IF NOT EXISTS `ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(250) NOT NULL,
  `lokasi` text,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `semua_asets_view`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `semua_asets_view`;
CREATE TABLE IF NOT EXISTS `semua_asets_view` (
`kodebarang` varchar(25)
,`namabarang` varchar(250)
,`merk` varchar(250)
,`ukuran` varchar(100)
,`tipe` varchar(250)
,`bahan` varchar(250)
,`tanggal` varchar(25)
,`tahun` varchar(5)
,`harga` float
,`unit` int(15)
,`kondisi` varchar(150)
,`keterangan` text
,`foto` text
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_asets`
--

DROP TABLE IF EXISTS `tipe_asets`;
CREATE TABLE IF NOT EXISTS `tipe_asets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(250) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe_asets`
--

INSERT INTO `tipe_asets` (`id`, `tipe`, `keterangan`) VALUES
(1, 'BANGUNAN', 'Harta benda sejenis bangunan atau tanah.'),
(2, 'BUKAN BANGUNAN', 'Benda yang dapat dipindahkan. Misal : Komputer, Ac, dll'),
(3, 'KENDARAAN', 'Mobil, motor, dll');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(35) NOT NULL,
  `password` varchar(55) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `telepon` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `nama`, `email`, `telepon`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator', 'admin@mail.com', '+6280909090');

-- --------------------------------------------------------

--
-- Struktur untuk view `asets_non_ruangan_view`
--
DROP TABLE IF EXISTS `asets_non_ruangan_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `asets_non_ruangan_view`  AS  (select `asets`.`kodebarang` AS `kodebarang`,`asets`.`namabarang` AS `namabarang`,`asets`.`merk` AS `merk`,`asets`.`ukuran` AS `ukuran`,`tipe_asets`.`tipe` AS `tipe`,`bahan_asets`.`bahan` AS `bahan`,`asets`.`tanggal` AS `tanggal`,`asets`.`tahun` AS `tahun`,`asets`.`harga` AS `harga`,`asets`.`unit` AS `unit`,`list_kondisi`.`kondisi` AS `kondisi`,`asets`.`keterangan` AS `keterangan`,`asets`.`foto` AS `foto` from (((`asets` left join `tipe_asets` on((`asets`.`idtipe` = `tipe_asets`.`id`))) left join `bahan_asets` on((`asets`.`idbahan` = `bahan_asets`.`id`))) left join `list_kondisi` on((`asets`.`idkondisi` = `list_kondisi`.`id`)))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `asets_ruangan_view`
--
DROP TABLE IF EXISTS `asets_ruangan_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `asets_ruangan_view`  AS  (select `asets_ruangan`.`kodebarang` AS `kodebarang`,`asets_ruangan`.`idruangan` AS `idruangan`,`ruangan`.`nama_ruangan` AS `nama_ruangan`,`asets_ruangan`.`namabarang` AS `namabarang`,`asets_ruangan`.`merk` AS `merk`,`asets_ruangan`.`ukuran` AS `ukuran`,`tipe_asets`.`tipe` AS `tipe`,`bahan_asets`.`bahan` AS `bahan`,`asets_ruangan`.`tanggal` AS `tanggal`,`asets_ruangan`.`tahun` AS `tahun`,`asets_ruangan`.`harga` AS `harga`,`asets_ruangan`.`unit` AS `unit`,`list_kondisi`.`kondisi` AS `kondisi`,`asets_ruangan`.`keterangan` AS `keterangan`,`asets_ruangan`.`foto` AS `foto` from ((((`asets_ruangan` left join `ruangan` on((`asets_ruangan`.`idruangan` = `ruangan`.`id`))) left join `tipe_asets` on((`asets_ruangan`.`idtipe` = `tipe_asets`.`id`))) left join `bahan_asets` on((`asets_ruangan`.`idbahan` = `bahan_asets`.`id`))) left join `list_kondisi` on((`asets_ruangan`.`idkondisi` = `list_kondisi`.`id`)))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `mutasi_view`
--
DROP TABLE IF EXISTS `mutasi_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mutasi_view`  AS  select `mutasi`.`id` AS `id`,`mutasi`.`kodebarang_lama` AS `kodebarang_lama`,`mutasi`.`kodebarang_baru` AS `kodebarang_baru`,`mutasi`.`idruangan_lama` AS `idruangan_lama`,`mutasi`.`idruangan_baru` AS `idruangan_baru`,`mutasi`.`tanggal` AS `tanggal`,`mutasi`.`keterangan` AS `keterangan`,`mutasi`.`user_posting` AS `user_posting`,`truangan_lama`.`nama_ruangan` AS `ruangan_lama`,`truangan_baru`.`nama_ruangan` AS `ruangan_baru`,`semua_asets_view`.`namabarang` AS `namabarang`,`semua_asets_view`.`merk` AS `merk`,`semua_asets_view`.`ukuran` AS `ukuran`,`semua_asets_view`.`tipe` AS `tipe`,`semua_asets_view`.`bahan` AS `bahan`,`semua_asets_view`.`tanggal` AS `tanggal_entri`,`semua_asets_view`.`tahun` AS `tahun`,`semua_asets_view`.`harga` AS `harga`,`semua_asets_view`.`unit` AS `unit`,`semua_asets_view`.`kondisi` AS `kondisi`,`semua_asets_view`.`foto` AS `foto` from (((`mutasi` left join `ruangan` `truangan_lama` on((`mutasi`.`idruangan_lama` = `truangan_lama`.`id`))) left join `ruangan` `truangan_baru` on((`mutasi`.`idruangan_baru` = `truangan_baru`.`id`))) left join `semua_asets_view` on((`mutasi`.`kodebarang_baru` = `semua_asets_view`.`kodebarang`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `peminjaman_asets_ruangan_view`
--
DROP TABLE IF EXISTS `peminjaman_asets_ruangan_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `peminjaman_asets_ruangan_view`  AS  select `peminjaman`.`idpeminjaman` AS `idpeminjaman`,`peminjaman`.`kodeasets` AS `kodeasets`,`peminjaman`.`username` AS `username`,`peminjaman`.`tanggalpinjam` AS `tanggalpinjam`,`peminjaman`.`tanggalkembali` AS `tanggalkembali`,`peminjaman`.`status` AS `status`,`asets_ruangan`.`id` AS `id`,`asets_ruangan`.`kodebarang` AS `kodebarang`,`asets_ruangan`.`idruangan` AS `idruangan`,`asets_ruangan`.`namabarang` AS `namabarang`,`asets_ruangan`.`merk` AS `merk`,`asets_ruangan`.`ukuran` AS `ukuran`,`asets_ruangan`.`idtipe` AS `idtipe`,`asets_ruangan`.`idbahan` AS `idbahan`,`asets_ruangan`.`tanggal` AS `tanggal`,`asets_ruangan`.`tahun` AS `tahun`,`asets_ruangan`.`harga` AS `harga`,`asets_ruangan`.`unit` AS `unit`,`asets_ruangan`.`idkondisi` AS `idkondisi`,`asets_ruangan`.`keterangan` AS `keterangan`,`asets_ruangan`.`foto` AS `foto` from (`peminjaman` join `asets_ruangan` on((`peminjaman`.`kodeasets` = `asets_ruangan`.`kodebarang`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `peminjaman_asets_view`
--
DROP TABLE IF EXISTS `peminjaman_asets_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `peminjaman_asets_view`  AS  select `peminjaman`.`idpeminjaman` AS `idpeminjaman`,`peminjaman`.`kodeasets` AS `kodeasets`,`peminjaman`.`username` AS `username`,`peminjaman`.`tanggalpinjam` AS `tanggalpinjam`,`peminjaman`.`tanggalkembali` AS `tanggalkembali`,`peminjaman`.`status` AS `status`,`asets`.`id` AS `id`,`asets`.`kodebarang` AS `kodebarang`,`asets`.`namabarang` AS `namabarang`,`asets`.`merk` AS `merk`,`asets`.`ukuran` AS `ukuran`,`asets`.`idtipe` AS `idtipe`,`asets`.`idbahan` AS `idbahan`,`asets`.`tanggal` AS `tanggal`,`asets`.`tahun` AS `tahun`,`asets`.`harga` AS `harga`,`asets`.`unit` AS `unit`,`asets`.`idkondisi` AS `idkondisi`,`asets`.`keterangan` AS `keterangan`,`asets`.`foto` AS `foto` from (`peminjaman` join `asets` on((`peminjaman`.`kodeasets` = `asets`.`kodebarang`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `semua_asets_view`
--
DROP TABLE IF EXISTS `semua_asets_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `semua_asets_view`  AS  (select `asets_ruangan`.`kodebarang` AS `kodebarang`,`asets_ruangan`.`namabarang` AS `namabarang`,`asets_ruangan`.`merk` AS `merk`,`asets_ruangan`.`ukuran` AS `ukuran`,`tipe_asets`.`tipe` AS `tipe`,`bahan_asets`.`bahan` AS `bahan`,`asets_ruangan`.`tanggal` AS `tanggal`,`asets_ruangan`.`tahun` AS `tahun`,`asets_ruangan`.`harga` AS `harga`,`asets_ruangan`.`unit` AS `unit`,`list_kondisi`.`kondisi` AS `kondisi`,`asets_ruangan`.`keterangan` AS `keterangan`,`asets_ruangan`.`foto` AS `foto` from (((`asets_ruangan` left join `tipe_asets` on((`asets_ruangan`.`idtipe` = `tipe_asets`.`id`))) left join `bahan_asets` on((`asets_ruangan`.`idbahan` = `bahan_asets`.`id`))) left join `list_kondisi` on((`asets_ruangan`.`idkondisi` = `list_kondisi`.`id`)))) union all (select `asets`.`kodebarang` AS `kodebarang`,`asets`.`namabarang` AS `namabarang`,`asets`.`merk` AS `merk`,`asets`.`ukuran` AS `ukuran`,`tipe_asets`.`tipe` AS `tipe`,`bahan_asets`.`bahan` AS `bahan`,`asets`.`tanggal` AS `tanggal`,`asets`.`tahun` AS `tahun`,`asets`.`harga` AS `harga`,`asets`.`unit` AS `unit`,`list_kondisi`.`kondisi` AS `kondisi`,`asets`.`keterangan` AS `keterangan`,`asets`.`foto` AS `foto` from (((`asets` left join `tipe_asets` on((`asets`.`idtipe` = `tipe_asets`.`id`))) left join `bahan_asets` on((`asets`.`idbahan` = `bahan_asets`.`id`))) left join `list_kondisi` on((`asets`.`idkondisi` = `list_kondisi`.`id`)))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
