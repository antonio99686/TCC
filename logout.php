<?php
// Inicia a sessão
session_start();

// Define a mensagem de sucesso na variável de sessão
$_SESSION['success_message'] = "Você saiu com sucesso.";

// Limpa todas as variáveis de sessão
$_SESSION = array();

// Se necessário, destrói a sessão
if (session_id() != "" || isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}
session_destroy();
?>

<script>
    // Exibe um alerta de sucesso
    alert("Você saiu com sucesso.");

    // Aguarda 2 segundos antes de redirecionar o usuário
    setTimeout(function() {
        window.location.href = "index.php";
    }, 2000);
</script>
