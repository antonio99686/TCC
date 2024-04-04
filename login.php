<?php
session_start();

if (empty($_POST) or empty($_POST['CPF']) or empty($_POST['senha'])) {
    echo "<script>location.href='index.php';</script>";
    exit; // Termina o script se as informações não estiverem completas
}

include('conexao.php');

$CPF = $_POST['CPF'];
$senha = $_POST['senha'];

// Verifica na tabela usuarios
$sql_usuarios = "SELECT * FROM usuario WHERE CPF = '{$CPF}' AND senha = '{$senha}'";
$resultado_usuarios = mysqli_query($conexao, $sql_usuarios);
$qtd_usuarios = mysqli_num_rows($resultado_usuarios);

// Verifica na tabela coordenador
$sql_coordenadores = "SELECT * FROM coordenador WHERE CPF = '{$CPF}' AND senha = '{$senha}'";
$resultado_coordenadores = mysqli_query($conexao, $sql_coordenadores);
$qtd_coordenadores = mysqli_num_rows($resultado_coordenadores);

// Verifica na tabela pais
$sql_pais = "SELECT * FROM pais WHERE CPF = '{$CPF}' AND senha = '{$senha}'";
$resultado_pais = mysqli_query($conexao, $sql_pais);
$qtd_pais = mysqli_num_rows($resultado_pais);

if ($qtd_usuarios > 0) {
    // Usuário encontrado na tabela usuarios
    $dados_usuario = mysqli_fetch_assoc($resultado_usuarios);
    $_SESSION['CPF'] = $CPF;
    $_SESSION['nome'] = $dados_usuario['nome'];
    $_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
    header('Location: dashboard.php');
} elseif ($qtd_coordenadores > 0) {
    // Usuário encontrado na tabela coordenadores
    $dados_coordenador = mysqli_fetch_assoc($resultado_coordenadores);
    $_SESSION['CPF'] = $CPF;
    $_SESSION['nome'] = $dados_coordenador['nome'];
    $_SESSION['id_usuario'] = $dados_coordenador['id_coordenador'];
    header('Location: coordenador/dashboard.php');
} elseif ($qtd_pais > 0) {
    // Usuário encontrado na tabela pais
    $dados_pais = mysqli_fetch_assoc($resultado_pais);
    $_SESSION['CPF'] = $CPF;
    $_SESSION['nome'] = $dados_pais['nome'];
    $_SESSION['id_usuario'] = $dados_pais['id_pais'];
    header('Location: pais/dashboard.php');
} else {
    // Usuário não encontrado em nenhuma tabela
    echo "<script>alert('CPF ou senha incorretos.');</script>";
    echo "<script>location.href='index.php';</script>";
    exit;
}

?>
