-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Nov 2024 pada 04.44
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_galeri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `albumid` int(11) NOT NULL,
  `namaalbum` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggalbuat` date DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`albumid`, `namaalbum`, `deskripsi`, `tanggalbuat`, `userid`) VALUES
(8, 'Black Sabbath', 'Cover Album Band Black Sabbath', '2024-11-05', 10),
(9, 'Gitar', 'Seputar Merk Gitar', '2024-11-05', 10),
(10, 'Anggota Nirvana & Nirvana', 'Berisi Anggota-Anggota Band Nirvana & Seputar Nirvana', '2024-11-05', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `fotoid` int(11) NOT NULL,
  `judulfoto` varchar(255) NOT NULL,
  `deskripsifoto` text NOT NULL,
  `tanggalunggah` date NOT NULL,
  `lokasifile` varchar(255) NOT NULL,
  `albumid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`fotoid`, `judulfoto`, `deskripsifoto`, `tanggalunggah`, `lokasifile`, `albumid`, `userid`) VALUES
(6, 'Album Black Sabbath', 'Cover Album', '2024-11-05', '926754365-BLACK SABBATH - Limited Edition CD Available Exclusively On 2016 The End World Tour.jpg', 8, 10),
(7, 'Metallica Guitar', 'Gitar Yang Di Pake Kirk Hammer', '2024-11-05', '141073932-METALLICA  signed AUTOGRAPHED full size GUITAR.jpg', 9, 10),
(8, 'Nirvana', 'Anggota Anggota Nirvana', '2024-11-05', '1333003362-Photos of Nirvana before grunge went mainstream.jpg', 10, 10),
(9, 'Album Nirvana', 'Album Nirvana Yang Bernamakan Nevermind Adalah Album Terlaku', '2024-11-05', '1388097613-Nevermind Nirvana cross stitch pattern pdf format.jpg', 10, 10),
(10, 'Gitar Curt Cobain', 'Gitar Ini Adalah gitar pertama Curt Cobain\r\nyang bernama fender mustang', '2024-11-05', '1637098087-Nirvana  Kurt Cobain  Guitar Art  1969 Fender Mustang - Etsy Canada _ Kurt cobain art, Nirvana art, Nirvana.jpg', 9, 10),
(12, 'Curt Cobain Kesal', 'Curt Cobain kesal karena gitar yang dia pakai fals atau gitar nya tidak enak', '2024-11-05', '1125717182-Kurt Cobain on violence caused by alienation….jpg', 10, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `komentarid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isikomentar` text NOT NULL,
  `tanggalkomentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komentarfoto`
--

INSERT INTO `komentarfoto` (`komentarid`, `fotoid`, `userid`, `isikomentar`, `tanggalkomentar`) VALUES
(6, 6, 10, 'Album Vip Termahal nihhh', '2024-11-05'),
(7, 6, 10, 'daw', '2024-11-05'),
(9, 7, 10, 'pengen eyy', '2024-11-05'),
(10, 6, 10, 'wkwk', '2024-11-05'),
(11, 6, 10, 'we', '2024-11-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `likefoto`
--

CREATE TABLE `likefoto` (
  `likeid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggallike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `likefoto`
--

INSERT INTO `likefoto` (`likeid`, `fotoid`, `userid`, `tanggallike`) VALUES
(27, 7, 10, '0000-00-00'),
(28, 8, 10, '0000-00-00'),
(29, 9, 10, '0000-00-00'),
(31, 7, 4, '0000-00-00'),
(32, 8, 4, '0000-00-00'),
(33, 9, 4, '0000-00-00'),
(34, 6, 4, '0000-00-00'),
(38, 10, 10, '0000-00-00'),
(39, 6, 10, '0000-00-00'),
(40, 12, 10, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `namalengkap`, `alamat`) VALUES
(1, 'aa', 'aa', 'aa@gmail.com', '', 'aa'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '', 'indonesia'),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '', 'indonesia'),
(4, 'aa', '4124bc0a9335c27f086f24ba207a4912', 'aa@gmail.com', '', 'indonesia'),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '', 'indonesia'),
(6, 'aa', '4124bc0a9335c27f086f24ba207a4912', 'aa@gmail.com', '', 'indonesia'),
(7, 'aa', '4124bc0a9335c27f086f24ba207a4912', 'aa@gmail.com', '', 'indonesia'),
(8, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '', 'indonesia'),
(9, 'lutfi', '4e58188ff528dea1eec738fffc0e118d', 'lutfi@gmail.com', '', 'indonesia'),
(10, 'admin', '202cb962ac59075b964b07152d234b70', 'admin@gmail.com', '', 'Indonesia'),
(11, 'admin', '202cb962ac59075b964b07152d234b70', 'admin@gmail.com', '', 'Indonesia');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`fotoid`),
  ADD KEY `albumid` (`albumid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `albumid_2` (`albumid`),
  ADD KEY `userid_2` (`userid`);

--
-- Indeks untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`komentarid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`likeid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`albumid`) REFERENCES `album` (`albumid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD CONSTRAINT `komentarfoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentarfoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likefoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
