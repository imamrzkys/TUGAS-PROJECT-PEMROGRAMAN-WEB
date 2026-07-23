<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Kelas.php';

requireRole('admin');

$pageTitle = 'Data Kelas';
$user = getCurrentUser();

$kelasModel = new Kelas();
$kelasList = $kelasModel->getKelasWithDetails();

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-admin.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kelas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Kelas</li>
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
                        <i class="fas fa-school"></i> Daftar Kelas
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Kode Kelas</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Dosen</th>
                                <th>Jadwal</th>
                                <th>Ruangan</th>
                                <th>Kuota</th>
                                <th>Terisi</th>
                                <th>Tahun Ajaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($kelasList)): ?>
                                <tr>
                                    <td colspan="11" class="text-center">Tidak ada data kelas</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($kelasList as $kls): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><strong><?php echo $kls['kode_kelas']; ?></strong></td>
                                    <td>
                                        <strong><?php echo $kls['kode_matkul']; ?></strong><br>
                                        <?php echo $kls['nama_matkul']; ?>
                                    </td>
                                    <td><span class="badge badge-primary"><?php echo $kls['sks']; ?></span></td>
                                    <td><?php echo $kls['nama_dosen']; ?></td>
                                    <td>
                                        <?php echo $kls['hari']; ?><br>
                                        <small><?php echo substr($kls['jam_mulai'], 0, 5); ?> - <?php echo substr($kls['jam_selesai'], 0, 5); ?></small>
                                    </td>
                                    <td><?php echo $kls['ruangan']; ?></td>
                                    <td><?php echo $kls['kuota']; ?></td>
                                    <td>
                                        <span class="badge badge-info"><?php echo $kls['jumlah_mahasiswa']; ?></span>
                                    </td>
                                    <td>
                                        <?php echo $kls['tahun_ajaran']; ?><br>
                                        <small><?php echo ucfirst($kls['semester']); ?></small>
                                    </td>
                                    <td>
                                        <?php if ($kls['aktif']): ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
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
