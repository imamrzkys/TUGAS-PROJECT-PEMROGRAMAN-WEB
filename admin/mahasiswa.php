<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/User.php';

requireRole('admin');

$pageTitle = 'Data Mahasiswa';
$user = getCurrentUser();

$userModel = new User();
$mahasiswaList = $userModel->getMahasiswa();

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-admin.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Mahasiswa</li>
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
                        <i class="fas fa-user-graduate"></i> Daftar Mahasiswa
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Jurusan</th>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th>Semester</th>
                                <th>Email</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($mahasiswaList)): ?>
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data mahasiswa</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($mahasiswaList as $mhs): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><strong><?php echo $mhs['nim']; ?></strong></td>
                                    <td><?php echo $mhs['nama_lengkap']; ?></td>
                                    <td><?php echo $mhs['jurusan'] ?? '-'; ?></td>
                                    <td><?php echo $mhs['program_studi'] ?? '-'; ?></td>
                                    <td><?php echo $mhs['angkatan'] ?? '-'; ?></td>
                                    <td>
                                        <span class="badge badge-info">
                                            <?php echo $mhs['semester_aktif'] ?? '-'; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $mhs['email'] ?? '-'; ?></td>
                                    <td><?php echo $mhs['telepon'] ?? '-'; ?></td>
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
