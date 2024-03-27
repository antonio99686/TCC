<?php
session_start();
if(empty($_POST) or (empty($_POST['CPF']) or (empty($_POST['senha'])))) {
   echo"<script>location.href='index.php';</script>";
}
include('conexao.php');

$CPF =  $_POST['CPF'];
$senha = $_POST['senha'];
$sql = "SELECT * FROM usuario WHERE CPF = '{$CPF}' AND  senha = '{$senha}'";

//$sql1 = "SELECT categoria
//FROM usuario
//LEFT JOIN coordanador
//ON c.coordenador = d.dancarino";
$result = $mysqli->query("SELECT * FROM categoria");

$resultado = mysqli_query($conexao,$sql);
$dados = mysqli_fetch_assoc($resultado);

$res = $conexao->query($sql) or die($conexao->error);
$row = $res->fetch_object();
$qtd = $res->num_rows;

if($qtd > 0 ){
    $_SESSION['CPF'] = $CPF;
    $_SESSION['nome'] = $row->nome;
    $_SESSION['id_usuario'] = $dados['id_usuario'];
    if ($dados['coordenador'] == '1'){
    header ('Location: coordenador/dashbord.php');
 }
    if ($dados['pais'] == '3'){
    header ('Location: pais/dashbord.php');
 }
else {
   header ('Location: dashbord.php');
}
}

 ?>
 
