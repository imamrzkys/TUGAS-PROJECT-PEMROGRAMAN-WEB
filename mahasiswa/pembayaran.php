<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';

requireRole('mahasiswa');

$pageTitle = 'Pembayaran UKT';
$user = getCurrentUser();

// Get data pembayaran (dummy untuk demo)
$db = getDB();
$stmt = $db->prepare("SELECT * FROM pembayaran WHERE mahasiswa_id = :mahasiswa_id ORDER BY dibuat_pada DESC");
$stmt->execute(['mahasiswa_id' => $user['id']]);
$pembayaranList = $stmt->fetchAll();

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-mahasiswa.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pembayaran UKT</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/mahasiswa/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pembayaran UKT</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> Informasi Penting</h5>
                        <ul class="mb-0">
                            <li>Lakukan pembayaran sebelum batas waktu yang ditentukan</li>
                            <li>Gunakan nomor Virtual Account (VA) yang tertera untuk pembayaran</li>
                            <li>Pembayaran dapat dilakukan melalui ATM, Mobile Banking, atau Internet Banking</li>
                            <li>Setelah pembayaran berhasil, status akan otomatis berubah (max 1x24 jam)</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <?php foreach ($pembayaranList as $bayar): ?>
                <?php
                // Hitung sisa hari
                $deadline = new DateTime($bayar['batas_waktu']);
                $today = new DateTime();
                $diff = $today->diff($deadline);
                $sisaHari = $diff->days;
                $statusBadge = '';
                $cardClass = '';
                
                switch($bayar['status']) {
                    case 'lunas':
                        $statusBadge = '<span class="badge badge-success badge-lg">LUNAS</span>';
                        $cardClass = 'card-success';
                        break;
                    case 'menunggu':
                        $statusBadge = '<span class="badge badge-warning badge-lg">MENUNGGU PEMBAYARAN</span>';
                        $cardClass = 'card-warning';
                        break;
                    case 'verifikasi':
                        $statusBadge = '<span class="badge badge-info badge-lg">SEDANG DIVERIFIKASI</span>';
                        $cardClass = 'card-info';
                        break;
                    case 'kadaluarsa':
                        $statusBadge = '<span class="badge badge-danger badge-lg">KADALUARSA</span>';
                        $cardClass = 'card-danger';
                        break;
                }
                ?>
                
                <div class="card <?php echo $cardClass; ?> card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-money-bill-wave"></i> 
                            <strong><?php echo strtoupper($bayar['jenis']); ?> - Semester <?php echo ucfirst($bayar['semester']); ?> <?php echo $bayar['tahun_ajaran']; ?></strong>
                        </h3>
                        <div class="card-tools">
                            <?php echo $statusBadge; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="150"><strong>Jenis Pembayaran</strong></td>
                                        <td><?php echo $bayar['jenis']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jumlah Tagihan</strong></td>
                                        <td class="text-danger"><h4><strong>Rp <?php echo number_format($bayar['jumlah'], 0, ',', '.'); ?></strong></h4></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Batas Pembayaran</strong></td>
                                        <td>
                                            <?php echo formatTanggalIndo($bayar['batas_waktu']); ?>
                                            <?php if ($bayar['status'] == 'menunggu'): ?>
                                                <br><small class="text-danger">
                                                    <i class="fas fa-clock"></i> Sisa waktu: <?php echo $sisaHari; ?> hari
                                                </small>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php if ($bayar['status'] == 'lunas' && $bayar['dibayar_pada']): ?>
                                        <tr>
                                            <td><strong>Dibayar Pada</strong></td>
                                            <td><?php echo formatTanggalIndo($bayar['dibayar_pada']); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                            
                            <?php if ($bayar['status'] == 'menunggu'): ?>
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-credit-card"></i> Nomor Virtual Account</h5>
                                            <div class="text-center my-3">
                                                <h2 class="text-primary"><strong><?php echo $bayar['nomor_va']; ?></strong></h2>
                                                <button class="btn btn-sm btn-outline-primary" onclick="copyVA('<?php echo $bayar['nomor_va']; ?>')">
                                                    <i class="fas fa-copy"></i> Salin Nomor VA
                                                </button>
                                            </div>
                                            <hr>
                                            <h6><i class="fas fa-university"></i> Bank Transfer Available:</h6>
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <img src="https://via.placeholder.com/80x30/00529C/FFFFFF?text=BCA" alt="BCA" class="img-fluid">
                                                </div>
                                                <div class="col-4">
                                                    <img src="https://via.placeholder.com/80x30/E31E24/FFFFFF?text=BNI" alt="BNI" class="img-fluid">
                                                </div>
                                                <div class="col-4">
                                                    <img src="https://via.placeholder.com/80x30/007DC3/FFFFFF?text=BRI" alt="BRI" class="img-fluid">
                                                </div>
                                            </div>
                                            
                                            <div class="mt-3">
                                                <button class="btn btn-primary btn-block" disabled>
                                                    <i class="fas fa-upload"></i> Upload Bukti Pembayaran
                                                </button>
                                                <small class="text-muted">Upload setelah transfer berhasil</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($bayar['status'] == 'lunas'): ?>
                                <div class="col-md-6 text-center">
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle fa-3x"></i>
                                        <h4 class="mt-2">Pembayaran Berhasil!</h4>
                                        <p>Terima kasih telah melakukan pembayaran tepat waktu</p>
                                        <button class="btn btn-success" disabled>
                                            <i class="fas fa-download"></i> Download Bukti Pembayaran
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if (empty($pembayaranList)): ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Tidak ada tagihan pembayaran saat ini
                </div>
            <?php endif; ?>

        </div>
    </section>
</div>

<script>
function copyVA(va) {
    navigator.clipboard.writeText(va);
    showToast('success', 'Nomor VA berhasil disalin!');
}
</script>

<?php
include __DIR__ . '/../includes/footer.php';
?>
