<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Kelas.php';

requireRole('dosen');

$pageTitle = 'Dashboard Dosen';
$user = getCurrentUser();

$kelasModel = new Kelas();

$tahunAjaranAktif = '2023/2024';
$semesterAktif = 'ganjil';

// Get kelas yang diajar
$kelasFilter = [
    'dosen_id' => $user['id'],
    'tahun_ajaran' => $tahunAjaranAktif,
    'semester' => $semesterAktif,
    'is_active' => 1
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
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Dosen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
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

            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $totalKelas; ?></h3>
                            <p>Kelas Diampu</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <a href="kelas.php" class="small-box-footer">
                            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $totalMahasiswa; ?></h3>
                            <p>Total Mahasiswa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="kelas.php" class="small-box-footer">
                            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $tahunAjaranAktif; ?></h3>
                            <p>Semester <?php echo ucfirst($semesterAktif); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            &nbsp;
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kelas yang diampu -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list"></i> Kelas yang Diampu
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Jadwal</th>
                                <th>Ruangan</th>
                                <th>Jumlah Mhs</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($kelasDiajar) > 0): ?>
                                <?php foreach ($kelasDiajar as $kelas): ?>
                                    <tr>
                                        <td><?php echo $kelas['kode_matkul']; ?></td>
                                        <td><?php echo $kelas['nama_matkul']; ?></td>
                                        <td><?php echo $kelas['kode_kelas']; ?></td>
                                        <td><?php echo $kelas['hari'] . ', ' . substr($kelas['jam_mulai'], 0, 5) . '-' . substr($kelas['jam_selesai'], 0, 5); ?></td>
                                        <td><?php echo $kelas['ruangan']; ?></td>
                                        <td><?php echo $kelas['jumlah_mahasiswa']; ?></td>
                                        <td>
                                            <a href="nilai.php?kelas_id=<?php echo $kelas['id']; ?>" class="btn btn-primary btn-sm" title="Input Nilai">
                                                <i class="fas fa-star"></i>
                                            </a>
                                            <a href="presensi.php?kelas_id=<?php echo $kelas['id']; ?>" class="btn btn-success btn-sm" title="Presensi">
                                                <i class="fas fa-check-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada kelas yang diampu</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
