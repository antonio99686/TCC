<?php
session_start();
// Verifique se o formulário foi enviado e se os campos CPF e senha estão preenchidos
if (empty($_POST['CPF']) or empty($_POST['senha'])) { 
   echo "<script>alert('Por favor, preencha todos os campos.'); location.href='index.php';</script>";
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
    $_SESSION['id_usuario'] = $id_usuario;
    $_SESSION['nome'] = $dados['nome'];
    $_SESSION['email'] = $dados['email'];
    $_SESSION['usuario'] = $dados['usuario'];
    $_SESSION['nom_dan'] = $dados['nom_dan'];
    $_SESSION['usuario'] = $dados['usuario'];
    $_SESSION['RG'] = $dados['RG'];
    $_SESSION['datas']= $dados['datas'];
    $_SESSION['endereco']= $dados['endereco'];
    $_SESSION['funcao']= $dados['funcao'];
    $_SESSION['responsavel']= $dados['responsavel'];
    $_SESSION['data_entrada']= $dados['data_entrada'];
    $_SESSION['categoria']= $dados['categoria'];
    $_SESSION['genero']= $dados['genero'];
    $_SESSION['tele_respon']= $dados['tele_respon'];
    $_SESSION['telefone']= $dados['telefone'];
    $_SESSION['imagem']= $dados['imagem'];
    $_SESSION['idade']= $dados['idade'];
    $_SESSION['status'] = $row->status;
    switch ($dados['status']) {
      case '1':
         echo "<script>alert('Seja bem-vindo, " . $dados['nome'] . "'); location.href='dashboard.php';</script>";
         break;
      case '2':
       echo "<script>alert('Seja bem-vindo, " . $dados['nome'] . "'); location.href='coordenador/dashboard.php';</script>";
         break;
      case '3':
         echo "<script>alert('Seja bem-vindo, " . $dados['nome'] . "'); location.href='pais/dashboard.php';</script>";
         break;
      
      default:
      echo "<script>alert('CPF ou senha incorretos.');</script>";
    echo "<script>location.href='index.php';</script>";
         break;
    } 
}

 ?>   

