<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/helpers.php';
require_once __DIR__ . '/models/User.php';

requireLogin();

$pageTitle = 'Ubah Password';
$user = getCurrentUser();

// Handle change password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword = $_POST['old_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
        setFlash('error', 'Semua field wajib diisi');
    } elseif ($newPassword !== $confirmPassword) {
        setFlash('error', 'Password baru dan konfirmasi tidak cocok');
    } elseif (strlen($newPassword) < 8) {
        setFlash('error', 'Password minimal 8 karakter');
    } else {
        $userModel = new User();
        $result = $userModel->updatePassword($user['id'], $oldPassword, $newPassword);
        
        if ($result['success']) {
            setFlash('success', $result['message']);
        } else {
            setFlash('error', $result['message']);
        }
    }
    redirect('/change-password.php');
}

$role = $user['role'];
$sidebarFile = __DIR__ . '/includes/sidebar-' . $role . '.php';

include __DIR__ . '/includes/header.php';
include $sidebarFile;
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/<?php echo $role; ?>/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Ubah Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <?php if ($success = getFlash('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="icon fas fa-check"></i> <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <?php if ($error = getFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="icon fas fa-ban"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-key"></i> Ubah Password</h3>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Password Lama</label>
                                    <input type="password" name="old_password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" name="new_password" class="form-control" required minlength="8">
                                    <small class="text-muted">Minimal 8 karakter</small>
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="password" name="confirm_password" class="form-control" required minlength="8">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Ubah Password
                                </button>
                                <a href="/profile.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
