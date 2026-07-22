<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Nilai.php';

requireRole('mahasiswa');

$pageTitle = 'Nilai & Transkrip';
$user = getCurrentUser();

$nilaiModel = new Nilai();

// Get transkrip mahasiswa
$transkrip = $nilaiModel->getTranskrip($user['id']);
$ipk = $nilaiModel->hitungIPK($user['id']);

// Kelompokkan per semester
$transkripPerSemester = [];
foreach ($transkrip as $nilai) {
    $key = $nilai['tahun_ajaran'] . ' - ' . ucfirst($nilai['semester']);
    if (!isset($transkripPerSemester[$key])) {
        $transkripPerSemester[$key] = [];
    }
    $transkripPerSemester[$key][] = $nilai;
}

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
                    <h1 class="m-0">Nilai & Transkrip</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nilai & Transkrip</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- IPK Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body text-center">
                            <h3>Indeks Prestasi Kumulatif (IPK)</h3>
                            <h1 class="display-1 text-primary">
                                <strong><?php echo number_format($ipk, 2); ?></strong>
                            </h1>
                            <p class="text-muted">
                                <?php
                                if ($ipk >= 3.51) echo 'Dengan Pujian (Cum Laude)';
                                elseif ($ipk >= 3.01) echo 'Sangat Memuaskan';
                                elseif ($ipk >= 2.76) echo 'Memuaskan';
                                elseif ($ipk >= 2.00) echo 'Cukup';
                                else echo 'Kurang';
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transkrip per Semester -->
            <?php if (count($transkripPerSemester) > 0): ?>
                <?php foreach ($transkripPerSemester as $semester => $nilaiSemester): ?>
                    <?php
                    // Hitung IP semester
                    $totalBobotSemester = 0;
                    $totalSKSSemester = 0;
                    foreach ($nilaiSemester as $n) {
                        $totalBobotSemester += ($n['bobot_nilai'] * $n['sks']);
                        $totalSKSSemester += $n['sks'];
                    }
                    $ipSemester = $totalSKSSemester > 0 ? round($totalBobotSemester / $totalSKSSemester, 2) : 0;
                    ?>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-book-open"></i> <?php echo $semester; ?>
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-primary">IP: <?php echo number_format($ipSemester, 2); ?></span>
                                <span class="badge badge-success">Total SKS: <?php echo $totalSKSSemester; ?></span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="100">Kode MK</th>
                                        <th>Mata Kuliah</th>
                                        <th width="60" class="text-center">SKS</th>
                                        <th width="80" class="text-center">Nilai</th>
                                        <th width="80" class="text-center">Grade</th>
                                        <th width="80" class="text-center">Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($nilaiSemester as $nilai): ?>
                                        <tr>
                                            <td><?php echo $nilai['kode_matkul']; ?></td>
                                            <td><?php echo $nilai['nama_matkul']; ?></td>
                                            <td class="text-center"><?php echo $nilai['sks']; ?></td>
                                            <td class="text-center"><?php echo round($nilai['nilai_akhir'], 2); ?></td>
                                            <td class="text-center">
                                                <span class="badge badge-<?php 
                                                    echo $nilai['grade'] == 'A' || $nilai['grade'] == 'A-' ? 'success' : 
                                                        ($nilai['grade'] == 'B' || $nilai['grade'] == 'B+' || $nilai['grade'] == 'B-' ? 'primary' : 
                                                        ($nilai['grade'] == 'C' || $nilai['grade'] == 'C+' ? 'warning' : 'danger'));
                                                ?>">
                                                    <?php echo $nilai['grade']; ?>
                                                </span>
                                            </td>
                                            <td class="text-center"><?php echo number_format($nilai['bobot_nilai'], 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="card">
                    <div class="card-body">
                        <p class="text-center text-muted">
                            <i class="fas fa-info-circle"></i> Belum ada data nilai
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Cetak Transkrip -->
            <div class="row">
                <div class="col-12">
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fas fa-print"></i> Cetak Transkrip
                    </button>
                </div>
            </div>

        </div>
    </section>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
