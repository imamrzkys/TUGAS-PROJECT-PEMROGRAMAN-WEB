<?php
session_start();

// Disable cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/Database.class.php';

// Redirect jika sudah login
if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['user_role'];
    header("Location: /{$role}/index.php");
    exit;
}

$error = '';
$success = '';

// Process login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = trim($_POST['nim'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($nim) || empty($password)) {
        $error = 'NIM dan password wajib diisi';
    } else {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT * FROM profil WHERE nim = ? AND aktif = 1 LIMIT 1");
            $stmt->execute([$nim]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['kata_sandi'])) {
                // Login berhasil
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nim'] = $user['nim'];
                $_SESSION['user_nama'] = $user['nama_lengkap'];
                $_SESSION['user_role'] = $user['peran'];
                $_SESSION['user_email'] = $user['email'];
                
                header("Location: /{$user['peran']}/index.php");
                exit;
            } else {
                $error = 'NIM atau password salah';
            }
        } catch (Exception $e) {
            $error = 'Terjadi kesalahan sistem: ' . $e->getMessage();
        }
    }
}

// Get flash messages
if (isset($_SESSION['flash_error'])) {
    $error = $_SESSION['flash_error'];
    unset($_SESSION['flash_error']);
}
if (isset($_SESSION['flash_success'])) {
    $success = $_SESSION['flash_success'];
    unset($_SESSION['flash_success']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>SIAKAD - Login</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script>
    // Force reload if coming from cache
    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    };
    </script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 50%, #c44569 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            animation: slideUp 0.5s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        
        .login-header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .login-header p {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 15px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            color: #333;
            font-weight: 500;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff6b6b;
            font-size: 18px;
        }
        
        .form-control {
            width: 100%;
            padding: 15px 15px 15px 50px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
            background: #f8f9fa;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #ff6b6b;
            background: white;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        }
        
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.5);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .alert-danger {
            background: #fee;
            color: #c33;
            border-left: 4px solid #c33;
        }
        
        .alert-success {
            background: #efe;
            color: #3c3;
            border-left: 4px solid #3c3;
        }
        
        .demo-accounts {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px dashed #e0e0e0;
        }
        
        .demo-accounts h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 600;
        }
        
        .demo-item {
            background: #f8f9fa;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            font-size: 13px;
        }
        
        .demo-item strong {
            color: #ff6b6b;
            display: block;
            margin-bottom: 5px;
        }
        
        .demo-item code {
            background: white;
            padding: 3px 8px;
            border-radius: 5px;
            color: #333;
            font-family: 'Courier New', monospace;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #999;
        }
        
        .university-info {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        
        .university-info strong {
            display: block;
            color: #ff6b6b;
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .university-info p {
            font-size: 12px;
            color: #666;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>SIAKAD</h1>
            <p>Sistem Informasi Akademik Kampus</p>
        </div>
        
        <div class="login-body">
            <p class="subtitle">Silakan login untuk mengakses sistem</p>
            
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span><?php echo htmlspecialchars($success); ?></span>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="nim" name="nim" class="form-control" placeholder="Masukkan NIM" required autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <div class="demo-accounts">
                <h3>📝 Akun Demo untuk Testing</h3>
                <div class="demo-item">
                    <strong>Admin</strong>
                    NIM: <code>admin</code> | Password: <code>password123</code>
                </div>
                <div class="demo-item">
                    <strong>Dosen</strong>
                    NIM: <code>D001</code> | Password: <code>password123</code>
                </div>
                <div class="demo-item">
                    <strong>Mahasiswa</strong>
                    NIM: <code>M001</code> | Password: <code>password123</code>
                </div>
            </div>
            
            <div class="university-info">
                <strong>Imam Rizki Saputra</strong>
                <p>
                    NIM: 301230013<br>
                    Teknik Informatika<br>
                    Universitas Bale Bandung
                </p>
            </div>
            
            <p class="footer-text">
                © 2026 SIAKAD. Tugas Pemrograman Web.
            </p>
        </div>
    </div>
</body>
</html>
