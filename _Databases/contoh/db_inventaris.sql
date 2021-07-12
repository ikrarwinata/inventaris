-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2021 pada 06.00
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `asets` (
  `id` int(11) NOT NULL,
  `kodebarang` varchar(25) NOT NULL,
  `namabarang` varchar(250) NOT NULL,
  `merk` varchar(250) DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL,
  `idtipe` varchar(25) DEFAULT NULL,
  `idbahan` varchar(25) DEFAULT NULL,
  `tanggal` varchar(25) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `harga` float NOT NULL,
  `unit` int(15) NOT NULL DEFAULT 0,
  `idkondisi` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `asets`
--

INSERT INTO `asets` (`id`, `kodebarang`, `namabarang`, `merk`, `ukuran`, `idtipe`, `idbahan`, `tanggal`, `tahun`, `harga`, `unit`, `idkondisi`, `keterangan`, `foto`) VALUES
(1, 'ASSETS01', 'Sebidang Tanah Wakaf', '', '260 m2', '1', '', '08-03-2020', '2007', 500000000, 1, 1, '', ''),
(2, 'ASSETS02', 'Sebidang Tanah', '', '400 m2', '1', '', '08-03-2020', '2007', 100000000, 1, 1, '', ''),
(3, 'ASSETS03', 'Gedung I', '', '41 m x 8 m x 3 lantai', '1', '', '08-03-2020', '2007', 7000000000, 1, 1, '', ''),
(4, 'ASSETS04', 'Gedung II', '', '16  m x 8 m x 3 lantai', '1', '', '08-03-2020', '2020', 3500000000, 1, 4, 'sedang dalam pembangunan', '');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `asets_non_ruangan_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `asets_non_ruangan_view` (
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

CREATE TABLE `asets_ruangan` (
  `id` int(11) NOT NULL,
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
  `unit` int(15) NOT NULL DEFAULT 0,
  `idkondisi` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `asets_ruangan`
--

INSERT INTO `asets_ruangan` (`id`, `kodebarang`, `idruangan`, `namabarang`, `merk`, `ukuran`, `idtipe`, `idbahan`, `tanggal`, `tahun`, `harga`, `unit`, `idkondisi`, `keterangan`, `foto`) VALUES
(1, 'ASSETS05', 1, 'Meja 1 Biro', '', '150 x 68 x 75', '2', '1', '08-03-2020', '2008', 950000, 1, 1, '', ''),
(2, 'ASSETS06', 1, 'Meja Rapat 1 Meter', '', '105 x 55 x 75', '2', '1', '08-03-2020', '2012', 400000000, 2, 1, '', ''),
(3, 'ASSETS07', 2, 'Kursi dan Meja', '', '105 x 55 x 75', '2', '7', '10-03-2020', '2007', 200000, 4, 1, '', ''),
(9, 'ASSETS010', 2, 'Komputer', 'Acer', 'Core\'i 5', '2', NULL, '10-03-2020', '2008', 2000000, 2, 1, '', '');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `asets_ruangan_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `asets_ruangan_view` (
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

CREATE TABLE `bahan_asets` (
  `id` int(11) NOT NULL,
  `bahan` varchar(250) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `list_kondisi` (
  `id` int(11) NOT NULL,
  `kondisi` varchar(150) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `mutasi` (
  `id` int(11) NOT NULL,
  `kodebarang_lama` varchar(25) NOT NULL,
  `kodebarang_baru` varchar(25) NOT NULL,
  `idruangan_lama` int(11) DEFAULT NULL,
  `idruangan_baru` int(11) DEFAULT NULL,
  `tanggal` varchar(25) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `user_posting` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mutasi`
--

INSERT INTO `mutasi` (`id`, `kodebarang_lama`, `kodebarang_baru`, `idruangan_lama`, `idruangan_baru`, `tanggal`, `keterangan`, `user_posting`) VALUES
(3, 'ASSETS08', 'ASSETS010', 1, 2, '10-03-2020', 'pindah ruangan', 'admin');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `mutasi_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `mutasi_view` (
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

CREATE TABLE `peminjaman` (
  `idpeminjaman` varchar(25) NOT NULL,
  `kodeasets` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tanggalpinjam` varchar(25) NOT NULL,
  `tanggalkembali` varchar(25) NOT NULL,
  `status` enum('Masih Dipinjam','Sudah Kembali','Dibatalkan') NOT NULL DEFAULT 'Masih Dipinjam'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `peminjaman_asets_ruangan_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `peminjaman_asets_ruangan_view` (
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
-- Stand-in struktur untuk tampilan `peminjaman_asets_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `peminjaman_asets_view` (
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

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL,
  `nama_ruangan` varchar(250) NOT NULL,
  `lokasi` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama_ruangan`, `lokasi`, `keterangan`) VALUES
(1, 'Kantor Yayasan', 'Lantai 1', ''),
(2, 'Kantor STAI Ma\'Arif Jambi', 'Lantai 1', '');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `semua_asets_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `semua_asets_view` (
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

CREATE TABLE `tipe_asets` (
  `id` int(11) NOT NULL,
  `tipe` varchar(250) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `users` (
  `username` varchar(35) NOT NULL,
  `password` varchar(55) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `telepon` varchar(25) DEFAULT NULL
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `asets_non_ruangan_view`  AS   (select `asets`.`kodebarang` AS `kodebarang`,`asets`.`namabarang` AS `namabarang`,`asets`.`merk` AS `merk`,`asets`.`ukuran` AS `ukuran`,`tipe_asets`.`tipe` AS `tipe`,`bahan_asets`.`bahan` AS `bahan`,`asets`.`tanggal` AS `tanggal`,`asets`.`tahun` AS `tahun`,`asets`.`harga` AS `harga`,`asets`.`unit` AS `unit`,`list_kondisi`.`kondisi` AS `kondisi`,`asets`.`keterangan` AS `keterangan`,`asets`.`foto` AS `foto` from (((`asets` left join `tipe_asets` on(`asets`.`idtipe` = `tipe_asets`.`id`)) left join `bahan_asets` on(`asets`.`idbahan` = `bahan_asets`.`id`)) left join `list_kondisi` on(`asets`.`idkondisi` = `list_kondisi`.`id`)))  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `asets_ruangan_view`
--
DROP TABLE IF EXISTS `asets_ruangan_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `asets_ruangan_view`  AS   (select `asets_ruangan`.`kodebarang` AS `kodebarang`,`asets_ruangan`.`idruangan` AS `idruangan`,`ruangan`.`nama_ruangan` AS `nama_ruangan`,`asets_ruangan`.`namabarang` AS `namabarang`,`asets_ruangan`.`merk` AS `merk`,`asets_ruangan`.`ukuran` AS `ukuran`,`tipe_asets`.`tipe` AS `tipe`,`bahan_asets`.`bahan` AS `bahan`,`asets_ruangan`.`tanggal` AS `tanggal`,`asets_ruangan`.`tahun` AS `tahun`,`asets_ruangan`.`harga` AS `harga`,`asets_ruangan`.`unit` AS `unit`,`list_kondisi`.`kondisi` AS `kondisi`,`asets_ruangan`.`keterangan` AS `keterangan`,`asets_ruangan`.`foto` AS `foto` from ((((`asets_ruangan` left join `ruangan` on(`asets_ruangan`.`idruangan` = `ruangan`.`id`)) left join `tipe_asets` on(`asets_ruangan`.`idtipe` = `tipe_asets`.`id`)) left join `bahan_asets` on(`asets_ruangan`.`idbahan` = `bahan_asets`.`id`)) left join `list_kondisi` on(`asets_ruangan`.`idkondisi` = `list_kondisi`.`id`)))  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `mutasi_view`
--
DROP TABLE IF EXISTS `mutasi_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mutasi_view`  AS SELECT `mutasi`.`id` AS `id`, `mutasi`.`kodebarang_lama` AS `kodebarang_lama`, `mutasi`.`kodebarang_baru` AS `kodebarang_baru`, `mutasi`.`idruangan_lama` AS `idruangan_lama`, `mutasi`.`idruangan_baru` AS `idruangan_baru`, `mutasi`.`tanggal` AS `tanggal`, `mutasi`.`keterangan` AS `keterangan`, `mutasi`.`user_posting` AS `user_posting`, `truangan_lama`.`nama_ruangan` AS `ruangan_lama`, `truangan_baru`.`nama_ruangan` AS `ruangan_baru`, `semua_asets_view`.`namabarang` AS `namabarang`, `semua_asets_view`.`merk` AS `merk`, `semua_asets_view`.`ukuran` AS `ukuran`, `semua_asets_view`.`tipe` AS `tipe`, `semua_asets_view`.`bahan` AS `bahan`, `semua_asets_view`.`tanggal` AS `tanggal_entri`, `semua_asets_view`.`tahun` AS `tahun`, `semua_asets_view`.`harga` AS `harga`, `semua_asets_view`.`unit` AS `unit`, `semua_asets_view`.`kondisi` AS `kondisi`, `semua_asets_view`.`foto` AS `foto` FROM (((`mutasi` left join `ruangan` `truangan_lama` on(`mutasi`.`idruangan_lama` = `truangan_lama`.`id`)) left join `ruangan` `truangan_baru` on(`mutasi`.`idruangan_baru` = `truangan_baru`.`id`)) left join `semua_asets_view` on(`mutasi`.`kodebarang_baru` = `semua_asets_view`.`kodebarang`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `peminjaman_asets_ruangan_view`
--
DROP TABLE IF EXISTS `peminjaman_asets_ruangan_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `peminjaman_asets_ruangan_view`  AS SELECT `peminjaman`.`idpeminjaman` AS `idpeminjaman`, `peminjaman`.`kodeasets` AS `kodeasets`, `peminjaman`.`username` AS `username`, `peminjaman`.`tanggalpinjam` AS `tanggalpinjam`, `peminjaman`.`tanggalkembali` AS `tanggalkembali`, `peminjaman`.`status` AS `status`, `asets_ruangan`.`id` AS `id`, `asets_ruangan`.`kodebarang` AS `kodebarang`, `asets_ruangan`.`idruangan` AS `idruangan`, `asets_ruangan`.`namabarang` AS `namabarang`, `asets_ruangan`.`merk` AS `merk`, `asets_ruangan`.`ukuran` AS `ukuran`, `asets_ruangan`.`idtipe` AS `idtipe`, `asets_ruangan`.`idbahan` AS `idbahan`, `asets_ruangan`.`tanggal` AS `tanggal`, `asets_ruangan`.`tahun` AS `tahun`, `asets_ruangan`.`harga` AS `harga`, `asets_ruangan`.`unit` AS `unit`, `asets_ruangan`.`idkondisi` AS `idkondisi`, `asets_ruangan`.`keterangan` AS `keterangan`, `asets_ruangan`.`foto` AS `foto` FROM (`peminjaman` join `asets_ruangan` on(`peminjaman`.`kodeasets` = `asets_ruangan`.`kodebarang`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `peminjaman_asets_view`
--
DROP TABLE IF EXISTS `peminjaman_asets_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `peminjaman_asets_view`  AS SELECT `peminjaman`.`idpeminjaman` AS `idpeminjaman`, `peminjaman`.`kodeasets` AS `kodeasets`, `peminjaman`.`username` AS `username`, `peminjaman`.`tanggalpinjam` AS `tanggalpinjam`, `peminjaman`.`tanggalkembali` AS `tanggalkembali`, `peminjaman`.`status` AS `status`, `asets`.`id` AS `id`, `asets`.`kodebarang` AS `kodebarang`, `asets`.`namabarang` AS `namabarang`, `asets`.`merk` AS `merk`, `asets`.`ukuran` AS `ukuran`, `asets`.`idtipe` AS `idtipe`, `asets`.`idbahan` AS `idbahan`, `asets`.`tanggal` AS `tanggal`, `asets`.`tahun` AS `tahun`, `asets`.`harga` AS `harga`, `asets`.`unit` AS `unit`, `asets`.`idkondisi` AS `idkondisi`, `asets`.`keterangan` AS `keterangan`, `asets`.`foto` AS `foto` FROM (`peminjaman` join `asets` on(`peminjaman`.`kodeasets` = `asets`.`kodebarang`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `semua_asets_view`
--
DROP TABLE IF EXISTS `semua_asets_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `semua_asets_view`  AS   (select `asets_ruangan`.`kodebarang` AS `kodebarang`,`asets_ruangan`.`namabarang` AS `namabarang`,`asets_ruangan`.`merk` AS `merk`,`asets_ruangan`.`ukuran` AS `ukuran`,`tipe_asets`.`tipe` AS `tipe`,`bahan_asets`.`bahan` AS `bahan`,`asets_ruangan`.`tanggal` AS `tanggal`,`asets_ruangan`.`tahun` AS `tahun`,`asets_ruangan`.`harga` AS `harga`,`asets_ruangan`.`unit` AS `unit`,`list_kondisi`.`kondisi` AS `kondisi`,`asets_ruangan`.`keterangan` AS `keterangan`,`asets_ruangan`.`foto` AS `foto` from (((`asets_ruangan` left join `tipe_asets` on(`asets_ruangan`.`idtipe` = `tipe_asets`.`id`)) left join `bahan_asets` on(`asets_ruangan`.`idbahan` = `bahan_asets`.`id`)) left join `list_kondisi` on(`asets_ruangan`.`idkondisi` = `list_kondisi`.`id`))) union all (select `asets`.`kodebarang` AS `kodebarang`,`asets`.`namabarang` AS `namabarang`,`asets`.`merk` AS `merk`,`asets`.`ukuran` AS `ukuran`,`tipe_asets`.`tipe` AS `tipe`,`bahan_asets`.`bahan` AS `bahan`,`asets`.`tanggal` AS `tanggal`,`asets`.`tahun` AS `tahun`,`asets`.`harga` AS `harga`,`asets`.`unit` AS `unit`,`list_kondisi`.`kondisi` AS `kondisi`,`asets`.`keterangan` AS `keterangan`,`asets`.`foto` AS `foto` from (((`asets` left join `tipe_asets` on(`asets`.`idtipe` = `tipe_asets`.`id`)) left join `bahan_asets` on(`asets`.`idbahan` = `bahan_asets`.`id`)) left join `list_kondisi` on(`asets`.`idkondisi` = `list_kondisi`.`id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asets`
--
ALTER TABLE `asets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kodebarang` (`kodebarang`);

--
-- Indeks untuk tabel `asets_ruangan`
--
ALTER TABLE `asets_ruangan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kodebarang` (`kodebarang`);

--
-- Indeks untuk tabel `bahan_asets`
--
ALTER TABLE `bahan_asets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `list_kondisi`
--
ALTER TABLE `list_kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kodebarang_baru` (`kodebarang_baru`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`idpeminjaman`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tipe_asets`
--
ALTER TABLE `tipe_asets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asets`
--
ALTER TABLE `asets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `asets_ruangan`
--
ALTER TABLE `asets_ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `bahan_asets`
--
ALTER TABLE `bahan_asets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `list_kondisi`
--
ALTER TABLE `list_kondisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tipe_asets`
--
ALTER TABLE `tipe_asets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
