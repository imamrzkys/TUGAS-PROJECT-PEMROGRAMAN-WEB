<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Kelas.php';
require_once __DIR__ . '/../models/KRS.php';

requireRole('dosen');

$pageTitle = 'Kelas Saya';
$user = getCurrentUser();

$kelasModel = new Kelas();
$krsModel = new KRS();

// Get semua kelas yang diampu
$kelasFilter = ['dosen_id' => $user['id']];
$kelasList = $kelasModel->getKelasWithDetails($kelasFilter);

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-dosen.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelas Saya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dosen/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kelas Saya</li>
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
                        <i class="fas fa-chalkboard"></i> Daftar Kelas yang Diampu
                    </h3>
                </div>
                <div class="card-body">
                    
                    <?php if (empty($kelasList)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Anda belum mengampu kelas apapun
                        </div>
                    <?php else: ?>
                        
                        <div class="row">
                            <?php foreach ($kelasList as $kelas): ?>
                                <?php
                                // Get mahasiswa di kelas ini
                                $mahasiswaList = $krsModel->getMahasiswaByKelas($kelas['id']);
                                ?>
                                <div class="col-md-6">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                <strong><?php echo $kelas['kode_matkul']; ?> - <?php echo $kelas['kode_kelas']; ?></strong>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <h6><?php echo $kelas['nama_matkul']; ?></h6>
                                            <hr>
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td width="120"><i class="fas fa-book"></i> SKS</td>
                                                    <td><strong><?php echo $kelas['sks']; ?> SKS</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-calendar"></i> Jadwal</td>
                                                    <td><strong><?php echo $kelas['hari']; ?>, <?php echo substr($kelas['jam_mulai'], 0, 5); ?> - <?php echo substr($kelas['jam_selesai'], 0, 5); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-door-open"></i> Ruangan</td>
                                                    <td><strong><?php echo $kelas['ruangan']; ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-users"></i> Mahasiswa</td>
                                                    <td>
                                                        <span class="badge badge-info"><?php echo $kelas['jumlah_mahasiswa']; ?> / <?php echo $kelas['kuota']; ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-calendar-alt"></i> Tahun Ajaran</td>
                                                    <td><strong><?php echo $kelas['tahun_ajaran']; ?> (<?php echo ucfirst($kelas['semester']); ?>)</strong></td>
                                                </tr>
                                            </table>
                                            
                                            <hr>
                                            
                                            <div class="btn-group btn-block">
                                                <a href="/dosen/nilai.php?kelas_id=<?php echo $kelas['id']; ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-star"></i> Input Nilai
                                                </a>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#mahasiswa-<?php echo $kelas['id']; ?>">
                                                    <i class="fas fa-users"></i> Lihat Mahasiswa
                                                </button>
                                            </div>
                                            
                                            <div id="mahasiswa-<?php echo $kelas['id']; ?>" class="collapse mt-3">
                                                <h6>Daftar Mahasiswa:</h6>
                                                <ul class="list-group list-group-sm">
                                                    <?php foreach ($mahasiswaList as $mhs): ?>
                                                        <li class="list-group-item">
                                                            <strong><?php echo $mhs['nim']; ?></strong> - <?php echo $mhs['nama_lengkap']; ?>
                                                            <br><small class="text-muted"><?php echo $mhs['program_studi']; ?></small>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                    <?php endif; ?>
                    
                </div>
            </div>

        </div>
    </section>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
