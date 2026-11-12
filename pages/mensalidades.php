<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_admin();
    csrf_check();
    $id = (int)($_POST['usuario_id'] ?? 0);
    $mes = (string)($_POST['mes'] ?? '');
    $valor = (string)($_POST['valor'] ?? '');
    $pago = isset($_POST['pago']) ? 1 : 0;
    if ($id < 1 || !valid_month($mes) || !is_numeric($valor) || (float)$valor < 0 || (float)$valor > 999999) {
        flash('Verifique os dados da mensalidade.', 'error');
        go('mensalidades');
    }
    q('INSERT INTO mensalidades(usuario_id,mes,valor,pago,data_pagamento) VALUES(?,?,?,?,?) ON DUPLICATE KEY UPDATE valor=VALUES(valor), pago=VALUES(pago),data_pagamento=VALUES(data_pagamento)', [$id, $mes, (float)$valor, $pago, $pago ? date('Y-m-d H:i:s') : null]);
    flash('Mensalidade atualizada.');
    go('mensalidades');
}
$rows = admin() ? q('SELECT m.*,u.nome FROM mensalidades m JOIN usuarios u ON u.id=m.usuario_id ORDER BY m.mes DESC,u.nome LIMIT 200')->fetchAll() : q('SELECT m.*,u.nome FROM mensalidades m JOIN usuarios u ON u.id=m.usuario_id WHERE usuario_id=? ORDER BY m.mes DESC LIMIT 100', [me()['id']])->fetchAll();
$users = admin() ? q('SELECT id,nome FROM usuarios WHERE ativo=1 ORDER BY nome')->fetchAll() : [];
render_header('Mensalidades'); ?><div class="page-head">
    <div>
        <div class="eyebrow">FINANCEIRO</div>
        <h1>Mensalidades</h1>
        <p>Controle transparente de contribuições e pagamentos registrados.</p>
    </div>
</div>
<div class="<?= admin() ? 'two-col' : 'one-col' ?>">
    <section class="panel">
        <h2>Histórico de mensalidades</h2>
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Integrante</th>
                        <th>Mês</th>
                        <th>Valor</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody><?php foreach ($rows as $r): ?><tr>
                            <td><?= h($r['nome']) ?></td>
                            <td><?= h($r['mes']) ?></td>
                            <td><?= money((float)$r['valor']) ?></td>
                            <td><span class="pill <?= $r['pago'] ? 'green' : 'orange' ?>"><?= $r['pago'] ? 'Pago' : 'Pendente' ?></span></td>
                        </tr><?php endforeach; ?></tbody>
            </table>
        </div><?php if (!$rows): ?><p class="empty">Nenhuma mensalidade registrada.</p><?php endif; ?>
    </section><?php if (admin()): ?><section class="panel">
            <div class="eyebrow">COORDENAÇÃO</div>
            <h2>Lançar mensalidade</h2>
            <form method="post" class="stack"><?= csrf_field() ?><label>Integrante<select name="usuario_id" required><?php foreach ($users as $u): ?><option value="<?= $u['id'] ?>"><?= h($u['nome']) ?></option><?php endforeach; ?></select></label><label>Competência<input type="month" name="mes" value="<?= date('Y-m') ?>" required></label><label>Valor (R$)<input type="number" step="0.01" min="0" name="valor" value="30.00" required></label><label class="check"><input type="checkbox" name="pago"> Pagamento confirmado</label>
                <p class="helper">Confirme pagamentos somente após verificação. Não há integração automática com gateway nesta versão.</p><button class="btn btn-primary">Salvar mensalidade</button>
            </form>
        </section><?php endif; ?>
</div><?php render_footer();
