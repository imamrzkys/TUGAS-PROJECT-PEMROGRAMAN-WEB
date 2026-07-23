<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Kelas.php';
require_once __DIR__ . '/../models/KRS.php';

requireRole('admin');

$pageTitle = 'Admin Dashboard';
$user = getCurrentUser();

$userModel = new User();
$kelasModel = new Kelas();
$krsModel = new KRS();

// Get statistik
$totalMahasiswa = $userModel->count(['peran' => 'mahasiswa', 'aktif' => 1]);
$totalDosen = $userModel->count(['peran' => 'dosen', 'aktif' => 1]);
$totalKelas = $kelasModel->count(['aktif' => 1]);

$db = getDB();
$stmt = $db->query("SELECT COUNT(*) as total FROM krs WHERE status = 'aktif'");
$totalKRS = $stmt->fetch()['total'];

// Get total mata kuliah
$stmt2 = $db->query("SELECT COUNT(*) as total FROM mata_kuliah WHERE aktif = 1");
$totalMatkul = $stmt2->fetch()['total'];

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-admin.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="text-muted mb-0" style="font-size: 14px;">Selamat datang kembali, berikut ringkasan aktivitas SIAKAD hari ini.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <?php if ($success = getFlash('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="icon fas fa-check"></i> <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <!-- Modern Stat Cards -->
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card stat-blue" style="cursor: pointer;" onclick="window.location.href='/admin/mahasiswa.php'">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-label">TOTAL MAHASISWA</div>
                        <div class="stat-value"><?php echo number_format($totalMahasiswa); ?></div>
                        <div class="stat-change stat-up">
                            <i class="fas fa-arrow-up"></i> +12%
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card stat-green" style="cursor: pointer;" onclick="window.location.href='/admin/dosen.php'">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-label">DOSEN PENGAJAR</div>
                        <div class="stat-value"><?php echo number_format($totalDosen); ?></div>
                        <div class="stat-change stat-up">
                            <i class="fas fa-arrow-up"></i> +3%
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card stat-orange" style="cursor: pointer;" onclick="window.location.href='/admin/matakuliah.php'">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-label">MATA KULIAH</div>
                        <div class="stat-value"><?php echo number_format($totalMatkul); ?></div>
                        <span class="badge badge-warning mt-2"><i class="fas fa-circle"></i> Aktif</span>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card stat-red" style="cursor: pointer;" onclick="window.location.href='/admin/kelas.php'">
                        <div class="stat-icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div class="stat-label">KELAS AKTIF</div>
                        <div class="stat-value"><?php echo number_format($totalKelas); ?></div>
                        <span class="badge badge-danger mt-2"><?php echo $totalKelas; ?> Kelas</span>
                    </div>
                </div>
            </div>

            <!-- Student Enrollment Trends & Quick Actions -->
            <div class="row">
                <!-- Chart Section -->
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line"></i> Tren Pendaftaran Mahasiswa
                            </h3>
                            <div class="card-tools">
                                <select class="form-control form-control-sm" style="width: auto; display: inline-block;">
                                    <option>6 Bulan Terakhir</option>
                                    <option>Tahun Terakhir</option>
                                    <option>Semua Waktu</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="height: 300px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, rgba(0, 102, 255, 0.05) 0%, rgba(0, 102, 255, 0.01) 100%); border-radius: 8px;">
                                <div class="text-center">
                                    <i class="fas fa-chart-bar" style="font-size: 48px; color: var(--primary-blue); opacity: 0.3; margin-bottom: 15px;"></i>
                                    <p class="text-muted">Visualisasi grafik akan ditampilkan di sini<br><small>Menampilkan tren pendaftaran mahasiswa dari waktu ke waktu</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bolt"></i> Aksi Cepat
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <a href="/admin/mahasiswa.php" style="text-decoration: none; color: inherit;">
                                        <div style="background: rgba(0, 102, 255, 0.1); padding: 20px; border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(0, 102, 255, 0.2)'" onmouseout="this.style.background='rgba(0, 102, 255, 0.1)'">
                                            <i class="fas fa-user-plus" style="font-size: 28px; color: var(--primary-blue);"></i>
                                            <p style="margin-top: 10px; margin-bottom: 0; font-size: 12px; font-weight: 600;">Modifikasi KRS</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <a href="/admin/pengumuman.php" style="text-decoration: none; color: inherit;">
                                        <div style="background: rgba(6, 214, 160, 0.1); padding: 20px; border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(6, 214, 160, 0.2)'" onmouseout="this.style.background='rgba(6, 214, 160, 0.1)'">
                                            <i class="fas fa-graduation-cap" style="font-size: 28px; color: var(--primary-green);"></i>
                                            <p style="margin-top: 10px; margin-bottom: 0; font-size: 12px; font-weight: 600;">Beasiswa</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <a href="/admin/kelas.php" style="text-decoration: none; color: inherit;">
                                        <div style="background: rgba(230, 57, 70, 0.1); padding: 20px; border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(230, 57, 70, 0.2)'" onmouseout="this.style.background='rgba(230, 57, 70, 0.1)'">
                                            <i class="fas fa-file-alt" style="font-size: 28px; color: var(--primary-red);"></i>
                                            <p style="margin-top: 10px; margin-bottom: 0; font-size: 12px; font-weight: 600;">Cetak<br>Transkrip</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <a href="/admin/pengumuman.php" style="text-decoration: none; color: inherit;">
                                        <div style="background: rgba(245, 158, 11, 0.1); padding: 20px; border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(245, 158, 11, 0.2)'" onmouseout="this.style.background='rgba(245, 158, 11, 0.1)'">
                                            <i class="fas fa-bullhorn" style="font-size: 28px; color: var(--primary-orange);"></i>
                                            <p style="margin-top: 10px; margin-bottom: 0; font-size: 12px; font-weight: 600;">Pengumuman</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Announcements Preview -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bullhorn"></i> Pengumuman
                            </h3>
                            <div class="card-tools">
                                <a href="/admin/pengumuman.php" style="font-size: 12px;">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="timeline-item" style="border-left: 2px solid var(--border-color); padding-left: 20px; margin: 15px;">
                                <div style="width: 10px; height: 10px; background: var(--primary-red); border-radius: 50%; position: absolute; left: 15px; border: 2px solid white;"></div>
                                <small class="text-muted">2 JAM LALU</small>
                                <p style="margin: 5px 0; font-weight: 600; font-size: 13px;">Pendaftaran Wisuda Dibuka</p>
                                <small class="text-muted">Batas waktu pendaftaran hingga Oktober...</small>
                            </div>
                            <div class="timeline-item" style="border-left: 2px solid var(--border-color); padding-left: 20px; margin: 15px;">
                                <div style="width: 10px; height: 10px; background: var(--primary-blue); border-radius: 50%; position: absolute; left: 15px; border: 2px solid white;"></div>
                                <small class="text-muted">KEMARIN</small>
                                <p style="margin: 5px 0; font-weight: 600; font-size: 13px;">Pemeliharaan Sistem</p>
                                <small class="text-muted">Portal akademik akan tidak dapat diakses...</small>
                            </div>
                            <div class="timeline-item" style="border-left: 2px solid var(--border-color); padding-left: 20px; margin: 15px;">
                                <div style="width: 10px; height: 10px; background: var(--primary-green); border-radius: 50%; position: absolute; left: 15px; border: 2px solid white;"></div>
                                <small class="text-muted">12 OKT 2026</small>
                                <p style="margin: 5px 0; font-weight: 600; font-size: 13px;">Beasiswa Baru Tersedia</p>
                                <small class="text-muted">Tersedia untuk fakultas...</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent User Activity -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-history"></i> Aktivitas Pengguna Terkini
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-warning"><i class="fas fa-circle"></i> Permintaan Tertunda</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>PENGGUNA</th>
                                        <th>AKTIVITAS</th>
                                        <th>WAKTU</th>
                                        <th>STATUS</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 35px; height: 35px; border-radius: 8px; background: var(--primary-blue); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">FA</div>
                                                <div>
                                                    <strong>Fahri Alamsyah</strong><br>
                                                    <small class="text-muted">Mahasiswa (20230810)</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Pengisian KRS</td>
                                        <td>Hari ini, 14:24</td>
                                        <td><span class="badge badge-primary">SELESAI</span></td>
                                        <td><button class="btn btn-sm btn-primary">Detail</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 35px; height: 35px; border-radius: 8px; background: var(--primary-green); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">LW</div>
                                                <div>
                                                    <strong>Laila Wahyuni</strong><br>
                                                    <small class="text-muted">Dosen (D-4210)</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Pengajuan Nilai</td>
                                        <td>Hari ini, 11:05</td>
                                        <td><span class="badge badge-warning">MENUNGGU</span></td>
                                        <td><button class="btn btn-sm btn-success">Tinjau</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 35px; height: 35px; border-radius: 8px; background: var(--primary-purple); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">BS</div>
                                                <div>
                                                    <strong>Budi Santoso</strong><br>
                                                    <small class="text-muted">Mahasiswa (20220112)</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Revisi KRS</td>
                                        <td>Kemarin, 16:45</td>
                                        <td><span class="badge badge-primary">SELESAI</span></td>
                                        <td><button class="btn btn-sm btn-primary">Detail</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 35px; height: 35px; border-radius: 8px; background: var(--primary-orange); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">ID</div>
                                                <div>
                                                    <strong>Indah Dwi</strong><br>
                                                    <small class="text-muted">Asisten Admin</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Pembaruan Konfigurasi Sistem</td>
                                        <td>Kemarin, 09:12</td>
                                        <td><span class="badge badge-primary">SELESAI</span></td>
                                        <td><button class="btn btn-sm btn-primary">Detail</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="p-3 text-center border-top">
                                <small class="text-muted">Menampilkan 4 dari 25 aktivitas</small>
                                <a href="#" class="ml-3"><i class="fas fa-arrow-right"></i></a>
                                <a href="#" class="ml-2"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Info -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="mb-0 text-muted" style="font-size: 13px;">
                                <i class="fas fa-server text-success"></i> Server: Jakarta-01 
                                <span class="mx-2">|</span>
                                <i class="fas fa-code-branch text-primary"></i> Versi 2.4.1-Stabil
                                <span class="mx-2">|</span>
                                © 2026 SIAKAD Modern - Sistem Informasi Akademik. Hak cipta dilindungi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
