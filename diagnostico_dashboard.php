<?php
declare(strict_types=1);
// Ferramenta temporária para ambiente local Wamp. Exclua após o diagnóstico.
$remote = $_SERVER['REMOTE_ADDR'] ?? '';
if (!in_array($remote, ['127.0.0.1', '::1'], true)) {
    http_response_code(403);
    exit('Disponível somente no computador local.');
}
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors', '0');
error_reporting(E_ALL);
$results=[];
function check_test(string $title, callable $run): void {
    global $results;
    try { $message=$run(); $results[]=['ok'=>true,'title'=>$title,'detail'=>(string)$message]; }
    catch (Throwable $e) {
        // Não divulgar dados sensíveis do erro no navegador.
        error_log('[Sentinela diagnostico] '.$title.': '.$e);
        $msg=$e->getMessage();
        $safe = preg_replace('/(?:password|passwd|senha|pass|user|usuario|host)\s*[=:]\s*[^\s,;]+/i', '[dado protegido]', $msg);
        $results[]=['ok'=>false,'title'=>$title,'detail'=>get_class($e).': '.substr($safe,0,350)];
    }
}
try {
    require_once __DIR__.'/app/bootstrap.php';
    $results[]=['ok'=>true,'title'=>'Carregar configuração e inicialização','detail'=>'Bootstrap carregado'];
} catch (Throwable $e) {
    error_log('[Sentinela diagnostico] '.$e);
    $results[]=['ok'=>false,'title'=>'Carregar configuração e inicialização','detail'=>'Falha na inicialização. Consulte o log do PHP.'];
}
if (function_exists('db')) {
    check_test('Conexão ao MySQL', fn() => db()->query('SELECT 1')->fetchColumn() == 1 ? 'Conectado' : 'Resposta inesperada');
    $tests = [
        'Contagem de integrantes'=>'SELECT COUNT(*) FROM usuarios WHERE ativo=1',
        'Contagem de próximos eventos'=>'SELECT COUNT(*) FROM eventos WHERE inicio>=NOW() AND cancelado=0',
        'Contagem de mensalidades pendentes'=>'SELECT COUNT(*) FROM mensalidades WHERE pago=0 AND mes<=?',
        'Contagem de figurinos emprestados'=>'SELECT COUNT(*) FROM figurinos WHERE devolvido=0',
        'Lista de eventos'=>'SELECT id,titulo,tipo,inicio,local FROM eventos WHERE inicio>=NOW() AND cancelado=0 ORDER BY inicio ASC LIMIT 5',
        'Lista de avisos'=>'SELECT titulo,conteudo,criado_em FROM avisos ORDER BY criado_em DESC LIMIT 4',
    ];
    foreach($tests as $title=>$sql){
        check_test($title, function() use ($sql) {
            $stmt=db()->prepare($sql);
            $stmt->execute(str_contains($sql, 'mes<=?') ? [date('Y-m')] : []);
            $stmt->fetchAll(PDO::FETCH_ASSOC);
            return 'Consulta executada sem erros';
        });
    }
}
check_test('Extensão mbstring', fn() => function_exists('mb_strimwidth') ? 'Ativa' : throw new RuntimeException('mbstring não está ativada: pode causar falha ao exibir avisos no dashboard'));
check_test('Dados de sessão do login', function(){
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $u=$_SESSION['user']??null;
    return is_array($u) && isset($u['id'],$u['name'],$u['role']) ? 'Estrutura de sessão presente' : 'Sessão de usuário não encontrada (pode ser normal se não estiver logado)';
});
?><!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Diagnóstico dashboard — Sentinela</title><style>body{font:16px system-ui,sans-serif;background:#f5f7f6;color:#183b34;margin:0;padding:40px 16px}.wrap{max-width:780px;margin:auto}h1{font-size:28px}p{color:#66736e}.card{background:white;border:1px solid #dae3de;border-radius:12px;padding:15px 20px;margin:10px 0}.card b{display:block}.ok{color:#087247}.bad{color:#b42318}.detail{overflow-wrap:anywhere;margin-top:6px;font-size:14px}code{background:#eaf0ed;padding:2px 5px}</style></head><body><main class="wrap"><h1>Diagnóstico do painel — Sentinela</h1><p>Verifica as mesmas consultas SQL usadas no dashboard. Não altera o banco. Envie uma captura dos cartões com erro.</p><?php foreach($results as $r): ?><section class="card"><b class="<?= $r['ok']?'ok':'bad' ?>"><?= $r['ok']?'✓':'✕' ?> <?= htmlspecialchars($r['title'],ENT_QUOTES,'UTF-8') ?></b><div class="detail"><?= htmlspecialchars($r['detail'],ENT_QUOTES,'UTF-8') ?></div></section><?php endforeach; ?><p>Depois do teste, apague <code>diagnostico_dashboard.php</code> da pasta do projeto.</p></main></body></html>
