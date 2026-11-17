CREATE DATABASE IF NOT EXISTS db_mahasiswa CHARACTER SET utf8 COLLATE utf8_general_ci;
USE db_mahasiswa;

CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(20) NOT NULL UNIQUE,
  nama VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('Laki-laki','Perempuan') NOT NULL,
  jurusan VARCHAR(100) NOT NULL,
  angkatan INT NOT NULL,
  telepon VARCHAR(20) DEFAULT NULL,
  alamat TEXT
) ENGINE=InnoDB;

INSERT INTO mahasiswa (nim, nama, jenis_kelamin, jurusan, angkatan, telepon, alamat) VALUES
('2021001', 'Budi Santoso', 'Laki-laki', 'Teknik Informatika', 2021, '081234567890', 'Kisaran'),
('2021002', 'Siti Aminah', 'Perempuan', 'Sistem Informasi', 2021, '081298765432', 'Medan'),
('2022003', 'Rizky Ramadhan', 'Laki-laki', 'Teknik Informatika', 2022, '085212345678', 'Tanjung Balai');
