<?php
/**
 * Database Configuration
 * Copy file ini menjadi database.php dan sesuaikan dengan environment Anda
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'siakad_kampus');
define('DB_CHARSET', 'utf8mb4');

// Atau gunakan SQLite (uncomment jika ingin pakai SQLite)
// define('DB_DRIVER', 'sqlite');
// define('DB_SQLITE_PATH', __DIR__ . '/../database/siakad.db');
