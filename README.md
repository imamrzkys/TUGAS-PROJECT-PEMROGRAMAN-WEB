# SIAKAD Kampus - Sistem Informasi Akademik

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)
[![Commits](https://img.shields.io/badge/Commits-41-success)](https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB/commits/main)

## 📚 Tentang Project

Sistem Informasi Akademik Kampus berbasis web menggunakan **PHP murni (tanpa framework)** dan **AdminLTE**.

**Tugas Akhir - Pemrograman Internet 2024**

🔗 **Repository**: https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB.git

---

## ✨ Fitur Utama

### 👨‍🎓 Mahasiswa
- ✅ **Isi KRS** - Tambah/hapus mata kuliah dengan validasi kuota
- ✅ **Lihat Nilai & Transkrip** - Perhitungan IPK otomatis
- ✅ **Jadwal Kuliah** - Lihat jadwal per semester
- ✅ Lihat pengumuman
- ✅ Manajemen profil

### 👨‍🏫 Dosen
- ✅ **Input Nilai** - Per komponen (Tugas 30%, UTS 30%, UAS 40%)
- ✅ **Auto Calculate** - Nilai akhir dan grade otomatis
- ✅ Lihat daftar mahasiswa per kelas

### 👨‍💼 Admin
- ✅ Dashboard statistik sistem
- ✅ Manajemen mahasiswa, dosen, kelas
- ✅ Kelola pengumuman

---

## 🛠️ Teknologi

**Backend**: PHP 7.4+ (Native) | MySQL 5.7+ | PDO  
**Frontend**: AdminLTE 3.2 | Bootstrap 4 | jQuery | DataTables | SweetAlert2

---

## 📊 Sistem Nilai & IPK

### Komponen Nilai
```
Tugas : 30%
UTS   : 30%
UAS   : 40%
```

### Konversi Grade
| Grade | Nilai  | Bobot |
|-------|--------|-------|
| A     | 85-100 | 4.0   |
| A-    | 80-84  | 3.7   |
| B+    | 75-79  | 3.3   |
| B     | 70-74  | 3.0   |
| B-    | 65-69  | 2.7   |
| C+    | 60-64  | 2.3   |
| C     | 55-59  | 2.0   |
| D     | 40-54  | 1.0   |
| E     | 0-39   | 0.0   |

### Rumus IPK
```
IPK = Σ(Bobot Nilai × SKS) / Σ(SKS)
```

---

## 🚀 Instalasi & Menjalankan

### 1. Clone Repository
```bash
git clone https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB.git
cd TUGAS-PROJECT-PEMROGRAMAN-WEB
```

### 2. Setup Database
```bash
# Buat database
mysql -u root -p -e "CREATE DATABASE siakad_kampus"

# Import schema
mysql -u root -p siakad_kampus < database/schema.sql

# Import data sample
mysql -u root -p siakad_kampus < database/seed.sql
```

### 3. Konfigurasi
```bash
# Copy & edit config
cp config/database.example.php config/database.php
```

Edit `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Sesuaikan dengan password MySQL Anda
define('DB_NAME', 'siakad_kampus');
```

### 4. Jalankan Server
```bash
php -S localhost:8000
```

### 5. Akses Aplikasi
Buka browser: **http://localhost:8000**

---

## 🔐 Akun Testing

| Role      | NIM    | Password     |
|-----------|--------|--------------|
| Admin     | admin  | password123  |
| Dosen     | D001   | password123  |
| Mahasiswa | M001   | password123  |
| Mahasiswa | M002   | password123  |

---

## 📁 Struktur Project

```
php-version/
├── config/           # Konfigurasi database & app
├── models/           # Model layer (MVC)
├── includes/         # Header, footer, sidebar
├── mahasiswa/        # Pages mahasiswa
├── dosen/            # Pages dosen
├── admin/            # Pages admin
├── database/         # SQL schema & seed
├── public/           # CSS & JS assets
├── uploads/          # File uploads
└── login.php         # Entry point
```

---

## 🎯 Fitur yang Diimplementasikan

- [x] Login multi-role dengan session
- [x] **Isi KRS** dengan validasi kuota & SKS
- [x] **Input Nilai** oleh dosen per komponen
- [x] **Hitung IPK** otomatis dengan formula
- [x] Dashboard untuk setiap role
- [x] Jadwal kuliah mahasiswa
- [x] Transkrip nilai dengan grade
- [x] Manajemen profil & password
- [x] Responsive UI dengan AdminLTE
- [x] Security: bcrypt, prepared statements

---

## 📊 Statistik Project

- **Total Commits**: 41 commits (✅ > 25)
- **Total Files**: 50+ files
- **Lines of Code**: 3000+ lines
- **Database Tables**: 10 tables
- **Status**: ✅ **COMPLETED**

---

## 🐛 Troubleshooting

### Error "Connection refused"
- Pastikan MySQL service sudah running
- Cek kredensial di `config/database.php`

### Error "Permission denied" saat upload
```bash
chmod -R 777 uploads
```

### Port 8000 sudah digunakan
```bash
php -S localhost:8080  # Gunakan port lain
```

---

## 📄 License

MIT License - see [LICENSE](LICENSE) file

---

## 👨‍💻 Author

**Tugas Akhir Pemrograman Internet - 2024**

Repository: https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB.git

---

⭐ **Star this repo if you find it helpful!**
