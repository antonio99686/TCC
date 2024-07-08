<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Cadastro</title>
</head>

<body>

</body>

</html>
<?php
// Conecta ao banco de dados
require_once '../conexao.php';
$conexao = conectar();

// Verifica se os dados do formulário foram recebidos corretamente
if (isset($_POST['usuario'], $_POST['senha'], $_POST['status'], $_POST['CPF'])) {

    // Dados do formulário
    $nome = $_POST['usuario'];
    $senha = $_POST['senha'];
    $status = $_POST['status'];
    $CPF = $_POST['CPF'];

    // Gera um número de matrícula único
    $numero = rand(2024, 999999);
    $matricula = date('Y') . $numero;

    // Comando SQL para inserção
    $sql = "INSERT INTO usuario (nome, statuss, senha, matricula,CPF) 
    VALUES 
    ('$nome', '$status', '$senha', '$matricula','$CPF')";

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
            }).then(() => {
                window.location.href = '../index.php';
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
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
}

?>
