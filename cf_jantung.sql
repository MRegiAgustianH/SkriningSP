-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2023 at 08:40 AM
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
-- Database: `cf_jantung`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `gambar`, `isi`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'Pengertian Penyakit Jantung', 'public/files/eU4sO5g9P4W4IFTj9g9EXWVQjwid39czFBphnbBf.jpg', '<p>Penyakit jantung adalah kondisi ketika bagian jantung yang meliputi pembuluh darah jantung, selaput jantung, katup jantung, dan otot jantung mengalami gangguan. Penyakit jantung bisa disebabkan oleh berbagai hal, seperti sumbatan pada pembuluh darah jantung, peradangan, infeksi, atau kelainan bawaan.</p>\r\n<p>Jantung adalah organ vital yang terdiri dari otot dan terbagi menjadi empat ruang. Ruang jantung dibatasi oleh katup jantung yang berfungsi mengatur aliran darah agar bergerak ke satu arah.</p>\r\n<p>Pada dinding jantung, terdapat pembuluh darah jantung atau arteri koroner yang mengalirkan darah kaya oksigen ke seluruh bagian jantung. Pembuluh ini memiliki dua cabang, yaitu pembuluh darah koroner kanan dan kiri.</p>\r\n<p>Jantung juga memiliki dua selaput yang disebut perikardium. Fungsinya adalah untuk melindungi jantung, menjaga posisi jantung tetap pada tempatnya, dan mencegah terjadinya luka akibat gesekan ketika berdenyut.</p>', 1, '2023-07-20 06:12:53', '2023-07-20 06:12:53'),
(4, 'Jenis, Gejala, dan Penyebab Penyakit Jantung', 'public/files/rSdUEDoNwod5w5EzXzAVYSvFeD0tsArFmt29WNuF.jpg', '<p>Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung.</p>\r\n<p>Saat ini penyakit jantung masih menjadi salah satu penyebab utama kematian tertinggi di Indonesia dan dunia baik pria maupun wanita pada segala usia. Terdapat beberapa jenis penyakit jantung antara lain:</p>\r\n<p>1. Penyakit Jantung Koroner</p>\r\n<p>Penyakit jantung koroner disebabkan oleh adanya penyumbatan pada pembuluh darah arteri oleh tumpukan plak maupun zat-zat kimia dari makanan dan minuman. Hal tersebut membuat adanya penggumpalan darah pada bagian arteri sehingga aliran darah terganggu.</p>\r\n<p>&nbsp;</p>\r\n<p>2. Kelainan Irama Jantung</p>\r\n<p>Kelainan irama jantung atau aritmia merupakan kondisi dimana laju irama jantung tidak normal. Laju dapat terasa terlalu cepat, terlalu lambat, atau ritmenya tidak teratur. Pada umumnya kelainan irama jantung tergolong tidak berbahaya, dapat menimbulkan gejala dan komplikasi yang parah apabila penyakit ini muncul karena adanya kondisi gangguan jantung lemah atau rusak.</p>\r\n<p>&nbsp;</p>\r\n<p>3. Penyakit Jantung Bawaan</p>\r\n<p>Penyakit jantung bawaan sebagian besar disebabkan adanya kelainan struktur maupun fungsi jantung sejak bayi dalam kandungan. ASD (Atrial Septal Defect) dan VSD (Ventricular Septal Defect) atau yang lebih&nbsp; dikenal sebagai jantung bocor merupakan penyakit jantung bawaan yang umum terjadi. Penyakit jantung bawaan dapat terjadi karena turunan genetik dari salah satu atau kedua orang tua.</p>\r\n<p>&nbsp;</p>\r\n<p>4. Kelainan Katup atau Klep Jantung</p>\r\n<p>Kelainan klep jantung merupakan penyakit yang terjadi ketika katup jantung tidak berfungsi sebagaimana mestinya. Katup jantung yang tidak berfungsi dengan baik dapat menyebabkan darah dapat mengarah balik dan sulit keluar dari jantung. Kondisi ini juga dapat menyebabkan terbentuknya lubang kecil pada sekat jantung yang dusebut jantung bocor.</p>\r\n<p>&nbsp;</p>\r\n<p>5. Gagal Jantung</p>\r\n<p>Gagal jantung adalah kondisi dimana jantung tidak dapat memompa darah dengan optimal sehingga darah yang dipompa tidak membawa oksigen dan nutrisi yang cukup dan tubuh menjadi kesulitan untuk mendapat kebutuhannya.</p>', 1, '2023-07-20 06:14:07', '2023-07-20 06:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `id` bigint UNSIGNED NOT NULL,
  `penyakit_id` bigint UNSIGNED NOT NULL,
  `gejala_id` bigint UNSIGNED NOT NULL,
  `cf_pakar` double(8,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`id`, `penyakit_id`, `gejala_id`, `cf_pakar`) VALUES
(2, 1, 1, 0.8),
(3, 1, 2, 0.5),
(4, 1, 3, 0.5),
(5, 1, 4, 0.4),
(6, 1, 5, 0.6),
(7, 1, 6, 0.5),
(8, 1, 7, 0.5),
(9, 1, 8, 0.5),
(10, 1, 17, 0.8),
(11, 2, 1, 0.5),
(12, 2, 2, 0.5),
(13, 2, 14, 0.5),
(14, 2, 15, 0.5),
(15, 2, 18, 0.5),
(16, 3, 10, 0.8),
(17, 3, 11, 0.8),
(18, 3, 12, 0.6),
(19, 3, 13, 0.5),
(20, 3, 14, 0.4),
(21, 4, 4, 0.8),
(22, 4, 12, 0.6),
(23, 4, 14, 0.6),
(24, 4, 15, 0.8),
(25, 4, 16, 0.5),
(26, 4, 17, 0.8),
(27, 5, 1, 0.5),
(28, 5, 12, 0.5),
(29, 5, 14, 0.5),
(30, 5, 16, 0.5),
(31, 5, 17, 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_gejala` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_gejala` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id`, `kode_gejala`, `nama_gejala`) VALUES
(1, 'G001', 'Nyeri dada'),
(2, 'G002', 'Nyeri lengan kiri'),
(3, 'G003', 'Nyeri bahu kiri'),
(4, 'G004', 'Sesak nafas'),
(5, 'G005', 'Keringat dingin'),
(6, 'G006', 'Mual'),
(7, 'G007', 'Nyeri leher'),
(8, 'G008', 'Nyeri rahang'),
(9, 'G009', 'Nyeri punggung'),
(10, 'G010', 'Sakit kepala'),
(11, 'G011', 'Pendarahan dari hidung'),
(12, 'G012', 'Pusing'),
(13, 'G013', 'Wajah kemerahan'),
(14, 'G014', 'Mudah Lelah'),
(15, 'G015', 'Kaki bengkak'),
(16, 'G016', 'Jantung berdebar-debar'),
(17, 'G017', 'Detak jantung tidak teratur'),
(18, 'G018', 'Batuk terutama saat berbaring');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gejala` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `penyakit_id` bigint UNSIGNED DEFAULT NULL,
  `cf` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `nama`, `no_hp`, `jenis_kelamin`, `alamat`, `gejala`, `penyakit_id`, `cf`, `created_at`, `updated_at`) VALUES
(4, 'Jajang Mulyana', '02657234564', 'Laki-Laki', 'Jl. Merak No. 99', 'a:4:{i:0;s:21:\"G001 - Nyeri dada (5)\";i:1;s:28:\"G002 - Nyeri lengan kiri (5)\";i:2;s:25:\"G009 - Nyeri punggung (3)\";i:3;s:23:\"G010 - Sakit kepala (3)\";}', 1, 63.60, '2023-07-20 06:30:41', '2023-07-20 06:30:41'),
(5, 'Jajang Mulyana', '02657234564', 'Laki-Laki', 'Jl. Merak No. 99', 'a:3:{i:0;s:21:\"G001 - Nyeri dada (3)\";i:1;s:22:\"G004 - Sesak nafas (6)\";i:2;s:23:\"G008 - Nyeri rahang (7)\";}', 1, 68.23, '2023-07-20 09:00:16', '2023-07-20 09:00:16'),
(6, 'Irman Firmansyah', '085223949111', 'Laki-Laki', 'Dusun Kalapasabrang Langensari', 'a:5:{i:0;s:21:\"G001 - Nyeri dada (8)\";i:1;s:22:\"G004 - Sesak nafas (4)\";i:2;s:17:\"G012 - Pusing (6)\";i:3;s:22:\"G014 - Mudah Lelah (2)\";i:4;s:38:\"G017 - Detak jantung tidak teratur (6)\";}', 4, 92.38, '2023-07-22 07:58:53', '2023-07-22 07:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_penyakit` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penyakit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `solusi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id`, `kode_penyakit`, `nama_penyakit`, `deskripsi`, `solusi`) VALUES
(1, 'P01', 'Jantung Koroner', 'Penyakit jantung koroner', '<p>Solusi penanganan penyakit jantung koroner</p>'),
(2, 'P02', 'Jantung Kongesif/Gagal Jantung', 'Penyakit jantung kongesif/gagal jantung', '<p>Solusi penanganan penyakit jantung kongesif/gagal jantung</p>'),
(3, 'P03', 'Jantung Hipertensi', 'Penyakit jantung hipertensi', '<p>Solusi penanganan penyakit jantung hipertensi</p>'),
(4, 'P04', 'Jantung Kardiomiopati', 'Penyakit jantung kardiomiopati', '<p>Solusi penanganan penyakit jantung kardiomiopati</p>'),
(5, 'P05', 'Aritmia Jantung', 'Penyakit aritmia jantung', '<p>Solusi penanganan penyakit aritmia jantung</p>');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` bigint UNSIGNED NOT NULL,
  `profil` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `profil`, `foto`) VALUES
(1, '<p>Aplikasi sistem pakar diagnosa awal penyakit jantung menggunakan metode certainty factor dan fuzzy adalah sebuah solusi inovatif untuk membantu pengguna dalam mendeteksi dini gejala-gejala penyakit jantung dan mengenali faktor risiko yang relevan. Dengan teknologi certainty factor, aplikasi ini memberikan tingkat kepercayaan yang tinggi dalam hasil diagnosanya berdasarkan data yang dikumpulkan dari pengguna, seperti gejala yang dialami dan riwayat kesehatan. Selain itu, pemanfaatan metode fuzzy memungkinkan aplikasi untuk mengatasi ketidakpastian data dan ambiguitas, sehingga memberikan hasil diagnosa yang lebih akurat.</p>\r\n<p>Aplikasi ini hadir dengan antarmuka yang mudah digunakan, sehingga pengguna dari berbagai latar belakang dapat dengan cepat memanfaatkan layanan ini. Pengguna dapat menginputkan gejala yang dirasakan, dan aplikasi akan memberikan diagnosa awal serta rekomendasi tindakan medis yang tepat berdasarkan data yang diberikan. Dengan kemampuan ini, aplikasi sistem pakar diagnosa awal penyakit jantung menjadi alat bantu yang sangat berharga dalam mendukung upaya deteksi dini dan pencegahan penyakit jantung, serta meningkatkan kesadaran masyarakat akan kesehatan jantung secara menyeluruh.</p>', 'public/files/J1CIMompVxzkxYeS4nZCJIcLi3oIe2iU1Xk7msSe.png');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Petugas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role_id`) VALUES
(1, 'Administrator', 'admin', '$2y$10$lXd5HHbSvQoJHlSlqOGoN.ZuYXL17hY0rFG9R5bqCn1yZJBr1rjA2', 1),
(4, 'Jajang Mulyana', 'petugas', '$2y$10$UWOaebxqypmq.7exIpfZh.BARJzevEzD9DdQy7wPM2H0xHHb.OOye', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_user_id_foreign` (`user_id`);

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aturan_penyakit_id_foreign` (`penyakit_id`),
  ADD KEY `aturan_gejala_id_foreign` (`gejala_id`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_penyakit_id_foreign` (`penyakit_id`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_gejala_id_foreign` FOREIGN KEY (`gejala_id`) REFERENCES `gejala` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aturan_penyakit_id_foreign` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_penyakit_id_foreign` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
