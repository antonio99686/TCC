<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/gmail.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Salvar senha</title>
</head>
<body>
    
</body>
</html>
<?php
$email = $_POST['email'];
$token = $_POST['token'];
$senha = $_POST['senha'];
$repetirSenha = $_POST['repetirSenha'];
$hash = password_hash($senha, PASSWORD_DEFAULT);
require_once "conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM `recuperar_senha` WHERE email='$email' AND token='$token'";
$resultado = executarSQL($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);

if ($recuperar == null) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Email ou token incorreto. Tente fazer um novo pedido de recuperação de senha.',
        });
    </script>";
    die();
} else {
    date_default_timezone_set('America/Sao_Paulo');
    $agora = new DateTime('now');
    $data_criacao = DateTime::createFromFormat('Y-m-d H:i:s', $recuperar['data_criacao']);
    $umDia = DateInterval::createFromDateString('1 day');
    $dataExpiracao = date_add($data_criacao, $umDia);

    if ($agora > $dataExpiracao) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Solicitação Expirada!',
                text: 'Essa solicitação de recuperação de senha expirou! Faça um novo pedido de recuperação de senha.',
            });
        </script>";
        die();
    }

    if ($recuperar['usado'] == 1) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Link já utilizado!',
                text: 'Esse pedido de recuperação de senha já foi utilizado anteriormente! Faça um novo pedido de recuperação de senha.',
            });
        </script>";
        die();
    }

    if ($senha != $repetirSenha) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Senhas não conferem!',
                text: 'A senha que você digitou é diferente da senha repetida. Por favor, tente novamente.',
            });
        </script>";
        die();
    }

    // Atualiza a senha com hash e marca o token como usado
    $sql2 = "UPDATE usuario SET senha='$hash' WHERE email='$email'";
    executarSQL($conexao, $sql2);
    $sql3 = "UPDATE `recuperar_senha` SET usado=1 WHERE email='$email' AND token='$token'";
    executarSQL($conexao, $sql3);

    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Nova senha cadastrada com sucesso! Faça o login para acessar o sistema.',
            showConfirmButton: false,
            timer: 3000
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
}
?>
