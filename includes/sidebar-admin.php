<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-0">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL; ?>/admin/index.php" class="brand-link">
        <div class="brand-image" style="margin-left: 5px;">
            <i class="fas fa-graduation-cap" style="font-size: 24px; color: white;"></i>
        </div>
        <span class="brand-text">
            SIAKAD
            <span class="brand-subtext">Academic System</span>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_nama']); ?>&background=0066FF&color=fff&bold=true" alt="User Avatar" style="width: 45px; height: 45px; border-radius: 10px; border: 2px solid var(--primary-blue);">
            </div>
            <div class="info">
                <a href="#">
                    <?php echo $_SESSION['user_nama']; ?>
                    <small>System Administrator</small>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">USER MANAGEMENT</li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/mahasiswa.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'mahasiswa.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>User Management</p>
                    </a>
                </li>

                <li class="nav-header">ACADEMIC MANAGEMENT</li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/matakuliah.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'matakuliah.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>Academic Management</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/dosen.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dosen.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>Finance</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/pengumuman.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'pengumuman.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Announcements</p>
                    </a>
                </li>

                <li class="nav-header">SETTINGS</li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/change-password.php" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/logout.php" class="nav-link" style="color: var(--primary-red) !important;">
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
