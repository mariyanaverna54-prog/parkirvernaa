-- 1. Tabel User
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','petugas','owner') NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert user default (password: admin123, petugas123, owner123)
INSERT INTO `tb_user` (`username`, `password`, `nama_lengkap`, `role`) VALUES
('admin', 'admin123', 'Administrator', 'admin'),
('petugas', 'petugas123', 'Petugas Parkir', 'petugas'),
('owner', 'owner123', 'Owner Parkir', 'owner');

-- 2. Tabel Tarif Parkir
CREATE TABLE IF NOT EXISTS `tb_tarif_parkir` (
  `id_tarif` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_kendaraan` varchar(50) NOT NULL,
  `tarif_per_jam` int(11) NOT NULL,
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert tarif default
INSERT INTO `tb_tarif_parkir` (`jenis_kendaraan`, `tarif_per_jam`) VALUES
('motor', 2000),
('mobil', 5000),
('truk', 10000),
('bus', 15000);

-- 3. Tabel Area Parkir
CREATE TABLE IF NOT EXISTS `tb_area_parkir` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nama_area` varchar(100) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `terisi` int(11) DEFAULT 0,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert area default
INSERT INTO `tb_area_parkir` (`nama_area`, `kapasitas`, `terisi`) VALUES
('Lantai 1 (Mobil)', 50, 0),
('Lantai 2 (Motor)', 100, 0),
('Basement (Truk/Bus)', 20, 0);

-- 4. Tabel Kendaraan
CREATE TABLE IF NOT EXISTS `tb_kendaraan` (
  `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT,
  `plat_nomor` varchar(20) NOT NULL,
  `jenis_kendaraan` varchar(50) NOT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kendaraan`),
  UNIQUE KEY `plat_nomor` (`plat_nomor`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `fk_kendaraan_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Tabel Transaksi
CREATE TABLE IF NOT EXISTS `tb_transaksi` (
  `id_parkir` int(11) NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `waktu_masuk` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waktu_keluar` datetime DEFAULT NULL,
  `biaya_total` int(11) DEFAULT 0,
  `metode_bayar` varchar(50) DEFAULT 'Tunai',
  `status` enum('masuk','keluar') DEFAULT 'masuk',
  PRIMARY KEY (`id_parkir`),
  KEY `id_kendaraan` (`id_kendaraan`),
  KEY `id_area` (`id_area`),
  CONSTRAINT `fk_transaksi_kendaraan` FOREIGN KEY (`id_kendaraan`) REFERENCES `tb_kendaraan` (`id_kendaraan`) ON DELETE CASCADE,
  CONSTRAINT `fk_transaksi_area` FOREIGN KEY (`id_area`) REFERENCES `tb_area_parkir` (`id_area`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Tabel Log Aktivitas
CREATE TABLE IF NOT EXISTS `tb_log_aktivitas` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `aktivitas` text NOT NULL,
  `waktu_aktivitas` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `fk_log_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
