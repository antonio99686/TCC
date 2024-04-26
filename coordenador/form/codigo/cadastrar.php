<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="formulario/css/style.css">
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
    $_GET['usuario'],
    $_GET['senha'],
    $_GET['email'],
    $_GET['CPF'],
    $_GET['datas'],
    $_GET['status'],
    $_GET['RG'],
    $_GET['categoria'],
    $_GET['telefone'],
    $_GET['endereco'],
    $_GET['responsavel'],
    $_GET['data_entrada'],
    $_GET['tele_respon'],
    $_GET['idade'],
    $_GET['nom_dan'],
    $_GET['genero']
)
) {

    // Dados do formulário
    $nome = $_GET['usuario'];
    $senha = $_GET['senha'];
    $email = $_GET['email'];
    $CPF = $_GET['CPF'];
    $datas = $_GET['datas'];
    $statuss = $_GET['status'];
    $RG = $_GET['RG'];
    $categoria = $_GET['categoria'];
    $telefone = $_GET['telefone'];
    $endereco = $_GET['endereco'];
    $responsavel = $_GET['responsavel'];
    $data_entrada = $_GET['data_entrada'];
    $tele_respon = $_GET['tele_respon'];
    $idade = $_GET['idade'];
    $nom_dan = $_GET['nom_dan'];
    $genero = $_GET['genero'];

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
            $diretorio = "../../../img";

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
                            window.location.href = '../index.php';
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
<!-- SweetAlert2 -->