<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/KRS.php';

requireRole('mahasiswa');

$pageTitle = 'Tugas Kuliah';
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
                    <h1 class="m-0">Tugas Kuliah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/mahasiswa/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tugas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <!-- Summary Cards -->
            <div class="row">
                <div class="col-md-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>3</h3>
                            <p>Tugas Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>1</h3>
                            <p>Belum Dikumpulkan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>2</h3>
                            <p>Sudah Dikumpulkan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>1</h3>
                            <p>Sudah Dinilai</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-tasks"></i> Daftar Tugas Semester <?php echo ucfirst($semesterAktif); ?> <?php echo $tahunAjaranAktif; ?>
                    </h3>
                </div>
                <div class="card-body">
                    
                    <?php if (empty($krsList)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Anda belum mengambil mata kuliah apapun
                        </div>
                    <?php else: ?>
                        
                        <?php foreach ($krsList as $krs): ?>
                            <div class="card card-outline card-warning mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-clipboard"></i> <strong><?php echo $krs['kode_matkul']; ?> - <?php echo $krs['nama_matkul']; ?></strong>
                                    </h5>
                                    <div class="card-tools">
                                        <span class="badge badge-primary"><?php echo $krs['sks']; ?> SKS</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                    <!-- Tugas 1 - Belum dikumpulkan -->
                                    <div class="callout callout-danger">
                                        <h5><i class="fas fa-exclamation-triangle"></i> Tugas 1: HTML & CSS Dasar</h5>
                                        <p><strong>Deadline:</strong> <span class="text-danger">15 Oktober 2026, 23:59 WIB</span></p>
                                        <p><strong>Deskripsi:</strong> Buat halaman web sederhana menggunakan HTML dan CSS</p>
                                        <p><strong>Status:</strong> <span class="badge badge-danger">Belum Dikumpulkan</span></p>
                                        <hr>
                                        <button class="btn btn-primary btn-sm" disabled>
                                            <i class="fas fa-upload"></i> Upload Tugas
                                        </button>
                                        <button class="btn btn-info btn-sm" disabled>
                                            <i class="fas fa-download"></i> Download Soal
                                        </button>
                                    </div>
                                    
                                    <!-- Tugas 2 - Sudah dikumpulkan -->
                                    <div class="callout callout-success">
                                        <h5><i class="fas fa-check-circle"></i> Tugas 2: JavaScript Interaktif</h5>
                                        <p><strong>Deadline:</strong> 01 November 2026, 23:59 WIB</p>
                                        <p><strong>Deskripsi:</strong> Buat aplikasi web interaktif menggunakan JavaScript</p>
                                        <p><strong>Status:</strong> <span class="badge badge-success">Sudah Dikumpulkan</span></p>
                                        <p><strong>Dikumpulkan pada:</strong> 28 Oktober 2026, 15:30 WIB</p>
                                        <p><strong>Nilai:</strong> <span class="badge badge-info">85/100</span></p>
                                        <p><strong>Feedback:</strong> Bagus! Kode bersih dan terstruktur dengan baik.</p>
                                        <hr>
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            <i class="fas fa-file"></i> Lihat Submission
                                        </button>
                                    </div>
                                    
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
