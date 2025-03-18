-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2025 pada 01.51
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studycon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `penulis` varchar(1000) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `isi` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_status`
--

CREATE TABLE `request_status` (
  `id` int(100) NOT NULL,
  `id_pengguna` int(100) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status_req` varchar(10) NOT NULL,
  `alasan` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `request_status`
--

INSERT INTO `request_status` (`id`, `id_pengguna`, `nama_lengkap`, `email`, `status_req`, `alasan`) VALUES
(8, 16, '', 'a@a.net', 'teacher', 'Halo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teacher_log`
--

CREATE TABLE `teacher_log` (
  `id` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `fullname` varchar(1000) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `tgl_lahir` varchar(1000) NOT NULL,
  `sekolah` varchar(1000) NOT NULL,
  `NIS` int(255) NOT NULL,
  `kelas` varchar(1000) NOT NULL,
  `guru_tmpt_mengajar` varchar(1000) NOT NULL,
  `guru_mapel` varchar(1000) NOT NULL,
  `status` varchar(1000) NOT NULL,
  `foto_profil` varchar(1000) NOT NULL,
  `status_akun` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `fullname`, `username`, `password`, `tgl_lahir`, `sekolah`, `NIS`, `kelas`, `guru_tmpt_mengajar`, `guru_mapel`, `status`, `foto_profil`, `status_akun`) VALUES
(10, 'm.rifki0729@gmail.com', 'Muhamad Rifqi Kurniawan', 'Nanashi', '123', '29 Juli 2007', 'SMK Negeri 1 Cimahi', 0, 'XI SIJA A', '', '', 'master', '10_SMILE.jpg', 'active'),
(11, 'test@test.com', 'Beta Tester', 'Beta Tester', 'test', '', '', 0, '', 'SMK Negeri 1 Cimahi', 'IPA, IPS', 'teacher', '11_Porter_Robinson_-_Nurture.png', 'active'),
(16, 'a@a.net', '', 'Beta_test', 'a', '', '', 0, '', '', '', 'teacher', '', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `website_log`
--

CREATE TABLE `website_log` (
  `id` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `request_status`
--
ALTER TABLE `request_status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `teacher_log`
--
ALTER TABLE `teacher_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `website_log`
--
ALTER TABLE `website_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `request_status`
--
ALTER TABLE `request_status`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `teacher_log`
--
ALTER TABLE `teacher_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `website_log`
--
ALTER TABLE `website_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
