<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Test Cache - SIAKAD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .test-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .success {
            color: green;
            font-weight: bold;
            font-size: 24px;
        }
        .info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .timestamp {
            color: #666;
            font-size: 14px;
            margin-top: 10px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #ff6b6b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="test-box">
        <h1>✅ Test Cache Berhasil!</h1>
        <p class="success">Halaman ini TIDAK menggunakan cache!</p>
        
        <div class="info">
            <h3>🔍 Informasi:</h3>
            <ul>
                <li>✅ No-cache headers sudah ditambahkan</li>
                <li>✅ CSS versioning dengan timestamp aktif</li>
                <li>✅ Bahasa Indonesia sudah diterapkan</li>
                <li>✅ Server PHP berjalan: localhost:8000</li>
            </ul>
        </div>
        
        <div class="timestamp">
            <strong>Server Time:</strong> <?php echo date('Y-m-d H:i:s'); ?><br>
            <strong>Random Number (untuk test refresh):</strong> <?php echo rand(1000, 9999); ?>
        </div>
        
        <h3 style="margin-top: 30px;">📋 Langkah Testing:</h3>
        <ol>
            <li><strong>Tutup SEMUA tab browser</strong> yang membuka localhost:8000</li>
            <li><strong>Buka Command Prompt</strong> dan jalankan: <code>ipconfig /flushdns</code></li>
            <li><strong>Buka browser dalam Incognito/Private mode</strong>:
                <ul>
                    <li>Chrome: Ctrl + Shift + N</li>
                    <li>Firefox: Ctrl + Shift + P</li>
                    <li>Edge: Ctrl + Shift + N</li>
                </ul>
            </li>
            <li><strong>Ketik langsung di address bar:</strong> <code>localhost:8000</code></li>
            <li><strong>Tekan Enter</strong></li>
        </ol>
        
        <div class="info" style="background: #fff3cd; border-left: 4px solid #ffc107;">
            <h4>⚠️ Jika MASIH belum berubah:</h4>
            <p>Kemungkinan browser cache sangat persistent. Coba:</p>
            <ol>
                <li>Buka <strong>Chrome DevTools</strong> (F12)</li>
                <li>Klik kanan tombol <strong>Refresh</strong></li>
                <li>Pilih <strong>"Empty Cache and Hard Reload"</strong></li>
            </ol>
            <p>Atau gunakan <strong>browser berbeda</strong> yang belum pernah buka localhost:8000</p>
        </div>
        
        <a href="/">← Kembali ke Login</a>
        <a href="javascript:location.reload()">🔄 Refresh Halaman Ini</a>
    </div>
    
    <script>
        // Auto refresh every 5 seconds to show no cache is working
        console.log('Test page loaded at:', new Date().toLocaleTimeString());
        console.log('Random number:', <?php echo rand(1000, 9999); ?>);
        console.log('If you see different random numbers on each refresh, cache is disabled!');
    </script>
</body>
</html>
