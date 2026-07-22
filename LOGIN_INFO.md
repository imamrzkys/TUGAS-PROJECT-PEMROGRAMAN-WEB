# Informasi Login SIAKAD

## Status
✅ Database sudah dikonversi ke Bahasa Indonesia  
✅ Password sudah diperbaiki  
✅ Login siap digunakan  

## Akses Aplikasi
URL: **http://localhost:8000/login.php**

## Akun Demo

### Admin
- **NIM:** admin
- **Password:** password123
- **Akses:** Dashboard Admin, Manajemen Pengguna

### Dosen
- **NIM:** D001
- **Password:** password123
- **Akses:** Dashboard Dosen, Input Nilai Mahasiswa

### Mahasiswa  
- **NIM:** M001
- **Password:** password123
- **Akses:** Dashboard Mahasiswa, Lihat Jadwal, KRS, Nilai

## Perubahan Database

Database telah dikonversi ke **Bahasa Indonesia**:

### Tabel
- `profiles` → `profil`

### Kolom Profil
- `password_hash` → `kata_sandi`
- `is_active` → `aktif`
- `role` → `peran`
- `created_at` → `dibuat_pada`
- `updated_at` → `diperbarui_pada`

### Kolom Lainnya
- `author_id` → `pembuat_id`
- `is_published` → `dipublikasi`
- `deadline` → `batas_waktu`
- `va_number` → `nomor_va`
- `paid_at` → `dibayar_pada`

## Data Mahasiswa di Database

| NIM  | Nama           | Jurusan              | Semester |
|------|----------------|----------------------|----------|
| M001 | Andi Wijaya    | Teknik Informatika   | 3        |
| M002 | Dewi Lestari   | Sistem Informasi     | 3        |
| M003 | Rizki Pratama  | Teknik Informatika   | 1        |
| M004 | Sari Wulandari | Sistem Informasi     | 1        |

## Data Dosen di Database

| NIM  | Nama                        | Jurusan              |
|------|------------------------------|----------------------|
| D001 | Dr. Budi Santoso, M.Kom     | Teknik Informatika   |
| D002 | Prof. Siti Aminah, M.T      | Sistem Informasi     |
| D003 | Ahmad Hidayat, S.Kom, M.Cs  | Teknik Informatika   |

## Cara Menjalankan Aplikasi

1. **Start XAMPP MySQL**
   ```
   Buka XAMPP Control Panel → Start MySQL
   ```

2. **Start PHP Server** (sudah berjalan)
   ```
   C:\xampp\php\php.exe -S localhost:8000
   ```

3. **Buka Browser**
   ```
   http://localhost:8000/login.php
   ```

## Troubleshooting

### Jika Login Gagal
1. Pastikan MySQL di XAMPP sudah running
2. Jalankan script fix password:
   ```
   C:\xampp\php\php.exe fix-password.php
   ```
3. Periksa database siakad_kampus sudah ada dan terisi data

### Jika Halaman Tidak Muncul
1. Pastikan PHP server berjalan di port 8000
2. Cek terminal tidak ada error
3. Restart server jika perlu

## File yang Telah Diupdate

✅ `database/schema_id.sql` - Schema Bahasa Indonesia  
✅ `database/seed_id.sql` - Data awal Bahasa Indonesia  
✅ `login.php` - Login authentication dengan tabel baru  
✅ `fix-password.php` - Script fix password untuk tabel baru  
✅ `models/User.php` - Model User dengan kolom Indonesia  

## Mahasiswa Pengembang

**Nama:** Imam Rizki Saputra  
**NIM:** 301230013  
**Prodi:** Teknik Informatika  
**Universitas:** Universitas Bale Bandung  
**Tugas:** Projek Pemrograman Web  
