<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Kelas.php';

requireRole('dosen');

$pageTitle = 'Materi Kuliah';
$user = getCurrentUser();

$kelasModel = new Kelas();

// Get kelas yang diampu
$kelasFilter = ['dosen_id' => $user['id'], 'aktif' => 1];
$kelasList = $kelasModel->getKelasWithDetails($kelasFilter);

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-dosen.php';
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
                        <li class="breadcrumb-item"><a href="/dosen/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Materi</li>
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
                        <i class="fas fa-book"></i> Manajemen Materi Kuliah
                    </h3>
                </div>
                <div class="card-body">
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Pilih kelas untuk mengelola materi perkuliahan
                    </div>
                    
                    <?php if (empty($kelasList)): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Anda belum mengampu kelas apapun
                        </div>
                    <?php else: ?>
                        
                        <div class="row">
                            <?php foreach ($kelasList as $kelas): ?>
                                <div class="col-md-4">
                                    <div class="card card-outline card-info">
                                        <div class="card-body">
                                            <h6><strong><?php echo $kelas['kode_matkul']; ?> - <?php echo $kelas['kode_kelas']; ?></strong></h6>
                                            <p class="mb-2"><?php echo $kelas['nama_matkul']; ?></p>
                                            <p class="mb-2 text-muted">
                                                <i class="fas fa-users"></i> <?php echo $kelas['jumlah_mahasiswa']; ?> Mahasiswa
                                            </p>
                                            <p class="mb-3">
                                                <span class="badge badge-primary"><?php echo $kelas['sks']; ?> SKS</span>
                                            </p>
                                            <button class="btn btn-info btn-block" disabled>
                                                <i class="fas fa-file-upload"></i> Upload Materi
                                            </button>
                                            <small class="text-muted d-block mt-2 text-center">Fitur dalam pengembangan</small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                    <?php endif; ?>
                    
                </div>
            </div>

        </div>
    </section>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
