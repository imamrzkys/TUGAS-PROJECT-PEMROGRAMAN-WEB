<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/helpers.php';
require_once __DIR__ . '/models/User.php';

requireLogin();

$pageTitle = 'Profil Saya';
$user = getCurrentUser();

$userModel = new User();
$userDetail = $userModel->findById($user['id']);

// Handle update profile
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $data = [
        'nama_lengkap' => sanitize($_POST['nama_lengkap']),
        'email' => sanitize($_POST['email']),
        'telepon' => sanitize($_POST['telepon']),
        'alamat' => sanitize($_POST['alamat'])
    ];
    
    $result = $userModel->updateProfile($user['id'], $data);
    
    if ($result['success']) {
        $_SESSION['user_nama'] = $data['nama_lengkap'];
        $_SESSION['user_email'] = $data['email'];
        setFlash('success', $result['message']);
    } else {
        setFlash('error', $result['message']);
    }
    redirect('/profile.php');
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
                    <h1 class="m-0">Profil Saya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/<?php echo $role; ?>/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profil</li>
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
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <i class="fas fa-user-circle fa-5x text-primary"></i>
                            </div>
                            <h3 class="profile-username text-center"><?php echo $userDetail['nama_lengkap']; ?></h3>
                            <p class="text-muted text-center">
                                <?php echo ucfirst($userDetail['role']); ?><br>
                                <?php echo $userDetail['nim']; ?>
                            </p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Program Studi</b> <span class="float-right"><?php echo $userDetail['program_studi'] ?? '-'; ?></span>
                                </li>
                                <?php if ($userDetail['role'] == 'mahasiswa'): ?>
                                <li class="list-group-item">
                                    <b>Angkatan</b> <span class="float-right"><?php echo $userDetail['angkatan'] ?? '-'; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Semester</b> <span class="float-right"><?php echo $userDetail['semester_aktif'] ?? '-'; ?></span>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Edit Profil</h3>
                        </div>
                        <form method="POST">
                            <input type="hidden" name="action" value="update">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>NIM</label>
                                    <input type="text" class="form-control" value="<?php echo $userDetail['nim']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $userDetail['nama_lengkap']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $userDetail['email']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input type="text" name="telepon" class="form-control" value="<?php echo $userDetail['telepon']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3"><?php echo $userDetail['alamat']; ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="/change-password.php" class="btn btn-warning">
                                    <i class="fas fa-key"></i> Ubah Password
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
