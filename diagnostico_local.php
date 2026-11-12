<?php
/** Diagnóstico local de instalação. Remova este arquivo após o teste. */
if (!in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1'], true)) {
    http_response_code(403);
    exit('Diagnóstico disponível somente no próprio computador.');
}
header('Content-Type: text/html; charset=utf-8');
function esc($v) { return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
$checks=[];
$checks[]=['Versão PHP', PHP_VERSION, version_compare(PHP_VERSION,'8.1','>=')];
$checks[]=['Extensão PDO', extension_loaded('pdo')?'Ativa':'Ausente', extension_loaded('pdo')];
$checks[]=['Extensão PDO MySQL', extension_loaded('pdo_mysql')?'Ativa':'Ausente', extension_loaded('pdo_mysql')];
$checks[]=['Arquivo config.php', is_file(__DIR__.'/config.php')?'Encontrado':'AUSENTE: copiar config.example.php para config.php',is_file(__DIR__.'/config.php')];
$checks[]=['Arquivo bootstrap.php', is_file(__DIR__.'/app/bootstrap.php')?'Encontrado':'Ausente',is_file(__DIR__.'/app/bootstrap.php')];
$checks[]=['Arquivo login.php', is_file(__DIR__.'/pages/login.php')?'Encontrado':'Ausente',is_file(__DIR__.'/pages/login.php')];
if(is_file(__DIR__.'/config.php') && extension_loaded('pdo_mysql')){
 try{
  $c=require __DIR__.'/config.php';
  $d=$c['db']??[];
  if(empty($d['host'])||empty($d['name'])) throw new RuntimeException('Configuração do banco incompleta');
  $pdo=new PDO('mysql:host='.$d['host'].';port='.(int)($d['port']??3306).';dbname='.$d['name'].';charset=utf8mb4',(string)($d['user']??''),(string)($d['pass']??''),[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
  $checks[]=['Conexão MySQL','Conectado',true];
  $stmt=$pdo->query("SHOW TABLES LIKE 'usuarios'");
  $found=(bool)$stmt->fetchColumn();
  $checks[]=['Tabela usuarios',$found?'Encontrada':'Ausente',$found];
 }catch(Throwable $e){
  $checks[]=['Conexão / esquema MySQL','Falhou. Verifique banco, credenciais e se o MySQL está ativo. Consulte log do PHP. Código: '.$e->getCode(),false];
  error_log('Diagnostico local TCC: '.$e->getMessage());
 }
}
echo '<!doctype html><html lang="pt-BR"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Diagnóstico TCC</title><style>body{font:16px system-ui;max-width:780px;margin:40px auto;padding:16px;background:#f7f9f8;color:#16372e}article{background:#fff;border:1px solid #d8e3de;border-radius:12px;padding:16px;margin:12px 0}strong{display:block;margin-bottom:5px}.ok{color:#167346}.fail{color:#b42318}small{color:#667}</style><h1>Diagnóstico local — Sentinela</h1><p>Este teste não exibe senhas ou credenciais do banco.</p>';
foreach($checks as $check) echo '<article><strong>'.esc($check[0]).'</strong><span class="'.($check[2]?'ok':'fail').'">'.esc($check[1]).'</span></article>';
echo '<p><small>Ao terminar, remova diagnostico_local.php da pasta TCC. Se o erro 500 continuar, consulte o arquivo de log do Apache/PHP no menu do WampServer.</small></p></html>';
