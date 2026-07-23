# 🎓 SIAKAD - Sistem Informasi Akademik Kampus

## 📌 Informasi Project

**Nama**: SIAKAD - Sistem Informasi Akademik Kampus  
**Bahasa**: 100% Bahasa Indonesia Akademik  
**Framework**: PHP Native (No Framework)  
**Frontend**: AdminLTE 3.2 + Bootstrap 4  
**Database**: MySQL 8.0  
**Design**: Modern Clean UI/UX  

**Dibuat oleh:**
- **Nama**: Imam Rizki Saputra
- **NIM**: 301230013
- **Prodi**: Teknik Informatika
- **Universitas**: Universitas Bale Bandung
- **Mata Kuliah**: Pemrograman Web
- **Tahun**: 2026

---

## ✅ Status Project

- ✅ **Total Commits**: 62+ commits (Melebihi requirement 25+ commits)
- ✅ **Bahasa**: 100% Bahasa Indonesia akademik yang baik dan benar
- ✅ **UI/UX**: Modern clean design dengan color scheme professional
- ✅ **Fitur**: Lengkap untuk Admin, Dosen, dan Mahasiswa
- ✅ **No-Cache**: Headers sudah ditambahkan untuk force browser refresh

---

## 🚀 Quick Start

### **1. Persiapan**
```bash
# Pastikan XAMPP sudah terinstall
# MySQL harus running di XAMPP Control Panel

# Clone repository (jika belum)
git clone https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB.git
cd php-version
```

### **2. Setup Database**
```bash
# Buka phpMyAdmin: http://localhost/phpmyadmin
# Import database:
1. Create database: siakad_kampus
2. Import: database/schema_id.sql
3. Import: database/seed_id.sql
```

### **3. Konfigurasi**
```bash
# Edit config/database.php
# Sesuaikan dengan kredensial MySQL Anda
```

### **4. Start Server**

**Cara 1: Menggunakan Batch File (RECOMMENDED)**
```bash
# Double click file: restart-server.bat
# Atau jalankan di CMD:
restart-server.bat
```

**Cara 2: Manual**
```bash
cd "c:\Users\X395\KULIAH SEM 6\PEMROGRAMAN WEB\TUGAS\TUGAS AKHIR\sia-kampus\php-version"
C:\xampp\php\php.exe -S localhost:8000
```

### **5. Clear Browser Cache (PENTING!)**

**HARUS dilakukan untuk melihat perubahan Bahasa Indonesia:**

```bash
# Method 1: Test Cache Page
1. Buka: localhost:8000/test-cache.php
2. Refresh (F5) beberapa kali
3. Random number harus berubah

# Method 2: Incognito Mode (PALING MUDAH)
1. Tutup semua tab localhost:8000
2. Tekan: Ctrl + Shift + N (Chrome/Edge)
3. Buka: localhost:8000

# Method 3: Clear Cache Manual
1. Tekan: Ctrl + Shift + Delete
2. Pilih: "All time"
3. Centang: Cache, Cookies
4. Clear data
5. Restart browser
```

**📖 Panduan lengkap:** Lihat file `FORCE_REFRESH.md`

---

## 🔐 Akun Testing

| Role | Username | Password |
|------|----------|----------|
| **Admin** | `admin` | `password123` |
| **Dosen** | `D001` | `password123` |
| **Mahasiswa** | `M001` | `password123` |

---

## 🎨 Fitur Utama

### **1. Dashboard Admin**
- ✅ Statistik: Total Mahasiswa, Dosen Pengajar, Mata Kuliah, Kelas Aktif
- ✅ Tren Pendaftaran Mahasiswa (Chart placeholder)
- ✅ Aksi Cepat: Modifikasi KRS, Beasiswa, Cetak Transkrip, Pengumuman
- ✅ Aktivitas Pengguna Terkini dengan avatar
- ✅ Timeline pengumuman
- ✅ Manajemen pengguna lengkap

### **2. Dashboard Dosen**
- ✅ Kelas yang diampu dengan gradient cards
- ✅ Total mahasiswa per kelas
- ✅ Jadwal mengajar
- ✅ Input nilai mahasiswa
- ✅ Presensi kelas
- ✅ Upload materi kuliah
- ✅ Manajemen tugas
- ✅ Pengumuman untuk mahasiswa

### **3. Dashboard Mahasiswa** (PALING LENGKAP)
- ✅ Profile card dengan avatar dan statistik akademik
- ✅ Status KRS terverifikasi
- ✅ Jadwal hari ini dengan color-coded schedule
- ✅ Pengumuman terkini dengan kategori
- ✅ Perkembangan akademik (IPS per semester)
- ✅ Quick actions: Pengisian KRS, Buku Nilai, Jadwal Kuliah, Transkrip
- ✅ Pengisian KRS online
- ✅ Lihat nilai dan IPK
- ✅ Rekap presensi
- ✅ Download materi kuliah
- ✅ Submit tugas
- ✅ Pembayaran UKT dengan Virtual Account

---

## 🗂️ Struktur Database

**Total Tables**: 10 tabel

1. **profil** - Data pengguna (admin, dosen, mahasiswa)
2. **mata_kuliah** - Data mata kuliah
3. **kelas** - Data kelas perkuliahan
4. **krs** - Kartu Rencana Studi mahasiswa
5. **nilai** - Nilai mahasiswa per mata kuliah
6. **presensi** - Data kehadiran mahasiswa
7. **materi** - Materi kuliah yang diupload dosen
8. **tugas** - Tugas dan pengumpulan mahasiswa
9. **pengumuman** - Pengumuman kampus
10. **pembayaran** - Pembayaran UKT mahasiswa

**Semua field dalam Bahasa Indonesia:**
- `nama_lengkap`, `kata_sandi`, `peran`, `aktif`
- `kode_matkul`, `nama_matkul`, `sks`, `semester`
- `tahun_ajaran`, `jumlah_mahasiswa`, `kuota`
- dll.

---

## 🎨 Design Features

### **Modern UI/UX:**
- ✅ Clean white card-based layout
- ✅ Professional color palette (Blue, Green, Red, Orange)
- ✅ Gradient stat cards with hover effects
- ✅ Modern typography with Inter font stack
- ✅ Subtle shadows dan smooth transitions
- ✅ Avatar integration dengan UI Avatars API
- ✅ Badge system untuk status
- ✅ Timeline untuk announcements
- ✅ Responsive design untuk mobile
- ✅ Custom scrollbars

### **Color Scheme:**
```css
Primary Blue: #0066FF
Primary Green: #06D6A0
Primary Red: #E63946
Primary Orange: #F59E0B
Primary Purple: #8B5CF6
```

---

## 📝 Bahasa Indonesia Akademik

Semua teks menggunakan **Bahasa Indonesia yang baik dan benar**:

### **Terminologi Akademik:**
- Dashboard → **Beranda**
- Students → **Mahasiswa**
- Lecturers → **Dosen Pengajar**
- Courses → **Mata Kuliah**
- Active Classes → **Kelas Aktif**
- Schedule → **Jadwal Kuliah**
- Grade Book → **Buku Nilai**
- Transcript → **Transkrip**
- Announcements → **Pengumuman**
- User Management → **Manajemen Pengguna**
- Academic Management → **Manajemen Akademik**
- Settings → **Pengaturan**
- Logout → **Keluar**

### **Status & Badge:**
- ACTIVE → **AKTIF**
- VERIFIED → **TERVERIFIKASI**
- COMPLETED → **SELESAI**
- PENDING → **MENUNGGU**
- ACADEMIC → **AKADEMIK**
- EVENT → **ACARA**
- SCHOLARSHIP → **BEASISWA**

---

## 🛠️ Teknologi yang Digunakan

### **Backend:**
- PHP 8.2+ (Native, No Framework)
- MySQL 8.0
- PDO untuk database connection
- MVC Pattern
- Session management
- Password hashing dengan bcrypt

### **Frontend:**
- AdminLTE 3.2
- Bootstrap 4.6.2
- Font Awesome 6.0
- DataTables 1.13.6
- SweetAlert2
- jQuery 3.6.0
- Custom CSS dengan CSS Variables

### **Tools:**
- Git & GitHub (Version Control)
- XAMPP (Local Development)
- VS Code (Code Editor)

---

## 📂 Struktur File

```
php-version/
├── admin/              # Dashboard admin
│   ├── index.php
│   ├── mahasiswa.php
│   ├── dosen.php
│   ├── matakuliah.php
│   ├── kelas.php
│   └── pengumuman.php
├── dosen/              # Dashboard dosen
│   ├── index.php
│   ├── kelas.php
│   ├── jadwal.php
│   ├── nilai.php
│   ├── presensi.php
│   ├── materi.php
│   ├── tugas.php
│   └── pengumuman.php
├── mahasiswa/          # Dashboard mahasiswa
│   ├── index.php
│   ├── krs.php
│   ├── jadwal.php
│   ├── nilai.php
│   ├── presensi.php
│   ├── materi.php
│   ├── tugas.php
│   ├── pembayaran.php
│   └── pengumuman.php
├── config/             # Konfigurasi
│   ├── config.php
│   ├── database.php
│   ├── Database.class.php
│   └── helpers.php
├── models/             # Model classes
│   ├── BaseModel.php
│   ├── User.php
│   ├── Kelas.php
│   ├── KRS.php
│   ├── Nilai.php
│   └── ...
├── includes/           # Include files
│   ├── header.php
│   ├── footer.php
│   ├── sidebar-admin.php
│   ├── sidebar-dosen.php
│   └── sidebar-mahasiswa.php
├── public/             # Static files
│   ├── css/
│   │   └── custom.css
│   └── js/
│       └── app.js
├── database/           # Database files
│   ├── schema_id.sql
│   └── seed_id.sql
├── login.php           # Halaman login
├── logout.php          # Proses logout
├── test-cache.php      # Test page untuk cache
├── restart-server.bat  # Batch file restart server
├── FORCE_REFRESH.md    # Panduan clear cache
└── README.md           # File ini
```

---

## 🐛 Troubleshooting

### **Problem 1: Masih muncul Bahasa Inggris**
**Solusi:**
1. Buka `localhost:8000/test-cache.php`
2. Refresh beberapa kali, pastikan random number berubah
3. Jika tidak berubah = browser cache masih aktif
4. Clear cache dengan `Ctrl + Shift + Delete`
5. Atau buka Incognito mode: `Ctrl + Shift + N`
6. Atau gunakan browser berbeda

**Panduan lengkap:** Lihat `FORCE_REFRESH.md`

### **Problem 2: Database connection error**
**Solusi:**
1. Pastikan MySQL running di XAMPP
2. Cek kredensial di `config/database.php`
3. Pastikan database `siakad_kampus` sudah dibuat
4. Import ulang `database/schema_id.sql` dan `seed_id.sql`

### **Problem 3: Page not found**
**Solusi:**
1. Pastikan server running di `localhost:8000`
2. Cek terminal/CMD apakah ada error
3. Restart server dengan `restart-server.bat`

### **Problem 4: Login gagal**
**Solusi:**
1. Pastikan password: `password123` (semua akun)
2. Jika lupa, jalankan `fix-password.php`
3. Atau re-import `database/seed_id.sql`

---

## 📊 Statistik Project

- ✅ **Total Commits**: 62 commits
- ✅ **Total Files**: 50+ files
- ✅ **Lines of Code**: 5000+ lines
- ✅ **Development Time**: 2 minggu
- ✅ **Database Tables**: 10 tables
- ✅ **Features**: 30+ features
- ✅ **Pages**: 25+ pages
- ✅ **Language**: 100% Bahasa Indonesia

---

## 🎯 Fitur yang Memenuhi Requirement

### **Requirement Tugas:**
1. ✅ **Login Multi-role** (Admin, Dosen, Mahasiswa)
2. ✅ **Manajemen KRS** (Pengisian, Edit, Hapus)
3. ✅ **Input Nilai** (Dosen input, Mahasiswa lihat)
4. ✅ **Hitung IPK Otomatis** (Berdasarkan nilai)
5. ✅ **View Jadwal Kuliah** (Per mahasiswa dan dosen)
6. ✅ **25+ Commits Git** (Sudah 62 commits!)

### **Fitur Tambahan:**
7. ✅ Presensi kehadiran
8. ✅ Upload/download materi kuliah
9. ✅ Manajemen tugas
10. ✅ Pengumuman kampus
11. ✅ Pembayaran UKT dengan Virtual Account
12. ✅ Modern UI/UX design
13. ✅ Responsive layout
14. ✅ Avatar integration
15. ✅ Timeline announcements

---

## 📖 Dokumentasi Lengkap

1. **INSTALASI.md** - Panduan instalasi lengkap
2. **FORCE_REFRESH.md** - Panduan clear cache browser
3. **CARA_CLEAR_CACHE.md** - Cara clear cache step by step
4. **LOGIN_INFO.md** - Informasi akun testing
5. **LAPORAN.md** - Laporan project lengkap
6. **GITHUB_COMMIT_GUIDE.md** - Panduan commit Git

---

## 🌐 Links

- **Repository**: https://github.com/imamrzkys/TUGAS-PROJECT-PEMROGRAMAN-WEB
- **Demo**: http://localhost:8000
- **Test Cache**: http://localhost:8000/test-cache.php

---

## 📞 Support

Jika ada pertanyaan atau masalah:

1. Baca `FORCE_REFRESH.md` untuk masalah cache
2. Baca `INSTALASI.md` untuk setup awal
3. Cek `test-cache.php` untuk verify cache settings
4. Gunakan browser Incognito jika masih ada masalah

---

## 📜 License

MIT License - Free to use for educational purposes

---

## 🎓 Kesimpulan

Project SIAKAD ini dibuat dengan **PHP Native** (tanpa framework) sesuai requirement tugas, dengan desain **modern dan profesional**, menggunakan **100% Bahasa Indonesia akademik yang baik dan benar**, dan dilengkapi dengan **fitur-fitur lengkap** untuk manajemen sistem informasi akademik kampus.

**Total commits: 62** (melebihi requirement 25+ commits)  
**Status: ✅ Complete & Ready to Use**

---

**Dibuat dengan ❤️ oleh Imam Rizki Saputra**  
**NIM: 301230013 - Teknik Informatika**  
**Universitas Bale Bandung - 2026**
