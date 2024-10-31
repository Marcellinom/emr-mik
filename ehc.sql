-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Sep 2024 pada 13.39
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehc`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asesmen_awal`
--

CREATE TABLE `asesmen_awal` (
  `id_asesmen` int(11) NOT NULL,
  `denyut_jantung` varchar(20) DEFAULT NULL,
  `pernapasan` varchar(20) DEFAULT NULL,
  `tekanan_darah_sistole` varchar(20) DEFAULT NULL,
  `tekanan_darah_diastole` varchar(20) DEFAULT NULL,
  `suhu` varchar(20) DEFAULT NULL,
  `berat_badan` varchar(4) DEFAULT NULL,
  `tingkat_kesadaran` varchar(30) DEFAULT NULL,
  `tinggi_badan` varchar(6) DEFAULT NULL,
  `keluhan_utama` varchar(100) DEFAULT NULL,
  `riwayat_penyakit` varchar(100) NOT NULL,
  `riwayat_alergi` enum('Obat','Makanan','Udara','Lain-lain') NOT NULL,
  `riwayat_pengobatan` varchar(100) NOT NULL,
  `kepala` varchar(50) NOT NULL,
  `mata` varchar(50) NOT NULL,
  `telinga` varchar(50) NOT NULL,
  `hidung` varchar(50) NOT NULL,
  `rambut` varchar(50) NOT NULL,
  `bibir` varchar(50) NOT NULL,
  `gigi_geligi` varchar(50) NOT NULL,
  `lidah` varchar(50) NOT NULL,
  `langit_langit` varchar(50) NOT NULL,
  `leher` varchar(50) NOT NULL,
  `tenggorokan` varchar(50) NOT NULL,
  `tonsil` varchar(50) NOT NULL,
  `dada` varchar(50) NOT NULL,
  `payudara` varchar(50) NOT NULL,
  `punggung` varchar(50) NOT NULL,
  `perut` varchar(50) NOT NULL,
  `genital` varchar(50) NOT NULL,
  `anus/dubur` varchar(50) NOT NULL,
  `lengan_atas` varchar(50) NOT NULL,
  `lengan_bawah` varchar(50) NOT NULL,
  `jari_tangan` varchar(50) NOT NULL,
  `kuku_tangan` varchar(50) NOT NULL,
  `persendian_tangan` varchar(50) NOT NULL,
  `tungkai_atas` varchar(50) NOT NULL,
  `tungkai_bawah` varchar(50) NOT NULL,
  `jari_kaki` varchar(50) NOT NULL,
  `kuku_kaki` varchar(50) NOT NULL,
  `persendian_kaki` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `asuransi`
--

CREATE TABLE `asuransi` (
  `id_asuransi` int(11) NOT NULL,
  `nama_asuransi` varchar(50) DEFAULT NULL,
  `nomor_asuransi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_obat`
--

CREATE TABLE `data_obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `nama_supplier` varchar(100) DEFAULT NULL,
  `no_batch` varchar(20) DEFAULT NULL,
  `kategori_obat` enum('Obat bebas','Obat bebas terbatas','Obat keras','Narkotika','Psikotropika') DEFAULT NULL,
  `sediaan_obat` varchar(20) DEFAULT NULL,
  `jumlah_obat` varchar(20) DEFAULT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `harga_beli` varchar(20) DEFAULT NULL,
  `harga_jual_umum` varchar(20) DEFAULT NULL,
  `harga_jual_bpjs` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nomor_induk_kependudukan` varchar(13) DEFAULT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('Tidak diketahui','Laki-laki','Perempuan','Tidak dapat ditentukan','Tidak mengisi') DEFAULT NULL,
  `agama` enum('Islam','Kristen (Protestan)','Katolik','Hindu','Budha','Konghucu','Penghayat','Lain-lain') NOT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `spesialisasi` enum('Umum','Gigi','Psikologi','Urologi','Orthopedi','Saraf','Anak','Kandungan','Penyakit Dalam') DEFAULT NULL,
  `nomor_izin_praktek` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `farmasi`
--

CREATE TABLE `farmasi` (
  `id_farmasi` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_rm` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `no_rm` int(11) NOT NULL,
  `id_bayar` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keperawatan`
--

CREATE TABLE `keperawatan` (
  `id_keperawatan` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `no_rm` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_bayar` int(11) NOT NULL,
  `id_asuransi` int(11) NOT NULL,
  `id_asesmen` int(11) NOT NULL,
  `tanggal_pembuatan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id_lab` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `no_rm` int(11) NOT NULL,
  `id_bayar` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_rm` int(11) NOT NULL,
  `prioritas_pemeriksaan` enum('CITO','non CITO') NOT NULL,
  `diagnosis` varchar(100) NOT NULL,
  `catatan_permintaan` varchar(150) NOT NULL,
  `metode_pengiriman_hasil` enum('Penyerahan langsung','Dikirim via surel') NOT NULL,
  `asal_sumber_spesimen_klinis` enum('Darah','Urin','Feses','Jaringan tubuh','Lain-lain') NOT NULL,
  `lokasi_pengambilan` varchar(100) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `volume` varchar(50) NOT NULL,
  `cara_pengambilan` enum('Eksisi','Kerokan','Operasi','Aspirasi/biopsi',' Lain-lain') NOT NULL,
  `kondisi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` datetime NOT NULL,
  `cairan` varchar(50) NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `hasil` blob DEFAULT NULL,
  `nilai_normal` enum('Normal','Tidak Normal') NOT NULL,
  `nilai_rujukan` varchar(100) NOT NULL,
  `nilai_kritis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `no_rm` int(6) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Tidak diketahui','Laki-laki','Perempuan','Tidak dapat ditentukan','Tidak mengisi') DEFAULT NULL,
  `nomor_induk_kependudukan` varchar(16) DEFAULT NULL,
  `nomor_identitas_lain` varchar(30) DEFAULT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nama_ibu_kandung` varchar(100) DEFAULT NULL,
  `agama` enum('Islam','Kristen (Protestan)','Katolik','Hindu','Budha','Konghucu','Penghayat','Lain-lain') DEFAULT NULL,
  `no_telepon_pribadi` varchar(13) DEFAULT NULL,
  `no_telepon_rumah` varchar(10) DEFAULT NULL,
  `pendidikan` enum('Tidak sekolah','SD','SLTP sederajat','SLTA sederajat','D1-D3 sederajat','D4','S1','S2','S3') DEFAULT NULL,
  `status_pernikahan` enum('Belum Kawin','Kawin','Cerai Hidup','Cerai Mati') DEFAULT NULL,
  `golongan_darah` enum('A','B','O','AB') DEFAULT NULL,
  `suku` varchar(20) DEFAULT NULL,
  `bahasa_yang_dikuasai` enum('Bahasa Indonesia','Bahasa Inggris','Bahasa Mandarin','Lain-lain') DEFAULT NULL,
  `kewarganegaraan` enum('Warga Negara Indonesia (WNI)','Warga Negara Asing (WNA)') DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `rt` varchar(3) DEFAULT NULL,
  `rw` varchar(3) DEFAULT NULL,
  `kode_pos` varchar(5) DEFAULT NULL,
  `kelurahan_desa` varchar(30) DEFAULT NULL,
  `kecamatan` varchar(30) DEFAULT NULL,
  `kabupaten_kota` varchar(30) DEFAULT NULL,
  `provinsi` varchar(30) DEFAULT NULL,
  `ttd_text` varchar(20) NOT NULL,
  `ttd_gambar` blob NOT NULL,
  `ttd_sidikjari` blob NOT NULL,
  `tgl_persetujuan` date DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_bayar` int(11) NOT NULL,
  `id_asuransi` int(11) DEFAULT NULL,
  `cara_bayar` enum('BPJS','Mandiri','Asuransi lainnya') DEFAULT NULL,
  `status_bayar` enum('Belum Dibayar','Sudah Dibayar') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `no_rm` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `id_asuransi` int(11) NOT NULL,
  `alasan_masuk` enum('Datang sendiri','Dirujuk') DEFAULT NULL,
  `tanggal_kunjungan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `poliklinik`
--

CREATE TABLE `poliklinik` (
  `id_poli` int(11) NOT NULL,
  `id_dokter` int(11) DEFAULT NULL,
  `nama_poliklinik` enum('Umum','Gigi','Kandungan','Penyakit Dalam','Anak','Bedah','Gizi','Orthopedi','THT','Mata','Jantung','Saraf','Paru') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `radiologi`
--

CREATE TABLE `radiologi` (
  `id_rad` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `no_rm` int(11) NOT NULL,
  `id_bayar` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_rm` int(11) NOT NULL,
  `prioritas_pemeriksaan` enum('CITO','Non CITO') NOT NULL,
  `diagnosis` varchar(150) NOT NULL,
  `catatan_permintaan` varchar(100) NOT NULL,
  `metode_penyampaian_hasil` enum('Penyerahan langsung (digital/cetak foto)','Dikirim via surel') NOT NULL,
  `status_alergi` enum('Ya','Tidak') NOT NULL,
  `status_kehamilan` enum('Hamil','Tidak hamil') NOT NULL,
  `tanggal` datetime NOT NULL,
  `waktu` date NOT NULL,
  `jenis_bahan` varchar(100) NOT NULL,
  `hasil` blob DEFAULT NULL,
  `interpretasi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id_rm` int(11) NOT NULL,
  `id_asesmen` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `no_rm` int(11) NOT NULL,
  `id_bayar` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `subjective` varchar(100) DEFAULT NULL,
  `objective` varchar(100) DEFAULT NULL,
  `asessment` varchar(100) DEFAULT NULL,
  `plan` varchar(100) DEFAULT NULL,
  `kode_icd_10` varchar(7) DEFAULT NULL,
  `nama_diagnosa` varchar(50) DEFAULT NULL,
  `kode_icd_9_cm` varchar(5) DEFAULT NULL,
  `nama_tindakan` varchar(50) DEFAULT NULL,
  `kode_obat` varchar(6) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `sediaan_obat` varchar(50) DEFAULT NULL,
  `aturan_pakai` varchar(100) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `edukasi` varchar(100) NOT NULL,
  `kode_laborat` varchar(7) DEFAULT NULL,
  `nama_laborat` varchar(100) DEFAULT NULL,
  `kode_radiologi` varchar(7) DEFAULT NULL,
  `nama_radiologi` varchar(100) DEFAULT NULL,
  `status_pulang` enum('Pulang','Meninggal','Dirujuk') DEFAULT NULL,
  `ttd_dokter` blob DEFAULT NULL,
  `cetak_surat` enum('Surat Izin Sakit','Surat Keterangan Sehat','Surat Rujukan') NOT NULL,
  `tgl_sakit_mulai` date NOT NULL,
  `tgl_sakit_selesai` date NOT NULL,
  `keperluan` varchar(100) DEFAULT NULL,
  `kebutuhan_pasien` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nomor_induk_kependudukan` varchar(16) DEFAULT NULL,
  `tempat_lahir` int(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Tidak diketahui','Laki-laki','Perempuan','Tidak dapat ditentukan','Tidak mengisi') NOT NULL,
  `agama` enum('Islam','Kristen (Protestan)','Katolik','Hindu','Budha','Konghucu','Penghayat','Lain-lain (free text)') NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `posisi` varchar(30) DEFAULT NULL,
  `bagian` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asesmen_awal`
--
ALTER TABLE `asesmen_awal`
  ADD PRIMARY KEY (`id_asesmen`);

--
-- Indeks untuk tabel `asuransi`
--
ALTER TABLE `asuransi`
  ADD PRIMARY KEY (`id_asuransi`);

--
-- Indeks untuk tabel `data_obat`
--
ALTER TABLE `data_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `farmasi`
--
ALTER TABLE `farmasi`
  ADD PRIMARY KEY (`id_farmasi`),
  ADD KEY `id_obat` (`id_obat`,`id_rm`,`id_staff`,`id_dokter`,`no_rm`,`id_bayar`,`id_poli`);

--
-- Indeks untuk tabel `keperawatan`
--
ALTER TABLE `keperawatan`
  ADD PRIMARY KEY (`id_keperawatan`),
  ADD KEY `id_staff` (`id_staff`,`no_rm`,`id_bayar`,`id_asuransi`,`id_asesmen`),
  ADD KEY `id_poli` (`id_poli`),
  ADD KEY `id_pasien` (`no_rm`),
  ADD KEY `no_rm` (`no_rm`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`id_lab`),
  ADD KEY `id_staff` (`id_staff`,`id_dokter`,`no_rm`,`id_bayar`,`id_poli`,`id_rm`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_asuransi` (`id_asuransi`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `no_rm` (`no_rm`,`id_staff`,`id_poli`,`id_pembayaran`,`id_asuransi`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `poliklinik`
--
ALTER TABLE `poliklinik`
  ADD PRIMARY KEY (`id_poli`),
  ADD KEY `id_staff` (`id_dokter`);

--
-- Indeks untuk tabel `radiologi`
--
ALTER TABLE `radiologi`
  ADD PRIMARY KEY (`id_rad`),
  ADD KEY `id_staff` (`id_staff`,`no_rm`,`id_bayar`,`id_poli`,`id_rm`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id_rm`),
  ADD KEY `id_asesmen` (`id_asesmen`,`id_staff`,`no_rm`,`id_bayar`,`id_poli`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asesmen_awal`
--
ALTER TABLE `asesmen_awal`
  MODIFY `id_asesmen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `asuransi`
--
ALTER TABLE `asuransi`
  MODIFY `id_asuransi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_obat`
--
ALTER TABLE `data_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `farmasi`
--
ALTER TABLE `farmasi`
  MODIFY `id_farmasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keperawatan`
--
ALTER TABLE `keperawatan`
  MODIFY `id_keperawatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id_lab` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `no_rm` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `poliklinik`
--
ALTER TABLE `poliklinik`
  MODIFY `id_poli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `radiologi`
--
ALTER TABLE `radiologi`
  MODIFY `id_rad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id_rm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
