<?php
include("conexao.php");

if (!isset($_GET['id_usuario']) || empty($_GET['id_usuario'])) {
    echo "ID do usuário não foi recebido.";
    exit();
}

$id = mysqli_real_escape_string($conexao, $_GET['id_usuario']);

$sql = "SELECT * FROM usuario WHERE id_usuario = '$id'";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) === 0) {
    echo "Usuário não encontrado.";
    exit();
}

$sql_delete_roupas = "DELETE FROM roupas WHERE id_usuario = '$id'";
$sql_delete_usuario = "DELETE FROM usuario WHERE id_usuario = '$id'";

if (mysqli_query($conexao, $sql_delete_roupas) && mysqli_query($conexao, $sql_delete_usuario)) {
    echo "Usuário e suas roupas foram excluídos com sucesso.";
} else {
    echo "Erro ao excluir usuário e suas roupas: " . mysqli_error($conexao);
}

if (mysqli_affected_rows($conexao) > 0) {
    header('Location: lista.php');
    exit();
} else {
    echo "Nenhum usuário foi excluído.";
}
?>
