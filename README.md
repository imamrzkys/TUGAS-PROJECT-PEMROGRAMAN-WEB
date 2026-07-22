# SIAKAD Kampus - PHP Version

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)
[![Commits](https://img.shields.io/badge/Commits-39+-success)](https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB/commits/main)

## 📚 Deskripsi
Sistem Informasi Akademik Kampus berbasis web menggunakan PHP murni (tanpa framework) dan AdminLTE.

**Proyek Tugas Akhir - Pemrograman Web**

🔗 **Live Demo**: [GitHub Repository](https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB.git)

---

## ✨ Fitur Utama

### 👨‍🎓 Mahasiswa
- ✅ Dashboard dengan statistik lengkap
- ✅ **Isi KRS** - Tambah/hapus mata kuliah
- ✅ **Lihat Jadwal** - Jadwal kuliah per semester
- ✅ **Lihat Nilai & Transkrip** - Dengan perhitungan IPK otomatis
- ✅ Lihat pengumuman kampus
- ✅ Manajemen profil

### 👨‍🏫 Dosen
- ✅ Dashboard dengan statistik kelas
- ✅ **Input Nilai** - Per komponen (Tugas, UTS, UAS)
- ✅ Auto calculate nilai akhir dan grade
- ✅ Lihat daftar mahasiswa per kelas

### 👨‍💼 Admin
- ✅ Dashboard dengan overview sistem
- ✅ Manajemen mahasiswa, dosen, mata kuliah
- ✅ Manajemen kelas dan KRS
- ✅ Kelola pengumuman

---

## 🛠️ Teknologi Stack

## 🛠️ Teknologi Stack

### Backend
- **PHP 7.4+** - Native PHP (No Framework)
- **MySQL 5.7+** - Database
- **PDO** - Database abstraction
- **bcrypt** - Password hashing

### Frontend
- **AdminLTE 3.2** - Admin template
- **Bootstrap 4** - CSS framework
- **jQuery** - JavaScript library
- **DataTables** - Interactive tables
- **SweetAlert2** - Beautiful alerts
- **Font Awesome 5** - Icons

---

## 📊 Sistem Nilai & IPK

### Komponen Nilai
- Tugas: 30%
- UTS: 30%
- UAS: 40%

### Konversi Grade
| Grade | Rentang Nilai | Bobot |
|-------|---------------|-------|
| A     | 85-100       | 4.0   |
| A-    | 80-84        | 3.7   |
| B+    | 75-79        | 3.3   |
| B     | 70-74        | 3.0   |
| B-    | 65-69        | 2.7   |
| C+    | 60-64        | 2.3   |
| C     | 55-59        | 2.0   |
| D     | 40-54        | 1.0   |
| E     | 0-39         | 0.0   |

### Rumus IPK
```
IPK = Σ(Bobot Nilai × SKS) / Σ(SKS)
```

---

## 🚀 Instalasi
- **Backend**: PHP 7.4+ (Native, tanpa framework)
- **Frontend**: HTML5, CSS3, JavaScript, jQuery
- **Template**: AdminLTE 3.2
- **Database**: MySQL / SQLite
- **Library**: Bootstrap 4, Font Awesome, DataTables

## Struktur Folder
```
php-version/
├── config/          # Konfigurasi database & konstanta
├── controllers/     # Logic bisnis
├── models/          # Model database
├── views/           # Tampilan HTML
├── public/          # Assets (CSS, JS, Images)
├── includes/        # Header, footer, sidebar
├── api/             # REST API endpoints
├── database/        # SQL schema & seed
└── uploads/         # File upload
```


## 🚀 Instalasi

### Persyaratan
- PHP 7.4 atau lebih tinggi
- MySQL 5.7+ atau MariaDB 10.2+
- Web Server (Apache/Nginx) atau PHP Built-in Server

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB.git
cd TUGAS-PROJECT-PEMROGRAMAN-WEB
```

2. **Setup Database**
```bash
# Buat database
mysql -u root -p -e "CREATE DATABASE siakad_kampus"

# Import schema
mysql -u root -p siakad_kampus < database/schema.sql

# Import seed data
mysql -u root -p siakad_kampus < database/seed.sql
```

3. **Konfigurasi**
```bash
# Copy config example
cp config/database.example.php config/database.php

# Edit database credentials
nano config/database.php
```

4. **Jalankan Server**
```bash
# Menggunakan PHP Built-in Server
php -S localhost:8000
```

5. **Akses Aplikasi**
```
http://localhost:8000
```

---

## 🔐 Default Login

### Admin
- **NIM**: `admin`
- **Password**: `password123`

### Dosen
- **NIM**: `D001`
- **Password**: `password123`

### Mahasiswa
- **NIM**: `M001` / `M002` / `M003` / `M004`
- **Password**: `password123`

---

## 📁 Struktur Project

## 📁 Struktur Project

```
php-version/
├── config/           # Konfigurasi & database
├── models/           # Model layer (MVC pattern)
├── includes/         # Layout components
├── mahasiswa/        # Halaman mahasiswa
├── dosen/            # Halaman dosen
├── admin/            # Halaman admin
├── database/         # SQL schema & seed
├── public/           # CSS & JavaScript assets
└── uploads/          # File uploads
```

---

## 📝 Dokumentasi

- [INSTALASI.md](INSTALASI.md) - Panduan instalasi lengkap
- [LAPORAN.md](LAPORAN.md) - Laporan project untuk submission
- [SUMMARY.md](SUMMARY.md) - Ringkasan project
- [GITHUB_COMMIT_GUIDE.md](GITHUB_COMMIT_GUIDE.md) - Strategi commit

---

## 🎯 Testing Checklist

- [x] Login multi-role (Admin, Dosen, Mahasiswa)
- [x] Mahasiswa: Tambah/hapus KRS
- [x] Mahasiswa: Lihat jadwal kuliah
- [x] Mahasiswa: Lihat nilai & transkrip
- [x] Mahasiswa: Hitung IPK otomatis
- [x] Dosen: Input nilai mahasiswa
- [x] Dosen: Auto calculate nilai akhir
- [x] Admin: Dashboard statistik
- [x] Security: Password hashing
- [x] Security: SQL injection prevention
- [x] UI/UX: Responsive design
- [x] UI/UX: Interactive elements

---

## 📊 GitHub Statistics

- **Total Commits**: 39+
- **Total Files**: 50+
- **Lines of Code**: 3000+
- **Status**: ✅ **COMPLETED**

---

## 🤝 Kontribusi

Project ini dibuat untuk memenuhi tugas akhir mata kuliah Pemrograman Internet.

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

Tugas Akhir Pemrograman Internet - 2024

**Repository**: https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB.git

---

⭐ **Star this repository if you find it helpful!**

