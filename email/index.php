<?php

require_once "../conexao.php";
$conexao = conectar();

// Carregando o PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Incluindo os arquivos necessários do PHPMailer
require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
include "config.php";
// Função para enviar e-mails
function enviarEmail($email_usuario, $nome_usuario, $assunto, $corpo) {
    global $config;
    $mail = new PHPMailer(true); // Habilita exceções

    try {
        // Configuração do servidor SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->setLanguage('br');
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // ou SMTP::DEBUG_SERVER para depuração
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Endereço do servidor SMTP
        $mail->SMTPAuth = true;    // Autenticação necessária
        $mail->Username = $config['email'];
        $mail->Password = $config['senha_email'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;           // Porta padrão para SMTP

        $mail->setFrom($config['email'], "Sistema de Notificações");
        $mail->addAddress($email_usuario, $nome_usuario);
        $mail->addReplyTo($config['email'], "Sistema de Notificações");

        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body = $corpo;

        $mail->send();
        echo "Email enviado com sucesso para $nome_usuario ($email_usuario).<br>";

    } catch (Exception $e) {
        echo "Não foi possível enviar o email para $nome_usuario ($email_usuario). Erro: {$mail->ErrorInfo}<br>";
    }
}

// Configurações do PHPMailer

// Verificação da data
$dia_atual = date('d'); // Obtém o dia atual

if ($dia_atual > 10) {
    // Verifica a conexão
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Consulta SQL para selecionar usuários com roupas pendentes
    $sql = "SELECT u.nome, u.email, r.nome AS nome_roupa
            FROM usuario u
            INNER JOIN roupas r ON u.id_usuario = r.id_usuario
            WHERE r.status_devolucao = 0";

    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        // Array para armazenar roupas pendentes por usuário
        $usuarios = [];

        // Loop pelos resultados da consulta
        while ($row = $result->fetch_assoc()) {
            $nome_usuario = $row['nome'];
            $email_usuario = $row['email'];
            $nome_roupa = $row['nome_roupa'];

            // Agrupa roupas pendentes por usuário
            if (!isset($usuarios[$email_usuario])) {
                $usuarios[$email_usuario] = [
                    'nome' => $nome_usuario,
                    'roupas' => []
                ];
            }

            $usuarios[$email_usuario]['roupas'][] = $nome_roupa;
        }

        // Envia um e-mail para cada usuário com todas as roupas pendentes
        foreach ($usuarios as $email_usuario => $dados_usuario) {
            $nome_usuario = $dados_usuario['nome'];
            $roupas_pendentes = implode(', ', $dados_usuario['roupas']);

            // Conteúdo do e-mail
            $assunto = 'Notificação de Roupa Pendente';
            $corpo = "Olá $nome_usuario,<br>
            Você possui as seguintes roupas ou acessórios pendentes para devolução: $roupas_pendentes.<br>
            Por favor, providencie a devolução o mais breve possível.<br>";

            // Envia o e-mail
            enviarEmail($email_usuario, $nome_usuario, $assunto, $corpo);
        }
    } else {
        echo 'Não há usuários com roupas pendentes para notificar.<br>';
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
} else {
    echo 'Os e-mails só serão enviados após o dia 10 do mês.<br>';
}

