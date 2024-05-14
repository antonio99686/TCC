<?php
// Lógica para verificar e enviar lembretes de pagamentos atrasados

// Função para verificar os pagamentos atrasados e enviar lembretes por e-mail
function verificarPagamentosAtrasados() {
    // Conectar ao banco de dados e buscar os pagamentos atrasados
    // Consulta SQL para buscar os pagamentos atrasados
    // Substitua 'seu_host', 'seu_usuario', 'sua_senha' e 'seu_banco_de_dados' pelas suas configurações
    $conn = new mysqli('localhost', 'root', '', 'sentinelas');

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta SQL para selecionar os pagamentos atrasados
    $sql = "SELECT * FROM pagamentos WHERE data_vencimento < CURDATE() AND pago = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop pelos resultados e enviar e-mails de lembrete
        while ($row = $result->fetch_assoc()) {
            $email = $row['email'];
            $valor = $row['valor'];

            // Aqui você pode enviar um e-mail de lembrete para $email sobre o pagamento de $valor
            // Use a função mail() do PHP ou uma biblioteca de e-mail como PHPMailer
            // Exemplo com PHPMailer: https://github.com/PHPMailer/PHPMailer
        }
    } else {
        echo "Nenhum pagamento atrasado encontrado.";
    }

    $conn->close();
}

// Chamar a função para verificar pagamentos atrasados e enviar lembretes
verificarPagamentosAtrasados();
?>
