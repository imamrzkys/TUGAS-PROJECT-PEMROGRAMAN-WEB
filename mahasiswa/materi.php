<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/KRS.php';

requireRole('mahasiswa');

$pageTitle = 'Materi Kuliah';
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
                    <h1 class="m-0">Materi Kuliah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/mahasiswa/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Materi Kuliah</li>
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
                        <i class="fas fa-book"></i> Materi Perkuliahan Semester <?php echo ucfirst($semesterAktif); ?> <?php echo $tahunAjaranAktif; ?>
                    </h3>
                </div>
                <div class="card-body">
                    
                    <?php if (empty($krsList)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Anda belum mengambil mata kuliah apapun
                        </div>
                    <?php else: ?>
                        
                        <?php foreach ($krsList as $krs): ?>
                            <div class="card card-outline card-info mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-book-open"></i> <strong><?php echo $krs['kode_matkul']; ?> - <?php echo $krs['nama_matkul']; ?></strong>
                                    </h5>
                                    <div class="card-tools">
                                        <span class="badge badge-primary"><?php echo $krs['sks']; ?> SKS</span>
                                        <span class="badge badge-success"><?php echo $krs['nama_dosen']; ?></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="timeline">
                                        <!-- Pertemuan 1 -->
                                        <div class="time-label">
                                            <span class="bg-info">Pertemuan 1</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-file-pdf bg-danger"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> 07 Sep 2026</span>
                                                <h3 class="timeline-header">Pengenalan Mata Kuliah</h3>
                                                <div class="timeline-body">
                                                    Materi perkenalan dan silabus mata kuliah
                                                </div>
                                                <div class="timeline-footer">
                                                    <button class="btn btn-primary btn-sm" disabled>
                                                        <i class="fas fa-download"></i> Download (PDF, 2.5 MB)
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Pertemuan 2 -->
                                        <div class="time-label">
                                            <span class="bg-info">Pertemuan 2</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-file-powerpoint bg-warning"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> 14 Sep 2026</span>
                                                <h3 class="timeline-header">Konsep Dasar</h3>
                                                <div class="timeline-body">
                                                    Penjelasan konsep dasar dan teori fundamental
                                                </div>
                                                <div class="timeline-footer">
                                                    <button class="btn btn-warning btn-sm" disabled>
                                                        <i class="fas fa-download"></i> Download (PPTX, 5.1 MB)
                                                    </button>
                                                    <button class="btn btn-secondary btn-sm" disabled>
                                                        <i class="fas fa-video"></i> Video Rekaman
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- End timeline -->
                                        <div>
                                            <i class="fas fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle"></i> Materi akan terus diperbarui setiap pertemuan
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
