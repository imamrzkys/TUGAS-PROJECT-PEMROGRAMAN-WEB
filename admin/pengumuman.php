<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Pengumuman.php';

requireRole('admin');

$pageTitle = 'Data Pengumuman';
$user = getCurrentUser();

$pengumumanModel = new Pengumuman();
$pengumumanList = $pengumumanModel->getAllPengumuman();

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-admin.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengumuman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengumuman</li>
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
                        <i class="fas fa-bullhorn"></i> Daftar Pengumuman
                    </h3>
                </div>
                <div class="card-body">
                    <?php if (empty($pengumumanList)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Belum ada pengumuman
                        </div>
                    <?php else: ?>
                        <?php foreach ($pengumumanList as $pengumuman): ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-bullhorn text-danger"></i>
                                        <?php echo htmlspecialchars($pengumuman['judul']); ?>
                                        <?php if ($pengumuman['dipublikasi']): ?>
                                            <span class="badge badge-success float-right">Published</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary float-right">Draft</span>
                                        <?php endif; ?>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p><?php echo nl2br(htmlspecialchars($pengumuman['konten'])); ?></p>
                                    <hr>
                                    <small class="text-muted">
                                        <i class="fas fa-tag"></i> <?php echo ucfirst($pengumuman['kategori']); ?> |
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
