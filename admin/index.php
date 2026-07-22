<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Kelas.php';
require_once __DIR__ . '/../models/KRS.php';

requireRole('admin');

$pageTitle = 'Dashboard Admin';
$user = getCurrentUser();

$userModel = new User();
$kelasModel = new Kelas();
$krsModel = new KRS();

// Get statistik
$totalMahasiswa = $userModel->count(['role' => 'mahasiswa', 'is_active' => 1]);
$totalDosen = $userModel->count(['role' => 'dosen', 'is_active' => 1]);
$totalKelas = $kelasModel->count(['is_active' => 1]);

$db = getDB();
$stmt = $db->query("SELECT COUNT(*) as total FROM krs WHERE status = 'aktif'");
$totalKRS = $stmt->fetch()['total'];

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-admin.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Admin</h1>
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
                            <h3><?php echo $totalMahasiswa; ?></h3>
                            <p>Total Mahasiswa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <a href="mahasiswa.php" class="small-box-footer">
                            Kelola <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $totalDosen; ?></h3>
                            <p>Total Dosen</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <a href="dosen.php" class="small-box-footer">
                            Kelola <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $totalKelas; ?></h3>
                            <p>Total Kelas Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <a href="kelas.php" class="small-box-footer">
                            Kelola <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $totalKRS; ?></h3>
                            <p>Total KRS Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <a href="krs.php" class="small-box-footer">
                            Lihat <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bolt"></i> Quick Actions
                            </h3>
                        </div>
                        <div class="card-body">
                            <a href="mahasiswa.php" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> Tambah Mahasiswa
                            </a>
                            <a href="dosen.php" class="btn btn-success">
                                <i class="fas fa-user-plus"></i> Tambah Dosen
                            </a>
                            <a href="matakuliah.php" class="btn btn-info">
                                <i class="fas fa-book-medical"></i> Tambah Mata Kuliah
                            </a>
                            <a href="kelas.php" class="btn btn-warning">
                                <i class="fas fa-plus-circle"></i> Buat Kelas
                            </a>
                            <a href="pengumuman.php" class="btn btn-danger">
                                <i class="fas fa-bullhorn"></i> Buat Pengumuman
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts/Statistics bisa ditambahkan di sini -->
            
        </div>
    </section>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
