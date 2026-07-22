<?php
// Script untuk fix password semua user menjadi password123

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/Database.class.php';

$db = Database::getInstance()->getConnection();

// Hash password123
$newPassword = password_hash('password123', PASSWORD_BCRYPT);

echo "Updating passwords...\n\n";

// Update semua user
$stmt = $db->prepare("UPDATE profil SET kata_sandi = ?");
$stmt->execute([$newPassword]);

echo "✓ Semua password berhasil diupdate ke: password123\n\n";

// Tampilkan daftar user
$stmt = $db->query("SELECT nim, nama_lengkap, peran FROM profil ORDER BY peran, nim");
$users = $stmt->fetchAll();

echo "Daftar User:\n";
echo str_repeat("=", 60) . "\n";
foreach ($users as $user) {
    echo sprintf("%-10s | %-30s | %s\n", $user['nim'], $user['nama_lengkap'], strtoupper($user['peran']));
}
echo str_repeat("=", 60) . "\n";
echo "\nPassword untuk semua user: password123\n";
