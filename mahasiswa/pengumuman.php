<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Pengumuman.php';

requireRole('mahasiswa');

$pageTitle = 'Pengumuman';
$user = getCurrentUser();

$pengumumanModel = new Pengumuman();
$pengumumanList = $pengumumanModel->getPublishedPengumuman();

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-mahasiswa.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengumuman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengumuman</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <?php if (count($pengumumanList) > 0): ?>
                <?php foreach ($pengumumanList as $pengumuman): ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bullhorn"></i> <?php echo $pengumuman['judul']; ?>
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-info"><?php echo ucfirst($pengumuman['kategori']); ?></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php echo nl2br($pengumuman['konten']); ?>
                        </div>
                        <div class="card-footer text-muted">
                            <small>
                                <i class="fas fa-user"></i> <?php echo $pengumuman['author_name'] ?? 'Admin'; ?> | 
                                <i class="fas fa-calendar"></i> <?php echo formatTanggalIndo($pengumuman['dibuat_pada']); ?>
                            </small>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="card">
                    <div class="card-body">
                        <p class="text-center text-muted">
                            <i class="fas fa-info-circle"></i> Belum ada pengumuman
                        </p>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
