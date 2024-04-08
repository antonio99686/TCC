<?php
// Conecta ao banco de dados
include ('../conexao.php');

// Verifica se o nome do usuário está definido na URL
if (isset($_GET['nome'])) {
    $nome_usuario = $_GET['nome'];

    // Consulta SQL para obter os dados do usuário
    $sql = "SELECT * FROM usuario WHERE nome = '$nome_usuario'";
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se a consulta retornou resultados
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Extrai os dados do usuário
        $usuario = mysqli_fetch_assoc($resultado);

        // Define os dados do usuário
        $nome = $usuario['nome'];
        $senha = $usuario['senha'];
        $email = $usuario['email'];
        $CPF = $usuario['CPF'];
        $datas = $usuario['datas'];
        $statuss = $usuario['statuss'];
        $RG = $usuario['RG'];
        $categoria = $usuario['categoria'];
        $telefone = $usuario['telefone'];
        $endereco = $usuario['endereco'];
        $responsavel = $usuario['responsavel'];
        $data_entrada = $usuario['data_entrada'];
        $tele_respon = $usuario['tele_respon'];
        $idade = $usuario['idade'];
        $nom_dan = $usuario['nom_dan'];
        $genero = $usuario['genero'];
    } else {
        echo "<script>alert('Nenhum usuário encontrado com o nome fornecido.');</script>";
        exit();
    }
} else {
    echo "<script>alert('Nome do usuário não fornecido.');</script>";
    exit();
}

// Verifica se os dados do formulário foram recebidos corretamente
if (isset($nome, $senha,
        $email, $CPF,
        $datas, $statuss,
        $RG, $categoria,
        $telefone, $endereco,
        $responsavel, $data_entrada,
        $tele_respon, $idade,
        $nom_dan, $genero)) {

  

    // Verifica se um arquivo foi enviado
    if (isset($_FILES['arquivo'])) {
        // Verifica se houve erro no upload
        if ($_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            // Define o nome do arquivo
            $imagem = $_FILES['arquivo']['name'];

            // Define a pasta para onde enviaremos o arquivo
            $diretorio = "../../img/";

            // Faz o upload, movendo o arquivo para a pasta especificada
            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $imagem)) {
                // Comando SQL para inserção
                $sql = "UPDATE usuario SET 
                        statuss='$statuss',
                        nome='$nome',
                        email='$email',
                        datas='$datas',
                        CPF='$CPF',
                        RG='$RG',
                        categoria='$categoria',
                        senha='$senha',
                        telefone='$telefone',
                        endereco='$endereco',
                        responsavel='$responsavel',
                        data_entrada='$data_entrada',
                        tele_respon='$tele_respon',
                        idade='$idade',
                        nom_dan='$nom_dan',
                        genero='$genero',
                        imagem='$imagem'
                        WHERE nome='$nome_usuario'";

                // Executa o comando SQL
                if (mysqli_query($conexao, $sql)) {
                    echo "<script>alert('Dados do usuário atualizados com sucesso!');</script>";
                    header('Location: ../form/index.php');
                    exit();
                } else {
                    echo "<script>alert('Falha ao atualizar os dados do usuário.');</script>";
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
