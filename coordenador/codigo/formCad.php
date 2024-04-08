<?php

// Conecta ao banco de dados
include ('../conexao.php');

// Verifica se os dados do formulário foram recebidos corretamente
if (isset( 
    $_POST['usuario'], $_POST['senha'],
        
    $_POST['email'],$_POST['CPF'],
        
    $_POST['datas'], $_POST['status'],
        
    $_POST['RG'],$_POST['categoria'],
      
    $_POST['telefone'],$_POST['endereco'],
       
    $_POST['responsavel'],$_POST['data_entrada'],

    $_POST['tele_respon'], $_POST['idade'],
    
    $_POST['nom_dan'],$_POST['genero']
    
           
)
) {

    // Dados do formulário
    $nome = $_POST['usuario'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $CPF = $_POST['CPF'];
    $datas = $_POST['datas'];
    $statuss = $_POST['status'];
    $RG = $_POST['RG'];
    $categoria = $_POST['categoria'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $responsavel = $_POST['responsavel'];
    $data_entrada = $_POST['data_entrada'];
    $tele_respon = $_POST['tele_respon'];
    $idade = $_POST['idade'];
    $nom_dan = $_POST['nom_dan'];
    $genero = $_POST['genero'];
    
   

    // Gera um número de matrícula único
    $numero = rand(2022, 9999);
    $matricula = date('Y') . $numero;

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
                $sql = "INSERT INTO usuario(
                      statuss, nome,
                       email, datas, 
                       CPF, RG, 
                       categoria, senha,
                        telefone, matricula, 
                        imagem, genero,
                         endereco, responsavel,
                          data_entrada, tele_respon,
                           idade, nom_dan
                          VALUES 
                          ('$statuss','$nome',
                          '$email','$datas','$CPF',
                          '$RG','$categoria',
                          '$senha','$telefone',
                          '$matricula','$imagem',
                          '$genero','$endereco',
                          '$responsavel','$data_entrada',
                          '$tele_respon','$idade',
                          '$nom_dan' )";

                // Executa o comando SQL
                if (mysqli_query($conexao, $sql)) {
                    echo "<script>alert('Pessoa cadastrada com sucesso!');</script>";
                    header('Location: ../form/index.php');
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