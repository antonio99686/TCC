<?php

// Conecta ao banco de dados
include('../conexao.php');

// Dados do formulário
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

// Gera um número de matrícula único
$numero = rand(2022, 9999);
$matricula = date('Y') . $numero;

// Verifica se um arquivo foi enviado
if (isset($_FILES['arquivo'])) 
        // Verifica se houve erro no upload
        if ($_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            // Define o nome do arquivo
            $novo_nome = $_FILES['arquivo']['name'];

            // Define a pasta para onde enviaremos o arquivo
            $diretorio = "../../img/";

            // Faz o upload, movendo o arquivo para a pasta especificada
            if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome)){
        // Comando SQL para inserção
        $sql = "INSERT INTO usuario (
                    nome, email, 
                    datas, CPF, 
                    RG, senha,
                     tipo, telefone,
                      usuario, imagem,
                       genero, endereco, 
                       responsavel, data_entrada
                       , tele_respon, idade
                ) VALUES (
                    '$nome', '$email', 
                    '$nascimento', '$CPF',
                     '$RG', '$senha', 
                     '$tipo', '$telefone', 
                     '$matricula', '$novo_nome', 
                     '$genero', '$endereco', 
                     '$responsavel', '$inicio', 
                     '$tele_respon', '$idade'
                )";

        // Executa o comando SQL
        if (mysqli_query($conexao, $sql)) { 
            header('Location: ../dashboard.php');
            exit();
        } else {
            echo "<script>alert('Falha ao cadastrar pessoa.');</script>";
        }
    } else {
        echo "<script>alert('Erro ao fazer upload do arquivo.');</script>";
    }
} else {
    echo "<script>alert('Nenhum arquivo enviado.');</script>";
}

?>
