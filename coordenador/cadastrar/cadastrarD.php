<?php

//conecta ao banco de dado
include('../conexao.php');


//dados do formulario

$nome = $_POST['usuario'];
$senha = $_POST['senha'];
$email = $_POST['email'];
$nascimento = $_POST['nascimento'];
$CPF = $_POST['cpf'];
$RG = $_POST['RG'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$responsavel = $_POST['responsavel'];
$inicio = $_POST['inicio'];
$tele_respon = $_POST['tele_respo'];
$idade = $_POST['idade'];
$genero = $_POST['genero'];
$tipo = $_POST['tipo'];
$numero = rand(2022, 9999);
$matricula = date('Y') . $numero;


if (isset($_FILES['file'])) {

        //define o nome do arquivo
        $novo_nome = $_FILES['arquivo']['name'];

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../../img/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

       
        //cadastramento no banco
        "INSERT INTO usuario(
                 nome, email,
                  datas, CPF, 
                  RG, senha, 
                  tipo, telefone,
                   usuario, imagem, 
                   genero, endereco, 
                   responsavel, data_entrada, 
                   tele_respon, idade)
         VALUES
              ('$nome','$email',
               '$nascimento','$CPF',
               '$RG','$senha',
                '$tipo','$telefone',
                '$matricula','$novo_nome',
                '$genero','$endereco',
                '$responsavel','$inicio',
                '$tele_respon','$idade')";

        // Executar o comando SQL

        }



?>