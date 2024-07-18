<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Email</title>
    <link rel="shortcut icon" href="img/gmail.png" />
    <!-- Inclua o SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  
    <?php
;
    require_once "../conexao.php";
    $conexao = conectar();

    // Verifica a conexão
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

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
    function enviarEmail($email_usuario, $nome_usuario, $assunto, $corpo)
    {
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
    
            $mail->setFrom($config['email'], "Sentinela da Fronteira");
            $mail->addAddress($email_usuario, $nome_usuario);
            $mail->addReplyTo($config['email'], "Sentinela da Fronteira");

            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = $corpo;

            $mail->send();
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Email enviado com sucesso!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>;</script>";

        } catch (Exception $e) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Não foi possível enviar o email para . Erro: {$mail->ErrorInfo}',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
        }
    }

    // Verificação da data
    $dia_atual = date('d'); // Obtém o dia atual
    
    if ($dia_atual > 10) {
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
            Identificamos que você possui os seguintes itens pendentes para devolução: <h2>$roupas_pendentes</h2>.<br>
            Solicitamos gentilmente que você providencie a devolução desses itens o mais breve possível.<br>
            Agradecemos pela sua colaboração.<br>
            Atenciosamente,<br>
           <em><b> Grupo de dança Sentinela da Fronteira </b></em>";


                // Envia o e-mail
                enviarEmail($email_usuario, $nome_usuario, $assunto, $corpo);
            }
        } else {
            echo "<script>Swal.fire('Informação!', 'Não há usuários com roupas pendentes para notificar.', 'info');</script>";
        }

        // Fecha a conexão com o banco de dados
        $conexao->close();
    } else {
        echo "<script>Swal.fire('Informação!', 'Os e-mails só serão enviados após o dia 10 do mês.', 'info');</script>";
    }
    ?>
</body>

</html>