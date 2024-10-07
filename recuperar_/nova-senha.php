<?php

// verificar o email
// verificar o token
$email = $_GET['email'];
$token = $_GET['token'];

require_once "conexao.php";
$conexao = conectar();
$sql = "SELECT * FROM `recuperar_senha` WHERE email='$email' AND 
        token='$token'";
$resultado = executarSQL($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);

if ($recuperar == null) {
    echo "Email ou token incorreto. Tente fazer um novo pedido 
          de recuperação de senha.";
    die();
} else {
    // verificar a validade do pedido (data_criacao)
    // verificar se o link jah foi usado
    date_default_timezone_set('America/Sao_Paulo');
    $agora = new DateTime('now');
    $data_criacao = DateTime::createFromFormat(
        'Y-m-d H:i:s',
        $recuperar['data_criacao']
    );
    $umDia = DateInterval::createFromDateString('1 day');
    $dataExpiracao = date_add($data_criacao, $umDia);

    if ($agora > $dataExpiracao) {
        echo "Essa solicitação de recuperação de senha expirou!
              Faça um novo pedido de recuperação de senha.";
        die();
    }

    if ($recuperar['usado'] == 1) {
        echo "Esse pedido de recuperação de senha já foi utilizado
        anteriormente! Para recuperar a senha faça um novo pedido
        de recuperação de senha.";
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="shortcut icon" href="img/gmail.png">
    <link rel="stylesheet" href="css/style.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Inputmask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.7-beta.16/jquery.inputmask.min.js"></script>
    <title>LOGIN</title>
</head>

<body>

    <div class="container" id="container">

        <div class="form-container sign-in">
            <form action="salvar-nova-senha.php" method="post">
                <input type="hidden" name="email" value="<?= $email ?>">
                <input type="hidden" name="token" value="<?= $token ?>">
                <SPAn>Email: <?= $email ?></SPAn>
                <br>
                <br>
                <label>Senha:</label>
                <input type="password" name="senha">
                <label>Repita a senha:</label>
                <input type="password" name="repetirSenha">
                <button type="submit">Salvar nova senha</button>
            </form>

        </div>

    </div>


</body>

</html>