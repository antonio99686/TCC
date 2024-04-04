<?php

//conecta ao banco de dado
include ('../conexao.php');


//dados do formulario
$nome = $_POST['usuario'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$telefone = $_POST['telefone'];
$nascimento = $_POST['nascimento'];
$CPF = $_POST['cpf'];
$RG = $_POST['RG'];
$endereco = $_POST['endereco'];
$inicio = $_POST['inicio'];
$funcao = $_POST['funcao'];
$idade = $_POST['idade'];
$genero = $_POST['genero'];

if (isset($_FILES['arquivo'])) {

        //define o nome do arquivo
        $novo_nome = $_FILES['arquivo']['name'];

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../../img/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);


        //cadastramento no banco
        $sql = "INSERT INTO coordenador( 
                nome, email, 
                senha, CPF,
                 nascimento, imagem,
                  idade, RG, 
                  telefone,data_entrada,
                    endereco,genero,funcao)
        VALUES
         ('$nome','$email',
         '$senha','$CPF',
         '$nascimento',
         '$novo_nome','$idade',
         '$RG','$telefone',
         '$inicio','$endereco',
         '$genero','$funcao')";

        // Executar o comando SQL
        if (mysqli_query($conexao, $sql)) { 
                header('Location: ../dashboard.php');
        } else {
                echo "Falha ao cadastrar pessoa.";
        }

}


?>