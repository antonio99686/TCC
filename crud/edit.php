<?php

// Conectar ao BD
include("conexao.php");

// receber os dados do formulário
$nome = $_GET['username'];
$email = $_GET['email'];
$matricula = $_GET['mat'];
$telefone = $_GET['tele'];
$entrada = $_GET['entrada'];   


if (isset($_FILES['arquivo'])) {

    //pega a extensao do arquivo
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

    //define o nome do arquivo
    $novo_nome = $_FILES['arquivo']['name'] . time();

    //define a pasta para onde enviaremos o arquivo
    $diretorio = "fotos/";

    //faz o upload, movendo o arquivo para a pasta especificada
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome); 

    //cadastra no banco
    $sql = "UPDATE usuario SET 
      email = '$email', entrarda = '$entrada', imagem = '$novo_nome', matrucula = '$matricula', telefone = '$telefone' WHERE nome = $nome";


    if (mysqli_query($conexao, $sql))
        echo "Arquivo enviado com sucesso!";
    else
        echo "Falha ao enviar arquivo.";
}
header('location: index.php');

