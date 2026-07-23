<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Pengumuman.php';

requireRole('dosen');

$pageTitle = 'Pengumuman';
$user = getCurrentUser();

$pengumumanModel = new Pengumuman();
$pengumumanList = $pengumumanModel->getPublishedPengumuman();

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-dosen.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengumuman Kampus</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dosen/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengumuman</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-12">
                    
                    <?php if (empty($pengumumanList)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Belum ada pengumuman saat ini
                        </div>
                    <?php else: ?>
                        <?php foreach ($pengumumanList as $pengumuman): ?>
                            <div class="card mb-3">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-bullhorn"></i> <?php echo htmlspecialchars($pengumuman['judul']); ?>
                                        <span class="badge badge-light text-dark float-right"><?php echo ucfirst($pengumuman['kategori']); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($pengumuman['konten'])); ?></p>
                                    <hr>
                                    <small class="text-muted">
                                        <i class="fas fa-user"></i> <?php echo $pengumuman['author_name'] ?? 'Admin'; ?> | 
                                        <i class="fas fa-calendar"></i> <?php echo formatTanggalIndo($pengumuman['dibuat_pada']); ?>
                                    </small>
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
