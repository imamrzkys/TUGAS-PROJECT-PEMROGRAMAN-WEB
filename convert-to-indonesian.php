<?php
/**
 * Script untuk mengkonversi semua file PHP dari nama kolom Inggris ke Indonesia
 */

$replacements = [
    // Tabel
    'profiles' => 'profil',
    
    // Kolom profiles -> profil
    'password_hash' => 'kata_sandi',
    'is_active' => 'aktif',
    "user['role']" => "user['peran']",
    "'role'" => "'peran'",
    '"role"' => '"peran"',
    'role' => 'peran',
    'created_at' => 'dibuat_pada',
    'updated_at' => 'diperbarui_pada',
    'author_id' => 'pembuat_id',
    
    // Kolom lainnya
    'is_published' => 'dipublikasi',
    'file_type' => 'tipe_file',
    'file_size_mb' => 'ukuran_file_mb',
    'scanned_at' => 'waktu_scan',
    'bobot_nilai' => 'bobot_nilai',
    'deadline' => 'batas_waktu',
    'va_number' => 'nomor_va',
    'paid_at' => 'dibayar_pada',
];

$excludeFiles = [
    'convert-to-indonesian.php',
    'fix-password.php',
];

$excludeDirs = [
    '.git',
    'vendor',
    'node_modules',
];

function scanDirectory($dir, $replacements, $excludeFiles, $excludeDirs) {
    $files = scandir($dir);
    $count = 0;
    
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        
        // Skip excluded directories
        if (is_dir($path)) {
            $skip = false;
            foreach ($excludeDirs as $excludeDir) {
                if (strpos($path, DIRECTORY_SEPARATOR . $excludeDir . DIRECTORY_SEPARATOR) !== false ||
                    substr($path, -strlen($excludeDir)) === $excludeDir) {
                    $skip = true;
                    break;
                }
            }
            if ($skip) continue;
            
            $count += scanDirectory($path, $replacements, $excludeFiles, $excludeDirs);
            continue;
        }
        
        // Skip non-PHP files
        if (pathinfo($file, PATHINFO_EXTENSION) !== 'php') continue;
        
        // Skip excluded files
        if (in_array($file, $excludeFiles)) continue;
        
        // Read file
        $content = file_get_contents($path);
        $original = $content;
        
        // Apply replacements
        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }
        
        // Save if changed
        if ($content !== $original) {
            file_put_contents($path, $content);
            echo "✓ Updated: $path\n";
            $count++;
        }
    }
    
    return $count;
}

echo "=== Converting PHP files to Indonesian column names ===\n\n";

$rootDir = __DIR__;
$totalUpdated = scanDirectory($rootDir, $replacements, $excludeFiles, $excludeDirs);

echo "\n=== Conversion Complete ===\n";
echo "Total files updated: $totalUpdated\n";
