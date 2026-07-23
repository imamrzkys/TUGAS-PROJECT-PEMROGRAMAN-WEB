@echo off
echo ========================================
echo   SIAKAD - Restart Server Script
echo ========================================
echo.
echo Stopping existing server...
taskkill /F /IM php.exe 2>nul
timeout /t 2 /nobreak >nul
echo.
echo Starting server at localhost:8000...
echo.
echo Server is running at: http://localhost:8000
echo Test cache at: http://localhost:8000/test-cache.php
echo.
echo ========================================
echo   INSTRUKSI PENTING:
echo ========================================
echo 1. Tutup SEMUA tab browser yang buka localhost:8000
echo 2. Buka Command Prompt dan jalankan: ipconfig /flushdns
echo 3. Buka browser INCOGNITO/PRIVATE mode:
echo    - Chrome/Edge: Ctrl + Shift + N
echo    - Firefox: Ctrl + Shift + P
echo 4. Ketik: localhost:8000/test-cache.php
echo 5. Jika random number berubah tiap refresh = cache disabled!
echo 6. Lalu buka: localhost:8000
echo.
echo Press Ctrl+C to stop the server
echo ========================================
echo.

C:\xampp\php\php.exe -S localhost:8000
