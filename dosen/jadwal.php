<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Kelas.php';

requireRole('dosen');

$pageTitle = 'Jadwal Mengajar';
$user = getCurrentUser();

$kelasModel = new Kelas();

// Get kelas yang diampu
$kelasFilter = ['dosen_id' => $user['id'], 'aktif' => 1];
$kelasList = $kelasModel->getKelasWithDetails($kelasFilter);

// Group by hari
$jadwalPerHari = [
    'Senin' => [],
    'Selasa' => [],
    'Rabu' => [],
    'Kamis' => [],
    'Jumat' => [],
    'Sabtu' => []
];

foreach ($kelasList as $kelas) {
    $jadwalPerHari[$kelas['hari']][] = $kelas;
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-dosen.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal Mengajar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dosen/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Jadwal Mengajar</li>
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
                        <i class="fas fa-calendar-week"></i> Jadwal Mengajar Per Hari
                    </h3>
                </div>
                <div class="card-body">
                    
                    <?php foreach ($jadwalPerHari as $hari => $kelasHari): ?>
                        <div class="card mb-3">
                            <div class="card-header bg-primary">
                                <h5 class="mb-0">
                                    <i class="fas fa-calendar-day"></i> <?php echo $hari; ?>
                                    <span class="badge badge-light float-right"><?php echo count($kelasHari); ?> Kelas</span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($kelasHari)): ?>
                                    <p class="text-muted mb-0">Tidak ada jadwal mengajar</p>
                                <?php else: ?>
                                    <table class="table table-bordered table-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th>Waktu</th>
                                                <th>Mata Kuliah</th>
                                                <th>Kelas</th>
                                                <th>Ruangan</th>
                                                <th>SKS</th>
                                                <th>Mahasiswa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($kelasHari as $kls): ?>
                                                <tr>
                                                    <td>
                                                        <strong><?php echo substr($kls['jam_mulai'], 0, 5); ?> - <?php echo substr($kls['jam_selesai'], 0, 5); ?></strong>
                                                    </td>
                                                    <td>
                                                        <strong><?php echo $kls['kode_matkul']; ?></strong><br>
                                                        <?php echo $kls['nama_matkul']; ?>
                                                    </td>
                                                    <td><span class="badge badge-info"><?php echo $kls['kode_kelas']; ?></span></td>
                                                    <td><?php echo $kls['ruangan']; ?></td>
                                                    <td><span class="badge badge-success"><?php echo $kls['sks']; ?> SKS</span></td>
                                                    <td><span class="badge badge-primary"><?php echo $kls['jumlah_mahasiswa']; ?> Mhs</span></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>

        </div>
    </section>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
