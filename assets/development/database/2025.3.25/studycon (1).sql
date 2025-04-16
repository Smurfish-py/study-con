-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Mar 2025 pada 06.40
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
-- Struktur dari tabel `anggota_kelas`
--

CREATE TABLE `anggota_kelas` (
  `id` int(255) NOT NULL,
  `id_kelas` int(255) NOT NULL,
  `id_murid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota_kelas`
--

INSERT INTO `anggota_kelas` (`id`, `id_kelas`, `id_murid`) VALUES
(1, 98104, 16),
(2, 52423, 16),
(3, 71006, 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_tugas_guru`
--

CREATE TABLE `file_tugas_guru` (
  `id_file` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `id_kelas` int(255) NOT NULL,
  `id_guru` int(255) NOT NULL,
  `nama_file` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_tugas`
--

CREATE TABLE `guru_tugas` (
  `id` int(255) NOT NULL,
  `id_guru` int(255) NOT NULL,
  `id_kelas` int(255) NOT NULL,
  `judul` varchar(1000) NOT NULL,
  `deskripsi` varchar(3000) NOT NULL,
  `tipe` char(10) NOT NULL,
  `id_file` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(255) NOT NULL,
  `id_guru` int(255) NOT NULL,
  `nama_kelas` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `deskripsi_kelas` varchar(1000) NOT NULL,
  `gambar_header_kelas` varchar(1000) NOT NULL,
  `status_kelas` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `id_guru`, `nama_kelas`, `password`, `deskripsi_kelas`, `gambar_header_kelas`, `status_kelas`) VALUES
(52423, 11, 'Dummy Class 2 : Second Dummy', '', 'Hello :D', '', 'active'),
(71006, 18, 'Dummy Class 3 : The Last Dummy', '', 'This is dummy class by second teacher account', '71006_wp12431802-porter-robinson-nurture-wallpapers.jpg', 'active'),
(98104, 11, 'Dummy Class : The First Class', '123', 'Hello!', '98104_wp12431747-porter-robinson-nurture-wallpapers.png', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `murid_tugas`
--

CREATE TABLE `murid_tugas` (
  `id` int(255) NOT NULL,
  `id_murid` int(255) NOT NULL,
  `id_kelas` int(255) NOT NULL,
  `nama_file` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id_guru` int(255) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `teacher_log`
--

INSERT INTO `teacher_log` (`id`, `id_guru`, `waktu`, `log`) VALUES
(1, 11, '2025-03-25 05:38:58', 'default@default.net bergabung kedalam kelas anda, id kelas : 98104'),
(2, 11, '2025-03-25 05:39:09', 'default@default.net bergabung kedalam kelas anda, id kelas : 52423'),
(3, 18, '2025-03-25 05:39:18', 'default@default.net bergabung kedalam kelas anda, id kelas : 71006');

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
(10, 'admin@admin.com', 'Muhamad Rifqi Kurniawan', 'Nanashi', '123', '29 Juli 2007', 'SMK Negeri 1 Cimahi', 0, 'XI SIJA A', '', '', 'master', '10_SMILE.jpg', 'active'),
(11, 'teacher@teacher.edu', 'Beta Tester', 'Beta Tester', '123', '', '', 0, '', 'SMK Negeri 1 Cimahi', 'IPA, IPS', 'teacher', '11_Porter_Robinson_-_Nurture.png', 'active'),
(16, 'default@default.net', '', 'Beta Tester', '123', '', '', 0, '', '', '', 'default', '', 'active'),
(18, 'second@teacher.edu', '', 'Dummy Teacher Account', '123', '', '', 0, '', '', '', 'teacher', '', 'active');

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
-- Dumping data untuk tabel `website_log`
--

INSERT INTO `website_log` (`id`, `waktu`, `log`) VALUES
(1, '2025-03-25 05:38:58', 'default@default.net bergabung kedalam kelas dengan id kelas : 98104'),
(2, '2025-03-25 05:39:09', 'default@default.net bergabung kedalam kelas dengan id kelas : 52423'),
(3, '2025-03-25 05:39:18', 'default@default.net bergabung kedalam kelas dengan id kelas : 71006');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota_kelas`
--
ALTER TABLE `anggota_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `file_tugas_guru`
--
ALTER TABLE `file_tugas_guru`
  ADD PRIMARY KEY (`id_file`);

--
-- Indeks untuk tabel `guru_tugas`
--
ALTER TABLE `guru_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `murid_tugas`
--
ALTER TABLE `murid_tugas`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `anggota_kelas`
--
ALTER TABLE `anggota_kelas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `file_tugas_guru`
--
ALTER TABLE `file_tugas_guru`
  MODIFY `id_file` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `guru_tugas`
--
ALTER TABLE `guru_tugas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `murid_tugas`
--
ALTER TABLE `murid_tugas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `website_log`
--
ALTER TABLE `website_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
