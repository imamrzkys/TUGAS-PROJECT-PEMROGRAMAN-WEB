<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/KRS.php';
require_once __DIR__ . '/../models/Kelas.php';

requireRole('mahasiswa');

$pageTitle = 'Kartu Rencana Studi (KRS)';
$user = getCurrentUser();

$krsModel = new KRS();
$kelasModel = new Kelas();

$tahunAjaranAktif = '2023/2024';
$semesterAktif = 'ganjil';

// Handle tambah KRS
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'tambah') {
    $kelasId = sanitize($_POST['kelas_id']);
    $result = $krsModel->tambahKRS($user['id'], $kelasId, $tahunAjaranAktif, $semesterAktif);
    
    if ($result['success']) {
        setFlash('success', $result['message']);
    } else {
        setFlash('error', $result['message']);
    }
    redirect('/mahasiswa/krs.php');
}

// Handle hapus KRS
if (isset($_GET['hapus'])) {
    $krsId = sanitize($_GET['hapus']);
    $result = $krsModel->hapusKRS($krsId, $user['id']);
    
    if ($result['success']) {
        setFlash('success', $result['message']);
    } else {
        setFlash('error', $result['message']);
    }
    redirect('/mahasiswa/krs.php');
}

// Get KRS mahasiswa
$krsData = $krsModel->getKRSMahasiswa($user['id'], $tahunAjaranAktif, $semesterAktif);
$totalSKS = $krsModel->getTotalSKS($user['id'], $tahunAjaranAktif, $semesterAktif);

// Get kelas tersedia
$kelasFilter = [
    'tahun_ajaran' => $tahunAjaranAktif,
    'semester' => $semesterAktif,
    'is_active' => 1
];
$kelasTersedia = $kelasModel->getKelasWithDetails($kelasFilter);

// Filter kelas yang belum diambil
$krsKelasIds = array_column($krsData, 'kelas_id');
$kelasTersedia = array_filter($kelasTersedia, function($kelas) use ($krsKelasIds) {
    return !in_array($kelas['id'], $krsKelasIds) && $kelas['jumlah_mahasiswa'] < $kelas['kuota'];
});

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-mahasiswa.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kartu Rencana Studi (KRS)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">KRS</li>
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

            <?php if ($error = getFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="icon fas fa-ban"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <!-- Info Box -->
            <div class="row">
                <div class="col-md-4">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tahun Ajaran</span>
                            <span class="info-box-number"><?php echo $tahunAjaranAktif; ?></span>
                            <span class="info-box-text">Semester <?php echo ucfirst($semesterAktif); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fas fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mata Kuliah Diambil</span>
                            <span class="info-box-number"><?php echo count($krsData); ?> MK</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="fas fa-calculator"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total SKS</span>
                            <span class="info-box-number"><?php echo $totalSKS; ?> SKS</span>
                            <span class="info-box-text">Max: 24 SKS</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KRS yang sudah diambil -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list"></i> KRS Saya
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambahKRS">
                            <i class="fas fa-plus"></i> Tambah Mata Kuliah
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="80">Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th width="50">SKS</th>
                                <th width="80">Kelas</th>
                                <th>Dosen</th>
                                <th>Jadwal</th>
                                <th>Ruangan</th>
                                <th width="80">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($krsData) > 0): ?>
                                <?php foreach ($krsData as $krs): ?>
                                    <tr>
                                        <td><?php echo $krs['kode_matkul']; ?></td>
                                        <td><?php echo $krs['nama_matkul']; ?></td>
                                        <td><?php echo $krs['sks']; ?></td>
                                        <td><?php echo $krs['kode_kelas']; ?></td>
                                        <td><?php echo $krs['nama_dosen']; ?></td>
                                        <td><?php echo $krs['hari'] . ', ' . substr($krs['jam_mulai'], 0, 5) . '-' . substr($krs['jam_selesai'], 0, 5); ?></td>
                                        <td><?php echo $krs['ruangan']; ?></td>
                                        <td>
                                            <a href="?hapus=<?php echo $krs['krs_id']; ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirmDelete(this.href, 'Hapus mata kuliah dari KRS?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="bg-light">
                                    <td colspan="2"><strong>TOTAL</strong></td>
                                    <td><strong><?php echo $totalSKS; ?></strong></td>
                                    <td colspan="5"></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        Belum ada KRS. Silakan tambah mata kuliah.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Modal Tambah KRS -->
<div class="modal fade" id="modalTambahKRS">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Mata Kuliah</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover datatable">
                    <thead>
                        <tr>
                            <th>Kode MK</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Kelas</th>
                            <th>Dosen</th>
                            <th>Jadwal</th>
                            <th>Ruangan</th>
                            <th>Kuota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kelasTersedia as $kelas): ?>
                            <tr>
                                <td><?php echo $kelas['kode_matkul']; ?></td>
                                <td><?php echo $kelas['nama_matkul']; ?></td>
                                <td><?php echo $kelas['sks']; ?></td>
                                <td><?php echo $kelas['kode_kelas']; ?></td>
                                <td><?php echo $kelas['nama_dosen']; ?></td>
                                <td><?php echo $kelas['hari'] . ', ' . substr($kelas['jam_mulai'], 0, 5) . '-' . substr($kelas['jam_selesai'], 0, 5); ?></td>
                                <td><?php echo $kelas['ruangan']; ?></td>
                                <td><?php echo $kelas['jumlah_mahasiswa'] . '/' . $kelas['kuota']; ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="action" value="tambah">
                                        <input type="hidden" name="kelas_id" value="<?php echo $kelas['id']; ?>">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-plus"></i> Ambil
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
