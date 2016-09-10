-- phpMyAdmin SQL Dump
-- version 4.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 10, 2016 at 06:59 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_padi`
--

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(11) unsigned NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `ref_url` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(200) DEFAULT NULL,
  `link_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `nama`, `deskripsi`, `ref_url`, `created_at`, `created_by`, `link_kategori`) VALUES
(1, 'skpd a', 'aaa', 'http://skpd.a', '2016-04-06 21:43:55', 'korpriadmin', 1),
(2, 'skpd b', 'skpd b', 'http://skpd.b', '2016-04-06 21:44:12', 'korpriadmin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `link_kategori`
--

CREATE TABLE `link_kategori` (
  `id` int(11) unsigned NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_kategori`
--

INSERT INTO `link_kategori` (`id`, `nama_kategori`, `deskripsi`, `created_at`, `created_by`) VALUES
(1, 'SKPD', 'skpd', '2016-04-06 21:43:34', 'korpriadmin');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(300) DEFAULT NULL,
  `ALIAS` varchar(500) DEFAULT NULL,
  `CONTENT` text,
  `ORDER` tinyint(4) DEFAULT '0',
  `META_KEY` varchar(200) DEFAULT NULL,
  `META_DESC` text,
  `STATUS` char(1) DEFAULT 'A' COMMENT 'A = Aktif, N = Tidak Aktif',
  `PARENT` int(11) DEFAULT NULL,
  `PAGE_VIEW` int(11) DEFAULT '0',
  `COLOR` varchar(10) DEFAULT NULL,
  `IMAGE` varchar(255) DEFAULT NULL,
  `CREATED_BY` varchar(200) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(200) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  `TYPE` int(11) DEFAULT NULL,
  `REF_URL` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`ID`, `TITLE`, `ALIAS`, `CONTENT`, `ORDER`, `META_KEY`, `META_DESC`, `STATUS`, `PARENT`, `PAGE_VIEW`, `COLOR`, `IMAGE`, `CREATED_BY`, `CREATED_DATE`, `UPDATED_BY`, `UPDATED_DATE`, `TYPE`, `REF_URL`) VALUES
(5, 'Aplikasi 1', 'aplikasi-1', '', 1, 'Adopsi Pulau, Kerjasama, Kemitraan, Perjanjian Kerjasama', '', 'A', NULL, 7, '', 'program__20160402172319.jpg', 'adminkp3k', '2014-07-17 01:34:26', 'adminkorpri', '2016-04-02 17:23:20', 2, 'http://google.com'),
(6, 'Aplikasi 2', 'aplikasi-2', '', 2, '', '', 'A', NULL, 7, '', 'program__20160402172438.gif', 'adminkp3k', '2014-07-17 01:39:18', 'adminkorpri', '2016-04-02 17:24:38', 2, 'http:###'),
(9, 'Aplikasi 2', 'aplikasi-2_20160402172457', '', 1, '', '', 'A', NULL, 0, '', 'program__20160402172456.gif', 'adminkp3k', '2014-06-24 16:17:06', 'adminkorpri', '2016-04-02 17:24:57', 2, '##');

-- --------------------------------------------------------

--
-- Table structure for table `X_AGENDA`
--

CREATE TABLE `X_AGENDA` (
  `ID` bigint(20) NOT NULL,
  `ALIAS` varchar(300) DEFAULT NULL,
  `TITLE` varchar(500) DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `DESC` text,
  `FILE` longtext,
  `STATUS` char(2) DEFAULT NULL,
  `TYPE` char(2) DEFAULT 'PH' COMMENT 'PH = Produk Hukum, BD = Bank Data',
  `PAGE_VIEW` int(11) DEFAULT '0',
  `UPDATED_BY` varchar(200) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(200) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `PLACE` varchar(100) DEFAULT NULL,
  `END_DATE` datetime DEFAULT NULL,
  `TIME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `X_BENIH`
--

CREATE TABLE `X_BENIH` (
  `ID` int(3) unsigned NOT NULL,
  `NAMA_BENIH` varchar(30) DEFAULT NULL,
  `BS` int(9) DEFAULT NULL,
  `FS` int(9) DEFAULT NULL,
  `SS` int(9) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_BENIH`
--

INSERT INTO `X_BENIH` (`ID`, `NAMA_BENIH`, `BS`, `FS`, `SS`) VALUES
(1, 'Padi 3S', 10, 10, 10),
(2, 'Padi 4S', 100, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `X_DOWNLOAD`
--

CREATE TABLE `X_DOWNLOAD` (
  `ID` bigint(20) NOT NULL,
  `ALIAS` varchar(300) DEFAULT NULL,
  `TITLE` varchar(500) DEFAULT NULL,
  `DESC` varchar(400) DEFAULT NULL,
  `FILE` longtext,
  `STATUS` char(2) DEFAULT NULL,
  `TYPE` char(2) DEFAULT 'PH' COMMENT 'PH = Produk Hukum, BD = Bank Data',
  `PAGE_VIEW` int(11) DEFAULT '0',
  `UPDATED_BY` varchar(200) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(200) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `TAHUN` varchar(4) DEFAULT NULL,
  `NOMOR` varchar(100) DEFAULT NULL,
  `KATEGORI` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `X_DOWNLOAD_CATEGORY`
--

CREATE TABLE `X_DOWNLOAD_CATEGORY` (
  `ID` int(11) NOT NULL,
  `CAT_ALIAS` varchar(500) DEFAULT '',
  `CAT_NAME` varchar(200) DEFAULT '',
  `UPDATED_BY` varchar(100) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(100) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `X_LEMBAGA`
--

CREATE TABLE `X_LEMBAGA` (
  `ID` int(11) NOT NULL,
  `INSTITUTION_NAME` varchar(90) NOT NULL,
  `REGION` varchar(30) NOT NULL,
  `ADDRESS` text NOT NULL,
  `ID_STATUS` int(3) NOT NULL,
  `DESC` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_LEMBAGA`
--

INSERT INTO `X_LEMBAGA` (`ID`, `INSTITUTION_NAME`, `REGION`, `ADDRESS`, `ID_STATUS`, `DESC`) VALUES
(1, 'IPB DIPLOMA', 'Bogor', '', 1, 'Ipb Diploma Penangkar'),
(2, 'BPTP ', 'Sulawesi Utara', '', 1, '<p>BPTP Sulawesi Utara</p>\n'),
(3, 'BLST', 'Bogor', '', 1, '<p>deskripsi dari BLST</p>\n');

-- --------------------------------------------------------

--
-- Table structure for table `X_NEWS`
--

CREATE TABLE `X_NEWS` (
  `NEWS_ID` bigint(20) NOT NULL,
  `CAT` int(11) DEFAULT NULL,
  `ALIAS` varchar(300) DEFAULT NULL,
  `NEWS_TITLE` varchar(500) DEFAULT NULL,
  `NEWS_SUBTITLE` varchar(400) DEFAULT NULL,
  `NEWS_CONTENT` longtext,
  `NEWS_PICTURE` varchar(500) DEFAULT NULL,
  `NEWS_PICTURE_CAPTION` varchar(300) DEFAULT NULL,
  `NEWS_PICTURE_SOURCE` varchar(200) DEFAULT NULL,
  `WRITER` varchar(200) DEFAULT NULL,
  `EDITOR` varchar(200) DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `TAGS` varchar(300) DEFAULT NULL,
  `META_TITLE` varchar(300) DEFAULT NULL,
  `META_KEY` varchar(200) DEFAULT NULL,
  `META_DESC` text,
  `STATUS` char(2) DEFAULT NULL,
  `IS_PILIHAN` tinyint(4) DEFAULT NULL,
  `IS_HEADLINE` tinyint(4) DEFAULT NULL,
  `TYPE` char(1) DEFAULT 'N' COMMENT 'N = News, F = Fokus, A = Artikel',
  `PAGE_VIEW` int(11) DEFAULT '0',
  `UPDATED_BY` varchar(200) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(200) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_NEWS`
--

INSERT INTO `X_NEWS` (`NEWS_ID`, `CAT`, `ALIAS`, `NEWS_TITLE`, `NEWS_SUBTITLE`, `NEWS_CONTENT`, `NEWS_PICTURE`, `NEWS_PICTURE_CAPTION`, `NEWS_PICTURE_SOURCE`, `WRITER`, `EDITOR`, `DATE`, `TAGS`, `META_TITLE`, `META_KEY`, `META_DESC`, `STATUS`, `IS_PILIHAN`, `IS_HEADLINE`, `TYPE`, `PAGE_VIEW`, `UPDATED_BY`, `UPDATED_DATE`, `CREATED_BY`, `CREATED_DATE`) VALUES
(195, 23, 'coba-dulu', 'coba dulu', 'ini berita coba coba aja dulu', '<p>asdbasd adiuagdua</p>\n\n<p>d a</p>\n\n<p>daido gasodgasdugado</p>\n\n<p>&nbsp;gdaiu dgauisdgfalsufdlafdlasda</p>\n\n<p>dago qwfd pdfyfdlasa</p>\n\n<p>&nbsp;</p>\n', 'coba-dulu_20160416050131.jpg', 'judul gambar', '0', 'udin', NULL, '2015-10-18 15:12:15', NULL, 'coba dulu', 'coba, dikmental', 'dasdasdasda', 'A', 0, 0, 'N', 5, 'korpriadmin', '2016-04-16 05:01:31', 'kpapadmin', '2015-10-18 08:14:49'),
(196, 23, 'cek', 'cek', 'cek', '<p>isi veritas</p>\n', 'cek_20160407035202.png', 'aaa', '0', 'sdsd,sdsds', NULL, '2016-04-07 10:51:15', NULL, 'cek', 'sdsakdgu, sdsad', 'sdasdasd', 'A', 0, 0, 'N', 1, NULL, NULL, 'korpriadmin', '2016-04-07 03:52:02'),
(197, 24, 'bidang-hukum', 'Bidang Hukum', 'bidang hukum', '<p>bidang hukum</p>\n', 'bidang-hukum_20160407035806.png', 'logo korpri', '0', 'admin', NULL, '2016-04-07 10:57:15', NULL, 'Bidang Hukum', 'bidang, hukum, korpri', 'bidang hukum', 'A', 0, 0, 'A', 0, NULL, NULL, 'korpriadmin', '2016-04-07 03:58:06'),
(198, 24, 'bidang-kerjasama', 'Bidang Kerjasama', 'bidang kerjasama', '<p>Bidang Kerjasama</p>\n', 'bidang-kerjasama_20160407035918.png', 'logo korpri', '0', 'admin', NULL, '2016-04-07 10:58:30', NULL, 'Bidang Kerjasama', 'bidang, kersjasama, korpri', 'Bidang Kerjasama', 'A', 0, 0, 'A', 3, NULL, NULL, 'korpriadmin', '2016-04-07 03:59:18'),
(199, 24, 'bidang-mental-dan-rohani', 'Bidang Mental dan Rohani', 'Bidang Mental dan Rohani', '<pre>\nBidang Mental dan Rohani</pre>\n', 'bidang-mental-dan-rohani_20160407040016.png', 'logo korpri', '0', 'admin', NULL, '2016-04-07 10:59:30', NULL, 'Bidang Mental dan Rohani', 'bidang, mental, rohani, korpri', 'Bidang Mental dan Rohani', 'A', 0, 0, 'A', 0, NULL, NULL, 'korpriadmin', '2016-04-07 04:00:16'),
(200, 24, 'bidang-sosial-dan-wirausaha', 'Bidang Sosial dan Wirausaha', 'Bidang Sosial dan Wirausaha', '<pre>\nBidang Sosial dan Wirausaha</pre>\n', 'bidang-sosial-dan-wirausaha_20160407040157.png', 'logo korpri', '0', 'admin', NULL, '2016-04-07 11:01:15', NULL, 'Bidang Sosial dan Wirausaha', 'bidang, sosial, wirausaha, korpri', 'Bidang Sosial dan Wirausaha', 'A', 0, 0, 'A', 0, NULL, NULL, 'korpriadmin', '2016-04-07 04:01:57'),
(201, 23, 'sekretariat-korpri-provinsi-dki-jakarta', 'SEKRETARIAT KORPRI PROVINSI DKI JAKARTA', 'SEKRETARIAT KORPRI PROVINSI DKI JAKARTA', '<p>SEKRETARIAT KORPRI PROVINSI DKI JAKARTA</p>\n', 'sekretariat-korpri-provinsi-dki-jakarta_20160407040342.jpg', 'upacara', '0', 'admin', NULL, '2016-04-07 11:02:00', NULL, 'SEKRETARIAT KORPRI PROVINSI DKI JAKARTA', 'uapcara, korpri', 'SEKRETARIAT KORPRI PROVINSI DKI JAKARTA', 'A', 0, 1, 'N', 0, NULL, NULL, 'korpriadmin', '2016-04-07 04:03:42'),
(202, 23, 'berita-3', 'berita 3', 'ini adalah berita 3', '<p>is berits sadsagdu dad a;dgad asda</p>\n\n<p>d a</p>\n\n<p>dyasd asidgad</p>\n\n<p>&nbsp;</p>\n', 'berita-3_20160416051101.jpg', 'sasa', '0', 'sdds,sdsd', NULL, '2016-04-16 12:10:00', NULL, 'berita 3', 'sass, sds', 'sdsada', 'A', 0, 0, 'N', 1, NULL, NULL, 'korpriadmin', '2016-04-16 05:11:01'),
(203, 23, 'popopopo', 'popopopo', 'popopposbsb sshsjsj', '<p>sdsdasas</p>\n', 'popopopo_20160416051206.jpg', 'aaaa', '0', 'aaaa', NULL, '2016-04-16 12:11:00', NULL, 'popopopo', 'aaaa', 'aaaaaa', 'A', 0, 0, 'N', 5, NULL, NULL, 'korpriadmin', '2016-04-16 05:12:06'),
(204, 25, 'laporan-1', 'laporan 1', 'laporan 1', '<p>isi&nbsp; laporan kegiatn</p>\n', 'laporan-1_20160417062823.jpg', 'believe', '0', 'udin', NULL, '2016-04-17 13:27:30', NULL, 'laporan 1', 'wala', 'oke', 'A', 0, 0, 'N', 1, NULL, NULL, 'korpriadmin', '2016-04-17 06:28:23'),
(205, 23, 'upacara-korpri', 'Upacara Korpri', 'Upacara Korpri', '<p>upadacfa</p>\n', 'upacara-korpri_20160418045731.jpg', 'upacara', '0', 'wala', NULL, '2016-04-18 11:56:30', NULL, 'Upacara Korpri', 'korpri, dki, jakarta', 'headline', 'A', 0, 1, 'N', 1, NULL, NULL, 'korpriadmin', '2016-04-18 04:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `X_NEWS_CATEGORY`
--

CREATE TABLE `X_NEWS_CATEGORY` (
  `ID` int(11) NOT NULL,
  `CAT_ALIAS` varchar(500) DEFAULT '',
  `CAT_NAME` varchar(200) DEFAULT '',
  `COLOR` varchar(10) DEFAULT '#ff7903',
  `PARENT` int(11) DEFAULT NULL,
  `CAT_ORDER` tinyint(4) DEFAULT '0',
  `META_DESC` text,
  `META_KEYWORD` varchar(200) DEFAULT NULL,
  `UPDATED_BY` varchar(100) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(100) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `TYPE` smallint(1) DEFAULT '1' COMMENT '1 = berita, 2 = artikel'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_NEWS_CATEGORY`
--

INSERT INTO `X_NEWS_CATEGORY` (`ID`, `CAT_ALIAS`, `CAT_NAME`, `COLOR`, `PARENT`, `CAT_ORDER`, `META_DESC`, `META_KEYWORD`, `UPDATED_BY`, `UPDATED_DATE`, `CREATED_BY`, `CREATED_DATE`, `TYPE`) VALUES
(23, 'berita-umum', 'Berita Umum', '0', NULL, 0, '', 'berita, umum', 'jametson', '2015-10-20 13:51:19', NULL, NULL, 1),
(24, 'bidang', 'Bidang', '0', NULL, 2, 'Bidang - bidang Korpri', 'bidang', NULL, NULL, 'korpriadmin', '2016-04-07 03:57:09', 2),
(25, 'laporan-kegiatan', 'Laporan Kegiatan', '0', NULL, 2, 'Laporan Kegiatan SKPD', 'laporan, kegiatan, korpri, skpd', NULL, NULL, 'korpriadmin', '2016-04-17 06:27:25', 1),
(26, 'teknologi-budi-daya', 'Teknologi Budi Daya', '0', NULL, 1, 'blah', 'sadsa,asdasdsa', NULL, NULL, 'admin', '2016-08-26 18:50:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `X_NEWS_COMMENT`
--

CREATE TABLE `X_NEWS_COMMENT` (
  `ID` bigint(20) NOT NULL,
  `USER` int(11) DEFAULT NULL,
  `NEWS` bigint(20) DEFAULT NULL,
  `COMMENT` text,
  `STATUS` varchar(5) DEFAULT 'P' COMMENT 'A = Approve, P = Pending, R = Reject, '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `X_NEWS_TAGS`
--

CREATE TABLE `X_NEWS_TAGS` (
  `ID` bigint(20) NOT NULL,
  `TAG` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `X_NEWS_TAGS_REL`
--

CREATE TABLE `X_NEWS_TAGS_REL` (
  `ID` bigint(20) NOT NULL,
  `TAG_ID` bigint(100) DEFAULT NULL,
  `NEWS_ID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `x_pages`
--

CREATE TABLE `x_pages` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(300) DEFAULT NULL,
  `ALIAS` varchar(500) DEFAULT NULL,
  `CONTENT` text,
  `ORDER` tinyint(4) DEFAULT '0',
  `META_KEY` varchar(200) DEFAULT NULL,
  `META_DESC` text,
  `STATUS` char(1) DEFAULT 'A' COMMENT 'A = Aktif, N = Tidak Aktif',
  `PARENT` int(11) DEFAULT NULL,
  `PAGE_VIEW` int(11) DEFAULT '0',
  `COLOR` varchar(10) DEFAULT NULL,
  `CREATED_BY` varchar(200) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(200) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  `TYPE` int(11) DEFAULT NULL,
  `REF_URL` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `x_pages`
--

INSERT INTO `x_pages` (`ID`, `TITLE`, `ALIAS`, `CONTENT`, `ORDER`, `META_KEY`, `META_DESC`, `STATUS`, `PARENT`, `PAGE_VIEW`, `COLOR`, `CREATED_BY`, `CREATED_DATE`, `UPDATED_BY`, `UPDATED_DATE`, `TYPE`, `REF_URL`) VALUES
(29, 'Dasar Hukum Pembentukan', 'dasar-hukum-pembentukan', '<p>Dasar Hukum Pembentukan</p>\n', 5, 'dasar hukum, korpri', 'dasar hukum korpri', 'A', 30, 5, '#1ca0cc', 'efriandika', '2014-06-08 22:08:41', 'adminkorpri', '2016-04-02 14:57:02', 1, 'agenda'),
(30, 'Tentang<br><div style="font-size:9px; margin-top:-5px;">kami</div>', 'tentang-br-div-style-font-size-9px-margin-top-5px-kami-div-', '', 2, '', '', 'A', NULL, 23, '#26638f', 'adminkp3k', '2014-07-17 13:07:26', 'adminkp3k', '2016-01-22 08:48:24', 2, ''),
(31, 'Visi & Misi', 'visi-misi', '<p><strong>VISI</strong></p>\n\n<p>Terwujudnya organisasi KORPRI yang kuat, netral, demokratis, untuk membangun</p>\n\n<p>jiwa korps (korsa) pegawai Republik Indonesia dan mensejahterakan anggota dan</p>\n\n<p>&nbsp;</p>\n\n<p><strong>MISI</strong></p>\n\n<ol>\n	<li>Mewujudkan organisasi KORPRI yang kuat, berwibawa dan mencakup seluruh</li>\n	<li>Membangun solidaritas dan soliditas pegawai Republik Indonesia sebagai perekat dan alat pemersatu bangsa dan negara;</li>\n	<li>Mewujudkan kesejahteraan, penghargaan, pengayoman dan perlindungan hukum untuk meningkatkan harkat dan martabat anggota;</li>\n	<li>Membangun pegawai Republik Indonesia yang bertaqwa, profesional, disiplin, bebas kolusi, korupsi dan nepotisme dan mampu melaksanakan tugas-tugas</li>\n	<li>Mewujudkan KORPRI yang netral dan bebas dari pengaruh politik.</li>\n</ol>\n', 2, 'Visi, Misi, korpri, dki, jakarta', 'Visi & Misi Korpri DKI Jakarta', 'A', 30, 23, '#0050ff', 'adminkp3k', '2014-07-23 01:16:21', 'admin', '2016-06-15 11:09:22', 1, ''),
(32, 'Struktur Organisasi', 'struktur-organisasi', '<p><iframe align="middle" frameborder="0" height="450" scrolling="no" src="http://www.ppk-kp3k.kkp.go.id/ver2/orgchrt" width="615"></iframe></p>\r\n', 4, 'Struktur Organisasi, Jabatan, posisi', 'Struktur Organisasi Direktorat Pendayagunaan Pulau-Pulau Kecil', 'A', 30, 47, '#ffa41b', 'adminkp3k', '2014-07-23 14:31:00', 'adminkp3k', '2014-11-07 15:13:12', 1, ''),
(33, 'Fungsi KORPRI', 'fungsi-korpri', '<p style="text-align:justify"><strong>KORPRI berfungsi :</strong></p>\n\n<ol>\n	<li>Sebagai satu-satunya wadah berhimpunnya seluruh anggota;</li>\n	<li>Membina dan meningkatkan jiwa korps (korsa);</li>\n	<li>Sebagai perekat dan pemersatu bangsa dan negara;</li>\n	<li>Sebagai wadah untuk peningkatan kesejahteraan dan memberikan penghargaan bagi anggota;</li>\n	<li>Sebagai pengayom, pelindung dan pemberi bantuan hukum bagi anggota;</li>\n	<li>Meningkatkan harkat dan martabat anggota;</li>\n	<li>Meningkatkan ketaqwaan, kejujuran, keadilan, disiplin dan profesionalisme;</li>\n	<li>Mewujudkan kepemerintahan yang baik.</li>\n</ol>\n', 3, 'fungsi, korpri', 'Fungsi Korpri', 'A', 30, 17, '#09857d', 'adminkp3k', '2014-07-23 14:39:09', 'adminkorpri', '2016-04-02 16:12:05', 1, ''),
(34, 'Tentang KORPRI ', 'tentang-korpri-', '<p style="text-align:justify"><strong>KORPRI</strong> :</p>\n\n<p style="text-align:justify">Organisasi PNS di seluruh Indonesia bernama Korps Pegawai Republik Indonesia, yang disingkat KORPRI adalah satu-satunya wadah untuk menghimpun seluruh Pegawai Republik Indonesia yang meliputi : Pegawai Negeri Sipil, Pegawai Badan Usaha Milik Negara dan Badan Usaha Milik Daerah, Badan Hukum Milik Negara dan/atau Badan Hukum Pendidikan, Lembaga Penyiaran Publik Pusat dan Daerah, Badan Layanan Umum Pusat dan Daerah, dan Badan Otorita/Kawasan Ekonomi Khusus yang kedudukan dan kegiatannya tidak terpisahkan dari kedinasan. Organisasi KORPRI bersifat demokratis, bebas, aktif, profesional, netral, produktif, dan akuntabel, KORPRI dibentuk pada tanggal 29 Nopember 1971 dengan Keputusan Presiden Republik Indonesia Nomor 82 tahun 1971, yang berdasarkan Pancasila dan Undang-Undang Dasar Negara Republik Indonesia Tahun 1945.</p>\n\n<p style="text-align:justify"><strong>Anggota KORPRI terdiri atas :</strong></p>\n\n<p style="text-align:justify">1. Anggota Biasa yaitu:</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; a. Pegawai Negeri Sipil Republik Indonesia;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; b. Pegawai Badan Usaha Milik Negara dan Badan Usaha Milik Daerah, Badan Hukum Milik Negara &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;dan/atau Badan Hukum Pendidikan, Lembaga Penyiaran Publik Pusat dan Lembaga Penyiaran &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Publik Daerah, Badan Layanan Umum Pusat dan Badan Layanan Umum Daerah, Badan Otorita &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;dan Pengelola Kawasan Ekonomi Khusus;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp;c. Aparatur Pemerintah Desa dan/atau nama lain dari desa di wilayah tersebut.</p>\n\n<p style="text-align:justify">2. Anggota Luar Biasa, yaitu para Pensiunan Pegawai Negeri Sipil Republik Indonesia, Badan Usaha &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Milik Negara dan Badan Usaha Milik Daerah, Badan Hukum Milik Negara dan/atau Badan Hukum &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pendidikan, Lembaga Penyiaran Publik Pusat dan Lembaga Penyiaran Publik Daerah, Badan Layanan &nbsp; &nbsp; Umum Pusat dan Badan Layanan Umum Daerah, Badan Otorita dan Pengelola Kawasan Ekonomi &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Khusus;</p>\n\n<p style="text-align:justify">3. Anggota Kehormatan, yaitu para Penasihat KORPRI disemua tingkat kepengurusan dan seseorang &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; yang berjasa kepada organisasi KORPRI yang dipilih secara selektif dan ditetapkan oleh Dewan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pengurus KORPRI Nasional.</p>\n\n<p style="text-align:justify"><strong>SEKRETARIAT DEWAN PENGURUS KORPRI PROVINSI DKI JAKARTA</strong></p>\n\n<p style="text-align:justify">(1) Sekretariat Dewan Pengurus KORPRI Provinsi DKI Jakarta adalah Satuan Kerja Perangkat Daerah &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (SKPD) Provinsi DKI Jakarta yang dibentuk berdasarkan:</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp;a. Peraturan Daerah Nomor 7 Tahun 2011 tentang Sekretariat Dewan Pengurus KORPRI Provinsi DKI &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Jakarta dan;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp;b.Peraturan Gubernur Provinsi DKI Jakarta Nomor 213 Tahun 2012 tentang Organisasi dan Tata Kerja &nbsp; &nbsp; &nbsp; &nbsp; Sekretariat Dewan Pengurus KORPRI Provinsi DKI Jakarta;</p>\n\n<p style="text-align:justify">(2) Sekretariat Dewan Pengurus KORPRI Provinsi DKI Jakarta dipimpin oleh seorang Sekretaris yang &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;merupakan pejabat struktural eselon II;</p>\n\n<p style="text-align:justify">(3) Dewan Pengurus KORPRI Provinsi DKI Jakarta dalam menyelenggarakan fungsi dan tugasnya &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;didukung oleh Sekretariat Dewan Pengurus KORPRI Provinsi DKI Jakarta;</p>\n\n<p style="text-align:justify"><strong>DEWAN PENGURUS KORPRI PROVINSI DKI JAKARTA:</strong></p>\n\n<p style="text-align:justify">(1) Dewan Pengurus KORPRI Provinsi DKI Jakarta bersifat kolektif dan dipilih oleh musyawarah provinsi;</p>\n\n<p style="text-align:justify">(2) Dewan Pengurus KORPRI Provinsi DKI Jakarta bertugas melaksanakan program KORPRI Provinsi DKI &nbsp; &nbsp; &nbsp;Jakarta berdasarkan keputusan musyawarah provinsi sebagai penjabaran Program Nasional KORPRI;</p>\n\n<p style="text-align:justify">(3) Susunan Dewan Pengurus KORPRI Provinsi DKI Jakarta terdiri atas:</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp;a. Seorang Ketua;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp;b. Sebanyak-banyaknya empat orang Wakil Ketua;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp;c. Ketua Bidang, sekurang-kurangnya:</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp; &nbsp; &ndash; Bidang Organisasi dan Kelembagaan;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp; &nbsp; &ndash; Bidang Pembinaan Disiplin, Jiwa Korps dan Wawasan Kebangsaan;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp; &nbsp; &ndash; Bidang Perlindungan dan Bantuan Hukum;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp; &nbsp; &ndash; Bidang Usaha dan Kesejahteraan;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp; &nbsp; &ndash; Bidang Kerohanian, Olahraga dan Sosial Budaya;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp; &nbsp; &ndash; Bidang Peningkatan Peran Perempuan dan Pengabdian Masyarakat;</p>\n\n<p style="text-align:justify">&nbsp; &nbsp; &nbsp; &nbsp; &ndash; Bidang Pengendalian (sesuai kebutuhan).</p>\n\n<p style="text-align:justify">(4) Dewan Pengurus KORPRI Provinsi DKI Jakarta dikukuhkan oleh Dewan Pengurus KORPRI Nasional.</p>\n', 1, 'korpri, dki, jakarta', 'tentang korpri', 'A', 30, 0, '#00ff19', 'adminkorpri', '2016-04-02 16:14:03', 'admin', '2016-06-15 11:09:09', 1, ''),
(35, 'News', 'news', '', 1, '', '', 'A', NULL, 0, '#ff0000', 'admin', '2016-08-28 02:11:59', NULL, NULL, 2, 'front/news/home');

-- --------------------------------------------------------

--
-- Table structure for table `X_PENANGKAR`
--

CREATE TABLE `X_PENANGKAR` (
  `ID` int(11) unsigned NOT NULL,
  `ID_INSTITUTION` int(11) DEFAULT NULL,
  `DEST_CITY` varchar(30) DEFAULT NULL,
  `DEST_STATE` varchar(40) DEFAULT NULL,
  `VOL_3S` int(9) DEFAULT NULL,
  `VOL_4S` int(9) DEFAULT NULL,
  `SEND_DATE` date DEFAULT NULL,
  `PRODUCER` varchar(40) DEFAULT NULL,
  `SENDER` varchar(40) DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_PENANGKAR`
--

INSERT INTO `X_PENANGKAR` (`ID`, `ID_INSTITUTION`, `DEST_CITY`, `DEST_STATE`, `VOL_3S`, `VOL_4S`, `SEND_DATE`, `PRODUCER`, `SENDER`, `CREATED_AT`, `UPDATED_AT`) VALUES
(5, 1, 'as', 'AUK', 101, 10, '2008-03-13', 'PT AUK', 'saya', '2016-09-09 03:07:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `X_PESEBARAN`
--

CREATE TABLE `X_PESEBARAN` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ID_WILAYAH` int(11) NOT NULL,
  `barang` varchar(30) NOT NULL,
  `bs` int(11) NOT NULL,
  `fs` int(11) NOT NULL,
  `ss` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_PESEBARAN`
--

INSERT INTO `X_PESEBARAN` (`id`, `name`, `ID_WILAYAH`, `barang`, `bs`, `fs`, `ss`, `created_at`, `updated_at`) VALUES
(1, 'coba', 8, '3s', 10, 10, 10, '2016-09-08 06:51:42', '2016-09-07 17:00:00'),
(2, 'cek', 8, '4s', 11, 12, 11, '2016-09-08 07:15:25', '0000-00-00 00:00:00'),
(4, 'adasdsad', -1, 'as', 1, 1, 1, '2016-09-08 07:18:11', '0000-00-00 00:00:00'),
(5, 'cekeeka', 10, '3s', 100, 2300, 102, '2016-09-08 07:30:40', '0000-00-00 00:00:00'),
(6, 'Muhammad Zulfa F', 11, '3s', 0, 0, 99, '2016-09-09 00:50:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `X_POTO_GAL`
--

CREATE TABLE `X_POTO_GAL` (
  `ID` int(11) NOT NULL,
  `ID_KAT` int(11) DEFAULT NULL,
  `KANAL` int(11) DEFAULT NULL,
  `TITLE` varchar(200) DEFAULT NULL,
  `POTOGRAFER` varchar(100) DEFAULT NULL,
  `URL` varchar(500) DEFAULT NULL,
  `EMBED` text COMMENT 'I',
  `HTML` text,
  `DESC` text,
  `TYPE` char(1) DEFAULT NULL COMMENT 'I = image, F = Flash, C = Custom',
  `POTO_DATE` varchar(11) NOT NULL,
  `STATUS` char(1) DEFAULT NULL COMMENT 'A = Aktif, N = Non Aktif',
  `CREATED_BY` varchar(100) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(100) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_POTO_GAL`
--

INSERT INTO `X_POTO_GAL` (`ID`, `ID_KAT`, `KANAL`, `TITLE`, `POTOGRAFER`, `URL`, `EMBED`, `HTML`, `DESC`, `TYPE`, `POTO_DATE`, `STATUS`, `CREATED_BY`, `CREATED_DATE`, `UPDATED_BY`, `UPDATED_DATE`) VALUES
(1, 1, 0, '1', '0', '0', '20160417035609.jpg', NULL, 'aa', 'I', '17-04-2016', 'A', 'korpriadmin', '2016-04-17 03:56:09', NULL, NULL),
(2, 2, 0, '2', '0', NULL, NULL, 'https://c3.staticflickr.com/6/5043/5210892354_f0b11789a0_b.jpg', 'aaa', 'C', '17-04-2016', 'A', 'korpriadmin', '2016-04-17 03:57:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `X_POTO_KAT`
--

CREATE TABLE `X_POTO_KAT` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(200) DEFAULT NULL,
  `DESC` text,
  `KAT_DATE` date NOT NULL,
  `STATUS` char(1) DEFAULT NULL COMMENT 'A = Aktif, N = Non Aktif',
  `CREATED_BY` varchar(100) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(100) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_POTO_KAT`
--

INSERT INTO `X_POTO_KAT` (`ID`, `TITLE`, `DESC`, `KAT_DATE`, `STATUS`, `CREATED_BY`, `CREATED_DATE`, `UPDATED_BY`, `UPDATED_DATE`) VALUES
(1, 'foto1', 'aaa', '2016-04-17', 'A', 'korpriadmin', '2016-04-10 14:09:00', 'korpriadmin', '2016-04-17 03:53:52'),
(2, 'foto2', 'foto2', '2016-04-17', 'A', 'korpriadmin', '2016-04-17 03:54:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `X_SETTING`
--

CREATE TABLE `X_SETTING` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `VALUE` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_SETTING`
--

INSERT INTO `X_SETTING` (`ID`, `NAME`, `VALUE`) VALUES
(1, 'Site Title', 'PADI IPB'),
(2, 'Site Subtitle', 'PADI IPB'),
(3, 'Meta Description', 'PADI PADI PADI IPB'),
(4, 'Meta Keyword', 'Biro,Dikmental,Pendidikan,Mental,Spiritual'),
(5, 'Facebook Username', 'Biro-Dikmental-Prov-DKI-Jakarta'),
(6, 'Twitter Username', 'dikmental'),
(7, 'FB App ID', '132341613495275'),
(8, 'FB Admin ID', '132341613495275');

-- --------------------------------------------------------

--
-- Table structure for table `X_STATUS`
--

CREATE TABLE `X_STATUS` (
  `ID` int(3) NOT NULL,
  `STATUS` varchar(40) NOT NULL,
  `DESC` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_STATUS`
--

INSERT INTO `X_STATUS` (`ID`, `STATUS`, `DESC`) VALUES
(1, 'Penangkar', 'Lembaga Penangkar');

-- --------------------------------------------------------

--
-- Table structure for table `X_STOK`
--

CREATE TABLE `X_STOK` (
  `ID` int(11) NOT NULL,
  `ID_INSTITUTION` int(11) NOT NULL,
  `DATE` date NOT NULL,
  `ID_BENIH` int(11) NOT NULL,
  `JUMLAH` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_STOK`
--

INSERT INTO `X_STOK` (`ID`, `ID_INSTITUTION`, `DATE`, `ID_BENIH`, `JUMLAH`) VALUES
(2, 0, '2016-04-03', 1, 101),
(7, 3, '2016-09-10', -1, 1),
(8, 3, '2016-09-10', 2, 1),
(9, 2, '2016-09-10', 2, 1),
(10, 1, '2016-09-10', 2, 121);

-- --------------------------------------------------------

--
-- Table structure for table `X_USERS`
--

CREATE TABLE `X_USERS` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `FULLNAME` varchar(200) DEFAULT NULL,
  `IMAGE` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PHONE` varchar(50) DEFAULT NULL,
  `ADDRESS` varchar(300) DEFAULT NULL,
  `BIO` longtext,
  `STATUS` char(4) DEFAULT NULL,
  `ROLE` tinyint(4) NOT NULL DEFAULT '3',
  `UPDATED_BY` varchar(100) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(255) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_USERS`
--

INSERT INTO `X_USERS` (`ID`, `USERNAME`, `PASSWORD`, `FULLNAME`, `IMAGE`, `EMAIL`, `PHONE`, `ADDRESS`, `BIO`, `STATUS`, `ROLE`, `UPDATED_BY`, `UPDATED_DATE`, `CREATED_BY`, `CREATED_DATE`) VALUES
(1, 'admin', '69a5ad4945060907d0bd682b6aa2136a', 'Admin Web', 'efriandika.png', 'rahan.rama@gmail.com', '08128627250', '<p>Jln. Johar VIII, No. 9<br />\nTaman Cimanggu, Kota Bogor<br />\n<strong>Jawa Barat</strong></p>\n', '', 'A', 1, 'jametson', '2015-08-22 13:05:21', 'admin', '2013-05-07 14:34:32'),
(2, 'korpriadmin', '69a5ad4945060907d0bd682b6aa2136a', 'Admin Korpri', NULL, 'biro_pms@yahoo.com', '-', '', '\n', 'A', 1, NULL, NULL, 'jametson', '2015-08-22 13:23:04'),
(3, 'lampung', '2b85eb1a513ed871537575dac38db1dd', 'Lampung 1', NULL, 'cek@cek.com', '08969069', '<p>jl alpa</p>\n', '<p>cek</p>\n', 'A', 2, NULL, NULL, 'admin', '2016-09-09 08:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `X_WILAYAH`
--

CREATE TABLE `X_WILAYAH` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `LAT` double NOT NULL,
  `LNG` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `X_WILAYAH`
--

INSERT INTO `X_WILAYAH` (`ID`, `NAME`, `LAT`, `LNG`) VALUES
(8, 'Bogor', -6.597682952880859, 106.80285233569032),
(10, 'Jakarta', -6.1744651, 106.82274499999994),
(11, 'Sulawesi', -4.5585849, 105.40680789999999),
(12, 'Aceh', 4.695135, 96.74939930000005);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link_kategori`
--
ALTER TABLE `link_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`ID`), ADD KEY `PARENT` (`PARENT`);

--
-- Indexes for table `X_AGENDA`
--
ALTER TABLE `X_AGENDA`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `X_BENIH`
--
ALTER TABLE `X_BENIH`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `X_DOWNLOAD`
--
ALTER TABLE `X_DOWNLOAD`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `X_DOWNLOAD_CATEGORY`
--
ALTER TABLE `X_DOWNLOAD_CATEGORY`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `X_LEMBAGA`
--
ALTER TABLE `X_LEMBAGA`
  ADD PRIMARY KEY (`ID`), ADD KEY `ID_STATUS` (`ID_STATUS`);

--
-- Indexes for table `X_NEWS`
--
ALTER TABLE `X_NEWS`
  ADD PRIMARY KEY (`NEWS_ID`), ADD KEY `CAT` (`CAT`);

--
-- Indexes for table `X_NEWS_CATEGORY`
--
ALTER TABLE `X_NEWS_CATEGORY`
  ADD PRIMARY KEY (`ID`), ADD KEY `PARENT` (`PARENT`);

--
-- Indexes for table `X_NEWS_COMMENT`
--
ALTER TABLE `X_NEWS_COMMENT`
  ADD PRIMARY KEY (`ID`), ADD KEY `NEWS` (`NEWS`);

--
-- Indexes for table `X_NEWS_TAGS`
--
ALTER TABLE `X_NEWS_TAGS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `X_NEWS_TAGS_REL`
--
ALTER TABLE `X_NEWS_TAGS_REL`
  ADD PRIMARY KEY (`ID`), ADD KEY `NEWS_ID` (`NEWS_ID`), ADD KEY `TAG_ID` (`TAG_ID`), ADD KEY `TAG_ID_2` (`TAG_ID`);

--
-- Indexes for table `x_pages`
--
ALTER TABLE `x_pages`
  ADD PRIMARY KEY (`ID`), ADD KEY `PARENT` (`PARENT`);

--
-- Indexes for table `X_PENANGKAR`
--
ALTER TABLE `X_PENANGKAR`
  ADD PRIMARY KEY (`ID`), ADD KEY `fk_lembaga` (`ID_INSTITUTION`);

--
-- Indexes for table `X_PESEBARAN`
--
ALTER TABLE `X_PESEBARAN`
  ADD PRIMARY KEY (`id`), ADD KEY `ID_WILAYAH` (`ID_WILAYAH`);

--
-- Indexes for table `X_POTO_GAL`
--
ALTER TABLE `X_POTO_GAL`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `X_POTO_KAT`
--
ALTER TABLE `X_POTO_KAT`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `X_SETTING`
--
ALTER TABLE `X_SETTING`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `X_STATUS`
--
ALTER TABLE `X_STATUS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `X_STOK`
--
ALTER TABLE `X_STOK`
  ADD PRIMARY KEY (`ID`), ADD KEY `INSTITUTION_ID` (`ID_INSTITUTION`), ADD KEY `ID_BENIH` (`ID_BENIH`);

--
-- Indexes for table `X_USERS`
--
ALTER TABLE `X_USERS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `X_WILAYAH`
--
ALTER TABLE `X_WILAYAH`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `link_kategori`
--
ALTER TABLE `link_kategori`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `X_AGENDA`
--
ALTER TABLE `X_AGENDA`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `X_BENIH`
--
ALTER TABLE `X_BENIH`
  MODIFY `ID` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `X_DOWNLOAD`
--
ALTER TABLE `X_DOWNLOAD`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `X_DOWNLOAD_CATEGORY`
--
ALTER TABLE `X_DOWNLOAD_CATEGORY`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `X_LEMBAGA`
--
ALTER TABLE `X_LEMBAGA`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `X_NEWS`
--
ALTER TABLE `X_NEWS`
  MODIFY `NEWS_ID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT for table `X_NEWS_CATEGORY`
--
ALTER TABLE `X_NEWS_CATEGORY`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `X_NEWS_COMMENT`
--
ALTER TABLE `X_NEWS_COMMENT`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `X_NEWS_TAGS`
--
ALTER TABLE `X_NEWS_TAGS`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `X_NEWS_TAGS_REL`
--
ALTER TABLE `X_NEWS_TAGS_REL`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `x_pages`
--
ALTER TABLE `x_pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `X_PENANGKAR`
--
ALTER TABLE `X_PENANGKAR`
  MODIFY `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `X_PESEBARAN`
--
ALTER TABLE `X_PESEBARAN`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `X_POTO_GAL`
--
ALTER TABLE `X_POTO_GAL`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `X_POTO_KAT`
--
ALTER TABLE `X_POTO_KAT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `X_SETTING`
--
ALTER TABLE `X_SETTING`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `X_STATUS`
--
ALTER TABLE `X_STATUS`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `X_STOK`
--
ALTER TABLE `X_STOK`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `X_USERS`
--
ALTER TABLE `X_USERS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `X_WILAYAH`
--
ALTER TABLE `X_WILAYAH`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `program`
--
ALTER TABLE `program`
ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`PARENT`) REFERENCES `x_pages` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `X_LEMBAGA`
--
ALTER TABLE `X_LEMBAGA`
ADD CONSTRAINT `fk_status` FOREIGN KEY (`ID_STATUS`) REFERENCES `X_STATUS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `x_pages`
--
ALTER TABLE `x_pages`
ADD CONSTRAINT `x_pages_ibfk_1` FOREIGN KEY (`PARENT`) REFERENCES `x_pages` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `X_PENANGKAR`
--
ALTER TABLE `X_PENANGKAR`
ADD CONSTRAINT `fk_lembaga` FOREIGN KEY (`ID_INSTITUTION`) REFERENCES `X_LEMBAGA` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
