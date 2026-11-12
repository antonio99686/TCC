<?php
if (me()) go();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $cpf = preg_replace('/\D+/', '', (string)($_POST['cpf'] ?? ''));
    $password = (string)($_POST['senha'] ?? '');
    $blocked = ($_SESSION['login_block_until'] ?? 0) > time();
    if ($blocked) {
        $error = 'Muitas tentativas. Tente novamente em alguns minutos.';
    } else {
        $u = q('SELECT id,nome,cpf,senha_hash,papel,ativo FROM usuarios WHERE cpf=? LIMIT 1', [$cpf])->fetch();
        if (!$u || !$u['ativo'] || !password_verify($password, $u['senha_hash'])) {
            $_SESSION['login_fails'] = ($_SESSION['login_fails'] ?? 0) + 1;
            if ($_SESSION['login_fails'] >= 7) {
                $_SESSION['login_block_until'] = time() + 600;
                $_SESSION['login_fails'] = 0;
            }
            $error = 'CPF ou senha inválidos.';
        } else {
            session_regenerate_id(true);
            unset($_SESSION['login_fails'], $_SESSION['login_block_until']);
            $_SESSION['user'] = ['id' => (int)$u['id'], 'name' => $u['nome'], 'role' => $u['papel']];
            go();
        }
    }
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Entrar | Sentinela da Fronteira</title>
    <link rel="stylesheet" href="assets/app.css">
</head>

<body class="auth-body">
    <main class="auth-layout">
        <section class="auth-intro">
            <div class="eyebrow">✦ TRADIÇÃO E TECNOLOGIA</div>
            <h1>Nossa cultura.<br><em>Nossa história.</em><br>Nosso futuro.</h1>
            <p>Um novo jeito de organizar ensaios, eventos, integrantes e a vida da nossa invernada.</p>
            <div class="auth-decor">PTG SENTINELA DA FRONTEIRA</div>
        </section>
        <section class="auth-panel">
            <div class="auth-card">
                <div class="logo-round">✦</div>
                <h2>Bem-vindo de volta</h2>
                <p>Entre com suas credenciais para acessar a plataforma.</p><?php if ($error): ?><div class="alert error" role="alert"><?= h($error) ?></div><?php endif; ?><form method="post" class="stack"><?= csrf_field() ?><label>CPF<input name="cpf" inputmode="numeric" autocomplete="username" maxlength="14" required placeholder="000.000.000-00"></label><label>Senha<input name="senha" type="password" autocomplete="current-password" required placeholder="Sua senha"></label><button class="btn btn-primary wide" type="submit">Entrar no sistema →</button></form>
                <p class="helper">Para criar sua conta ou recuperar o acesso, procure a coordenação.</p>
            </div>
        </section>
    </main>
</body>

</html>