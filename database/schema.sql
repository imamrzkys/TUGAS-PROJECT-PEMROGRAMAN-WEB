-- ============================================================
-- SIAKAD Kampus - Database Schema (MySQL Version)
-- ============================================================

-- ============================================================
-- TABEL PROFILES (Users)
-- ============================================================
CREATE TABLE IF NOT EXISTS profiles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(20) UNIQUE NOT NULL,
  email VARCHAR(100) UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  nama_lengkap VARCHAR(100) NOT NULL,
  role ENUM('mahasiswa', 'dosen', 'admin') NOT NULL DEFAULT 'mahasiswa',
  jurusan VARCHAR(100),
  program_studi VARCHAR(100),
  angkatan INT,
  semester_aktif INT DEFAULT 1,
  foto_url TEXT,
  telepon VARCHAR(20),
  alamat TEXT,
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- TABEL MATA KULIAH
-- ============================================================
CREATE TABLE IF NOT EXISTS mata_kuliah (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode_matkul VARCHAR(20) UNIQUE NOT NULL,
  nama_matkul VARCHAR(100) NOT NULL,
  sks INT NOT NULL CHECK (sks > 0 AND sks <= 6),
  semester INT CHECK (semester >= 1 AND semester <= 8),
  jenis ENUM('wajib', 'pilihan') DEFAULT 'wajib',
  prasyarat_id INT NULL,
  deskripsi TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (prasyarat_id) REFERENCES mata_kuliah(id) ON DELETE SET NULL
);

-- ============================================================
-- TABEL KELAS
-- ============================================================
CREATE TABLE IF NOT EXISTS kelas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matakuliah_id INT NOT NULL,
  dosen_id INT NOT NULL,
  kode_kelas VARCHAR(10),
  ruangan VARCHAR(50),
  hari ENUM('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'),
  jam_mulai TIME,
  jam_selesai TIME,
  kuota INT DEFAULT 40,
  jumlah_pertemuan INT DEFAULT 16,
  tahun_ajaran VARCHAR(10),
  semester ENUM('ganjil', 'genap'),
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (matakuliah_id) REFERENCES mata_kuliah(id) ON DELETE CASCADE,
  FOREIGN KEY (dosen_id) REFERENCES profiles(id) ON DELETE CASCADE
);

-- ============================================================
-- TABEL KRS (Kartu Rencana Studi)
-- ============================================================
CREATE TABLE IF NOT EXISTS krs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT NOT NULL,
  kelas_id INT NOT NULL,
  tahun_ajaran VARCHAR(10),
  semester ENUM('ganjil', 'genap'),
  status ENUM('aktif', 'mengundurkan_diri', 'selesai') DEFAULT 'aktif',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_krs (mahasiswa_id, kelas_id),
  FOREIGN KEY (mahasiswa_id) REFERENCES profiles(id) ON DELETE CASCADE,
  FOREIGN KEY (kelas_id) REFERENCES kelas(id) ON DELETE CASCADE
);

-- ============================================================
-- TABEL PRESENSI
-- ============================================================
CREATE TABLE IF NOT EXISTS presensi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kelas_id INT NOT NULL,
  mahasiswa_id INT NOT NULL,
  pertemuan_ke INT NOT NULL CHECK (pertemuan_ke >= 1),
  tanggal DATE DEFAULT (CURRENT_DATE),
  status ENUM('hadir', 'izin', 'alpha', 'sakit') DEFAULT 'alpha',
  kode_absensi VARCHAR(6),
  scanned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  keterangan TEXT,
  FOREIGN KEY (kelas_id) REFERENCES kelas(id) ON DELETE CASCADE,
  FOREIGN KEY (mahasiswa_id) REFERENCES profiles(id) ON DELETE CASCADE
);

-- ============================================================
-- TABEL MATERI
-- ============================================================
CREATE TABLE IF NOT EXISTS materi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kelas_id INT NOT NULL,
  judul VARCHAR(200) NOT NULL,
  deskripsi TEXT,
  file_url TEXT,
  file_type VARCHAR(20),
  file_size_mb DECIMAL(6,2),
  pertemuan_ke INT,
  is_published TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (kelas_id) REFERENCES kelas(id) ON DELETE CASCADE
);

-- ============================================================
-- TABEL TUGAS
-- ============================================================
CREATE TABLE IF NOT EXISTS tugas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kelas_id INT NOT NULL,
  judul VARCHAR(200) NOT NULL,
  deskripsi TEXT,
  file_url TEXT,
  deadline DATETIME,
  bobot_nilai DECIMAL(5,2) DEFAULT 100,
  is_published TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (kelas_id) REFERENCES kelas(id) ON DELETE CASCADE
);

-- ============================================================
-- TABEL PENGUMPULAN TUGAS
-- ============================================================
CREATE TABLE IF NOT EXISTS pengumpulan_tugas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tugas_id INT NOT NULL,
  mahasiswa_id INT NOT NULL,
  file_url TEXT,
  catatan TEXT,
  nilai DECIMAL(5,2),
  feedback TEXT,
  status ENUM('submitted', 'graded', 'late') DEFAULT 'submitted',
  dikumpulkan_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  dinilai_at TIMESTAMP NULL,
  UNIQUE KEY unique_submission (tugas_id, mahasiswa_id),
  FOREIGN KEY (tugas_id) REFERENCES tugas(id) ON DELETE CASCADE,
  FOREIGN KEY (mahasiswa_id) REFERENCES profiles(id) ON DELETE CASCADE
);

-- ============================================================
-- TABEL NILAI
-- ============================================================
CREATE TABLE IF NOT EXISTS nilai (
  id INT AUTO_INCREMENT PRIMARY KEY,
  krs_id INT NOT NULL,
  komponen ENUM('tugas', 'uts', 'uas', 'praktikum') NOT NULL,
  nilai DECIMAL(5,2) CHECK (nilai >= 0 AND nilai <= 100),
  bobot DECIMAL(5,2) DEFAULT 100,
  keterangan TEXT,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY unique_nilai (krs_id, komponen),
  FOREIGN KEY (krs_id) REFERENCES krs(id) ON DELETE CASCADE
);

-- ============================================================
-- TABEL PENGUMUMAN
-- ============================================================
CREATE TABLE IF NOT EXISTS pengumuman (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(200) NOT NULL,
  konten TEXT NOT NULL,
  kategori VARCHAR(30) DEFAULT 'umum',
  is_published TINYINT(1) DEFAULT 1,
  author_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (author_id) REFERENCES profiles(id) ON DELETE SET NULL
);

-- ============================================================
-- TABEL PEMBAYARAN
-- ============================================================
CREATE TABLE IF NOT EXISTS pembayaran (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT NOT NULL,
  jenis VARCHAR(50) DEFAULT 'UKT',
  semester ENUM('ganjil', 'genap'),
  tahun_ajaran VARCHAR(10),
  jumlah DECIMAL(12,2) NOT NULL,
  status ENUM('pending', 'lunas', 'expired', 'verifikasi') DEFAULT 'pending',
  deadline DATE,
  va_number VARCHAR(30),
  paid_at TIMESTAMP NULL,
  bukti_url TEXT,
  keterangan TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (mahasiswa_id) REFERENCES profiles(id) ON DELETE CASCADE
);

-- ============================================================
-- INDEXES untuk performa query
-- ============================================================
CREATE INDEX idx_krs_mahasiswa ON krs(mahasiswa_id);
CREATE INDEX idx_krs_kelas ON krs(kelas_id);
CREATE INDEX idx_presensi_kelas ON presensi(kelas_id);
CREATE INDEX idx_presensi_mahasiswa ON presensi(mahasiswa_id);
CREATE INDEX idx_nilai_krs ON nilai(krs_id);
CREATE INDEX idx_pembayaran_mahasiswa ON pembayaran(mahasiswa_id);
CREATE INDEX idx_kelas_dosen ON kelas(dosen_id);
CREATE INDEX idx_tugas_kelas ON tugas(kelas_id);

-- ============================================================
-- VIEW: Rekap Nilai Akhir Mahasiswa
-- ============================================================
CREATE OR REPLACE VIEW v_nilai_akhir AS
SELECT 
  k.mahasiswa_id,
  k.kelas_id,
  mk.nama_matkul,
  mk.sks,
  COALESCE(SUM(n.nilai * n.bobot / 100), 0) AS nilai_akhir,
  CASE 
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 85 THEN 'A'
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 80 THEN 'A-'
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 75 THEN 'B+'
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 70 THEN 'B'
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 65 THEN 'B-'
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 60 THEN 'C+'
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 55 THEN 'C'
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 40 THEN 'D'
    ELSE 'E'
  END AS grade,
  CASE 
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 85 THEN 4.0
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 80 THEN 3.7
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 75 THEN 3.3
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 70 THEN 3.0
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 65 THEN 2.7
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 60 THEN 2.3
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 55 THEN 2.0
    WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 40 THEN 1.0
    ELSE 0
  END AS bobot_nilai
FROM krs k
JOIN kelas kl ON k.kelas_id = kl.id
JOIN mata_kuliah mk ON kl.matakuliah_id = mk.id
LEFT JOIN nilai n ON n.krs_id = k.id
GROUP BY k.mahasiswa_id, k.kelas_id, mk.nama_matkul, mk.sks;
