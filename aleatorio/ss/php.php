<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sla";

// Criando conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['CPF'];
    $password = $_POST['senha'];

    // Consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Credenciais válidas, agora buscamos as informações adicionais
        $row = $result->fetch_assoc();
        $usuario_id = $row['id'];
        $detalhes_sql = "SELECT * FROM detalhes_usuarios WHERE usuario_id = '$usuario_id'";
        $detalhes_result = $conn->query($detalhes_sql);

        if ($detalhes_result->num_rows > 0) {
            // Informações adicionais encontradas
            $detalhes = $detalhes_result->fetch_assoc();
            echo "Nome: " . $detalhes['nome'] . "<br>";
            echo "Email: " . $detalhes['email'] . "<br>";
        } else {
            echo "Informações adicionais não encontradas";
        }
    } else {
        echo "Credenciais inválidas";
    }
}

// Fechando conexão
$conn->close();
?>
