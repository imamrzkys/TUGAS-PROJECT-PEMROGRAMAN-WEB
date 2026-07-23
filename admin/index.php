<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Kelas.php';
require_once __DIR__ . '/../models/KRS.php';

requireRole('admin');

$pageTitle = 'Admin Dashboard';
$user = getCurrentUser();

$userModel = new User();
$kelasModel = new Kelas();
$krsModel = new KRS();

// Get statistik
$totalMahasiswa = $userModel->count(['peran' => 'mahasiswa', 'aktif' => 1]);
$totalDosen = $userModel->count(['peran' => 'dosen', 'aktif' => 1]);
$totalKelas = $kelasModel->count(['aktif' => 1]);

$db = getDB();
$stmt = $db->query("SELECT COUNT(*) as total FROM krs WHERE status = 'aktif'");
$totalKRS = $stmt->fetch()['total'];

// Get total mata kuliah
$stmt2 = $db->query("SELECT COUNT(*) as total FROM mata_kuliah WHERE aktif = 1");
$totalMatkul = $stmt2->fetch()['total'];

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar-admin.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="text-muted mb-0" style="font-size: 14px;">Welcome back, here is what's happening in SIAKAD today.</p>
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

            <!-- Modern Stat Cards -->
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card stat-blue" style="cursor: pointer;" onclick="window.location.href='/admin/mahasiswa.php'">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-label">TOTAL STUDENTS</div>
                        <div class="stat-value"><?php echo number_format($totalMahasiswa); ?></div>
                        <div class="stat-change stat-up">
                            <i class="fas fa-arrow-up"></i> +12%
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card stat-green" style="cursor: pointer;" onclick="window.location.href='/admin/dosen.php'">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-label">LECTURERS</div>
                        <div class="stat-value"><?php echo number_format($totalDosen); ?></div>
                        <div class="stat-change stat-up">
                            <i class="fas fa-arrow-up"></i> +3%
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card stat-orange" style="cursor: pointer;" onclick="window.location.href='/admin/matakuliah.php'">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-label">COURSES</div>
                        <div class="stat-value"><?php echo number_format($totalMatkul); ?></div>
                        <span class="badge badge-warning mt-2"><i class="fas fa-circle"></i> Active</span>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card stat-red" style="cursor: pointer;" onclick="window.location.href='/admin/kelas.php'">
                        <div class="stat-icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div class="stat-label">ACTIVE CLASSES</div>
                        <div class="stat-value"><?php echo number_format($totalKelas); ?></div>
                        <span class="badge badge-danger mt-2"><?php echo $totalKelas; ?> Classes</span>
                    </div>
                </div>
            </div>

            <!-- Student Enrollment Trends & Quick Actions -->
            <div class="row">
                <!-- Chart Section -->
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line"></i> Student Enrollment Trends
                            </h3>
                            <div class="card-tools">
                                <select class="form-control form-control-sm" style="width: auto; display: inline-block;">
                                    <option>Last 6 Months</option>
                                    <option>Last Year</option>
                                    <option>All Time</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="height: 300px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, rgba(0, 102, 255, 0.05) 0%, rgba(0, 102, 255, 0.01) 100%); border-radius: 8px;">
                                <div class="text-center">
                                    <i class="fas fa-chart-bar" style="font-size: 48px; color: var(--primary-blue); opacity: 0.3; margin-bottom: 15px;"></i>
                                    <p class="text-muted">Chart visualization would appear here<br><small>Showing enrollment trends over time</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bolt"></i> Quick Actions
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <a href="/admin/mahasiswa.php" style="text-decoration: none; color: inherit;">
                                        <div style="background: rgba(0, 102, 255, 0.1); padding: 20px; border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(0, 102, 255, 0.2)'" onmouseout="this.style.background='rgba(0, 102, 255, 0.1)'">
                                            <i class="fas fa-user-plus" style="font-size: 28px; color: var(--primary-blue);"></i>
                                            <p style="margin-top: 10px; margin-bottom: 0; font-size: 12px; font-weight: 600;">Modify KRS</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <a href="/admin/pengumuman.php" style="text-decoration: none; color: inherit;">
                                        <div style="background: rgba(6, 214, 160, 0.1); padding: 20px; border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(6, 214, 160, 0.2)'" onmouseout="this.style.background='rgba(6, 214, 160, 0.1)'">
                                            <i class="fas fa-graduation-cap" style="font-size: 28px; color: var(--primary-green);"></i>
                                            <p style="margin-top: 10px; margin-bottom: 0; font-size: 12px; font-weight: 600;">Scholarship</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <a href="/admin/kelas.php" style="text-decoration: none; color: inherit;">
                                        <div style="background: rgba(230, 57, 70, 0.1); padding: 20px; border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(230, 57, 70, 0.2)'" onmouseout="this.style.background='rgba(230, 57, 70, 0.1)'">
                                            <i class="fas fa-file-alt" style="font-size: 28px; color: var(--primary-red);"></i>
                                            <p style="margin-top: 10px; margin-bottom: 0; font-size: 12px; font-weight: 600;">Generate<br>Transcripts</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <a href="/admin/pengumuman.php" style="text-decoration: none; color: inherit;">
                                        <div style="background: rgba(245, 158, 11, 0.1); padding: 20px; border-radius: 12px; transition: all 0.3s;" onmouseover="this.style.background='rgba(245, 158, 11, 0.2)'" onmouseout="this.style.background='rgba(245, 158, 11, 0.1)'">
                                            <i class="fas fa-bullhorn" style="font-size: 28px; color: var(--primary-orange);"></i>
                                            <p style="margin-top: 10px; margin-bottom: 0; font-size: 12px; font-weight: 600;">Broadcast</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Announcements Preview -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bullhorn"></i> Announcements
                            </h3>
                            <div class="card-tools">
                                <a href="/admin/pengumuman.php" style="font-size: 12px;">See All</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="timeline-item" style="border-left: 2px solid var(--border-color); padding-left: 20px; margin: 15px;">
                                <div style="width: 10px; height: 10px; background: var(--primary-red); border-radius: 50%; position: absolute; left: 15px; border: 2px solid white;"></div>
                                <small class="text-muted">2 HOURS AGO</small>
                                <p style="margin: 5px 0; font-weight: 600; font-size: 13px;">Graduation Registration Open</p>
                                <small class="text-muted">Deadline for registration is Oct...</small>
                            </div>
                            <div class="timeline-item" style="border-left: 2px solid var(--border-color); padding-left: 20px; margin: 15px;">
                                <div style="width: 10px; height: 10px; background: var(--primary-blue); border-radius: 50%; position: absolute; left: 15px; border: 2px solid white;"></div>
                                <small class="text-muted">YESTERDAY</small>
                                <p style="margin: 5px 0; font-weight: 600; font-size: 13px;">System Maintenance</p>
                                <small class="text-muted">Academic portal will be down t...</small>
                            </div>
                            <div class="timeline-item" style="border-left: 2px solid var(--border-color); padding-left: 20px; margin: 15px;">
                                <div style="width: 10px; height: 10px; background: var(--primary-green); border-radius: 50%; position: absolute; left: 15px; border: 2px solid white;"></div>
                                <small class="text-muted">OCT 12, 2026</small>
                                <p style="margin: 5px 0; font-weight: 600; font-size: 13px;">New Scholarship Grant</p>
                                <small class="text-muted">Available for faculty of...</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent User Activity -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-history"></i> Recent User Activity
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-warning"><i class="fas fa-circle"></i> Pending Requests</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>USER</th>
                                        <th>ACTION</th>
                                        <th>TIMESTAMP</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 35px; height: 35px; border-radius: 8px; background: var(--primary-blue); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">FA</div>
                                                <div>
                                                    <strong>Fahri Alamsyah</strong><br>
                                                    <small class="text-muted">Student (20230810)</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Course Enrollment</td>
                                        <td>Today, 14:24 PM</td>
                                        <td><span class="badge badge-primary">COMPLETED</span></td>
                                        <td><button class="btn btn-sm btn-primary">Details</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 35px; height: 35px; border-radius: 8px; background: var(--primary-green); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">LW</div>
                                                <div>
                                                    <strong>Laila Wahyuni</strong><br>
                                                    <small class="text-muted">Lecturer (L-4210)</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Grade Submission</td>
                                        <td>Today, 11:05 AM</td>
                                        <td><span class="badge badge-warning">PENDING</span></td>
                                        <td><button class="btn btn-sm btn-success">Review</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 35px; height: 35px; border-radius: 8px; background: var(--primary-purple); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">BS</div>
                                                <div>
                                                    <strong>Budi Santoso</strong><br>
                                                    <small class="text-muted">Student (20220112)</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>KRS Revision</td>
                                        <td>Yesterday, 16:45 PM</td>
                                        <td><span class="badge badge-primary">COMPLETED</span></td>
                                        <td><button class="btn btn-sm btn-primary">Details</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 35px; height: 35px; border-radius: 8px; background: var(--primary-orange); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">ID</div>
                                                <div>
                                                    <strong>Indah Dwi</strong><br>
                                                    <small class="text-muted">Admin Assistant</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>System Config Update</td>
                                        <td>Yesterday, 09:12 AM</td>
                                        <td><span class="badge badge-primary">COMPLETED</span></td>
                                        <td><button class="btn btn-sm btn-primary">Details</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="p-3 text-center border-top">
                                <small class="text-muted">Showing 4 of 25 activities</small>
                                <a href="#" class="ml-3"><i class="fas fa-arrow-right"></i></a>
                                <a href="#" class="ml-2"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Info -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="mb-0 text-muted" style="font-size: 13px;">
                                <i class="fas fa-server text-success"></i> Server: Jakarta-01 
                                <span class="mx-2">|</span>
                                <i class="fas fa-code-branch text-primary"></i> Version 2.4.1-Stable
                                <span class="mx-2">|</span>
                                © 2026 SIAKAD Modern Academic System. All rights reserved.
                            </p>
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
