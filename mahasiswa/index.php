<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/KRS.php';
require_once __DIR__ . '/../models/Nilai.php';

requireRole('mahasiswa');

$pageTitle = 'Dashboard Mahasiswa';
$user = getCurrentUser();

// Get data untuk dashboard
$krsModel = new KRS();
$nilaiModel = new Nilai();

$tahunAjaranAktif = '2026/2027';
$semesterAktif = 'ganjil';

$krsAktif = $krsModel->getKRSMahasiswa($user['id'], $tahunAjaranAktif, $semesterAktif);
$totalSKS = $krsModel->getTotalSKS($user['id'], $tahunAjaranAktif, $semesterAktif);
$ipk = $nilaiModel->hitungIPK($user['id']);

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-mahasiswa.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
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
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo count($krsAktif); ?></h3>
                            <p>Mata Kuliah Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="krs.php" class="small-box-footer">
                            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $totalSKS; ?></h3>
                            <p>Total SKS Semester Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <a href="krs.php" class="small-box-footer">
                            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo number_format($ipk, 2); ?></h3>
                            <p>IPK</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <a href="nilai.php" class="small-box-footer">
                            Lihat Transkrip <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $_SESSION['semester_aktif'] ?? 3; ?></h3>
                            <p>Semester Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <a href="profile.php" class="small-box-footer">
                            Profil Saya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Jadwal Hari Ini -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-calendar-day mr-1"></i>
                                Jadwal Hari Ini
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $hariIni = date('l');
                            $hariIndo = [
                                'Monday' => 'Senin',
                                'Tuesday' => 'Selasa',
                                'Wednesday' => 'Rabu',
                                'Thursday' => 'Kamis',
                                'Friday' => 'Jumat',
                                'Saturday' => 'Sabtu',
                                'Sunday' => 'Minggu'
                            ];
                            
                            $jadwalHariIni = array_filter($krsAktif, function($krs) use ($hariIndo, $hariIni) {
                                return $krs['hari'] == $hariIndo[$hariIni];
                            });
                            
                            if (count($jadwalHariIni) > 0):
                            ?>
                                <div class="list-group">
                                    <?php foreach ($jadwalHariIni as $jadwal): ?>
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"><?php echo $jadwal['nama_matkul']; ?></h5>
                                                <small><?php echo substr($jadwal['jam_mulai'], 0, 5) . ' - ' . substr($jadwal['jam_selesai'], 0, 5); ?></small>
                                            </div>
                                            <p class="mb-1">
                                                <i class="fas fa-chalkboard-teacher"></i> <?php echo $jadwal['nama_dosen']; ?>
                                            </p>
                                            <small>
                                                <i class="fas fa-door-open"></i> <?php echo $jadwal['ruangan']; ?>
                                            </small>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-center text-muted">
                                    <i class="fas fa-info-circle"></i> Tidak ada jadwal kuliah hari ini
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- KRS Semester Ini -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list mr-1"></i>
                                KRS Semester Ini
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($krsAktif) > 0): ?>
                                        <?php foreach ($krsAktif as $krs): ?>
                                            <tr>
                                                <td><?php echo $krs['kode_matkul']; ?></td>
                                                <td><?php echo $krs['nama_matkul']; ?></td>
                                                <td><?php echo $krs['sks']; ?></td>
                                                <td><?php echo $krs['kode_kelas']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada KRS</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="krs.php" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Kelola KRS
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php
include __DIR__ . '/../includes/footer.php';
?>
