-- Database schema for School Complaint Application
CREATE DATABASE IF NOT EXISTS db_pengaduan_sekolah;
USE db_pengaduan_sekolah;

-- 1. Tabel users
CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','siswa') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabel kategori
CREATE TABLE IF NOT EXISTS kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

-- 3. Tabel aspirasi
CREATE TABLE IF NOT EXISTS aspirasi (
    id_aspirasi INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_kategori INT NOT NULL,
    judul VARCHAR(150) NOT NULL,
    deskripsi TEXT NOT NULL,
    tanggal DATE NOT NULL,
    status ENUM('baru','diproses','selesai') DEFAULT 'baru',
    foto VARCHAR(255) NULL,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

-- Indexing
CREATE INDEX idx_status ON aspirasi(status);
CREATE INDEX idx_tanggal ON aspirasi(tanggal);

-- 4. Tabel feedback
CREATE TABLE IF NOT EXISTS feedback (
    id_feedback INT AUTO_INCREMENT PRIMARY KEY,
    id_aspirasi INT NOT NULL,
    isi_feedback TEXT NOT NULL,
    tanggal_feedback DATE NOT NULL,
    foto VARCHAR(255) NULL,
    FOREIGN KEY (id_aspirasi) REFERENCES aspirasi(id_aspirasi) ON DELETE CASCADE
);

-- Seed Initial Data
INSERT INTO users (nama, username, password, role) VALUES 
('Administrator', 'admin', MD5('admin123'), 'admin'),
('Siswa Contoh', 'siswa', MD5('siswa123'), 'siswa');

INSERT INTO kategori (nama_kategori) VALUES 
('Kebersihan'), 
('Fasilitas Kelas'), 
('Keamanan'), 
('Olahraga'), 
('Lainnya');
