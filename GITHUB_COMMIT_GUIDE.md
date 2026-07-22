# Panduan GitHub Commits (Minimal 25 Commits)

## Setup Awal

### 1. Inisialisasi Git Repository
```bash
cd php-version
git init
git remote add origin <your-github-repo-url>
```

### 2. Konfigurasi Git
```bash
git config user.name "Nama Anda"
git config user.email "email@anda.com"
```

## Strategi Commits Bertahap

Berikut adalah rencana 30+ commits yang terstruktur:

### Fase 1: Setup Project (Commits 1-5)

```bash
# Commit 1: Initial commit
git add README.md .gitignore
git commit -m "feat: initial project setup with README and gitignore"

# Commit 2: Database schema
git add database/schema.sql
git commit -m "feat: add database schema with all tables"

# Commit 3: Database seed
git add database/seed.sql
git commit -m "feat: add seed data for testing"

# Commit 4: Configuration files
git add config/
git commit -m "feat: add database and app configuration"

# Commit 5: Base model & helpers
git add config/Database.class.php config/helpers.php models/BaseModel.php
git commit -m "feat: add base model class and helper functions"
```

### Fase 2: Authentication (Commits 6-9)

```bash
# Commit 6: User model
git add models/User.php
git commit -m "feat: add User model with authentication logic"

# Commit 7: Login page
git add login.php
git commit -m "feat: add login page with AdminLTE template"

# Commit 8: Logout functionality
git add logout.php index.php
git commit -m "feat: add logout and index redirect"

# Commit 9: Layout components
git add includes/header.php includes/footer.php
git commit -m "feat: add header and footer layout components"
```

### Fase 3: Mahasiswa Module (Commits 10-15)

```bash
# Commit 10: Mahasiswa sidebar
git add includes/sidebar-mahasiswa.php
git commit -m "feat: add mahasiswa navigation sidebar"

# Commit 11: Mahasiswa dashboard
git add mahasiswa/index.php
git commit -m "feat: add mahasiswa dashboard with statistics"

# Commit 12: KRS model
git add models/KRS.php
git commit -m "feat: add KRS model for course registration"

# Commit 13: KRS page
git add mahasiswa/krs.php
git commit -m "feat: add KRS page for course selection"

# Commit 14: Nilai model
git add models/Nilai.php
git commit -m "feat: add Nilai model with IPK calculation"

# Commit 15: Transkrip page
git add mahasiswa/nilai.php
git commit -m "feat: add transcript and IPK display page"
```

### Fase 4: Dosen Module (Commits 16-20)

```bash
# Commit 16: Dosen sidebar
git add includes/sidebar-dosen.php
git commit -m "feat: add dosen navigation sidebar"

# Commit 17: Dosen dashboard
git add dosen/index.php
git commit -m "feat: add dosen dashboard with class list"

# Commit 18: Kelas model
git add models/Kelas.php
git commit -m "feat: add Kelas model with detailed queries"

# Commit 19: Input nilai page
git add dosen/nilai.php
git commit -m "feat: add grade input page for dosen"

# Commit 20: Kelas management
git add dosen/kelas.php
git commit -m "feat: add class management for dosen"
```

### Fase 5: Admin Module (Commits 21-25)

```bash
# Commit 21: Admin sidebar
git add includes/sidebar-admin.php
git commit -m "feat: add admin navigation sidebar"

# Commit 22: Admin dashboard
git add admin/index.php
git commit -m "feat: add admin dashboard with overview statistics"

# Commit 23: Mahasiswa management
git add admin/mahasiswa.php
git commit -m "feat: add student management CRUD for admin"

# Commit 24: Dosen management
git add admin/dosen.php
git commit -m "feat: add lecturer management CRUD for admin"

# Commit 25: Mata kuliah management
git add admin/matakuliah.php
git commit -m "feat: add course management CRUD for admin"
```

### Fase 6: Additional Features (Commits 26-30+)

```bash
# Commit 26: Kelas management admin
git add admin/kelas.php
git commit -m "feat: add class management for admin"

# Commit 27: Presensi feature
git add mahasiswa/presensi.php dosen/presensi.php
git commit -m "feat: add attendance feature for mahasiswa and dosen"

# Commit 28: Materi kuliah
git add mahasiswa/materi.php dosen/materi.php
git commit -m "feat: add course materials upload and download"

# Commit 29: Tugas feature
git add mahasiswa/tugas.php dosen/tugas.php
git commit -m "feat: add assignment submission feature"

# Commit 30: Pembayaran feature
git add mahasiswa/pembayaran.php admin/pembayaran.php
git commit -m "feat: add payment tracking feature"

# Commit 31: Pengumuman
git add mahasiswa/pengumuman.php dosen/pengumuman.php admin/pengumuman.php
git commit -m "feat: add announcement system"

# Commit 32: Documentation
git add INSTALASI.md GITHUB_COMMIT_GUIDE.md
git commit -m "docs: add installation and commit guide"

# Commit 33: Final touches
git add .
git commit -m "style: improve UI/UX and fix minor bugs"

# Commit 34: Upload folder setup
mkdir -p uploads/{materi,tugas,pembayaran,foto}
git add uploads/.gitkeep
git commit -m "chore: add uploads folder structure"
```

## Push ke GitHub

```bash
git branch -M main
git push -u origin main
```

## Tips Commits yang Baik

### Format Commit Message
```
<type>: <subject>

<body> (optional)
```

### Types
- `feat`: Fitur baru
- `fix`: Bug fix
- `docs`: Dokumentasi
- `style`: Formatting, styling
- `refactor`: Code refactoring
- `test`: Testing
- `chore`: Maintenance

### Contoh Commit Messages
✅ Good:
```
feat: add KRS module with course selection
fix: resolve session timeout issue
docs: update README with installation steps
```

❌ Bad:
```
update
fixed bug
changes
```

## Verifikasi Commits

Cek jumlah commits:
```bash
git log --oneline | wc -l
```

Lihat history:
```bash
git log --oneline --graph --all
```

## Catatan Penting

1. **Commit secara bertahap** - Jangan commit semua file sekaligus
2. **Commit message yang jelas** - Jelaskan apa yang diubah
3. **Minimal 25 commits** - Target: 30-35 commits untuk nilai maksimal
4. **Commit setiap fitur** - Setiap fitur baru = 1 commit
5. **Push reguler** - Push setiap 5-10 commits

## Timeline Rekomendasi

- **Minggu 1**: Commits 1-12 (Setup & Mahasiswa Module)
- **Minggu 2**: Commits 13-25 (Dosen & Admin Module)
- **Minggu 3**: Commits 26-35+ (Additional Features & Polish)
