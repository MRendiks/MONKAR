-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jun 2023 pada 15.52
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monkar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobdesk`
--

CREATE TABLE `jobdesk` (
  `id_jobdesk` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `kategori_job` varchar(255) NOT NULL,
  `project_name` varchar(250) NOT NULL,
  `tgl_upload` date NOT NULL,
  `deadline` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jobdesk`
--

INSERT INTO `jobdesk` (`id_jobdesk`, `id_karyawan`, `kategori_job`, `project_name`, `tgl_upload`, `deadline`, `status`) VALUES
(1, 2, 'menambahkan', 'menambahkan karyawan', '2023-03-12', '2023-03-13', 100),
(17, 4, 'Coba', 'Mencoba', '0000-00-00', '2023-06-08', 0),
(18, 2, 'Daftar Ujian', 'Kelengkapan Berkas', '0000-00-00', '2023-06-09', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobdesk_list`
--

CREATE TABLE `jobdesk_list` (
  `id_list_jobdesk` int(11) NOT NULL,
  `id_jobdesk` int(11) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `status` enum('Selesai','Belum Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jobdesk_list`
--

INSERT INTO `jobdesk_list` (`id_list_jobdesk`, `id_jobdesk`, `keterangan`, `status`) VALUES
(1, 1, 'Coba Selesai Kan Dulu', 'Selesai'),
(3, 1, 'ayoo coba', 'Selesai'),
(4, 1, 'rerere', 'Selesai'),
(5, 1, 'hehe', 'Selesai'),
(15, 18, 'Fotocopy Ijazah', 'Selesai'),
(16, 18, 'Fotocopy Biodata', 'Selesai'),
(17, 18, 'Toefl', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Nama_lengkap` varchar(250) NOT NULL,
  `NIK` int(16) NOT NULL,
  `Jabatan` enum('Admin','Manager','Karyawan') NOT NULL,
  `Jenis_Kelamin` enum('Laki-Laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `username`, `password`, `Nama_lengkap`, `NIK`, `Jabatan`, `Jenis_Kelamin`) VALUES
(1, 'admin', 'admin', 'Adminstrator', 1234567890, 'Admin', 'Laki-Laki'),
(2, 'ija', 'ija', 'ija', 1232, 'Karyawan', 'Perempuan'),
(4, 'manager', 'manager', 'manager', 12345, 'Manager', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kinerja`
--

CREATE TABLE `kinerja` (
  `id_kinerja` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kinerja`
--

INSERT INTO `kinerja` (`id_kinerja`, `id_karyawan`, `bulan`, `tahun`, `nilai`) VALUES
(2, 2, 3, 2023, 100);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jobdesk`
--
ALTER TABLE `jobdesk`
  ADD PRIMARY KEY (`id_jobdesk`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `jobdesk_list`
--
ALTER TABLE `jobdesk_list`
  ADD PRIMARY KEY (`id_list_jobdesk`),
  ADD KEY `id_jobdesk` (`id_jobdesk`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `kinerja`
--
ALTER TABLE `kinerja`
  ADD PRIMARY KEY (`id_kinerja`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jobdesk`
--
ALTER TABLE `jobdesk`
  MODIFY `id_jobdesk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `jobdesk_list`
--
ALTER TABLE `jobdesk_list`
  MODIFY `id_list_jobdesk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kinerja`
--
ALTER TABLE `kinerja`
  MODIFY `id_kinerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jobdesk`
--
ALTER TABLE `jobdesk`
  ADD CONSTRAINT `jobdesk_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `jobdesk_list`
--
ALTER TABLE `jobdesk_list`
  ADD CONSTRAINT `jobdesk_list_ibfk_1` FOREIGN KEY (`id_jobdesk`) REFERENCES `jobdesk` (`id_jobdesk`);

--
-- Ketidakleluasaan untuk tabel `kinerja`
--
ALTER TABLE `kinerja`
  ADD CONSTRAINT `kinerja_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
