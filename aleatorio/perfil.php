<?php

require_once "../conexao.php";
$conexao = conectar();

// Carregando o PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluindo os arquivos necessários do PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Configurações do PHPMailer
$mail = new PHPMailer(true); // Habilita exceções

try {
    // Verificação da data
    $dia_atual = date('d'); // Obtém o dia atual

    if ($dia_atual > 10) {
        // Configuração do servidor SMTP local

        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->Port = 25; // ou 587, dependendo da configuração do seu servidor SMTP
        $mail->SMTPAuth = false; // Se o servidor SMTP local não requer autenticação

        // Remetente padrão
        $mail->setFrom('sentineladafronteira7@gmail.com', 'Sentinela da Fronteira');

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

                // Configuração do destinatário
                $mail->addAddress($email_usuario, $nome_usuario);

                // Conteúdo do e-mail
                $mail->isHTML(true); // Define se o e-mail será enviado como HTML ou texto plano
                $mail->Subject = 'Notificação de Roupa Pendente';
                $mail->Body =
                    "Olá $nome_usuario,\r\nVocê possui as seguintes roupas ou acessórios pendentes
                  para devolução: $roupas_pendentes.\r\nPor favor, 
                  providencie a devolução o mais breve possível.\r\n";

                // Envia o e-mail
                $mail->send();

                // Limpa os destinatários para o próximo loop
                $mail->clearAddresses();
            }
            echo 'E-mails enviados com sucesso.';
            var_dump($mail);
            echo "$nome_usuario";
            echo "$nome_roupa";
            echo "$email_usuario";
            echo "$mail->Body";
        } else {
            echo 'Não há usuários com roupas pendentes para notificar.';
        }

        // Fecha a conexão com o banco de dados
        $conexao->close();
    } else {
        echo 'Os e-mails só serão enviados após o dia 10 do mês.';
    }
} catch (Exception $e) {
    echo 'Erro ao enviar e-mails: ' . $mail->ErrorInfo;
}
?>