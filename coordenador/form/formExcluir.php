<?php
include("conexao.php");

// Verificar se o ID foi enviado
if (!isset($_GET['id_usuario'])) {
    echo "ID do usuário não foi recebido.";
    exit();
}

// Sanitize e escapar o ID para prevenir SQL Injection
$id = mysqli_real_escape_string($conexao, $_GET['id_usuario']);

// Consulta para buscar o usuário
$sql = "SELECT * FROM usuario WHERE id_usuario = $id";
$resultado = mysqli_query($conexao, $sql);

// Verificar se o usuário existe
if (mysqli_num_rows($resultado) === 0) {
    echo "Usuário não encontrado.";
    exit();
}

// Consulta para deletar o usuário
$sql_delete = "DELETE FROM usuario WHERE id_usuario = $id";
if (mysqli_query($conexao, $sql_delete)) {
    // Operação de exclusão bem-sucedida
    echo "Usuário excluído com sucesso.";
} else {
    // Erro na operação de exclusão
    echo "Erro ao excluir usuário: " . mysqli_error($conexao);
}

// Redireciona para a página de lista
header('Location: lista.php');
exit();
?>