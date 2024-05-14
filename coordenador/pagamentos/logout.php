<?php
session_start();

// Destroi a sessão
unset($_SESSION["id_usuario"]);
unset($_SESSION["nome"]);
unset($_SESSION["status"]);


// Redireciona o usuário após a destruição da sessão (caso o JavaScript esteja desativado)
echo '<meta http-equiv="refresh" content="1.5;url=../../index.php">';

// Finaliza o script PHP
exit;
?>
