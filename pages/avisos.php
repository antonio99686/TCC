<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_admin();
    csrf_check();
    $title = trim((string)($_POST['titulo'] ?? ''));
    $body = trim((string)($_POST['conteudo'] ?? ''));
    if ($title === '' || mb_strlen($title) > 160 || $body === '') {
        flash('Preencha título e mensagem.', 'error');
        go('avisos');
    }
    q('INSERT INTO avisos (titulo,conteudo,criado_por) VALUES (?,?,?)', [$title, $body, me()['id']]);
    flash('Aviso publicado.');
    go('avisos');
}
$rows = q('SELECT a.*,u.nome autor FROM avisos a LEFT JOIN usuarios u ON u.id=a.criado_por ORDER BY a.criado_em DESC LIMIT 100')->fetchAll();
render_header('Mural de avisos'); ?><div class="page-head">
    <div>
        <div class="eyebrow">COMUNICAÇÃO</div>
        <h1>Mural de avisos</h1>
        <p>Mensagens da coordenação para os integrantes.</p>
    </div>
</div>
<div class="<?= admin() ? 'two-col' : 'one-col' ?>">
    <section class="panel">
        <h2>Publicações</h2><?php if (!$rows): ?><p class="empty">Ainda não há avisos.</p><?php endif;
                                                                                    foreach ($rows as $row): ?><article class="notice notice-large"><strong><?= h($row['titulo']) ?></strong>
                <p><?= nl2br(h($row['conteudo'])) ?></p><small><?= h($row['autor'] ?? 'Coordenação') ?> · <?= date('d/m/Y H:i', strtotime($row['criado_em'])) ?></small>
            </article><?php endforeach; ?>
    </section><?php if (admin()): ?><section class="panel">
            <div class="eyebrow">COORDENAÇÃO</div>
            <h2>Publicar aviso</h2>
            <form method="post" class="stack"><?= csrf_field() ?><label>Título<input name="titulo" maxlength="160" required></label><label>Mensagem<textarea name="conteudo" rows="6" required></textarea></label><button class="btn btn-primary" type="submit">Publicar comunicado</button></form>
        </section><?php endif; ?>
</div><?php render_footer();
