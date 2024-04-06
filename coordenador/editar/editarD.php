<?php

// Conecta ao banco de dados
include('../conexao.php');

// Verifica se os dados do formulário foram recebidos corretamente
if(isset($_POST['usuario'], $_POST['senha'],
        $_POST['email'], $_POST['nascimento'], 
        $_POST['cpf'], $_POST['RG'], $_POST['telefone'], 
        $_POST['endereco'], $_POST['responsavel'], 
        $_POST['inicio'], $_POST['tele_respo'], 
        $_POST['idade'], $_POST['genero'], 
        $_POST['tipo'])) {

    // Dados do formulário
    $id = $_POST['id_usuario'];
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
                $sql = "UPDATE usuario SET 
                                nome='$nome', email='$email',
                                datas='$nascimento', CPF='$CPF', 
                                RG='$RG', senha='$senha',
                                 tipo='$tipo', telefone='$telefone',
                                  usuario='$matricula', imagem='$novo_nome',
                                   genero='$genero', endereco='$endereco',
                                    responsavel='$responsavel', data_entrada='$inicio',
                                     tele_respon='$tele_respon', idade='$idade'
                        WHERE
                           id_usuario = '$id'";

                // Executa o comando SQL
                if (mysqli_query($conexao, $sql)) { 
                    echo "<script>alert('Registro atualizado com sucesso!');</script>";
                    header('Location: ../dashboard.php');
                    exit();
                } else {
                    echo "<script>alert('Falha ao atualizar registro.');</script>";
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
