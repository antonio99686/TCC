<?php

declare(strict_types=1);
$configFile = __DIR__ . '/../config.php';
if (!is_file($configFile)) {
    http_response_code(503);
    exit('Configuração ausente. Copie config.example.php para config.php.');
}
$config = require $configFile;
date_default_timezone_set($config['timezone'] ?? 'America/Sao_Paulo');
ini_set('display_errors', '0');
ini_set('log_errors', '1');
if (PHP_SAPI !== 'cli') {
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('X-Frame-Options: DENY');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') header('Strict-Transport-Security: max-age=31536000');
}
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('SENTINELA_SESSION');
    session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off', 'httponly' => true, 'samesite' => 'Lax']);
    session_start();
}
function db(): PDO
{
    static $db = null;
    global $config;
    if ($db) return $db;
    $c = $config['db'];
    $db = new PDO('mysql:host=' . $c['host'] . ';port=' . (int)$c['port'] . ';dbname=' . $c['name'] . ';charset=utf8mb4', $c['user'], $c['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false]);
    return $db;
}
function h(mixed $x): string
{
    return htmlspecialchars((string)$x, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function url(string $page = 'dashboard'): string
{
    return 'index.php?page=' . rawurlencode($page);
}
function go(string $page = 'dashboard'): never
{
    header('Location: ' . url($page), true, 303);
    exit;
}
function me(): ?array
{
    return $_SESSION['user'] ?? null;
}
function admin(): bool
{
    return (me()['role'] ?? '') === 'coordenador';
}
function require_auth(): void
{
    if (!me()) go('login');
}
function require_admin(): void
{
    require_auth();
    if (!admin()) {
        http_response_code(403);
        exit('Acesso não autorizado.');
    }
}
function csrf_token(): string
{
    return $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
}
function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . h(csrf_token()) . '">';
}
function csrf_check(): void
{
    if (!hash_equals(csrf_token(), (string)($_POST['csrf'] ?? ''))) {
        http_response_code(419);
        exit('Sessão de formulário inválida. Recarregue a página.');
    }
}
function flash(string $message, string $type = 'success'): void
{
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}
function receive_flash(): ?array
{
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}
function q(string $sql, array $params = []): PDOStatement
{
    $s = db()->prepare($sql);
    $s->execute($params);
    return $s;
}
function countq(string $sql, array $params = []): int
{
    return (int)q($sql, $params)->fetchColumn();
}
function valid_date(string $date): bool
{
    $dt = DateTimeImmutable::createFromFormat('!Y-m-d', $date);
    return $dt !== false && $dt->format('Y-m-d') === $date;
}
function valid_month(string $month): bool
{
    return preg_match('/^\d{4}-(0[1-9]|1[0-2])$/D', $month) === 1;
}
function money(float $n): string
{
    return 'R$ ' . number_format($n, 2, ',', '.');
}
function nav(): array
{
    return ['dashboard' => 'Visão geral', 'calendario' => 'Calendário', 'eventos' => 'Ensaios e eventos', 'avisos' => 'Mural de avisos', 'integrantes' => 'Integrantes', 'mensalidades' => 'Mensalidades', 'figurinos' => 'Figurinos', 'perfil' => 'Meu perfil'];
}
function render_header(string $title): void
{
    global $config;
    $u = me();
    $page = $_GET['page'] ?? 'dashboard';
    $msg = receive_flash(); ?>
    <!doctype html>
    <html lang="pt-BR">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
        <meta name="theme-color" content="#102d29">
        <meta name="description" content="Gestão da invernada Sentinela da Fronteira">
        <title><?= h($title) ?> | Sentinela da Fronteira</title>
        <link rel="stylesheet" href="assets/app.css">
    </head>

    <body>
        <div class="app-shell">
            <aside class="sidebar" id="sidebar"><a class="brand" href="<?= url() ?>"><span class="brand-mark">✦</span><span><strong>Sentinela</strong><small>da Fronteira • Gestão</small></span></a>
                <div class="side-label">MENU PRINCIPAL</div>
                <nav aria-label="Menu principal"><?php foreach (nav() as $slug => $label): if (!admin() && $slug === 'integrantes') continue; ?><a class="nav-link <?= ($page === $slug ? 'active' : '') ?>" href="<?= url($slug) ?>"><span class="nav-symbol"><?= (['dashboard' => '◫', 'calendario' => '▦', 'eventos' => '♧', 'avisos' => '☷', 'integrantes' => '♙', 'mensalidades' => '◈', 'figurinos' => '♜', 'perfil' => '◉'][$slug]) ?></span><?= h($label) ?></a><?php endforeach; ?></nav>
                <div class="sidebar-footer"><span class="status-dot"></span> Sistema de gestão v2.0</div>
            </aside>
            <div class="main-wrap">
                <header class="topbar"><button type="button" class="icon-btn menu-toggle" id="menuToggle" aria-label="Abrir menu" aria-expanded="false">☰</button>
                    <div><small>PTG • Invernada Artística</small><strong><?= h($title) ?></strong></div>
                    <div class="top-actions"><span class="user-chip"><?= h($u['name'] ?? '') ?> <small><?= admin() ? 'Coordenação' : 'Integrante' ?></small></span><a href="<?= url('logout') ?>" class="btn btn-ghost">Sair</a></div>
                </header>
                <main class="content"><?php if ($msg): ?><div class="alert <?= h($msg['type']) ?>" role="status"><?= h($msg['message']) ?></div><?php endif; ?>
                <?php }
            function render_footer(): void
            { ?></main>
                <footer class="footer">© <?= date('Y') ?> PTG Sentinela da Fronteira · Plataforma de gestão da invernada</footer>
            </div>
        </div>
        <div class="overlay" id="overlay"></div>
        <script src="assets/app.js" defer></script>
    </body>

    </html><?php }
