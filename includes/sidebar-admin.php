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

                <li class="nav-header">INFORMASI</li>

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="alert('Total Mahasiswa: 4\nTotal Dosen: 3\nTotal Kelas: 6'); return false;">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>Info Sistem</p>
                    </a>
                </li>

                <li class="nav-header">AKUN</li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/profile.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/change-password.php" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Ubah Password</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/logout.php" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
