<?php

// Receber os dados do formulário
$nome = $_POST['username'];
$email = $_POST['email'];
$matricula = $_POST['matatricula'];
$telefone = $_POST['telefone'];
$entrada = $_POST['entrada'];
$senha = $_POST['senha'];




// Conectar ao BD
include("conexao.php");
if (isset($_FILES['arquivo'])) {

    //pega a extensao do arquivo
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

    //define o nome do arquivo
    $novo_nome = $_FILES['arquivo']['name'] . time();

    //define a pasta para onde enviaremos o arquivo
    $diretorio = "img/";

    //faz o upload, movendo o arquivo para a pasta especificada
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome); 

    //cadastra no banco
    $sql = "INSERT INTO usuario(nome,email,senha,entrada,imagem,matricula,telefone) 
    VALUES ('$nome','$email','$entrada','$novo_nome','$matricula','$telefone','$senha',)";
    if (mysqli_query($conexao, $sql))
        echo "Arquivo enviado com sucesso!";
    else
        echo "Falha ao enviar arquivo.";
}
header('location: ../adminstrativo.php');


?>

