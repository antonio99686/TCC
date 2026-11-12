<?php
require_admin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $name = trim((string)($_POST['nome'] ?? ''));
    $cpf = preg_replace('/\D+/', '', (string)($_POST['cpf'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $pass = (string)($_POST['senha'] ?? '');
    $role = (string)($_POST['papel'] ?? 'integrante');
    $phone = trim((string)($_POST['telefone'] ?? ''));
    if (mb_strlen($name) < 3 || strlen($cpf) !== 11 || strlen($pass) < 10 || !in_array($role, ['integrante', 'coordenador'], true) || ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL))) {
        flash('Verifique nome, CPF, e-mail e senha (mínimo 10 caracteres).', 'error');
        go('integrantes');
    }
    try {
        q('INSERT INTO usuarios(nome,cpf,email,senha_hash,papel,telefone) VALUES(?,?,?,?,?,?)', [$name, $cpf, $email ?: null, password_hash($pass, PASSWORD_DEFAULT), $role, $phone ?: null]);
        flash('Integrante cadastrado.');
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') flash('CPF ou e-mail já cadastrado.', 'error');
        else throw $e;
    }
    go('integrantes');
}
$search = trim((string)($_GET['busca'] ?? ''));
$rows = q('SELECT id,nome,email,telefone,papel,ativo FROM usuarios WHERE nome LIKE ? ORDER BY nome LIMIT 150', ['%' . $search . '%'])->fetchAll();
render_header('Integrantes'); ?><div class="page-head">
    <div>
        <div class="eyebrow">PESSOAS</div>
        <h1>Integrantes</h1>
        <p>Cadastro e consulta de participantes da invernada.</p>
    </div>
</div>
<div class="two-col">
    <section class="panel">
        <div class="section-head">
            <h2>Lista de integrantes</h2><span class="muted"><?= count($rows) ?> registros</span>
        </div>
        <form class="search" method="get"><input type="hidden" name="page" value="integrantes"><input name="busca" value="<?= h($search) ?>" placeholder="Buscar por nome"><button class="btn btn-ghost">Buscar</button></form>
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Contato</th>
                        <th>Papel</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody><?php foreach ($rows as $u): ?><tr>
                            <td><strong><?= h($u['nome']) ?></strong></td>
                            <td><?= h($u['email'] ?: $u['telefone'] ?: '—') ?></td>
                            <td><?= h(ucfirst($u['papel'])) ?></td>
                            <td><span class="pill <?= $u['ativo'] ? 'green' : 'red' ?>"><?= $u['ativo'] ? 'Ativo' : 'Inativo' ?></span></td>
                        </tr><?php endforeach; ?></tbody>
            </table>
        </div>
    </section>
    <section class="panel">
        <div class="eyebrow">COORDENAÇÃO</div>
        <h2>Novo integrante</h2>
        <form method="post" class="stack"><?= csrf_field() ?><label>Nome completo<input name="nome" maxlength="160" required></label><label>CPF (somente números)<input name="cpf" inputmode="numeric" maxlength="14" required></label><label>E-mail<input name="email" type="email"></label><label>Telefone<input name="telefone" type="tel"></label><label>Permissão<select name="papel">
                    <option value="integrante">Integrante</option>
                    <option value="coordenador">Coordenador</option>
                </select></label><label>Senha inicial (mínimo 10 caracteres)<input name="senha" type="password" minlength="10" required autocomplete="new-password"></label><button class="btn btn-primary">Cadastrar integrante</button></form>
    </section>
</div><?php render_footer();
