<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>cadastro</title>
</head>

<body>

</body>

</html>
<?php
// Conecta ao banco de dados
include ('../conexao.php');

// Verifica se os dados do formulário foram recebidos corretamente
if (
    isset(
    $_POST['usuario'],
    $_POST['senha'],
    $_POST['email'],
    $_POST['CPF'],
    $_POST['datas'],
    $_POST['status'],
    $_POST['RG'],
    $_POST['categoria'],
    $_POST['telefone'],
    $_POST['endereco'],
    $_POST['responsavel'],
    $_POST['data_entrada'],
    $_POST['tele_respon'],
    $_POST['idade'],
    $_POST['nom_dan'],
    $_POST['genero']
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
    $numero = rand(2024, 999999);
    $matricula = date('Y') . $numero;

    // Verifica se um arquivo foi enviado
    if (isset($_FILES['arquivo'])) {
        // Verifica se houve erro no upload
        if ($_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            // Define o nome do arquivo
            $imagem = $_FILES['arquivo']['name'];

            // Define a pasta para onde enviaremos o arquivo
            $diretorio = "../img/";

            // Faz o upload, movendo o arquivo para a pasta especificada
            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $imagem)) {
                // Comando SQL para inserção
                $sql = "INSERT INTO usuario (
                          statuss, nome,
                          email, datas, 
                          CPF, RG, 
                          categoria, senha,
                          telefone, matricula, 
                          imagem, genero,
                          endereco, responsavel,
                          data_entrada, tele_respon,
                          idade, nom_dan
                        ) VALUES (
                          '$statuss','$nome',
                          '$email','$datas','$CPF',
                          '$RG','$categoria',
                          '$senha','$telefone',
                          '$matricula','$imagem',
                          '$genero','$endereco',
                          '$responsavel','$data_entrada',
                          '$tele_respon','$idade',
                          '$nom_dan'
                        )";

                // Executa o comando SQL
                if (mysqli_query($conexao, $sql)) {
                    // SweetAlert2 para sucesso
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: 'Pessoa cadastrada com sucesso!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = ../index.php';
                        });
                    </script>";
                    exit();
                } else {
                    // SweetAlert2 para falha na inserção
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: 'Falha ao cadastrar pessoa.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>";
                }
            } else {
                // SweetAlert2 para erro ao mover arquivo
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Erro ao mover o arquivo.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>";
            }
        } else {
            // SweetAlert2 para erro no upload
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Erro durante o upload do arquivo.',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>";
        }
    } else {
        // SweetAlert2 para nenhum arquivo enviado
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Atenção!',
                text: 'Nenhum arquivo enviado.',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    }
} else {
    // SweetAlert2 para dados incompletos
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Atenção!',
            text: 'Dados do formulário incompletos.',
            showConfirmButton: false,
            timer: 1500
        });
    </script>";
}

?>