<?php

// Conecta ao banco de dados
include('../conexao.php');

// Verifica se os dados do formulário foram recebidos corretamente
if(isset($_POST['id_pais'], $_POST['usuario'],
        $_POST['nome'], $_POST['senha'], 
        $_POST['email'], $_POST['telefone'], 
        $_POST['cpf'], $_POST['idade'], 
        $_POST['nas'], $_POST['funcao'])) {

    // Dados do formulário
    $id = $_POST['id_pais'];
    $nome =  $_POST['usuario'];
    $nom_dan =  $_POST['nome'];
    $senha =  $_POST['senha'];
    $email =  $_POST['email'];
    $telefone =  $_POST['telefone'];
    $CPF =  $_POST['cpf'];
    $idade =  $_POST['idade'];
    $nacionalidade =  $_POST['nas'];
    $funcao =  $_POST['funcao'];

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
                // Comando SQL para atualização
                $sql = "UPDATE pais SET 
                            nome='$nome', nom_dan='$nom_dan',
                             senha='$senha', cpf='$CPF', 
                             idade='$idade', nacionalidade='$nacionalidade', 
                             funcao='$funcao', telefone='$telefone', 
                             email='$email', imagem='$novo_nome'
                        WHERE
                            id_pais='$id'";

                // Executa o comando SQL
                if (mysqli_query($conexao, $sql)) { 
                    echo "<script>alert('Pessoa atualizada com sucesso!');</script>";
                    header('Location: ../dashboard.php');
                    exit();
                } else {
                    echo "<script>alert('Falha ao atualizar pessoa.');</script>";
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
