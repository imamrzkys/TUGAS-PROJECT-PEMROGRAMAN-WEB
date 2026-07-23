<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/Kelas.php';

requireRole('dosen');

$pageTitle = 'Dashboard Dosen';
$user = getCurrentUser();

$kelasModel = new Kelas();

$tahunAjaranAktif = '2026/2027';
$semesterAktif = 'ganjil';

// Get kelas yang diajar
$kelasFilter = [
    'dosen_id' => $user['id'],
    'tahun_ajaran' => $tahunAjaranAktif,
    'semester' => $semesterAktif,
    'aktif' => 1
];
$kelasDiajar = $kelasModel->getKelasWithDetails($kelasFilter);

// Hitung statistik
$totalKelas = count($kelasDiajar);
$totalMahasiswa = array_sum(array_column($kelasDiajar, 'jumlah_mahasiswa'));

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-dosen.php';
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

            <!-- Profile & Calendar Row -->
            <div class="row mb-4">
                <!-- Profile Card -->
                <div class="col-xl-7 col-lg-12 mb-4 mb-xl-0">
                    <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                        <div class="card-body" style="padding: 25px;">
                            <div class="row">
                                <!-- Avatar & Basic Info -->
                                <div class="col-md-4 col-sm-12 mb-3 mb-md-0">
                                    <div style="text-align: center;">
                                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['nama_lengkap']); ?>&background=0066FF&color=fff&bold=true&size=200" 
                                             alt="Profile" 
                                             class="img-fluid" 
                                             style="width: 100px; height: 100px; border-radius: 16px; border: 3px solid #0066FF; margin-bottom: 12px;">
                                        <span class="badge badge-success" style="font-size: 11px; padding: 6px 12px; border-radius: 8px;">DOSEN AKTIF</span>
                                        <div style="margin-top: 12px;">
                                            <button class="btn btn-sm btn-primary" style="border-radius: 8px; font-weight: 600; padding: 8px 20px; font-size: 12px;" onclick="window.location.href='../change-password.php'">
                                                <i class="fas fa-user-edit"></i> Edit Profil
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Profile Details -->
                                <div class="col-md-8 col-sm-12">
                                    <h4 style="margin: 0 0 8px 0; font-size: 22px; font-weight: 700; color: var(--text-primary);">
                                        <?php echo $user['nama_lengkap']; ?>
                                    </h4>
                                    <p style="margin: 0 0 15px 0; color: var(--text-secondary); font-size: 13px;">
                                        <strong>NIP: <?php echo $user['nim']; ?></strong>
                                    </p>
                                    
                                    <!-- Info Grid -->
                                    <div style="background: rgba(0, 102, 255, 0.05); padding: 15px; border-radius: 12px; margin-bottom: 15px;">
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <div style="font-size: 11px; color: var(--text-muted); margin-bottom: 4px;">
                                                    <i class="fas fa-building" style="color: var(--primary-blue); margin-right: 5px;"></i>Fakultas
                                                </div>
                                                <div style="font-size: 13px; font-weight: 600; color: var(--text-primary);">Teknik Informatika</div>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <div style="font-size: 11px; color: var(--text-muted); margin-bottom: 4px;">
                                                    <i class="fas fa-briefcase" style="color: var(--primary-green); margin-right: 5px;"></i>Status
                                                </div>
                                                <div style="font-size: 13px; font-weight: 600; color: var(--text-primary);">Dosen Tetap</div>
                                            </div>
                                            <div class="col-6">
                                                <div style="font-size: 11px; color: var(--text-muted); margin-bottom: 4px;">
                                                    <i class="fas fa-calendar-alt" style="color: var(--primary-orange); margin-right: 5px;"></i>Semester
                                                </div>
                                                <div style="font-size: 13px; font-weight: 600; color: var(--text-primary);"><?php echo ucfirst($semesterAktif); ?> • <?php echo $tahunAjaranAktif; ?></div>
                                            </div>
                                            <div class="col-6">
                                                <div style="font-size: 11px; color: var(--text-muted); margin-bottom: 4px;">
                                                    <i class="fas fa-envelope" style="color: var(--primary-red); margin-right: 5px;"></i>Email
                                                </div>
                                                <div style="font-size: 13px; font-weight: 600; color: var(--text-primary);">dosen@siakad.ac.id</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Stats Row -->
                                    <div class="row">
                                        <div class="col-4">
                                            <div style="text-align: center; padding: 12px; background: linear-gradient(135deg, rgba(0, 102, 255, 0.1) 0%, rgba(0, 102, 255, 0.05) 100%); border-radius: 10px;">
                                                <div style="font-size: 24px; font-weight: 700; color: var(--primary-blue); line-height: 1;"><?php echo $totalKelas; ?></div>
                                                <small class="text-muted" style="font-size: 10px;">Kelas Diampu</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div style="text-align: center; padding: 12px; background: linear-gradient(135deg, rgba(6, 214, 160, 0.1) 0%, rgba(6, 214, 160, 0.05) 100%); border-radius: 10px;">
                                                <div style="font-size: 24px; font-weight: 700; color: var(--primary-green); line-height: 1;"><?php echo $totalMahasiswa; ?></div>
                                                <small class="text-muted" style="font-size: 10px;">Total Mahasiswa</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div style="text-align: center; padding: 12px; background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%); border-radius: 10px;">
                                                <div style="font-size: 24px; font-weight: 700; color: var(--primary-orange); line-height: 1;">5+</div>
                                                <small class="text-muted" style="font-size: 10px;">Tahun Mengajar</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar Card -->
                <div class="col-xl-5 col-lg-12">
                    <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); height: 100%;">
                        <div class="card-body" style="padding: 20px;">
                            <?php
                            // Get current date info
                            $current_month = 7; // Juli
                            $current_year = 2026;
                            $current_day = 23; // Hari ini
                            $month_name = 'Juli';
                            
                            // Get first day of month and total days
                            $first_day = date('N', strtotime("$current_year-$current_month-01")); // 1=Monday, 7=Sunday
                            $total_days = date('t', strtotime("$current_year-$current_month-01"));
                            
                            // Days with classes (example)
                            $days_with_classes = [];
                            foreach ($kelasDiajar as $kelas) {
                                $hari = $kelas['hari'];
                                $day_map = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5];
                                if (isset($day_map[$hari])) {
                                    for ($d = 1; $d <= $total_days; $d++) {
                                        $day_of_week = date('N', strtotime("$current_year-$current_month-$d"));
                                        if ($day_of_week == $day_map[$hari]) {
                                            if (!in_array($d, $days_with_classes)) {
                                                $days_with_classes[] = $d;
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                            
                            <!-- Calendar Header -->
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                                <h6 style="font-weight: 700; margin: 0; color: var(--text-primary); font-size: 14px;">
                                    <i class="far fa-calendar" style="color: var(--primary-blue);"></i> <?php echo $month_name; ?> <?php echo $current_year; ?>
                                </h6>
                                <div>
                                    <button style="border: none; background: rgba(0, 102, 255, 0.1); color: var(--primary-blue); width: 30px; height: 30px; border-radius: 8px; margin-right: 5px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(0, 102, 255, 0.2)'" onmouseout="this.style.background='rgba(0, 102, 255, 0.1)'">
                                        <i class="fas fa-chevron-left" style="font-size: 11px;"></i>
                                    </button>
                                    <button style="border: none; background: rgba(0, 102, 255, 0.1); color: var(--primary-blue); width: 30px; height: 30px; border-radius: 8px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(0, 102, 255, 0.2)'" onmouseout="this.style.background='rgba(0, 102, 255, 0.1)'">
                                        <i class="fas fa-chevron-right" style="font-size: 11px;"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Calendar Grid -->
                            <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; margin-bottom: 15px;">
                                <!-- Day Headers -->
                                <?php 
                                $day_headers = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                                foreach ($day_headers as $day_header): 
                                ?>
                                    <div style="text-align: center; font-size: 10px; font-weight: 600; color: var(--text-muted); padding: 6px 0;">
                                        <?php echo $day_header; ?>
                                    </div>
                                <?php endforeach; ?>
                                
                                <!-- Empty cells before first day -->
                                <?php for ($i = 1; $i < $first_day; $i++): ?>
                                    <div style="padding: 6px;"></div>
                                <?php endfor; ?>
                                
                                <!-- Calendar days -->
                                <?php for ($day = 1; $day <= $total_days; $day++): 
                                    $is_today = ($day == $current_day);
                                    $has_class = in_array($day, $days_with_classes);
                                    $day_of_week = date('N', strtotime("$current_year-$current_month-$day"));
                                    $is_weekend = ($day_of_week >= 6);
                                ?>
                                    <div style="position: relative; text-align: center; padding: 10px 6px; border-radius: 8px; 
                                        background: <?php echo $is_today ? 'linear-gradient(135deg, #0066FF 0%, #0052CC 100%)' : ($has_class ? 'rgba(6, 214, 160, 0.1)' : ($is_weekend ? 'rgba(0,0,0,0.02)' : 'transparent')); ?>; 
                                        color: <?php echo $is_today ? 'white' : 'var(--text-primary)'; ?>; 
                                        font-size: 12px; 
                                        font-weight: <?php echo $is_today ? '700' : '500'; ?>; 
                                        cursor: pointer;
                                        transition: all 0.2s;"
                                        onmouseover="this.style.background='<?php echo $is_today ? 'linear-gradient(135deg, #0052CC 0%, #003d99 100%)' : 'rgba(0, 102, 255, 0.1)'; ?>'"
                                        onmouseout="this.style.background='<?php echo $is_today ? 'linear-gradient(135deg, #0066FF 0%, #0052CC 100%)' : ($has_class ? 'rgba(6, 214, 160, 0.1)' : ($is_weekend ? 'rgba(0,0,0,0.02)' : 'transparent')); ?>'">
                                        <?php echo $day; ?>
                                        <?php if ($has_class && !$is_today): ?>
                                            <div style="width: 4px; height: 4px; background: var(--primary-green); border-radius: 50%; position: absolute; bottom: 3px; left: 50%; transform: translateX(-50%);"></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            
                            <!-- Calendar Legend -->
                            <div style="padding-top: 12px; border-top: 1px solid var(--border-color); display: flex; justify-content: center; align-items: center; gap: 20px; flex-wrap: wrap;">
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <div style="width: 14px; height: 14px; background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%); border-radius: 4px;"></div>
                                    <span style="font-size: 10px; color: var(--text-muted); font-weight: 500;">Hari Ini</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <div style="width: 4px; height: 4px; background: var(--primary-green); border-radius: 50%;"></div>
                                    <span style="font-size: 10px; color: var(--text-muted); font-weight: 500;">Ada Kelas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Buttons -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                        <div class="card-body" style="padding: 20px;">
                            <h6 style="font-weight: 700; margin-bottom: 15px; color: var(--text-primary); font-size: 15px;">
                                <i class="fas fa-bolt" style="color: var(--primary-orange);"></i> Aksi Cepat
                            </h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                    <a href="nilai.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 20px; background: linear-gradient(135deg, rgba(0, 102, 255, 0.1) 0%, rgba(0, 102, 255, 0.05) 100%); border-radius: 12px; transition: all 0.3s; border: 2px solid transparent;" onmouseover="this.style.borderColor='var(--primary-blue)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='transparent'; this.style.transform='translateY(0)'">
                                            <i class="fas fa-star" style="font-size: 28px; color: var(--primary-blue); margin-bottom: 10px;"></i>
                                            <div style="font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 4px;">Input Nilai</div>
                                            <div style="font-size: 10px; color: var(--text-muted);">Kelola nilai mahasiswa</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                    <a href="presensi.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 20px; background: linear-gradient(135deg, rgba(6, 214, 160, 0.1) 0%, rgba(6, 214, 160, 0.05) 100%); border-radius: 12px; transition: all 0.3s; border: 2px solid transparent;" onmouseover="this.style.borderColor='var(--primary-green)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='transparent'; this.style.transform='translateY(0)'">
                                            <i class="fas fa-check-circle" style="font-size: 28px; color: var(--primary-green); margin-bottom: 10px;"></i>
                                            <div style="font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 4px;">Presensi</div>
                                            <div style="font-size: 10px; color: var(--text-muted);">Rekap kehadiran</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                    <a href="materi.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 20px; background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%); border-radius: 12px; transition: all 0.3s; border: 2px solid transparent;" onmouseover="this.style.borderColor='var(--primary-orange)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='transparent'; this.style.transform='translateY(0)'">
                                            <i class="fas fa-book" style="font-size: 28px; color: var(--primary-orange); margin-bottom: 10px;"></i>
                                            <div style="font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 4px;">Materi Kuliah</div>
                                            <div style="font-size: 10px; color: var(--text-muted);">Upload & kelola materi</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                    <a href="tugas.php" style="text-decoration: none;">
                                        <div style="text-align: center; padding: 20px; background: linear-gradient(135deg, rgba(230, 57, 70, 0.1) 0%, rgba(230, 57, 70, 0.05) 100%); border-radius: 12px; transition: all 0.3s; border: 2px solid transparent;" onmouseover="this.style.borderColor='var(--primary-red)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='transparent'; this.style.transform='translateY(0)'">
                                            <i class="fas fa-tasks" style="font-size: 28px; color: var(--primary-red); margin-bottom: 10px;"></i>
                                            <div style="font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 4px;">Tugas</div>
                                            <div style="font-size: 10px; color: var(--text-muted);">Kelola tugas mahasiswa</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Row: Table + Sidebar -->
            <div class="row">
                <!-- Kelas yang Diampu Table -->
                <div class="col-xl-8 col-lg-12 mb-4">
                    <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                        <div class="card-header" style="background: white; border-bottom: 2px solid var(--border-color); padding: 20px 25px;">
                            <h5 style="font-weight: 700; margin: 0; color: var(--text-primary);">
                                <i class="fas fa-chalkboard-teacher" style="color: var(--primary-blue);"></i> Kelas yang Diampu
                            </h5>
                            <p style="font-size: 12px; color: var(--text-muted); margin: 5px 0 0 0;">Daftar mata kuliah yang Anda ampu pada semester ini</p>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0;">
                                    <thead style="background: rgba(0, 102, 255, 0.05);">
                                        <tr>
                                            <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">KODE MK</th>
                                            <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">MATA KULIAH</th>
                                            <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">KELAS</th>
                                            <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">JADWAL</th>
                                            <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none;">JUMLAH</th>
                                            <th style="padding: 15px 20px; font-weight: 600; font-size: 12px; color: var(--text-primary); border: none; text-align: center;">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($kelasDiajar) > 0): ?>
                                            <?php foreach ($kelasDiajar as $index => $kelas): ?>
                                                <tr style="transition: all 0.2s; <?php echo $index % 2 == 0 ? 'background: #fff;' : 'background: rgba(0,0,0,0.01);'; ?>">
                                                    <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                        <span style="font-weight: 700; color: var(--primary-blue); font-size: 13px;"><?php echo $kelas['kode_matkul']; ?></span>
                                                    </td>
                                                    <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                        <div style="font-weight: 600; font-size: 14px; color: var(--text-primary); margin-bottom: 2px;"><?php echo $kelas['nama_matkul']; ?></div>
                                                        <div style="font-size: 11px; color: var(--text-muted);">
                                                            <i class="fas fa-door-open" style="color: var(--primary-orange); margin-right: 4px;"></i>
                                                            <?php echo $kelas['ruangan']; ?> • <?php echo $kelas['sks']; ?> SKS
                                                        </div>
                                                    </td>
                                                    <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                        <span class="badge badge-primary" style="padding: 6px 12px; font-size: 12px; font-weight: 600;"><?php echo $kelas['kode_kelas']; ?></span>
                                                    </td>
                                                    <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                        <div style="font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 2px;">
                                                            <i class="far fa-calendar" style="color: var(--primary-green); margin-right: 4px;"></i>
                                                            <?php echo $kelas['hari']; ?>
                                                        </div>
                                                        <div style="font-size: 11px; color: var(--text-muted);">
                                                            <i class="far fa-clock" style="margin-right: 4px;"></i>
                                                            <?php echo substr($kelas['jam_mulai'], 0, 5); ?>-<?php echo substr($kelas['jam_selesai'], 0, 5); ?>
                                                        </div>
                                                    </td>
                                                    <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle;">
                                                        <span class="badge badge-success" style="padding: 8px 12px; font-size: 12px; font-weight: 600; border-radius: 8px;">
                                                            <i class="fas fa-users" style="margin-right: 4px;"></i>
                                                            <?php echo $kelas['jumlah_mahasiswa']; ?>
                                                        </span>
                                                    </td>
                                                    <td style="padding: 18px 20px; border-top: 1px solid var(--border-color); vertical-align: middle; text-align: center;">
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="nilai.php?kelas_id=<?php echo $kelas['id']; ?>" 
                                                               class="btn btn-primary" 
                                                               title="Input Nilai"
                                                               style="padding: 8px 12px; border-radius: 8px 0 0 8px;">
                                                                <i class="fas fa-star"></i>
                                                            </a>
                                                            <a href="presensi.php?kelas_id=<?php echo $kelas['id']; ?>" 
                                                               class="btn btn-success" 
                                                               title="Presensi"
                                                               style="padding: 8px 12px; border-radius: 0 8px 8px 0;">
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center" style="padding: 60px 20px; border-top: 1px solid var(--border-color);">
                                                    <i class="fas fa-inbox" style="font-size: 64px; opacity: 0.2; color: var(--text-muted); margin-bottom: 20px;"></i>
                                                    <p style="font-size: 16px; color: var(--text-muted); margin: 0;">Belum ada kelas yang diampu untuk semester ini</p>
                                                    <p style="font-size: 12px; color: var(--text-muted); margin-top: 5px;">Silakan hubungi admin untuk penugasan kelas</p>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Kanan -->
                <div class="col-xl-4 col-lg-12 mb-4">
                    <!-- Statistik & Info Card -->
                    <div class="card mb-4" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                        <div class="card-body" style="padding: 20px;">
                            <h6 style="font-weight: 700; margin-bottom: 15px; color: var(--text-primary); font-size: 14px;">
                                <i class="fas fa-chart-line" style="color: var(--primary-blue);"></i> Statistik Pengajaran
                            </h6>
                            
                            <!-- Completion Rate -->
                            <div style="margin-bottom: 15px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <span style="font-size: 12px; color: var(--text-secondary); font-weight: 500;">Materi Terselesaikan</span>
                                    <span style="font-size: 13px; font-weight: 700; color: var(--primary-blue);">85%</span>
                                </div>
                                <div style="background: #E5E7EB; border-radius: 10px; height: 6px; overflow: hidden;">
                                    <div style="background: linear-gradient(90deg, #0066FF 0%, #0052CC 100%); height: 100%; width: 85%; transition: width 0.3s;"></div>
                                </div>
                            </div>

                            <!-- Attendance Rate -->
                            <div style="margin-bottom: 15px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <span style="font-size: 12px; color: var(--text-secondary); font-weight: 500;">Kehadiran Mahasiswa</span>
                                    <span style="font-size: 13px; font-weight: 700; color: var(--primary-green);">92%</span>
                                </div>
                                <div style="background: #E5E7EB; border-radius: 10px; height: 6px; overflow: hidden;">
                                    <div style="background: linear-gradient(90deg, #06D6A0 0%, #059669 100%); height: 100%; width: 92%; transition: width 0.3s;"></div>
                                </div>
                            </div>

                            <!-- Assignment Submission -->
                            <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color);">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <span style="font-size: 12px; color: var(--text-secondary); font-weight: 500;">Pengumpulan Tugas</span>
                                    <span style="font-size: 13px; font-weight: 700; color: var(--primary-orange);">78%</span>
                                </div>
                                <div style="background: #E5E7EB; border-radius: 10px; height: 6px; overflow: hidden;">
                                    <div style="background: linear-gradient(90deg, #F59E0B 0%, #D97706 100%); height: 100%; width: 78%; transition: width 0.3s;"></div>
                                </div>
                            </div>

                            <!-- Quick Stats Inline -->
                            <div style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); padding: 15px; border-radius: 12px; color: white; text-align: center;">
                                <i class="fas fa-calendar-check" style="font-size: 24px; opacity: 0.9; margin-bottom: 8px;"></i>
                                <h4 style="font-size: 28px; font-weight: 700; margin: 0; line-height: 1;">14</h4>
                                <p style="font-size: 11px; opacity: 0.9; margin: 4px 0 0 0;">Pertemuan Tersisa • Semester Ganjil 2026/2027</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pengumuman Terbaru -->
                    <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                        <div class="card-header" style="background: white; border-bottom: 1px solid var(--border-color); padding: 15px 20px;">
                            <h6 style="font-weight: 700; margin: 0; color: var(--text-primary); font-size: 14px;">
                                <i class="fas fa-bullhorn" style="color: var(--primary-orange);"></i> Pengumuman Terkini
                            </h6>
                        </div>
                        <div class="card-body" style="padding: 15px; max-height: 280px; overflow-y: auto;">
                            <!-- Announcement 1 -->
                            <div style="padding-bottom: 12px; margin-bottom: 12px; border-bottom: 1px solid var(--border-color);">
                                <div style="display: flex; align-items: start; gap: 8px;">
                                    <div style="width: 6px; height: 6px; background: var(--primary-red); border-radius: 50%; margin-top: 5px; flex-shrink: 0;"></div>
                                    <div style="flex: 1;">
                                        <span class="badge badge-danger" style="font-size: 8px; margin-bottom: 4px; padding: 2px 6px;">PENTING</span>
                                        <div style="font-weight: 600; font-size: 12px; color: var(--text-primary); margin-bottom: 4px; line-height: 1.3;">Pengumpulan Nilai Tengah Semester</div>
                                        <div style="font-size: 10px; color: var(--text-muted); margin-bottom: 4px; line-height: 1.4;">Batas pengumpulan nilai UTS paling lambat 25 Juli 2026.</div>
                                        <div style="font-size: 9px; color: var(--text-muted);">
                                            <i class="far fa-clock"></i> 3 jam lalu
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Announcement 2 -->
                            <div style="padding-bottom: 12px; margin-bottom: 12px; border-bottom: 1px solid var(--border-color);">
                                <div style="display: flex; align-items: start; gap: 8px;">
                                    <div style="width: 6px; height: 6px; background: var(--primary-blue); border-radius: 50%; margin-top: 5px; flex-shrink: 0;"></div>
                                    <div style="flex: 1;">
                                        <span class="badge badge-primary" style="font-size: 8px; margin-bottom: 4px; padding: 2px 6px;">INFO</span>
                                        <div style="font-weight: 600; font-size: 12px; color: var(--text-primary); margin-bottom: 4px; line-height: 1.3;">Workshop Metode Pembelajaran Modern</div>
                                        <div style="font-size: 10px; color: var(--text-muted); margin-bottom: 4px; line-height: 1.4;">Diselenggarakan pada 28 Juli 2026 di Auditorium Utama.</div>
                                        <div style="font-size: 9px; color: var(--text-muted);">
                                            <i class="far fa-clock"></i> Kemarin
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Announcement 3 -->
                            <div style="padding-bottom: 0;">
                                <div style="display: flex; align-items: start; gap: 8px;">
                                    <div style="width: 6px; height: 6px; background: var(--primary-green); border-radius: 50%; margin-top: 5px; flex-shrink: 0;"></div>
                                    <div style="flex: 1;">
                                        <span class="badge badge-success" style="font-size: 8px; margin-bottom: 4px; padding: 2px 6px;">AGENDA</span>
                                        <div style="font-weight: 600; font-size: 12px; color: var(--text-primary); margin-bottom: 4px; line-height: 1.3;">Rapat Koordinasi Dosen</div>
                                        <div style="font-size: 10px; color: var(--text-muted); margin-bottom: 4px; line-height: 1.4;">Evaluasi proses pembelajaran semester ganjil 2026/2027.</div>
                                        <div style="font-size: 9px; color: var(--text-muted);">
                                            <i class="far fa-clock"></i> 2 hari lalu
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="background: rgba(0, 102, 255, 0.05); border-top: 1px solid var(--border-color); padding: 10px 15px; text-align: center;">
                            <a href="pengumuman.php" style="font-size: 11px; color: var(--primary-blue); text-decoration: none; font-weight: 600;">
                                Lihat Semua Pengumuman <i class="fas fa-arrow-right" style="font-size: 9px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Mengajar Minggu Ini -->
            <div class="row">
                <div class="col-12">
                    <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                        <div class="card-header" style="background: white; border-bottom: 2px solid var(--border-color); padding: 20px 25px;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h5 style="font-weight: 700; margin: 0; color: var(--text-primary);">
                                        <i class="fas fa-calendar-week" style="color: var(--primary-blue);"></i> Jadwal Mengajar Minggu Ini
                                    </h5>
                                    <p style="font-size: 12px; color: var(--text-muted); margin: 5px 0 0 0;">23 - 27 Juli 2026</p>
                                </div>
                                <a href="jadwal.php" class="btn btn-primary btn-sm" style="border-radius: 8px; font-weight: 600; padding: 8px 20px;">
                                    <i class="fas fa-calendar-alt"></i> Lihat Kalender Lengkap
                                </a>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 25px;">
                            <div class="row">
                                <?php if (count($kelasDiajar) > 0): ?>
                                    <?php 
                                    $hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                                    $kelas_per_hari = [];
                                    foreach ($kelasDiajar as $kelas) {
                                        $hari = $kelas['hari'];
                                        if (!isset($kelas_per_hari[$hari])) {
                                            $kelas_per_hari[$hari] = [];
                                        }
                                        $kelas_per_hari[$hari][] = $kelas;
                                    }
                                    
                                    foreach ($hari_list as $hari): 
                                        $is_today = ($hari == 'Kamis'); // Hari ini Kamis
                                    ?>
                                        <div class="col-xl col-lg-2-4 col-md-4 col-sm-6 mb-3">
                                            <div style="padding: 16px; background: <?php echo $is_today ? 'linear-gradient(135deg, rgba(0, 102, 255, 0.1) 0%, rgba(0, 102, 255, 0.05) 100%)' : 'rgba(0,0,0,0.02)'; ?>; border-radius: 12px; border-left: 4px solid <?php echo $is_today ? 'var(--primary-blue)' : 'var(--border-color)'; ?>; min-height: 180px; height: 100%;">
                                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                                    <h6 style="font-weight: 700; margin: 0; color: var(--text-primary); font-size: 13px;"><?php echo $hari; ?></h6>
                                                    <?php if ($is_today): ?>
                                                        <span class="badge badge-primary" style="font-size: 8px; padding: 3px 8px;">HARI INI</span>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <?php if (isset($kelas_per_hari[$hari]) && count($kelas_per_hari[$hari]) > 0): ?>
                                                    <?php foreach ($kelas_per_hari[$hari] as $kelas): ?>
                                                        <div style="background: white; padding: 10px; border-radius: 8px; margin-bottom: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                                                            <div style="font-size: 10px; color: var(--primary-blue); font-weight: 700; margin-bottom: 4px;">
                                                                <?php echo $kelas['kode_matkul']; ?>
                                                            </div>
                                                            <div style="font-size: 11px; font-weight: 600; color: var(--text-primary); margin-bottom: 6px; line-height: 1.3;">
                                                                <?php echo strlen($kelas['nama_matkul']) > 25 ? substr($kelas['nama_matkul'], 0, 25) . '...' : $kelas['nama_matkul']; ?>
                                                            </div>
                                                            <div style="font-size: 10px; color: var(--text-muted); margin-bottom: 3px;">
                                                                <i class="far fa-clock" style="color: var(--primary-green); margin-right: 3px;"></i>
                                                                <?php echo substr($kelas['jam_mulai'], 0, 5); ?>-<?php echo substr($kelas['jam_selesai'], 0, 5); ?>
                                                            </div>
                                                            <div style="font-size: 10px; color: var(--text-muted);">
                                                                <i class="fas fa-door-open" style="color: var(--primary-orange); margin-right: 3px;"></i>
                                                                <?php echo $kelas['ruangan']; ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <div style="text-align: center; padding: 25px 10px; opacity: 0.5;">
                                                        <i class="fas fa-coffee" style="font-size: 28px; color: var(--text-muted); margin-bottom: 8px;"></i>
                                                        <p style="font-size: 10px; color: var(--text-muted); margin: 0;">Tidak ada jadwal</p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="col-12">
                                        <div style="text-align: center; padding: 60px 20px;">
                                            <i class="fas fa-calendar-times" style="font-size: 64px; opacity: 0.2; color: var(--text-muted); margin-bottom: 20px;"></i>
                                            <p style="font-size: 16px; color: var(--text-muted); margin: 0;">Belum ada jadwal mengajar untuk minggu ini</p>
                                            <p style="font-size: 12px; color: var(--text-muted); margin-top: 5px;">Silakan hubungi admin untuk penugasan jadwal</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
