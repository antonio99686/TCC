<?php
if(me())go();
$error='';
$remainingSeconds=max(0,(int)($_SESSION['login_block_until']??0)-time());
if($remainingSeconds===0){unset($_SESSION['login_block_until']);}
if($_SERVER['REQUEST_METHOD']==='POST'){
 csrf_check();$cpf=preg_replace('/\D+/','',(string)($_POST['cpf']??''));$password=(string)($_POST['senha']??'');
 $blocked=($_SESSION['login_block_until']??0)>time();
 if($blocked){$remainingSeconds=max(0,(int)$_SESSION['login_block_until']-time());$error='Muitas tentativas. Aguarde '.max(1,(int)ceil($remainingSeconds/60)).' minuto(s) para tentar novamente.';}
 else{
  $u=q('SELECT id,nome,cpf,senha_hash,papel,ativo FROM usuarios WHERE cpf=? LIMIT 1',[$cpf])->fetch();
  if(!$u||!$u['ativo']||!password_verify($password,$u['senha_hash'])){
   $_SESSION['login_fails']=($_SESSION['login_fails']??0)+1;
   if($_SESSION['login_fails']>=7){$_SESSION['login_block_until']=time()+600;$_SESSION['login_fails']=0;$remainingSeconds=600;$error='Muitas tentativas. Aguarde 10 minutos antes de tentar novamente.';}
   else{$error='CPF ou senha inválidos. Confira se o CPF e a senha são os mesmos do cadastro inicial.';}
  }else{
   session_regenerate_id(true);unset($_SESSION['login_fails'],$_SESSION['login_block_until']);
   $_SESSION['user']=['id'=>(int)$u['id'],'name'=>$u['nome'],'role'=>$u['papel']];go();
  }
 }
}
?><!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Entrar | Sentinela da Fronteira</title><link rel="icon" type="image/png" href="assets/favicon.png"><link rel="stylesheet" href="assets/app.css"></head><body class="auth-body"><main class="auth-layout"><section class="auth-intro"><img class="auth-intro-logo" src="assets/logo-sentinela.png" alt="Brasão oficial do PTG Sentinela da Fronteira" width="180" height="228"><div class="eyebrow">✦ TRADIÇÃO E TECNOLOGIA</div><h1>Nossa cultura.<br><em>Nossa história.</em><br>Nosso futuro.</h1><p>Um novo jeito de organizar ensaios, eventos, integrantes e a vida da nossa invernada.</p><div class="auth-decor">PTG SENTINELA DA FRONTEIRA</div></section><section class="auth-panel"><div class="auth-card"><img class="auth-logo" src="assets/logo-sentinela.png" alt="Brasão do PTG Sentinela da Fronteira" width="100" height="126"><h2>Bem-vindo de volta</h2><p>Entre com suas credenciais para acessar a plataforma.</p><?php if($error):?><div class="alert error" role="alert"><?=h($error)?></div><?php elseif($remainingSeconds>0):?><div class="alert error" role="alert">Login temporariamente bloqueado. Aguarde <?=max(1,(int)ceil($remainingSeconds/60))?> minuto(s) para tentar novamente.</div><?php endif;?><form method="post" class="stack"><?=csrf_field()?><label>CPF<input name="cpf" inputmode="numeric" autocomplete="username" maxlength="14" required placeholder="000.000.000-00"></label><label>Senha<input name="senha" type="password" autocomplete="current-password" required placeholder="Sua senha"></label><button class="btn btn-primary wide" type="submit">Entrar no sistema →</button></form><p class="helper">Para recuperar o acesso, procure a coordenação.</p><?php try { if(countq("SELECT COUNT(*) FROM usuarios") === 0): ?><p class="helper"><a href="<?=h(url('install'))?>">Primeiro acesso? Cadastre o administrador</a></p><?php endif; } catch(PDOException $e) { /* Banco ainda nao configurado */ } ?></div></section></main></body></html>
