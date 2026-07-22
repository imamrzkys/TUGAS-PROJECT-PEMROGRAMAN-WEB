# 📸 Screenshot Guide untuk Laporan

Berikut adalah daftar screenshot yang perlu diambil untuk laporan:

---

## 1️⃣ Login Page
📍 **URL**: http://localhost:8000/login.php

**Yang perlu difoto**:
- [ ] Tampilan login dengan gradient ungu
- [ ] Form input NIM dan Password
- [ ] Info demo account di bawah form

---

## 2️⃣ Dashboard Mahasiswa
📍 **Login**: NIM=M001, Password=password123
📍 **URL**: http://localhost:8000/mahasiswa/index.php

**Yang perlu difoto**:
- [ ] Dashboard dengan 4 info box:
  - Mata Kuliah Aktif: 3
  - Total SKS: 9
  - IPK: (akan tampil angka)
  - Semester Aktif: 3
- [ ] Card "Jadwal Hari Ini"
- [ ] Card "KRS Semester Ini"

---

## 3️⃣ KRS Management (Mahasiswa)
📍 **URL**: http://localhost:8000/mahasiswa/krs.php

**Yang perlu difoto**:
- [ ] Info box: Tahun Ajaran, Mata Kuliah Diambil, Total SKS
- [ ] Tabel KRS yang sudah diambil (3 mata kuliah)
- [ ] Button "Tambah Mata Kuliah"
- [ ] Modal "Tambah Mata Kuliah" dengan daftar kelas tersedia
- [ ] Kolom: Kode MK, Mata Kuliah, SKS, Kelas, Dosen, Jadwal, Ruangan, Kuota, Aksi

**Cara ambil screenshot modal**:
1. Klik button "Tambah Mata Kuliah"
2. Screenshot saat modal terbuka

---

## 4️⃣ Jadwal Kuliah (Mahasiswa)
📍 **URL**: http://localhost:8000/mahasiswa/jadwal.php

**Yang perlu difoto**:
- [ ] Tabel jadwal kuliah dengan kolom:
  - Kode MK
  - Mata Kuliah
  - Hari
  - Jam
  - Ruangan
  - Dosen

---

## 5️⃣ Nilai & Transkrip (Mahasiswa)
📍 **URL**: http://localhost:8000/mahasiswa/nilai.php

**Yang perlu difoto**:
- [ ] Card IPK besar di tengah dengan angka besar
- [ ] Keterangan predikat (contoh: "Sangat Memuaskan")
- [ ] Card per semester dengan tabel nilai:
  - Kode MK
  - Mata Kuliah
  - SKS
  - Nilai (angka)
  - Grade (badge warna: hijau untuk A, biru untuk B, dll)
  - Bobot
- [ ] Badge IP Semester dan Total SKS di header card

---

## 6️⃣ Dashboard Dosen
📍 **Logout dulu, lalu login**: NIM=D001, Password=password123
📍 **URL**: http://localhost:8000/dosen/index.php

**Yang perlu difoto**:
- [ ] Dashboard dengan info box:
  - Kelas Diampu
  - Total Mahasiswa
  - Tahun Ajaran
- [ ] Tabel "Kelas yang Diampu" dengan button aksi (Input Nilai, Presensi)

---

## 7️⃣ Input Nilai (Dosen)
📍 **URL**: http://localhost:8000/dosen/nilai.php

**Screenshot 1 - Pilih Kelas**:
- [ ] Dropdown "Pilih Kelas"
- [ ] Info kelas (Kode MK, Nama, Jadwal, Ruangan, SKS)

**Screenshot 2 - Tabel Input Nilai**:
- [ ] Tabel mahasiswa dengan kolom:
  - NIM
  - Nama Mahasiswa
  - Input Tugas (30%)
  - Input UTS (30%)
  - Input UAS (40%)
  - Nilai Akhir (auto calculate)
  - Grade (badge warna)
  - Button Simpan
- [ ] Contoh: isi nilai Tugas=85, UTS=80, UAS=88
- [ ] Screenshot sebelum dan sesudah klik simpan

---

## 8️⃣ Dashboard Admin
📍 **Logout dulu, lalu login**: NIM=admin, Password=password123
📍 **URL**: http://localhost:8000/admin/index.php

**Yang perlu difoto**:
- [ ] Dashboard dengan 4 info box:
  - Total Mahasiswa
  - Total Dosen
  - Total Kelas Aktif
  - Total KRS Aktif
- [ ] Section "Quick Actions" dengan button-button:
  - Tambah Mahasiswa
  - Tambah Dosen
  - Tambah Mata Kuliah
  - Buat Kelas
  - Buat Pengumuman

---

## 9️⃣ Profil User
📍 **URL**: http://localhost:8000/profile.php

**Yang perlu difoto**:
- [ ] Card profil dengan foto icon besar
- [ ] Info: Nama, Role, NIM
- [ ] Form edit profil dengan field:
  - Nama Lengkap
  - Email
  - Telepon
  - Alamat
- [ ] Button "Simpan Perubahan" dan "Ubah Password"

---

## 🔟 Ubah Password
📍 **URL**: http://localhost:8000/change-password.php

**Yang perlu difoto**:
- [ ] Form ubah password dengan field:
  - Password Lama
  - Password Baru (minimal 8 karakter)
  - Konfirmasi Password Baru

---

## 1️⃣1️⃣ Pengumuman (Mahasiswa)
📍 **URL**: http://localhost:8000/mahasiswa/pengumuman.php

**Yang perlu difoto**:
- [ ] Card pengumuman dengan:
  - Icon bullhorn
  - Judul pengumuman
  - Badge kategori
  - Isi pengumuman
  - Footer dengan author dan tanggal

---

## 💡 Tips Screenshot

### Untuk Windows:
- **Fullscreen**: Tekan `Windows + Shift + S`, pilih area
- **Window**: Tekan `Alt + PrtScn`
- **Tool**: Gunakan Snipping Tool atau Snip & Sketch

### Yang Perlu Diperhatikan:
1. ✅ Screenshot dalam resolusi yang jelas (tidak blur)
2. ✅ Tampilkan URL di browser (untuk bukti)
3. ✅ Capture seluruh komponen penting
4. ✅ Pastikan data terlihat jelas
5. ✅ Untuk modal/popup, screenshot saat terbuka

### Organisasi File Screenshot:
```
screenshots/
├── 01-login.png
├── 02-dashboard-mahasiswa.png
├── 03-krs-management.png
├── 04-krs-tambah-modal.png
├── 05-jadwal-kuliah.png
├── 06-nilai-transkrip.png
├── 07-dashboard-dosen.png
├── 08-input-nilai-pilih-kelas.png
├── 09-input-nilai-tabel.png
├── 10-dashboard-admin.png
├── 11-profil-user.png
├── 12-ubah-password.png
└── 13-pengumuman.png
```

---

## 📝 Keterangan untuk Laporan

Setiap screenshot diberi keterangan:

**Contoh**:
```
Gambar 3.1 Halaman KRS Management
Halaman ini menampilkan daftar mata kuliah yang sudah diambil mahasiswa
beserta informasi jadwal, dosen, dan ruangan. Mahasiswa dapat menambah
atau menghapus mata kuliah dengan validasi kuota dan total SKS maksimal 24 SKS.
```

---

✅ **Setelah screenshot semua, masukkan ke laporan Word dengan nomor dan keterangan!**
