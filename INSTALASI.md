# Panduan Instalasi SIAKAD Kampus

## Persyaratan Sistem
- PHP 7.4 atau lebih tinggi
- MySQL 5.7+ atau MariaDB 10.2+
- Web Server (Apache/Nginx) atau PHP Built-in Server
- Extension PHP: PDO, pdo_mysql, mbstring

## Langkah Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd sia-kampus/php-version
```

### 2. Konfigurasi Database

#### Opsi A: Menggunakan MySQL/MariaDB

1. Buat database baru:
```sql
CREATE DATABASE siakad_kampus CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Import schema:
```bash
mysql -u root -p siakad_kampus < database/schema.sql
```

3. Import data seed:
```bash
mysql -u root -p siakad_kampus < database/seed.sql
```

4. Konfigurasi koneksi database:
```bash
cp config/database.example.php config/database.php
```

Edit `config/database.php` sesuaikan dengan environment Anda:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'password_anda');
define('DB_NAME', 'siakad_kampus');
```

### 3. Setup Folder Upload
```bash
mkdir -p uploads/materi uploads/tugas uploads/pembayaran uploads/foto
chmod -R 777 uploads
```

### 4. Jalankan Aplikasi

#### Menggunakan PHP Built-in Server (Development)
```bash
php -S localhost:8000
```

Akses aplikasi di: `http://localhost:8000`

#### Menggunakan XAMPP/WAMP
1. Copy folder `php-version` ke `htdocs` atau `www`
2. Akses via: `http://localhost/php-version`

## Akun Default

### Admin
- **NIM**: `admin`
- **Password**: `password123`

### Dosen
- **NIM**: `D001`
- **Password**: `password123`

### Mahasiswa
- **NIM**: `M001`, `M002`, `M003`, `M004`
- **Password**: `password123`

## Troubleshooting

### Error "Connection refused"
- Pastikan MySQL service sudah running
- Cek kredensial database di `config/database.php`

### Error "Permission denied" saat upload
```bash
chmod -R 777 uploads
```

### Error "Session could not start"
```bash
chmod 777 /tmp  # Linux/Mac
```

## Struktur Folder
```
php-version/
├── config/           # Konfigurasi aplikasi
├── models/           # Model database
├── includes/         # Header, footer, sidebar
├── mahasiswa/        # Halaman mahasiswa
├── dosen/            # Halaman dosen
├── admin/            # Halaman admin
├── database/         # SQL schema & seed
├── uploads/          # File upload
└── public/           # Assets (optional)
```

## Fitur yang Tersedia

### Mahasiswa
- ✅ Login
- ✅ Dashboard
- ✅ Isi KRS
- ✅ Lihat Jadwal
- ✅ Lihat Nilai & IPK
- ✅ Lihat Presensi
- ✅ Download Materi
- ✅ Upload Tugas
- ✅ Cek Pembayaran
- ✅ Lihat Pengumuman

### Dosen
- ✅ Login
- ✅ Dashboard
- ✅ Lihat Kelas
- ✅ Input Nilai
- ✅ Input Presensi
- ✅ Upload Materi
- ✅ Buat Tugas

### Admin
- ✅ Login
- ✅ Dashboard
- ✅ Kelola Mahasiswa
- ✅ Kelola Dosen
- ✅ Kelola Mata Kuliah
- ✅ Kelola Kelas
- ✅ Kelola KRS
- ✅ Lihat Nilai
- ✅ Kelola Pembayaran
- ✅ Kelola Pengumuman
- ✅ Laporan

## Support
Jika ada pertanyaan atau masalah, silakan buat issue di GitHub repository.
