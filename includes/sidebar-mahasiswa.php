<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL; ?>/mahasiswa/index.php" class="brand-link text-center">
        <span class="brand-text font-weight-bold"><?php echo APP_NAME; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_nama']); ?>&background=06D6A0&color=fff&bold=true&size=128" 
                     class="img-circle elevation-2" 
                     alt="Mahasiswa Avatar" 
                     style="width: 40px; height: 40px;">
            </div>
            <div class="info">
                <a href="<?php echo BASE_URL; ?>/profile.php" class="d-block">
                    <?php echo $_SESSION['user_nama']; ?>
                    <br><small><?php echo $_SESSION['user_nim']; ?></small>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/mahasiswa/index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">AKADEMIK</li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/mahasiswa/krs.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'krs.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>KRS Saya</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/mahasiswa/jadwal.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'jadwal.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Jadwal Kuliah</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/mahasiswa/nilai.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'nilai.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-star"></i>
                        <p>Nilai & Transkrip</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/mahasiswa/presensi.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'presensi.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>Presensi</p>
                    </a>
                </li>

                <li class="nav-header">PERKULIAHAN</li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/mahasiswa/materi.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'materi.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Materi Kuliah</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/mahasiswa/tugas.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'tugas.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Tugas</p>
                    </a>
                </li>

                <li class="nav-header">KEUANGAN</li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/mahasiswa/pembayaran.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'pembayaran.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>Pembayaran UKT</p>
                    </a>
                </li>

                <li class="nav-header">INFORMASI</li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/mahasiswa/pengumuman.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'pengumuman.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Pengumuman</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
