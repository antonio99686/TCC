<?php
session_start();
// Verifique se o formulário foi enviado e se os campos CPF e senha estão preenchidos
if (empty($_POST['CPF']) or empty($_POST['senha'])) { 
   echo "<script>alert('Por favor, preencha todos os campos.');</script>";
    exit; // Termina o script se as informações não estiverem completas
}   

include('conexao.php');

$CPF =  $_POST['CPF'];
$senha = $_POST['senha'];
$sql = "SELECT * FROM usuario WHERE CPF = '{$CPF}' AND  senha = '{$senha}'";

$resultado = mysqli_query($conexao,$sql);
$dados = mysqli_fetch_assoc($resultado);

$res = $conexao->query($sql) or die($conexao->error);
$row = $res->fetch_object();
$qtd = $res->num_rows;

if($qtd > 0 ){
    $_SESSION['CPF'] = $CPF;
    $_SESSION['id_usuario'] = $dados['id_usuario'];;
    $_SESSION['nome'] = $dados['nome'];
    $_SESSION['statuss'] = $dados['statuss'];

    switch ($dados['statuss']) {
      case '1':
         echo "<script>alert('Seja bem-vindo, " . $dados['nome'] . "'); location.href='dashboard.php';</script>";
         break;
      case '2':
       echo "<script>alert('Seja bem-vindo, " . $dados['nome'] . "');location.href='coordenador/dashboard.php';</script>";
         break;
      case '3':
         echo "<script>alert('Seja bem-vindo, " . $dados['nome'] . "'); location.href='pais/dashboard.php';</script>";
         break;
      
      default:
      echo "<script>alert('CPF ou senha incorretos.');</script>";
    echo "<script>location.href='index.php';</script>";
         break;
    } 
} else {
    // Se nenhum registro foi encontrado, exibe um alerta informando que o CPF ou a senha estão incorretos
    echo "<script>alert('CPF ou SENHA incorretos.');</script>";
    echo "<script>location.href='index.php';</script>";
}

?>