<?php
// Inicia a sessão
session_start();

// Limpa todas as variáveis de sessão
$_SESSION = array();

// Se necessário, destrói a sessão
if (session_id() != "" || isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}
session_destroy();

// Redireciona o usuário após a destruição da sessão
header("Location: ../../index.php");
exit;
?>
