<?php
/**
 * Application Configuration
 */

// Start session jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Base URL Configuration
define('BASE_URL', 'http://localhost:8000');
define('BASE_PATH', dirname(__DIR__));

// Application Settings
define('APP_NAME', 'SIAKAD Kampus');
define('APP_VERSION', '1.0.0');
define('APP_DESCRIPTION', 'Sistem Informasi Akademik Kampus');
define('APP_AUTHOR', 'Tugas Akhir Pemrograman Web');

// Security Settings
define('JWT_SECRET', 'your-secret-key-here-change-in-production');
define('JWT_EXPIRY', 86400 * 7); // 7 days

// Upload Settings
define('UPLOAD_PATH', BASE_PATH . '/uploads');
define('UPLOAD_MAX_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'ppt', 'pptx']);

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Error Reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoload Database
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/config/Database.class.php';
