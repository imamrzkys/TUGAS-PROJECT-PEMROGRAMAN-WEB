<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/helpers.php';

// Destroy session
session_destroy();

// Redirect to login
setFlash('success', 'Anda telah logout');
redirect('/login.php');
