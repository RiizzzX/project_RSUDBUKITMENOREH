-- RSUD Bukit Menoreh - Initial Database Setup
CREATE TABLE IF NOT EXISTS farmasi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nomor_antrian VARCHAR(20) NOT NULL UNIQUE,
    nama_obat VARCHAR(255) NOT NULL,
    dosis VARCHAR(255),
    catatan TEXT,
    status ENUM('Menunggu', 'Disiapkan', 'Selesai') DEFAULT 'Menunggu',
    waktu_masuk TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    waktu_disiapkan TIMESTAMP NULL,
    waktu_selesai TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_waktu (waktu_masuk)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS antrian (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nomor_antrian VARCHAR(20) NOT NULL UNIQUE,
    nama_pasien VARCHAR(255) NOT NULL,
    no_rekam_medis VARCHAR(50),
    layanan VARCHAR(100),
    status ENUM('Menunggu', 'Dilayani', 'Selesai', 'Batal') DEFAULT 'Menunggu',
    waktu_masuk TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    waktu_dilayani TIMESTAMP NULL,
    waktu_selesai TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_waktu (waktu_masuk)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS pasien (
    id INT PRIMARY KEY AUTO_INCREMENT,
    no_rekam_medis VARCHAR(50) UNIQUE NOT NULL,
    nama VARCHAR(255) NOT NULL,
    no_identitas VARCHAR(50),
    jenis_kelamin ENUM('L', 'P'),
    tanggal_lahir DATE,
    alamat TEXT,
    no_telepon VARCHAR(20),
    email VARCHAR(255),
    status_aktif BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_nama (nama),
    INDEX idx_identitas (no_identitas)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data untuk testing
INSERT INTO farmasi (nomor_antrian, nama_obat, dosis, status) VALUES
('IGD1', 'Paracetamol 500mg', '2x sehari', 'Menunggu'),
('IGD2', 'Amoxicillin 250mg', '3x sehari', 'Disiapkan'),
('IGD3', 'Ibuprofen 400mg', '2x sehari', 'Selesai');

INSERT INTO antrian (nomor_antrian, nama_pasien, no_rekam_medis, layanan, status) VALUES
('A001', 'Budi Santoso', 'RM001', 'Farmasi', 'Menunggu'),
('A002', 'Siti Nurhaliza', 'RM002', 'Farmasi', 'Dilayani'),
('A003', 'Ahmad Wijaya', 'RM003', 'Farmasi', 'Selesai');

INSERT INTO pasien (no_rekam_medis, nama, no_identitas, jenis_kelamin, tanggal_lahir, no_telepon) VALUES
('RM001', 'Budi Santoso', '1234567890123456', 'L', '1990-05-15', '081234567890'),
('RM002', 'Siti Nurhaliza', '9876543210987654', 'P', '1995-08-22', '082345678901'),
('RM003', 'Ahmad Wijaya', '1122334455667788', 'L', '1988-03-10', '083456789012');
