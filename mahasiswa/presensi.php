<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/KRS.php';

requireRole('mahasiswa');

$pageTitle = 'Rekap Presensi';
$user = getCurrentUser();

$krsModel = new KRS();
$tahunAjaranAktif = '2026/2027';
$semesterAktif = 'ganjil';

// Get KRS mahasiswa
$krsList = $krsModel->getKRSMahasiswa($user['id'], $tahunAjaranAktif, $semesterAktif);

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-mahasiswa.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rekap Presensi Kuliah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/mahasiswa/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Presensi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-check-circle"></i> Rekap Kehadiran Semester <?php echo ucfirst($semesterAktif); ?> <?php echo $tahunAjaranAktif; ?>
                    </h3>
                </div>
                <div class="card-body">
                    
                    <?php if (empty($krsList)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Anda belum mengambil mata kuliah apapun
                        </div>
                    <?php else: ?>
                        
                        <?php foreach ($krsList as $krs): ?>
                            <div class="card mb-3">
                                <div class="card-header bg-primary">
                                    <h5 class="mb-0">
                                        <strong><?php echo $krs['kode_matkul']; ?> - <?php echo $krs['nama_matkul']; ?></strong>
                                        <span class="badge badge-light float-right"><?php echo $krs['sks']; ?> SKS</span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="info-box bg-success">
                                                <span class="info-box-icon"><i class="fas fa-check"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Hadir</span>
                                                    <span class="info-box-number">12 kali</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-box bg-info">
                                                <span class="info-box-icon"><i class="fas fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Izin</span>
                                                    <span class="info-box-number">1 kali</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-box bg-warning">
                                                <span class="info-box-icon"><i class="fas fa-medkit"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Sakit</span>
                                                    <span class="info-box-number">0 kali</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-box bg-danger">
                                                <span class="info-box-icon"><i class="fas fa-times"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Alpha</span>
                                                    <span class="info-box-number">0 kali</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 92%">92%</div>
                                    </div>
                                    <small class="text-muted">Persentase Kehadiran (12/13 pertemuan)</small>
                                    
                                    <hr>
                                    
                                    <p class="mb-2"><strong>Detail:</strong></p>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pertemuan</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>07 Sep 2026</td>
                                                <td><span class="badge badge-success">Hadir</span></td>
                                                <td>Tepat waktu</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>14 Sep 2026</td>
                                                <td><span class="badge badge-success">Hadir</span></td>
                                                <td>Tepat waktu</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>21 Sep 2026</td>
                                                <td><span class="badge badge-info">Izin</span></td>
                                                <td>Sakit (Ada surat)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                    <?php endif; ?>
                    
                </div>
            </div>

        </div>
    </section>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
