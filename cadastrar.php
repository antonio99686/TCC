<?php

//conecta ao banco de dado
include('conexao.php');


//dados do formulario
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$email = $_POST['email'];
$datas = $_POST['nascimento'];
$CPF = $_POST['cpf'];
$RG = $_POST['RG'];
$tipo = $_POST['tipo'];
$telefone = $_POST['telefone'];
$numero = rand(0000, 9999);
$matricula = date('Y') . $numero;
$endereco = $_POST['endereco'];
$responsavel = $_POST['resp'];
$data_inicio = $_POST['inicio'];
$tele_respo = $_POST['tele_respo'];

if (isset($_FILES['arquivo'])) {

        //define o nome do arquivo
        $novo_nome = $_FILES['arquivo']['name'];

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "img/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);


        //cadastramento no banco
        $sql = "INSERT INTO usuario(
     nome, email,
     datas, CPF, 
     RG, senha,
     tipo,  telefone,
     usuario, imagem,
     genero, endereco,
     resp, inicio,
     tele_respo)
 VALUES 
 ('$usuario','$email','$datas','$CPF','$RG',
 '$senha','$tipo','$telefone','$numero','$novo_nome',
 '$genero','$endereco','$responsavel','$data_inicio','$tele_respo')";

        // Executar o comando SQL
        if (mysqli_query($conexao, $sql)) {
                echo "pessoa cadastrada com sucesso!";
                header('Location: index.php');
        } else {
                echo "Falha ao cadastrar pessoa.";
        }

}

?>