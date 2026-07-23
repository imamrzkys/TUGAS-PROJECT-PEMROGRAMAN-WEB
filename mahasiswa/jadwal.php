<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/KRS.php';

requireRole('mahasiswa');

$pageTitle = 'Jadwal Kuliah';
$user = getCurrentUser();

$krsModel = new KRS();
$tahunAjaranAktif = '2026/2027';
$semesterAktif = 'ganjil';
$jadwal = $krsModel->getKRSMahasiswa($user['id'], $tahunAjaranAktif, $semesterAktif);

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-mahasiswa.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal Kuliah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Jadwal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Jadwal Kuliah Semester Ini</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Ruangan</th>
                                <th>Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jadwal as $j): ?>
                                <tr>
                                    <td><?php echo $j['kode_matkul']; ?></td>
                                    <td><?php echo $j['nama_matkul']; ?></td>
                                    <td><?php echo $j['hari']; ?></td>
                                    <td><?php echo substr($j['jam_mulai'], 0, 5) . ' - ' . substr($j['jam_selesai'], 0, 5); ?></td>
                                    <td><?php echo $j['ruangan']; ?></td>
                                    <td><?php echo $j['nama_dosen']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
