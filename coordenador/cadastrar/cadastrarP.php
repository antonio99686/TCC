<?php

//conecta ao banco de dado
include('../conexao.php');


//dados do formulario
$nome = $_POST['usuario'];
$nom_dan = $_POST['nome'];
$senha= $_POST['senha'];
$email= $_POST['email'];
$telefone = $_POST['telefone'];
$CPF= $_POST['cpf'];
$idade= $_POST['idade'];
$nacionalidade= $_POST['nas'];
$funcao= $_POST['funcao'];

if (isset($_FILES['arquivo'])) {

        //define o nome do arquivo
        $novo_nome = $_FILES['arquivo']['name'];

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../../img/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);


        //cadastramento no banco
        $sql = "INSERT INTO pais( 
        nome, nom_dan, 
        senha, cpf, 
         idade, nacionalidade,
          funcao,telefone,
          email,imagem) 
        VALUES 
        ('$nome','$nom_dan',
        '$senha','$CPF',
        '$idade','$nacionalidade',
        '$funcao','$telefone',
        '$email','$novo_nome')";

        // Executar o comando SQL
        if (mysqli_query($conexao, $sql)) {
                echo "pessoa cadastrada com sucesso!";
                header('Location: ../dashbord.php');
        } else {
                echo "Falha ao cadastrar pessoa.";
        }

}

?>