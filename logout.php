<?php
session_start();

// Destroi a sessão
unset($_SESSION["id_usuario"]);
unset($_SESSION["nome"]);
unset($_SESSION["status"]);

// Inclui o link para o SweetAlert2
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';

// Inicia o script JavaScript do SweetAlert2
echo '<script>';
echo 'Swal.fire({';
echo '    icon: "success",';
echo '    title: "Você saiu com sucesso!",';
echo '    showConfirmButton: false,';
echo '    timer: 1500';
echo '}).then(function() {';
echo '    window.location.href = "index.php";';
echo '});';
echo '</script>';

// Redireciona o usuário após a destruição da sessão (caso o JavaScript esteja desativado)
echo '<meta http-equiv="refresh" content="1.5;url=index.php">';

// Finaliza o script PHP
exit;
?>
