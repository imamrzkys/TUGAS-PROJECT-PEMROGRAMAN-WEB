<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Kelas.php';

requireRole('dosen');

$pageTitle = 'Dashboard Dosen';
$user = getCurrentUser();

$kelasModel = new Kelas();

$tahunAjaranAktif = '2026/2027';
$semesterAktif = 'ganjil';

// Get kelas yang diajar
$kelasFilter = [
    'dosen_id' => $user['id'],
    'tahun_ajaran' => $tahunAjaranAktif,
    'semester' => $semesterAktif,
    'aktif' => 1
];
$kelasDiajar = $kelasModel->getKelasWithDetails($kelasFilter);

// Hitung statistik
$totalKelas = count($kelasDiajar);
$totalMahasiswa = array_sum(array_column($kelasDiajar, 'jumlah_mahasiswa'));

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-dosen.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-muted mb-0" style="font-size: 13px;"><i class="fas fa-home"></i> Beranda</p>
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

            <!-- Profile Card -->
            <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                        <div class="card-body" style="padding: 30px;">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['nama_lengkap']); ?>&background=0066FF&color=fff&bold=true&size=200" 
                                         alt="Profile" 
                                         style="width: 80px; height: 80px; border-radius: 12px; border: 3px solid #0066FF;">
                                </div>
                                <div class="col-md-7">
                                    <h3 style="margin: 0; font-size: 24px; font-weight: 700; color: var(--text-primary);">
                                        <?php echo $user['nama_lengkap']; ?>
                                        <span class="badge badge-success ml-2" style="font-size: 11px; vertical-align: middle;">DOSEN AKTIF</span>
                                    </h3>
                                    <p style="margin: 5px 0; color: var(--text-secondary);">
                                        <strong>NIP: <?php echo $user['nim']; ?></strong> | Dosen Tetap • Fakultas Teknik Informatika
                                    </p>
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col-auto">
                                                <small class="text-muted">Kelas Diampu</small>
                                                <div style="font-size: 24px; font-weight: 700; color: var(--primary-blue);"><?php echo $totalKelas; ?></div>
                                            </div>
                                            <div class="col-auto border-left">
                                                <small class="text-muted">Total Mahasiswa</small>
                                                <div style="font-size: 24px; font-weight: 700; color: var(--primary-green);"><?php echo $totalMahasiswa; ?></div>
                                            </div>
                                            <div class="col-auto border-left">
                                                <small class="text-muted">Tahun Mengajar</small>
                                                <div style="font-size: 24px; font-weight: 700; color: var(--primary-orange);">5+</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-right">
                                    <div style="margin-bottom: 15px;">
                                        <button class="btn btn-sm" style="background: rgba(0, 102, 255, 0.1); color: var(--primary-blue); border: none; padding: 8px 16px; border-radius: 8px; font-weight: 600;" onclick="window.location.href='../change-password.php'">
                                            <i class="fas fa-user-edit"></i> Edit Profil
                                        </button>
                                    </div>
                                    <div style="font-size: 11px; color: var(--text-muted);">
                                        Semester <?php echo ucfirst($semesterAktif); ?> • <?php echo $tahunAjaranAktif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card" style="border: none; border-radius: 16px; background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%); color: white; box-shadow: 0 4px 16px rgba(0, 102, 255, 0.3);">
                        <div class="card-body" style="padding: 25px;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div>
                                    <i class="fas fa-chalkboard-teacher" style="font-size: 20px; opacity: 0.8;"></i>
                                    <div style="font-size: 13px; margin-top: 10px; margin-bottom: 5px; opacity: 0.9;">Jadwal Mengajar Hari Ini</div>
                                    <div style="font-size: 11px; opacity: 0.8; margin-bottom: 15px;">Anda memiliki <?php echo min(2, $totalKelas); ?> sesi perkuliahan yang dijadwalkan untuk hari ini.</div>
                                    <button class="btn btn-light btn-sm" style="color: #0066FF; font-weight: 600;" onclick="window.location.href='jadwal.php'">
                                        Lihat Jadwal Lengkap
                                    </button>
                                </div>
                                <span class="badge badge-light" style="color: #0066FF; font-weight: 700;"><?php echo min(2, $totalKelas); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Buttons -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                        <div class="card-body" style="padding: 25px;">
                            <h5 style="font-weight: 700; margin-bottom: 20px; color: var(--text-primary);">
                                <i class="fas fa-bolt" style="color: var(--primary-orange);"></i> Aksi Cepat
                            </h5>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="nilai.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 25px; background: linear-gradient(135deg, rgba(0, 102, 255, 0.1) 0%, rgba(0, 102, 255, 0.05) 100%); border-radius: 12px; transition: all 0.3s; border: 2px solid transparent;" onmouseover="this.style.borderColor='var(--primary-blue)'" onmouseout="this.style.borderColor='transparent'">
                                            <i class="fas fa-star" style="font-size: 32px; color: var(--primary-blue); margin-bottom: 12px;"></i>
                                            <div style="font-size: 14px; font-weight: 600; color: var(--text-primary); margin-bottom: 5px;">Input Nilai</div>
                                            <div style="font-size: 11px; color: var(--text-muted);">Kelola nilai mahasiswa</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="presensi.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 25px; background: linear-gradient(135deg, rgba(6, 214, 160, 0.1) 0%, rgba(6, 214, 160, 0.05) 100%); border-radius: 12px; transition: all 0.3s; border: 2px solid transparent;" onmouseover="this.style.borderColor='var(--primary-green)'" onmouseout="this.style.borderColor='transparent'">
                                            <i class="fas fa-check-circle" style="font-size: 32px; color: var(--primary-green); margin-bottom: 12px;"></i>
                                            <div style="font-size: 14px; font-weight: 600; color: var(--text-primary); margin-bottom: 5px;">Presensi</div>
                                            <div style="font-size: 11px; color: var(--text-muted);">Rekap kehadiran</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="materi.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 25px; background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%); border-radius: 12px; transition: all 0.3s; border: 2px solid transparent;" onmouseover="this.style.borderColor='var(--primary-orange)'" onmouseout="this.style.borderColor='transparent'">
                                            <i class="fas fa-book" style="font-size: 32px; color: var(--primary-orange); margin-bottom: 12px;"></i>
                                            <div style="font-size: 14px; font-weight: 600; color: var(--text-primary); margin-bottom: 5px;">Materi Kuliah</div>
                                            <div style="font-size: 11px; color: var(--text-muted);">Upload & kelola materi</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="tugas.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 25px; background: linear-gradient(135deg, rgba(230, 57, 70, 0.1) 0%, rgba(230, 57, 70, 0.05) 100%); border-radius: 12px; transition: all 0.3s; border: 2px solid transparent;" onmouseover="this.style.borderColor='var(--primary-red)'" onmouseout="this.style.borderColor='transparent'">
                                            <i class="fas fa-tasks" style="font-size: 32px; color: var(--primary-red); margin-bottom: 12px;"></i>
                                            <div style="font-size: 14px; font-weight: 600; color: var(--text-primary); margin-bottom: 5px;">Tugas</div>
                                            <div style="font-size: 11px; color: var(--text-muted);">Kelola tugas mahasiswa</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kelas yang Diampu -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                <div class="card-header" style="background: white; border-bottom: 2px solid var(--border-color); padding: 20px 25px;">
                    <h5 style="font-weight: 700; margin: 0; color: var(--text-primary);">
                        <i class="fas fa-chalkboard-teacher" style="color: var(--primary-blue);"></i> Kelas yang Diampu
                    </h5>
                    <p style="font-size: 12px; color: var(--text-muted); margin: 5px 0 0 0;">Daftar mata kuliah yang Anda ampu pada semester ini</p>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0;">
                            <thead style="background: rgba(0, 102, 255, 0.05);">
                                <tr>
                                    <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">KODE MK</th>
                                    <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">MATA KULIAH</th>
                                    <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">KELAS</th>
                                    <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">JADWAL</th>
                                    <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">RUANGAN</th>
                                    <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">JUMLAH MHS</th>
                                    <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none; text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($kelasDiajar) > 0): ?>
                                    <?php foreach ($kelasDiajar as $index => $kelas): ?>
                                        <tr style="transition: all 0.2s; <?php echo $index % 2 == 0 ? 'background: #fff;' : 'background: rgba(0,0,0,0.01);'; ?>">
                                            <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                <span style="font-weight: 700; color: var(--primary-blue); font-size: 13px;"><?php echo $kelas['kode_matkul']; ?></span>
                                            </td>
                                            <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                <div style="font-weight: 600; font-size: 14px; color: var(--text-primary); margin-bottom: 2px;"><?php echo $kelas['nama_matkul']; ?></div>
                                                <div style="font-size: 11px; color: var(--text-muted);"><?php echo $kelas['sks']; ?> SKS</div>
                                            </td>
                                            <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                <span class="badge badge-primary" style="padding: 6px 12px; font-size: 12px; font-weight: 600;"><?php echo $kelas['kode_kelas']; ?></span>
                                            </td>
                                            <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                <div style="font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 2px;">
                                                    <i class="far fa-calendar" style="color: var(--primary-green); margin-right: 4px;"></i>
                                                    <?php echo $kelas['hari']; ?>
                                                </div>
                                                <div style="font-size: 11px; color: var(--text-muted);">
                                                    <i class="far fa-clock" style="margin-right: 4px;"></i>
                                                    <?php echo substr($kelas['jam_mulai'], 0, 5); ?>-<?php echo substr($kelas['jam_selesai'], 0, 5); ?>
                                                </div>
                                            </td>
                                            <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                <span style="font-size: 13px; color: var(--text-secondary);">
                                                    <i class="fas fa-door-open" style="color: var(--primary-orange); margin-right: 4px;"></i>
                                                    <?php echo $kelas['ruangan']; ?>
                                                </span>
                                            </td>
                                            <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                <span class="badge badge-success" style="padding: 8px 12px; font-size: 12px; font-weight: 600; border-radius: 8px;">
                                                    <i class="fas fa-users" style="margin-right: 4px;"></i>
                                                    <?php echo $kelas['jumlah_mahasiswa']; ?> Mhs
                                                </span>
                                            </td>
                                            <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle; text-align: center;">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="nilai.php?kelas_id=<?php echo $kelas['id']; ?>" 
                                                       class="btn btn-primary" 
                                                       title="Input Nilai"
                                                       style="padding: 8px 12px; border-radius: 8px 0 0 8px;">
                                                        <i class="fas fa-star"></i>
                                                    </a>
                                                    <a href="presensi.php?kelas_id=<?php echo $kelas['id']; ?>" 
                                                       class="btn btn-success" 
                                                       title="Presensi"
                                                       style="padding: 8px 12px; border-radius: 0 8px 8px 0;">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center" style="padding: 60px 20px; border-top: 1px solid var(--border-color);">
                                            <i class="fas fa-inbox" style="font-size: 64px; opacity: 0.2; color: var(--text-muted); margin-bottom: 20px;"></i>
                                            <p style="font-size: 16px; color: var(--text-muted); margin: 0;">Belum ada kelas yang diampu untuk semester ini</p>
                                            <p style="font-size: 12px; color: var(--text-muted); margin-top: 5px;">Silakan hubungi admin untuk penugasan kelas</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
