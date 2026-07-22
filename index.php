<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/helpers.php';

if (!isLoggedIn()) {
    redirect('/login.php');
}

$role = $_SESSION['user_role'];
redirect('/' . $role . '/index.php');
