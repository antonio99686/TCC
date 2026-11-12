<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_admin();
    csrf_check();
    $act = (string)($_POST['action'] ?? 'save');
    if ($act === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        q('UPDATE eventos SET cancelado=1 WHERE id=?', [$id]);
        flash('Evento cancelado.');
        go('eventos');
    }
    $t = trim((string)($_POST['titulo'] ?? ''));
    $type = (string)($_POST['tipo'] ?? 'ensaio');
    $start = (string)($_POST['inicio'] ?? '');
    $end = (string)($_POST['fim'] ?? '');
    $local = trim((string)($_POST['local'] ?? ''));
    $desc = trim((string)($_POST['descricao'] ?? ''));
    $types = ['ensaio', 'apresentacao', 'reuniao', 'evento'];
    $sd = DateTimeImmutable::createFromFormat('!Y-m-d\TH:i', $start);
    $ed = $end ? DateTimeImmutable::createFromFormat('!Y-m-d\TH:i', $end) : false;
    if ($t === '' || mb_strlen($t) > 160 || !in_array($type, $types, true) || !$sd || $sd->format('Y-m-d\TH:i') !== $start || ($end && (!$ed || $ed < $sd)) || mb_strlen($local) > 180) {
        flash('Confira os dados do evento.', 'error');
        go('eventos');
    }
    q('INSERT INTO eventos(titulo,tipo,inicio,fim,local,descricao,criado_por) VALUES(?,?,?,?,?,?,?)', [$t, $type, $sd->format('Y-m-d H:i:s'), $ed ? $ed->format('Y-m-d H:i:s') : null, $local, $desc, me()['id']]);
    flash('Evento cadastrado!');
    go('eventos');
}
$events = q('SELECT * FROM eventos WHERE cancelado=0 ORDER BY inicio DESC LIMIT 150')->fetchAll();
render_header('Ensaios e eventos'); ?><div class="page-head">
    <div>
        <div class="eyebrow">PROGRAMAÇÃO</div>
        <h1>Ensaios e eventos</h1>
        <p>Atividades e compromissos oficiais da invernada.</p>
    </div>
</div>
<div class="<?= admin() ? 'two-col' : 'one-col' ?>">
    <section class="panel">
        <div class="section-head">
            <h2>Programação cadastrada</h2><span class="muted"><?= count($events) ?> registros</span>
        </div><?php if (!$events): ?><p class="empty">Nenhum evento cadastrado.</p><?php endif;
                                                                                foreach ($events as $e): ?><article class="item" id="evento-<?= $e['id'] ?>">
                <div class="date-pill"><strong><?= date('d', strtotime($e['inicio'])) ?></strong><small><?= date('m/Y', strtotime($e['inicio'])) ?></small></div>
                <div class="item-main"><strong><?= h($e['titulo']) ?></strong>
                    <p><?= h(ucfirst($e['tipo'])) ?> · <?= date('d/m/Y H:i', strtotime($e['inicio'])) ?></p>
                    <p><?= h($e['local']) ?> <?= ($e['descricao'] ? '· ' . h($e['descricao']) : '') ?></p>
                </div><?php if (admin()): ?><form method="post" onsubmit="return confirm('Cancelar este evento?')"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $e['id'] ?>"><button class="btn btn-danger" type="submit">Cancelar</button></form><?php endif; ?>
            </article><?php endforeach; ?>
    </section><?php if (admin()): ?><section class="panel" id="novo">
            <div class="eyebrow">COORDENAÇÃO</div>
            <h2>Cadastrar evento</h2>
            <form class="stack" method="post"><?= csrf_field() ?><label>Título<input name="titulo" maxlength="160" required placeholder="Ex.: Ensaio de dança"></label><label>Tipo<select name="tipo">
                        <option value="ensaio">Ensaio</option>
                        <option value="apresentacao">Apresentação</option>
                        <option value="reuniao">Reunião</option>
                        <option value="evento">Evento</option>
                    </select></label><label>Início<input type="datetime-local" name="inicio" required></label><label>Término (opcional)<input type="datetime-local" name="fim"></label><label>Local<input name="local" maxlength="180" placeholder="Salão do PTG"></label><label>Observações<textarea name="descricao" rows="3"></textarea></label><button class="btn btn-primary" type="submit">Salvar evento</button></form>
        </section><?php endif; ?>
</div><?php render_footer();
