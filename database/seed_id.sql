-- ============================================================
-- SIAKAD Kampus - Data Awal (Bahasa Indonesia)
-- ============================================================

-- Password untuk semua user: password123
-- Hash akan diupdate oleh fix-password.php

-- ============================================================
-- DATA PROFIL (Pengguna)
-- ============================================================
INSERT INTO profil (nim, email, kata_sandi, nama_lengkap, peran, jurusan, program_studi, angkatan, semester_aktif, telepon, alamat) VALUES
-- Admin
('admin', 'admin@siakad.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator Sistem', 'admin', 'Sistem Informasi', 'Sistem Informasi', 2024, 1, '081234567890', 'Jl. Admin No. 1'),

-- Dosen
('D001', 'dosen1@siakad.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dr. Budi Santoso, M.Kom', 'dosen', 'Teknik Informatika', 'Teknik Informatika', NULL, NULL, '081234567891', 'Jl. Dosen No. 1'),
('D002', 'dosen2@siakad.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Prof. Siti Aminah, M.T', 'dosen', 'Sistem Informasi', 'Sistem Informasi', NULL, NULL, '081234567892', 'Jl. Dosen No. 2'),
('D003', 'dosen3@siakad.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ahmad Hidayat, S.Kom, M.Cs', 'dosen', 'Teknik Informatika', 'Teknik Informatika', NULL, NULL, '081234567893', 'Jl. Dosen No. 3'),

-- Mahasiswa
('M001', 'mahasiswa1@siakad.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Andi Wijaya', 'mahasiswa', 'Teknik Informatika', 'Teknik Informatika', 2023, 3, '081234567894', 'Jl. Mahasiswa No. 1'),
('M002', 'mahasiswa2@siakad.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dewi Lestari', 'mahasiswa', 'Sistem Informasi', 'Sistem Informasi', 2023, 3, '081234567895', 'Jl. Mahasiswa No. 2'),
('M003', 'mahasiswa3@siakad.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rizki Pratama', 'mahasiswa', 'Teknik Informatika', 'Teknik Informatika', 2024, 1, '081234567896', 'Jl. Mahasiswa No. 3'),
('M004', 'mahasiswa4@siakad.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sari Wulandari', 'mahasiswa', 'Sistem Informasi', 'Sistem Informasi', 2024, 1, '081234567897', 'Jl. Mahasiswa No. 4');

-- ============================================================
-- DATA MATA KULIAH
-- ============================================================
INSERT INTO mata_kuliah (kode_matkul, nama_matkul, sks, semester, jenis, deskripsi) VALUES
-- Semester 1
('TIF101', 'Pemrograman Dasar', 3, 1, 'wajib', 'Mata kuliah dasar pemrograman menggunakan bahasa C'),
('TIF102', 'Matematika Diskrit', 3, 1, 'wajib', 'Logika, himpunan, relasi, dan graf'),
('TIF103', 'Algoritma dan Struktur Data', 4, 1, 'wajib', 'Konsep algoritma dan struktur data'),
('UMU101', 'Bahasa Indonesia', 2, 1, 'wajib', 'Mata kuliah umum bahasa Indonesia'),

-- Semester 2
('TIF201', 'Pemrograman Berorientasi Objek', 3, 2, 'wajib', 'OOP dengan Java'),
('TIF202', 'Basis Data', 3, 2, 'wajib', 'Konsep database dan SQL'),
('TIF203', 'Sistem Operasi', 3, 2, 'wajib', 'Konsep sistem operasi'),

-- Semester 3
('TIF301', 'Pemrograman Web', 3, 3, 'wajib', 'HTML, CSS, JavaScript, PHP'),
('TIF302', 'Jaringan Komputer', 3, 3, 'wajib', 'Konsep jaringan dan protokol'),
('TIF303', 'Rekayasa Perangkat Lunak', 3, 3, 'wajib', 'Software engineering methodology'),

-- Semester 4
('TIF401', 'Pemrograman Mobile', 3, 4, 'pilihan', 'Pemrograman aplikasi mobile'),
('TIF402', 'Pembelajaran Mesin', 3, 4, 'pilihan', 'Konsep dan implementasi ML'),
('TIF403', 'Keamanan Sistem Informasi', 3, 4, 'pilihan', 'Keamanan dan kriptografi');

-- ============================================================
-- DATA KELAS
-- ============================================================
INSERT INTO kelas (matakuliah_id, dosen_id, kode_kelas, ruangan, hari, jam_mulai, jam_selesai, kuota, tahun_ajaran, semester) VALUES
-- Semester Ganjil 2026/2027
(1, 2, 'A', 'Lab 101', 'Senin', '08:00:00', '10:30:00', 40, '2026/2027', 'ganjil'),
(2, 3, 'A', 'R-201', 'Selasa', '08:00:00', '10:30:00', 40, '2026/2027', 'ganjil'),
(3, 2, 'A', 'Lab 102', 'Rabu', '13:00:00', '16:30:00', 35, '2026/2027', 'ganjil'),
(8, 2, 'A', 'Lab 201', 'Kamis', '08:00:00', '10:30:00', 40, '2026/2027', 'ganjil'),
(9, 3, 'A', 'R-301', 'Jumat', '08:00:00', '10:30:00', 40, '2026/2027', 'ganjil'),
(10, 2, 'B', 'R-202', 'Senin', '13:00:00', '15:30:00', 40, '2026/2027', 'ganjil');

-- ============================================================
-- DATA KRS
-- ============================================================
INSERT INTO krs (mahasiswa_id, kelas_id, tahun_ajaran, semester, status) VALUES
-- Mahasiswa 1 (Andi - Semester 3)
(5, 4, '2026/2027', 'ganjil', 'aktif'),
(5, 5, '2026/2027', 'ganjil', 'aktif'),
(5, 6, '2026/2027', 'ganjil', 'aktif'),

-- Mahasiswa 2 (Dewi - Semester 3)
(6, 4, '2026/2027', 'ganjil', 'aktif'),
(6, 5, '2026/2027', 'ganjil', 'aktif'),
(6, 6, '2026/2027', 'ganjil', 'aktif'),

-- Mahasiswa 3 (Rizki - Semester 1)
(7, 1, '2026/2027', 'ganjil', 'aktif'),
(7, 2, '2026/2027', 'ganjil', 'aktif'),
(7, 3, '2026/2027', 'ganjil', 'aktif');

-- ============================================================
-- DATA NILAI
-- ============================================================
INSERT INTO nilai (krs_id, komponen, nilai, bobot, keterangan) VALUES
-- Mahasiswa 1 - Pemrograman Web
(1, 'tugas', 85, 30, 'Nilai rata-rata tugas'),
(1, 'uts', 80, 30, 'Ujian Tengah Semester'),
(1, 'uas', 88, 40, 'Ujian Akhir Semester'),

-- Mahasiswa 1 - Jaringan Komputer
(2, 'tugas', 78, 30, 'Nilai rata-rata tugas'),
(2, 'uts', 82, 30, 'Ujian Tengah Semester'),
(2, 'uas', 85, 40, 'Ujian Akhir Semester'),

-- Mahasiswa 2 - Pemrograman Web
(4, 'tugas', 90, 30, 'Nilai rata-rata tugas'),
(4, 'uts', 88, 30, 'Ujian Tengah Semester'),
(4, 'uas', 92, 40, 'Ujian Akhir Semester');

-- ============================================================
-- DATA PENGUMUMAN
-- ============================================================
INSERT INTO pengumuman (judul, konten, kategori, pembuat_id) VALUES
('Selamat Datang di SIAKAD', 'Selamat datang di Sistem Informasi Akademik Kampus. Silakan gunakan fitur-fitur yang tersedia untuk menunjang kegiatan akademik Anda.', 'umum', 1),
('Jadwal UTS Semester Ganjil 2023/2024', 'Ujian Tengah Semester akan dilaksanakan pada minggu ke-8 perkuliahan. Jadwal detail akan diinformasikan kemudian.', 'akademik', 1),
('Pengisian KRS Dibuka', 'Pengisian KRS untuk semester ganjil 2023/2024 telah dibuka. Batas akhir pengisian adalah 2 minggu setelah perkuliahan dimulai.', 'akademik', 1),
('Libur Nasional', 'Kampus libur pada tanggal 17 Agustus 2024 dalam rangka memperingati Hari Kemerdekaan RI.', 'umum', 1);

-- ============================================================
-- DATA PEMBAYARAN
-- ============================================================
INSERT INTO pembayaran (mahasiswa_id, jenis, semester, tahun_ajaran, jumlah, status, batas_waktu, nomor_va) VALUES
(5, 'UKT', 'ganjil', '2026/2027', 5000000, 'lunas', '2026-08-31', 'VA001234567890'),
(6, 'UKT', 'ganjil', '2026/2027', 5000000, 'lunas', '2026-08-31', 'VA001234567891'),
(7, 'UKT', 'ganjil', '2026/2027', 5000000, 'menunggu', '2026-08-31', 'VA001234567892'),
(5, 'UKT', 'genap', '2026/2027', 5000000, 'menunggu', '2027-02-28', 'VA001234567893');

-- ============================================================
-- DATA TUGAS
-- ============================================================
INSERT INTO tugas (kelas_id, judul, deskripsi, batas_waktu, bobot_nilai, dipublikasi) VALUES
(4, 'Tugas 1: HTML & CSS Dasar', 'Buat halaman web sederhana dengan HTML dan CSS', '2026-10-15 23:59:00', 100, 1),
(4, 'Tugas 2: JavaScript Interaktif', 'Buat aplikasi web interaktif menggunakan JavaScript', '2026-11-01 23:59:00', 100, 1),
(5, 'Tugas 1: Analisis Topologi Jaringan', 'Analisis topologi jaringan pada studi kasus', '2026-10-20 23:59:00', 100, 1);

-- ============================================================
-- DATA MATERI
-- ============================================================
INSERT INTO materi (kelas_id, judul, deskripsi, pertemuan_ke, dipublikasi) VALUES
(4, 'Pengenalan HTML', 'Materi pengenalan HTML dan struktur dasar dokumen web', 1, 1),
(4, 'Penataan CSS', 'Materi tentang styling dengan CSS', 2, 1),
(4, 'Dasar-dasar JavaScript', 'Materi dasar-dasar JavaScript', 3, 1),
(5, 'Model OSI dan TCP/IP', 'Materi tentang model referensi jaringan', 1, 1),
(5, 'Pengalamatan IP', 'Materi tentang pengalamatan IP', 2, 1);

-- ============================================================
-- DATA PRESENSI
-- ============================================================
INSERT INTO presensi (kelas_id, mahasiswa_id, pertemuan_ke, tanggal, status, keterangan) VALUES
-- Pemrograman Web - Pertemuan 1
(4, 5, 1, '2026-09-07', 'hadir', 'Tepat waktu'),
(4, 6, 1, '2026-09-07', 'hadir', 'Tepat waktu'),

-- Pemrograman Web - Pertemuan 2
(4, 5, 2, '2026-09-14', 'hadir', 'Tepat waktu'),
(4, 6, 2, '2026-09-14', 'hadir', 'Tepat waktu'),

-- Pemrograman Web - Pertemuan 3
(4, 5, 3, '2026-09-21', 'hadir', 'Tepat waktu'),
(4, 6, 3, '2026-09-21', 'izin', 'Sakit'),

-- Jaringan Komputer - Pertemuan 1
(5, 5, 1, '2026-09-08', 'hadir', 'Tepat waktu'),
(5, 6, 1, '2026-09-08', 'hadir', 'Tepat waktu');
