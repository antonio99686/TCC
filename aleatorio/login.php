<?php
// Incluindo o arquivo de conexão com o banco de dados
include('conexao.php');

// Verificando se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturando os dados do formulário
    $CPF = $_POST['CPF'];
    $senha = $_POST['senha'];

    // Verificando as credenciais do usuário em três tabelas diferentes
    if (verifyLogin($CPF, $senha, $mysqli)) {
        // Login bem-sucedido
        echo "Login bem-sucedido!";
        // Você pode redirecionar para a página de destino após o login
         header("Location: dashboard.php");
        exit();
    } else {
        // Credenciais inválidas
        echo "Credenciais inválidas.";
    }
}

// Função para verificar o login em três tabelas diferentes
function verifyLogin($CPF, $senha, $mysqli) {
    // Array com os nomes das tabelas
    $tables = array('usuario', 'coordenador', 'pais');

    foreach ($tables as $table) {
        // Consulta SQL para verificar as credenciais do usuário
        $sql = "SELECT * FROM $table WHERE CPF = {$CPF} AND senha = {$senha}";
        $stmt = $mysqli->prepare($sql);

        // Verificando se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            echo "Erro na preparação da consulta: " . $mysqli->error;
            return false;
        }

        // Bind parameters
        $stmt->bind_param('ss', $CPF, $senha);

        // Executando a consulta preparada
        $stmt->execute();

        // Obtendo o resultado da consulta
        $result = $stmt->get_result();

        // Verificando se o usuário foi encontrado
        if ($result->num_rows === 1) {
            // Autenticação bem-sucedida
            return true;
        }
    }

    // Autenticação falhou em todas as tabelas
    return false;
}
?>
