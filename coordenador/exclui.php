<?php
include("conexao.php");

$id = $_POST['id'];


//define a pasta para onde enviaremos o arquivo
$diretorio = "img/";

$sql = "SELECT * FROM usuario WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);
$lista = mysqli_fetch_assoc($resultado);

unlink($diretorio . $lista['imagem']);
$sql = "DELETE FROM usuario WHERE id = $id";
mysqli_query($conexao, $sql);


header('Location: listar.php');