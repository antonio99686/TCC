<?php
session_start();
// Incluindo o arquivo de conexão com o banco de dados
include('conexao.php');



// Processamento do formulário de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['CPF'];
    $password = $_POST['senha'];

    // Consulta ao banco de dados
    $sql = "SELECT * FROM usuario WHERE CPF='$username' AND senha='$password'";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login bem-sucedido, redirecionar para a página principal
        $_SESSION['username'] = $username;
        header("location: dashboard.php");
    } else {
        // Login falhou, exibir mensagem de erro
        echo "Nome de usuário ou senha incorretos.";
    }
}

mysqli_close($conn);
?>
