<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/MataKuliah.php';

requireRole('admin');

$pageTitle = 'Data Mata Kuliah';
$user = getCurrentUser();

$mataKuliahModel = new MataKuliah();
$mataKuliahList = $mataKuliahModel->findAll('semester', 'ASC');

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-admin.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Mata Kuliah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Mata Kuliah</li>
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
                        <i class="fas fa-book-open"></i> Daftar Mata Kuliah
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Kode</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Semester</th>
                                <th>Jenis</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($mataKuliahList)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data mata kuliah</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($mataKuliahList as $mk): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><strong><?php echo $mk['kode_matkul']; ?></strong></td>
                                    <td><?php echo $mk['nama_matkul']; ?></td>
                                    <td>
                                        <span class="badge badge-primary"><?php echo $mk['sks']; ?> SKS</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">Semester <?php echo $mk['semester']; ?></span>
                                    </td>
                                    <td>
                                        <?php if ($mk['jenis'] == 'wajib'): ?>
                                            <span class="badge badge-success">Wajib</span>
                                        <?php else: ?>
                                            <span class="badge badge-warning">Pilihan</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $mk['deskripsi'] ?? '-'; ?></td>
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
