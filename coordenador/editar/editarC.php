<?php

// Conecta ao banco de dados
include ('../conexao.php');

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
                // Cadastramento no banco
                $sql = "UPDATE coordenador SET 
                nome=$nome, email=$email,
                 senha=$senha, CPF=$CPF,
                  nascimento=$nascimento, imagem=$novo_nome,
                   idade=$idade, funcao=$funcao,
                    RG=$RG, telefone=$telefone,
                     data_entrada=$inicio, endereco=$endereco,
                      genero=$genero WHERE id_coor=$id_coor";
                $stmt = mysqli_prepare($conexao, $sql);
                mysqli_stmt_bind_param($stmt, "ssssssissssssi", $nome, $email,
                 $senha, $CPF, $nascimento, 
                 $novo_nome, $idade, 
                 $funcao, $RG, $telefone,
                  $inicio, $endereco, $genero,
                   $id_coor);
                
                // Executa o comando SQL
                if (mysqli_stmt_execute($stmt)) { 
                    echo "<script>alert('Arquivo enviado com sucesso!');</script>";
                    header('Location: ../dashboard.php');
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
