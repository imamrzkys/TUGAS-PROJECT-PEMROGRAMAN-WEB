<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/User.php';

requireRole('admin');

$pageTitle = 'Data Dosen';
$user = getCurrentUser();

$userModel = new User();
$dosenList = $userModel->getDosen();

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-admin.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Dosen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Dosen</li>
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
                        <i class="fas fa-chalkboard-teacher"></i> Daftar Dosen
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>NIM/NIDN</th>
                                <th>Nama Lengkap</th>
                                <th>Jurusan</th>
                                <th>Program Studi</th>
                                <th>Email</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($dosenList)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data dosen</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($dosenList as $dsn): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><strong><?php echo $dsn['nim']; ?></strong></td>
                                    <td><?php echo $dsn['nama_lengkap']; ?></td>
                                    <td><?php echo $dsn['jurusan'] ?? '-'; ?></td>
                                    <td><?php echo $dsn['program_studi'] ?? '-'; ?></td>
                                    <td><?php echo $dsn['email'] ?? '-'; ?></td>
                                    <td><?php echo $dsn['telepon'] ?? '-'; ?></td>
                                </tr>
                                <?php endforeach; ?>
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
