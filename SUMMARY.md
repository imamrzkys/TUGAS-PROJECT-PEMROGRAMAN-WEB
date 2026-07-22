# Summary Project SIAKAD Kampus

## Informasi Project
- **Nama Project**: Sistem Informasi Akademik Kampus
- **Teknologi**: PHP Native (No Framework), MySQL, AdminLTE, Bootstrap
- **Repository**: https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB.git
- **Total Commits**: 37+ commits
- **Status**: ✅ Completed & Pushed to GitHub

## Fitur yang Telah Diimplementasikan

### 1. Authentication System ✅
- Login multi-role (Admin, Dosen, Mahasiswa)
- Logout functionality
- Session management
- Password encryption (bcrypt)
- Change password feature

### 2. Mahasiswa Module ✅
- **Dashboard**: Statistik KRS, IPK, jadwal hari ini
- **KRS (Kartu Rencana Studi)**: 
  - Tambah/hapus mata kuliah
  - Validasi kuota kelas
  - Validasi maksimal SKS
- **Jadwal Kuliah**: Lihat jadwal per semester
- **Nilai & Transkrip**: 
  - Lihat nilai per mata kuliah
  - Hitung IPK otomatis
  - Grade dan bobot nilai
  - Cetak transkrip
- **Pengumuman**: Lihat pengumuman kampus
- **Profil**: Edit profil mahasiswa

### 3. Dosen Module ✅
- **Dashboard**: Statistik kelas yang diampu
- **Daftar Kelas**: Lihat kelas yang diajar
- **Input Nilai**: 
  - Input nilai per komponen (Tugas, UTS, UAS)
  - Dengan bobot yang dapat dikonfigurasi
  - Lihat daftar mahasiswa per kelas
  - Hitung nilai akhir otomatis

### 4. Admin Module ✅
- **Dashboard**: Statistik keseluruhan sistem
- Quick actions untuk manajemen data

### 5. Sistem Nilai & IPK ✅
- Komponen nilai: Tugas (30%), UTS (30%), UAS (40%)
- Konversi nilai ke grade (A, A-, B+, B, B-, C+, C, D, E)
- Perhitungan IPK otomatis
- View transkrip per semester

## Struktur Database

### Tables (10 Tables)
1. **profiles** - Data user (mahasiswa, dosen, admin)
2. **mata_kuliah** - Data mata kuliah
3. **kelas** - Data kelas perkuliahan
4. **krs** - Kartu Rencana Studi
5. **nilai** - Data nilai mahasiswa
6. **presensi** - Data kehadiran
7. **materi** - Materi kuliah
8. **tugas** - Penugasan
9. **pengumuman** - Pengumuman kampus
10. **pembayaran** - Data pembayaran UKT

## Teknologi Stack

### Backend
- **PHP 7.4+**: Pure PHP tanpa framework
- **PDO**: Database abstraction layer
- **MySQL**: Relational database
- **Session**: State management

### Frontend
- **AdminLTE 3.2**: Admin template
- **Bootstrap 4**: CSS framework
- **jQuery**: JavaScript library
- **DataTables**: Table enhancement
- **SweetAlert2**: Beautiful alerts
- **Font Awesome**: Icons

### Security
- Password hashing dengan bcrypt
- Prepared statements untuk SQL injection prevention
- Session-based authentication
- Input sanitization
- Role-based access control (RBAC)

## Struktur Folder
```
php-version/
├── config/               # Konfigurasi & helpers
│   ├── config.php
│   ├── database.php
│   ├── Database.class.php
│   └── helpers.php
├── models/               # Model layer (MVC)
│   ├── BaseModel.php
│   ├── User.php
│   ├── KRS.php
│   ├── Nilai.php
│   ├── Kelas.php
│   ├── MataKuliah.php
│   └── Pengumuman.php
├── includes/             # Layout components
│   ├── header.php
│   ├── footer.php
│   ├── sidebar-mahasiswa.php
│   ├── sidebar-dosen.php
│   └── sidebar-admin.php
├── mahasiswa/            # Mahasiswa pages
│   ├── index.php
│   ├── krs.php
│   ├── jadwal.php
│   ├── nilai.php
│   └── pengumuman.php
├── dosen/                # Dosen pages
│   ├── index.php
│   └── nilai.php
├── admin/                # Admin pages
│   └── index.php
├── database/             # SQL files
│   ├── schema.sql
│   └── seed.sql
├── public/               # Assets
│   ├── css/custom.css
│   └── js/app.js
├── uploads/              # File uploads
├── login.php
├── logout.php
├── profile.php
├── change-password.php
└── index.php
```

## Akun Testing

### Admin
- NIM: `admin`
- Password: `password123`

### Dosen
- NIM: `D001`
- Password: `password123`

### Mahasiswa
- NIM: `M001`, `M002`, `M003`, `M004`
- Password: `password123`

## Git Commit History (37 Commits)

1. feat: initial project setup with README and gitignore
2. feat: add database schema with all tables
3. feat: add seed data for testing
4. feat: add database and app configuration
5. feat: add base model class and helper functions
6. feat: add User model with authentication logic
7. feat: add login page with AdminLTE template
8. feat: add logout and index redirect
9. feat: add header and footer layout components
10. feat: add mahasiswa navigation sidebar
11. feat: add mahasiswa dashboard with statistics
12. feat: add KRS model for course registration
13. feat: add KRS page for course selection
14. feat: add Nilai model with IPK calculation
15. feat: add transcript and IPK display page
16. feat: add dosen navigation sidebar
17. feat: add dosen dashboard with class list
18. feat: add Kelas model with detailed queries
19. feat: add grade input page for dosen
20. feat: add admin navigation sidebar
21. docs: add installation guide
22. docs: add GitHub commit strategy guide
23. feat: add admin dashboard with statistics overview
24. feat: add schedule page for mahasiswa
25. chore: add uploads folder structure
26. style: improve app configuration with author info
27. feat: add user profile management page
28. feat: add password change functionality
29. docs: improve README with badges and description
30. docs: add MIT license
31. chore: add Apache configuration and security rules
32. feat: add MataKuliah model with CRUD operations
33. feat: add Pengumuman model for announcements
34. feat: add announcement page for mahasiswa
35. style: add custom CSS for improved UI/UX
36. feat: add interactive JavaScript functionality
37. refactor: integrate custom assets in layout

## Cara Menjalankan Project

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

# Import seed data
mysql -u root -p siakad_kampus < database/seed.sql
```

### 3. Konfigurasi
```bash
# Copy config example
cp config/database.example.php config/database.php

# Edit database credentials di config/database.php
```

### 4. Jalankan Server
```bash
# Gunakan PHP built-in server
php -S localhost:8000

# Atau gunakan XAMPP/WAMP
# Copy ke folder htdocs/www
```

### 5. Akses Aplikasi
```
http://localhost:8000
```

## Fitur Tambahan yang Bisa Dikembangkan

1. **Presensi**: QR Code atau Manual attendance
2. **Materi Kuliah**: Upload dan download materi
3. **Tugas**: Submission system dengan deadline
4. **Pembayaran UKT**: Payment tracking
5. **Laporan**: Generate PDF reports
6. **Export Data**: Excel export functionality
7. **Email Notification**: Automated emails
8. **Mobile Responsive**: Improve mobile UX
9. **API REST**: untuk mobile app
10. **Real-time Notification**: menggunakan WebSocket

## Testing Checklist

- [✅] Login sebagai Admin
- [✅] Login sebagai Dosen
- [✅] Login sebagai Mahasiswa
- [✅] Mahasiswa: Lihat dashboard
- [✅] Mahasiswa: Tambah KRS
- [✅] Mahasiswa: Hapus KRS
- [✅] Mahasiswa: Lihat jadwal
- [✅] Mahasiswa: Lihat nilai dan IPK
- [✅] Mahasiswa: Lihat pengumuman
- [✅] Mahasiswa: Edit profil
- [✅] Mahasiswa: Ubah password
- [✅] Dosen: Lihat dashboard
- [✅] Dosen: Lihat kelas yang diampu
- [✅] Dosen: Input nilai mahasiswa
- [✅] Admin: Lihat dashboard
- [✅] Hitung IPK otomatis
- [✅] Konversi nilai ke grade

## Screenshots

### Login Page
- Modern gradient design
- Clean interface
- Demo account info

### Mahasiswa Dashboard
- Statistik mata kuliah
- Total SKS
- IPK display
- Jadwal hari ini

### KRS Management
- Tambah/hapus mata kuliah
- Filter kelas tersedia
- Validasi kuota

### Nilai & Transkrip
- Tampilan per semester
- Grade dengan warna
- IPK calculation
- Print function

### Dosen - Input Nilai
- Select kelas
- Input per komponen
- Auto calculate nilai akhir
- Grade preview

## Catatan Penting

1. **Password default semua user**: `password123`
2. **Database**: Gunakan MySQL 5.7+ atau MariaDB 10.2+
3. **PHP Version**: Minimal PHP 7.4
4. **Extensions**: PDO, pdo_mysql, mbstring
5. **Security**: Ganti JWT_SECRET di production
6. **Folder Upload**: Chmod 777 untuk folder uploads/

## Dokumentasi Tambahan

- [INSTALASI.md](INSTALASI.md) - Panduan instalasi lengkap
- [GITHUB_COMMIT_GUIDE.md](GITHUB_COMMIT_GUIDE.md) - Strategi commit
- [LICENSE](LICENSE) - MIT License

## Kontributor

Tugas Akhir Pemrograman Web - 2024

---

**Repository**: https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB.git

**Status**: ✅ **COMPLETED & READY FOR SUBMISSION**
