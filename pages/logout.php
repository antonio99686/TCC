<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION = [];
    session_regenerate_id(true);
    session_destroy();
    header('Location: ' . url('login'));
    exit;
}
