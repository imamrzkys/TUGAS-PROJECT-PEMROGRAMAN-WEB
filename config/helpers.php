<?php
/**
 * Helper Functions
 */

/**
 * Redirect ke URL tertentu
 */
function redirect($path) {
    header("Location: " . BASE_URL . $path);
    exit;
}

/**
 * Cek apakah user sudah login
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Cek role user
 */
function checkRole($allowedRoles) {
    if (!isLoggedIn()) {
        return false;
    }
    
    if (!is_array($allowedRoles)) {
        $allowedRoles = [$allowedRoles];
    }
    
    return in_array($_SESSION['user_role'], $allowedRoles);
}

/**
 * Require login - redirect jika belum login
 */
function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['flash_error'] = 'Silakan login terlebih dahulu';
        redirect('/login.php');
    }
}

/**
 * Require role - redirect jika role tidak sesuai
 */
function requireRole($allowedRoles) {
    requireLogin();
    
    if (!checkRole($allowedRoles)) {
        $_SESSION['flash_error'] = 'Akses ditolak';
        redirect('/index.php');
    }
}

/**
 * Get current user data
 */
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'id' => $_SESSION['user_id'],
        'nim' => $_SESSION['user_nim'],
        'nama' => $_SESSION['user_nama'],
        'role' => $_SESSION['user_role'],
        'email' => $_SESSION['user_email'] ?? null
    ];
}

/**
 * Set flash message
 */
function setFlash($type, $message) {
    $_SESSION['flash_' . $type] = $message;
}

/**
 * Get and clear flash message
 */
function getFlash($type) {
    if (isset($_SESSION['flash_' . $type])) {
        $message = $_SESSION['flash_' . $type];
        unset($_SESSION['flash_' . $type]);
        return $message;
    }
    return null;
}

/**
 * Sanitize input
 */
function sanitize($input) {
    if (is_array($input)) {
        return array_map('sanitize', $input);
    }
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Format tanggal Indonesia
 */
function formatTanggalIndo($date) {
    if (empty($date)) return '-';
    
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    $timestamp = strtotime($date);
    $hari = date('d', $timestamp);
    $bulanNum = date('n', $timestamp);
    $tahun = date('Y', $timestamp);
    
    return $hari . ' ' . $bulan[$bulanNum] . ' ' . $tahun;
}

/**
 * Format Rupiah
 */
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

/**
 * Hitung IPK dari array nilai
 */
function hitungIPK($nilaiArray) {
    if (empty($nilaiArray)) return 0;
    
    $totalBobotNilai = 0;
    $totalSKS = 0;
    
    foreach ($nilaiArray as $nilai) {
        $bobotNilai = getNilaiBobot($nilai['nilai_akhir']);
        $totalBobotNilai += ($bobotNilai * $nilai['sks']);
        $totalSKS += $nilai['sks'];
    }
    
    if ($totalSKS == 0) return 0;
    
    return round($totalBobotNilai / $totalSKS, 2);
}

/**
 * Konversi nilai angka ke grade
 */
function getNilaiGrade($nilai) {
    if ($nilai >= 85) return 'A';
    if ($nilai >= 80) return 'A-';
    if ($nilai >= 75) return 'B+';
    if ($nilai >= 70) return 'B';
    if ($nilai >= 65) return 'B-';
    if ($nilai >= 60) return 'C+';
    if ($nilai >= 55) return 'C';
    if ($nilai >= 40) return 'D';
    return 'E';
}

/**
 * Konversi nilai angka ke bobot
 */
function getNilaiBobot($nilai) {
    if ($nilai >= 85) return 4.0;
    if ($nilai >= 80) return 3.7;
    if ($nilai >= 75) return 3.3;
    if ($nilai >= 70) return 3.0;
    if ($nilai >= 65) return 2.7;
    if ($nilai >= 60) return 2.3;
    if ($nilai >= 55) return 2.0;
    if ($nilai >= 40) return 1.0;
    return 0;
}

/**
 * Upload file
 */
function uploadFile($file, $directory = 'general') {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Tidak ada file yang diupload'];
    }
    
    // Validasi ukuran
    if ($file['size'] > UPLOAD_MAX_SIZE) {
        return ['success' => false, 'message' => 'Ukuran file terlalu besar (max 5MB)'];
    }
    
    // Validasi extension
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ALLOWED_EXTENSIONS)) {
        return ['success' => false, 'message' => 'Tipe file tidak diizinkan'];
    }
    
    // Generate unique filename
    $filename = uniqid() . '_' . time() . '.' . $extension;
    $uploadDir = UPLOAD_PATH . '/' . $directory;
    
    // Create directory if not exists
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $destination = $uploadDir . '/' . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return [
            'success' => true,
            'filename' => $filename,
            'path' => '/uploads/' . $directory . '/' . $filename
        ];
    }
    
    return ['success' => false, 'message' => 'Gagal mengupload file'];
}

/**
 * JSON Response
 */
function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

/**
 * Debug helper
 */
function dd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}
