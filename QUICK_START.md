# 🚀 Quick Start - SIAKAD Kampus

## ✅ Database Sudah Ready!

Database **siakad_kampus** sudah dibuat dan terisi dengan data sample.

---

## 🎯 Cara Menjalankan Aplikasi

### Opsi 1: Double Click (Paling Mudah)
1. Double click file **`start.bat`**
2. Browser akan otomatis terbuka
3. Atau buka manual: **http://localhost:8000**

### Opsi 2: Manual via Command
```bash
C:\xampp\php\php.exe -S localhost:8000
```

---

## 🔐 Akun Login

### Admin
- **NIM**: `admin`
- **Password**: `password123`
- **Akses**: Kelola seluruh sistem

### Dosen
- **NIM**: `D001`
- **Password**: `password123`
- **Fitur**: Input nilai mahasiswa

### Mahasiswa
| NIM  | Nama            | Password     |
|------|-----------------|--------------|
| M001 | Andi Wijaya     | password123  |
| M002 | Dewi Lestari    | password123  |
| M003 | Rizki Pratama   | password123  |
| M004 | Sari Wulandari  | password123  |

---

## 📋 Testing Checklist

### Test sebagai Mahasiswa (M001)
1. ✅ Login dengan NIM: M001, Password: password123
2. ✅ Lihat Dashboard (ada 3 mata kuliah, total 9 SKS, IPK)
3. ✅ Buka menu **"KRS Saya"**
4. ✅ Klik **"Tambah Mata Kuliah"** - pilih mata kuliah baru
5. ✅ Buka menu **"Nilai & Transkrip"**
6. ✅ Lihat IPK otomatis terhitung
7. ✅ Buka menu **"Jadwal Kuliah"**
8. ✅ Logout

### Test sebagai Dosen (D001)
1. ✅ Login dengan NIM: D001, Password: password123
2. ✅ Lihat Dashboard (jumlah kelas yang diampu)
3. ✅ Buka menu **"Input Nilai"**
4. ✅ Pilih kelas "Pemrograman Web"
5. ✅ Input nilai mahasiswa:
   - Tugas: 85
   - UTS: 80
   - UAS: 88
6. ✅ Klik **"Simpan"** - lihat nilai akhir & grade otomatis
7. ✅ Logout

### Test sebagai Admin
1. ✅ Login dengan NIM: admin, Password: password123
2. ✅ Lihat Dashboard dengan statistik lengkap
3. ✅ Explore menu admin
4. ✅ Logout

---

## ⚠️ Troubleshooting

### Port 8000 sudah digunakan
Gunakan port lain:
```bash
C:\xampp\php\php.exe -S localhost:8080
```
Lalu akses: http://localhost:8080

### Error "Connection refused"
1. Pastikan XAMPP MySQL sudah running
2. Buka XAMPP Control Panel
3. Start MySQL service
4. Refresh browser

### Error "Database not found"
Jalankan ulang setup database:
```bash
# Masuk ke folder php-version
cd "c:\Users\X395\KULIAH SEM 6\PEMROGRAMAN WEB\TUGAS\TUGAS AKHIR\sia-kampus\php-version"

# Buat database
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS siakad_kampus"

# Import schema
Get-Content database/schema.sql | C:\xampp\mysql\bin\mysql.exe -u root siakad_kampus

# Import data
Get-Content database/seed.sql | C:\xampp\mysql\bin\mysql.exe -u root siakad_kampus
```

---

## 🎓 Fitur yang Bisa Dicoba

### Mahasiswa
- ✅ Tambah/hapus KRS
- ✅ Lihat jadwal kuliah
- ✅ Lihat nilai setiap mata kuliah
- ✅ Lihat transkrip per semester
- ✅ Cek IPK (auto calculate)
- ✅ Edit profil
- ✅ Ubah password

### Dosen
- ✅ Input nilai per komponen (Tugas, UTS, UAS)
- ✅ Auto calculate nilai akhir
- ✅ Lihat grade otomatis
- ✅ Lihat daftar mahasiswa per kelas

### Admin
- ✅ Lihat statistik sistem
- ✅ Quick actions untuk manajemen

---

## 📊 Data yang Sudah Ada

### Mahasiswa
- 4 mahasiswa (M001, M002, M003, M004)
- M001 & M002 sudah punya KRS (3 mata kuliah)
- M001 & M002 sudah punya nilai di beberapa matkul

### Kelas
- 6 kelas tersedia semester Ganjil 2023/2024
- Pemrograman Web (Kamis 08:00)
- Jaringan Komputer (Jumat 08:00)
- Rekayasa Perangkat Lunak (Senin 13:00)
- Dan lainnya...

### Nilai
- M001 sudah punya nilai di 2 mata kuliah
- M002 sudah punya nilai di 1 mata kuliah
- Bisa lihat IPK otomatis

---

## 🎯 Next Steps

1. **Test semua fitur** dengan 3 role berbeda
2. **Screenshot** setiap halaman penting untuk laporan
3. **Export database** jika ingin backup:
   ```bash
   C:\xampp\mysql\bin\mysqldump.exe -u root siakad_kampus > backup.sql
   ```

---

## 📞 Butuh Bantuan?

Lihat file **LAPORAN.md** untuk dokumentasi lengkap.

---

✅ **Aplikasi sudah siap digunakan!**

**URL**: http://localhost:8000
