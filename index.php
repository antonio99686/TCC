<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require __DIR__ . '/app/bootstrap.php';
$page = (string)($_GET['page'] ?? 'dashboard');
$public = ['login', 'install'];
if (!in_array($page, $public, true)) require_auth();
$allowed = ['install', 'login', 'logout', 'dashboard', 'calendario', 'eventos', 'avisos', 'integrantes', 'mensalidades', 'figurinos', 'perfil'];
if (!in_array($page, $allowed, true)) {
    http_response_code(404);
    $page = '404';
}
require __DIR__ . '/pages/' . $page . '.php';
