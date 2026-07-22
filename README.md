# SIAKAD Kampus - PHP Version

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

## Deskripsi
Sistem Informasi Akademik Kampus berbasis web menggunakan PHP murni (tanpa framework) dan AdminLTE.

**Proyek Tugas Akhir - Pemrograman Web**

## Fitur Utama
- ✅ Login Multi Role (Admin, Dosen, Mahasiswa)
- ✅ Isi KRS (Kartu Rencana Studi)
- ✅ Input dan Lihat Nilai
- ✅ Hitung IPK Otomatis
- ✅ Manajemen Kelas
- ✅ Presensi
- ✅ Tugas & Materi
- ✅ Pembayaran UKT
- ✅ Pengumuman

## Teknologi
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

## Instalasi
1. Clone repository
2. Import database dari `database/schema.sql`
3. Konfigurasi `config/database.php`
4. Jalankan dengan PHP built-in server: `php -S localhost:8000`

## Default Login
- **Admin**: nim=`admin`, password=`admin123`
- **Dosen**: nim=`D001`, password=`dosen123`
- **Mahasiswa**: nim=`M001`, password=`mahasiswa123`

## Author
Tugas Akhir Pemrograman Internet
