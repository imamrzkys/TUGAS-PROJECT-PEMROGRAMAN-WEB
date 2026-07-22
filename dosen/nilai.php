<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Kelas.php';
require_once __DIR__ . '/../models/KRS.php';
require_once __DIR__ . '/../models/Nilai.php';

requireRole('dosen');

$pageTitle = 'Input Nilai';
$user = getCurrentUser();

$kelasModel = new Kelas();
$krsModel = new KRS();
$nilaiModel = new Nilai();

// Get kelas yang diajar
$kelasFilter = ['dosen_id' => $user['id'], 'is_active' => 1];
$kelasDiajar = $kelasModel->getKelasWithDetails($kelasFilter);

// Get selected kelas
$selectedKelasId = isset($_GET['kelas_id']) ? sanitize($_GET['kelas_id']) : null;
$kelasDetail = null;
$mahasiswaList = [];

if ($selectedKelasId) {
    $kelasDetail = $kelasModel->getKelasDetail($selectedKelasId);
    
    // Validasi apakah dosen mengajar kelas ini
    if ($kelasDetail && $kelasDetail['dosen_id'] != $user['id']) {
        setFlash('error', 'Anda tidak memiliki akses ke kelas ini');
        redirect('/dosen/nilai.php');
    }
    
    $mahasiswaList = $krsModel->getMahasiswaKelas($selectedKelasId);
}

// Handle input nilai
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'input_nilai') {
    $krsId = sanitize($_POST['krs_id']);
    $nilaiTugas = sanitize($_POST['nilai_tugas']) ?: 0;
    $nilaiUTS = sanitize($_POST['nilai_uts']) ?: 0;
    $nilaiUAS = sanitize($_POST['nilai_uas']) ?: 0;
    
    // Input nilai dengan bobot
    $nilaiModel->inputNilai($krsId, 'tugas', $nilaiTugas, 30);
    $nilaiModel->inputNilai($krsId, 'uts', $nilaiUTS, 30);
    $nilaiModel->inputNilai($krsId, 'uas', $nilaiUAS, 40);
    
    setFlash('success', 'Nilai berhasil disimpan');
    redirect('/dosen/nilai.php?kelas_id=' . $selectedKelasId);
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-dosen.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Input Nilai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Input Nilai</li>
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

            <!-- Pilih Kelas -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pilih Kelas</h3>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="row">
                            <div class="col-md-8">
                                <select name="kelas_id" class="form-control" onchange="this.form.submit()">
                                    <option value="">-- Pilih Kelas --</option>
                                    <?php foreach ($kelasDiajar as $kelas): ?>
                                        <option value="<?php echo $kelas['id']; ?>" <?php echo $selectedKelasId == $kelas['id'] ? 'selected' : ''; ?>>
                                            <?php echo $kelas['kode_matkul'] . ' - ' . $kelas['nama_matkul'] . ' (' . $kelas['kode_kelas'] . ')'; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php if ($kelasDetail): ?>
                <!-- Info Kelas -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?php echo $kelasDetail['nama_matkul']; ?> (<?php echo $kelasDetail['kode_kelas']; ?>)
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Kode MK:</strong> <?php echo $kelasDetail['kode_matkul']; ?>
                            </div>
                            <div class="col-md-3">
                                <strong>SKS:</strong> <?php echo $kelasDetail['sks']; ?>
                            </div>
                            <div class="col-md-3">
                                <strong>Jadwal:</strong> <?php echo $kelasDetail['hari'] . ', ' . substr($kelasDetail['jam_mulai'], 0, 5); ?>
                            </div>
                            <div class="col-md-3">
                                <strong>Ruangan:</strong> <?php echo $kelasDetail['ruangan']; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Mahasiswa & Input Nilai -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-star"></i> Input Nilai Mahasiswa
                        </h3>
                        <div class="card-tools">
                            <span class="badge badge-primary">Total: <?php echo count($mahasiswaList); ?> Mahasiswa</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="100">NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th width="100">Tugas (30%)</th>
                                    <th width="100">UTS (30%)</th>
                                    <th width="100">UAS (40%)</th>
                                    <th width="80">Nilai Akhir</th>
                                    <th width="60">Grade</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mahasiswaList as $mhs): ?>
                                    <?php
                                    // Get nilai existing
                                    $nilaiData = $nilaiModel->getNilaiByKRS($mhs['krs_id']);
                                    $nilaiTugas = 0;
                                    $nilaiUTS = 0;
                                    $nilaiUAS = 0;
                                    
                                    foreach ($nilaiData as $n) {
                                        if ($n['komponen'] == 'tugas') $nilaiTugas = $n['nilai'];
                                        if ($n['komponen'] == 'uts') $nilaiUTS = $n['nilai'];
                                        if ($n['komponen'] == 'uas') $nilaiUAS = $n['nilai'];
                                    }
                                    
                                    $nilaiAkhir = $nilaiModel->hitungNilaiAkhir($mhs['krs_id']);
                                    $grade = getNilaiGrade($nilaiAkhir);
                                    ?>
                                    <tr>
                                        <td><?php echo $mhs['nim']; ?></td>
                                        <td><?php echo $mhs['nama_lengkap']; ?></td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" 
                                                   id="tugas_<?php echo $mhs['krs_id']; ?>" 
                                                   value="<?php echo $nilaiTugas; ?>" 
                                                   min="0" max="100" step="0.01">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" 
                                                   id="uts_<?php echo $mhs['krs_id']; ?>" 
                                                   value="<?php echo $nilaiUTS; ?>" 
                                                   min="0" max="100" step="0.01">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" 
                                                   id="uas_<?php echo $mhs['krs_id']; ?>" 
                                                   value="<?php echo $nilaiUAS; ?>" 
                                                   min="0" max="100" step="0.01">
                                        </td>
                                        <td class="text-center">
                                            <strong><?php echo round($nilaiAkhir, 2); ?></strong>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-<?php 
                                                echo $grade == 'A' || $grade == 'A-' ? 'success' : 
                                                    ($grade == 'B' || $grade == 'B+' || $grade == 'B-' ? 'primary' : 
                                                    ($grade == 'C' || $grade == 'C+' ? 'warning' : 'danger'));
                                            ?>">
                                                <?php echo $grade; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="action" value="input_nilai">
                                                <input type="hidden" name="krs_id" value="<?php echo $mhs['krs_id']; ?>">
                                                <input type="hidden" name="nilai_tugas" id="nilai_tugas_<?php echo $mhs['krs_id']; ?>">
                                                <input type="hidden" name="nilai_uts" id="nilai_uts_<?php echo $mhs['krs_id']; ?>">
                                                <input type="hidden" name="nilai_uas" id="nilai_uas_<?php echo $mhs['krs_id']; ?>">
                                                <button type="button" class="btn btn-success btn-sm" onclick="submitNilai(<?php echo $mhs['krs_id']; ?>)">
                                                    <i class="fas fa-save"></i> Simpan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
</div>

<?php
$extraJS = "
<script>
function submitNilai(krsId) {
    var tugas = document.getElementById('tugas_' + krsId).value;
    var uts = document.getElementById('uts_' + krsId).value;
    var uas = document.getElementById('uas_' + krsId).value;
    
    document.getElementById('nilai_tugas_' + krsId).value = tugas;
    document.getElementById('nilai_uts_' + krsId).value = uts;
    document.getElementById('nilai_uas_' + krsId).value = uas;
    
    event.target.closest('form').submit();
}
</script>
";

include __DIR__ . '/../includes/footer.php';
?>
