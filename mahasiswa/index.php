<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/KRS.php';
require_once __DIR__ . '/../models/Nilai.php';

requireRole('mahasiswa');

$pageTitle = 'Dashboard Mahasiswa';
$user = getCurrentUser();

// Get data untuk dashboard
$krsModel = new KRS();
$nilaiModel = new Nilai();

$tahunAjaranAktif = '2026/2027';
$semesterAktif = 'ganjil';

$krsAktif = $krsModel->getKRSMahasiswa($user['id'], $tahunAjaranAktif, $semesterAktif);
$totalSKS = $krsModel->getTotalSKS($user['id'], $tahunAjaranAktif, $semesterAktif);
$ipk = $nilaiModel->hitungIPK($user['id']);

// Calculate academic progress
$semester_count = 5;
$total_sks_target = 144;
$completed_sks = 112;

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-mahasiswa.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-muted mb-0" style="font-size: 13px;"><i class="fas fa-home"></i> Beranda</p>
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

            <!-- Profile Card -->
            <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                        <div class="card-body" style="padding: 30px;">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['nama_lengkap']); ?>&background=0066FF&color=fff&bold=true&size=200" 
                                         alt="Profile" 
                                         style="width: 80px; height: 80px; border-radius: 12px; border: 3px solid #0066FF;">
                                </div>
                                <div class="col-md-7">
                                    <h3 style="margin: 0; font-size: 24px; font-weight: 700; color: var(--text-primary);">
                                        <?php echo $user['nama_lengkap']; ?>
                                        <span class="badge badge-primary ml-2" style="font-size: 11px; vertical-align: middle;">AKTIF</span>
                                    </h3>
                                    <p style="margin: 5px 0; color: var(--text-secondary);">
                                        <strong>NIM: <?php echo $user['nim']; ?></strong> | Sarjana Teknik Informatika • Angkatan 2021
                                    </p>
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col-auto">
                                                <small class="text-muted">Semester Saat Ini</small>
                                                <div style="font-size: 24px; font-weight: 700; color: var(--primary-blue);"><?php echo $semester_count; ?></div>
                                            </div>
                                            <div class="col-auto border-left">
                                                <small class="text-muted">Total SKS</small>
                                                <div style="font-size: 24px; font-weight: 700; color: var(--primary-green);"><?php echo $completed_sks; ?></div>
                                            </div>
                                            <div class="col-auto border-left">
                                                <small class="text-muted">IPK Saat Ini</small>
                                                <div style="font-size: 24px; font-weight: 700; color: var(--primary-orange);"><?php echo number_format($ipk, 2); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-right">
                                    <div style="font-size: 11px; color: var(--text-muted); margin-bottom: 5px;">
                                        <i class="fas fa-bell"></i> <i class="fas fa-question-circle"></i> <i class="fas fa-moon"></i> 
                                    </div>
                                    <div style="font-size: 11px; color: var(--text-muted);">Semester 5</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card" style="border: none; border-radius: 16px; background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%); color: white; box-shadow: 0 4px 16px rgba(0, 102, 255, 0.3); min-height: 180px;">
                        <div class="card-body" style="padding: 25px;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 15px;">
                                <div style="flex: 1;">
                                    <i class="fas fa-clipboard-check" style="font-size: 24px; opacity: 0.9; display: block; margin-bottom: 12px;"></i>
                                    <div style="font-size: 14px; margin-bottom: 8px; opacity: 1; font-weight: 600; line-height: 1.4;">Status KRS</div>
                                    <div style="font-size: 11px; opacity: 0.9; margin-bottom: 15px; line-height: 1.5;">Rencana akademik untuk Semester Ganjil 2026/2027 telah disetujui oleh pembimbing akademik Anda.</div>
                                    <button class="btn btn-light btn-sm" style="color: #0066FF; font-weight: 600; border-radius: 8px; padding: 8px 16px;" onclick="window.location.href='krs.php'">
                                        <i class="fas fa-clipboard-list" style="margin-right: 5px;"></i> Lihat KRS Detail
                                    </button>
                                </div>
                                <div style="flex-shrink: 0;">
                                    <span class="badge badge-success" style="font-size: 10px; padding: 6px 10px; font-weight: 700; border-radius: 6px; white-space: nowrap;">TERVERIFIKASI</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Schedule & Academic Progress -->
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <div class="card">
                        <div class="card-header" style="background: white; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-calendar-day"></i> Jadwal Hari Ini
                            </h3>
                            <a href="jadwal.php" style="font-size: 12px; color: var(--primary-blue); text-decoration: none;">Kalender Lengkap</a>
                        </div>
                        <div class="card-body">
                            <?php if (count($krsAktif) > 0 && count($krsAktif) >= 2): ?>
                                <!-- Schedule Item 1 -->
                                <div style="background: rgba(0, 102, 255, 0.05); padding: 15px; border-radius: 12px; margin-bottom: 15px; border-left: 4px solid var(--primary-blue);">
                                    <div style="display: flex; justify-content: space-between; align-items: start;">
                                        <div>
                                            <div style="font-size: 12px; color: var(--text-muted); margin-bottom: 5px;">08:00 - 09:40</div>
                                            <div style="font-weight: 600; font-size: 14px; color: var(--text-primary); margin-bottom: 3px;"><?php echo $krsAktif[0]['nama_matkul']; ?></div>
                                            <div style="font-size: 12px; color: var(--text-secondary);">
                                                Lab 8.7.1 • M.Sc. Dr. Siti Aminah
                                            </div>
                                        </div>
                                        <div>
                                            <span class="badge badge-primary"><i class="fas fa-circle" style="font-size: 6px;"></i></span>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Schedule Item 2 -->
                                <div style="background: rgba(6, 214, 160, 0.05); padding: 15px; border-radius: 12px; margin-bottom: 15px; border-left: 4px solid var(--primary-green);">
                                    <div style="display: flex; justify-content: space-between; align-items: start;">
                                        <div>
                                            <div style="font-size: 12px; color: var(--text-muted); margin-bottom: 5px;">13:08 - 15:30</div>
                                            <div style="font-weight: 600; font-size: 14px; color: var(--text-primary); margin-bottom: 3px;"><?php echo $krsAktif[1]['nama_matkul']; ?></div>
                                            <div style="font-size: 12px; color: var(--text-secondary);">
                                                Ruang 133 • M.Sc. Budi Santoso
                                            </div>
                                        </div>
                                        <span class="badge badge-primary"><i class="fas fa-circle" style="font-size: 6px;"></i></span>
                                    </div>
                                </div>

                                <div style="text-align: center; padding: 10px 0;">
                                    <small class="text-muted">Tidak ada kelas tambahan hari ini</small>
                                </div>
                            <?php else: ?>
                                <div style="text-align: center; padding: 40px 20px;">
                                    <i class="fas fa-calendar-times" style="font-size: 48px; color: var(--text-muted); opacity: 0.3; margin-bottom: 15px;"></i>
                                    <p class="text-muted">Tidak ada jadwal hari ini</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Recent Announcements -->
                    <div class="card mt-4">
                        <div class="card-header" style="background: white; border-bottom: 1px solid var(--border-color);">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-bullhorn"></i> Pengumuman Terkini
                            </h3>
                        </div>
                        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                            <!-- Announcement Item 1 -->
                            <div style="padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 8px; height: 8px; background: var(--primary-red); border-radius: 50%; margin-top: 8px;"></div>
                                    <div style="flex: 1;">
                                        <span class="badge badge-danger" style="font-size: 9px; margin-bottom: 5px;">AKADEMIK</span>
                                        <div style="font-weight: 600; font-size: 13px; margin-bottom: 3px;">Pembaruan Jadwal Pendaftaran Ujian Akhir</div>
                                        <small class="text-muted" style="font-size: 11px;">Harap diperhatikan bahwa pendaftaran untuk...</small>
                                        <div style="margin-top: 5px;"><small class="text-muted" style="font-size: 10px;">2 jam lalu</small></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Announcement Item 2 -->
                            <div style="padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 8px; height: 8px; background: var(--primary-blue); border-radius: 50%; margin-top: 8px;"></div>
                                    <div style="flex: 1;">
                                        <span class="badge badge-warning" style="font-size: 9px; margin-bottom: 5px;">ACARA</span>
                                        <div style="font-weight: 600; font-size: 13px; margin-bottom: 3px;">Seminar Tahunan Teknik Informatika 2026</div>
                                        <small class="text-muted" style="font-size: 11px;">Kami dengan bangga mempersembahkan pertemuan tahunan...</small>
                                        <div style="margin-top: 5px;"><small class="text-muted" style="font-size: 10px;">Kemarin</small></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Announcement Item 3 -->
                            <div style="padding: 12px 0;">
                                <div style="display: flex; gap: 10px;">
                                    <div style="width: 8px; height: 8px; background: var(--primary-green); border-radius: 50%; margin-top: 8px;"></div>
                                    <div style="flex: 1;">
                                        <span class="badge badge-success" style="font-size: 9px; margin-bottom: 5px;">BEASISWA</span>
                                        <div style="font-weight: 600; font-size: 13px; margin-bottom: 3px;">Beasiswa Baru Tersedia</div>
                                        <small class="text-muted" style="font-size: 11px;">Tersedia untuk fakultas...</small>
                                        <div style="margin-top: 5px;"><small class="text-muted" style="font-size: 10px;">12 Okt 2026</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 mb-4">
                    <div class="card">
                        <div class="card-header" style="background: white; border-bottom: 1px solid var(--border-color);">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-chart-line"></i> Perkembangan Akademik
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Progress Chart Placeholder -->
                            <div style="height: 250px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, rgba(0, 102, 255, 0.05) 0%, rgba(0, 102, 255, 0.01) 100%); border-radius: 12px;">
                                <div class="text-center">
                                    <div class="row text-center">
                                        <div class="col-3">
                                            <div style="font-size: 13px; color: var(--text-muted); margin-bottom: 8px;">IPS Sem-1</div>
                                            <div style="font-size: 28px; font-weight: 700; color: var(--primary-blue);">3.84</div>
                                        </div>
                                        <div class="col-3">
                                            <div style="font-size: 13px; color: var(--text-muted); margin-bottom: 8px;">IPS Sem-2</div>
                                            <div style="font-size: 28px; font-weight: 700; color: var(--primary-green);">3.92</div>
                                        </div>
                                        <div class="col-3">
                                            <div style="font-size: 13px; color: var(--text-muted); margin-bottom: 8px;">IPS Sem-3</div>
                                            <div style="font-size: 28px; font-weight: 700; color: var(--primary-orange);">3.78</div>
                                        </div>
                                        <div class="col-3">
                                            <div style="font-size: 13px; color: var(--text-muted); margin-bottom: 8px;">IPS Sem-4</div>
                                            <div style="font-size: 28px; font-weight: 700; color: var(--primary-purple);">3.88</div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <small class="text-muted">IPS: Indeks Prestasi Semester</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Action Buttons -->
                            <div class="row mt-4">
                                <div class="col-3">
                                    <a href="krs.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 20px; background: rgba(0, 102, 255, 0.1); border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(0, 102, 255, 0.2)'" onmouseout="this.style.background='rgba(0, 102, 255, 0.1)'">
                                            <i class="fas fa-clipboard-list" style="font-size: 28px; color: var(--primary-blue);"></i>
                                            <div style="margin-top: 10px; font-size: 11px; font-weight: 600; color: var(--text-primary);">Pengisian KRS</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="nilai.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 20px; background: rgba(6, 214, 160, 0.1); border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(6, 214, 160, 0.2)'" onmouseout="this.style.background='rgba(6, 214, 160, 0.1)'">
                                            <i class="fas fa-book-open" style="font-size: 28px; color: var(--primary-green);"></i>
                                            <div style="margin-top: 10px; font-size: 11px; font-weight: 600; color: var(--text-primary);">Buku Nilai</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="jadwal.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 20px; background: rgba(230, 57, 70, 0.1); border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(230, 57, 70, 0.2)'" onmouseout="this.style.background='rgba(230, 57, 70, 0.1)'">
                                            <i class="fas fa-calendar-alt" style="font-size: 28px; color: var(--primary-red);"></i>
                                            <div style="margin-top: 10px; font-size: 11px; font-weight: 600; color: var(--text-primary);">Jadwal Kuliah</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="pembayaran.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 20px; background: rgba(245, 158, 11, 0.1); border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(245, 158, 11, 0.2)'" onmouseout="this.style.background='rgba(245, 158, 11, 0.1)'">
                                            <i class="fas fa-file-invoice-dollar" style="font-size: 28px; color: var(--primary-orange);"></i>
                                            <div style="margin-top: 10px; font-size: 11px; font-weight: 600; color: var(--text-primary);">Transkrip</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
