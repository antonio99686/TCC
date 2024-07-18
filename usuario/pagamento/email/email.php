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
    require_once "conexao.php";
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
                window.location.href = '../../../email/index.php';
            });
        </script>";

        } catch (Exception $e) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Não foi possível enviar o email para . Erro: {$mail->ErrorInfo}',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = '../../../email/index.php';
            });
        </script>";
        }
    }

    // Verificação da data
    $dia_atual = date('d'); // Obtém o dia atual
    
    if ($dia_atual > 10) {
        // Consulta SQL para selecionar usuários com mensalidades pendentes
        $sql = "SELECT u.nome, u.email, m.mes
            FROM usuario u
            INNER JOIN mensalidades m ON u.id_usuario = m.usuario_id
            WHERE m.pago = 0";

        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            // Array para armazenar meses pendentes por usuário
            $usuarios = [];

            // Loop pelos resultados da consulta
            while ($row = $result->fetch_assoc()) {
                $nome_usuario = $row['nome'];
                $email_usuario = $row['email'];
                $mes_pendente = $row['mes'];

                // Agrupa meses pendentes por usuário
                if (!isset($usuarios[$email_usuario])) {
                    $usuarios[$email_usuario] = [
                        'nome' => $nome_usuario,
                        'meses' => []
                    ];
                }

                $usuarios[$email_usuario]['meses'][] = $mes_pendente;
            }

            // Envia um e-mail para cada usuário com os meses pendentes
            foreach ($usuarios as $email_usuario => $dados_usuario) {
                $nome_usuario = $dados_usuario['nome'];
                $meses_pendentes = implode(', ', $dados_usuario['meses']);

                // Conteúdo do e-mail
                $assunto = 'Aviso de Mensalidade Pendente';
                $corpo = "Olá $nome_usuario,<br>
            Identificamos que você possui as seguintes mensalidades pendentes: <h2>$meses_pendentes</h2>.<br>
            Por favor, regularize sua situação o quanto antes.<br>
            Atenciosamente,<br>
            <em><b> Grupo de dança Sentinela da Fronteira </b></em>";

                // Envia o e-mail
                enviarEmail($email_usuario, $nome_usuario, $assunto, $corpo);
            }
        } else {
            echo "<script>Swal.fire('Informação!', 'Não há usuários com mensalidades pendentes para notificar.', 'info');</script>";
        }

        // Fecha a conexão com o banco de dados
        $conexao->close();
    } else {
        echo "<script>Swal.fire('Informação!', 'Os e-mails só serão enviados após o dia 10 do mês.', 'info');</script>";
    }
    ?>
</body>

</html>
