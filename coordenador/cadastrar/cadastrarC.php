<?php

//conecta ao banco de dado
include ('../conexao.php');


//dados do formulario
$nome = $_POST['usuario'];
$senha = $_POST['senha'];
$email = $_POST['email'];
$CPF = $_POST['cpf'];
$RG = $_POST['RG'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$data_entrada = $_POST['inicio'];
$nascimento = $_POST['nascimento'];
$genero = $_POST['genero'];
$funcao = $_POST['funcao'];
$idade = $_POST['idade'];
$nacionalidade = $_POST['nas'];
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
               nascimento,imagem,
               idade,nacionalidade,
               funcao,RG,
                telefone,data_entrada,
                endereco,genero) 
        VALUES
         ('$nome','$email',
         '$senha','$CPF',
         '$nascimento','$novo_nome',
         '$idade','$nacionalidade',
         '$funcao','$RG',
         '$telefone','$data_entrada',
         '$endereco','$genero')";

        // Executar o comando SQL
        if (mysqli_query($conexao, $sql)) {
                echo "pessoa cadastrada com sucesso!";
                header('Location: ../dashbord.php');
        } else {
                echo "Falha ao cadastrar pessoa.";
        }

}

?>