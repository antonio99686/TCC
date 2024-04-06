<?php

// Conecta ao banco de dados
include('../conexao.php');

// Verifica se os dados do formulário foram recebidos corretamente
if(isset($_POST['usuario'], $_POST['nome'],
        $_POST['senha'], $_POST['email'],
        $_POST['telefone'], $_POST['cpf'],
        $_POST['idade'], $_POST['nas'],
        $_POST['funcao'])) {

    // Dados do formulário
    $nome = $_POST['usuario'];
    $nom_dan = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $CPF = $_POST['cpf'];
    $idade = $_POST['idade'];
    $nacionalidade = $_POST['nas'];
    $funcao = $_POST['funcao'];

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
                $sql = "INSERT INTO pais (
                            nome, nom_dan,
                             senha, cpf,
                              idade, nacionalidade,
                               funcao, telefone,
                                email, imagem
                        ) VALUES (
                            '$nome', '$nom_dan', 
                            '$senha', '$CPF', 
                            '$idade', '$nacionalidade',
                             '$funcao', '$telefone',
                              '$email', '$novo_nome'
                        )";

                // Executa o comando SQL
                if (mysqli_query($conexao, $sql)) { 
                    echo "<script>alert('Pessoa cadastrada com sucesso!');</script>";
                    header('Location: ../dashboard.php');
                    exit();
                } else {
                    echo "<script>alert('Falha ao cadastrar pessoa.');</script>";
                }
            } else {
                echo "<script>alert('Erro ao mover o arquivo.');</script>";
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
