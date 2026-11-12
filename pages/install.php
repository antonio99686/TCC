<?php
declare(strict_types=1);
// Configuracao inicial: somente quando NENHUM usuario existe.
if (me()) go();
$error = '';
try {
    $totalUsuarios = countq('SELECT COUNT(*) FROM usuarios');
} catch (PDOException $e) {
    http_response_code(503);
    exit('Banco indisponivel. Importe sql/01_schema.sql e configure config.php antes de continuar.');
}
if ($totalUsuarios !== 0) {
    http_response_code(403);
    $installClosed = true;
} else {
    $installClosed = false;
}
if (!$installClosed && $_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $name = trim((string)($_POST['nome'] ?? ''));
    $cpf = preg_replace('/\D+/', '', (string)($_POST['cpf'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['senha'] ?? '');
    $confirm = (string)($_POST['confirmar_senha'] ?? '');
    if (mb_strlen($name) < 3 || mb_strlen($name) > 160 || strlen($cpf) !== 11 || !preg_match('/^\d{11}$/', $cpf)) {
        $error = 'Informe nome completo e CPF com 11 digitos.';
    } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Informe um e-mail valido.';
    } elseif (strlen($password) < 12 || $password !== $confirm) {
        $error = 'Use senha com pelo menos 12 caracteres e confirme corretamente.';
    } else {
        // Bloqueio no MySQL para impedir dois cadastros iniciais simultaneos.
        $pdo = db();
        $locked = false;
        try {
            $locked = (int)$pdo->query("SELECT GET_LOCK('sentinela_first_admin_install', 5)")->fetchColumn() === 1;
            if (!$locked) {
                $error = 'Cadastro ocupado. Tente novamente.';
            } elseif (countq('SELECT COUNT(*) FROM usuarios') > 0) {
                $installClosed = true;
                http_response_code(403);
            } else {
                q("INSERT INTO usuarios (nome,cpf,email,senha_hash,papel,ativo) VALUES (?,?,?,?,'coordenador',1)", [
                    $name, $cpf, $email !== '' ? $email : null, password_hash($password, PASSWORD_DEFAULT)
                ]);
                flash('Primeiro coordenador cadastrado! Entre com seu CPF e senha.');
                go('login');
            }
        } catch (PDOException $e) {
            $error = 'Nao foi possivel salvar. Confira os dados e a conexao com o banco.';
        } finally {
            if ($locked) $pdo->query("SELECT RELEASE_LOCK('sentinela_first_admin_install')");
        }
    }
}
?><!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="theme-color" content="#102d29"><title>Primeiro acesso | Sentinela</title><link rel="icon" type="image/png" href="assets/favicon.png"><link rel="stylesheet" href="assets/app.css"></head>
<body class="auth-body"><main class="auth-layout">
<section class="auth-intro"><img class="auth-intro-logo" src="assets/logo-sentinela.png" alt="Brasão oficial do PTG Sentinela da Fronteira" width="180" height="228"><div class="eyebrow">✦ CONFIGURACAO INICIAL</div><h1>Sentinela<br><em>da Fronteira.</em></h1><p>Cadastre o primeiro coordenador para iniciar a gestao da invernada.</p><div class="auth-decor">PTG SENTINELA DA FRONTEIRA</div></section>
<section class="auth-panel"><div class="auth-card"><img class="auth-logo" src="assets/logo-sentinela.png" alt="Brasão do PTG Sentinela da Fronteira" width="100" height="126">
<?php if ($installClosed): ?>
<h2>Cadastro inicial encerrado</h2><p>O sistema ja possui usuarios. Para cadastrar novos coordenadores, entre com uma conta de coordenacao e acesse Integrantes.</p><a href="<?=h(url('login'))?>" class="btn btn-primary wide">Ir para o login</a>
<?php else: ?>
<h2>Criar primeiro administrador</h2><p>Esta pagina fica indisponivel automaticamente apos a criacao da primeira conta.</p>
<?php if ($error !== ''): ?><div class="alert error" role="alert"><?=h($error)?></div><?php endif; ?>
<form method="post" class="stack" autocomplete="on"><?=csrf_field()?>
<label>Nome completo<input name="nome" maxlength="160" autocomplete="name" value="<?=h($_POST['nome']??'')?>" required></label>
<label>CPF<input name="cpf" inputmode="numeric" maxlength="14" autocomplete="username" placeholder="Somente numeros" value="<?=h($_POST['cpf']??'')?>" required></label>
<label>E-mail (opcional)<input type="email" name="email" maxlength="190" autocomplete="email" value="<?=h($_POST['email']??'')?>"></label>
<label>Senha de administrador<input name="senha" type="password" minlength="12" autocomplete="new-password" required></label>
<label>Confirme a senha<input name="confirmar_senha" type="password" minlength="12" autocomplete="new-password" required></label>
<button type="submit" class="btn btn-primary wide">Criar administrador</button></form>
<p class="helper">Guarde sua senha em local seguro. Depois do cadastro, utilize a pagina de login.</p>
<?php endif; ?>
</div></section></main></body></html>
