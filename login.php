<?php


// Verifique se o formulário foi enviado e se os campos CPF e senha estão preenchidos
if (empty($_POST['CPF']) or empty($_POST['senha'])) { // <-- MODIFICADA
   echo "<script>alert('Por favor, preencha todos os campos.'); location.href='index.php';</script>";
    exit; // Termina o script se as informações não estiverem completas
}   

include('conexao.php');
$CPF = $_POST['CPF'];
$senha = $_POST['senha'];


// Unificar as tabelas de usuário no sistema tendo um campo para o status (comum, coordenador, pais)
// Nivel
// 1 - coordenador
// 2 - pai
// 3 - comum

// um switch aqui vai facilitar a consulta para definir para onde ele será enviado

// Consulta SQL para verificar o usuário nas tabelas 'usuario', 'coordenador' e 'pais'
$sql_usuarios = "SELECT * FROM usuario WHERE CPF = '{$CPF}' AND senha = '{$senha}'";
$sql_coordenadores = "SELECT * FROM coordenador WHERE CPF = '{$CPF}' AND senha = '{$senha}'";
$sql_pais = "SELECT * FROM pais WHERE CPF = '{$CPF}' AND senha = '{$senha}'";

// Execução das consultas
$resultado_usuarios = mysqli_query($conexao, $sql_usuarios);
$resultado_coordenadores = mysqli_query($conexao, $sql_coordenadores);
$resultado_pais = mysqli_query($conexao, $sql_pais);

// Verificação se o usuário foi encontrado em alguma tabela
if (mysqli_num_rows($resultado_usuarios) > 0) {
    // Usuário encontrado na tabela 'usuario'
    $dados_usuario = mysqli_fetch_assoc($resultado_usuarios);
    $_SESSION['CPF'] = $CPF;
    $_SESSION['nome'] = $dados_usuario['nome'];
    echo "<script>alert('Seja bem-vindo, " . $dados_usuario['nome'] . "'); location.href='dashboard.php';</script>";
    exit;
} elseif (mysqli_num_rows($resultado_coordenadores) > 0) {
    // Usuário encontrado na tabela 'coordenador'
    $dados_coordenador = mysqli_fetch_assoc($resultado_coordenadores);
    $_SESSION['CPF'] = $CPF;
    $_SESSION['nome'] = $dados_coordenador['nome'];
    echo "<script>alert('Seja bem-vindo, " . $dados_coordenador['nome'] . "'); location.href='coordenador/dashboard.php';</script>";
    exit;
} elseif (mysqli_num_rows($resultado_pais) > 0) {
    // Usuário encontrado na tabela 'pais'
    $dados_pais = mysqli_fetch_assoc($resultado_pais);
    $_SESSION['CPF'] = $CPF;
    $_SESSION['nome'] = $dados_pais['nome'];
    echo "<script>alert('Seja bem-vindo, " . $dados_pais['nome'] . "'); location.href='pais/dashboard.php';</script>";
    exit;
} else {
    // Usuário não encontrado em nenhuma tabela
    echo "<script>alert('CPF ou senha incorretos.');</script>";
    echo "<script>location.href='index.php';</script>";
    exit;
}
