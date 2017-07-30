-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Jun 2017 pada 19.07
-- Versi Server: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pemilihangedung_ahp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gedung`
--

CREATE TABLE IF NOT EXISTS `gedung` (
  `id_gedung` int(11) NOT NULL,
  `id_jenis_gedung` int(11) NOT NULL,
  `nama_gedung` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gedung`
--

INSERT INTO `gedung` (`id_gedung`, `id_jenis_gedung`, `nama_gedung`) VALUES
(1, 1, 'Gedung Cak Durasim'),
(2, 1, 'Pendopo Jayengrono');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_gedung`
--

CREATE TABLE IF NOT EXISTS `jenis_gedung` (
  `id_jenis_gedung` int(11) NOT NULL,
  `Nama_Jenis` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_gedung`
--

INSERT INTO `jenis_gedung` (`id_jenis_gedung`, `Nama_Jenis`) VALUES
(1, 'Gedung Resmi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
(1, 'Jadwal'),
(2, 'Fasilitas'),
(3, 'Luas'),
(4, 'Harga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_nilai`
--

CREATE TABLE IF NOT EXISTS `kriteria_nilai` (
  `kriteria_nilai_id` int(11) NOT NULL,
  `id_pemilihan_gedung` int(11) NOT NULL,
  `kriteria_id_dari` int(11) NOT NULL,
  `kriteria_id_tujuan` int(11) NOT NULL,
  `nilai` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria_nilai`
--

INSERT INTO `kriteria_nilai` (`kriteria_nilai_id`, `id_pemilihan_gedung`, `kriteria_id_dari`, `kriteria_id_tujuan`, `nilai`) VALUES
(17, 1, 1, 2, 3),
(18, 1, 1, 3, 1),
(19, 1, 1, 4, 6),
(20, 1, 2, 3, 1),
(21, 1, 2, 4, 1),
(22, 1, 3, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kategori`
--

CREATE TABLE IF NOT EXISTS `nilai_kategori` (
  `nilai_id` int(11) NOT NULL,
  `nama_nilai` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_kategori`
--

INSERT INTO `nilai_kategori` (`nilai_id`, `nama_nilai`) VALUES
(1, 'Sangat Baik'),
(2, 'Baik'),
(3, 'Cukup'),
(4, 'Kurang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `jk` char(1) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `golongan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `notelp` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `user_id`, `nama_pegawai`, `jk`, `nip`, `jabatan`, `golongan`, `alamat`, `notelp`) VALUES
(1, 0, 'A.R. Bagas Danang Haditio, S.Kom., M.Kom.', 'L', '5152764666210000', 'Kepala UPT', 'IV/d', 'Jl. Jawa, Surabaya', '082298112795'),
(2, 2, 'Risky Fitri Islamiati, S.Kom.', 'P', '5152764666210000', 'Seksi Bagian Tata Usaha', 'III/d', '	Jl. Sumatera, Surabaya	', '082298112795'),
(3, 0, 'Andi Perdana Kusuma, S.E.', 'L', '5152764666210000', 'Seksi Bagian Tata Usaha', 'III/c', '	Jl. Jawa, Surabaya	', '082298112795'),
(4, 0, 'Pangestika Ayu Ashari, S.Kom.', 'P', '5152764666210000', 'Seksi Bagian Tata Usaha', 'III/d', '	Jl. Sumatera, Surabaya	', '082298112795'),
(5, 0, 'Riko Mindage Ginting, S.Kom.', 'L', '5152764666210000', 'Seksi Pengembangan Seni dan Budaya', 'III/d', '	Jl. Jawa, Surabaya	', '082298112795'),
(6, 0, 'Pujiono, S.H.', 'L', '5152764666210000', 'Seksi Pengembangan Seni dan Budaya', 'III/c', '	Jl. Sumatera, Surabaya	', '082298112795'),
(7, 0, 'Mesut Ozil, S.E', 'L', '5152764666210000', 'Seksi Penyajian Seni dan Budaya', 'III/c', '	Jl. Jawa, Surabaya	', '082298112795'),
(8, 0, 'Boro Primorac, S.T., M.Si.', 'L', '5152764666210000', 'Seksi Penyajian Seni dan Budaya', 'III/c', '	Jl. Sumatera, Surabaya	', '082298112795'),
(9, 0, 'Gerry Peyton, S.T., M.T.', 'L', '5152764666210000', 'Seksi Pengembangan Seni dan Budaya', 'III/c', '	Jl. Jawa, Surabaya	', '082298112795'),
(10, 0, 'Mathieu Debuchy, S.H.', 'L', '5152764666210000', 'Seksi Penyajian Seni dan Budaya', 'III/c', '	Jl. Jawa, Surabaya	', '082298112795'),
(11, 0, 'Rob Holding, S.T.', 'L', '5152764666210000', 'Seksi Penyajian Seni dan Budaya', 'III/c', '	Jl. Jawa, Surabaya	', '082298112795'),
(12, 7, 'AA', 'L', '1213', 'Seksi Bagian Tata Usaha', 'I/c', 'aaa', '131');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_gedung`
--

CREATE TABLE IF NOT EXISTS `pemesanan_gedung` (
  `id_pemesanan_gedung` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_gedung` int(11) NOT NULL,
  `tgl_acara` date NOT NULL,
  `jam_acara` varchar(20) NOT NULL,
  `tgl_order` date NOT NULL,
  `jumlah_pesan` double NOT NULL,
  `acara` varchar(100) NOT NULL,
  `status` enum('Belum Disetujui','Telah Disetujui') NOT NULL,
  `file` varchar(100) NOT NULL,
  `instansi` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan_gedung`
--

INSERT INTO `pemesanan_gedung` (`id_pemesanan_gedung`, `user_id`, `id_gedung`, `tgl_acara`, `jam_acara`, `tgl_order`, `jumlah_pesan`, `acara`, `status`, `file`, `instansi`) VALUES
(1, 7, 2, '2017-05-26', '11:00', '2017-05-27', 1, 'Pernikahan', 'Belum Disetujui', 'a.pdf', 'Bukan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilihan_gedung`
--

CREATE TABLE IF NOT EXISTS `pemilihan_gedung` (
  `id_pemilihan_gedung` int(11) NOT NULL,
  `id_gedung` int(11) NOT NULL,
  `id_jenis_gedung` int(11) NOT NULL,
  `nama_pemilihan` varchar(100) NOT NULL,
  `tahun` int(4) NOT NULL,
  `kuota` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemilihan_gedung`
--

INSERT INTO `pemilihan_gedung` (`id_pemilihan_gedung`, `id_gedung`, `id_jenis_gedung`, `nama_pemilihan`, `tahun`, `kuota`) VALUES
(1, 1, 1, 'Gedung Cak Durasim', 2017, 2),
(2, 2, 1, 'Pendopo Jayengrono', 2017, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilih_penyewa`
--

CREATE TABLE IF NOT EXISTS `pemilih_penyewa` (
  `id_pemilih_penyewa` int(11) NOT NULL,
  `id_pemilihan_gedung` int(11) NOT NULL,
  `id_penyewa` int(11) NOT NULL,
  `status` enum('Analisa','Layak Sewa','Tidak Layak Sewa') NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemilih_penyewa`
--

INSERT INTO `pemilih_penyewa` (`id_pemilih_penyewa`, `id_pemilihan_gedung`, `id_penyewa`, `status`, `total`) VALUES
(1, 1, 1, 'Layak Sewa', 0),
(2, 1, 2, 'Layak Sewa', 0),
(3, 2, 2, 'Analisa', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `akses` enum('staff','kepala','penyewa') NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`user_id`, `nama`, `username`, `password`, `akses`, `photo`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'staff', 'ava-c4ca4238a0b923820dcc509a6f75849b.png'),
(2, 'Staff', 'Fitri', '534a0b7aa872ad1340d0071cbfa38697', 'staff', 'ava-c4ca4238a0b923820dcc509a6f75849b.png'),
(3, 'Kepala UPT', 'kepala', '870f669e4bbbfa8a6fde65549826d1c4', 'kepala', ''),
(4, 'Penyewa', 'Penyewa', 'ca8692aabeb75728837836763de05b8c', 'penyewa', ''),
(5, 'Penyewa', 'Andi', 'ca8692aabeb75728837836763de05b8c', 'penyewa', ''),
(6, 'Pangestika', 'ayu', '29c65f781a1068a41f735e1b092546de', 'penyewa', ''),
(7, 'Administrator', 'Danang', '6a17faad3b1275fd2558d5435c58440e', 'penyewa', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewa`
--

CREATE TABLE IF NOT EXISTS `penyewa` (
  `id_penyewa` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `KTP` varchar(200) NOT NULL,
  `nama_penyewa` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `notelp_penyewa` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penyewa`
--

INSERT INTO `penyewa` (`id_penyewa`, `user_id`, `KTP`, `nama_penyewa`, `alamat`, `pekerjaan`, `notelp_penyewa`) VALUES
(1, 2, '13410100054', 'Risky Fitri Islamiati, S.Kom.', 'Jl. Jawa', 'PNS', '082298112795'),
(2, 7, '12410100190', 'A.R. Bagas Danang Haditio, S.Kom.', 'Jl. Fabregas', 'PNS', '082298112795');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta_nilai`
--

CREATE TABLE IF NOT EXISTS `peserta_nilai` (
  `peserta_nilai_id` int(11) NOT NULL,
  `id_pemilih_penyewa` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peserta_nilai`
--

INSERT INTO `peserta_nilai` (`peserta_nilai_id`, `id_pemilih_penyewa`, `id_kriteria`, `nilai_id`) VALUES
(1, 1, 1, 6),
(2, 1, 2, 9),
(3, 1, 3, 14),
(4, 1, 4, 17),
(5, 3, 1, 7),
(6, 3, 2, 9),
(7, 3, 3, 14),
(8, 3, 4, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE IF NOT EXISTS `subkriteria` (
  `subkriteria_id` int(11) NOT NULL,
  `nama_subkriteria` varchar(50) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `tipe` enum('teks','nilai') NOT NULL,
  `nilai_minimum` double DEFAULT NULL,
  `nilai_maksimum` double DEFAULT NULL,
  `op_min` varchar(4) DEFAULT NULL,
  `op_max` varchar(4) DEFAULT NULL,
  `nilai_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`subkriteria_id`, `nama_subkriteria`, `id_kriteria`, `tipe`, `nilai_minimum`, `nilai_maksimum`, `op_min`, `op_max`, `nilai_id`) VALUES
(5, 'Sedang', 1, 'nilai', 80, 90, '<', '<=', 2),
(6, 'Penuh', 1, 'nilai', 70, 80, '<', '<=', 3),
(7, 'Cukup Penuh', 1, 'teks', 700, 70, '<', NULL, 4),
(8, 'Tempat Parkir', 2, 'teks', NULL, NULL, NULL, NULL, 1),
(9, 'Dapur', 2, 'teks', NULL, NULL, NULL, NULL, 2),
(10, 'AC', 2, 'teks', NULL, NULL, NULL, NULL, 3),
(11, 'Outlet Makanan', 2, 'teks', NULL, NULL, NULL, NULL, 4),
(12, '400 meter persegi', 3, 'teks', NULL, NULL, NULL, NULL, 1),
(13, '22,5x47,5', 3, 'teks', NULL, NULL, NULL, NULL, 2),
(14, '20x30 m', 3, 'teks', NULL, NULL, NULL, NULL, 3),
(15, 'Tidak Ada', 3, 'teks', NULL, NULL, NULL, NULL, 4),
(16, '<= 1500000 < 1500000', 4, 'nilai', 1500000, 1500000, '<=', '<', 1),
(17, '< 1500000 <= 2500000', 4, 'nilai', 1500000, 2500000, '<', '<=', 2),
(18, '< 2500000 <= 3500000', 4, 'nilai', 2500000, 3500000, '<', '<=', 3),
(19, '=> 3500000 > 3500000', 4, 'nilai', 3500000, 3500000, '=>', '>', 4),
(20, '= 4  4', 5, 'nilai', 4, 4, '=', NULL, 1),
(21, '> 4  > 4', 5, 'nilai', 4, 4, '>', '>', 2),
(22, '= 3 = 3', 5, 'nilai', 3, 3, '=', '=', 3),
(23, '<= 2 <= 2', 5, 'nilai', 2, 2, '<=', '<=', 4),
(24, 'Tidak Ada', 1, 'nilai', 2, 2, '>', '>', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria_hasil`
--

CREATE TABLE IF NOT EXISTS `subkriteria_hasil` (
  `subkriteria_hasil_id` int(11) NOT NULL,
  `id_pemilihan_gedung` int(11) NOT NULL,
  `subkriteria_id` int(11) NOT NULL,
  `prioritas` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria_hasil`
--

INSERT INTO `subkriteria_hasil` (`subkriteria_hasil_id`, `id_pemilihan_gedung`, `subkriteria_id`, `prioritas`) VALUES
(1, 3, 16, 1),
(2, 3, 17, 0.6088913020841081),
(3, 3, 18, 0.2782827306130342),
(4, 3, 19, 0.20898353242193896),
(5, 3, 1, 1),
(6, 3, 5, 0.4652226971611079),
(7, 3, 6, 0.20150479274158797),
(8, 3, 7, 0.1264838604896141),
(9, 3, 8, 1),
(10, 3, 9, 0.5949526134405514),
(11, 3, 10, 0.34577828834003443),
(12, 3, 11, 0.20602383687535897),
(13, 3, 12, 1),
(14, 3, 13, 0.4301845987904696),
(15, 3, 14, 0.25758657541918056),
(16, 3, 15, 0.15612791814736754),
(17, 3, 20, 1),
(18, 3, 21, 0.7450778338083753),
(19, 3, 22, 0.2948147336110502),
(20, 3, 23, 0.16278228458671345);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria_nilai`
--

CREATE TABLE IF NOT EXISTS `subkriteria_nilai` (
  `subkriteria_nilai_id` int(11) NOT NULL,
  `id_pemilihan_gedung` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `subkriteria_id_dari` int(11) NOT NULL,
  `subkriteria_id_tujuan` int(11) NOT NULL,
  `nilai` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria_nilai`
--

INSERT INTO `subkriteria_nilai` (`subkriteria_nilai_id`, `id_pemilihan_gedung`, `id_kriteria`, `subkriteria_id_dari`, `subkriteria_id_tujuan`, `nilai`) VALUES
(93, 1, 1, 1, 7, 6),
(94, 1, 1, 5, 6, 3),
(95, 1, 1, 5, 7, 4),
(96, 1, 1, 6, 7, 2),
(97, 3, 2, 8, 9, 2),
(98, 3, 2, 8, 10, 3),
(99, 3, 2, 8, 11, 4),
(100, 3, 2, 9, 10, 2),
(101, 3, 2, 9, 11, 3),
(102, 3, 2, 10, 11, 2),
(103, 3, 3, 12, 13, 3),
(104, 3, 3, 12, 14, 4),
(105, 3, 3, 12, 15, 5),
(106, 3, 3, 13, 14, 2),
(107, 3, 3, 13, 15, 3),
(108, 3, 3, 14, 15, 2),
(109, 3, 4, 16, 17, 2),
(110, 3, 4, 16, 18, 3),
(111, 3, 4, 16, 19, 5),
(112, 3, 4, 17, 18, 2),
(113, 3, 4, 17, 19, 4),
(114, 3, 4, 18, 19, 1),
(115, 3, 5, 20, 21, 2),
(116, 3, 5, 20, 22, 4),
(117, 3, 5, 20, 23, 4),
(118, 3, 5, 21, 22, 4),
(119, 3, 5, 21, 23, 5),
(120, 3, 5, 22, 23, 3),
(121, 1, 1, 24, 5, 1),
(122, 1, 1, 24, 6, 1),
(123, 1, 1, 24, 7, 1),
(124, 1, 1, 5, 6, 1),
(125, 1, 1, 5, 7, 1),
(126, 1, 1, 6, 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id_gedung`);

--
-- Indexes for table `jenis_gedung`
--
ALTER TABLE `jenis_gedung`
  ADD PRIMARY KEY (`id_jenis_gedung`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
  ADD PRIMARY KEY (`kriteria_nilai_id`);

--
-- Indexes for table `nilai_kategori`
--
ALTER TABLE `nilai_kategori`
  ADD PRIMARY KEY (`nilai_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pemesanan_gedung`
--
ALTER TABLE `pemesanan_gedung`
  ADD PRIMARY KEY (`id_pemesanan_gedung`);

--
-- Indexes for table `pemilihan_gedung`
--
ALTER TABLE `pemilihan_gedung`
  ADD PRIMARY KEY (`id_pemilihan_gedung`);

--
-- Indexes for table `pemilih_penyewa`
--
ALTER TABLE `pemilih_penyewa`
  ADD PRIMARY KEY (`id_pemilih_penyewa`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id_penyewa`);

--
-- Indexes for table `peserta_nilai`
--
ALTER TABLE `peserta_nilai`
  ADD PRIMARY KEY (`peserta_nilai_id`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`subkriteria_id`);

--
-- Indexes for table `subkriteria_hasil`
--
ALTER TABLE `subkriteria_hasil`
  ADD PRIMARY KEY (`subkriteria_hasil_id`);

--
-- Indexes for table `subkriteria_nilai`
--
ALTER TABLE `subkriteria_nilai`
  ADD PRIMARY KEY (`subkriteria_nilai_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id_gedung` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jenis_gedung`
--
ALTER TABLE `jenis_gedung`
  MODIFY `id_jenis_gedung` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
  MODIFY `kriteria_nilai_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `nilai_kategori`
--
ALTER TABLE `nilai_kategori`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pemesanan_gedung`
--
ALTER TABLE `pemesanan_gedung`
  MODIFY `id_pemesanan_gedung` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pemilihan_gedung`
--
ALTER TABLE `pemilihan_gedung`
  MODIFY `id_pemilihan_gedung` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pemilih_penyewa`
--
ALTER TABLE `pemilih_penyewa`
  MODIFY `id_pemilih_penyewa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id_penyewa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `peserta_nilai`
--
ALTER TABLE `peserta_nilai`
  MODIFY `peserta_nilai_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `subkriteria_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `subkriteria_hasil`
--
ALTER TABLE `subkriteria_hasil`
  MODIFY `subkriteria_hasil_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `subkriteria_nilai`
--
ALTER TABLE `subkriteria_nilai`
  MODIFY `subkriteria_nilai_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=127;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
