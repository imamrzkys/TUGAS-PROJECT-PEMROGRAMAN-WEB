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
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Dashboard Dosen</h1>
                    <p class="text-muted mb-0" style="font-size: 14px;">Selamat datang kembali, <?php echo isset($user['nama_lengkap']) ? $user['nama_lengkap'] : 'Dosen'; ?> (<?php echo isset($user['nim']) ? $user['nim'] : ''; ?>).</p>
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

            <!-- Modern Cards with Gradient -->
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="background: linear-gradient(135deg, #E63946 0%, #DC2626 100%); color: white; border: none; border-radius: 16px; box-shadow: 0 4px 12px rgba(230, 57, 70, 0.3);">
                        <div class="card-body" style="padding: 30px;">
                            <div style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">
                                <?php echo $totalKelas; ?>
                            </div>
                            <div style="font-size: 14px; font-weight: 600; margin-bottom: 20px;">
                                Kelas Diampu
                                <a href="kelas.php" class="btn btn-light btn-sm mt-2" style="color: #E63946; font-weight: 600; display: inline-flex; align-items: center; gap: 5px;">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="background: linear-gradient(135deg, #06D6A0 0%, #059669 100%); color: white; border: none; border-radius: 16px; box-shadow: 0 4px 12px rgba(6, 214, 160, 0.3);">
                        <div class="card-body" style="padding: 30px;">
                            <div style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">
                                <?php echo $totalMahasiswa; ?>
                            </div>
                            <div style="font-size: 14px; font-weight: 600; margin-bottom: 20px;">
                                Total Mahasiswa
                                <a href="kelas.php" class="btn btn-light btn-sm mt-2" style="color: #06D6A0; font-weight: 600; display: inline-flex; align-items: center; gap: 5px;">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); color: white; border: none; border-radius: 16px; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);">
                        <div class="card-body" style="padding: 30px;">
                            <div style="font-size: 32px; font-weight: 700; margin-bottom: 5px;">
                                <?php echo $tahunAjaranAktif; ?>
                            </div>
                            <div style="font-size: 14px; font-weight: 600; margin-bottom: 5px;">
                                Semester <?php echo ucfirst($semesterAktif); ?>
                            </div>
                            <span class="badge badge-light mt-2" style="font-size: 11px; color: #F59E0B; font-weight: 600;">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kelas yang Diampu -->
            <div class="card">
                <div class="card-header" style="background: white; border-bottom: 1px solid var(--border-color);">
                    <h3 class="card-title">
                        <i class="fas fa-chalkboard"></i> Kelas yang Diampu
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>KODE MK</th>
                                    <th>MATA KULIAH</th>
                                    <th>KELAS</th>
                                    <th>JADWAL</th>
                                    <th>RUANGAN</th>
                                    <th>JUMLAH MHS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($kelasDiajar) > 0): ?>
                                    <?php foreach ($kelasDiajar as $kelas): ?>
                                        <tr>
                                            <td><strong><?php echo $kelas['kode_matkul']; ?></strong></td>
                                            <td><?php echo $kelas['nama_matkul']; ?></td>
                                            <td><span class="badge badge-primary"><?php echo $kelas['kode_kelas']; ?></span></td>
                                            <td>
                                                <small>
                                                    <?php echo $kelas['hari']; ?>, 
                                                    <?php echo substr($kelas['jam_mulai'], 0, 5); ?>-<?php echo substr($kelas['jam_selesai'], 0, 5); ?>
                                                </small>
                                            </td>
                                            <td><?php echo $kelas['ruangan']; ?></td>
                                            <td>
                                                <span class="badge badge-success">
                                                    <?php echo $kelas['jumlah_mahasiswa']; ?> Mhs
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="nilai.php?kelas_id=<?php echo $kelas['id']; ?>" 
                                                       class="btn btn-primary" title="Input Nilai">
                                                        <i class="fas fa-star"></i>
                                                    </a>
                                                    <a href="presensi.php?kelas_id=<?php echo $kelas['id']; ?>" 
                                                       class="btn btn-success" title="Presensi">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-inbox fa-3x mb-3" style="opacity: 0.3;"></i>
                                            <p>Belum ada kelas yang diampu untuk semester ini.</p>
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
