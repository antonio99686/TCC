<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Recuperação de Email</title>
</head>
<body>
    
</body>
</html>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "conexao.php";
$conexao = conectar();

// Verifica se o parâmetro 'email' foi passado na URL
if (isset($_GET['email'])) {
    $email = $_GET['email'];  // Recebe o email da URL

    // Verifica se o email está cadastrado no banco de dados
    $sql = "SELECT * FROM usuario WHERE email='$email'";
    $resultado = executarSQL($conexao, $sql);
    $usuario = mysqli_fetch_assoc($resultado);

    if ($usuario == null) {
        // Usando SweetAlert2 para erro de email não cadastrado
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Email não cadastrado!',
                text: 'Faça o cadastro e em seguida realize o login.',
            });
        </script>";
        die();
    }

    // Gera um token único
    $token = bin2hex(random_bytes(50));

    // Carrega a biblioteca do PHPMailer
    require_once 'PHPMailer/src/PHPMailer.php';
    require_once 'PHPMailer/src/SMTP.php';
    require_once 'PHPMailer/src/Exception.php';
    include 'config.php';  // Configurações de email, como credenciais

    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->setLanguage('br');
        $mail->SMTPDebug = SMTP::DEBUG_OFF;  // Desativa debug em produção
        $mail->isSMTP();  // Envia o email usando SMTP
        $mail->Host = 'smtp.gmail.com';  // Servidor SMTP
        $mail->SMTPAuth = true;  // Habilita autenticação SMTP
        $mail->Username = $config['email'];  // Email de envio
        $mail->Password = $config['senha_email'];  // Senha do email de envio
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Criptografia TLS
        $mail->Port = 587;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Recipiente do email
        $mail->setFrom($config['email'], 'Sistema de Recuperação');
        $mail->addAddress($usuario['email'], $usuario['nome']);  // Destinatário

        // Conteúdo do email
        $mail->isHTML(true);  // Formato HTML
        $mail->Subject = 'Recuperação de Senha do Sistema';
        $mail->Body = 'Olá!<br>
            Você solicitou a recuperação da sua conta no nosso sistema.
            Para isso, clique no link abaixo para realizar a troca de senha:<br>
            <a href="http://' . $_SERVER['SERVER_NAME'] . '/tcc/recuperar_/nova-senha.php?email='
            . $usuario['email'] . '&token=' . $token . '">Clique aqui para recuperar o acesso à sua conta!</a><br><br>
            Atenciosamente,<br>
            Equipe do Sistema';

        // Envia o email
        $mail->send();

        // Usando SweetAlert2 para sucesso
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Email enviado com sucesso!',
                text: 'Confira o seu email para redefinir sua senha.',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = '../index.php';
            });
        </script>";

        // Grava as informações na tabela recuperar-senha
        date_default_timezone_set('America/Sao_Paulo');
        $data = new DateTime('now');
        $agora = $data->format('Y-m-d H:i:s');

        $sql2 = "INSERT INTO `recuperar_senha` (email, token, data_criacao, usado) 
                 VALUES ('" . $usuario['email'] . "', '$token', '$agora', 0)";
        executarSQL($conexao, $sql2);
    } catch (Exception $e) {
        // Usando SweetAlert2 para erro no envio do email
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Não foi possível enviar o email. Tente novamente mais tarde.',
                footer: '{$mail->ErrorInfo}'
            });
        </script>";
    }
} else {
    // Usando SweetAlert2 para erro de falta de email
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Nenhum email informado!',
            text: 'Por favor, informe um email válido.',
        });
    </script>";
}
