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
        echo "Email não cadastrado! Faça o cadastro e em seguida realize o login.";
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
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Para debug: mostrar mensagens de erro
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
            <a href="http://' . $_SERVER['SERVER_NAME'] . '/recuperar-senha/nova-senha.php?email='
            . $usuario['email'] . '&token=' . $token . '">Clique aqui para recuperar o acesso à sua conta!</a><br><br>
            Atenciosamente,<br>
            Equipe do Sistema';

        // Envia o email
        $mail->send();
        echo 'Email enviado com sucesso! Confira o seu email.';

        // Grava as informações na tabela recuperar-senha
        date_default_timezone_set('America/Sao_Paulo');
        $data = new DateTime('now');
        $agora = $data->format('Y-m-d H:i:s');

        $sql2 = "INSERT INTO `recuperar-senha` (email, token, data_criacao, usado) 
                 VALUES ('" . $usuario['email'] . "', '$token', '$agora', 0)";
        executarSQL($conexao, $sql2);
    } catch (Exception $e) {
        echo "Não foi possível enviar o email. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Nenhum email foi enviado!";
}
