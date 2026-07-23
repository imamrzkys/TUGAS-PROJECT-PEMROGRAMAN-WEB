<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL; ?>/admin/index.php" class="brand-link text-center">
        <span class="brand-text font-weight-bold"><?php echo APP_NAME; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-user-shield fa-2x text-white"></i>
            </div>
            <div class="info">
                <a href="<?php echo BASE_URL; ?>/profile.php" class="d-block">
                    <?php echo $_SESSION['user_nama']; ?>
                    <br><small>Administrator</small>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MANAJEMEN USER</li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/mahasiswa.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'mahasiswa.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Data Mahasiswa</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/dosen.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dosen.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>Data Dosen</p>
                    </a>
                </li>

                <li class="nav-header">MANAJEMEN AKADEMIK</li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/matakuliah.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'matakuliah.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>Mata Kuliah</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/kelas.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'kelas.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-school"></i>
                        <p>Kelas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/pengumuman.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'pengumuman.php' ? 'active' : ''; ?>">
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
