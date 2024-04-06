<?php

// Conecta ao banco de dados
include('../conexao.php');

// Verifica se os dados do formulário foram recebidos corretamente
if(isset($_POST['usuario'], $_POST['email'], 
$_POST['senha'], $_POST['telefone'], 
$_POST['nascimento'], $_POST['cpf'],
 $_POST['RG'], $_POST['endereco'], 
 $_POST['inicio'], $_POST['funcao'],
  $_POST['idade'], $_POST['genero'])) {

    // Dados do formulário
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

    // Verifica se um arquivo foi enviado
    if (isset($_FILES['arquivo'])) {
        // Verifica se houve erro no upload
        if ($_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            // Define o nome do arquivo
            $novo_nome = $_FILES['arquivo']['name'];

            // Define a pasta para onde enviaremos o arquivo
            $diretorio = "../../img/";

            // Faz o upload, movendo o arquivo para a pasta especificada
            if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome)) {
                // Comando SQL para inserção
                $sql = "INSERT INTO coordenador (
                            nome, email, 
                            senha, CPF, 
                            nascimento, imagem,
                             idade, RG, telefone, 
                             data_entrada, endereco,
                              genero, funcao
                        ) VALUES (
                            '$nome', '$email',
                             '$senha', '$CPF',
                              '$nascimento', '$novo_nome', '$idade',
                               '$RG', '$telefone', '$inicio', 
                               '$endereco', '$genero', '$funcao'
                        )";

                // Executa o comando SQL
                if (mysqli_query($conexao, $sql)) { 
                    echo "<script>alert('Pessoa cadastrada com sucesso!'); window.location.href='../dashboard.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Falha ao cadastrar pessoa.');</script>";
                }
            } else {
                echo "<script>alert('Erro ao fazer upload do arquivo.');</script>";
            }
        } else {
            echo "<script>alert('Erro durante o upload do arquivo.');</script>";
        }
    } else {
        echo "<script>alert('Nenhum arquivo enviado.');</script>";
    }
} else {
    echo "<script>alert('Dados do formulário incompletos.');</script>";
}

?>
